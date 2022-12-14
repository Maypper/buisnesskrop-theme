<?php
function splitter_ajax_account_editing() {
	global $wpdb;
	check_ajax_referer( 'account-editing' );

	$user_id = get_current_user_id();
	if ( ! $user_id ) {
		http_response_code( 403 );
		wp_die();
	}

	$response = array();
	$userdata = array(
		'ID' => $user_id,
	);
	if ( ! empty( $_POST['user_password'] ) ) {
		$userdata['user_pass'] = $_POST['user_password'];
	}
	if ( ! empty( $_POST['user_display_name'] ) ) {
		$userdata['display_name'] = sanitize_text_field( $_POST['user_display_name'] );
	}

	if ( ! empty( $_POST['user_email'] ) ) {
		if ( filter_var( $_POST['user_email'], FILTER_VALIDATE_EMAIL ) ) {
			if ( email_exists( filter_var( $_POST['user_email'], FILTER_SANITIZE_EMAIL ) ) ) {
				$response['code']    = 'existing_user_email';
				$response['message'] = 'existing_user_email';
				echo json_encode( $response );
				wp_die();
			}
			$transitive_email = filter_var( $_POST['user_email'], FILTER_SANITIZE_EMAIL );
			update_user_meta( $user_id, 'transitive_email', $transitive_email );
		} else {
			$response['code']    = 'invalid_email';
			$response['message'] = 'Invalid email';
			echo json_encode( $response );
			wp_die();
		}
	}
	if ( ! empty( $_POST['user_phone'] ) ) {
		// check is valid phone number
		if ( isValidTelephoneNumber( $_POST['user_phone'] ) ) {
			update_user_meta( $user_id, 'transitive_phone', normalizeTelephoneNumber( $_POST['user_phone'] ) );
		} else {
			$response['code']    = 'invalid_phone';
			$response['message'] = 'Invalid phone number';
			echo json_encode( $response );
			wp_die();
		}
	}


	$user_id = wp_update_user( $userdata );

	if ( is_wp_error( $user_id ) ) {
		wp_send_json(
			array( 'code' => $user_id->get_error_code(), 'message' => $user_id->get_error_message() )
		);
	}
	$user             = wp_get_current_user();
	$transitive_email = get_user_meta( $user->ID, 'transitive_email', true );
	$transitive_phone = get_user_meta( $user->ID, 'transitive_phone', true );
	if ( $transitive_email || $transitive_phone ) {
		if ( filter_var( $transitive_email, FILTER_VALIDATE_EMAIL ) ) {
			$response['type'] = 'email';
			$transitive_login = filter_var( $transitive_email, FILTER_SANITIZE_EMAIL );
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

			if ( !wp_mail( $user->user_email, $title, $message ) ) {
				wp_send_json(array('code' => 'invalid-email'));
			}
		} elseif ( isValidTelephoneNumber( $transitive_phone ) ) {
			$response['type'] = 'phone';
			$transitive_login = normalizeTelephoneNumber( $transitive_phone );
			if (strlen($transitive_login) == 10 && str_starts_with( $transitive_login, '0' ) ) {
				$transitive_login = '+38'.$transitive_login;
			}
			$key              = wp_rand( 100000, 999999 );

			$message = 'Your OTP is: ' . $key . '
@' . parse_url( home_url() )['host'] . ' #' . $key;

			$sms_sender = new SMS_Sender( array( $transitive_login ), $message );
			$result     = $sms_sender->send();

			$response_sms = $sms_sender->send();
			if ( is_wp_error( $response_sms ) || !($response_sms->response_code >= 800 && $response_sms->response_code < 900) ) {
				wp_send_json(array('code' => 'invalid_phone'));
			}
		}
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . 'wp-includes/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}
		$hashed = $wp_hasher->HashPassword( $key );
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => time() . ":" . $hashed ), array( 'user_login' => $user->user_login ) );
		/** @noinspection PhpUndefinedVariableInspection */
		update_user_meta( get_current_user_id(), 'transitive_' . $response['type'], $transitive_login );

		wp_send_json( array(
			'modal'         => 'modal-confirm-code',
			'login'         => $user->user_login,
			'login_type'    => $transitive_email ? 'email' : 'phone',
			'user_password' => false,
		) );
	}
	wp_send_json( array() );
}


