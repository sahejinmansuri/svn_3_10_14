<?php

class App_Event_Mobws_CellphoneController_updateprofile extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USER' => array('generic', 100, 1, App_Constants::getFormLabel('USER')),
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
                //App_DataUtils::beginTransaction();
                //$pview->pageid = "profile";

                        $uid = $this->_request->getParam("USER");
                        
						
$upload = new Zend_File_Transfer_Adapter_Http();
$upload->setDestination("/var/www/html/incash/tmp");
$upload->receive();
$filename = $upload->getFileName('PROFILEIMG');

$extension = explode('.', $filename);	
$timestamp = time();			
$target_path = '/var/www/html/incash/public_html/u/profile/'.$uid.'_'.$timestamp.'.'.$extension[1];
if(isset($extension[1])){
	$image_name = $uid.'_'.$timestamp.'.'.$extension[1];
}else{
	$image_name = "";
}
	


//move_uploaded_file($filename, $target_path);
 $data12  = file_get_contents($filename);
file_put_contents($target_path,$data12);


								$uinfo = new App_Models_Db_Wigi_User();
								$uinfof = $uinfo->update(
                                        array(
												'image_path' => $image_name
                                        ),
                                        $uinfo->getAdapter()->quoteInto('user_id = ?', $uid)
                                );
								
								$dataRes=array('title'=>'Success','message'=>'Your profile has been updated.');
								$result['result']['status'] = 'success';
								$result['result']['value']  = '';
								$result['result']['data']   = $dataRes;
                       


                        //App_DataUtils::commit();
						
		return $result;
    }
}
