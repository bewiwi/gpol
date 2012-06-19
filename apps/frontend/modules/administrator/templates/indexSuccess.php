<h1>Administrator List</h1>

<table class="table">
  <thead>
    <tr>
	    <th>#</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Email address</th>
      <th>Username</th>
      <th>Last login</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sf_guard_users as $sf_guard_user): ?>
    <tr>
	    <td><i class="<?php if(! $sf_guard_user->getIsActive())echo 'icon-remove';else echo 'icon-ok'  ?>" ></i></td>
      <td><a href="<?php echo url_for('administrator/edit?id='.$sf_guard_user->getId()) ?>"><?php echo $sf_guard_user->getFirstName() ?></a></td>
      <td><?php echo $sf_guard_user->getLastName() ?></td>
      <td><?php echo $sf_guard_user->getEmailAddress() ?></td>
      <td><?php echo $sf_guard_user->getUsername() ?></td>
      <td><?php echo $sf_guard_user->getLastLogin() ?></td>
	    <td><a href="<?php echo url_for('administrator/edit?id='.$sf_guard_user->getId()) ?>">edit</a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="btn btn-success" href="<?php echo url_for('administrator/new') ?>">New</a>
