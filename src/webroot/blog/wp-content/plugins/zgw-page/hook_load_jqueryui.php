<?php
	add_action('init', 'reg_resource');

	
	function reg_resource(){
		$folder = site_url().'/wp-content/plugins/zgw-setting/';
	    wp_deregister_script( 'jquery-ui' );
	    wp_register_script('jquery-ui', $folder.'jquery-ui-1.10.4/ui/minified/jquery-ui.min.js');
	
	    wp_deregister_style( 'jquery-ui' );
	    wp_register_style( 'jquery-ui', $folder.'jquery-ui-1.10.4/themes/base/minified/jquery-ui.min.css' );
	}

	add_action('wp_enqueue_scripts', 'load_resource');
	add_action('admin_enqueue_scripts', 'load_resource');

	function load_resource()
	{     
	    wp_enqueue_script('jquery-ui');
		wp_enqueue_style('jquery-ui');
	}

?>