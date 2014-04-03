<?php /* @var $itr_submission itr_submission */ 

    $states["1"]="Andaman &amp; Nicobar Islands";
$states["2"]="Andhra Pradesh";
$states["3"]="Arunachal Pradesh";
$states["4"]="Assam";
$states["5"]="Bihar";
$states["6"]="Chandigarh";
$states["33"]="Chhattisgarh";
$states["7"]="Dadra &amp; Nagar Haveli";
$states["8"]="Daman &amp; Diu";
$states["9"]="Delhi";
$states["10"]="Goa";
$states["11"]="Gujarat";
$states["12"]="Haryana";
$states["13"]="Himachal Pradesh";
$states["14"]="Jammu &amp; Kashmir";
$states["35"]="Jharkhand";
$states["15"]="Karnataka";
$states["16"]="Kerala";
$states["17"]="Lakhswadeep";
$states["18"]="Madhya Pradesh";
$states["19"]="Maharashtra";
$states["20"]="Manipur";
$states["21"]="Meghalaya";
$states["22"]="Mizoram";
$states["23"]="Nagaland";
$states["24"]="Orissa";
$states["25"]="Pondicherry";
$states["26"]="Punjab";
$states["27"]="Rajasthan";
$states["28"]="Sikkim";
$states["29"]="Tamil Nadu";
$states["30"]="Tripura";
$states["31"]="Uttar Pradesh";
$states["32"]="West Bengal";
$states["34"]="Uttaranchal"; 
?>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
  <table>
  <tbody>
    <tr class="fg-toolbar ui-widget-header ui-corner-all">
      <th class="sf_admin_text ui-th-column" colspan="4" style="padding:4px;">Personal Details</th>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Id</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getId(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">Pancard Number</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getPanNo(); ?></td>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Member</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getMember(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">Product</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getProduct(); ?></td>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Full Name</th>
      <td class="sf_admin_text" colspan="3"><?php echo $itr_submission->getFirstName(). " ".$itr_submission->getMiddleName()." ".$itr_submission->getLastName(); ?></td>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Date of Birth</th>
      <td class="sf_admin_text"><?php echo format_date($itr_submission->getDob(), "dd/MM/yyyy") ; ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">Gender</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getGender(); ?></td>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Email</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getEmailAddress(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">Phone</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getPhoneNo(); ?></td>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Father&rsquo;s Name</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getFathersName(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">Mother&rsquo;s Name</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getMothersName(); ?></td>
    </tr>
    <tr class="fg-toolbar ui-widget-header ui-corner-all">
      <th class="sf_admin_text ui-th-column" colspan="4" style="padding:4px;">Address</th>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Flat/Door/Block No.</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getFlatNo(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">Name of Building Premises</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getPremises(); ?></td>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Road/ Street/ Post Office</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getStreet(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">Area/Locality</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getArea(); ?></td>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Town/City/District</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getCity(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">State</th>
      <td class="sf_admin_text"><?php $state_id =$itr_submission->getState(); echo isset($states[$state_id])?$states[$state_id]:"NA"; ?></td>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Country</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getCountry(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">PIN Code</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getPin(); ?></td>
    </tr>
    <tr class="fg-toolbar ui-widget-header ui-corner-all">
      <th class="sf_admin_text ui-th-column" colspan="4" style="padding:4px;">Bank Details</th>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">Bank account No.</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getBankAcNo(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">Type of account</th>
      <td class="sf_admin_text">
          <?php
                    $choices = array(
                        ""=>"",
                        itr_submissionTable::AC_TYPE_SAVINGS=>"Savings",
                        itr_submissionTable::AC_TYPE_CURRENT=>"Current",
                        itr_submissionTable::AC_TYPE_OTHER=>"Other"
                    );
                    
                    $ac_type = $itr_submission->getAcType();
          ?>
          <?php echo  isset($choices[$ac_type])?$choices[$ac_type]:"NA";  ?>
      </td>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <th class="sf_admin_text ui-state-default ui-th-column">IFSC Code</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getIfscCode(); ?></td>
      <th class="sf_admin_text ui-state-default ui-th-column">Micr Code</th>
      <td class="sf_admin_text"><?php echo $itr_submission->getMicrCode(); ?></td>
    </tr>
    <tr class="fg-toolbar ui-widget-header ui-corner-all">
      <th class="sf_admin_text ui-th-column" colspan="4" style="padding:4px;">Notes</th>
    </tr>
    <tr class="sf_admin_row ui-widget-content">
      <td class="sf_admin_text" colspan="4"><?php echo $itr_submission->getNotes(); ?></td>
    </tr>
  </tbody>
  </table>
</div>

