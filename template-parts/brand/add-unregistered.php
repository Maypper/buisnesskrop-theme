<div class="add-brand__content add-brand__content__padding-big">
    <div class="add-brand__content__inform-block add-brand__content__inform-block__margin-big d-flex align-items-center">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path d="M20 6.6665C18.1616 6.6665 16.6666 8.16142 16.6666 9.99986C16.6666 11.8383 18.1616 13.3332 20 13.3332C21.8384 13.3332 23.3334 11.8383 23.3334 9.99986C23.3334 8.16142 21.8384 6.6665 20 6.6665ZM20 11.6665C19.0812 11.6665 18.3333 10.9186 18.3333 9.99986C18.3333 9.08111 19.0812 8.33322 20 8.33322C20.9187 8.33322 21.6666 9.08111 21.6666 9.99986C21.6666 10.9186 20.9187 11.6665 20 11.6665Z"
                  fill="#1B1B1B"></path>
            <path d="M22.5 15H15.8334C15.3727 15 15 15.3727 15 15.8334V19.1667C15 19.6273 15.3727 20.0001 15.8334 20.0001H16.6667V32.5001C16.6667 32.9607 17.0395 33.3334 17.5001 33.3334H22.5001C22.9607 33.3334 23.3334 32.9607 23.3334 32.5001V15.8334C23.3334 15.3727 22.9606 15 22.5 15ZM21.6666 31.6666H18.3333V19.1666C18.3333 18.706 17.9605 18.3333 17.4999 18.3333H16.6666V16.6666H21.6666V31.6666H21.6666Z"
                  fill="#1B1B1B"></path>
            <path d="M20 0C8.97219 0 0 8.97219 0 20C0 31.0278 8.97219 40 20 40C31.0278 40 40 31.0278 40 20C40 8.97219 31.0278 0 20 0ZM20 38.3334C9.89094 38.3334 1.66664 30.1091 1.66664 20C1.66664 9.89094 9.89094 1.66664 20 1.66664C30.1091 1.66664 38.3334 9.89094 38.3334 20C38.3334 30.1091 30.1091 38.3334 20 38.3334Z"
                  fill="#1B1B1B"></path>
        </svg>
        <div class="add-brand__content__inform-block__text">
            <span>
                <?php _e( 'Below you can fill in the information you need to enter a brand/business on the portal.', 'krop' ); ?>
                <br><br class="d-md-none d-inline-block">
                <?php _e( 'You are not a registered user, so you cannot edit the information provided after adding it.', 'krop' ); ?>
                <br><br class="d-md-none d-inline-block">
                <?php _e( 'Are you a brand/business owner? Click the button above to go to the personal account registration.', 'krop' ); ?>
            </span>
        </div>
    </div>
    <div class="add-brand__form">
        <form method="post" id="profile_form">
            <div class="add-brand__form__text"><?php _e( 'Full official name of the brand/business', 'krop' ); ?></div>
            <input type="text" class="add-brand__form__input mobile-placeholder"
                   name="post_title" required
                   data-moblile-placeholder-text="<?php _e( 'Boutique', 'krop' ); ?>"
                   data-default-placeholder-text="<?php _e( 'For example: Shop sewing workshop “Boutique”', 'krop' ); ?>"
                   placeholder="<?php _e( 'For example: Shop sewing workshop “Boutique”', 'krop' ); ?>">
            <div class="login__form__input-error post_title" aria-hidden="true">
				<?php _e( 'Please fill this information', 'krop' ); ?>
            </div>
            <div class="add-brand__form__text"><?php _e( 'Brand/business address', 'krop' ); ?></div>
            <input type="text" class="add-brand__form__input mobile-placeholder"
                   name="location" required
                   data-moblile-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                   data-default-placeholder-text="<?php _e( 'For example: Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                   placeholder="<?php _e( 'For example: Kropyvnytskyi, street Name 123', 'krop' ); ?>">
            <div class="login__form__input-error location" aria-hidden="true">
				<?php _e( 'Please fill this information', 'krop' ); ?>
            </div>
            <div class="d-flex flex-md-column flex-column-reverse">
                <div class="d-block">
                    <div class="add-brand__form__text"><?php _e( 'Short description or comment on the brand/business (max. 3000 characters)', 'krop' ); ?></div>
                    <textarea name="post_content" class="add-brand__form__textarea" cols="30"
                              rows="10" maxlength="3000" required
                              placeholder="<?php _e( 'For example: some example of information to fill', 'krop' ); ?>"></textarea>
                    <div class="login__form__input-error post_content" aria-hidden="true">
						<?php _e( 'Please fill this information', 'krop' ); ?>
                    </div>
                </div>
                <div class="d-md-flex d-block">
                    <div class="d-block w-100 add-brand__form__text-input">
                        <div class="add-brand__form__text"><?php _e( 'Brand/business phone', 'krop' ); ?></div>
                        <input name="phone_number" type="tel" required
                               class="add-brand__form__input add-brand__form__input__small invalid_phone_number"
                               placeholder="<?php _e( 'For example +380501234567', 'krop' ); ?>"
                               pattern="(?:^\+)?(?:[0-9] ?){6,14}[0-9]$">
                        <div class="login__form__input-error invalid_phone_number" aria-hidden="true">
							<?php _e( 'Invalid phone number', 'krop' ); ?>
                        </div>
                    </div>
                    <div class="d-block w-100">
                        <div class="add-brand__form__text"><?php _e( 'Your phone', 'krop' ); ?></div>
                        <input name="user_number" type="tel" required
                               class="add-brand__form__input add-brand__form__input__small invalid_user_number"
                               placeholder="<?php _e( 'For example +380501234567', 'krop' ); ?>"
                               pattern="(?:^\+)?(?:[0-9] ?){6,14}[0-9]$">
                        <div class="login__form__input-error invalid_user_number" aria-hidden="true">
							<?php _e( 'Invalid phone number', 'krop' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-brand__form__checkbox add-brand__form__border-bottom checkbox">
                <input name="confirm-data-processing" class="custom-checkbox confirm-data-processing" type="checkbox"
                       id="confirm-data-processing" value="true" required>
                <label for="confirm-data-processing"><?php _e( 'I agree to the processing of data', 'krop' ); ?></label>
                <div class="login__form__input-error confirm-data-processing" aria-hidden="true">
					<?php _e( 'You must allow data processing', 'krop' ); ?>
                </div>
            </div>
            <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'add-business-unregistered' ); ?>">
            <input type="hidden" name="action" value="add_business_unregistered">
            <button type="submit"
                    class="btn btn--primary add-brand__form__btn"><?php _e( 'Submit brand/business', 'krop' ); ?>
                <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.3333 3.16703H14.1667V2.33367C14.1667 1.41449 13.4192 0.666992 12.5 0.666992H7.5C6.58082 0.666992 5.83332 1.41445 5.83332 2.33367V3.16699H1.66668C0.747461 3.16703 0 3.91449 0 4.83367V15.667C0 16.5862 0.747461 17.3337 1.66668 17.3337H18.3334C19.2525 17.3337 20 16.5862 20 15.667V4.83367C20 3.91449 19.2525 3.16703 18.3333 3.16703ZM6.66668 2.33367C6.66668 1.8743 7.04063 1.50035 7.5 1.50035H12.5C12.9594 1.50035 13.3333 1.8743 13.3333 2.33367V3.16699H6.66668V2.33367ZM19.1667 15.667C19.1667 16.1264 18.7927 16.5003 18.3334 16.5003H1.66668C1.2073 16.5003 0.833359 16.1264 0.833359 15.667V9.6019C1.07949 9.74542 1.36176 9.8337 1.66668 9.8337H8.33336V11.0837C8.33336 11.314 8.51973 11.5004 8.75004 11.5004H11.25C11.4804 11.5004 11.6667 11.314 11.6667 11.0837V9.8337H18.3334C18.6383 9.8337 18.9206 9.74546 19.1667 9.6019V15.667H19.1667ZM9.16668 10.667V9.00034H10.8334V10.667H9.16668ZM19.1667 8.16702C19.1667 8.6264 18.7927 9.00034 18.3334 9.00034H11.6667V8.58366C11.6667 8.35335 11.4803 8.16699 11.25 8.16699H8.75C8.51969 8.16699 8.33332 8.35335 8.33332 8.58366V9.00034H1.66668C1.2073 9.00034 0.833359 8.6264 0.833359 8.16702V4.83371C0.833359 4.37433 1.2073 4.00039 1.66668 4.00039H18.3334C18.7927 4.00039 19.1667 4.37433 19.1667 4.83371V8.16702Z"
                          fill="white"></path>
                </svg>
            </button>
        </form>
    </div>
</div>