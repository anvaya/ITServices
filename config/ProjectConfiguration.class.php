<?php

#require_once dirname(dirname(__FILE__)).'/lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
//require_once "C:\\phplib\\symfony\\symfony-1.4.17\\lib/autoload/sfCoreAutoload.class.php";
require_once 'C:\\phplib\\symfony\\symfony-1.4.17\\lib/autoload/sfCoreAutoload.class.php';

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
  }

  public function configureDoctrine(Doctrine_Manager $manager)
  {
    $manager->registerHydrator('key_value_pair', 'KeyValuePairHydrator');
    $manager->registerHydrator('csv', 'csvHydrator');
    #$manager->setAttribute(Doctrine_Core::ATTR_USE_DQL_CALLBACKS, true);
  }

}
