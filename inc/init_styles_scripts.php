<?php
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );

remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


function init_styles_scripts() {
	wp_dequeue_style( 'flexslider' );
	wp_dequeue_style( 'owl-carousel' );
	wp_dequeue_style( 'owl-theme' );
	wp_dequeue_style( 'font-awesome' );
	wp_dequeue_style( 'wp-pagenavi' );
	wp_dequeue_style( 'wp-block-library' );

	wp_deregister_script( 'flexslider' );
	wp_deregister_script( 'googlemapapis' );
	wp_deregister_script( 'easing' );
	wp_deregister_script( 'jflickrfeed' );
	wp_deregister_script( 'playlist' );
	wp_deregister_script( 'jplayer' );
	wp_deregister_script( 'wp-embed' );

	$tmplUri = get_template_directory_uri();

	/*if ( !is_admin() ) {
		wp_deregister_script('jquery');
	}*/
	wp_enqueue_script( "jquery" );


	wp_enqueue_style( 'main-styles', $tmplUri . '/assets/style/main.css', array() );
	wp_enqueue_style( 'add-style', $tmplUri . '/assets/style/add-style.css', array( 'main-styles' ) );

	wp_enqueue_script( 'flickity', 'https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js', array(), false, true );
	wp_enqueue_script( 'main-scripts', $tmplUri . '/assets/scripts/main.js', array(), false, true );
	wp_localize_script( 'main-scripts', 'l10n', array(
		'placeholders' => array(
			'select_category' => __('Select a category from the list', 'krop'),
			'enter_your_time' => __('Enter your time...', 'krop'),
		),
		'password_didnt_match' => __("Password didn't match", 'krop')
	));
	wp_enqueue_script( 'add-scripts', $tmplUri . '/assets/scripts/add-script.js', array(), false, true );
	wp_localize_script( 'add-scripts', 'add_scripts', array(
		'url'  => add_query_arg( array(
			'_wpnonce' => wp_create_nonce( 'read_notification' ),
			'action'   => 'read_notification'
		), admin_url( 'admin-ajax.php' ) ),
		'l10n' => array(
			'month' => array(
				__( 'january', 'krop' ),
				__( 'february', 'krop' ),
				__( 'march', 'krop' ),
				__( 'april', 'krop' ),
				__( 'may', 'krop' ),
				__( 'june', 'krop' ),
				__( 'july', 'krop' ),
				__( 'august', 'krop' ),
				__( 'september', 'krop' ),
				__( 'october', 'krop' ),
				__( 'november', 'krop' ),
				__( 'december', 'krop' ),
			),
			'day'   => array(
				__( 'Sunday', 'krop' ),
				__( 'Monday', 'krop' ),
				__( 'Tuesday', 'krop' ),
				__( 'Wednesday', 'krop' ),
				__( 'Thursday', 'krop' ),
				__( 'Friday', 'krop' ),
				__( 'Saturday', 'krop' ),
			)
		),

	) );
	wp_enqueue_script( 'embed-video', $tmplUri . '/assets/scripts/embed-video.js', array(), false, true );
	wp_enqueue_script( 'search', $tmplUri . '/assets/scripts/search.js', array(), false, true );
	wp_localize_script( 'search', 'search_data', array(
		'redirect_to' => esc_url( home_url( '/login' ) ),
	) );
	wp_enqueue_script( 'login', $tmplUri . '/assets/scripts/login.js', array( 'select' ), false, true );

	wp_localize_script( 'login', 'login_data', array(
		'root_url'    => admin_url( 'admin-ajax.php' ),
		'redirect_to' => array(
			'login'           => splitter_lang_condition( array(
				'ukr' => home_url( '/edit-account/' ),
				'eng' => home_url( '/eng/personal-account/' )
			) ),
			'registration'    => esc_url( splitter_lang_condition( array(
				'ukr' => home_url( '/registration-confirmation/' ),
				'eng' => home_url( '/eng/registration-confirm/' )
			) ) ),
			'restore_access'  => add_query_arg(
				array(
					'_wpnonce' => wp_create_nonce( 'reset-password-nonce' ),
					'action'   => 'restore_access'
				),
				splitter_lang_condition( array(
					'ukr' => home_url( '/restore-access/' ),
					'eng' => home_url( '/eng/restore-password/' )
				) )
			),
			'update_password' => add_query_arg(
				array(
					'action' => 'confirm_change'
				),
				splitter_lang_condition( array(
					'ukr' => home_url( '/restore-access/' ),
					'eng' => home_url( '/eng/restore-password/' )
				) )
			),
			'account_editing' => splitter_lang_condition( array(
					'ukr' => home_url( '/edit-account/' ),
					'eng' => home_url( '/eng/personal-account/' )
				)
			)
		)
	) );

	if ( is_page_template( 'page-templates/add-brand.php' ) ) {
		wp_enqueue_script( 'plupload', $tmplUri . '/assets/scripts/plupload.full.min.js', array(), false, true );
		wp_enqueue_script( 'uploader', $tmplUri . '/assets/scripts/uploader.js', array( 'plupload' ), 7.0, true );
		$post_id    = isset( $_GET['post_id'] ) ? absint( $_GET['post_id'] ) : false;
		$images     = get_field( 'field_620f88cd8e27e', $post_id );
		$image_urls = array();
		if ( $images ) {
			$image_urls = array_map( function ( $row ) {
				return wp_get_attachment_image_src( $row['image'], 'full' )[0];
			}, $images );
		}
		wp_localize_script( 'uploader', 'uploader_js', array(
			'url'       => add_query_arg( array(
				'_wpnonce' => wp_create_nonce( 'media_upload_brand' ),
				'action'   => 'media_upload_brand',
			), admin_url( 'admin-ajax.php' ) ),
			'preloaded' => json_encode( $image_urls ),
		) );
	}
	if ( is_page_template( array( 'page-templates/brand-settings.php', 'page-templates/brand-statistic.php' ) ) ) {
		wp_enqueue_script( 'edit-brand', $tmplUri . '/assets/scripts/edit-brands.js', array(), false, true );
		wp_localize_script( 'edit-brand', 'edit_brand', array(
			'root_url' => add_query_arg(
				array(
					'_wpnonce' => wp_create_nonce( 'load_statistic' ),
					'action'   => 'load_statistic'
				),
				admin_url( 'admin-ajax.php' )
			)
		) );
	}


	wp_enqueue_script( 'select', $tmplUri . '/assets/scripts/select.js', array(), false, true );
	$news_select = null;
	if ( is_page_template( 'page-templates/news-page.php' ) ) {
		$termsCat = get_terms( [
			'taxonomy'   => 'catecory-news',
			'hide_empty' => true,
		] );

		$termsAnn    = get_terms( [
			'taxonomy'   => 'catecory-announcement',
			'hide_empty' => true,
		] );
		$news_select = array(
			'terms_cats'          => $termsCat,
			'terms_ann'           => $termsAnn,
			'announc_placeholder' => __( 'Choose announcements', 'krop' ),
		);
	}
	$brands_cats        = get_terms( array(
		'hide_empty' => true,
		'taxonomy'   => 'category-brands',
		'fields'     => 'id=>name'
	) );
	$city_districts     = get_terms( array(
		'hide_empty' => false,
		'taxonomy'   => 'city_district',
		'fields'     => 'id=>name'
	) );
	$city_districts[''] = __('All districts', 'krop');
	$select_data = array(
		'news'             => $news_select,
		'brands'           => array_map( function ( $key, $value ) {
			return array( 'label' => $value, 'value' => $key );
		}, array_keys( $brands_cats ), array_values( $brands_cats ) ),
		'cats_placeholder' => __( 'Categories', 'krop' ),
		'news_placeholder' => __( 'News categories', 'krop' ),
		'district_placeholder' => __( 'City district', 'krop' ),
		'work_hours' => array(
			'working_hours' => __('Working hours', 'krop'),
			'select_working_hours' => __('Select workings hours', 'krop'),
			'twenty_four' => __('Around the clock', 'krop'),
			'standard' => __('Standard period (08:00 - 20:00)', 'krop'),
			'night' => __('Evening hours (20:00 - 08:00)', 'krop'),
			'custom' => __('Enter your time...', 'krop'),
		),
		'work_days' => array(
			'placeholder' => __('Select a work schedule', 'krop'),
			'no_weekends' => __('No holidays (from Monday to Sunday)', 'krop'),
			'weekdays' => __('Only on weekdays (Monday - Friday)', 'krop'),
			'weekends' => __('Only on weekends (Saturday - Sunday)', 'krop'),
			'custom' => __('Select your days of the week...', 'krop'),
		),
		'display_order' => array(
			'placeholder' => __('Display order', 'krop'),
			'new_first' => __('First the new ones', 'krop'),
			'old_first' => __('First the old ones', 'krop'),
		),
		'select_days' => __('Select your days of the week...', 'krop'),
		'city_districts'   => array_map( function ( $key, $value ) {
			return array( 'label' => $value, 'value' => $key );
		}, array_keys( $city_districts ), array_values( $city_districts ) ),
	);
	wp_localize_script( 'select', 'select_data', $select_data );


	wp_register_script( 'map', $tmplUri . '/assets/scripts/map.js', array(), false, true );
	// localize object for map
	if ( is_post_type_archive( 'brands' ) ) {
		$items_on_map = get_posts( array(
			'post_type'      => 'brands',
			'meta_key'       => 'post_location',
			'posts_per_page' => - 1,
		) );
	} elseif ( ! is_search() ) {
		$items_on_map = get_posts( array(
			'post_type'      => [ 'brands', 'places' ],
			'meta_key'       => 'post_location',
			'posts_per_page' => - 1,
		) );
	} elseif ( $_GET['search_post_type'] == 'brands' ) {
		$concrete_args = array(
			'post_type'      => $_GET['search_post_type'],
			'meta_key'       => 'post_location',
			'posts_per_page' => - 1,
			's'              => get_search_query(),
		);
		if ( ! empty( $_GET['category-brands'] ) ) {
			$concrete_args = search_tax_query( 'category-brands', $concrete_args );
		}
		if ( ! empty( $_GET['city_district'] ) ) {
			$concrete_args = search_tax_query( 'city_district', $concrete_args );
		}
		if ( ! empty( $_GET['work_hours'] ) ) {
			$concrete_args['meta_query'] = array(
				'relation' => 'AND',
			);

			if ( $_GET['work_hours'] == 'custom' ) {
				if ( ! empty( $_GET['time_from'] ) ) {
					$concrete_args['meta_query'][] = array(
						'key'     => 'time_from',
						'value'   => $_GET['time_from'],
						'compare' => '<=',
						'type'    => 'TIME',
					);
				}
				if ( ! empty( $_GET['time_to'] ) ) {
					$concrete_args['meta_query'][] = array(
						'key'     => 'time_to',
						'value'   => $_GET['time_to'],
						'compare' => '>=',
						'type'    => 'TIME',
					);
				}
				if ( $_GET['time_from'] >= $_GET['time_to'] ) {
					$concrete_args['meta_query'][] = array(
						'key'   => 'night_time_work',
						'value' => '1',
					);
				}
			} else {
				$concrete_args['meta_query'][] = array(
					'key'   => 'works_hours',
					'value' => $_GET['work_hours'],
				);

			}
		}
		$concrete_args = search_checkboxes( 'url', $concrete_args );
		$concrete_args = search_checkboxes( 'images', $concrete_args );
		$concrete_args = search_checkboxes( 'order_page', $concrete_args );
		$concrete_args = search_checkboxes( 'a11y', $concrete_args );
		$items_on_map  = get_posts( $concrete_args );
	} elseif ( ! array_key_exists( 'search_post_type', $_GET ) ) {
		$items_on_map = get_posts( array(
			'post_type'      => [ 'brands', 'places' ],
			'meta_key'       => 'post_location',
			'posts_per_page' => - 1,
			's'              => get_search_query(),
		) );
	} elseif ( $_GET['search_post_type'] == 'places' ) {
		$concrete_args = array(
			'post_type'      => $_GET['search_post_type'],
			'meta_key'       => 'post_location',
			'posts_per_page' => - 1,
			's'              => get_search_query(),
		);
		if ( isset( $_GET['places_districts'] ) ) {
			$concrete_args = search_tax_query( 'places_districts', $concrete_args );
		}
		$concrete_args = search_checkboxes( 'a11y', $concrete_args );
		$items_on_map  = get_posts( $concrete_args );
	}
	foreach ( $items_on_map as $index => $item ) {
		$item_id       = $item->ID;
		$item_location = get_field( 'post_location', $item_id );
		$location      = get_field( 'location', $item_id );
		if ( is_array( $location ) ) {
			$location = $location[0]['item'];
		}
		$item_phone = get_field( 'phone_number', $item_id );
		$item_type  = get_post_type( $item_id );
		if ( $item_type === 'brands' ) {
			$item_cats = wp_get_post_terms( $item_id, 'category-brands' );
		} elseif ( $item_type === 'places' ) {
			$item_cats = wp_get_post_terms( $item_id, 'tags-places' );
		}
		if ( $item_cats && count( $item_cats ) > 1 ) {
			$item_cat_slugs  = array();
			$item_cat_labels = array();
			foreach ( $item_cats as $cat ) {
				$item_cat_slugs[]  = $cat->slug;
				$item_cat_labels[] = $cat->name;
			}
		} elseif ( $item_cats && is_array( $item_cats ) ) {
			$item_cat_slugs  = $item_cats[0]->slug;
			$item_cat_labels = $item_cats[0]->name;
		} else {
			$item_cat_slugs  = '';
			$item_cat_labels = '';
		}
		if ( is_array( $item_cat_labels ) ) {
			$item_cat_labels = implode( ', ', $item_cat_labels );
		}

		$site            = get_field( 'url', $item_id );
		$facebook        = get_field( 'facebook', $item_id );
		$instagram       = get_field( 'instagram', $item_id );
		$youtube         = get_field( 'youtube', $item_id );
		$telegram        = get_field( 'telegram', $item_id );
		$viber           = get_field( 'viber', $item_id );
		$item_order_page = get_field( 'order_page', $item_id );
		$email           = get_field( 'email', $item_id );
		$item            = (array) $item;
		if ( $site ) {
			$item['site'] = $site;
		}
		if ( $facebook ) {
			$item['facebook'] = $facebook;
		}
		if ( $instagram ) {
			$item['instagram'] = $instagram;
		}
		if ( $youtube ) {
			$item['youtube'] = $youtube;
		}
		if ( $telegram ) {
			$item['telegram'] = $telegram;
		}
		if ( $viber ) {
			$item['viber'] = $viber;
		}
		$item['post_location']     = $item_location;
		$item['phone_number']      = $item_phone;
		$item['cats']              = $item_cat_slugs;
		$item['cats_label']        = $item_cat_labels;
		$item['thumb']             = get_the_post_thumbnail_url( $item_id, 'map-img' );
		$item['post_location_str'] = $location;
		$item['permalink']         = get_the_permalink( $item_id );
		$item['post_type']         = get_post_type( $item_id );
		if ( $item_order_page ) {
			$item['order_page'] = $item_order_page;
		}
		if ( $email ) {
			$item['email'] = $email;
		}
		$items_on_map[ $index ] = $item;
	}
	$google_api = get_field( 'google_maps_api_key', 'options' );
	wp_localize_script( 'map', 'map_data', array(
		'brands'     => $items_on_map,
		'google_api' => $google_api,
		'root_url'   => admin_url( 'admin-ajax.php' ),
	) );
	wp_enqueue_script( 'map' );


	wp_enqueue_style( 'krop-style', get_stylesheet_uri(), array(), false );
	wp_style_add_data( 'krop-style', 'rtl', 'replace' );
}

add_action( 'wp_enqueue_scripts', 'init_styles_scripts' );