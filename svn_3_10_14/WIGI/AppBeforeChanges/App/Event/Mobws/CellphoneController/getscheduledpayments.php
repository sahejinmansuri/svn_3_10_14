<?php

class App_Event_Mobws_CellphoneController_getscheduledpayments extends App_Event_WsEventAbstract {

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
    
    public function execute(){
                App_DataUtils::beginTransaction();
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get Scheduled Payments');

                $p["CONSUMER_MOBILE_ID"] = $ns->mobileid;
                $p["STATUS"] = "scheduled";
                $raw = App_Order::getConsumerOrders($ns->userid,$p,'pay','0','50',$ns->prefs["system"]["timezone"]);

                $res = array();
                foreach ($raw as $row) {
                    $t = array();
                    $t['ORDER_ID']                 = $row['order_id'];
                    $t['ACCT_NO']                  = $row['user_acct_no'];
                    $t['INVOICE_NO']               = $row['merchant_order_id']; 
                    $t['MERCHANT_NAME']            = $row['business_name'];
                    $t['BUSINESS_DBA_NAME']        = $row['business_dba_name'];
                    $t['AMOUNT']                   = App_DataUtils::fmtMoney($row['price']);
                    $t['DUE_DATE']                 = App_DataUtils::datetime_fmtdate($row['due_date'],'0.0');
                    $t['SCHEDULED_DATE']           = App_DataUtils::datetime_fmtdate($row['payment_scheduled_date'],'0.0');
                    $t['MERCHANT_ID']              = "";

                    array_push($res,$t);
                }

               if (count($res) == 0) {
                 throw new App_Exception_WsException("No scheduled payments available");
                 return false;
               }

                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $res;

                App_DataUtils::commit();
                return $result;
    }
}
