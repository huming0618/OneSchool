<?php
	add_action('init', 'register_channel_page');
   	function register_channel_page() {
    	$labels = array(
       		'name' => __( '频道页面', 'zgw_page' ),
       		'singular_name' => __( '所有页面', 'zgw_page' ),
       		'add_new'  => __( '新建', 'zgw_page' ),
       		'add_new_item' => __( '添加频道页面', 'zgw_page' ),
       		'edit_item' => __( '编辑', 'zgw_page' ),
       		'new_item'  => __( '新建页面', 'zgw_page' ),
       		'view_item' => __( '预览页面', 'zgw_page' ),
       		'search_items' => __( '搜索页面', 'zgw_page' ),
       		'not_found' => __( '没有找到相关页面', 'zgw_page' ),
       		'not_found_in_trash' => __( '没有找到相关页面','zgw_page' ),
       		'parent_item_colon' => __( '父级', 'zgw_page'),
       		'menu_name' => __( '频道页面', 'zgw_page' ),
       	);
	   
     	$args = array(
       		'labels'  => $labels,
       		'hierarchical' => true,
       		'description' => __( '频道页面', 'zgw_page' ),
       		'supports'   => array( 'title'),//
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'menu_position' => 15,
			'capability_type' => 'post'
		);

		register_post_type( 'channel_page', $args );
	}

	//metabox for theme selection
	add_action('admin_menu', 'add_channel_page_meta_box');
		
	function add_channel_page_meta_box(){
		add_meta_box(
				'channel_page_meta_box_theme', 
				__('模版选择'), 
				'show_channel_page_meta_box_theme', 
				'channel_page', 
				'advanced',
				'high');
				
		add_meta_box(
				'channel_page_meta_box_setting', 
				__('内容编辑设置'), 
				'show_channel_page_meta_box_setting', 
				'channel_page', 
				'advanced',
				'high');
	}
	
	
	function  show_channel_page_meta_box_theme($post,$metabox){
		//get channel page themes in current theme folder
		$post_id = $post->ID;
		$theme_for = 'channel-page';
		$theme_option_name = 'zgw-page-theme';
		$theme_option_type = 'meta';
		
		$current_theme = get_post_meta($post_id, $theme_option_name, true);
		include_once('theme_picker.php');
		//echo '<script>alert("'.$post_id.'")</script>';
	
		$theme_picker = new zgw_theme_picker($theme_for,$current_theme,$theme_option_type,$theme_option_name,$post_id);
		$theme_picker->render();
	}


	function  show_channel_page_meta_box_setting($post,$metabox){
		//get channel page themes in current theme folder
		$plugin_url = plugin_dir_url(__FILE__);
		echo '<script src="'.$plugin_url.'js/theme_option_box.js"></script>';
		echo get_post_type();
	}
?>