<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('config/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
	  <thead>
	  <tr>
		  <td>Name</td>
		  <td><?php echo $form->getObject()->getName()?></td>
	  </tr>
	  <tr>
		  <td>Description</td>
		  <td><?php echo nl2br($form->getObject()->getDescription())?></td>
	  </tr>
	  </thead>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('config/index') ?>">Back to list</a>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
<!--      <tr>-->
<!--        <th>--><?php //echo $form['name']->renderLabel() ?><!--</th>-->
<!--        <td>-->
<!--          --><?php //echo $form['name']->renderError() ?>
<!--          --><?php //echo $form['name'] ?>
<!--        </td>-->
<!--      </tr>-->
      <tr>
        <th><?php echo $form['value']->renderLabel() ?></th>
        <td>
          <?php echo $form['value']->renderError() ?>
          <?php echo $form['value'] ?>
        </td>
      </tr>
<!--      <tr>-->
<!--        <th>--><?php //echo $form['description']->renderLabel() ?><!--</th>-->
<!--        <td>-->
<!--          --><?php //echo $form['description']->renderError() ?>
<!--          --><?php //echo $form['description'] ?>
<!--        </td>-->
<!--      </tr>-->
    </tbody>
  </table>
</form>
