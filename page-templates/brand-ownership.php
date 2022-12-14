<?php
/*
Template Name: Право власності бренду
Template Post Type: page
*/
get_header();
get_template_part( 'template-parts/breadcrumbs' );

?>
    <div class="edit-brand">
        <div class="container">
            <div class="d-lg-flex d-block justify-content-between align-items-center add-brand__title">
				<?php the_title( '<h1 class="text-left">', '</h1>' ); ?>
            </div>
            <div class="row overflow-hidden">
                <div class="col-12">
					<?php
					$post_id = isset( $_GET['post_id'] ) ? absint( $_GET['post_id'] ) : false;
					get_template_part( 'template-parts/brand/ownership', null, array( 'post_id' => $post_id ) );
					?>
                </div>
            </div>
        </div>
    </div>
<?php

get_template_part( 'template-parts/modals/brand-ownership-send' );
get_template_part( 'template-parts/modals/overlay' );

get_footer();