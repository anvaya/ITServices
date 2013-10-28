<?php

/**
 * member form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class memberForm extends BasememberForm
{
    /**
     * @see sfGuardUserForm
     */
    public function configure()
    {
        parent::configure();
        $this->widgetSchema['country'] = new sfWidgetFormI18nChoiceCountry(array("add_empty" => true));
        $this->validatorSchema['country'] = new sfValidatorI18nChoiceCountry(array("required" => false));

        $this->widgetSchema['culture'] = new sfWidgetFormI18nChoiceLanguage(array("add_empty" => true));
        $this->validatorSchema['culture'] = new sfValidatorI18nChoiceLanguage(array("required" => false));

        $this->widgetSchema['timezone'] = new sfWidgetFormI18nChoiceTimezone(array("add_empty" => true));
        $this->validatorSchema['timezone'] = new sfValidatorI18nChoiceTimezone(array("required" => false));

        $this->validatorSchema['email_address'] = new sfValidatorEmail(array("required" => true));

     $this->useFields( array("first_name", "middle_name", "last_name","email_address", "dob", "country","passport_no", "pan_no", "gender", "married", "marriage_anniversary", "year_as_nri", "occupation_type", "job_title", "industry", "other_income_source","timezone","culture" ));


        //$this->embedForm("nri_address", new addressForm(null, array('address_type'=> addressTable::ADDRESS_TYPE_NRI)));
        $id = $this->getObject()->getId();
        $addressTable = addressTable::getInstance();

        $in_address = $addressTable->findOneByMemberIdAndAddressType($id, addressTable::ADDRESS_TYPE_IND);
        $this->embedForm("in_address", new addressForm($in_address, array("address_type" => addressTable::ADDRESS_TYPE_IND)));

        $nri_address = $addressTable->findOneByMemberIdAndAddressType($id, addressTable::ADDRESS_TYPE_NRI);
        $nri_address->setAddressType(addressTable::ADDRESS_TYPE_NRI);
        $this->embedForm("nri_address", new addressForm($nri_address, array("address_type" => addressTable::ADDRESS_TYPE_NRI)));

        $contactTable = contactTable::getInstance();

        $nri_mobile = $contactTable->createQuery('nm')
                ->addWhere('nm.member_id = ?', $id)
                ->addWhere('nm.contact_type = ?', contactTable::CONTACT_TYPE_MOBILE)
                ->addWhere('nm.country IS NULL OR nm.country <> "IN"')
                ->fetchOne();

        $this->embedForm("nri_mobile", new contactForm($nri_mobile, array("contact_type" => contactTable::CONTACT_TYPE_MOBILE)));

        $nri_landline = $contactTable->createQuery('nm')
                ->addWhere('nm.member_id = ?', $id)
                ->addWhere('nm.contact_type = ?', contactTable::CONTACT_TYPE_LANDLINE)
                ->addWhere('nm.country IS NULL OR nm.country <> "IN"')
                ->fetchOne();

        $this->embedForm("nri_landline", new contactForm($nri_landline, array("contact_type" => contactTable::CONTACT_TYPE_LANDLINE)));

        $nri_office = $contactTable->findOneByMemberIdAndContactType($id, contactTable::CONTACT_TYPE_OFFICE);
        $this->embedForm("nri_office", new contactForm($nri_office, array("contact_type" => contactTable::CONTACT_TYPE_OFFICE)));

        $nri_fax = $contactTable->findOneByMemberIdAndContactType($id, contactTable::CONTACT_TYPE_FAX);
        $this->embedForm("nri_fax", new contactForm($nri_fax, array("contact_type" => contactTable::CONTACT_TYPE_FAX)));

        $in_mobile = $contactTable->findOneByMemberIdAndContactTypeAndCountry($id, contactTable::CONTACT_TYPE_MOBILE, 'IN');
        $this->embedForm("in_mobile", new contactForm($in_mobile, array("contact_type" => contactTable::CONTACT_TYPE_MOBILE, 'isd_code' => 91)));

        $in_landline = $contactTable->findOneByMemberIdAndContactTypeAndCountry($id, contactTable::CONTACT_TYPE_LANDLINE, 'IN');
        $this->embedForm("in_landline", new contactForm($in_landline, array("contact_type" => contactTable::CONTACT_TYPE_LANDLINE, 'isd_code' => 91)));

        $this->widgetSchema['nri_address']->setLabel(" ");
        $this->widgetSchema['in_address']->setLabel(" ");
        $this->widgetSchema['nri_mobile']->setLabel("Mobile");
        $this->widgetSchema['nri_landline']->setLabel("Landline");
        $this->widgetSchema['nri_office']->setLabel("Office");
        $this->widgetSchema['nri_fax']->setLabel("Fax");

        $this->widgetSchema['in_mobile']->setLabel("Mobile");
        $this->widgetSchema['in_landline']->setLabel("Landline");

        $occupations = array(
            sfGuardUserTable::OCCUPATION_TYPE_UNKNOWN => "---Select---",
            sfGuardUserTable::OCCUPATION_TYPE_SALARY => 'I am an Salaried Employee',
            sfGuardUserTable::OCCUPATION_TYPE_BUSINESS => 'I am engaged in business / Profession',
        );

        $this->widgetSchema['gender'] = new sfWidgetFormChoice(array('choices' => array('M' => 'Male', 'F' => 'Female')));

        $this->widgetSchema['other_income_source'] = new sfWidgetFormChoice(array('choices' => array("" => "---Select---",
                "A" => "Income from capital gains",
                "B" => "Income from house property",
                "C" => "Income from other sources",
                "D" => "Income from capital gains &amp; house property",
                "E" => "Income from house property &amp; other sources",
                "F" => "Income from capital gains &amp; other sources",
                "G" => "Income from capital gains, house property &amp; other sources",
                "H" => "No income")
        ));

        $years = array();
        for ($i = date('Y') - 80; $i <= date('Y') - 18; $i++)
            $years[$i] = $i;

        //$years = range(date('Y')-80, date('Y')-18);       


        $this->widgetSchema['dob']->setOption('years', $years);
        $this->widgetSchema['dob']->setLabel('Date of Birth');
        $this->widgetSchema['dob']->setOption('format', "%day%-%month%-%year%");
        $this->validatorSchema['dob'] = new sfValidatorDate();

        $years = array("" => "Select");
        for ($i = date('Y') - 80; $i <= date('Y'); $i++)
            $years[$i] = $i;

        $this->widgetSchema['year_as_nri'] = new sfWidgetFormChoice(array("choices" => $years));
        $this->validatorSchema['year_as_nri'] = new sfValidatorChoice(array("choices" => $years, "required" => false));

        $this->widgetSchema['occupation_type'] = new sfWidgetFormChoice(array("choices" => $occupations));
        $this->validatorSchema['occupation_type'] = new sfValidatorChoice(array("choices" => array_keys($occupations)));

        $years = array("" => "Select");
        for ($i = date('Y') - 70; $i <= date('Y'); $i++)
            $years[$i] = $i;
        $this->widgetSchema['marriage_anniversary']->setOption('years', $years);
        $this->widgetSchema['marriage_anniversary']->setOption('format', "%day%-%month%-%year%");

        $family_contacts = family_contactTable::getInstance()
                ->createQuery('dd')
                ->addWhere('dd.member_id = ?', $id)                
                ->execute();

        foreach ($family_contacts as $index => $contact) 
        {
            $this->embedForm("family" . $index, new family_contactForm($contact, array("contact_type" => contactTable::CONTACT_TYPE_FAMILY)));
            $this->widgetSchema["family".$index]->setLabel("Member ".($index+1));
        }

        for ($i = $family_contacts->count(); $i < 5; $i++) 
        {
            $contact = new family_contact();
            $contact->setMember($this->getObject());            
            $this->embedForm("family" . $i, new family_contactForm($contact, array("contact_type" => contactTable::CONTACT_TYPE_FAMILY)));
            $this->widgetSchema["family".$i]->setLabel("Member ".($i+1));
        }


        $this->useFields(array("first_name", "middle_name", "last_name", "dob", "gender", "year_as_nri", "email_address", "country", "nri_address", "in_address", "nri_mobile", "nri_landline", "nri_office", "nri_fax", "in_landline", "in_mobile", "occupation_type", "job_title", "industry", "other_income_source", "passport_no", "pan_no", "married", "marriage_anniversary", "family0", "family1", "family2", "family3", "family4"));
    }

    public function saveEmbeddedForms($con = null, $forms = null) {
        if (is_null($con)) {
            $con = $this->getConnection();
        }

        if (is_null($forms)) {
            $forms = $this->embeddedForms;
        }

        foreach ($forms as $name => $form) {
            if ($form instanceof sfFormDoctrine) {
                $form->getObject()->setMemberId($this->getObject()->getId());
                // Here it ends
                $form->getObject()->save($con);
                $form->saveEmbeddedForms($con);
            } else {
                $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
            }
        }
    }

}
