<?php

class App_Event_Cw_MoneyController_banktransfer extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'cellphone_list'  => array('int', 25, 1, App_Constants::getFormLabel('PHONE')),
                'account_list'  => array('generic', 25, 1, App_Constants::getFormLabel('ACCOUNT')),
                'amount'  => array('amount', 25, 1, App_Constants::getFormLabel('AMOUNT')),
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
        
        $pview->pageid = "addfunds";
		
		$f_code = $this->_request->getParam('f_code');
		$amt = $this->_request->getParam('amt');
		$clientcode = $this->_request->getParam('clientcode');
		$mmp_txn = $this->_request->getParam('mmp_txn');
		$mer_txn = $this->_request->getParam('mer_txn');
		$prod = $this->_request->getParam('prod');
		$date = $this->_request->getParam('date');
		$bank_txn = $this->_request->getParam('bank_txn');
		$bank_name = $this->_request->getParam('bank_name');
		$udf9 = $this->_request->getParam('udf9');
		$status = "in-process";

		
		$docmodel = new App_Models_Db_Wigi_MobileAddFund();
        $approvals = array();

        $selectAll = $docmodel->select();
        $selectAll->from('mobile_add_fund')->where("mmp_txn = ".$mmp_txn) ;
		//
        $rawApprovalSet = $docmodel->fetchAll($selectAll);
        
        $i = 0;
        foreach ( $rawApprovalSet as $row ){
            /*$cur_appr = new App_Approval($row);
            $approvals[$i] = $cur_appr;*/
            ++$i;
        }
		
		$c = new App_Cellphone($clientcode);
		$user_id = $c->getUserId();
		
		if($i == 0){
            $keyval = array(
               'user_id'     => $user_id,
               'mmp_txn' 	 => $mmp_txn,
               'mer_txn'     => $mer_txn,
               'amt'     	 => $amt,
               'prod'        => $prod,
               'date'     	 => $date,
               'bank_txn'    => $bank_txn,
               'f_code'      => $f_code,
               'mobile_id'   => $clientcode,
               'bank_name'   => $bank_name,
               'udf9'        => $udf9,
               'status'      => $status,
            );
            
            $bank_fund_id = $docmodel->insert($keyval);
			
			if($f_code == "Ok"){
				$pview->success = "success";
				//$c->addToTempBalance($amt);
				$c->addToBalance($amt);
				
				$uinfof = $docmodel->update(
                    array(
						'status' => 'complete'
                    ),
                    $docmodel->getAdapter()->quoteInto('id = ?', $bank_fund_id)
                );
			}else{
				$pview->success = "failure";
				$uinfof = $docmodel->update(
                    array(
						'status' => 'failure'
                    ),
                    $docmodel->getAdapter()->quoteInto('id = ?', $bank_fund_id)
                );
			}
		}else{
			$pview->success = "already";
		}
        /*$uid  = $session_data->identity['userid'];
        list($id,$type) = explode(",",$this->_request->getParam('account_list'));
        $amount    = $this->_request->getParam('amount');
        $mobileid  = $this->_request->getParam('cellphone_list');
        App_Resource::consumerIsAuthorized("CELLPHONE",$uid,$mobileid);
        if ($type == 1) {
          App_Resource::consumerIsAuthorized("CREDIT_CARD",$uid,$id);
        } else {
          App_Resource::consumerIsAuthorized("BANK_ACCOUNT",$uid,$id);
        }


        $u = new App_User($uid);
        $b = new App_Bank();

        $c = new App_Cellphone($mobileid);
        $c->checkConstraint($amount,'5',false);
        $c->checkConstraint($amount,'6',false);


        if ($type == 1) {
            $cc = new App_CreditCard($id);
            $b->fundFromCreditCard($session_data->extinfo,$uid,$mobileid,$id,$amount,$u->getFirstName(),$u->getLastName(),$cc->getNameOnCard(),$cc->getExpireMonth(),$cc->getExpireYear(),$u->getZip(),$u->getAddress(),$u->getState(),$cc->getCardType(),'1',false);
        } else{
            $ba = new App_BankAccount($id);
            $b->fundFromBankAccount($session_data->extinfo,$uid,$mobileid,$id,$amount,$u->getFirstName(),$u->getLastName(),$ba->getRouting(),$u->getZip(),$u->getAddress(),$u->getState(),$ba->getBankType(),'1',false);
        }*/

        $cthis->initTplData();

        App_DataUtils::commit();

    }
}
