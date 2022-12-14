<div class="modal personal__modal" data-modal="personal-modal-exit">
    <div class="personal__modal__title"><?php _e( 'Do you really want to leave your personal account?', 'krop' ); ?></div>
    <div class="personal__modal__text"><?php _e( 'After leaving the personal account, you will need to log in again to re-add your own brands / businesses, edit information and view brand / business statistics.', 'krop' ); ?></div>
    <div class="d-md-flex d-block">
        <button class="personal__modal__btn personal__modal__btn__cancel js-modal-close"><?php _e( 'Cancel sign out', 'krop' ); ?></button>
        <a href="<?php echo wp_logout_url( home_url() ); ?>"
           class="personal__modal__btn personal__modal__btn__apply text-white"><?php _e( 'Sign out from personal account', 'krop' ); ?></a>
    </div>
</div>