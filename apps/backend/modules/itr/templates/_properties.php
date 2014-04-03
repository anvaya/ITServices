<?php
  /* @var $itr_submission itr_submission */
  /* @var $property itr_property */

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
<style type="text/css">
    #properties th
    {
        text-align: left;
    }
</style>
<?php $properties = $itr_submission->getItrProperty() ?>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<table id="properties">
    <tbody>
  <?php foreach($properties as $key => $property): ?>
  <tr><td style="padding: 5px;">
    <table>
    <tbody>
      <tr class="fg-toolbar ui-widget-header ui-corner-all">
        <th class="sf_admin_text ui-th-column" colspan="4" style="padding:4px;">Property <?php echo ($key+1); ?></th>
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
                       $flags = array("","Received","To be Received","Can not be Received","Vacant (Not Let Out)" ) ;
        ?>        
        
        <tr class="sf_admin_row ui-widget-content">          
          <td class="sf_admin_text" colspan="4">
              Total amount of rent received in the year:
              <table>
              <?php $months = array("Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec","Jan","Feb","Mar");?>    
              <tr>     
              <?php foreach($rent_info_raw as $index=>$row): ?>
                  <th class="sf_admin_text ui-state-default ui-th-column"><?php echo $months[$index]; ?></th>
              <?php endforeach;?>
              </tr><tr>
              <?php foreach($rent_info_raw as $index=>$row): ?>
                <td><?php echo isset($row["amount"])?$row["amount"]:"";?></td>                
              <?php endforeach;?>
              </tr>        
              <tr>
              <?php foreach($rent_info_raw as $index=>$row): ?>                
                <td><?php echo isset($flags[$row["flag"]])?$flags[$row["flag"]]:"";?></td>              
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