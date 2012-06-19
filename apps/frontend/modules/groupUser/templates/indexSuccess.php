<h1>Group users List</h1>

<table class="table">
  <thead>
    <tr>
      <th>Name</th>
	    <th>Elements</th>
	    <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($group_users as $group_user): ?>
    <tr>
      <td><a href="<?php echo url_for('groupUser/edit?id='.$group_user->getId()) ?>"><?php echo $group_user->getName() ?></a></td>
	    <td><?php echo $group_user->countUser(); ?></td>
	    <td><?php echo $group_user->getDescription(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="btn btn-success" href="<?php echo url_for('groupUser/new') ?>">New</a>
