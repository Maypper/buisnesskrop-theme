<div class="article-content__navigation-bottom divider">

    <div class="navigation-bottom">
		<?php
		$prev_post = get_previous_post();
		if ( empty( $prev_post ) ) {
			?>
            <div class="navigation-bottom__link"></div>
			<?php
		} else {
			?>
            <a href="<?php echo get_permalink( $prev_post->ID ); ?>"
               class="navigation-bottom__link navigation-bottom__link--prev">
                <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M23 12c0-.379-.145-.742-.403-1.01a1.35 1.35 0 0 0-.972-.418H5.696l5.904-6.13a1.46 1.46 0 0 0 .403-1.012c0-.38-.145-.743-.403-1.011A1.351 1.351 0 0 0 10.626 2c-.365 0-.715.15-.973.419l-8.25 8.57a1.476 1.476 0 0 0 0 2.022l8.25 8.57c.258.268.608.419.973.419.366 0 .716-.15.974-.419.258-.268.403-.632.403-1.011 0-.38-.145-.743-.403-1.011l-5.904-6.13h15.93c.364 0 .713-.151.971-.419S23 12.379 23 12Z"
                          fill="#6B2A14"/>
                </svg>
                <div>
                    <div class="navigation-bottom__text"><?php _e( 'Previous news', 'krop' ); ?></div>
                    <div class="navigation-bottom__title">
						<?php echo apply_filters( 'the_title', $prev_post->post_title ); ?></div>
                </div>
            </a>
			<?php
		}
		$next_post = get_next_post();
		if ( ! empty( $next_post ) ): ?>
            <a href="<?php echo get_permalink( $next_post->ID ); ?>"
               class="navigation-bottom__link navigation-bottom__link--next">
                <div>
                    <div class="navigation-bottom__text"><?php _e( 'Next news', 'krop' ); ?></div>
                    <div class="navigation-bottom__title">
						<?php echo apply_filters( 'the_title', $next_post->post_title ); ?></div>
                </div>
                <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M1 12c0-.379.145-.742.403-1.01a1.35 1.35 0 0 1 .972-.418h15.929L12.4 4.442a1.46 1.46 0 0 1-.403-1.012c0-.38.145-.743.403-1.011.258-.268.608-.419.974-.419.365 0 .715.15.973.419l8.25 8.57a1.477 1.477 0 0 1 0 2.022l-8.25 8.57a1.35 1.35 0 0 1-.973.419c-.366 0-.716-.15-.974-.419a1.459 1.459 0 0 1-.403-1.011c0-.38.145-.743.403-1.011l5.904-6.13H2.374a1.35 1.35 0 0 1-.971-.419A1.457 1.457 0 0 1 1 12Z"
                          fill="#6B2A14"/>
                </svg>
            </a>
		<?php endif; ?>
    </div>
</div>