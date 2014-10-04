<?php

class App_Event_Aw_ConsumerProfileController_savebilling extends App_Event_WsEventAbstract  {

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
    
    public function execute(&$uid,&$pview,&$cthis, &$identity){
                $pview->pageid = "consumerprofile";

				$list = App_Transaction_Type::getConstName();
				$this->view->typelist = $list;
				$fixedStr='';

				foreach($list as $id=>$data)
				{
					if($this->_request->getParam($id.'_type'))
					{
						$fixedStr .= $id.'-'.$this->_request->getParam($id.'_type').'-'.$this->_request->getParam($id.'_value').'|';
					}
				}

				$us = new App_Models_Db_Wigi_WigiUserSettings();
				$u1['status']='I';
				$u1['usermodified']=$identity['userid'];
				$u1['datecreated']=new Zend_Db_Expr('NOW()');
				$us->update($u1, array(
					'user_id = ? ' => $uid,
					'category = ? ' => 'wigi billing',
					'status = ? ' => 'A',
				));
		
				
				$r=array();
				$r['user_id']=$uid;
				$r['category']='wigi billing';
				$r['status']='A';
				$r['value']=$fixedStr;
				$r['useradded']=$identity['userid'];
				$r['datecreated']=new Zend_Db_Expr('NOW()');
				$us->insert($r);
    }
}
