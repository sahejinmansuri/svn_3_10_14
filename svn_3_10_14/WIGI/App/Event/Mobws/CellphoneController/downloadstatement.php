<?php

require('/var/www/html/incash/svn/WIGI/App/fpdf.php');

class App_Event_Mobws_CellphoneController_downloadstatement extends App_Event_WsEventAbstract  {
	
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
                'MOBILE' => array('generic', 100, 1, App_Constants::getFormLabel('MOBILE')),
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
				$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));

                /*header("Content-type: text/csv");
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=InCashMe-Statement.csv");
                header("Content-Transfer-Encoding: binary");*/

                //$uid  = $session_data->identity['userid'];
				$uid = $this->_request->getParam('USER');
				$mobile_id = $this->_request->getParam('MOBILE');
				if($this->_request->getParam('MOBILE')){
					$mobile_id = $this->_request->getParam('MOBILE');
				}else{
					$mobile_id = $ns->mobileid;
					//$mobile_id = '821';
				}

				$c = new App_Cellphone($mobile_id);
				$cellphone = $c->getCellphone();

                $getdatefrom = $this->_request->getParam("from");
                $getdateto = $this->_request->getParam("to");

                $allusers = Array();
                $u = new App_Models_Db_Wigi_User();
                $udb = $u->fetchAll();
                foreach ($udb as $urow) {
                        $allusers[$urow['user_id']] = $urow;
                }
                $pview->allusers = $allusers;

                $allcells = Array();
                $c = new App_Models_Db_Wigi_UserMobile();
                $cdb = $c->fetchAll();
                foreach ($cdb as $crow) {
                        $allcells[$crow['mobile_id']] = $crow;
                }
                $pview->allcellphones = $allcells;

                $p = new App_Prefs();
                $prefs = $p->getWebUserPrefs($uid);
                $timezone = $prefs["system"]["timezone"];

                $w = new App_WigiEngine();

                //$statement = $w->getStatement($uid, $getdatefrom, $getdateto, $timezone);
				$statement = $w->getCellphoneStatement($mobile_id, $getdatefrom, $getdateto, $timezone);

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


               $result['result']['status'] = 'success';
		$result['result']['value']  = '';
		$result['result']['data']['totalending'] = $total;
		$result['result']['data']['totaltransactions'] = $transactions;
		$result['result']['data']['datefull'] = $pview->datefull;
		$result['result']['data']['datefrom'] = $pview->datefrom;
		$result['result']['data']['dateto'] = $pview->dateto;
		$result['result']['data']['email'] = $pview->email;
		$result['result']['data']['statement'] = $pview->statement;
		
		$from_date = $result['result']['data']['datefrom'];
		$to_date = $result['result']['data']['dateto'];
				
		foreach ($statement as $k=>$s) {
			foreach ($s['transactions'] as $k1=>$t) {

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
		//echo "<pre>";
		//echo "Cell Phone,Date,From,To,Description,Amount,Balance";
		//echo "\n";
		$result_csv_data = $result['result']['data']['statement'];
		//echo "<pre>";
		//print_r($result['result']['data']['datefrom']);
		
		$debit_card_funding = 0;
		$credit_card_funding = 0;
		$total_money_send = 0;
		$total_money_recieved = 0;
		$bank_funding = 0;
		$bank_withdraw = 0;
		$impc_redeemed = 0;
		$total_donation = 0;
		$scan_buy = 0;
		$scan_pay = 0;
		$scan_gift = 0;
		$scan_donate = 0;
		$info = array();
		foreach($result_csv_data as $key1=>$result_csv){
			foreach($result_csv['transactions'] as $key2=>$final_csv){
				//print_r($final_csv);
				$type = $final_csv['type'];
				if($type == ''){ //debit card fund
					$debit_card_funding = $debit_card_funding + $final_csv['amount'];
				}
				elseif($type == 300 || $type == 304){ //Credit card fund
					$credit_card_funding = $credit_card_funding + $final_csv['amount'];
				}
				elseif($type == 100){ //send money
					$total_money_send = $total_money_send + $final_csv['amount'];
				}
				elseif($type == 101){ //money recieved
					$total_money_recieved = $total_money_recieved + $final_csv['amount'];
				}
				elseif($type == 302 || $type == 305){ //bank funding
					$bank_funding = $bank_funding + $final_csv['amount'];
				}
				elseif($type == 303){ //bank withdraw
					$bank_withdraw = $bank_withdraw + $final_csv['amount'];
				}
				elseif($type == 207){ //impc_redeemed
					$impc_redeemed = $impc_redeemed + $final_csv['amount'];
				}
				elseif($type == 102){ //total_donation
					$total_donation = $total_donation + $final_csv['amount'];
				}
				elseif($type == 205){ //scan_buy
					$scan_buy = $scan_buy + $final_csv['amount'];
				}
				elseif($type == 206){ //scan_pay
					$scan_pay = $scan_pay + $final_csv['amount'];
				}
				elseif($type == 100){ //scan_gift
					$scan_gift = $scan_gift + $final_csv['amount'];
				}
				elseif($type == 100){ //scan_donate
					$scan_donate = $scan_donate + $final_csv['amount'];
				}
				$cellobj_f = new App_Cellphone($final_csv['from']);
                $uid_f = $cellobj_f->getUserId();
				$user_f = new App_User($uid_f);
				
				$first_name_f = $user_f->getFirstName();
				$last_name_f = $user_f->getLastName();
				$mobile_f = $cellobj_f->getCellphone();
				
				if(is_numeric($mobile_f)){
					$mobile_f = substr_replace($mobile_f, '-', 6, 0);
					$mobile_f = substr_replace($mobile_f, ')', 3, 0);
					$mobile_f = substr_replace($mobile_f, '(', 0, 0);
				}
		
				$from_text = $first_name_f." ".$last_name_f." ".$mobile_f;
				
				if($final_csv['to'] == 0){
					$to_text = "Self";
				}else{
					$cellobj_t = new App_Cellphone($final_csv['to']);
					$uid_t = $cellobj_t->getUserId();
					if($uid_t == ""){
						$to_text = "";
					}else{
						$user_t = new App_User($uid_t);
						
						$first_name_t = $user_t->getFirstName();
						$last_name_t = $user_t->getLastName();
						$mobile_t = $cellobj_t->getCellphone();
						
						if(is_numeric($mobile_t)){
							$mobile_t = substr_replace($mobile_t, '-', 6, 0);
							$mobile_t = substr_replace($mobile_t, ')', 3, 0);
							$mobile_t = substr_replace($mobile_t, '(', 0, 0);
						}
					
						$to_text = $first_name_t." ".$last_name_t." ".$mobile_t;
					}
				}
				
				$billing_charge = $final_csv['billing_amount'];
				
$str = $key1;
$str = substr_replace($str, '-', 6, 0);
$str = substr_replace($str, ')', 3, 0);
$str = substr_replace($str, '(', 0, 0);

				
				$info[]  = array('cellphone'=>$str,'date'=>$final_csv['stamp'],'from'=>$from_text,'to'=>$to_text,'description'=>$final_csv['description'],'amount'=>'₹'.number_format($final_csv['amount'], 2, '.', ''),'balance'=>'₹'.number_format($final_csv['balance'], 2, '.', ''),'billing_charge'=>$billing_charge);

				//echo $key1.",".$final_csv['stamp'].",".$from_text.",".$to_text.",".$final_csv['description'].",₹".number_format($final_csv['amount'], 2, '.', '').",₹".number_format($final_csv['balance'], 2, '.', '');
				//echo "\n";
			}
		}

$imagePath1 = '/var/www/html/incash/svn/WIGI/App/images/incashme_consumer.jpg';
$imagePath2 = '/var/www/html/incash/svn/WIGI/App/images/incashme_payment.jpg';
$imagePath3 = '/var/www/html/incash/svn/WIGI/App/images/incashme.jpg';

$pdf = new InvoicePDF('P','mm','Letter');
$pdf->AddPage();

$pdf->fillItems1($debit_card_funding,$credit_card_funding,$total_money_send,$total_money_recieved,$bank_funding, $bank_withdraw,$impc_redeemed,$total_donation,$scan_buy,$scan_pay,$scan_gift,$scan_donate,$cellphone);
$pdf->fillItems2($uid,$from_date, $to_date,$total);
$pdf->Image($imagePath1,10,10,65,0);
$pdf->Image($imagePath2,75,10,65,0);
$pdf->Image($imagePath3,143,10,65,0); 
$pdf->FillHeadInfo($info,$result['result']['data']['datefrom'],$result['result']['data']['dateto']); 

$pdf->FillItems();
$pdf->Output('filename.pdf','I');
		exit();
		//return $result;

        }
	
	
}
?>
