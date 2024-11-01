jQuery(document).ready(function(e) {
	
	jQuery("#SaveWPHOData").click(function(e) {
		
		var WPH_FORM_DATA =  jQuery( "#wpho_form" ).serializeArray();
		WPH_FORM_DATA.push({ name: "action", value: "save_wpho_value" });
		
		 jQuery.ajax({
			 type : "post",
			 dataType : "json",
			 url : wphoAjax.ajaxurl,
			 data : WPH_FORM_DATA,
			 success: function(response) {
				jQuery(".wpho_message").show();
				window.location=wphoAjax.wphourl+'&res=suc';
			 }
		  })   
		
		
    });
});