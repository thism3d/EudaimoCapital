<?php
include '../../cookies.php';
require '../admin_server_files/header_server_validate.php';



$isSuccess = false;

$data1 = $data2 = $data3 = $data4 = $data5 = NULL;


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $data1 = stringPostReturn("data1");
    $data2 = stringPostReturn("data2");


    $finalCookieString =  '
    <?php
    $botName = "'. $data1  .'";
    $coinName = "'. $data2 .'";
    ?>';

    // echo $finalCookieString;

    // Write the string to the cookies.php file
    $filePath = '../../cookies.php';
    
    if (file_put_contents($filePath, $finalCookieString) !== false) {
        $isSuccess = true; // Write successful
    } else {
        $isSuccess = false; // Write failed
    }

}

header("Location: ../configure.php");


?>