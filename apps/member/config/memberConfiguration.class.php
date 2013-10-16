<?php

class memberConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
      $this->loadHelpers(array("Url","Date"));
  }
}
