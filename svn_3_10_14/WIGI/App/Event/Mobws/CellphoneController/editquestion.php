<?php

class App_Event_Mobws_CellphoneController_editquestion extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'QUESTION_ID'  => array('generic', 100, 1, App_Constants::getFormLabel('QUESTION_ID')),
                'MOBILE'  => array('generic', 100, 1, App_Constants::getFormLabel('MOBILE')),
                'QUESTION'  => array('generic', 100, 1, App_Constants::getFormLabel('QUESTION')),
                'ANSWER'  => array('generic', 100, 1, App_Constants::getFormLabel('ANSWER')),
				'COUNTRY_CODE'  => array('generic', 100, 1, App_Constants::getFormLabel('COUNTRY_CODE')),
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

                App_DataUtils::beginTransaction();

                $pview->pageid = "profile";

                $pview->showcontent = "form";


                        $questionid = $this->_request->getParam("QUESTION_ID");
                        $mobile_no = $this->_request->getParam("MOBILE");
						
						
						$countrycode = $this->_request->getParam("COUNTRY_CODE");
						
						$countrycode = $countrycode?$countrycode:'91';
						$item = App_Cellphone::getIdFromCellphone($mobile_no,$countrycode);
						
                        $c = new App_Cellphone($item);
						$uid = $c->getUserId();
						


                        App_Resource::consumerIsAuthorized("CELLPHONE",$uid,$item);
                        $pview->ITEM = $item;
                        $pview->QUESTION_ID = $questionid;

                        $q = new App_Question($questionid);

                        App_Resource::cellphoneIsAuthorized("QUESTION",$item,$questionid);

                        $pview->selectedq = $q->getQuestion();
                        $pview->selecteda = $q->getAnswer();

                        $questions = $c->getPredefQuestions();
                        $questions[] = $q->getQuestion();

                        $pview->questions = $questions;

                        //if ($this->_request->getParam('doaction') != null) {

                                $q = $this->_request->getParam('QUESTION');
                                $a = $this->_request->getParam('ANSWER');

                                $c->removeQuestion($questionid);
                                $c->addQuestion($q, $a);

                                $dataRes=array('title'=>'Success','message'=>'Question is Changed');
								$result['result']['status'] = 'success';
								$result['result']['value']  = '';
								$result['result']['data']   = $dataRes;

                        //}


                        App_DataUtils::commit();
						return $result;

    }
}
