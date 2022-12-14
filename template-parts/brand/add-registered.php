<?php
$post_id = $args['post_id'] ?? false;
?>


    <div class="add-brand__content add-brand__content__padding-big">
        <div class="add-brand__content__inform-block add-brand__content__inform-block__margin-big d-flex align-items-center">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                <?php _e( 'You are a registered user, so you can then edit brand/business information in your personal account.', 'krop' ); ?>
            </span>
            </div>
        </div>
        <div class="add-brand__form">
            <form class="edit-brand__form" action="" id="profile_form">
                <div class="add-brand__form__text"><?php _e( 'Your EDPNOU code', 'krop' ); ?></div>
                <input name="edpnou" required type="text" class="add-brand__form__input mobile-placeholder"
                       data-default-placeholder-text="<?php _e( 'For example: 12345678', 'krop' ); ?>"
                       data-tablet-placeholder-text="<?php _e( 'For example: 12345678', 'krop' ); ?>"
                       data-moblile-placeholder-text="<?php _e( 'For example: 12345678', 'krop' ); ?>"
                       placeholder="<?php _e( 'For example: 12345678', 'krop' ); ?>" <?php echo get_field( 'edpnou', $post_id ) ? 'value="' . get_field( 'edpnou', $post_id ) . '"' : '' ?>>
                <div class="login__form__input-error edpnou" aria-hidden="true">
					<?php _e( 'Please fill this information', 'krop' ); ?>
                </div>
                <div class="add-brand__form__text"><?php _e( 'Full name of the business entity', 'krop' ); ?></div>
                <input name="post_title" required type="text" class="add-brand__form__input mobile-placeholder"
                       data-moblile-placeholder-text="<?php _e( 'Boutique', 'krop' ); ?>"
                       data-tablet-placeholder-text="<?php _e( 'Boutique', 'krop' ); ?>"
                       data-default-placeholder-text="<?php _e( 'For example: Shop sewing workshop “Boutique”', 'krop' ); ?>"
                       placeholder="<?php _e( 'Boutique', 'krop' ); ?>" <?php echo get_field( 'full_name', $post_id ) ? 'value="' . htmlentities( get_field( 'full_name', $post_id ) ) . '"' : '' ?>>
                <div class="login__form__input-error post_title" aria-hidden="true">
					<?php _e( 'Please fill this information', 'krop' ); ?>
                </div>
                <div class="add-brand__form__text"><?php _e( 'Legal address of the brand/business', 'krop' ); ?></div>
                <input name="legal_address" required type="text" class="add-brand__form__input mobile-placeholder"
                       data-moblile-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                       data-tablet-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                       data-default-placeholder-text="<?php _e( 'For example: Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                       placeholder="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
					<?php echo get_field( 'legal_address', $post_id ) ? 'value="' . get_field( 'legal_address', $post_id ) . '"' : '' ?>>
                <div class="login__form__input-error legal_address" aria-hidden="true">
					<?php _e( 'Please fill this information', 'krop' ); ?>
                </div>
                <div class="add-brand__form__text"><?php _e( 'Actual brand/business address', 'krop' ); ?></div>
				<?php $location = get_field( 'location', $post_id ); ?>
                <input name="location[]" required type="text" class="add-brand__form__input mobile-placeholder"
                       data-moblile-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                       data-tablet-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                       data-default-placeholder-text="<?php _e( 'For example: Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                       placeholder="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
					<?php echo isset( $location[0]['item'] ) ? 'value="' . $location[0]['item'] . '"' : '' ?>>
                <div class="login__form__input-error location" aria-hidden="true">
					<?php _e( 'Please fill this information', 'krop' ); ?>
                </div>
                <p class="add-address__btn"><?php _e( 'Add another address', 'krop' ); ?></p>
				<?php
				if ( isset( $location ) && ! empty( $location ) ) {
					foreach ( $location as $key => $item ) {
						if ( $key === 0 ) {
							continue;
						}
						?>
                        <div class="add-brand__form__text"><?php _e( 'Actual brand/business address', 'krop' ); ?></div>
                        <input name="location[]" required type="text" class="add-brand__form__input mobile-placeholder"
                               data-moblile-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                               data-tablet-placeholder-text="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                               data-default-placeholder-text="<?php _e( 'For example: Kropyvnytskyi, street Name 123', 'krop' ); ?>"
                               placeholder="<?php _e( 'Kropyvnytskyi, street Name 123', 'krop' ); ?>"
							<?php echo isset( $item['item'] ) ? 'value="' . $item['item'] . '"' : '' ?>>
						<?php
					}
				}
				?>
                <div>
                    <div class="add-brand__form__text"><?php _e( 'Short description or comment on the brand/business (max. 3000 characters)', 'krop' ); ?></div>
                    <textarea name="post_content" class="add-brand__form__textarea" id="" cols="30" rows="10"
                              maxlength="3000" required
                              placeholder="<?php _e( 'For example: some example of information to fill', 'krop' ); ?>"><?php echo get_field( 'post_content', $post_id ) ? get_field( 'post_content', $post_id ) : '' ?></textarea>
                    <div class="login__form__input-error post_content" aria-hidden="true">
						<?php _e( 'Please fill this information', 'krop' ); ?>
                    </div>
                </div>
                <div class="d-flex flex-md-column flex-column">
                    <div class="d-md-flex d-block">
                        <div class="d-block w-100 add-brand__form__text-input">
                            <div class="add-brand__form__text js-open-modal">
								<?php _e( 'Category', 'krop' ); ?>
                            </div>
                            <div class="add-brand__form__input category-button d-flex justify-content-between">
								<?php _e( 'Select a category from the list', 'krop' ); ?>
                            </div>
                            <div class="login__form__input-error category" aria-hidden="true">
								<?php _e( 'Please fill this information', 'krop' ); ?>
                            </div>
                        </div>
                        <div class="d-block w-100 hours-block">
                            <div class="add-brand__form__text">
								<?php _e( 'Hours of work', 'krop' ); ?>
                            </div>
                            <div class="custom-select custom-select-single no-chips work-hours visible"
                                 id="work-hours"></div>
                            <input type="hidden" name="custom-work-hours"
                                   class="hours-to-backend single-item" <?php echo get_field( 'custom-work-hours', $post_id ) ? 'value="' . get_field( 'custom-work-hours', $post_id ) . '"' : '' ?>>
                            <div class="login__form__input-error works_hours" aria-hidden="true">
								<?php _e( 'Please fill this information', 'krop' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex d-block">
                        <div class="d-block w-100 add-brand__form__text-input">
                            <div class="add-brand__form__text">
								<?php _e( 'Working days', 'krop' ); ?>
                            </div>
                            <!--                            id="work-days"-->
                            <select id="work-days" name="works_days"
                                    class="init-virtual-select custom-select custom-select-single no-chips work-days visible"
                                    placeholder="<?php _e('Select a work schedule', 'krop'); ?>" multiple
                                    data-search="false" data-silent-initial-value-set="true">
                                <option value="no_weekends"><?php _e('No holidays (from Monday to Sunday)', 'krop'); ?></option>
                                <option value="weekdays"><?php _e('Only on weekdays (Monday - Friday)', 'krop'); ?></option>
                                <option value="weekends"><?php _e('Only on weekends (Saturday - Sunday)', 'krop'); ?></option>
                                <option value="custom"><?php _e('Select your days of the week...', 'krop'); ?></option>
                            </select>
                            <input type="hidden" name="custom-work-days"
                                   class="days-to-backend single-item" <?php echo get_field( 'custom-work-days', $post_id ) ? 'value="' . get_field( 'custom-work-days', $post_id ) . '"' : '' ?>>
                            <div class="login__form__input-error works_days" aria-hidden="true">
								<?php _e( 'Please fill this information', 'krop' ); ?>
                            </div>
                        </div>
                        <div class="d-block w-100">
                            <div class="add-brand__form__text">
								<?php _e( 'Phone number', 'krop' ); ?>
                            </div>
                            <input name="phone_number" type="tel" pattern="(?:^\+)?(?:[0-9] ?){6,14}[0-9]$" required
                                   class="add-brand__form__input add-brand__form__input__small"
                                   placeholder="<?php _e( 'For example +380501234567', 'krop' ); ?>"
								<?php echo get_field( 'phone_number', $post_id ) ? 'value="' . get_field( 'phone_number', $post_id ) . '"' : '' ?>>
                            <div class="login__form__input-error phone_number" aria-hidden="true">
								<?php _e( 'Invalid phone number', 'krop' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex d-block">
                        <div class="d-block w-100 add-brand__form__text-input">
                            <div class="add-brand__form__text"><?php _e( 'Website', 'krop' ); ?></div>
                            <input type="text" name="url" required
                                   class="add-brand__form__input add-brand__form__input__small"
                                   placeholder="<?php _e( 'For example: www.somesite.com', 'krop' ); ?>"
								<?php echo get_field( 'url', $post_id ) ? 'value="' . get_field( 'url', $post_id ) . '"' : '' ?>>
                            <div class="login__form__input-error url" aria-hidden="true">
								<?php _e( 'Invalid link format', 'krop' ); ?>
                            </div>
                        </div>
                        <div class="d-block w-100">
                            <div class="add-brand__form__text"><?php _e( 'Email', 'krop' ); ?></div>
                            <input type="email" name="email" required
                                   pattern="(?![_.-])((?![_.-][_.-])[\w.-]){0,63}[a-zA-Z\d]@((?!-)((?!--)[a-zA-Z\d-]){0,63}[a-zA-Z\d]\.){1,2}([a-zA-Z]{2,14}\.)?[a-zA-Z]{2,14}"
                                   class="add-brand__form__input add-brand__form__input__small"
                                   placeholder="<?php _e( 'For example: support@email.com', 'krop' ); ?>"
								<?php echo get_field( 'email', $post_id ) ? 'value="' . get_field( 'email', $post_id ) . '"' : '' ?>>
                            <div class="login__form__input-error email" aria-hidden="true">
								<?php _e( 'Invalid email', 'krop' ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex d-block">
                        <div class="d-block w-100 add-brand__form__text-input">
                            <div class="add-brand__form__text">Facebook</div>
                            <input name="facebook" type="text" autocomplete="url"
                                   class="add-brand__form__input add-brand__form__input__small mobile-placeholder"
                                   data-moblile-placeholder-text="<?php _e( 'Address of your page at', 'krop' ); ?> Facebook"
                                   data-tablet-placeholder-text="<?php _e( 'Your', 'krop' ); ?> Facebook"
                                   data-default-placeholder-text="<?php _e( 'Address of your page at', 'krop' ); ?> Facebook"
								<?php echo get_field( 'facebook', $post_id ) ? 'value="' . get_field( 'facebook', $post_id ) . '"' : '' ?>>
                            <div class="login__form__input-error facebook" aria-hidden="true">
								<?php _e( 'Invalid link format', 'krop' ); ?>
                            </div>
                        </div>
                        <div class="d-block w-100">
                            <div class="add-brand__form__text">Instagram</div>
                            <input name="instagram" type="text" autocomplete="url"
                                   class="add-brand__form__input add-brand__form__input__small mobile-placeholder"
                                   data-moblile-placeholder-text="<?php _e( 'Address of your page in', 'krop' ); ?> Instagram"
                                   data-tablet-placeholder-text="<?php _e( 'Your', 'krop' ); ?> Instagram"
                                   data-default-placeholder-text="<?php _e( 'Address of your page in', 'krop' ); ?> Instagram"
								<?php echo get_field( 'instagram', $post_id ) ? 'value="' . get_field( 'instagram', $post_id ) . '"' : '' ?>>
                            <div class="login__form__input-error instagram" aria-hidden="true">
								<?php _e( 'Invalid link format', 'krop' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-md-flex d-block">
                    <div class="d-block w-100 add-brand__form__text-input">
                        <div class="add-brand__form__text">YouTube</div>
                        <input name="youtube" type="text" autocomplete="url"
                               class="add-brand__form__input add-brand__form__input__small mobile-placeholder"
                               data-moblile-placeholder-text="<?php _e( 'Address of your page at', 'krop' ); ?> YouTube"
                               data-tablet-placeholder-text="<?php _e( 'Your', 'krop' ); ?> YouTube"
                               data-default-placeholder-text="<?php _e( 'Address of your page at', 'krop' ); ?> YouTube"
							<?php echo get_field( 'youtube', $post_id ) ? 'value="' . get_field( 'youtube', $post_id ) . '"' : '' ?>>
                        <div class="login__form__input-error youtube" aria-hidden="true">
							<?php _e( 'Invalid link format', 'krop' ); ?>
                        </div>
                    </div>
                    <div class="d-block w-100">
                        <div class="add-brand__form__text">WhatsApp</div>
                        <input name="whatsapp" type="text" autocomplete="url"
                               class="add-brand__form__input add-brand__form__input__small mobile-placeholder"
                               data-moblile-placeholder-text="<?php _e( 'Address of your page in', 'krop' ); ?> WhatsApp"
                               data-tablet-placeholder-text="<?php _e( 'Your', 'krop' ); ?> WhatsApp"
                               data-default-placeholder-text="<?php _e( 'Address of your page in', 'krop' ); ?> WhatsApp"
							<?php echo get_field( 'whatsapp', $post_id ) ? 'value="' . get_field( 'whatsapp', $post_id ) . '"' : '' ?>>
                        <div class="login__form__input-error whatsapp" aria-hidden="true">
							<?php _e( 'Invalid link format', 'krop' ); ?>
                        </div>
                    </div>
                </div>
                <div class="d-md-flex d-block">
                    <div class="d-block w-100 add-brand__form__text-input">
                        <div class="add-brand__form__text">Telegram</div>
                        <input name="telegram" type="text" autocomplete="url"
                               class="add-brand__form__input add-brand__form__input__small mobile-placeholder"
                               data-moblile-placeholder-text="<?php _e( 'Address of your page in', 'krop' ); ?> Telegram"
                               data-tablet-placeholder-text="<?php _e( 'Your', 'krop' ); ?> Telegram"
                               data-default-placeholder-text="<?php _e( 'Address of your page in', 'krop' ); ?> Telegram"
							<?php echo get_field( 'telegram', $post_id ) ? 'value="' . get_field( 'telegram', $post_id ) . '"' : '' ?>>
                        <div class="login__form__input-error telegram" aria-hidden="true">
							<?php _e( 'Invalid link format', 'krop' ); ?>
                        </div>
                    </div>
                    <div class="d-block w-100">
                        <div class="add-brand__form__text">Viber</div>
                        <input name="viber" type="text" autocomplete="url"
                               class="add-brand__form__input add-brand__form__input__small mobile-placeholder"
                               data-moblile-placeholder-text="<?php _e( 'Address of your page in', 'krop' ); ?> Viber"
                               data-tablet-placeholder-text="<?php _e( 'Your', 'krop' ); ?> Viber"
                               data-default-placeholder-text="<?php _e( 'Address of your page in', 'krop' ); ?> Viber">
                        <div class="login__form__input-error viber" aria-hidden="true">
							<?php _e( 'Invalid link format', 'krop' ); ?>
                        </div>
                    </div>
                </div>
                <div class="add-brand__form__text"><?php _e( 'Brand/business logo and photo (minimum 3, maximum 10)', 'krop' ); ?>
                </div>
                <div class="file__input d-md-flex d-block" id="dwn_cnt">
                    <div class="file__drop d-flex flex-column align-items-center justify-content-between w-100 add-brand__form__text-input"
                         id="drop_cnt" ondragover="this.classList.add('drag_over');"
                         ondrop="this.classList.remove('drag_over');" ondragleave="this.classList.remove('drag_over')">
                        <svg width="42" height="56" viewBox="0 0 42 56" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M32.6667 30.8308V10.5C32.6667 10.1901 32.5437 9.89384 32.3249 9.67509L22.9915 0.341797C22.7728 0.123047 22.4766 0 22.1666 0H4.66659C2.09289 0 0 2.09289 0 4.6667V39.6667C0 42.2404 2.09289 44.3334 4.6667 44.3334H16.3925C16.9846 50.8642 22.4841 56 29.1667 56C36.243 56 42 50.243 42 43.1667C42 37.3049 38.045 32.3595 32.6667 30.8308ZM23.3333 3.98311L28.6836 9.33341H25.6667C24.3805 9.33341 23.3334 8.28636 23.3334 7.00011V3.98311H23.3333ZM4.6667 42C3.38045 42 2.33341 40.953 2.33341 39.6667V4.6667C2.33341 3.38045 3.38045 2.33341 4.6667 2.33341H21V7C21 9.5737 23.0929 11.6667 25.6667 11.6667H30.3334V30.3925C29.9486 30.3576 29.5606 30.3334 29.1667 30.3334C22.4841 30.3334 16.9846 35.4692 16.3925 42.0001H4.6667V42ZM29.1667 53.6667C23.3766 53.6667 18.6667 48.9567 18.6667 43.1667C18.6667 37.3767 23.3767 32.6667 29.1667 32.6667C34.9567 32.6667 39.6667 37.3767 39.6667 43.1667C39.6667 48.9567 34.9567 53.6667 29.1667 53.6667Z"
                                    fill="#6B2A14"/>
                            <path
                                    d="M33.8332 41.9997H30.3332V38.4997C30.3332 37.8548 29.8114 37.333 29.1665 37.333C28.5217 37.333 27.9998 37.8548 27.9998 38.4997V41.9997H24.4998C23.855 41.9997 23.3331 42.5215 23.3331 43.1664C23.3331 43.8113 23.855 44.3331 24.4998 44.3331H27.9998V47.8331C27.9998 48.478 28.5217 48.9998 29.1665 48.9998C29.8114 48.9998 30.3332 48.478 30.3332 47.8331V44.3331H33.8332C34.4781 44.3331 34.9999 43.8113 34.9999 43.1664C34.9999 42.5215 34.4781 41.9997 33.8332 41.9997Z"
                                    fill="#6B2A14"/>
                        </svg>

                        <div class="file__drop-title"><?php _e( 'Add a photo or logo', 'krop' ); ?></div>
                        <div class="file__drop-text">
							<?php _e( 'File formats: .jpg, .jpeg, .png', 'krop' ); ?> <br>
							<?php _e( 'Drag the photo here, or click the button', 'krop' ); ?>
                        </div>
                        <div class="input__wrapper">
                            <input class="input__file" type="file" name="files" id="dwn_btn">
                            <label class="input__button" for="dwn_btn"><?php _e( 'Upload', 'krop' ); ?></label>
                        </div>
                    </div>
                    <div class="files__wrpap d-block w-100">
                        <div class="file" id="file_tmpl" style="display: none;">
                            <div class="logo">
                                <svg width="18" height="24" viewBox="0 0 18 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M14 13.2132V4.5C14 4.3672 13.9473 4.24022 13.8535 4.14647L9.8535 0.146484C9.75975 0.0527344 9.63281 0 9.49997 0H1.99997C0.896953 0 0 0.896953 0 2.00002V17C0 18.103 0.896953 19 2.00002 19H7.02534C7.27912 21.7989 9.63605 24 12.5 24C15.5327 24 18 21.5327 18 18.5C18 15.9878 16.305 13.8683 14 13.2132ZM9.99998 1.70705L12.293 4.00003H11C10.4488 4.00003 10 3.5513 10 3.00005V1.70705H9.99998ZM2.00002 18C1.44877 18 1.00003 17.5513 1.00003 17V2.00002C1.00003 1.44877 1.44877 1.00003 2.00002 1.00003H9V3C9 4.10302 9.89695 5.00002 11 5.00002H13V13.0253C12.8351 13.0104 12.6688 13 12.5 13C9.63605 13 7.27912 15.2011 7.02534 18H2.00002V18ZM12.5 23C10.0185 23 8.00002 20.9814 8.00002 18.5C8.00002 16.0186 10.0186 14 12.5 14C14.9814 14 17 16.0186 17 18.5C17 20.9814 14.9814 23 12.5 23Z"
                                            fill="#1B1B1B"/>
                                    <path
                                            d="M14.1462 19.1465L12.9998 20.293V15.5C12.9998 15.2236 12.7761 15 12.4997 15C12.2234 15 11.9997 15.2236 11.9997 15.5V20.293L10.8533 19.1465C10.6579 18.9512 10.3415 18.9512 10.1463 19.1465C9.95092 19.3418 9.95092 19.6582 10.1463 19.8535L12.1463 21.8535C12.2439 21.9512 12.3719 22 12.4998 22C12.6277 22 12.7556 21.9512 12.8533 21.8535L14.8533 19.8535C15.0486 19.6582 15.0486 19.3418 14.8533 19.1465C14.6579 18.9512 14.3415 18.9512 14.1462 19.1465Z"
                                            fill="#1B1B1B"/>
                                </svg>

                            </div>
                            <span class="filenam"></span>
                            <div class="d-flex">
                                <div class="ext image js-open-modal" data-modal="modal-image-preview" data-preview-image="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_933_3856)">
                                            <path
                                                    d="M7.49976 12C9.15431 12 10.4998 10.6546 10.4998 9.00001C10.4998 7.34546 9.15431 6 7.49976 6C5.84521 6 4.49976 7.34546 4.49976 9.00001C4.49976 10.6546 5.84521 12 7.49976 12ZM7.49976 7.50003C8.32667 7.50003 8.99974 8.1731 8.99974 9.00001C8.99974 9.82691 8.32667 10.5 7.49976 10.5C6.67286 10.5 5.99978 9.82691 5.99978 9.00001C5.99978 8.1731 6.67286 7.50003 7.49976 7.50003Z"
                                                    fill="#6B2A14"/>
                                            <path
                                                    d="M23.25 3H0.750014C0.33543 3 0 3.33543 0 3.75001V20.25C0 20.6645 0.33543 21 0.750014 21H23.25C23.6645 21 24 20.6646 24 20.25V3.75001C24 3.33543 23.6645 3 23.25 3ZM1.49998 4.49998H22.5V17.6894L15.5303 10.7197C15.2373 10.4267 14.7627 10.4267 14.4697 10.7197L5.68944 19.5H1.49998C1.49998 19.5 1.49998 4.50003 1.49998 4.49998ZM22.1895 19.5H7.81056L15 12.3105C15 12.3105 22.1895 19.5 22.1895 19.5Z"
                                                    fill="#6B2A14"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_933_3856">
                                                <rect width="24" height="24" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="btn cross">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M10.2435 10.2426L6.00091 6M6.00091 6L1.75827 1.75736M6.00091 6L10.2435 1.75736M6.00091 6L1.75827 10.2426"
                                                stroke="#6B2A14" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="login__form__input-error upload-error-600" aria-hidden="true">
					<?php _e( 'File to large. Please select file smaller than 5mb', 'krop' ); ?>
                </div>
                <div class="login__form__input-error upload-error-to-few" aria-hidden="true">
					<?php _e( 'You must provide at least 3 images', 'krop' ); ?>
                </div>
                <div class="login__form__input-error upload-error-to-many" aria-hidden="true">
					<?php _e( 'The maximum number of images is 10', 'krop' ); ?>
                </div>
                <div class="add-brand__form__text"><?php _e( 'Special notes', 'krop' ); ?></div>
                <div class="d-md-flex d-block">
                    <div>
                        <div class="checkbox margin-top">
                            <input class="custom-checkbox" type="checkbox" name="a11y" value="true"
                                   id="cripple-label" <?php echo get_field( 'a11y', $post_id ) ? 'checked' : '' ?>>
                            <label for="cripple-label"><?php _e( 'Accessible for people with disabilities', 'krop' ); ?></label>
                        </div>
                    </div>
                    <div>
                        <div class="checkbox checkbox-for-online">
                            <input class="custom-checkbox online-label" type="checkbox" name="has-online" value="true"
                                   id="online-label" <?php echo get_field( 'has-online', $post_id ) ? 'checked' : '' ?>>
                            <label for="online-label"><?php _e( 'You can order online', 'krop' ); ?></label>
                        </div>
                    </div>
                </div>
                <div class="add-brand__online hidden">
                    <div class="add-brand__form__text"><?php _e( 'The address of the page to order online', 'krop' ); ?></div>
                    <input name="order_page" type="text"
                           class="add-brand__form__input add-brand__form__input mobile-placeholder"
                           data-moblile-placeholder-text="<?php _e( 'The address of your page is from order to order', 'krop' ); ?>"
                           data-tablet-placeholder-text="<?php _e( 'The address of your page is from order to order', 'krop' ); ?>"
                           data-default-placeholder-text="<?php _e( 'The address of your page from which you can order online', 'krop' ); ?>"
						<?php echo get_field( 'order_page', $post_id ) ? 'checked' : '' ?>>
                    <div class="login__form__input-error order_page" aria-hidden="true">
						<?php _e( 'Invalid link format', 'krop' ); ?>
                    </div>
                </div>
                <div class="add-object__title-button">
                    <h2 class="add-object__title"><?php _e( 'Brand/business objects', 'krop' ); ?></h2>
                    <button class="add-object__button btn btn--secondary"
                            type="button"><?php _e( 'Add another object', 'krop' ); ?>
                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.3333 3.16703H14.1667V2.33367C14.1667 1.41449 13.4192 0.666992 12.5 0.666992H7.5C6.58082 0.666992 5.83332 1.41445 5.83332 2.33367V3.16699H1.66668C0.747461 3.16703 0 3.91449 0 4.83367V15.667C0 16.5862 0.747461 17.3337 1.66668 17.3337H18.3334C19.2525 17.3337 20 16.5862 20 15.667V4.83367C20 3.91449 19.2525 3.16703 18.3333 3.16703ZM6.66668 2.33367C6.66668 1.8743 7.04063 1.50035 7.5 1.50035H12.5C12.9594 1.50035 13.3333 1.8743 13.3333 2.33367V3.16699H6.66668V2.33367ZM19.1667 15.667C19.1667 16.1264 18.7927 16.5003 18.3334 16.5003H1.66668C1.2073 16.5003 0.833359 16.1264 0.833359 15.667V9.6019C1.07949 9.74542 1.36176 9.8337 1.66668 9.8337H8.33336V11.0837C8.33336 11.314 8.51973 11.5004 8.75004 11.5004H11.25C11.4804 11.5004 11.6667 11.314 11.6667 11.0837V9.8337H18.3334C18.6383 9.8337 18.9206 9.74546 19.1667 9.6019V15.667H19.1667ZM9.16668 10.667V9.00034H10.8334V10.667H9.16668ZM19.1667 8.16702C19.1667 8.6264 18.7927 9.00034 18.3334 9.00034H11.6667V8.58366C11.6667 8.35335 11.4803 8.16699 11.25 8.16699H8.75C8.51969 8.16699 8.33332 8.35335 8.33332 8.58366V9.00034H1.66668C1.2073 9.00034 0.833359 8.6264 0.833359 8.16702V4.83371C0.833359 4.37433 1.2073 4.00039 1.66668 4.00039H18.3334C18.7927 4.00039 19.1667 4.37433 19.1667 4.83371V8.16702Z"
                                  fill="#E8BA06"></path>
                        </svg>
                    </button>
                </div>
				<?php
				$objects = get_field( 'objects', $post_id );
				if ( isset( $objects ) && is_array( $objects ) ) {
					foreach ( $objects as $object ) {
						get_template_part( 'template-parts/brand/parts/object', null, array(
							'object'  => $object,
							'post_id' => $post_id
						) );
					}
				}
				?>

                <div class="d-md-flex d-block">
                    <div class="d-block w-100 add-brand__form__text-input">
                        <div class="add-brand__form__text"><?php _e( 'Surname of the contact person', 'krop' ); ?></div>
                        <input type="text" name="person_name" required
                               class="add-brand__form__input add-brand__form__input__small"
                               placeholder="<?php _e( 'For example: Franco', 'krop' ); ?>"
							<?php echo get_field( 'person_name', $post_id ) ? 'value="' . get_field( 'person_name', $post_id ) . '"' : '' ?>>
                        <div class="login__form__input-error person_name" aria-hidden="true">
							<?php _e( 'Please fill this information', 'krop' ); ?>
                        </div>
                    </div>
                    <div class="d-block w-100">
                        <div class="add-brand__form__text"><?php _e( 'Name of contact person', 'krop' ); ?></div>
                        <input type="text" name="person_lastname" required
                               class="add-brand__form__input add-brand__form__input__small"
                               placeholder="<?php _e( 'For example: Ivan', 'krop' ); ?>"
							<?php echo get_field( 'person_lastname', $post_id ) ? 'value="' . get_field( 'person_lastname', $post_id ) . '"' : '' ?>>
                        <div class="login__form__input-error person_lastname" aria-hidden="true">
							<?php _e( 'Please fill this information', 'krop' ); ?>
                        </div>
                    </div>
                </div>
                <div class="d-md-flex d-block">
                    <div class="d-block w-100 add-brand__form__text-input">
                        <div class="add-brand__form__text"><?php _e( 'Contact person\'s e-mail', 'krop' ); ?></div>
                        <input type="email" name="person_email" required
                               pattern="(?![_.-])((?![_.-][_.-])[\w.-]){0,63}[a-zA-Z\d]@((?!-)((?!--)[a-zA-Z\d-]){0,63}[a-zA-Z\d]\.){1,2}([a-zA-Z]{2,14}\.)?[a-zA-Z]{2,14}"
                               class="add-brand__form__input add-brand__form__input__small"
                               placeholder="<?php _e( 'For example: support@email.com', 'krop' ); ?>"
							<?php echo get_field( 'person_email', $post_id ) ? 'value="' . get_field( 'person_email', $post_id ) . '"' : '' ?>>
                        <div class="login__form__input-error object_person_email" aria-hidden="true">
							<?php _e( 'Invalid email', 'krop' ); ?>
                        </div>
                    </div>
                    <div class="d-block w-100">
                        <div class="add-brand__form__text tablet-size"><?php _e( 'Contact person\'s phone number', 'krop' ); ?></div>
                        <input type="tel" name="person_phone_number" pattern="(?:^\+)?(?:[0-9] ?){6,14}[0-9]$"
                               required
                               class="add-brand__form__input add-brand__form__input__small"
                               placeholder="<?php _e( 'For example +380501234567', 'krop' ); ?>"
							<?php echo get_field( 'person_phone_number', $post_id ) ? 'value="' . get_field( 'person_phone_number', $post_id ) . '"' : '' ?>>
                        <div class="login__form__input-error object_person_phone_number" aria-hidden="true">
							<?php _e( 'Invalid phone number', 'krop' ); ?>
                        </div>
                    </div>
                </div>
                <div class="add-brand__form__checkbox add-brand__form__border-bottom checkbox">
                    <input name="confirm-data-processing" required class="custom-checkbox" type="checkbox"
                           id="checkbox-login"
                           value="true" <?php echo get_field( 'confirm-data-processing', $post_id ) ? 'checked' : '' ?>>
                    <label for="checkbox-login"><?php _e( 'I agree to the processing of data', 'krop' ); ?></label>
                    <div class="login__form__input-error confirm-data-processing" aria-hidden="true">
						<?php _e( 'You must allow data processing', 'krop' ); ?>
                    </div>
                </div>
                <input type="hidden" name="_wpnonce" value="<?php echo wp_create_nonce( 'add-business' ); ?>">
				<?php echo $post_id ? '<input type="hidden" name="post_id" value="' . $post_id . '">' : ''; ?>
                <input type="hidden" name="action" value="add_business_registered">
                <button type="submit" class="btn btn--primary add-brand__form__btn">
					<?php _e( 'Submit brand/business', 'krop' ); ?>
                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M18.3333 3.16703H14.1667V2.33367C14.1667 1.41449 13.4192 0.666992 12.5 0.666992H7.5C6.58082 0.666992 5.83332 1.41445 5.83332 2.33367V3.16699H1.66668C0.747461 3.16703 0 3.91449 0 4.83367V15.667C0 16.5862 0.747461 17.3337 1.66668 17.3337H18.3334C19.2525 17.3337 20 16.5862 20 15.667V4.83367C20 3.91449 19.2525 3.16703 18.3333 3.16703ZM6.66668 2.33367C6.66668 1.8743 7.04063 1.50035 7.5 1.50035H12.5C12.9594 1.50035 13.3333 1.8743 13.3333 2.33367V3.16699H6.66668V2.33367ZM19.1667 15.667C19.1667 16.1264 18.7927 16.5003 18.3334 16.5003H1.66668C1.2073 16.5003 0.833359 16.1264 0.833359 15.667V9.6019C1.07949 9.74542 1.36176 9.8337 1.66668 9.8337H8.33336V11.0837C8.33336 11.314 8.51973 11.5004 8.75004 11.5004H11.25C11.4804 11.5004 11.6667 11.314 11.6667 11.0837V9.8337H18.3334C18.6383 9.8337 18.9206 9.74546 19.1667 9.6019V15.667H19.1667ZM9.16668 10.667V9.00034H10.8334V10.667H9.16668ZM19.1667 8.16702C19.1667 8.6264 18.7927 9.00034 18.3334 9.00034H11.6667V8.58366C11.6667 8.35335 11.4803 8.16699 11.25 8.16699H8.75C8.51969 8.16699 8.33332 8.35335 8.33332 8.58366V9.00034H1.66668C1.2073 9.00034 0.833359 8.6264 0.833359 8.16702V4.83371C0.833359 4.37433 1.2073 4.00039 1.66668 4.00039H18.3334C18.7927 4.00039 19.1667 4.37433 19.1667 4.83371V8.16702Z"
                                fill="white"/>
                    </svg>
                </button>
				<?php
				get_template_part( 'template-parts/brand/modals/categories' );
				?>
            </form>
        </div>

    </div>


    <div id="preview" class="visually-hidden"></div>

<?php
get_template_part( 'template-parts/brand/modals/days' );
get_template_part( 'template-parts/brand/modals/timepicker' );
get_template_part( 'template-parts/brand/modals/image-preview' );

get_template_part( 'template-parts/brand/parts/address' );
get_template_part( 'template-parts/brand/parts/object' );
