<?php

class App_Event_Cw_AdvancedController_mydocuments extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ITEM'  => array('int', 25, 1, App_Constants::getFormLabel('ITEM')),
                'PIN'  => array('int', 25, 1, App_Constants::getFormLabel('PIN')),
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
                        $item = $this->_request->getParam("ITEM");
                        $pin = $this->_request->getParam('PIN');
                        $uid = $session_data->userid;
                        App_Resource::consumerIsAuthorized('CELLPHONE',$uid,$item);

                        $pview->pageid = "advanced";

                        $user = new App_User($uid);

                        $cellphones = $user->getFmtCellphones();
                        $pview->cellphones = $cellphones;

                        $c = new App_Cellphone($item);

                        $checkcell = ($session_data->ownedcell == $item) ? true : false;

                        if ($c->pinMatches($pin) || $checkcell) {

                                        $session_data->ownedcell = $item;

                                        $d = new App_DocumentEngine();
                                        $documents = $d->getDocuments($item);

                                        $docs = Array();
                                        foreach ($documents as $doc) {
                                                $docs[] = $d->getDocument($item, $doc['doc_id']);
                                        }

                                        $pview->selectedcellphone = $c->getCellphone();
										
                                        $pview->selectedcellalias = $c->getAlias()." ".$c->getLastname();
                                        $pview->item = $item;

                                        $pview->docs = $docs;

                         } else {
					 throw new App_Exception_WsException('The PIN you entered is incorrect.');
                         }

                         App_DataUtils::commit();
    }
}
