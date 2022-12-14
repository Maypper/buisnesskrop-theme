<?php
$size    = get_field( 'shyrokaya_novost' ) ? 'news-wide-list' : 'news-list';
$title   = splitter_trim_symbols( html_entity_decode( get_the_title() ), get_field( 'shyrokaya_novost' ) ? 90 : 32 );
$excerpt = splitter_trim_symbols( html_entity_decode( get_the_excerpt() ), get_field( 'shyrokaya_novost' ) ? 108 : 40 );
$terms   = wp_get_post_terms( $post->ID, 'catecory-news' );

?>
<div class="article-item-wrapper">
<!--    <a href="--><?php //the_permalink(); ?><!--" class="article-item">-->
        <div class="article-item__img">
			<?php echo wp_get_attachment_image( get_post_thumbnail_id(), $size ) ?>
        </div>
        <div class="article-item__info">
            <time class="article-item__info-data"><?php echo get_the_date( 'd.m.Y' ) ?></time>
            <h3 class="article-item__info-title"><?php echo $title; ?></h3>
            <a class="link-box__nav btn btn--primary m-0 card-link-cover" href="<?php the_permalink(); ?>">
	            <?php _e('Learn more', 'krop'); ?>
                <svg width="21" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.936 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.12-2.5 2.5-2.5 1.378 0 2.5 1.121 2.5 2.5s-1.122 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM10.218 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5s2.5 1.121 2.5 2.5-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM2.5 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5S5 8.839 5 10.218s-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25s1.25-.561 1.25-1.25c0-.69-.56-1.25-1.25-1.25Z" fill="#fff"></path>
                </svg>
            </a>
<!--            <p class="article-item__info-text">--><?php //echo $excerpt; ?><!--</p>-->
<!--            <div class="article-item__info-category">-->
<!--				--><?php //if ( ! empty( $terms ) ):
//					$terms_names = array();
//					foreach ( $terms as $term ) {
//						$terms_names[] = $term->name;
//					}
//					$terms_list = implode( ', ', $terms_names );
//					?>
<!--                    <p>--><?php //echo splitter_trim_symbols( $terms_list, get_field( 'shyrokaya_novost' ) ? 60 : 25 ); ?><!--</p>-->
<!--				--><?php //endif; ?>
<!--            </div>-->
        </div>
<!--    </a>-->
</div>