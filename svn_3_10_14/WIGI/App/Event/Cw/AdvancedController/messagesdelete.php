<?php

class App_Event_Cw_AdvancedController_messagesdelete extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'C'  => array('int', 25, 1, App_Constants::getFormLabel('CELLPHONE')),
                'M'  => array('generic', 25, 1, App_Constants::getFormLabel('MESSAGE')),
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
                        $cellid = $this->_request->getParam("C");
                        $msgid = $this->_request->getParam("M");
                        $uid = $session_data->userid;
                        App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$cellid);
                        if ($msgid !== "all") App_Resource::cellphoneIsAuthorized("MESSAGE",$cellid,$msgid);

                        $pview->pageid = "advanced";
                        $pview->showcontent = "form";

                        $pview->cellid = $cellid;
                        $pview->msgid = $msgid;

                        if ($msgid === "all") {
                          App_Message::deleteMessages($cellid);
                        } else {
                          $m = new App_Message($msgid);
                          $m->deleteMessage();
                        }

                        $pview->showcontent = "success";
			App_DataUtils::commit();
    }
}
