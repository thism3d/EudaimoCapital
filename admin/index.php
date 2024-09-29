<?php
include '../cookies.php';
$title = $botName . " | Admin Panel";
require 'admin_server_files/header_server.php';






if(isset($_COOKIE[$cookie_admin_name]) && isset($_COOKIE[$cookie_admin_status]) && isset($_COOKIE[$cookie_admin_username])) {
  header('Location: ' . $serverhost .'home.php');
  exit;
}
// } else {

$formUsernameError = $formPasswordError = "";
$formUsername = $formPassword = "";
$errorcount = 0;


$error_no_user_found = false;
$error_no_form_validated = false;


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
      $formUsernameError = "Username is required";
      $errorcount = $errorcount + 1;
  }else{
    $formUsername = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    // if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/',$formUsername)) {
    if(strlen($formUsername)<8){
      $formUsernameError = "Place a valid username";
      $errorcount = $errorcount + 1;
    }
  }



  if (empty($_POST["password"])) {
      $formPasswordError = "Password is required";
      $errorcount = $errorcount + 1;
  }else{
    $formPassword = test_input($_POST["password"]);
    // check if name only contains letters and whitespace

    // if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/',$formPassword)) {
    if(strlen($formPassword)<8){
      $formPasswordError = "Place a valid password";
      $errorcount = $errorcount + 1;
    }
  }

    if($errorcount <= 0){


        $sql = 'SELECT fullname, username, status FROM admin_table WHERE username = "'. $formUsername .'" AND password = "'. $formPassword .'" AND enabled = "Y";';
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Use openssl_encrypt() function to encrypt the data
                $adminnamecookie = openssl_encrypt($row["fullname"], $ciphering,
                            $encryption_key, $options, $encryption_iv);
                $adminusernamecookie = openssl_encrypt($row["username"], $ciphering,
                            $encryption_key, $options, $encryption_iv);
                $adminstatuscookie = openssl_encrypt($row["status"], $ciphering,
                            $encryption_key, $options, $encryption_iv);


                setcookie($cookie_admin_name, $adminnamecookie,  time() + (86400 * 1), "/");
                setcookie($cookie_admin_status, $adminstatuscookie,  time() + (86400 * 1), "/");
                setcookie($cookie_admin_username, $adminusernamecookie,  time() + (86400 * 1), "/");


                header('Location: ' . $serverhost .'home.php');
                exit;


            }
        } else {
            $error_no_user_found = true;

        }


    }else{
        $error_no_form_validated = true;

    }



}
?>


<!DOCTYPE html>
<html>
      <head>

          <title><?php echo $title; ?></title>
          <meta name="robots" content="noindex">
          <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1, initial-scale=1.0, user-scalable=no, shrink-to-fit=no" />


          <!-- CSS For this Page -->
          <link rel="icon" href="../assets/age-wallet2.png">
          <link rel="stylesheet" href="library/login_css.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



      </head>
      <body>

		<div id="logindiv">
			<img id="mylogo" src="../assets/age-wallet2.png">

			<form action="index" method="post" autocomplete="off">
                <?php echo $error_no_user_found ? '<h3 style="color: red; text-align: center;">User Not Found</h3>' : ""; ?>
                <?php echo $error_no_form_validated ? '<h3 style="color: red; text-align: center;">Place valid username and password</h3>' : ""; ?>

				<input type="text" name="username" placeholder="Username" maxlength="25" autofocus pattern=".{8,20}" title="8 to 20 characters" required>

				<input id="password" type="password" name="password" placeholder="Password" pattern=".{8,20}" required title="8 to 20 characters" required >

				<input type="submit">
			</form>
		</div>

    </body>
</html>
