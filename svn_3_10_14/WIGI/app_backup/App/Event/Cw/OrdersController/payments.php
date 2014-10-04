<?php

class App_Event_Cw_OrdersController_payments extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'P'  => array('int', 25, 0, App_Constants::getFormLabel('PAGE')),
                'AF' => array('amount', 25, 0, App_Constants::getFormLabel('AMOUNT')),
                'AT' => array('amount', 25, 0, App_Constants::getFormLabel('AMOUNT')),
                'T'  => array('generic', 25, 0, App_Constants::getFormLabel('TYPE')),
                'DF' => array('date_d', 25, 0, App_Constants::getFormLabel('DATE')),
                'DT' => array('date_d', 25, 0, App_Constants::getFormLabel('DATE')),
                'M'  => array('generic', 25, 0, App_Constants::getFormLabel('BUSINESS_NAME')),
                'PT'  => array('generic', 25, 0, App_Constants::getFormLabel('PAYMENT_TYPE')),
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

                $pview->pageid = "orders";

                        $pview->tzpref = $session_data->prefs["system"]["timezone"];

                        $uid = $session_data->identity['userid'];
                        $user = new App_User($uid);

                        $cellphones = $user->getCellphones();
                        $pview->cellphones = $cellphones;

                        $merchantselection = Array();
                        if (count(App_Order::getDistinctBusinessName($uid)) > 0) {
                                $merchantselection = array_merge(App_Order::getDistinctBusinessName($uid), $merchantselection);
                        }
                        if (count(App_Order::getDistinctBusinessDBAName($uid)) > 0) {
                                $merchantselection = array_merge(App_Order::getDistinctBusinessDBAName($uid), $merchantselection);
                        }
                        $pview->merchantnames = $merchantselection;

                        $results_per_page = 20;

                        $o = new App_Order();

                        $tabs = Array(
                                "PS" => "payment"
                        );

                        $filters = Array(
                                "AF" => "AMOUNT_FROM",
                                "AT" => "AMOUNT_TO",
                                "DF" => "DATE_FROM",
                                "DT" => "DATE_TO",
                                "PT" => "PAYMENT_TYPE_TO",
                                "M" => "BUSINESS_NAME",
                                "S" => "STATUS"
                        );

                        $orders = Array();
                        foreach ($tabs as $tabid => $tab) {

                                $orders[$tab] = Array();
                                $getpage = $this->_request->getParam($tabid.'P');
                                if ($getpage > 0) {
                                        $page = $getpage;
                                } else {
                                        $page = 1;
                                }

                                $p = Array();

                                foreach ($filters as $f => $parameter) {
                                        $field = $tabid.$f;
                                        $fieldval = $this->_request->getParam($field);
                                        if ($fieldval != null || (is_numeric($fieldval) && $fieldval > 0)) {
                                                if (strstr($parameter, "DATE")) {
                                                        $p[$parameter] = App_DataUtils::fmtdate_human2db($fieldval);
                                                } else if ($parameter == "DEVICE") {
                                                        $cellobj = new App_Cellphone($fieldval);
                                                        if ($cellobj->getUserId() != $uid) {
                                                                throw new App_Exception_WsException('You do not own this device.');
                                                        }
                                                        $p[$parameter] = $fieldval;
                                                } else {
                                                        $p[$parameter] = $fieldval;
                                                }
                                                $pview->$field = $fieldval;
                                        } else {
                                                $pview->$field = "";
                                        }
                                }

                                $getorders = $o->getConsumerOrders($uid, $p, $tab, $page - 1, $results_per_page, $session_data->prefs["system"]["timezone"]);
                                $pages = ceil(($o->getConsumerOrders($uid, $p, $tab, $page - 1, $results_per_page,  $session_data->prefs["system"]["timezone"], true)) / $results_per_page);


                                $orders[$tab]["orders"] = Array();
                                foreach ($getorders as $order) {
                                        $orders[$tab]["orders"][] = $order;
                                }

                                $autofilters = Array();
                                foreach ($filters as $fid => $f) {
                                        $autofilters[$fid] = Array();
                                        unset($p[$f]);
                                }
                                $allinfo = $o->getMerchantOrders($uid, $p, $tab, 0, 1000, $session_data->prefs["system"]["timezone"]);
                                foreach ($allinfo as $info) {
                                        $autofilters["C"][$info['cellphone']] = $info['cellphone'];
                                        $autofilters["M"][$info['business_name']] = $info['business_name'];
                                }
                                $orders[$tab]["autofilters"] = $autofilters;

                                $orders[$tab]["pages"] = $pages;
                                $orders[$tab]["page"] = $page;

                        }

                        $pview->orders = $orders;

                        App_DataUtils::commit();

    }
}
