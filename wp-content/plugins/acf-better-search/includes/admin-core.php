<?php

	class ACFBetterSearchAdmin {

		var $pluginUrl;

		function __construct() {

			$this->setVars();
			$this->initFilters();
			$this->initActions();

		}

		function setVars() {

			$pluginBasename  = plugin_basename(__FILE__);
			$this->pluginUrl = substr($pluginBasename, 0, strpos($pluginBasename, '/'));

		}

		function initFilters() {

			add_filter('admin_enqueue_scripts', array(&$this, 'registerStyles')); 

		}

		function initActions() {

			add_action('admin_menu', array(&$this, 'addAdminPage'));
			add_action('current_screen', array(&$this, 'getSavedOptions')); 

		}

		function addAdminPage() {

			add_submenu_page(
				'options-general.php',
				'ACF: Better Search',
				'ACF: Better Search',
				'edit_posts',
				'acfbs_admin_page',
				array(&$this, 'initAdminPage')
			);

		}

		function initAdminPage() {

			require_once 'admin-page.php';

		}

		function getSavedOptions($current_screen) {

			if (($current_screen->base == 'settings_page_acfbs_admin_page') && isset($_POST['acfbs_save'])) {

				$this->fieldsTypes = isset($_POST['acfbs_fields_types']) ? $_POST['acfbs_fields_types'] : array();
				$this->saveOptions();

			}

		}

		function saveOptions() {

			if (get_option('acfbs_fields_types') !== false) {

				update_option('acfbs_fields_types', $this->fieldsTypes);

			} else {

				add_option('acfbs_fields_types', $this->fieldsTypes);

			}

		}

		function registerStyles() {

			wp_register_style('acfbs_styles', plugins_url() . '/' . $this->pluginUrl . '/assets/css/admin.css');
			wp_enqueue_style('acfbs_styles');

		}

	}