<?php
/**
 * Contact form settings.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Contact Form Appearance', 'theme-options', 'the7mk2'), "type" => "heading", "id" => "contact-form-appearance" );

	/**
	 * Contact form.
	 */
	$options[] = array(	"name" => _x('Contact form', 'theme-options', 'the7mk2'), "type" => "block" );

		$options[] = array(
			"desc"		=> '',
			"name"		=> _x( ' Input height (in "px")', 'theme-options', 'the7mk2' ),
			"id"		=> "input_height",
			"std"		=> '38px', 
			"type"		=> "text",
			"sanitize"	=> 'dimensions'
		);

		$options[] = array(
			"name"		=> _x( 'Input border radius (px)', 'theme-options', 'the7mk2' ),
			"id"		=> 'input_border_radius',
			"std"		=> '0',
			"type"		=> 'text',
			"sanitize"	=> 'dimensions'
		);

		$options[] = array(
			"name"	=> _x( 'Input font color', 'theme-options', 'the7mk2' ),
			"id"	=> "input_color",
			"std"	=> "#787d85",
			"type"	=> "color",
		);

		$options[] = array(
			"name"	=> _x( 'Border color', 'theme-options', 'the7mk2' ),
			"id"	=> "input_border_color",
			"std"	=> "#adb0b6",
			"type"	=> "color",
		);

		$options[] = array(
			"name"      => _x( 'Border opacity', 'theme-options', 'the7mk2' ),
			"id"        => "input_border_opacity",
			"std"       => 30, 
			"type"      => "slider"
		);

		$options[] = array(
			"name"	=> _x( 'Background color', 'theme-options', 'the7mk2' ),
			"id"	=> "input_bg_color",
			"std"	=> "#fcfcfc",
			"type"	=> "color"
		);

		$options[] = array(
			"name"      => _x( 'Background opacity', 'theme-options', 'the7mk2' ),
			"id"        => "input_bg_opacity",
			"std"       => 100, 
			"type"      => "slider"
		);

	/**
	 * Contact form sends emails to:.
	 */
	$options[] = array( "name" => _x("Contact form sends emails to:", "theme-options", 'the7mk2'), "type" => "block" );

		$options["general-contact_form_send_mail_to"] = array(
			"name"		=> _x( 'E-mail', 'theme-options', 'the7mk2' ),
			"desc"		=> _x('Leave empty to use admin e-mail.', 'theme-options', 'the7mk2'),
			"id"		=> "general-contact_form_send_mail_to",
			"std"		=> "",
			"type"		=> "text",
			"sanitize"	=> 'email'
		);