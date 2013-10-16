<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
      $this->loadHelpers("JavascriptBase","Url","Date");
  }
}
