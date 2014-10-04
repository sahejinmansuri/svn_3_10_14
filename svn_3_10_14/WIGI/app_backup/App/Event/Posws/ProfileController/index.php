<?php

class App_Event_Posws_ProfileController_index extends App_Event_WsEventAbstract {

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

                $result = array();

                $c = new App_Cellphone($ns->mobileid);
                $u = new App_User($c->getUserId());

                $result["business_name"]   = $u->getBusinessName();
                $result["dba_name"]        = $u->getBusinessDBAName();

                if ($result["dba_name"] === "") {
                  $result["dba_name"]        = $u->getBusinessName();
                }

                $result["business_tax_id"] = $u->getBusinessTaxId();
                $result["business_phone"]  = $u->getBusinessPhone();
                $result["merchant_id"]     = $u->getMerchantId();

                $result["pin"]     = $c->getPin();
                //$result['release'] = $this->cfg->release;

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                $prefs = $ns->prefs;
                foreach ($prefs['accept'] as $var => $val) {
                        $result[$var] = $val;
                }

                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = '';

                App_DataUtils::commit();

                return $result;
    }
}
