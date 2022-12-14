<div class="article-content__other-articles">
    <div class="other-articles">
        <h2 class="other-articles__title"><?php _e( 'Related news', 'krop' ); ?></h2>
        <a class="other-articles__btn btn btn--primary" href="<?php echo home_url( '/news/' ); ?>">

			<?php _e( 'View full list', 'krop' ); ?>
            <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M15.833 1.667H14.09a1.248 1.248 0 0 0-1.173-.834h-1.259A2.086 2.086 0 0 0 10 0c-.651 0-1.267.314-1.658.833H7.083c-.542 0-1 .35-1.173.834H4.167c-.92 0-1.667.747-1.667 1.666v15c0 .92.747 1.667 1.667 1.667h11.666c.92 0 1.667-.747 1.667-1.667v-15c0-.919-.747-1.666-1.667-1.666Zm-9.166.416c0-.23.186-.416.416-.416h1.481a.417.417 0 0 0 .36-.207 1.236 1.236 0 0 1 2.152 0 .417.417 0 0 0 .36.207h1.48c.23 0 .417.186.417.416V2.5c0 .46-.373.833-.833.833h-5a.834.834 0 0 1-.833-.833v-.417Zm10 16.25c0 .46-.374.834-.834.834H4.167a.834.834 0 0 1-.834-.834v-15c0-.46.374-.833.834-.833h1.666c0 .92.748 1.667 1.667 1.667h5c.92 0 1.667-.748 1.667-1.667h1.666c.46 0 .834.374.834.833v15Z"
                        fill="#fff"/>
                <path
                        d="M13.75 9.167h-7.5a.416.416 0 1 0 0 .833h7.5a.417.417 0 1 0 0-.833ZM13.75 10.833h-7.5a.416.416 0 1 0 0 .834h7.5a.416.416 0 1 0 0-.834ZM13.75 12.5h-7.5a.416.416 0 1 0 0 .833h7.5a.416.416 0 1 0 0-.833ZM10.417 14.167H6.25a.416.416 0 1 0 0 .833h4.167a.416.416 0 1 0 0-.833Z"
                        fill="#fff"/>
            </svg>
        </a>
		<?php
		$post_id = get_the_ID();


		$relatedPostArgs = array(
			'post_type'      => 'news',
			'posts_per_page' => 4,
			'post_status'    => 'publish',
			'orderby'        => 'rand',
			'post__not_in'   => array( $post_id ),
		);
		$terms           = get_the_terms( $post->ID, 'catecory-news' );
		if ( is_array( $terms ) ) {
			$relatedPostArgs['tax_query'] = array(
				array(
					'taxonomy' => 'catecory-news',
					'terms'    => array_column( $terms, 'slug' ),
					'field'    => 'slug',
					'operator' => 'IN',
				)
			);
		}

		$relatedPostQuery = new WP_Query( $relatedPostArgs );
		if ( $relatedPostQuery->have_posts() ):
			?>

            <div class="other-articles__slider">

				<?php while ( $relatedPostQuery->have_posts() ) : $relatedPostQuery->the_post(); ?>
                <div class="article-item-wrapper">

                    <a href="<?php the_permalink() ?>" class="other-articles__item article-item">
                        <div class="article-item__img">
							<?php the_post_thumbnail( 'medium' ); ?>
                        </div>
                        <div class="article-item__info">
                            <time class="article-item__info-data"><?php the_time( 'd.m.Y' ); ?></time>
                            <h3 class="article-item__info-title"><?php echo splitter_trim_symbols( get_the_title(), 36 ); ?></h3>
                            <p class="article-item__info-text"><?php echo splitter_trim_symbols( get_the_excerpt(), 45 ); ?></p>
                            <div class="article-item__info-category">
								<?php
								$termsListReadyString = '';
								$terms                = get_the_terms( $post->ID, 'catecory-news' );

								$termsListReadyString = implode( ' ', array_column( $terms, 'name' ) );
								?>
                                <p><?php echo $termsListReadyString; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
				<?php endwhile; ?>

            </div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
    </div>
</div>