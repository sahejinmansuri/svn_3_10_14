<?php

class App_Event_Cw_AdvancedController_mydocumentsedit extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

       if ($this->_request->getParam("doaction") != null) {
         $this->_evt_data = array(
            'inputs' => array(
                'C'  => array('int', 25, 1, App_Constants::getFormLabel('CELLPHONE')),
                'D'  => array('int', 25, 1, App_Constants::getFormLabel('DOCUMENT')),
                'DOCTYPE' => array('generic', 25, 0, App_Constants::getFormLabel('DOCTYPE')),
                'DOCDESC' => array('generic', 50, 0, App_Constants::getFormLabel('DOCDESC')),
                'DOCNUM' => array('generic', 25, 0, App_Constants::getFormLabel('DOCNUM')),
                'DOCEXP_YEAR' => array('int', 25, 0, App_Constants::getFormLabel('DOCEXP_YEAR')),
                'DOCEXP_MONTH' => array('int', 25, 0, App_Constants::getFormLabel('DOCEXP_MONTH')),
                'DOCEXP_DAY' => array('int', 25, 0, App_Constants::getFormLabel('DOCEXP_DAY')),
            )
        );
      } else {
         $this->_evt_data = array(
            'inputs' => array(
                'C'  => array('int', 25, 1, App_Constants::getFormLabel('CELLPHONE')),
                'D'  => array('int', 25, 1, App_Constants::getFormLabel('DOCUMENT')),
            )
        );

      }

    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$session_data,&$pview,&$cthis){

                        App_DataUtils::beginTransaction();
                        $uid = $session_data->userid;
                        $cellid = $this->_request->getParam("C");
                        $docid = $this->_request->getParam("D");
                        App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$cellid);
                        App_Resource::cellphoneIsAuthorized("DOCUMENT",$cellid,$docid);


                        $pview->pageid = "advanced";

                        $pview->showcontent = "form";

                        $doctypes = Array('Vehicle Registration','Insurance Card','Passport','Student ID','Credit Card','Bank Card','Airline Card','Hotel Card','Car Rental Card','Membership Card','ID Card','Social Security Card','Gift Card','Prescription','Asset','License','None','Other');
                        $pview->doctypes = $doctypes;

                        $pview->docexpdatedays = 31;
                        $pview->docexpdatemonths = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
                        $pview->docexpdateyears = date("Y") + 20;

                        $c = new App_Cellphone($cellid);


                        $d = new App_DocumentEngine();
                        $docinfo = $d->getDocument($cellid, $docid);

                        $time = new Zend_Date($docinfo['expiration']);
                        $docexpmonth = $time->toString("M");
                        $docexpday = $time->toString("d");
                        $docexpyear = $time->toString("YYYY");

                        $pview->cellid = $cellid;
                        $pview->docid = $docid;

                        $pview->DOCDESC = $docinfo['description'];
                        $pview->DOCNUM = $docinfo['number'];
                        $pview->DOCTYPE = $docinfo['type'];
                        $pview->DOCEXP_MONTH = $docexpmonth;
                        $pview->DOCEXP_DAY = $docexpday;
                        $pview->DOCEXP_YEAR = $docexpyear;

                        if ($this->_request->getParam("doaction") != null) {

                                        $doctype = $this->_request->getParam("DOCTYPE");
                                        $description = $this->_request->getParam("DOCDESC");
                                        $number = $this->_request->getParam("DOCNUM");

                                        $expires = $this->_request->getParam("DOCEXP_YEAR");
                                        $expires .= "-" . $this->_request->getParam("DOCEXP_MONTH");
                                        $expires .= "-" . $this->_request->getParam("DOCEXP_DAY");

                                        $d->updateDocument($docid, $cellid, $doctype, "1", $description, "", "", $number, $expires);

                                        $pview->showcontent = "success";

                       }
                       App_DataUtils::commit();
    }
}
