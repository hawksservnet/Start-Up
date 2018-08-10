<?php
/*
Plugin Name: Top Level Categories Fix 
Plugin URI: http://wordpressgogo.com/development/top-level-cats-fix.html
Description: This plugin modifies the url which includes subcategories and paginations when the Top Level Categories plugin is in use.
Author: Hiroaki Miyashita
Version: 0.2.3
Author URI: http://wordpressgogo.com/
*/

add_filter('parse_query', 'top_level_parse_query');
function top_level_parse_query($query) {

	if ( !is_array($query->query) )
		parse_str($query->query, $query->query);

	$qv = $query->query_vars;
	$cat = get_term_by('slug', $qv['name'], 'category', OBJECT, 'display');

	if ( $cat ) {
		$query->query_vars['category_name'] = $qv['category_name'].'/'.$qv['name'];
		$query->query['category_name'] = $qv['category_name'].'/'.$qv['name'];
		if ( isset($query->query['name']) ) unset($query->query['name']);
		if ( isset($query->query_vars['name']) ) unset($query->query_vars['name']);
		$query->is_single = false;
		$query->is_singular = false;
		$query->is_archive = true;
		$query->is_category = true;
	}
	
	if ( $qv['name'] == 'page' ) {
		if ( isset($qv['page']) ) {
			$qv['page'] = trim($qv['page'], '/');
			$qv['page'] = (int) $qv['page'];
			$qv['page'] = abs($qv['page']);
		}
		$query->query['paged'] = $qv['page'];
		$query->query_vars['paged'] = $qv['page'];
		if ( isset($query->query['name']) ) unset($query->query['name']);
		if ( isset($query->query['page']) ) unset($query->query['page']);
		if ( isset($query->query_vars['name']) ) unset($query->query_vars['name']);
		if ( isset($query->query_vars['page']) ) unset($query->query_vars['page']);
		$query->is_single = false;
		$query->is_singular = false;
		$query->is_archive = true;
		$query->is_category = true;
	}
	
	if ( $qv['p'] && preg_match('/\/page$/', $qv['category_name']) ) {
		$query->query['paged'] = $qv['p'];
		$query->query['category_name'] = preg_replace('/\/page$/', '', $qv['category_name']);
		$query->query_vars['paged'] = $qv['p'];
		$query->query_vars['category_name'] = $query->query['category_name'];
		if ( isset($query->query['p']) ) unset($query->query['p']);
		if ( isset($query->query_vars['p']) ) unset($query->query_vars['p']);
		$query->is_single = false;
		$query->is_singular = false;
		$query->is_archive = true;
		$query->is_category = true;
	}
	
	/* In case of using the Language Switcher plugin, use the following section. */
	/* Language Switcher Start
	$langSwitchGetVar = get_option('langswitch_get_var');
	if ( preg_match("/$langSwitchGetVar/", $query->query['category_name']) ) {
		$query->query_vars['category_name'] = preg_replace("/\/$langSwitchGetVar(\/[a-z]+)?/",'',$query->query['category_name']);
		$query->query['category_name'] = preg_replace("/\/$langSwitchGetVar(\/[a-z]+)?/",'',$query->query['category_name']);
		if ( isset($query->query['name']) ) unset($query->query['name']);
		if ( isset($query->query_vars['name']) ) unset($query->query_vars['name']);
		$query->is_single = false;
		$query->is_singular = false;
		$query->is_archive = true;
		$query->is_category = true;
	}
	Language Switcher End */
	
	return $query;
}
?>