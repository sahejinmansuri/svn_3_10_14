<?php

class App_Event_Posws_DocumentController_addcell extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USER' => array('generic', 100, 1, App_Constants::getFormLabel('USER')),
                'CELLDESC' => array('phone', 15, 1, App_Constants::getFormLabel('CELLDESC')),
                'CCODE' => array('countrycode', 3, 1, App_Constants::getFormLabel('CCODE')),
                'CELLPHONE' => array('generic', 100, 1, App_Constants::getFormLabel('CELLPHONE')),
                'PIN' => array('pin', 10, 1, App_Constants::getFormLabel('PIN')),
                'CPIN' => array('pin', 10, 1, App_Constants::getFormLabel('CPIN')),
                'QUESTION' => array('generic', 100, 1, App_Constants::getFormLabel('QUESTION')),
                'ANSWER' => array('generic', 100, 1, App_Constants::getFormLabel('ANSWER')),
                'ROLENAME' => array('generic', 100, 1, App_Constants::getFormLabel('ROLENAME')),
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
				$uid = $this->_request->getParam('USER');
        		//$uid = $session_data->identity['userid'];

                $pview->pageid = "profile";

                $pview->showcontent = "form";

                     
                        $user = new App_User($uid);
						
						$user_cell = $user->getUserCellphones();
						
                        $questions = new App_Question();
                        $pview->questions = $questions->getPredefQuestions();

                        //if ($this->_request->getParam('doaction') != null) {

                              
                              
                              
                                $alias = $this->_request->getParam('CELLDESC');
                                $country_code = $user->getCountryCode();
                                $cellphone = $this->_request->getParam('CELLPHONE');
                                $pin = $this->_request->getParam('PIN');
                                $cpin = $this->_request->getParam('CPIN');
                                $question = $this->_request->getParam('QUESTION');
                                $answer = $this->_request->getParam('ANSWER');
                                $rolename = $this->_request->getParam('ROLENAME');
                                
								if($pin != $cpin){
									throw new App_Exception_WsException("Enter PIN Again");
									return false;
								}
								if($rolename ==''){
									throw new App_Exception_WsException("Select role");
									return false;
								}
                                $ucell = new App_Models_Db_Wigi_UserMobile();
                                $ucget = $ucell->fetchAll($ucell->select()->where('cellphone = ?', $cellphone)->where('status != ?', 'deleted'));
						
						$count_cell = count($user_cell);
						//print_r($user_cell);
                                if (count($ucget) > 0) {
									$errno = "Pos is already registered";
												$result = array(
													'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
												);
												$result['result']['status'] = 'failure';
												$result['result']['value']  = '';
												$result['result']['data']   = $errno;

                                }else if($count_cell >= 5){
									$errno = "You have reached maximum number of Pos. You can not add new cellphone";
												$result = array(
													'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
												);
												$result['result']['status'] = 'failure';
												$result['result']['value']  = '';
												$result['result']['data']   = $errno;
								}else {

                                        $cellid = $user->addCellphone($cellphone, Atlasp_Utils::inst()->encryptPassword($pin),$alias,"pos");
                                       

                                        $mobileid = App_Cellphone::getIdFromCellphone($cellphone, $country_code);

                                        $c = new App_Cellphone($mobileid);
                                        $defSettings = new App_DefSettings();
                                        $defSettings->createMobileSettings($c->getUserId(), $mobileid);

                                        $c->addQuestion($question, $answer);

                                        $m = new App_Messenger();
                                        $m->sendMessage("Your confirmation code is $cellid",$cellphone,'2'); //SMS

                                        $pview->cellid = $mobileid;
                                        

  $ucell = new App_Models_Db_Wigi_UserMobile();
                                
                                $ucget = $ucell->fetchRow($ucell->select()->where('user_id = ?', $uid)->where('cellphone = ?', $cellphone)->where('user_id = ?', $uid)
  ->where('status != ?',"deleted")
                                        );
                                    
                                       $mobile1=$ucget['mobile_id'];
                                        

                                        $dataRes=array('title'=>'Pos Added','message'=>'Your pos has been added. One more step to go! We will now send you sms to verify the pos');
										$result['result']['status'] = 'success';
										$result['result']['value']  = '';
										$result['result']['data']   = $dataRes;
										$result['result']['data']['key'] = Zend_Session::getId();
										$result['result']['data']['mobileid'] = $mobile1;
										

                                }

                        //}

                        App_DataUtils::commit();
						return $result;

    }
}
