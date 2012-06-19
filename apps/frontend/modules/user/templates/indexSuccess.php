<h1>Users List</h1>

<table class="table">
  <thead>
    <tr>
	    <th>#</th>
      <th>Name</th>
	    <th>Last Contact</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
	    <td><i class="<?php if(! $user->getEnable())echo 'icon-remove';else echo 'icon-ok'  ?>" ></i></td>
      <td><a href="<?php echo url_for('user/edit?id='.$user->getId()) ?>"><?php echo $user ?></a></td>
	    <td><?php echo $user->getLastContact() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="btn btn-success" href="<?php echo url_for('user/new') ?>">New</a>
