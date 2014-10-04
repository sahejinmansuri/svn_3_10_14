<?php

class App_Event_Posws_AuthController_editpassword extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'OLDPASSWORD'  => array('generic', 100, 0, App_Constants::getFormLabel('PASSWORD')),
                'NEWPASSWORD'    => array('generic', 100, 0, App_Constants::getFormLabel('PASSWORD')),
                'NEWPASSWORD_CONFIRM'   => array('generic', 100, 0, App_Constants::getFormLabel('PASSWORD')),
                'USER'   => array('generic', 100, 0, App_Constants::getFormLabel('USER')),
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

                //$pview->pageid = "profile";

                //$pview->showcontent = "form";
$result  = array();
						$uid = $this->_request->getParam('USER');
                        $user = new App_User($uid);

                        //if ($this->_request->getParam('doaction') != null) {

                                $oldpassword = $this->_request->getParam('OLDPASSWORD');
                                $newpassword1 = $this->_request->getParam('NEWPASSWORD');
                                $newpassword2 = $this->_request->getParam('NEWPASSWORD_CONFIRM');
								
								if ($newpassword1 != $newpassword2){
									$result = array(
										'error'  => array( 'code' => '-32000', 'message' => 'New passwords do not match', 'data' => ''),
									);
									$result['result']['status'] = 'failure';
									$result['result']['value']  = '';
									$result['result']['data']   = 'New passwords do not match';
								}else if(strlen($newpassword1) < 8){
									$result = array(
										'error'  => array( 'code' => '-32000', 'message' => 'Password must be at least 8 characters long', 'data' => ''),
									);
									$result['result']['status'] = 'failure';
									$result['result']['value']  = '';
									$result['result']['data']   = 'Password must be at least 8 characters long';
								}else if(!$user->passwordMatches($oldpassword)){
									$result = array(
										'error'  => array( 'code' => '-32000', 'message' => 'Old Password is wrong', 'data' => ''),
									);
									$result['result']['status'] = 'failure';
									$result['result']['value']  = '';
									$result['result']['data']   = 'Old Password is wrong';
								}else{
										$uinfo = new App_Models_Db_Wigi_User();
                                        $uinfof = $uinfo->update(
                                                array(
                                                        'password' => Atlasp_Utils::inst()->encryptPassword($newpassword1)
                                                ),
                                                $uinfo->getAdapter()->quoteInto('user_id = ?', $uid)
                                        );

                                        $dataRes=array('title'=>'Success','message'=>'Password is Changed.');
										$result['result']['status'] = 'success';
										$result['result']['value']  = '';
										$result['result']['data']   = $dataRes;
								}

                               /* if ($newpassword1 == $newpassword2 && strlen($newpassword1) >= 8 && $user->passwordMatches($oldpassword)) {

                                        

                                } else {

                                        //$pview->showcontent = "error";
										$result['result']['status'] = 'failed';
										$result['result']['value']  = '';
										$result['result']['data']   = '';

                                }*/

                        //}

                        App_DataUtils::commit();
						return $result;

    }
}
