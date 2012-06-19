<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php function test_in_array($obj,$array){
	foreach($array as $t){if($t->getId() == $obj->getId())return true;}return false;
} ?>
<form action="<?php echo url_for('groupUser/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>
	<table class="table">
		<tfoot>
		<tr>
			<td colspan="2">
				<?php echo $form->renderHiddenFields(false) ?>
				&nbsp;<a href="<?php echo url_for('groupUser/index') ?>">Back to list</a>
				<?php if (!$form->getObject()->isNew()): ?>
				&nbsp;<?php echo link_to('Delete', 'groupUser/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
				<?php endif; ?>
				<input type="submit" value="Save" />
			</td>
		</tr>
		</tfoot>
		<tbody>
		<?php echo $form->renderGlobalErrors() ?>
		<tr>
			<th><?php echo $form['name']->renderLabel() ?></th>
			<td>
				<?php echo $form['name']->renderError() ?>
				<?php echo $form['name'] ?>
			</td>
		</tr>
		<tr>
			<th><?php echo $form['description']->renderLabel() ?></th>
			<td>
				<?php echo $form['description']->renderError() ?>
				<?php echo $form['description'] ?>
			</td>
		</tr>
		<tr>
			<th>Members</th>
			<td>
				<?php foreach($allusers as $user): ?>
					<label><input type="checkbox" name="user[]" value="<?php echo $user->getId();?>"  <?php if(test_in_array($user,$users))echo 'checked="checked"' ?>  /><?php echo $user ?> </label>
				<?php endforeach; ?>

			</td>
		</tr>
		</tbody>
	</table>






</form>
