<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php include_http_metas() ?>
	<?php include_metas() ?>
	<?php include_title() ?>
	<link rel="shortcut icon" href="/favicon.ico" />
	<?php include_stylesheets() ?>
	<?php include_javascripts() ?>
</head>
<body>



<div  class="navbar">
	<div class="navbar-inner">
		<div class="container">

			<?php if ($sf_user->isAuthenticated()): ?>
			<ul class="nav">
				<li <?php if($sf_context->getModuleName()== 'gpol' )echo 'class="active"' ?> ><a href="<?php echo url_for('gpol/index');?>">Gpol</a></li>
				<li <?php if($sf_context->getModuleName()== 'host' )echo 'class="active"' ?>><a href="<?php echo url_for('host/index');?>">Host</a></li>
				<li <?php if($sf_context->getModuleName()== 'user' )echo 'class="active"' ?>><a href="<?php echo url_for('user/index');?>">User</a></li>
				<li <?php if($sf_context->getModuleName()== 'groupHost' )echo 'class="active"' ?>><a href="<?php echo url_for('groupHost/index');?>">Group Host</a></li>
				<li <?php if($sf_context->getModuleName()== 'groupUser' )echo 'class="active"' ?>><a href="<?php echo url_for('groupUser/index');?>">Group User</a></li>
				<li <?php if($sf_context->getModuleName()== 'config' )echo 'class="active"' ?>><a href="<?php echo url_for('config/index');?>">Configuration</a></li>
				<li <?php if($sf_context->getModuleName()== 'log' )echo 'class="active"' ?>><a href="<?php echo url_for('log/index');?>">Logs</a></li>
				<li <?php if($sf_context->getModuleName()== 'administrator' )echo 'class="active"' ?>><a href="<?php echo url_for('administrator/index');?>">Administrator</a></li>
				<li class="logout"></li>
			</ul>
			<?php endif ?>
			<div id="div_title">
				<span id="title">GpoL</span>&nbsp;<span id="subtitle">Linux Business Utility</span><br />
				<?php if ($sf_user->isAuthenticated()): ?>
				<?php echo link_to('Logout', 'sf_guard_signout') ?>
				<?php endif ?>
			</div>
		</div><!--close container-->
	</div><!--close navbar-inner-->
</div><!--close navbar-->

<div id="main">
	<div id="site_content">
		<div class="row">
			<div class="offset4 span7">
				<?php echo $sf_content ?>
			</div>
		</div>
	</div><!--close site_content-->
</div><!--close main-->

</body>
</html>
