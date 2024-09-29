<?php

require '../admin_server_files/header_server_validate.php';

$isSuccess = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $idToDelete = stringPostReturn("idToDelete");



        $stmt = $conn->prepare('DELETE FROM tasks WHERE id = ?;');
        $stmt->bind_param("i", $idToDelete);
        if($stmt->execute()){
            $isSuccess = true;
        }

       


}


// Go To Page
if($_POST["data5"] == "Constant"){
    if($isSuccess) header("Location: ../home");
}else{
    if($isSuccess) header("Location: ../daily_task");
}

?>
