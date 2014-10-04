<?php

class App_Event_Mobws_RegistrationController_checkanswer extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'CELLPHONE' => array('generic', 50, 1, App_Constants::getFormLabel('CELLPHONE')),
                'COUNTRY' => array('generic', 50, 1, App_Constants::getFormLabel('COUNTRY')),
                'QUESTION' => array('generic', 50, 1, App_Constants::getFormLabel('QUESTION')),
                'ANSWER' => array('generic', 50, 1, App_Constants::getFormLabel('ANSWER')),
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

                $cellphone = $this->_request->getParam("CELLPHONE");
                $country = $this->_request->getParam("COUNTRY");
                $answer = $this->_request->getParam("ANSWER");
                $question = $this->_request->getParam("QUESTION");
                $result = array();

                $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country);

                if (!($mobileid > 0)) {
                        throw new App_Exception_WsException('Cellphone is not a registered InCashMe account');
                }


                $c = new App_Cellphone($mobileid);

                if ( $c->questionMatches($question,$answer) ) {
					$result['result']['status'] = 'success';
				}else {
					$result['result']['status'] = 'failure';
					
				}
				
                App_DataUtils::commit();
				$result['result']['value']  = '';
				$result['result']['data']   = '';
                
				return $result;

    }
}
