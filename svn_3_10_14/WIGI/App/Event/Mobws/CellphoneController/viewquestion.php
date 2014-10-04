<?php

class App_Event_Mobws_CellphoneController_viewquestion extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'MOBILE'  => array('generic', 100, 1, App_Constants::getFormLabel('MOBILE')),
			'COUNTRY_CODE'  => array('generic', 100, 1, App_Constants::getFormLabel('COUNTRY_CODE')),

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

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     


                $pview->pageid = "profile";


                        $item = $this->_request->getParam("MOBILE");
						$countrycode = $this->_request->getParam("COUNTRY_CODE");
						
						$countrycode = $countrycode?$countrycode:'91';
						$mobile_id = App_Cellphone::getIdFromCellphone($item,$countrycode);
						
                        $c = new App_Cellphone($mobile_id);

						$uid = $c->getUserId();
                        App_Resource::consumerIsAuthorized("CELLPHONE",$uid,$mobile_id);
                        $questions = $c->getQuestions();
			
						$q_count = 0;
			
                        $count = 3 - count($questions);
                        for ($qa=1; $qa<=$count; $qa++) {
                                $questions[] = array(
                                        "question" => "",
                                        "answer" => ""
                                );
								$q_count++;
                        }
$final_count = count($questions) - $q_count;
                        $dataRes = $questions;
						$result['result']['status'] = 'success';
						$result['result']['value']  = '';
						$result['result']['data']   = $dataRes;
						$result['result']['question_count']   = $final_count;
						
                        $pview->ITEM = $mobile_id;

                App_DataUtils::commit();
				return $result;
    }
}
