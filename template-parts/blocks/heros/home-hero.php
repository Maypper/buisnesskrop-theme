<?php
$title     = get_field( 'title' );
$paragraph = get_field( 'paragraph' );
$img       = get_field( 'img' );
$show_news = get_field( 'show_news' );
if ( $show_news ) {
	$news = get_field( 'news' );
}
global $post;
?>
<h1 class="visually-hidden"><?php echo $title; ?></h1>

<div class="main-slider">
    <div class="container">
        <div class="main-slider__wrap">
            <div class="main-slider__data">
                <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M22 14.26V4c0-1.103-.898-2-2-2h-3V.5a.5.5 0 1 0-1 0V2H7V.5a.5.5 0 1 0-1 0V2H2C.897 2 0 2.897 0 4v16c0 1.103.897 2 2 2h12.26c1.01 1.22 2.536 2 4.24 2 3.032 0 5.5-2.467 5.5-5.5a5.49 5.49 0 0 0-2-4.24ZM1 4c0-.551.448-1 1-1h4v1a1.001 1.001 0 0 0 0 2c.552 0 1-.449 1-1V3h9v1a1.001 1.001 0 0 0 0 2c.552 0 1-.449 1-1V3h3c.552 0 1 .449 1 1v3H1V4Zm1 17c-.552 0-1-.449-1-1V8h20v5.607A5.458 5.458 0 0 0 18.5 13a5.507 5.507 0 0 0-5.5 5.5c0 .9.222 1.749.607 2.5H2Zm16.5 2a4.505 4.505 0 0 1-4.5-4.5c0-2.481 2.019-4.5 4.5-4.5s4.5 2.019 4.5 4.5-2.019 4.5-4.5 4.5Z"
                            fill="#E8BA06"/>
                    <path
                            d="M19 18.293V15.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 .146.354l1.5 1.5a.498.498 0 0 0 .708 0 .5.5 0 0 0 0-.707L19 18.293Z"
                            fill="#E8BA06"/>
                </svg>
                <div>
					<?php
					$months = array(
						__( 'january', 'krop' ),
						__( 'february', 'krop' ),
						__( 'march', 'krop' ),
						__( 'april', 'krop' ),
						__( 'may', 'krop' ),
						__( 'june', 'krop' ),
						__( 'july', 'krop' ),
						__( 'august', 'krop' ),
						__( 'september', 'krop' ),
						__( 'october', 'krop' ),
						__( 'november', 'krop' ),
						__( 'december', 'krop' ),
					);
					$month  = date( 'n' ) - 1;

					$days = [
						__( 'Sunday', 'krop' ),
						__( 'Monday', 'krop' ),
						__( 'Tuesday', 'krop' ),
						__( 'Wednesday', 'krop' ),
						__( 'Thursday', 'krop' ),
						__( 'Friday', 'krop' ),
						__( 'Saturday', 'krop' ),
					];
					$day  = date( 'w' );
					?>
                    <p id="current_date"><?php echo mb_strtolower( date( 'j' ) . ' ' . $months[ $month ] ); ?>,<br><?php echo $days[ $day ]; ?></p>
                </div>
            </div>
            <div class="main-slider__time">
                <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M12 0C5.383 0 0 5.383 0 12s5.383 12 12 12 12-5.383 12-12S18.617 0 12 0Zm0 22.5C6.21 22.5 1.5 17.79 1.5 12S6.21 1.5 12 1.5 22.5 6.21 22.5 12 17.79 22.5 12 22.5Z"
                            fill="#E8BA06"/>
                    <path
                            d="M12.75 5.25a.75.75 0 0 0-1.5 0v6.646a1 1 0 0 0 .293.707l3.896 3.897a.75.75 0 1 0 1.06-1.06l-3.456-3.458a1 1 0 0 1-.293-.707V5.25Z"
                            fill="#E8BA06"/>
                </svg>
                <div>
                    <p id="current_time"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid buttons-wrapper"<?php if (! $show_news ) : ?>style="display: none" <?php endif; ?>>
        <div class="container button-row">
            <div class="button-row__wrapper">
                <div class="button-group button-group--cells">
                    <button class="button is-selected"></button>
                    <button class="button"></button>
                    <button class="button"></button>
                    <button class="button"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="main-slider__slider">
        <div class="slider-item" style="background-image: url('<?php echo $img; ?>')">
            <div class="container">
                    <h2 class="slider-item__title"><?php echo $title; ?></h2>
                <div>
                    <p class="slider-item__text"><?php echo $paragraph; ?></p>
                </div>
            </div>
        </div>
		<?php
		if ( $show_news && !empty($news) ):
			foreach ( $news as $post ):
				setup_postdata( $post );
				?>
                <div class="slider-item" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
                    <div class="container">
                        <a href="<?php echo get_permalink(); ?>">
                            <h2 class="slider-item__title"><?php echo get_the_title(); ?></h2>
                        </a>
                        <div>
                            <p class="slider-item__text"><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </div>
                </div>
			<?php
			endforeach;
			wp_reset_postdata();
		endif;
		?>
    </div>
    <div class="container">
        <div class="main-slider__search-block">
            <div class="search-block__form">
				<?php get_search_form(); ?>
                <div class="search-block__form-chip advanced-search-button" id="index-search-button">
					<?php _e( 'Advanced search', 'krop' ); ?>
                    <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 15V9m0 0V3m0 6h6M9 9H3" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container search-block--index search-block__wrap" id="search-block--index">
    <div class="search-block">
        <div class="search-block__content">
            <div class="mob-searchform">
                <form role="search" method="get" id="searchform-mob" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input name="s" id="s" value="<?php echo get_search_query() ?>" placeholder="<?php _e('Enter a query, such as City Council', 'krop'); ?>"
                           type="text">
                    <button class="btn btn--primary" type="submit">
                        <span><?php _e('Search', 'krop'); ?></span>
                        <svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="m14 14-2.99-2.996L14 14Zm-1.333-7A5.667 5.667 0 1 1 1.333 7a5.667 5.667 0 0 1 11.334 0v0Z"
                                  stroke="#fff" stroke-width="2" stroke-linecap="round"></path>
                        </svg>
                    </button>
                </form>
                <div class="search-block__form-chip advanced-search-button mob-advanced-form-btn" id="index-search-button">
		            <?php _e( 'Advanced search', 'krop' ); ?>
                    <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 15V9m0 0V3m0 6h6M9 9H3" stroke="#1B1B1B" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
			<?php get_template_part( 'template-parts/search/search', 'advanced' ); ?>
        </div>
    </div>
</div>
<!--<style>-->
<!--    .search-block--index {-->
<!--        opacity: 1 !important;-->
<!--        max-height: none !important;-->
<!--    }-->
<!--</style>-->
