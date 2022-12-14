<?php
$object  = $args['object'] ?? null;
$post_id = $args['post_id'] ?? false;
?>
<div class="add-object <?php echo $object ? 'visible' : 'hidden'; ?>" id="findme">
    <div class="add-object__head d-flex justify-content-between align-items-center">
        <h3><?php _e( 'Object #', 'krop' ); ?><span class="object-number"></span></h3>
        <p class="delete-object"><?php _e( 'Delete object', 'krop' ); ?></p>
    </div>
    <div class="add-brand__form__text"><?php _e( 'Name of the object of network trade (restaurants, pharmacies, etc.)', 'krop' ); ?>
    </div>
    <input name="object_title[]" type="text" required
           class="add-brand__form__input add-brand__form__input  mobile-placeholder"
           data-moblile-placeholder-text="<?php _e( '“Workshop”', 'krop' ); ?>"
           data-default-placeholder-text="<?php _e( 'For example: Head Office “Workshop”', 'krop' ); ?>"
		<?php echo isset( $object['object_title'] ) ? 'value="' . $object['object_title'] . '"' : '' ?>>
    <div class="login__form__input-error object_title" aria-hidden="true">
		<?php _e( 'Please fill this information', 'krop' ); ?>
    </div>
    <div class="add-brand__form__text"><?php _e( 'Location of the object', 'krop' ); ?></div>
    <input name="object_address[]" required type="text"
           class="add-brand__form__input add-brand__form__input mobile-placeholder"
           data-moblile-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
           data-default-placeholder-text="<?php _e( 'For example: Kropyvnytskyi, street Name 123', 'krop' ); ?>"
		<?php echo isset( $object['object_address'] ) ? 'value="' . $object['object_address'] . '"' : '' ?>>
    <div class="login__form__input-error object_address" aria-hidden="true">
		<?php _e( 'Please fill this information', 'krop' ); ?>
    </div>
    <div class="d-md-flex d-block">
        <div class="d-block w-100 add-brand__form__text-input new-hours-block">
            <div class="add-brand__form__text"><?php _e( 'Hours of work', 'krop' ); ?></div>
            <div class="custom-select custom-select-single work-hours no-chips"></div>
            <div class="login__form__input-error object_works_hours" aria-hidden="true">
				<?php _e( 'Please fill this information', 'krop' ); ?>
            </div>
            <input type="hidden" name="object_custom_works_hours[]"
                   class="hours-to-backend single-item" <?php echo isset( $object['object_custom_works_hours'] ) ? 'value="' . implode( ', ', $object['object_custom_works_hours'] ) . '"' : '' ?>>
        </div>
        <div class="d-block w-100">
            <div class="add-brand__form__text"><?php _e( 'Working days', 'krop' ); ?></div>
            <div class="custom-select custom-select-single work-days no-chips"></div>
            <div class="login__form__input-error object_works_days" aria-hidden="true">
				<?php _e( 'Please fill this information', 'krop' ); ?>
            </div>
            <input type="hidden" name="object_custom_works_days[]"
                   class="days-to-backend multi-item" <?php echo isset( $object['object_custom_works_days'] ) ? 'value="' . implode( ', ', $object['object_custom_works_days'] ) . '"' : '' ?>>
        </div>
    </div>
    <div class="d-md-flex d-block">
        <div class="d-block w-100 add-brand__form__text-input">
            <div class="add-brand__form__text"><?php _e( 'Phone number', 'krop' ); ?></div>
            <input type="number" required name="object_phone_number[]"
                   class="add-brand__form__input add-brand__form__input__small"
                   placeholder="<?php _e( 'For example +380501234567', 'krop' ); ?>"
				<?php echo isset( $object['object_phone_number'] ) ? 'value="' . $object['object_phone_number'] . '"' : '' ?>>
            <div class="login__form__input-error object_phone_number" aria-hidden="true">
				<?php _e( 'Invalid phone number', 'krop' ); ?>
            </div>
        </div>
        <div class="d-block w-100">
            <div class="add-brand__form__text"><?php _e( 'Special notes', 'krop' ); ?></div>
            <div class="checkbox">
                <input class="custom-checkbox" type="checkbox" name="object_a11y[]" id="cripple-label-2"
                       value="true" <?php echo ( isset( $object['object_a11y'] ) && $object['object_a11y'] ) ? 'checked' : '' ?>>
                <label for="cripple-label-2"><?php _e( 'Accessible for people with disabilities', 'krop' ); ?></label>
            </div>
        </div>
    </div>
    <div class="modal new-days__modal add-brand__modal" data-modal="modal-category">
        <div class="category__head d-flex justify-content-between w-100">
            <div class="category__title">
				<?php _e( 'Choose your days of the week:', 'krop' ); ?>
            </div>
            <a class="days__close-modal">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M10.2435 10.2426L6.00091 6M6.00091 6L1.75827 1.75736M6.00091 6L10.2435 1.75736M6.00091 6L1.75827 10.2426"
                            stroke="#E8BA06" fill="#E8BA06" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>
        </div>
        <div class="row category__list">
            <div class="category__item">
                <label class="checkbox">
                    <input type="checkbox" name=monday"><?php _e( 'Monday', 'krop' ); ?></label>
            </div>
            <div class="category__item">
                <label class="checkbox">
                    <input type="checkbox" name="tuesday"><?php _e( 'Tuesday', 'krop' ); ?></label>
            </div>
            <div class="category__item">
                <label class="checkbox">
                    <input type="checkbox" name="wednesday"><?php _e( 'Wednesday', 'krop' ); ?>
                </label>
            </div>
            <div class="category__item">
                <label class="checkbox">
                    <input type="checkbox" name="thursday"><?php _e( 'Thursday', 'krop' ); ?>
                </label>
            </div>
            <div class="category__item">
                <label class="checkbox">
                    <input type="checkbox" name="friday"><?php _e( 'Friday', 'krop' ); ?></label>
            </div>
            <div class="category__item">
                <label class="checkbox">
                    <input type="checkbox" name="saturday"><?php _e( 'Saturday', 'krop' ); ?>
                </label>
            </div>
            <div class="category__item">
                <label class="checkbox">
                    <input type="checkbox" name="sunday"><?php _e( 'Sunday', 'krop' ); ?></label>
            </div>
        </div>
        <button type="button" class="category__button-submit btn btn--primary">
			<?php _e( 'Confirm', 'krop' ); ?>
            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M13.8333 1.66668H12.0899C11.9173 1.18273 11.4591 0.833359 10.9166 0.833359H9.65809C9.26668 0.314141 8.65145 0 8 0C7.34855 0 6.73332 0.314141 6.34188 0.83332H5.08332C4.54082 0.83332 4.08266 1.1827 3.91008 1.66664H2.16668C1.24746 1.66668 0.5 2.41414 0.5 3.33332V18.3333C0.5 19.2525 1.24746 20 2.16668 20H13.8334C14.7525 20 15.5 19.2525 15.5 18.3333V3.33332C15.5 2.41414 14.7525 1.66668 13.8333 1.66668ZM4.66668 2.08332C4.66668 1.85344 4.85344 1.66664 5.08336 1.66664H6.56449C6.71262 1.66664 6.84973 1.5877 6.92461 1.45953C7.15289 1.06727 7.55488 0.83332 8.00004 0.83332C8.4452 0.83332 8.84723 1.0673 9.07547 1.45953C9.15035 1.5877 9.28746 1.66664 9.43559 1.66664H10.9167C11.1466 1.66664 11.3334 1.8534 11.3334 2.08332V2.5C11.3334 2.95937 10.9595 3.33332 10.5001 3.33332H5.5C5.04063 3.33332 4.66668 2.95937 4.66668 2.5V2.08332ZM14.6667 18.3333C14.6667 18.7927 14.2927 19.1666 13.8334 19.1666H2.16668C1.7073 19.1666 1.33336 18.7927 1.33336 18.3333V3.33332C1.33336 2.87395 1.7073 2.5 2.16668 2.5H3.83336C3.83336 3.41918 4.58082 4.16668 5.50004 4.16668H10.5C11.4192 4.16668 12.1667 3.41922 12.1667 2.5H13.8334C14.2928 2.5 14.6667 2.87395 14.6667 3.33332V18.3333H14.6667Z"
                        fill="white"/>
                <path
                        d="M11.7507 9.1665H4.25067C4.02035 9.1665 3.83398 9.35287 3.83398 9.58319C3.83398 9.81351 4.02035 9.99988 4.25067 9.99988H11.7507C11.981 9.99988 12.1674 9.81351 12.1674 9.58319C12.1674 9.35287 11.981 9.1665 11.7507 9.1665Z"
                        fill="white"/>
                <path
                        d="M11.7507 10.8335H4.25067C4.02035 10.8335 3.83398 11.0199 3.83398 11.2502C3.83398 11.4805 4.02035 11.6669 4.25067 11.6669H11.7507C11.981 11.6669 12.1674 11.4805 12.1674 11.2502C12.1674 11.0199 11.981 10.8335 11.7507 10.8335Z"
                        fill="white"/>
                <path
                        d="M11.7507 12.5H4.25067C4.02035 12.5 3.83398 12.6864 3.83398 12.9167C3.83398 13.147 4.02035 13.3334 4.25067 13.3334H11.7507C11.981 13.3334 12.1674 13.147 12.1674 12.9167C12.1674 12.6864 11.981 12.5 11.7507 12.5Z"
                        fill="white"/>
                <path
                        d="M8.41733 14.1665H4.25066C4.02035 14.1665 3.83398 14.3529 3.83398 14.5832C3.83398 14.8135 4.02035 14.9999 4.25066 14.9999H8.41733C8.64764 14.9999 8.83401 14.8135 8.83401 14.5832C8.83397 14.3529 8.64764 14.1665 8.41733 14.1665Z"
                        fill="white"/>
            </svg>
        </button>
    </div>
</div>