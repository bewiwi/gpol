<h1>Hosts List</h1>

<table  class="table">
  <thead>
    <tr>
	    <th>#</th>
      <th>Name</th>
      <th>Ip</th>
      <th>Serial</th>
      <th>Os</th>
	    <th>Last Contact</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($hosts as $host): ?>
    <tr>
	    <td><i class="<?php if(! $host->getEnable())echo 'icon-remove';else echo 'icon-ok'  ?>" ></i></td>
      <td><a href="<?php echo url_for('host/edit?id='.$host->getId()) ?>"><?php echo $host->getName() ?></a></td>
	    <td><?php echo $host->getIp() ?></td>
      <td><?php echo $host->getSerial() ?></td>
      <td><?php echo $host->getOs() ?></td>
	    <td><?php echo $host->getLastContact() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a class="btn btn-success" href="<?php echo url_for('host/new') ?>">New</a>
