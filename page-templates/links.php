<?php
/*
Template Name: Посилання
Template Post Type: page
*/
get_header();
get_template_part( 'template-parts/breadcrumbs' );
?>

    <section class="useful-links-content">
        <div class="container">
            <h1><?php the_title(); ?></h1>

			<?php if ( have_rows( 'useful_link' ) ): ?>

                <div class="row useful-links-content__links-wrapper">

					<?php while ( have_rows( 'useful_link' ) ) : the_row(); ?>

                        <div class="link-box">
                            <div class="link-box__img">

								<?php $image = get_sub_field( 'image' );
								if ( ! empty( $image ) ): ?>
                                    <img src="<?php echo esc_url( $image['url'] ); ?>"
                                         alt="<?php echo esc_attr( $image['alt'] ); ?>"/>
								<?php endif; ?>

                            </div>
                            <div class="link-box__info">
                                <h2><?= get_sub_field( 'zagolovok' ) ? get_sub_field( 'zagolovok' ) : ''; ?></h2>
                                <p><?= get_sub_field( 'kratkoe_opysanye' ) ? get_sub_field( 'kratkoe_opysanye' ) : ''; ?></p>
                            </div>
                            <a class="link-box__nav btn btn--primary"
                               href="<?php echo get_sub_field( 'url_link' ) ? get_sub_field( 'url_link' ) : ''; ?>">
								<?php _e( 'Find out more', 'krop' ); ?>
                                <svg width="21" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.936 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.12-2.5 2.5-2.5 1.378 0 2.5 1.121 2.5 2.5s-1.122 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM10.218 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5s2.5 1.121 2.5 2.5-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25.689 0 1.25-.561 1.25-1.25 0-.69-.561-1.25-1.25-1.25ZM2.5 12.718a2.502 2.502 0 0 1-2.5-2.5c0-1.379 1.121-2.5 2.5-2.5S5 8.839 5 10.218s-1.121 2.5-2.5 2.5Zm0-3.75c-.69 0-1.25.56-1.25 1.25 0 .689.56 1.25 1.25 1.25s1.25-.561 1.25-1.25c0-.69-.56-1.25-1.25-1.25Z"
                                          fill="#fff"/>
                                </svg>
                            </a>
                        </div>

					<?php endwhile; ?>

                </div>

			<?php endif; ?>

        </div>
    </section>

<?php if ( get_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ) ): ?>
    <div class="container">
        <div class="text-bottom divider">
			<?php the_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ); ?>
        </div>
    </div>
<?php
endif; ?>

<?php get_footer();