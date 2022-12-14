<div class="search-block search-block--main" id="search">
    <div class="search-block__content">
        <div class="search-block__form divider">
			<?php get_template_part( 'template-parts/search/searchform', 'header' ); ?>
            <!-- тут змінено id -->
            <div class="search-block__form-chip advanced-search-button" id="main-menu-search-button">
                <?php _e('Advanced search', 'krop'); ?>
                <svg width="12" height="12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.243 10.243 6 6m0 0L1.757 1.757M6 6l4.243-4.243M6 6l-4.243 4.243" stroke="#6B2A14"
                          stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>

        <!-- тут змінено id -->
        <div class="search-block__wrap open" id="main-search-block-bottom">
			<?php get_template_part( 'template-parts/search/search', 'advanced-header' ); ?>
        </div>
    </div>
</div>