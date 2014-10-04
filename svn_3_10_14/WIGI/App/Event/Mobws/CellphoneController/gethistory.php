<?php

class App_Event_Mobws_CellphoneController_gethistory extends App_Event_WsEventAbstract {

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
				//$ns->mobileid = '821';
				//$ns->prefs["system"]["timezone"] = '5.5';
				//$checkpermission = $cthis->checkpermission($ns->mobileid,'',4);
				
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get History');

                $w = new App_WigiEngine();
                $trans = $w->getHistory($ns->mobileid,$ns->prefs["system"]["timezone"],"50");

				foreach($trans as $key=>$val){
					//error_log("========".$val['from_user_id']."==".$val['to_user_id']);
					
					$desc = $val['description'];
					if($val['from_user_id'] == $val['to_user_id']){
						$desc = 'Internal Fund transfer';
					}
					$from_description_fetch = $val['from_description'];
					$from_description_fetch = str_replace(")",") ",$from_description_fetch);
					$from_description_fetch = str_replace("-","- ",$from_description_fetch);
					$trans[$key]['from_description'] = $from_description_fetch;
					
					$to_description_fetch = $val['to_description'];
					$to_description_fetch = str_replace(")",") ",$to_description_fetch);
					$to_description_fetch = str_replace("-","- ",$to_description_fetch);
					$trans[$key]['to_description'] = $to_description_fetch;
					
					$direction = $val['direction'];
					if($direction != 'INFO'){
						$find = 'IMPC™';
						$find1 = 'Send IMPC™';
						$find2 = 'Receive IMPC™';
						$strpos = strpos($desc,$find);
						$strpos1 = strpos($desc,$find1);
						$strpos2 = strpos($desc,$find2);
						if(($strpos1 === FALSE) && ($strpos2 === FALSE)){
							if($strpos !== FALSE){
								$description = substr($desc,0,$strpos);
							}else{
								$description = $desc;
							}
						}else{
							$find3 = 'IMPC™';
							$strpos3 = strpos($desc,$find3);
							if($strpos3 !== FALSE){
								$description = substr($desc,0,$strpos3+7);
							}else{
								$description = $desc;
							}
						}
					}else{
						$find1 = 'Activated';
						$find2 = 'Deactivated';
						$strpos1 = strpos($desc,$find1);
						$strpos2 = strpos($desc,$find2);
						if($strpos1 !== FALSE){
							$description = substr($desc,0,$strpos1+9);
						}else if($strpos2 !== FALSE){
							$description = substr($desc,0,$strpos2+11);
						}else{
							$description = $desc;
						}
					}
					$trans[$key]['description'] = $description;
					//$trans[$key]['settled'] = "";
					
					//to_description
					//error_log("===================================".$from_description_fetch);
				}
				/*$test = print_r($trans,true);
				error_log($test);*/
				
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $trans;
                App_DataUtils::commit();
                return $result;
    }
}
