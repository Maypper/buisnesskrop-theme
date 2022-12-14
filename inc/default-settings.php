<?php
/**
 * FAS functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business Krop Online
 */
if ( ! function_exists( 'krop_setup' ) ) :
	function krop_setup() {
		load_theme_textdomain( 'krop', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'notification-thumbnail', 48, 48, true );
		add_image_size( 'brands-settings-thumbnail', 72, 72, true );
		add_image_size( 'brands-list', 343, 260, false );
		add_image_size( 'news-list', 255, 206, true );
		add_image_size( 'news-wide-list', 540, 206, true );
		add_image_size( 'places-list', 531, 400, true );
		add_image_size( 'places-list', 531, 400, true );
		add_image_size( 'map-img', 187, 139, false );
		add_image_size( 'brand-high', 343, 947, true );
		add_image_size( 'brand-wide', 1110, 409, true );
		add_image_size( 'small-square', 98, 98, true );

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		add_theme_support(
			'custom-background',
			apply_filters(
				'fas_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'krop_setup' );

add_action( 'after_setup_theme', 'remove_admin_bar' );
function remove_admin_bar() {
	if ( ! ( current_user_can( 'administrator' ) || current_user_can( 'editor' ) ) && ! is_admin() ) {
		show_admin_bar( false );
	}
}