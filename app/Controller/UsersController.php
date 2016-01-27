<?php
class UsersController extends AppController{

  // モデルの指定
  public $uses = array('User');

  /**
   *   beforeFilterコールバック
   */
  public function beforeFilter(){

    // ログインなしでアクセス可能なページを列挙
    $this->Auth->allow('add');
  }

  /**
   *   ログイン処理
   */
  public function login(){

    // フォームに入力があった場合にログイン処理後ダッシュボードへ
    if($this->request->isPost()){

      if($this->Auth->login()){
        $this->redirect(array('action' => 'index'));
      } else {
        echo 'ログインに失敗しました';
      }
    }
  }

  /**
   *   ログアウト処理
   */
  public function logout(){
    $this->Auth->logout();
  }

  /**
   *   ダッシュボード
   */
  public function index(){
    // ビューテンプレートを表示するのみ
  }

  /**
   *   管理者リスト
   */
  public function userlist(){

    // ページネーション機能でデータを入手し、リスト作成
    $userData = $this->paginate();

    $this->set(compact('userData'));

  }

  /**
   *   管理者詳細
   */
  public function view($id){

    // ユーザを捜して見つかったら表示
    $userData = $this->User->findById($id);
    if(empty($userData)){
      $this->Session->setFlash('ユーザが見つかりませんでした');
      $this->redirect(array('action' => 'userlist'));
    }

    $this->set(compact('userData'));
  }

  /**
   *   ユーザ追加
   */
  public function add(){

    // addはeditと同じ処理。ただし、idは無指定
    return $this->edit();

  }

  /**
   *   ユーザ編集
   */
  public function edit($id = null){

    // フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
    if($this->request->isPost() || $this->request->isPut()){
      
      // edit時にもしパスワードが空白だったら対象外にする
      // 新規追加かどうかをチェックする
      if($id !== null) {
        if($this->request->data[$this->User->alias]['password'] == ''){

          unset($this->request->data[$this->User->alias]['password']);

        }
      }

      if($this->User->save($this->request->data)){

        $this->Session->setFlash('ユーザ情報を保存しました');
        $this->redirect(array('action' => 'userlist'));

      } else {

        $this->Session->setFlash('入力に間違いがあります');

      }        
    } else {
      if($id !== null) {

        $this->request->data = $this->User->findById($id);
        unset($this->request->data[$this->User->alias]['password']);

        if(empty($this->request->data)){
          $this->Session->setFlash('ユーザが見つかりませんでした');
          $this->redirect(array('action' => 'userlist'));
        }

      }//if文
    }

    // addもeditもedit.ctpを表示する(明示)→addの場合もeditテンプレートを表示するため
    $this->render('edit');
  }

  /**
   *   ユーザ削除
   */
  public function delete($id){

    // フォーム入力があった場合に削除処理。そうでない場合は初期値の準備
    if($this->request->isDelete()) {

      // 削除実行。削除できない場合はエラー
      if($this->User->delete($id)){
        $this->Session->setFlash('ユーザを削除しました');
        $this->redirect(array('action' => 'userlist'));        
      }
      $this->Session->setFlash('ユーザの削除に失敗しました');
      $this->redirect(array('action' => 'userlist'));

    // フォーム入力がなかった場合は、確認画面用にユーザデータ入手
    // 見つからなかった場合はエラー
    } else {
      $this->request->data = $this->User->findById($id);
      if(empty($this->request->data)){
        $this->Session->setFlash('ユーザが見つかりませんでした');
        $this->redirect(array('action' => 'userlist'));
      }
    }
  }
}