<?php
// auto-generated by sfViewConfigHandler
// date: 2013/10/07 12:19:45
$response = $this->context->getResponse();

if ($this->actionName.$this->viewName == 'indexSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}

if ($templateName.$this->viewName == 'indexSuccess')
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('media.css', '', array ());
  $response->addStylesheet('menu.css', '', array ());
  $response->addStylesheet('ui-lightness/jquery-ui-1.10.0.custom.min.css', '', array ());
  $response->addStylesheet('http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic', '', array ());
  $response->addStylesheet('register_form.css', '', array ());
  $response->addJavascript('jquery-1.9.0.min.js', '', array ());
  $response->addJavascript('jquery-ui-1.10.0.custom/js/jquery-ui-1.10.0.custom.min.js', '', array ());
  $response->addJavascript('jmpress.min.js', '', array ());
}
else
{
  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('media.css', '', array ());
  $response->addStylesheet('menu.css', '', array ());
  $response->addStylesheet('ui-lightness/jquery-ui-1.10.0.custom.min.css', '', array ());
  $response->addStylesheet('http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic', '', array ());
  $response->addJavascript('jquery-1.9.0.min.js', '', array ());
  $response->addJavascript('jquery-ui-1.10.0.custom/js/jquery-ui-1.10.0.custom.min.js', '', array ());
  $response->addJavascript('jmpress.min.js', '', array ());
}

