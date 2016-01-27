<h2>投稿一覧</h2>

<table>

<th>No</th>
<th>名前</th>
<th>タイトル</th>
<th>内容</th>
</tr>

<?php foreach($userData as $data): ?>

<tr>
<td><?php echo h($data['Article']['user_id']); ?></td>
<td><?php echo h($data['User']['name']); ?></td>
<td><?php echo nl2br(h($data['Article']['title'])); ?></td>
</tr>


<?php endforeach; ?>

</table>
