<?php
function splitter_ajax_map_search() {
	$search_input = sanitize_text_field($_REQUEST['search_query']);
	$items_on_map = get_posts( array(
		'post_type'      => [ 'brands', 'places' ],
		'meta_key'       => 'post_location',
		's'              => $search_input,
		'posts_per_page' => - 1
	) );
	foreach ( $items_on_map as $index => $item ) {
		do_action( 'brand_statistic_map_search', $item->ID );
		$item_id                = $item->ID;
		$items_on_map[ $index ] = $item_id;
	}
	echo json_encode( $items_on_map );
	wp_die();
}