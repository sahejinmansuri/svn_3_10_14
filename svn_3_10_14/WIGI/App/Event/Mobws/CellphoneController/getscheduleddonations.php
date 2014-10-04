<?php

class App_Event_Mobws_CellphoneController_getscheduleddonations extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'USER' => array('generic', 25, 1, App_Constants::getFormLabel('USER')),
                'MOBILE_ID' => array('generic', 255, 1, App_Constants::getFormLabel('MOBILE_ID')),
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

                /*$user_id     = $this->_request->getParam("USER");
                $mobile_id = $this->_request->getParam("MOBILE_ID");*/
                $timezone = '+5.5';
				
                //$code = $this->_request->getParam("CODE");
                $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Transaction',$ns->mobileid,'user_mobile','Delete WigiCode');
				
				$mobile_id = $ns->mobileid;
				$cell = new App_Cellphone($mobile_id);
				$user_id = $cell->getUserId();
                
                $p["CONSUMER_MOBILE_ID"] = $mobile_id;
                $p["STATUS"] = 'recurring';

                $results = App_Order::getConsumerOrdersRecurring($user_id,$p,'donate','0','1000',$timezone);
				//$results = App_Order::getConsumerOrders($user_id,$p,'donate','0','1000',$timezone);
				/*echo "<pre>";
				print_r($results);
				print_r($results1);
				exit();*/
			
                if (count($results) == 0) {
                    throw new App_Exception_WsException("No recurring donations available.");
                }
				$cfg = Zend_Registry::get('config');
				$basepath = $cfg->paths->baseurl;
				
				foreach($results as $key=>$val){
					$merchant_id = $val['merchant_user_id'];
					$merchant = new App_User($merchant_id);
					$m_image = $merchant->getImagePath();
					if($m_image == ""){
						$image_name = "";
					}else{
						$image_name = $basepath.'u/profile/'.$m_image;
					}
					$results[$key]['merchant']['image'] = $image_name;
					$results[$key]['merchant']['first_name'] = $merchant->getFirstName();
					$results[$key]['merchant']['last_name'] = $merchant->getLastName();
					$results[$key]['merchant']['business_name'] = $merchant->getBusinessName();
					$results[$key]['merchant']['appt_no'] = $merchant->getAppSuite();
					$results[$key]['merchant']['address_line1'] = $merchant->getAddress1();
					$results[$key]['merchant']['address_line2'] = $merchant->getAddress2();
					$results[$key]['merchant']['city'] = $merchant->getCity();
					$results[$key]['merchant']['state'] = $merchant->getState();
					$results[$key]['merchant']['country'] = $merchant->getCountry();
					$results[$key]['merchant']['zipcode'] = $merchant->getZip();
					
				}
				/*echo "<pre>";
				print_r($results);
				exit();*/
                $result = array();
                $result['result']['status'] = 'success';
                $result['result']['value'] = '';
                $result['result']['data']   = $results;

                App_DataUtils::commit();
                return $result;
    }
}
