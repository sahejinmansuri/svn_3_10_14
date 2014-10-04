<?php
include(__DIR__ . '/WebController.php');

class Aw_LoginController extends Aw_WebController {
	
    public function homeAction(){
        
    }
    
    public function forgotpasswdAction(){
    	
    }
    
    public function lostcellAction(){
    	
    }

	public function authAction(){
        $login = new App_Login_Aw();
        $stat  = $login->doLogin(array('LOGIN'=>$this->getRequest()->getParam('LOGIN'), 'PASSWD'=>$this->getRequest()->getParam('PASSWD'), 'CODE' => $this->getRequest()->getParam('CODE')));    

        $stat = Atlasp_App_Login::RESULT_SUCCESS;
        error_log("got status as ". $stat);
        
        $result = array('status' => 0);
        if($stat == Atlasp_App_Login::RESULT_SUCCESS){
            $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
            $idm = $login->getIdentity();
            $ns->userid    = $idm['userid'];
            $ns->role_name    = $idm['permissions'];
            $ns->email     = $this->getRequest()->getParam('LOGIN');
            $ns->loginid   = $this->getRequest()->getParam('LOGIN');
            $ns->logged_in = 1;
            //$p = new App_Prefs($ns->userid);
            //$ns->prefs = $p->getPrefs("aw");
            $login->createSession();

            //$this->createUserPermissions();
            error_log("Login Success.. redirecting to dashboard");
            #$this->redirect('home','dashboard','aw');
            $result['status']=1;
            
        }else{
            error_log("Login Failed.. redirecting to login page");
            #$this->redirect('home','login','aw');
        }
        
        $this->_response->setHeader('Content-type', 'application/json');
        $this->getHelper('ViewRenderer')->setNoRender();
        print Zend_Json::encode($result);

    }
    
	protected function createUserPermissions()
	{
        error_log("Setting User Permissions");
		// Get the role of the user
		$role_name = $this->ns->role_name;
		$role_name=str_replace(" ","_",$role_name);
        error_log("Role of the user	".$role_name);
		// Get wigi admin settings
		$wigi_admin_settings = $this->getWigiAdminSettings();
		$existing_roles = App_Perm::prepareRolesData($wigi_admin_settings);
		$userPermissions = $existing_roles[$role_name];
		print_r($existing_roles);
		die();
	}


    public function loggedoutAction(){
    	
    }
    
}
