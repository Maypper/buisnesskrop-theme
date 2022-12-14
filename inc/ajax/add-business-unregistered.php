<?php
function splitter_ajax_add_business_unregistered() {
	check_ajax_referer( 'add-business-unregistered' );

	$response    = array();
	$status_code = 200;
	$post_author = splitter_get_admin_ids()[0] ?: 1;

	if ( ! isValidTelephoneNumber( $_POST['user_number'] ) ) {
		$response['code']    = 'invalid_user_number';
		$response['message'] = 'Invalid phone number';
	}
	if ( ! isValidTelephoneNumber( $_POST['phone_number'] ) ) {
		$response['code']    = 'invalid_phone_number';
		$response['message'] = 'Invalid phone number';
	}

	if ( empty( $_POST['confirm-data-processing'] ) || 'true' !== $_POST['confirm-data-processing'] ) {
		$response['code']    = 'confirm-data-processing';
		$response['message'] = 'You must allow data processing';
	}

	$check_is_empty = array(
		'post_title'   => $_POST['post_title'],
		'post_content' => $_POST['post_content'],
		'location'     => $_POST['location']
	);
	foreach ( $check_is_empty as $key => $item ) {
		if ( empty( $item ) ) {
			$response['code']    = $key;
			$response['message'] = 'Please fill this information';
			wp_send_json( $response, $status_code );
		}
	}

	// after checking all fields return errors and break script
	if ( ! empty( $response['code'] ) || ! empty( $response['message'] ) ) {
		wp_send_json( $response, $status_code );
	}


	$post_data = array(
		'post_type'    => 'brands',
		'post_status'  => 'pending',
		'post_author'  => $post_author,
		'post_title'   => sanitize_text_field( $_POST['post_title'] ),
		'post_content' => sanitize_text_field( $_POST['post_content'] ),
		'meta_input'   => array(
			'location'                     => sanitize_text_field( $_POST['location'] ),
			'phone_number'                 => sanitize_text_field( $_POST['phone_number'] ),
			'user_number'                  => sanitize_text_field( $_POST['user_number'] ),
			'user_confirm_data_processing' => sanitize_text_field( $_POST['confirm-data-processing'] )
		),
	);

	$post_id = wp_insert_post( $post_data, true );

	if ( is_wp_error( $post_id ) ) {
		$response['code']    = $post_id->get_error_code();
		$response['message'] = $post_id->get_error_message();
	} else {
		$response['modal'] = 'modal-send-brand';
	}

	wp_send_json( $response, $status_code );
}