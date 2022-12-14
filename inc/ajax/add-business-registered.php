<?php

function splitter_ajax_add_business_registered() {
	check_ajax_referer( 'add-business' );
	$response    = array();
	$status_code = 200;
	$post_author = get_current_user_id();
//	$post_author = 27;

	$required_fields = array(
		'edpnou',
		'post_title',
		'post_content',
		'legal_address',
		'category[]',
		'location[]',
		'works_hours',
		'works_days',
		'phone_number',
		'url',
		'email',
		'confirm-data-processing',
		'person_name',
		'person_lastname',
		'person_email',
		'person_phone_number',
//		Категорія
	);

	$other_fields = array(
		'custom-work-hours',
		'time_from',
		'time_to',
		'facebook',
		'instagram',
		'youtube',
		'whatsapp',
		'telegram',
		'viber',
		'a11y',
		'has-online',
		'order_page',

		// for objects
		'object_title[]',
		'object_address[]',
		'object_works_hours[]',
		'object_works_days[]',
		'object_email[]',
		'object_phone_number[]',
		'object_a11y[]',
	);

	$phone_numbers_fields = array(
		'phone_number',
		'person_phone_number',
		'object_phone_number[]',
	);

	$emails_fields = array(
		'email',
		'person_email',
	);

	$url_fields = array(
		'url',
		'facebook',
		'instagram',
		'youtube',
//		'whatsapp',
//		'telegram',
//		'viber',
		'order_page',
	);


	// check is user can edit post
	if ( isset( $_REQUEST['post_id'] ) ) {
		$post_id = absint( $_REQUEST['post_id'] );
		if ( ! can_user_edit_post( $post_id ) ) {
			$status_code      = 403;
			$response['code'] = 'cant_edit';
			wp_send_json( $response, $status_code );
		}
	}

	// check required fields early
	foreach ( $required_fields as $required_field ) {
		if ( strpos( $required_field, '[]' ) ) {
			$required_field = str_replace( '[]', '', $required_field );
			if ( empty( $_POST[ $required_field ] ) ) {
				$response['code'] = $required_field; // send back name of missing required field
				wp_send_json( $response, $status_code );
			}
			foreach ( $_POST[ $required_field ] as $item ) {
				if ( empty( $item ) ) {
					$response['code'] = $required_field; // send back name of missing required field
					wp_send_json( $response, $status_code );
				}
			}
		} else {
			if ( empty( $_POST[ $required_field ] ) ) {
				$response['code'] = $required_field; // send back name of missing required field
				wp_send_json( $response, $status_code );
			}
		}
	}

	if ( ! empty( $_POST['custom-work-hours'] ) && $_POST['works_hours'] === 'custom' ) {
		if ( strpos( $_POST['custom-work-hours'], ' - ' ) !== false ) {
			$time               = explode( ' - ', $_POST['custom-work-hours'] );
			$_POST['time_from'] = $time[0];
			$_POST['time_to']   = $time[1];
		}
	}

	if ( ! empty( $_POST['custom-work-days'] ) && $_POST['works_days'] === 'custom' ) {
		$_POST['custom-work-days'] = explode( ', ', $_POST['custom-work-days'] );
	}


	//objects
	if ( ! empty( $_POST['object_custom_works_hours'] ) ) {
		foreach ( $_POST['object_custom_works_hours'] as $key => $item ) {
			if ( $_POST['object_works_hours'][ $key ] === 'custom' ) {
				if ( strpos( $item, ' - ' ) !== false ) {
					$time                              = explode( ' - ', $item );
					$_POST['object_time_from'][ $key ] = $time[0];
					$_POST['object_time_to'][ $key ]   = $time[1];
				}
			}
		}
	}

	if ( ! empty( $_POST['object_custom_works_days'] ) ) {
		foreach ( $_POST['object_custom_works_days'] as $key => $item ) {
			if ( $_POST['object_works_days'][ $key ] === 'custom' ) {
				$_POST['object_custom_works_days'][ $key ] = explode( ', ', $item );
			}
		}
	}


	// validate some important fields
	if ( empty( $_POST['confirm-data-processing'] ) || 'true' !== $_POST['confirm-data-processing'] ) {
		$response['code']    = 'confirm-data-processing';
		$response['message'] = 'You must allow data processing';
	}

	foreach ( $_POST['category'] as $item ) {
		if ( ! get_term( $item ) ) {
			$response['code'] = $item;
			$status_code      = 403;
			wp_send_json( $response, $status_code );
		}
	}

	foreach ( $phone_numbers_fields as $numbers_field ) {
		// array or single
		if ( strpos( $numbers_field, '[]' ) ) {
			$numbers_field = str_replace( '[]', '', $numbers_field );
			foreach ( $_POST[ $numbers_field ] as $item ) {
				if ( ! empty( $item ) && ! isValidTelephoneNumber( $item ) ) {
					$response['code'] = $numbers_field;
					wp_send_json( $response, $status_code );
				}
			}
		} else {
			if ( ! empty( $_POST[ $numbers_field ] ) && ! isValidTelephoneNumber( $_POST[ $numbers_field ] ) ) {
				$response['code'] = $numbers_field;
				wp_send_json( $response, $status_code );
			}
		}
	}

	foreach ( $emails_fields as $emails_field ) {
		if ( strpos( $emails_field, '[]' ) ) {
			$emails_field = str_replace( '[]', '', $emails_field );
			foreach ( $_POST[ $emails_field ] as $item ) {
				if ( ! empty( $item ) && ! filter_var( $item, FILTER_VALIDATE_EMAIL ) ) {
					$response['code'] = $emails_field;
					wp_send_json( $response, $status_code );
				}
			}
		} else {
			if ( ! empty( $_POST[ $emails_field ] ) && ! filter_var( $_POST[ $emails_field ], FILTER_VALIDATE_EMAIL ) ) {
				$response['code'] = $emails_field;
				wp_send_json( $response, $status_code );
			}
		}
	}

	foreach ( $url_fields as $url_field ) {
		if ( ! empty( $_POST[ $url_field ] ) ) {
			if ( ! is_valid_url( $_POST[ $url_field ] ) ) {
				$response['code'] = $url_field;
				wp_send_json( $response, $status_code );
			}
		}
	}


	$post_data = array(
		'post_type'    => 'brands',
		'post_status'  => 'draft',
		'post_author'  => $post_author,
		'post_title'   => sanitize_text_field( $_POST['post_title'] ),
		'post_content' => sanitize_text_field( $_POST['post_content'] ),
		'meta_input'   => array(
			'edpnou'                       => sanitize_text_field( $_POST['edpnou'] ),
			'full_name'                    => sanitize_text_field( $_POST['post_title'] ),
			'legal_address'                => sanitize_text_field( $_POST['legal_address'] ),
			'post_content'                 => sanitize_text_field( $_POST['post_content'] ),
			'works_hours'                  => sanitize_text_field( $_POST['works_hours'] ),
			'time_from'                    => sanitize_text_field( $_POST['time_from'] ),
			'time_to'                      => sanitize_text_field( $_POST['time_to'] ),
			'works_days'                   => sanitize_text_field( $_POST['works_days'] ),
			'phone_number'                 => sanitize_text_field( $_POST['phone_number'] ),
			'url'                          => esc_url_raw( $_POST['url'] ),
			'email'                        => sanitize_text_field( $_POST['email'] ),
			'facebook'                     => esc_url_raw( $_POST['facebook'] ),
			'instagram'                    => esc_url_raw( $_POST['instagram'] ),
			'youtube'                      => esc_url_raw( $_POST['youtube'] ),
			'whatsapp'                     => esc_url_raw( $_POST['whatsapp'] ),
			'telegram'                     => esc_url_raw( $_POST['telegram'] ),
			'viber'                        => esc_url_raw( $_POST['viber'] ),
			'a11y'                         => sanitize_text_field( $_POST['a11y'] ),
			'order_page'                   => $_POST['has-online'] ? esc_url_raw( $_POST['order_page'] ) : '',
			'user_confirm_data_processing' => sanitize_text_field( $_POST['confirm-data-processing'] ),
			'person_name'                  => sanitize_text_field( $_POST['person_name'] ),
			'person_lastname'              => sanitize_text_field( $_POST['person_lastname'] ),
			'person_email'                 => sanitize_text_field( $_POST['person_email'] ),
			'person_phone_number'          => sanitize_text_field( $_POST['person_phone_number'] ),
			'unread'                       => false,
		),
	);

	if ( isset( $post_id ) ) {
		$post_data['ID'] = $post_id;
	}

	$post_id = wp_insert_post( $post_data );


	if ( is_wp_error( $post_id ) ) {
		$response['code']    = $post_id->get_error_code();
		$response['message'] = $post_id->get_error_message();
	} else {

		update_field( 'field_6213e33ac3270', $_POST['custom-work-days'], $post_id );
		// set categories;
		$taxonomies = wp_set_post_terms( $post_id, $_POST['category'], 'category-brands' );
		if ( ! $taxonomies || is_wp_error( $taxonomies ) ) {
			$response['code'] = $taxonomies;
		}

		// repeater fields

		// field_620d439135426 === location
		delete_field( 'field_620d439135426', $post_id );
		foreach ( $_POST['location'] as $location ) {

			add_row( 'field_620d439135426', array( 'item' => sanitize_text_field( $location ) ), $post_id );
		}

		$object_fields     = array(
			'object_title',
			'object_address',
			'object_works_hours',
			'object_time_from',
			'object_time_to',
			'object_works_days',
			'object_phone_number',
			'object_custom_works_days'
		);
		$number_of_objects = isset( $_POST['object_title'] ) ? count( $_POST['object_title'] ) : 0;
		delete_field( 'field_620d4cf474988', $post_id );
		for ( $i = 0; $i < $number_of_objects; $i ++ ) {
			$fields = array();
			foreach ( $object_fields as $field ) {
				$fields[ $field ] = $_POST[ $field ][ $i ];
			}
			add_row( 'field_620d4cf474988', $fields, $post_id );
		}
		// clear old images
		$images = get_field('field_620f88cd8e27e', $post_id);
		foreach ($images as $image) {
			wp_delete_attachment( $image['image'], true);
		}
		delete_field('field_620f88cd8e27e', $post_id);

		$response['post_id'] = $post_id;
		$response['modal']   = 'modal-send-brand';
	}

	wp_send_json( $response, $status_code );
}


function splitter_ajax_media_upload_brand() {
	check_ajax_referer( 'media_upload_brand' );
	$post_id = absint( $_REQUEST['post_id'] );
	if ( ! can_user_edit_post( $post_id ) ) {
		http_response_code( 403 );
		wp_die( 'cant_edit' );
	}
	require_once( ABSPATH . 'wp-admin/includes/admin.php' );
	require_once( ABSPATH . 'wp-admin/includes/image.php' );


	$file = &$_FILES['file'];

	$overrides   = array(
		'test_form' => false,
		'mimes'     => array(
			'jpg'  => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'png'  => 'image/png'
		)
	);
	$file_return = wp_handle_upload( $file, $overrides );

	if ( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
		http_response_code( 500 );
		wp_die( 'file_handling_error' );
	} else {
		$filename      = $file_return['file'];
		$attachment    = array(
			'post_mime_type' => $file_return['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
			'post_content'   => '',
			'post_status'    => 'inherit',
			'guid'           => $file_return['url']
		);
		$attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
		do_action('qm/debug', array( 'attachment_id' => $attachment_id, 'attachment_data' => $attachment_data ));
		if ( 0 < intval( $attachment_id ) ) {
			if ( wp_attachment_is_image( $attachment_id ) ) {
				// field_620f88cd8e27e === images
				add_row( 'field_620f88cd8e27e', array( 'image' => ( $attachment_id ) ), $post_id );
				$images = get_field( 'field_620f88cd8e27e', $post_id );
				if ( isset( $images[0]['image'] ) ) {
					set_post_thumbnail( $post_id, $images[0]['image'] );
				}
			}
			http_response_code( 200 );
			wp_die();
		}
	}
	http_response_code( 403 );
	wp_die();
}