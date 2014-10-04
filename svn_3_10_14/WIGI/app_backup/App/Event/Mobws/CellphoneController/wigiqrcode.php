<?php

class App_Event_Mobws_CellphoneController_wigiqrcode extends App_Event_WsEventAbstract {

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

         error_log("being gen wigiqr");
         $ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
         App_DataUtils::userlogp('Get',$ns->mobileid,'user_mobile','Get QR Code');
         $wigicode   = $this->_request->getParam("WIGICODE");

         $u = new App_User($ns->userid);
         $c = new App_Cellphone($ns->mobileid);

         $s = "WIGICODE=$wigicode&COUNTRYCODE=" . $u->getCountryCode() . "&CELLPHONE=" . $c->getCellphone();
         error_log("wigiqr is ". $s);
         $code_params = array('text'            => "$s",
          'backgroundColor' => '#FFFFFF',
          'foreColor' => '#000000',
          'padding' => 4,  //array(10,5,10,5),
          'moduleSize' => 8);

          App_DataUtils::commit();

          $renderer_params = array('imageType' => 'png');
          try{
          Zend_Matrixcode::render('qrcode', $code_params, 'image', $renderer_params);
          }catch(Exception $e){
            error_log("error rendering wigiqr ". $e->getMessage());
          }
          error_log("finished rendering wigiqr");


    }
}
