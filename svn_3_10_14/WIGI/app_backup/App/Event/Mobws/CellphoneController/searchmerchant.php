<?php

class App_Event_Mobws_CellphoneController_searchmerchant extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'SEARCH' => array('generic', 45, 1, App_Constants::getFormLabel('SEARCH')),
                'TYPE' => array('generic', 45, 0, App_Constants::getFormLabel('TYPE')),
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

                $search  = $this->_request->getParam("SEARCH");
                $type    = $this->_request->getParam("TYPE");

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Search Merchant');

                if (!preg_match('/^a{0,1}\d-\d\d\d-\d\d\d\d\d\d\d$/',$search)) {
		  $search = str_replace("-", "", $search);
                  $search = str_replace("(", "", $search);
                  $search = str_replace(")", "", $search);
                  $search = preg_replace('/\d+\s+/','',$search);
                }


		$res = App_User::searchMerchant($search,$type);

		if (count($res) == 0) {
			 throw new App_Exception_WsException("Merchant not found.");
		}

                if (count($res) > 10) {
                         throw new App_Exception_WsException("Too many results. Please refine your search.");
                }

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $res;

                App_DataUtils::commit();
                return $result;
    }
}
