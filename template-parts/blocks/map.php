<?php
$title               = get_field( 'title' );
$brands_cats         = get_terms( array(
		'taxonomy' => 'category-brands',
		'hide_empty' => true,
	) );
$places_cats         = get_terms( array(
	'taxonomy' => 'tags-places'
) );
$map_container_class = '';
if ( is_search() ) {
	$map_container_class = 'search__map';
} elseif ( ! is_front_page() && ! is_home() ) {
	$map_container_class = 'catalog-content__map';
}
?>
<div class="main-page__map <?php echo $map_container_class; ?>">
    <div class="container">
        <h2 class="map__title"><?php
			if ( is_search() ) {
				_e( 'Results on map', 'krop' );
			} elseif ( is_post_type_archive( 'brands' ) ) {
				_e( 'Brands/businesses on map', 'krop' );
			} else {
				echo $title;
			}
			?></h2>
    </div>
    <section class="map">
        <div class="container">
            <div class="open-modal hidden">
				<?php _e( 'Map navigation', 'krop' ); ?>
                <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M19.6702 2.65364L13.3065 0.835486C13.2243 0.812176 13.1379 0.812474 13.0571 0.835486L6.81819 2.61802L0.57929 0.835486C0.443438 0.796878 0.294759 0.823937 0.180682 0.909633C0.0670313 0.995713 0 1.1302 0 1.2727V14.9091C0 15.1119 0.134489 15.2904 0.32983 15.3463L6.69346 17.1645C6.73428 17.176 6.77647 17.1818 6.81819 17.1818C6.86042 17.1818 6.90243 17.176 6.94292 17.1645L13.1818 15.3819L19.4207 17.1645C19.4615 17.176 19.5037 17.1818 19.5454 17.1818C19.6431 17.1818 19.7394 17.1503 19.8193 17.0903C19.933 17.0042 20 16.8697 20 16.7272V3.09086C20 2.88802 19.8655 2.70959 19.6702 2.65364ZM6.36363 16.1245L0.909077 14.5664V1.87551L6.36363 3.4336V16.1245ZM12.7273 14.5661L7.27275 16.1245V3.4339L12.7273 1.87543V14.5661ZM19.0909 16.1245L13.6364 14.5664V1.87551L19.0909 3.4336V16.1245Z"
                            fill="#E8BA06"/>
                </svg>
            </div>
            <div class="map-modal">
                <div class="map-modal__close">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.2426 10.2426L6 6M6 6L1.75736 1.75736M6 6L10.2426 1.75736M6 6L1.75736 10.2426"
                              stroke="#E8BA06"
                              stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="map-modal__wrapper">

                    <div class="map-modal-allmarkers">
                        <div class="map-modal__search d-flex">
                            <form role="search" method="get" id="searchform-map" action="<?php echo home_url( '/' ) ?>">
                                <input type="search" name="search"
                                       placeholder="<?php _e( 'Enter a query', 'krop' ); ?>">
                                <button type="submit" class="submit-btn">
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M17.5003 17.5001L13.762 13.7551L17.5003 17.5001ZM15.8337 8.75008C15.8337 10.6287 15.0874 12.4304 13.759 13.7588C12.4306 15.0871 10.6289 15.8334 8.75033 15.8334C6.87171 15.8334 5.07004 15.0871 3.74165 13.7588C2.41327 12.4304 1.66699 10.6287 1.66699 8.75008C1.66699 6.87146 2.41327 5.06979 3.74165 3.74141C5.07004 2.41303 6.87171 1.66675 8.75033 1.66675C10.6289 1.66675 12.4306 2.41303 13.759 3.74141C15.0874 5.06979 15.8337 6.87146 15.8337 8.75008V8.75008Z"
                                                stroke="white" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="map-modal__switch">
                            <a class="switch-btn<?php if (!is_search() || is_search() && $_GET['search_post_type'] != 'places') { echo ' active';} ?>"><?php _e( 'Brands/Businesses', 'krop' ); ?></a>
                            <a class="switch-btn<?php if (is_search() && $_GET['search_post_type'] == 'places') { echo ' active';} ?>"><?php _e( 'Interesting places', 'krop' ); ?></a>
                        </div>
                        <div class="map-modal__info">
			                <?php if ( $brands_cats ): ?>
                                <div class="brands-business info__categories categories">
					                <?php
					                foreach (
						                $brands_cats

						                as $brands_cat
					                ):
						                $cat_icon = get_field( 'cat_icon', $brands_cat );
						                $cat_icon_hover = get_field( 'cat_icon_hover', $brands_cat );
						                if ( $cat_icon ) {
							                $svg_code = file_get_contents( $cat_icon );
						                }
						                $show_cat = true;
						                if (is_search()) {
							                $concrete_args = array(
								                'numberposts' => 1,
								                'post_type'   => 'brands',
								                'tax_query' => array(
                                                    'relation' => 'AND',
									                array(
										                'taxonomy' => 'category-brands',
										                'field' => 'term_id',
										                'terms' => $brands_cat->term_id,
										                'include_children' => false
									                )
								                ),
								                's' => get_query_var('s'),
							                );
							                if ( !empty( $_GET['city_district'] ) ) {
								                $concrete_args = search_tax_query('city_district', $concrete_args);
							                }
							                if (!empty($_GET['work_hours'])) {
								                $concrete_args['meta_query'] = array(
									                'relation' => 'AND',
								                );

								                if ($_GET['work_hours'] == 'custom') {
									                if (!empty($_GET['time_from'])) {
										                $concrete_args['meta_query'][] = array(
											                'key'     => 'time_from',
											                'value'   => $_GET['time_from'],
											                'compare' => '<=',
											                'type'    => 'TIME',
										                );
									                }
									                if (!empty($_GET['time_to'])) {
										                $concrete_args['meta_query'][] = array(
											                'key'     => 'time_to',
											                'value'   => $_GET['time_to'],
											                'compare' => '>=',
											                'type'    => 'TIME',
										                );
									                }
									                if ($_GET['time_from'] >= $_GET['time_to']) {
										                $concrete_args['meta_query'][] = array(
											                'key'     => 'night_time_work',
											                'value'   => '1',
										                );
									                }
								                } else {
									                $concrete_args['meta_query'][] = array(
										                'key' => 'works_hours',
										                'value' => $_GET['work_hours'],
									                );

								                }
							                }
							                $concrete_args = search_checkboxes('url', $concrete_args);
							                $concrete_args = search_checkboxes('images', $concrete_args);
							                $concrete_args = search_checkboxes('order_page', $concrete_args);
							                $concrete_args = search_checkboxes('a11y', $concrete_args);
							                $posts_by_s = get_posts($concrete_args);
							                if (empty($posts_by_s)) {
								                $show_cat = false;
							                }
                                            if (isset($_GET['category-brands']) && !empty($_GET['category-brands'])) {
                                                $cats = explode(',', $_GET['category-brands']);
                                                foreach ($cats as $cat) {
                                                    if ($cat != $brands_cat->term_id) {
	                                                    $show_cat = false;
                                                    }
                                                }
                                            }
						                }
						                if ($show_cat):
							                ?>
                                            <div class="categories__item item"
                                                 data-category="<?php echo $brands_cat->slug; ?>">
								                <?php
								                if ( $cat_icon ) { ?>
                                                    <div class="custom-svg custom-svg-<?php echo $brands_cat->term_id; ?>"
                                                         style="background-image: url('<?php echo $cat_icon; ?>')">
                                                    </div>
                                                    <style>
                                                        .custom-svg-<?php echo $brands_cat->term_id; ?>:hover, .categories__item.active .custom-svg-<?php echo $brands_cat->term_id; ?> {
                                                            background-image: url('<?php echo $cat_icon_hover ?>') !important;
                                                        }
                                                    </style>
									                <?php
								                } else {
									                echo '<div class="item__circle" style="--m-color:#37bce533;--h-color:#37bce5;">
                                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M38.5714 8.5714H31.4279L31.425 2.8571L28.5715 0H11.2857V2.8571H28.5714V8.5714H11.4286L11.2857 0L8.5714 2.8571L8.57353 8.5714H1.42855C0.638933 8.5714 0 9.21043 0 10V35.7143C0 38.0776 1.92248 40.0001 4.28575 40.0001H35.7143C38.0776 40.0001 40.0001 38.0776 40.0001 35.7143V10C40 9.21043 39.3611 8.5714 38.5714 8.5714ZM37.1429 35.7143C37.1429 36.5025 36.5025 37.1429 35.7143 37.1429H4.28575C3.49755 37.1429 2.8572 36.5025 2.8572 35.7143V31.4286H37.1429V35.7143ZM37.1429 28.5715H2.8571V11.4286H37.1428L37.1429 28.5715Z" fill="#37BBE5" style="--h-fill:#fff"></path>
                                                    </svg>
                                                 </div>';
								                }
								                ?>
                                                <div class="item__title">
									                <?php echo $brands_cat->name; ?>
                                                </div>
                                            </div>
						                <?php endif; endforeach; ?>
                                </div>
			                <?php
			                endif;
			                if ( $places_cats ):
				                ?>
                                <div class="map-interesting-places info__categories categories <?php if (!is_search() || is_search() && $_GET['search_post_type'] != 'places') { echo 'hidden';} ?>">
					                <?php foreach ( $places_cats as $places_cat ): ?>
                                        <div class="categories__item item"
                                             data-category="<?php echo $places_cat->slug; ?>">
                                            <div class="item__circle" style="--m-color:#e8ba0633; --h-color:#e8ba06;">
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_541_330)">
                                                        <path
                                                                d="M39.3384 10.1467L20.5884 0.14671C20.2197 -0.0485777 19.7803 -0.0485777 19.4116 0.14671L0.661634 10.1467C0.253936 10.364 0 10.7888 0 11.2502V17.5002H2.49996V32.7659C1.04023 33.3135 0 34.6646 0 36.2503V40.0003H40V36.2503C40 34.6646 38.9598 33.3136 37.5 32.7659V17.5002H40V11.2502C40 10.7888 39.7462 10.364 39.3384 10.1467ZM16.25 17.5002V32.5002H10V17.5002H16.25ZM30.0001 17.5002V32.5002H23.7501V17.5002H30.0001ZM21.25 32.5002H18.7501V17.5002H21.25V32.5002ZM7.49997 32.5002H5.00001V17.5002H7.49997V32.5002ZM37.5 37.5003H2.50005V36.2503C2.50005 35.5606 3.14092 35.0003 3.92828 35.0003H36.0718C36.8592 35.0003 37.5 35.5606 37.5 36.2503V37.5003ZM35 32.5002H32.5V17.5002H35V32.5002ZM2.50005 15.0003V11.9998L20 2.66752L37.5 11.9998V15.0003H2.50005Z"
                                                                fill="#e8ba06" style="--h-fill:#fff"/>
                                                        <path
                                                                d="M21.7677 6.98226C22.744 7.95861 22.744 9.54149 21.7677 10.5177C20.7913 11.4941 19.2084 11.4941 18.2322 10.5177C17.2558 9.5414 17.2558 7.95852 18.2322 6.98226C19.2084 6.00591 20.7914 6.00591 21.7677 6.98226Z"
                                                                fill="#e8ba06" style="--h-fill:#fff"/>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_541_330">
                                                            <rect width="40" height="40" fill="white"/>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </div>
                                            <div class="item__title">
								                <?php echo $places_cat->name; ?>
                                            </div>
                                        </div>
					                <?php endforeach; ?>
                                </div>
			                <?php endif; ?>
                            <div class="map-category__wrapper">
                                <h3 class="map-category__head"></h3>

                                <div class="map-category">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="map-modal-individualmarker from-marker hidden">
                        <div class="from-marker__forward-button">
                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M22 10C22 9.62119 21.8552 9.25789 21.5973 8.99003C21.3395 8.72217 20.9898 8.57169 20.6252 8.57169H4.69618L10.5998 2.44137C10.8579 2.17317 11.003 1.80941 11.003 1.43012C11.003 1.05083 10.8579 0.687071 10.5998 0.418872C10.3416 0.150673 9.99147 0 9.62638 0C9.26129 0 8.91115 0.150673 8.65299 0.418872L0.403912 8.98875C0.275877 9.12143 0.174297 9.27905 0.104987 9.45257C0.0356769 9.6261 0 9.81213 0 10C0 10.1879 0.0356769 10.3739 0.104987 10.5474C0.174297 10.721 0.275877 10.8786 0.403912 11.0112L8.65299 19.5811C8.91115 19.8493 9.26129 20 9.62638 20C9.99147 20 10.3416 19.8493 10.5998 19.5811C10.8579 19.3129 11.003 18.9492 11.003 18.5699C11.003 18.1906 10.8579 17.8268 10.5998 17.5586L4.69618 11.4283H20.6252C20.9898 11.4283 21.3395 11.2778 21.5973 11.01C21.8552 10.7421 22 10.3788 22 10Z"
                                      fill="#6B2A14"/>
                            </svg>
                            <a>До списку брендів/бізнесів</a>
                        </div>
                        <div class="from-marker__rating-stars d-flex">
                            <div class="stars">
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M4.28912 18.3386C3.83074 18.5737 3.31062 18.1616 3.40324 17.6356L4.38887 12.0187L0.205303 8.03342C-0.185384 7.66055 0.0176783 6.97892 0.541366 6.9053L6.35774 6.0788L8.95124 0.940483C9.18518 0.477358 9.81812 0.477358 10.0521 0.940483L12.6456 6.0788L18.4619 6.9053C18.9856 6.97892 19.1887 7.66055 18.7968 8.03342L14.6144 12.0187L15.6001 17.6356C15.6927 18.1616 15.1726 18.5737 14.7142 18.3386L9.49987 15.6596L4.28793 18.3386H4.28912Z"
                                            fill="#E8BA06"/>
                                </svg>
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M4.28912 18.3386C3.83074 18.5737 3.31062 18.1616 3.40324 17.6356L4.38887 12.0187L0.205303 8.03342C-0.185384 7.66055 0.0176783 6.97892 0.541366 6.9053L6.35774 6.0788L8.95124 0.940483C9.18518 0.477358 9.81812 0.477358 10.0521 0.940483L12.6456 6.0788L18.4619 6.9053C18.9856 6.97892 19.1887 7.66055 18.7968 8.03342L14.6144 12.0187L15.6001 17.6356C15.6927 18.1616 15.1726 18.5737 14.7142 18.3386L9.49987 15.6596L4.28793 18.3386H4.28912Z"
                                            fill="#E8BA06"/>
                                </svg>
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M4.28912 18.3386C3.83074 18.5737 3.31062 18.1616 3.40324 17.6356L4.38887 12.0187L0.205303 8.03342C-0.185384 7.66055 0.0176783 6.97892 0.541366 6.9053L6.35774 6.0788L8.95124 0.940483C9.18518 0.477358 9.81812 0.477358 10.0521 0.940483L12.6456 6.0788L18.4619 6.9053C18.9856 6.97892 19.1887 7.66055 18.7968 8.03342L14.6144 12.0187L15.6001 17.6356C15.6927 18.1616 15.1726 18.5737 14.7142 18.3386L9.49987 15.6596L4.28793 18.3386H4.28912Z"
                                            fill="#E8BA06"/>
                                </svg>
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M4.28912 18.3386C3.83074 18.5737 3.31062 18.1616 3.40324 17.6356L4.38887 12.0187L0.205303 8.03342C-0.185384 7.66055 0.0176783 6.97892 0.541366 6.9053L6.35774 6.0788L8.95124 0.940483C9.18518 0.477358 9.81812 0.477358 10.0521 0.940483L12.6456 6.0788L18.4619 6.9053C18.9856 6.97892 19.1887 7.66055 18.7968 8.03342L14.6144 12.0187L15.6001 17.6356C15.6927 18.1616 15.1726 18.5737 14.7142 18.3386L9.49987 15.6596L4.28793 18.3386H4.28912Z"
                                            fill="#E8BA06"/>
                                </svg>
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M4.28912 18.3386C3.83074 18.5737 3.31062 18.1616 3.40324 17.6356L4.38887 12.0187L0.205303 8.03342C-0.185384 7.66055 0.0176783 6.97892 0.541366 6.9053L6.35774 6.0788L8.95124 0.940483C9.18518 0.477358 9.81812 0.477358 10.0521 0.940483L12.6456 6.0788L18.4619 6.9053C18.9856 6.97892 19.1887 7.66055 18.7968 8.03342L14.6144 12.0187L15.6001 17.6356C15.6927 18.1616 15.1726 18.5737 14.7142 18.3386L9.49987 15.6596L4.28793 18.3386H4.28912Z"
                                            fill="#E8BA06"/>
                                </svg>
                            </div>
                            <div class="count">
                                5.0
                            </div>
                        </div>
                        <div class="from-marker__name-of-brand">

                        </div>
                        <div class="from-marker__category-of-brand">
                        </div>
                        <div class="from-marker__another-text">
                        </div>
                        <div class="from-marker__information information">
                            <div class="information__title">
                                <div class="bold-text space">Адреса</div>
                                <div class="bold-text space">Телефон</div>
                                <div class="bold-text">Пошта</div>
                            </div>
                            <div class="information__items">
                                <div class="address__text text">
                                    <a class="brand-address-item" href="">

                                    </a>
                                </div>
                                <div class="phone__text text">
                                    <a class="brand-phone-item" href="">

                                    </a>
                                </div>
                                <div class="mail__text">
                                    <a class="brand-mail-item" href="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="from-marker__links d-md-flex align-items-center">
                            <div class="bold-text">Посилання</div>
                            <div class="links d-flex align-items-center">
                                <a href="#" target="_blank" class="facebook">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M16.5 5.66667V12.3333C16.5 13.4384 16.061 14.4982 15.2796 15.2796C14.4982 16.061 13.4384 16.5 12.3333 16.5H5.66665C4.56158 16.5 3.50177 16.061 2.72037 15.2796C1.93897 14.4982 1.49998 13.4384 1.49998 12.3333V5.66667C1.49998 4.5616 1.93897 3.50179 2.72037 2.72039C3.50177 1.93899 4.56158 1.5 5.66665 1.5H12.3333C13.4384 1.5 14.4982 1.93899 15.2796 2.72039C16.061 3.50179 16.5 4.5616 16.5 5.66667Z"
                                                stroke="#6B2A14" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        <path d="M8.16666 16.5V9.00002C8.16666 7.17669 8.58332 5.66669 11.5 5.66669"
                                              stroke="#6B2A14"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.49998 9.83331H11.5" stroke="#6B2A14" stroke-width="1.5"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a href="#" target="_blank" class="instagram">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M10 14C11.0609 14 12.0783 13.5786 12.8284 12.8284C13.5786 12.0783 14 11.0609 14 10C14 8.93913 13.5786 7.92172 12.8284 7.17157C12.0783 6.42143 11.0609 6 10 6C8.93913 6 7.92172 6.42143 7.17157 7.17157C6.42143 7.92172 6 8.93913 6 10C6 11.0609 6.42143 12.0783 7.17157 12.8284C7.92172 13.5786 8.93913 14 10 14V14Z"
                                                stroke="#6B2A14" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        <path
                                                d="M1 14V6C1 4.67392 1.52678 3.40215 2.46447 2.46447C3.40215 1.52678 4.67392 1 6 1H14C15.3261 1 16.5979 1.52678 17.5355 2.46447C18.4732 3.40215 19 4.67392 19 6V14C19 15.3261 18.4732 16.5979 17.5355 17.5355C16.5979 18.4732 15.3261 19 14 19H6C4.67392 19 3.40215 18.4732 2.46447 17.5355C1.52678 16.5979 1 15.3261 1 14Z"
                                                stroke="#6B2A14" stroke-width="1.5"/>
                                        <path d="M15.5 4.50819L15.5083 4.49902" stroke="#6B2A14" stroke-width="1.5"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a href="#" target="_blank" class="youtube">
                                    <svg width="22" height="16" viewBox="0 0 22 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13 8L9.5 10V6L13 8Z" fill="#6B2A14" stroke="#6B2A14"
                                              stroke-width="1.5" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                        <path
                                                d="M1 8.70702V7.29202C1 4.39702 1 2.94902 1.905 2.01802C2.811 1.08602 4.237 1.04602 7.088 0.965024C8.438 0.927024 9.818 0.900024 11 0.900024C12.181 0.900024 13.561 0.927024 14.912 0.965024C17.763 1.04602 19.189 1.08602 20.094 2.01802C21 2.94902 21 4.39802 21 7.29202V8.70702C21 11.603 21 13.05 20.095 13.982C19.189 14.913 17.764 14.954 14.912 15.034C13.562 15.073 12.182 15.1 11 15.1C9.819 15.1 8.439 15.073 7.088 15.034C4.237 14.954 2.811 14.914 1.905 13.982C1 13.05 1 11.602 1 8.70802V8.70702Z"
                                                stroke="#6B2A14" stroke-width="1.5"/>
                                    </svg>
                                </a>
                                <a href="#" target="_blank" class="viber">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.72">
                                            <path
                                                    d="M11.3981 0.00373641C9.47212 0.0269864 5.33137 0.343486 3.01537 2.46824C1.29262 4.17524 0.691116 6.69899 0.620616 9.81974C0.562116 12.9292 0.491616 18.7687 6.12037 20.3587V22.7805C6.12037 22.7805 6.08512 23.7495 6.72562 23.9482C7.51462 24.198 7.96387 23.4525 8.71387 22.6515L10.1126 21.0697C13.9639 21.39 16.9136 20.652 17.2534 20.5425C18.0349 20.2927 22.4366 19.7302 23.1559 13.89C23.8939 7.85849 22.7966 4.05824 20.8159 2.33924H20.8039C20.2061 1.78874 17.8039 0.0382364 12.4369 0.0187364C12.4369 0.0187364 12.0386 -0.00826359 11.3981 0.00298641V0.00373641ZM11.4641 1.69949C12.0109 1.69574 12.3431 1.71899 12.3431 1.71899C16.8859 1.73099 19.0541 3.09824 19.5656 3.55874C21.2336 4.98824 22.0931 8.41424 21.4639 13.4497C20.8661 18.3322 17.2961 18.6412 16.6354 18.852C16.3541 18.942 13.7561 19.5825 10.4831 19.3717C10.4831 19.3717 8.04562 22.3132 7.28362 23.0707C7.16287 23.2035 7.02187 23.2425 6.93187 23.223C6.80287 23.1915 6.76387 23.0317 6.77137 22.8127L6.79462 18.7935C2.02087 17.4735 2.30212 12.4927 2.35312 9.89099C2.41162 7.28924 2.89987 5.16074 4.35337 3.71924C6.31012 1.94999 9.82612 1.71149 11.4626 1.69949H11.4641ZM11.8241 4.30049C11.7848 4.30009 11.7458 4.30748 11.7094 4.32221C11.673 4.33695 11.6399 4.35876 11.6119 4.38636C11.5839 4.41397 11.5617 4.44684 11.5465 4.48308C11.5313 4.51931 11.5235 4.5582 11.5234 4.59749C11.5234 4.76549 11.6599 4.89824 11.8241 4.89824C12.5677 4.88409 13.3068 5.01731 13.9987 5.29021C14.6906 5.5631 15.3216 5.97027 15.8554 6.48824C16.9451 7.54649 17.4761 8.96849 17.4964 10.8277C17.4964 10.992 17.6291 11.1285 17.7971 11.1285V11.1165C17.8763 11.1167 17.9523 11.0856 18.0087 11.0299C18.065 10.9743 18.0971 10.8987 18.0979 10.8195C18.1343 9.94435 17.9924 9.07095 17.6807 8.25236C17.3691 7.43378 16.8943 6.68711 16.2851 6.05774C15.0979 4.89749 13.5934 4.29974 11.8241 4.29974V4.30049ZM7.87087 4.98824C7.65858 4.95722 7.44207 4.99983 7.25737 5.10899H7.24162C6.81281 5.36034 6.42653 5.67803 6.09712 6.05024C5.82337 6.36674 5.67487 6.68699 5.63587 6.99524C5.61262 7.17899 5.62837 7.36274 5.68312 7.53824L5.70262 7.55024C6.01087 8.45624 6.41362 9.32774 6.90562 10.1482C7.53938 11.301 8.31933 12.367 9.22612 13.32L9.25312 13.359L9.29587 13.3905L9.32287 13.422L9.35437 13.449C10.3108 14.3584 11.3794 15.142 12.5344 15.7807C13.8544 16.4992 14.6554 16.839 15.1361 16.98V16.9875C15.2771 17.0302 15.4054 17.0497 15.5344 17.0497C15.9441 17.0197 16.332 16.8534 16.6361 16.5772C17.0066 16.2477 17.3208 15.8599 17.5661 15.429V15.4215C17.7964 14.988 17.7184 14.5777 17.3861 14.3002C16.7207 13.7186 16.0012 13.202 15.2374 12.7575C14.7259 12.48 14.2061 12.648 13.9954 12.9292L13.5461 13.4955C13.3159 13.7767 12.8974 13.7377 12.8974 13.7377L12.8854 13.7452C9.76462 12.948 8.93212 9.78824 8.93212 9.78824C8.93212 9.78824 8.89312 9.35849 9.18187 9.13949L9.74437 8.68649C10.0136 8.46749 10.2011 7.94849 9.91237 7.43624C9.47092 6.67135 8.95544 5.95165 8.37337 5.28749C8.24611 5.13091 8.06759 5.02438 7.86937 4.98674L7.87087 4.98824ZM12.3431 5.87924C11.9449 5.87924 11.9449 6.48074 12.3469 6.48074C12.8421 6.48877 13.3309 6.59431 13.7853 6.79134C14.2397 6.98836 14.6508 7.273 14.9951 7.62899C15.3092 7.97549 15.5506 8.38152 15.7049 8.82302C15.8593 9.26451 15.9234 9.7325 15.8936 10.1992C15.895 10.2782 15.9272 10.3535 15.9834 10.4091C16.0397 10.4646 16.1154 10.4959 16.1944 10.4962L16.2064 10.512C16.2859 10.5114 16.3621 10.4795 16.4184 10.4232C16.4747 10.367 16.5065 10.2908 16.5071 10.2112C16.5341 9.01949 16.1636 8.01974 15.4369 7.21874C14.7064 6.41774 13.6871 5.96849 12.3859 5.87924H12.3431ZM12.8359 7.49624C12.4256 7.48424 12.4099 8.09774 12.8164 8.10974C13.8049 8.16074 14.2849 8.66024 14.3479 9.68774C14.3492 9.76573 14.3811 9.84009 14.4366 9.8949C14.4921 9.94971 14.5669 9.98061 14.6449 9.98099H14.6569C14.697 9.97927 14.7363 9.96958 14.7726 9.95248C14.809 9.93538 14.8415 9.91123 14.8684 9.88141C14.8953 9.8516 14.9159 9.81673 14.9292 9.77884C14.9425 9.74096 14.948 9.7008 14.9456 9.66074C14.8751 8.32124 14.1446 7.56674 12.8479 7.49699H12.8359V7.49624Z"
                                                    fill="#6B2A14"/>
                                        </g>
                                    </svg>
                                </a>
                                <a href="#" target="_blank" class="telegram">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.72">
                                            <path
                                                    d="M21.5581 3.11738C21.3773 2.9612 21.1571 2.85748 20.9216 2.81745C20.686 2.77743 20.444 2.80263 20.2218 2.89032L2.91954 9.68766C2.65563 9.79133 2.4324 9.97766 2.28323 10.2188C2.13407 10.4599 2.06699 10.7429 2.09205 11.0253C2.11711 11.3077 2.23294 11.5744 2.42223 11.7855C2.61151 11.9966 2.86407 12.1407 3.1421 12.1963L7.68766 13.1053V18.7484C7.68739 19.0081 7.76421 19.2621 7.90839 19.4781C8.05257 19.6941 8.25762 19.8625 8.49757 19.9619C8.73752 20.0612 9.00156 20.0872 9.25626 20.0364C9.51096 19.9855 9.74484 19.8603 9.92829 19.6764L12.4848 17.1199L16.3083 20.4848C16.5461 20.6959 16.853 20.8127 17.171 20.8131C17.3093 20.8129 17.4467 20.7911 17.5782 20.7485C17.7951 20.6797 17.9902 20.5552 18.144 20.3874C18.2978 20.2197 18.405 20.0146 18.4548 19.7925L21.981 4.40504C22.0347 4.17224 22.0237 3.92919 21.9492 3.7022C21.8746 3.47521 21.7394 3.27294 21.5582 3.11729L21.5581 3.11738ZM3.21269 10.9258C3.20662 10.8852 3.21515 10.8437 3.23678 10.8087C3.2584 10.7737 3.29172 10.7476 3.33082 10.7348L17.8085 5.04713L8.11975 12.0445L3.36269 11.0931C3.32194 11.0874 3.2845 11.0676 3.25704 11.0369C3.22957 11.0063 3.21386 10.9669 3.21269 10.9258ZM9.13272 18.8811C9.1065 18.9073 9.0731 18.9251 9.03673 18.9324C9.00036 18.9396 8.96267 18.9359 8.92841 18.9217C8.89416 18.9075 8.86488 18.8835 8.84427 18.8527C8.82367 18.8218 8.81267 18.7856 8.81266 18.7485V13.8885L11.6386 16.3753L9.13272 18.8811ZM17.3582 19.5413C17.3509 19.5729 17.3356 19.6022 17.3136 19.6261C17.2917 19.6501 17.2639 19.6679 17.233 19.6779C17.2021 19.6879 17.1691 19.6897 17.1373 19.6831C17.1054 19.6765 17.0759 19.6617 17.0515 19.6403L9.15082 12.6877L20.8681 4.22522L17.3582 19.5413Z"
                                                    fill="#6B2A14"/>
                                        </g>
                                    </svg>
                                </a>
                                <a href="#" target="_blank" class="site">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g opacity="0.72" clip-path="url(#clip0_1_74)">
                                            <path
                                                    d="M19.3751 1.25H4.37513C4.02966 1.25 3.75012 1.52953 3.75012 1.87501V5H5.00014V2.49998H18.7501V17.5H5.00014V15H3.75012V18.125C3.75012 18.4705 4.02966 18.75 4.37513 18.75H19.3751C19.7206 18.75 20.0002 18.4705 20.0002 18.125V1.87497C20.0001 1.52953 19.7206 1.25 19.3751 1.25V1.25Z"
                                                    fill="#6B2A14"/>
                                            <path
                                                    d="M7.42431 13.3081L8.30809 14.1918L12.5 9.99994L8.30809 5.80804L7.42431 6.69183L10.1074 9.37493H0V10.6249H10.1074L7.42431 13.3081Z"
                                                    fill="#6B2A14"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_1_74">
                                                <rect width="20" height="20" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="from-marker__buttons d-md-flex">
                            <a href="#" class="button order-online-map">Замовити онлайн
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.72" clip-path="url(#clip0_1_74)">
                                        <path
                                                d="M19.3751 1.25H4.37513C4.02966 1.25 3.75012 1.52953 3.75012 1.87501V5H5.00014V2.49998H18.7501V17.5H5.00014V15H3.75012V18.125C3.75012 18.4705 4.02966 18.75 4.37513 18.75H19.3751C19.7206 18.75 20.0002 18.4705 20.0002 18.125V1.87497C20.0001 1.52953 19.7206 1.25 19.3751 1.25V1.25Z"
                                                fill="white"/>
                                        <path
                                                d="M7.42431 13.3081L8.30809 14.1918L12.5 9.99994L8.30809 5.80804L7.42431 6.69183L10.1074 9.37493H0V10.6249H10.1074L7.42431 13.3081Z"
                                                fill="white"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_1_74">
                                            <rect width="20" height="20" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            <a class="button create-direction">Прокласти маршрут
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M9.99998 0C4.48608 0 0 4.48608 0 9.99998C0 15.5139 4.48608 20 9.99998 20C15.5139 20 20 15.5139 20 9.99998C20 4.48608 15.5139 0 9.99998 0ZM9.99998 18.75C5.17516 18.75 1.24997 14.8248 1.24997 9.99998C1.24997 5.17516 5.17516 1.25001 9.99998 1.25001C14.8248 1.25001 18.75 5.17516 18.75 9.99998C18.75 14.8248 14.8248 18.75 9.99998 18.75Z"
                                            fill="white"/>
                                    <path
                                            d="M14.2109 5.02198L7.33288 6.89393C7.11927 6.95192 6.95202 7.11913 6.89403 7.33278L5.02212 14.2108C4.96291 14.4268 5.02456 14.6582 5.18327 14.8169C5.3023 14.9359 5.46158 15 5.62517 15C5.68011 15 5.73504 14.9926 5.78937 14.978L12.6674 13.106C12.881 13.048 13.0483 12.8808 13.1063 12.6672L14.9781 5.7892C15.0374 5.57315 14.9757 5.3418 14.817 5.18313C14.6577 5.02442 14.427 4.96338 14.2109 5.02198ZM11.9941 11.994L6.51504 13.4851L8.00612 8.00599L13.4852 6.5149L11.9941 11.994Z"
                                            fill="white"/>
                                    <path
                                            d="M10.4419 9.55799C10.686 9.80208 10.686 10.1978 10.4419 10.4419C10.1978 10.6859 9.80215 10.6859 9.55806 10.4419C9.31398 10.1978 9.31398 9.80208 9.55806 9.55799C9.80215 9.3139 10.1979 9.31394 10.4419 9.55799Z"
                                            fill="white"/>
                                </svg>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="map-control-buttons">
            <div class="controls fullscreen-control">
                <button title="Toggle Fullscreen"></button>
            </div>
            <div class="controls zoom-control">
                <button class="zoom-control-in" title="Zoom In"></button>
                <button class="zoom-control-out" title="Zoom Out"></button>
            </div>
            <div class="controls my-location">
                <button class="find-my-location"></button>
            </div>
        </div>
        <div id="map"></div>
    </section>
</div>
<?php
if (is_search() && $_GET['search_post_type'] == 'brands') : ?>
    <style>
        .map-modal__info .map-interesting-places.info__categories, .map-modal__switch {
            display: none !important;
        }
        .map-modal__info .brands-business.info__categories {
            border-top: none;
        }
    </style>
<?php
endif;
if (is_search() && $_GET['search_post_type'] == 'places') : ?>
    <style>
        .map-modal__info .brands-business.info__categories, .map-modal__switch {
            display: none !important;
        }
        .map-modal__info .map-interesting-places.info__categories {
            border-top: none;
        }
    </style>
<?php
endif;