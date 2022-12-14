<?php
/**
 * The template for displaying news
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Business Krop Online
 */

get_header( 'header-news' );
?>
    <div class="container">

		<?php krop_breadcrumb(); ?>

    </div>

    <section class="article-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
					<?php
					the_title( '<h1>', '</h1>' );
					get_template_part( '/template-parts/share' );
					the_content();
					get_template_part( '/template-parts/share', null, array( 'class' => 'divider' ) );
					get_template_part( '/template-parts/pagination-news' );
					//					get_template_part( '/template-parts/similar-news' );
					?>
                </div>
            </div>
        </div>
    </section>

<?php if ( get_field( splitter_lang_condition( array(
	'ukr' => 'seo_tekst',
	'eng' => 'seo_tekst_eng'
) ), 'options' ) ): ?>
    <div class="container">
        <div class="text-bottom divider">
			<?php the_field( splitter_lang_condition( array(
				'ukr' => 'seo_tekst',
				'eng' => 'seo_tekst_eng'
			) ), 'options' ); ?>
        </div>
    </div>
<?php
endif; ?>


<?php
get_footer();