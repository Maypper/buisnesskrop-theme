<?php
get_header();
get_template_part( 'template-parts/breadcrumbs' );
global $post;
$places_title = get_field( 'places_title', 'options' );
$places_text  = get_field( 'places_text', 'options' );
?>
    <section class="interesting-places-content">

        <div class="container">
            <div class="row interesting-places-content__info">
                <div class="col-12">
                    <h1><?php _e( 'Interesting places to visit', 'krop' ); ?></h1>
                </div>
            </div>
        </div>
		<?php

		$paged       = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		$places_args = array(
			'post_type'      => 'places',
			'posts_per_page' => 9,
			'post_status'    => 'publish',
			'orderby'        => 'data',
			'paged'          => $paged,
		);
		$places      = new WP_Query( $places_args );
		if ( $places->have_posts() ):
			?>
            <div class="container">
                <div class="places-box-wrapper">
                    <div class="row places-box-wrapper__links-wrapper">
						<?php
						while ( $places->have_posts() ):
							$places->the_post();
							get_template_part( 'template-parts/single-items/item', 'place' );
						endwhile;
						?>
                    </div>
                </div>
            </div>
		<?php
		endif;
		?>
        <div class="container interesting-places-content">
			<?php crop_blog_pagination( $places ); ?>
        </div>
		<?php
		get_template_part( 'template-parts/blocks/map' );
		?>
    </section>
    <div class="container">
		<?php
		if ( $places_title ) {
			echo '<h2>' . $places_title . '</h2>';
		}
		if ( $places_text ) {
			echo $places_text;
		} ?>
    </div>
<?php if ( get_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ) ): ?>
    <div class="container">
        <div class="text-bottom divider">
			<?php the_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ); ?>
        </div>
    </div>
<?php
endif;
get_footer();