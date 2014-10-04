<?php
class App_Encrypt {

  public static function encrypt($data,$keyver) {
    $pubKey = openssl_pkey_get_public(file_get_contents("/var/www/html/incash/etc/wigi-keys/v${keyver}/wigisafe-public.key"));

    openssl_public_encrypt($data, $encryptedData, $pubKey);
    return base64_encode($encryptedData);
  }


  public static function bigencrypt($data,$keyver) {
    $publicKeys[] = openssl_get_publickey(file_get_contents( "/var/www/html/incash/etc/wigi-keys/v${keyver}/wigilarge-public.key"  ));
    $res = openssl_seal($data, $encryptedData, $encryptedKeys, $publicKeys);
    $result['data'] = base64_encode($encryptedData);
    $result['key']  = base64_encode($encryptedKeys[0]);
    return $result;
  }

  public static function docencrypt($data,$keyver) {
  
	$publicKeys[] = openssl_get_publickey(file_get_contents( "/var/www/html/incash/etc/wigi-keys/v${keyver}/wigisafe-public.key"));
    $res = openssl_seal(base64_encode($data), $encryptedData, $encryptedKeys, $publicKeys);
    $result['data'] = base64_encode($encryptedData);
    $result['key']  = base64_encode($encryptedKeys[0]);
    return $result;
  }

}
?>