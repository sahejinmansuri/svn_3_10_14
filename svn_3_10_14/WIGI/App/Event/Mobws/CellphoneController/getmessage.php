<?php

class App_Event_Mobws_CellphoneController_getmessage extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => 0
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
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
				//$checkpermission = $cthis->checkpermission($ns->mobileid,'',2);
				
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Message');

                $c = new App_Cellphone($ns->mobileid);
				
				
                $data = $c->getMessage();
				//$new_message = $c->getNewMessage();
				$new_message = App_Message::getNewMessageCount($ns->mobileid);
	
                if (count($data) == 0) {
                        throw new App_Exception_WsException('You have no messages in your Inbox');
                        return false;
                }
				
				$cfg = Zend_Registry::get('config');
				$basepath = $cfg->paths->baseurl;
				
				foreach($data as $key=>$val){
					$filename = '/var/www/html/incash/public_html/u/messages/message_'.$val['message_id'].'.rtf';
					if(file_exists ($filename )){
						$data[$key]['rtf_file_path'] = $basepath.'u/messages/message_'.$val['message_id'].'.rtf';
					}
				}
/*$test = print_r($data,true);
error_log($test);*/
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $data;

                App_DataUtils::commit();
                return $result;
    }
}
