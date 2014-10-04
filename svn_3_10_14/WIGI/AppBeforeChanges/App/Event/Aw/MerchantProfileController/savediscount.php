<?php

class App_Event_Aw_MerchantProfileController_savediscount extends App_Event_WsEventAbstract  {

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
    
    public function execute(&$uid,&$pview,&$cthis, &$identity){
				$list = App_Transaction_Type::getConstName();
				$this->view->typelist = $list;
				$fixedStr='';
				
				$month = $this->_request->getParam('month');
				$special_billing_discount_one_code = $this->_request->getParam('special_billing_discount_one_code');
				$special_billing_discount_one = $this->_request->getParam('special_billing_discount_one');

				$special_billing_discount_two_code = $this->_request->getParam('special_billing_discount_two_code');
				$account_special_min_num_trans = $this->_request->getParam('account_special_min_num_trans');
				$account_special_min_amount_trans = $this->_request->getParam('account_special_min_amount_trans');
				$special_billing_discount_two = $this->_request->getParam('special_billing_discount_two');

				$currentTotalNumTrans = $this->_request->getParam('currentTotalNumTrans');
				$currentTotalTransAmt = $this->_request->getParam('currentTotalTransAmt');

				$fixedStr.=$special_billing_discount_one_code.'-'.$special_billing_discount_one.'|'.$special_billing_discount_two_code.'-'.$account_special_min_num_trans.'-'.$account_special_min_amount_trans.'-'.$special_billing_discount_two.'|'.$currentTotalNumTrans.'-'.$currentTotalTransAmt.'|';

				$us = new App_Models_Db_Wigi_WigiMerchantSettings();
				$u1['status']='I';
				$u1['usermodified']=$identity['userid'];
				$u1['datemodified']=new Zend_Db_Expr('NOW()');
				$us->update($u1, array(
					'user_id = ? ' => $uid,
					'category = ? ' => $month.' special billing',
					'status = ? ' => 'A',
				));
		
				
				$r=array();
				$r['user_id']=$uid;
				$r['category']=$month.' special billing';
				$r['status']='A';
				$r['value']=$fixedStr;
				$r['useradded']=$identity['userid'];
				$r['datecreated']=new Zend_Db_Expr('NOW()');
				$us->insert($r);
    }
}
