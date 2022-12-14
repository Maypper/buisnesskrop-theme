<div class="modal personal__modal personal__modal__padding-small add-brand__modal" data-modal="modal-send-brand">
    <div class="d-md-flex d-block align-items-center">
        <div class="personal__modal__icon-title">
            <svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.3333 4.66656H22.6667V3.33319C22.6667 1.8625 21.4708 0.666504 20 0.666504H12C10.5293 0.666504 9.33331 1.86244 9.33331 3.33319V4.6665H2.66669C1.19594 4.66656 0 5.8625 0 7.33319V24.6665C0 26.1372 1.19594 27.3332 2.66669 27.3332H29.3334C30.8041 27.3332 32.0001 26.1372 32.0001 24.6665V7.33319C32 5.8625 30.8041 4.66656 29.3333 4.66656ZM10.6667 3.33319C10.6667 2.59819 11.265 1.99988 12 1.99988H20C20.735 1.99988 21.3333 2.59819 21.3333 3.33319V4.6665H10.6667V3.33319ZM30.6667 24.6665C30.6667 25.4015 30.0684 25.9999 29.3334 25.9999H2.66669C1.93169 25.9999 1.33337 25.4015 1.33337 24.6665V14.9624C1.72719 15.192 2.17881 15.3332 2.66669 15.3332H13.3334V17.3332C13.3334 17.7017 13.6316 17.9999 14.0001 17.9999H18.0001C18.3686 17.9999 18.6667 17.7017 18.6667 17.3332V15.3332H29.3334C29.8213 15.3332 30.273 15.1921 30.6667 14.9624V24.6665H30.6667ZM14.6667 16.6666V13.9999H17.3334V16.6666H14.6667ZM30.6667 12.6666C30.6667 13.4016 30.0684 13.9999 29.3334 13.9999H18.6667V13.3332C18.6667 12.9647 18.3685 12.6665 18 12.6665H14C13.6315 12.6665 13.3333 12.9647 13.3333 13.3332V13.9999H2.66669C1.93169 13.9999 1.33337 13.4016 1.33337 12.6666V7.33325C1.33337 6.59825 1.93169 5.99994 2.66669 5.99994H29.3334C30.0684 5.99994 30.6667 6.59825 30.6667 7.33325V12.6666Z"
                      fill="#E8BA06"></path>
            </svg>
        </div>
        <div class="personal__modal__title"><?php _e( 'Brand/business submitted', 'krop' ); ?></div>
    </div>
    <div class="personal__modal__text personal__modal__text__margin"><?php _e( 'Thank you for your contribution to the portal!', 'krop' ); ?>
        <br>
		<?php _e( 'Your request to add a brand/business', 'krop' ); ?>
        <span class="personal__modal__text__color font-weight-bold" id="post_title"></span>
		<?php
		if ( is_user_logged_in() ) {
			_e( 'will be reviewed by an administrator shortly. You can check the availability of the business/brand in personal account or on the', 'krop' );
		} else {
			_e( 'will be reviewed by an administrator shortly. You can check the availability of the business/brand on the', 'krop' );
		} ?>
        <a href="<?php echo home_url( splitter_lang_condition( array('ukr' => '/catalog/', 'eng' => '/eng/catalog/' ) ) ) ?>"
           class="personal__modal__text__link personal__modal__text__color"><?php _e( 'Catalog page.', 'krop' ); ?></a>
    </div>
    <div class="d-md-flex d-block">
        <a href="<?php echo home_url(); ?>" class="personal__modal__btn personal__modal__btn__big btn--primary">
			<?php _e( 'Back to home page', 'krop' ); ?>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.8136 6.10922L14.0011 4.65919V1.49978C14.0011 1.22341 13.7774 0.999783 13.5011 0.999783H11.502C11.2262 0.999783 11.002 1.22341 11.002 1.49928L11.0015 2.25954L8.3135 0.109135C8.13087 -0.0363783 7.87111 -0.0363783 7.68851 0.109135L0.188384 6.10925C0.0228534 6.24206 -0.0411016 6.46523 0.0292063 6.66539C0.0995141 6.8656 0.288504 6.99986 0.500883 6.99986H2.00088V15.5C2.00088 15.7763 2.22451 16 2.50088 16H13.5011C13.7774 16 14.0011 15.7763 14.0011 15.5V6.99986H15.5011C15.7135 6.99986 15.9025 6.8656 15.9728 6.66539C16.0431 6.46519 15.9791 6.24206 15.8136 6.10922ZM12.001 3.00031L12.0015 1.99981H13.0011V3.85922L11.9274 3.00027C11.9274 3.00024 12.001 3.00031 12.001 3.00031ZM7.00097 14.9999V10.9999H9.001V14.9999H7.00097ZM13.5011 5.99983C13.2247 5.99983 13.0011 6.22346 13.0011 6.49983V14.9999H10.001V10.4999C10.001 10.2235 9.77741 9.99988 9.50104 9.99988H6.50101C6.22464 9.99988 6.00101 10.2235 6.00101 10.4999V14.9999H3.00091V6.49983C3.00091 6.22346 2.77728 5.99983 2.50091 5.99983H1.92617L8.00097 1.13994L14.0758 5.99987C14.0758 5.99983 13.5011 5.99983 13.5011 5.99983Z"
                      fill="white"></path>
            </svg>
        </a>
        <a href="<?php echo is_page_template( array(
			'page-templates/add-brand.php',
			'page-templates/brand-ownership.php'
		) ) ? home_url( splitter_lang_condition( array('ukr' => '/brands-settings/', 'eng' => '/eng/brands-setting/' ) ) ) : home_url( splitter_lang_condition( array('ukr' => '/add-brand/', 'eng' => '/eng/add-brands/' ) ) ); ?>"
           class="personal__modal__btn personal__modal__btn__big text-white">
			<?php
			if ( is_page_template( array( 'page-templates/add-brand.php', 'page-templates/brand-ownership.php' ) ) ) {
				_e( 'Go to account', 'krop' );
				?>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 0C4.48609 0 0 4.48609 0 10C0 15.5139 4.48609 20 10 20C15.5139 20 20 15.5139 20 10C20 4.48609 15.5139 0 10 0ZM10 1.25001C14.8248 1.25001 18.75 5.17519 18.75 10C18.75 12.0101 18.0617 13.8583 16.918 15.3373C12.5311 13.2611 7.46884 13.2611 3.082 15.3373C1.93827 13.8583 1.25001 12.0101 1.25001 10C1.25001 5.17519 5.17519 1.25001 10 1.25001ZM3.95881 16.3145C7.81518 14.6064 12.1848 14.6064 16.0412 16.3145C14.469 17.8193 12.343 18.7501 10 18.7501C7.657 18.7501 5.531 17.8192 3.95881 16.3145Z"
                          fill="white"/>
                    <path d="M10 12.5C12.0679 12.5 13.75 10.8179 13.75 8.75C13.75 6.6821 12.0679 5 10 5C7.93214 5 6.25 6.6821 6.25 8.75C6.25 10.8179 7.93214 12.5 10 12.5ZM10 6.25001C11.3788 6.25001 12.5 7.37123 12.5 8.75C12.5 10.1288 11.3788 11.25 10 11.25C8.6212 11.25 7.50001 10.1288 7.50001 8.75C7.50001 7.37123 8.62124 6.25001 10 6.25001Z"
                          fill="white"/>
                </svg>
				<?php
			} else {
				_e( 'Add one more brand/business', 'krop' );
				?>
                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.3333 3.16703H14.1667V2.33367C14.1667 1.41449 13.4192 0.666992 12.5 0.666992H7.5C6.58082 0.666992 5.83332 1.41445 5.83332 2.33367V3.16699H1.66668C0.747461 3.16703 0 3.91449 0 4.83367V15.667C0 16.5862 0.747461 17.3337 1.66668 17.3337H18.3334C19.2525 17.3337 20 16.5862 20 15.667V4.83367C20 3.91449 19.2525 3.16703 18.3333 3.16703ZM6.66668 2.33367C6.66668 1.8743 7.04063 1.50035 7.5 1.50035H12.5C12.9594 1.50035 13.3333 1.8743 13.3333 2.33367V3.16699H6.66668V2.33367ZM19.1667 15.667C19.1667 16.1264 18.7927 16.5003 18.3334 16.5003H1.66668C1.2073 16.5003 0.833359 16.1264 0.833359 15.667V9.6019C1.07949 9.74542 1.36176 9.8337 1.66668 9.8337H8.33336V11.0837C8.33336 11.314 8.51973 11.5004 8.75004 11.5004H11.25C11.4804 11.5004 11.6667 11.314 11.6667 11.0837V9.8337H18.3334C18.6383 9.8337 18.9206 9.74546 19.1667 9.6019V15.667H19.1667ZM9.16668 10.667V9.00034H10.8334V10.667H9.16668ZM19.1667 8.16702C19.1667 8.6264 18.7927 9.00034 18.3334 9.00034H11.6667V8.58366C11.6667 8.35335 11.4803 8.16699 11.25 8.16699H8.75C8.51969 8.16699 8.33332 8.35335 8.33332 8.58366V9.00034H1.66668C1.2073 9.00034 0.833359 8.6264 0.833359 8.16702V4.83371C0.833359 4.37433 1.2073 4.00039 1.66668 4.00039H18.3334C18.7927 4.00039 19.1667 4.37433 19.1667 4.83371V8.16702Z"
                          fill="white"></path>
                </svg>
				<?php
			}
			?>
        </a>
    </div>
</div>