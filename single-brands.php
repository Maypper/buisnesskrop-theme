<?php
get_header();
global $post;

get_template_part( 'template-parts/breadcrumbs' );
$thumb_id     = get_post_thumbnail_id();
$gallery      = get_field( 'images' );
$brand_cats   = wp_get_post_terms( $post->ID, 'category-brands' );
$order_page   = get_field( 'order_page', $post->ID );
$objects      = get_field( 'objects' );
$site         = brand_outgoing_link( get_field( 'url' ) );
$facebook     = brand_outgoing_link( get_field( 'facebook' ) );
$instagram    = brand_outgoing_link( get_field( 'instagram' ) );
$youtube      = brand_outgoing_link( get_field( 'youtube' ) );
$whatsapp     = brand_outgoing_link( get_field( 'whatsapp' ) );
$telegram     = brand_outgoing_link( get_field( 'telegram' ) );
$viber        = brand_outgoing_link( get_field( 'viber' ) );
$location     = get_field( 'post_location' );
$location_str = get_field( 'legal_address' );
$location_str = remove_post_code( $location_str );
$phone_num    = get_field( 'phone_number' );
$phones_valid = false;


$brand_rating = get_post_meta( $post->ID, 'brand_rating', true );
$total_comments = wp_count_comments( $post->ID )->approved;
if ( $total_comments > 1 && $brand_rating < 1 ) { // if obviously wrong rating saved...
	$brand_rating = count_commnets_rating(); // count all again
	update_post_meta( $post->ID, 'brand_rating', $brand_rating );
}

if ( $phone_num ) {
	$phones = explode( ',', $phone_num );
	foreach ( $phones as $phone ) {
		if ( isValidTelephoneNumber( $phone ) ) {
			$phones_valid = true;
		}
	}
}
$ownership_request_id = get_post_meta( $post->ID, 'ownership_request_id', true );
$email                = get_field( 'email' );
if ( isset( $brand_cats ) ) {
	$item_cat_labels = array();
	foreach ( $brand_cats as $cat ) {
		$item_cat_labels[] = $cat->name;
	}
	$brand_cats = implode( ', ', $item_cat_labels );
}
?>
<section class="business-content">
    <div class="container business-info">
        <h1 class="business-info__title"><?php the_title(); ?></h1>
        <div class="business-info__gallery">
            <div class="gallery">
                <div class="carousel">
					<?php
					if ( is_array( $gallery ) ):
						foreach ( $gallery as $item ):
							$img_id = $item['image'];
							?>
                            <div class="carousel__item">
								<?php echo wp_get_attachment_image( $img_id, 'brands-list', '', [ "class" => "carousel__img" ] ); ?>
                                <p class="carousel__rate">
                                    <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M4.29 18.339c-.46.235-.98-.177-.887-.703l.986-5.617L.205 8.033c-.39-.372-.187-1.054.337-1.128l5.816-.826L8.95.94a.61.61 0 0 1 1.101 0l2.594 5.139 5.816.826c.524.074.727.756.335 1.128l-4.182 3.986.985 5.617c.093.526-.427.938-.886.703L9.5 15.659l-5.212 2.68h.001Z"
                                                fill="#fff"/>
                                    </svg>
                                    <span><?php echo_formatted_rating( $brand_rating ); ?></span>
                                </p>
                            </div>
						<?php
						endforeach;
					endif;
					?>
                </div>
                <div class="gallery-buttons">
					<?php
					if ( is_array( $gallery ) ):
						foreach ( $gallery as $item ):
							$img_id = $item['image'];
							echo wp_get_attachment_image( $img_id, 'small_square', '', [ "class" => "gallery-buttons__button" ] );
						endforeach;
					endif;
					?>
                </div>
            </div>
        </div>

        <div class="business-info__description">
            <div class="business-description">
                <div class="business-description__info divider">
					<?php if ( $brand_cats ): ?>
                        <div class="business-description__category"><?php echo $brand_cats; ?></div>
					<?php endif; ?>
                    <div class="business-description__text">
                        <p><?php the_excerpt(); ?></p>
                    </div>
                </div>
				<?php if ( $order_page ): ?>
                    <div class="business-description__order divider">
                        <h2 class="business-description__title">Продукції/послуги доступні до замовлення</h2>
                        <a class="business-description__btn btn btn--primary" href="<?php echo $order_page ?>">
                            Замовити онлайн
                            <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#a)" fill="#fff">
                                    <path
                                            d="M19.375 1.25h-15a.625.625 0 0 0-.625.625V5H5V2.5h13.75v15H5V15H3.75v3.125c0 .346.28.625.625.625h15c.346 0 .625-.28.625-.625V1.875a.625.625 0 0 0-.625-.625Z"/>
                                    <path
                                            d="m7.424 13.308.884.884L12.5 10 8.308 5.808l-.884.884 2.683 2.683H0v1.25h10.107l-2.683 2.683Z"/>
                                </g>
                                <defs>
                                    <clipPath id="a">
                                        <path fill="#fff" d="M0 0h20v20H0z"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
				<?php endif; ?>
            </div>
        </div>
		<?php if ( ! $ownership_request_id ): ?>
            <div class="business-info__our-brand">
                <div class="our-brand divider">
                    <h2 class="our-brand__title"><?php _e( 'Is that your brand/business?', 'krop' ); ?></h2>
                    <div class="our-brand__text">
                        <p><?php _e( "Don't worry, it may have been added to the system automatically. The good news is that you still own it! Click the button below to complete the ownership verification process.", 'krop' ); ?></p>
                    </div>
                    <a class="our-brand__btn btn btn--secondary"
                       href="<?php echo add_query_arg( array( 'post_id' => $post->ID ), home_url( splitter_lang_condition( array('ukr' => '/brand-ownership/', 'eng' => '/brand-ownerships/' ) ) ) ) ?>">
						<?php _e( 'I am the owner of this brand/business', 'krop' ); ?>
                        <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#a)">
                                <path
                                        d="M18.333 4.167h-4.166v-.834c0-.919-.748-1.666-1.667-1.666h-5c-.92 0-1.667.747-1.667 1.666v.834H1.667C.747 4.167 0 4.914 0 5.833v10.834c0 .919.747 1.666 1.667 1.666h16.666c.92 0 1.667-.747 1.667-1.666V5.833c0-.919-.747-1.666-1.667-1.666ZM6.667 3.333c0-.459.374-.833.833-.833h5c.46 0 .833.374.833.833v.834H6.667v-.834Zm12.5 13.334c0 .46-.374.833-.834.833H1.667a.834.834 0 0 1-.834-.833v-6.065c.246.143.529.232.834.232h6.666v1.25c0 .23.187.416.417.416h2.5c.23 0 .417-.186.417-.416v-1.25h6.666c.305 0 .588-.089.834-.232v6.065Zm-10-5V10h1.666v1.667H9.167Zm10-2.5c0 .46-.374.833-.834.833h-6.666v-.417a.416.416 0 0 0-.417-.416h-2.5a.416.416 0 0 0-.417.416V10H1.667a.834.834 0 0 1-.834-.833V5.833c0-.459.374-.833.834-.833h16.666c.46 0 .834.374.834.833v3.334Z"
                                        fill="#E8BA06"/>
                            </g>
                            <defs>
                                <clipPath id="a">
                                    <path fill="#fff" d="M0 0h20v20H0z"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
            </div>
		<?php endif; ?>

        <div class="business-info__map">
            <div class="business-map">
                <h3 class="business-map__title">Бренд/бізнес на мапі</h3>
                <div class="business-map__map" id="map">

                </div>
                <a class="business-map__btn btn btn--primary text-white">
					<?php _e( 'Get route on the map', 'krop' ); ?>
                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M10 0C4.486 0 0 4.486 0 10s4.486 10 10 10 10-4.486 10-10S15.514 0 10 0Zm0 18.75c-4.825 0-8.75-3.925-8.75-8.75S5.175 1.25 10 1.25s8.75 3.925 8.75 8.75-3.925 8.75-8.75 8.75Z"
                                fill="#fff"/>
                        <path
                                d="M14.21 5.022 7.334 6.894a.625.625 0 0 0-.44.439L5.023 14.21a.624.624 0 0 0 .767.767l6.878-1.872a.625.625 0 0 0 .439-.439l1.872-6.878a.624.624 0 0 0-.767-.767Zm-2.216 6.972-5.48 1.491 1.492-5.479 5.479-1.491-1.491 5.479Z"
                                fill="#fff"/>
                        <path d="M10.442 9.558a.625.625 0 1 1-.884.884.625.625 0 0 1 .884-.884Z" fill="#fff"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="business-info__contacts">
            <div class="business-contacts">
				<?php if ( work_time_format( $post->ID ) ): ?>
                    <div class="business-contacts__tab divider">
                        <input type="checkbox" class="business-contacts__checkbox" id="business-contacts-heading-1"
                               checked>
                        <label class="business-contacts__heading" for="business-contacts-heading-1">
							<?php _e( 'Opening days and hours', 'krop' ); ?>
                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M8.55 3.621a.665.665 0 0 0-1.096 0l-6 8.667a.666.666 0 0 0 .548 1.046h12a.668.668 0 0 0 .548-1.046l-6-8.667Z"
                                        fill="#6B2A14"/>
                            </svg>
                        </label>
                        <ul class="business-contacts__content">
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name">Об'єкт 1</div>
                                <p class="business-contacts__contact">
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#a)" fill="#6B2A14">
                                            <path
                                                    d="M17.572 11.884v-8.55c0-.92-.716-1.667-1.597-1.667h-2.396V.417a.408.408 0 0 0-.4-.417c-.22 0-.4.186-.4.417v1.25H5.592V.417a.408.408 0 0 0-.4-.417c-.22 0-.399.186-.399.417v1.25H1.598C.717 1.667 0 2.414 0 3.333v13.334c0 .919.717 1.666 1.597 1.666h9.794C12.197 19.351 13.416 20 14.777 20c2.422 0 4.393-2.056 4.393-4.583 0-1.42-.623-2.692-1.598-3.533ZM.8 3.334c0-.46.358-.834.798-.834h3.195v.833c-.44 0-.798.374-.798.834 0 .459.358.833.798.833.441 0 .8-.374.8-.833V2.5h7.188v.833c-.44 0-.799.374-.799.834 0 .459.358.833.799.833.44 0 .799-.374.799-.833V2.5h2.396c.44 0 .799.374.799.833v2.5H.799v-2.5ZM1.597 17.5c-.44 0-.798-.374-.798-.833v-10h15.975v4.672a4.215 4.215 0 0 0-1.997-.506c-2.422 0-4.393 2.056-4.393 4.584 0 .75.177 1.457.485 2.083H1.598Zm13.18 1.667c-1.982 0-3.595-1.683-3.595-3.75 0-2.068 1.613-3.75 3.595-3.75 1.982 0 3.594 1.682 3.594 3.75s-1.612 3.75-3.594 3.75Z"/>
                                            <path
                                                    d="M15.176 15.244v-2.327a.408.408 0 0 0-.4-.417c-.22 0-.399.186-.399.417v2.5c0 .11.043.216.117.294l1.199 1.25a.39.39 0 0 0 .564 0 .43.43 0 0 0 0-.589l-1.08-1.128Z"/>
                                        </g>
                                        <defs>
                                            <clipPath id="a">
                                                <path fill="#fff" d="M0 0h19.17v20H0z"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span><?php echo work_time_format( $post->ID ); ?></span>
                                </p>
                            </li>
							<?php
							if ( $objects ):
								foreach ( $objects as $object ):
									?>
                                    <li class="business-contacts__content-item">
                                        <div class="business-contacts__name"><?php echo $object['object_title']; ?></div>
                                        <p class="business-contacts__contact">
                                            <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#a)" fill="#6B2A14">
                                                    <path
                                                            d="M17.572 11.884v-8.55c0-.92-.716-1.667-1.597-1.667h-2.396V.417a.408.408 0 0 0-.4-.417c-.22 0-.4.186-.4.417v1.25H5.592V.417a.408.408 0 0 0-.4-.417c-.22 0-.399.186-.399.417v1.25H1.598C.717 1.667 0 2.414 0 3.333v13.334c0 .919.717 1.666 1.597 1.666h9.794C12.197 19.351 13.416 20 14.777 20c2.422 0 4.393-2.056 4.393-4.583 0-1.42-.623-2.692-1.598-3.533ZM.8 3.334c0-.46.358-.834.798-.834h3.195v.833c-.44 0-.798.374-.798.834 0 .459.358.833.798.833.441 0 .8-.374.8-.833V2.5h7.188v.833c-.44 0-.799.374-.799.834 0 .459.358.833.799.833.44 0 .799-.374.799-.833V2.5h2.396c.44 0 .799.374.799.833v2.5H.799v-2.5ZM1.597 17.5c-.44 0-.798-.374-.798-.833v-10h15.975v4.672a4.215 4.215 0 0 0-1.997-.506c-2.422 0-4.393 2.056-4.393 4.584 0 .75.177 1.457.485 2.083H1.598Zm13.18 1.667c-1.982 0-3.595-1.683-3.595-3.75 0-2.068 1.613-3.75 3.595-3.75 1.982 0 3.594 1.682 3.594 3.75s-1.612 3.75-3.594 3.75Z"/>
                                                    <path
                                                            d="M15.176 15.244v-2.327a.408.408 0 0 0-.4-.417c-.22 0-.399.186-.399.417v2.5c0 .11.043.216.117.294l1.199 1.25a.39.39 0 0 0 .564 0 .43.43 0 0 0 0-.589l-1.08-1.128Z"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="a">
                                                        <path fill="#fff" d="M0 0h19.17v20H0z"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span>Понеділок - п’ятниця: 08:00 - 20:00</span>
                                        </p>
                                    </li>
								<?php endforeach; endif; ?>
                        </ul>
                    </div>
				<?php endif; ?>
                <div class="business-contacts__tab divider">
                    <input type="checkbox" class="business-contacts__checkbox" id="business-contacts-heading-2"
                           checked>
                    <label class="business-contacts__heading" for="business-contacts-heading-2">
                        Електронні ресурси
                        <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M8.55 3.621a.665.665 0 0 0-1.096 0l-6 8.667a.666.666 0 0 0 .548 1.046h12a.668.668 0 0 0 .548-1.046l-6-8.667Z"
                                    fill="#6B2A14"/>
                        </svg>
                    </label>
                    <ul class="business-contacts__content">
						<?php
						if ( $site ): ?>
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name"><?php _e( 'Website', 'krop' ); ?></div>
                                <a href="<?php echo $site ?>" target="_blank" class="business-contacts__contact">
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#a)" fill="#6B2A14">
                                            <path
                                                    d="M19.375 1.25h-15a.625.625 0 0 0-.625.625V5H5V2.5h13.75v15H5V15H3.75v3.125c0 .346.28.625.625.625h15c.346 0 .625-.28.625-.625V1.875a.625.625 0 0 0-.625-.625Z"/>
                                            <path
                                                    d="m7.424 13.308.884.884L12.5 10 8.308 5.808l-.884.884 2.683 2.683H0v1.25h10.107l-2.683 2.683Z"/>
                                        </g>
                                        <defs>
                                            <clipPath id="a">
                                                <path fill="#fff" d="M0 0h20v20H0z"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span><?php echo get_field( 'url' ) ?></span>
                                </a>
                            </li>
						<?php
						endif;
						if ( $facebook ):
							?>
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name">Facebook</div>
                                <a href="<?php echo $facebook ?>" target="_blank" class="business-contacts__contact">
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M17.5 6.667v6.666a4.167 4.167 0 0 1-4.167 4.167H6.667A4.167 4.167 0 0 1 2.5 13.333V6.667A4.167 4.167 0 0 1 6.667 2.5h6.666A4.167 4.167 0 0 1 17.5 6.667Z"
                                                stroke="#6B2A14" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        <path d="M9.167 17.5V10c0-1.823.416-3.333 3.333-3.333M7.5 10.833h5"
                                              stroke="#6B2A14"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span><?php _e( 'Go to the site', 'krop' ); ?></span>
                                </a>
                            </li>
						<?php
						endif;
						if ( $instagram ):
							?>
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name">Instagram</div>
                                <a href="<?php echo $instagram ?>" target="_blank" class="business-contacts__contact">
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 13.333a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666v0Z"
                                              stroke="#6B2A14"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                                d="M2.5 13.333V6.667A4.167 4.167 0 0 1 6.667 2.5h6.666A4.167 4.167 0 0 1 17.5 6.667v6.666a4.167 4.167 0 0 1-4.167 4.167H6.667A4.167 4.167 0 0 1 2.5 13.333Z"
                                                stroke="#6B2A14" stroke-width="1.5"/>
                                        <path d="m14.583 5.425.009-.01" stroke="#6B2A14" stroke-width="1.5"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                    <span><?php _e( 'Go to the site', 'krop' ); ?></span>
                                </a>
                            </li>
						<?php
						endif;
						if ( $youtube ):
							?>
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name">YouTube</div>
                                <a href="<?php echo $youtube ?>" target="_blank" class="business-contacts__contact">
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.667 10 8.75 11.667V8.333L11.667 10Z" fill="#6B2A14"
                                              stroke="#6B2A14"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                                d="M1.667 10.59V9.41c0-2.413 0-3.62.754-4.395.755-.777 1.943-.81 4.32-.878 1.124-.031 2.274-.054 3.26-.054.983 0 2.133.023 3.26.054 2.375.068 3.563.101 4.317.878.755.776.755 1.983.755 4.395v1.18c0 2.412 0 3.618-.754 4.395-.755.776-1.942.81-4.319.877-1.125.032-2.275.055-3.26.055-.984 0-2.134-.023-3.26-.055-2.376-.067-3.564-.1-4.32-.877-.753-.777-.753-1.983-.753-4.395Z"
                                                stroke="#6B2A14" stroke-width="1.5"/>
                                    </svg>
                                    <span><?php _e( 'Go to the channel', 'krop' ); ?></span>
                                </a>
                            </li>
						<?php
						endif;
						if ( $viber ):
							?>
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name">Viber</div>
                                <a href="<?php echo $viber ?>" target="_blank" class="business-contacts__contact">
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M9.499.003c-1.605.02-5.056.283-6.986 2.054C1.078 3.479.576 5.583.518 8.183.468 10.774.41 15.641 5.1 16.966v2.018s-.03.807.504.973c.658.208 1.032-.413 1.657-1.08l1.166-1.319c3.209.267 5.667-.348 5.95-.44.651-.207 4.32-.676 4.919-5.543.615-5.026-.3-8.193-1.95-9.626h-.01c-.498-.458-2.5-1.917-6.973-1.933 0 0-.332-.023-.865-.013Zm.055 1.413c.455-.003.732.017.732.017 3.786.01 5.593 1.149 6.019 1.533 1.39 1.19 2.106 4.046 1.582 8.242-.498 4.069-3.473 4.326-4.024 4.502-.234.075-2.4.609-5.127.433 0 0-2.031 2.451-2.666 3.083-.1.11-.218.143-.293.127-.108-.027-.14-.16-.134-.342l.02-3.35c-3.979-1.1-3.744-5.25-3.702-7.418.049-2.169.456-3.942 1.667-5.144 1.63-1.474 4.56-1.673 5.925-1.683Zm.3 2.168a.248.248 0 0 0-.25.247c0 .14.113.25.25.25a4.696 4.696 0 0 1 3.36 1.326c.907.882 1.35 2.067 1.367 3.616 0 .137.11.25.25.25v-.01a.25.25 0 0 0 .25-.247 5.384 5.384 0 0 0-1.51-3.968c-.99-.967-2.243-1.465-3.717-1.465Zm-3.295.573a.783.783 0 0 0-.51.1h-.014c-.357.21-.68.475-.954.785-.228.264-.352.53-.384.787-.02.154-.006.307.04.453l.016.01c.256.755.592 1.481 1.002 2.165.528.96 1.178 1.849 1.934 2.643l.022.033.036.026.022.026.027.022a12.92 12.92 0 0 0 2.65 1.944c1.1.598 1.767.882 2.168.999v.006c.117.036.224.052.332.052.341-.025.664-.164.918-.394.308-.274.57-.597.775-.957v-.006c.192-.361.127-.703-.15-.934a11.536 11.536 0 0 0-1.79-1.286c-.427-.231-.86-.091-1.036.143l-.374.472c-.192.235-.54.202-.54.202l-.01.006c-2.601-.664-3.295-3.297-3.295-3.297s-.033-.358.208-.54l.469-.378c.224-.183.38-.615.14-1.042a11.245 11.245 0 0 0-1.283-1.79.713.713 0 0 0-.42-.251h.001Zm3.727.742c-.332 0-.332.502.003.502a3.14 3.14 0 0 1 2.207.957 2.913 2.913 0 0 1 .749 2.141.251.251 0 0 0 .25.248l.01.013a.253.253 0 0 0 .251-.25c.023-.994-.286-1.827-.892-2.494-.608-.668-1.458-1.042-2.542-1.117h-.036Zm.41 1.348c-.341-.01-.354.501-.015.511.823.043 1.223.459 1.276 1.315a.249.249 0 0 0 .247.245h.01a.252.252 0 0 0 .241-.267c-.059-1.117-.668-1.745-1.748-1.803h-.01v-.001Z"
                                                fill="#6B2A14"/>
                                    </svg>
                                    <span><?php _e( 'Go to chat', 'krop' ); ?></span>
                                </a>
                            </li>
						<?php
						endif;
						if ( $whatsapp ):
							?>
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name">WhatsApp</div>
                                <a href="<?php echo $whatsapp ?>" target="_blank" class="business-contacts__contact">
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M16.717 3.72A9.378 9.378 0 0 0 10.04.953C4.838.952.602 5.186.6 10.391c0 1.663.435 3.287 1.26 4.719L.521 20l5.004-1.313a9.443 9.443 0 0 0 4.51 1.149h.005c5.201 0 9.437-4.234 9.439-9.439a9.384 9.384 0 0 0-2.762-6.676ZM10.04 18.244h-.003a7.829 7.829 0 0 1-3.993-1.095l-.286-.17-2.97.78.792-2.895-.186-.297a7.83 7.83 0 0 1-1.2-4.175c.002-4.326 3.522-7.845 7.85-7.845a7.794 7.794 0 0 1 5.545 2.3 7.8 7.8 0 0 1 2.296 5.551c-.002 4.326-3.522 7.846-7.845 7.846Zm4.304-5.876c-.237-.12-1.396-.689-1.612-.768-.216-.079-.372-.118-.53.118-.158.235-.61.766-.748.924-.138.158-.275.177-.51.059-.236-.118-.997-.367-1.898-1.17-.7-.626-1.174-1.398-1.312-1.634-.137-.237-.014-.364.104-.482.107-.105.236-.275.354-.413.117-.138.156-.235.235-.393.079-.158.04-.296-.02-.413-.059-.12-.53-1.28-.727-1.752-.19-.457-.385-.396-.53-.403-.15-.006-.301-.009-.451-.008a.868.868 0 0 0-.63.294c-.217.237-.826.807-.826 1.967 0 1.161.846 2.283.964 2.44.117.159 1.663 2.54 4.029 3.562.563.243 1.003.388 1.344.497.565.18 1.08.154 1.486.094.453-.067 1.395-.57 1.592-1.12.197-.552.197-1.024.138-1.123-.06-.099-.218-.159-.452-.276Z"
                                              fill="#6B2A14"/>
                                    </svg>
                                    <span><?php _e( 'Go to chat', 'krop' ); ?></span>
                                </a>
                            </li>
						<?php
						endif;
						if ( $telegram ):
							?>
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name">Telegram</div>
                                <a href="<?php echo $telegram ?>" target="_blank" class="business-contacts__contact">
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M17.965 2.598a1.091 1.091 0 0 0-1.114-.19L2.433 8.074a1.094 1.094 0 0 0 .185 2.09l3.788.758v4.703a1.093 1.093 0 0 0 1.867.773l2.13-2.13 3.187 2.804a1.085 1.085 0 0 0 1.058.22 1.085 1.085 0 0 0 .73-.797l2.94-12.823a1.092 1.092 0 0 0-.353-1.073ZM2.677 9.105a.145.145 0 0 1 .098-.16l12.065-4.74-8.074 5.832-3.964-.793a.145.145 0 0 1-.125-.14Zm4.933 6.63a.156.156 0 0 1-.266-.111v-4.05l2.354 2.072-2.088 2.088Zm6.855.55a.156.156 0 0 1-.256.082l-6.584-5.794 9.765-7.052-2.925 12.763Z"
                                                fill="#6B2A14"/>
                                    </svg>
                                    <span><?php _e( 'Go to chat', 'krop' ); ?></span>
                                </a>
                            </li>
						<?php
						endif;
						?>
                    </ul>
                </div>
				<?php if ( $email ): ?>
                    <div class="business-contacts__tab divider">
                        <input type="checkbox" class="business-contacts__checkbox" id="business-contacts-heading-3"
                               checked>
                        <label class="business-contacts__heading" for="business-contacts-heading-3">
							<?php _e( 'Emails', 'krop' ); ?>
                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M8.55 3.621a.665.665 0 0 0-1.096 0l-6 8.667a.666.666 0 0 0 .548 1.046h12a.668.668 0 0 0 .548-1.046l-6-8.667Z"
                                        fill="#6B2A14"/>
                            </svg>
                        </label>
                        <ul class="business-contacts__content">
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name"><?php _e( 'Mail', 'krop' ); ?> №1</div>
                                <a href="<?php echo 'mailto:' . $email; ?>" class="business-contacts__contact">
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#a)">
                                            <path
                                                    d="M18.125 2.5H1.875A1.877 1.877 0 0 0 0 4.375v11.25C0 16.66.841 17.5 1.875 17.5h16.25A1.877 1.877 0 0 0 20 15.625V4.375A1.877 1.877 0 0 0 18.125 2.5Zm0 1.25a.62.62 0 0 1 .24.049L10 11.049l-8.365-7.25a.622.622 0 0 1 .24-.049h16.25Zm0 12.5H1.875a.625.625 0 0 1-.625-.625V5.12l8.34 7.229a.624.624 0 0 0 .82 0l8.34-7.229v10.506c0 .345-.28.625-.625.625Z"
                                                    fill="#6B2A14"/>
                                        </g>
                                        <defs>
                                            <clipPath id="a">
                                                <path fill="#fff" d="M0 0h20v20H0z"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span><?php echo $email; ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
				<?php
				endif;
				if ( $phones_valid ):
					?>
                    <div class="business-contacts__tab divider">
                        <input type="checkbox" class="business-contacts__checkbox" id="business-contacts-heading-4"
                               checked>
                        <label class="business-contacts__heading" for="business-contacts-heading-4">
							<?php _e( 'Phones', 'krop' ); ?>
                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M8.55 3.621a.665.665 0 0 0-1.096 0l-6 8.667a.666.666 0 0 0 .548 1.046h12a.668.668 0 0 0 .548-1.046l-6-8.667Z"
                                        fill="#6B2A14"/>
                            </svg>
                        </label>
                        <ul class="business-contacts__content">
							<?php foreach ( $phones as $index => $phone ):
								if ( isValidTelephoneNumber( $phone ) ):
									?>
                                    <li class="business-contacts__content-item">
                                        <div class="business-contacts__name"><?php _e( 'Phone number', 'krop' ); ?>
                                            №<?php echo $index + 1; ?>
                                        </div>
                                        <a href="<?php echo 'tel:' . normalizeTelephoneNumber( $phone ); ?>"
                                           class="business-contacts__contact">
                                            <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#a)" fill="#6B2A14">
                                                    <path
                                                            d="M19.167 20C8.597 20 0 11.402 0 .833 0 .373.373 0 .833 0H7.5c.46 0 .833.373.833.833 0 1.648.374 3.247 1.11 4.75a.835.835 0 0 1-.209 1.001l-4.631 3.943a17.637 17.637 0 0 0 4.864 4.866l3.95-4.628a.834.834 0 0 1 1-.208 10.727 10.727 0 0 0 4.75 1.11c.46 0 .833.373.833.833v6.667c0 .46-.373.833-.833.833Zm-8.252-3.737a17.375 17.375 0 0 0 7.418 2.05v-5.007a12.343 12.343 0 0 1-4.057-.98l-3.36 3.937ZM1.687 1.667a17.37 17.37 0 0 0 2.047 7.41l3.94-3.354a12.365 12.365 0 0 1-.979-4.056H1.686Z"/>
                                                    <path
                                                            d="m191.516 250.125-32-128A15.995 15.995 0 0 0 144 109.999H90.3C125.917 58.789 160-9.116 160-82.001 160-170.218 88.218-242 0-242c-88.22 0-160 71.781-160 160 0 72.884 34.083 140.788 69.701 191.999h-53.7a15.995 15.995 0 0 0-15.516 12.126l-32.001 128a15.948 15.948 0 0 0 2.907 13.719A15.981 15.981 0 0 0-176 270h352.001c4.921 0 9.578-2.266 12.609-6.156a15.95 15.95 0 0 0 2.906-13.719ZM.001-210c70.578 0 128 57.422 128 128 0 112.625-95.563 217.501-128.016 249.86C-32.47 135.531-128 30.844-128-82c0-70.578 57.422-128 128-128ZM-155.5 238.001l24.001-96h65.209c28.548 35.402 53.21 57.775 55.665 59.953a15.919 15.919 0 0 0 10.626 4.047c3.797 0 7.593-1.344 10.625-4.047 2.455-2.178 27.117-24.55 55.665-59.953H131.5l24.001 96H-155.5Z"/>
                                                </g>
                                                <defs>
                                                    <clipPath id="a">
                                                        <path fill="#fff" d="M0 0h20v20H0z"/>
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                            <span><?php echo $phone; ?></span>
                                        </a>
                                    </li>
								<?php endif; endforeach; ?>
                        </ul>
                    </div>
				<?php
				endif;
				if ( $location ):
					?>
                    <div class="business-contacts__tab divider business-address">
                        <input type="checkbox" class="business-contacts__checkbox" id="business-contacts-heading-5"
                               checked>
                        <label class="business-contacts__heading" for="business-contacts-heading-5">
							<?php _e( 'Addresses', 'krop' ); ?>
                            <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M8.55 3.621a.665.665 0 0 0-1.096 0l-6 8.667a.666.666 0 0 0 .548 1.046h12a.668.668 0 0 0 .548-1.046l-6-8.667Z"
                                        fill="#6B2A14"/>
                            </svg>
                        </label>
                        <ul class="business-contacts__content">
                            <li class="business-contacts__content-item">
                                <div class="business-contacts__name"><?php _e( 'Address', 'krop' ); ?> №1</div>
                                <a class="business-contacts__contact"
                                   data-location='{
	"lat":<?php echo $location['lat']; ?>, "lng":<?php echo $location['lng']; ?>}'>
                                    <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#a)" fill="#6B2A14">
                                            <path
                                                    d="m17.481 19.224-1.25-5a.625.625 0 0 0-.606-.474h-2.098c1.392-2 2.723-4.653 2.723-7.5A6.257 6.257 0 0 0 10 0a6.257 6.257 0 0 0-6.25 6.25c0 2.847 1.331 5.5 2.723 7.5H4.375a.625.625 0 0 0-.606.474l-1.25 5a.623.623 0 0 0 .606.776h13.75a.624.624 0 0 0 .606-.776ZM10 1.25c2.757 0 5 2.243 5 5 0 4.4-3.733 8.496-5 9.76-1.268-1.263-5-5.352-5-9.76 0-2.757 2.243-5 5-5Zm-6.074 17.5L4.863 15H7.41c1.116 1.383 2.079 2.257 2.175 2.342a.622.622 0 0 0 .83 0c.096-.085 1.06-.959 2.174-2.342h2.548l.937 3.75H3.926Z"/>
                                            <path
                                                    d="M12.5 6.25c0-1.379-1.121-2.5-2.5-2.5a2.502 2.502 0 0 0-2.5 2.5c0 1.379 1.121 2.5 2.5 2.5s2.5-1.121 2.5-2.5Zm-3.75 0C8.75 5.56 9.31 5 10 5s1.25.56 1.25 1.25S10.69 7.5 10 7.5s-1.25-.56-1.25-1.25Z"/>
                                        </g>
                                        <defs>
                                            <clipPath id="a">
                                                <path fill="#fff" d="M0 0h20v20H0z"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span><?php echo $location_str; ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
	<?php
	$id   = get_the_ID();
	$page = ( get_query_var( 'cpage' ) ) ? get_query_var( 'cpage' ) : 1;

	$limit          = get_option( 'comments_per_page' );
	$offset         = ( $page * $limit ) - $limit;
	$param          = array(
		'orderby' => 'post_date',
		'order'   => isset($_GET['order']) && $_GET['order'] == 'older' ? 'ASC' : 'DESC',
		'status'  => 'approve',
		'offset'  => $offset,
		'post_id' => $id,
		'number'  => $limit,
	);
	$pages    = ceil( $total_comments / $limit );
	$comments = get_comments( $param );
	?>
    <div class="container reviews" id="comments">
        <h2 class="reviews__title">Користувацькі відгуки</h2>
        <div class="reviews__select divider">
            <p>Відображення</p>
            <div class="custom-select" id="display-reviews"></div>
        </div>
        <div class="reviews_wrapper">
            <div class="reviews__list">
				<?php
				foreach ( $comments as $comment ) {
					get_template_part( 'template-parts/single-items/comment-box' );
				}
				?>
            </div>
            <div class="reviews__form">
				<?php comment_form(
					array(
						'fields'        => array(
							'author' => '<p class="comment-form-author"><label for="author">' . __( 'Your name and surname', 'krop' ) . '</label><input placeholder="' . __( 'For example: Ivan Franko', 'krop' ) . '" id="author" name="author"></p>',
							'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Your email', 'krop' ) . '</label><input placeholder="' . __( 'For example: ivanfranko@mail.com', 'krop' ) . '" id="email" name="email"></p>',
						),
						'class_submit'  => 'submit btn btn--primary personal__modal__btn personal__modal__btn__big m-0 w-100',
						'comment_field' => '<p class="comment-form-comment"><label for="comment">' . __( 'Your comment', 'krop' ) . '</label><textarea placeholder="Деякий додатковий текст відгуку" id="comment" name="comment" cols="45" rows="6" aria-required="true"></textarea></p>'
					)
				); ?>
            </div>
            <div class="pagination divider">
				<?php
				$links = paginate_comments_links( array(
//					'base'      => @add_query_arg( 'page', '%#%' ),
//					'format'    => '?page=%#%',
					'total'     => $pages,
					'current'   => $page,
					'show_all'  => false,
					'end_size'  => 1,
					'mid_size'  => 2,
					'prev_next' => true,
					'prev_text' => '<svg width="22" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M22 10c0-.379-.145-.742-.403-1.01a1.35 1.35 0 0 0-.972-.418H4.696l5.904-6.13a1.46 1.46 0 0 0 .403-1.012c0-.38-.145-.743-.403-1.011A1.351 1.351 0 0 0 9.626 0c-.365 0-.715.15-.973.419l-8.25 8.57a1.477 1.477 0 0 0 0 2.022l8.25 8.57c.258.268.608.419.973.419s.716-.15.974-.419c.258-.268.403-.632.403-1.011 0-.38-.145-.743-.403-1.011l-5.904-6.13h15.93c.364 0 .713-.151.971-.419S22 10.379 22 10Z"
                              fill="#6B2A14"/>
                    </svg>
                    <span>' . __( 'Previous', 'krop' ) . '</span>',
					'next_text' => '<span>' . __( 'Next', 'krop' ) . '</span>
                    <svg width="22" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M0 10c0-.379.145-.742.403-1.01a1.35 1.35 0 0 1 .972-.418h15.929L11.4 2.442a1.46 1.46 0 0 1-.403-1.012c0-.38.145-.743.403-1.011.258-.268.608-.419.974-.419.365 0 .715.15.973.419l8.25 8.57a1.477 1.477 0 0 1 0 2.022l-8.25 8.57a1.35 1.35 0 0 1-.973.419c-.366 0-.716-.15-.974-.419a1.459 1.459 0 0 1-.403-1.011c0-.38.145-.743.403-1.011l5.904-6.13H1.374a1.35 1.35 0 0 1-.971-.419A1.457 1.457 0 0 1 0 10Z"
                              fill="#6B2A14"/>
                    </svg>',
					'type'      => 'array'
				));
                if (!empty($links)) {
	                $find         = array(
		                'page-numbers current',
		                'page-numbers',
		                'next pagination__link',
		                'prev pagination__link'
	                );
	                $replace      = array(
		                'pagination__link pagination__link--active',
		                'pagination__link',
		                'pagination__arrow pagination__arrow--next',
		                'pagination__arrow pagination__arrow--prev'
	                );
	                $links        = str_replace( $find, $replace, $links );
	                $links_length = count( $links ) - 1;
	                foreach ( $links as $key => $link ) {
		                $link = ( $key === 0 ) ? ( strpos( $link, 'pagination__arrow--prev' ) ? $link . '<div class="pagination__numbers">' : '<div class="pagination__arrow pagination__arrow--prev inactive"><svg width="22" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M22 10c0-.379-.145-.742-.403-1.01a1.35 1.35 0 0 0-.972-.418H4.696l5.904-6.13a1.46 1.46 0 0 0 .403-1.012c0-.38-.145-.743-.403-1.011A1.351 1.351 0 0 0 9.626 0c-.365 0-.715.15-.973.419l-8.25 8.57a1.477 1.477 0 0 0 0 2.022l8.25 8.57c.258.268.608.419.973.419s.716-.15.974-.419c.258-.268.403-.632.403-1.011 0-.38-.145-.743-.403-1.011l-5.904-6.13h15.93c.364 0 .713-.151.971-.419S22 10.379 22 10Z"
                              fill="#6B2A14"/>
                    </svg>
                    <span>' . __( 'Previous', 'krop' ) . '</span></div><div class="pagination__numbers">' . $link ) : $link;
		                $link = ( $key === $links_length ) ? ( strpos( $link, 'pagination__arrow--next' ) ? '</div>' . $link : $link . '</div><div class="pagination__arrow pagination__arrow--next inactive"><span>' . __( 'Next', 'krop' ) . '</span>
                    <svg width="22" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M0 10c0-.379.145-.742.403-1.01a1.35 1.35 0 0 1 .972-.418h15.929L11.4 2.442a1.46 1.46 0 0 1-.403-1.012c0-.38.145-.743.403-1.011.258-.268.608-.419.974-.419.365 0 .715.15.973.419l8.25 8.57a1.477 1.477 0 0 1 0 2.022l-8.25 8.57a1.35 1.35 0 0 1-.973.419c-.366 0-.716-.15-.974-.419a1.459 1.459 0 0 1-.403-1.011c0-.38.145-.743.403-1.011l5.904-6.13H1.374a1.35 1.35 0 0 1-.971-.419A1.457 1.457 0 0 1 0 10Z"
                              fill="#6B2A14"/>
                    </svg></div>' ) : $link;
		                echo $link;
	                }
                }
				?>
            </div>
        </div>
    </div>

	<?php
	global $post;
	$relatedPostArgs = array(
		'post_type'      => 'brands',
		'posts_per_page' => 4,
		'post_status'    => 'publish',
		'orderby'        => 'rand',
		'post__not_in'   => array( get_the_ID() ),
	);
	$terms           = get_the_terms( $post->ID, 'category-brands' );
	if ( is_array( $terms ) ) {
		$relatedPostArgs['tax_query'] = array(
			array(
				'taxonomy' => 'category-brands',
				'terms'    => array_column( $terms, 'slug' ),
				'field'    => 'slug',
				'operator' => 'IN',
			)
		);
	}

	$relatedPostQuery = new WP_Query( $relatedPostArgs );
	if ( $relatedPostQuery->have_posts() ) {
		?>
        <div class="container other-brands">
            <h2 class="other-brands__title">Схожі бренди/бізнеси</h2>
            <a class="other-brands__btn btn btn--primary" href="#">

                <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M15.833 1.667H14.09a1.248 1.248 0 0 0-1.173-.834h-1.259A2.086 2.086 0 0 0 10 0c-.651 0-1.267.314-1.658.833H7.083c-.542 0-1 .35-1.173.834H4.167c-.92 0-1.667.747-1.667 1.666v15c0 .92.747 1.667 1.667 1.667h11.666c.92 0 1.667-.747 1.667-1.667v-15c0-.919-.747-1.666-1.667-1.666Zm-9.166.416c0-.23.186-.416.416-.416h1.481a.417.417 0 0 0 .36-.207 1.236 1.236 0 0 1 2.152 0 .417.417 0 0 0 .36.207h1.48c.23 0 .417.186.417.416V2.5c0 .46-.373.833-.833.833h-5a.834.834 0 0 1-.833-.833v-.417Zm10 16.25c0 .46-.374.834-.834.834H4.167a.834.834 0 0 1-.834-.834v-15c0-.46.374-.833.834-.833h1.666c0 .92.748 1.667 1.667 1.667h5c.92 0 1.667-.748 1.667-1.667h1.666c.46 0 .834.374.834.833v15Z"
                            fill="#fff"/>
                    <path
                            d="M13.75 9.167h-7.5a.416.416 0 1 0 0 .833h7.5a.417.417 0 1 0 0-.833ZM13.75 10.833h-7.5a.416.416 0 1 0 0 .834h7.5a.416.416 0 1 0 0-.834ZM13.75 12.5h-7.5a.416.416 0 1 0 0 .833h7.5a.416.416 0 1 0 0-.833ZM10.417 14.167H6.25a.416.416 0 1 0 0 .833h4.167a.416.416 0 1 0 0-.833Z"
                            fill="#fff"/>
                </svg>
            </a>
            <div class="other-brands__slider">
				<?php while ( $relatedPostQuery->have_posts() ) {
					$relatedPostQuery->the_post();
					?>
                    <a href="<?php the_permalink(); ?>" class="brand-item">
                        <div class="brand-item__img">
							<?php the_post_thumbnail( 'medium' ); ?>
                            <p class="brand-item__rate">
                                <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M4.29 18.339c-.46.235-.98-.177-.887-.703l.986-5.617L.205 8.033c-.39-.372-.187-1.054.337-1.128l5.816-.826L8.95.94a.61.61 0 0 1 1.101 0l2.594 5.139 5.816.826c.524.074.727.756.335 1.128l-4.182 3.986.985 5.617c.093.526-.427.938-.886.703L9.5 15.659l-5.212 2.68h.001Z"
                                            fill="#fff"/>
                                </svg>
                                <span>5.0</span>
                            </p>
                        </div>
                        <div class="brand-item__info">
                            <h3 class="brand-item__info-title"><?php echo splitter_trim_symbols( get_the_title(), 36 ); ?></h3>
                            <p class="brand-item__info-text"><?php echo splitter_trim_symbols( get_the_excerpt(), 45 ); ?></p>
							<?php
							$termsListReadyString = '';
							$terms                = get_the_terms( $post->ID, 'category-brands' );

							$termsListReadyString = implode( ' ', array_column( $terms, 'name' ) );
							?>
                            <p class="brand-item__info-category"><?php echo $termsListReadyString; ?></p>
                        </div>
                    </a>
					<?php
				}
				?>
            </div>

            <div class="other-brands__slider-nav">
                <button class="other-brands__slider-button other-brands__slider-button--left" disabled
                        data-reviews-action="prev">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M23 12c0-.379-.145-.742-.403-1.01a1.35 1.35 0 0 0-.972-.418H5.696l5.904-6.13a1.46 1.46 0 0 0 .403-1.012c0-.38-.145-.743-.403-1.011A1.351 1.351 0 0 0 10.626 2c-.365 0-.715.15-.973.419l-8.25 8.57a1.476 1.476 0 0 0 0 2.022l8.25 8.57c.258.268.608.419.973.419.366 0 .716-.15.974-.419.258-.268.403-.632.403-1.011 0-.38-.145-.743-.403-1.011l-5.904-6.13h15.93c.364 0 .713-.151.971-.419S23 12.379 23 12Z"
                              fill="#6B2A14"/>
                    </svg>
                </button>
                <button class="other-brands__slider-button other-brands__slider-button--right"
                        data-reviews-action="next">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M1 12c0-.379.145-.742.403-1.01a1.35 1.35 0 0 1 .972-.418h15.929L12.4 4.442a1.46 1.46 0 0 1-.403-1.012c0-.38.145-.743.403-1.011.258-.268.608-.419.974-.419.365 0 .715.15.973.419l8.25 8.57a1.477 1.477 0 0 1 0 2.022l-8.25 8.57a1.35 1.35 0 0 1-.973.419c-.366 0-.716-.15-.974-.419a1.459 1.459 0 0 1-.403-1.011c0-.38.145-.743.403-1.011l5.904-6.13H2.374a1.35 1.35 0 0 1-.971-.419A1.457 1.457 0 0 1 1 12Z"
                              fill="#6B2A14"/>
                    </svg>
                </button>
            </div>

        </div>
		<?php
	}
	?>


</section>
<script>
    function initMap() {
        let directionsService = new google.maps.DirectionsService();
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 48.516245706561484, lng: 32.25828303343775},
            zoom: 15,
            style: [
                {
                    "featureType": "landscape.natural.landcover",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape.natural.terrain",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.attraction",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.attraction",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.government",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.place_of_worship",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.airport",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.bus",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.rail",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                }
            ]
        });

        let directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);

        let svgMarker = {
            path: 'M18 0C8.05884 0 0 8.05884 0 18C0 33 18 48 18 48C18 48 36 33 36 18C36 8.05884 27.9412 0 18 0ZM18 24C14.6863 24 12 21.3137 12 18C12 14.6862 14.6863 12 18 12C21.3137 12 24 14.6862 24 18C24 21.3137 21.3137 24 18 24Z',
            fillColor: '#e8Ba06',
            fillOpacity: 1,
            strokeWeight: 0,
            anchor: new google.maps.Point(15, 30),
        };

        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var currentLatitude = position.coords.latitude;
                var currentLongitude = position.coords.longitude;
                console.log(currentLatitude);
                console.log(currentLongitude);
                let currentMarker = new google.maps.Marker({
                    position: {lat: currentLatitude, lng: currentLongitude},
                    map: map,
                    icon: '',
                });
                createDirection.setAttribute('data-position', `{"lat":${position.coords.latitude}, "lng":${position.coords.longitude}}`);
            });
        }

        let addressParent = document.querySelector('.business-address');
        let addressItem = addressParent.querySelectorAll('.business-contacts__contact');

        let mapParent = document.querySelector('.business-map');
        let createDirection = mapParent.querySelector('.business-map__btn');

        createDirection.addEventListener('click', function () {
            let Dest = JSON.parse(this.getAttribute('data-location'));
            let Curr = JSON.parse(this.getAttribute('data-position'));
            calculateAndDisplayRoute(directionsRenderer, directionsService, Dest, Curr);
        });


        let prevMarker = {};
        addressItem.forEach(elem => {
            elem.addEventListener('click', function () {
                if (Object.keys(prevMarker).length !== 0
                    && Object.getPrototypeOf(prevMarker) !== Object.prototype) {
                    prevMarker.setMap(null);
                }
                let itemAttribute = JSON.parse(this.getAttribute('data-location'));
                let marker = new google.maps.Marker({
                    position: itemAttribute,
                    map: map,
                    icon: svgMarker,
                });
                prevMarker = marker;
                createDirection.setAttribute('data-location', this.getAttribute('data-location'));
                map.setCenter(new google.maps.LatLng(itemAttribute));
                map.setZoom(15);
            });
        });


        function calculateAndDisplayRoute(
            directionsRenderer,
            directionsService,
            Dest,
            Curr
        ) {
            directionsService.route({
                origin: Curr,
                destination: Dest,
                travelMode: google.maps.TravelMode.WALKING,
            })
                .then((result) => {
                    directionsRenderer.setDirections(result);
                })
                .catch((e) => {
                    window.alert('Directions request failed due to ' + e);
                });
        }
    }

</script>
<?php
if ( get_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ) ): ?>
    <div class="container">
        <div class="text-bottom divider">
			<?php the_field( splitter_lang_condition( array('ukr' => 'seo_tekst', 'eng' => 'seo_tekst_eng' ) ), 'options' ); ?>
        </div>
    </div>
<?php
endif;
get_footer();
?>
<script>
    function initMap() {
        let directionsService = new google.maps.DirectionsService();
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 48.516245706561484, lng: 32.25828303343775},
            zoom: 15,
            style: [
                {
                    "featureType": "landscape.natural.landcover",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape.natural.terrain",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.attraction",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.attraction",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.government",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "poi.place_of_worship",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.airport",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.bus",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.rail",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                }
            ]
        });

        let directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);

        let svgMarker = {
            path: 'M18 0C8.05884 0 0 8.05884 0 18C0 33 18 48 18 48C18 48 36 33 36 18C36 8.05884 27.9412 0 18 0ZM18 24C14.6863 24 12 21.3137 12 18C12 14.6862 14.6863 12 18 12C21.3137 12 24 14.6862 24 18C24 21.3137 21.3137 24 18 24Z',
            fillColor: '#e8Ba06',
            fillOpacity: 1,
            strokeWeight: 0,
            anchor: new google.maps.Point(15, 30),
        };

        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var currentLatitude = position.coords.latitude;
                var currentLongitude = position.coords.longitude;
                console.log(currentLatitude);
                console.log(currentLongitude);
                let currentMarker = new google.maps.Marker({
                    position: {lat: currentLatitude, lng: currentLongitude},
                    map: map,
                    icon: '',
                });
                createDirection.setAttribute('data-position', `{"lat":${position.coords.latitude}, "lng":${position.coords.longitude}}`);
            });
        }

        let addressParent = document.querySelector('.business-address');
        let addressItem = addressParent.querySelectorAll('.business-contacts__contact');

        let mapParent = document.querySelector('.business-map');
        let createDirection = mapParent.querySelector('.business-map__btn');

        createDirection.addEventListener('click', function () {
            let Dest = JSON.parse(this.getAttribute('data-location'));
            let Curr = JSON.parse(this.getAttribute('data-position'));
            calculateAndDisplayRoute(directionsRenderer, directionsService, Dest, Curr);
        });


        let prevMarker = {};
        let itemAttribute = JSON.parse(addressItem[0].getAttribute('data-location'));
        let markerFirst = new google.maps.Marker({
            position: itemAttribute,
            map: map,
            icon: svgMarker,
        });
        map.setCenter(new google.maps.LatLng(itemAttribute));
        createDirection.setAttribute('data-location', addressItem[0].getAttribute('data-location'));
        addressItem.forEach(elem => {
            elem.addEventListener('click', function () {
                markerFirst.setMap(null);
                if (Object.keys(prevMarker).length !== 0
                    && Object.getPrototypeOf(prevMarker) !== Object.prototype) {
                    prevMarker.setMap(null);
                }
                let itemAttribute = JSON.parse(this.getAttribute('data-location'));
                let marker = new google.maps.Marker({
                    position: itemAttribute,
                    map: map,
                    icon: svgMarker,
                });
                prevMarker = marker;
                createDirection.setAttribute('data-location', this.getAttribute('data-location'));
                map.setCenter(new google.maps.LatLng(itemAttribute));
                map.setZoom(15);
            });
        });


        function calculateAndDisplayRoute(
            directionsRenderer,
            directionsService,
            Dest,
            Curr
        ) {
            directionsService.route({
                origin: Curr,
                destination: Dest,
                travelMode: google.maps.TravelMode.WALKING,
            })
                .then((result) => {
                    directionsRenderer.setDirections(result);
                })
                .catch((e) => {
                    window.alert('Directions request failed due to ' + e);
                });
        }
    }

</script>
