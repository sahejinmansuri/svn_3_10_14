<?php

class App_Event_Cw_ProfileController_editcell extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'ITEM'  => array('generic', 100, 1, App_Constants::getFormLabel('ITEM')),
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
                $uid = $session_data->identity['userid'];
                $item = $this->_request->getParam("ITEM");
                App_Resource::consumerIsAuthorized('CELLPHONE',$uid,$item);

                $pview->pageid = "profile";

                $pview->showcontent = "form";
                        if ($item != null && is_numeric($item)) {

                                $alias = $this->_request->getParam('CELLDESC');

                                $ucell = new App_Models_Db_Wigi_UserMobile();
                                $ucget = $ucell->fetchRow($ucell->select()->where('mobile_id = ?', $item));

                                $pview->ITEM = $item;

                                $pview->CELLDESC = $ucget['alias'];

                                if ($this->_request->getParam('doaction') != null) {

                                        $ucedit = $ucell->update(
                                                array('alias' => $alias),
                                                $ucell->getAdapter()->quoteInto('mobile_id = ?', $item)
                                        );

                                        $pview->showcontent = "success";

                                }

                        } else {

                                $pview->ITEM = "";

                        }

                        App_DataUtils::commit();
    }
}
