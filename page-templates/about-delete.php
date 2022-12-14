<?php
/*
Template Name: Про портал
Template Post Type: page
*/
get_header();
get_template_part( 'template-parts/breadcrumbs' );
?>

    <section class="about-content">
        <div class="container">
            <h1><?php the_title(); ?></h1>

			<?php
			$image = get_field( 'about_is_image' );
			if ( ! empty( $image ) ): ?>
                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"/>
			<?php endif; ?>
			<?php if ( get_field( 'aboyt_us_text' ) ) {
				the_field( 'aboyt_us_text' );
			} ?>
        </div>
    </section>

<?php if ( get_field( 'seo_tekst', 'options' ) ): ?>
    <div class="container">
        <div class="text-bottom divider">
			<?php the_field( 'seo_tekst', 'options' ); ?>
        </div>
    </div>
<?php endif; ?>


<?php get_footer();