<?php

class App_Event_Mw_OrdersController_deleteorder extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'ITEM' => array('generic', 100, 0, App_Constants::getFormLabel('ITEM')),
				'T' => array('generic', 100, 0, App_Constants::getFormLabel('TYPE')),
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

        $pview->pageid = "orders";

        $pview->showcontent = "form";

                $item = $this->_request->getParam('ITEM');
                $type = $this->_request->getParam('T');
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));

                $pview->ITEM = $item;
                $pview->ordertype = $type;

                if ($item != null && is_numeric($item)) {

                        if ($this->_request->getParam('doaction') != null) {

                                $o = new App_Order($item);

                                if ($o->getMerchantUserId() !== $ns->userid) {
                                        throw new App_Exception_WsException("User does not own this order");
                                }

                                $wgc = $o->getWigiCode();
                                $wgc = str_replace("-", "", $wgc);
                                $o->setStatus('cancelled');
                                $w = new App_WigiEngine();
                                try {
                                  $w->deleteCode($ns->extinfo, $wgc, $o->getConsumerMobileId());
                                } catch (Exception $e) {}

                                $pview->showcontent = "success";

                        }

                } else {

                        $pview->ITEM = "";

                }
	

           App_DataUtils::commit();

	}
	
}

?>
