<?php
global $post;
do_action('brand_update_rating_order');
$brands_query = new WP_Query( array(
	'post_type'   => 'brands',
	'post_status' => array( 'publish', 'deactivated', 'approved' ),
	'author'      => get_current_user_id(),
	'orderby'     => 'date',
	'nopaging'    => true,
) );
if ( $brands_query->have_posts() ) {
	while ( $brands_query->have_posts() ) {
		$brands_query->the_post();
		$stat = new BrandStatistic( $post->ID, $args['period'] ?? 1 );
		?>
        <div class="personal__content__item row <?php echo $brands_query->current_post + 1 == $brands_query->post_count ? 'personal__content__item__border-none' : ''; ?>">
            <div class="personal__content__item__img col-2">
				<?php the_post_thumbnail( 'brands-settings-thumbnail' ); ?>
            </div>
			<?php get_template_part( 'template-parts/personal-info/parts/brand-info' ); ?>
            <div class="row justify-content-between w-100 personal__content__item__list-inform">
                <div class="d-block col-md-4 col-5 personal__content__item__list-inform__mar-element">
                    <div class="personal__content__item__statistics__number"><?php echo $stat->__get( 'clicks' ); ?></div>
                    <div class="personal__content__item__statistics__text"><?php _e('Clicks on the brand/business', 'krop'); ?></div>
                </div>

                <div class="d-block col-md-3 col-5 personal__content__item__list-inform__mar-element">
                    <div class="personal__content__item__statistics__number"><?php echo $stat->__get( 'shown_in_search' ); ?></div>
                    <div class="personal__content__item__statistics__text"><?php _e('Queries in search', 'krop'); ?></div>
                </div>
                <div class="d-block col-md-3 col-6 personal__content__item__list-inform__mar-element">
                    <div class="personal__content__item__statistics__number"><?php echo $stat->__get( 'follow_links' ); ?></div>
                    <div class="personal__content__item__statistics__text"><?php _e('Number of links to the site and social networks followed', 'krop'); ?>
                    </div>
                </div>
                <div class="d-block col-md-4 col-5">
                    <div class="personal__content__item__statistics__number">
	                    <?php _e('#', 'krop'); ?><?php echo $stat->__get( 'rating_order' ); ?></div>
                    <div class="personal__content__item__statistics__text"><?php _e('Place in the ranking among brands/businesses', 'krop'); ?></div>
                </div>
                <div class="d-block col-md-3 col-6">
                    <div class="personal__content__item__statistics__number"><?php echo_formatted_rating( $stat->__get( 'user_rating' ) ); ?></div>
                    <div class="personal__content__item__statistics__text"><?php _e('User rating', 'krop'); ?>
                    </div>
                </div>
                <div class="d-block col-md-3 col-5">
                    <div class="personal__content__item__statistics__number"><?php echo $stat->__get( 'new_reviews' ); ?></div>
                    <div class="personal__content__item__statistics__text"><?php _e('New reviews', 'krop'); ?></div>
                </div>
            </div>
        </div>
		<?php
	}
}
?>