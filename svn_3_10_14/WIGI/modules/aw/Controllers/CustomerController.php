<?php

error_reporting(E_ALL);
include(__DIR__ . '/SearchUtilsController.php');

class Aw_CustomerController extends Aw_SearchUtilsController {

    public function homeAction() {
        $this->view->pageid = "customer";
        $this->view->bankaccounts = App_BankAccount::getBankAccounts();
        
        $this->loadSuppportMessages();
        //$this->findMessages();
        $this->view->unapproved_user = array();
		$list = App_Transaction_Type::getConstName();
		$this->view->transaction_types = $list;

        $this->view->transactionSrchForm = $this->prepareSearchInputForm('TRANSACTIONS','customer/forms/transactions_search.tpl','T');
        $this->view->merchantSrchForm = $this->prepareSearchInputForm('MERCHANTS','customer/forms/merchants_search.tpl','M');
        $this->view->consumerSrchForm = $this->prepareSearchInputForm('CONSUMERS','customer/forms/consumer_search.tpl','C');

        $params = Array();
        $params["STATUS"] = "pending";
        $this->view->unapproved_user = App_User::searchMerchantInfo($params);
    }

    public function approvebankaccountAction() {
        $id = $this->getRequest()->getParam("B");
        $bank = new App_BankAccount($id);
        $bank->adminConfirm('1');
    }

    public function denybankaccountAction() {
        $id = $this->getRequest()->getParam("B");
        $bank = new App_BankAccount($id);
        $bank->adminConfirm('0');
    }
    
    public function nonprofitapprovedAction() {

        $user_id = $this->getRequest()->getParam("UID");

        //Zend_Debug::dump($this->getRequest());
        $approv = array();
        //Zend_Debug::dump($this->getRequest()->getParam("chk_is_phone_verified"));
        $aid = $this->getRequest()->getParam("AID");
        $approv['approval_id'] = $this->getRequest()->getParam("AID");
        $approv['is_phone_verified'] = ($this->getRequest()->getParam("chk_is_phone_verified") === "on" )?1:0;
        $approv['phone_comment'] = $this->getRequest()->getParam("txt_is_phone_verified");
        $approv['is_bbb_verified'] = ($this->getRequest()->getParam("chk_is_bbb_verified") === "on" )?1:0;
        $approv['bbb_comment'] = $this->getRequest()->getParam("txt_is_bbb_verified");
        $approv['is_irs_verified'] = ($this->getRequest()->getParam("chk_is_irs_verified") === "on" )?1:0;
        $approv['irs_comment'] = $this->getRequest()->getParam("txt_is_irs_verified");
        $approv['is_clearinghouse_verified'] = ($this->getRequest()->getParam("chk_is_clearinghouse_verified") === "on" )?1:0;
        $approv['clearinghouse_comment'] = $this->getRequest()->getParam("txt_is_clearinghouse_verified");
        $approv['is_address_verified'] = ($this->getRequest()->getParam("chk_is_address_verified") === "on" )?1:0;
        $approv['address_comment'] = $this->getRequest()->getParam("txt_is_address_verified");
        $approv['is_statereg_verified'] = ($this->getRequest()->getParam("chk_is_statereg_verified") === "on" )?1:0;
        $approv['statereg_comment'] = $this->getRequest()->getParam("txt_is_statereg_verified");
        $approv['is_url_verified'] = ($this->getRequest()->getParam("chk_is_url_verified") === "on" )?1:0;
        $approv['url_comment'] = $this->getRequest()->getParam("txt_is_url_verified");
        $approv['is_ssl_verified'] = ($this->getRequest()->getParam("chk_is_ssl_verified") === "on" )?1:0;
        $approv['ssl_comment'] = $this->getRequest()->getParam("txt_is_ssl_verified");
        $approv['is_fed501c_verified'] = ($this->getRequest()->getParam("chk_is_fed501c_verified") === "on" )?1:0;
        $approv['fed501c_comment'] = $this->getRequest()->getParam("txt_is_fed501c_verified");
        $approv['is_fedfein_verified'] = ($this->getRequest()->getParam("chk_is_fedfein_verified") === "on" )?1:0;
        $approv['fedfein_verified'] = $this->getRequest()->getParam("txt_is_fedfein_verified");
        $approv['approved'] = ($this->getRequest()->getParam("chk_approved") === "on" )?1:0;
        $dummyapproval = new App_Approval();
  //      Zend_Debug::dump($approv);
        $dummyapproval->save($aid, $approv);
        if($approv['approved']==1){
            $usr = array();
            //$usr['user_id'] = $user_id;
            $usr['status'] = "active";
            $dummyUser = new App_User($user_id);
            $dummyUser->save($user_id, $usr);
            $this->view->message = "IS";
        }else{
            $this->view->message = "IS NOT";
        }

        $this->view->mid = $user_id;
        $this->view->approval = $approv;
        //Zend_Debug::dump($approv);
        
    }

    public function approvenonprofitAction() {

        $merc_id = $this->getRequest()->getParam("UID");
        $approvalArr = App_Approval::findByMerchant($merc_id);
        //Zend_Debug::dump($approvalArr);
        $this->view->approval_id = $approvalArr->get_approval_id();
        $this->view->questions = App_Admin_QuestionCollection::getAllAsArray();
        $this->view->user_id = $merc_id;
    }

    public function loadSuppportMessages() {
        $datefrom = $this->getRequest()->getParam('datefrom')?$this->getRequest()->getParam('datefrom'):'';
        $dateto = $this->getRequest()->getParam('dateto')?$this->getRequest()->getParam('dateto'):'';
        $msg_status = $this->getRequest()->getParam('msg_status')?$this->getRequest()->getParam('msg_status'):'';

		$params=array();
        if ($msg_status != null) { $params["msg_status"] = $msg_status; }
        if ($datefrom != null) { $params["datefrom"] = $datefrom; }
        if ($dateto != null) { $params["dateto"] = $dateto; }

        $support = new App_Support();
		$supportMessages = $support->getWigiSupportTickets($params);
		$finalResults=array();
		foreach($supportMessages as $id=>$data)
		{
			$msg_status_desc='';
			if($data['msg_status']=='RE'){ $msg_status_desc='Read'; }
			if($data['msg_status']=='RR'){ $msg_status_desc='Read & Responded'; }
			if($data['msg_status']=='UR'){ $msg_status_desc='Unread'; }
			if($data['msg_status']=='AR'){ $msg_status_desc='Archived'; }

			$data['msg_status_desc'] = $msg_status_desc;
			$finalResults[]=$data;
		}
		$this->view->support_messages = $finalResults;
		$this->view->datefrom = $datefrom;
		$this->view->msg_status = $msg_status;
		$this->view->dateto = $dateto;
		$this->view->support_messages_count = count($supportMessages);
	}

    public function findMessages() {
        $results_per_page = 20;
        $s = new App_Support;
        $filters = Array(
            "DF" => "DATE_FROM",
            "DT" => "DATE_TO",
            "S" => "STATUS"
        );

        $msgs = Array();
        $getpage = $this->getRequest()->getParam('SP');
        if ($getpage > 0) {
            $page = $getpage;
        } else {
            $page = 1;
        }

        $p = Array();

        foreach ($filters as $f => $parameter) {
            $field = $f;
            $fieldval = $this->getRequest()->getParam($field);
            if ($fieldval != null || (is_numeric($fieldval) && $fieldval > 0 )) {
                if (strstr($parameter, "DATE")) {
                    $p[$parameter] = App_DataUtils::fmtdate_human2db($fieldval);
                } else {
                    $p[$parameter] = $fieldval;
                }
                $this->view->$field = $fieldval;
            } else {
                $this->view->$field = "";
            }
        }

        $getmsgs = $s->getSupportTickets($p, $page - 1, $results_per_page);
        $pages = ceil(($s->getSupportTickets($p, $page - 1, $results_per_page, true)) / $results_per_page);

        $msgs["messages"] = Array();
        $msgs["messagesshort"] = Array();
        foreach ($getmsgs as $msg) {
            $excerpt = $msg['message'];
            if (strlen($excerpt) > 100) {
                $excerpt = explode(" ", substr($excerpt, 0, 100));
                $excerpt = implode(" ", array_slice($excerpt, 0, -1)) . "...";
            }
            $msgs["messages"][] = $msg;
            $msgs["messagesshort"][] = $excerpt;
        }

        $msgs["pages"] = $pages;
        $msgs["page"] = $page;

        $this->view->msgs = $msgs;
        $this->view->messagestatuses = Array();
    }

    /**
     * findUsers()
     * passes request params to user search function.
     * @return array of User rows
     */
    public function usersearchAction() {
		$fixedInputs =array('status');
        $usrs = $this->getSearchResults('CONSUMERS',$fixedInputs);
        $this->view->usrs = $usrs;
        $this->view->usrs_counts = count($usrs);
        $this->view->back_url = 'consumer_search';
        $this->view->pageid = "customer";
    }

    /**
     * mercsearchAction()
     * passes request params to user search function.
     * @return array of User rows
     */
    public function mercsearchAction() {
		$fixedInputs =array('status');
        $mercs = $this->getSearchResults('MERCHANTS',$fixedInputs);
        $this->view->mercs = $mercs;
        $this->view->mercs_counts = count($mercs);
        $this->view->back_url = 'merchants_search';
    }

    public function txsearchAction() {
		$fixedInputs =array('type','direction');
		$transactions_count = count($this->getSearchResults('TRANSACTIONS',$fixedInputs));
		$page_per = 50;
		$transactions_count1 = $transactions_count + 4;
		$page_count_1 = $transactions_count1 / $page_per;
		$page_count_1 = $page_count_1 ;
		$page_count = ceil($page_count_1);
		//echo $transactions_count."<br>";
		//echo $page_count_1."<br>";
		//echo $page_count;
		//exit();
		
		$p = $this->getRequest()->getParam('p');
		$type = $this->getRequest()->getParam('type');
		$direction = $this->getRequest()->getParam('direction');
		$orderby = $this->getRequest()->getParam('orderby');
		$orderby2 = $this->getRequest()->getParam('orderby2');
		
		$inputsArr = $this->prepareSearchInputs($id,$fixedInputs);
		//echo "<pre>";
		//print_r($inputsArr);
		//exit();

		
		
		if($p > 0){
			$page = $p;
		}else{
			$page = 1;
		}
		//$page = 3;
		$page_offset = ($page - 1) * $page_per;
		$per_page = $page_per;
		
        $transactions = $this->getTransSearchResults('TRANSACTIONS',$fixedInputs,$page_offset,$per_page);
		
		
        $finalRes=array();

		$list = App_Transaction_Type::getConstName();
        foreach($transactions as $id=>$data)
        {
			if(isset($list[$data['type']]))
			{
				$data['type_desc'] = $list[$data['type']];
				$finalRes[]=$data;
			}
        }

        $this->view->consumers_transaction_data = $finalRes;
        $this->view->consumers_transaction_data_cnt = count($transactions);
        $this->view->transactions_count = $transactions_count;
        $this->view->back_url = 'transactions_search';
        $this->view->pageid = "customer";
		$this->view->page_current = $page;
		$this->view->page_count = $page_count;
		$this->view->type = $type;
		$this->view->orderby = $orderby;
		$this->view->orderby2 = $orderby2;
		$this->view->inputsArr = $inputsArr;
    }

    public function mercdetailAction() {
        try {
        $evt = new App_Event_Aw_MerchantProfileController_merchanthome($this->getRequest());
        $mid = $this->getRequest()->getParam("MID");
        //Zend_Debug::dump($mid);
		$this->view->mid = $mid;
        $evt->execute($mid, $this->view, $this);
        } catch (Exception $e) {
           $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror', 'usererror', 'aw', $a);
        }
    }

    public function userdetailAction() {
        try {
            $evt = new App_Event_Aw_ConsumerProfileController_consumerhome($this->getRequest());
            $uid = $this->getRequest()->getParam("UID");
            $evt->execute($uid, $this->view, $this);
            $this->view->uid = $uid;
        }
        catch (Exception $e) {
           $a["MESSAGE"] = $e->getMessage();
            $this->redirect('usererror', 'usererror', 'aw', $a);
        }
    }

	public function savebillingAction()
	{
            $evt = new App_Event_Aw_ConsumerProfileController_savebilling($this->getRequest());
            $uid = $this->getRequest()->getParam("UID");
            Zend_Debug::dump($uid);
            $evt->execute($uid, $this->view, $this, $this->ns->identity);

			$this->redirect('home','customer','aw');
	}

	public function msavediscountAction()
	{
            $evt = new App_Event_Aw_MerchantProfileController_savediscount($this->getRequest());
            $mid = $this->getRequest()->getParam("MID");
            Zend_Debug::dump($mid);
            $evt->execute($mid, $this->view, $this, $this->ns->identity);

			$this->redirect('home','customer','aw');
	}

	public function msavebillingAction()
	{
            $evt = new App_Event_Aw_MerchantProfileController_savebilling($this->getRequest());
            $uid = $this->getRequest()->getParam("MID");
            Zend_Debug::dump($uid);
            $evt->execute($uid, $this->view, $this, $this->ns->identity);
			$this->redirect('home','customer','aw');
	}

	public function showdiscountAction()
	{
			$this->view->curr_year = date('Y');
			$this->view->curr_month = date('F');
			$this->view->month_plus1 = date('F', strtotime('1 month'));
			$this->view->month_plus2 = date('F', strtotime('2 month'));
			$this->view->month_plus3 = date('F', strtotime('3 month'));

            $mid = $this->getRequest()->getParam("MID");
			$this->view->mid = $mid;
			$this->view->pageid = "customer";
	}

	public function discountstep2Action()
	{
            $month = $this->getRequest()->getParam("month");
			$this->view->month = $month;

			if(!$month)
			{
				$this->redirect('home','customer','aw');
			}

            $evt = new App_Event_Aw_MerchantProfileController_discountstep2($this->getRequest());
            $mid = $this->getRequest()->getParam("MID");
			$this->view->mid = $mid;
            //Zend_Debug::dump($mid);
            $evt->execute($mid, $this->view, $this, $this->ns->identity);
	}



}

