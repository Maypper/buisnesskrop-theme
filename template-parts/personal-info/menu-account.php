<?php
global $wp;
?>

<div class="personal__content__block">
    <div class="personal__content__block__title d-flex justify-content-between swapper-list-item"
         data-swapper-select="block3,block4"
         data-swapper-class="hidden-mob,personal__content__block__title__icon">
        <div class="d-flex align-items-center">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M12 0C5.38331 0 0 5.38331 0 12C0 18.6167 5.38331 24 12 24C18.6167 24 24 18.6167 24 12C24 5.38331 18.6167 0 12 0ZM12 1.50002C17.7898 1.50002 22.5 6.21022 22.5 12C22.5 14.4121 21.6741 16.63 20.3016 18.4047C15.0373 15.9133 8.9626 15.9133 3.69839 18.4047C2.32593 16.63 1.50002 14.4121 1.50002 12C1.50002 6.21022 6.21022 1.50002 12 1.50002ZM4.75057 19.5774C9.37822 17.5277 14.6218 17.5277 19.2494 19.5774C17.3628 21.3831 14.8116 22.5001 12 22.5001C9.18839 22.5001 6.6372 21.3831 4.75057 19.5774Z"
                        fill="#E8BA06"/>
                <path
                        d="M12 15C14.4814 15 16.5 12.9815 16.5 10.5C16.5 8.01852 14.4814 6 12 6C9.51857 6 7.5 8.01852 7.5 10.5C7.5 12.9815 9.51857 15 12 15ZM12 7.50001C13.6546 7.50001 15 8.84548 15 10.5C15 12.1546 13.6545 13.5 12 13.5C10.3454 13.5 9.00002 12.1545 9.00002 10.5C9.00002 8.84548 10.3455 7.50001 12 7.50001Z"
                        fill="#E8BA06"/>
            </svg>
            <div class="personal__content__block__title__text"><?php _e( 'My account', 'krop' ); ?></div>
        </div>
        <div class="d-md-none d-block">
            <svg data-swapper="block4" width="14" height="11" viewBox="0 0 14 11" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                        d="M6.4522 10.0459C6.51336 10.1347 6.5952 10.2074 6.69066 10.2576C6.78613 10.3077 6.89236 10.3339 7.0002 10.3339C7.10805 10.3339 7.21428 10.3077 7.30974 10.2576C7.40521 10.2074 7.48704 10.1347 7.5482 10.0459L13.5482 1.37925C13.6177 1.27929 13.6584 1.16221 13.666 1.04072C13.6735 0.919239 13.6477 0.798001 13.5912 0.690181C13.5347 0.582362 13.4498 0.492084 13.3456 0.429157C13.2414 0.366231 13.1219 0.333061 13.0002 0.333253H1.0002C0.878764 0.333754 0.759761 0.367351 0.655989 0.430428C0.552217 0.493506 0.467604 0.583678 0.411248 0.691248C0.354892 0.798818 0.328925 0.919716 0.336141 1.04094C0.343357 1.16216 0.383483 1.27913 0.452202 1.37925L6.4522 10.0459Z"
                        fill="#6B2A14"/>
            </svg>
        </div>
    </div>
    <div class="d-block" data-swapper="block3">
        <a href="<?php echo home_url( splitter_lang_condition( array('ukr' => '/edit-account/', 'eng' => '/eng/personal-account/' ) ) ); ?>"
           class="personal__content__block__link <?php echo home_url( splitter_lang_condition( array('ukr' => '/edit-account/', 'eng' => '/eng/personal-account/' ) ) ) === trailingslashit(home_url( $wp->request )) ? 'personal__content__block__link--active' : ''; ?>"><?php _e( 'Edit personal information', 'krop' ); ?></a>
        <a href="<?php echo home_url( splitter_lang_condition( array('ukr' => '/contact-administrator/', 'eng' => '/eng/contact-the-administrator/' ) ) ); ?>"
           class="personal__content__block__link <?php echo home_url( splitter_lang_condition( array('ukr' => '/contact-administrator/', 'eng' => '/eng/contact-the-administrator/' ) ) ) === trailingslashit(home_url( $wp->request )) ? 'personal__content__block__link--active' : ''; ?>"><?php _e( 'Contact with administrator', 'krop' ); ?></a>
        <button data-modal="personal-modal-exit"
                class="js-open-modal personal__content__block__link"><?php _e( 'Sign out from account', 'krop' ); ?>
        </button>
    </div>
</div>