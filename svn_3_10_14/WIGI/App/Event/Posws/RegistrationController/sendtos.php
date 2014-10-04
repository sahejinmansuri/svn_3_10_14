<?php

class App_Event_Posws_RegistrationController_sendtos extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'TYPE' => array('generic', 50, 1, App_Constants::getFormLabel('TYPE')),
                'COUNTRY' => array('generic', 50, 0, App_Constants::getFormLabel('COUNTRY')),
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

                  $type = $this->_request->getParam("TYPE");
                  $country = $this->_request->getParam("COUNTRY");
                  $name = $this->_request->getParam("NAME");

                  $t = App_Tos::getCurrentTos();
                  $tos = $t['tos'];
                  $m = new App_Messenger();
                  $tos = str_replace("\n",'<br /><br />' . "\n",$tos);

                  if ($type === "email") {
                    $m->sendMessage($tos,$name,'1');
                  } else if ($type === "cellphone") {
                    $mobileid = App_Cellphone::getIdFromCellphone($name,$country);
                    $c = new App_Cellphone($mobileid);
                    $u = new App_User($c->getUserId());
                    $m->sendMessage($tos,$u->getEmail(),'1');
                  }

                  $result = array();
                  $result['result']['status'] = 'success';
                  $result['result']['value']  = '';
                  $result['result']['data']   = '';

                  App_DataUtils::commit();

                  return $result;

    }
}
