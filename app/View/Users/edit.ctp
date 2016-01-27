<h1>サンプル2</h1>
<h2>ユーザー管理</h2>

<h3>ユーザーの<?php echo empty($this->data['User']['id']) ? '追加' : '編集';?></h3><!--trueの場合は編集、falseの場合は新規追加-->

<?php echo $this->Form->create('User'); ?>

<?php echo empty($this->data['User']['id']) ? null : $this->Form->input('id' , array('type' => 'hidden'))?>

<div class="input">
  <p>ID</p>
  <p><?php echo empty($this->data['User']['id']) ? '(新規)' : h($this->data['User']['id']); ?></p>
</div>

<?php echo $this->Form->input('username'); ?>
<?php echo $this->Form->input('password'); ?>
<?php echo $this->Form->end(empty($this->data['User']['id']) ? '　追加　' : '　編集　'); ?>