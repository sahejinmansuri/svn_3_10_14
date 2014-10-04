<?php

class App_Event_Posws_DocumentController_deletecell extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MOBILE_ID'  => array('generic', 100, 1, App_Constants::getFormLabel('MOBILE_ID')),
                'USER'  => array('generic', 100, 1, App_Constants::getFormLabel('USER')),
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

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";
                        $item = $this->_request->getParam("MOBILE_ID");
                        $cellobj = new App_Cellphone($item);
						$uid = $cellobj->getUserId();

                        $user = new App_User($uid);


                        App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$item);

                        if ($item != null && is_numeric($item)) {

                                $pview->ITEM = $item;

                                //if ($this->_request->getParam('doaction') != null) {

                                        $ucell = new App_Models_Db_Wigi_UserMobile();
                                        $ucget = $ucell->fetchRow($ucell->select()->where('mobile_id = ?', $item));
                                        
                                        
                                        //$pin = $this->_request->getParam('PIN');
                                        //$password = $this->_request->getParam('PASSWORD');
                                        //$checkfields = ($user->passwordMatches($password) && $cellobj->pinMatches($pin));

                                        if ($ucget['is_default'] == 1 || $ucget['balance'] > 0 || $cellobj->getNoActiveCodes() > 0 || ($ns->mobileid == $item)){
											/*if (!$checkfields) {
												$errno = "Please make sure you entered your PIN and password correctly.";
												$result = array(
													'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
												);
												$result['result']['status'] = 'failure';
												$result['result']['value']  = '';
												$result['result']['data']   = $errno;
                                                
                                            }*/
											if ($ucget['is_default'] == 1) {
												$errno = "This cellphone is default. You can not delete it.";
												$result = array(
													'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
												);
												$result['result']['status'] = 'failure';
												$result['result']['value']  = '';
												$result['result']['data']   = $errno;
                                            } elseif ($ucget['balance'] > 0) {
                                                $errno = "Please withdraw your funds from this account before deleting.";
												$result = array(
													'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
												);
												$result['result']['status'] = 'failure';
												$result['result']['value']  = '';
												$result['result']['data']   = $errno;
                                            } elseif ($cellobj->getNoActiveCodes() > 0) {
												$errno = "Make sure you don't have any pending transactions.";
												$result = array(
													'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
												);
												$result['result']['status'] = 'failure';
												$result['result']['value']  = '';
												$result['result']['data']   = $errno;
											} elseif ($ns->mobileid == $item) {
												$errno = "You can not delete current cellphone.";
												$result = array(
													'error'  => array( 'code' => '-32000', 'message' => $errno, 'data' => ''),
												);
												$result['result']['status'] = 'failure';
												$result['result']['value']  = '';
												$result['result']['data']   = $errno;
											}
											/*throw new App_Exception_WsException($errno);
											return false;*/
                                        } else {

                                                $ucdel = $ucell->update(
                                                        array('status' => 'deleted'),
                                                        $ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
                                                );

                                                $country_code = $user->getCountryCode();
                                                $cellphone = $countrycode . $ucget['cellphone'];

                                                $m = new App_Messenger();
                                                $m->sendMessage("Your cell phone, $cellphone, has been successfully deleted from your account.",$user->getEmail(),'1','InCashMe: Cellphone Deleted');

                                                $dataRes=array('title'=>'Cellphone Deleted','message'=>'Your cellphone has been deleted.');
												$result['result']['status'] = 'success';
												$result['result']['value']  = '';
												$result['result']['data']   = $dataRes;

                                        }

                                //}

                        } else {

                                $pview->ITEM = "";

                        }

                        App_DataUtils::commit();
						return $result;

    }
}
