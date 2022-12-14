<?php

class BrandStatistic {
	private $post_ID;
	private $post;
	private $id_active;

	private $period;
	private $statistic = array();
	private $allowed_metrics = array(
		'clicks',
		'shown_in_search',
		'follow_links',
		'rating_order',
		'user_rating',
		'new_reviews'
	);

	private $meta_key_prefix = 'brand_statistic_';

	public function __construct( $post, $period = 1 ) {
		if ( $post instanceof WP_Post ) {
			$this->post    = $post;
			$this->post_ID = $this->post->ID;
		} else {
			$this->post_ID = $post;
			$this->post    = get_post( $post );
		}
		$this->period    = $period;
		$this->id_active = $this->post->post_status === 'publish';
		$this->loadStatistic();

		// prevent zero rating before new comments added
		if ( ! $this->__get( 'user_rating' ) ) {
			$brand_rating = get_post_meta($this->post_ID, 'brand_rating', true) ?: 0;
			$this->__set('user_rating',  $brand_rating);
			$this->statistic['user_rating'] = $brand_rating;
		}
		do_action( 'qm/debug', $this->statistic );

		return $this;
	}

	public function __get( $name ) {
		if ( in_array( $name, $this->allowed_metrics ) ) {
			return $this->statistic[ $name ] ?? null;
		} else {
			return new WP_Error( 'metric_dont_exist', 'Requested metric do\'t exist' );
		}
	}

	public function __set( $name, $value ) {
		if ( $this->id_active ) {
			return new WP_Error( 'brand_deactivated', 'Can\'t save statistic for deactivated brand' );
		}
		if ( in_array( $name, $this->allowed_metrics ) ) {
			return new WP_Error( 'metric_dont_exist', 'Can\'t save statistic because metric do\'t exist' );
		}

		$meta_key           = $this->getMetaKeys( 1 )[0]; // get key for current mouth meta-data
		$current_statistic  = get_post_meta( $this->post_ID, $meta_key, true );
		$statistic          = $current_statistic ?: array_fill_keys( $this->allowed_metrics, 0 ); // create blank template if no data
		$statistic[ $name ] = $value;

		return update_post_meta( $this->post_ID, $meta_key, $statistic );
	}

	public function increment_stat( $stat ) {
		$prev_value = $this->__get( $stat );
		if ( ! is_wp_error( $prev_value ) ) {
			return $this->__set( $stat, $prev_value + 1 );
		} else {
			return $prev_value;
		}
	}

	private function loadStatistic(): void {
		$chunks = $this->getStatisticChunks( $this->period );
		$values = $this->combineChunks( $chunks, $this->allowed_metrics );

		$this->statistic = array_combine( $this->allowed_metrics, $values );
	}

	private function getStatisticChunks( $period ): array {
		$chunks    = array();
		$meta_keys = $this->getMetaKeys( $period );
		foreach ( $meta_keys as $meta_key ) {
			$chunks[ $meta_key ] = get_post_meta( $this->post_ID, $meta_key, true );
		}

		return $chunks;
	}

	private function combineChunks( array $chunks, $columns ): array {
		$values = array();
		foreach ( $columns as $column ) {
			$values[ $column ] = array_sum( array_column( $chunks, $column ) );
		}

		return $values;
	}

	private function getMetaKeys( $period ): array {
		$keys = array();
		$dt   = new DateTime( 'first day of this month' );
		for ( $i = 1; $i <= $period; $i ++ ) {
			$keys[] = $this->meta_key_prefix . strtolower( $dt->format( 'F_Y' ) );
			$dt->modify( '-1 month' );
		}

		return $keys;
	}
}
