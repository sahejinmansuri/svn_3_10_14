<?php

class App_Event_Aw_ConsumerProfileController_showadd extends App_Event_WsEventAbstract  {

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
    
    public function execute(&$session_data,&$pview,&$cthis){

        //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
        //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     
        
        $pview->pageid = "addfunds";

        $uid  = $session_data->identity['userid'];
        $user = new App_User($uid);

        $pview->credit_cards  = $user->getCreditCards();
        $pview->bank_accounts = $user->getBankAccounts();
        $pview->cellphones    = $user->getFmtCellphones();


    }
}
