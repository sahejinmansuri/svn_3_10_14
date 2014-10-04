<?php

class App_Event_Mobws_RegistrationController_getquestion extends App_Event_WsEventAbstract {

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
                'TYPE' => array('generic', 50, 1, App_Constants::getFormLabel('TYPE')),
                'NAME' => array('generic', 50, 1, App_Constants::getFormLabel('NAME')),
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
                $type = $this->_request->getParam("TYPE");
                $field = $this->_request->getParam("NAME");
                $result = array();

                if($type === 'pin'){
                    $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country);
                    if (!($mobileid > 0)) {  throw new App_Exception_WsException('Cellphone is not a registered WiGime user'); }
                    $c = new App_Cellphone($mobileid);
                    $u = new App_User($c->getUserId());

                    if($c->getPin() == Atlasp_Utils::inst()->encryptPassword($field)){
                        $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country);
                        if (!($mobileid > 0)) {  throw new App_Exception_WsException('Cellphone is not a registered WiGime user'); }
                        $c = new App_Cellphone($mobileid);
                        $result['result']['data'] =  $c->getRealAndFakeQuestions(); //$c->getRandQuestion();
                        $result['result']['status'] = 'success';
                    } else {
                    throw new App_Exception_WsException('Unauthorized request');
                }
                return $result;
 
                } else if($type === 'osid'){
                    $mobileid = App_Cellphone::getIdFromCellphone($cellphone,$country);
                    if (!($mobileid > 0)) {  throw new App_Exception_WsException('Cellphone is not a registered WiGime user'); }
                    $c = new App_Cellphone($mobileid);
                    $u = new App_User($c->getUserId());
                    
                    if($c->isAuthorized($field)){
                        $result['result']['data'] =  $c->getRealAndFakeQuestions(); //$c->getRandQuestion();
                        $result['result']['status'] = 'success';
    
                    } else {
                        throw new App_Exception_WsException('Unauthorized request');
                    }

                    App_DataUtils::commit();
                    return $result;

                }

    }
}
