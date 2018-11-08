<?php
// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class The7_Option_Field_Icons_Picker
 */
class The7_Option_Field_Icons_Picker {

	/**
	 * Return icons picker HTML.
	 *
	 * @param string $name   Input name.
	 * @param string $id     Field id.
	 * @param string $value  Value string.
	 * @param array  $config Config.
	 *
	 * @return string
	 */
	public static function html( $name, $id, $value, $config = array() ) {
		$config = wp_parse_args( $config, array(
			'icons'             => array(),
			'allow_empty'       => false,
			'value_input_class' => '',
		) );

		$value = $value ? (string) $value : '';
		$icons = array();

		if ( $config['allow_empty'] ) {
			$icons['Empty'] = array( '' );
		}

		$icons = array_merge( $icons, $config['icons'] );

		$icons['Font Awesome'] = include PRESSCORE_EXTENSIONS_DIR . '/font-awesome-icons.php';

		$icons = apply_filters( 'the7_icons_in_settings', $icons );

		$output = '';

		$output .= '<div class="of-icons_picker-controls">';
		$output .= '<input type="hidden" name="' . esc_attr( $name ) . '" class="of-icons_picker-value ' . esc_attr( $config['value_input_class'] ) . '" value="' . esc_attr( $value ) . '" />';
		$output .= '<ul class="of-icons_picker-list">';
		$output .= '<li class="of-icons_picker-selector" data-car-icon=""><i class="moon-icon ' . esc_attr( $value ) . '"></i><span class="selector-button"><i class="fa-arrow-down fip-fa fa"></i></span>';
		$output .= '<ul class="of-icons_picker-list-sub">';
		$output .= '<input type="search" class="of-icons_picker-search widefat" placeholder="' . esc_attr( _x( 'Filter icons', 'admin', 'the7mk2' ) ) . '">';
		foreach ( $icons as $font => $icon_set ) {
			$output .= '<p class="of-icons_picker-list-group">' . esc_html( $font ) . '</p>';
			foreach ( $icon_set as $icon ) {
				$icon_att = esc_attr( $icon );
				$selected = $icon === $value ? 'class="selected"' : '';
				$output   .= '<li ' . $selected . ' data-car-icon="' . $icon_att . '" title="' . $icon_att . '">';
				$output   .= '<i class="moon-icon ' . $icon_att . '"></i><label class="moon-icon">' . $icon_att . '</label>';
				$output   .= '</li>';
			}
		}
		$output .= '</ul>';
		$output .= '</li>';
		$output .= '</ul>';
		$output .= '</div>';

		return $output;
	}

}
