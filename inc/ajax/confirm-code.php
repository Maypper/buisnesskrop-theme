<?php
function splitter_ajax_confirm_code(): void {
	$user_login = is_user_logged_in() ? wp_get_current_user()->user_login : $_POST['login'];
	$user = check_password_reset_key( $_POST['key'], $user_login );
	if ( is_wp_error( $user ) ) {
		wp_send_json( array(
			'code' => $user->get_error_code()
		) );
		die();
	} else {
		$transitive_login = get_user_meta( $user->ID, 'transitive_login', true );
		$transitive_email = get_user_meta( $user->ID, 'transitive_email', true );
		$transitive_phone = get_user_meta( $user->ID, 'transitive_phone', true );
		if ( $transitive_login ) { // registration confirm
			if ( $_POST['login_type'] == 'email' ) {
				wp_insert_user( array(
					'ID'         => $user->ID,
					'user_email' => $transitive_login,
					'user_login' => $user->user_login
				) );
			} elseif ( $_POST['login_type'] == 'phone' ) {
				update_user_meta( $user->ID, 'user_phone', normalizeTelephoneNumber( $transitive_login ) );
			}
			delete_user_meta( $user->ID, 'transitive_login' );
		} elseif ( $transitive_phone || $transitive_email ) {
			if ( $_POST['login_type'] == 'phone' && $transitive_phone ) {
				update_user_meta( $user->ID, 'user_phone', normalizeTelephoneNumber( $transitive_phone ) );
				delete_user_meta( $user->ID, 'transitive_phone' );
			} elseif ( $_POST['login_type'] === 'email' && $transitive_email ) {
				wp_update_user( array(
					'ID'         => $user->ID,
					'user_email' => get_user_meta( $user->ID, 'transitive_email', true )
				) );
				delete_user_meta( $user->ID, 'transitive_email' );
			}

			$transitive_email = get_user_meta( $user->ID, 'transitive_email', true );
			$transitive_phone = get_user_meta( $user->ID, 'transitive_phone', true );
			if ($transitive_email || $transitive_phone ) {
				wp_send_json( array(
					'modal' => 'modal-confirm-code',
					'login' => $user->user_login,
					'login_type' => $transitive_email ? 'email' : 'phone',
					'user_password' => false,
				) );
			}
			wp_send_json( array() );
		}
	}

	if ( ! empty( $_POST['user_password'] ) || ! is_user_logged_in() ) {
		wp_logout(); // just for sure
		$user = wp_signon( array(
			'user_login'    => $_POST['login'],
			'user_password' => $_POST['user_password'],
			'remember'      => true,
		) );
		if ( is_wp_error( $user ) ) {
			wp_send_json( array(
				'code' => $user->get_error_code()
			) );
		} else {
			wp_send_json( array(
				'redirect' => home_url( splitter_lang_condition( array('ukr' => '/registration-confirmation/', 'eng' => '/eng/registration-confirm/' ) ) )
			) );
		}
		die();
	}


	die();
}
