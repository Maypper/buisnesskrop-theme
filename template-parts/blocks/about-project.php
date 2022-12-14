<?php
$image      = get_field( 'image' );
$title      = get_field( 'title' );
$paragraphs = get_field( 'paragraphs' );
$link       = get_field( 'link' );
?>
<div class="about-project" <?php if ( $image ) { ?>style="background-image: url('<?php echo $image; ?>')"<?php } ?>>
    <div class="container">
        <div class="about-project__wrapper">
			<?php if ( $title ): ?>
                <h2 class="about-project__title"><?php echo $title; ?></h2>
			<?php
			endif;
			if ( $paragraphs ):
				?>
                <div class="about-project__text">
					<?php echo $paragraphs; ?>
                </div>
			<?php
			endif;
			if ( $link ):
				?>
                <a class="about-project__btn btn btn--secondary" href="<?php echo $link['url']; ?>"
                   target="<?php echo $link['target']; ?>">
					<?php echo $link['title']; ?>
                    <svg width="21" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M17.936 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.12-2.5 2.5-2.5 1.378 0 2.5 1.121 2.5 2.5s-1.122 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM10.218 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5s2.5 1.121 2.5 2.5-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM2.5 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5S5 8.839 5 10.218s-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25s1.25-.561 1.25-1.25c0-.69-.56-1.25-1.25-1.25Z"
                                fill="#E8BA06"/>
                    </svg>
                </a>
			<?php endif; ?>
        </div>
    </div>
</div>
