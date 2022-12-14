<?php
/*
Template Name: Підтвердження електронної пошти
Template Post Type: page
*/
get_header();
get_template_part( 'template-parts/breadcrumbs' );
?>

    <div class="login__content">
        <div class="container--small mx-auto">
            <h1 class="text-center"><?php the_title(); ?></h1>
            <div class="confirm-password__text text-center">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
<?php get_footer();