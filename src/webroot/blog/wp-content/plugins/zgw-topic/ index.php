<?php
/*
   Plugin Name: Topic
   Plugin URI: -
   Description: 专题
   Version: 1.0
   Author: HU QI MING
   Author URI: yesky93
   License: GPLv2 or later
*/
	
	function display_html(){
		echo'This is your first meta box';
	}
	
	function reg_meta_box(){
		add_meta_box('my_first_meta_box', 'My First Meta Box', 'display_html', 'wp_topic', 'advanced', 'high');
	}
	
	
	add_action('admin_menu', 'reg_meta_box');
	
	add_action('init', 'register_topic');
   	function register_topic() {
    	$labels = array(
       		'name' => __( '专题', 'wp_topic' ),
       		'singular_name' => __( '专题', 'wp_topic' ),
       		'add_new'  => __( '新建', 'wp_topic' ),
       		'add_new_item' => __( '添加专题', 'wp_topic' ),
       		'edit_item' => __( '编辑', 'wp_topic' ),
       		'new_item'  => __( '新建专题', 'wp_topic' ),
       		'view_item' => __( '预览专题', 'wp_topic' ),
       		'search_items' => __( '搜索专题', 'wp_topic' ),
       		'not_found' => __( '没有找到相关专题', 'wp_topic' ),
       		'not_found_in_trash' => __( '没有找到相关专题','wp_topic' ),
       		'parent_item_colon' => __( '父级', 'wp_topic'),
       		'menu_name' => __( '专题', 'wp_topic' ),
       	);
	   
     	$args = array(
       		'labels'  => $labels,
       		'hierarchical' => true,
       		'description' => __( '专题', 'wp_topic' ),
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
			'capability_type' => 'post'
		);

		register_post_type( 'wp_topic', $args );
	}
?>