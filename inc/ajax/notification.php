<?php

function splitter_ajax_read_notification() {
	check_ajax_referer( 'read_notification' );
	$response    = array();
	$status_code = 200;

	$post_ids = $_POST['post_ids'];
	foreach ( $post_ids as $post_id ) {
		if ( splitter_post_exists( $post_id ) && can_user_edit_post( $post_id ) ) {
			$response['post_ids'][ $post_id ] = update_post_meta( $post_id, 'unread', false );
		}
	}

	wp_send_json( $response, $status_code );
}