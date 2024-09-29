<?php

require 'admin_server_files/header_server_validate.php';

$isSuccess = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if($decryptedAdminStatus == "Admin"){

        $stmt = $conn->prepare('INSERT INTO admin_table (fullname, username, public_key, country, status, password) VALUES( ?, ?, ?, ?, ?, ? )');
        $stmt->bind_param("ssssss", $full_name, $user_name, $public_key, $country, $status, $password);

        $full_name = stringPostReturn("admin_fullname");
        $user_name = stringPostReturn("admin_username");
        $public_key = "98126479162376412537178";
        $country = "India";
        $status = "Subadmin";
        $password = stringPostReturn("admin_password");

        if($stmt->execute()){
            $isSuccess = true;
            echo "Executed";
        }
    }


}

header('Location: ' . $serverhost .'admin_settings');
exit();

?>
