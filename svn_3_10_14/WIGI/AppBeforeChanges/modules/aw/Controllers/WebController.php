<?php

require_once 'ControllerAbstract.php';

class Aw_WebController extends Aw_ControllerAbstract {


    public function dispatch($action) {
        $isAllowed = true;
        //Place logic here if certain actions are to be disabled for the users based on some criteria. ( for future )
		$this->setSecurityTplVars();
		$this->initTPLVars();

        if ($isAllowed) {
            parent::dispatch($action);
        } else {
            $this->_setResponseAccessNotAllowed();
        }
    }


    protected function initTPLVars()
    {
	$cntrl = $this->getRequest()->getControllerName();
        $this->view->pageid=$cntrl;
		//print_r($this->ns->identity);exit;
		// Set up user info in view
        $this->view->login_id      = $this->ns->identity['loginid'];
        $this->view->first_name    = $this->ns->identity['first_name'];
        $this->view->last_name     = $this->ns->identity['last_name'];
        $this->view->last_login_date = $this->ns->identity['last_login_date'];
        $this->view->last_login_ip = $this->ns->identity['last_login_ip'];
    }

	/*protected function checkSystemMaintainence()
	{
		$maintainence = new App_WigiSystemMaintainence();
		$has_maintainence = $maintainence->getMaintainenceInfo('aw');
		if(count($has_maintainence)>0)
		{
			$user_message = $has_maintainence[0]['user_message'];
			$user_message.= '<br/>Our System would not be available from '.$has_maintainence[0]['start_time'].' until '.$has_maintainence[0]['end_time'].'. <br/> We apologize for the inconvinience.';
			$this->view->user_message = $user_message;
			$action = $this->getRequest()->getActionName();
			if($action != 'unavailable'){
				$this->redirect('unavailable','index','aw');
			}
		}
	}*/

    public function init() {
        parent::init();
        $action = $this->getRequest()->getActionName();
        $cntrl = $this->getRequest()->getControllerName();

		if($this->cfg->aw->disabled == 1 && $action != 'unavailable'){
            $this->_helper->redirector->goto('unavailable','index','aw');
            exit();
        }

		if ($this->freeEvent($cntrl.'/'.$action) == false ) {
			//  If user is not logged in set error and terminate application
            if (!$this->ns->logged_in  ) {
                #$this->_setResponseLoginRequired();
                $this->redirect('home','login','aw');
                exit();
            }

            /*if ($this->ns->login_type !== "admin" ) {
                #$this->_setResponseLoginRequired();
                $this->ns->logged_in = false;
                $this->redirect('home','login','aw');
                exit();
            }*/
 
            //  Make sure device identifier matches the one used for login
            $helper = $this->getHelper('SessionHopping');
            
            if (!$helper->isCorrectIdentifier()) {
                $helper->sendInvalidIdentifierNotification();
                $this->_setResponseInvalidDevice();
                exit();
            }

            $this->reInitializeDbs($this->ns->userid);

            //$this->initTplData();   

        }
    }

    
    public function initTplData() {
        $uid   = $this->ns->identity['userid'];
       // $user  = new App_User($uid);
        $user = new App_AdminUser($uid);
       // $cells = $user->getFmtCellphones();

        //$this->view->name      = $this->ns->identity['firstname'];
        //$this->view->status    = strtoupper($this->ns->identity['status']);
        //$this->view->usertype  = strtoupper($this->ns->identity['user_type']);
        //$this->view->balance   = "US$".number_format($user->getBalance(), 2, '.', ',');
        //$this->view->tbalance  = "US$".number_format($user->getTempBalance(), 2, '.', ',');
        //$this->view->ccountry  = $user->getCountryCode();
        //$this->view->usercells = $cells;
        
        //$this->view->timezones = array('5.0' => '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent', '4.5' => '(GMT +4:30) Kabul', '4.0' => '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi', '3.5' => '(GMT +3:30) Tehran', '3.0' => '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg', '2.0' => '(GMT +2:00) Kaliningrad, South Africa', '1.0' => '(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris', '-12.0' => '(GMT -12:00) Eniwetok, Kwajalein', '-11.0' => '(GMT -11:00) Midway Island, Samoa', '-10.0' => '(GMT -10:00) Hawaii', '-9.0' => '(GMT -9:00) Alaska', '-8.0' => '(GMT -8:00) Pacific Time (US & Canada)', '-7.0' => '(GMT -7:00) Mountain Time (US & Canada)', '-6.0' => '(GMT -6:00) Central Time (US & Canada), Mexico City', '-5.0' => '(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima', '-4.5' => '(GMT -4:30) Caracas', '-4.0' => '(GMT -4:00) Atlantic Time (Canada), La Paz', '-3.5' => '(GMT -3:30) Newfoundland', '-3.0' => '(GMT -3:00) Brazil, Buenos Aires, Georgetown', '-2.0' => '(GMT -2:00) Mid-Atlantic', '-1.0' => '(GMT -1:00 hour) Azores, Cape Verde Islands', '0.0' => '(GMT) Western Europe Time, London, Lisbon, Casablanca', '5.5' => '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi', '5.75' => '(GMT +5:45) Kathmandu', '6.0' => '(GMT +6:00) Almaty, Dhaka, Colombo', '7.0' => '(GMT +7:00) Bangkok, Hanoi, Jakarta', '8.0' => '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong', '9.0' => '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk', '9.5' => '(GMT +9:30) Adelaide, Darwin', '10.0' => '(GMT +10:00) Eastern Australia, Guam, Vladivostok', '11.0' => '(GMT +11:00) Magadan, Solomon Islands, New Caledonia', '12.0' => '(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka');
    }

	public function setSecurityTplVars()
	{
		if(!isset($this->ns->identity))
		{
			return 1;
		}

		$this->checkEventSecurity();

		$this->view->is_admin = $this->ns->identity['admin'];
		//echo "SETTING TPL VARS NOW";
		$perm = $this->ns->permissions;
		foreach($perm as $id=>$data)
		{
			$this->view->$data['vname'] = $data['is_enabled'];

			foreach($data['subcat'] as $id2=>$data2)
			{
				$this->view->$data2['vname'] = $data2['is_enabled'];
			}
		}
	}

	public function checkEventSecurity()
	{
		// Bypass these checks for Wigi Admin
		if($this->ns->identity['admin'])
		{
			return 1;
		}

		$defaultIndex='NA';

		$action = $this->getRequest()->getActionName();
		$cntrl = $this->getRequest()->getControllerName();

		$perm = $this->ns->permissions;
		$controllerEvts = App_Perm::getControllerSecurity();

		$cntrlIndex = isset($controllerEvts[$cntrl]['index'])?$controllerEvts[$cntrl]['index']:$defaultIndex;
		$actionIndex = isset($controllerEvts[$cntrl]['subcat'][$action])?$controllerEvts[$cntrl]['subcat'][$action]:$defaultIndex;

		/*echo "CONTR	".$cntrl."\n";
		print_r($controllerEvts);
		echo "\n ".$cntrl."	| 111111111111	|".$cntrlIndex;
		echo "\n 222222222222	|".$actionIndex;
		die();*/

		// Check if the controller is enabled
		if(($cntrlIndex != $defaultIndex) and !$perm[$cntrlIndex]['is_enabled'])
		{
			echo "This Controller/Module is disabled for the User";
			$this->redirect('home','login','aw');
		}


		// Check the event now
		if(($actionIndex != $defaultIndex) and !$perm[$cntrlIndex]['subcat'][$actionIndex]['is_enabled'])
		{
			$this->redirect('home',$cntrl,'aw');
		}		
	}


    public function freeEvent($evt){
        $free = array(
            'misc/whatsmyip'                           => 1,
            'login/home'                               => 1,
            'login/auth'                               => 1,
            'login/sendtoken'                          => 1,
            'login/forgotpasswd'                       => 1,
            'login/lostcell'                           => 1,
            'login/loggedout'                          => 1,
            'index/unavailable'                        => 1,
        );    
        return (isset( $free[$evt] )) ? true : false;
    }
    

    #Get Handles based on userid // for later optimization
    public function reInitializeDbs($userid){
        
    }

	/* Added it here since Wigi admin settings would be needed in almost every controller */
	public function getWigiAdminSettings()
	{
			$was = new App_WigiAdminSettings();
			$wigi_data = $was->getAdminSetting();
			return $wigi_data;
	}


}
