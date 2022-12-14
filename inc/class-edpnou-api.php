<?php

use JetBrains\PhpStorm\ArrayShape;

class EdpnouAPI {
	private $api_key;
	private $api_base_url;
	private $url;

	private $api_entrypoint_version = '/2.0';


	public function __construct( string $endpoint ) {
		$this->api_key      = get_field( 'edpnou_api_key', 'option' );
		$this->api_base_url = get_field( 'api_entrypoint', 'option' );

		$this->url = $this->api_base_url . $this->api_entrypoint_version . '/' . $endpoint;

		return $this;
	}

	public function call( $args ) {
		$defaults = array(
			'limit' => 5,
		);
		$request  = wp_remote_post( $this->url, array(
			'headers' => $this->get_headers(),
			'body'    => wp_parse_args( $args, $defaults )
		) );
		$response = array(
			'status'  => wp_remote_retrieve_response_code( $request ),
			'headers' => wp_remote_retrieve_headers( $request ),
			'body'    => json_decode( wp_remote_retrieve_body( $request ) ),
		);
		if ( is_wp_error( $request ) ) {
			$response['body'] = array(
				'errors'          => $request->get_error_codes(),
				'errors_messages' => $request->get_error_messages()
			);
		}

		return $response;
	}

	private function get_headers(): array {
		return array(
			'Authorization' => 'Token ' . $this->api_key,
			'Accept'        => 'application/json'
		);
	}
}