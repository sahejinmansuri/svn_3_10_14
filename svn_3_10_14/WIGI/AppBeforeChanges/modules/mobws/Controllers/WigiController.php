<?php

include(__DIR__ . '/RestController.php');

class Mobws_WigiController extends Mobws_RestController
{

        public function init() {
            parent::init();
            if ($_SERVER['REMOTE_ADDR'] !== $_SERVER['SERVER_ADDR']) {
                throw new App_Exception_WsException("INVALID REQUEST");
                exit();
            }
        }

        public function testcreditcardAction() {
                $userid       = $this->getRequest()->getParam("USERID");
                $passphrase   = $this->getRequest()->getParam("PASSPHRASE");
                $keyver       = $this->getRequest()->getParam("KEYVER");
                $creditcard   = $this->getRequest()->getParam("CREDITCARD");
                $amount       = $this->getRequest()->getParam("AMOUNT");
                $first_name   = $this->getRequest()->getParam("FIRST_NAME");
                $last_name    = $this->getRequest()->getParam("LAST_NAME");
                $name_on_card = $this->getRequest()->getParam("NAME_ON_CARD");
                $expire_month = $this->getRequest()->getParam("EXPIRE_MONTH");
                $expire_year  = $this->getRequest()->getParam("EXPIRE_YEAR");
                $type         = $this->getRequest()->getParam("TYPE");
                $processor    = $this->getRequest()->getParam("PROCESSOR");
                $cvv2         = $this->getRequest()->getParam("CVV2");
                $zip          = $this->getRequest()->getParam("ZIP");
                $address      = $this->getRequest()->getParam("ADDRESS");
                $state        = $this->getRequest()->getParam("STATE");


                $wst = new App_WigiSafe($userid,$passphrase,$keyver);
                $res = $wst->testCreditCard($creditcard,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$cvv2,$zip,$address,$state,$type,$processor);

                $result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);
        }

        public function testbankaccountAction() {
                $userid        = $this->getRequest()->getParam("USERID");
                $passphrase    = $this->getRequest()->getParam("PASSPHRASE");
                $keyver        = $this->getRequest()->getParam("KEYVER");
                $bankaccount   = $this->getRequest()->getParam("BANKACCOUNT");
                $amount        = $this->getRequest()->getParam("AMOUNT");
                $amount2       = $this->getRequest()->getParam("AMOUNT2");
                $routing       = $this->getRequest()->getParam("ROUTING");
                $first_name    = $this->getRequest()->getParam("FIRST_NAME");
                $last_name     = $this->getRequest()->getParam("LAST_NAME");
                $type          = $this->getRequest()->getParam("TYPE");
                $processor     = $this->getRequest()->getParam("PROCESSOR");
                $zip           = $this->getRequest()->getParam("ZIP");
                $address       = $this->getRequest()->getParam("ADDRESS");
                $state         = $this->getRequest()->getParam("STATE");


                $wst = new App_WigiSafe($userid,$passphrase,$keyver);
                $res = $wst->testBankAccount($bankaccount,$amount,$amount2,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor);

                $result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);
        
        }

	
        public function addcreditcardAction() {
		$userid     = $this->getRequest()->getParam("USERID");
		$passphrase = $this->getRequest()->getParam("PASSPHRASE");
		$keyver     = $this->getRequest()->getParam("KEYVER");
		$creditcard = $this->getRequest()->getParam("CREDITCARD");
		$username   = $this->getRequest()->getParam("USERNAME");
                $conf_number   = $this->getRequest()->getParam("CONF_NUMBER");

                $ws = new App_WigiSafe($userid,$passphrase,$keyver);
                $id = $ws->addCreditCard($creditcard,$conf_number,$username);

                $result = array();
                $result['status'] = 'success';
                $result['data']   = "$id";
                $this->sendResponse($result);
        }

        public function addbankaccountAction() {
		$userid      = $this->getRequest()->getParam("USERID");
		$passphrase  = $this->getRequest()->getParam("PASSPHRASE");
		$keyver      = $this->getRequest()->getParam("KEYVER");
		$bankaccount = $this->getRequest()->getParam("BANKACCOUNT");
		$username    = $this->getRequest()->getParam("USERNAME");
                $conf_number    = $this->getRequest()->getParam("CONF_NUMBER");

                $ws = new App_WigiSafe($userid,$passphrase,$keyver);
                $id = $ws->addBankAccount($bankaccount,$conf_number,$username);

                $result = array();
                $result['status'] = 'success';
                $result['data']   = "$id";
                $this->sendResponse($result);
        }

 	public function creditcardsaleAction() {

                $name_on_card   = $this->getRequest()->getParam("NAME_ON_CARD");
                $expire_month   = $this->getRequest()->getParam("EXPIRE_MONTH");
                $expire_year    = $this->getRequest()->getParam("EXPIRE_YEAR");
                $type           = $this->getRequest()->getParam("TYPE");
                $cvv2           = $this->getRequest()->getParam("CVV2");
                $zip            = $this->getRequest()->getParam("ZIP");
                $address        = $this->getRequest()->getParam("ADDRESS");
                $state          = $this->getRequest()->getParam("STATE");
                $creditcard     = $this->getRequest()->getParam("CREDITCARD");
                $processor      = $this->getRequest()->getParam("PROCESSOR");
                $amount         = $this->getRequest()->getParam("AMOUNT");
                $processor_transaction_id = $this->getRequest()->getParam("PROCESSOR_TRANSACTION_ID");


                $pg = new App_PaymentGateway($processor_transaction_id,$processor,$amount,$type,$creditcard,$expire_month,$expire_year,'first','last',$name_on_card,'',$cvv2,$zip,$address,$state,'1');
                $res = $pg->makeTransfer();

                $result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);

	}

	public function fromcreditcardtowigiAction() {

		$userid         = $this->getRequest()->getParam("USERID");
		$passphrase     = $this->getRequest()->getParam("PASSPHRASE");
		$keyver         = $this->getRequest()->getParam("KEYVER");
		$first_name     = $this->getRequest()->getParam("FIRST_NAME");
		$last_name      = $this->getRequest()->getParam("LAST_NAME");
		$name_on_card   = $this->getRequest()->getParam("NAME_ON_CARD");
		$expire_month   = $this->getRequest()->getParam("EXPIRE_MONTH");
		$expire_year    = $this->getRequest()->getParam("EXPIRE_YEAR");
		$type           = $this->getRequest()->getParam("TYPE");
		$processor      = $this->getRequest()->getParam("PROCESSOR");
		$accountid      = $this->getRequest()->getParam("ACCOUNTID");
		$amount	        = $this->getRequest()->getParam("AMOUNT");
                $zip            = $this->getRequest()->getParam("ZIP");
                $address        = $this->getRequest()->getParam("ADDRESS");
                $state          = $this->getRequest()->getParam("STATE");
                $processor_transaction_id = $this->getRequest()->getParam("PROCESSOR_TRANSACTION_ID");

		$ws = new App_WigiSafe($userid,$passphrase,$keyver);
		$res = $ws->fromCreditCardToWigi($processor_transaction_id,$accountid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor);
		
		$result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);
                
	}

	public function fromwigitocreditcardAction() {

		$userid         = $this->getRequest()->getParam("USERID");
		$passphrase     = $this->getRequest()->getParam("PASSPHRASE");
		$keyver         = $this->getRequest()->getParam("KEYVER");
		$first_name     = $this->getRequest()->getParam("FIRST_NAME");
		$last_name      = $this->getRequest()->getParam("LAST_NAME");
		$name_on_card   = $this->getRequest()->getParam("NAME_ON_CARD");
		$expire_month   = $this->getRequest()->getParam("EXPIRE_MONTH");
		$expire_year    = $this->getRequest()->getParam("EXPIRE_YEAR");
		$type           = $this->getRequest()->getParam("TYPE");
		$processor      = $this->getRequest()->getParam("PROCESSOR");
		$accountid      = $this->getRequest()->getParam("ACCOUNTID");
		$amount	        = $this->getRequest()->getParam("AMOUNT");
                $processor_transaction_id = $this->getRequest()->getParam("PROCESSOR_TRANSACTION_ID");

                $zip            = $this->getRequest()->getParam("ZIP");
                $address        = $this->getRequest()->getParam("ADDRESS");
                $state          = $this->getRequest()->getParam("STATE");


		$ws = new App_WigiSafe($userid,$passphrase,$keyver);
		$res = $ws->fromWigiToCreditCard($processor_transaction_id,$accountid,$amount,$first_name,$last_name,$name_on_card,$expire_month,$expire_year,$zip,$address,$state,$type,$processor);
		
		$result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);
	}

	public function frombankaccounttowigiAction() {

		$userid         = $this->getRequest()->getParam("USERID");
		$passphrase     = $this->getRequest()->getParam("PASSPHRASE");
		$keyver         = $this->getRequest()->getParam("KEYVER");
		$first_name     = $this->getRequest()->getParam("FIRST_NAME");
		$last_name      = $this->getRequest()->getParam("LAST_NAME");
		$type           = $this->getRequest()->getParam("TYPE");
		$processor      = $this->getRequest()->getParam("PROCESSOR");
		$accountid      = $this->getRequest()->getParam("ACCOUNTID");
		$amount	        = $this->getRequest()->getParam("AMOUNT");
		$routing        = $this->getRequest()->getParam("ROUTING");
                $zip            = $this->getRequest()->getParam("ZIP");
                $address        = $this->getRequest()->getParam("ADDRESS");
                $state          = $this->getRequest()->getParam("STATE");
                $processor_transaction_id = $this->getRequest()->getParam("PROCESSOR_TRANSACTION_ID");

		$ws = new App_WigiSafe($userid,$passphrase,$keyver);
		$res = $ws->fromBankAccountToWigi($processor_transaction_id,$accountid,$amount,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor);

		$result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);
	}

	public function fromwigitobankaccountAction() {

		$userid         = $this->getRequest()->getParam("USERID");
		$passphrase     = $this->getRequest()->getParam("PASSPHRASE");
		$keyver         = $this->getRequest()->getParam("KEYVER");
		$first_name     = $this->getRequest()->getParam("FIRST_NAME");
		$last_name      = $this->getRequest()->getParam("LAST_NAME");
		$type           = $this->getRequest()->getParam("TYPE");
		$processor      = $this->getRequest()->getParam("PROCESSOR");
		$accountid      = $this->getRequest()->getParam("ACCOUNTID");
		$amount	        = $this->getRequest()->getParam("AMOUNT");
		$routing        = $this->getRequest()->getParam("ROUTING");
                $processor_transaction_id = $this->getRequest()->getParam("PROCESSOR_TRANSACTION_ID");

                $zip            = $this->getRequest()->getParam("ZIP");
                $address        = $this->getRequest()->getParam("ADDRESS");
                $state          = $this->getRequest()->getParam("STATE");

		$ws = new App_WigiSafe($userid,$passphrase,$keyver);
		$res = $ws->fromWigiToBankAccount($processor_transaction_id,$accountid,$amount,$routing,$first_name,$last_name,$zip,$address,$state,$type,$processor);

		$result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);
	}

        public function adddocumentAction() {

                $userid         = $this->getRequest()->getParam("USERID");
                $passphrase     = $this->getRequest()->getParam("PASSPHRASE");
                $keyver         = $this->getRequest()->getParam("KEYVER");
                $version        = $this->getRequest()->getParam("VERSION");
                $number         = $this->getRequest()->getParam("NUMBER");
                $data           = $this->getRequest()->getParam("DATA");
                $data2          = $this->getRequest()->getParam("DATA2");

                $ws = new App_WigiSafe($userid,$passphrase,$keyver);
                $res = $ws->addDocument($version,$data,$data2,$number);

                $result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);

        }

        public function updatedocumentAction() {

                $userid         = $this->getRequest()->getParam("USERID");
                $passphrase     = $this->getRequest()->getParam("PASSPHRASE");
                $keyver         = $this->getRequest()->getParam("KEYVER");
                $version        = $this->getRequest()->getParam("VERSION");
                $number         = $this->getRequest()->getParam("NUMBER");
                $data           = $this->getRequest()->getParam("DATA");
                $data2          = $this->getRequest()->getParam("DATA2");
                $docid          = $this->getRequest()->getParam("DOCID");

                $ws = new App_WigiSafe($userid,$passphrase,$keyver);
                $res = $ws->updateDocument($docid,$version,$data,$data2,$number);

                $result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);

        }

        public function deletedocAction() {}

        public function getdocumentdataAction() {

                $userid         = $this->getRequest()->getParam("USERID");
                $keyver         = $this->getRequest()->getParam("KEYVER");
                $passphrase     = $this->getRequest()->getParam("PASSPHRASE");
                $docid          = $this->getRequest()->getParam("DOCID");
                $type           = $this->getRequest()->getParam("TYPE");

                $ws = new App_WigiSafe($userid,$passphrase,$keyver);
                $res = $ws->getDocumentData($docid,$type);

                $this->_helper->viewRenderer->setNoRender();
                echo $res;
                exit;

        }

        public function getdocumentAction() {

                $userid         = $this->getRequest()->getParam("USERID");
                $keyver         = $this->getRequest()->getParam("KEYVER");
                $passphrase     = $this->getRequest()->getParam("PASSPHRASE");
                $docid          = $this->getRequest()->getParam("DOCID");
                $ws = new App_WigiSafe($userid,$passphrase,$keyver);
                $res = $ws->getDocument($docid);


                $result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);

        }

        public function getcreditcardconfnumberAction() {

                $userid         = $this->getRequest()->getParam("USERID");
                $keyver         = $this->getRequest()->getParam("KEYVER");
                $passphrase     = $this->getRequest()->getParam("PASSPHRASE");
                $id             = $this->getRequest()->getParam("ID");
                $ws = new App_WigiSafe($userid,$passphrase,$keyver);
                $res = $ws->getCreditCardConfNumber($id);


                $result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);

        }

        public function getbankaccountconfnumberAction() {

                $userid         = $this->getRequest()->getParam("USERID");
                $keyver         = $this->getRequest()->getParam("KEYVER");
                $passphrase     = $this->getRequest()->getParam("PASSPHRASE");
                $id             = $this->getRequest()->getParam("ID");
                $ws = new App_WigiSafe($userid,$passphrase,$keyver);
                $res = $ws->getBankAccountConfNumber($id);


                $result = array();
                $result['status'] = 'success';
                $result['data']   = $res;
                $this->sendResponse($result);

        }


}
