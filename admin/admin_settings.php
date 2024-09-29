<?php

include '../cookies.php';
$title = $botName . " | Administration Profiles";
include 'admin_server_files/admin_header.php';




?>




<div class="admin_middle_box_conatiner">

	<div class="admin_access_main_container">

		<div class="admin_access_panel_setting_container">
			<span class="material-icons">admin_panel_settings</span>
			<h2>Access Admin Data</h2>
		</div>
		<form class="admin_access_form" method="post" action="admin_member_update.php">
			<label class="admin_access_form_label">Admin Full Name</label>
			<input name="admin_user_fullname" class="admin_access_form_input" type="text" placeholder="Admin Name" minlength="5" required value="<?php echo $serverUesrFullname;?>">
			<label class="admin_access_form_label">Admin Username</label>
			<input name="admin_user_username" class="admin_access_form_input"  type="text" placeholder="Admin Username" minlength="8" maxlength="25" required pattern=".{8,20}" title="8 to 20 characters" value="<?php echo $serverUsername;?>">
			<button onclick="return confirmSubmitWithPopup(this, 'Do you really want to update your account ?')" class="admin_access_form_button"  type="submit">UPDATE</button>
		</form>

		<button onclick="show_change_password_form()" class="admin_access_form_button"  type="submit">CHANGE PASSWORD</button>
	</div>


	<script>

		const change_password_form_HTML =
		`<div style="padding: 20px;" class="admin_access_main_container">

			<div style="text-align: center;" class="admin_access_panel_setting_container">
				<span style="margin-left: 0;" class="material-icons">password</span>
				<h2>Change Password</h2>
			</div>
			<div class="admin_access_form">
				<label class="admin_access_form_label">Enter Current Password</label>
				<input id="current_password" class="admin_access_form_input" type="text" placeholder="">
				<label class="admin_access_form_label">Enter New Password</label>
				<input id="new_password" class="admin_access_form_input"  type="text" placeholder="">
				<label class="admin_access_form_label">Re-type New Password</label>
				<input id="confirmed_new_password" class="admin_access_form_input" type="text" placeholder="">

				<p id="warning_section_admin_password"></p>

				<div style="text-align: center;">
					<button onclick="try_change_password(this)" class="admin_access_form_button">CHANGE</button>
				</div>
			</div>
		</div>`;


		const show_change_password_form = () => {
			show_universal_modal("500px", "600px", change_password_form_HTML);
		}


		const try_change_password = (btnClicked) => {
			const current_password = document.getElementById("current_password");
			const new_password = document.getElementById("new_password");
			const confirmed_new_password = document.getElementById("confirmed_new_password");

			const warning_section_admin_password = document.getElementById("warning_section_admin_password");

			if(current_password.value.length < 8 || new_password.value.length < 8 || confirmed_new_password.value.length < 8){
				warning_section_admin_password.innerHTML = "Minimum 8 characters required for password";
			}else if(new_password.value != confirmed_new_password.value){
				warning_section_admin_password.innerHTML = "Confirm Password Not Matched!";
			}else{

				current_password.disabled = true;
				new_password.disabled = true;
				confirmed_new_password.disabled = true;
				btnClicked.disabled = true;



				const data = {
		            currentpassword: current_password.value,
		            newpassword: new_password.value,
		        }

		        var xhttp = new XMLHttpRequest();
		        xhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
						var data = JSON.parse(this.responseText);
						console.log(data);

						if(data.status == "SUCCESS"){
							window.location.replace("logout");
						}else{
							current_password.disabled = false;
							new_password.disabled = false;
							confirmed_new_password.disabled = false;
							btnClicked.disabled = false;
							warning_section_admin_password.innerHTML = "Wrong Current Password. Enter Correct Password !";
						}


		            }
		        }

		        xhttp.open("POST", "apis/api_change_password_admin.php", true);
		        xhttp.setRequestHeader("Content-type", "application/json");
		        xhttp.send(JSON.stringify(data));

			}

		}
	</script>

<?php
if($serverUserStatus == "Admin"){


	echo
	'<div class="all_admins_main_container">
		<div class="all_admins_keeper_heading">
			<h2 class="all_admin_h2_text">All Admins</h2>
			<button onclick="show_add_member_modal()" class="add_admin_btn"><span class="material-icons">person_add_alt</span></button>
		</div>

		<div class="all_admins_keeper">';



			$sql = 'SELECT id, dateadded, fullname, username, status, enabled FROM admin_table WHERE username <> "'. $serverUsername .'" AND username <> "demoadmin";';
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    while($row = $result->fetch_assoc()) {
					$dateFormatted = date("dS M, Y", strtotime($row["dateadded"]));
					echo '
					<div class="admin_single_people">
						<div class="admin_single_people_left">
							<div class="admin_single_people_l_item">
								<p class="admin_spli_top">Full Name</p>
								<p class="admin_spli_bottom">'. $row["fullname"] .'</p>
							</div>
							<div class="admin_single_people_l_item">
								<p class="admin_spli_top">Username</p>
								<p class="admin_spli_bottom">'. $row["username"] .'</p>
							</div>
							<div class="admin_single_people_l_item">
								<p class="admin_spli_top">Joined</p>
								<p class="admin_spli_bottom">'. $dateFormatted .'</p>
							</div>
							<div class="admin_single_people_l_item">
								<p class="admin_spli_top">Status</p>
								<select onchange="admin_position_update(this.value, '. $row["id"] .')" class="admin_spli_bottom_select">
									<option '. ($row["status"] == "Admin" ? 'selected' : '') .' value="Admin">Admin</option>
									<option '. ($row["status"] == "Subadmin" ? 'selected' : '') .' value="Subadmin">Subadmin</option>
								</select>
							</div>

						</div>
						<div class="admin_single_people_right">
							<form method="post" action="admin_member_delete.php">
								<input type="hidden" name="admin_user_id" value="'. $row["id"] .'" required>
								<button onclick="return confirmSubmitWithPopup(this, \'Do you really want to delete admin '. $row["fullname"] .' ?\')" type="submit" class="material-icons">delete_forever</button>
							</form>
						</div>
					</div>';
			    }
			}




	echo '
		</div>

	</div>';
}
?>

</div>


<?php
if($serverUserStatus == "Admin"){
echo '
		<script>
			const admin_position_update = (selectedValue, adminId) => {

				show_universal_modal("350px", "350px", confirmingAlertBox());


				const data = {
		            new_status: selectedValue,
		            my_id: adminId,
		        }

				// console.log(data);
		        var xhttp = new XMLHttpRequest();
		        xhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
						// console.log(this.responseText);

	                    location.reload();
		            }
		        }

		        xhttp.open("POST", "apis/api_update_admin_status.php", true);
		        xhttp.setRequestHeader("Content-type", "application/json");
		        xhttp.send(JSON.stringify(data));
			}


			const add_member_form =
			`<div style="padding: 20px;" class="admin_access_main_container">

				<div style="text-align: center;" class="admin_access_panel_setting_container">
					<span style="margin-left: 0;" class="material-icons">person_add_alt</span>
					<h2>Add New Admin</h2>
				</div>
				<form class="admin_access_form" method="post" action="admin_member_new.php">
					<label class="admin_access_form_label">New Admin Full Name</label>
					<input name="admin_fullname" class="admin_access_form_input" type="text" placeholder="New Admin Full Name" minlength="5" required>
					<label class="admin_access_form_label">New Admin Username</label>
					<input name="admin_username" class="admin_access_form_input"  type="text" placeholder="New Admin Username" minlength="8" maxlength="25" required pattern=".{8,20}" title="8 to 20 characters">
					<label class="admin_access_form_label">New Admin Password</label>
					<input name="admin_password" class="admin_access_form_input" type="text" placeholder="New Admin Password" minlength="8" maxlength="20"  pattern=".{8,20}" title="8 to 20 characters" required>

					<div style="text-align: center;">
						<button class="admin_access_form_button" type="submit">CREATE</button>
					</div>
				</form>
			</div>`;


			const show_add_member_modal = () =>
			{
				show_universal_modal("500px", "600px", add_member_form);
			}

		</script>

';
}

?>




<?php require 'admin_server_files/admin_footer.php'; ?>
