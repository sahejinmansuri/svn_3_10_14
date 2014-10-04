<?php

class App_Event_Mobws_CellphoneController_emaildocument extends App_Event_WsEventAbstract {

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
                'DOCID' => array('generic', 50, 0, App_Constants::getFormLabel('DOCID')),
                'MOBILE' => array('generic', 50, 0, App_Constants::getFormLabel('MOBILE')),
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
				$mobile = $ns->mobileid;
                $fname  = $this->_request->getParam("FIRST_NAME");
                $lname  = $this->_request->getParam("LAST_NAME");
                $email = $this->_request->getParam("EMAIL");
                $docid = $this->_request->getParam("DOCID");
                //$mobile = $this->_request->getParam("MOBILE");
				
				$cellphone = new App_Cellphone($mobile);
				$userid = $cellphone->getUserId();
				$user = new App_User($userid);
				
				$de = new App_DocumentEngine();
                $res = $de->getDocument($mobile,$docid);
                $res_front = $de->getDocumentData($mobile,$docid,'FRONT');
                $res_back = $de->getDocumentData($mobile,$docid,'BACK');
				
				//mail code start
				$to = $email;
				$user_name = $user->getFirstName()." ".$user->getLastName();
				$message = 'Hi '. $fname." ". $lname."<br><br>";
				$message .= 'InCashMe&trade; : Your friend '.$user_name.' has send you Document Detail<br><br>';
				$message .= 'Document Type : '.$res['type'].'<br>';
				$message .= 'Number : '.$res['number'].'<br>';
				$message .= 'Description : '.$res['description'].'<br>';
				$message .= 'Expiration : '.$res['expiration'].'<br>';
	
				$fileType = 'image/jpeg';
				
				$fileName = 'document_front.jpg';
				$fileName2 = 'document_back.jpg';
				
				if($res_front != ""){
					$data = chunk_split($res_front);
				}else{
					$data = "";
				}
				if($res_back != ""){
					$data2 = chunk_split($res_back);
				}else{
					$data2 = "";
				}
				
				$m = new App_Messenger();
				$m->sendMessageAttachment($message,$to,'InCashMe : Document',$fileType,$data,$data2,$fileName,$fileName2);

                $result = array();
				$dataRes=array('title'=>'Success','message'=>'You have successfully send document to your friend. Thank you.');
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $dataRes;

                App_DataUtils::commit();
                return $result;

    }
}
