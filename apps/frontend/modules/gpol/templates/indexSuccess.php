<h1>Gpols List</h1>

<table class="table">
  <thead>
    <tr>
      <th>Name</th>
	    <th>Type</th>
      <th>Desc</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($gpols as $gpol): ?>
    <tr>
      <td> <a href="<?php echo url_for('gpol/edit?id='.$gpol->getId()) ?>"><?php echo $gpol->getName() ?></a></td>
	    <td><?php echo $gpol->getTypeName() ?></td>
      <td><?php echo $gpol->getDescription() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="btn btn-success" href="<?php echo url_for('gpol/new') ?>">New</a>
