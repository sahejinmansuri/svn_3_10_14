<?php
class Atlasp_Models_Db_Session_State extends Atlasp_Models_Db_Session
{
    const REVALIDATE_PASSWORD   = 1;
    const LOGOUT_USER           = 2;
    const REGENERATE_SESSION_ID = 3;
    const NO_IDENTITY           = 4;

    public function userSessionState(Zend_Controller_Request_Http $request)
    {
        $sessionState = false;
        $appName = strtolower(Zend_Registry::get('name'));
        $ns = new Zend_Session_Namespace($appName);

        if (!isset($ns->identity)) {
            return self::NO_IDENTITY;
        }

        $cfg = Zend_Registry::get('config');
        $regenerateTime = $cfg->session->regenerateTime;
        $idleTime       = $cfg->session->idleTime;
        $logoutTime     = $cfg->session->logoutTime;
        $elapsedTime    = $this->_getElapsedTime($ns->pageAccessTime);

        if ($elapsedTime >= $logoutTime) {
            $sessionState = self::LOGOUT_USER;
        } elseif ($elapsedTime >= $idleTime) {
            $sessionState = self::REVALIDATE_PASSWORD;
            $this->_maintainUserState($request);
        } else {
            $elapsedTime = $this->_getElapsedTime($ns->timestamp);

            if ($elapsedTime >= $regenerateTime) {
                $sessionState = self::REGENERATE_SESSION_ID;
            }
        }
 
        return $sessionState;
    }

    public function generateNewSessionId()
    {
        Zend_Registry::get('log')->debug(__METHOD__ . '(): Generating new session id.');
        $appName = strtolower(Zend_Registry::get('name'));
        $ns = new Zend_Session_Namespace($appName);
        $idt = $ns->identity;
        $this->regenerateSessionId($idt->loginid);
        $ns->timestamp = time();
    }

    protected function _getElapsedTime($checkTime)
    {
        if (!isset($checkTime)) {
            return -1;
        }

        $et = ceil( (time() - $checkTime) / 60 );
        return $et;
    }

    protected function _maintainUserState(Zend_Controller_Request_Http $request)
    {
        $appName = strtolower(Zend_Registry::get('name'));
        $ns = new Zend_Session_Namespace($appName);
        $ns->revalidatePassword = 1;
        $ns->logged_in          = 0;
        $ns->pageAccessTime     = time();
        $ns->activeController   = $request->getControllerName();
        $ns->activeAction       = $request->getActionName();
        $ns->activePost         = $request->getPost();
        $ns->activeGet          = $request->getQuery();

        Zend_Registry::get('log')->debug("-----[ User State ]---------------------");
        Zend_Registry::get('log')->debug("Controller: {$ns->activeController}");
        Zend_Registry::get('log')->debug("Action:     {$ns->activeAction}");
        Zend_Registry::get('log')->debug("Post:       " . serialize($ns->activePost));
        Zend_Registry::get('log')->debug("Get:        " . serialize($ns->activeGet));
        Zend_Registry::get('log')->debug("----------------------------------------");
    }

    public function resetUserState(Zend_Controller_Request_Http $request)
    {
        $appName = strtolower(Zend_Registry::get('name'));
        $ns = new Zend_Session_Namespace($appName);
        $ns->logged_in      = 1;
        $previousController = $ns->activeController;
        $previousAction     = $ns->activeAction;
        $activePost         = $ns->activePost;
        $activeGet          = $ns->activeGet;
        $idt                = $ns->identity;

        if (!empty($activePost) && is_array($activePost)) {
            foreach($activePost as $param => $value) {
                $request->setPost($param, $value);
            }
        }

        if (!empty($activeGet) && is_array($activeGet)) {
            foreach($activeGet as $param => $value) {
                $request->setParam($param, $value);
            }
        }

        $this->_clearUserState();
  
        $smodel = new Atlasp_Models_Db_Session();
        $smodel->regenerateSessionId($idt->loginid);

        $request->setControllerName($previousController);
        $request->setActionName($previousAction);
    }

    protected function _clearUserState()
    {
        $appName = strtolower(Zend_Registry::get('name'));
        $ns = $ns = new Zend_Session_Namespace($appName);

        unset($ns->revalidatePassword);    
        unset($ns->activeController);    
        unset($ns->activeAction);    
        unset($ns->activePost);    
        unset($ns->activeGet);    
    }

    public function revalidateUser(Zend_Controller_Request_Http $request)
    {
        $m = __METHOD__ . '(): ';
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        $revalidateUser = false; 

        $cfg = Zend_Registry::get('config');
        $revalController = $cfg->session->revalidateController;
        $revalAction = $cfg->session->revalidateAction;
 
        $appName = strtolower(Zend_Registry::get('name'));
        $ns = new Zend_Session_Namespace($appName);
        
        if ((isset($ns->revalidatePassword) && ($ns->revalidatePassword == 1)) &&
            (($controller != $revalController) && ($action != $revalAction))
        ) { 
            $revalidateUser = true;
            Zend_Registry::get('log')->info($m . 'User needs to revalidate password.');
        }   
        
        return $revalidateUser;
    }  
}
