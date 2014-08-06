<?php
	include_once('class-config.php');
	include_once(ABSPATH.'wp-includes/theme.php');
	
	class zgw_theme_picker{
		function __construct($themes_for,$current='',$option_type='',$option_name='',$post_id=''){
			$this->theme_key = $themes_for;
			$this->current = $current;
			$this->option_type = $option_type;
			$this->option_name = $option_name;
			$this->post_id = $post_id;
			$config = new zgw_page_themes_config();
			
			$this->themes = $config->get_theme_list($this->theme_key);
			
		}

		function render(){
			#sort by current useds
			
			$theme_url = get_template_directory_uri();
			if(count($this->themes) == 0){
				echo __('无模版可以选择');
				return;
			}
?>
	<div id="zgw-page-theme-picker-form">
		<input type="hidden" id="zgw_page_theme" name="zgw_page_theme" value="<?php echo $this->current?>"/>
		<input type="hidden" value="<?php echo $this->theme_key?>" name="zgw_page_theme_for"/>
		<input type="hidden" name="zgw_page_theme_option_type" value="<?php echo $this->option_type?>"/>
		<input type="hidden" name="zgw_page_theme_option_name" value="<?php echo $this->option_name?>"/>
		<input type="hidden" name="zgw_page_theme_post_id" value="<?php echo $this->post_id?>"/>
		
		<ul id="zgw-page-theme-picker" class="grid">
<?php
			foreach($this->themes as $item){
				
				$img = $theme_url.'/'.$item['screenshot'];//#todo :use template url
?>
			<li class="theme-box box240">
				<img alt="" class="box-image" src="<?php echo $img?>"/>
<?php
			if($this->current == $item['theme']){
?>
				<div class="bottom-banner active" data-theme="<?php echo $item['theme'] ?>"  data-theme-name="<?php echo $item['display'] ?>">
					<label>当前模版 - <?php echo $item['display'] ?></label>
				</div>
<?php
			}
			else{
?>
				<div class="bottom-banner bg-graywhite" data-theme="<?php echo $item['theme'] ?>" data-theme-name="<?php echo $item['display'] ?>">
					<label><?php echo $item['display'] ?></label>
					<div class="action">
						<a href="#" data-theme="<?php echo $item['theme'] ?>"  data-theme-name="<?php echo $item['display'] ?>" class="button button-primary" style="z-index: 9999">启用</a>
					</div>
				</div>
<?php
			}
?>
			</li>
<?php
			}
?>
		</ul>
	</div>
<?php
		}
	}
	
?>
<script>
	(function(){
		var $ = jQuery;
		$(document).ready(function(){
	
			window.theme_picker = new window.themePicker($('#zgw-page-theme-picker-form'));
	
		})
	}())

	
</script>


