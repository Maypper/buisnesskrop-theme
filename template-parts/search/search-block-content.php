<div class="search-block__content">
	<div class="search-block__form divider">
		<?php get_search_form(); ?>
		<div class="search-block__form-chip advanced-search-button" id="menu-search-button">
			<?php _e( 'Advanced search', 'krop' ) ?>
			<svg width="12" height="12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M10.243 10.243 6 6m0 0L1.757 1.757M6 6l4.243-4.243M6 6l-4.243 4.243"
				      stroke="#6B2A14"
				      stroke-width="2" stroke-linecap="round"/>
			</svg>
		</div>
	</div>

	<div class="search-block__wrap open" id="search-block-bottom">
		<?php get_template_part( 'template-parts/search/search', 'advanced' ); ?>
	</div>
</div>