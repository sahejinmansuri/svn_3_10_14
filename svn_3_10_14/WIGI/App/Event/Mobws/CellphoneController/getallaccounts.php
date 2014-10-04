<?php

class App_Event_Mobws_CellphoneController_getallaccounts extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
           'inputs' => array(
                'MOBILE' => array('merchantid', 60, 1, App_Constants::getFormLabel('MOBILE')),
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
                //App_DataUtils::userlogp('Get',$mobileid,'user_mobile','Get All Accounts');

				$mobileid = $ns->mobileid;
				if(!$mobileid){
					$mobileid = $this->_request->getParam("MOBILE");
				}
				
                $b = new App_Cellphone($mobileid);
                $accounts = $b->getLinkedBankAccounts();
                $cards = $b->getLinkedCards();

                $total = array_merge($accounts,$cards);

                if (count($total) == 0) {
                  throw new App_Exception_WsException('This cell phone has no Money Sources. Add them at our InCashMe Consumer Web Portal or from this App by selecting Add Credit Cards');
                }

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $total;

                App_DataUtils::commit();

                return $result;
    }
}
