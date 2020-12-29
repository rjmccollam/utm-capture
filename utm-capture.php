<?php

/*
	Plugin Name: UTM Capture
	Plugin URI: https://github.com/rjmccollam/utm-capture
	Description: Capture UTM parameters from marketing campaigns and use them to pass along information to specific Gravity Forms fields.
	Version: 1.0
	Author: RJ McCollam
	Author URI: https://rjmccollam.com/
	License: GPLv2 or later
	Text Domain: utm_capture
*/

	function process_cookies() {
		if ( !is_admin() ) {

			// Get UTM parameters from URL
			$source = $_GET['utm_source'];
			$medium = $_GET['utm_medium'];
			$term = $_GET['utm_term'];
			$content = $_GET['utm_content'];
			$campaign = $_GET['utm_campaign'];

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
		if (!isset($_COOKIE['utm_source'])) {
			return false;
		}

		return $_COOKIE['utm_source'];
	}
	add_filter( 'gform_field_value_utm_source', 'populate_utm_source' );

	// Medium field
	function populate_utm_medium( $value ) {
		if (!isset($_COOKIE['utm_medium'])) {
			return false;
		}

		return $_COOKIE['utm_medium'];
	}
	add_filter( 'gform_field_value_utm_medium', 'populate_utm_medium' );

	// Term field
	function populate_utm_term( $value ) {
		if (!isset($_COOKIE['utm_term'])) {
			return false;
		}

		return $_COOKIE['utm_term'];
	}
	add_filter( 'gform_field_value_utm_term', 'populate_utm_term' );

	// Content field
	function populate_utm_content( $value ) {
		if (!isset($_COOKIE['utm_content'])) {
			return false;
		}

		return $_COOKIE['utm_content'];
	}
	add_filter( 'gform_field_value_utm_content', 'populate_utm_content' );

	// Campaign field
	function populate_utm_campaign( $value ) {
		if (!isset($_COOKIE['utm_campaign'])) {
			return false;
		}

		return $_COOKIE['utm_campaign'];
	}
	add_filter( 'gform_field_value_utm_campaign', 'populate_utm_campaign' );