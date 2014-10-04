<?php

include(__DIR__ . '/RestController.php');

class Bps_SearchController extends Bps_RestController
{

    protected $_permissionsMap = array(
        'businessAction' => 'search_business',
        'enhancedpeopleAction' => 'search_enhancedPeople',
        'mvrAction' => 'search_mvr',
        'peopleAction' => 'search_people',
        'phonesAction' => 'search_phones',
        'propertyAction' => 'search_property',
        'dlAction' => 'search_dl',
        'emailAction' => 'search_email',
        'pawAction' => 'search_paw',
        'foreclosureAction' => 'search_foreclosure',
        'liensAction' => 'search_liens',
        'bankruptcyAction' => 'search_bankruptcy',
    );

    public function mvrAction()
    {
        $this->log->debug(__METHOD__);

        $sp = new App_Ws_Search_Mvr($this->getRequest());
        $this->sendResponse($sp, array('VIN', 'SSN', 'TAG', 'LICENSE', 'COMPANY',
            'TITLENUMBER', 'UNIQUEID', 'FIRST_NAME', 'MI', 'LAST_NAME',
            'STREET_ADDRESS', 'CITY', 'STATE', 'ZIP', 'YEAR', 'MONTH', 'DAY')
        );
    }

    public function propertyAction()
    {
        $this->log->debug(__METHOD__);

        //
        $lookUpType = '';
        $perms = $this->ns->permissions;
        if ($perms->search_property_deeds xor $perms->search_property_assessment) {
            $lookUpType = ($perms->search_property_deeds) ? 'D' : 'A';
        }
        $this->getRequest()->setParam('LOOKUP_TYPE', $lookUpType);

        $sp = new App_Ws_Search_Property($this->getRequest());
        $this->sendResponse($sp, array('COMPANY', 'FIRST_NAME', 'MI', 'LAST_NAME',
            'PARCEL_NUMBER', 'STREET_ADDRESS', 'CITY', 'STATE', 'ZIP', 'COUNTY')
        );
    }

    public function peopleAction()
    {
        $this->log->debug(__METHOD__);

        $sp = new App_Ws_Search_People($this->getRequest());
        $this->sendResponse($sp, array('SSN', 'FIRST_NAME', 'MI', 'LAST_NAME',
            'STREET_ADDRESS', 'CITY', 'STATE', 'ZIP', 'YEAR', 'MONTH', 'DAY',
            'AGE_LOW', 'AGE_HIGH', 'PHONETICS')
        );
    }

    public function enhancedpeopleAction()
    {
        $this->log->debug(__METHOD__);

        $sp = new App_Ws_Search_EnhancedPeople($this->getRequest());
        $this->sendResponse($sp, array('SSN', 'FIRST_NAME', 'MI', 'LAST_NAME',
            'STREET_ADDRESS', 'CITY', 'STATE', 'ZIP', 'YEAR', 'MONTH', 'DAY',
            'AGE_LOW', 'AGE_HIGH',
            'OTHER_LAST_NAME', 'OTHER_CITY', 'OTHER_STATE', 'RELATIVE_FIRST_NAME', 'OTHER_RELATIVE_FIRST_NAME', 'PHONETICS')
        );
    }

    public function businessAction()
    {
        $this->log->debug(__METHOD__);

        $sp = new App_Ws_Search_Business($this->getRequest());
        $this->sendResponse($sp, array('COMPANY', 'FEIN', 'SSN', 'FIRST_NAME',
            'MI', 'LAST_NAME', 'STREET_ADDRESS', 'CITY', 'STATE', 'ZIP')
        );
    }

    public function phonesAction()
    {
        $this->log->debug(__METHOD__);

        //  Real Time Phone Search
        if ($this->ns->permissions->search_phones_rt) {
            $this->_doPhonesrealtimeSearch();
        } else
        // Phones Plus
        if ($this->ns->permissions->search_phones_pl) {
            $this->_doPhonesplusSearch();
        } else {
            //  None of the above searches are enabled, respond with error
            $this->_setResponseAccessNotAllowed();
            return;
        }
    }
    
    public function dlAction()
    {
        $this->log->debug(__METHOD__);
        
        $sp = new App_Ws_Search_DriverLicenseSearch2($this->getRequest());
        $this->sendResponse($sp, array(
            'DRIVER_LICENSE', 'SSN', 'FIRST_NAME', 'MI', 'LAST_NAME', 'UID',
            'STREET_ADDRESS', 'CITY', 'STATE', 'ZIP', 'YEAR', 'MONTH', 'DAY'
            )
        );
    }

    public function emailAction()
    {
        $this->log->debug(__METHOD__);
        
        $sp = new App_Ws_Search_EmailSearch($this->getRequest());
        $this->sendResponse($sp, array(
            'SSN', 'FIRST_NAME', 'MI', 'LAST_NAME', 'UID', 'STREET_ADDRESS', 
            'CITY', 'STATE', 'ZIP', 'YEAR', 'MONTH', 'DAY', 'EMAIL'
            )
        );
    }
    
    public function pawAction()
    {
        $this->log->debug(__METHOD__);

        $sp = new App_Ws_Search_PeopleAtWorkSearch2($this->getRequest());
        $this->sendResponse($sp, array(
            'COMPANY', 'SSN', 'FIRST_NAME', 'MI', 'LAST_NAME', 'STREET_ADDRESS',
            'CITY', 'STATE', 'ZIP', 'FEIN', 'PHONE', 'UID'
            )
        );
    }
    
    public function foreclosureAction()
    {
        $this->log->debug(__METHOD__);
        
        $sp = new App_Ws_Search_ForeclosureSearch($this->getRequest());
        $this->sendResponse($sp, array(
            'COMPANY', 'SSN', 'FIRST_NAME', 'MI', 'LAST_NAME', 'STREET_ADDRESS',
            'CITY', 'STATE', 'ZIP'
            )
        );
    }
    
    public function liensAction()
    {
        $this->log->debug(__METHOD__);
        
        $sp = new App_Ws_Search_LienJudgmentSearch($this->getRequest());
        $this->sendResponse($sp, array(
            'COMPANY', 'SSN', 'FIRST_NAME', 'MI', 'LAST_NAME', 'STREET_ADDRESS',
            'CITY', 'STATE', 'ZIP', 'COUNTY', 'UID', 'FEIN', 'CASE_NUMBER', 
            'FILING_NUMBER'
            )
        );
    }
    
    public function bankruptcyAction()
    {
        $this->log->debug(__METHOD__);
        
        $sp = new App_Ws_Search_BankruptcySearch2($this->getRequest());
        $this->sendResponse($sp, array(
            'COMPANY', 'SSN', 'FIRST_NAME', 'MI', 'LAST_NAME', 'STREET_ADDRESS',
            'CITY', 'STATE', 'ZIP', 'COUNTY', 'UID', 'FEIN', 'CASE_NUMBER', 
            'FILING_NUMBER'
            )
        );
    }
    
    protected function _doPhonesplusSearch()
    {
        $this->log->debug(__METHOD__);

        $sp = new App_Ws_Search_PhonesPlus($this->getRequest());
        $this->getRequest()->setParam('IncludeRealTimePhoneInfo', 0);
        $this->sendResponse($sp, array('FIRST_NAME', 'MI', 'LAST_NAME',
            'STREET_ADDRESS', 'CITY', 'STATE', 'ZIP', 'PHONE', 'UID', 'INCLUDEDA', 'IncludeRealTimePhoneInfo')
        );
    }

    protected function _doPhonesrealtimeSearch()
    {
        $this->log->debug(__METHOD__);

        $sp = new App_Ws_Search_PhonesRealTime($this->getRequest());
        $this->getRequest()->setParam('IncludeRealTimePhoneInfo', 1);
        $this->sendResponse($sp, array('FIRST_NAME', 'MI', 'LAST_NAME',
            'STREET_ADDRESS', 'CITY', 'STATE', 'ZIP', 'SSN', 'PHONE', 'UID', 'INCLUDEDA', 'IncludeRealTimePhoneInfo')
        );
    }

}
