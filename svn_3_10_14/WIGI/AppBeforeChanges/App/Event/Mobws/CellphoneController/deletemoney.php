<?php

class App_Event_Mobws_CellphoneController_deletemoney extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
              'ID'  => array('generic', 100, 1, App_Constants::getFormLabel('ID')),
              'TYPE'  => array('generic', 100, 1, App_Constants::getFormLabel('TYPE')),
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
                $uid = $ns->userid;

                $id = $this->_request->getParam("ID");
                $type = $this->_request->getParam("TYPE");

                if ($type == "2") {
                     App_Resource::consumerIsAuthorized("BANK_ACCOUNT",$uid,$id);
                     $uba = new App_Models_Db_Wigi_UserBankAccount();

                     $ubdel = $uba->update(
                                 array('status' => 'deleted'),
                                 $uba->getAdapter()->quoteInto('user_bank_account_id = ?', $id)
                     );

                } elseif ($type == "1") {
                     App_Resource::consumerIsAuthorized("CREDIT_CARD",$uid,$id);
                     $ucc = new App_Models_Db_Wigi_UserCreditCard();

                     $ucdel = $ucc->update(
                                  array('status' => 'deleted'),
                                  $ucc->getAdapter()->quoteInto('user_credit_card_id = ?', $id)
                     );

                }

                App_DataUtils::commit();

                    $result = array();
                    $result['result']['status'] = 'success';
                    $result['result']['value']  = '';
                    $result['result']['data']   = '';

                    return $result;


    }
}
