<h1>Configs List</h1>

<table class="table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Value</th>
	    <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($configs as $config): ?>
    <tr>
      <td><a href="<?php echo url_for('config/edit?id='.$config->getId()) ?>"><?php echo $config->getName() ?></a></td>
      <td><?php echo $config->getValue() ?></td>
	    <td><?php echo nl2br($config->getDescription()) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

