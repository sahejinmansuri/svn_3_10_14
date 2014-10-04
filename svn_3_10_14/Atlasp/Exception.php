<?php
class Atlasp_Exception extends Exception
{
    public $trace;
    public $faultcode;

    public function __construct($code, $msg, $origexp, $notify=false){
	
	$this->trace = debug_backtrace();
	if(isset($origexp->faultcode))
	$this->faultcode = $origexp->faultcode;
	$str = $this->getNotifyMsg($code, $msg, $origexp );
	if($notify){
	    $this->notify($msg,$str);    
	    Zend_Registry::get('log')->log($str, Zend_Log::ERR);
	} else {
	    Zend_Registry::get('log')->log($str, Zend_Log::WARN);
	}
    }

    public function getNotifyMsg($code, $msg, $orig){
	return $code . ' : '. $msg . "\n\n". $this->strDump($orig). "\n\n". $this->strDump($this->trace);
    }


    public function notify($msg,$str){
	$cfg = Zend_Registry::get('config');
        $mail = new Zend_Mail();
	$mail->setBodyText($str);
	$mail->setFrom($cfg->errfrom, 'Atlasp_Exception');
	$mail->addTo($cfg->errto,     'Excp_Handlers');
	$mail->setSubject($_SERVER['SERVER_NAME'] .':'. $msg);
	$mail->send();
    }

    protected function strDump($var = null) {
	ob_start();
	#var_dump($var);
	print_r($var);
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
    }

}
?>
