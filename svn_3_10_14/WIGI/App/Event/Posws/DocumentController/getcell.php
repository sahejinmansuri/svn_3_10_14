<?php

class App_Event_Posws_DocumentController_getcell extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USER' => array('pin', 25, 1, App_Constants::getFormLabel('USER')),
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

                /*$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Documents');

                

                $c = new App_Cellphone($ns->mobileid);*/
				$user_id     = $this->_request->getParam("USER");
				$user = new App_User($user_id);

                //if ($c->getPin() !== Atlasp_Utils::inst()->encryptPassword($pin)) {
                //  throw new App_Exception_WsException("Incorrect PIN.");
                //}

                //$de = new App_DocumentEngine();
                
                $res = $user->getUserCell();
				$result_cell = array();
				
				$i = 0;
				foreach($res as $key=>$val){
					
					$result_cell[$i]['mobile_id'] = $val['mobile_id'];
					$result_cell[$i]['cellphone'] = $val['cellphone'];
					$result_cell[$i]['cellphone_name'] = $val['alias'];
					$result_cell[$i]['is_default'] = $val['is_default'];
					$result_cell[$i]['balance'] = $val['balance'];
					$result_cell[$i]['status'] = $val['status'];
					
					$i++;
				}
				
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $result_cell;

                App_DataUtils::commit();
                return $result;
    }
}
