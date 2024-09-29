<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: X-Requested-With');

require '../cookies.php';

echo '{ "botName" : "'. $botName .'", "coinName" : "'. $coinName .'" }';
  
?>