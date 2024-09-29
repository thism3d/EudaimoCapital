<?php

    require '../admin_server_files/header_server_validate.php';


    $error_on_image = $error_on_pdf = false;
    $isSuccess = false;

    $data1 = $data2 = $data3 = $data4 = $data5 = NULL;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $data1 = stringPostReturn("data1");
        $data2 = stringPostReturn("data2");
        $data3 = stringPostReturn("data3");
        $data4 = stringPostReturn("data4");
        $data5 = stringPostReturn("data5");


        $stmt = $conn->prepare('INSERT INTO tasks (slug, reward, title, iconName, taskType) VALUES ( ?, ?, ?, ?, ? );');
        $stmt->bind_param("sssss", $data1, $data2, $data3, $data4, $data5);
        if($stmt->execute()){
            $isSuccess = true;
        }





    }





    // Go To Page
    if($data5 == "Constant"){
        if($isSuccess) header("Location: ../home");
    }else{
        if($isSuccess) header("Location: ../daily_task");
    }
    



 ?>


