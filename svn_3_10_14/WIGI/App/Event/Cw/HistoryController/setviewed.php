<?php

class App_Event_Cw_HistoryController_setviewed extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'TID'  => array('int', 25, 1, App_Constants::getFormLabel('TRANSACTIONID')),
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
                $uid  = $session_data->identity['userid'];
                $tid = $this->_request->getParam("TID");

                $w = new App_Models_Db_Wigilog_Transaction();
                $w->update(
                        array(
                                'viewed' => 1
                        ),
                        array(
                                $w->getAdapter()->quoteInto('transaction_id = ?', $tid),
                        )
                );

                App_DataUtils::commit();

    }
}
