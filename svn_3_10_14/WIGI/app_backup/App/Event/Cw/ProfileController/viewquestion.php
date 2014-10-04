<?php

class App_Event_Cw_ProfileController_viewquestion extends App_Event_WsEventAbstract  {

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

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     


                $pview->pageid = "profile";

                        $uid = $session_data->identity['userid'];

                        $item = $this->_request->getParam("ITEM");
                        $c = new App_Cellphone($item);

                        App_Resource::consumerIsAuthorized("CELLPHONE",$uid,$item);
                        $questions = $c->getQuestions();

                        $count = 3 - count($questions);
                        for ($qa=1; $qa<=$count; $qa++) {
                                $questions[] = array(
                                        "question" => "",
                                        "answer" => ""
                                );
                        }

                        $pview->questions = $questions;

                        $pview->ITEM = $item;

                App_DataUtils::commit();
    }
}
