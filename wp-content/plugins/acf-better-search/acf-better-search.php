<?php 

	/*
		Plugin Name: ACF: Better Search
		Description: Adds to default WordPress search engine the ability to search by content from selected fields of Advanced Custom Fields plugin.
		Version: 1.0.0
		Author: Mateusz Gbiorczyk
		Author URI: http://crafton.pl/
	*/

	include 'includes/search-core.php';
	include 'includes/admin-core.php';


	add_action('wp_loaded', 'initACFBetterSearchPlugin');

	function initACFBetterSearchPlugin() {

		new ACFBetterSearch();

	}