<h2>プレアントレ申請管理</h2>
<?php if ($requests): ?>
<table class="table">
  <thead>
    <tr>
      <th>申請ID</th>
      <th>ステータス</th>
      <th>ユーザID</th>
      <th>ユーザー名</th>
      <th>申請日</th>
      <th>承認日</th>
      <th>有効期限</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($requests as $item): ?>
    <?php if (empty($item->user)) continue; ?>
    <tr>
      <td><?php echo $item->id; ?></td>
      <td><?php echo $item->status == '1'?"<font color='red'>":null; ?><?php echo $item->getStatus(); ?><?php echo $item->status == '1'?"</font>":null; ?></td>
      <td><?php echo $item->user->id; ?></td>
      <td><?php echo Html::anchor('admin/users/show/'.$item->user->id, $item->user->getName()) ?></td>
      <td><?php echo $item->created_at?date('Y/m/d H:i:s', $item->created_at):null; ?></td>
      <td><?php echo $item->updated_at?date('Y/m/d H:i:s', $item->updated_at):null; ?></td>
      <td><?php echo $item->updated_at?date('Y/m/d', mktime(0, 0, 0, date('m', $item->updated_at) + 4, 0, date('Y', $item->updated_at))):null; ?></td>
      <td>
        <?php echo Html::anchor('admin/preentre/requests/review/'.$item->id, '申請確認',
          array('class' => 'btn btn-primary btn-xs'));
        ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php else: ?>
  <p>No Preentre Requests.</p>

<?php endif; ?>
