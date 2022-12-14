<?php
/*
Template Name: Відновлення паролю
Template Post Type: page
*/
get_header();
get_template_part( 'template-parts/breadcrumbs' );
?>

    <div class="login__content">
        <div class="container--small mx-auto">
			<?php if ( isset( $_GET['action'] ) && $_GET['action'] === 'restore_access' && wp_verify_nonce( $_GET['_wpnonce'], 'reset-password-nonce' ) ) {
				$update_password_nonce = wp_create_nonce( 'update-password-nonce' );
				?>
                <h1 class="text-center"><?php _e( 'Password restoring', 'krop' ); ?></h1>
                <div class="login__form">
                    <form action="" method="post" id="profile_form">
                        <div class="login__form__text"><?php _e( 'Code from phone / email', 'krop' ); ?></div>
                        <input type="text" class="login__form__input mobile-placeholder" name="code" required
                               autocomplete="off" id="email_code"
                               data-moblile-placeholder-text="<?php _e( 'Enter the code sent to you here', 'krop' ); ?>"
                               data-default-placeholder-text="<?php _e( 'Enter the code sent to you here', 'krop' ); ?>"
                               placeholder="<?php _e( 'Enter the code sent to you here', 'krop' ); ?>">
                        <label class="mt-3" for="email_code"><?php _e( "If it isn't in your inbox, check your folders. Maybe a spam filter or email rule moved the email, it might be in the Spam, Junk, Trash, Deleted Items, or Archive folder", 'krop' ); ?></label>
                        <div class="login__form__input-error empty_code" aria-hidden="true">
							<?php _e( 'Please enter the received code', 'krop' ); ?>
                        </div>
                        <div class="login__form__input-error invalid_code" aria-hidden="true">
							<?php _e( 'Incorrect code, check that it is entered correctly', 'krop' ); ?>
                        </div>
                        <div class="login__form__text"><?php _e( 'Password', 'krop' ); ?></div>

                        <div class="d-flex flex-wrap flex-dir-column position-relative div-password-field">
                            <input type="password" class="login__form__input mobile-placeholder password" required
                                   name="new-password" autocomplete="new-password"
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
                        <input type="hidden" name="_wpnonce" value="<?php echo $update_password_nonce; ?>">
                        <input type="hidden" name="action" value="update_password">
                        <button type="submit" class="btn btn--primary login__form__btn recovery__btn"><span
                                    class="recovery__btn__desk"><?php _e( 'Start the password recovery procedure', 'krop' ); ?></span>
                            <span class="recovery__btn__mob"><?php _e( 'Start the recovery procedure', 'krop' ); ?></span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M13.3333 0C9.65738 0 6.66664 2.99074 6.66664 6.66668C6.66664 7.10449 6.71426 7.55371 6.80824 8.00496L6.06359 8.37726C5.94395 8.43707 5.86016 8.55102 5.83859 8.68324C5.81703 8.81547 5.86059 8.94977 5.95539 9.04457L6.49414 9.58332L6.07746 10H5.41664C5.18633 10 4.99996 10.1864 4.99996 10.4167V11.0775L4.41078 11.6667H3.75C3.51969 11.6667 3.33332 11.853 3.33332 12.0834V12.7442L2.74414 13.3333H2.08332C1.85301 13.3333 1.66664 13.5197 1.66664 13.75V14.4108L0.12207 15.9554C0.0439453 16.0335 0 16.1393 0 16.25V19.5833C0 19.8136 0.186367 20 0.41668 20H3.75C3.86066 20 3.96648 19.9561 4.04461 19.8779L10.4167 13.5059L10.9554 14.0446C11.0498 14.1394 11.1845 14.1838 11.3168 14.1614C11.449 14.1398 11.5629 14.056 11.6227 13.9364L11.995 13.1918C16.2345 14.0755 20 10.7804 20 6.66668C20 2.99074 17.0093 0 13.3333 0ZM11.873 12.3079C11.6842 12.2599 11.4844 12.3495 11.3965 12.5252L11.1357 13.0465L10.7113 12.6221C10.5485 12.4593 10.2848 12.4593 10.1221 12.6221L3.57746 19.1667H0.83332V16.4225L2.37793 14.8779C2.45605 14.7998 2.5 14.694 2.5 14.5833V14.1666H2.91668C3.02734 14.1666 3.13316 14.1227 3.21129 14.0446L4.04461 13.2113C4.12273 13.1331 4.16668 13.0273 4.16668 12.9166V12.5H4.58336C4.69402 12.5 4.79984 12.4561 4.87797 12.3779L5.71129 11.5446C5.78941 11.4665 5.83336 11.3607 5.83336 11.25V10.8333H6.25C6.36066 10.8333 6.46648 10.7894 6.54461 10.7113L7.37793 9.87793C7.5407 9.71516 7.5407 9.45148 7.37793 9.28875L6.95352 8.86434L7.47477 8.60352C7.65055 8.51562 7.7409 8.31707 7.69207 8.12703C7.56473 7.63223 7.5 7.14109 7.5 6.66668C7.5 3.45012 10.1168 0.833359 13.3333 0.833359C16.5498 0.833359 19.1666 3.45016 19.1666 6.66668C19.1667 10.3577 15.7223 13.2991 11.873 12.3079Z"
                                        fill="white"/>
                                <path
                                        d="M15.4173 2.5C14.2686 2.5 13.334 3.43465 13.334 4.58332C13.334 5.73199 14.2686 6.66664 15.4173 6.66664C16.566 6.66664 17.5006 5.73203 17.5006 4.58332C17.5006 3.43461 16.566 2.5 15.4173 2.5ZM15.4173 5.83332C14.728 5.83332 14.1673 5.27262 14.1673 4.58332C14.1673 3.89402 14.728 3.33332 15.4173 3.33332C16.1066 3.33332 16.6673 3.89402 16.6673 4.58332C16.6673 5.27262 16.1066 5.83332 15.4173 5.83332Z"
                                        fill="white"/>
                                <path
                                        d="M8.4554 10.9555L2.62208 16.7889C2.45931 16.9517 2.45931 17.2153 2.62208 17.3781C2.70345 17.4594 2.81009 17.5001 2.91669 17.5001C3.02329 17.5001 3.12989 17.4594 3.2113 17.3781L9.04462 11.5448C9.20739 11.382 9.20739 11.1183 9.04462 10.9556C8.88185 10.7928 8.61817 10.7928 8.4554 10.9555Z"
                                        fill="white"/>
                            </svg>
                        </button>
                        <div class="d-md-flex d-block align-center justify-content-center">
                            <div class="login__form__bottom-text text-center"><?php _e( 'Found your password?', 'krop' ); ?> </div>
                            <a href="<?php echo esc_url(splitter_lang_condition( array('ukr' => home_url( '/login/' ), 'eng' => home_url( '/eng/sign-in/' ) ) )); ?>"
                               class="login__form__link d-flex text-center justify-content-center"><?php _e( 'Back to log in', 'krop' ); ?></a>
                        </div>
                    </form>
                </div>
				<?php
			} elseif ( isset( $_GET['action'] ) && $_GET['action'] === 'confirm_change' ) {
				?>
                <div class="login__content">
                    <div class="container--small mx-auto">
                        <h1 class="text-center"><?php _e( 'Password restoring', 'krop' ); ?></h1>
                        <div class="confirm-password__text text-center">
							<?php _e( 'Password reset, write it down or save it in a safe place', 'krop' ); ?>
                            <br>
							<?php _e( 'Now you can go to your personal account.', 'krop' ); ?>
                        </div>
                        <a href="<?php echo esc_url( splitter_lang_condition( array('ukr' => home_url( '/login/' ), 'eng' => home_url( '/eng/sign-in/' ) ) ) ); ?>"
                           class="btn btn--primary login__form__btn recovery__btn confirm-password__btn d-flex mx-auto"><?php _e( 'Go to account', 'krop' ); ?>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 0C4.48609 0 0 4.48609 0 10C0 15.5139 4.48609 20 10 20C15.5139 20 20 15.5139 20 10C20 4.48609 15.5139 0 10 0ZM10 1.25001C14.8248 1.25001 18.75 5.17519 18.75 10C18.75 12.0101 18.0617 13.8583 16.918 15.3373C12.5311 13.2611 7.46884 13.2611 3.082 15.3373C1.93827 13.8583 1.25001 12.0101 1.25001 10C1.25001 5.17519 5.17519 1.25001 10 1.25001ZM3.95881 16.3145C7.81518 14.6064 12.1848 14.6064 16.0412 16.3145C14.469 17.8193 12.343 18.7501 10 18.7501C7.657 18.7501 5.531 17.8192 3.95881 16.3145Z"
                                      fill="white"></path>
                                <path d="M10 12.5C12.0679 12.5 13.75 10.8179 13.75 8.75C13.75 6.6821 12.0679 5 10 5C7.93214 5 6.25 6.6821 6.25 8.75C6.25 10.8179 7.93214 12.5 10 12.5ZM10 6.25001C11.3788 6.25001 12.5 7.37123 12.5 8.75C12.5 10.1288 11.3788 11.25 10 11.25C8.6212 11.25 7.50001 10.1288 7.50001 8.75C7.50001 7.37123 8.62124 6.25001 10 6.25001Z"
                                      fill="white"></path>
                            </svg>
                        </a>
                    </div>
                </div>
				<?php
			} else {
				$restore_access_nonce = wp_create_nonce( 'restore-access-nonce' );
				?>
                <h1 class="text-center"><?php _e( 'Lost yours password?', 'krop' ); ?></h1>
                <div class="recovery__text text-center"><?php _e( 'Enter email associated with your personal account and we sent email with code for restoring.', 'krop' ); ?></div>
                <div class="login__form">
                    <form action="" method="post" id="profile_form">
                        <div class="login__form__text"><?php _e( 'Email or phone number', 'krop' ); ?></div>
                        <input type="text" class="login__form__input mobile-placeholder" name="login"
                               data-moblile-placeholder-text="<?php _e( 'mail@example.com or +380501234567', 'krop' ); ?>"
                               data-default-placeholder-text="<?php _e( 'For example mail@example.com or +380501234567', 'krop' ); ?>"
                               placeholder="<?php _e( 'For example mail@example.com or +380501234567', 'krop' ); ?>"
                               required>

                        <div class="login__form__input-error empty_username" aria-hidden="true">
							<?php _e( 'Please enter your email or username', 'krop' ); ?>
                        </div>
                        <div class="login__form__input-error username_not_found" aria-hidden="true">
							<?php _e( 'User with such email or username not registered', 'krop' ); ?>
                        </div>
                        <div class="login__form__input-error invalid_username invalid_email" aria-hidden="true">
							<?php _e( 'Invalid email or username, please try again', 'krop' ); ?>
                        </div>
                        <input type="hidden" name="_wpnonce" value="<?php echo $restore_access_nonce; ?>">
                        <input type="hidden" name="action" value="restore_access">
                        <button type="submit" class="btn btn--primary login__form__btn recovery__btn"><span
                                    class="recovery__btn__desk"><?php _e( 'Start the password recovery procedure', 'krop' ); ?></span>
                            <span class="recovery__btn__mob"><?php _e( 'Start the recovery procedure', 'krop' ); ?></span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M13.3333 0C9.65738 0 6.66664 2.99074 6.66664 6.66668C6.66664 7.10449 6.71426 7.55371 6.80824 8.00496L6.06359 8.37726C5.94395 8.43707 5.86016 8.55102 5.83859 8.68324C5.81703 8.81547 5.86059 8.94977 5.95539 9.04457L6.49414 9.58332L6.07746 10H5.41664C5.18633 10 4.99996 10.1864 4.99996 10.4167V11.0775L4.41078 11.6667H3.75C3.51969 11.6667 3.33332 11.853 3.33332 12.0834V12.7442L2.74414 13.3333H2.08332C1.85301 13.3333 1.66664 13.5197 1.66664 13.75V14.4108L0.12207 15.9554C0.0439453 16.0335 0 16.1393 0 16.25V19.5833C0 19.8136 0.186367 20 0.41668 20H3.75C3.86066 20 3.96648 19.9561 4.04461 19.8779L10.4167 13.5059L10.9554 14.0446C11.0498 14.1394 11.1845 14.1838 11.3168 14.1614C11.449 14.1398 11.5629 14.056 11.6227 13.9364L11.995 13.1918C16.2345 14.0755 20 10.7804 20 6.66668C20 2.99074 17.0093 0 13.3333 0ZM11.873 12.3079C11.6842 12.2599 11.4844 12.3495 11.3965 12.5252L11.1357 13.0465L10.7113 12.6221C10.5485 12.4593 10.2848 12.4593 10.1221 12.6221L3.57746 19.1667H0.83332V16.4225L2.37793 14.8779C2.45605 14.7998 2.5 14.694 2.5 14.5833V14.1666H2.91668C3.02734 14.1666 3.13316 14.1227 3.21129 14.0446L4.04461 13.2113C4.12273 13.1331 4.16668 13.0273 4.16668 12.9166V12.5H4.58336C4.69402 12.5 4.79984 12.4561 4.87797 12.3779L5.71129 11.5446C5.78941 11.4665 5.83336 11.3607 5.83336 11.25V10.8333H6.25C6.36066 10.8333 6.46648 10.7894 6.54461 10.7113L7.37793 9.87793C7.5407 9.71516 7.5407 9.45148 7.37793 9.28875L6.95352 8.86434L7.47477 8.60352C7.65055 8.51562 7.7409 8.31707 7.69207 8.12703C7.56473 7.63223 7.5 7.14109 7.5 6.66668C7.5 3.45012 10.1168 0.833359 13.3333 0.833359C16.5498 0.833359 19.1666 3.45016 19.1666 6.66668C19.1667 10.3577 15.7223 13.2991 11.873 12.3079Z"
                                        fill="white"/>
                                <path
                                        d="M15.4173 2.5C14.2686 2.5 13.334 3.43465 13.334 4.58332C13.334 5.73199 14.2686 6.66664 15.4173 6.66664C16.566 6.66664 17.5006 5.73203 17.5006 4.58332C17.5006 3.43461 16.566 2.5 15.4173 2.5ZM15.4173 5.83332C14.728 5.83332 14.1673 5.27262 14.1673 4.58332C14.1673 3.89402 14.728 3.33332 15.4173 3.33332C16.1066 3.33332 16.6673 3.89402 16.6673 4.58332C16.6673 5.27262 16.1066 5.83332 15.4173 5.83332Z"
                                        fill="white"/>
                                <path
                                        d="M8.4554 10.9555L2.62208 16.7889C2.45931 16.9517 2.45931 17.2153 2.62208 17.3781C2.70345 17.4594 2.81009 17.5001 2.91669 17.5001C3.02329 17.5001 3.12989 17.4594 3.2113 17.3781L9.04462 11.5448C9.20739 11.382 9.20739 11.1183 9.04462 10.9556C8.88185 10.7928 8.61817 10.7928 8.4554 10.9555Z"
                                        fill="white"/>
                            </svg>
                        </button>
                        <div class="d-md-flex d-block align-center justify-content-center">
                            <div class="login__form__bottom-text text-center"><?php _e( 'Found your password?', 'krop' ); ?> </div>
                            <a href="<?php echo esc_url(splitter_lang_condition( array('ukr' => home_url( '/login/' ), 'eng' => home_url( '/eng/sign-in/' ) ) )); ?>"
                               class="login__form__link d-flex text-center justify-content-center"><?php _e( 'Back to log in', 'krop' ); ?></a>
                        </div>
                    </form>
                </div>
				<?php
			}
			?>
        </div>
    </div>


<?php
get_template_part( 'template-parts/modals/alert/reload' );
get_template_part( 'template-parts/modals/overlay' );

get_footer();