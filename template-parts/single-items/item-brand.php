<?php
$terms        = wp_get_post_terms( $post->ID, 'category-brands' );
$excerpt      = get_the_excerpt();
$excerpt      = max_symbols_is( $excerpt, 68 );
$title        = get_the_title();
$title        = max_symbols_is( $title, 49 );
$brand_rating = get_post_meta( $post->ID, 'brand_rating', true ) ?: 0;
if ( ! empty( $terms ) ) {
	$terms_names = array();
	foreach ( $terms as $term ) {
		$terms_names[] = $term->name;
	}
	$terms_list = implode( ', ', $terms_names );
}
$view_format = null;
if ( is_post_type_archive( 'brands' ) ) {
	$view_format = get_field( 'brand_view_format', $post->ID );
}
if ( ! $view_format || $view_format === 'normal' ):
	$location = get_field( 'location', $post->ID );
	?>
    <a href="<?php the_permalink(); ?>" class="brand-item">
        <div class="brand-item__img">
			<?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'brands-list' ) ?>
            <p class="brand-item__rate">
                <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M4.29 18.339c-.46.235-.98-.177-.887-.703l.986-5.617L.205 8.033c-.39-.372-.187-1.054.337-1.128l5.816-.826L8.95.94a.61.61 0 0 1 1.101 0l2.594 5.139 5.816.826c.524.074.727.756.335 1.128l-4.182 3.986.985 5.617c.093.526-.427.938-.886.703L9.5 15.659l-5.212 2.68h.001Z"
                            fill="#fff"/>
                </svg>
                <span><?php echo_formatted_rating( $brand_rating ); ?></span>
            </p>
        </div>
        <div class="brand-item__info">
            <h3 class="brand-item__info-title"><?php echo $title; ?></h3>
            <p class="brand-item__info-text"><?php echo $excerpt; ?></p>
			<?php if ( isset( $terms_list ) ): ?>
                <p class="brand-item__info-category"><?php echo $terms_list ?></p>
			<?php endif; ?>
        </div>
    </a>
<?php elseif ( $view_format === 'high' ): ?>
    <div class="brand-item brand-item--high">
		<?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'brand-high' ) ?>
        <p class="brand-item__rate">
            <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M4.29 18.339c-.46.235-.98-.177-.887-.703l.986-5.617L.205 8.033c-.39-.372-.187-1.054.337-1.128l5.816-.826L8.95.94a.61.61 0 0 1 1.101 0l2.594 5.139 5.816.826c.524.074.727.756.335 1.128l-4.182 3.986.985 5.617c.093.526-.427.938-.886.703L9.5 15.659l-5.212 2.68h.001Z"
                        fill="#fff"/>
            </svg>
            <span><?php echo_formatted_rating( $brand_rating ); ?></span>
        </p>
        <div class="brand-item__info">
            <h3 class="brand-item__info-title"><?php echo $title ?></h3>
            <p class="brand-item__info-text"><?php echo $excerpt ?></p>
			<?php if ( isset( $terms_list ) ): ?>
                <p class="brand-item__info-category"><?php echo $terms_list ?></p>
			<?php endif; ?>
            <a class="link-box__nav btn btn--secondary" href="<?php the_permalink(); ?>">
				<?php _e( 'Find out more', 'krop' ); ?>
                <svg width="21" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M17.936 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.12-2.5 2.5-2.5 1.378 0 2.5 1.121 2.5 2.5s-1.122 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM10.218 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5s2.5 1.121 2.5 2.5-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM2.5 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5S5 8.839 5 10.218s-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25s1.25-.561 1.25-1.25c0-.69-.56-1.25-1.25-1.25Z"
                            fill="#E8BA06"/>
                </svg>
            </a>
        </div>
    </div>
    <a href="<?php the_permalink(); ?>" class="brand-item d-md-none">
        <div class="brand-item__img">
			<?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'brands-list' ) ?>
            <p class="brand-item__rate">
                <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M4.29 18.339c-.46.235-.98-.177-.887-.703l.986-5.617L.205 8.033c-.39-.372-.187-1.054.337-1.128l5.816-.826L8.95.94a.61.61 0 0 1 1.101 0l2.594 5.139 5.816.826c.524.074.727.756.335 1.128l-4.182 3.986.985 5.617c.093.526-.427.938-.886.703L9.5 15.659l-5.212 2.68h.001Z"
                            fill="#fff"/>
                </svg>
                <span><?php echo_formatted_rating( $brand_rating ); ?></span>
            </p>
        </div>
        <div class="brand-item__info">
            <h3 class="brand-item__info-title"><?php echo $title; ?></h3>
            <p class="brand-item__info-text"><?php echo $excerpt; ?></p>
			<?php if ( isset( $terms_list ) ): ?>
                <p class="brand-item__info-category"><?php echo $terms_list ?></p>
			<?php endif; ?>
        </div>
    </a>
<?php elseif ( $view_format === 'wide' ): ?>
    <div class="brand-item brand-item--wide">
		<?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'brand-wide' ) ?>
        <p class="brand-item__rate">
            <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M4.29 18.339c-.46.235-.98-.177-.887-.703l.986-5.617L.205 8.033c-.39-.372-.187-1.054.337-1.128l5.816-.826L8.95.94a.61.61 0 0 1 1.101 0l2.594 5.139 5.816.826c.524.074.727.756.335 1.128l-4.182 3.986.985 5.617c.093.526-.427.938-.886.703L9.5 15.659l-5.212 2.68h.001Z"
                        fill="#fff"/>
            </svg>
            <span><?php echo_formatted_rating( $brand_rating ); ?></span>
        </p>
        <div class="brand-item__info">
            <h3 class="brand-item__info-title"><?php echo $title; ?></h3>
            <p class="brand-item__info-text"><?php echo $excerpt; ?></p>

            <a class="link-box__nav btn btn--secondary" href="<?php the_permalink(); ?>">
	            <?php _e('Learn more', 'krop'); ?>
                <svg width="21" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M17.936 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.12-2.5 2.5-2.5 1.378 0 2.5 1.121 2.5 2.5s-1.122 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM10.218 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5s2.5 1.121 2.5 2.5-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM2.5 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5S5 8.839 5 10.218s-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25s1.25-.561 1.25-1.25c0-.69-.56-1.25-1.25-1.25Z"
                            fill="#E8BA06"/>
                </svg>
            </a>
        </div>
    </div>
    <a href="<?php the_permalink(); ?>" class="brand-item d-md-none">
        <div class="brand-item__img">
			<?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'brands-list' ) ?>
            <p class="brand-item__rate">
                <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M4.29 18.339c-.46.235-.98-.177-.887-.703l.986-5.617L.205 8.033c-.39-.372-.187-1.054.337-1.128l5.816-.826L8.95.94a.61.61 0 0 1 1.101 0l2.594 5.139 5.816.826c.524.074.727.756.335 1.128l-4.182 3.986.985 5.617c.093.526-.427.938-.886.703L9.5 15.659l-5.212 2.68h.001Z"
                            fill="#fff"/>
                </svg>
                <span><?php echo_formatted_rating( $brand_rating ); ?></span>
            </p>
        </div>
        <div class="brand-item__info">
            <h3 class="brand-item__info-title"><?php echo $title; ?></h3>
            <p class="brand-item__info-text"><?php echo $excerpt; ?></p>
			<?php if ( isset( $terms_list ) ): ?>
                <p class="brand-item__info-category"><?php echo $terms_list ?></p>
			<?php endif; ?>
        </div>
    </a>
<?php endif; ?>