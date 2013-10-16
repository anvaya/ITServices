<?php

/**
 * contact form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contactForm extends BasecontactForm
{
  public function configure()
  {
      $choices = array("-1"=>"-- Please select --","54"=>"ARGENTINA (54)","A61"=>"AUSTRALIA (61)","43"=>"AUSTRIA (43)","973"=>"BAHRAIN (973)","880"=>"BANGLADESH (880)","1246"=>"BARBADOS (1246)","375"=>"BELARUS (375)","32"=>"BELGIUM (32)","1441"=>"BERMUDA (1441)","975"=>"BHUTAN (975)","267"=>"BOTSWANA (267)","55"=>"BRAZIL (55)","673"=>"BRUNEI DARUSSALAM (673)","359"=>"BULGARIA (359)","855"=>"CAMBODIA (855)","A1"=>"CANADA (1)","238"=>"CAPE VERDE (238)","1345"=>"CAYMAN ISLANDS (1345)","86"=>"CHINA (86)","53"=>"CUBA (53)","357"=>"CYPRUS (357)","850"=>"DEMOCRATIC PEOPLE'S REPUBLIC OF KOREA(NORTH KOREA) (850)","45"=>"DENMARK (45)","20"=>"EGYPT (20)","503"=>"EL SALVADOR (503)","291"=>"ERITREA (291)","372"=>"ESTONIA (372)","251"=>"ETHIOPIA (251)","679"=>"FIJI (679)","358"=>"FINLAND (358)","33"=>"FRANCE (33)","995"=>"GEORGIA (995)","49"=>"GERMANY (49)","233"=>"GHANA (233)","30"=>"GREECE (30)","592"=>"GUYANA (592)","852"=>"HONG KONG (852)","36"=>"HUNGARY (36)","354"=>"ICELAND (354)","62"=>"INDONESIA (62)","964"=>"IRAQ (964)","353"=>"IRELAND (353)","98"=>"ISLAMIC REPUBLIC OF IRAN (98)","972"=>"ISRAEL (972)","39"=>"ITALY (39)","81"=>"JAPAN (81)","962"=>"JORDAN (962)","254"=>"KENYA (254)","965"=>"KUWAIT (965)","371"=>"LATVIA (371)","352"=>"LUXEMBOURG (352)","853"=>"MACAO (853)","265"=>"MALAWI (265)","60"=>"MALAYSIA (60)","960"=>"MALDIVES (960)","230"=>"MAURITIUS (230)","52"=>"MEXICO (52)","976"=>"MONGOLIA (976)","A212"=>"MOROCCO (A212)","B264"=>"NAMIBIA (264)","674"=>"NAURU (674)","977"=>"NEPAL (977)","31"=>"NETHERLANDS (31)","A64"=>"NEW ZEALAND (64)","227"=>"NIGER (227)","234"=>"NIGERIA (234)","B47"=>"NORWAY (47)","968"=>"OMAN (968)","92"=>"PAKISTAN (92)","507"=>"PANAMA (507)","675"=>"PAPUA NEW GUINEA (675)","63"=>"PHILIPPINES (63)","48"=>"POLAND (48)","351"=>"PORTUGAL (351)","974"=>"QATAR (974)","82"=>"REPUBLIC OF KOREA(SOUTH KOREA) (82)","40"=>"ROMANIA (40)","B7"=>"RUSSIAN FEDERATION (7)","250"=>"RWANDA (250)","685"=>"SAMOA (685)","966"=>"SAUDI ARABIA (966)","221"=>"SENEGAL (221)","65"=>"SINGAPORE (65)","27"=>"SOUTH AFRICA (27)","34"=>"SPAIN (34)","94"=>"SRI LANKA (94)","B249"=>"SUDAN (249)","46"=>"SWEDEN (46)","41"=>"SWITZERLAND (41)","886"=>"TAIWAN, PROVINCE OF CHINA (886)","66"=>"THAILAND (66)","243"=>"THE DEMOCRATIC REPUBLIC OF THE CONGO (243)","216"=>"TUNISIA (216)","90"=>"TURKEY (90)","256"=>"UGANDA (256)","380"=>"UKRAINE (380)","971"=>"UNITED ARAB EMIRATES (971)","44"=>"UNITED KINGDOM (44)","255"=>"UNITED REPUBLIC OF TANZANIA (255)","B1"=>"UNITED STATES (1)","598"=>"URUGUAY (598)","84"=>"VIET NAM (84)","967"=>"YEMEN (967)","260"=>"ZAMBIA (260)","263"=>"ZIMBABWE (263)");
      $isd_code =  $this->getOption("isd_code", null);
      if($isd_code == "91")
        $this->widgetSchema['isd_code'] = new sfWidgetFormInputHidden(array('default'=> '91'));
      else
      $this->widgetSchema['isd_code'] = new sfWidgetFormChoice(array("choices"=>$choices));

      $this->widgetSchema['country'] = new sfWidgetFormInputHidden();

      
      $contact_type =  $this->getOption("contact_type", null);
      if($contact_type)
      {
          switch($contact_type)
          {
              case contactTable::CONTACT_TYPE_MOBILE:
                  $this->widgetSchema['contact_text']->setLabel('number');
                  $this->useFields(array("isd_code","contact_text","country"));
                  break;
              case contactTable::CONTACT_TYPE_LANDLINE:
              case contactTable::CONTACT_TYPE_OFFICE:    
              case contactTable::CONTACT_TYPE_FAX:    
                  $this->useFields(array("isd_code", "std_code", "contact_text","country"));
                  $this->widgetSchema['contact_text']->setLabel('number');
                  break;              
              case contactTable::CONTACT_TYPE_FAMILY:
                  break;
          }
      }
      unset($this['member_id']);
  }
}
