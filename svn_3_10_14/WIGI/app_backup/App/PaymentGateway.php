<?php

class App_PaymentGateway {

  public function __construct($processor_transaction_id,$processor,$amount,$type,$num,$expire_month,$expire_year,$firstname,$lastname,$name_on_card,$routing,$cvv2,$zip,$address,$state,$direction) {
    $this->processor_transaction_id = $processor_transaction_id;
    $this->processor = $processor;
    $this->amount = $amount;
    $this->type = $type;
    $this->num = $num;
    $this->expire_month = $expire_month;
    $this->expire_year = $expire_year;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->name_on_card = $name_on_card;
    $this->direction = $direction;
    $this->routing = $routing;
    $this->cvv2 = $cvv2;
    $this->zip = $zip;
    $this->address = $address;

    $states = App_DataUtils::getStates();
    $state  = $states[$state];
    $this->state = $state;
  }
  
  public function makeTransfer() {
    if ($this->processor == 1) {
      $r = $this->paymentsgateway($this->direction);
      if (!$r) {
        return false;
      } else {
        return $r;
      }
    }
  }

  public function paymentsgateway($direction) {

    if ($direction == 1) { $direction = 10; } //Credit Card Sale
    if ($direction == 2) { $direction = 13; } //Credit Card Credit
    if ($direction == 3) { $direction = 20; } //EFT Sale
    if ($direction == 4) { $direction = 23; } //EFT Credit
    if ($direction == 5) { $direction = 11; } //Credit Card Auth Only

    $fields = array();

    $url = ''; $merchantid = ''; $password = '';
    $cfg = Zend_Registry::get('config');
    if ($cfg->pp->env === "live") {
      $url = 'https://www.paymentsgateway.net/cgi-bin/postauth.pl';
      $merchantid = '132977';
      $password = 'NGTmqL89';
    } else if ($cfg->pp->env === "test") {
      $url = 'https://www.paymentsgateway.net/cgi-bin/posttest.pl';
      $merchantid = '121421';
      $password = 'otPwcM17';
    }

    if ($direction == 10 || $direction == 13 || $direction == 11) {

      $fields = array(
            'pg_merchant_id'=>urlencode($merchantid),
            'pg_password'=>urlencode($password),
            'ecom_payment_card_verification'=>urlencode($this->cvv2),
            'pg_transaction_type'=>urlencode($direction),
            'pg_total_amount'=>urlencode($this->amount),
            'ecom_billto_postal_name_first'=>urlencode($this->firstname),
            'ecom_billto_postal_name_last'=>urlencode($this->lastname),
            'ecom_billto_postal_postalcode'=>urlencode($this->zip),
            'ecom_billto_postal_street_line1'=>urlencode($this->address),
            'ecom_billto_postal_stateprov'=>urlencode($this->state),
            'ecom_payment_card_type'=>urlencode($this->type),
            'ecom_payment_card_name'=>urlencode($this->name_on_card),
            'ecom_payment_card_number'=>urlencode($this->num),
            'ecom_payment_card_expdate_month'=>urlencode($this->expire_month),
            'ecom_payment_card_expdate_year'=>urlencode($this->expire_year),
            'ecom_consumerorderid'=>urlencode($this->processor_transaction_id),
            'pg_avs_method'=>'22200'
        ); 
     } else if ($direction == 20 || $direction == 23) {
      $fields = array(
            'pg_merchant_id'=>urlencode($merchantid),
            'pg_password'=>urlencode($password),
            'pg_transaction_type'=>urlencode($direction),
            'pg_total_amount'=>urlencode($this->amount),
            'ecom_billto_postal_name_first'=>urlencode($this->firstname),
            'ecom_billto_postal_name_last'=>urlencode($this->lastname),
            'ecom_billto_postal_postalcode'=>urlencode($this->zip),
            'ecom_billto_postal_street_line1'=>urlencode($this->address),
            'ecom_billto_postal_stateprov'=>urlencode($this->state),
            'ecom_payment_check_trn'=>urlencode($this->routing),
            'ecom_payment_check_account'=>urlencode($this->num),
            'ecom_payment_check_account_type'=>urlencode($this->type),
            'ecom_consumerorderid'=>urlencode($this->processor_transaction_id),
            'pg_avs_method'=>'22200'

        ); 
     }

    $fields_string = "";

    //url-ify the data for the POST
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    rtrim($fields_string,'&');

    //error_log("Payment processor post string $fields_string");

    //open connection
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

    //execute post
    $result = curl_exec($ch);

    error_log("Payment processor result $result");

    //close connection
    curl_close($ch);

    $p = explode("\n",$result);
    $res = array();

    foreach ($p as $line) {
      $line = rtrim($line);
      if ($line === "endofdata") break;
      $q = explode('=',$line); $l = $q[0]; $r = $q[1];
      $res[$l] = $r;
    }

    if ($res['pg_response_type'] !== "A") {
      return false;
    } else {
      return true;
    }

  }
}

?>
