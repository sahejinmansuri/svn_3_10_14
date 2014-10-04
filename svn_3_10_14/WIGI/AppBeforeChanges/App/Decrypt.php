<?php

class App_Decrypt {

  public static function decrypt($data,$passphrase,$keyver) {
    $bin_data = base64_decode($data);
    $privateKey = openssl_pkey_get_private("file:///home/incash/etc/wigi-keys/v${keyver}/wigisafe-private.key", $passphrase);
    openssl_private_decrypt($bin_data, $sensitiveData, $privateKey);
    return $sensitiveData;
  }


  public static function bigdecrypt($data,$signkey,$keyver) {
    $privateKey = openssl_get_privatekey(file_get_contents( "file:///home/incash/etc/wigi-keys/v${keyver}/wigilarge-private.key"  ));
    openssl_open(base64_decode($data), $decryptedData, base64_decode($signkey), $privateKey);
    return $decryptedData;
  }

}
?>
