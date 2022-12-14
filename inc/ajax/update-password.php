<?php
function splitter_ajax_update_password() {
	check_ajax_referer( 'update-password-nonce' );
	$response = array();
	$rp_key   = $_POST['code'];

	// check rp cookie
	list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
	$rp_cookie = 'wp-resetpass-' . COOKIEHASH;
	if ( isset( $_COOKIE[ $rp_cookie ] ) ) {
		$user = check_password_reset_key( $rp_key, wp_unslash( $_COOKIE[ $rp_cookie ] ) );
	} else {
		$user = false;
	}

	if ( ! $user || is_wp_error( $user ) ) {
		setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );

		if ( $user && $user->get_error_code() === 'expired_key' ) {
			$response['code']    = $user->get_error_code();
			$response['message'] = $user->get_error_message();
		} else {
			$response['code']    = 'invalid_code';
			$response['message'] = __( 'Incorrect code, check that it is entered correctly', 'krop' );
		}

		echo json_encode( $response );
		wp_die();
	}

	if ( isset( $_POST['new-password'] ) && ! empty( $_POST['new-password'] ) ) {
		wp_set_password( $_POST['new-password'], $user->ID );
//		reset_password( $user, $_POST['user_password'] );
		setcookie( $rp_cookie, ' ', time() - YEAR_IN_SECONDS, $rp_path, COOKIE_DOMAIN, is_ssl(), true );
	}

	echo json_encode( $response );
	wp_die();
}