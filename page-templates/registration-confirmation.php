<?php
/*
Template Name: Реєстрація у особистий кабінет (підтвердження)
Template Post Type: page
*/
get_header();
get_template_part( 'template-parts/breadcrumbs' );
?>

    <div class="login__content">
        <div class="container--small mx-auto">
            <h1 class="text-center"><?php the_title(); ?></h1>

			<?php
			if ( have_rows( 'text_registr_comfirm' ) ):
				while ( have_rows( 'text_registr_comfirm' ) ) : the_row();
					?>
                    <div class="confirm-password__text text-center">
						<?= get_sub_field( 'paragraph' ); ?>
                    </div>
				<?php
				endwhile;
			endif; ?>

            <a href="<?php echo esc_url( splitter_lang_condition( array(
					'ukr' => home_url( '/edit-account/' ),
					'eng' => home_url( '/eng/personal-account/' )
				)
			) ); ?>"
               class="btn btn--primary login__form__btn recovery__btn confirm-password__btn d-flex mx-auto"><?php _e( 'Go to account', 'krop' ); ?>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M10 0C4.48609 0 0 4.48609 0 10C0 15.5139 4.48609 20 10 20C15.5139 20 20 15.5139 20 10C20 4.48609 15.5139 0 10 0ZM10 1.25001C14.8248 1.25001 18.75 5.17519 18.75 10C18.75 12.0101 18.0617 13.8583 16.918 15.3373C12.5311 13.2611 7.46884 13.2611 3.082 15.3373C1.93827 13.8583 1.25001 12.0101 1.25001 10C1.25001 5.17519 5.17519 1.25001 10 1.25001ZM3.95881 16.3145C7.81518 14.6064 12.1848 14.6064 16.0412 16.3145C14.469 17.8193 12.343 18.7501 10 18.7501C7.657 18.7501 5.531 17.8192 3.95881 16.3145Z"
                            fill="white"/>
                    <path
                            d="M10 12.5C12.0679 12.5 13.75 10.8179 13.75 8.75C13.75 6.6821 12.0679 5 10 5C7.93214 5 6.25 6.6821 6.25 8.75C6.25 10.8179 7.93214 12.5 10 12.5ZM10 6.25001C11.3788 6.25001 12.5 7.37123 12.5 8.75C12.5 10.1288 11.3788 11.25 10 11.25C8.6212 11.25 7.50001 10.1288 7.50001 8.75C7.50001 7.37123 8.62124 6.25001 10 6.25001Z"
                            fill="white"/>
                </svg>
            </a>
        </div>
    </div>
<?php get_footer();