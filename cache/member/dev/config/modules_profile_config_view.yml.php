<?php
// auto-generated by sfViewConfigHandler
// date: 2013/10/09 14:54:43
$response = $this->context->getResponse();

if ($this->actionName.$this->viewName == 'editSuccess')
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}
else
{
  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());
}

if ($templateName.$this->viewName == 'editSuccess')
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

  $response->addStylesheet('member/main.css', '', array ());
  $response->addStylesheet('media.css', '', array ());
  $response->addStylesheet('ui-lightness/jquery-ui-1.10.0.custom.min.css', '', array ());
  $response->addStylesheet('member/form.css', '', array ());
  $response->addStylesheet('member/profile.css', '', array ());
  $response->addJavascript('jquery-1.9.0.min.js', '', array ());
  $response->addJavascript('jquery-ui-1.10.0.custom/js/jquery-ui-1.10.0.custom.min.js', '', array ());
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

  $response->addStylesheet('member/main.css', '', array ());
  $response->addStylesheet('media.css', '', array ());
  $response->addStylesheet('ui-lightness/jquery-ui-1.10.0.custom.min.css', '', array ());
  $response->addJavascript('jquery-1.9.0.min.js', '', array ());
  $response->addJavascript('jquery-ui-1.10.0.custom/js/jquery-ui-1.10.0.custom.min.js', '', array ());
}
