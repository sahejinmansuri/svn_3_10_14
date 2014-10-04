<?php

class App_Event_Mobws_CellphoneController_contactus extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => 0
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
                App_DataUtils::userlogp('Send Info',$ns->mobileid,'user_mobile','Contact Us');
				
				$c_from = new App_Cellphone($ns->mobileid);
				
				$m = new App_Messenger();
				$u = new App_User($c_from->getUserId());
				
				$message = 'Hi,<br><br>InCashME : Thank you for connecting with us. We will contact you shortly.';
				$m->sendMessage($message,$u->getEmail(),'1','InCashMe: Thank You for connect with us');
				
				$message_admin = 'Hi,<br><br>User has fill up connect form.';
				$m->sendMessage($message_admin,'','1','InCashMe: Connect Form');
	
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

          App_DataUtils::commit();
          return $result;
    }
}
