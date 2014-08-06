<?php
	include_once('class-options-reader.php');
	include_once(ABSPATH.'wp-includes/theme.php');
	
	class zgw_setting_panel{
		function __construct($config_file){
			$this->option_reader = new options_reader($config_file);
		}
		
		function render(){
				$raw_tabs = $this->option_reader->get_tabs();
      
				$tabs_options = $this->option_reader->get_options_tree($theme,$for_page);
				$tab_form_html_cache = array();
?>

		<ul>
<?php	
		foreach($tabs_options as $tab_index=>$tab){
					//tabs
?>
			<li>
				<a href="#zgw-setting-tab-<?php echo $tab_index?>">
					<?php echo $raw_tabs[$tab_index]['display']; ?>
				</a>
			</li>
		
<?php
					//option divs
		}
?>
		</ul>
<?php
		foreach($tabs_options as $tab_index=>$tab){
					//tabs
?>

		<div id="zgw-setting-tab-<?php echo $tab_index?>">
<?php
			foreach($tab as $group=>$options){
				//group title
				$group_title = "设置";
				if(isset($raw_tabs[$tab_index]['groups'])){
					$group_title = $raw_tabs[$tab_index]['groups'][$group];
				}
?>
			<h3><?php echo $group_title?></h3>	
			<div style="height:300px;">
				<table class="form-table">
					<tr valign="top">
						<td>
							
<?php
				foreach($options as $option){
					$wp_option = $option['wp-option'];
?>
                    <form method="post" action="options.php" data-type="image-link" data-role="zgw-setting-form">
<?php
					settings_fields($wp_option);
					do_settings_sections($wp_option);
					$option_Val = get_option($wp_option);

					include('editor/image-link.php');
?>
					</form>
<?php

				}
				submit_button();
?>	
							
						</td>
					</tr>
				</table>
			</div>
<?php
			}
?>
		</div>

<?php
		}

	}
}
	
	
?>
	