<?php
global $post;
$messages = new WP_Query( array(
	'post_type'    => array( 'confirm_ownership', 'brands' ),
	'post_status'  => array( 'publish', 'rejected', 'approved' ),
	'author'       => get_current_user_id(),
	'orderby'      => 'modified',
	'nopaging'     => true,
	'meta_key'     => 'unread',
	'meta_value'   => true,
	'meta_compare' => 'LIKE'
) );

$new_messages = $messages->have_posts();
?>

    <div class="d-flex personal__title__text-btn align-items-center justify-content-between">
        <div class="d-flex personal__title__text-btn align-items-center justify-content-between">
            <div class="d-flex personal__title__icon-text align-items-center">
                <svg class="<?php echo $new_messages ? 'notification-animation' : ''; ?>" width="28" height="28"
                     viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M21.8757 19.2939C21.6259 18.6714 21.4999 18.0152 21.4999 17.3443V12.5C21.4999 9.13966 19.2634 6.32178 16.2117 5.37108C16.0303 4.31107 15.111 3.5 14 3.5C12.889 3.5 11.9696 4.31107 11.7883 5.37108C8.73654 6.32178 6.50002 9.13966 6.50002 12.5V17.3443C6.50002 18.0152 6.37404 18.6714 6.12429 19.2939L5.05345 21.9717C4.96114 22.2031 4.98973 22.4638 5.12887 22.6704C5.26877 22.8769 5.50092 23 5.74996 23H11.4512C11.983 23.9038 12.9315 24.5 14 24.5C15.0685 24.5 16.017 23.9038 16.5487 23H22.2499C22.499 23 22.7311 22.8769 22.871 22.6704C23.0102 22.4638 23.0388 22.2031 22.9465 21.9717C22.9465 21.9717 21.8757 19.2939 21.8757 19.2939ZM6.8574 21.5L7.51731 19.8506C7.83739 19.0507 7.99997 18.207 7.99997 17.3442V12.5C7.99997 9.19087 10.6916 6.49995 14 6.49995C17.3084 6.49995 19.9999 9.19087 19.9999 12.5V17.3442C19.9999 18.207 20.1625 19.0507 20.4826 19.8506L21.1425 21.5H6.8574Z"
                            fill="#E8BA06"/>
                    <path
                            d="M3.41284 8.35303C2.48851 10.0845 2 12.0371 2 14C2 15.9629 2.48851 17.9155 3.41284 19.647L4.73559 18.9409C3.91602 17.4043 3.5 15.7417 3.5 14C3.5 12.2583 3.91602 10.5957 4.73559 9.05907L3.41284 8.35303Z"
                            fill="#E8BA06"/>
                    <path
                            d="M24.5874 8.35303L23.2646 9.05907C24.0842 10.5957 24.5002 12.2583 24.5002 14C24.5002 15.7417 24.0842 17.4043 23.2646 18.9409L24.5874 19.647C25.5117 17.9155 26.0003 15.9629 26.0003 14C26.0003 12.0371 25.5117 10.0845 24.5874 8.35303Z"
                            fill="#E8BA06"/>
                </svg>
				<?php echo $new_messages ? __( 'You have new messages!', 'krop' ) : __( 'There are no new messages', 'krop' ); ?>
            </div>
            <button class="personal__title__btn swapper-list-item <?php echo $new_messages ? '' : 'personal__title__btn--disabled'; ?>"
                    data-swapper-select="show-message" data-swapper-class="personal__title__btn__show-message">
				<?php _e( 'View', 'krop' ); ?>
            </button>
        </div>
        <div class="personal__message" data-swapper="show-message">
            <div class="personal__message__title">
                <div class="personal__message__title__content">
                    <div class="d-flex align-items-center">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M21.8757 19.2939C21.6259 18.6714 21.4999 18.0152 21.4999 17.3443V12.5C21.4999 9.13966 19.2634 6.32178 16.2117 5.37108C16.0303 4.31107 15.111 3.5 14 3.5C12.889 3.5 11.9696 4.31107 11.7883 5.37108C8.73654 6.32178 6.50002 9.13966 6.50002 12.5V17.3443C6.50002 18.0152 6.37404 18.6714 6.12429 19.2939L5.05345 21.9717C4.96114 22.2031 4.98973 22.4638 5.12887 22.6704C5.26877 22.8769 5.50092 23 5.74996 23H11.4512C11.983 23.9038 12.9315 24.5 14 24.5C15.0685 24.5 16.017 23.9038 16.5487 23H22.2499C22.499 23 22.7311 22.8769 22.871 22.6704C23.0102 22.4638 23.0388 22.2031 22.9465 21.9717C22.9465 21.9717 21.8757 19.2939 21.8757 19.2939ZM6.8574 21.5L7.51731 19.8506C7.83739 19.0507 7.99997 18.207 7.99997 17.3442V12.5C7.99997 9.19087 10.6916 6.49995 14 6.49995C17.3084 6.49995 19.9999 9.19087 19.9999 12.5V17.3442C19.9999 18.207 20.1625 19.0507 20.4826 19.8506L21.1425 21.5H6.8574Z"
                                    fill="#E8BA06"/>
                            <path
                                    d="M3.41284 8.35303C2.48851 10.0845 2 12.0371 2 14C2 15.9629 2.48851 17.9155 3.41284 19.647L4.73559 18.9409C3.91602 17.4043 3.5 15.7417 3.5 14C3.5 12.2583 3.91602 10.5957 4.73559 9.05907L3.41284 8.35303Z"
                                    fill="#E8BA06"/>
                            <path
                                    d="M24.5874 8.35303L23.2646 9.05907C24.0842 10.5957 24.5002 12.2583 24.5002 14C24.5002 15.7417 24.0842 17.4043 23.2646 18.9409L24.5874 19.647C25.5117 17.9155 26.0003 15.9629 26.0003 14C26.0003 12.0371 25.5117 10.0845 24.5874 8.35303Z"
                                    fill="#E8BA06"/>
                        </svg>
                        <div class="personal__message__title__text"><?php _e( 'New message', 'krop' ); ?></div>
                    </div>
                    <div class="personal__message__title__close swapper-list-item"
                         data-swapper-select="show-message"
                         data-swapper-class="personal__title__btn__show-message"
                         onclick="markMessagesAsRead()">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M10.2435 10.2426L6.00091 6M6.00091 6L1.75827 1.75736M6.00091 6L10.2435 1.75736M6.00091 6L1.75827 10.2426"
                                    stroke="#E8BA06" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="personal__message__list">
				<?php
				if ( $messages->have_posts() ) {
					while ( $messages->have_posts() ) {
						$messages->the_post();
						?>
                        <div class="personal__message__item" data-message-id="<?php echo $post->ID; ?>">
                            <div class="d-md-flex d-block justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="personal__message__item__img">
										<?php
										if ( $post->post_type === 'brand' ) {
											the_post_thumbnail( 'notification-thumbnail' );
										} else {
											echo wp_get_attachment_image( get_post_thumbnail_id( get_post_meta( $post->ID, 'property_id', true ) ), 'notification-thumbnail' );
										}
										?>
                                    </div>
                                    <div class="d-block">
                                        <div class="personal__message__item__title"><?php echo splitter_trim_symbols( html_entity_decode( get_the_title() ), 40 ); ?></div>
										<?php
										switch ( $post->post_status ) {
											case 'publish':
												?>
                                                <div class="personal__message__item__text personal__message__item__text--сonfirm">
	                                                <?php _e('Confirmed by administrator', 'krop'); ?>
                                                </div>
												<?php
												break;
											case 'rejected':
												?>
                                                <div class="personal__message__item__text personal__message__item__text--reject">
													<?php echo $post->post_type === 'brands' ?  __('Rejected by administrator', 'krop') : __( 'Ownership rejected by administrator', 'krop' );; ?>
                                                </div>
												<?php
												break;
											case 'approved':
												?>
                                                <div class="personal__message__item__text personal__message__item__text--сonfirm">
	                                                <?php _e('Ownership confirmed by administrator', 'krop'); ?>
                                                </div>
												<?php
												break;
											default:
												break;
										}
										?>
                                    </div>
                                </div>
                                <div class="personal__message__item__date d-flex justify-content-end"><?php echo human_time_post_date( $post, true ); ?></div>
                            </div>

                        </div>
						<?php
					}
				}
				?>
            </div>
        </div>
    </div>

<?php
wp_reset_query();