<?php

class App_Event_Cw_HistoryController_home extends App_Event_WsEventAbstract  {

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
                'M'  => array('int', 25, 0, App_Constants::getFormLabel('PHONE')),
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
                $pview->pageid = "history";
                $uid  = $session_data->identity['userid'];
                $getpage = $this->_request->getParam('P');
                $getamountfrom = $this->_request->getParam('AF');

                $getamountto = $this->_request->getParam('AT');

                $gettype = $this->_request->getParam('T');

                $getdatefrom = $this->_request->getParam('DF');

                $getdateto = $this->_request->getParam('DT');

                $getmobileid = $this->_request->getParam('M');

                if ($getmobileid > 0) App_Resource::consumerIsAuthorized ("CELLPHONE",$uid,$getmobileid);

                $user = new App_User($uid);

                $cellphones = $user->getCellphones();
                $pview->cellphones = $cellphones;

                $pview->tzpref = $session_data->prefs["system"]["timezone"];

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

		$results_per_page = 20;
		
                $p = Array();
		
		$p["RPP"] = $results_per_page;
		
                if ($getpage > 0) {
                        $page = $getpage;
                } else {
                        $page = 1;
                }
                $p["PAGE"] = $page - 1;

                $p["USER_ID"] = $uid;
                $pview->selectedcell = "";
                if ($getmobileid > 0) {
                        $p["CELLPHONE_FROM"] = $getmobileid;
                        $pview->selectedcell = $getmobileid;
                } 

                $pview->selectedamountfrom = "";
                if ($getamountfrom > 0) {
                        $p["AMOUNT_FROM"] = $getamountfrom;
                        $pview->selectedamountfrom = $getamountfrom;
                } 

                $pview->selectedamountto = "";
                if ($getamountto > 0) {
                        $p["AMOUNT_TO"] = $getamountto;
                        $pview->selectedamountto = $getamountto;
                } 

                $pview->selectedtype = "";
                if ($gettype != null) {
                        $p["TRANSACTION_TYPE"] = $gettype;
                        $pview->selectedtype = $gettype;
                }

                $pview->selecteddatefrom = "";
                if ($getdatefrom != null) {
                        $p["DATE_FROM"] = App_DataUtils::fmtdate_human2db($getdatefrom);
                        $pview->selecteddatefrom = ($getdatefrom);
                }

                $pview->selecteddateto = "";
                if ($getdateto != null) {
                        $p["DATE_TO"] = App_DataUtils::fmtdate_human2db($getdateto);
                        $pview->selecteddateto = ($getdateto);
                }

                $t = new App_Transaction_Transaction();
				//print_r($p); 

                $r = $t->search($p,$session_data->prefs["system"]["timezone"]);
				//print_r($r);
		$allpages = ceil(($t->search($p,$session_data->prefs["system"]["timezone"],true))/$results_per_page);

                $res = array();
                foreach ($r as $row) {
				//echo "test";
                        $res[] = $row;
                }

                $resinfo = Array();
                foreach ($res as $r) {
				//echo "test";
                        $t = new App_Transaction_Transaction($r['transaction_id'],$session_data->prefs["system"]["timezone"]);
                        $resinfo[$r['transaction_id']] = $t->getInfo();
						//print_r($t);
                }
				
		
		
		$searchData = App_SearchOptionsUtils::getSearchData('CONSUMERS_TRANSACTIONS');
		if(@class_exists($searchData['class_name']))
        {
            $srchObj = new $searchData['class_name']();
        }else
        {
            return 0;
        }

        $select = $srchObj->select();
        $w = $searchData['field_name']." = ?";
        $orderby = $searchData['order_by'];

        $select->where($w,$uid);
        if($searchData['has_status'])
        {
            $select->where('status = ?','active');
        }
        
        $select->order($orderby);
        $select->limit(50);

        $raw = $srchObj->fetchAll($select);
        $finalResults = $raw->toArray();
		
		$res_final_info = array();
		foreach($finalResults as $key1=>$val){
			$key = $val['transaction_id'];
			$res_final_info[$key]['Transaction ID'] = $val['transaction_id'];
			$res_final_info[$key]['Type'] = $val['type'];
			$res_final_info[$key]['Direction'] = $val['direction'];
			$res_final_info[$key]['Description'] = $val['description'];
			$res_final_info[$key]['From User Desc'] = $val['from_user_id_description'];
			$res_final_info[$key]['To User Desc'] = $val['to_user_id_description'];
			$res_final_info[$key]['Mobile Id'] = $val['from'];
			$res_final_info[$key]['GPS Coordinates'] = $val['gps'];
			$res_final_info[$key]['To Description'] = $val['to_description'];
			$res_final_info[$key]['Device Model'] = $val['device_model'];
			$res_final_info[$key]['Balance'] = $val['balance'];
			$res_final_info[$key]['Temp Balance'] = $val['temp_balance'];
			$res_final_info[$key]['IMPC'] = $val['wigi_code_id'];
			$res_final_info[$key]['Order Id'] = $val['order_id'];
			$res_final_info[$key]['Tax'] = $val['tax'];
			$res_final_info[$key]['Settled'] = $val['settled'];
		}
		
        $finalRes=array();

		

                $pview->trans     = $res;
                //$pview->transinfo = $resinfo;
                $pview->transinfo = $res_final_info;
                $pview->pages     = $allpages;
                $pview->page      = $page;

                App_DataUtils::commit();

                return $pview;
   

    }
}