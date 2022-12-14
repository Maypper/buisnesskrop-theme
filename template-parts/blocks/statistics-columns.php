<?php
$title = get_field( 'title' );
?>
<div class="statistics">
    <div class="container">
		<?php if ( $title ): ?>
            <h2 class="statistics__title"><?php echo $title; ?></h2>
		<?php
		endif;
		if ( have_rows( 'post_types' ) ):
			?>
            <ul class="statistics__list">
				<?php
				while ( have_rows( 'post_types' ) ):
					the_row();
					$post_type  = get_sub_field( 'post_type' );
					$sub_title  = get_sub_field( 'sub_title' );
					$link       = get_sub_field( 'link' );
					?>
                    <li class="statistics__item">
                        <h3 class="statistics__item-title"><?php echo $post_type; ?></h3>
						<?php if ( $sub_title ): ?>
                            <p class="statistics__item-text"><?php echo $sub_title; ?></p>
						<?php
						endif;
						if ( $link ):
							?>
                            <a class="statistics__link" href="<?php echo $link['url']; ?>"
                               target="<?php echo $link['target']; ?>">
                                <span><?php echo $link['title']; ?></span>
                                <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m13 19 7-7-7-7M20 12H4" stroke="#E8BA06" stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </a>
						<?php endif; ?>
                    </li>
				<?php endwhile; ?>
            </ul>
		<?php endif; ?>
    </div>
</div>
