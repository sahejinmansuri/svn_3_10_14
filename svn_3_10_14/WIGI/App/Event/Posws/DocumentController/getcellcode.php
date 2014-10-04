<?php

class App_Event_Posws_DocumentController_getcellcode extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USER' => array('pin', 25, 1, App_Constants::getFormLabel('USER')),
                'CODE' => array('pin', 25, 1, App_Constants::getFormLabel('CODE')),
                'MOBILE' => array('pin', 25, 1, App_Constants::getFormLabel('MOBILE')),
                
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
				$code    = $this->_request->getParam("CODE");
				$mobile = $this->_request->getParam("MOBILE");
				$user = new App_User($user_id);

                //if ($c->getPin() !== Atlasp_Utils::inst()->encryptPassword($pin)) {
                //  throw new App_Exception_WsException("Incorrect PIN.");
                //}

                //$de = new App_DocumentEngine();
                
                $res = $user->getUserCell1($mobile);
				$result_cell = array();
				
				$i = 0;
				foreach($res as $key=>$val){
					
			/*		$result_cell[$i]['mobile_id'] = $val['mobile_id'];
					$result_cell[$i]['cellphone'] = $val['cellphone'];
					$result_cell[$i]['cellphone_name'] = $val['alias'];
					$result_cell[$i]['is_default'] = $val['is_default'];
					$result_cell[$i]['balance'] = $val['balance'];
					$result_cell[$i]['status'] = $val['status'];*/
					$result_cell[0]['cellphone'] = $val['cellphone'];
					$result_cell[0]['CODE'] = $val['mobile_confirmation_code'];
					
					$i++;
				}
			
				if($result_cell[0]['CODE'] == $code ) {
					
                                $ucell = new App_Models_Db_Wigi_UserMobile();
                                
                                $ucget = $ucell->fetchRow($ucell->select()->where('mobile_id = ?', $mobile)
                                        );

                                        $ucedit = $ucell->update(
                                                array('status' =>"active"),
                                                $ucell->getAdapter()->quoteInto('mobile_id = ?', $mobile)
                                        );

					 
					 
					$dataRes=array('title'=>'Congratulations','message'=>'Your pos has been verified.');
			
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $dataRes;
}
else {
	$dataRes=array('title'=>'Sorry','message'=>'Your conformation code is not valid.Please try again with valid code');
	
	 $result = array();
                $result['result']['status'] = 'failure';
                $result['result']['value'] = '';
                $result['result']['data']   = $dataRes;
}
                App_DataUtils::commit();
                return $result;
    }
}
