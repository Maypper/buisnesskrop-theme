<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Brickbite
 */

get_header();
get_template_part( 'template-parts/breadcrumbs' );
$actual_link = home_url( $_SERVER['REQUEST_URI'] );
global $wp_query;
?>

    <section class="search-page-content">
        <div class="container">
            <h1><?php _e( 'Search results', 'krop' ); ?></h1>
            <div class="search-block">
	            <?php get_template_part( 'template-parts/search/search-block-content' ); ?>
            </div>
        </div>

		<?php
        if (isset($_GET['search_post_type']) && $_GET['search_post_type'] != 'news' ) {
	        get_template_part( 'template-parts/blocks/map' );
        }
        ?>

        <div class="container">
			<?php
			$my_posts   = new WP_Query;
			if ( ! array_key_exists( 'search_post_type', $_GET ) ):
				$results_test = $my_posts->query( array(
					'post_type' => [ 'brands', 'news', 'places' ],
					's'         => get_search_query()
				) );
				$brands = $my_posts->query( array(
					'post_type'      => 'brands',
					's'              => get_search_query(),
					'posts_per_page' => 3
				) );
				if ( ! empty( $results_test ) ):
					if ( ! empty( $brands ) ):
						?>
                        <div class="search-page-content__head-wrapper">
                            <h2><?php _e( 'Brands/Businesses', 'krop' ) ?></h2>
                            <a class="btn btn--primary" href="<?php echo $actual_link . '&search_post_type=brands'; ?>">
								<?php _e( 'See all results', 'krop' ); ?>
                                <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M15.833 1.667H14.09a1.248 1.248 0 0 0-1.173-.834h-1.259A2.086 2.086 0 0 0 10 0c-.651 0-1.267.314-1.658.833H7.083c-.542 0-1 .35-1.173.834H4.167c-.92 0-1.667.747-1.667 1.666v15c0 .92.747 1.667 1.667 1.667h11.666c.92 0 1.667-.747 1.667-1.667v-15c0-.919-.747-1.666-1.667-1.666Zm-9.166.416c0-.23.186-.416.416-.416h1.481a.417.417 0 0 0 .36-.207 1.236 1.236 0 0 1 2.152 0 .417.417 0 0 0 .36.207h1.48c.23 0 .417.186.417.416V2.5c0 .46-.373.833-.833.833h-5a.834.834 0 0 1-.833-.833v-.417Zm10 16.25c0 .46-.374.834-.834.834H4.167a.834.834 0 0 1-.834-.834v-15c0-.46.374-.833.834-.833h1.666c0 .92.748 1.667 1.667 1.667h5c.92 0 1.667-.748 1.667-1.667h1.666c.46 0 .834.374.834.833v15Z"
                                            fill="#fff"/>
                                    <path
                                            d="M13.75 9.167h-7.5a.416.416 0 1 0 0 .833h7.5a.417.417 0 1 0 0-.833ZM13.75 10.833h-7.5a.416.416 0 1 0 0 .834h7.5a.416.416 0 1 0 0-.834ZM13.75 12.5h-7.5a.416.416 0 1 0 0 .833h7.5a.416.416 0 1 0 0-.833ZM10.417 14.167H6.25a.416.416 0 1 0 0 .833h4.167a.416.416 0 1 0 0-.833Z"
                                            fill="#fff"/>
                                </svg>
                            </a>
                        </div>
                        <div class="search-page-content__brands-wrapper">
							<?php
							foreach ( $brands as $post ):
								setup_postdata( $post );
								get_template_part( 'template-parts/single-items/item', 'brand' );
							endforeach;
							wp_reset_postdata();
							?>
                        </div>
					<?php
					endif;
					$news = $my_posts->query( array(
						'post_type'      => 'news',
						's'              => get_search_query(),
						'post_status'    => [ 'publish' ],
						'posts_per_page' => 4
					) );
					if ( ! empty( $news ) ):
						?>
                        <div class="search-page-content__head-wrapper">
                            <h2><?php _e( 'News/Announcements', 'krop' ); ?></h2>
                            <a class="btn btn--primary" href="<?php echo $actual_link . '&search_post_type=news'; ?>">
								<?php _e( 'See all results', 'krop' ); ?>
                                <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M15.833 1.667H14.09a1.248 1.248 0 0 0-1.173-.834h-1.259A2.086 2.086 0 0 0 10 0c-.651 0-1.267.314-1.658.833H7.083c-.542 0-1 .35-1.173.834H4.167c-.92 0-1.667.747-1.667 1.666v15c0 .92.747 1.667 1.667 1.667h11.666c.92 0 1.667-.747 1.667-1.667v-15c0-.919-.747-1.666-1.667-1.666Zm-9.166.416c0-.23.186-.416.416-.416h1.481a.417.417 0 0 0 .36-.207 1.236 1.236 0 0 1 2.152 0 .417.417 0 0 0 .36.207h1.48c.23 0 .417.186.417.416V2.5c0 .46-.373.833-.833.833h-5a.834.834 0 0 1-.833-.833v-.417Zm10 16.25c0 .46-.374.834-.834.834H4.167a.834.834 0 0 1-.834-.834v-15c0-.46.374-.833.834-.833h1.666c0 .92.748 1.667 1.667 1.667h5c.92 0 1.667-.748 1.667-1.667h1.666c.46 0 .834.374.834.833v15Z"
                                            fill="#fff"/>
                                    <path
                                            d="M13.75 9.167h-7.5a.416.416 0 1 0 0 .833h7.5a.417.417 0 1 0 0-.833ZM13.75 10.833h-7.5a.416.416 0 1 0 0 .834h7.5a.416.416 0 1 0 0-.834ZM13.75 12.5h-7.5a.416.416 0 1 0 0 .833h7.5a.416.416 0 1 0 0-.833ZM10.417 14.167H6.25a.416.416 0 1 0 0 .833h4.167a.416.416 0 1 0 0-.833Z"
                                            fill="#fff"/>
                                </svg>
                            </a>
                        </div>
                        <div class="row search-page-content__articles-wrapper">
							<?php
							foreach ( $news as $post ):
								setup_postdata( $post );
								echo '<div class="col-md-3 col-12">';
								get_template_part( 'template-parts/single-items/item', 'news' );
								echo '</div>';
								wp_reset_postdata();
							endforeach;
							?>
                        </div>
					<?php
					endif;
					$places = $my_posts->query( array(
						'post_type'      => 'places',
						's'              => get_search_query(),
						'posts_per_page' => 3
					) );
					if ( ! empty( $places ) ):
						?>
                        <div class="search-page-content__head-wrapper">
                            <h2><?php _e( 'Interesting places', 'krop' ); ?></h2>
                            <a class="btn btn--primary" href="<?php echo $actual_link . '&search_post_type=places'; ?>">
								<?php _e( 'See all results', 'krop' ); ?>
                                <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M15.833 1.667H14.09a1.248 1.248 0 0 0-1.173-.834h-1.259A2.086 2.086 0 0 0 10 0c-.651 0-1.267.314-1.658.833H7.083c-.542 0-1 .35-1.173.834H4.167c-.92 0-1.667.747-1.667 1.666v15c0 .92.747 1.667 1.667 1.667h11.666c.92 0 1.667-.747 1.667-1.667v-15c0-.919-.747-1.666-1.667-1.666Zm-9.166.416c0-.23.186-.416.416-.416h1.481a.417.417 0 0 0 .36-.207 1.236 1.236 0 0 1 2.152 0 .417.417 0 0 0 .36.207h1.48c.23 0 .417.186.417.416V2.5c0 .46-.373.833-.833.833h-5a.834.834 0 0 1-.833-.833v-.417Zm10 16.25c0 .46-.374.834-.834.834H4.167a.834.834 0 0 1-.834-.834v-15c0-.46.374-.833.834-.833h1.666c0 .92.748 1.667 1.667 1.667h5c.92 0 1.667-.748 1.667-1.667h1.666c.46 0 .834.374.834.833v15Z"
                                            fill="#fff"/>
                                    <path
                                            d="M13.75 9.167h-7.5a.416.416 0 1 0 0 .833h7.5a.417.417 0 1 0 0-.833ZM13.75 10.833h-7.5a.416.416 0 1 0 0 .834h7.5a.416.416 0 1 0 0-.834ZM13.75 12.5h-7.5a.416.416 0 1 0 0 .833h7.5a.416.416 0 1 0 0-.833ZM10.417 14.167H6.25a.416.416 0 1 0 0 .833h4.167a.416.416 0 1 0 0-.833Z"
                                            fill="#fff"/>
                                </svg>
                            </a>
                        </div>
                        <div class="places-box-wrapper">
                            <div class="row places-box-wrapper__links-wrapper">
								<?php
								$places_count = count( $places );
								$places_count --;
								foreach ( $places as $index => $post ):
									get_template_part( 'template-parts/single-items/item', 'place' );
								endforeach;
								?>
                            </div>
                        </div>
					<?php
					endif;
				else:
					?>
                    <div class="search-page-content__text-no-results">
                        <h2><?php _e( 'No search results found', 'krop' ); ?></h2>
                        <p><?php _e( 'So far we have not found anything on your request, please try again', 'krop' ); ?></p>
                    </div>
				<?php
				endif;
			else:
				$concrete_args = array(
					'post_type' => $_GET['search_post_type'],
					's'         => get_search_query(),
					'posts_per_page' => -1,
				);
				if ( $_GET['search_post_type'] == 'brands' ) {
					if (isset($_GET['category-brands']) && !empty($_GET['category-brands']) ) {
						$concrete_args = search_tax_query('category-brands', $concrete_args);
					}
					if (isset($_GET['city_district']) && !empty( $_GET['city_district'] ) ) {
						$concrete_args = search_tax_query('city_district', $concrete_args);
					}
                    if (isset($_GET['work_hours']) && !empty($_GET['work_hours'])) {
	                    $concrete_args['meta_query'] = array(
                            'relation' => 'AND',
                        );

                        if ($_GET['work_hours'] == 'custom') {
	                        if (!empty($_GET['time_from'])) {
		                        $concrete_args['meta_query'][] = array(
			                        'key'     => 'time_from',
			                        'value'   => $_GET['time_from'],
			                        'compare' => '<=',
			                        'type'    => 'TIME',
		                        );
	                        }
	                        if (!empty($_GET['time_to'])) {
		                        $concrete_args['meta_query'][] = array(
			                        'key'     => 'time_to',
			                        'value'   => $_GET['time_to'],
			                        'compare' => '>=',
			                        'type'    => 'TIME',
		                        );
	                        }
	                        if ($_GET['time_from'] >= $_GET['time_to']) {
		                        $concrete_args['meta_query'][] = array(
			                        'key'     => 'night_time_work',
			                        'value'   => '1',
		                        );
                            }
                        } else {
	                        $concrete_args['meta_query'][] = array(
		                        'key' => 'works_hours',
		                        'value' => $_GET['work_hours'],
                            );

                        }
                    }
					$concrete_args = search_checkboxes('url', $concrete_args);
					$concrete_args = search_checkboxes('images', $concrete_args);
					$concrete_args = search_checkboxes('order_page', $concrete_args);
					$concrete_args = search_checkboxes('a11y', $concrete_args);

				} elseif ( $_GET['search_post_type'] == 'news' ) {
					$concrete_args['post_status'] = [ 'publish', 'future' ]; //todo майбутні також? 🤔
					if ( isset($_GET['category-news']) && !empty( $_GET['category-news'] ) ) {
						$concrete_args = search_tax_query('category-news', $concrete_args);
					}
					if ( $_GET['date_range'] ) {
						$date_range = explode( ' - ', $_GET['date_range'] );
						foreach ( $date_range as $index => $date ) {
							$date_range[ $index ] = explode( '-', $date );
						}
						$concrete_args['date_query'] = array(
							array(
								'before'    => [
									'year'  => $date_range[1][2],
									'month' => $date_range[1][1],
									'day'   => $date_range[1][0],
                                ],
								'after'     => [
									'year'  => $date_range[0][2],
									'month' => $date_range[0][1],
									'day'   => $date_range[0][0],
								],
								'inclusive' => true,
							)
						);
					}
				} elseif ( $_GET['search_post_type'] == 'places' ) {
                    if (isset($_GET['places_districts'])) {
	                    $concrete_args = search_tax_query('places_districts', $concrete_args);
                    }
					$concrete_args = search_checkboxes('a11y', $concrete_args);
				}
				$posts       = $my_posts->query( $concrete_args );
				$posts_count = count( $posts );

				if ( ! empty( $posts ) ):
					if ( $_GET['search_post_type'] == 'brands' ) {
						$container_class = 'search-page-content__concretized-wrapper';
						$search_label    = __( 'businesses/brands', 'krop' );
					} elseif ( $_GET['search_post_type'] == 'news' ) {
						$container_class = 'row search-page-content__articles-wrapper';
						$search_label    = __( 'news/announcements', 'krop' );
					} elseif ( $_GET['search_post_type'] == 'places' ) {
						$container_class = 'row places-box-wrapper__links-wrapper';
						$search_label    = __( 'interesting places', 'krop' );
					}
					?>
                    <h2 class="search-page-content__concretized-title"><?php echo __( 'Search results by ', 'krop' ) . $search_label . ': ' . $posts_count; ?></h2>
                    <div class="<?php echo $container_class; ?>">
						<?php
						foreach ( $posts as $post ):
							setup_postdata( $post );
							if ( $_GET['search_post_type'] == 'brands' ) {
								do_action( 'brand_statistic_map_search', $post->ID );
								get_template_part( 'template-parts/single-items/item', 'brand' );
							} elseif ( $_GET['search_post_type'] == 'news' ) {
								echo '<div class="col-md-3 col-12">';
								get_template_part( 'template-parts/single-items/item', 'news' );
								echo '</div>';
							} elseif ( $_GET['search_post_type'] == 'places' ) {
								get_template_part( 'template-parts/single-items/item', 'place' );
							}
						endforeach; ?>
                    </div>
				<?php else: ?>
                    <div class="search-page-content__text-no-results">
                        <h2><?php _e( 'No search results found', 'krop' ); ?></h2>
                        <p><?php _e( 'So far we have not found anything on your request, please try again', 'krop' ); ?></p>
                    </div>
				<?php
				endif;
			endif;
			?>
        </div>
    </section>

<?php if ( get_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ) ): ?>
    <div class="container">
        <div class="text-bottom divider">
			<?php the_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ); ?>
        </div>
    </div>
<?php
endif;
get_sidebar();
get_footer();
