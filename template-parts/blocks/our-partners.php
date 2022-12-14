<?php
$title = get_field( 'title' );
?>
<div class="container our-partners">
	<?php if ( $title ): ?>
        <h2 class="our-partners__title"><?php echo $title; ?></h2>
	<?php
	endif;
	if ( have_rows( 'partners' ) ):
		?>
        <ul class="our-partners__list">
			<?php
			while ( have_rows( 'partners' ) ):
				the_row();
				$logo = get_sub_field( 'logo' );
				?>
                <li class="our-partners__item">
                    <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                </li>
			<?php endwhile; ?>
        </ul>
	<?php endif; ?>
</div>
