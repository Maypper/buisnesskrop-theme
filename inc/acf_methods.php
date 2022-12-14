<?php
if ( function_exists( 'acf_add_options_page' ) && current_user_can( 'edit_others_pages' ) ) {

	acf_add_options_page( array(
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Theme Footer Settings',
		'menu_title'  => 'Footer',
		'parent_slug' => 'theme-general-settings',
	) );

	acf_add_options_page( array(
		'page_title' => 'Seo Text',
		'menu_title' => 'Seo Text',
		'menu_slug'  => 'search-page-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
		'icon_url'   => 'dashicons-editor-justify',
	) );
	acf_add_options_page( array(
		'page_title' => 'Interesting Places Text',
		'menu_title' => 'Places Text',
		'menu_slug'  => 'places-text',
		'capability' => 'edit_posts',
		'redirect'   => false,
		'icon_url'   => 'dashicons-location-alt',
	) );
}


function register_acf_blocks() {

	acf_register_block_type( array(
		'name'            => 'home_hero',
		'title'           => 'Баннер на головній',
		'category'        => 'formatting',
		'keywords'        => array( 'головна' ),
		'icon'            => array( 'background' => '#fbb605', 'src' => 'format-video' ),
		'render_template' => get_stylesheet_directory() . '/template-parts/blocks/heros/home-hero.php',
	) );
	acf_register_block_type( array(
		'name'            => 'about_city',
		'title'           => 'Про місто',
		'category'        => 'formatting',
		'keywords'        => array( 'місто' ),
		'icon'            => array( 'background' => '#fbb605', 'src' => 'format-video' ),
		'render_template' => get_stylesheet_directory() . '/template-parts/blocks/about-city.php',
	) );
	acf_register_block_type( array(
		'name'            => 'statistics',
		'title'           => 'Статистика брендів, новин та місць',
		'category'        => 'formatting',
		'keywords'        => array( 'статистика' ),
		'icon'            => array( 'background' => '#fbb605', 'src' => 'format-video' ),
		'render_template' => get_stylesheet_directory() . '/template-parts/blocks/statistics.php',
	) );
	
	acf_register_block_type( array(
		'name'            => 'statistics-columns',
		'title'           => 'Статистика у колонках',
		'category'        => 'formatting',
		'keywords'        => array( 'статистика' ),
		'icon'            => array( 'background' => '#fbb605', 'src' => 'format-video' ),
		'render_template' => get_stylesheet_directory() . '/template-parts/blocks/statistics-columns.php',
	) );
	acf_register_block_type( array(
		'name'            => 'latest_news',
		'title'           => 'Останні новини',
		'category'        => 'formatting',
		'keywords'        => array( 'новини' ),
		'icon'            => array( 'background' => '#fbb605', 'src' => 'format-video' ),
		'render_template' => get_stylesheet_directory() . '/template-parts/blocks/latest-news.php',
	) );
	acf_register_block_type( array(
		'name'            => 'about_project',
		'title'           => 'Про проект',
		'category'        => 'formatting',
		'keywords'        => array( 'про', 'проект' ),
		'icon'            => array( 'background' => '#fbb605', 'src' => 'format-video' ),
		'render_template' => get_stylesheet_directory() . '/template-parts/blocks/about-project.php',
	) );
	acf_register_block_type( array(
		'name'            => 'our_partners',
		'title'           => 'Наші партнери',
		'category'        => 'formatting',
		'keywords'        => array( 'партнери', 'наші' ),
		'icon'            => array( 'background' => '#fbb605', 'src' => 'format-video' ),
		'render_template' => get_stylesheet_directory() . '/template-parts/blocks/our-partners.php',
	) );
	acf_register_block_type( array(
		'name'            => 'map',
		'title'           => 'Мапа',
		'category'        => 'formatting',
		'keywords'        => array( 'мапа' ),
		'icon'            => array( 'background' => '#fbb605', 'src' => 'format-video' ),
		'render_template' => get_stylesheet_directory() . '/template-parts/blocks/map.php',
	) );
	acf_register_block_type( array(
		'name'            => 'accordion',
		'title'           => 'Аккордеон',
		'category'        => 'formatting',
		'keywords'        => array( 'аккордеон', 'accordion', 'details' ),
		'icon'            => array( 'background' => '#fbb605', 'src' => 'sort' ),
		'render_template' => get_stylesheet_directory() . '/template-parts/blocks/accordion.php',
	) );

}

if ( function_exists( 'acf_register_block_type' ) ) {
	add_action( 'acf/init', 'register_acf_blocks' );
}


//add google maps for acf
function my_acf_google_map_api( $api ) {
	$google_maps_api_key = get_field( 'google_maps_api_key', 'options' );
	$api['key']          = $google_maps_api_key;

	return $api;
}

add_filter( 'acf/fields/google_map/api', 'my_acf_google_map_api' );