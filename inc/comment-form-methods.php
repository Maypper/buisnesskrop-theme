<?php
add_action( 'comment_form_logged_in_after', 'additional_fields' );
add_action( 'comment_form_after_fields', 'additional_fields' );

function additional_fields() {
	echo '<p class="comment-form-title">' .
	     '<label for="title">' . __( 'Comment Title', 'krop' ) . '</label>' .
	     '<input id="title" placeholder="' . __( 'Theme of comment', 'krop' ) . '" name="title" type="text" size="30"  tabindex="5" /></p>';

	echo '<p class="comment-form-rating">' .
	     '<label for="rating">' . __( 'Your rating', 'krop' ) . '<span class="required">*</span></label>
  <span class="d-flex align-items-center flex-wrap"><span class="commentratingbox">';

	//Current rating scale is 1 to 5. If you want the scale to be 1 to 10, then set the value of $i to 10.
	for ( $i = 1; $i <= 5; $i ++ ) {
		if ( $i == 1 ) {
			$checked = 'checked ';
		} else {
			$checked = '';
		}
		echo '<label for="comment-rating-star-' . $i . '" class="star-icon"></label><input type="radio" name="rating" ' . $checked . 'value="' . $i . '" id="comment-rating-star-' . $i . '" class="comment-stars">';
	}

	echo '</span> <span class="rating_value">/ <span class="rating_value__current">1</span> ' . __( 'from 5 stars', 'krop' ) . '</span></span> </p>';

}


add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {

	if ( ( isset( $_POST['title'] ) ) && ( $_POST['title'] != '' ) ) {
		$title = wp_filter_nohtml_kses( $_POST['title'] );
		add_comment_meta( $comment_id, 'title', $title );
	}

	if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '' ) ) {
		$rating = wp_filter_nohtml_kses( $_POST['rating'] );
		add_comment_meta( $comment_id, 'rating', $rating );
	}
}

add_filter( 'comment_form_defaults', 'splitter_edit_form_defaults' );
function splitter_edit_form_defaults( $defaults ) {
	unset( $defaults['logged_in_as'] );
	unset( $defaults['comment_notes_before'] );

	return $defaults;
}

add_filter( 'comment_form_default_fields', 'modify_standart_form_fields' );
function modify_standart_form_fields( $fields ) {
	unset( $fields['url'] );
	$fields['author'] = '<p class="comment-form-author"><label for="author">' . __( 'Your name and surname', 'krop' ) . '</label><input placeholder="' . __( 'For example: Ivan Franko', 'krop' ) . '" id="author" name="author"></p>';
	$fields['email']  = '<p class="comment-form-email"><label for="email">' . __( 'Your email', 'krop' ) . '</label><input placeholder="' . __( 'For example: ivanfranko@mail.com', 'krop' ) . '" id="email" name="email"></p>';

	return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
function wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;

	return $fields;
}


add_action( 'wp_insert_comment', 'brand_rating_counter', 10, 2 );
function brand_rating_counter( $comment_ID, $comment ) {
	if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '' ) ) {
		$add_rating = intval( wp_filter_nohtml_kses( $_POST['rating'] ) );
	} else {
		return;
	}
	if ( $comment->__get( 'post_type' ) === 'brands' ) {
		$post_id          = $comment->comment_post_ID;
		$old_brand_rating = floatval( get_post_meta( $post_id, 'brand_rating', true ) );
		$comments_count   = wp_count_comments( $post_id )->approved;

		if ( $comments_count > 1 && $old_brand_rating < 1 ) { // if wrong rating saved...
			$old_brand_rating = count_commnets_rating(); // count all again
		}

		$new_rating = $comments_count > 1 ? ( ( $old_brand_rating * ( $comments_count - 1 ) + $add_rating ) / $comments_count ) : $add_rating;
//        $new_rating = 0;
		update_post_meta( $post_id, 'brand_rating', $new_rating );
		do_action( 'brand_statistic_comments_update', $post_id, $new_rating );
	}
}

add_action( 'trash_comment', 'brand_rating_counter_del', 10, 2 );
add_action( 'delete_comment', 'brand_rating_counter_del', 10, 2 );
function brand_rating_counter_del( $comment_ID, $comment ) {
	$post_id        = $comment->comment_post_ID;
	$brand_rating   = floatval( get_post_meta( $post_id, 'brand_rating', true ) );
	$comment_rating = intval( get_comment_meta( $comment_ID, 'rating', true ) );
	$comments_count = wp_count_comments( $post_id )->approved;

	$old_rating = $comments_count > 1 ? ( ( $brand_rating * $comments_count - $comment_rating ) / ( $comments_count - 1 ) ) : 0;
//    $old_rating = 0;
	update_post_meta( $post_id, 'brand_rating', $old_rating );
	do_action( 'brand_statistic_comments_update', $post_id, $old_rating );
}

add_action( 'pre_comment_on_post', 'custom_validate_city' );
function custom_validate_city() {
	if ( empty( $_POST['rating'] ) ) {
		wp_die( __( 'Please enter a rating' ) );
	}
}

function count_commnets_rating() {
	global $post;
	$comments = get_comments( array(
		'post_id' => $post->ID,
		'status'  => 'approve',
		'parent'  => 0
	) );
	$comments_ids = array_column($comments, 'comment_ID');
	return array_sum( array_map( function ( $id ) {
		return get_comment_meta( $id, 'rating', true );
	}, $comments_ids ) );
}