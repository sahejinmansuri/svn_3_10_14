<?php

require_once 'ControllerAbstract.php';

class Mobws_RestController extends Mobws_ControllerAbstract {


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
		//echo Zend_Session::getId();
	   
		foreach($_POST as $k =>$v){
            //error_log("Input $k => $v");
        }
        //  Set Response Headers
        $this->_response->setHeader('Content-type', 'application/json');
        $this->getHelper('ViewRenderer')->setNoRender();
        
        if($this->cfg->mobws->disabled == 1){
            $this->_setResponseSiteDown();
            exit();
        }

	    // REST NON-Authentication
        $action = $this->getRequest()->getActionName();
		$cntrl = $this->getRequest()->getControllerName();
		
		
		//application timeout code start
		$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
		
		$inactive = $ns->prefs["system"]['timeout'];
		$new_time = time() + $inactive;
		
		$ulog = new App_Models_Db_Wigi_UserAppLog();
		
		if(($ns->userid != "")){
			$userid = $ns->userid;
		}else{
			$userid = $this->ns->userid;
		}
		if(($ns->mobileid != "")){
			$mobileid = $ns->mobileid;
		}else{
			$mobileid = $this->ns->mobileid;
		}
		
		$new_time = $new_time + 25; 
		//error_log("===================================1".$cntrl."===2".$action);
		
		/*if(($action != 'consolidatedauth') && ($action != 'forgotpin') && ($action != 'getquestion') && ($action != 'getdocument') && ($action != 'adddocument') && ($action != 'updatedocument') && ($action != 'getdocuments')&& ($action != 'getdocumentdata') && ($action != 'editprofile')){ */
		
		/*if(($action != 'consolidatedauth') && ($action != 'forgotpin') && ($action != 'getquestion') && ($cntrl != 'wigi') && ($action != 'editprofile') && ($action != 'getscheduleddonations')){ 
			if(isset($mobileid)){
				$fetch = $ulog->fetchRow($ulog->select()->where('mobile_id = ?', $mobileid));
				$timelimit_id = $fetch['log_id'];
				$timelimit_timelimit = $fetch['timelimit'];
				
				if(isset($timelimit_timelimit)){
					if($timelimit_timelimit < time()){
						Zend_Session::destroy();
						$this->_setResponseLoginRequired();
						exit();
					}
				}
				
				if(isset($timelimit_timelimit)){
					$uinfof = $ulog->update(
						array(
							'timelimit' => $new_time,
						),
						$ulog->getAdapter()->quoteInto('log_id = ?', $timelimit_id)
					);
				}else{
					if($mobileid != ""){
						$keyval = array(
						   'timelimit'  => $new_time,
						   'mobile_id' 	=> $mobileid,
						   'user_id'    => $userid,
						);
						$ulog->insert($keyval);
					}
				}
			}
			else{
				Zend_Session::destroy();
				$this->_setResponseLoginRequired();
				exit();
			}
		}*/
		
		//application timeout code finish
		
        if ($this->freeEvent($cntrl.'/'.$action) == false ) {

            //  If user is not logged in set error and terminate application
            if (!$this->ns->logged_in ) {
                $this->_setResponseLoginRequired();
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

            /*$u = new App_User($this->ns->userid);
            if (!($u->isActive())) {
                $this->_setResponseLoginRequired();
                exit();
            }*/


            $c = new App_Cellphone($this->ns->mobileid);
            if (!($c->isActive())) {
                $this->_setResponseLoginRequired();
                exit();
            }

            $this->reInitializeDbs( $this->ns->userid);

        }
    }

    /**
     * Destroy session
     */
    public function logoutAction()
    {
        // Logout and destroy session
        $this->login->logout();
        Zend_Session::destroy();
        
        // Set response
        $response = new App_Ws_Types_Response();
        $response->setCount(1);
        $response->setResult(array('success' =>  (int)Zend_Session::isDestroyed()));  
        
        // Send the response
        $this->_response->setBody($response->toJson());
        $this->_response->sendResponse();
        exit();
    }



    /**
     * 
     * This method handles all REST responses.
     */
    protected function sendResponse($r, $inputParams=array()) {
        
        $request = $this->getRequest();
	    $json = Zend_Json::encode($r);
        $this->_response->setBody($json);
    }

    /**
     * 
     * This method generates a checksum based on the URL parameters passed.
     * 
     * @param Zend_Controller_Request_Abstract $request Request object
     * @param array $cacheParams Parameter names
     * @return string md5-checksum
     */
    protected function generateCacheCheckSum($cacheParams)
    {
        $request = $this->getRequest();
        $cacheParams = array_merge( $cacheParams, array($request->getControllerKey(), $request->getActionKey()));
        asort($cacheParams);
        $arr = array();
        foreach ($cacheParams as $key) {
            $arr[] = $key . '=' . $request->getParam($key);
        }
        return md5(strtolower(implode('&', $arr))); // md5 of key1=val1&key2=val2
    }
    
    public function freeEvent($evt){
        $free = array(
            'misc/whatsmyip'                           => 1,
            'registration/register'                    => 1,
            'registration/resendcellphoneconfirmation' => 1,
            'registration/confirmcellphoneandsetosid'  => 1,
            'registration/getquestionfrompin'          => 1,
            'registration/getquestionfromosid'         => 1,
            'registration/getquestion'                 => 1,
            'registration/forgotpin'                   => 1,
            'registration/setosid'                     => 1,
            'registration/sendtos'                     => 1,
			'registration/getcurrenttos'           	   => 1,
            'registration/confirmcellphone'            => 1,
            'registration/checkcellphone'              => 1,
            'registration/checkloginid'                => 1,
            'registration/getquestions'                => 1,
            'registration/checkanswer'                => 1,
            'auth/auth'                                => 1,
            'auth/auth1'                               => 1,
            'auth/consolidatedauth'                    => 1,
			'auth/settosandauth'                       => 1,
			'auth/profile'                       	   => 1,
			'wigi/addcreditcard'                       => 1,
			'wigi/addbankaccount'                      => 1,
            'wigi/fromcreditcardtowigi'                => 1,
            'wigi/fromwigitocreditcard'                => 1,
            'wigi/frombankaccounttowigi'               => 1,
            'wigi/fromwigitobankaccount'               => 1,
            'wigi/testcreditcard'                      => 1,
            'wigi/testbankaccount'                     => 1,
            'wigi/creditcardsale'                      => 1,
            'wigi/adddocument'                         => 1,
            'wigi/getdocument'                         => 1,
            'wigi/getdocumentdata'                     => 1,
            'wigi/updatedocument'                      => 1,
            'wigi/getcreditcardconfnumber'             => 1,
            'wigi/getbankaccountconfnumber'            => 1,
			'cellphone/getdocuments'                   => 1,
            'cellphone/addcell'                        => 1,
            'cellphone/deletecell'                     => 1,
            'cellphone/editquestion'                   => 1,
            'cellphone/editpassword'                   => 1,
            'cellphone/viewquestion'                   => 1,
            'cellphone/editprofile'                    => 1,
            'cellphone/updateprofile'                    => 1,
			'cellphone/getcellphones'                  => 1,
			'cellphone/editcell'   	                   => 1,
			'cellphone/getstatement'   	               => 1,
			'cellphone/updatedonation'                 => 1,
			'cellphone/viewstatement'   	           => 1,
			'cellphone/userstatement'   		       => 1,
			'cellphone/downloadstatement'   	       => 1,
			'cellphone/downloaddocument'   		       => 1,
			'cellphone/emailstatement'  	 	       => 1,
			'cellphone/emailuserstatement'   	       => 1,
			'cellphone/getallaccounts'   	       	   => 1,
			'cellphone/selffund'   	     		  	   => 1,
			'cellphone/banktransfer'   	     	  	   => 1,
            'cellphone/applicationsession'             => 1,
			'cellphone/getscheduleddonations'          => 1,
			'cellphone/gethistory'  			       => 1,
			'cellphone/emaildocument'  			       => 1,
			'cellphone/isdefaultcell'  			       => 1,
			'cellphone/getmerchantdetail' 		       => 1,
			'cellphone/addrole'  			       	   => 1,
			'cellphone/getallrole'  		       	   => 1,
			'cellphone/getrole'  		       	   	   => 1,
			'cellphone/editrole'  		       	   	   => 1,
			'cellphone/deleterole'  		       	   => 1,
			'cellphone/assignrole'  		       	   => 1,
			'cellphone/movefunds'	  		       	   => 1,
			'cellphone/celldetail'	  		       	   => 1,
			'cellphone/qrcodetest'	  		       	   => 1,
			'cellphone/scanpay'		  		       	   => 1,
			'cellphone/scandonatedecode'	      	   => 1,
			'cellphone/scangiftdecode'	 	     	   => 1,
			'cellphone/scanbuydecode'	 	     	   => 1,
			'cellphone/scanpaydecode'		      	   => 1,
			'cellphone/scandonate'	  		    	   => 1,
			'cellphone/donatemoney'		  	       	   => 1,
            'misc/test'                                => 1,
            'misc/version'                             => 1,
            'test/testlock'                            => 1,
            'zip/getstatefromzip'                      => 1,
            'index/index'                              => 1,
            'cellphone/processtxt'                     => 1,
            'registration/passwordstrength'            => 1
        );
        return (isset( $free[$evt] ))?true:false;
    }
    

    #Get Handles based on userid // for later optimization
    public function reInitializeDbs($userid){
        
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
				if($this->getRequest()->getParam($data['vname']))
				{
					$str.= $this->getRequest()->getParam($data['vname']); 
				}else
				{
					$str.=0;
				}
			$str.='|';
		}
		return $str;

	}
	public function insertWigiUsersSettings($a,$uid)
	{
		//print_r($this->ns->identity);
		$a['useradded']=$uid;
		$a['datecreated']=new Zend_Db_Expr('NOW()');
		$a['status']='A';
		$was = new App_WigiUsersSetting();
		$was->insertUsersSettings($a);
	}
	public function updateWigiUsersSettings($a,$uid)
	{
		$b['status']='I';
		$b['usermodified']=$uid;
		$b['datemodified']=new Zend_Db_Expr('NOW()');

		$was = new App_WigiUsersSetting();
		$was->updateUsersSettings($b, $a['category']);
	}
	public function getRoleUsers($uid,$rolename)
	{
		$edit_table = new App_Models_Db_Wigi_UserMobile();
		$res = $edit_table->select()->from($edit_table,array('mobile_id'))->where('user_id = ?',$uid)->where('role = ?',$rolename)->where('status != ?','deleted');
		$rows = $edit_table->fetchAll($res);
		$count = count($rows); 
		return $count;
	}
	public function checkpermission($mobile_id,$user_id="",$permission)
	{
		$cell = new App_Cellphone($mobile_id);
		if($user_id == ""){
			$user_id = $cell->getUserId();
		}
		$user = new App_User($user_id);
		$res = $user->getUserCellphones();
		$result_cell = array();
		$result = array();
		$flag = 0;
		foreach($res as $key=>$val){
			if($val['is_default'] == 1){
				if($val['mobile_id'] == $mobile_id){
					$flag = 1;
				}
			}
		}
		if($flag == 0){
			$role = $cell->getRole();
			if($role != ""){
				$was = new App_WigiUsersSetting();
				$wigi_admin_settings = $was->getMobwsUsersSettings($user_id);
				$user_role_name = "User Roles ".$role;
				foreach($wigi_admin_settings as $key=>$val){
					if($val['rolename'] == $user_role_name){
						$permission_check = $val['value'];
					}
				}
				$permission_check_arr = explode('|',$permission_check);
				
				if($permission_check_arr[$permission] == 0){
					$flag_permission = 0;
				}else{
					return true;
				}
			}else{
				$flag_permission = 0;
			}
			if($flag_permission == 0){
				throw new App_Exception_WsException('You Do not have permission');
                return false;
			}
		}else{
			return true;
		}
		
	}
	public function getpermission($mobile_id,$user_id="")
	{
		$cell = new App_Cellphone($mobile_id);
		if($user_id == ""){
			$user_id = $cell->getUserId();
		}
		$user = new App_User($user_id);
		$res = $user->getUserCellphones();
		$result_cell = array();
		$result = array();
		$flag = 0;
		foreach($res as $key=>$val){
			if($val['is_default'] == 1){
				if($val['mobile_id'] == $mobile_id){
					$flag = 1;
				}
			}
		}
		if($flag == 0){
			$role = $cell->getRole();
			if($role != ""){
				$was = new App_WigiUsersSetting();
				$wigi_admin_settings = $was->getMobwsUsersSettings($user_id);
				$user_role_name = "User Roles ".$role;
				foreach($wigi_admin_settings as $key=>$val){
					if($val['rolename'] == $user_role_name){
						$permission_check = $val['value'];
					}
				}
				return $permission_check;
			}else{
				return "0|0|0|0|0|0|0|";
			}
		}else{
			return "1|1|1|1|1|1|1|";
		}
		
	}
	

}
