jQuery( document ).ready(function() {
	jQuery( "#form_contato" ).submit(function(event) {
		jQuery('.form-group').hide();
		event.preventDefault();
	jQuery( "#loading").show();
		var posting = jQuery.post( SCF.ajaxurl, jQuery("#form_contato :input").serialize() )
		 .done(function() {
			jQuery( "#loading").hide();
			jQuery(".formmessage p").html('<span class="">Obrigado pela mensagem, iremos entrar em contato em breve.</span>');
		})
		 .fail(function() {
			jQuery( "#loading").hide();
			jQuery(".formmessage p").html('<span class="">Algo ocorreu errado.</span>');
		});
	});
});