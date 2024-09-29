<?php


/*
Free SVG Codes : https://svgicons.sparkk.fr
*/


header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

date_default_timezone_set('Asia/Tehran');
ini_set("log_errors", "off");
error_reporting(0);



$apiKey = '7592048262:AAHrAqi0EI4Fkd1v3GBEzPPsOWVuDLgJuH4';
$botUsername = 'EudaimoCapitalBot';
$web_app = 'https://telegram.eudaimocapital.com';


$age_rewards = array(
    "1" => 1024,
    "2" => 2118,
    "3" => 2720,
    "4" => 3085,
    "5" => 4025,
    "6" => 6012,
    "7" => 8055,
    "8" => 1010,
    "9" => 13500,
    "10" => 16800,
    "11" => 20000,
    "11" => 20000,
);


$ref_percentage = 35;

$DB = [
'dbname' => 'hungfoep_eudaimotelegram',
'username' => 'hungfoep_eudaimotelegram',
'password' => 'eudaimotelegram'
];

$admins_user_id = [
882073618,
];