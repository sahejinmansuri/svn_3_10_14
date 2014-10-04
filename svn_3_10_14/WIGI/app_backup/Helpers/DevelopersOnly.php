<?php

/**
*	Requesting this helper from a controller restricts that controller to
*	developer requests only - intended for test harnesses or other dev-only code
*
*	To use, immediately above the controller class insert the following line:
*
*	Zend_Controller_Action_HelperBroker::getStaticHelper('DevelopersOnly');
* 
*/

class Helpers_DevelopersOnly extends Zend_Controller_Action_Helper_Abstract
{
	function init()
	{
		$remoteIp = $this->getRequest()->getServer('REMOTE_ADDR');
		$allowedIps = array('::1', '127.0.0.1', '198.185.18.207');
		
		if (!in_array($remoteIp, $allowedIps))
		{
			$notFoundHtml = '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html>
<head>
<title>404 Not Found</title>
</head>
<body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
</body>
</html>
';
			$response = $this->getResponse();
			$response->clearAllHeaders();
			$response->setRawHeader('HTTP/1.1 404 Not Found')->appendBody($notFoundHtml);
			$response->sendResponse();
			exit;
		}
	}
}