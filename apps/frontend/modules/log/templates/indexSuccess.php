<?php
function getBadgeClass($level){
	if($level == 1)
		$badge = 'badge-success';
	elseif($level == 2)
		$badge = 'badge-warning';
	elseif($level == 3)
		$badge = 'badge-important';
	return $badge;
}
?>

<h1>Logs List</h1>
<form class="form-horizontal" method="post">
	<?php echo $formFilter;$formFilter->renderHiddenFields() ?>
	<input type="submit" value='ok'>
</form>

<?php if(isset($pager)): ?>
<div class="pagination">
	<ul>
		<li><a href="<?php echo url_for('log/index') ?>?page=<?php echo $pager->getPreviousPage() ?>">Prev</a></li>
		<?php foreach ($pager->getLinks() as $page): ?>
		<?php if ($page == $pager->getPage()): ?>
			<li class="active"><a href="#"><?php echo $page ?></a></li>
			<?php else: ?>
			<li><a href="<?php echo url_for('log/index') ?>?page=<?php echo $page ?>"><?php echo $page ?></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
		<li><a href="<?php echo url_for('log/index') ?>?page=<?php echo $pager->getNextPage() ?>">Next</a></li>
	</ul>
</div>
<?php endif; ?>


<table class="table">
	<thead>
	<tr>
		<th>Id</th>
		<th>Level</th>
		<th>Host</th>
		<th>User</th>
		<th>Action</th>
		<th>Detail</th>
		<th>Date</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($logs as $log): ?>
	<tr>
		<td><?php echo $log->getId() ?></td>
		<td>
	      <span class="badge <?php echo getBadgeClass($log->level) ?>" >
	      <?php echo Log::getNameLevel($log->getLevel()) ?>
	      </span>
		</td>
		<td><?php echo $log->Host[0]->getName() ?></td>
		<td><?php if(isset($log->User[0])) echo $log->User[0] ?></td>
		<td><?php echo $log->getAction() ?></td>
		<td><?php echo $log->getDetail() ?></td>
		<td><?php echo $log->getDate() ?></td>
	</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php if(isset($pager)): ?>
<div class="pagination">
	<ul>
		<li><a href="<?php echo url_for('log/index') ?>?page=<?php echo $pager->getPreviousPage() ?>">Prev</a></li>
		<?php foreach ($pager->getLinks() as $page): ?>
		<?php if ($page == $pager->getPage()): ?>
			<li class="active"><a href="#"><?php echo $page ?></a></li>
			<?php else: ?>
			<li><a href="<?php echo url_for('log/index') ?>?page=<?php echo $page ?>"><?php echo $page ?></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
		<li><a href="<?php echo url_for('log/index') ?>?page=<?php echo $pager->getNextPage() ?>">Next</a></li>
	</ul>
</div>
<?php endif; ?>