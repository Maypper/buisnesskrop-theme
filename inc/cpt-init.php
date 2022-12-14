<?php
add_action( 'init', 'register_post_types_tax' );
function register_post_types_tax() {

	register_taxonomy( 'city_district', array( 'brands', 'places' ), array(
		'labels'            => array(
			'name'          => __( 'City districts', 'krop' ),
			'singular_name' => __( 'City district', 'krop' ),
			'search_items'  => __( 'Search city district', 'krop' ),
			'all_items'     => __( 'All city districts', 'krop' ),
			'edit_item'     => __( 'Edit city district', 'krop' ),
			'update_item'   => __( 'Update city districts', 'krop' ),
			'add_new_item'  => __( 'Add city district', 'krop' ),
			'new_item_name' => __( 'New city districts', 'krop' ),
			'menu_name'     => __( 'City districts', 'krop' ),
		),
		'description'       => __( 'City districts for brands and places', 'krop' ),
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'hierarchical'      => true,
		'show_admin_column' => true,
	) );

	// Раздел новости - category-news
	register_taxonomy( 'catecory-announcement', [ 'news' ], [
		'label'             => null,
		'labels'            => array(
			'name'          => __( 'Announcements categories', 'krop' ),
			'singular_name' => __( 'Announcement category', 'krop' ),
			'search_items'  => __( 'Search announcement category', 'krop' ),
			'all_items'     => __( 'All Announcements categories', 'krop' ),
			//'parent_item'       => 'Родит. раздел вопроса',
			//'parent_item_colon' => 'Родит. раздел вопроса:',
			'edit_item'     => __( 'Edit announcement category', 'krop' ),
			'update_item'   => __( 'Update announcement category', 'krop' ),
			'add_new_item'  => __( 'Add announcement category', 'krop' ),
			'new_item_name' => __( 'New announcement category', 'krop' ),
			'menu_name'     => __( 'Announcements categories', 'krop' ),
		),
		'description'       => __( 'Categories for news', 'krop' ),
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'category-announcement' ),
		'show_admin_column' => true,
	] );

	register_taxonomy( 'catecory-news', [ 'news' ], [
		'label'             => null,
		'labels'            => array(
			'name'          => __( 'News categories', 'krop' ),
			'singular_name' => __( 'News category', 'krop' ),
			'search_items'  => __( 'Search news category', 'krop' ),
			'all_items'     => __( 'All news categories', 'krop' ),
			//'parent_item'       => 'Родит. раздел вопроса',
			//'parent_item_colon' => 'Родит. раздел вопроса:',
			'edit_item'     => __( 'Edit news category', 'krop' ),
			'update_item'   => __( 'Update news category', 'krop' ),
			'add_new_item'  => __( 'Add news category', 'krop' ),
			'new_item_name' => __( 'New news category', 'krop' ),
			'menu_name'     => __( 'News categories', 'krop' ),
		),
		'description'       => __( 'Categories for news', 'krop' ),
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_tagcloud'     => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'category-news' ),
		'show_admin_column' => true,
	] );

	// post type news
	register_post_type( 'news', [
		'label'               => null,
		'labels'              => array(
			'name'          => __( 'News/Announcements', 'krop' ),
			'singular_name' => __( 'News', 'krop' ),
			'menu_name'     => __( 'The News', 'krop' ),
			'all_items'     => __( 'All news', 'krop' ),
			'add_new'       => __( 'Add news', 'krop' ),
			'add_new_item'  => __( 'Add new news', 'krop' ),
			'edit'          => __( 'Edit', 'krop' ),
			'edit_item'     => __( 'Edit news', 'krop' ),
			'new_item'      => __( 'New news', 'krop' ),
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-text-page',
		'show_ui'             => true,
		'show_in_rest'        => true,
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		//'rewrite'             => array( 'slug'=>'faq/%faqcat%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
		'has_archive'         => true,
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'taxonomies'          => array( 'catecory-news', 'announcement-news' ),
	] );

	//brands taxonomy - category
	register_taxonomy( 'category-brands', [ 'brands', 'confirm_ownership' ], [
		'label'             => null,
		'labels'            => array(
			'name'          => __( 'Brands categories', 'krop' ),
			'singular_name' => __( 'Brands category', 'krop' ),
			'search_items'  => __( 'Search brands category', 'krop' ),
			'all_items'     => __( 'All brands categories', 'krop' ),
			'edit_item'     => __( 'Edit brands category', 'krop' ),
			'update_item'   => __( 'Update brands category', 'krop' ),
			'add_new_item'  => __( 'Add brands category', 'krop' ),
			'new_item_name' => __( 'New brands category', 'krop' ),
			'menu_name'     => __( 'Brands categories', 'krop' ),
		),
		'description'       => __( 'Categories for brands', 'krop' ),
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'hierarchical'      => true,
		//'rewrite'               => array('slug'=>'faq', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
		'show_admin_column' => true,
	] );

	// post type brands
	register_post_type( 'brands', [
		'label'               => null,
		'labels'              => array(
			'name'          => __( 'Brands/Businesses', 'krop' ),
			'singular_name' => __( 'Brand/Business', 'krop' ),
			'menu_name'     => __( 'Brands', 'krop' ),
			'all_items'     => __( 'All Brands/Businesses', 'krop' ),
			'add_new'       => __( 'Add Brand/Business', 'krop' ),
			'add_new_item'  => __( 'Add new Brand/Business', 'krop' ),
			'edit'          => __( 'Edit', 'krop' ),
			'edit_item'     => __( 'Edit Brand/Business', 'krop' ),
			'new_item'      => __( 'New Brand/Business', 'krop' ),
		),
		'public'              => true,
		'publicly_queryable'  => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-portfolio',
		'show_ui'             => true,
		'show_in_rest'        => true,
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		//'rewrite'             => array( 'slug'=>'faq/%faqcat%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
		'has_archive'         => 'catalog',
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions', 'comments' ),
		'taxonomies'          => array( 'category-brands' ),
	] );

	// post type places
	register_post_type( 'places', [
		'label'               => null,
		'labels'              => array(
			'name'          => __( 'Interesting places', 'krop' ),
			'singular_name' => __( 'Interesting place', 'krop' ),
			'menu_name'     => __( 'Places', 'krop' ),
			'all_items'     => __( 'All Interesting places', 'krop' ),
			'add_new'       => __( 'Add Interesting place', 'krop' ),
			'add_new_item'  => __( 'Add new Interesting place', 'krop' ),
			'edit'          => __( 'Edit', 'krop' ),
			'edit_item'     => __( 'Edit Interesting place', 'krop' ),
			'new_item'      => __( 'New Interesting place', 'krop' ),
		),
		'public'              => true,
		'publicly_queryable'  => true,
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-location-alt',
		'show_ui'             => true,
		'show_in_rest'        => true,
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		//'rewrite'             => array( 'slug'=>'faq/%faqcat%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
		'has_archive'         => 'interesting-places',
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions', 'comments' ),
		'taxonomies'          => array( 'tags-places' ),
	] );

	register_taxonomy( 'tags-places', [ 'places' ], [
		'label'             => null,
		'labels'            => array(
			'name'          => __( 'Places tags', 'krop' ),
			'singular_name' => __( 'Places tag', 'krop' ),
			'search_items'  => __( 'Search places tag', 'krop' ),
			'all_items'     => __( 'All places tags', 'krop' ),
			'edit_item'     => __( 'Edit places tag', 'krop' ),
			'update_item'   => __( 'Update places tag', 'krop' ),
			'add_new_item'  => __( 'Add places tag', 'krop' ),
			'new_item_name' => __( 'New places tag', 'krop' ),
			'menu_name'     => __( 'Places tags', 'krop' ),
		),
		'description'       => __( 'Tags for places', 'krop' ),
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		//'rewrite'               => array('slug'=>'faq', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
		'show_admin_column' => true,
		'meta_box_cb'       => 'post_tags_meta_box',
	] );


	register_post_type( 'confirm_ownership', array(
		'label'              => 'Ownership request',
		'labels'             => array(
			'name'          => __( 'Ownership request', 'krop' ),
			'singular_name' => __( 'Ownership request', 'krop' ),
			'search_items'  => __( 'Search ownership requests', 'krop' ),
			'all_items'     => __( 'All ownership requests', 'krop' ),
			'edit_item'     => __( 'Edit ownership request', 'krop' ),
			'update_item'   => __( 'Update ownership request', 'krop' ),
			'add_new_item'  => __( 'Add ownership request', 'krop' ),
			'new_item_name' => __( 'New ownership request', 'krop' ),
			'menu_name'     => __( 'Ownerships', 'krop' ),
		),
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-id',
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'capability_type'    => 'post',
		'map_meta_cap'       => true,
		'query_var'          => false,
		'supports'           => array( 'title', 'editor', 'author', 'revisions' ),
	) );

}

