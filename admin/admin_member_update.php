<?php

require 'admin_server_files/header_server_validate.php';

$isSuccess = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if($decryptedAdminStatus == "Admin"){

        $stmt = $conn->prepare('UPDATE admin_table SET username = ?, fullname = ? WHERE username = ?;');
        $stmt->bind_param("sss", $admin_username, $admin_fullname, $admin_previous_username);

        $admin_username = stringPostReturn("admin_user_username");
        $admin_fullname = stringPostReturn("admin_user_fullname");
        $admin_previous_username = $decryptedAdminUsername;
        //
        // sysout($admin_username);
        // sysout($admin_fullname);


        if($stmt->execute()){
            $isSuccess = true;
            // echo "Executed";
        }
    }


}

header('Location: ' . $serverhost .'admin_settings');
exit();

?>
