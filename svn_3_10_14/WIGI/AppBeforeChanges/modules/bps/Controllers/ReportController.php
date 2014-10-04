<?php

include(__DIR__ . '/RestController.php');

class Bps_ReportController extends Bps_RestController
{

    protected $_permissionsMap = array(
        'businessAction' => 'report_business',
        'mvrAction' => 'report_mvr',
        'peopleAction' => 'report_people',
        'phonesAction' => 'report_phones',
        'propertyAction' => 'report_property'
    );

    public function mvrAction()
    {
        $this->log->debug(__METHOD__);
        $sp = new App_Ws_Report_Mvr($this->getRequest());
        $this->sendResponse($sp, array('VIN', 'UNIQUEID'));
    }

    public function propertyAction()
    {
        $this->log->debug(__METHOD__);
        $sp = new App_Ws_Report_Property($this->getRequest());
        $this->sendResponse($sp, array('STREET_ADDRESS', 'CITY', 'STATE', 'ZIP'));
    }

    public function peopleAction()
    {
        $this->log->debug(__METHOD__);
        $sp = new App_Ws_Report_People($this->getRequest());
        $this->sendResponse($sp, array('UID', 'SSN'));
    }

    public function businessAction()
    {
        $this->log->debug(__METHOD__);
        $sp = new App_Ws_Report_Business($this->getRequest());
        $this->sendResponse($sp, array('BID', 'FEIN'));
    }

    public function bpswebreport2Action()
    {
        $this->log->debug(__METHOD__);

        $sp = new App_Ws_Report_BpsWebReport2($this->getRequest());

        $this->getRequest()->setParam('GLB', 1);
        $this->getRequest()->setParam('DPPA', 1);
        $this->getRequest()->setParam('RETCOUNT', 50);

        $this->getRequest()->setParam('IncludeAKAs', 1);
        $this->getRequest()->setParam('IncludeImposters', 1);

        $this->getRequest()->setParam('IncludeOldPhones', 0);
        $this->getRequest()->setParam('IncludeAssociates', 0);
        $this->getRequest()->setParam('IncludeProperties', 0);
        $this->getRequest()->setParam('IncludePriorProperties', 0);
        $this->getRequest()->setParam('IncludeCurrentProperties', 0);
        $this->getRequest()->setParam('IncludeDriversLicenses', 0);
        $this->getRequest()->setParam('IncludeMotorVehicles', 0);
        $this->getRequest()->setParam('IncludeBankruptcies', 0);
        $this->getRequest()->setParam('IncludeLiensJudgments', 0);
        $this->getRequest()->setParam('IncludeCorporateAffiliations', 0);
        $this->getRequest()->setParam('IncludeUCCFilings', 0);
        $this->getRequest()->setParam('IncludeFAACertificates', 0);
        $this->getRequest()->setParam('IncludeCriminalRecords', 0);
        $this->getRequest()->setParam('IncludeCensusData', 0);
        $this->getRequest()->setParam('IncludeAccidents', 0);
        $this->getRequest()->setParam('IncludeWaterCrafts', 0);
        $this->getRequest()->setParam('IncludeProfessionalLicenses', 0);
        $this->getRequest()->setParam('IncludeHealthCareSanctions', 0);
        $this->getRequest()->setParam('IncludeDEAControlledSubstance', 0);
        $this->getRequest()->setParam('IncludeVoterRegistrations', 0);
        $this->getRequest()->setParam('IncludeHuntingFishingLicenses', 0);
        $this->getRequest()->setParam('IncludeFirearmExplosives', 0);
        $this->getRequest()->setParam('IncludeWeaponPermits', 1);
        $this->getRequest()->setParam('IncludeSexualOffenses', 0);
        $this->getRequest()->setParam('IncludeCivilCourts', 0);
        $this->getRequest()->setParam('IncludeFAAAircrafts', 0);
        $this->getRequest()->setParam('IncludePeopleAtWork', 0);
        $this->getRequest()->setParam('IncludeHighRiskIndicators', 0);
        $this->getRequest()->setParam('IncludeForeclosures', 0);
        $this->getRequest()->setParam('IncludePhonesPlus', 0);
        $this->getRequest()->setParam('DoPhoneReport', 0);
        $this->getRequest()->setParam('LawEnforcement', 0);
        $this->getRequest()->setParam('IncludeSourceDocs', 0);
        $this->getRequest()->setParam('IncludeBestInfo', 0);
        $this->getRequest()->setParam('IncludeDriversAtAddress', 0);
        $this->getRequest()->setParam('IncludeGlobalWatchLists', 0);
        $this->getRequest()->setParam('IncludeRealTimeVehicles', 0);
        $this->getRequest()->setParam('IncludeFictitiousBusinesses', 0);
        $this->getRequest()->setParam('IncludeNoticeOfDefaults', 0);
        $this->getRequest()->setParam('IncludeEmailAddresses', 0);
        $this->getRequest()->setParam('IncludeVerification', 0);
        $this->getRequest()->setParam('IncludePhoneSummary', 0);
        $this->getRequest()->setParam('IncludeStudentInformation', 0);

        // can't use this function, this is not a json response
        //$this->sendResponse($sp, array('UID', 'SSN'));
        //$data = $sp->getResponse($this->getRequest());
        //$cache = Zend_Cache::factory('Core', 'File', array('lifetime'=>1)); //throws error
        $cache = Zend_Cache::factory('Core', 'File'); //throws error
        // generate cache id from parameters
        $cacheId = $this->generateCacheKey($this->getRequest(), array('SSN', 'UID'));
        // try to get cached data if not, then run the live request
        if (!($data = $cache->load($cacheId))) {
            //cache miss
            $data = $sp->getResponse($this->getRequest());
            $cache->save($data);
        }
        die($data);
    }

    public function phonesAction()
    {
        $this->log->debug(__METHOD__);

        //  Real Time Report
        if ($this->ns->permissions->search_phones_rt) {
            $this->log->debug(__METHOD__ . '() Real Time Phones');
            $sp = new App_Ws_Report_PhoneRealTime($this->getRequest());
            $this->sendResponse($sp, array('PHONE', 'SERVICETYPE', 'IDX'));
        } else
        // Phones Plus Report
        if ($this->ns->permissions->search_phones_pl) {
            $this->log->debug(__METHOD__ . '() Phones Plus Report not implemented');
            $this->_setResponseAccessNotAllowed();
        } else {
            $this->_setResponseAccessNotAllowed();
        }
    }

}
