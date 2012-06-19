<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php function test_in_array($obj,$array){
	foreach($array as $t){if($t->getId() == $obj->getId())return true;}return false;
} ?>
<?php $nb_col = 5; ?>
<form action="<?php echo url_for('gpol/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	<?php if (!$form->getObject()->isNew()): ?>
	<input type="hidden" name="sf_method" value="put" />
	<?php endif; ?>
	<table class="table">
		<tfoot>
		<tr>
			<td colspan="2">
				<?php echo $form->renderHiddenFields(false) ?>
				&nbsp;<a href="<?php echo url_for('gpol/index') ?>">Back to list</a>
				<?php if (!$form->getObject()->isNew()): ?>
				&nbsp;<?php echo link_to('Delete', 'gpol/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
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
			<th><?php echo $form['type']->renderLabel() ?></th>
			<td>
				<?php echo $form['type']->renderError() ?>
				<?php echo $form['type'] ?>
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
			<th style="vertical-align:text-top; "><?php echo $form['script']->renderLabel() ?></th>
			<td>
				<?php echo $form['script']->renderError() ?>
				<?php echo $form['script'] ?>
			</td>
		</tr>
		<tr>
			<th colspan="2">Link Host</th>
		</tr>
		<tr>
			<td colspan="2">
				<?php $i=0;foreach($data['hosts'] as $host): ?>
				<input type="checkbox" name="host[]"  <?php if(test_in_array($host,$datalinked['hosts']))echo'checked="checked"' ?> value="<?php echo $host->getId() ?>" /><?php echo $host->getName() ?>
				<?php if($i%$nb_col == $nb_col-1):?>
					<br />
					<?php endif;$i++;?>
				<?php endforeach; ?>
			</td>
		</tr>
		<tr>
			<th colspan="2">Link User</th>
		</tr>
		<tr>
			<td colspan="2">
				<?php $i=0;foreach($data['users'] as $user): ?>
				<input type="checkbox" name="user[]" <?php if($form->getObject()->getType() == '1' || $form->getObject()->isNew())echo'disabled="disabled"' ?>  <?php if(test_in_array($user,$datalinked['users']))echo'checked="checked"' ?> value="<?php echo $user->getId() ?>" /><?php echo $user ?>
				<?php if($i%$nb_col == $nb_col-1):?>
					<br />
					<?php endif;$i++;?>
				<?php endforeach; ?>
			</td>
		</tr>
		<tr>
			<th colspan="2">Link Group Host</th>
		</tr>
		<tr>
			<td colspan="2">
				<?php $i=0;foreach($data['groupHosts'] as $groupHost):  ?>
				<input type="checkbox" name="groupHost[]" <?php if(test_in_array($groupHost,$datalinked['groupHost']))echo'checked="checked"' ?> value="<?php echo $groupHost->getId() ?>" /><?php echo $groupHost->getName() ?>
				<?php if($i%$nb_col == $nb_col-1):?>
					<br />
					<?php endif;$i++;?>
				<?php endforeach; ?>
			</td>
		</tr>
		<tr>
			<th colspan="2">Link Group User</th>
		</tr>
		<tr>
			<td colspan="2">
				<?php $i=0;foreach($data['groupUsers'] as $groupUser): ?>
				<input type="checkbox" name="groupUser[]"  <?php if($form->getObject()->getType() == '1' || $form->getObject()->isNew())echo'disabled="disabled"' ?>  <?php if(test_in_array($groupUser,$datalinked['groupUser']))echo'checked="checked"' ?> value="<?php echo $groupUser->getId() ?>" /><?php echo $groupUser->getName() ?>
				<?php if($i%$nb_col == $nb_col-1):?>
					<br />
					<?php endif;$i++;?>
				<?php endforeach; ?>
			</td>
		</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript" >
	$('#gpol_type').change(
					function(){
						type = $(this).attr('value');
						if(type == 1){//Type BOOT
							$('#site_content').find('input[name="user[]"]').attr("disabled", true);
							$('#site_content').find('input[name="groupUser[]"]').attr("disabled", true);
						}else{
							$('#site_content').find('input[name="user[]"]').removeAttr("disabled");
							$('#site_content').find('input[name="groupUser[]"]').removeAttr("disabled");
						}
					}
	);
</script>