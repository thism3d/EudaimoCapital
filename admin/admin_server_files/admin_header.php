  <?php


require 'header_server_validate.php';
include '../../cookies.php';

$extra_heading = isset($extra_heading) ? $extra_heading : "";

if(!isset($title)){
    $title = $botName . " | Admin";
}



$serverUserId = $serverUesrFullname = $serverUsername =  $serverUserStatus = "";

$sql = 'SELECT id, fullname, username, status, enabled FROM admin_table WHERE username = "'. $decryptedAdminUsername .'";';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $serverUserId = $row["id"];
        $serverUsername = $row["username"];
        $serverUesrFullname = $row["fullname"];
        $serverUserStatus = $row["status"];
    }
}else{
    header("Location: logout.php");
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
		  
		  <!--  <link rel="stylesheet" href="../main_v0.0.3.css">-->
  	      <link rel="stylesheet" href="library/main0.0.1.css"> <!-- Oncher Website CSS -->
  	      <link rel="stylesheet" href="library/main_admin<?php echo $version; ?>.css">
  	      <link rel="stylesheet" href="library/main0.1.2.css"> <!-- Main Website CSS -->

        <!-- Font Awesome Link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


		  <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



		<!-- jQuery 3.5.1 -->
		<script src="library/jquery.min.js"></script>
        
        
        

		<?php echo $extra_heading; ?>
        
        


      </head>
      <body>



        <div id="main_container">     <!-- Main Container Starts Here -->


			  <div  id="final_header">   <!-- Final Header Starts Here -->

				<div id="upper_header" class="clearfix">
				  <div id="inside_upper_header">
					<h2 style="display:inline; color: #b22222;">Admin Panel</h2>
					<a href="logout" style="margin-right: 10px; margin-left: 10px; "><h3 style="display:inline;">Logout</h3></a>

				  </div>
				</div>
			  </div>  <!-- Final Header Ends Here -->



			  <div id="header_section_sticky">  <!-- Sticky Section Starts Here -->


				  <div id="first_section">    <!-- First Section Starts Here -->

					<div id="left_first_section">
					  <a href="index"><img src="../assets/age-wallet2.png" alt="<?php echo $botName; ?> Logo"></a>
					</div>

					<div id="right_first_section">
					  <div>
						<a><p id="my_hidden_search_box"  style="border:none; text-align:center;">Hi, <?php echo $decryptedAdminName; ?></p></a>
					  </div>
					</div>



					<div id="third_first_section">
                        <div class="admin_access_panel_head">
                            <span class="material-icons">admin_panel_settings</span>
                            <a href="admin_settings">Access Account</a>
                        </div>
					  <!-- <p id="non_hidden_thirdp1"><i class="fa fa-language"></i> Language</p>
					  <p id="non_hidden_thirdp2"><span id="third_second_span">English</span></p>
					  <a id="non_hidden_thirda" href="index.html"><p id="non_hidden_thirdp3"><span><i class="fa fa-sign-out"></i></span></p></a> -->
					</div>

				  </div>                      <!-- First Section Ends Here -->


				  <!-- Menu Items -->

				  <div id="top_menu_container">
					<span>
					  <a href="home">Constant Task</a>
					  <a href="daily_task">Daily Task</a>
					  <a href="configure">Configure</a>
					</span>
				   </div>


			  </div>    <!-- Sticky Section Ends Here -->




              			  <!-- Tiles Menu Section -->
              <!--
              			  <div id="tiles_menu_container">
              				<div id="tiles_menu_inside">
              					<a href="accounts" class="tiles_menu_item" style="background-color: #009688">
              						<p class="tiles_normal_text">Account Information</p>
              						<p class="tiles_short_text">See all accounts details</p>
              					</a>

              					<a href="notifications" class="tiles_menu_item" style="background-color: #f44336">
              						<p class="tiles_big_text">Notifications</p>
              					</a>

              					<a href="maintainance" class="tiles_menu_item" style="background-color: #03A9F4">
              						<p class="tiles_normal_text">Maintainance</p>
              						<p class="tiles_short_text">Turn on or off</p>
              					</a>

              					<a href="withdrawal" class="tiles_menu_item" style="background-color: #4CAF50">
              						<p class="tiles_big_text">Withdrawal</p>
              					</a>

              					<a href="#" class="tiles_menu_item" style="background-color: #8BC34A">
              						<p class="tiles_big_text">Big Text</p>
              					</a>

              					<a href="#" class="tiles_menu_item" style="background-color: #009688">
              						<p class="tiles_big_text">Big Text</p>
              					</a>

              					<a href="#" class="tiles_menu_item" style="background-color: #795548">
              						<p class="tiles_big_text">Big Text</p>
              					</a>

              					<a href="#" class="tiles_menu_item" style="background-color: #E91E63">
              						<p class="tiles_big_text">Big Text</p>
              					</a>
              				</div>
              			  </div>
              -->


			  