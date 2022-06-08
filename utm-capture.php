<?php

/*
	Plugin Name: UTM Capture
	Plugin URI: https://github.com/rjmccollam/utm-capture
	Description: Capture UTM parameters from marketing campaigns and use them to pass along information to specific Gravity Forms fields.
	Version: 1.0.1
	Author: RJ McCollam
	Author URI: https://rjmccollam.com/
	License: GPLv2 or later
	Text Domain: utm_capture
*/

	function process_cookies() {
		if ( !is_admin() ) {

			// Get UTM parameters from URL
			$source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
			$medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : null;
			$term = isset($_GET['utm_term']) ? $_GET['utm_term'] : null;
			$content = isset($_GET['utm_content']) ? $_GET['utm_content'] : null;
			$campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;

			// If source parameter exists and the cookie has not already been set process all cookies
			if ( $source && !isset($_COOKIE['utm_source']) ) {

				setcookie('utm_source', $source, time() + (86400 * 30), '/');
				setcookie('utm_medium', $medium, time() + (86400 * 30), '/');
				setcookie('utm_term', $term, time() + (86400 * 30), '/');
				setcookie('utm_content', $content, time() + (86400 * 30), '/');
				setcookie('utm_campaign', $campaign, time() + (86400 * 30), '/');

			}

	    }
	}
	add_action('wp_loaded', 'process_cookies');

	// Populate Gravity Form Fields

	// Source field
	function populate_utm_source( $value ) {
		if (empty($_COOKIE['utm_source']) && empty($_GET['utm_source'])) {
			return false;
		}

		$source = isset($_GET['utm_source']) ? $_GET['utm_source'] : $_COOKIE['utm_source'];

		return $source;
	}
	add_filter( 'gform_field_value_utm_source', 'populate_utm_source' );

	// Medium field
	function populate_utm_medium( $value ) {
		if (empty($_COOKIE['utm_medium']) && empty($_GET['utm_medium'])) {
			return false;
		}

		$medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : $_COOKIE['utm_medium'];

		return $medium;
	}
	add_filter( 'gform_field_value_utm_medium', 'populate_utm_medium' );

	// Term field
	function populate_utm_term( $value ) {
		if (empty($_COOKIE['utm_term']) && empty($_GET['utm_term'])) {
			return false;
		}

		$term = isset($_GET['utm_term']) ? $_GET['utm_term'] : $_COOKIE['utm_term'];

		return $term;
	}
	add_filter( 'gform_field_value_utm_term', 'populate_utm_term' );

	// Content field
	function populate_utm_content( $value ) {
		if (empty($_COOKIE['utm_content']) && empty($_GET['utm_content'])) {
			return false;
		}

		$content = isset($_GET['utm_content']) ? $_GET['utm_content'] : $_COOKIE['utm_content'];

		return $content;
	}
	add_filter( 'gform_field_value_utm_content', 'populate_utm_content' );

	// Campaign field
	function populate_utm_campaign( $value ) {
		if (empty($_COOKIE['utm_campaign']) && empty($_GET['utm_campaign'])) {
			return false;
		}

		$campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : $_COOKIE['utm_campaign'];

		return $campaign;
	}
	add_filter( 'gform_field_value_utm_campaign', 'populate_utm_campaign' );

	// Referer field
	function populate_referer( $value ) {
		if (empty($_SERVER['HTTP_REFERER'])) {
			return false;
		}

		return $_SERVER['HTTP_REFERER'];
	}
	add_filter( 'gform_field_value_referer', 'populate_referer' );