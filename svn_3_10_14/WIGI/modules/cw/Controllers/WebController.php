<?php

require_once 'ControllerAbstract.php';

class Cw_WebController extends Cw_ControllerAbstract {


    public function dispatch($action) {
        $isAllowed = true;
        //Place logic here if certain actions are to be disabled for the users based on some criteria. ( for future )
        if ($isAllowed) {
            parent::dispatch($action);
        } else {
            $this->_setResponseAccessNotAllowed();
        }
    }

    public function init() {
        parent::init();
        $action = $this->getRequest()->getActionName();
        $cntrl = $this->getRequest()->getControllerName();
        if($this->cfg->cw->disabled == 1 && $action != 'unavailable'){
            $this->_helper->redirector->goto('unavailable','index','cw');
            exit();
        }

		$this->checkAppMaintainence('cw');

		if ($this->freeEvent($cntrl.'/'.$action) == false ) {

            //  If user is not logged in set error and terminate application
            if (!$this->ns->logged_in  ) {
                #$this->_setResponseLoginRequired();
                $this->redirect('home','login','cw');
                exit();
            }

            if ($this->ns->login_type !== "consumer" ) {
                #$this->_setResponseLoginRequired();
                $this->ns->logged_in = false;
                $this->redirect('home','login','cw');
                exit();
            }

 
            //  Make sure device identifier matches the one used for login
            $helper = $this->getHelper('SessionHopping');
            /* @var $helper Helpers_SessionHopping */
            if (!$helper->isCorrectIdentifier()) {
                $helper->sendInvalidIdentifierNotification();
                $this->_setResponseInvalidDevice();
                exit();
            }

            $u = new App_User($this->ns->userid);
            if (!($u->isActive())) {
                $this->ns->logged_in = false;
                $this->redirect('home','login','mw');
                exit();
            }


            $this->reInitializeDbs($this->ns->userid);

            $this->initTplData();   

        }
    }

    
    public function initTplData() {
        $uid   = $this->ns->identity['userid'];
        $user  = new App_User($uid);
        $cells = $user->getFmtCellphones();

        $this->view->name      = $this->ns->identity['firstname'];
        $this->view->status    = strtoupper($this->ns->identity['status']);
        $this->view->usertype  = strtoupper($this->ns->identity['user_type']);
        $this->view->balance   = "₹".number_format($user->getBalance(), 2, '.', ',');
        $this->view->tbalance  = "₹".number_format($user->getTempBalance(), 2, '.', ',');
        $this->view->ccountry  = $user->getCountryCode();
        $this->view->usercells = $cells;
        
        $this->view->timezones = array('5.0' => '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent', '4.5' => '(GMT +4:30) Kabul', '4.0' => '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi', '3.5' => '(GMT +3:30) Tehran', '3.0' => '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg', '2.0' => '(GMT +2:00) Kaliningrad, South Africa', '1.0' => '(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris', '-12.0' => '(GMT -12:00) Eniwetok, Kwajalein', '-11.0' => '(GMT -11:00) Midway Island, Samoa', '-10.0' => '(GMT -10:00) Hawaii', '-9.0' => '(GMT -9:00) Alaska', '-8.0' => '(GMT -8:00) Pacific Time (US & Canada)', '-7.0' => '(GMT -7:00) Mountain Time (US & Canada)', '-6.0' => '(GMT -6:00) Central Time (US & Canada), Mexico City', '-5.0' => '(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima', '-4.5' => '(GMT -4:30) Caracas', '-4.0' => '(GMT -4:00) Atlantic Time (Canada), La Paz', '-3.5' => '(GMT -3:30) Newfoundland', '-3.0' => '(GMT -3:00) Brazil, Buenos Aires, Georgetown', '-2.0' => '(GMT -2:00) Mid-Atlantic', '-1.0' => '(GMT -1:00 hour) Azores, Cape Verde Islands', '0.0' => '(GMT) Western Europe Time, London, Lisbon, Casablanca', '5.5' => '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi', '5.75' => '(GMT +5:45) Kathmandu', '6.0' => '(GMT +6:00) Almaty, Dhaka, Colombo', '7.0' => '(GMT +7:00) Bangkok, Hanoi, Jakarta', '8.0' => '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong', '9.0' => '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk', '9.5' => '(GMT +9:30) Adelaide, Darwin', '10.0' => '(GMT +10:00) Eastern Australia, Guam, Vladivostok', '11.0' => '(GMT +11:00) Magadan, Solomon Islands, New Caledonia', '12.0' => '(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka');
    	
    	$this->view->beversion = App_DataUtils::getVersion();
    	
    }

    public function freeEvent($evt){
        $free = array(
            'misc/whatsmyip'                           => 1,
            'registration/home'                        => 1,
            'registration/register'                    => 1,
            'registration/resendcellphoneconfirmation' => 1,
            'registration/confirmcellphoneandsetosid'  => 1,
            'registration/getquestionfrompin'          => 1,
            'registration/getquestionfromosid'         => 1,
            'registration/verify'                      => 1,
            'registration/userexists'                  => 1,
            'registration/cellphoneexists'             => 1,
            'login/home'                               => 1,
            'login/auth'                               => 1,
            'login/sendtoken'                          => 1,
            'login/forgotpasswd'                       => 1,
            'login/lostcell'                           => 1,
            'login/loggedout'                          => 1,
            'index/unavailable'                        => 1,
            'misc/signupdirections'                    => 1,
            
            'usererror/usererror' => 1,
        );    
        return (isset( $free[$evt] )) ? true : false;
    }
    

    #Get Handles based on userid // for later optimization
    public function reInitializeDbs($userid){
        
    }
	public function getWigiUsersSettings($uid) 
	{
			$was = new App_WigiUsersSetting();
			$wigi_data = $was->getWebUsersSettings($uid);
			return $wigi_data;
	}
	public function insertWigiUsersSettings($a)
	{
		//print_r($this->ns->identity);
		$a['useradded']=$this->ns->identity['userid'];
		$a['datecreated']=new Zend_Db_Expr('NOW()');
		$a['status']='A';
		$was = new App_WigiUsersSetting();
		$was->insertUsersSettings($a);
	}
	public function updateWigiUsersSettings($a)
	{
		$b['status']='I';
		$b['usermodified']=$this->ns->identity['userid'];
		$b['datemodified']=new Zend_Db_Expr('NOW()');

		$was = new App_WigiUsersSetting();
		$was->updateUsersSettings($b, $a['category']);
	}
	
	public function getRoleUsers($uid,$rolename)
	{
		$edit_table = new App_Models_Db_Wigi_UserMobile();
		$res = $edit_table->select()->from($edit_table,array('mobile_id'))->where('user_id = ?',$uid)->where('role = ?',$rolename);
		$rows = $edit_table->fetchAll($res);
		$count = count($rows); 
		return $count;
	}
	
	
	public function getPermissionStringFromInputsUser()
	{
		$r=App_Perm::getUserWigiFeatures();
		$str='';

		foreach($r as $id=>$data)
		{
			$str.=$this->getRequest()->getParam($data['vname']);
			foreach($data['subcat'] as $id2=>$data2)
			{
				if($this->getRequest()->getParam($data2['vname']))
				{
					$str.=$this->getRequest()->getParam($data2['vname']);
				}else
				{
					$str.=0;
				}
			}
			$str.='|';
		}

		return $str;

	}
	public function getPermissionStringUser()
	{
		$r=App_Perm::getCellphonePermission();
		$str='';

		
		foreach($r as $id=>$data)
		{
				if($this->getRequest()->getParam($data['vname']) == 'on'){
					$str.= 1; 
				}else{
					$str.=0;
				}
			$str.='|';
		}
		return $str;

	}

}
?>
