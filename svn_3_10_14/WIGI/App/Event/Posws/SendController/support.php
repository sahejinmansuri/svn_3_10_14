<?php

class App_Event_Posws_SendController_support extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

/*
        $this->_evt_data = array(
            'inputs' => 0 
        );
*/        
        $this->_evt_data = array(
            'inputs' => array(
                'MESSAGE'  => array('generic', 50, 1, App_Constants::getFormLabel('MESSAGE')),
                'QUERY' => array('generic', 50, 0, App_Constants::getFormLabel('QUERY'))
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    //~ public function execute(){
//~ 
                //~ App_DataUtils::beginTransaction();
//~ 
                //~ $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
//~ 
                //~ $result['result']['status'] = 'success';
                //~ $result['result']['value'] = '';
                //~ $result['result']['data']   = '';
//~ 
                //~ App_DataUtils::commit();
//~ 
                //~ return $result;
    //~ }
    
    public function execute(){
                App_DataUtils::beginTransaction();
				
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                $c = new App_Cellphone($ns->mobileid);
                $u = new App_User($c->getUserId());

                $m = new App_Messenger();
                $mess = new App_Messages();
                $merchName = $u->getBusinessName();
				$m = new App_Messenger();
				
				$user_message = $this->_request->getParam('MESSAGE');
				$query_type = $this->_request->getParam('QUERY');
				
				$message = 'Hi '.$merchName.',<br><br><p>Thank you for connecting with us. We will contact you shortly.</p>';
				$c->sendMessage($message,'InCashMe: Thank You for connect with us');
				
				$message_admin = 'Hi,<br><br>User has fill up connect form.';
				$m->sendMessage($message_admin,'','1','InCashMe: Connect Form<br/><br/>User Message: '.$user_message.'<br/><br/>Query Type: '.$query_type);
	
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = ''; 

          App_DataUtils::commit();
          return $result;
    }
}
