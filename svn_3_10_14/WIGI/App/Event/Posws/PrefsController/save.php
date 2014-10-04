<?php

class App_Event_Posws_PrefsController_save extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'STAX' => array('generic', 50, 1, App_Constants::getFormLabel('STAX')),
                'TIPS' => array('generic', 50, 1, App_Constants::getFormLabel('TIPS')),
                'DNAME' => array('generic', 50, 1, App_Constants::getFormLabel('DNAME')),
                'TIPVAL' => array('generic', 50, 1, App_Constants::getFormLabel('TIPVAL')),

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

        $stax  = $this->_request->getParam('STAX');
        $tips  = $this->_request->getParam('TIPS');
        $dname = $this->_request->getParam('DNAME');
        $tipval = $this->_request->getParam('TIPVAL');

        $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
        $prefs = $ns->prefs;
        $prefs['salestax'] = $stax;
        $prefs['tips']     = $tips;
        $prefs['tipval']     = $tipval;
        $prefs['dname']    = $dname;

        $p       = new App_Prefs();
        $p->saveWebUserPrefs( $ns->parentid, $prefs  ,'mw');

        $result = array();
        $result['result']['data']   = '';
        $result['result']['status'] = 'success';

        App_DataUtils::commit();

        return $result;

    }
}
