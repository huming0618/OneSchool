<?php
	include_once('common.php');
	include_once('class-config.php');
	
	function register_wp_setting() {
		$config = new zgw_setting_config();

		$wp_theme_options = $config->get_all_wp_options();
		
		foreach($wp_theme_options as $index=>$wp_options){
		
			foreach($wp_options as $wp_option){
				add_option( $wp_option['name'], '');
				register_setting($wp_option['name'],$wp_option['name']);
			}
			
		}

	} 
	add_action( 'admin_init', 'register_wp_setting' );

	function show_category_menu(){
	    add_menu_page( '目录管理', 
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
			add_submenu_page( 'category_settings', 
									$category->name, 
									$category->name, 
									'manage_options', 
									$category->slug, //slug
									'load_view' //callback
								);
		}
		remove_submenu_page( 'category_settings', 'category_settings' );
	}

	function show_site_menu(){
		add_menu_page( '页面管理', 
		    				'页面管理', 
		    				'manage_options', 
		    				'zgw_site_settings', //slug
		    				'load_view', //function for display
		    				'dashicons-admin-home',//,
		    				3 );
							
		//generate menus for settings
		
		$config = new zgw_setting_config();
		$current_nocategory = $config->get_current_list_nocategory();

		
		foreach($current_nocategory as $part=>$item){
			$display = $item['display'];
			$theme = $item['theme'];
			add_submenu_page( 'zgw_site_settings', 
										$display, 
										$display, 
										'manage_options', 
										$part, //slug
										'load_view' //callback
									);
		}
		remove_submenu_page( 'zgw_site_settings', 'zgw_site_settings' );
		
	}
	
	function load_view() {
        $page = current_filter();
		$config_slug = substr($page, strrpos($page, 'page_')+5);
		include('show_setting.php');
    }
	
	function show_menu(){
		show_site_menu();
		show_category_menu();
		
	}
	
	
	add_action( 'admin_menu', 'show_menu' );
?>