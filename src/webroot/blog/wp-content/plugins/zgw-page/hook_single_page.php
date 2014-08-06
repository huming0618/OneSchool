<?php
	
	function zgw_page_display_html(){
		//get channel page themes in current theme folder
		echo'This is your first meta box';
	}
	
	add_action('admin_menu', 'add_single_page_meta_box');
		
	function add_single_page_meta_box(){
		add_meta_box(
			'single_page_meta_box', 
			__('模版选择'), 
			'zgw_page_display_html', 
			'page', 
			'advanced', 
			'high');
	}
	
	function change_page_menu_label() {
		global $menu;   
		global $submenu;    
		$menu[20][0] = '单篇页面';    
		//$submenu['edit.php?post_type=page'][5][0] = 'Contacts';    
		//$submenu['edit.php?post_type=page'][10][0] = 'Add Contacts';    
	 	echo '';
	}
	
	function change_page_label() {
		global $wp_post_types;        
		$labels = &$wp_post_types['page']->labels;        
		$labels->name = '单篇页面';        
		$labels->singular_name = '单篇页面';        
		$labels->add_new = '新建单页';        
		$labels->add_new_item = '新建单页';        
		$labels->edit_item = '编辑单页';        
		$labels->new_item = '单页面';        
		$labels->view_item = '查看单页';        
		$labels->search_items = '搜索单页';        
		$labels->not_found = '没有找到单篇页面';        
		$labels->not_found_in_trash = '没有在回收站找到单篇页面';    
	}    
	add_action( 'init', 'change_page_label' );    
	add_action( 'admin_menu', 'change_page_menu_label' );
?>