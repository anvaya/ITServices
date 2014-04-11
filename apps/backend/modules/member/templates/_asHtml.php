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
        <title><?php echo "Member List" ?></title>
    </head>
<body>
<div class="content">
    <div id="page_nav">
    </div>
    <div id="page_content">
        <div id="page1">
            <h3>Member Information</h3>
            <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
            <table>
              <thead>
                <tr>
                  <th class="sf_admin_text ui-state-default ui-th-column">Username</th>
                  <th class="sf_admin_text ui-state-default ui-th-column">Email</th>
                  <th class="sf_admin_text ui-state-default ui-th-column">Full Name</th>
                  <th class="sf_admin_text ui-state-default ui-th-column">Date of Birth</th>
                  <th class="sf_admin_text ui-state-default ui-th-column">Is Married</th>
                  <th class="sf_admin_text ui-state-default ui-th-column">Gender</th>
                  <th class="sf_admin_text ui-state-default ui-th-column">Current Address (Outside India)</th>
                  <th class="sf_admin_text ui-state-default ui-th-column">Address In India</th>
                  <th class="sf_admin_text ui-state-default ui-th-column">Contact Information</th>
                  <th class="sf_admin_text ui-state-default ui-th-column">Contact Information (India)</th>
                </tr>
              </thead>
            <tbody>
              <?php /* @var $member Member */ ?>
              <?php foreach($members as $member): ?>
                <?php
                  $nri_address = "";
                  $in_address = "";
                  /* @var $address Address */
                  foreach($member->getAddress() as $address)
                  {
                    if($address->getAddressType() == addressTable::ADDRESS_TYPE_NRI)
                    {
                      $nri_address .= (trim($address->getFlatNo()) != "") ? $address->getFlatNo()."<br/>" : "";
                      $nri_address .= (trim($address->getPremises()) != "") ? $address->getPremises()."<br/>" : "";
                      $nri_address .= (trim($address->getStreet()) != "") ? $address->getStreet()."<br/>" : "";
                      $nri_address .= (trim($address->getArea()) != "") ? $address->getArea()."<br/>" : "";
                      $nri_address .= (trim($address->getCity()) != "") ? $address->getCity()."<br/>" : "";
                      $nri_address .= (trim($address->getState()) != "") ? $address->getState()."<br/>" : "";
                      $nri_address .= (trim($address->getCountry()) != "") ? $address->getCountry()."<br/>" : "";
                      $nri_address .= $address->getPin();
                    }
                    else if($address->getAddressType() == addressTable::ADDRESS_TYPE_IND)
                    {
                      $in_address .= (trim($address->getFlatNo()) != "") ? $address->getFlatNo()."<br/>" : "";
                      $in_address .= (trim($address->getPremises()) != "") ? $address->getPremises()."<br/>" : "";
                      $in_address .= (trim($address->getStreet()) != "") ? $address->getStreet()."<br/>" : "";
                      $in_address .= (trim($address->getArea()) != "") ? $address->getArea()."<br/>" : "";
                      $in_address .= (trim($address->getCity()) != "") ? $address->getCity()."<br/>" : "";
                      $in_address .= (trim($address->getState()) != "") ? $address->getState()."<br/>" : "";
                      $in_address .= $address->getPin();
                    }
                  }
                  
                  /* @var $contact Contact */
                  $in_contact = "";
                  $nri_contact = "";
                  foreach($member->getContact() as $contact)
                  {
                    if(trim($contact->getContactText()) != "")
                    {
                      if($contact->getCountry() == "IN")
                      {
                        if($contact->getContactType() == contactTable::CONTACT_TYPE_MOBILE)
                          $in_contact .= "Mobile: ".$contact->getIsdCode(). " ".$contact->getContactText()."<br/>";
                        if($contact->getContactType() == contactTable::CONTACT_TYPE_LANDLINE)
                          $in_contact .= "Landline: ".$contact->getIsdCode(). " ".$contact->getStdCode()." ".$contact->getContactText();
                      }else
                      {
                        if($contact->getContactType() == contactTable::CONTACT_TYPE_MOBILE)
                          $nri_contact .= "Mobile: ".$contact->getIsdCode(). " ".$contact->getContactText()."<br/>";
                        if($contact->getContactType() == contactTable::CONTACT_TYPE_LANDLINE)
                          $nri_contact .= "Landline: ".$contact->getIsdCode(). " ".$contact->getStdCode()." ".$contact->getContactText();
                      }
                    }
                  }
                ?>
              <tr class="sf_admin_row ui-widget-content">
                <td class="sf_admin_text"><?php echo $member->getUsername(); ?></td>
                <td class="sf_admin_text"><?php echo $member->getEmailAddress(); ?></td>
                <td class="sf_admin_text"><?php echo $member->getFirstName(). " ".$member->getMiddleName()." ".$member->getLastName(); ?></td>
                <td class="sf_admin_text"><?php echo format_date($member->getDob(), "dd/MM/yyyy") ; ?></td>
                <td class="sf_admin_text"><?php echo $member->getMarried() == 1? "Yes" : "No" ?></td>
                <td class="sf_admin_text"><?php echo $member->getGender(); ?></td>
                <td class="sf_admin_text"><?php echo $nri_address ?></td>
                <td class="sf_admin_text"><?php echo $in_address ?></td>
                <td class="sf_admin_text"><?php echo $nri_contact ?></td>
                <td class="sf_admin_text"><?php echo $in_contact ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
</body>
</html>