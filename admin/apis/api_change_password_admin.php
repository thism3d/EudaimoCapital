<?php

$row_affected = false;       // Default Initialisation


if($_SERVER["REQUEST_METHOD"] == "POST"){

    require '../admin_server_files/header_server_validate.php';

    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    if ($contentType === "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);
        if(! is_array($decoded)) {
        } else {
        }
    }



    $currentpassword = input_checking($decoded["currentpassword"]);
    $newpassword = input_checking($decoded["newpassword"]);



    $stmt = $conn->prepare('UPDATE admin_table SET password = ? WHERE username = ? AND password = ?;');
    $stmt->bind_param("sss", $newpassword, $decryptedAdminUsername, $currentpassword);
    if($stmt->execute()){
        if($conn->affected_rows > 0){
            $row_affected = true;
        }
    }




}






// Found Data, Now Execute the JSON
if($row_affected){
  echo '{ "status" : "SUCCESS" }';
}else{
  echo '{ "status" : "FAILED" }';
}



?>
