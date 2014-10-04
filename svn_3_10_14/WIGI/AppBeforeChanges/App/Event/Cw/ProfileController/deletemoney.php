<?php

class App_Event_Cw_ProfileController_deletemoney extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ITEM'  => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
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

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     
                $pview->pageid = "profile";

                $pview->showcontent = "form";
                $uid = $session_data->identity['userid'];
                        $item = $this->_request->getParam("ITEM");
                        $itemtype = substr($item, 0, 2); // ba: bankaccount, cc: creditcard
                        $itemid = substr($item, 2);
                        if ($itemtype != false && is_numeric($itemid)) {

                                $pview->ITEM = $item;

                                if ($this->_request->getParam('doaction') != null) {

                                        if ($itemtype == "ba") {
						App_Resource::consumerIsAuthorized("BANK_ACCOUNT",$uid,$itemid);
                                                $uba = new App_Models_Db_Wigi_UserBankAccount();

                                                $ubdel = $uba->update(
                                                        array('status' => 'deleted'),
                                                        $uba->getAdapter()->quoteInto('user_bank_account_id = ?', $itemid)
                                                );

                                        } elseif ($itemtype == "cc") {
                                                App_Resource::consumerIsAuthorized("CREDIT_CARD",$uid,$itemid);
                                                $ucc = new App_Models_Db_Wigi_UserCreditCard();

                                                $ucdel = $ucc->update(
                                                        array('status' => 'deleted'),
                                                        $ucc->getAdapter()->quoteInto('user_credit_card_id = ?', $itemid)
                                                );

                                        }

                                        $pview->showcontent = "success";

                                }

                        } else {

                                $pview->ITEM = "";

                        }

                        App_DataUtils::commit();

    }
}
