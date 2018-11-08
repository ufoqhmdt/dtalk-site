<?php
/**
 * Contact form settings.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options[] = array(
	'name' => _x( 'Contact Form Appearance', 'theme-options', 'the7mk2' ),
	'type' => 'heading',
	'id'   => 'contact-form-appearance',
);

$options[] = array( 'name' => _x( 'Contact form appearance', 'theme-options', 'the7mk2' ), 'type' => 'block' );

$options['input_height'] = array(
	'name'  => _x( 'Input height', 'theme-options', 'the7mk2' ),
	'id'    => 'input_height',
	'std'   => '38px',
	'type'  => 'number',
	'units' => 'px',
);

$options['input_color'] = array(
	'name' => _x( 'Input font color', 'theme-options', 'the7mk2' ),
	'id'   => 'input_color',
	'std'  => '#787d85',
	'type' => 'color',
);

$options['input_bg_color'] = array(
	'name' => _x( 'Background color', 'theme-options', 'the7mk2' ),
	'id'   => 'input_bg_color',
	'std'  => '#fcfcfc',
	'type' => 'alpha_color',
);

$options['input_border_radius'] = array(
	'name'  => _x( 'Input border radius', 'theme-options', 'the7mk2' ),
	'id'    => 'input_border_radius',
	'std'   => '0px',
	'type'  => 'number',
	'units' => 'px',
);

$options['input_border_width'] = array(
	'name'  => _x( 'Border width', 'theme-options', 'the7mk2' ),
	'id'    => 'input_border_width',
	'std'   => '1px',
	'type'  => 'number',
	'units' => 'px',
);

$options['input_border_color'] = array(
	'name' => _x( 'Border color', 'theme-options', 'the7mk2' ),
	'id'   => 'input_border_color',
	'std'  => 'rgba(173, 176, 182, 0.3)',
	'type' => 'alpha_color',
);

$options[] = array( 'name' => _x( 'Contact form messages', 'theme-options', 'the7mk2' ), 'type' => 'block' );

$options['contact_form_message'] = array(
	'id'      => 'contact_form_message',
	'name'    => _x( 'Display messages', 'theme-options', 'the7mk2' ),
	'type'    => 'radio',
	'class'   => 'small',
	'std'     => '1',
	'desc'    => _x( 'Also affects WooCommerce messages.', 'theme-options', 'the7mk2' ),
	'options' => array(
		'1' => _x( 'Pop-up', 'theme-options', 'the7mk2' ),
		'0' => _x( 'Inline', 'theme-options', 'the7mk2' ),
	),
);

$options['message_color'] = array(
	'name' => _x( 'Message font color', 'theme-options', 'the7mk2' ),
	'id'   => 'message_color',
	'std'  => '#fff',
	'type' => 'color',
	'desc' => _x( 'Also affects WooCommerce messages.', 'theme-options', 'the7mk2' ),
);

$options['message_bg_color'] = array(
	'name'     => _x( 'Message background color', 'theme-options', 'the7mk2' ),
	'id'       => 'message_bg_color',
	'std'      => '',
	'type'     => 'alpha_color',
	'sanitize' => 'empty_alpha_color',
	'desc'     => _x( 'Leave empty to use accent color. Also affects WooCommerce messages.', 'theme-options', 'the7mk2' ),
);

$options['custom_error_messages_validation'] = array(
	'name'     => _x( 'Field error message', 'theme-options', 'the7mk2' ),
	'id'       => 'custom_error_messages_validation',
	'std'      => 'One or more fields have an error. Please check and try again.',
	'type'     => 'textarea',
	'desc'     => _x( 'Leave empty to show default message.', 'theme-options', 'the7mk2' ),
	'sanitize' => 'text',
);

$options['custom_error_messages'] = array(
	'name'     => _x( 'Form error message', 'theme-options', 'the7mk2' ),
	'id'       => 'custom_error_messages',
	'std'      => 'The message has not been sent. Please try again.',
	'type'     => 'textarea',
	'desc'     => _x( 'Leave empty to show default message.', 'theme-options', 'the7mk2' ),
	'sanitize' => 'text',
);

$options['custom_success_messages'] = array(
	'name'     => _x( 'Form success message', 'theme-options', 'the7mk2' ),
	'id'       => 'custom_success_messages',
	'std'      => 'Your message has been sent.',
	'type'     => 'textarea',
	'desc'     => _x( 'Leave empty to show default message.', 'theme-options', 'the7mk2' ),
	'sanitize' => 'text',
);

$options[] = array( 'name' => _x( 'Contact form sends emails to:', 'theme-options', 'the7mk2' ), 'type' => 'block' );

$options['general-contact_form_send_mail_to'] = array(
	'name'     => _x( 'E-mail', 'theme-options', 'the7mk2' ),
	'desc'     => _x( 'Leave empty to use admin e-mail.', 'theme-options', 'the7mk2' ),
	'id'       => 'general-contact_form_send_mail_to',
	'std'      => '',
	'type'     => 'text',
	'sanitize' => 'email',
);