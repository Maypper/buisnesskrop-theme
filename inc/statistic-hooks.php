<?php
add_action('init', 'brand_outgoing_redirect');

function brand_outgoing_redirect()
{
    if (!empty($_GET['href']) && !empty($_GET['id'])) {
        $post_id = absint($_GET['id']);
        $stats = new BrandStatistic($post_id);
        $stats->increment_stat('follow_links');
	    wp_redirect(urldecode($_GET['href']));
        die('Redirecting...');
    }
}

function brand_outgoing_link($href): string
{
    global $post;
    if (!$href) {
        return '';
    }

    return add_query_arg(array(
        'href' => urlencode($href),
        'id' => $post->ID
    ), get_permalink());
}

add_action('wp_head', 'brand_clicks');
function brand_clicks(): void
{
    global $post;
    if (is_singular('brands')) {
        $stats = new BrandStatistic($post->ID);
        $stats->increment_stat('clicks');
    }
}

add_action('brand_statistic_comments_update', 'brand_update_comments', 15, 2);
function brand_update_comments($post_id, $new_rating)
{
    $stats = new BrandStatistic($post_id);
    $stats->increment_stat('new_reviews');
    $stats->__set('user_rating', $new_rating);
}

add_action('brand_statistic_map_search', 'brand_map_search', 15, 1);
function brand_map_search($post_ID)
{
    do_action('qm/debug', $post_ID);
    $stats = new BrandStatistic($post_ID);
    $stats->increment_stat('shown_in_search');
}

add_action('brand_update_rating_order', 'brand_update_rating_order');
function brand_update_rating_order() {
    $cache_key = 'brand_update_rating_order';
    $cache_lifetime = strtotime('1 day', 0);
    $is_updated = get_transient( $cache_key );
    if ( ! $is_updated ) {
        global $post;
		do_action('qm/start', 'Brand rating order update');
	    $brands = get_posts( array(
            'numberposts' => -1,
            'orderby'     => 'meta_value',
            'meta_key'    => 'brand_rating',
            'post_type'   => 'brands',
        ) );

	    foreach( $brands as $key => $post ){
		    setup_postdata( $post );
		    $stats = new BrandStatistic($post);
		    $stats->__set('rating_order', ( $key+1 ) );
	    }
	    wp_reset_postdata();

	    set_transient( $cache_key, true, $cache_lifetime );
	    do_action('qm/stop', 'Brand rating order update');
    }
}


add_action('brand_initial_user_rating', 'brand_initial_user_rating');

function brand_initial_user_rating( $post_id ) {

	$stats = new BrandStatistic($post_id);


}