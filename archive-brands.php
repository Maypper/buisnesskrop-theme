<?php
get_header();
get_template_part( 'template-parts/breadcrumbs' );
?>
    <section class="catalog-content">
        <div class="container">
            <h1><?php _e( 'Catalog of brands/businesses', 'krop' ); ?></h1>

            <div class="catalog-content__search">
                <div class="search-block">
	                <?php get_template_part( 'template-parts/search/search-block-content' ); ?>
                </div>
            </div>
        </div>

		<?php get_template_part( 'template-parts/blocks/map' ); ?>

        <div class="container">
			<?php
			$paged       = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$brands_args = array(
				'post_type'      => 'brands',
				'posts_per_page' => 10,
				'post_status'    => 'publish',
				'orderby'        => 'data',
				'paged'          => $paged,
			);
			$brands      = new WP_Query( $brands_args );
			if ( $brands->have_posts() ):
				?>
                <div class="catalog-content__brands">
					<?php
					while ( $brands->have_posts() ):
						$brands->the_post();
						get_template_part( 'template-parts/single-items/item', 'brand' );
					endwhile; ?>
                </div>
			<?php endif; ?>
        </div>
        <div class="container">
			<?php crop_blog_pagination( $brands ); ?>
        </div>
    </section>
<?php
get_footer();