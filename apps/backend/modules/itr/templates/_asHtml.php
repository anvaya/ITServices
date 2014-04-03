<?php

    /* @var $itr_submission itr_submission */
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
    
    
    $arr_cp_category = array(
    1 => 'Investments in Shares in India Shares (listed in stock Exchange)',
    2 => 'Investments in Shares in India Shares (unlisted)',
    3 => 'Investments in other Securities  Debentures/ Bonds (Listed in Stock Exchange)',
    4 => 'Investments in other Securities  Debentures/ Bonds (Unlisted)',
    5 => 'Any other assets sold during the year such as, House property / land / motor /vehicles etc.',
    6 => 'Investments in Mutual Funds in India',
    7 => 'Immovable Property Sold'    
  );

  $securities = itr_securitiesTable::getInstance()
                    ->createQuery('it')
                    ->addWhere('submission_id = ?', $itr_submission->getId())
                    ->orderBy('category_id asc')
                    ->addWhere('category_id > 0')
                    ->execute();
  
  $last_category = -1;
?>
<style type="text/css">
    <?php include(sfConfig::get('sf_web_dir')."/css/backend/main.css");?>
        
    th { text-align: left; background-color: #eee; font-size: 12px; }
    td { font-size: 12px; }
    td { border: 1px solid #eee; }
    
    h3
    {
        padding: 5px;
        background-color: #2E444F;
        color: white;
    }
    th.section_head { background-color: #006600; color: white; }
    
    #properties th
    {
        text-align: left;
    }
    
    
</style>
<html>
    <head>
        <title><?php echo $itr_submission->getPanNo()."_".$itr_submission->getLastName()."_".$itr_submission->getFirstName() ?></title>
    </head>
<body>
<div class="content">
    <div id="page_nav">
    </div>
    <div id="page_content">
        <div id="page1">
            <h3>Personal Information</h3>
            <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
            <table>
            <tbody>              
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
                    NRO
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
        </div>
    <hr />    
        <div id="page2">
            <h3>House Property Information</h3> 
            <?php $properties = $itr_submission->getItrProperty() ?>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<table id="properties">
    <tbody>
  <?php foreach($properties as $key => $property): ?>
  <tr><td style="padding: 5px;">
    <table>
    <tbody>
      <tr class="fg-toolbar ui-widget-header ui-corner-all">
        <th class="sf_admin_text ui-th-column section_head" colspan="4" style="padding:4px;">House Property <?php echo ($key+1); ?></th>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Address</th>
        <th class="sf_admin_text ui-state-default ui-th-column">Town/City</th>
        <th class="sf_admin_text ui-state-default ui-th-column">State</th>
        <th class="sf_admin_text ui-state-default ui-th-column">PIN Code</th>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <td class="sf_admin_text"><?php echo $property->getAddress(); ?></td>
        <td class="sf_admin_text"><?php echo $property->getCity(); ?></td>
        <td class="sf_admin_text"><?php $state_id = $property->getState();  echo isset($states[$state_id])?$states[$state_id]:"NA"; ?></td>
        <td class="sf_admin_text"><?php echo $property->getPin(); ?></td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Is the Property co-owned ?</th>
        <td class="sf_admin_text"><?php echo $property->getCoOwned() == 1 ? "Yes" : "No"; ?></td>
      </tr>
      <?php if($property->getCoOwned() == 1): ?>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Your Percentage of share in Property</th>
          <td class="sf_admin_text"><?php echo $property->getPercentShare(); ?></td>
        </tr>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column">Details of Co-owners</th>
          <td class="sf_admin_text" colspan="3">            
         <?php            
            $prev_years = html_entity_decode($property->getOwners());                                    
            $arr_pyr = json_decode($prev_years, true);                       
            if(!$arr_pyr) $arr_pyr = array();
            if(count($arr_pyr)):
          ?>
            <table>
                <thead>
                    <tr>
                        <th class="sf_admin_text ui-state-default ui-th-column">Name</th>
                        <th class="sf_admin_text ui-state-default ui-th-column">Pan</th>
                        <th class="sf_admin_text ui-state-default ui-th-column">% Share</th>    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arr_pyr as $pr):?>
                    <tr>
                        <td><?php echo $pr['name'];?></td>
                        <td><?php echo $pr['pan_no'];?></td>
                        <td><?php echo $pr['percentage'];?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>            
            <?php endif;?>              
              
          </td>
        </tr>
      <?php endif; ?>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Is the Property Let Out ?</th>
        <td class="sf_admin_text"><?php echo $property->getLetOut() == 1 ? "Yes" : "No"; ?></td>
      </tr>
      <?php if($property->getLetOut() == 1): ?>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="4">Rental Information</th>
        </tr>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column">Name of the Tenant</th>
          <td class="sf_admin_text" ><?php echo $property->getTenant(); ?></td>
          <th class="sf_admin_text ui-state-default ui-th-column">PAN of the Tenant</th>
          <td class="sf_admin_text"><?php echo $property->getTenantPan(); ?></td>
        </tr>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Total amount of rent received in the year:</th>
          <td><?php echo $property->getRentRcvd(); ?></td>
        </tr>
        
         <?php $rent_info_raw = $property->getRaw("rent_details");// ->getRentDetails();
                       if(!is_array($rent_info_raw) )
                       {                         
                           if(strlen($rent_info_raw))
                           {
                             $rent_info_raw = json_decode($rent_info_raw, true);
                           }
                           else
                           {
                             $rent_info_raw = array
                                 ( 
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),                                    
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                 );       
                           }
                       }
                       
                       if(!is_array($rent_info_raw))
                       {
                           $rent_info_raw = array
                                 ( 
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),                                    
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                 );       
                       }
                       $flags = array("","Received","To be Received","Can not be Received","Vacant (Not Let Out)" ) ;?>
        
         <tr class="sf_admin_row ui-widget-content">          
          <td class="sf_admin_text" colspan="4">              
              <table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                      <td colspan="12">Total amount of rent received in the year:</td>
                  </tr>
                <?php $months = array("Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec","Jan","Feb","Mar");?>    
                <tr>     
                  <?php foreach($rent_info_raw as $index=>$row): ?>
                      <th class="sf_admin_text ui-state-default ui-th-column"><?php echo $months[$index]; ?></th>
                  <?php endforeach;?>
                </tr><tr>
                  <?php foreach($rent_info_raw as $index=>$row): ?>
                    <td><?php echo isset($row["amount"])?$row["amount"]:"&nbsp;";?></td>                
                  <?php endforeach;?>
                </tr>        
                <tr>
                <?php foreach($rent_info_raw as $index=>$row): ?>                
                  <td><?php echo isset($flags[$row["flag"]])?$flags[$row["flag"]]:"&nbsp;";?></td>              
                <?php endforeach;?>
              </tr>        
              </table>
          </td>
        </tr>
        
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">The amount of rent which cannot be realized</th>
          <td class="sf_admin_text"><?php echo $property->getRentNotRealized(); ?></td>
        </tr>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Tax paid to local authorities</th>
          <td class="sf_admin_text"><?php echo $property->getTaxPaid(); ?></td>
        </tr>
      <?php endif; ?>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">If any Loan is taken for purchase of House property, then details of Loan as follows</th>
        <td class="sf_admin_text"><?php //echo $property->getLoanTaken() == 1 ? "Yes" : "No"; ?></td>
      </tr>
      <?php if(true): //if($property->getLoanTaken() == 1): ?>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Cost of House Property</th>
          <td class="sf_admin_text"><?php echo $property->getPropertyCost(); ?></td>
        </tr>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Amount of Loan taken</th>
          <td class="sf_admin_text"><?php echo $property->getLoanAmount(); ?></td>
        </tr>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Amount repaid during the year</th>
          <td class="sf_admin_text"><?php echo $property->getLoanRepaid(); ?></td>
        </tr>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Interest paid during the year</th>
          <td class="sf_admin_text"><?php echo $property->getInterestPaid(); ?></td>
        </tr>
        <tr class="sf_admin_row ui-widget-content">
          <th class="sf_admin_text ui-state-default ui-th-column" colspan="3">Balance loan out standing</th>
          <td class="sf_admin_text"><?php echo $property->getLoanOustanding(); ?></td>
        </tr>
      <?php endif; ?>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="4">If any rent of previous years received during the year, then details of rent received</th>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <td class="sf_admin_text" colspan="4">
          <?php            
            $prev_years = html_entity_decode($property->getPrevYearReceipt());                                    
            $arr_pyr = json_decode($prev_years, true);                       
            if(!$arr_pyr) $arr_pyr = array();
            if(count($arr_pyr)):
          ?>
            <table>
                <thead>
                    <tr>
                        <th class="sf_admin_text ui-state-default ui-th-column">Year</th>
                        <th class="sf_admin_text ui-state-default ui-th-column">Amount</th>    
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arr_pyr as $pr):?>
                    <tr>
                        <td><?php echo $pr['year'];?></td>
                        <td><?php echo $pr['amount'];?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>            
            <?php endif;?>
        </td>
      </tr>
      </tbody>
    </table>
  </td></tr>
  <?php endforeach; ?>
</tbody></table>
</div>
            
        </div>
        
        <div id="page3">            
            <h3>Capital Gains</h3>
            <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<table><tbody>
  <?php foreach($securities as $key => $security): ?>        
  <tr><td style="padding: 5px;">
    <table>
    <tbody>
      <?php if($last_category != $security->getCategoryId()):?>  
        <tr class="fg-toolbar ui-widget-header ui-corner-all">
          <th class="sf_admin_text ui-th-column" colspan="4" style="padding:4px;"><?php echo $arr_cp_category[$security->getCategoryId()] ?></th>
        </tr>
        <?php $last_category = $security->getCategoryId();?>
      <?php endif;?>      
      
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="2">Selling Details</td>
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="2">Purchase Details</td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Details</th>
        <td class="sf_admin_text" ><?php echo $security->getDetails(); ?></td>
        <td class="sf_admin_text" rowspan="6" valign="top">
          <?php
            //ToDo :: decode json             
            $arr_pi = json_decode($security->getPurchaseInfo(),true);
            if(!$arr_pi) $arr_pi = array();            
          ?>            
    <table>
        <thead>
            <tr>
                <th class="sf_admin_text ui-state-default ui-th-column">Date</th>
                <th class="sf_admin_text ui-state-default ui-th-column">Qty</th>
                <th class="sf_admin_text ui-state-default ui-th-column">Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($arr_pi as $prow):?>
            <tr>
                <td><?php $date_array = explode("GMT", $prow['date']); $date = strtotime( $date_array[0]); echo date('d/m/Y', $date);?></td>
                <td><?php echo $prow['quantity'];?></td>
                <td><?php echo $prow['cost'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>            
    </table>
            
        <?php if($last_category == 7): ?>
                <?php $arr_cost = json_decode($security->getAddonCosts(), true); if(!is_array($arr_cost)) $arr_cost=  array(); ?>
                <br />
                Major cost of Improvement Done (Renovation / Additional Construction etc) 
                <table>
                    <thead>
                        <tr>
                            <th class="sf_admin_text ui-state-default ui-th-column">Date</th>
                            <th class="sf_admin_text ui-state-default ui-th-column">Particulars of Work</th>
                            <th class="sf_admin_text ui-state-default ui-th-column">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($arr_cost as $prow):?>
                        <tr>
                            <td><?php echo $prow['date']; // $date_array = explode("GMT", $prow['date']); $date = strtotime( $date_array[0]); echo date('d/m/Y', $date);  ?></td>
                            <td><?php echo $prow['details'];?></td>
                            <td><?php echo $prow['amount'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>            
                </table>
          <?php endif;?>  
            
            
        </td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Date of Sale</th>
        <td class="sf_admin_text" ><?php echo $security->getDateSale(); ?></td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Quantity Sold</th>
        <td class="sf_admin_text" ><?php echo $security->getQuantitySold(); ?></td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Sell Value</th>
        <td class="sf_admin_text" ><?php echo $security->getSellValue(); ?></td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="2">Details of expenditure done for selling</th>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Paid to Broker</th>
        <td class="sf_admin_text" ><?php echo $security->getBrokeragePaid(); ?></td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Other Expenses</th>
        <td class="sf_admin_text" ><?php echo $security->getOtherExpenses(); ?></td>
      </tr>
    </tbody>
    </table>
  </td></tr>
  <?php endforeach; ?>
</tbody></table>
</div>
        </div>
        
        
             
        <div id="page4">
            <h3>Other Income</h3>
            <?php
  /* @var $itr_submission itr_submission */
  /* @var $other_income itr_other_income */

  $arr_category = array(
      1 => 'Dividend received during the year',
      2 => 'Interest received during the year',
      3 => 'Rent Received from other than House property (such as machinery, vehicles Etc.',
      4 => 'Gift Received - Details of gift received for the value exceeding 50,000 from single person.',
      5 => 'Miscellaneous Income : Details of income such as winning from lottery or any other income which is not covered in any of the source above.'
      );
      $other_incomes = itr_other_incomeTable::getInstance()
                        ->createQuery('ic')
                        ->addWhere('submission_id=?',$itr_submission->getId())
                        ->orderBy('category_id asc')
                        ->execute();
?>
<?php  ?>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<table>
  <tbody>    
    <?php $last_category = -1;?>
    <?php foreach($other_incomes as $key => $other_income): ?>
      
      <?php if($last_category != $other_income->getCategoryId()):?>
        <tr >
            <th colspan="3" class= " section_head sf_admin_text ui-state-default ui-th-column"><?php echo $arr_category[$other_income->getCategoryId()]; ?></th>
        </tr>
        
         <tr class="fg-toolbar ui-widget-header ui-corner-all">      
            <th class="sf_admin_text ui-state-default ui-th-column">Date Received</th>
            <th class="sf_admin_text ui-state-default ui-th-column">Amount</th>
            <th class="sf_admin_text ui-state-default ui-th-column">Details</th>
          </tr>
        
        <?php $last_category = $other_income->getCategoryId();?>
      <?php endif;?>
        
    
      <tr class="sf_admin_row ui-widget-content">        
        <td class="sf_admin_text"><?php echo format_date($other_income->getDateRcvd(),'dd/MM/y'); ?></td>
        <td class="sf_admin_text"><?php echo $other_income->getAmount(); ?></td>
        <td class="sf_admin_text"><?php echo $other_income->getDetails(); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
        </div>
        
        <div id="page5">
            <h3>Exemptions</h3>
            <?php $itr_exemptions = $itr_submission->getItrExemption() ?>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<table>
  <tbody>
    <tr class="fg-toolbar ui-widget-header ui-corner-all">
      <th class="sf_admin_text ui-state-default ui-th-column">Category</th>
      <th class="sf_admin_text ui-state-default ui-th-column">Amount</th>
    </tr>
    <?php foreach($itr_exemptions as $key => $itr_exemption): ?>
      <tr class="sf_admin_row ui-widget-content">
        <td class="sf_admin_text"><?php echo $itr_exemption->getExemptionCategory(); ?></td>
        <td class="sf_admin_text"><?php echo $itr_exemption->getAmount(); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
        </div>
        
    </div>
</div>
    <br /><br />
</body>
</html>