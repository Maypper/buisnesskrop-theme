<?php

if ( wp_doing_ajax() ) {
	// account
	add_action( 'wp_ajax_account_editing', 'splitter_ajax_account_editing' );
	require_once get_template_directory() . '/inc/ajax/account-editing.php';

	add_action( 'wp_ajax_send_confirmation_code', 'splitter_send_confirmation_code' );
	require_once get_template_directory() . '/inc/ajax/send-confirmation-code.php';

	add_action( 'wp_ajax_login', 'splitter_ajax_login' );
	add_action( 'wp_ajax_nopriv_login', 'splitter_ajax_login' );
	require_once get_template_directory() . '/inc/ajax/login.php';

	add_action( 'wp_ajax_registration', 'splitter_ajax_registration' );
	add_action( 'wp_ajax_nopriv_registration', 'splitter_ajax_registration' );
	require_once get_template_directory() . '/inc/ajax/registration.php';

	add_action( 'wp_ajax_confirm_code', 'splitter_ajax_confirm_code' );
	add_action( 'wp_ajax_nopriv_confirm_code', 'splitter_ajax_confirm_code' );
	require_once get_template_directory() . '/inc/ajax/confirm-code.php';

	add_action( 'wp_ajax_restore_access', 'splitter_ajax_restore_access' );
	add_action( 'wp_ajax_nopriv_restore_access', 'splitter_ajax_restore_access' );
	require_once get_template_directory() . '/inc/ajax/restore-access.php';

	add_action( 'wp_ajax_update_password', 'splitter_ajax_update_password' );
	add_action( 'wp_ajax_nopriv_update_password', 'splitter_ajax_update_password' );
	require_once get_template_directory() . '/inc/ajax/update-password.php';


	// update business
	add_action( 'wp_ajax_nopriv_add_business_unregistered', 'splitter_ajax_add_business_unregistered' );
	require_once get_template_directory() . '/inc/ajax/add-business-unregistered.php';

	add_action( 'wp_ajax_brand_ownership', 'splitter_ajax_brand_ownership' );
	require_once get_template_directory() . '/inc/ajax/brand-ownership.php';

	add_action( 'wp_ajax_add_business_registered', 'splitter_ajax_add_business_registered' );
	add_action( 'wp_ajax_media_upload_brand', 'splitter_ajax_media_upload_brand' );
	require_once get_template_directory() . '/inc/ajax/add-business-registered.php';

	// mark as read
	add_action( 'wp_ajax_read_notification', 'splitter_ajax_read_notification' );
    require_once get_template_directory() . '/inc/ajax/notification.php';

    // map search
    add_action( 'wp_ajax_map_search', 'splitter_ajax_map_search' );
    add_action( 'wp_ajax_nopriv_map_search', 'splitter_ajax_map_search' );
    require_once get_template_directory() . '/inc/ajax/map-search.php';

    // change statistic period
    add_action( 'wp_ajax_load_statistic', 'splitter_ajax_load_statistic' );
    require_once get_template_directory() . '/inc/ajax/load_statistic.php';
}













