<form role="search" method="get" id="searchform-header" class="search-form"
      action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input name="s" id="s" value="<?php echo get_search_query() ?>" placeholder="<?php _e('Enter a query, such as City Council', 'krop'); ?>"
           type="text">
    <button class="btn btn--primary" type="submit">
        <span><?php _e('Search', 'krop'); ?></span>
        <svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="m14 14-2.99-2.996L14 14Zm-1.333-7A5.667 5.667 0 1 1 1.333 7a5.667 5.667 0 0 1 11.334 0v0Z"
                  stroke="#fff" stroke-width="2" stroke-linecap="round"></path>
        </svg>
    </button>
</form>
