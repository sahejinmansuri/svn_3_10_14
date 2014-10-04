<?php
include(__DIR__ . '/WebController.php');

class Aw_BillingController extends Aw_WebController {
	
    public function homeAction(){
    	$this->view->pageid = "billing";

		/*  Can get rid of it once discount piece if complete*/
		$list = App_Transaction_Type::getConstName();
		$this->view->typelist = $list;

		$was = new App_WigiAdminSettings();
		$data = $was->getAdminSetting();

		$this->view->wigi_fixed_billing = App_Transaction_WigiCharges::prepareBillingData($data['wigi_fixed_billing']);
		$this->view->wigi_percentage_billing = App_Transaction_WigiCharges::prepareBillingData($data['wigi_percentage_billing']);
		$this->view->wigi_default_billing = App_Transaction_WigiCharges::prepareDefaultsData($data['wigi_default_billing']);
		
		$a = App_Transaction_WigiCharges::_convertDefaultValStrtoArr($data['wigi_default_billing']);
		$this->view->minamt = @$a['minamt']['type'];
    }

    public function showdiscountAction(){
    	$this->view->pageid = "billing";
    }

	
	public function savediscountAction()
	{
		$list = App_Transaction_Type::getConstName();
		$this->view->typelist = $list;
		$fixedStr='';

		$sb_datefrom = $this->getRequest()->getParam('sb_datefrom');
		$sb_dateto = $this->getRequest()->getParam('sb_dateto');

		if(!$sb_datefrom or !$sb_dateto or strtotime($sb_datefrom) > strtotime($sb_dateto))
		{
			$this->redirect('showdiscount','billing','aw');
		}

		foreach($list as $id=>$data)
		{
			if($this->getRequest()->getParam($id.'_free') == 'Y'  or  ($this->getRequest()->getParam($id.'_free') == 'N' and $this->getRequest()->getParam($id.'_value') > 0))
			{
				$fixedStr .= $id.'-'.$this->getRequest()->getParam($id.'_free').'-'.$this->getRequest()->getParam($id.'_value').'|';
			}
		}

		$r=array();
		$r['category']=date("Ymd", strtotime($sb_datefrom)).'-'.date("Ymd", strtotime($sb_dateto)).' Special Billing';
		$r['datefrom']=$sb_datefrom;
		$r['dateto']=$sb_dateto;
		$r['value']=$fixedStr;
		//print_r($r); die();

		$this->saveWigiBillingSettings($r);
		$this->redirect('showdiscount','billing','aw');

	}


	public function discountstep2Action()
	{
    	$this->view->pageid = "billing";
		//$month = $this->getRequest()->getParam('month');
		$sb_datefrom = $this->getRequest()->getParam('sb_datefrom');
		$sb_dateto = $this->getRequest()->getParam('sb_dateto');

		$this->view->sb_datefrom = $sb_datefrom;
		$this->view->sb_dateto = $sb_dateto;
		$this->view->rec_datefrom=$sb_datefrom;
		$this->view->rec_dateto=$sb_dateto;

		$category_value='';
		$wigi_admin_settings_id='';
		$this->view->rec_found=0;

		if(!$sb_datefrom or !$sb_dateto)
		{
			$this->redirect('showdiscount','billing','aw');
		}


		$list = App_Transaction_Type::getConstName();
		$this->view->typelist = $list;

		$was = new App_WigiAdminSettings();
		$data = $was->getAdminBillingByDates($sb_datefrom, $sb_dateto);

		if (count($data)>0)
		{
			$category_value=$data[0]['value'];
			$this->view->rec_found=1;
			$this->view->rec_datefrom=$data[0]['datefrom'];
			$this->view->rec_dateto=$data[0]['dateto'];
		}

		
		//die();


		$this->view->wigi_special_billing = App_Transaction_WigiSpecialBilling::prepareDefaultsData($category_value);

	}



	public function savediscountActionOnMonth()
	{
		$list = App_Transaction_Type::getConstName();
		$this->view->typelist = $list;
		$fixedStr='';
		$month = $this->getRequest()->getParam('month');

		if(!$month)
		{
			$this->redirect('showdiscount','billing','aw');
		}

		foreach($list as $id=>$data)
		{
			if($this->getRequest()->getParam($id.'_free') == 'Y'  or  ($this->getRequest()->getParam($id.'_free') == 'N' and $this->getRequest()->getParam($id.'_value') > 0))
			{
				$fixedStr .= $id.'-'.$this->getRequest()->getParam($id.'_free').'-'.$this->getRequest()->getParam($id.'_value').'|';
			}
		}

		$r=array();
		$r['category']=$month.' special billing';
		$r['value']=$fixedStr;
		//print_r($r);
		//die();

		$this->saveWigiBillingSettings($r);
		$this->redirect('showdiscount','billing','aw');

	}



	public function discountstepOnMonth()
	{
		$month = $this->getRequest()->getParam('month');

		$list = App_Transaction_Type::getConstName();
		$this->view->typelist = $list;

		$was = new App_WigiAdminSettings();
		$data = $was->getAdminSetting();
		$this->view->month = $month;
		$category = $month.' special billing';
		$cid = str_replace(' ','_',$category);
		$category_value = '';

		if(isset($data[$cid]))
		{
			$category_value = $data[$cid];
			//echo "CATEGORY	 VALUE	|".$category_value;
		}

		$this->view->wigi_special_billing = App_Transaction_WigiSpecialBilling::prepareDefaultsData($category_value);
	}


    public function savefixedAction(){
    	$this->view->pageid = "billing";

		$list = App_Transaction_Type::getConstName();
		$this->view->typelist = $list;
		$fixedStr='';

		foreach($list as $id=>$data)
		{
			$fixedStr .= $id.'-'.$this->getRequest()->getParam($id.'_min').'-'.$this->getRequest()->getParam($id.'_def').'-'.$this->getRequest()->getParam($id.'_max').'|';
		}
		$r=array();
		$r['category']='wigi fixed billing';
		$r['value']=$fixedStr;
		$this->saveWigiBillingSettings($r);

		$this->redirect('home','billing','aw');
    }

    public function savepercentageAction(){
    	$this->view->pageid = "billing";

		$list = App_Transaction_Type::getConstName();
		$this->view->typelist = $list;
		$fixedStr='';

		foreach($list as $id=>$data)
		{
			$fixedStr .= $id.'-'.$this->getRequest()->getParam($id.'_min').'-'.$this->getRequest()->getParam($id.'_def').'-'.$this->getRequest()->getParam($id.'_max').'|';
		}
		$r=array();
		$r['category']='wigi percentage billing';
		$r['value']=$fixedStr;
		$this->saveWigiBillingSettings($r);

		$this->redirect('home','billing','aw');
    }

	/* Save Default Billing function */
    public function savedefaultsAction(){
    	$this->view->pageid = "billing";

		$list = App_Transaction_Type::getConstName();
		$this->view->typelist = $list;
		$fixedStr='';
		$min_amount_billing = $this->getRequest()->getParam('min_amount_billing');
		foreach($list as $id=>$data)
		{
			$fixedStr .= $id.'-'.$this->getRequest()->getParam($id.'_type').'|';
		}
		if($min_amount_billing){
			$fixedStr .= "minamt-".$min_amount_billing."|";
		}
		$r=array();
		$r['category']='wigi default billing';
		$r['value']=$fixedStr;
		$this->saveWigiBillingSettings($r);

		$this->redirect('home','billing','aw');
    }

	protected function saveWigiBillingSettings($a)
	{
		$this->updateWigiBillingSettings($a);
		$this->insertWigiBillingSettings($a);
	}


	protected function updateWigiBillingSettings($a)
	{
		$b['status']='I';
		$b['usermodified']=$this->ns->identity['userid'];
		$b['datemodified']=new Zend_Db_Expr('NOW()');

		$was = new App_WigiAdminSettings();
		$was->updateAdminSettings($b, $a['category']);
	}

	protected function insertWigiBillingSettings($a)
	{
		//print_r($this->ns->identity);
		$a['useradded']=$this->ns->identity['userid'];
		$a['datecreated']=new Zend_Db_Expr('NOW()');
		$a['status']='A';

		$was = new App_WigiAdminSettings();
		$was->insertAdminSettings($a);
		//print_r($a);
	}
	
}
