<?php
    add_action('init', 'reg_zgw_backbone_resource');

    
    function reg_zgw_backbone_resource(){
        
        //$folder = site_url().'/wp-content/plugins/zgw-setting/';
        $plugin_url = plugin_dir_url(__FILE__);
        
        wp_deregister_script( 'zgw-backbone-js' );
        wp_register_script('zgw-backbone-js', $plugin_url.'js/backbone.js');

        wp_deregister_script( 'zgw-underscore-js' );
        wp_register_script('zgw-underscore-js', $plugin_url.'js/underscore.js');
    }

    add_action('wp_enqueue_scripts', 'load_zgw_backbone_resource');
    add_action('admin_enqueue_scripts', 'load_zgw_backbone_resource');

    function load_zgw_backbone_resource()
    {
        wp_enqueue_script('zgw-underscore-js');  
        wp_enqueue_script('zgw-backbone-js');
    }

?>