<div class="edit-brand__add-address hidden">
    <div class="add-brand__form__text"><?php _e( 'Actual brand/business address', 'krop' ); ?></div>

    <input name="location[]" required type="text" class="add-brand__form__input mobile-placeholder"
           data-moblile-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
           data-tablet-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
           data-default-placeholder-text="<?php _e( 'For example: Kropyvnytskyi, street Name 123', 'krop' ); ?>"
           placeholder="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>">
    <div class="login__form__input-error location[]" aria-hidden="true">
		<?php _e( 'Please fill this information', 'krop' ); ?>
    </div>
</div>