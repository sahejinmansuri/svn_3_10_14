<?php

class App_Event_Posws_MiscController_prodimage extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'SKU' => array('generic', 50, 0, App_Constants::getFormLabel('SKU')),
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

        $count = 0;

        $i = $this->_request->getParam('SKU');
        $cthis->getHelper('ViewRenderer')->setNoRender();

        #$imurl = 'http://static.www.odcdn.com/pictures/us/od/sk/lg/477643_sk_lg.jpg';
        $imurl = $ns->imgurl; error_log("CHRIS IMAGE $imurl");
        #exit;

        #$path_to_image = '/tmp/a.png';
        #header("Content-Type: image/jpeg");
        #$img = imagecreatefromjpeg(file_get_contents($imurl));


        $image = "";
        //do {
       //   $count++;
          $imagestr = file_get_contents($imurl);
          $image = imagecreatefromstring($imagestr);
        //} while ($count < 4 && $imagestr === "");
        header('Content-type: image/png');
        imagepng($image);


        #imagejpeg($img, NULL ,75);

        #imagedestroy($image);

        App_DataUtils::commit();

        exit;

    }
}
