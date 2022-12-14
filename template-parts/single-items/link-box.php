<?php
global $post;
$url = get_field( 'external_url' );
if ( ! $url ) {
	$url = get_the_permalink();
}
?>
<div class="link-box">
    <div class="link-box__img">
		<?php the_post_thumbnail( 'medium' ); ?>
    </div>
    <div class="link-box__info">
        <h2><?php echo splitter_trim_symbols( html_entity_decode( get_the_title() ), 40 ); ?></h2>
        <p><?php echo splitter_trim_symbols( html_entity_decode( get_the_excerpt() ), 80 ); ?></p>
    </div>
    <a class="link-box__nav btn btn--primary" target="_blank" href="<?php echo $url; ?>">
	    <?php _e('Learn more', 'krop'); ?>
        <svg width="21" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.936 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.12-2.5 2.5-2.5 1.378 0 2.5 1.121 2.5 2.5s-1.122 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM10.218 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5s2.5 1.121 2.5 2.5-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM2.5 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5S5 8.839 5 10.218s-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25s1.25-.561 1.25-1.25c0-.69-.56-1.25-1.25-1.25Z"
                  fill="#fff"></path>
        </svg>
    </a>
</div>