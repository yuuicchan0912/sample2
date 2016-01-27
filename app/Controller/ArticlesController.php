<?php
class ArticlesController extends AppController {
  // モデルの指定
  public $uses = array('Article');

  // indexアクション
  public function index(){
    $userData = $this->Article->find('all');
    $this->set(compact('userData'));
    
  }  

}
