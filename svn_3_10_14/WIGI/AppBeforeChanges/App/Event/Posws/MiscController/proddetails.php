<?php

class App_Event_Posws_MiscController_proddetails extends App_Event_WsEventAbstract {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'QRCODE' => array('generic', 350, 0, App_Constants::getFormLabel('QRCODE')),
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

        $url = $this->_request->getParam('QRCODE');
        error_log("url is -".$url."--");

        $data = array();

        if (preg_match('/officedepot/',$url)) {

        $host = App_User::getHostname($url);
        $ns->merchantuid = App_user::getUserIdFromHost($host);

        $merchuid = App_user::getUserIdFromHost($host);

        if (!($merchuid > 0)) {
                throw new App_Exception_WsException('Merchant not part of the WiGime network.');
        }

        $od = $url;
        $cnt = file_get_contents($od);

        if (!preg_match('/skuValue.*?(\d+).*?src=.(.*?)"/ms',$cnt)) {
                throw new App_Exception_WsException('Product not found or no longer available.');
        }

        preg_match('/skuValue.*?(\d+).*?src=.(.*?)"/ms', $cnt, $m);
        preg_match('/Your Price.*?\$(\d+).(\d+)\D/ms',$cnt, $n);
        preg_match('/title.(.*?) by Office Depot/ms',$cnt, $t);
        preg_match('/longBulletTop.*?i\>(.*?)\</ms',$cnt, $d);
        preg_match('/(http:\/\/static.www.odcdn.com\/pictures\/.*?)"/',$cnt,$z); 

        $sku   = $m[1]; 
        $img   = $z[1]; 
        $price = $n[1].'.'.$n[2];

        $s = array();
        $s[$sku] = $img;

        $ns->imgurl = $img;
        $ns->sku = $s;
        $ns->prodtitle = $t[1];
        $data = array(
            'sku' => $sku,
            'price' => $price,
            'title' => $t[1],
            'desc'  => $d[1],
        );

        } else {
          $plugin = App_SBPlugins_Url::getPlugin($url);
          $data = $plugin->details();
          $ns->imgurl = $plugin->image();
          $s = array();
          $s[$data['sku']] = $plugin->image();
          $ns->sku = $s;
          $ns->prodtitle = $data['title'];
          $ns->merchantuid = $plugin->getMerchantUid();
        }

        $res = array();
        $res['result']['status'] = 'success';
        $res['result']['value'] = '';
        $res['result']['data']   = $data;

        session_write_close();

        App_DataUtils::commit();

        return $res;
    }
}
