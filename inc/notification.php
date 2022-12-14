<?php
add_action( 'post_updated', 'mark_unread_save_actions', 20, 3 );
function mark_unread_save_actions( $post_ID, $post_after, $post_before ) {
	if (
		! empty( $post_after->post_type ) && in_array( $post_after->post_type, array(
			'brands',
			'confirm_ownership'
		) )
		&& ( ! defined( 'DOING_AUTOSAVE' ) || ! DOING_AUTOSAVE )
		&& $post_after->post_status !== $post_before->post_status // if status changed
		&& in_array( $post_after->post_status, array( 'publish', 'rejected', 'approved' ) )
		&& current_user_can( 'edit_others_pages' ) // only if editor or admin edit page
	) {
		//set unread mark
		update_post_meta( $post_ID, 'unread', true );
	}
}


add_filter( 'post_row_actions', 'ownership_override_buttons', 10, 2 );
function ownership_override_buttons( $actions, $post ) {

	if ( get_post_type( $post ) == 'confirm_ownership' && current_user_can( 'edit_others_pages' ) ) {
		$current_url = home_url( add_query_arg( null, null ) );

		if ( in_array( $post->post_status, array( 'pending', 'rejected' ) ) ) {
			$actions['approve_ownership'] = '<details style="display: inline-block;"><summary style="color: #007017;">Approve</summary><p>This action can`t be reverted automatically. <a style="color: #007017;" href="' . add_query_arg( array(
					'action'   => 'approve_ownership',
					'post_id'  => $post->ID,
					'_wpnonce' => wp_create_nonce( 'approve_ownership' ),
					'redirect' => $current_url
				), admin_url() ) . '">Approve ownership?</a></p></details>';
		}
		if ( $post->post_status == 'pending' ) {
			$actions['reject_ownership'] = '<a style="color: #b32d2e;" href="' . add_query_arg( array(
					'action'   => 'reject_ownership',
					'post_id'  => $post->ID,
					'_wpnonce' => wp_create_nonce( 'reject_ownership' ),
					'redirect' => $current_url
				), admin_url() ) . '">Reject</a>';
		}
	}

	return $actions;
}

add_action( 'admin_init', 'ownership_override_actions' );

function ownership_override_actions() {
	if ( ! isset( $_GET['action'] ) || ! in_array( $_GET['action'], array(
			'approve_ownership',
			'reject_ownership'
		) ) ) {
		return;
	}
	if ( current_user_can( 'edit_others_pages' ) && wp_verify_nonce( $_GET['_wpnonce'], $_GET['action'] ) ) {

		$post_id = isset( $_REQUEST['post_id'] ) ? absint( $_REQUEST['post_id'] ) : false;
		if ( splitter_post_exists( $post_id ) ) {
			if ( $_GET['action'] === 'approve_ownership' ) {
				wp_update_post( array(
					'ID'          => $post_id,
					'post_status' => 'approved'
				) );

				$post     = get_post( $post_id );
				$brand_id = get_post_meta( $post_id, 'property_id', true );
				$args     = array(
					'ID'           => $brand_id,
					'post_author'  => $post->post_author,
					'post_title'   => $post->post_title,
					'post_content' => $post->post_content,
					'meta_input'   => array(
						'ownership_request_id'         => $post_id,
						'edpnou'                       => get_post_meta( $post_id, 'edpnou', true ),
						'full_name'                    => get_post_meta( $post_id, 'post_title', true ),
						'legal_address'                => get_post_meta( $post_id, 'legal_address', true ),
						'post_content'                 => get_post_meta( $post_id, 'post_content', true ),
						'phone_number'                 => get_post_meta( $post_id, 'phone_number', true ),
						'url'                          => get_post_meta( $post_id, 'url', true ),
						'email'                        => get_post_meta( $post_id, 'email', true ),
						'person_name'                  => get_post_meta( $post_id, 'person_name', true ),
						'person_lastname'              => get_post_meta( $post_id, 'person_lastname', true ),
						'person_email'                 => get_post_meta( $post_id, 'person_email', true ),
						'person_phone_number'          => get_post_meta( $post_id, 'person_phone_number', true ),
						'user_confirm_data_processing' => get_post_meta( $post_id, 'user_confirm_data_processing', true ),
						'owner_approved'               => true,
					),
				);

				$brand_id = wp_update_post( $args );
				do_action( 'qm/debug', array( 'updated' => $brand_id ) );

				if ( $brand_id && ! is_wp_error( $brand_id ) ) {
					// location[]
					update_field( 'field_620d439135426', get_field( 'field_620d439135426', $post_id ), $brand_id );

					$taxonomies = get_the_terms( $post, 'category-brands' );
					if ( $taxonomies && ! is_wp_error( $taxonomies ) ) {
						wp_set_post_terms( $brand_id, array_column( $taxonomies, 'term_id' ), 'category-brands' );
					}

				}
			} elseif ( $_GET['action'] === 'reject_ownership' ) {
				$updated = wp_update_post( array(
					'ID'          => $post_id,
					'post_status' => 'rejected'
				) );
				do_action( 'qm/debug', array( 'rejected' => $updated ) );
			}
		}


		wp_safe_redirect( $_REQUEST['redirect'] );
	} else {
		wp_safe_redirect( $_REQUEST['redirect'] );
	}
	die();
}