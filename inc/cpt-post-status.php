<?php

add_action( 'init', 'deactivated_brand_status' );
function deactivated_brand_status() {
	register_post_status( 'deactivated', array(
		'label'                     => _x( 'Deactivated', 'admin', 'krop' ),
		'post_type'                 => array( 'brands' ),
		'exclude_from_search'       => true,
		'show_in_admin_all_list'    => false,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Deactivated <span class="count">(%s)</span>', 'Deactivated <span class="count">(%s)</span>', 'plugin-domain' ),

		'show_in_metabox_dropdown'    => true,
		'show_in_inline_dropdown'     => true,
		'show_in_press_this_dropdown' => true,
		'labels'                      => array(
			'metabox_dropdown' => _x( 'Deactivated', 'admin', 'krop' ),
			'inline_dropdown'  => _x( 'Deactivated', 'admin', 'krop' ),
		),
		'dashicon'                    => 'dashicons-archive',
	) );
}


add_action( 'init', 'confirm_ownership_statuses' );
function confirm_ownership_statuses() {
	register_post_status( 'approved', array(
		'label'                       => __( 'Approved', 'krop' ),
		'post_type'                   => array( 'confirm_ownership' ),
		'exclude_from_search'         => true,
		'show_in_admin_all_list'      => false,
		'show_in_admin_status_list'   => true,
		'label_count'                 => _n_noop( 'Approved <span class="count">(%s)</span>', 'Approved <span class="count">(%s)</span>', 'krop' ),
		'show_in_metabox_dropdown'    => true,
		'show_in_inline_dropdown'     => true,
		'show_in_press_this_dropdown' => true,
		'labels'                      => array(
			'metabox_dropdown' => __( 'Approved', 'krop' ),
			'inline_dropdown'  => __( 'Approved', 'krop' ),
		),
		'dashicon'                    => 'dashicons-yes-alt',
	) );

	register_post_status( 'rejected', array(
		'label'                       => __( 'Rejected', 'krop' ),
		'post_type'                   => array( 'confirm_ownership', 'brands' ),
		'exclude_from_search'         => true,
		'show_in_admin_all_list'      => false,
		'show_in_admin_status_list'   => true,
		'label_count'                 => _n_noop( 'Rejected <span class="count">(%s)</span>', 'Rejected <span class="count">(%s)</span>', 'krop' ),
		'show_in_metabox_dropdown'    => true,
		'show_in_inline_dropdown'     => true,
		'show_in_press_this_dropdown' => true,
		'labels'                      => array(
			'metabox_dropdown' => __( 'Rejected', 'krop' ),
			'inline_dropdown'  => __( 'Rejected', 'krop' ),
		),
		'dashicon'                    => 'dashicons-dismiss',
	) );
}

function restrict_statuses_for_confirm_ownership( $post_types = array(), $status_name = '' ) {
	if ( 'pending' === $status_name ) {
		return $post_types;
	}

	// All other statuses (eg: Publish, Private...) won't be applied to tickets
	return array_diff( $post_types, array( 'confirm_ownership' ) );
}

add_filter( 'wp_statuses_get_registered_post_types', 'restrict_statuses_for_confirm_ownership', 10, 2 );