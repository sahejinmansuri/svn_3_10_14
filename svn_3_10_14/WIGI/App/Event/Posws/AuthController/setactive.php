<?php

class App_Event_Posws_AuthController_setactive extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'LOGIN' => array('generic', 50, 0, App_Constants::getFormLabel('LOGIN')),
                'PASSWD' => array('generic', 50, 0, App_Constants::getFormLabel('PASSWD')),
                'SECRET' => array('generic', 50, 0, App_Constants::getFormLabel('SECRET')),
                'IDENTIFIER' => array('generic', 50, 0, App_Constants::getFormLabel('IDENTIFIER')),
                'MERCHANTID' => array('generic', 50, 0, App_Constants::getFormLabel('MERCHANTID')),
                'DESCRIPTION' => array('generic', 50, 0, App_Constants::getFormLabel('DESCRIPTION')),

            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(){

    App_DataUtils::beginTransaction();

    $loginid          = $this->_request->getParam("LOGIN");
    $passwd           = $this->_request->getParam('PASSWD');
    $secret           = $this->_request->getParam('SECRET');
    $osid             = $this->_request->getParam('IDENTIFIER');
    $merchantid       = $this->_request->getParam('MERCHANTID');
    $description      = $this->_request->getParam('DESCRIPTION');

    $uid = App_User::getUserIdFromEmail($loginid);
    $u = new App_User($uid);

    $parentid = $u->getParentUserId();
    $puser = new App_User($parentid);
    $countrycode = $puser->getCountryCode();


    $result = array();

    $a = new App_Auth();
    if (!($a->authCheck($uid, Atlasp_Utils::inst()->encryptPassword($passwd)  ))) {
      throw new App_Exception_WsException('Invalid username or password');
    }


    $p = new App_Prefs();
    $prefs = $p->getWebUserPrefs( $parentid, 'mw');

    if ($secret !== $prefs['possecret'] ) {
      throw new App_Exception_WsException('Invalid secret');
    }

    if ($u->getStatus() !== 'inactive' && $u->getStatus() !== 'active') {
      throw new App_Exception_WsException('Can only change active and inactive users');
    }

    if ($puser->getMerchantId() !== $merchantid ) {
      throw new App_Exception_WsException("Merchant id does not match merchant id on record");
    }

    $u->addPosToUser($osid,$description);

    if ($u->getStatus() === "inactive") {
      $u->setStatus('active');
      $puser->resetPosSecret($prefs);
    }

    $result['result']['data'] = '';
    $result['result']['status'] = 'success';

    App_DataUtils::commit();

    return $result;

  }

}
