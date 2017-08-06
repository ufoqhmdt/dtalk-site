<?php

class The7_Image_BWB_Width_Calculator {

	protected $config;

	public function __construct( The7_Image_Width_Calculator_Config $config ) {
		$this->config = $config;
	}

	public function calculate_options() {
		$desktop_width = $this->config->get_content_width();
		if ( false !== strpos( $desktop_width, '%' ) ) {
			$desktop_width = round( $desktop_width * 19.20 );
		}

		$desktop_width = absint( $desktop_width );

		$responsive_width = array(
			'desktop' => $desktop_width,
			'h_tablet' => 1200,
			'v_tablet' => 990,
			'phone' => 768,
		);

		$image_w = array();
		foreach ( $responsive_width as $device => $content_width ) {
			$masonry_content_width = $content_width;
			$masonry_content_width_without_padding = $masonry_content_width -= $this->get_content_padding( $content_width ) * 2;
			$masonry_content_width -= $this->get_sidebar_width( $content_width );
			$columns_gaps = $this->config->get_columns_gaps();
			$col = $this->get_columns( $device );
			if ( $col >= 2 && $this->config->image_is_wide() ) {
				$gaps = ($col - 2) * 2 * $columns_gaps;
				$masonry_content_width -= $gaps;
				$image_width = round( $masonry_content_width / $col );
				$image_width = $image_width * 2;
			} else {
				$gaps = ($col - 1) * 2 * $columns_gaps;
				$masonry_content_width -= $gaps;
				$image_width = round( $masonry_content_width / $col );
			}

			$image_w[] = min( $image_width, $masonry_content_width_without_padding );
		}

		$image_width = max( $image_w );
		$img_options = array( 'w' => $image_width, 'z' => 0, 'hd_ratio' => 1.5 );

		return $img_options;
	}

	protected function get_sidebar_width( $content_width ) {
		if ( ! $this->config->is_sidebar_enabled() ) {
			return 0;
		}

		$hide_sidebar_after = $this->config->get_sidebar_switch();

		if ( $content_width <= $hide_sidebar_after ) {
			// Do not count sidebar if it's displayed after content.
			return 0;
		}

		$sidebar_width = $this->config->get_sidebar_width();
		$sidebar_in_percents = ( false !== strpos( $sidebar_width, '%' ) );

		if ( $sidebar_in_percents ) {
			$content_padding = $this->get_content_padding( $content_width );
			$sidebar_width = ($content_width - $content_padding) * absint( $sidebar_width ) * 0.01;
		} else {
			$sidebar_width = absint( $sidebar_width );
		}

		$sidebar_gap = $this->config->get_sidebar_gap();

		return ($sidebar_gap  + $sidebar_width - 25);
	}

	protected function get_content_padding( $content_width ) {
		$side_padding_switch = $this->config->get_side_padding_switch();

		if ( $content_width < $side_padding_switch ) {
			$mobile_side_padding = $this->config->get_mobile_side_padding();

			return $mobile_side_padding;
		} else {
			$side_padding = $this->config->get_side_padding();

			return $side_padding;
		}
	}

	protected function get_columns( $device ) {
		$cols = $this->config->get_columns();
		if ( array_key_exists( $device, $cols ) ) {
			return absint( $cols[ $device ] );
		}

		return 1;
	}
}