<?php
/*
Template Name: Довідка
Template Post Type: page
*/
get_header();
get_template_part( 'template-parts/breadcrumbs' );
?>

    <section class="help-content">
        <div class="container">

            <h1><?php the_title(); ?></h1>
			<?php if ( have_rows( 'helps' ) ): ?>
				<?php while ( have_rows( 'helps' ) ) : the_row(); ?>

                    <h2><?= get_sub_field( 'question' ) ? get_sub_field( 'question' ) : ''; ?></h2>
                    <p><?= get_sub_field( 'answer' ) ? get_sub_field( 'answer' ) : ''; ?></p>

				<?php endwhile; ?>
			<?php endif; ?>
    </section>
<?php if ( get_field( 'seo_tekst', 'options' ) ): ?>

    <div class="container">
        <div class="text-bottom divider">
			<?php the_field( 'seo_tekst', 'options' ); ?>
        </div>
    </div>
<?php endif; ?>

<?php get_footer();