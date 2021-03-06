<?php

class App_Event_Posws_MainmenuController_addsubmenu extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'MENUID' => array('generic', 25, 1, App_Constants::getFormLabel('MENUID')),
                'TITLE' => array('generic', 25, 1, App_Constants::getFormLabel('TITLE')),
                'DESCRIPTION' => array('generic', 255, 1, App_Constants::getFormLabel('DESCRIPTION')),
                'RATE' => array('generic', 255, 1, App_Constants::getFormLabel('RATE')),
                'QUANTITY' => array('generic', 255, 1, App_Constants::getFormLabel('QUANTITY')),
               
               
            )
        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute()
    {
    	App_DataUtils::beginTransaction();
		$menuid     = $this->_request->getParam("MENUID");
		$title     = $this->_request->getParam("TITLE");
      $description = $this->_request->getParam("DESCRIPTION");
      $rate = $this->_request->getParam("RATE");
      $quantity = $this->_request->getParam("QUANTITY");
      $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
      $upload = new Zend_File_Transfer_Adapter_Http();
      $upload->setDestination("/var/www/html/incash/public_html/u/data");
      $upload->receive();
      $filename  = $upload->getFileName('MENUSUBIMG');
      $data  = base64_encode(file_get_contents($filename));
      $de = new App_MainmenuEngine();
      $id = $de->addsubmenu($ns->mobileid,$menuid, $title,$description, $data, $rate, $quantity);
 		$result = array();
      $result['result']['status'] = 'success';
      $result['result']['value'] = '';
      $result['result']['data']   = $id;
		App_DataUtils::commit();
		$uinfo = new App_Models_Db_Wigi_tblsubmenu();
		$uinfof = $uinfo->update(
      	array(
         	'title' => $title
         ),
         $uinfo->getAdapter()->quoteInto('sub_menu_id = ?', $id)
      );
      return $result;
    }
}
