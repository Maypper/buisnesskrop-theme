<?php

function splitter_ajax_brand_ownership() {
	check_ajax_referer( 'brand_ownership' );
	$response    = array();
	$status_code = 200;
	$post_author = get_current_user_id();

//	var_dump( $_POST );
//	die();

//	todo: в атрибутах name вказувати індекс яквно (не []). Може призводити до того, що пропущене значення здвине весь масив данних при невідповідній валідації на фронті

	$required_fields = array(
		'edpnou',
		'post_title',
		'legal_address',
		'location[]',
		'post_content',
		'category[]',
		'phone_number',
		'url',
		'email',
		'person_name',
		'person_lastname',
		'person_email',
		'person_phone_number',
		'confirm-data-processing',
//		Категорія
	);

	$phone_numbers_fields = array(
		'phone_number',
		'person_phone_number',
	);

	$emails_fields = array(
		'email',
		'person_email',
	);

	$url_fields = array(
		'url',
	);


	// check is user can edit post
	$post_id = isset( $_REQUEST['post_id'] ) ? absint( $_REQUEST['post_id'] ) : false;
	if ( ! $post_id || ! splitter_post_exists( $post_id ) ) {
		$status_code      = 403;
		$response['code'] = 'dont_exist';
		wp_send_json( $response, $status_code );
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

	// validate some important fields
	if ( empty( $_POST['confirm-data-processing'] ) || 'true' !== $_POST['confirm-data-processing'] ) {
		$response['code']    = 'confirm-data-processing';
		$response['message'] = 'You must allow data processing';
		wp_send_json( $response, $status_code );
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
		'post_type'    => 'confirm_ownership',
		'post_status'  => 'pending',
		'post_author'  => $post_author,
		'post_title'   => sanitize_text_field( $_POST['post_title'] ),
		'post_content' => sanitize_text_field( $_POST['post_content'] ),
		'meta_input'   => array(
			'property_id'                  => $post_id,
			'new_author_property_id'       => get_current_user_id(),
			'property'                     => get_permalink( $post_id ),
			'edpnou'                       => sanitize_text_field( $_POST['edpnou'] ),
			'full_name'                    => sanitize_text_field( $_POST['post_title'] ),
			'legal_address'                => sanitize_text_field( $_POST['legal_address'] ),
			'post_content'                 => sanitize_text_field( $_POST['post_content'] ),
			'phone_number'                 => sanitize_text_field( $_POST['phone_number'] ),
			'url'                          => esc_url_raw( $_POST['url'] ),
			'email'                        => sanitize_text_field( $_POST['email'] ),
			'person_name'                  => sanitize_text_field( $_POST['person_name'] ),
			'person_lastname'              => sanitize_text_field( $_POST['person_lastname'] ),
			'person_email'                 => sanitize_text_field( $_POST['person_email'] ),
			'person_phone_number'          => sanitize_text_field( $_POST['person_phone_number'] ),
			'user_confirm_data_processing' => sanitize_text_field( $_POST['confirm-data-processing'] ),
		),
	);

	$post_id = wp_insert_post( wp_slash( $post_data ) );

	if ( is_wp_error( $post_id ) ) {
		$response['code']    = $post_id->get_error_code();
		$response['message'] = $post_id->get_error_message();
	} else {
		// set categories;
		$taxonomies = wp_set_post_terms( $post_id, $_POST['category'], 'category-brands' );
		if ( ! $taxonomies || is_wp_error( $taxonomies ) ) {
			$response['code'] = $taxonomies;
		}

		// repeater fields
		foreach ( $_POST['location'] as $location ) {
			// field_620d439135426 === location
			add_row( 'field_620d439135426', array( 'item' => sanitize_text_field( $location ) ), $post_id );
		}

		$response['post_id'] = $post_id;
		$response['modal']   = 'modal-send-brand';
	}

	wp_send_json( $response, $status_code );
}