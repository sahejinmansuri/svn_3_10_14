<?php

class App_Event_Cw_ProfileController_linkcell extends App_Event_WsEventAbstract  {

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
    
    public function execute(&$session_data,&$pview,&$cthis){


                App_DataUtils::beginTransaction();

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     

                $pview->pageid = "profile";

                $pview->showcontent = "form";


                        $uid = $session_data->identity['userid'];
                        $user = new App_User($uid);

                        $creditcards = $user->getCreditCards();
                        $bankaccounts = $user->getBankAccounts();

                        $item = $this->_request->getParam("ITEM");
                        $itemtype = substr($item, 0, 2); // ba: bankaccount, cc: creditcard
                        $itemid = substr($item, 2);
                        if ($itemtype != false && is_numeric($itemid)) {

                                $pview->ITEM = $item;

                                $foundaccount = false;
                                if ($itemtype == "ba") {
                                        $creditcards = Array();
                                        foreach ($bankaccounts as $ba) {
                                                if ($itemid == $ba->id) {
                                                        $bankaccounts = Array($ba);
                                                        $foundaccount = true;
                                                }
                                        }
                                } elseif ($itemtype == "cc") {
                                        $bankaccounts = Array();
                                        foreach ($creditcards as $cc) {
                                                if ($itemid == $cc->id) {
                                                        $creditcards = Array($cc);
                                                        $foundaccount = true;
                                                }
                                        }
                                }
                                if (!$foundaccount) {
                                        $bankaccounts = Array();
                                        $creditcards = Array();
                                }

                                $allaccounts = Array();
                                foreach ($creditcards as $ccard) {
                                        $allaccounts["cc".$ccard['id']] = $ccard;
                                }
                                foreach ($bankaccounts as $baccount) {
                                        $allaccounts["ba".$baccount['id']] = $baccount;
 }

                                $cellphones = $user->getFmtCellphones();
                                $pview->cellphones = $cellphones;
                                $pview->moneysources = $allaccounts;

                                $links = Array();
                                foreach($cellphones as $c) {
                                        $cell = new App_Cellphone($c['mobile_id']);
                                        $getlba = $cell->getLinkedBankAccounts();
                                        $getlcc = $cell->getLinkedCards();

                                        foreach ($getlba as $lbar) {
                                                $links["ba".$lbar['id']][] = $c['mobile_id'];
                                        }
                                        foreach ($getlcc as $lccr) {
                                                $links["cc".$lccr['id']][] = $c['mobile_id'];
                                        }
                                }
                                $pview->existinglinks = $links;

                                if ($this->_request->getParam('doaction') != null) {

                                        foreach($creditcards as $cc) {
                                                $user->resetAccountLinks($cc->id, "cc");
                                        }
                                        foreach($bankaccounts as $ba) {
                                                $user->resetAccountLinks($ba->id, "ba");
                                        }

                                        $getlinks = $this->_request->getParam("LINKEDCELLPHONES");
                                        foreach ($getlinks as $linkaccount => $linkcellphones) {
                                                $linktype = substr($linkaccount, 0, 2); // ba: bankaccount, cc: creditcard
                                                $linkid = substr($linkaccount, 2);
                                                if ($linktype == "ba") {
                                                        foreach ($linkcellphones as $lc) {
                                                                $user->linkBankAccountToCellphone($lc, $linkid);
                                                        }
                                                }
                                                if ($linktype == "cc") {
                                                        foreach ($linkcellphones as $lc) {
                                                                $user->linkCreditCardToCellphone($lc, $linkid);
                                                        }
                                                }
                                        }

                                        $pview->showcontent = "success";

                                }

                        } else {

                                $pview->ITEM = "";
                                $pview->moneysources = Array();

                        }

                        App_DataUtils::commit();


    }
}
