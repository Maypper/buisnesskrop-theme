<?php
$title    = get_field( 'title' );
$link     = get_field( 'link' );
$articles = get_posts( array(
	'numberposts' => 4,
	'post_type'   => 'news',
//	'category'    => - 129,
) );
global $post;
?>
<div class="container 123123">
    <div class="main-page-content__other-articles">
        <div class="other-articles">
			<?php if ( $title ): ?>
                <h2 class="other-articles__title"><?php echo $title; ?></h2>
			<?php
			endif;
			if ( $link ):
				?>
                <a class="other-articles__btn btn btn--primary" href="<?php echo $link['url']; ?>"
                   target="<?php echo $link['target']; ?>">
					<?php echo $link['title']; ?>
                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M15.833 1.667H14.09a1.248 1.248 0 0 0-1.173-.834h-1.259A2.086 2.086 0 0 0 10 0c-.651 0-1.267.314-1.658.833H7.083c-.542 0-1 .35-1.173.834H4.167c-.92 0-1.667.747-1.667 1.666v15c0 .92.747 1.667 1.667 1.667h11.666c.92 0 1.667-.747 1.667-1.667v-15c0-.919-.747-1.666-1.667-1.666Zm-9.166.416c0-.23.186-.416.416-.416h1.481a.417.417 0 0 0 .36-.207 1.236 1.236 0 0 1 2.152 0 .417.417 0 0 0 .36.207h1.48c.23 0 .417.186.417.416V2.5c0 .46-.373.833-.833.833h-5a.834.834 0 0 1-.833-.833v-.417Zm10 16.25c0 .46-.374.834-.834.834H4.167a.834.834 0 0 1-.834-.834v-15c0-.46.374-.833.834-.833h1.666c0 .92.748 1.667 1.667 1.667h5c.92 0 1.667-.748 1.667-1.667h1.666c.46 0 .834.374.834.833v15Z"
                                fill="#fff"/>
                        <path
                                d="M13.75 9.167h-7.5a.416.416 0 1 0 0 .833h7.5a.417.417 0 1 0 0-.833ZM13.75 10.833h-7.5a.416.416 0 1 0 0 .834h7.5a.416.416 0 1 0 0-.834ZM13.75 12.5h-7.5a.416.416 0 1 0 0 .833h7.5a.416.416 0 1 0 0-.833ZM10.417 14.167H6.25a.416.416 0 1 0 0 .833h4.167a.416.416 0 1 0 0-.833Z"
                                fill="#fff"/>
                    </svg>
                </a>
			<?php endif; ?>
            <div class="other-articles__slider">
				<?php
				foreach ( $articles as $post ):
					setup_postdata( $post );
					get_template_part( 'template-parts/single-items/item', 'news' );
				endforeach;
				wp_reset_postdata();
				?>
            </div>
        </div>
    </div>
</div>
