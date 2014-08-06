<?php
	add_action('init', 'reg_plugin_resource');

	
	function reg_plugin_resource(){
		
		//$folder = site_url().'/wp-content/plugins/zgw-setting/';
		$plugin_url = plugin_dir_url(__FILE__);
		
	   	wp_deregister_script( 'my-js' );
	   	wp_register_script('my-js', $plugin_url.'js/plugin.min.js');

		//wp_deregister_script( 'theme-option-box' );
	   //	wp_register_script('theme-option-box-js', $plugin_url.'js/theme_option_box.js');
		
	    wp_deregister_style( 'my-css' );
	    wp_register_style( 'my-css', $plugin_url.'css/plugin.min.css' );

	}

	add_action('wp_enqueue_scripts', 'load_plugin_resource');
	add_action('admin_enqueue_scripts', 'load_plugin_resource');

	function load_plugin_resource()
	{
	    wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
	    wp_enqueue_script('my-js');
		wp_enqueue_style('my-css');
	}

?>