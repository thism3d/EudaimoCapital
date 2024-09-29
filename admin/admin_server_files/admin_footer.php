



		  </div>

		  <div id="alert_box_window" style="display: none;">
			  <div id="alert_box_inside">


			  </div>
		  </div>


		  <script>

		  	  var canSubmitForm = false;
			  var clickedBtnTargeted = null;

			  // Model Initialization
			  const alert_box_window = document.getElementById("alert_box_window");
			  const alert_box_inside = document.getElementById("alert_box_inside");

			  const closeTheModal = () => { alert_box_window.style.display = "none"; };


			  const processAlertBox = (textOnAlertBox) => {
				  const alert_for_finish_HTML =
				  `<div class="my_alert_box_warning">
					  <p class="my_alert_box_top"><span class="material-icons">help</span></p>

					  <p class="my_alert_confirm_text">Confirm</p>
					  <p class="my_alert_box_message">`+ textOnAlertBox +`</p>

					  <div class="my_alert_buttons_keeper">
						  <div class="my_alert_button_item">
							  <button onclick="closeTheModal()" class="my_alert_no_button">No</button>
						  </div>
						  <div class="my_alert_button_item">
							  <button id="my_alert_button_confirm" class="my_alert_yes_button">Yes</button>
						  </div>
					  </div>
				  </div>
				  `;

				  return alert_for_finish_HTML;
			  }

			  const confirmingAlertBox = () => {
				  const alert_for_finish_HTML =
				  `<div class="my_alert_box_warning">
					  <p class="my_alert_box_top"><span class="material-icons">help</span></p>

					  <p class="my_alert_confirm_text">Confirming</p>
					  <p class="my_alert_box_message">Please Keep Patience...</p>

					  <div class="my_alert_buttons_keeper">
					  	<i style="font-size: 30px;" class="fa fa-circle-o-notch fa-spin"></i>
					  </div>
				  </div>
				  `;

				  return alert_for_finish_HTML;
			  }



  			  // Model View Function
  			  const show_universal_modal = ( modalWidth, modalHeight, modalHTML) => {
  				  alert_box_window.style.display = "block";

  				  alert_box_inside.style.width = modalWidth;
  				  alert_box_inside.style.height = modalHeight;

  				  alert_box_inside.innerHTML = modalHTML;
  			  }


  			  window.onclick = function(event) {
	  			  if (event.target == alert_box_window) {
	  			    closeTheModal();
	  			  }
	  		  }

			  const form_submit_returner = (btnClicked) => {
				  canSubmitForm = true;
				  clickedBtnTargeted.click();
				  show_universal_modal("350px", "350px", confirmingAlertBox());
			  }


			  const confirmSubmitWithPopup = (btnClicked, textOnAlertBox) => {
				  show_universal_modal("350px", "350px", processAlertBox(textOnAlertBox));
				  clickedBtnTargeted = btnClicked;

				  if(document.getElementById("my_alert_button_confirm")){
					  document.getElementById("my_alert_button_confirm").removeEventListener("click", form_submit_returner);
					  document.getElementById("my_alert_button_confirm").addEventListener("click", form_submit_returner);
				  }

				  return canSubmitForm;
				  // return false;
			  }








		  </script>

      </body>
<html>
