<?php

class App_Event_Cw_AdvancedController_movefund extends App_Event_WsEventAbstract  {

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
                        $pview->pageid = "advanced";

                        $uid = $session_data->userid;
                        $user = new App_User($uid);

                        $extendedcellphones = array();
                        $cellphones = $user->getFmtCellphones();

                        $d = new App_DocumentEngine();
                        foreach ($cellphones as $ck => $cv) {
                                $extendedcellphones[$ck] = count($d->getDocuments($cv['mobile_id']));
                        }

                        unset($session_data->ownedcell);

                        $pview->cellphones = $cellphones;
                        $pview->extcellphones = $extendedcellphones;
			App_DataUtils::commit();

    }
}
