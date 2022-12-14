<?php

function disable_plugin_updates( $value ) {
	$pluginsToDisable = [
		'advanced-custom-fields-pro/acf.php',
	];
	if ( isset( $value ) && is_object( $value ) ) {
		foreach ( $pluginsToDisable as $plugin ) {
			if ( isset( $value->response[ $plugin ] ) ) {
				unset( $value->response[ $plugin ] );
			}
		}
	}

	return $value;
}

add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );

//register menu

function theme_register_nav_menu() {

	register_nav_menu( 'header-primary', 'Header Menu' );
	register_nav_menu( 'footer-primary', 'Footer Menu' );

}

function splitter_primary_nav_class( $classes, $item, $args ) {
	global $post;
	if ( 'header-primary' === $args->theme_location ) {
		$classes[] = "menu-list__item";

		if ( isset( $post->post_type ) ) {
			if ( $item->type === 'post_type_archive' && $item->object === $post->post_type ) {
				$classes[] = 'current-menu-item';
			}
		}
	}

	if ( 'footer-primary' === $args->theme_location ) {
		$classes[] = "footer-navigation__menu-item";
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'splitter_primary_nav_class', 10, 4 );

add_action( 'after_setup_theme', 'theme_register_nav_menu' );


add_action( 'admin_menu', 'remove_menus' );
function remove_menus() {

	remove_menu_page( 'edit.php' );

}

function splitter_class_names( $classes ) {
	if ( is_home() || is_front_page() ) {
		$classes[] = 'main-page';
	}
	if ( is_page_template( 'about.php' ) ) {
		$classes[] = 'about';
	} elseif ( is_page_template( array(
		'page-templates/personal-info.php',
		'page-templates/brand-settings.php',
		'page-templates/brand-statistic.php'
	) ) ) {
		$classes[] = 'personal';
	} elseif ( is_page_template( 'page-templates/help-delete.php' ) ) {
		$classes[] = 'help';
	} elseif ( is_page_template( 'page-templates/links.php' ) ) {
		$classes[] = 'links';
	} elseif ( is_page_template( 'page-templates/login.php' ) || is_page_template( 'page-templates/registration.php' ) ) {
		$classes[] = 'login';
	} elseif ( is_page_template( array( 'page-templates/news-page.php', ) ) ) {
		$classes[] = 'news';
	} elseif ( is_singular( 'news-item' ) ) {
		$classes[] = 'news';
	} elseif ( is_page_template( 'page-templates/registration-confirmation.php' ) || is_page_template( 'page-templates/restore-access.php' ) ) {
		$classes[] = 'recovery';
	} elseif ( is_search() ) {
		$classes[] = 'search-page main-page';
	} elseif ( is_404() ) {
		$classes[] = 'page-not-found';
	}
	if ( is_post_type_archive( 'brands' ) ) {
		$classes[] = 'catalog main-page';
	}

	return $classes;
}

add_filter( 'body_class', 'splitter_class_names' );

add_filter( 'wp_head', 'edit_brand_post_check', 1 );
function edit_brand_post_check() {
	if ( is_page_template( 'page-templates/add-brand.php' ) && ! empty( $_GET['post_id'] ) ) {
		if ( is_user_logged_in() ) {
			$post_id = absint( $_GET['post_id'] );
			$post    = get_post( $post_id );
			if ( ! ( current_user_can( 'edit_post', $post_id ) || (int) $post->post_author === get_current_user_id() ) || in_array( get_post( $post_id )->post_status, array(
					'draft',
					'rejected',
					'pending',
				) )
			) {
				wp_safe_redirect( splitter_lang_condition( array(
						'ukr' => home_url( '/edit-account/' ),
						'eng' => home_url( '/eng/personal-account/' )
					)
				), 307 );
			}
		} else {
			$redirect_after_login = home_url( add_query_arg( null, null ) );
			wp_safe_redirect( wp_login_url( $redirect_after_login ) );
		}
	}
}

add_filter( 'wp_head', 'edit_brand_check', 1 );
function edit_brand_check() {
	if ( is_page_template( 'page-templates/brand-ownership.php' ) && ! empty( $_GET['post_id'] ) ) {
		$post_id = absint( $_GET['post_id'] );
		if ( ! is_user_logged_in() || ! splitter_post_exists( $post_id ) ) {
			wp_safe_redirect( home_url( splitter_lang_condition( array('ukr' => '/brands-settings/', 'eng' => '/eng/brands-setting/' ) ) ), 307 );
		}
	}
}

add_filter( 'wp_head', 'brand_settings_edit', 1 );
function brand_settings_edit() {
	if ( is_page_template( 'page-templates/brand-settings.php' ) && ! empty( $_GET['post_id'] ) ) {
		$post_id         = absint( $_GET['post_id'] );
		$allowed_actions = array(
			'activate-post',
			'deactivate-post',
			'delete-post'
		);
		$action          = in_array( $_GET['action'], $allowed_actions ) ? $_GET['action'] : false;

		if ( ! is_user_logged_in() ) {
			$redirect_after_login = home_url( add_query_arg( null, null ) );
			wp_safe_redirect( wp_login_url( $redirect_after_login ) );
		}

		if ( $action && wp_verify_nonce( $_GET['_wpnonce'], $action ) ) {
			$post = get_post( $post_id );

			if ( ! ( current_user_can( 'edit_post', $post_id ) || (int) $post->post_author === get_current_user_id() ) || $post->post_status === 'pending' || $post->post_status === 'draft' ) {
				wp_safe_redirect( home_url( splitter_lang_condition( array('ukr' => '/brands-settings/', 'eng' => '/eng/brands-setting/' ) ) ), 307 );
			}

			$post_data = array(
				'ID' => $post_id,
			);
			switch ( $action ) {
				case 'activate-post':
					$transitive_status        = get_post_meta( $post_id, 'brand_transitive_status', true );
					$post_data['post_status'] = $transitive_status ?: 'publish';
					break;
				case 'deactivate-post':
					$post_data['post_status'] = 'deactivated';
					update_post_meta( $post_id, 'brand_transitive_status', $post->post_status );
					break;
				case 'delete-post':
					wp_trash_post( $post_id );
					$post_data = array();
					break;
				default:
					$post_data = array();
			}

			if ( ! empty( $post_data ) ) {
				$post_id = wp_update_post( $post_data, true );

				if ( is_wp_error( $post_id ) ) {
//					var_dump( $post_id );
					// todo: add some exceptions handling
				}
			}
			wp_safe_redirect( home_url( splitter_lang_condition( array('ukr' => '/brands-settings/', 'eng' => '/eng/brands-setting/' ) ) ), 307 );
		}
	}
}

add_filter( 'lostpassword_url', 'change_lost_password_url', 10, 2 );
function change_lost_password_url( $url, $redirect ): string {
	$url = splitter_lang_condition( array('ukr' => home_url( '/restore-access/' ), 'eng' => home_url( '/eng/restore-password/' ) ) );

	return add_query_arg( array( 'redirect' => $redirect ), $url );
}

add_filter( 'login_url', 'change_login_url', 10, 3 );
function change_login_url( $url, $redirect, $force_reauth ): string {
	if ( is_admin() ) {
		return $url;
	}
	$url = splitter_lang_condition( array('ukr' => home_url( '/login/' ), 'eng' => home_url( '/eng/sign-in/' ) ) );

	if ( $redirect ) {
		$url = add_query_arg( 'redirect', $redirect, $url );
	}
	if ( $force_reauth ) {
		$url = add_query_arg( 'reauth', '1', $url );
	}

	return $url;
}


add_action( 'wp_head', 'authorized_only_pages', 1 );

function authorized_only_pages() {
	if ( ! is_user_logged_in() ) {
		if ( is_page_template( array(
			'page-templates/personal-info.php',
			'page-templates/brand-settings.php',
			'page-templates/brand-statistic.php',
			'page-templates/brand-ownership.php',
			'page-templates/contact-administrator.php',
//			'page-templates/add-brand.php',
		) ) ) {
			auth_redirect();
		}
	}
}


//max symbols function
function max_symbols_is( $string, $max_symbols ) {
	if ( mb_strlen( $string ) > $max_symbols ) {
		$string = mb_strimwidth( $string, 0, $max_symbols, '...' );
	}

	return $string;
}

function splitter_trim_symbols( $string, $length ): string {
	if ( mb_strlen( $string ) > $length ) {
		$string = mb_strimwidth( trim( $string ), 0, $length );
		$string = trim( $string, " \t\n\r,:." ) . '...';
	}

	return $string;
}

function isDigits( string $s, int $minDigits = 9, int $maxDigits = 14 ): bool {
	return preg_match( '/^[0-9]{' . $minDigits . ',' . $maxDigits . '}\z/', $s );
}

function isValidTelephoneNumber( string $telephone, int $minDigits = 10, int $maxDigits = 12 ): bool {
	if ( preg_match( '/^[+][0-9]/', $telephone ) ) { //is the first character + followed by a digit
		$count     = 1;
		$telephone = str_replace( [ '+' ], '', $telephone, $count ); //remove +
	}
	$telephone = normalizeTelephoneNumber( $telephone );

	//are we left with digits only?
	return isDigits( $telephone, $minDigits, $maxDigits );
}

function normalizeTelephoneNumber( string $telephone ): string {
	//remove white space, dots, hyphens and brackets
	return str_replace( [ ' ', '.', '-', '(', ')' ], '', $telephone );
}

function generate_username( $string ) {
	$string = sanitize_text_field( $string );
	if ( class_exists( '\Cyr_To_Lat\Main' ) ) {
		$transliterate = new Cyr_To_Lat\Main();
		$string        = $transliterate->transliterate( $string );
	} else {
		$table  = array(
			'А' => 'A',
			'Б' => 'B',
			'В' => 'V',
			'Г' => 'G',
			'Д' => 'D',
			'Е' => 'E',
			'Ё' => 'YO',
			'Ж' => 'ZH',
			'З' => 'Z',
			'И' => 'I',
			'Й' => 'J',
			'К' => 'K',
			'Л' => 'L',
			'М' => 'M',
			'Н' => 'N',
			'О' => 'O',
			'П' => 'P',
			'Р' => 'R',
			'С' => 'S',
			'Т' => 'T',
			'У' => 'U',
			'Ф' => 'F',
			'Х' => 'H',
			'Ц' => 'CZ',
			'Ч' => 'CH',
			'Ш' => 'SH',
			'Щ' => 'SHH',
			'Ъ' => '',
			'Ы' => 'Y',
			'Ь' => '',
			'Э' => 'E',
			'Ю' => 'YU',
			'Я' => 'YA',
			'а' => 'a',
			'б' => 'b',
			'в' => 'v',
			'г' => 'g',
			'д' => 'd',
			'е' => 'e',
			'ё' => 'yo',
			'ж' => 'zh',
			'з' => 'z',
			'и' => 'i',
			'й' => 'j',
			'к' => 'k',
			'л' => 'l',
			'м' => 'm',
			'н' => 'n',
			'о' => 'o',
			'п' => 'p',
			'р' => 'r',
			'с' => 's',
			'т' => 't',
			'у' => 'u',
			'ф' => 'f',
			'х' => 'h',
			'ц' => 'cz',
			'ч' => 'ch',
			'ш' => 'sh',
			'щ' => 'shh',
			'ъ' => '',
			'ы' => 'y',
			'ь' => '',
			'э' => 'e',
			'ю' => 'yu',
			'я' => 'ya',
			'І' => 'I',
			'і' => 'i',
			'Ѣ' => 'YE',
			'ѣ' => 'ye',
			'Ѳ' => 'FH',
			'ѳ' => 'fh',
			'Ѵ' => 'YH',
			'ѵ' => 'yh',
		);
		$string = strtr( $string, $table );
	}

	$string = strtolower( str_replace( ' ', '_', $string ) );

	return generate_unique_username( $string );
}

function generate_unique_username( $username, $index = '' ) {
	if ( $index ) {
		$new_username = sprintf( '%s-%s', $username, $index );
	} else {
		$new_username = $username;
	}
	if ( ! username_exists( $new_username ) ) {
		return $new_username;
	} else {
		$index = mt_rand( 1, 99999 );

		return generate_unique_username( $username, $index ); //todo remove recursion
	}
}

function splitter_get_admin_ids(): array {
	global $wpdb;

	$admins = $wpdb->get_col( $wpdb->prepare( "SELECT user_id 
						FROM $wpdb->usermeta 
						WHERE meta_key = 'wp_capabilities'
						AND meta_value LIKE %s",
		'%' . $wpdb->esc_like( 'administrator' ) . '%' ) );
	if ( is_array( $admins ) ) {

		// Remove possible roles like 'xyzadministrator'
		foreach ( array_keys( $admins ) as $key ) {
			if ( ! user_can( $admins[ $key ], 'administrator' ) ) {
				unset( $admins[ $key ] );
			}
		}
	} else {
		$admins = array();
	}

	return $admins;
}

function social_share_link( $target_media ) {
	global $post;
	$short_link = wp_get_shortlink();
	$url        = rawurlencode( $short_link ?: get_permalink() );
	$title      = rawurlencode( get_the_title() );
	$share_url  = false;

	switch ( $target_media ) {
		case 'facebook':
			$share_url = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
			break;
		case 'twitter':
			$share_url = "https://twitter.com/intent/tweet?url=" . $url . "&text=" . $title;
			break;
		case 'messenger':
			$share_url = "https://www.facebook.com/dialog/send?app_id=582974079197583&link=" . $url . "&redirect_uri=" . $url;
			break;
		case 'telegram':
			$share_url = 'https://t.me/share/url?url=' . $url . '&text=' . $title;
			break;
		default:
			break;
	}

	return $share_url;
}


function add_blog_post_to_query( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'post_type', array( 'post', 'news' ) );
		$query->set( 'posts_per_page', 3 );
	}
}

add_action( 'pre_get_posts', 'add_blog_post_to_query' );

function is_valid_url( $url ): bool {
	$url          = strpos( $url, 'http' ) === 0 ? $url : "http://$url";
	$file_headers = @get_headers( $url );

	return ( $file_headers && $file_headers[0] !== 'HTTP/1.1 404 Not Found' );
}


function krop_address_view( $location ) {
	$address = __( 'м.', 'krop' ) . ' ' . $location['city'] . ', ' . $location['street_name'] . ', ' . $location['street_number'];

	return $address;
}

/**
 * @param $id int|WP_Post $post Optional. Post ID or post object. Defaults to global $post..
 *
 * @return bool
 */
function splitter_post_exists( $id ): bool {
	return is_string( get_post_status( $id ) );
}

function human_time_post_date( $post_id = null, $modified = false ) {
	return sprintf( esc_html__( '%s ago', 'krop' ), human_time_diff( $modified ? get_the_modified_date( 'U', $post_id ) : get_the_time( 'U', $post_id ), current_time( 'timestamp' ) ) );
}

function work_time_format( $post_id ) {
	$work_hours = get_field( 'works_hours', $post_id );
	if ( $work_hours == 'standard' ) {
		$response_hours = '08:00 - 20:00';
	} elseif ( $work_hours == '24' ) {
		$response_hours = '00:00 - 24:00';
	} elseif ( $work_hours == 'night' ) {
		$response_hours = '20:00 - 08:00';
	} elseif ( $work_hours == 'custom' ) {
		$from           = get_field( 'time_from', $post_id );
		$to             = get_field( 'time_to', $post_id );
		$response_hours = $from . ' - ' . $to;
	}
	$work_days = get_field( 'works_days', $post_id );
	if ( $work_days == 'no_weekends' ) {
		$response_days = __( 'Monday', 'krop' ) . ' - ' . mb_strtolower( __( 'Sunday', 'krop' ) );
	} elseif ( $work_days == 'weekdays' ) {
		$response_days = __( 'Monday', 'krop' ) . ' - ' . mb_strtolower( __( 'Friday', 'krop' ) );
	} elseif ( $work_days == 'weekends' ) {
		$response_days = __( 'Saturday', 'krop' ) . ' - ' . mb_strtolower( __( 'Sunday', 'krop' ) );
	} elseif ( $work_days == 'custom' ) {
		$from          = get_field( 'time_from', $post_id );
		$to            = get_field( 'time_to', $post_id );
		$response_days = $from . ' - ' . $to;
	}
	$response = $response_days . ': ' . $response_hours;

	return $response;
}

function remove_post_code( $address ) {
	$first_five_characters = mb_substr( $address, 0, 5 );
	if ( ctype_digit( $first_five_characters ) ) {
		$address = str_replace( $first_five_characters . ',', '', $address );
	}

	return $address;
}


add_filter( 'post_thumbnail_id', 'brand_fallback', 10, 2 );

function brand_fallback( $id, $post ) {
	if ( ! $id ) {
		$post_type = get_post_type( $post );
		if ( $post_type == 'brands' ) {
			return get_field( 'brands_placeholder_img', 'options' );
		} elseif ( $post_type == 'places' ) {
			return get_field( 'places_placeholder_img', 'options' );
		}
	} else {
		return $id;
	}
}

function can_user_edit_post( $post_id ): bool {
	$post = get_post( $post_id );

	return $post_id && splitter_post_exists( $post ) && ( current_user_can( 'edit_post', $post_id ) || ( (int) $post->post_author === get_current_user_id() ) );
}

function echo_formatted_rating( $brand_rating ) {
	echo number_format( round( $brand_rating, 1 ), 1 );
}


//add_action( 'wp_head', 'trigger_email_change_confirm', 1 );

// todo delete this staff
function trigger_email_change_confirm(): void {

	if ( ! is_page_template( 'page-templates/personal-info.php' ) ) {
		return;
	}
	global $wpdb;
	$transitive_email        = get_user_meta( get_current_user_id(), 'transitive_email', true );
	$transitive_email_shoved = get_user_meta( get_current_user_id(), 'transitive_email_shoved', true );

	$transitive_phone        = get_user_meta( get_current_user_id(), 'transitive_phone', true );
	$transitive_phone_shoved = get_user_meta( get_current_user_id(), 'transitive_phone_shoved', true );

	if ( $transitive_email && isset( $_GET['action'] ) && $_GET['action'] === 'confirm_email_change' ) {
		$rp_key = $_GET['key'];
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
		} else {
			$userdata['ID']         = $user->ID;
			$userdata['user_email'] = get_user_meta( $user->ID, 'transitive_email', true );
			delete_user_meta( $user->ID, 'transitive_email' );
			$is_updated = wp_update_user( $userdata );
//			if ( is_wp_error( $is_updated ) ) {
//				wp_safe_redirect(
//					add_query_arg(
//						array( 'errors' => $is_updated->get_error_code() ),
//						home_url( '/edit-account/' )
//					)
//				);
//			}
		}
	} elseif ( $transitive_email && ( ! $transitive_email_shoved || ( isset( $_GET['send_confirm_again'] ) && $_GET['send_confirm_again'] === 1 ) ) ) {

		$user = wp_get_current_user();

		$key = wp_generate_password( 6, false );
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . 'wp-includes/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}
		$hashed = $wp_hasher->HashPassword( $key );
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => time() . ":" . $hashed ), array( 'user_login' => $user->user_login ) );

		$message = __( 'Someone requested email changing for the following account:', 'krop' ) . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
		$message .= sprintf( __( 'New email: %s', 'krop' ), $transitive_email ) . "\r\n\r\n";
		$message .= __( 'If this was a mistake, just ignore this email and nothing will happen.', 'krop' ) . "\r\n\r\n";
		$message .= __( 'For changing account email, visit the following address:', 'krop' ) . "\r\n\r\n";
		$message .= '<' . network_site_url( "edit-account/?action=confirm_email_change&key=$key&login=" . rawurlencode( $user->user_login ), 'login' ) . ">\r\n";

		if ( is_multisite() ) {
			$blogname = $GLOBALS['current_site']->site_name;
		} else {
			$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		}

		$title = sprintf( __( '[%s] Password Reset' ), $blogname );

		$title   = apply_filters( 'retrieve_password_title', $title );
		$message = apply_filters( 'retrieve_password_message', $message, $key );

		if ( $message && wp_mail( $user->user_email, $title, $message ) ) {
			update_user_meta( get_current_user_id(), 'transitive_email_shoved', true );
			wp_safe_redirect( home_url( '/confirm-email/' ) );
			die();
		}
	} elseif ( $transitive_phone && ( ! $transitive_phone_shoved || ( isset( $_GET['send_confirm_again'] ) && $_GET['send_confirm_again'] === 2 ) ) ) {

	}
}

function splitter_lang_condition($array) {
    if (function_exists('pll_current_language') && isset( $array[pll_current_language()] ) ) {
        return $array[pll_current_language()];
    } else {
        return reset($array);
    }
}