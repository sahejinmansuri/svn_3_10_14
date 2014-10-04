<?php

class App_Event_Mobws_CellphoneController_tellfriends extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'NAME'  => array('generic', 50, 1, App_Constants::getFormLabel('NAME')),
                'CCODE' => array('generic', 50, 0, App_Constants::getFormLabel('CCODE')),
                'PHONE'  => array('generic', 50, 0, App_Constants::getFormLabel('PHONE')),
                'EMAIL' => array('generic', 50, 0, App_Constants::getFormLabel('EMAIL')),
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(){
                App_DataUtils::beginTransaction();

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('User',$ns->mobileid,'none','Tell Friends');

                $name  = $this->_request->getParam("NAME");
                $ccode = $this->_request->getParam("CCODE");
                $phone  = $this->_request->getParam("PHONE");
                $email = $this->_request->getParam("EMAIL");
		
		$u = new App_User($ns->userid);
		$m = new App_Messenger();
		$mess = new App_Messages();
		if ($email !== "") {
			if (App_User::getUserIdFromEmail($email) > 0)
                                throw new App_Exception_WsException("$email is already a registered InCashMe&trade; user");
			$message = $mess->getEmailInvite($u->getFirstName() . " " . $u->getLastName());
			$m->sendMessage($message,$email,'1');
		} 
                else {
                        if (App_Cellphone::getIdFromCellphone($phone,$ccode) > 0)
                                throw new App_Exception_WsException("$phone is already a registered InCashMe&trade; user");
			$message = $mess->getTxtInvite($u->getFirstName() . " " . $u->getLastName());
			$m->sendMessage($message,$ccode . $phone,'2');
		}

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();
                return $result;

    }
}
