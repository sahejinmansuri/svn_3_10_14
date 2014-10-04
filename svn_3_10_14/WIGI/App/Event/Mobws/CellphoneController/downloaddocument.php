<?php

require('/var/www/html/incash/svn/WIGI/App/fpdf.php');

class App_Event_Mobws_CellphoneController_downloaddocument extends App_Event_WsEventAbstract  {
	
	/**
	 * @param Zend_Controller_Request_Abstract $request 
	 */
	public function __construct(Zend_Controller_Request_Abstract $request = null) {
		parent::__construct($request);
		$this->_evt_data = array(
			'inputs' => array(
				'DOCID' => array('generic', 100, 0, App_Constants::getFormLabel('DOCID')),
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

                $docid = $this->_request->getParam("DOCID");
				$mobile = $this->_request->getParam('MOBILE');
				
				$cellphone = new App_Cellphone($mobile);
				$userid = $cellphone->getUserId();
				$user = new App_User($userid);
				
				$de = new App_DocumentEngine();
                $res = $de->getDocument($mobile,$docid);
                $res_front = $de->getDocumentData($mobile,$docid,'FRONT');
                $res_back = $de->getDocumentData($mobile,$docid,'BACK');
				
				$user_name = $user->getFirstName()." ".$user->getLastName();
				
				$fileType = 'image/jpeg';
				
				if($res_front != ""){
					$data = $res_front;
				}else{
					$data = "";
				}
				if($res_back != ""){
					$data2 = $res_back;
				}else{
					$data2 = "";
				}
				
				$doctype = $res['type'];
				$docnumber = $res['number'];
				$docdesc = $res['description'];
				$docexpiration = $res['expiration'];
				
		$fileName = 'document_front.jpg';
		$fileName2 = 'document_back.jpg';
		$path = '/var/www/html/incash/u/data/'.$docid.'/';
		
		$path1 = "";
		$path2 = "";
		
		if($data != ""){
			file_put_contents($path.$fileName,base64_decode($data));
			$path1 = $path.$fileName;
		}	
		if($data2 != ""){
			file_put_contents($path.$fileName2,base64_decode($data2));
			$path2 = $path.$fileName2;
		}			

$imagePath3 = '/var/www/html/incash/svn/WIGI/App/images/incashme.jpg';

$pdf = new InvoicePDF('P','mm','Letter');
$pdf->AddPage();

$pdf->fillItems_doc($user_name,$doctype,$docnumber,$docdesc,$docexpiration,$path1,$path2,$docid);

$pdf->Image($imagePath3,70,10,65,0); 

$pdf->Output('filename.pdf','I');
		exit();
		//return $result;

        }
	
	
}
?>
