<?php
	class zgw_page_themes_config{

		function __construct(){

			$this->theme_folder = get_template_directory();
			$this->config_file = $this->theme_folder.DIRECTORY_SEPARATOR.'zgw-page-config.json';
			if(!file_exists($this->config_file)){
				echo '<script>alert("页面内容编辑可视化插件  : 由于当前主题可能不是手动可配置内容的主题，请暂时停用本插件 插件名称 － zgw_page")</script>';
				die();
			}
			$this->config = $this->read_config();
		}

		function read_config(){
			
			return json_decode(file_get_contents($this->config_file), true);
		}

		
		function get_theme_list($name){
			$themes = $this->config['themes'];
	
			return $themes[$name];
		}
		
		function get_general_page_theme_options(){
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
		
		
		function change_current($theme){
			
		}
	}
?>