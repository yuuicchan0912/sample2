<?php
class Contact extends AppModel {

  public $belongsTo = array(
    'MtrSex',
    'MtrAge',
  );

  public $hasAndBelongsToMany = array(
    'MtrFavolite',
  );

  public $validate = array(
    'name' => array(
      array(
        'rule' => 'notBlank',
        'message' => '何も入力されていません',
      ),
      array(
        'rule' => array('maxLength', 255),
        'message' => '文字数が多すぎます',
      ),
    ),
    'email' => array(
      array(
        'rule' => 'notBlank',
        'message' => '何も入力されていません',
      ),
      array(
        'rule' => array('maxLength', 255),
        'message' => '文字数が多すぎます',
      ),
      array(
        'rule' => 'email',
        'message' => '正しくないメールアドレスです',
      ),
    ),
    'mtr_sex_id' => array(
      array(
        'rule' => 'notBlank',
        'message' => '何も入力されていません',
      ),
    ),
    'mtr_age_id' => array(
      array(
        'rule' => 'notBlank',
        'message' => '何も入力されていません',
      ),
    ),
    'title' => array(
      array(
        'rule' => 'notBlank',
        'message' => '何も入力されていません',
      ),
      array(
        'rule' => array('maxLength', 255),
        'message' => '文字数が多すぎます',
      ),
    ),
    'content' => array(
      array(
        'rule' => 'notBlank',
        'message' => '何も入力されていません',
      ),
      array(
        'rule' => array('maxLength', 255),
        'message' => '文字数が多すぎます',
      ),
    ),
  );//$validate

} //Contactclass