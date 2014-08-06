<?php
	/*$config_slug is from slug of menu
	 * 
	 */
	include_once('class-config.php');
	include_once('class-options-reader.php');
	
	$config = new zgw_setting_config();
	
	
	$current = $config->get_current($config_slug);
	$theme = $current['theme'];
	$display = $current['display'];
	$theme_folder = get_template_directory();
	
	$option_reader = new options_reader($theme_folder.DIRECTORY_SEPARATOR.$theme.'.options.json');
	
?>

	<div class="wrap">
		<h2>
			设置 - <?php echo $display?>
			<a class="add-new-h2" href="#" id="zge_change_theme">更换模版</a>
			<script>
				var $ = jQuery;
				$(window).load(function(){
					$('#zge_change_theme').click(function(){
						var $btn = $(this);
						var $panel = $('#zgw_change_theme_panel');
						var $option_panel = $('#zgw-setting-tabs');
						$panel.slideToggle(200,function(){
							if($panel.is(':visible')){
								$btn.text('X 取消更换');
								$btn.css('background-color','#A21B25');
								$btn.css('color','white');
								console.log($option_panel);
								$option_panel.hide();
							}
							else{
								$btn.text('更换模版');
								$btn.css('background-color','');
								$btn.css('color','');
								$option_panel.show();
							}
						});
						/*$panel.toggle(
							function(){$btn.text('X 取消更换 更换模版')},
							function(){$btn.text('X 取消更换')}
						);*/
					})
				})
			</script>
		</h2>
		<div class="tablenav top" id="zgw_change_theme_panel" style="display:none">
			<form id="zgw_form_change_theme" action="<?php echo(site_url().'/wp-content/plugins/zgw-setting/change_theme.php') ?>">
				<label>更换模版 ： </label>
				<input type="hidden" name="slug" value="<?php echo $config_slug ?>"/>
				<select name="theme">
						<option selected="selected" value="-1">--选择模版--</option>
						<?php 
							$themes = $config->get_theme_list($config_slug);
							foreach($themes as $item){
						?>
							<option value="<?php echo $item['theme']?>"><?php echo $item['display']?></option>
						<?php
							}
						?>
				</select>&nbsp;
				<input id="zgw_apply_theme" type="submit" value="应用" class="button action" id="doaction" name=""/>
			</form>
			<script>
				var $ = jQuery;
				$('#zgw_form_change_theme').on('submit',function(e){
					e.preventDefault();
					var $form = $( this )
					var url = $form.attr('action')
					
					var slug = $form.find( "input[name='slug']" ).val(),
						theme = $form.find( "select[name='theme']" ).val();
					if(theme == -1){
						alert('请选择一个模版后进行更换');
						return false;
					}
					var post = $.post(url,{'slug':slug,'theme':theme});
					post.done(function(result){
						if(result=="1"){
							window.location.reload();
						}
						else{
							alert('模版更换出现错误 - '+result)
						}
					})
					 
				});
			</script>
		</div>
		<!--<div class="tablenav top">
			
		</div>-->
		<?php //echo $theme_file?>
		<div id="zgw-setting-tabs">
			<ul>
		<?php
				//create tabs

				$raw_tabs = $option_reader->get_tabs();
				$tabs_options = $option_reader->get_options_tree($theme,$config_slug);
				$tab_form_html_cache = array();
				//start tabs loop
				
				foreach($tabs_options as $tab_index=>$tab){

					$div_html = '';
					$i=0;
					/*option forms*/
				
					foreach($tab as $group=>$options){
						//start form

						
						$group_title = "设置";
						if(isset($raw_tabs[$tab_index]['groups'])){
							$group_title = $raw_tabs[$tab_index]['groups'][$group];
						}
						$div_html = $div_html.'<h3>'.$group_title.'</h3>';
						$table_array = array(
								'<div><table class="form-table">',
									'<tr valign="top">',
										'<td>'
						);
						
						$table = implode('',$table_array);
						$div_html = $div_html.$table;
						
						$div_html = $div_html.'<form method="post" action="options.php">';
						foreach($options as $option){
								//setting functions
							ob_start();
							$wp_option = $option['wp-option'];
							settings_fields($wp_option);
							$settings_fields_buffer = ob_get_contents();
							ob_end_clean();
							
							ob_start();
							do_settings_sections($wp_option);
							$do_settings_sections_buffer = ob_get_contents();
							ob_end_clean();
							
							
							$div_html = $div_html.$settings_fields_buffer;
							$div_html = $div_html.$do_settings_sections_buffer;
						
							$option_Val = get_option($wp_option);
							//fields table
							ob_start();
							include "option-editor/editor-image-link.php";
							$editor_html = ob_get_contents();
							ob_end_clean();
							$div_html = $div_html.$editor_html;
							//$div_html = $div_html.'<label class="width-60">'.$option['display'].'</label><input type="text" name="'.$option['wp-option'].'" value="'.$option_Val.'" /><hr><div class="break"></div>';
						}
						$div_html = $div_html.'</form></td></tr><tr><td>';
						ob_start();
						submit_button();
						$button_html = ob_get_contents();
						ob_end_clean();
						$button_html = str_replace('id="submit"','id="submit-'.$option['wp-option'].'"',$button_html);
						$div_html = $div_html.$button_html;
						$div_html = $div_html.'</td></tr></table></div>';
					}

					$tab_form_html_cache[$tab_index] = $div_html;
					//$tab['options_form_html'] = $div_html;
		?>
					<li>
						<a href="#zgw-setting-tab-<?php echo $tab_index?>">
							<?php echo $raw_tabs[$tab_index]['display']; ?>
						</a>
					</li>
		<?php
				
				}//end tab each
		?>
		</ul>
		<?php
				
				//show forms in div 
				foreach($tabs_options as $tab_index=>$tab){
					echo '<div id="zgw-setting-tab-'.$tab_index.'">';
						echo $tab_form_html_cache[$tab_index];
					echo '</div>';
		?>
					<script>
			
						$(window).load(function(){
				
						$('#zgw-setting-tab-<?php echo $tab_index?>').accordion();
				
						});
			
					</script>
		<?php
				}
		?>
		</div>
	</div>
	<script>
		$(window).load(function(){
			$("#zgw-setting-tabs").tabs();
			
			$("form[action='options.php']").submit(function(e){
				e.preventDefault();
				var $form = $(this);
				var data = $form.serialize();
				
				var url = $form.attr('action')

				var post = $.post(url,data);
				post.done(function(result){
					alert('设置保存成功');
					//console.log(result);
				}).fail(function(){
					alert('设置保存失败');
				})
				
			});
		})
	</script>
