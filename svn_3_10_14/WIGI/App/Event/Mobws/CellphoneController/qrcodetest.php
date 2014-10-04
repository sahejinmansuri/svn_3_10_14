<?php

class App_Event_Mobws_CellphoneController_qrcodetest extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'WIGICODE' => array('wigicode', 15, 1, App_Constants::getFormLabel('WIGICODE')),
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

		$uinfo = new App_Models_Db_Wigilog_Transaction();
		
		$select1 = $uinfo->select();
		$raws = $uinfo->fetchAll($select1);
		echo "<pre>";
		$i = 0;
		foreach($raws as $key=>$val){
			if($i > 150 && $i < 170){
				if($val['direction'] == 'INFO'){
					$settled = 'N/A';
				}else{
					$settled = 'Yes';
				}
				$desc = $val['description'];
				//echo $desc;
				$find = 'IMPCÃ¢â€žÂ¢';
				$replace = 'IMPC™';
				$desc1 = str_replace($find, $replace, $desc);
				echo "<br>";
				echo $settled;
				//echo "<br><br>";
				$uinfof = $uinfo->update(
					array(
						'description' => $desc1,
						'settled' => $settled
					),
					$uinfo->getAdapter()->quoteInto('transaction_id = ?', $val['transaction_id'])
				);
			}
			$i++;
		}
		exit();
		/*$uinfof = $uinfo->update(
			array(
				'image_path' => $image_name,
				'image_path2' => $image_name
			),
			$uinfo->getAdapter()->quoteInto('user_id = ?', $userid)
        );*/
		
		/*$ns->mobileid = '821';
		$ns->userid = '692';
		$to_user_id = '559';
		
		$p["CONSUMER_MOBILE_ID"] = $ns->mobileid;
        $p["STATUS"] = 'recurring';
		$timezone = '+5.5';

        $results = App_Order::getConsumerOrdersRecurring($ns->userid,$p,'donate','0','1000',$timezone);
		$flag = 0;
		$now = time() + (24 * 60*60*59);
		foreach($results as $key=>$val){
			$merchant_id = $val['merchant_user_id'];
			$donate_end_date = $val['donate_end_date'];
			$donate_start_date = $val['donate_start_date'];
			if($merchant_id == $to_user_id){
				echo $donate_end_date."<br>";
				$time_end = $val['time_end'];
				if($now < $time_end){
					$flag = 1;
				}
			}
		}
		
		if($flag == 1){
			echo "error";
		}
		exit();*/
        /*$s   = $this->_request->getParam("WIGICODE");  
        
		$encrypt = App_Encrypt::encrypt($s,'1');
		
		$color_code = '#000000';
		$code_params = array('text'            => "$encrypt",
          'backgroundColor' => '#FFFFFF',
          'foreColor' => $color_code,
          'padding' => 2,  //array(10,5,10,5),
          'moduleSize' => 8,
		  'newcolor' => '#0000ff'
		);
			
		$renderer_params = array('imageType' => 'png');
		try{
			Zend_Matrixcode::render('qrcode', $code_params, 'image', $renderer_params);
          }catch(Exception $e){
            error_log("error rendering wigiqr ". $e->getMessage());
          }*/

		/*$passphrase = file_get_contents("/var/www/html/incash/etc/wigi-keys/v1/passphrase");
		$decrypt = App_DataUtils::unobfuscate($s);
		echo $decrypt;
		exit();
		error_log("wigiqr is = ". $decrypt);
		 
        /*$code_params = array('text'            => "$s",
			'backgroundColor' => '#FFFFFF',
			'foreColor' => '#000000',
			'padding' => 2,  //array(10,5,10,5),
			'moduleSize' => 8,
			'newcolor' => '#0000ff'
		);

        App_DataUtils::commit();

        $renderer_params = array('imageType' => 'png');
        try{
			Zend_Matrixcode::render('qrcode', $code_params, 'image', $renderer_params);
        }catch(Exception $e){
			error_log("error rendering wigiqr ". $e->getMessage());
        }
          error_log("finished rendering wigiqr");*/


    }
}
