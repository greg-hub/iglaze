/*!
 * iglaze
 * 
 * 
 * @author Greg Clinton
 * @version 1.0.0
 * Copyright 2017. MIT licensed.
 */
jQuery(document).ready(function($) {

	$("#ajax-contact-form").submit(function() {
		var str = $(this).serialize();

		$.ajax({
			type: "POST",
			url: "./includes/contact-process.php",
			data: str,
			success: function(msg) {
    			// Message Sent? Show the 'Thank You' message and hide the form
    			if(msg == 'OK') {
    				result = '<div class="notification_ok">Your message has been sent. Thank you!</div>';
    				$("#fields").hide();
    			} else {
    				result = msg;
    			}
    			$('#note').html(result);
			}
		});
		return false;
	});
});