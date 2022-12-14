<?php

add_action( 'admin_menu', 'sms_sender_options_page' );

function sms_sender_options_page() {

	add_options_page(
		'SMS Sending Settings', // page <title>Title</title>
		'SMS Sending', // menu link text
		'manage_options', // capability to access the page
		'sms-sending', // page URL slug
		'sms_sender_options_page_content', // callback function with content
		2 // priority
	);

}

function sms_sender_options_page_content(){

	echo '<div class="wrap">
	<h1>SMS Sending Settings</h1>
	<form method="post" action="options.php">';

	settings_fields( 'sms_sender_settings' ); // settings group name
	do_settings_sections( 'sms-sending' ); // just a page slug
	submit_button();

	echo '</form></div>';
}

add_action( 'admin_init',  'sms_sender_register_setting' );

function sms_sender_register_setting(){

	register_setting(
		'sms_sender_settings', // settings group name
		'sms_api_key', // option name
		'sanitize_text_field' // sanitization function
	);

	add_settings_section(
		'some_settings_section_id', // section ID
		'', // title (if needed)
		'', // callback function (if needed)
		'sms-sending' // page slug
	);

	add_settings_field(
		'sms_api_key',
		'SMS Sender API key',
		'sms_sender_text_field_html', // function which prints the field
		'sms-sending', // page slug
		'some_settings_section_id', // section ID
		array(
			'label_for' => 'sms_api_key',
			'class' => 'sms_sender-class', // for <tr> element
		)
	);

}

function sms_sender_text_field_html() {

	$text = get_option( 'sms_api_key' );

	printf(
		'<input type="text" id="sms_api_key" name="sms_api_key" value="%s" />',
		esc_attr( $text )
	);
}

