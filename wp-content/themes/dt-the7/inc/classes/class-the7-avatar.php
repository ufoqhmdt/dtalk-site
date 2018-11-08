<?php

class The7_Avatar {

	/**
	 * get_avatar() wrapper with some filters.
	 *
	 * @param mixed      $id_or_email
	 * @param int        $size
	 * @param string     $default
	 * @param string     $alt
	 * @param null|array $args
	 *
	 * @return false|string
	 */
	public static function get_avatar( $id_or_email, $size = 96, $default = '', $alt = '', $args = null ) {
		add_filter( 'get_avatar', array( __CLASS__, 'check_gravatar_existence_filter' ), 10, 6 );
		$avatar = get_avatar( $id_or_email, $size, $default, $alt, $args );
		remove_filter( 'get_avatar', array( __CLASS__, 'check_gravatar_existence_filter' ), 10 );

		return $avatar;
	}

	/**
	 * Return false if gravatar in use and user do not have one.
	 *
	 * @param $avatar
	 * @param $id_or_email
	 * @param $args_size
	 * @param $args_default
	 * @param $args_alt
	 * @param $args
	 *
	 * @return bool
	 */
	public static function check_gravatar_existence_filter( $avatar, $id_or_email, $args_size, $args_default, $args_alt, $args ) {
		if ( ! preg_match( '/.*\.gravatar\.com.*/', $avatar ) || self::is_gravatar_exists( $args['url'] ) ) {
			// non gravatar or gravatar exists.
			return $avatar;
		}

		return false;
	}

	/**
	 * Check if provided gravatar url response with 200.
	 *
	 * Cache result for $url in wp_cache for 24 hours.
	 *
	 * @param string $url
	 *
	 * @return bool
	 */
	public static function is_gravatar_exists( $url ) {
		$_uri = remove_query_arg( array( 's', 'd', 'f', 'r' ), $url );
		$hash_key = md5( strtolower( trim( $_uri ) ) );
		$data = wp_cache_get( $hash_key );
		if ( empty( $data ) ) {
			$_uri = add_query_arg( 'd', '404', $_uri );
			$response = wp_remote_head( $_uri );
			if ( is_wp_error( $response ) ) {
				$data = 'not200';
			} else {
				$data = $response['response']['code'];
			}
			wp_cache_set( $hash_key, $data, $group = '', $expire = DAY_IN_SECONDS );
		}

		return ( $data == 200 );
	}
}
