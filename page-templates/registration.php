<?php
/*
Template Name: Реєстрація у особистий кабінет
Template Post Type: page
*/
get_header();
get_template_part( 'template-parts/breadcrumbs' );
$registration_nonce = wp_create_nonce( 'registration-nonce' );
?>

    <div class="login__content">
        <div class="container--small mx-auto">
            <h1 class="text-center"><?php _e( 'Sign up for personal account', 'krop' ); ?></h1>
            <div class="login__form">
                <form method="post" id="profile_form">
                    <div class="login__form__head mx-auto">
                        <a href="<?php echo esc_url(splitter_lang_condition( array('ukr' => home_url( '/login/' ), 'eng' => home_url( '/eng/sign-in/' ) ) )) ?>" class="login__form__head__elem">
                            <svg class="inactive-icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M10 0C4.48609 0 0 4.48609 0 10C0 15.5139 4.48609 20 10 20C15.5139 20 20 15.5139 20 10C20 4.48609 15.5139 0 10 0ZM10 1.25001C14.8248 1.25001 18.75 5.17519 18.75 10C18.75 12.0101 18.0617 13.8583 16.918 15.3373C12.5311 13.2611 7.46884 13.2611 3.082 15.3373C1.93827 13.8583 1.25001 12.0101 1.25001 10C1.25001 5.17519 5.17519 1.25001 10 1.25001ZM3.95881 16.3145C7.81518 14.6064 12.1848 14.6064 16.0412 16.3145C14.469 17.8193 12.343 18.7501 10 18.7501C7.657 18.7501 5.531 17.8192 3.95881 16.3145Z"
                                        fill="#333333"/>
                                <path
                                        d="M10 12.5C12.0679 12.5 13.75 10.8179 13.75 8.75C13.75 6.6821 12.0679 5 10 5C7.93214 5 6.25 6.6821 6.25 8.75C6.25 10.8179 7.93214 12.5 10 12.5ZM10 6.25001C11.3788 6.25001 12.5 7.37123 12.5 8.75C12.5 10.1288 11.3788 11.25 10 11.25C8.6212 11.25 7.50001 10.1288 7.50001 8.75C7.50001 7.37123 8.62124 6.25001 10 6.25001Z"
                                        fill="#333333"/>
                            </svg>
                            <svg class="active-icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M10 0C4.48609 0 0 4.48609 0 10C0 15.5139 4.48609 20 10 20C15.5139 20 20 15.5139 20 10C20 4.48609 15.5139 0 10 0ZM10 1.25001C14.8248 1.25001 18.75 5.17519 18.75 10C18.75 12.0101 18.0617 13.8583 16.918 15.3373C12.5311 13.2611 7.46884 13.2611 3.082 15.3373C1.93827 13.8583 1.25001 12.0101 1.25001 10C1.25001 5.17519 5.17519 1.25001 10 1.25001ZM3.95881 16.3145C7.81518 14.6064 12.1848 14.6064 16.0412 16.3145C14.469 17.8193 12.343 18.7501 10 18.7501C7.657 18.7501 5.531 17.8192 3.95881 16.3145Z"
                                        fill="#6B2A14"/>
                                <path
                                        d="M10 12.5C12.0679 12.5 13.75 10.8179 13.75 8.75C13.75 6.6821 12.0679 5 10 5C7.93214 5 6.25 6.6821 6.25 8.75C6.25 10.8179 7.93214 12.5 10 12.5ZM10 6.25001C11.3788 6.25001 12.5 7.37123 12.5 8.75C12.5 10.1288 11.3788 11.25 10 11.25C8.6212 11.25 7.50001 10.1288 7.50001 8.75C7.50001 7.37123 8.62124 6.25001 10 6.25001Z"
                                        fill="#6B2A14"/>
                            </svg>
                            <div class="login__form__head__elem__text"><?php _e( 'Log in', 'krop' ); ?></div>
                        </a>
                        <div class="login__form__head__text"><?php _e( 'or', 'krop' ); ?></div>
                        <a href="<?php echo esc_url(splitter_lang_condition( array('ukr' => home_url( '/registration/' ), 'eng' => home_url( '/eng/register/' ) ) ))?>"
                           class="login__form__head__elem login__form__head__elem--active">
                            <svg class="inactive-icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M10 0C4.48609 0 0 4.48609 0 10C0 15.5139 4.48609 20 10 20C15.5139 20 20 15.5139 20 10C20 4.48609 15.5139 0 10 0ZM10 1.25001C14.8248 1.25001 18.75 5.17519 18.75 10C18.75 12.0101 18.0617 13.8583 16.918 15.3373C12.5311 13.2611 7.46884 13.2611 3.082 15.3373C1.93827 13.8583 1.25001 12.0101 1.25001 10C1.25001 5.17519 5.17519 1.25001 10 1.25001ZM3.95881 16.3145C7.81518 14.6064 12.1848 14.6064 16.0412 16.3145C14.469 17.8193 12.343 18.7501 10 18.7501C7.657 18.7501 5.531 17.8192 3.95881 16.3145Z"
                                        fill="#333333"/>
                                <path
                                        d="M10 12.5C12.0679 12.5 13.75 10.8179 13.75 8.75C13.75 6.6821 12.0679 5 10 5C7.93214 5 6.25 6.6821 6.25 8.75C6.25 10.8179 7.93214 12.5 10 12.5ZM10 6.25001C11.3788 6.25001 12.5 7.37123 12.5 8.75C12.5 10.1288 11.3788 11.25 10 11.25C8.6212 11.25 7.50001 10.1288 7.50001 8.75C7.50001 7.37123 8.62124 6.25001 10 6.25001Z"
                                        fill="#333333"/>
                            </svg>
                            <svg class="active-icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M10 0C4.48609 0 0 4.48609 0 10C0 15.5139 4.48609 20 10 20C15.5139 20 20 15.5139 20 10C20 4.48609 15.5139 0 10 0ZM10 1.25001C14.8248 1.25001 18.75 5.17519 18.75 10C18.75 12.0101 18.0617 13.8583 16.918 15.3373C12.5311 13.2611 7.46884 13.2611 3.082 15.3373C1.93827 13.8583 1.25001 12.0101 1.25001 10C1.25001 5.17519 5.17519 1.25001 10 1.25001ZM3.95881 16.3145C7.81518 14.6064 12.1848 14.6064 16.0412 16.3145C14.469 17.8193 12.343 18.7501 10 18.7501C7.657 18.7501 5.531 17.8192 3.95881 16.3145Z"
                                        fill="#6B2A14"/>
                                <path
                                        d="M10 12.5C12.0679 12.5 13.75 10.8179 13.75 8.75C13.75 6.6821 12.0679 5 10 5C7.93214 5 6.25 6.6821 6.25 8.75C6.25 10.8179 7.93214 12.5 10 12.5ZM10 6.25001C11.3788 6.25001 12.5 7.37123 12.5 8.75C12.5 10.1288 11.3788 11.25 10 11.25C8.6212 11.25 7.50001 10.1288 7.50001 8.75C7.50001 7.37123 8.62124 6.25001 10 6.25001Z"
                                        fill="#6B2A14"/>
                            </svg>
                            <div class="login__form__head__elem__text"><?php _e( 'Sign up', 'krop' ); ?></div>
                        </a>
                    </div>
                    <div class="login__form__text"><?php _e( 'Surname and first name', 'krop' ); ?></div>
                    <input type="text" class="login__form__input"
                           placeholder="<?php _e( 'For example: Ivan Franko', 'krop' ); ?>" required name="user_fio">
                    <div class="login__form__input-error" aria-hidden="true">
						<?php _e( 'Name field can\'t be empty', 'krop' ); ?>
                    </div>
<!--                    <div class="login__form__text">--><?php //_e( 'Email', 'krop' ); ?><!--</div>-->
                    <div class="login__form__text"><?php _e( 'Email or phone number', 'krop' ); ?></div>
                    <div>
                        <!-- todo edit pattern to accept phone numbers too -->
                        <input type="text"
                               pattern="(\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9})|((?![_.-])((?![_.-][_.-])[\w.-]){0,63}[a-zA-Z\d]@((?!-)((?!--)[a-zA-Z\d-]){0,63}[a-zA-Z\d]\.){1,2}([a-zA-Z]{2,14}\.)?[a-zA-Z]{2,14})"
                               class="login__form__input mobile-placeholder existing_user_email invalid-email"
                               name="user_email" autocomplete="email"
                               data-moblile-placeholder-text="<?php _e( 'mail@example.com or +380501234567', 'krop' ); ?>"
                               data-default-placeholder-text="<?php _e( 'For example mail@example.com or +380501234567', 'krop' ); ?>"
                               placeholder="<?php _e( 'For example mail@example.com', 'krop' ); ?>"
                               required>
                        <div class="login__form__input-error invalid-email-or-phone" aria-hidden="true">
		                    <?php _e( 'Invalid email or phone number', 'krop' ); ?>
                        </div>
                        <div class="login__form__input-error invalid-email" aria-hidden="true">
							<?php _e( 'Invalid email', 'krop' ); ?>
                        </div>
                        <div class="login__form__input-error invalid-phone" aria-hidden="true">
							<?php _e( 'Invalid phone number', 'krop' ); ?>
                        </div>
                        <div class="login__form__input-error existing_user_email" aria-hidden="true">
							<?php _e( 'This email already in use', 'krop' ); ?>
                        </div>
                    </div>
                    <div class="login__form__text"><?php _e( 'Password', 'krop' ); ?></div>
                    <div class="d-flex flex-wrap flex-dir-column position-relative div-password-field">
                        <input type="password" class="login__form__input mobile-placeholder password" required
                               name="user_password" autocomplete="new-password"
                               data-moblile-placeholder-text="<?php _e( 'Think up a new password', 'krop' ); ?>"
                               data-default-placeholder-text="<?php _e( 'Create a new password for your personal account', 'krop' ); ?>"
                               placeholder="<?php _e( 'Create a new password for your personal account', 'krop' ); ?>">
                        <div class="login__form__input__password-visible password-visible-switcher">
                            <span
                                    class="login__form__input__icon form-password-visible-icon login__form__input__icon__hide"><svg
                                        width="26" height="18" viewBox="0 0 26 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M12.6094 0C6.19408 0 2.13326 5.01164 0.560923 7.38027C-0.193368 8.51657 -0.191664 9.97709 0.59479 11.107C2.18012 13.3847 6.17222 18 12.6094 18C19.0466 18 23.0387 13.3847 24.624 11.107C25.4104 9.97709 25.4121 8.51657 24.6579 7.38027C23.0855 5.01164 19.0247 0 12.6094 0ZM2.22721 8.48638C3.74179 6.20476 7.2804 2 12.6094 2C17.9384 2 21.477 6.20476 22.9916 8.48638C23.2991 8.94972 23.2929 9.51852 22.9825 9.96445C21.4956 12.1006 18.0252 16 12.6094 16C7.19362 16 3.72316 12.1006 2.23631 9.96445C1.92592 9.51852 1.91964 8.94972 2.22721 8.48638ZM9.60939 9C9.60939 7.34315 10.9525 6 12.6094 6C14.2662 6 15.6094 7.34315 15.6094 9C15.6094 10.6569 14.2662 12 12.6094 12C10.9525 12 9.60939 10.6569 9.60939 9ZM12.6094 4C9.84797 4 7.60939 6.23858 7.60939 9C7.60939 11.7614 9.84797 14 12.6094 14C15.3708 14 17.6094 11.7614 17.6094 9C17.6094 6.23858 15.3708 4 12.6094 4Z"
                                      fill="#E8BA06"/>
                            </svg>
                        </span>
                            <span class="login__form__input__icon  form-password-hide-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_698_942)">
                                    <path
                                            d="M12.0009 2.99976C10.3161 2.99976 8.70177 3.38162 7.20312 4.02038L8.34564 5.16289C9.50335 4.74349 10.7306 4.49975 12.0009 4.49975C16.6401 4.49975 20.8099 7.50344 22.4557 11.9999C21.8286 13.7134 20.8311 15.2054 19.5846 16.4018L20.6394 17.4566C22.1032 16.0452 23.2647 14.2795 23.9609 12.2423C24.0143 12.0848 24.0143 11.9149 23.9609 11.7574C22.1708 6.51909 17.3645 2.99976 12.0009 2.99976Z"
                                            fill="#E8BA06"/>
                                    <path
                                            d="M14.9799 11.798L16.3326 13.1507C16.431 12.7812 16.5003 12.4003 16.5003 12.0001C16.5003 9.5186 14.4818 7.5 12.0003 7.5C11.6001 7.5 11.2191 7.56933 10.8496 7.66775L12.2023 9.02046C13.6932 9.12188 14.8784 10.3072 14.9799 11.798Z"
                                            fill="#E8BA06"/>
                                    <path
                                            d="M1.49986 2.5606L4.54109 5.60183C2.52689 7.12512 0.909882 9.21253 0.0401073 11.7577C-0.0133691 11.9152 -0.0133691 12.0851 0.0401073 12.2426C1.83017 17.481 6.63638 21.0003 12 21.0003C14.2296 21.0003 16.3355 20.3451 18.1932 19.2539L21.4396 22.5004L22.5001 21.4398L2.56038 1.5L1.49982 2.56056L1.49986 2.5606ZM12 19.5003C7.36084 19.5003 3.19108 16.4966 1.54528 12.0002C2.35701 9.7823 3.81572 7.97826 5.61167 6.6724L8.33987 9.40061C7.81556 10.1364 7.49997 11.0299 7.49997 12.0002C7.49997 14.4816 9.51853 16.5002 12 16.5002C12.9703 16.5002 13.8638 16.1847 14.5996 15.6603L17.0955 18.1563C15.5465 18.9957 13.8211 19.5003 12 19.5003ZM9.42499 10.4858L13.5145 14.5753C13.0683 14.8388 12.5548 15.0003 12 15.0003C10.3455 15.0003 9.00001 13.6548 9.00001 12.0003C9.00001 11.4455 9.16149 10.932 9.42499 10.4858Z"
                                            fill="#E8BA06"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_698_942">
                                        <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        </div>
                        <div class="login__form__input-error password" aria-hidden="true">
							<?php _e( 'Please, think up a new password', 'krop' ); ?>
                        </div>
                    </div>
                    <div class="login__form__text"><?php _e( 'Confirm password', 'krop' ); ?></div>
                    <div class="d-flex flex-wrap flex-dir-column position-relative div-password-field">
                        <input type="password" class="login__form__input mobile-placeholder confirm-password"
                               name="password_confirm"
                               placeholder="<?php _e( 'Enter your password again', 'krop' ); ?>" required>
                        <div class="login__form__input__password-visible password-visible-switcher">
                            <span
                                    class="login__form__input__icon form-password-visible-icon login__form__input__icon__hide"><svg
                                        width="26" height="18" viewBox="0 0 26 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M12.6094 0C6.19408 0 2.13326 5.01164 0.560923 7.38027C-0.193368 8.51657 -0.191664 9.97709 0.59479 11.107C2.18012 13.3847 6.17222 18 12.6094 18C19.0466 18 23.0387 13.3847 24.624 11.107C25.4104 9.97709 25.4121 8.51657 24.6579 7.38027C23.0855 5.01164 19.0247 0 12.6094 0ZM2.22721 8.48638C3.74179 6.20476 7.2804 2 12.6094 2C17.9384 2 21.477 6.20476 22.9916 8.48638C23.2991 8.94972 23.2929 9.51852 22.9825 9.96445C21.4956 12.1006 18.0252 16 12.6094 16C7.19362 16 3.72316 12.1006 2.23631 9.96445C1.92592 9.51852 1.91964 8.94972 2.22721 8.48638ZM9.60939 9C9.60939 7.34315 10.9525 6 12.6094 6C14.2662 6 15.6094 7.34315 15.6094 9C15.6094 10.6569 14.2662 12 12.6094 12C10.9525 12 9.60939 10.6569 9.60939 9ZM12.6094 4C9.84797 4 7.60939 6.23858 7.60939 9C7.60939 11.7614 9.84797 14 12.6094 14C15.3708 14 17.6094 11.7614 17.6094 9C17.6094 6.23858 15.3708 4 12.6094 4Z"
                                      fill="#E8BA06"/>
                            </svg>
                        </span>
                            <span class="login__form__input__icon form-password-hide-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_698_942)">
                                    <path
                                            d="M12.0009 2.99976C10.3161 2.99976 8.70177 3.38162 7.20312 4.02038L8.34564 5.16289C9.50335 4.74349 10.7306 4.49975 12.0009 4.49975C16.6401 4.49975 20.8099 7.50344 22.4557 11.9999C21.8286 13.7134 20.8311 15.2054 19.5846 16.4018L20.6394 17.4566C22.1032 16.0452 23.2647 14.2795 23.9609 12.2423C24.0143 12.0848 24.0143 11.9149 23.9609 11.7574C22.1708 6.51909 17.3645 2.99976 12.0009 2.99976Z"
                                            fill="#E8BA06"/>
                                    <path
                                            d="M14.9799 11.798L16.3326 13.1507C16.431 12.7812 16.5003 12.4003 16.5003 12.0001C16.5003 9.5186 14.4818 7.5 12.0003 7.5C11.6001 7.5 11.2191 7.56933 10.8496 7.66775L12.2023 9.02046C13.6932 9.12188 14.8784 10.3072 14.9799 11.798Z"
                                            fill="#E8BA06"/>
                                    <path
                                            d="M1.49986 2.5606L4.54109 5.60183C2.52689 7.12512 0.909882 9.21253 0.0401073 11.7577C-0.0133691 11.9152 -0.0133691 12.0851 0.0401073 12.2426C1.83017 17.481 6.63638 21.0003 12 21.0003C14.2296 21.0003 16.3355 20.3451 18.1932 19.2539L21.4396 22.5004L22.5001 21.4398L2.56038 1.5L1.49982 2.56056L1.49986 2.5606ZM12 19.5003C7.36084 19.5003 3.19108 16.4966 1.54528 12.0002C2.35701 9.7823 3.81572 7.97826 5.61167 6.6724L8.33987 9.40061C7.81556 10.1364 7.49997 11.0299 7.49997 12.0002C7.49997 14.4816 9.51853 16.5002 12 16.5002C12.9703 16.5002 13.8638 16.1847 14.5996 15.6603L17.0955 18.1563C15.5465 18.9957 13.8211 19.5003 12 19.5003ZM9.42499 10.4858L13.5145 14.5753C13.0683 14.8388 12.5548 15.0003 12 15.0003C10.3455 15.0003 9.00001 13.6548 9.00001 12.0003C9.00001 11.4455 9.16149 10.932 9.42499 10.4858Z"
                                            fill="#E8BA06"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_698_942">
                                        <rect width="24" height="24" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </span>
                        </div>
                        <div class="login__form__input-error fill-confirm-password" aria-hidden="true">
							<?php _e( 'Please, fill new password again', 'krop' ); ?>
                        </div>
                        <div class="login__form__input-error confirm-password" aria-hidden="true">
							<?php _e( 'Password didn\'t match', 'krop' ); ?>
                        </div>
                    </div>
                    <div class="login__form__checkbox checkbox">
                        <input class="custom-checkbox" type="checkbox" id="checkbox-register" name="checkbox-register"
                               required value="confirm_policy">
                        <label class="login__form__text-checkbox"
                               for="checkbox-register"><?php _e( 'I confirm that I have read the policy', 'krop' ); ?></label>
                        <div class="login__form__input-error confirm_policy" aria-hidden="true">
							<?php _e( 'You must agree with usage policy', 'krop' ); ?>
                        </div>
                    </div>
                    <input type="hidden" name="_wpnonce" value="<?php echo $registration_nonce; ?>">
                    <input type="hidden" name="action" value="registration">
                    <button type="submit" class="btn btn--primary login__form__btn"><span
                                class="d-md-block d-none"><?php _e( 'Sign up for a personal account', 'krop' ); ?></span>
                        <span class="d-block d-md-none"><?php _e( 'Sign up', 'krop' ); ?></span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M10 0C4.48609 0 0 4.48609 0 10C0 15.5139 4.48609 20 10 20C15.5139 20 20 15.5139 20 10C20 4.48609 15.5139 0 10 0ZM10 1.25001C14.8248 1.25001 18.75 5.17519 18.75 10C18.75 12.0101 18.0617 13.8583 16.918 15.3373C12.5311 13.2611 7.46884 13.2611 3.082 15.3373C1.93827 13.8583 1.25001 12.0101 1.25001 10C1.25001 5.17519 5.17519 1.25001 10 1.25001ZM3.95881 16.3145C7.81518 14.6064 12.1848 14.6064 16.0412 16.3145C14.469 17.8193 12.343 18.7501 10 18.7501C7.657 18.7501 5.531 17.8192 3.95881 16.3145Z"
                                    fill="white"/>
                            <path
                                    d="M10 12.5C12.0679 12.5 13.75 10.8179 13.75 8.75C13.75 6.6821 12.0679 5 10 5C7.93214 5 6.25 6.6821 6.25 8.75C6.25 10.8179 7.93214 12.5 10 12.5ZM10 6.25001C11.3788 6.25001 12.5 7.37123 12.5 8.75C12.5 10.1288 11.3788 11.25 10 11.25C8.6212 11.25 7.50001 10.1288 7.50001 8.75C7.50001 7.37123 8.62124 6.25001 10 6.25001Z"
                                    fill="white"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

<?php
get_template_part( 'template-parts/modals/confirm-code' );
get_template_part( 'template-parts/modals/alert/reload' );
get_template_part( 'template-parts/modals/overlay' );

get_footer();