<?php
/*
   Plugin Name: old_zgw_plugin_setting
   Plugin URI: -
   Description: 站点设置
   Version: 1.0
   Author: HU QI MING
   Author URI: yesky93
   License: GPLv2 or later
*/
	function zgw_setting($option, $default){
		$prefix = 'zgw_plugin_setting_';
		return get_option( $prefix.$option, $default );
	}
	
	add_action( 'admin_menu', 'register_my_custom_menu_page' );
	
	
	function add_front_page_menu(){
		$option = 'zgw_frontpage_setting';
		
	    add_menu_page( '首页设置', 
	    				'首页设置', 
	    				'manage_options', 
	    				'front_page_settings', //slug
	    				'front_page_settings', //function for display
	    				'dashicons-admin-home',//,
	    				3 );
		$front_theme = zgw_setting('frontpage_theme','');
		$theme_dir = get_template_directory();

		$front_theme_options_file = empty($front_theme) ? 
			'front-page-options.php' : 'front-page-'.$front_theme.'-options.php';
		$front_theme_options_file = $theme_dir . DIRECTORY_SEPARATOR .$front_theme_options_file;
		
		if(file_exists($front_theme_options_file)){
			$submenu_settings = include( $front_theme_options_file);
			$i=0;
			
			foreach($submenu_settings['submenus'] as $submenu){
				$slug = $i===0? 'front_page_settings':$submenu['name'];
				$option_group = $submenu['option_group'];
				$options = $submenu['options'];
				$callback = $submenu['option_callback'];
				if(isset($options)){
					foreach($options as $option){
						register_setting($option_group , $option );
					}
				}
				
				
				add_submenu_page( 'front_page_settings', 
									$submenu['display'], 
									$submenu['display'], 
									'manage_options', 
									$slug, //slug
									$callback //callback
								);
			}
			//print_r($frontpage_submenu);
		}
	}

	function add_category_page_menu(){
	    add_menu_page( '目录设置', 
	    				'目录设置', 
	    				'manage_options', 
	    				'category_settings', //slug
	    				'category_settings', //function for display
	    				'dashicons-screenoptions',//,
	    				4 );
						 
		$args = array(
		  'orderby' => 'name',
		  'parent' => 0
		  );
		$categories = get_categories( $args );
		$seq = 3;
		$i=0;
		foreach ( $categories as $category ) {
			$slug = $i===0? 'category_settings':$category->slug;
			add_submenu_page( 'category_settings', 
									$category->name, 
									$category->name, 
									'manage_options', 
									$slug, //slug
									'' //callback
								);
		}
	}
	
	function register_my_custom_menu_page(){
		//front(home) page
		add_front_page_menu();
		
		//categories
		add_category_page_menu();

	}

	function front_page_settings(){


	}
	
?>