<?php

class App_Event_Posws_SendController_invite extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'EMAIL' => array('generic', 50, 1, App_Constants::getFormLabel('EMAIL')),
                'PHONE' => array('generic', 50, 1, App_Constants::getFormLabel('PHONE')),
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
                $email          = $this->_request->getParam('EMAIL');
                $phone          = $this->_request->getParam('PHONE');
                $result = array();

                $c = new App_Cellphone($ns->mobileid);
                $u = new App_User($c->getUserId());

                $m = new App_Messenger();
                $mess = new App_Messages();
                $merchName = $u->getBusinessName();

                if ($email !== "") {
                  if (App_User::getUserIdFromEmail($email) > 0)
                      throw new App_Exception_WsException("$email is already a registered WiGime user");
                  $message = $mess->getEmailInvite($merchName);
                  $m->sendMessage($message,$email,'1');
                } else if ($phone !== "") {
                  if (App_Cellphone::getIdFromCellphone($phone,'1') > 0)
                      throw new App_Exception_WsException("$phone is already a registered WiGime user");
                  $message = $mess->getTxtInvite($merchName);
                  $m->sendMessage($message,$phone,'2');
                }


                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';


                App_DataUtils::commit();

                return $result;

    }
}
