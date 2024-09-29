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



    $my_id = intval(input_checking($decoded["my_id"]));
    $new_status = input_checking($decoded["new_status"]);



    $stmt = $conn->prepare('UPDATE admin_table SET status = ? WHERE id = ?;');
    $stmt->bind_param("si", $new_status, $my_id);
    if($stmt->execute()){
        $row_affected = true;
    }




}






// Found Data, Now Execute the JSON
if($row_affected){
  echo '{ "status" : "SUCCESS" }';
}else{
  echo '{ "status" : "FAILED" }';
}



?>
