<?php

require 'admin_server_files/header_server_validate.php';

$isSuccess = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if($decryptedAdminStatus == "Admin"){
        $member_id = intval(stringPostReturn("admin_user_id"));

        $sql = "DELETE FROM admin_table WHERE id = " . $member_id;
        if($conn->query($sql)){
            $row_affected = true;
        }

    }

}

header('Location: ' . $serverhost .'admin_settings');
exit();

?>
