$(document).ready(function() {
	
	$("input").focus(function(){
		$(this).parent().removeClass("has-error");
		console.log("removeClass!");
	});
	
    $("#order-form").submit(function(event) {
		event.preventDefault ? event.preventDefault() : (event.returnValue = false);
		if(!formValidation(event.target)){return false;}

		var action = $(this).attr("action");
		var sendingForm = $(this);
		var submit_btn = $(this).find("button[type=submit]");
		var value_text = $(submit_btn).text();
		var waiting_text = 'SENDING';
		$.ajax({
			type: "POST",
			url: action,
			data: $(event.target).serializeArray(),
			beforeSend:function(){
				$(submit_btn).prop( "disabled", true );
				$(submit_btn).addClass("waiting").text(waiting_text);
			},
			success: function(msg,status){
				console.log(msg);
				$(sendingForm).trigger('reset');
				$(submit_btn).removeClass("waiting");
				$(submit_btn).text(value_text);
				$(submit_btn).prop( "disabled", false );
				$('#order').modal("hide");
				$("#success").modal("show")
				setTimeout(
					function() 
					{
						$("#success").modal("hide");
					}, 3000);
			},
			error: function(){
				$(submit_btn).prop( "disabled", false );
				$(submit_btn).removeClass("waiting").text("ERROR");
				setTimeout(
					function() 
					{
						$(submit_btn).delay( 3000 ).text(value_text);
					}, 3000);
			}

		});
		event.preventDefault();

    });	

});
function formValidation(formElem){
	var elements = $(formElem).find(".required");
	var errorCounter = 0;
	
	$(elements).each(function(indx,elem){
		var placeholder = $(elem).attr("placeholder");
		if($.trim($(elem).val()) == "" || $(elem).val() == placeholder){
			$(elem).parent().addClass("has-error");
			errorCounter++;
		}
		else{
			$(elem).parent().removeClass("has-error");
		}
	});
	
	
	$('input[name="phone"]').each(function() {
		var pattern = new RegExp(/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/);
		var data_pattern = $(this).attr('data-pattern');
		var data_placeholder = $(this).attr('placeholder');
		console.log(pattern.test($(this).val()));
		if(!pattern.test($(this).val()) || $.trim($(this).val()) == '' ){
			console.log('NON valid phone!');
			$('input[name="phone"]').parent().addClass("has-error");
			errorCounter++;
		} else if (data_pattern == 'true') {
			console.log('data-pattern = true');
			if ($(this).val().length != data_placeholder.length) {
				console.log('Phone too short!!!');
				$('input[name="phone"]').parent().addClass("has-error");
				errorCounter++;		
			}
		}
		else{
			$(this).parent().removeClass("has-error");
		}		

	});	
	
	if (errorCounter > 0) {
		$(".fancy_form_error_text").show();
		return false;
	} else {
		$(".fancy_form_error_text").hide();
		return true;
	}
}