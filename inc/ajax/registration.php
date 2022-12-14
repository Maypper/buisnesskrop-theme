<?php
function splitter_ajax_registration() {
	global $wpdb;
	check_ajax_referer( 'registration-nonce' );
	if ( ! get_option( 'users_can_register' ) ) {
		echo 'Sorry, registration is temporarily unavailable';
		http_response_code( 403 );
		wp_die();
	}

	$response         = array();
	$maybe_user_email = $_POST['user_email'];
	$username         = generate_username( $_POST['user_fio'] );

	$userdata = [
		'user_login'           => $username,
		'user_email'           => '',
		'user_pass'            => $_POST['user_password'],
		'display_name'         => $_POST['user_fio'],
		'show_admin_bar_front' => 'false'
	];

	if ( filter_var( $maybe_user_email, FILTER_VALIDATE_EMAIL ) ) {
		$response['login_type'] = 'email';
		$transitive_login       = filter_var( $_POST['user_email'], FILTER_SANITIZE_EMAIL );
//		$userdata['user_email'] = filter_var( $maybe_user_email, FILTER_SANITIZE_EMAIL );
	} elseif ( isValidTelephoneNumber( $_POST['user_email'] ) ) {
		$response['login_type'] = 'phone';
		$transitive_login       = normalizeTelephoneNumber( $_POST['user_email'] );
	} else {
		$response['code'] = 'invalid-email-or-phone';
		echo json_encode( $response );
		wp_die();
	}
	// elseif phone number...
	// $response['login_type'] = 'mobile';

	$user_id = wp_insert_user( $userdata );

	if ( is_wp_error( $user_id ) ) {
		$response['code']    = $user_id->get_error_code();
		$response['message'] = $user_id->get_error_message();
	} else {
//		do_action( 'register_new_user', $user_id );

		$response['modal'] = 'modal-confirm-code';
		$response['login'] = $username;
		$response['user_password'] = $_POST['user_password'];

		$user = get_user_by( 'ID', $user_id );

		// generate code to finish registration
		if ( $response['login_type'] === 'email' ) {
			$key = wp_generate_password( 6, false );
		} elseif ( $response['login_type'] === 'phone' ) {
			$key = wp_rand( 100000, 999999 );
		}
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . 'wp-includes/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}
		$hashed = $wp_hasher->HashPassword( $key );
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => time() . ":" . $hashed ), array( 'user_login' => $user->user_login ) );

		//send code via email or SMS
		if ( $response['login_type'] === 'email' ) {
			do_action( 'qm/debug', 'Login type is email' );
			$message = __( 'Only one step left to finish registration for account!', 'krop' ) . "\r\n\r\n";
			$message .= network_home_url( '/' ) . "\r\n\r\n";
			$message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
			$message .= sprintf( __( 'Email: %s', 'krop' ), $transitive_login ) . "\r\n\r\n";
			$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'krop' ) . "\r\n\r\n";
			$message .= __( 'For confirming account email, use that code:', 'krop' ) . "\r\n\r\n";
			$message .= "$key";

			if ( is_multisite() ) {
				$blogname = $GLOBALS['current_site']->site_name;
			} else {
				$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
			}

			$title = sprintf( __( '[%s] Confirm Email', 'krop' ), $blogname );
			wp_mail( $transitive_login, $title, $message );
		} elseif ( $response['login_type'] === 'phone' ) {
			// for SMS
			do_action( 'qm/debug', 'Login type is phone number' );
			if (strlen($transitive_login) == 10 && str_starts_with( $transitive_login, '0' ) ) {
				$transitive_login = '+38'.$transitive_login;
			}

			// don`t translate, cyrillic letters cost more than latin
			$message = sprintf( __( 'Your OTP is: %s' ), $key ) . '
@' . parse_url( home_url() )['host'] . ' #' . $key;

			$sms_sender           = new SMS_Sender( array( $transitive_login ), $message );
			$response_sms = $sms_sender->send();
			if ( is_wp_error( $response_sms ) || !($response_sms->response_code >= 800 && $response_sms->response_code < 900) ) {
				$response['code'] = 'invalid-phone';
			}
		}
		update_user_meta( $user_id, 'transitive_login', $transitive_login ); // maybe login


		// переміщено в підтвердження коду
//		wp_logout();
//		$user = wp_signon( array(
//			'user_login'    => $username,
//			'user_password' => $_POST['user_password'],
//			'remember'      => true,
//		) );
//		if ( is_wp_error( $user ) ) {
//			$response['code']    = $user->get_error_code();
//			$response['message'] = $user->get_error_message();
//		}
	}
	echo json_encode( $response );
	wp_die();
}