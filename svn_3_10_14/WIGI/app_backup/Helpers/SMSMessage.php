<?php

/**
*	Helper for sending messages via SMS
*/

class Helpers_SMSMessage extends Zend_Controller_Action_Helper_Abstract
{
	protected static $carrier_data = null;
	
	function carrierData()
	{
		if (self::$carrier_data == null)
		{
			$cfg = Zend_Registry::get('config');
	        $carrier_json = file_get_contents($cfg->paths->carrierfile);
			self::$carrier_data = Zend_Json::decode($carrier_json);
		}
		return self::$carrier_data;
	}
	
	function send($phone, $carrier, $message)
	{
		$carrierdata = $this->carrierData();
		$format = $carrierdata[$carrier]['format'];
		$email = $phone . $format;
		$mailer = new Zend_Mail();
		$mailer->setBodyText($message);
		$mailer->setFrom('webadmin@seisnit.com', 'Web Admin');
		$mailer->addTo($email, $email);
		$mailer->send();
	}
}