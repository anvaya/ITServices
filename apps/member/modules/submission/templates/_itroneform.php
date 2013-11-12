<?php use_helper('I18N') ?>
<?php 
use_javascript("knockout-3.0.0.js");

$tab_labels = array
  (
    "Personal_Detail" =>"Personal Details",
    "Residential_Address" => "Residential Address",
    "Communication" => "Communication Details",
    "Applicant_Status" => "Applicant Status"
  );

$detailed_help = array
        (
            "Representative"=>'
Representative assessee.

160. (1) For the purposes of this Act, “representative assessee” means—

(i) in respect of the income of a non-resident specified in sub-section (1) of section 9, 
    the agent of the non-resident, including a person who is treated as an agent under section 163;

Who may be regarded as agent?

163. (1) For the purposes of this Act, “agent”, in relation to a non-resident,
         includes any person in India—

(a) who is employed by or on behalf of the non-resident; or

(b) who has any business connection with the non-resident; or

(c) from or through whom the non-resident is in receipt of any income, whether directly or indirectly;
or

(d) who is the trustee of the non-resident;

and includes also any other person who, whether a resident or non-resident, 
has acquired by means of a transfer, a capital asset in India :'
        )
?>
<?php if ($itrone_form->hasErrors()): ?>
    <p>The sub_form has some errors you need to fix.</p>
    <?php foreach($itrone_form->getWidgetSchema()->getPositions() as $widgetName): ?>
        <?php if($itrone_form[$widgetName]->hasError()): ?>
        <p><?php echo $itrone_form[$widgetName]->renderLabelName().': '.$itrone_form[$widgetName]->getError()->getMessageFormat(); ?></p>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
<?php echo $itrone_form->renderGlobalErrors(); ?> 
<div style="clear:both;"></div>
<form action="<?php echo url_for('submission/itrone') ?>" method="post" onsubmit="return validateForm()" >    
    <fieldset id="sf_fieldset_none">
        <?php $group = $gc = ''; ?>
        <?php foreach($itrone_form as $key => $field ):?>
          <?php
            // pass for hidden field and program year id
            if($field->isHidden() || $key == "captcha" || $key == "itrone_subs") continue;
            // explode field name for get group_code,question_id and answer_type
            $arr_q_id = explode("_",$key);
            /* @var $form_question form_question */
            $form_question = Doctrine_Core::getTable('form_question')->find($arr_q_id[1]);
            if($form_question)
              $gc = $form_question->getGroupCode();
          ?>
          <?php if($group != $gc): ?>
            <div class="sf_admin_form_row sf_admin_text tab_head">
              <?php echo strtoupper($tab_labels[$gc]); ?>
                <span class="help_icon">
                    <?php echo image_tag("q.gif", array("group_code"=>"$gc","title"=>"Click here for information on this section") );?>
                </span>  
            </div>
          <?php endif; ?>
                <?php
                  if($form_question->getCssClass() != "")
                    $field_css_class = $form_question->getCssClass();
                  else
                    $field_css_class = "";
                  
                  if($form_question->getAnswerType() == questionTable::ANSWER_TYPE_MULTI_CHOICE_WITH_TEXT || $form_question->getAnswerType() == questionTable::ANSWER_TYPE_SINGLE_CHOICE_WITH_TEXT)
                    $css_style = 'style="border:0;"';
                  else 
                    $css_style = '';
                ?>
                <div id="q_<?php echo $form_question->getId(); ?>" class="sf_admin_form_row sf_admin_text <?php echo $field_css_class ?>" <?php echo $css_style ?>>
                    <?php echo $field->renderError(); ?>
                    <div>
                        <?php echo $field->renderLabel(); ?>
                        <ul class="error_list" style="display: none;" id="error_list_<?php echo $form_question->getId(); ?>">
                            <li></li>
                        </ul>
                        <div class="content">
                            <?php echo $field->render(array("qid"=>$form_question->getId())); ?>                            
                        </div>
                        <?php
                                if( ($help = $form_question->getHelpMessage()) ):
                        ?>
                            <div class="help"><?php echo __($help, array(), 'messages'); ?></div>
                        <?php endif;?>
                    </div>
                </div>
          <?php $group = $gc; ?>
        <?php endforeach;?>
        <div class="sf_admin_form_row sf_admin_text">
          <div>
            <label>Itrone Subs</label>
            <div class="content" id="itrone_subs_form_div">
              <?php foreach ($itrone_form['itrone_subs'] as $itrone_subs): ?>
                <table>
                  <thead><tr><td colspan="2"><?php echo image_tag('toggle_collapse.png', array('class'=>'toggle-property')) ?></td></tr></thead>
                  <tbody class="table-subform">
                  <?php foreach ($itrone_subs as $sub_key => $sub_fields): ?>
                    <?php if($sub_fields->isHidden()) continue; ?>
                    <tr>
                      <td><?php echo $sub_fields->renderLabel(); ?></td>
                      <td><?php echo $sub_fields->render(); ?></td>
                    </tr>
                  <?php endforeach; ?>
                  <tr><?php echo $itrone_subs->renderHiddenFields(); ?></tr>
                  </tbody>
                </table>
              <?php endforeach; ?>
            </div>
            <div class="">
              <label>&nbsp;</label>
              <a id="add_itrone_subs_form" href="#" class="fg-button ui-state-default fg-button-icon-left add_new_sub_form"><?php echo __('Add New Sub Form',null,'submission') ?></a>
            </div>
          </div>
        </div>
      <div style="clear:both;height: 30px;">&nbsp;</div>
      <div class="sf_admin_form_row sf_admin_text">
        <div>
          <label>&nbsp;</label>
          <div class="content">
            <?php echo $itrone_form->renderHiddenFields(); ?>
            <input type="submit" class="green-btn" name="register" value="<?php echo __('Submit', null, 'messages') ?>" onclick="return validateForm();" />
          </div>
        </div>
      </div>
      <div style="clear:both;height: 30px;">&nbsp;</div>
    </fieldset>
    <?php //echo $itrone_form['_csrf_token'] ?>
    <?php //echo $itrone_form[$itrone_form->getCSRFFieldName()]->render() ?>
</form>
<div style="clear:both;"></div>
<?php foreach($detailed_help as $key=>$message):?>
    <p style="display: none;" id="help_<?php echo $key ?>">
        <?php echo $message; ?>
    </p>
<?php endforeach;?>
<div id="detailed_help">
    <pre>
    </pre>
</div>
<script type="text/javascript">
  function validateForm()
    {
      var err = "";
      var name, value;
      var err_flg = 0;
      $('input.required').each(function()
      {
          if($(this).attr('type')=="hidden") return;
          name = $(this).attr('name');
          if($(this).attr('type') != 'text' && $(this).attr('type') != 'textarea')
          {
             value = $('input[name="' + name + '"]:checked').val();
             if(value==undefined) value="";
             err = errormsg($(this).attr('id'),$(this).attr('type'))
          }
          else
          {
             value = $(this).val();    
          }
 
           var ul_id = $('#error_list_'+ $(this).attr('qid'));
           
           if($.trim(value) === "")
           {            
                var id = $(this).attr('id');   
                var err = errormsg($(this).attr('id'),'select');
                var ul_id = $('#error_list_'+ $(this).attr('qid'));
                $('li', ul_id).html(err);
                $(ul_id).show();
                err_flg = 1;            
           }
           else
               $(ul_id).hide();

          /*
          if($.trim(value) == "")
          {
            //var id = $(this).attr('id');
            var pp_div = $(this).parent().parent().parent();
            $(pp_div).children('.error_list').remove();

            var p_div = $(this).closest('div'); //parent('div'); //.parent();
            var already_added = $('.error_list', p_div.parent());

            if(!already_added.length)
            {
                err_flg = 1;
                $('<ul class="error_list"><li>'+err+'</li></ul>').insertBefore(p_div);
            }
          }*/ 
        });
        
        $('select.required').each(function()
        {
           value = $(this).val();                  
           var ul_id = $('#error_list_'+ $(this).attr('qid'));
           
           if($.trim(value) === "")
           {            
            var id = $(this).attr('id');   
            var err = errormsg($(this).attr('id'),'select');
            var ul_id = $('#error_list_'+ $(this).attr('qid'));
            $('li', ul_id).html(err);
            $(ul_id).show();
            err_flg = 1;
            
            /*
            //var id = $(this).attr('id');
            var pp_div = $(this).parent().parent().parent();
            $(pp_div).children('.error_list').remove();

            var p_div = $(this).closest('div'); //parent('div'); //.parent();
            var already_added = $('.error_list', p_div.parent());

            if(!already_added.length)
            {
                err_flg = 1;
                var err = errormsg($(this).attr('id'),'select');
                $('<ul class="error_list"><li>' +err+ '</li></ul>').insertBefore(p_div);
            }*/
           }
           else
               $(ul_id).hide();
        });
        if(err_flg === 1)
          return false;
    }
    
    function errormsg(field_id,field_type)
    {
          var err = "";
          var _attr = $('#'+field_id).attr('error_msg');
          if(typeof _attr !== "undefined" && _attr !== false && _attr !== null){
            err = $('#'+field_id).attr('error_msg');
          }
          if(err === "")
          {
            err = "You must provide an answer";
          }
          
          return err;
    }    
</script>
<?php 
  /* @var $form ItroneForm */
  if($itrone_form->isNew())
    $number =1;
  else{
    $itrone_form->getObject()->getId();
    $number = Doctrine_Query::create()
        ->from("submission_inner si")
        ->where("si.submission_id = ?",$itrone_form->getObject()->getId())
        ->count();
  }
?>

<script type="text/javascript">
var newfieldscount = <?php echo $number ?>;

function addNewField(num){
    return jQuery.ajax({
    type: 'GET',
    url: '<?php echo str_replace('/action','',url_for('submission/additronesub')) ?>?num='+num+'&id=<?php echo $itrone_form->getObject()->getId() ?>',
    async: false
  }).responseText;
}

jQuery(document).ready(function(){
  jQuery('#add_itrone_subs_form').click(function(e){
    e.preventDefault();

    jQuery('#itrone_subs_form_div').append(addNewField(newfieldscount));

    newfieldscount = newfieldscount + 1;
    jQuery('.removenew').unbind('click');
    jQuery("toggle-property").unbind("click");  
    removeNew();
  });
});

var removeNew = function(){
  jQuery('.removenew').click(function(e){
    e.preventDefault();
    jQuery(this).parent().parent().remove();
  })
};

jQuery(document).ready(function(){
  jQuery(".toggle-property").click(function() {
      var image_name = this.src;
      $(".table-subform").hide();
      if(this.src.match('toggle-expand'))
      {
        jQuery('.toggle-property').attr('src','<?php echo image_tag('toggle_collapse.png') ?>');
        image_name = image_name.replace("toggle-expand.png","toggle_collapse.png");
        jQuery(this).attr('src',image_name);
        $(this).parent().parent().parent().siblings().show();
      }
      else
      {
        jQuery('.toggle-property').attr('src','<?php echo image_tag('toggle_collapse.png') ?>');
        image_name = image_name.replace("toggle_collapse.png","toggle-expand.png");
        jQuery(this).attr('src',image_name);
        $(this).parent().parent().parent().siblings().hide();
      }
  });
});
/*function PropertyFormViewModel()
{
    var self = this;

    self.cities = ko.observableArray
    ([                
        <?php /* foreach($form['cities'] as $index=>$city):?>
              <?php if($index > 0):?>,<?php endif;?>       
              new City(<?php echo $city['id']->getValue(); ?>,"<?php echo $city['city_name']->getValue(); ?>",0)
        <?php endforeach; */ ?>                            
    ]);

    self.addCity = function()
    {
        self.cities.push(new City("","",0));
    };

    self.removeCity = function(city)
    {
        if(!confirm('Remove this city ?'))
        {
           return;     
        }

        city.remove_flag(1);
    };
}

ko.applyBindings(new PropertyFormViewModel()); */

</script>