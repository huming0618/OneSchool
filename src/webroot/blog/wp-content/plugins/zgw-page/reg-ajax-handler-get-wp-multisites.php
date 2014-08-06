<?php
    add_action('wp_ajax_zgw_get_wp_sites','get_wp_sites_ajax_handler');
    function show_setting_panel_ajax_handler(){
        $result = wp_get_sites();
        header('Content-Type: application/json');
        echo json_encode($result);
        die();
    }
    
?>