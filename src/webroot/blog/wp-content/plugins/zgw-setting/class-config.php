<?php
	class zgw_setting_config{

		function __construct(){

			$this->theme_folder = get_template_directory();
			$this->config_file = $this->theme_folder.DIRECTORY_SEPARATOR.'zgw-setting-config.json';
			$this->config = $this->read_config();
		}
		
		function _save(){
			file_put_contents($this->config_file, json_encode($this->config));
		}
		
		function read_config(){
			return json_decode(file_get_contents($this->config_file), true);
		}
		
		function change_theme($name, $theme){
			$this->config['current'][$name]['theme'] = $theme;
			$this->_save();
		}
		
		function get_current($name){
			$current = $this->config['current'];
			return $current[$name];
		}
		
		function get_theme_list($name){
			$themes = $this->config['themes'];
			return $themes[$name];
		}
		
		function get_all_wp_options(){
			$result = array();
			$current = $this->config['current'];
			foreach($current as $used_by=>$val){
				$theme = $val['theme'];
				include_once('class-options-reader.php');
				$theme_config_file = $this->theme_folder.DIRECTORY_SEPARATOR.$theme.'.options.json';
				if(file_exists($theme_config_file)){
					$options_reader = new options_reader($theme_config_file);
					array_push($result, $options_reader->get_wp_options($theme,$used_by));
				}
				
			}
			return $result;
		}
		
		function get_current_list_nocategory(){
			$result = array();
			$current = $this->config['current'];
			foreach($current as $key=>$val){
				if(strrpos($key,'category') !== 0){
					$result[$key] = $val;
				}
			}
			return $result;
		}
		
		function change_current($theme){
			
		}
	}
?>