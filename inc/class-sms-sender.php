<?php

class SMS_Sender {
	private $api_key;
	private $api_endpoint;
	private $api_url;
	private $sender;
	private $request;

	public function __construct( array $recipients = array(), string $message = '' ) {
		$this->api_key      = get_option( 'sms_api_key' );
		$this->api_endpoint = 'https://api.turbosms.ua/';
		$this->sender       = 'BRAND';

		$this->request = array(
			'headers' => array(
				'Authorization' => 'Bearer ' . $this->api_key,
				'Content-Type'  => 'application/json',
			),
			'body'    => array()
		);

		if ( $recipients ) {
			$this->request['body']['recipients']    = $recipients;
			$this->request['body']['sms']['sender'] = $this->sender;
		}
		if ( $message ) {
			$this->request['body']['sms']['text'] = iconv(mb_detect_encoding($message, mb_detect_order(), true), "UTF-8", $message);
		}
		$this->request['body'] = json_encode( $this->request['body'] );

		return $this;
	}

	public function test() {
		$this->api_url = $this->api_endpoint . '/message/ping.json/';

		return $this->send();
	}

	public function send() {
		$this->api_url = $this->api_endpoint . '/message/send.json/';
		$response = wp_remote_post( $this->api_url, $this->request );
		if ( is_wp_error( $response ) ) {
			return $response;
		} else {
			return json_decode( wp_remote_retrieve_body( $response ) );
		}
	}

	public function debug(): array {
		return $this->request;
	}
}