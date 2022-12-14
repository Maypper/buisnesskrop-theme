<?php
global $current_link;
?>
<div class="modal personal__modal" data-modal="personal-modal-deactivate">
    <div class="personal__modal__title"><?php _e( 'Do you really want to deactivate the brand/business?', 'krop' ); ?></div>
    <div class="personal__modal__text"><?php _e( 'Once a brand/business is deactivated, it will not be available in the brand/business directory, search engine, or map. The statistics for this brand/business will also not be updated, but you will be able to edit the information.', 'krop' ); ?></div>
    <div class="d-md-flex d-block">
        <button class="personal__modal__btn personal__modal__btn__cancel js-modal-close"><?php _e( 'Cancel deactivation', 'krop' ); ?></button>
        <a href="#"
           class="personal__modal__btn personal__modal__btn__apply text-white"><?php _e( 'Deactivate brand/business', 'krop' ); ?></a>
    </div>
</div>