// JavaScript Document
$(function(){
	$("#designer_register_form").validate({
		rules:{
			designer_name: {required: true},
			designer_email:{required: true, email: true},
			designer_password:{required: true, minlength: [6]},
			confirm_password:{required: true, equalTo: "#designer_password"},
			designer_country:{required: true}
		},
		messages:{
			designer_name:{required: "Designer Name is reqired"},
			designer_email:{required: "Designer Email is reqired", email: "Please enter a valid email address"},
			designer_password:{required: "Password is reqired", minlength: "Please enter at least {0} characters"},
			confirm_password:{required: "Confirm Password is reqired", equalTo: "Please enter same password again"},
			designer_country:{required: "Designer Country is reqired"}
		},
		errorElement:"div",
		errorClass: "error_msg",
		highlight: function(element, errorClass) {
        	$(element).removeClass(errorClass);
    	},
		
		submitHandler: function(form)
		{
			form.submit();
		}
	});
	
	$("#client_register_form").validate({
		rules:{
			client_name:{required: true},
			client_email:{required: true, email: true},
			client_password:{required: true, minlength: [6]},
			confirm_password:{required: true, equalTo: "#client_password"},
			client_country:{required: true},
		},
		messages:{
			client_name:{required: "Client Name is reqired"},
			client_email:{required: "Client Email is reqired"},
			client_password:{required: "Password is reqired", minlength: "Please enter at least {0} characters"},
			confirm_password:{required: "Confirm Password is reqired"},
			client_country:{required: "Client Country is reqired", equalTo: "Please enter same password again"},
		},
		errorElement:"div",
		errorClass: "error_msg",
		highlight: function(element, errorClass) {
        	$(element).removeClass(errorClass);
    	},
		submitHandler: function(form)
		{
			form.submit();
		}
	});	
	
	$("#creative_brief").validate({
		rules:{
			org_bus:{required: true},
			creative_brief_msg_area:{required: true},
			cont_tit:{required: true},
			cont_desc:{required: true},
			ts_size:{required: true},
			indus:{required: true},
			logo_tag_line:{required: true},
			logo_style_idea:{required: true},
			copy_right:{required: true},
			background_info:{required: true},
			org_info:{required: true},
			language:{required: true},
			creative_b_msg_area:{required: true},
			coding_type:{required: true},
			//other_code_option:{required: true},
		},
		messages:{
			org_bus:{required: "Title is reqired"},
			creative_brief_msg_area:{required: "Please provide few words about the contest"},
			cont_tit:{required: "Contest Title is Required"},
			cont_desc:{required: "Contest Description is Required"},
			ts_size:{required: "Size is Required For This"},
			indus:{required: "Select Any One Of This Industries"},
			language:{required: "Please select language"},
			logo_tag_line:{required: "Tag Line Detail is required"},
			logo_style_idea:{required: "Please provide some ideas about your contest."},
			copy_right:{required: "Please select this"},
			background_info:{required: "Background Information is Required"},
			org_info:{required: "Background Information is Required"},
			creative_b_msg_area:{required: "Provide Some Ideas About the contest"},
			coding_type:{required: "Select Coding type as you want"},
			//other_code_option:{required: "Please provide the coding type"},
		},
		errorElement:"div",
		errorClass: "error_msg",
		highlight: function(element, errorClass) {
        	$(element).removeClass(errorClass);
    	},
		submitHandler: function(form)
		{
			form.submit();
		}
	});	
	
});