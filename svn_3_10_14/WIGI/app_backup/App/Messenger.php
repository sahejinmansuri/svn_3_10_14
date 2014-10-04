<?php

class App_Messenger {

  public function sendMessage($message,$to,$method,$subject=null) {
    if ($method == 1) {

      $config = array(
        'ssl' => 'tls',
        'port' => 587,
        'auth' => 'login',
        'username' => 'support@incashme.in',
        'password' => 'support'
      );
      $transport = new Zend_Mail_Transport_Smtp('server.incashme.in', $config);

	  $subject = ($subject)?$subject:'Login Authorization code from InCashMe';	
      $mail = new Zend_Mail();

      $mail->setBodyHtml($message . "\n\n<br/><br/>Please do not reply to this email");
      $mail->setFrom('support@incashme.in', 'InCashMe Support');
      $mail->addTo($to, 'InCashMe User');
      $mail->setSubject($subject);
      $mail->send($transport);


    } else if ($method == 2) {
      $message .= " Please do not reply to this message.";
      App_Messenger::sendViaSmsIndia($message,$to);
    }

  }


  private static function sendViaAbtxt($message,$to) {
    $ch = curl_init ("http://www.abtxt.com/websms/sendsms.aspx?user=wigime&passwd=wigime321&mobilenumber=$to&message=$message&senderid=[YOUR APPROVED SENDERID]");
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $page = curl_exec ($ch);
  }

  private static function sendViaGroupTxt($message,$to) {
    $client = new Zend_XmlRpc_Client('http://apicloud.grouptexting.com/xmlrpc?key=178C97AB4A102B840FCE3F805CAF8D1B5C6D5BA3&apiVersion=1.0');
    $client->call('sms.send',array('7722040811',$to,$message,1));
  } 
  private static function sendViaSmsIndia($message,$to) {
    $ch = curl_init ("http://login.smsindiahub.in/API/WebSMS/Http/v1.0a/index.php?username=michalgreg2013@gmail.com&password=password&sender=InCash&to=$to&message=$message&reqid=1&unique=0");
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $page = curl_exec ($ch);
  }
}

?>