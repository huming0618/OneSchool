<?php
    add_action('init', 'reg_zgw_bootstrap_resource');

    
    function reg_zgw_bootstrap_resource(){
        
        //$folder = site_url().'/wp-content/plugins/zgw-setting/';
        $plugin_url = plugin_dir_url(__FILE__);
        
        wp_deregister_script( 'zgw-bootstrap-js' );
        wp_register_script('zgw-bootstrap-js', $plugin_url.'js/bootstrap.min.js');

        wp_register_script('zgw-respond-js', $plugin_url.'js/respond.min.js');
        wp_register_script('zgw-html5shiv-js', $plugin_url.'js/html5shiv.js');
        
        wp_deregister_style( 'zgw-bootstrap-css' );
        wp_register_style( 'zgw-bootstrap-css', $plugin_url.'css/bootstrap.min.css' );
    }

    add_action('wp_enqueue_scripts', 'load_zgw_bootstrap_resource');
    add_action('admin_enqueue_scripts', 'load_zgw_bootstrap_resource');

    function load_zgw_bootstrap_resource()
    {
        wp_enqueue_style('zgw-bootstrap-css');     
        wp_enqueue_script('zgw-bootstrap-js');
        
        $ie_ver = $_SERVER['HTTP_USER_AGENT'];
        if(strpos($ie_ver, "MSIE 6.0") || strpos($ie_ver, "MSIE 7.0") || strpos($ie_ver, "MSIE 8.0")){
            wp_enqueue_script('zgw-html5shiv-js');
            wp_enqueue_script('zgw-respond-js');    
            
        }
        
    }

?>