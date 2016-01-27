<?php
class ContactsController extends AppController{

  // モデルの指定
  public $uses = array('Contact');

  // ページネーション設定
  public $paginate = array(
    'Contact' => array(
      'order' => array(
        'id' => 'DESC',
      ),
      'limit' => 30,
    ),
  );

  /**
   *   beforeRenderコールバック
   */
  public function beforeRender(){

    $this->set('sexList' , $this->Contact->MtrSex->find('list'));
    $this->set('ageList' , $this->Contact->MtrAge->find('list'));
    $this->set('favoliteList' , $this->Contact->MtrFavolite->find('list'));

  }


  /**
   *   問い合わせリスト
   */
  public function index() {

    $contactData = $this->paginate('Contact');

    $this->set(compact('contactData'));

  } //function index

  /**
   *   問い合わせ詳細
   */
  public function view($id) {

    // お問い合わせを捜して見つかったら表示
    $contactData = $this->Contact->findById($id);
    if(empty($contactData)){
      $this->Session->setFlash('お問い合わせが見つかりませんでした');
      $this->redirect(array('action' => 'index'));
    }

    $this->set(compact('contactData'));

  }


  /**
   *   お問い合わせ編集
   */
  public function edit($id){

    // フォーム入力があった場合には保存処理。そうでない場合は初期値の準備
    if($this->request->isPut()){
      
      if($this->Contact->save($this->request->data)){

        $this->Session->setFlash('お問い合わせを保存しました');
        $this->redirect(array('action' => 'index'));

      } else {

        $this->Session->setFlash('入力に間違いがあります');

      }        
    } else {

      $this->request->data = $this->Contact->findById($id);

      if(empty($this->request->data)){
        $this->Session->setFlash('お問い合わせが見つかりませんでした');
        $this->redirect(array('action' => 'index'));
      }
    }

  }

  /**
   *   お問い合わせ削除
   */
  public function delete($id){

    // フォーム入力があった場合に削除処理。そうでない場合は初期値の準備
    if($this->request->isDelete()) {

      // 削除実行。削除できない場合はエラー
      if($this->Contact->delete($id)){
        $this->Session->setFlash('お問い合わせを削除しました');
        $this->redirect(array('action' => 'index'));        
      } else {

        $this->Session->setFlash('お問い合わせの削除に失敗しました');
        $this->redirect(array('action' => 'index'));

      }


      // お問い合わせを探し、いなかったらエラー
      // 
      $this->request->data = $this->Contact->findById($id);
      if(empty($this->request->data)){
        $this->Session->setFlash('お問い合わせが見つかりませんでした');
        $this->redirect(array('action' => 'index'));
      }
    }
  }
  
}