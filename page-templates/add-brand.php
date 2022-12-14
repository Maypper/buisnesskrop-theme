<?php
/*
Template Name: Додати бренд/бізнес
Template Post Type: page
*/
get_header();
get_template_part( 'template-parts/breadcrumbs' );

?>
    <div class="add-brand edit-brand">
        <div class="container">
            <div class="d-lg-flex d-block justify-content-between align-items-center add-brand__title">
				<?php
				the_title( '<h1 class="text-left">', '</h1>' );
				if ( ! is_user_logged_in() ) {
					?>
                    <a href="<?php echo wp_login_url( home_url( '/add-brand/' ) ); ?>" class="add-brand__title__btn">
						<?php _e( 'I want to add my brand/business', 'krop' ); ?>
                        <svg class="icon" width="24" height="20" viewBox="0 0 24 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 3.00004H17V2.00001C17 0.896999 16.1031 0 15 0H9C7.89698 0 6.99998 0.896952 6.99998 2.00001V3H2.00002C0.896953 3.00004 0 3.897 0 5.00001V18C0 19.103 0.896953 20 2.00002 20H22C23.103 20 24 19.103 24 18V5.00001C24 3.897 23.103 3.00004 22 3.00004ZM8.00002 2.00001C8.00002 1.44876 8.44875 1.00003 9 1.00003H15C15.5513 1.00003 16 1.44876 16 2.00001V3H8.00002V2.00001ZM23 18C23 18.5513 22.5513 19 22 19H2.00002C1.44877 19 1.00003 18.5513 1.00003 18V10.7219C1.29539 10.8941 1.63411 11.0001 2.00002 11.0001H10V12.5001C10 12.7764 10.2237 13.0001 10.5 13.0001H13.5C13.7764 13.0001 14.0001 12.7764 14.0001 12.5001V11.0001H22.0001C22.366 11.0001 22.7048 10.8942 23.0001 10.7219V18H23ZM11 12V10H13V12H11ZM23 9.00004C23 9.55129 22.5513 10 22 10H14V9.50001C14 9.22363 13.7764 8.99999 13.5 8.99999H10.5C10.2236 8.99999 9.99998 9.22363 9.99998 9.50001V10H2.00002C1.44877 10 1.00003 9.55129 1.00003 9.00004V5.00006C1.00003 4.44881 1.44877 4.00008 2.00002 4.00008H22C22.5513 4.00008 23 4.44881 23 5.00006V9.00004Z"
                                  fill="#E8BA06"></path>
                        </svg>
                        <svg class="icon-hover" width="20" height="18" viewBox="0 0 20 18" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.3333 3.16703H14.1667V2.33367C14.1667 1.41449 13.4192 0.666992 12.5 0.666992H7.5C6.58082 0.666992 5.83332 1.41445 5.83332 2.33367V3.16699H1.66668C0.747461 3.16703 0 3.91449 0 4.83367V15.667C0 16.5862 0.747461 17.3337 1.66668 17.3337H18.3334C19.2525 17.3337 20 16.5862 20 15.667V4.83367C20 3.91449 19.2525 3.16703 18.3333 3.16703ZM6.66668 2.33367C6.66668 1.8743 7.04063 1.50035 7.5 1.50035H12.5C12.9594 1.50035 13.3333 1.8743 13.3333 2.33367V3.16699H6.66668V2.33367ZM19.1667 15.667C19.1667 16.1264 18.7927 16.5003 18.3334 16.5003H1.66668C1.2073 16.5003 0.833359 16.1264 0.833359 15.667V9.6019C1.07949 9.74542 1.36176 9.8337 1.66668 9.8337H8.33336V11.0837C8.33336 11.314 8.51973 11.5004 8.75004 11.5004H11.25C11.4804 11.5004 11.6667 11.314 11.6667 11.0837V9.8337H18.3334C18.6383 9.8337 18.9206 9.74546 19.1667 9.6019V15.667H19.1667ZM9.16668 10.667V9.00034H10.8334V10.667H9.16668ZM19.1667 8.16702C19.1667 8.6264 18.7927 9.00034 18.3334 9.00034H11.6667V8.58366C11.6667 8.35335 11.4803 8.16699 11.25 8.16699H8.75C8.51969 8.16699 8.33332 8.35335 8.33332 8.58366V9.00034H1.66668C1.2073 9.00034 0.833359 8.6264 0.833359 8.16702V4.83371C0.833359 4.37433 1.2073 4.00039 1.66668 4.00039H18.3334C18.7927 4.00039 19.1667 4.37433 19.1667 4.83371V8.16702Z"
                                  fill="white"></path>
                        </svg>
                    </a>
					<?php
				}
				?>
            </div>
            <div class="row overflow-hidden">
                <div class="col-12">
					<?php
					if ( is_user_logged_in() ) {
						$post_id = isset( $_GET['post_id'] ) ? absint( $_GET['post_id'] ) : false;
						get_template_part( 'template-parts/brand/add-registered', null, array( 'post_id' => $post_id ) );
					} else {
						get_template_part( 'template-parts/brand/add-unregistered' );
					}
					?>
                </div>
            </div>
        </div>
    </div>
<?php
get_template_part( 'template-parts/modals/add_brand_confirm' );
if ( is_user_logged_in() ) {
	get_template_part( 'template-parts/modals/files-uploading' );
}
get_template_part( 'template-parts/modals/overlay' );

get_footer();
