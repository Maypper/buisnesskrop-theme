<div class="calendar-modal timepicker-modal-search">
    <div class="calendar-modal__content">
        <h3 class="calendar-modal__title"><?php _e('Select the time you want', 'krop'); ?></h3>
        <button class="calendar-modal__close-button">
            <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.243 13.243 9.002 9m0 0L4.758 4.757M9.001 9l4.242-4.243M9.002 9l-4.243 4.243"
                      stroke="#E8BA06"
                      stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
        <div class="timepicker-modal__wrapper">
            <div class="timepicker-modal__inputs">
                <p><?php _e('From:', 'krop'); ?></p>
                <input class="timepicker-input timepicker-input-from" id="timepicker-input3">
                <p><?php _e('To:', 'krop'); ?></p>
                <input class="timepicker-input timepicker-input-until" id="timepicker-input4">
            </div>
            <input class="to-backend" type="text" value="">
            <button class="btn btn--primary">
	            <?php _e('Confirm', 'krop'); ?>
                <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M18.333 11.884v-8.55c0-.92-.748-1.667-1.666-1.667h-2.5V.417a.416.416 0 1 0-.834 0v1.25h-7.5V.417a.416.416 0 1 0-.833 0v1.25H1.667C.747 1.667 0 2.414 0 3.333v13.334c0 .919.748 1.666 1.667 1.666h10.217A4.576 4.576 0 0 0 15.417 20 4.589 4.589 0 0 0 20 15.417c0-1.42-.65-2.692-1.667-3.533Zm-17.5-8.55c0-.46.374-.834.834-.834H5v.833a.834.834 0 1 0 .833.834V2.5h7.5v.833a.834.834 0 1 0 .834.834V2.5h2.5c.46 0 .833.374.833.833v2.5H.833v-2.5ZM1.667 17.5a.834.834 0 0 1-.834-.833v-10H17.5v4.672a4.55 4.55 0 0 0-2.083-.506 4.589 4.589 0 0 0-4.584 4.584c0 .75.185 1.457.506 2.083H1.667Zm13.75 1.667a3.754 3.754 0 0 1-3.75-3.75 3.754 3.754 0 0 1 3.75-3.75 3.754 3.754 0 0 1 3.75 3.75 3.754 3.754 0 0 1-3.75 3.75Z"
                            fill="#fff"/>
                    <path
                            d="M17.084 15h-1.25v-1.25a.416.416 0 1 0-.833 0V15h-1.25a.416.416 0 1 0 0 .834H15v1.25a.416.416 0 1 0 .833 0v-1.25h1.25a.416.416 0 1 0 0-.834Z"
                            fill="#fff"/>
                </svg>
            </button>
        </div>
    </div>
</div>