<?php
/*
Template Name: Персональний кабінет (зв'язатись з адміністратором)
Template Post Type: page
*/
get_header( 'personal-info' );
get_template_part( 'template-parts/breadcrumbs' );
?>

	<div class="container personal__content">
		<div class="d-lg-flex d-block justify-content-between align-items-center personal__title position-relative">
			<h1 class="text-left"><?php _e( 'Personal account', 'krop' ); ?></h1>
			<?php get_template_part( 'template-parts/personal-info/messages' ); ?>
		</div>
		<div class="personal__content">
			<div class="row">
				<div class="col-lg-4 col-12">
					<div class="personal__content__left d-lg-block d-md-flex d-block justify-content-between">
						<?php get_template_part( 'template-parts/personal-info/menu-business' ); ?>
						<?php get_template_part( 'template-parts/personal-info/menu-account' ); ?>
					</div>
				</div>
				<div class="col-lg-8 col-12">
					<div class="personal__content__right">
						<?php get_template_part( 'template-parts/personal-info/contact-administrator' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php

get_footer();