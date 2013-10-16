<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
      $this->widgetSchema['password']->setAttribute('autocomplete','off');
      /*
      if($this->isNew())
      {
          $profile = new user_profile();
          $profile->setSfGuardUser($this->getObject());
      }
      else
      {
          $profile = $this->getObject()->getUserProfile ();
          
          if(get_class($profile)=='Doctrine_Collection')
              $profile = $profile->getFirst ();
          
          if(!$profile)
          {
              $profile = new user_profile();
              $profile->setSfGuardUser($this->getObject());
          }
      }
      
      $profile_form = new admin_user_profileForm($profile);
      
      $this->embedForm("profile", $profile_form);
      $this->embedForm('column_permissions', new userFieldPermissionsCollectionForm($this->getValue("column_permissions"), array("user"=>$this->getObject()) ) );
       * 
       */
  }
  
  
}
