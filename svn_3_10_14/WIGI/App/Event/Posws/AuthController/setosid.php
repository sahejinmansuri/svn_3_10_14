<?php

class App_Event_Posws_AuthController_setosid extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                /*'CELLPHONE' => array('generic', 50, 0, App_Constants::getFormLabel('CELLPHONE')),
                'COUNTRY' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY')),*/
                'QUESTION' => array('generic', 100, 0, App_Constants::getFormLabel('QUESTION')),
                'ANSWER' => array('generic', 50, 0, App_Constants::getFormLabel('ANSWER')),
              //  'PIN' => array('generic', 50, 0, App_Constants::getFormLabel('PIN')),
                'OSID' => array('generic', 50, 0, App_Constants::getFormLabel('OSID'))

            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$cthis){

        App_DataUtils::beginTransaction();
        
		  $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
		  
        /*$cellphone = $this->_request->getParam("CELLPHONE");
        $country = $this->_request->getParam("COUNTRY");
        $pin = $this->_request->getParam("PIN");*/
        
        $answer = $this->_request->getParam("ANSWER");
        $question = $this->_request->getParam("QUESTION");
        $osid = $this->_request->getParam("OSID");
        $allparams = $this->_request->getParams();
       // $allparams["CCODE"] = $country;

//        $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country);
         
        $c = new App_Cellphone($ns->mobileid);
        
        $userid = $c->getUserId();
        $u = new App_User($userid);

        $a = new App_Auth();
        
       // $a->mobileConstraintCheck('consumer',$mobileid,$pin,$osid,false,true,false);
        //if($c->getPin() == Atlasp_Utils::inst()->encryptPassword($pin)) {
                        if ($c->questionMatches($question,$answer)) {
                                $c->authorize($osid);
				$u->resetSuspendCount();
				App_DataUtils::commit();
                                session_write_close();
                                $cthis->getHelper('redirector')->goto('consolidatedauth','auth','posws',$allparams); 
                        } else {
				$u->increaseSuspendCount();
                                throw new App_Exception_WsException('Incorrect question or answer');
                        }
        //        }


        App_DataUtils::commit();

    }
}
