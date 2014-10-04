<?php

class App_Event_Mobws_CellphoneController_getstatement extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
			'inputs' => array(
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
				$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
				
				//$checkpermission = $cthis->checkpermission($ns->mobileid,'',5);

                $pview->pageid = "statements";

                        //$uid  = $session_data->identity['userid'];
						$uid = $this->_request->getParam('USER');

                        $p = new App_Prefs();
                        $prefs = $p->getWebUserPrefs($uid);

                        $w = new App_WigiEngine();
                        $timezone = $prefs["system"]["timezone"];

                        $uinfo = new App_Models_Db_Wigi_User();
                        $uinfof = $uinfo->fetchRow($uinfo->select()->from($uinfo,
                                array('date_added')
                        )->where('user_id = ?', $uid));

                        $accountcreated = strtotime($uinfof['date_added']);

                        $dates = Array();
                        $datescount = Array();
                        $m = new Zend_Date();
                        for ($i=0; $i<12; $i++) {
                                $m->subMonth(1);
                                $lastday = $m->get(Zend_Date::MONTH_DAYS);
                                $m->set($lastday, Zend_Date::DAY);
                                $m->set('23:59:59', Zend_Date::TIMES);
                                if ($m->get(Zend_Date::TIMESTAMP) >= $accountcreated) {
                                        $date = $m->toArray();
                                        /*if (!array_key_exists($date['year'] , $dates)) {
                                                //$dates[$date['year']] = Array();
                                                //$datescount[$date['year']] = Array();
                                        }*/
                                        $datefrom = $date['year']."-".$date['month']."-1";
                                        $dateto = $date['year']."-".$date['month']."-".$date['day'];
                                        $statement = $w->getStatement($uid, $datefrom, $dateto, $timezone);
                                        $statement_count = 0;
                                        foreach ($statement as $s) {
                                                $statement_count += count($s['transactions']);
                                        }
										$date['statement_count'] = $statement_count;
										
										$cfg = Zend_Registry::get('config');
										$basepath = $cfg->paths->baseurl;
										
										$url = $basepath."v2/mobws/cellphone/downloadstatement?";
										
										$date['view_url'] = $url."USER=".$uid."&from=".$datefrom."&to=".$dateto."&MOBILE=".$ns->mobileid;
                                        //$dates[$date['year']][$date['month']] = $date;
                                        //$datescount[$date['year']][$date['month']] = $statement_count;
										$dates[] = $date;
                                        //$dates[$date['year']][$date['month']] = $statement_count;
                                }
                        }

                        $pview->dates = $dates;
                        //$pview->datescount = $datescount;
						//echo "<pre>";
						//print_r($dates);
						//print_r($datescount);
						
if (count($dates) == 0) {
        throw new App_Exception_WsException("Your Account has no statements, Wait till the end of the month to avail your statement");
        return false;
    }
						/*$dataRes=array('title'=>'Cellphone Added','message'=>'Your cellphone has been added. One more step to go! We will now send you sms to verify the cellphone');*/
						$result['result']['status'] = 'success';
						$result['result']['value']  = '';
						//$result['result']['data']['datescount']   = $datescount;
						$result['result']['data']['dates']   = $dates;
						$result['result']['data']['key'] = Zend_Session::getId();
//print_r($result);
                        
                        App_DataUtils::commit();
						return $result;

    }
}
