<?php

class App_Event_Mobws_CellphoneController_getcellphones extends App_Event_WsEventAbstract {

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
                $res = $user->getUserCellphones();
				$result_cell = array();
				
				$i = 0;
				foreach($res as $key=>$val){
					
					$result_cell[$i]['mobile_id'] = $val['mobile_id'];
					$result_cell[$i]['cellphone'] = $val['cellphone'];
					$result_cell[$i]['cellphone_name'] = $val['alias'];
					$result_cell[$i]['is_default'] = $val['is_default'];
					$result_cell[$i]['balance'] = $val['balance'];
					//$result_cell[$i]['permission'] = $val['permission'];
					//premission
					$permission = $val['permission'];
					$perm_array = explode('|',$permission);
					if($val['is_default'] == 1){
						$result_cell[$i]['permission']['profile'] = 1;
						$result_cell[$i]['permission']['change_pin'] = 1;
						$result_cell[$i]['permission']['add_money'] = 1;
						$result_cell[$i]['permission']['withdraw_money'] = 1;
						$result_cell[$i]['permission']['change_question'] = 1;
						$result_cell[$i]['permission']['lock_cell'] = 1;
					}else{
						$result_cell[$i]['permission']['profile'] = $perm_array['0']?1:0;
						$result_cell[$i]['permission']['change_pin'] = $perm_array['1']?1:0;
						$result_cell[$i]['permission']['add_money'] = $perm_array['2']?1:0;
						$result_cell[$i]['permission']['withdraw_money'] = $perm_array['3']?1:0;
						$result_cell[$i]['permission']['change_question'] = $perm_array['4']?1:0;
						$result_cell[$i]['permission']['lock_cell'] = $perm_array['5']?1:0;
					}
					$b = new App_Cellphone($val['mobile_id']);
					$accounts = $b->getLinkedBankAccounts();
					$cards = $b->getLinkedCards();

					$total = array_merge($accounts,$cards);
					if($val['role'] == NULL){
						$role = "";
					}else{
						$role = $val['role'];
					}
					$result_cell[$i]['accounts'] = $total;
					$result_cell[$i]['role'] = $role;
					$i++;
				}
				//exit();
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $result_cell;

                App_DataUtils::commit();
                return $result;
    }
}
