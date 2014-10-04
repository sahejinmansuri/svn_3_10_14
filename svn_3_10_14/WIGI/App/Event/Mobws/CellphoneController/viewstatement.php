<?php

class App_Event_Mobws_CellphoneController_viewstatement extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'from' => array('generic', 100, 0, App_Constants::getFormLabel('DATE')),
				'to' => array('generic', 100, 0, App_Constants::getFormLabel('DATE')),
                'USER' => array('generic', 100, 1, App_Constants::getFormLabel('USER')),
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
		
        //$uid  = $session_data->identity['userid'];
		$uid = $this->_request->getParam('USER');
        $user = new App_User($uid);

        $getdatefrom = $this->_request->getParam("from");
        $getdateto = $this->_request->getParam("to");

        $allusers = Array();
        $u = new App_Models_Db_Wigi_User();
        $udb = $u->fetchAll();
        foreach ($udb as $urow) {
                $allusers[$urow['user_id']] = $urow;
        }
        $pview->allusers = $allusers;

        $country_code = $user->getCountryCode();
        $allcells = Array();
        $c = new App_Models_Db_Wigi_UserMobile();
        $cdb = $c->fetchAll();
        foreach ($cdb as $crow) {
                $allcells[$crow['mobile_id']] = $crow;
        }
        $pview->allcellphones = $allcells;
        $pview->countrycode = $country_code;

        $p = new App_Prefs();
        $prefs = $p->getWebUserPrefs($uid);
        $timezone = $prefs["system"]["timezone"];

        $w = new App_WigiEngine();

        $statement = $w->getStatement($uid, $getdatefrom, $getdateto, $timezone);

        $total = 0;
        $transactions = 0;
        foreach ($statement as $s) {
            $i = 0;
            foreach ($s['transactions'] as $t) {
                if ($i == 0) {
                    if ($t['balance'] > 0) {
                        $total += $t['balance'];
                    }
                    $i++;
                }
                $transactions += $t['amount'];
            }
        }

        $pview->totalending = $total;
        $pview->totaltransactions = $transactions;

        $pview->datefull = date("F, Y", strtotime($getdatefrom));
        $pview->datefrom = date("M d, Y", strtotime($getdatefrom));
        $pview->dateto = date("M d, Y", strtotime($getdateto));

        $pview->email = $session_data->identity['email'];
        $pview->statement = $statement;
        $pview->tzpref = $timezone;
		//echo "<pre>";
		//print_r($pview);
		
		$result['result']['status'] = 'success';
		$result['result']['value']  = '';
		$result['result']['data']['totalending'] = $total;
		$result['result']['data']['totaltransactions'] = $transactions;
		$result['result']['data']['datefull'] = $pview->datefull;
		$result['result']['data']['datefrom'] = $pview->datefrom;
		$result['result']['data']['dateto'] = $pview->dateto;
		$result['result']['data']['email'] = $pview->email;
		$result['result']['data']['statement'] = $pview->statement;
				
		foreach ($statement as $k=>$s) {
			foreach ($s['transactions'] as $k1=>$t) {
				//print_R($t);
				$result['result']['data']['statement'][$k]['transactions'][$k1] = array();
				$result['result']['data']['statement'][$k]['transactions'][$k1]['transaction_id'] = $t->transaction_id;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['type'] = $t->type;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['direction'] = $t->direction;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['amount'] = $t->amount;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['from'] = $t->from;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['from_description'] = $t->from_description;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['to'] = $t->to;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['to_description'] = $t->to_description;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['description'] = $t->description;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['viewed'] = $t->viewed;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['stamp'] = $t->stamp;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['ip_address'] = $t->ip_address;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['gps'] = $t->gps;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['server_datetime'] = $t->server_datetime;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['client_datetime'] = $t->client_datetime;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['app_name'] = $t->app_name;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['app_version'] = $t->app_version;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['device_model'] = $t->device_model;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['os'] = $t->os;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['browser_string'] = $t->browser_string;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['language'] = $t->language;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['os_id'] = $t->os_id;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['system_name'] = $t->system_name;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['system_version'] = $t->system_version;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['balance'] = $t->balance;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['temp_balance'] = $t->temp_balance;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['tip'] = $t->tip;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['tax'] = $t->tax;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['raw_amount'] = $t->raw_amount;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['pos_name'] = $t->pos_name;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['wigi_code_id'] = $t->wigi_code_id;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['order_id'] = $t->order_id;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['billing_amount'] = $t->billing_amount;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['processor_transaction_id'] = $t->processor_transaction_id;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['user_description'] = $t->user_description;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['from_user_id'] = $t->from_user_id;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['to_user_id'] = $t->to_user_id;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['from_user_id_description'] = $t->from_user_id_description;
				$result['result']['data']['statement'][$k]['transactions'][$k1]['to_user_id_description'] = $t->to_user_id_description;
			}
		}
		$result['result']['data']['tzpref'] = $pview->tzpref;

        App_DataUtils::commit();
		return $result;

	}
	
}

?>
