
<?php

require 'admin_server_files/cookiesvariablesadmin.php';

setcookie($cookie_admin_name, "", time() - 3600, "/");
setcookie($cookie_admin_status, "", time() - 3600, "/");
setcookie($cookie_admin_username, "", time() - 3600, "/");

header('Location: ' . $serverhost .'index.php');
exit;

 ?>
