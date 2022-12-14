<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Business Krop Online
 */

get_header();

while ( have_posts() ) {
	the_post();
	the_content();
}
if ( get_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ) ): ?>
    <div class="container">
        <div class="text-bottom divider">
			<?php the_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ); ?>
        </div>
    </div>
<?php
endif;
get_footer();