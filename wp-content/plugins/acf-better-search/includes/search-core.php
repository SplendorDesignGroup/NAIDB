<?php

	class ACFBetterSearch {

		var $wpdb;
		var $fieldsTypes = array('text', 'textarea', 'wysiwyg');

		function __construct() {

			$this->setVars();
			$this->initFilters();

			if (is_admin()) {

				$admin = new ACFBetterSearchAdmin();
				$admin->fieldsTypes = $this->fieldsTypes;

			}

		}

		function setVars() {

			global $wpdb;

			$this->wpdb = $wpdb;

			if (get_option('acfbs_fields_types') !== false) {

				$this->fieldsTypes = get_option('acfbs_fields_types') ? get_option('acfbs_fields_types') : array();

			}

		}

		function initFilters() {

			add_filter('posts_search',  array(&$this, 'sqlWhere'),    10, 2); 
			add_filter('posts_join',    array(&$this, 'sqlJoin'),     10, 2);
			add_filter('posts_request', array(&$this, 'sqlDistinct'), 10, 2); 

		}

		function getExtendConditions($words) {

			$searchWords      = explode(' ', $words);
			$extendConditions = array();

			$parts = array();

			foreach ($searchWords as $word) {

				$parts[] = '(a.meta_value LIKE \'%' . $word . '%\')';

			}

			$extendConditions = (count($parts) > 1) ? '((' : '(';
			$extendConditions .= implode(' AND ', $parts);
			$extendConditions .= (count($parts) > 1) ? ')' : '';
			$extendConditions .= ' AND (b.meta_id = a.meta_id + 1) AND (c.post_name = b.meta_value)';
			$extendConditions .= ')';

			return $extendConditions;

		}

		function getDefaultConditions($words) {

			$searchWords       = explode(' ', $words);
			$defaultConditions = array();

			foreach ($searchWords as $word) {

				$parts = array();
				$parts[] = '(' . $this->wpdb->posts . '.post_title LIKE \'%' . $word . '%\')';
				$parts[] = '(' . $this->wpdb->posts . '.post_content LIKE \'%' . $word . '%\')';
				$parts[] = '(' . $this->wpdb->posts . '.post_excerpt LIKE \'%' . $word . '%\')';

				$defaultConditions[] = implode(' OR ', $parts);
			}

			return $defaultConditions;

		}

		function sqlWhere($where, &$query) {

			if (empty($query->query_vars['s']))
				return $where;

			$extendConditions  = $this->getExtendConditions($query->query_vars['s']);
			$defaultConditions = $this->getDefaultConditions($query->query_vars['s']);

			$where = 'AND ';
			$where .= '(';
			$where .= $extendConditions;
			$where .= ' OR ';
			$where .= (count($defaultConditions) > 1) ? '((' : '(';
			$where .= implode(' AND ', $defaultConditions);
			$where .= (count($defaultConditions) > 1) ? '))' : ')';
			$where .= ')';

			return $where;

		}

		function getFieldsConditions() {

			$parts = array();

			foreach ($this->fieldsTypes as $fieldType) {

				$parts[] = '(c.post_content LIKE \'%:"' . $fieldType. '"%\')';

			}

			$conditions = (count($parts) > 0) ? '(' : '';
			$conditions .= '(c.post_type = \'acf-field\')';
			$conditions .= (count($parts) > 0) ? ' AND ' : '';
			$conditions .= (count($parts) > 1) ? '(' : '';
			$conditions .= implode(' OR ', $parts);
			$conditions .= (count($parts) > 1) ? ')' : '';
			$conditions .= (count($parts) > 0) ? ')' : '';

			return $conditions;

		}

		function sqlJoin($join, &$query) {

			if (empty($query->query_vars['s']))
				return $join;

			$parts = array();
			$parts[] = 'LEFT JOIN ' . $this->wpdb->postmeta . ' AS a ON (a.post_id = ' . $this->wpdb->posts . '.ID)';
			$parts[] = 'LEFT JOIN ' . $this->wpdb->postmeta . ' AS b ON (b.post_id = ' . $this->wpdb->posts . '.ID)';
			$parts[] = 'LEFT JOIN ' . $this->wpdb->posts . ' AS c ON ' . $this->getFieldsConditions();

			$join .= implode(' ', $parts);

			return $join;

		}

		function sqlDistinct($sql, &$query) {

			if (empty($query->query_vars['s']))
				return $sql;

			$sql = str_replace('SELECT', 'SELECT DISTINCT', $sql);

			return $sql;

		}

	}