<?php
//breadcrumb

function krop_breadcrumb() {
	global $post;

	//$sep = ' > ';

	if ( ! is_front_page() ) {

		// Start the breadcrumb with a link to your homepage

		echo '<ul class="breadcrumbs">';
		echo '<li class="breadcrumbs__item">';
		echo '<a href="';
		echo get_option( 'home' );
		echo '">';
		echo get_the_title( get_option( 'page_on_front' ) );
		echo '</a></li>';

		// Check if the current page is a category, an archive or a single page. If so show the category or archive name.

		/* if (is_category() || is_single() ){
			 the_category('title_li=');
		 } elseif (is_archive() || is_single()){
			 if ( is_day() ) {
				 printf( __( '%s', 'text_domain' ), get_the_date() );
			 } elseif ( is_month() ) {
				 printf( __( '%s', 'text_domain' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'text_domain' ) ) );
			 } elseif ( is_year() ) {
				 printf( __( '%s', 'text_domain' ), get_the_date( _x( 'Y', 'yearly archives date format', 'text_domain' ) ) );
			 } else {
				 _e( 'Blog Archives', 'text_domain' );
			 }
		 }
	 */
		// If the current page is a news, show its title with the separator

		if ( get_post_type() == 'news' && ! is_archive() && ! is_search() ) {

			echo '<li class="breadcrumbs__item">';
			echo '<a href="';
			echo get_post_type_archive_link( 'news' );
			echo '">';
			echo __( 'News/Announcements', 'krop' );
			echo '</a></li>';

			echo '<li class="breadcrumbs__item breadcrumbs__item--active">';
			the_title();
			echo '</li>';
		}
		if ( get_post_type() == 'places' && ! is_archive() && ! is_search() ) {

			echo '<li class="breadcrumbs__item">';
			echo '<a href="';
			echo get_post_type_archive_link( 'places' );
			echo '">';
			echo __( 'Interesting places', 'krop' );
			echo '</a></li>';

			echo '<li class="breadcrumbs__item breadcrumbs__item--active">';
			the_title();
			echo '</li>';
		}
		if ( get_post_type() == 'brands' && ! is_archive() && ! is_search() ) {

			echo '<li class="breadcrumbs__item">';
			echo '<a href="';
			echo get_post_type_archive_link( 'brands' );
			echo '">';
			echo __( 'Brands/businesses', 'krop' );
			echo '</a></li>';

			echo '<li class="breadcrumbs__item breadcrumbs__item--active">';
			the_title();
			echo '</li>';
		}

		if ( is_post_type_archive( 'news' ) ) {

			echo '<li class="breadcrumbs__item breadcrumbs__item--active">';
			echo __( 'News/Announcements', 'krop' );
			echo '</li>';
		}
		if ( is_post_type_archive( 'brands' ) ) {

			echo '<li class="breadcrumbs__item breadcrumbs__item--active">';
			echo __( 'Brands/Businesses', 'krop' );
			echo '</li>';
		}
		if ( is_post_type_archive( 'places' ) ) {

			echo '<li class="breadcrumbs__item breadcrumbs__item--active">';
			echo __( 'Interesting places', 'krop' );
			echo '</li>';
		}

		if ( is_archive() && is_tax() ) {
			echo '<li class="breadcrumbs__item breadcrumbs__item--active">' . single_term_title( '', false ) . '</li>';
		}

		// If the current page is a event, show its title with the separator

		if ( get_post_type() == 'mec-events' ) {

			echo '<li class="breadcrumbs__item">';
			echo '<a href="';
			echo home_url(splitter_lang_condition( array('ukr' => '/news/', 'eng' => '/eng/news/' ) ));
			echo '">';
			echo __( 'News/Announcements', 'krop' );
			echo '</a></li>';

			echo '<li class="breadcrumbs__item breadcrumbs__item--active">';
			the_title();
			echo '</li>';
		}

		// If the current page is a static page, show its title.

		if ( is_page() && ! is_archive() ) {
			$parent = wp_get_post_parent_id( $post );
			while ( $parent ) {
				echo '<li class="breadcrumbs__item">' . get_the_title( $parent ) . '</li>';
				$parent = wp_get_post_parent_id( $parent );
			}
			echo '<li class="breadcrumbs__item breadcrumbs__item--active">';
			echo the_title();
			echo '</li>';
		}
		if ( is_search() ) {
			echo '<li class="breadcrumbs__item breadcrumbs__item--active">';
			_e( 'Search', 'krop' );
			echo '</li>';
		}

		// if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
		if ( is_home() ) {
			global $post;
			$page_for_posts_id = get_option( 'page_for_posts' );
			if ( $page_for_posts_id ) {
				$post = get_post( $page_for_posts_id );
				setup_postdata( $post );
				the_title();
				rewind_posts();
			}
		}

		echo '</ul>';
	}
}

remove_filter( 'the_excerpt', 'wpautop' );

//custom pagination

function crop_blog_pagination( $custom_query, $pages = '', $range = 5 ) {
	$showitems = ( $range * 2 ) + 1;


	$paged = absint(
		max(
			1,
			get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' )
		)
	);

	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {

		$pages = $custom_query->max_num_pages;

		if ( ! $pages ) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {
		echo '<div class="pagination">';

		if ( $paged > 1 ) {
			echo '<a class="pagination__arrow pagination__arrow--prev" href="' . get_pagenum_link( $paged - 1 ) . '">
         <svg width="22" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" clip-rule="evenodd"
                 d="M22 10c0-.379-.145-.742-.403-1.01a1.35 1.35 0 0 0-.972-.418H4.696l5.904-6.13a1.46 1.46 0 0 0 .403-1.012c0-.38-.145-.743-.403-1.011A1.351 1.351 0 0 0 9.626 0c-.365 0-.715.15-.973.419l-8.25 8.57a1.477 1.477 0 0 0 0 2.022l8.25 8.57c.258.268.608.419.973.419s.716-.15.974-.419c.258-.268.403-.632.403-1.011 0-.38-.145-.743-.403-1.011l-5.904-6.13h15.93c.364 0 .713-.151.971-.419S22 10.379 22 10Z"
                 fill="#6B2A14" />
         </svg>
         <span>' . __( 'Previous page', 'krop' ) . '</span>
     </a>';
		} else {
			echo '<a class="pagination__arrow pagination__arrow--prev inactive" href="javascript:void(0);">
     <svg width="22" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path fill-rule="evenodd" clip-rule="evenodd"
             d="M22 10c0-.379-.145-.742-.403-1.01a1.35 1.35 0 0 0-.972-.418H4.696l5.904-6.13a1.46 1.46 0 0 0 .403-1.012c0-.38-.145-.743-.403-1.011A1.351 1.351 0 0 0 9.626 0c-.365 0-.715.15-.973.419l-8.25 8.57a1.477 1.477 0 0 0 0 2.022l8.25 8.57c.258.268.608.419.973.419s.716-.15.974-.419c.258-.268.403-.632.403-1.011 0-.38-.145-.743-.403-1.011l-5.904-6.13h15.93c.364 0 .713-.151.971-.419S22 10.379 22 10Z"
             fill="#6B2A14" />
     </svg>
     <span>' . __( 'Previous page', 'krop' ) . '</span>
 </a>';
		}

		echo '<div class="pagination__numbers">';

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? '<a class="pagination__link pagination__link--active" href="' . get_pagenum_link( $i ) . '">' . $i . '</a>' : '<a class="pagination__link" href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';
			}
		}

		echo '</div>';

		if ( $paged < $pages ) {
			echo '<a class="pagination__arrow pagination__arrow--next" href="' . get_pagenum_link( $paged + 1 ) . '">
         <span>' . __( 'Next page', 'krop' ) . '</span>
         <svg width="22" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" clip-rule="evenodd"
                 d="M0 10c0-.379.145-.742.403-1.01a1.35 1.35 0 0 1 .972-.418h15.929L11.4 2.442a1.46 1.46 0 0 1-.403-1.012c0-.38.145-.743.403-1.011.258-.268.608-.419.974-.419.365 0 .715.15.973.419l8.25 8.57a1.477 1.477 0 0 1 0 2.022l-8.25 8.57a1.35 1.35 0 0 1-.973.419c-.366 0-.716-.15-.974-.419a1.459 1.459 0 0 1-.403-1.011c0-.38.145-.743.403-1.011l5.904-6.13H1.374a1.35 1.35 0 0 1-.971-.419A1.457 1.457 0 0 1 0 10Z"
                 fill="#6B2A14" />
         </svg>
     </a>
 </div>';
		} else {
			echo '<a class="pagination__arrow pagination__arrow--next inactive" href="javascript:void(0);">
 <span>' . __( 'Next page', 'krop' ) . '</span>
 <svg width="22" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
     <path fill-rule="evenodd" clip-rule="evenodd"
         d="M0 10c0-.379.145-.742.403-1.01a1.35 1.35 0 0 1 .972-.418h15.929L11.4 2.442a1.46 1.46 0 0 1-.403-1.012c0-.38.145-.743.403-1.011.258-.268.608-.419.974-.419.365 0 .715.15.973.419l8.25 8.57a1.477 1.477 0 0 1 0 2.022l-8.25 8.57a1.35 1.35 0 0 1-.973.419c-.366 0-.716-.15-.974-.419a1.459 1.459 0 0 1-.403-1.011c0-.38.145-.743.403-1.011l5.904-6.13H1.374a1.35 1.35 0 0 1-.971-.419A1.457 1.457 0 0 1 0 10Z"
         fill="#6B2A14" />
 </svg>
</a>
</div>';
		}

	}
}

//breadcrumbs for event

add_action( 'mec_before_main_content', 'krop_breadcrums' );
function krop_breadcrums() {
	return '<div class="container">' . krop_breadcrumb() . '</div>';

}

function print_rating( int $rating, $max_rating = 5 ): void {
    $rating = min($rating, $max_rating);
    $rate = 1;
    while ( $rate <= $max_rating  ) {
        echo '<span class="star-icon '. ( $rate <= $rating ? 'star-fill' : 'star')  .'"></span>';
        $rate++;
    }
    echo_formatted_rating($rating);
}

function search_tax_query($taxonomy, $args) {
	if ($_GET[$taxonomy] !== 'all') {
		$args['tax_query']['relation'] = 'AND';
		$query = $_GET[$taxonomy];
		if ($taxonomy == 'category-news') {
			$taxonomy = 'catecory-news';
		} elseif ($taxonomy == 'places_districts') {
			$taxonomy = 'city_district';
		}
		$categories = explode(',', $query);
		$tax_query = array(
			'taxonomy' => $taxonomy,
			'field'    => 'id',
			'terms'    => $categories
		);
		$args['tax_query'][] = $tax_query;
	}
	return $args;
}
function search_checkboxes($query, $args) {
	if (!empty($_GET[$query])) {
		$args['meta_query']['relation'] = 'AND';
		$args['meta_query'][] = array(
			'key' => $query,
			'value' => array('0', ''),
			'compare' => 'NOT IN',
		);
	}
	return $args;
}

//add meta field to brand
add_action('save_post', 'update_brands');
function update_brands($post_id) {
	if (get_post_type($post_id) == 'brands') {
		$works_hours = get_field('works_hours', $post_id);
		if ($works_hours == '24') {
			update_post_meta($post_id, 'time_from', '00:00:00');
			update_post_meta($post_id, 'time_to', '23:59:59');
			update_post_meta($post_id, 'night_time_work', true);
		} elseif ($works_hours == 'standard') {
			update_post_meta($post_id, 'time_from', '08:00:00');
			update_post_meta($post_id, 'time_to', '20:00:00');
			update_post_meta($post_id, 'night_time_work', false);
		} elseif ($works_hours == 'night') {
			update_post_meta($post_id, 'time_from', '20:00:00');
			update_post_meta($post_id, 'time_to', '08:00:00');
			update_post_meta($post_id, 'night_time_work', true);
		} elseif ($works_hours == 'custom') {
			if (get_field('time_from', $post_id) >= get_field('time_to', $post_id)) {
				update_post_meta($post_id, 'night_time_work', true);
			} else {
				update_post_meta($post_id, 'night_time_work', false);
			}
		}
	}
}


add_filter('date_i18n', 'mec_month_ukrainian_lang', 10, 4);
function mec_month_ukrainian_lang( $date, $format, $timestamp, $gmt ) {
	do_action('qm/debug', array( wp_doing_ajax(), $_POST['action'] ?? false ));
	if (is_post_type_archive('news') || ( isset( $_POST['action'] ) && $_POST['action'] === 'mec_monthly_view_load_month' )) {
		$mouths = array(
			'Січень' => 'Січня',
			'Лютий' => 'Лютого',
			'Березень' => 'Березня',
			'Квітень' => 'Квітня',
			'Травень' => 'Травня',
			'Червень' => 'Червня',
			'Липень' => 'Липня',
			'Серпень' => 'Серпня',
			'Вересень' => 'Вересня',
			'Жовтень' => 'Жовтня',
			'Листопад' => 'Листопаду',
			'Грудень' => 'Грудня',
		);
		return $mouths[ $date ] ?? $date;
	}
	return $date;
}