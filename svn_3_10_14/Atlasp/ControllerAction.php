<?php
class Atlasp_ControllerAction extends Zend_Controller_Action
{
    public $db;
    private $begin;

    public function init() {
        $this->set_default_tpls();
        $log = Zend_Registry::get('log');
        $log->debug("Form Data :");

        foreach ($this->getRequest()->getParams() as $k => $v) {
               # $log->debug($k . '=' . $v);
        }

        error_log('Starting Request');
        $this->begin = Atlasp_Utils::inst()->startTimer();
    }

	protected function getCurrentMaintainence()
	{
        $cfg = Zend_Registry::get('config');
        $maintainence_file = $cfg->paths->systemmaintainence;
		$currMaintainence=array();

		if(file_exists($maintainence_file))
		{
			$curr_time = strtotime(date('m/d/Y H:i:s'));
			$handle = fopen($maintainence_file, 'r');
			$data = fread($handle,filesize($maintainence_file));		
			$mData = explode("\n",$data);

			foreach($mData as $id=>$rec)
			{
				if($rec)
				{
					$recData=explode("|",$rec);
					if((count($recData) > 6) and ($curr_time > $recData[7]) and ($curr_time < $recData[9]))
					{
						$currMaintainence[]=$recData;
					}
				}
			}
			fclose($handle);
		}

		return $currMaintainence;
	}


	protected function checkAppMaintainence($app)
	{
		$currMaintainence = $this->getCurrentMaintainence();

		foreach($currMaintainence as $id=>$recData)
		{
			if($recData[1]==$app)
			{
				$user_message = $recData[11];
				$schedule_action = $recData[5];
				$sdate = date("m/d/Y h:i:s A T",$recData[7]);
				$edate = date("m/d/Y h:i:s A T",$recData[9]);
				$user_message.= '<br/>Our System would not be available from '.$sdate.' until '.$edate.'. <br/> We apologize for the inconvinience.';
				$this->view->user_message = $user_message;
				$action = $this->getRequest()->getActionName();
		        $controller = $this->getRequest()->getControllerName();
				if($schedule_action == 'ALL_OUT' and $action != 'unavailable'){
					$this->redirect('unavailable','index',$app);
				}
				if($schedule_action == 'NO_NEW' and $controller == 'login'){
					$this->redirect('unavailable','index',$app);
				}
			}
		}
	}

    public function set_default_tpls()
    {
        $cfg = Zend_Registry::get('config');
        $this->view->jspath   = $cfg->paths->js;
        $this->view->dbbackuppath = $cfg->paths->dbbackup;
        $this->view->csspath  = $cfg->paths->css;
        $this->view->imgpath  = $cfg->paths->images;
        $this->view->htmlpath = $cfg->paths->html;
        $this->view->orig_basehref = $cfg->paths->basehref;
        $this->view->basehref = $cfg->paths->basehref;
        $this->view->web_version = $cfg->web->version;
        $this->view->be_version = $cfg->be->version;
    }

    public function preDispatch()
    {
        $m = __METHOD__ . '(): ';
        $appName = strtolower(Zend_Registry::get('name'));
        $ns = new Zend_Session_Namespace($appName);

        if (isset($ns->logged_in) && ($ns->logged_in === 1)) {
            $request = $this->getRequest();
	    /*
            $ssModel = new Models_Db_Session_State();

            switch($ssModel->userSessionState($request))
            {
                case Models_Db_Session_State::LOGOUT_USER:
                    Zend_Registry::get('log')->debug($m . '*** LOGGING USER OUT');
                    $ns->logged_in = 0;
                    $this->_helper->redirector('logout', 'login');
                    break;
                case Models_Db_Session_State::REVALIDATE_PASSWORD:
                    Zend_Registry::get('log')->debug($m . 'REVALIDATE PASSWORD');
                    $this->_helper->redirector('pwform', 'login');
                    break;
                case Models_Db_Session_State::REGENERATE_SESSION_ID: 
                    $ssModel->generateNewSessionId();
                    break;                            
            }                                         
            */                                          
            $ns->pageAccessTime = time();             
        }                                             
                                                      
        parent::preDispatch();                        
    } 

    public function postDispatch()
    {
        $str='Times:SID|'. Zend_Session::getId().'|';

        $s = new Zend_Session_Namespace( strtolower( Zend_Registry::get('name')) );
        if(isset($s->identity->loginid)){
           $str.='LOGINID|'.$s->identity->loginid.'|';
        }

        foreach(Zend_Registry::get('times') as $k => $v){
           $str.=$k.'|'.$v.'|';
        }

        $t = Atlasp_Utils::inst()->endTimer($this->begin);
        $str.='total|'.$t.'|';
        //error_log($str);
        parent::postDispatch();
    }


    public function redirect($action, $controller = null, $module = null, array $params=array()) {
        if (is_array($action)) {
            error_log('Redirecting to: ' . $action['url']);
            $this->printTimings();
            $this->_helper->redirector->gotoUrl($action['url']);
        } else {
            $cfg = Zend_Registry::get('config');
            $url = $cfg->paths->formbase . $module. '/'.$controller . '/' . $action;
            error_log('Redirecting to: ' . $url);
            $this->printTimings();
            $this->_helper->redirector->goto($action, $controller, $module, $params);
        }
    }
    
    public function printTimings(){
        
    }

}
