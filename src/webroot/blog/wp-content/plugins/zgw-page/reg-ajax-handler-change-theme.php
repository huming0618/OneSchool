<?php
	add_action('wp_ajax_zgw_change_theme','zgw_change_theme_ajax_handler');
	add_action('wp_ajax_nopriv_zgw_change_theme','zgw_change_theme_ajax_handler');
	function zgw_change_theme_ajax_handler(){
		
		$theme  = $_POST['zgw_page_theme_active'];
		$option_type = $_POST['zgw_page_theme_option_type'];
		$option_name = $_POST['zgw_page_theme_option_name'];
		
		//$theme_for = $_POST['zgw_page_theme_for'];
		
		if($option_type == 'meta'){
			$post_id = $_POST['zgw_page_theme_post_id'];
			update_post_meta($post_id,$option_name,$theme);
		}
		else if($option_type == 'wp_option'){
			update_option($option_name,$theme);
		}
		echo "1";
		die();
	}
	
?>