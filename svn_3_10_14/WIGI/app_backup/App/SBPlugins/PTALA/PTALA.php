<?php

class App_SBPlugins_PTALA_PTALA {

  private $url;

  public function __construct($url) {
      $this->url = $url;
    }

  public function details() {
            $data = array(
            'sku' => '096208770X',
            'price' => '19.99',
            'title' => 'Union Station Book',
            'desc'  => 'Learning the history of Union Station in this brand new book!',);
            return $data;
  }

  public function image() {
    return "http://brdev01.wigime.com/PTALA/products/096208770X/unionstationicon.png";
  }

  public function getMerchantUid() {
    return "411";
  }

}

?>
