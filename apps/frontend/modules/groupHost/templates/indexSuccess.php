<h1>Group hosts List</h1>

<table class="table">
  <thead>
    <tr>
      <th>Name</th>
	    <th>Elements</th>
	    <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($group_hosts as $group_host): ?>
    <tr>
      <td><a href="<?php echo url_for('groupHost/edit?id='.$group_host->getId()) ?>"><?php echo $group_host->getName() ?></a></td>
	    <td><?php echo $group_host->countHost(); ?></td>
	    <td><?php echo $group_host->getDescription(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="btn btn-success" href="<?php echo url_for('groupHost/new') ?>">New</a>
