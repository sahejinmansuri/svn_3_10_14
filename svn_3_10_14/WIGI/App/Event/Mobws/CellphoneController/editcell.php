<?php

class App_Event_Mobws_CellphoneController_editcell extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CELLPHONE'  => array('generic', 100, 1, App_Constants::getFormLabel('CELLPHONE')),
                'CCODE'  => array('generic', 100, 1, App_Constants::getFormLabel('CCODE')),
                'CELLDESC'  => array('generic', 100, 1, App_Constants::getFormLabel('CELLDESC')),
                'USER'  => array('generic', 100, 1, App_Constants::getFormLabel('USER')),
                'ROLE'  => array('generic', 100, 1, App_Constants::getFormLabel('ROLE')),
				//for permission
				'VIEW_PROFILE_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('VIEW_PROFILE_INDEX')),
                'CHNAGE_PIN_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('CHNAGE_PIN_INDEX')),
                'ADD_MONEY_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('ADD_MONEY_INDEX')),
                'WITHDRAW_MONEY_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('WITHDRAW_MONEY_INDEX')),
                'CHANGE_QUESTION_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('CHANGE_QUESTION_INDEX')),
                'LOCK_CELL_INDEX' => array('pin', 25, 1, App_Constants::getFormLabel('LOCK_CELL_INDEX')),
            )

        );
    }
/*profile
change pin
Add money
withdraw money
Change security question
Lock cell*/
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
                $uid = $this->_request->getParam("USER");
                $mobile_no = $this->_request->getParam("CELLPHONE");
                $countrycode = $this->_request->getParam("CCODE");
				$item = App_Cellphone::getIdFromCellphone($mobile_no,$countrycode);
				
				$c = new App_Cellphone($item);
                App_Resource::consumerIsAuthorized('CELLPHONE',$uid,$item);
				
				$alias = $this->_request->getParam('CELLDESC');
				$explode_str = "User Roles ";
				$role = $this->_request->getParam('ROLE');
				$role_array = explode($explode_str,$role);
				
				$final_role = $role_array[1];
				
				//$role = 'test1';
                $pview->pageid = "profile";

                //$pview->showcontent = "form";
                        if ($item != null && is_numeric($item)) {
                                	

                                $ucell = new App_Models_Db_Wigi_UserMobile();
                                $ucget = $ucell->fetchRow($ucell->select()->where('mobile_id = ?', $item));

								//permission string
								$rolestr = $cthis->getPermissionStringUser();	
								

                                //if ($this->_request->getParam('doaction') != null) {

                                        $ucedit = $ucell->update(
                                                array('alias' => $alias,'role' => $final_role,'permission'=>$rolestr),
                                                $ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
                                        );

                                        $dataRes=array('title'=>'Cellphone Changed','message'=>'Your cellphone has been changed.');
										$result['result']['status'] = 'success';
										$result['result']['value']  = '';
										$result['result']['data']   = $dataRes;

                               // }

                        } else {
								$errno = "Please enter correct cellphone and country code";
                                $result = array(
									'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
								);
								$result['result']['status'] = 'failure';
								$result['result']['value']  = '';
								$result['result']['data']   = $errno;

                        }

                        App_DataUtils::commit();
						return $result;
    }
}
