<?php


require 'header_server.php';

// Intitializing Information
$decryptedAdminName = "";
$decryptedAdminStatus = "";
$decryptedAdminUsername = "";



if(isset($_COOKIE[$cookie_admin_name]) && isset($_COOKIE[$cookie_admin_status]) && isset($_COOKIE[$cookie_admin_username])) {

  $decryptedAdminName = openssl_decrypt ($_COOKIE[$cookie_admin_name], $ciphering,
  $decryption_key, $options, $decryption_iv);
  $decryptedAdminStatus = openssl_decrypt ($_COOKIE[$cookie_admin_status], $ciphering,
  $decryption_key, $options, $decryption_iv);
  $decryptedAdminUsername = openssl_decrypt ($_COOKIE[$cookie_admin_username], $ciphering,
  $decryption_key, $options, $decryption_iv);

}else{
  header('Location: ' . $serverhost .'logout.php');
  exit();
}




?>
