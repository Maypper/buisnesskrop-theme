<?php
function splitter_ajax_login() {
	check_ajax_referer( 'login-nonce' );
	wp_logout();
	$user = wp_signon( array(
		'user_login'    => sanitize_user( $_POST['log'] ),
		'user_password' => $_POST['pwd'],
		'remember'      => $_POST['rememberme'],
	) );

	$response = array();
	if ( is_wp_error( $user ) ) {
		$response['code']    = $user->get_error_code();
		$response['message'] = $user->get_error_message();
	}
	echo json_encode( $response );
	wp_die();
}