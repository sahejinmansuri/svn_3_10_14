<?php

class App_Event_Cw_ProfileController_home extends App_Event_WsEventAbstract  {

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
    
    public function execute(&$session_data,&$pview,&$cthis){


                App_DataUtils::beginTransaction();

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                        $uid = $session_data->userid;
                        $user = new App_User($uid);

                        $country_code = $user->getCountryCode();
                        $pview->country_code = $country_code;

                        $pview->firstname = $session_data->identity['firstname'];
                        $pview->lastname  = $session_data->identity['lastname'];
                        $pview->email     = $session_data->identity['email'];

                        $uinfo = new App_Models_Db_Wigi_User();
                        $uinfof = $uinfo->fetchRow($uinfo->select()->from($uinfo,
                                array('alternate_email', 'alternate_phone', 'date_added', 'created_via')
                        )->where('user_id = ?', $uid));

                        $pview->altemail = $uinfof['alternate_email'];
                        $pview->altphone = $uinfof['alternate_phone'];
                        $pview->account_date = date("M j, Y", strtotime($uinfof['date_added']));
                        $pview->account_device = $uinfof['created_via'];

                        $uaddr = new App_Models_Db_Wigi_UserAddress();
                        $uaddrf = $uaddr->fetchRow($uaddr->select()->from($uaddr,
                                array('addr_line1', 'addr_line2', 'city', 'state', 'zip')
                        )->where('user_id = ?', $uid));

                        $pview->zip      = $uaddrf['zip'];
                        $pview->address  = $uaddrf['addr_line1'];
                        $pview->address2 = $uaddrf['addr_line2'];
                        $pview->city     = $uaddrf['city'];
                        $pview->state    = $uaddrf['state'];

                        $uinfo = new App_Models_Db_Wigi_User();
                        $birthdate = $uinfo->fetchRow($uinfo->select()->where('user_id = ?', $uid));
                        $pview->birthdate = date("M j, Y", strtotime($birthdate['birthdate']));

                        $ucc = new App_Models_Db_Wigi_UserCreditCard();
                        $creditcards = $ucc->fetchAll($ucc->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
                        $pview->credit_cards = $creditcards;

                        $uba = new App_Models_Db_Wigi_UserBankAccount();
                        $bankaccounts = $uba->fetchAll($uba->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
                        $pview->bank_accounts = $bankaccounts;
		
						$bankaccountsr = array();
						$ubar = new App_Models_Db_Wigi_RoutingNumberInfo();
						foreach ($bankaccounts as $ba) {
							$bankaccountsr[$ba['user_bank_account_id']] = $ubar->fetchRow($ubar->select()->from($ubar, array("description"))->where('routing = ?', $ba['routing']));
						}
						$pview->bank_accounts_r = $bankaccountsr;

                        $ucells = new App_Models_Db_Wigi_UserMobile();
                        $cellphones_raw = $ucells->fetchAll($ucells->select()->where('user_id = ?', $uid)->where('status != ?', "deleted"));
                        $cellphones = array();
                        foreach ($cellphones_raw as $crow) {
                          $crow->cellphone = preg_replace("/(\d\d\d)(\d\d\d)(\d\d\d\d)/", "($1)$2-$3",$crow->cellphone);
                          array_push($cellphones,$crow);
                        }
                        $pview->cellphones = $cellphones;

                        $uprefs = new App_Prefs();
                        $preferences = $uprefs->getWebUserPrefs($uid);
                        $pview->preferences = $preferences;

                        $cellpreferences = Array();
                        foreach ($cellphones as $cell) {
                                $mid = $cell['mobile_id'];
                                $cellpreferences[$mid] = $uprefs->getCellphonePrefs($uid, $mid);
                        }
				        $pview->cellpreferences = $cellpreferences;
                        
						$celllinks = Array();
						foreach ($cellphones as $cell) {
							$mid = $cell['mobile_id'];
							$cell = new App_Cellphone($mid);
				            $getlba = $cell->getLinkedBankAccounts();
				            $getlcc = $cell->getLinkedCards();
				            $celllinks[$mid] = array(
				            	"ba" => $getlba,
				            	"cc" => $getlcc
				            );
				        }
				        $pview->celllinks = $celllinks;


                        App_DataUtils::commit();

    }
}
