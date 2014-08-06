<?php
	add_action('init', 'reg_plugin_resource');

	
	function reg_plugin_resource(){
		$folder = site_url().'/wp-content/plugins/zgw-setting/';
	   // wp_deregister_script( 'my-js' );
	   // wp_register_script('my-js', $folder.'js/ui/minified/jquery-ui.min.js');
	
	    wp_deregister_style( 'my-css' );
	    wp_register_style( 'my-css', $folder.'css/plugin.css' );
	}

	add_action('wp_enqueue_scripts', 'load_plugin_resource');
	add_action('admin_enqueue_scripts', 'load_plugin_resource');

	function load_plugin_resource()
	{     
	    //wp_enqueue_script('my-js');
		wp_enqueue_style('my-css');
	}

?>