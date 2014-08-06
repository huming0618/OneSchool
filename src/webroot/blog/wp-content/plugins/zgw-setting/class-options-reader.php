<?php
	class options_reader{

		
		function __construct($theme_config){
			$this->theme_config = $theme_config;
			$this->config = $this->read_config();
		}
		
		function read_config(){
			return json_decode(file_get_contents($this->theme_config), true);
		}
		
		public function get_raw_options(){
			return $this->config['options'];
		}
		
		public function get_wp_options($theme,$used_by){
			$result = array();
			$options =  $this->config['options'];
			foreach($options as $option){
				if($option['type'] === 'theme'){
					//try to get from wp_option
					$option_theme_file = get_option($option['name']);
					if(!empty($option_theme_file)){
						$option_theme_config_file = $option_theme_file.'.options.json';
						if(file_exists($option_theme_config_file)){
							$reader = new options_reader($option_theme_config_file);
							$sub_results = $reader->get_wp_options($option_theme_file,$used_by);
							array_push($result, $sub_results);
						}
					}
				}
				array_push($result,
					array(
						'group'=>str_replace('.','_',$theme.'-'.$used_by),
						'name'=>str_replace('.','_',$theme.'-'.$used_by.'-'.$option['name']))
				);
			}
			return $result;
		}
		
		public function get_tabs(){
			return $this->config['options-tabs'];
		}
		
		/*
		 * output tab->group->option tree with theme and slug 
		 */
		public function get_options_tree($theme,$used_by){
			$options = $this->config['options'];
			
			$tabs = array();
			//no need sorting, since options is sorted in json file
			
			//output formatted
			foreach($options as $option){
				if(!isset($option['tab'])){
					$option['tab'] = "-1";
				}
				if(!isset($option['group'])){
					$option['group'] = "-1";
				}
				if(!isset($option['display'])){
					$option['display'] = "设置";
				}
				
				$option['wp-option-group'] = str_replace('.','_',$theme.'-'.$used_by);
				$option['wp-option'] = str_replace('.','_',$theme.'-'.$used_by.'-'.$option['name']);
				
				$tab_index = $option['tab'];
				$group_index = $option['group'];
				if(!isset($tabs[$tab_index])){
					$tabs[$tab_index] = array();
				}
				if(!isset($tabs[$tab_index][$group_index])){
					$tabs[$tab_index][$group_index] = array();
				}
				array_push($tabs[$tab_index][$group_index],$option);
			}
	
			return $tabs;
		}
	}
?>