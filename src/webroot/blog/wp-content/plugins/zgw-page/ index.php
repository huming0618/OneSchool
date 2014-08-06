<?php
/*
   Plugin Name: zgw_page
   Plugin URI: -
   Description: 页面内容可视化编辑
   Version: 1.0
   Author: HU QI MING
   Author URI: yesky93
   License: GPLv2 or later
*/
	include_once('hook_load_jqueryui.php');
	include_once('hook_load_backbone_script.php');
	include_once('hook_load_bootstrap_script.php');
    include_once('hook_load_plugin_script.php');
    
	include_once('hook_single_page.php');
	include_once('hook_channel_page.php');
	include_once('hook_general_page.php');
	
	include_once('reg-ajax-handler-cat-articles.php');
	include_once('reg-ajax-handler-change-theme.php');
    include_once('reg-ajax-handler-show-setting-panel.php');
    
?>