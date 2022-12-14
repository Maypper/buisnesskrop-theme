<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post" id="advanced-search">
	<?php if ( ! is_post_type_archive( [ 'brands', 'places' ] ) ): ?>
        <div class="search-block__settings divider">
            <p><?php _e('Select a search category', 'krop'); ?></p>
            <div class="nav-tabs">
                <div data-tab="1" data-value="brands" class="nav-tabs__item nav-tabs__item--active"><?php _e('Brands/Businesses', 'krop'); ?></div>
                <div data-tab="2" data-value="news" class="nav-tabs__item"><?php _e('News', 'krop'); ?></div>
                <div data-tab="3" data-value="places" class="nav-tabs__item"><?php _e('Interesting places', 'krop'); ?></div>
                <input type="hidden" class="search-post-type" name="search_post_type" value="brands">
            </div>
        </div>
	<?php else: ?>
        <input type="hidden" class="search-post-type" name="search_post_type" value="<?php echo get_post_type(); ?>">
	<?php endif; ?>

    <div class="search-block__tabs">
        <div class="tab-content">
			<?php if ( ! is_post_type_archive( [ 'brands', 'places' ] ) ): ?>
                <div data-tab-content="1"
                     class="tab-content__item tab-content__item--1 tab-content__item--active">
                    <p><?php _e( 'Search settings', 'krop' ); ?></p>
                    <div class="tab-content__item-wrap divider">
                        <div class="search-block__select-list">
                            <div class="custom-select custom-select-single" id="brands-category"></div>
                            <div class="custom-select custom-multiselect" id="brands-districts"></div>
                            <div class=" custom-select custom-select-hours" id="brands-work-hours"></div>
                        </div>
                        <div class="search-block__checkbox-list">
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-1" name="checkbox-1"
                                       value="<?php _e('Show on map', 'krop'); ?>">
                                <label for="checkbox-1"><?php _e('Show on map', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-2" name="url"
                                       value="<?php _e('Has site', 'krop'); ?>">
                                <label for="checkbox-2"><?php _e('Has site', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-3" name="images"
                                       value="<?php _e('Has photos', 'krop'); ?>">
                                <label for="checkbox-3"><?php _e('Has photos', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-4" name="order_page"
                                       value="<?php _e('Order online', 'krop'); ?>">
                                <label for="checkbox-4"><?php _e('Order online', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-5" name="a11y"
                                       value="<?php _e('Accessible for people with disabilities', 'krop'); ?>">
                                <label for="checkbox-5"><?php _e('Accessible for people with disabilities', 'krop'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="search-block__chips chips">
                        <div class="chips__item">
                            <p class="text">text</p>
                            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.243 10.243 6 6m0 0L1.757 1.757M6 6l4.243-4.243M6 6l-4.243 4.243"
                                      stroke="#6B2A14" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div data-tab-content="2" class="tab-content__item tab-content__item--2">
                    <p><?php _e( 'Search settings', 'krop' ); ?></p>
                    <div class="tab-content__item-wrap divider">
                        <div class="search-block__select-list">
                            <div class="custom-select custom-select-single" id="news-announcement"></div>
                            <div class="calendar-select" id="calendar-select">
                                <input id="datepicker" class="datepicker" name="date_range" readonly=""
                                       placeholder="<?php _e('Period or date', 'krop'); ?>">
                                <button>
                                    <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M14.667 9.507v-6.84c0-.736-.599-1.334-1.334-1.334h-2v-1a.333.333 0 1 0-.666 0v1h-6v-1a.333.333 0 1 0-.667 0v1H1.333C.598 1.333 0 1.931 0 2.667v10.666c0 .736.598 1.334 1.333 1.334h8.174A3.661 3.661 0 0 0 12.333 16 3.671 3.671 0 0 0 16 12.333a3.66 3.66 0 0 0-1.333-2.826Zm-14-6.84c0-.368.298-.667.666-.667H4v.667a.667.667 0 1 0 .667.666V2h6v.667a.667.667 0 1 0 .666.666V2h2c.368 0 .667.3.667.667v2H.667v-2ZM1.333 14a.667.667 0 0 1-.666-.667v-8H14v3.739a3.64 3.64 0 0 0-1.667-.405 3.67 3.67 0 0 0-3.666 3.666c0 .6.148 1.166.405 1.667H1.333Zm11 1.333c-1.654 0-3-1.345-3-3 0-1.654 1.346-3 3-3 1.655 0 3 1.346 3 3 0 1.655-1.345 3-3 3Z"
                                                fill="#fff"/>
                                        <path
                                                d="M13.666 12h-1v-1A.333.333 0 1 0 12 11v1h-1a.333.333 0 1 0 0 .667h1v1a.333.333 0 1 0 .666 0v-1h1a.333.333 0 1 0 0-.667Z"
                                                fill="#fff"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="search-block__chips chips">
                        <div class="chips__item">
                            <p class="text">text</p>
                            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.243 10.243 6 6m0 0L1.757 1.757M6 6l4.243-4.243M6 6l-4.243 4.243"
                                      stroke="#6B2A14" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div data-tab-content="3" class="tab-content__item tab-content__item--3">
                    <p><?php _e( 'Search settings', 'krop' ); ?></p>
                    <div class="tab-content__item-wrap divider">
                        <div class="search-block__select-list">
                            <div class="custom-select custom-select-single" id="places-category"></div>
                            <div class="custom-select custom-multiselect" id="places-districts"></div>
                        </div>
                        <div class="search-block__checkbox-list">
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-6" name="checkbox-6"
                                       value="<?php _e('Now open', 'krop'); ?>">
                                <label for="checkbox-6"><?php _e('Now open', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-7" name="a11y"
                                       value="<?php _e('Accessible for people with disabilities', 'krop'); ?>">
                                <label for="checkbox-7"><?php _e('Accessible for people with disabilities', 'krop'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="search-block__chips chips">
                        <div class="chips__item">
                            <p class="text">text</p>
                            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.243 10.243 6 6m0 0L1.757 1.757M6 6l4.243-4.243M6 6l-4.243 4.243"
                                      stroke="#6B2A14" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
			<?php elseif ( is_post_type_archive( 'brands' ) ): ?>
                <div class="tab-content__item tab-content__item--1 tab-content__item--active">
                    <p><?php _e( 'Search settings', 'krop' ); ?></p>
                    <div class="tab-content__item-wrap divider">
                        <div class="search-block__select-list">
                            <div class="custom-select custom-select-single" id="brands-category"></div>
                            <div class="custom-select custom-multiselect" id="brands-districts"></div>
                            <div class="custom-select custom-select-hours" id="brands-work-hours"></div>
                        </div>
                        <div class="search-block__checkbox-list">
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-1" name="checkbox-1"
                                       value="<?php _e('Show on map', 'krop'); ?>">
                                <label for="checkbox-1"><?php _e('Show on map', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-2" name="url"
                                       value="<?php _e('Has site', 'krop'); ?>">
                                <label for="checkbox-2"><?php _e('Has site', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-3" name="images"
                                       value="<?php _e('Has photos', 'krop'); ?>">
                                <label for="checkbox-3"><?php _e('Has photos', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-4" name="order_page"
                                       value="<?php _e('Order online', 'krop'); ?>">
                                <label for="checkbox-4"><?php _e('Order online', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-5" name="a11y"
                                       value="<?php _e('Accessible for people with disabilities', 'krop'); ?>">
                                <label for="checkbox-5"><?php _e('Accessible for people with disabilities', 'krop'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="search-block__chips chips">
                        <div class="chips__item">
                            <p class="text">text</p>
                            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.243 10.243 6 6m0 0L1.757 1.757M6 6l4.243-4.243M6 6l-4.243 4.243"
                                      stroke="#6B2A14" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
			<?php elseif ( is_post_type_archive( 'places' ) ): ?>
                <div class="tab-content__item tab-content__item--3 tab-content__item--active">
                    <p><?php _e( 'Search settings', 'krop' ); ?></p>
                    <div class="tab-content__item-wrap divider">
                        <div class="search-block__select-list">
                            <div class="custom-select custom-select-single" id="places-category"></div>
                            <div class="custom-select custom-multiselect" id="places-districts"></div>
                        </div>
                        <div class="search-block__checkbox-list">
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-6" name="checkbox-6"
                                       value="<?php _e('Now open', 'krop'); ?>">
                                <label for="checkbox-6"><?php _e('Now open', 'krop'); ?></label>
                            </div>
                            <div class="checkbox">
                                <input class="custom-checkbox" type="checkbox" id="checkbox-7" name="a11y"
                                       value="<?php _e('Accessible for people with disabilities', 'krop'); ?>">
                                <label for="checkbox-7"><?php _e('Accessible for people with disabilities', 'krop'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="search-block__chips chips">
                        <div class="chips__item">
                            <p class="text">text</p>
                            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.243 10.243 6 6m0 0L1.757 1.757M6 6l4.243-4.243M6 6l-4.243 4.243"
                                      stroke="#6B2A14" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
			<?php endif; ?>
        </div>
    </div>
</form>