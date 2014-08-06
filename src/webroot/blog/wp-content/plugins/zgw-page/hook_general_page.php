<?php
	

	
	//register options
	add_action( 'admin_init', 'reg_general_page_options' );
	function reg_general_page_options(){
		include_once('class-options-reader.php');
		$theme_folder = get_template_directory();
		//theme-option
		$options = array(
			'zgw-page-home-theme',
			'zgw-page-category-theme',
			'zgw-page-post-theme'
		);
		
		foreach($options as $option){
			add_option( $option, '');
			register_setting($option,$option);
			$theme_for = $option;
			//theme setting options
			$current_theme = get_option($option,'');
			if(!empty($current_theme)){
				$theme_config_file = $theme_folder.DIRECTORY_SEPARATOR.$current_theme.'.options.json';
				
				if(file_exists($theme_config_file)){
					$reader = new options_reader($theme_config_file);
					$setting_options = $reader->get_wp_options($current_theme,$theme_for);
					foreach($setting_options as $setting_option){
						add_option( $setting_option, '');
						register_setting($setting_option,$setting_option);
					}
				}
				
			}
			
		}
	
	}
					

	//add menus
	function show_general_page_menu(){
		add_menu_page( '通用页面', 
		    				'通用页面', 
		    				'manage_options', 
		    				'general_page', //slug
		    				'', //function for display
		    				'dashicons-admin-home',//,
		    				21 );
							
		add_submenu_page( 'general_page', 
										'首页', 
										'首页', 
										'manage_options', 
										'general-front-page', //slug
										'general_page_load_view' //callback
									);

		add_submenu_page( 'general_page', 
										'目录页', 
										'目录页', 
										'manage_options', 
										'general-category-page', //slug
										'general_page_load_view' //callback
									);
									
		add_submenu_page( 'general_page', 
										'文章页', 
										'文章页', 
										'manage_options', 
										'general-post-page', //slug
										'general_page_load_view' //callback
									);
									
		add_submenu_page( 'general_page', 
										'相册页', 
										'相册页', 
										'manage_options', 
										'general-gallery-page', //slug
										'general_page_load_view' //callback
									);
									
		add_submenu_page( 'general_page', 
										'视频页', 
										'视频页', 
										'manage_options', 
										'general-video-page', //slug
										'general_page_load_view' //callback
									);	
																																				
		remove_submenu_page( 'general_page', 'general_page' );
		
	}
	
	function general_page_load_view() {
        $page = current_filter();
		$for_page = substr($page, strrpos($page, 'page_')+5);
		$theme_option_key = '';
		if($for_page =='general-front-page' ){
			$theme_option_key = 'zgw-page-home-theme';
		}
		else if($for_page =='general-post-page' ){
			$theme_option_key = 'zgw-page-post-theme';
		}
		else if($for_page =='general-category-page' ){
			$theme_option_key = 'zgw-page-category-theme';
		}
		$theme_folder = get_template_directory();
		$current_theme = get_option($theme_option_key,'');
		
		//include_once('theme_picker.php');
		//echo '<script>alert("'.$post_id.'")</script>';
	
		//$theme_picker = new zgw_theme_picker($for_page,$current_theme,'wp-option',$theme_option_key);
		//$theme_picker->render();
		
		
		include('show_generalpage_settings.php');
    }
	
	
	
	add_action( 'admin_menu', 'show_general_page_menu' );
?>