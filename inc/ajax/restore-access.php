<?php
function splitter_ajax_restore_access() {
	global $wpdb;
	check_ajax_referer( 'restore-access-nonce' );
	$response   = array();
	$user_login = $_POST['login'];


	$user_login = sanitize_text_field( $user_login );
	if ( empty( $user_login ) ) {
		$response['code']    = 'empty_username';
		$response['message'] = __( 'Please enter your email or username', 'krop' );

	} else if ( strpos( $user_login, '@' ) ) {
		$user_data = get_user_by( 'email', trim( $user_login ) );
		if ( empty( $user_data ) ) {
			$response['code']    = 'username_not_found';
			$response['message'] = __( 'User with such email or username not registered', 'krop' );
		}
	} else {
		$login     = trim( $user_login );
		$user_data = get_user_by( 'login', $login );

		if ( empty( $user_data ) ) {
			$response['code']    = 'username_not_found';
			$response['message'] = __( 'User with such email or username not registered', 'krop' );
		}
	}

	if ( empty( $user_data ) ) {
		echo json_encode( $response );
		wp_die();
	}

	do_action( 'lostpassword_post' );


	// redefining user_login ensures we return the right case in the email
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;

//    do_action('retreive_password', $user_login);  // Misspelled and deprecated
	do_action( 'retrieve_password', $user_login );
	$allow = apply_filters( 'allow_password_reset', true, $user_data->ID );
	if ( ! $allow ) {
		echo __( 'Sorry, unable reset password.', 'krop' );
		http_response_code( 403 );
		wp_die();
	} elseif ( is_wp_error( $allow ) ) {
		echo __( 'Sorry, unable reset password.', 'krop' );
		http_response_code( 403 );
		wp_die();
	}
	$key = wp_generate_password( 6, false );
	do_action( 'retrieve_password_key', $user_login, $key );

	if ( empty( $wp_hasher ) ) {
		require_once ABSPATH . 'wp-includes/class-phpass.php';
		$wp_hasher = new PasswordHash( 8, true );
	}
	$hashed = $wp_hasher->HashPassword( $key );
	$wpdb->update( $wpdb->users, array( 'user_activation_key' => time() . ":" . $hashed ), array( 'user_login' => $user_login ) );


	// set rp cookie
	list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
	$rp_cookie = 'wp-resetpass-' . COOKIEHASH;
	setcookie( $rp_cookie, $user_login, 0, $rp_path, COOKIE_DOMAIN, is_ssl(), true );

	// send email with code
	$message = __( 'Someone requested that the password be reset for the following account:' ) . "\r\n\r\n";
	$message .= network_home_url( '/' ) . "\r\n\r\n";
	$message .= sprintf( __( 'Username: %s' ), $user_login ) . "\r\n\r\n";
	$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'krop' ) . "\r\n\r\n";
	$message .= __( 'To reset your password, paste this code in form', 'krop' ) . "\r\n\r\n";
	$message .= $key . "\r\n";
//    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
//    $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

	if ( is_multisite() ) {
		$blogname = $GLOBALS['current_site']->site_name;
	} else {
		$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
	}

	$title = sprintf( __( '[%s] Email confirmation', 'krop' ), $blogname );

	$title   = apply_filters( 'retrieve_password_title', $title );
	$message = apply_filters( 'retrieve_password_message', $message, $key );

	if ( $message && ! wp_mail( $user_email, $title, $message ) ) {
		http_response_code( 403 );
		$response['code']    = 'email_dont_send';
		$response['message'] = __( 'The e-mail could not be sent.', 'krop' );
		// I will die later
	}

	echo json_encode( $response );
	wp_die();
}