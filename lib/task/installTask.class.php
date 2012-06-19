<?php

class installTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
//      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
//      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
//      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = '';
    $this->name             = 'install';
    $this->briefDescription = 'Install GpoL';
    $this->detailedDescription = <<<EOF
The [install|INFO] task install the GpoL project.
It configure and install/reinstall the database.
Initialise admin with :
[login : admin
password : admin|INFO]

Call it with:

  [php symfony install|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
//    $databaseManager = new sfDatabaseManager($this->configuration);
//    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
	  $task = $this->createTask('doctrine:build');
	  $task->run(array('--all --and-load --no-confirmation'));
	  $task = $this->createTask('guard:create-user');
	  $task->run(array('admin@admin.ad admin admin'));
  }
}
