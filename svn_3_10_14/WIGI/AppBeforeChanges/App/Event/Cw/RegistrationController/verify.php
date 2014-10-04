<?php

class App_Event_Cw_RegistrationController_verify extends App_Event_WsEventAbstract  {

        /**
         * @param Zend_Controller_Request_Abstract $request
         */
        public function __construct(Zend_Controller_Request_Abstract $request = null) {
                parent::__construct($request);
                $this->_evt_data = array(
                        'inputs' => array(
                                'CODE' => array('generic', 100, 1, App_Constants::getFormLabel('CODE')),
                                'UID' => array('generic', 100, 1, App_Constants::getFormLabel('UID')),

                        )
                );
        }

        public function getEvtData() {
                $data = parent::getEvtData();
                unset($data['inputs']['KEY']);
                unset($data['inputs']['IDENTIFIER']);
                return $data;
        }

        public function execute(&$session_data,&$pview,&$cthis){
        App_DataUtils::beginTransaction();
        $code = $this->_request->getParam('CODE');
        $uid  = $this->_request->getParam('UID');
        $u  = new App_User($uid);
        $u->confirmEmail($code);
        if ($u->getBusinessType() == 5) {
          $pview->message = "However, your account will remain pending until it has been reviewed by WiGime staff.";
        }

        App_DataUtils::commit();
        }

}

?>

