<?php
function splitter_send_confirmation_code(): void {
	global $wpdb;
	$user           = wp_get_current_user();
	$email_or_phone = $_POST['email_or_phone'];
	$response       = array();

	if ( filter_var( $email_or_phone, FILTER_VALIDATE_EMAIL ) ) {
		$response['type'] = 'email';
		$transitive_login = filter_var( $email_or_phone, FILTER_SANITIZE_EMAIL );
		$key              = wp_generate_password( 6, false );

		$message = __( 'Someone requested email changing for the following account:', 'krop' ) . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
		$message .= sprintf( __( 'New email: %s', 'krop' ), $transitive_login ) . "\r\n\r\n";
		$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'krop' ) . "\r\n\r\n";
		$message .= __( 'For confirming account email, use that code:', 'krop' ) . "\r\n\r\n";
		$message .= "$key";

		if ( is_multisite() ) {
			$blogname = $GLOBALS['current_site']->site_name;
		} else {
			$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		}

		$title = sprintf( __( '[%s] Confirm Email', 'krop' ), $blogname );

		if ( $message && wp_mail( $user->user_email, $title, $message ) ) {
			$response['sent'] = true;
		}
	} elseif ( isValidTelephoneNumber( $email_or_phone ) ) {
		$response['type'] = 'phone';
		$transitive_login = normalizeTelephoneNumber( $email_or_phone );
		if (strlen($transitive_login) == 10 && str_starts_with( $transitive_login, '0' ) ) {
			$transitive_login = '+38'.$transitive_login;
		}
		$key              = wp_rand( 100000, 999999 );

		$message = 'Your OTP is: ' . $key . '
@' . parse_url( home_url() )['host'] . ' #' . $key;

		$response['number'] = $transitive_login;
		$sms_sender = new SMS_Sender( array( $transitive_login ), $message );
		$result     = $sms_sender->send();

		if ( ! is_wp_error( $result ) ) {
			$response['result'] = $result;
			$response['sent'] = ($result->response_code >= 800 && $result->response_code < 900);
		}
	} else {
		$response['sent'] = false;
		$response['code'] = 'invalid-email-or-phone';
		wp_send_json_error( $response );
	}

	if ( empty( $wp_hasher ) ) {
		require_once ABSPATH . 'wp-includes/class-phpass.php';
		$wp_hasher = new PasswordHash( 8, true );
	}
	$hashed = $wp_hasher->HashPassword( $key );
	$wpdb->update( $wpdb->users, array( 'user_activation_key' => time() . ":" . $hashed ), array( 'user_login' => $user->user_login ) );
	/** @noinspection PhpUndefinedVariableInspection */
	update_user_meta( get_current_user_id(), 'transitive_' . $response['type'], $transitive_login );
	wp_send_json( $response );
}

