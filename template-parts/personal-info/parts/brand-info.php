<div class="personal__content__item__content col-md-10 col-8">
	<?php
	switch ( $post->post_status ) {
		case 'publish':
			?>
            <div class="personal__content__item__status-brand personal__content__item__status-brand--active">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M6 0C2.69166 0 0 2.69166 0 6C0 9.30834 2.69166 12 6 12C9.30834 12 12 9.30834 12 6C12 2.69166 9.30834 0 6 0ZM6 11.25C3.10511 11.25 0.750008 8.89491 0.750008 6.00002C0.750008 3.10513 3.10511 0.750008 6 0.750008C8.89489 0.750008 11.25 3.10511 11.25 6C11.25 8.89489 8.89489 11.25 6 11.25Z"
                            fill="#83A348"/>
                    <path
                            d="M5.24951 7.34475L3.63965 5.73488L3.10938 6.26516L5.24951 8.4053L8.88966 4.76514L8.35939 4.23486L5.24951 7.34475Z"
                            fill="#83A348"/>
                </svg>
				<?php _e( 'Activated', 'krop' ); ?>
            </div>
			<?php
			break;
		case 'draft':
		case 'pending':
			?>
            <div class="personal__content__item__status-brand personal__content__item__status-brand--time">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M6 0C2.69166 0 0 2.69166 0 6C0 9.30834 2.69166 12 6 12C9.30834 12 12 9.30834 12 6C12 2.69166 9.30834 0 6 0ZM6 11.25C3.1051 11.25 0.750003 8.8949 0.750003 6C0.750003 3.1051 3.1051 0.750003 6 0.750003C8.8949 0.750003 11.25 3.1051 11.25 6C11.25 8.8949 8.8949 11.25 6 11.25Z"
                            fill="#E57937"/>
                    <path d="M6.375 2.25H5.625V6.15526L7.98485 8.51512L8.51513 7.98485L6.375 5.84472V2.25Z"
                          fill="#E57937"/>
                </svg>
				<?php _e( 'Under consideration', 'krop' ); ?>
            </div>
			<?php
			break;
		case 'deactivated':
		case 'rejected':
			?>
            <div class="personal__content__item__status-brand personal__content__item__status-brand--inactive">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M11.8906 9.95166C11.8906 9.95166 11.8906 9.95166 11.8904 9.95143C11.0915 8.31275 9.75234 5.98852 8.57091 3.938C7.95272 2.86475 7.3687 1.85134 6.94657 1.08106C6.74735 0.717289 6.39333 0.5 5.99974 0.5C5.60616 0.5 5.25216 0.717289 5.05294 1.08106C4.63055 1.8518 4.0463 2.86623 3.42738 3.9402C2.24667 5.99023 0.907992 8.31348 0.109383 9.95166C0.0368672 10.1008 0 10.2588 0 10.4207C0 11.0159 0.480727 11.5 1.07182 11.5L6 11.4995L10.9282 11.5C11.5193 11.5 12 11.0159 12 10.4207C12 10.2588 11.9631 10.1008 11.8906 9.95166ZM10.9282 11.0003H1.07227C0.757078 11.0003 0.500484 10.74 0.500484 10.4207C0.500484 10.3352 0.520266 10.251 0.559313 10.1707C1.35033 8.54811 2.68432 6.23267 3.86107 4.18995C4.48118 3.11354 5.06688 2.09668 5.49169 1.3213C5.71191 0.918945 6.28807 0.918945 6.50829 1.3213C6.93286 2.09621 7.51805 3.11206 8.13769 4.18752C9.31519 6.23098 10.6496 8.54738 11.4409 10.1704C11.4802 10.251 11.5 10.3352 11.5 10.4207C11.5 10.74 11.2434 11.0003 10.9282 11.0003Z"
                            fill="black"/>
                    <path
                            d="M6.00002 3C5.86182 3 5.75 3.11182 5.75 3.25001V8.25001C5.75 8.3882 5.86182 8.50002 6.00002 8.50002C6.13821 8.50002 6.25003 8.3882 6.25003 8.25001V3.25001C6.25003 3.11182 6.13821 3 6.00002 3Z"
                            fill="black"/>
                    <path
                            d="M6.00002 10C6.1381 10 6.25003 9.88808 6.25003 9.75001C6.25003 9.61193 6.1381 9.5 6.00002 9.5C5.86194 9.5 5.75 9.61193 5.75 9.75001C5.75 9.88808 5.86194 10 6.00002 10Z"
                            fill="black"/>
                </svg>
				<?php
				if ( $post->post_status === 'deactivated' ) {
					_e( 'Deactivated', 'krop' );
				} else {
					_e( 'Rejected', 'krop' );
				}
				?>

            </div>
			<?php
			break;
		default:
			break;
	}
	the_title( '<a class="personal__content__item__text d-block" href="'.get_post_permalink().'" target="_blank">', '</a>' );
	the_date( 'j.m.Y', '<div class="personal__content__item__date">' . __( 'Added:', 'krop' ) . ' ', '</div>' );
	?>
</div>