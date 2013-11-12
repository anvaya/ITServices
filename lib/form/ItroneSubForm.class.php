<?php
class ItroneSubForm extends submission_innerForm
{
  public function configure()
  {
    unset($this['submission_ip'],$this['archieved'],$this['created_at'],$this['updated_at'],$this['submission_id']);
    //$this->widgetSchema['submission_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['form_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_id'] = new sfWidgetFormInputHidden();
    $this->setDefault('form_id', 3);
    $this->setDefault('user_id', sfContext::getInstance()->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
    
    $query = Doctrine_Query::create()
            ->select('id,question_text,group_code,answer_type,mandatory')
            ->from('form_question')
            ->where('form_id = ?', 3)
            ->andWhere('disabled = 0')
            ->orderBy('page_num ASC, display_order ASC');
    $form_question = $query->execute();
    
    /* @var $fq form_question */
    foreach ($form_question as $fq)
    {
      if($fq->getMandatory())
      {
          $mandatory = true;
          $css_mandatory = "<span class='mandatory'>* </span>";
          $required = "required";
      }else
      {
          $mandatory = false;
          $css_mandatory = "";
          $required = "";
      }
        
      $fn = str_replace(":", "",trim($fq->getQuestionText()));
      $fn = str_replace("_", "", trim($fn));
      
      $gc = str_replace("_", "", trim($fq->getGroupCode()));
      $widget_name = strtolower($gc)."_".$fq->getId()."_".$fq->getAnswerType();
      $widget_name_other = "";
      
      switch($fq->getAnswerType())
      {
          case questionTable::ANSWER_TYPE_COUNTRY:
              $this->widgetSchema[$widget_name] = new sfWidgetFormI18nChoiceCountry(array("add_empty"=>"select"), array('class' => $required,'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorI18nChoiceCountry(array("required"=>$mandatory), array('required'=> $fq->getErrorMsg()));              
              break;
          
          case questionTable::ANSWER_TYPE_DATE:
              $min_year = intval($fq->getDateMinYear());
              $max_year = intval($fq->getDateMaxYear());
              
              if($min_year == 0) $min_year = date('Y')-5;
              if($max_year == 0) $max_year = date('Y') + 5;
              
              $years_range = range($min_year, $max_year);
              $years = array();
              foreach($years_range as $item)
              {
                  $years[$item] = $item;
              }
              
              $date_widget = new sfWidgetFormDate(array("years"=>$years));
              
              $this->widgetSchema[$widget_name] = new sfWidgetFormJQueryDate(array("date_widget"=>$date_widget), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorDate(array("required"=>$mandatory),array('required'=> $fq->getErrorMsg()));
              break;
          
          case questionTable::ANSWER_TYPE_DATE_PERIOD:
              break;
          
          case questionTable::ANSWER_TYPE_EMAIL:
              $this->widgetSchema[$widget_name] = new sfWidgetFormInputText(array(), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorEmail(array("required"=>$mandatory),array('required'=> $fq->getErrorMsg(), 'invalid'=> 'Invalid Email address.'));              
              break;
          
          case questionTable::ANSWER_TYPE_FILE:
              break;
          
          case questionTable::ANSWER_TYPE_LONGTEXT:
              $this->widgetSchema[$widget_name] = new sfWidgetFormTextarea(array(), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorString(array("required"=>$mandatory),array('required'=> $fq->getErrorMsg()));
              break;
          
          case questionTable::ANSWER_TYPE_MULTI_CHOICE:
              $choices = $this->getChoiceOption($fq->getId());
              $this->widgetSchema[$widget_name] = new sfWidgetFormChoice(array("choices"=>$choices,"multiple"=>true,"expanded"=>true), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorChoice(array("required"=>$mandatory, "choices"=>array_keys($choices),"multiple"=>true),array('required'=> $fq->getErrorMsg()));
              break;
          
          case questionTable::ANSWER_TYPE_MULTI_CHOICE_WITH_TEXT:
              $widget_name = strtolower($gc)."_".$fq->getId()."_".$fq->getAnswerType()."_selectedoptions";
              $widget_name_other = strtolower($gc)."_".$fq->getId()."_".$fq->getAnswerType()."_answertext";
              
              $choices = $this->getChoiceOption($fq->getId());
              $this->widgetSchema[$widget_name] = new sfWidgetFormChoice(array("choices"=>$choices, "multiple"=>true, "expanded"=>true), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorChoice(array("required"=>$mandatory, "choices"=>array_keys($choices),"multiple"=>true),array('required'=> $fq->getErrorMsg()));

              $this->widgetSchema[$widget_name_other] = new sfWidgetFormInputText(array(), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name_other] = new sfValidatorString(array("required"=>$mandatory), array('required'=> $fq->getErrorMsg()));
              
              break;
          
          case questionTable::ANSWER_TYPE_PROGRAM_YEAR:
              
              $this->widgetSchema[$widget_name] = new sfWidgetFormDoctrineChoice(array("model"=>"program_year"), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorDoctrineChoice(array("model" => "program_year", "required" => $mandatory), array('required' => $fq->getErrorMsg()));
              break;
          
          case questionTable::ANSWER_TYPE_SELECT:
              $choices = $this->getChoiceOption($fq->getId(),questionTable::ANSWER_TYPE_SELECT);
              $this->widgetSchema[$widget_name] = new sfWidgetFormChoice(array("choices"=>$choices,"expanded"=>false), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorChoice(array("required"=>$mandatory, "choices"=>array_keys($choices)),array('required'=> $fq->getErrorMsg()));
              break;
          
          case questionTable::ANSWER_TYPE_SINGLE_CHOICE:
              $choices = $this->getChoiceOption($fq->getId());
              $this->widgetSchema[$widget_name] = new sfWidgetFormChoice(array("choices"=>$choices,"expanded"=>true), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorChoice(array("required"=>$mandatory, "choices"=>array_keys($choices)),array('required'=> $fq->getErrorMsg()));
              break;
              
          case questionTable::ANSWER_TYPE_SINGLE_CHOICE_WITH_TEXT:
              $widget_name = strtolower($gc)."_".$fq->getId()."_".$fq->getAnswerType()."_selectedoptions";
              $widget_name_other = strtolower($gc)."_".$fq->getId()."_".$fq->getAnswerType()."_answertext";
              $choices = $this->getChoiceOption($fq->getId());
              $this->widgetSchema[$widget_name] = new sfWidgetFormChoice(array("choices"=>$choices,"expanded"=>true), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name] = new sfValidatorChoice(array("required"=>$mandatory, "choices"=>array_keys($choices)),array('required'=> $fq->getErrorMsg()));

              $this->widgetSchema[$widget_name_other] = new sfWidgetFormInputText(array(), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
              $this->validatorSchema[$widget_name_other] = new sfValidatorString(array("required"=>$mandatory),array('required'=> $fq->getErrorMsg()));
              break;
          
          case questionTable::ANSWER_TYPE_TEXT:
              $this->widgetSchema[$widget_name] = new sfWidgetFormInputText(array(), array('class' => $required, 'error_msg'=> $fq->getErrorMsg()));
                $this->validatorSchema[$widget_name] = new sfValidatorString(array("required"=>$mandatory),array('required'=> $fq->getErrorMsg()));
              break;
          
          case questionTable::ANSWER_TYPE_QUESTION_GROUP:
              $this->widgetSchema[$widget_name] = new sfWidgetFormInputHidden();
              $this->widgetSchema[$widget_name] = new sfWidgetFormInputHidden();
              break;
          
          case questionTable::ANSWER_TYPE_INDIAN_STATES_WITH_OUTSIDE_OPTION:
              $choices = array( ""=>"--Select--",
                                "1"=>"Andaman &amp; Nicobar Islands",
                                "2"=>"Andhra Pradesh",
                                "3"=>"Arunachal Pradesh",
                                "4"=>"Assam",
                                "5"=>"Bihar",
                                "6"=>"Chandigarh",
                                "33"=>"Chhattisgarh",
                                "7"=>"Dadra &amp; Nagar Haveli",
                                "8"=>"Daman &amp; Diu",
                                "9"=>"Delhi",
                                "10"=>"Goa",
                                "11"=>"Gujarat",
                                "12"=>"Haryana",
                                "13"=>"Himachal Pradesh",
                                "14"=>"Jammu &amp; Kashmir",
                                "35"=>"Jharkhand",
                                "15"=>"Karnataka",
                                "16"=>"Kerala",
                                "17"=>"Lakhswadeep",
                                "18"=>"Madhya Pradesh",
                                "19"=>"Maharashtra",
                                "20"=>"Manipur",
                                "21"=>"Meghalaya",
                                "22"=>"Mizoram",
                                "23"=>"Nagaland",
                                "24"=>"Orissa",
                                "25"=>"Pondicherry",
                                "26"=>"Punjab",
                                "27"=>"Rajasthan",
                                "28"=>"Sikkim",
                                "29"=>"Tamil Nadu",
                                "30"=>"Tripura",
                                "31"=>"Uttar Pradesh",
                                "32"=>"West Bengal",
                                "34"=>"Uttaranchal",
                                "99"=>"Outside India");
              
              $this->widgetSchema[$widget_name] = new sfWidgetFormChoice(array("choices"=>$choices));
              $this->validatorSchema[$widget_name] = new sfValidatorChoice(array("required"=>$mandatory, "choices"=>array_keys($choices)),array('required'=> $fq->getErrorMsg()));
              break;   
          case questionTable::ANSWER_TYPE_ISD_CODES:
              $choices = array("-1"=>"-- Please select --","54"=>"ARGENTINA (54)","A61"=>"AUSTRALIA (61)","43"=>"AUSTRIA (43)","973"=>"BAHRAIN (973)","880"=>"BANGLADESH (880)","1246"=>"BARBADOS (1246)","375"=>"BELARUS (375)","32"=>"BELGIUM (32)","1441"=>"BERMUDA (1441)","975"=>"BHUTAN (975)","267"=>"BOTSWANA (267)","55"=>"BRAZIL (55)","673"=>"BRUNEI DARUSSALAM (673)","359"=>"BULGARIA (359)","855"=>"CAMBODIA (855)","A1"=>"CANADA (1)","238"=>"CAPE VERDE (238)","1345"=>"CAYMAN ISLANDS (1345)","86"=>"CHINA (86)","53"=>"CUBA (53)","357"=>"CYPRUS (357)","850"=>"DEMOCRATIC PEOPLE'S REPUBLIC OF KOREA(NORTH KOREA) (850)","45"=>"DENMARK (45)","20"=>"EGYPT (20)","503"=>"EL SALVADOR (503)","291"=>"ERITREA (291)","372"=>"ESTONIA (372)","251"=>"ETHIOPIA (251)","679"=>"FIJI (679)","358"=>"FINLAND (358)","33"=>"FRANCE (33)","995"=>"GEORGIA (995)","49"=>"GERMANY (49)","233"=>"GHANA (233)","30"=>"GREECE (30)","592"=>"GUYANA (592)","852"=>"HONG KONG (852)","36"=>"HUNGARY (36)","354"=>"ICELAND (354)","62"=>"INDONESIA (62)","964"=>"IRAQ (964)","353"=>"IRELAND (353)","98"=>"ISLAMIC REPUBLIC OF IRAN (98)","972"=>"ISRAEL (972)","39"=>"ITALY (39)","81"=>"JAPAN (81)","962"=>"JORDAN (962)","254"=>"KENYA (254)","965"=>"KUWAIT (965)","371"=>"LATVIA (371)","352"=>"LUXEMBOURG (352)","853"=>"MACAO (853)","265"=>"MALAWI (265)","60"=>"MALAYSIA (60)","960"=>"MALDIVES (960)","230"=>"MAURITIUS (230)","52"=>"MEXICO (52)","976"=>"MONGOLIA (976)","A212"=>"MOROCCO (A212)","B264"=>"NAMIBIA (264)","674"=>"NAURU (674)","977"=>"NEPAL (977)","31"=>"NETHERLANDS (31)","A64"=>"NEW ZEALAND (64)","227"=>"NIGER (227)","234"=>"NIGERIA (234)","B47"=>"NORWAY (47)","968"=>"OMAN (968)","92"=>"PAKISTAN (92)","507"=>"PANAMA (507)","675"=>"PAPUA NEW GUINEA (675)","63"=>"PHILIPPINES (63)","48"=>"POLAND (48)","351"=>"PORTUGAL (351)","974"=>"QATAR (974)","82"=>"REPUBLIC OF KOREA(SOUTH KOREA) (82)","40"=>"ROMANIA (40)","B7"=>"RUSSIAN FEDERATION (7)","250"=>"RWANDA (250)","685"=>"SAMOA (685)","966"=>"SAUDI ARABIA (966)","221"=>"SENEGAL (221)","65"=>"SINGAPORE (65)","27"=>"SOUTH AFRICA (27)","34"=>"SPAIN (34)","94"=>"SRI LANKA (94)","B249"=>"SUDAN (249)","46"=>"SWEDEN (46)","41"=>"SWITZERLAND (41)","886"=>"TAIWAN, PROVINCE OF CHINA (886)","66"=>"THAILAND (66)","243"=>"THE DEMOCRATIC REPUBLIC OF THE CONGO (243)","216"=>"TUNISIA (216)","90"=>"TURKEY (90)","256"=>"UGANDA (256)","380"=>"UKRAINE (380)","971"=>"UNITED ARAB EMIRATES (971)","44"=>"UNITED KINGDOM (44)","255"=>"UNITED REPUBLIC OF TANZANIA (255)","B1"=>"UNITED STATES (1)","598"=>"URUGUAY (598)","84"=>"VIET NAM (84)","967"=>"YEMEN (967)","260"=>"ZAMBIA (260)","263"=>"ZIMBABWE (263)");
              $this->widgetSchema[$widget_name] = new sfWidgetFormChoice(array("choices"=>$choices));
              $this->validatorSchema[$widget_name] = new sfValidatorChoice(array("required"=>$mandatory, "choices"=>array_keys($choices)),array('required'=> $fq->getErrorMsg()));
              break;   
      }
      
      $arr_label = explode ("|", $fq->getQuestionText());
      if(isset($arr_label[1]))
        $widget_label_other = $arr_label[1];
      else
        $widget_label_other = "Other ".$arr_label[0];
        
      $this->widgetSchema->setLabel($widget_name, $css_mandatory .$arr_label[0]);
      //$this->setDefault($widget_name, sfContext::getInstance()->getRequest()->getParameter($widget_name));
      
      
      if($widget_name_other != "")
        $this->widgetSchema->setLabel($widget_name_other, $css_mandatory .$widget_label_other);
      
      if(!$this->isNew)
      {
        $def_val = $this->getFieldValue($this->object->getId(), $fq->getId());
        $this->setDefault($widget_name, $def_val);
      }
      
    }

    $css_mandatory = "<span class='mandatory'>* </span>";
    
    //$this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array('public_key' => '6Le36L0SAAAAABGYUC3m06DuwX3FGmUZgZ-EHKR9'));
    //$this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array("private_key" => "6Le36L0SAAAAANUU1B40huMwtC856kXTo1ftUfco"));
    
    $this->validatorSchema->setOption('allow_extra_fields', true);
    $this->validatorSchema->setOption('filter_extra_fields', FALSE);
    
    $this->widgetSchema->setNameFormat('itrone_sub[%s]'); 
    
    $this->mergePostValidator(new RegisterSubFormValidatorSchema());
    
  }
  
  public function getName() 
  {
      return "itrone_sub";
  }  
  
  private function getChoiceOption($question_id,$answer_type_select = 1){
    $arr_option = array();
    if($answer_type_select == 0)
      $arr_option[""] = "Select";
    $query = Doctrine_Query::create()
            ->select('option_value,option_text')
            ->from('formquestion_option')
            ->where('question_id = ?', $question_id)
            ->orderBy('display_order');
    $formquestion_option = $query->execute();
    foreach ($formquestion_option as $fo)
    {
      $arr_option[$fo->getOptionValue()] = $fo->getOptionText();
    }
    return $arr_option;
  }
  
  public function getFieldValue($submission_inner_id, $question_id)
  {
    $val = "";
    $submission_inner_data = Doctrine::getTable('submission_inner_data')->findOneBySubmissionInnerIdAndQuestionId($submission_inner_id, $question_id);
    if($submission_inner_data)
    {
      if($submission_inner_data->getAnswserText() != "")
      {
        $val = $submission_inner_data->getAnswserText();
      }
      else
      {
        if($submission_inner_data->getSelectedOptions() != "")
        {
           $arr = unserialize($submission_inner_data->getSelectedOptions());
           if(count($arr) == 1)
           {
             $val = $arr[0]; 
           }else
             $val = $arr; 
        }
      }
    }
    return $val;
  }
  /*protected function getFormField()
  {
    if (is_null($this->formField))
    {
      $this->formField = new sfFormFieldSchema($this->widgetSchema, null, null, $this->isBound ? array_merge($this->defaults, $this->taintedValues) : $this->defaults, $this->errorSchema);
    }

    return $this->formField;
  }*/
}