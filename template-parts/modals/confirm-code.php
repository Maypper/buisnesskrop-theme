<div class="modal personal__modal personal__modal__padding-small add-brand__modal" data-modal="modal-confirm-code">
    <div class="d-md-flex d-block align-items-center">
        <div class="personal__modal__icon-title">
            <svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.3333 4.66656H22.6667V3.33319C22.6667 1.8625 21.4708 0.666504 20 0.666504H12C10.5293 0.666504 9.33331 1.86244 9.33331 3.33319V4.6665H2.66669C1.19594 4.66656 0 5.8625 0 7.33319V24.6665C0 26.1372 1.19594 27.3332 2.66669 27.3332H29.3334C30.8041 27.3332 32.0001 26.1372 32.0001 24.6665V7.33319C32 5.8625 30.8041 4.66656 29.3333 4.66656ZM10.6667 3.33319C10.6667 2.59819 11.265 1.99988 12 1.99988H20C20.735 1.99988 21.3333 2.59819 21.3333 3.33319V4.6665H10.6667V3.33319ZM30.6667 24.6665C30.6667 25.4015 30.0684 25.9999 29.3334 25.9999H2.66669C1.93169 25.9999 1.33337 25.4015 1.33337 24.6665V14.9624C1.72719 15.192 2.17881 15.3332 2.66669 15.3332H13.3334V17.3332C13.3334 17.7017 13.6316 17.9999 14.0001 17.9999H18.0001C18.3686 17.9999 18.6667 17.7017 18.6667 17.3332V15.3332H29.3334C29.8213 15.3332 30.273 15.1921 30.6667 14.9624V24.6665H30.6667ZM14.6667 16.6666V13.9999H17.3334V16.6666H14.6667ZM30.6667 12.6666C30.6667 13.4016 30.0684 13.9999 29.3334 13.9999H18.6667V13.3332C18.6667 12.9647 18.3685 12.6665 18 12.6665H14C13.6315 12.6665 13.3333 12.9647 13.3333 13.3332V13.9999H2.66669C1.93169 13.9999 1.33337 13.4016 1.33337 12.6666V7.33325C1.33337 6.59825 1.93169 5.99994 2.66669 5.99994H29.3334C30.0684 5.99994 30.6667 6.59825 30.6667 7.33325V12.6666Z"
                      fill="#E8BA06"></path>
            </svg>
        </div>
        <div class="personal__modal__title">
            <span class="modal_confirm_code_email modal_confirm_code" <?php echo (isset($args['type']) && $args['type'] === 'email') ? '' : 'style="display: none"'; ?>>
                <?php _e( 'Email confirmation', 'krop' ); ?>
            </span>
            <span class="modal_confirm_code_phone modal_confirm_code" <?php echo (isset($args['type']) && $args['type'] === 'phone') ? '' : 'style="display: none"'; ?>>
                <?php _e( 'Phone number confirmation', 'krop' ); ?>
            </span>
        </div>
    </div>
    <div class="personal__modal__text personal__modal__text__margin">
    <span class="modal_confirm_code_email modal_confirm_code" <?php echo (isset($args['type']) && $args['type'] === 'email') ? '' : 'style="display: none"'; ?> >
        <?php _e( 'We sent confirmation code to your email. Put them into field below', 'krop' ); ?>
    </span>
        <span class="modal_confirm_code_phone modal_confirm_code" <?php echo (isset($args['type']) && $args['type'] === 'phone') ? '' : 'style="display: none"'; ?>>
        <?php _e( 'We sent confirmation code to your phone. Put them into field below', 'krop' ); ?>
    </span>
        <input type="hidden" name="login" value="<?php echo wp_get_current_user() ? wp_get_current_user()->user_login : ''; ?>">
        <input type="hidden" name="login_type" value="<?php echo isset($args['type']) ? $args['type'] : ''; ?>">
        <input type="hidden" name="user_password_2" value="">
        <input type="text" class="login__form__input mt-3" id="code" name="code" autocomplete="one-time-code"
               placeholder="<?php _e( '6-symbols code', 'krop' ); ?>">
        <div class="login__form__input-error expired_key" aria-hidden="true">
		    <?php _e( 'Code expired. Reload page and try again', 'krop' ); ?>
        </div>
        <div class="login__form__input-error invalid_key" aria-hidden="true">
		    <?php _e( 'Code invalid. Check them try again', 'krop' ); ?>
        </div>
    </div>
    <div class="d-md-flex d-block">
        <button type="button" id="submit_check_code"
                class="personal__modal__btn personal__modal__btn__big text-white mr-0">
			<?php _e( 'Confirm', 'krop' ); ?>
        </button>
    </div>
</div>