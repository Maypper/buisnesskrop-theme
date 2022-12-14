<div class="modal personal__modal personal__modal__padding-small" data-modal="modal-alert-reload">
    <div class="d-md-flex d-block align-items-center">
        <h2 class="personal__modal__title mb-0"><?php _e( 'Oops, an error occurred!', 'krop' ); ?></h2>
    </div>
    <p class="personal__modal__text personal__modal__text__margin"><?php _e( 'Please reload the page and try again', 'krop' ); ?></p>
    <div class="d-md-flex d-block">
        <a href="<?php the_permalink(); ?>" class="personal__modal__btn personal__modal__btn__big btn--primary mr-0">
			<?php _e( 'Reload', 'krop' ); ?>
        </a>
    </div>
</div>