<?php

class App_Event_Mobws_RegistrationController_registermerchant extends App_Event_WsEventAbstract
{

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
		'ADDRESS' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS')),
                'ADDRESS2' => array('generic', 50, 0, App_Constants::getFormLabel('ADDRESS2')),
		'CITY' => array('generic', 50, 0, App_Constants::getFormLabel('CITY')),
		'STATE' => array('generic', 50, 0, App_Constants::getFormLabel('STATE')),
		'ZIP' => array('generic', 50, 0, App_Constants::getFormLabel('ZIP')),
		'COUNTRY_CODE' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY_CODE')),
		'QUESTION' => array('generic', 50, 0, App_Constants::getFormLabel('QUESTION')),
		'ANSWER' => array('generic', 50, 0, App_Constants::getFormLabel('ANSWER')),
		'BUSINESS_TYPE' => array('generic', 50, 0, App_Constants::getFormLabel('BUSINESS_TYPE')),
		'BUSINESS_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('BUSINESS_NAME')),
		'BUSINESS_TAX_ID' => array('generic', 50, 0, App_Constants::getFormLabel('BUSINESS_TAX_ID')),
		'BUSINESS_PHONE' => array('generic', 50, 0, App_Constants::getFormLabel('BUSINESS_PHONE')),
                'BUSINESS_DBA_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('BUSINESS_DBA_NAME')),
                'BUSINESS_URL' => array('generic', 50, 0, App_Constants::getFormLabel('BUSINESS_URL')),
                'FIRST_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('FIRST_NAME')),
                'LAST_NAME' => array('generic', 50, 0, App_Constants::getFormLabel('LAST_NAME')),
		'OSID' => array('generic', 50, 0, App_Constants::getFormLabel('OSID')),
                '501C' => array('generic', 50, 0, App_Constants::getFormLabel('501C')),
                'STATE_OF_INC' => array('generic', 50, 0, App_Constants::getFormLabel('STATE_OF_INC')),
		'SENDTC' => array('generic', 50, 0, App_Constants::getFormLabel('SENDTC')),
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
    
    public function execute(&$session_data,&$pview,&$cthis){

                App_DataUtils::beginTransaction();

		$email = $this->_request->getParam("EMAIL");
		$password = $this->_request->getParam("PASSWORD");
		$pin = $this->_request->getParam("PIN");
		$first_name =  $this->_request->getParam("FIRST_NAME");
		$last_name = $this->_request->getParam("LAST_NAME");
		$address = $this->_request->getParam("ADDRESS");
		$city = $this->_request->getParam("CITY");
		$state = $this->_request->getParam("STATE");
		$zip = $this->_request->getParam("ZIP");
		$country_code = $this->_request->getParam("COUNTRY_CODE");
		$osid = $this->_request->getParam("OSID");
                $cellphone = $this->_request->getParam("OSID");
		$question = $this->_request->getParam("QUESTION");
		$answer = $this->_request->getParam("ANSWER");
		$business_type =  $this->_request->getParam("BUSINESS_TYPE");
		$business_name =  $this->_request->getParam("BUSINESS_NAME");
		$business_tax_id =  $this->_request->getParam("BUSINESS_TAX_ID");
		$business_phone =  $this->_request->getParam("BUSINESS_PHONE");
                $business_dba_name =  $this->_request->getParam("BUSINESS_PHONE");
                $business_url =  $this->_request->getParam("BUSINESS_URL");
                $sendtc =  $this->_request->getParam("SENDTC");
                $address2 =  $this->_request->getParam("ADDRESS2");

                $description  =  $this->_request->getParam("DESCRIPTION");
                $_501C        =  $this->_request->getParam("501C");
                $state_of_inc =  $this->_request->getParam("STATE_OF_INC");


		$result = array();
        
        $type = 'pos';

        if(App_User::getUserIdFromEmail($email) > 0 ){
            throw new App_Exception_WsException('User ID already exists');
        }

	$b = $business_type;
	if (!is_numeric($b)) {
		switch ($b) {
    			case "Individual":
        		$business_type = 1;
        		break;

                        case "SOHO":
                        $business_type = 2;
                        break;

                        case "Small Business":
                        $business_type = 3;
                        break;

                        case "Large Business":
                        $business_type = 4;
                        break;

                        case "Non-Profit":
                        $business_type = 5;
                        break;

                        case "Government":
                        $business_type = 6;
                        break;

                        case "Association":
                        $business_type = 7;
                        break;

		}
	}
        $pview->npoMsg = "";
        if ($business_type == 5) {
           $pview->npoMsg = "You will be contacted by our support team shortly to confirm valid 501(c) status.";
        }
        /*if ($osid !== "") {
            $mid = App_Cellphone::getIdFromCellphone($osid,$country_code);
            if ($mid > 0) {
                throw new App_Exception_WsException('POS is already registered');
            }
        }*/

	/*if (App_User::urlRegistered($business_url)) {
		throw new App_Exception_WsException('Business URL or website already registered');
	}*/

        $sp = new App_Db_Sp_MerchantCreate($this->_request);
        $res = $sp->getSimpleResponse(array(
            'USER_TYPE' => 'merchant',
            'PASSWORD'  => Atlasp_Utils::inst()->encryptPassword($password),
            'STATUS'    => 'unconfirmed',
            'MIDDLE_INIT' => '',
            'DATE_ADDED' => date("Y-m-d H:i:s"),
            'USER_ADDED' => $email,
            'USER_CHANGED' => $email,
            'BUSINESS_URL' => App_User::getHostname($business_url),
            'BUSINESS_TYPE' => $business_type,
            '501C' => $_501C,
            'STATE_OF_INC' => $state_of_inc

        ));

        $userid = $res['@p_user_id'];
        $ecode  = $res['@p_email_code'];
    
        $u = new App_User($userid);
        //$u->confirmEmail($ecode);
        $t = App_Tos::getCurrentTos();
        $u->addAddress($address,$address2,$city,$state,$zip,$country_code);
        $u->setAcceptedTos($t->tos_id);
        App_Approval::create($userid);

        //Create a virtual POS for accepting transactions
        $vcode = $u->addCellphone('virtual-' . $userid,Atlasp_Utils::inst()->encryptPassword($pin),'Virtual','virtualpos');
        $vposid = App_Cellphone::getIdFromCellphone('virtual-' . $userid,$country_code);
        $vpos = new App_Cellphone($vposid);
        $vpos->confirm($vcode,"POS");
        $vpos->setDefault($vposid);
        $vpos->addQuestion($question,$answer);

        if ($osid !== "") {
          $cellid = $u->addCellphone($osid,Atlasp_Utils::inst()->encryptPassword($pin),'','pos');
        }

        $msg = new App_Messages();
        $emailMsg = $msg->getMerchantRegister($business_name,$email,$ecode,$userid,$u->getMerchantId());

        $m = new App_Messenger();
        $m->sendMessage($emailMsg,$email,'1'); //email
        $m->sendMessage("Your confirmation code is $cellid",$cellphone,'2'); //SMS
        //error_log("Your confirmation code is $cellid to $cellphone"); //SMS
    
	if ($sendtc) {
        	$t = App_Tos::getCurrentTos();
        	$tos = $t['tos'];
        	$m = new App_Messenger();
        	$tos = str_replace("\n",'<br />' . "\n",$tos);

        	$m->sendMessage($tos,$email,'1');
 	}
        

        App_DataUtils::commit();

    }

}
