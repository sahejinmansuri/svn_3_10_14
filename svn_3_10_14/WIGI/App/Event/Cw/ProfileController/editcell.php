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
                                $last_name = $this->_request->getParam('LASTNAME');

                                $ucell = new App_Models_Db_Wigi_UserMobile();
                                $ucget = $ucell->fetchRow($ucell->select()->where('mobile_id = ?', $item));

                                $pview->ITEM = $item;

                                $pview->CELLDESC = $ucget['alias'];
                                $pview->LASTNAME = $ucget['last_name'];
                                $permission = $ucget['permission'];
								
								//$permission = str_replace('1','on',$permission);
								//$permission = str_replace('0','off',$permission);
								
								$permission_array = explode('|', $permission);
								
								$pview->profile = $permission_array[0];
								$pview->changepin = $permission_array[1];
								$pview->addmoney = $permission_array[2];
								$pview->withdrawmoney = $permission_array[3];
								$pview->secquestion = $permission_array[4];
								$pview->lockcell = $permission_array[5];
								

                                if ($this->_request->getParam('doaction') != null) {
								
										$rolestr = $cthis->getPermissionStringUser();
										$ucedit = $ucell->update(
                                                array('alias' => $alias, 'last_name' => $last_name, 'permission' => $rolestr),
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
