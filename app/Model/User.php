<?php
class User extends AppModel {

  // バリデーションの記述
  public $validate = array(
    'username' => array(
      array(
        'rule' => 'alphaNumeric',
        'message' => 'ユーザー名は英数字で入力してください',
      ),
      array(
        'rule' => array('minLength' , 4),
        'message' =>'ユーザー名が短すぎます'
      ),
      array(
        'rule' => array('maxLength' , 255),
        'message' =>'ユーザー名が長すぎます'
      ),
      array(
        'rule' => array('isUnique'), //同じログイン名が入力された場合に自動的にエラーとなる
        'message' =>'既に登録されているユーザー名です'
      ),
    ),
    'password' => array(
      array(
        'rule' => 'alphaNumeric',
        'message' => 'パスワードを英数字で入力してください'
      ),
      array(
        'rule' => array('minLength' , 4),
        'message' => 'パスワードが短すぎます'
      ),
      array(
        'rule' => array('maxLength' , 255),
        'message' => 'パスワードが長すぎます'
      ),
    ),
  );  

  //保存前の処理
  // 
  function beforeSave($options = array()) {//DB保存前に暗号化するファンクション

    // パスワードが入力されている場合は暗号化する
    // $this->aliasにはモデル名（User）が入っている→モデル名が変化しても汎用的に使えるようにするためにこの書き方にしている
    if(!empty($this->data[$this->alias]['password'])){
      $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
    return true;
  }

}