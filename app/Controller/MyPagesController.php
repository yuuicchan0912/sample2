<?php
class MyPagesController extends AppController{

  // モデルの指定(今はモデルがない状態です)
  public $uses = array();

  // レイアウトの指定(defaiultの場合はなくても動作します)
  public $layout = 'default';

  // indexアクション
  public function index(){
  }

}