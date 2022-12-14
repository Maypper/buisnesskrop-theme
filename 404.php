<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Business Krop Online
 */

get_header();
?>

    <div class="container-fluid page-not-found-content"
         style="background-image: url(<?php echo get_field( 'not_found_image', 'option' ) ? get_field( 'not_found_image', 'option' ) : ''; ?>)">
        <h1>404</h1>
        <h2><?php _e( 'Page not found', 'krop' ); ?></h2>
        <p><?php _e( 'Oh, something went wrong, we can\'t find the page you wanted to go to.', 'krop' ); ?></p>
        <a class="btn btn--primary" href="<?php echo home_url( '/' ); ?>">
			<?php _e( 'Back to home page', 'krop' ); ?>
            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M15.814 6.11 14 4.66V1.5a.5.5 0 0 0-.5-.5h-1.999a.5.5 0 0 0-.5.5v.76L8.313.11a.502.502 0 0 0-.624 0l-7.5 6A.5.5 0 0 0 .5 7H2v8.5a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5V7h1.5a.5.5 0 0 0 .313-.89ZM12 3V2h1v1.86L11.927 3h.074Zm-5 12v-4h2v4h-2Zm6.5-9a.5.5 0 0 0-.5.5V15h-3v-4.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V15h-3V6.5a.5.5 0 0 0-.5-.5h-.575l6.075-4.86L14.076 6H13.5Z"
                        fill="#fff"/>
            </svg>
        </a>
    </div>

<?php
get_footer();