<?php

class App_Messenger {
	
	public function sendMessageAttachment($message,$to,$subject=null,$fileType,$data,$data2,$fileName,$fileName2) { 
	
			$message = str_replace("InCashMe&trade;","<span style='font-family:tahoma'>InCashMe&trade;</span>",$message);
			$message = str_replace("InCashMe","<span style='font-family:tahoma'>InCashMe</span>",$message);
			
			
			
			$subject = ($subject)?$subject:'Login Authorization code from InCashMe&trade;';
			$subject = str_replace("InCashMe&trade;","InCashMe",$subject);		
	$subject = str_replace("InCashMe™","InCashMe",$subject);	
			    
			$mail = new Zend_Mail();
			$mail->setBodyHtml($message . "\n\n<br/><br/>Please do not reply to this email");
			$mail->setFrom('support@incashme.com', 'InCashMe Support');
			$mail->addTo($to, 'InCashMe User');
			$mail->setSubject($subject);
			
			if($data != ""){
				$data_send = base64_decode($data);
				$at = $mail->createAttachment($data_send);
				$at->type        = $fileType;
				$at->disposition = Zend_Mime::DISPOSITION_INLINE;
				$at->encoding    = Zend_Mime::ENCODING_BASE64;
				$at->filename    = $fileName;
			}
			if($data2 != ""){
				$data_send2 = base64_decode($data2);
				$at1 = $mail->createAttachment($data_send2);
				$at1->type        = $fileType;
				$at1->disposition = Zend_Mime::DISPOSITION_INLINE;
				$at1->encoding    = Zend_Mime::ENCODING_BASE64;
				$at1->filename    = $fileName2;
			}
			$mail->send();
	}
public function sendMessageAttachment1($message,$to,$subject=null,$fileType,$data,$fileName1) { 
	
			$message = str_replace("InCashMe&trade;","<span style='font-family:tahoma'>InCashMe&trade;</span>",$message);
			$message = str_replace("InCashMe","<span style='font-family:tahoma'>InCashMe</span>",$message);
			
			$subject = ($subject)?$subject:'Login Authorization code from InCashMe&trade;';	
			$subject = str_replace("InCashMe&trade;","InCashMe",$subject);	
	$subject = str_replace("InCashMe™","InCashMe",$subject);		
			  //  $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com');
			$mail = new Zend_Mail();
			$mail->addTo($to, 'InCashMe User');
			$mail->setSubject($subject);			
			$mail->setBodyHtml($message . "\n\n<br/><br/>Please do not reply to this email");
			$mail->setFrom('support@incashme.com', 'InCashMe Support');
			
			if($data != ""){
				$data_send = $data;
				
				$at = $mail->createAttachment($data);
				$at->type        = $fileType;
				$at->disposition = Zend_Mime::DISPOSITION_INLINE;
				$at->encoding    = Zend_Mime::ENCODING_BASE64;
				$at->filename    = $fileName1;
			}
  $mail->send();		
		
			/*if($data2 != ""){
				$data_send2 = base64_decode($data2);
				$at1 = $mail->createAttachment($data_send2);
				$at1->type        = $fileType;
				$at1->disposition = Zend_Mime::DISPOSITION_INLINE;
				$at1->encoding    = Zend_Mime::ENCODING_BASE64;
				$at1->filename    = $fileName2;
			}*/
			
			
			
		/*	//Send it!
			$sent = true;
			try {
			    $mail->send();
			} catch (Exception $e){
			    $sent = false;
			}
			
			//Do stuff (display error message, log it, redirect user, etc)
			if($sent){
			    //Mail was sent successfully.
			} else {
			    //Mail failed to send.
			}
			*/
			
	}

  public function sendMessage($message,$to,$method,$subject=null) {
    if ($method == 1) {
			$message = str_replace("InCashMe&trade;","<span style='font-family:tahoma'>InCashMe&trade;</span>",$message);
			$message = str_replace("InCashMe","<span style='font-family:tahoma'>InCashMe</span>",$message);
		//integrated with amazon SES
      $config = array(
        'ssl' => 'tls',
        'port' => 587,
        'auth' => 'login',
        'username' => 'AKIAJHNE7TKMT2NZ4DZQ',
        'password' => 'AuLdJn9++eh4LY8rjX5uFXI3/EazhNYZbqcZAhvLKgKQ'
      );
     // $transport = new Zend_Mail_Transport_Smtp('server.incashme.com', $config);
      $transport = new Zend_Mail_Transport_Smtp('email-smtp.us-east-1.amazonaws.com', $config);

	  $subject = ($subject)?$subject:'Login Authorization code from InCashMe&trade;';	
	$subject = str_replace("InCashMe&trade;","InCashMe",$subject);		
	$subject = str_replace("InCashMe™","InCashMe",$subject);	
      $mail = new Zend_Mail();
		$to = $to?$to:'support@incashme.com';
      $mail->setBodyHtml($message . "\n\n<br/><br/>Please do not reply to this email");
      $mail->setFrom('support@incashme.com', 'InCashMe Support');
      $mail->addTo($to, 'InCashMe User');
      $mail->setSubject($subject);
      $mail->send($transport); //comment by attune
	  
	  //$to = "sahejinmansuri@gmail.com";
	//$subject = "Test mail";
	//$message = "Hello! You've got this mail because your mail server is working..Congratulation!!";
	/*$from = "support@incashme.com";
	$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);*/
	  

    } else if ($method == 2) {
      //$message .= " Please do not reply to this message.";
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
    $ch = curl_init ("http://login.smsindiahub.in/API/WebSMS/Http/v1.0a/index.php?username=michalgreg2013@gmail.com&password=password&sender=InCash&to=$to&message=$message&format=json");
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    $page = curl_exec ($ch);
    //$m->sendMessage("======SMS LOG======<br/><hr/>SMS TO: ".$to.".<br/> Message:".$message,"mayurpatel3209@gmail.com",'1');
	$message1 = "http://login.smsindiahub.in/API/WebSMS/Http/v1.0a/index.php?username=michalgreg2013@gmail.com&password=password&sender=InCash&to=$to&message=$message&format=json";
    $m = new App_Messenger();
	//$m->sendMessage($message1,"incashmeapp@gmail.com",'1');
	$m->sendMessage("======SMS LOG======<br/><hr/>SMS TO: ".$to.".<br/> Message:".$message,"incashmeapp@gmail.com",'1');
  }
}

?>