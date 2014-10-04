<?php

class App_Event_Mobws_RegistrationController_register extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'EMAIL' => array('generic', 50, 0, App_Constants::getFormLabel('EMAIL')),
                'PASSWORD' => array('generic', 50, 0, App_Constants::getFormLabel('PASSWORD')),
                'PIN' => array('generic', 50, 0, App_Constants::getFormLabel('PIN')),
                'FIRST_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('FIRST_NAME')),
                'LAST_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('LAST_NAME')),
                'ADDRESS' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS')),
                'ADDRESS2' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS2')),
                'CITY' => array('generic', 50, 0, App_Constants::getFormLabel('CITY')),
                'STATE' => array('generic', 50, 0, App_Constants::getFormLabel('STATE')),
                'ZIP' => array('generic', 50, 0, App_Constants::getFormLabel('ZIP')),
                'COUNTRY_CODE' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY_CODE')),
                'BIRTHDATE' => (array('generic', 50, 0, App_Constants::getFormLabel('BIRTHDATE'))),
                'CELLPHONE' => array('generic', 50, 0, App_Constants::getFormLabel('CELLPHONE')),
                'QUESTION' => array('generic', 50, 0, App_Constants::getFormLabel('QUESTION')),
                'ANSWER' => array('generic', 50, 0, App_Constants::getFormLabel('ANSWER')),

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


		$email = $this->_request->getParam("EMAIL");
		$password = $this->_request->getParam("PASSWORD");
		$pin = $this->_request->getParam("PIN");
		$first_name = $this->_request->getParam("FIRST_NAME");
		$last_name = $this->_request->getParam("LAST_NAME");
		$address = $this->_request->getParam("ADDRESS");
                $address2 = $this->_request->getParam("ADDRESS2");
		$city = $this->_request->getParam("CITY");
		$state = $this->_request->getParam("STATE");
		$zip = $this->_request->getParam("ZIP");
		$country_code = $this->_request->getParam("COUNTRY_CODE");
		$cellphone = $this->_request->getParam("CELLPHONE");
		$question = $this->_request->getParam("QUESTION");
		$answer = $this->_request->getParam("ANSWER");
                $birthdate = $this->_request->getParam("BIRTHDATE");

        if(App_User::getUserIdFromEmail($email) > 0 ){
            throw new App_Exception_WsException('Email is already registered');
        }

        $testmobileid = App_Cellphone::getIdFromCellphone($cellphone,$country_code);

        if ($testmobileid > 0) {
            throw new App_Exception_WsException('Cellphone is already registered');
        }

	if ( preg_match('/\d\d\d\d-\d\d-\d\d/',$birthdate) ) {
	}
	else {
            $birthdate = App_DataUtils::fmtdate_human2db($birthdate);
        }


        $sp = new App_Db_Sp_UserCreate($this->_request);
        $res = $sp->getSimpleResponse(array(
            'USER_TYPE' => 'consumer',
            'PASSWORD'  => Atlasp_Utils::inst()->encryptPassword($password),
            'STATUS'    => 'unconfirmed',
            'MIDDLE_INIT' => '',
            'DATE_ADDED' => date("Y-m-d H:i:s"),
            'USER_ADDED' => $email,
            'USER_CHANGED' => $email,
            'IP' => getenv('REMOTE_ADDR'),
            'BIRTHDATE' => $birthdate,
            'PARENT_USER_ID' => '',
            'CREATED_VIA' => 'iPhone',
        ));

        $userid = $res['@p_user_id'];
        $ecode  = $res['@p_email_code'];
    
        $u = new App_User($userid);
        //$t = App_Tos::getCurrentTos();
        $u->addAddress($address,$address2,$city,$state,$zip,$country_code);
        //$u->setAcceptedTos($t->tos_id);

        $cellid = $u->addCellphone($cellphone,Atlasp_Utils::inst()->encryptPassword($pin),'','cellphone' );

        $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country_code);

        $cellobj = new App_Cellphone($mobileid);
        $cellobj->setDefault();

	$cellobj->addQuestion($question,$answer);

        $defSettings = new App_DefSettings();
        $defSettings->createUserSettings( $userid );
        $defSettings->createMobileSettings( $userid , $mobileid );

        $mobileid = App_Cellphone::getIdFromCellphone($cellphone, $country_code);
        $c = new App_Cellphone($mobileid);
        $u = new App_User($c->getUserId());


        $result = array();
        $result['result']['status'] = 'success';
        $result['result']['value']  = '';
        $result['result']['data']   = '';


        App_DataUtils::commit();

        return $result;

        
    }
}
