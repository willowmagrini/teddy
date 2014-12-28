<?php

function scf_ajax_simple_contact_form() {

	if ( isset( $_POST['scf_nonce'] ) && wp_verify_nonce( $_POST['scf_nonce'], 'scf_html' ) ) {
        $name = sanitize_text_field($_POST['scfn']);
		$email = sanitize_email($_POST['scfe']);
		$subject = sanitize_text_field($_POST['scfsj']);
		$message = wp_kses_data($_POST['scfm']);

	  $headers[] = 'De: ' . $name . ' <' . $email . '>' . "\r\n";
	  $headers[] = 'Content-type: text/html' . "\r\n"; //Enables HTML ContentType. Remove it for Plain Text Messages
	  $to = get_option( 'admin_email' );

		wp_mail( $to, $subject, $message, $headers );
	}
	die(); // Important
}
add_action( 'wp_ajax_simple_contact_form', 'scf_ajax_simple_contact_form' );
add_action( 'wp_ajax_nopriv_simple_contact_form', 'scf_ajax_simple_contact_form' );
?>