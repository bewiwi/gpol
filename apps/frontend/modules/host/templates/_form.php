<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('host/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="table">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('host/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'host/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
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
        <th><?php echo $form['ip']->renderLabel() ?></th>
        <td>
          <?php echo $form['ip']->renderError() ?>
          <?php echo $form['ip'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['serial']->renderLabel() ?></th>
        <td>
          <?php echo $form['serial']->renderError() ?>
          <?php echo $form['serial'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['os']->renderLabel() ?></th>
        <td>
          <?php echo $form['os']->renderError() ?>
          <?php echo $form['os'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['enable']->renderLabel() ?></th>
        <td>
          <?php echo $form['enable']->renderError() ?>
          <?php echo $form['enable'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
