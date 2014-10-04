<?php

class App_Event_Posws_DocumentController_emailinvoice extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'FIRST_NAME'  => array('generic', 50, 1, App_Constants::getFormLabel('FIRST_NAME')),
                'LAST_NAME'  => array('generic', 50, 1, App_Constants::getFormLabel('LAST_NAME')),
                'EMAIL' => array('generic', 50, 0, App_Constants::getFormLabel('EMAIL')),
                // 'MOBILE' => array('generic', 50, 0, App_Constants::getFormLabel('MOBILE')),
               /* 'DOCID' => array('generic', 50, 0, App_Constants::getFormLabel('DOCID')),
                'MOBILE' => array('generic', 50, 0, App_Constants::getFormLabel('MOBILE')),*/
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

                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
               /* $mobile = $this->_request->getParam("MOBILE");
                
				$cellphone = new App_Cellphone($mobile);
				$userid = $cellphone->getUserId();
				$user = new App_User($userid);*/
				
				
                $fname  = $this->_request->getParam("FIRST_NAME");
                $lname  = $this->_request->getParam("LAST_NAME");
                $email = $this->_request->getParam("EMAIL");
               
				$to = $email;	
				$message = 'Hi '. $fname." ". $lname."<br><br>";
				$message .= 'InCashMe&trade :Your Invoice Detail<br><br>';
				$message .= 'Invoice Type :<br>';
				$message .= 'Number : <br>';
				$message .= 'Description <br>';
				$message .= 'Expiration : <br>';
				
			  $upload = new Zend_File_Transfer_Adapter_Http();
                
                $upload->setDestination("/var/www/html/incash/public_html/u/data");
                $upload->receive();
            $fileType = 'image/jpeg';
		      $filename  = $upload->getFileName('BILLIMG');
				$filename1 = $_FILES['BILLIMG']['name'];
				if($filename != ""){
					$data = file_get_contents($filename);
					 //$data  = base64_encode(file_get_contents($filename));
				}else{
					$data = "";
				}
			
				/*if($res_back != ""){
					$data2 = chunk_split($res_back);
				}else{
					$data2 = "";
				}*/
			
				$m = new App_Messenger();
				$m->sendMessageAttachment1($message,$to,'InCashMe : Document',$fileType,$data,$fileName1);

                $result = array();
				$dataRes=array('title'=>'Success','message'=>'You have successfully send Invoice. Thank you.');
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $dataRes;

                App_DataUtils::commit();
                return $result;

    }
}
