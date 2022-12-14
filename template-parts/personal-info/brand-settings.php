<?php
global $post;
$current_link = get_permalink( $post );
$args         = array(
	'post_type'   => 'brands',
	'author'      => get_current_user_id(),
	'post_status' => array( 'pending', 'deactivated', 'rejected', 'publish', 'draft' ),
    'orderby'     => 'date',
    'nopaging'    => true,
);
$brands_query = new WP_Query( $args );
if ( $brands_query->have_posts() ) {
	while ( $brands_query->have_posts() ) {
		$brands_query->the_post();
		?>
        <div class="personal__content__item">
            <div class="row mx-auto">
                <div class="personal__content__item__img col-2">
					<?php the_post_thumbnail( 'brands-settings-thumbnail' ); ?>
                </div>
				<?php get_template_part( 'template-parts/personal-info/parts/brand-info' ); ?>
            </div>
            <div class="row mx-auto personal__content__item__list-btn">
                <div class="col-md-2 col-0"></div>
                <div class="personal__content__item__list-btn__block col-md-10 col-12">
                    <a href="<?php echo ( $post->post_status === 'pending' || $post->post_status === 'draft' ) ? 'javascript:void(0)' : add_query_arg( array( 'post_id' => $post->ID ), home_url( splitter_lang_condition( array('ukr' => '/edit-brand/', 'eng' => '/eng/edit-brands/' ) ) ) ); ?>"
                       class="personal__content__item__link personal__content__item__link--active <?php echo ( $post->post_status === 'pending' || $post->post_status === 'draft' ) ? 'personal__content__item__link--disabled personal__content__item__link__tooltip' : ''; ?>"><?php _e( 'Edit', 'krop' );
						echo ( $post->post_status === 'pending' ) ? '<span class="tooltip-text">'.__('Editing is not available while the brand/business is under review', 'krop').'</span>' : ''; ?></a>
                    <button <?php echo in_array( $post->post_status, array(
//						'pending',
						'draft',
						'rejected'
					) ) ? 'disabled' : ''; ?>
                            data-link="<?php echo add_query_arg( array(
								'action'   => ( $post->post_status === 'deactivated' ) ? 'activate-post' : 'deactivate-post',
								'_wpnonce' => wp_create_nonce( ( $post->post_status === 'deactivated' ) ? 'activate-post' : 'deactivate-post' )
							), $current_link ); ?>"
                            data-post_id="<?php echo $post->ID ?>"
                            data-modal="personal-modal-<?php echo ( $post->post_status === 'deactivated' ) ? 'activate' : 'deactivate'; ?>"
                            class="js-open-modal personal__content__item__link personal__content__item__link--active <?php echo in_array( $post->post_status, array(
//								'pending',
								'draft',
								'rejected'
							) ) ? 'personal__content__item__link--disabled personal__content__item__link__tooltip' : ''; ?>">
						<?php echo ( $post->post_status === 'deactivated' ) ? __( 'Activate', 'krop' ) : __( 'Deactivate', 'krop' ); ?>
                    </button>
                    <button
                            data-link="<?php echo add_query_arg( array(
								'action'   => 'delete-post',
								'_wpnonce' => wp_create_nonce( 'delete-post' )
							), $current_link ); ?>"
                            data-post_id="<?php echo $post->ID ?>"
                            data-modal="personal-modal-delete"
                            class="js-open-modal personal__content__item__link personal__content__item__link--active">
						<?php _e( 'Delete', 'krop' ); ?>
                    </button>
                </div>
            </div>
        </div>
		<?php
	}
}
wp_reset_query();