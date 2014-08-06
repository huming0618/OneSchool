<?php
    add_action('wp_ajax_zgw_show_setting_panel','show_setting_panel_ajax_handler');
    function show_setting_panel_ajax_handler(){
        
        $theme  = $_POST['theme'];

        //$theme_for = $_POST['zgw_page_theme_for'];
        
        include_once ('class-setting-panel.php');
        $theme_folder = get_template_directory();
        $theme_config_file = $theme_folder . DIRECTORY_SEPARATOR . $theme . '.options.json';
        if(!file_exists($theme_config_file)){
            header("HTTP/1.0 404 Not Found");
            die();
        }
        $panel = new zgw_setting_panel($theme_config_file);
        $panel -> render();
        die();
    }
    
?>