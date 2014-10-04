<?php

class App_Ws_Mobws_Registration_register extends App_Ws_Base {
    private $evt_data;

    public function __construct(){

        $this->evt_data = array(
              'method'  => '/registration/register',
              'headers' => array(
		     'X-Auth-Token' => 'sess: novatoken',
		     'Content-Type' => 'c: application/json',
		     'Accept'       => 'c: application/json',
               ),

              'inputs'  => array(
	       );
        );
        $this->evt_data = parent::__construct($this->evt_data);
    }
    public function getEvtData(){return $this->evt_data;}
}
