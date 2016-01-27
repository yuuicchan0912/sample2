<?php
class Article extends AppModel {
  // アソシエーションの設定(belongsTo)
  public $belongsTo = array(
    'User',
  );

  // もしほかのアソシエーションを行いたい場合は次のように記述
  public $hasOne = array(
//     YourModel, ←hasOneの関係にしたいモデル名
  );
  // もしほかのアソシエーションを行いたい場合は次のように記述
  public $hasMany = array(
//     YourModel, ←hasManyの関係にしたいモデル名
  );  
  // もしほかのアソシエーションを行いたい場合は次のように記述
  public $hasAndBelongsToMany = array(
//     YourModel, ←HABTMの関係にしたいモデル名
  );

}
