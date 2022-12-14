<div class="calendar-modal" id="calendar-modal-header">
    <div class="calendar-modal__content">
        <h3 class="calendar-modal__title divider"><?php _e('Select the desired period in the calendar', 'krop'); ?></h3>
        <button class="calendar-modal__close-button" id="calendar-modal-close-button-header">
            <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.243 13.243 9.002 9m0 0L4.758 4.757M9.001 9l4.242-4.243M9.002 9l-4.243 4.243"
                      stroke="#E8BA06" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>

        <div class="calendar-modal__descktop-content">
            <input class="calendar-input" id="calendar-input-header" type="text">
        </div>

        <div class="calendar-modal__mobile-content">
            <div class="mobile-calendar-item">
                <label class="mobile-calendar-item__label" for="first-calendar-input-header">
                    <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M14.667 9.507v-6.84c0-.736-.599-1.334-1.334-1.334h-2v-1a.333.333 0 1 0-.666 0v1h-6v-1a.333.333 0 1 0-.667 0v1H1.333C.598 1.333 0 1.931 0 2.667v10.666c0 .736.598 1.334 1.333 1.334h8.174A3.661 3.661 0 0 0 12.333 16 3.671 3.671 0 0 0 16 12.333a3.66 3.66 0 0 0-1.333-2.826Zm-14-6.84c0-.368.298-.667.666-.667H4v.667a.667.667 0 1 0 .667.666V2h6v.667a.667.667 0 1 0 .666.666V2h2c.368 0 .667.3.667.667v2H.667v-2ZM1.333 14a.667.667 0 0 1-.666-.667v-8H14v3.739a3.64 3.64 0 0 0-1.667-.405 3.67 3.67 0 0 0-3.666 3.666c0 .6.148 1.166.405 1.667H1.333Zm11 1.333c-1.654 0-3-1.345-3-3 0-1.654 1.346-3 3-3 1.655 0 3 1.346 3 3 0 1.655-1.345 3-3 3Z"
                                fill="#fff"/>
                        <path
                                d="M13.667 12h-1v-1A.333.333 0 1 0 12 11v1h-1a.333.333 0 1 0 0 .666h1v1a.333.333 0 1 0 .667 0v-1h1a.333.333 0 1 0 0-.666Z"
                                fill="#fff"/>
                    </svg>
                </label>
                <input class="mobile-calendar-item__input" id="first-calendar-input-header" type="text"
                       placeholder="<?php _e('Select a start date', 'krop'); ?>">
            </div>
            <div class="mobile-calendar-item">
                <label class="mobile-calendar-item__label" for="second-calendar-input-header">
                    <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M14.667 9.507v-6.84c0-.736-.599-1.334-1.334-1.334h-2v-1a.333.333 0 1 0-.666 0v1h-6v-1a.333.333 0 1 0-.667 0v1H1.333C.598 1.333 0 1.931 0 2.667v10.666c0 .736.598 1.334 1.333 1.334h8.174A3.661 3.661 0 0 0 12.333 16 3.671 3.671 0 0 0 16 12.333a3.66 3.66 0 0 0-1.333-2.826Zm-14-6.84c0-.368.298-.667.666-.667H4v.667a.667.667 0 1 0 .667.666V2h6v.667a.667.667 0 1 0 .666.666V2h2c.368 0 .667.3.667.667v2H.667v-2ZM1.333 14a.667.667 0 0 1-.666-.667v-8H14v3.739a3.64 3.64 0 0 0-1.667-.405 3.67 3.67 0 0 0-3.666 3.666c0 .6.148 1.166.405 1.667H1.333Zm11 1.333c-1.654 0-3-1.345-3-3 0-1.654 1.346-3 3-3 1.655 0 3 1.346 3 3 0 1.655-1.345 3-3 3Z"
                                fill="#fff"/>
                        <path
                                d="M13.667 12h-1v-1A.333.333 0 1 0 12 11v1h-1a.333.333 0 1 0 0 .666h1v1a.333.333 0 1 0 .667 0v-1h1a.333.333 0 1 0 0-.666Z"
                                fill="#fff"/>
                    </svg>
                </label>
                <input class="mobile-calendar-item__input" id="second-calendar-input-header" type="text"
                       placeholder="<?php _e('Select the end date', 'krop'); ?>">
            </div>
        </div>

        <div class="calendar-modal__nav-buttons divider">
            <button class="reset-button" id="reset-button-header">
	            <?php _e('Clear selection', 'krop'); ?>
                <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M18.333 11.884v-8.55c0-.92-.748-1.667-1.666-1.667h-2.5V.417a.416.416 0 1 0-.834 0v1.25h-7.5V.417a.416.416 0 1 0-.833 0v1.25H1.667C.747 1.667 0 2.414 0 3.333v13.334c0 .919.748 1.666 1.667 1.666h10.217A4.576 4.576 0 0 0 15.417 20 4.589 4.589 0 0 0 20 15.417c0-1.42-.65-2.692-1.667-3.533Zm-17.5-8.55c0-.46.374-.834.834-.834H5v.833a.834.834 0 1 0 .833.834V2.5h7.5v.833a.834.834 0 1 0 .834.834V2.5h2.5c.46 0 .833.374.833.833v2.5H.833v-2.5ZM1.667 17.5a.834.834 0 0 1-.834-.833v-10H17.5v4.672a4.55 4.55 0 0 0-2.083-.506 4.589 4.589 0 0 0-4.584 4.584c0 .75.185 1.457.506 2.083H1.667Zm13.75 1.667a3.754 3.754 0 0 1-3.75-3.75 3.754 3.754 0 0 1 3.75-3.75 3.754 3.754 0 0 1 3.75 3.75 3.754 3.754 0 0 1-3.75 3.75Z"
                            fill="#E8BA06"/>
                    <path d="M17.084 15h-3.333a.416.416 0 1 0 0 .833h3.333a.416.416 0 1 0 0-.833Z" fill="#E8BA06"/>
                </svg>
            </button>
            <button class="apply-button" id="apply-button-header">
	            <?php _e('Confirm period', 'krop'); ?>
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