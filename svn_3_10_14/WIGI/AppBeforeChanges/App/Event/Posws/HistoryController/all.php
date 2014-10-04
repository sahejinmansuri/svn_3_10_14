<?php

class App_Event_Posws_HistoryController_all extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'DATE' => array('generic', 50, 0, App_Constants::getFormLabel('DATE')),
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

        $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));

        $date = $this->_request->getParam('DATE');
        error_log("Date si $date");
        list($month,$day,$year) = explode('/',$date);

        $month = sprintf('%02s', $month);
        $day = sprintf('%02s', $day);

        $w = new App_WigiEngine();
        $trans = $w->getHistory($ns->mobileid,$ns->prefs["system"]["timezone"],"20","$year-$month-$day");


        $totals = $w->getHistory($ns->mobileid,$ns->prefs["system"]["timezone"],"1000000","$year-$month-$day");

        $stats["grand_total"]    = 0;
        $stats["charge_total"]   = 0;
        $stats["tax_total"]      = 0;
        $stats["tip_total"]      = 0;

        foreach ($totals as $row) {
          $stats["grand_total"]    += $row["amount"];
          $stats["charge_total"]   += $row["raw_amount"];
          $stats["tax_total"]      += $row["tax"];
          $stats["tip_total"]      += $row["tip"];
        }

        $stats["grand_total"]    = App_DataUtils::fmtMoney($stats["grand_total"]);
        $stats["charge_total"]   = App_DataUtils::fmtMoney($stats["charge_total"]);
        $stats["tax_total"]      = App_DataUtils::fmtMoney($stats["tax_total"]);
        $stats["tip_total"]      = App_DataUtils::fmtMoney($stats["tip_total"]);


        $result = array();
        $result['result']['status'] = 'success';
        $result['result']['value'] = '';
        $result['result']['data']   = $trans;
        $result['result']['stats']  = $stats;

        App_DataUtils::commit();

        return $result;

    }
}
