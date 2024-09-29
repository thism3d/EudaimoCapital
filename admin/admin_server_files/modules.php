<?php

// sysout,  upload_image, input_checking, stringPostReturn, stringGetReturn, create_file





// Decryption System Starts Here
$ciphering = "AES-128-CTR"; // Store the cipher method
$iv_length = openssl_cipher_iv_length($ciphering);  // Use OpenSSl Encryption method
$options = 0;

$encryption_iv = '9981236912386901';  // Non-NULL Initialization Vector for encryption
$encryption_key = "OZEPJAS2632X68SHJDGF67568DA";  // Store the encryption key
$decryption_iv = '9981236912386901';  // Non-NULL Initialization Vector for decryption
$decryption_key = "OZEPJAS2632X68SHJDGF67568DA";  // Store the decryption key




// Session Start
session_start();






// Purify Input
function input_checking($data) {
  $data = trim($data);
  $data = stripslashes($data);
  // $data = htmlspecialchars($data, ENT_QUOTES);
  return $data;
}




// Printing Function
function sysout($object) {
  echo $object . '<br>';
}


// Post String Return
function stringPostReturn($value) {
  if(isset($_POST[$value])){
    return input_checking($_POST[$value]);
  }else{
    return NULL;
  }
}



// Get String Return
function stringGetReturn($value) {
  if(isset($_GET[$value])){
    return input_checking($_GET[$value]);
  }else{
    return "";
  }
}



// Upload Picture File     // Return filename after upload or zero
function upload_image($fileUploadName) {
  $target_dir = "../restaurants_menu_images/";
  $target_file = $target_dir . basename($_FILES[$fileUploadName]["name"]);

  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


  $filenameforserver = preg_replace("/[^a-zA-Z0-9.]+/", "", basename($_FILES[$fileUploadName]["name"]));
  $filenameforserver = round(microtime(true)) . $filenameforserver;

  $target_file_name = $target_dir . $filenameforserver;

  $check = getimagesize($_FILES[$fileUploadName]["tmp_name"]);
  if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".<br>";
      $uploadOk = 1;
  } else {
      echo "File is not an image.<br>";
      $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.<br>";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES[$fileUploadName]["size"] > 5000000) {   // 5000 KB LIMIT
      echo "Sorry, your file is too large.<br>";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.<br>";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES[$fileUploadName]["tmp_name"], $target_file_name)) {
          echo "The file ". basename( $_FILES[$fileUploadName]["name"]). " has been uploaded.<br>";

          return $filenameforserver;
      }
  }



  return "0";
}







// Create File  // Return 1 if created or 0 if not
function create_file($path, $string = "") {
  $myfile = fopen($path, "w") or die("Unable to open file!");
  fwrite($myfile, $string);
  fclose($myfile);
  return file_exists($path);
}



function only_let_num_verification($variable){
  if (!preg_match('/[^A-Za-z0-9]/', $variable)){
  // string contains only english letters & digits
    return true;
  }else{
    return false;
  }
}





// Check if the number is an integer
// Check if the number is an float/double
// Check if string
//




?>
