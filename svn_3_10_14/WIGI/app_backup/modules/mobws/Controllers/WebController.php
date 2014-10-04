<?php

require_once 'WebControllerAbstract.php';

class Mobws_WebController extends Mobws_WebControllerAbstract {


    public function dispatch($action) {
        $isAllowed = true;
        //Place logic here if certain actions are to be disabled for the users based on some criteria. ( for future )
        if ($isAllowed) {
            parent::dispatch($action);
        } else {
            $this->_setResponseAccessNotAllowed();
        }
    }

	protected function checkSystemMaintainence()
	{
		$maintainence = new App_WigiSystemMaintainence();
		$has_maintainence = $maintainence->getMaintainenceInfo('mo');
		if(count($has_maintainence)>0)
		{
			$user_message = $has_maintainence[0]['user_message'];
			$user_message.= '<br/>Our System would not be available from '.$has_maintainence[0]['start_time'].' until '.$has_maintainence[0]['end_time'].'. <br/> We apologize for the inconvinience.';
			$this->view->user_message = $user_message;
			$action = $this->getRequest()->getActionName();
			if($action != 'unavailable'){
				$this->redirect('unavailable','index','mo');
			}
		}
	}

    public function init() {
        parent::init();
        $action = $this->getRequest()->getActionName();
        $cntrl = $this->getRequest()->getControllerName();

		$this->checkSystemMaintainence();

        /*if($this->cfg->cw->disabled == 1 && $action != 'unavailable'){
            $this->_helper->redirector->goto('unavailable','index','cw');
            exit();
        }*/

        if ($this->freeEvent($cntrl.'/'.$action) == false ) {
            //  If user is not logged in set error and terminate application
            $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
            if (!$ns->logged_in  ) {
                #$this->_setResponseLoginRequired();
                $this->redirect('home','login','cw');
                exit();
            }

            /*if ($this->ns->login_type !== "consumer" ) {
                #$this->_setResponseLoginRequired();
                $this->ns->logged_in = false;
                $this->redirect('home','login','cw');
                exit();
            }*/

 
            //  Make sure device identifier matches the one used for login
            $helper = $this->getHelper('SessionHopping');
            /* @var $helper Helpers_SessionHopping */
            if (!$helper->isCorrectIdentifier()) {
                $helper->sendInvalidIdentifierNotification();
                $this->_setResponseInvalidDevice();
                exit();
            }

            $this->reInitializeDbs($ns->userid);


        }
    }

    
    public function freeEvent($evt){
        $free = array(
            'misc/whatsmyip'                           => 1,
            
            'usererror/usererror' => 1,
        );    
        return (isset( $free[$evt] )) ? true : false;
    }
    

    #Get Handles based on userid // for later optimization
    public function reInitializeDbs($userid){
        
    }

}
?>
