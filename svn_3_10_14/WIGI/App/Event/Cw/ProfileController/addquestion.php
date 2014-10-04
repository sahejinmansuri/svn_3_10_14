<?php

class App_Event_Cw_ProfileController_addquestion extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ITEM'  => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
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

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";

                        $uid = $session_data->identity['userid'];

                        $item = $this->_request->getParam("ITEM");

                        App_Resource::consumerIsAuthorized("CELLPHONE",$uid,$item);
                        $c = new App_Cellphone($item);
                        $questions = $c->getPredefQuestions();

                        $pview->questions = $questions;

                        $pview->ITEM = $item;

                        if ($this->_request->getParam('doaction') != null) {

                                $q = $this->_request->getParam('QUESTION');
                                $a = $this->_request->getParam('ANSWER');

                                $c->addQuestion($q, $a);

                                $pview->showcontent = "success";

                        }

                        App_DataUtils::commit();


    }
}
