<?php
/*
+----------------------------------------------------------------+
|																							|
|	WordPress 2.7 Plugin: WP-PostViews 1.50	 								|
|	Copyright (c) 2009 Lester "GaMerZ" Chan									|
|																							|
|	File Written By:																	|
|	- Lester "GaMerZ" Chan															|
|	- http://lesterchan.net															|
|																							|
|	File Information:																	|
|	- Post Views Options Page														|
|	- wp-content/plugins/wp-postviews/postviews-options.php			|
|																							|
+----------------------------------------------------------------+
*/


### Variables Variables Variables
$base_name = plugin_basename('wp-postviews/postviews-options.php');
$base_page = 'admin.php?page='.$base_name;
$id = intval($_GET['id']);
$mode = trim($_GET['mode']);
$views_settings = array('views_options', 'widget_views_most_viewed', 'widget_views');
$views_postmetas = array('views');


### Form Processing
// Update Options
if(!empty($_POST['Submit'])) {
	$views_options = array();
	$views_options['count'] = intval($_POST['views_count']);
	$views_options['exclude_bots'] = intval($_POST['views_exclude_bots']);
	$views_options['display_home'] = intval($_POST['views_display_home']);
	$views_options['display_single'] = intval($_POST['views_display_single']);
	$views_options['display_page'] = intval($_POST['views_display_page']);
	$views_options['display_archive'] = intval($_POST['views_display_archive']);
	$views_options['display_search'] = intval($_POST['views_display_search']);
	$views_options['display_other'] = intval($_POST['views_display_other']);
	$views_options['template'] =  trim($_POST['views_template_template']);
	$views_options['most_viewed_template'] =  trim($_POST['views_template_most_viewed']);
	$update_views_queries = array();
	$update_views_text = array();
	$update_views_queries[] = update_option('views_options', $views_options);
	$update_views_text[] = __('文章浏览统计设置', 'wp-postviews');
	$i=0;
	$text = '';
	foreach($update_views_queries as $update_views_query) {
		if($update_views_query) {
			$text .= '<font color="green">'.$update_views_text[$i].' '.__('已更新', 'wp-postviews').'</font><br />';
		}
		$i++;
	}
	if(empty($text)) {
		$text = '<font color="red">'.__('文章浏览统计设置无需更新', 'wp-postviews').'</font>';
	}
}
// Decide What To Do
if(!empty($_POST['do'])) {
	//  Uninstall WP-PostViews
	switch($_POST['do']) {		
		case __('卸载WP-PostViews', 'wp-postviews') :
			if(trim($_POST['uninstall_views_yes']) == 'yes') {
				echo '<div id="message" class="updated fade">';
				echo '<p>';
				foreach($views_settings as $setting) {
					$delete_setting = delete_option($setting);
					if($delete_setting) {
						echo '<font color="green">';
						printf(__('设置键 \'%s\' 已删除。', 'wp-postviews'), "<strong><em>{$setting}</em></strong>");
						echo '</font><br />';
					} else {
						echo '<font color="red">';
						printf(__('删除设置键 \'%s\'出错。', 'wp-postviews'), "<strong><em>{$setting}</em></strong>");
						echo '</font><br />';
					}
				}
				echo '</p>';
				echo '<p>';
				foreach($views_postmetas as $postmeta) {
					$remove_postmeta = $wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key = '$postmeta'");
					if($remove_postmeta) {
						echo '<font color="green">';
						printf(__('文章标签键 \'%s\' 已删除。', 'wp-postviews'), "<strong><em>{$postmeta}</em></strong>");
						echo '</font><br />';
					} else {
						echo '<font color="red">';
						printf(__('删除文章标签键 \'%s\'出错。', 'wp-postviews'), "<strong><em>{$postmeta}</em></strong>");
						echo '</font><br />';
					}
				}
				echo '</p>';
				echo '</div>'; 
				$mode = 'end-UNINSTALL';
			}
			break;
	}
}


### Determines Which Mode It Is
switch($mode) {
		//  Deactivating WP-PostViews
		case 'end-UNINSTALL':
			$deactivate_url = 'plugins.php?action=deactivate&amp;plugin=wp-postviews/wp-postviews.php';
			if(function_exists('wp_nonce_url')) { 
				$deactivate_url = wp_nonce_url($deactivate_url, 'deactivate-plugin_wp-postviews/wp-postviews.php');
			}
			echo '<div class="wrap">';
			echo '<h2>'.__('卸载WP-PostViews', 'wp-postviews').'</h2>';
			echo '<p><strong>'.sprintf(__('<a href="%s">点击这里</a> 完成卸载，WP-PostViews 将自动停用。', 'wp-postviews'), $deactivate_url).'</strong></p>';
			echo '</div>';
			break;
	// Main Page
	default:
		$views_options = get_option('views_options');
?>
<script type="text/javascript">
	/* <![CDATA[*/
	function views_default_templates(template) {
		var default_template;
		switch(template) {
			case 'template':
				default_template = "<?php _e('%VIEW_COUNT%人浏览', 'wp-postviews'); ?>";
				break;
			case 'most_viewed':
				default_template = "<li><a href=\"%POST_URL%\"  title=\"%POST_TITLE%\">%POST_TITLE%</a> - %VIEW_COUNT% <?php _e('人浏览', 'wp-postviews'); ?></li>";
				break;
		}
		jQuery("#views_template_" + template).val(default_template);
	}
	/* ]]> */
</script>
<?php if(!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo plugin_basename(__FILE__); ?>">
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('文章浏览设置', 'wp-postviews'); ?></h2>
	<table class="form-table">
		 <tr>
			<td valign="top" width="30%"><strong><?php _e('浏览统计包括:', 'wp-postviews'); ?></strong></td>
			<td valign="top">
				<select name="views_count" size="1">
					<option value="0"<?php selected('0', $views_options['count']); ?>><?php _e('所有人', 'wp-postviews'); ?></option>
					<option value="1"<?php selected('1', $views_options['count']); ?>><?php _e('仅游客', 'wp-postviews'); ?></option>
					<option value="2"<?php selected('2', $views_options['count']); ?>><?php _e('仅注册用户', 'wp-postviews'); ?></option>
				</select>
			</td>
		</tr>
		 <tr>
			<td valign="top" width="30%"><strong><?php _e('统计排除蜘蛛浏览:', 'wp-postviews'); ?></strong></td>
			<td valign="top">
				<select name="views_exclude_bots" size="1">
					<option value="0"<?php selected('0', $views_options['exclude_bots']); ?>><?php _e('否', 'wp-postviews'); ?></option>
					<option value="1"<?php selected('1', $views_options['exclude_bots']); ?>><?php _e('是', 'wp-postviews'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<strong><?php _e('浏览统计模版:', 'wp-postviews'); ?></strong><br /><br />
				<?php _e('允许变量:', 'wp-postviews'); ?><br />
				- %VIEW_COUNT%<br /><br />
				<input type="button" name="RestoreDefault" value="<?php _e('恢复默认模版', 'wp-postviews'); ?>" onclick="views_default_templates('template');" class="button" />
			</td>
			<td valign="top">
				<input type="text" id="views_template_template" name="views_template_template" size="70" value="<?php echo htmlspecialchars(stripslashes($views_options['template'])); ?>" />
			</td>
		</tr>
		<tr>
			<td valign="top">
				<strong><?php _e('浏览次数最多的模版:', 'wp-postviews'); ?></strong><br /><br />
				<?php _e('允许变量:', 'wp-postviews'); ?><br />
				- %VIEW_COUNT%<br />
				- %POST_TITLE%<br />
				- %POST_EXCERPT%<br />
				- %POST_CONTENT%<br />
				- %POST_URL%<br /><br />
				<input type="button" name="RestoreDefault" value="<?php _e('恢复默认模版', 'wp-postviews'); ?>" onclick="views_default_templates('most_viewed');" class="button" />
			</td>
			<td valign="top">
				<textarea cols="80" rows="15"  id="views_template_most_viewed" name="views_template_most_viewed"><?php echo htmlspecialchars(stripslashes($views_options['most_viewed_template'])); ?></textarea>
			</td>
		</tr>
	</table>
	<h3><?php _e('显示设置', 'wp-postviews'); ?></h3>
	<p><?php _e('这些设置指定统计数据对哪些人显示，以及显示的位置。默认是对所有人显示。请确认主题模版文件调用了<code>the_views()</code>以显示统计数据。', 'wp-postviews'); ?></p>
	<table class="form-table">
		<tr>
			<td valign="top"><strong><?php _e('首页:', 'wp-postviews'); ?></strong></td>
			<td>
				<select name="views_display_home" size="1">
					<option value="0"<?php selected('0', $views_options['display_home']); ?>><?php _e('对所有人显示', 'wp-postviews'); ?></option>
					<option value="1"<?php selected('1', $views_options['display_home']); ?>><?php _e('仅对注册用户显示', 'wp-postviews'); ?></option>
					<option value="2"<?php selected('2', $views_options['display_home']); ?>><?php _e('不在首页显示', 'wp-postviews'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><strong><?php _e('每篇文章:', 'wp-postviews'); ?></strong></td>
			<td>
				<select name="views_display_single" size="1">
					<option value="0"<?php selected('0', $views_options['display_single']); ?>><?php _e('对所有人显示', 'wp-postviews'); ?></option>
					<option value="1"<?php selected('1', $views_options['display_single']); ?>><?php _e('仅对注册用户显示', 'wp-postviews'); ?></option>
					<option value="2"<?php selected('2', $views_options['display_single']); ?>><?php _e('不在每篇文章显示', 'wp-postviews'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><strong><?php _e('页面:', 'wp-postviews'); ?></strong></td>
			<td>
				<select name="views_display_page" size="1">
					<option value="0"<?php selected('0', $views_options['display_page']); ?>><?php _e('对所有人显示', 'wp-postviews'); ?></option>
					<option value="1"<?php selected('1', $views_options['display_page']); ?>><?php _e('仅对注册用户显示', 'wp-postviews'); ?></option>
					<option value="2"<?php selected('2', $views_options['display_page']); ?>><?php _e('不在页面显示', 'wp-postviews'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><strong><?php _e('存档页:', 'wp-postviews'); ?></strong></td>
			<td>
				<select name="views_display_archive" size="1">
					<option value="0"<?php selected('0', $views_options['display_archive']); ?>><?php _e('对所有人显示', 'wp-postviews'); ?></option>
					<option value="1"<?php selected('1', $views_options['display_archive']); ?>><?php _e('仅对注册用户显示', 'wp-postviews'); ?></option>
					<option value="2"<?php selected('2', $views_options['display_archive']); ?>><?php _e('不在存档页显示', 'wp-postviews'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><strong><?php _e('搜索页面:', 'wp-postviews'); ?></strong></td>
			<td>
				<select name="views_display_search" size="1">
					<option value="0"<?php selected('0', $views_options['display_search']); ?>><?php _e('对所有人显示', 'wp-postviews'); ?></option>
					<option value="1"<?php selected('1', $views_options['display_search']); ?>><?php _e('仅对注册用户显示', 'wp-postviews'); ?></option>
					<option value="2"<?php selected('2', $views_options['display_search']); ?>><?php _e('不在搜索页面显示', 'wp-postviews'); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td valign="top"><strong><?php _e('其他页面:', 'wp-postviews'); ?></strong></td>
			<td>
				<select name="views_display_other" size="1">
					<option value="0"<?php selected('0', $views_options['display_other']); ?>><?php _e('对所有人显示', 'wp-postviews'); ?></option>
					<option value="1"<?php selected('1', $views_options['display_other']); ?>><?php _e('仅对注册用户显示', 'wp-postviews'); ?></option>
					<option value="2"<?php selected('2', $views_options['display_other']); ?>><?php _e('不在其他页面显示', 'wp-postviews'); ?></option>
				</select>
			</td>
		</tr>
	</table>
	<p class="submit">
		<input type="submit" name="Submit" class="button" value="<?php _e('保存更改', 'wp-postviews'); ?>" />
	</p>
</div>
</form> 
<p>&nbsp;</p>

<!-- Uninstall WP-PostViews -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo plugin_basename(__FILE__); ?>">
<div class="wrap"> 
	<h3><?php _e('卸载WP-PostViews', 'wp-postviews'); ?></h3>
	<p>
		<?php _e('停用WP-PostViews插件，不会删除任何已经创建的数据，比如浏览数据。要完全删除，您可以在这里彻底移除插件。', 'wp-postviews'); ?>
	</p>
	<p style="color: red">
		<strong><?php _e('警告:', 'wp-postviews'); ?></strong><br />
		<?php _e('一旦卸载，就无法撤消。建议您在卸载之前使用WordPress数据库备份插件备份所有数据。', 'wp-postviews'); ?>
	</p>
	<p style="color: red">
		<strong><?php _e('以下WordPress选项/文章标签将被删除:', 'wp-postviews'); ?></strong><br />
	</p>
	<table class="widefat">
		<thead>
			<tr>
				<th><?php _e('WordPress选项', 'wp-postviews'); ?></th>
				<th><?php _e('WordPress文章标签', 'wp-postviews'); ?></th>
			</tr>
		</thead>
		<tr>
			<td valign="top">
				<ol>
				<?php
					foreach($views_settings as $settings) {
						echo '<li>'.$settings.'</li>'."\n";
					}
				?>
				</ol>
			</td>
			<td valign="top" class="alternate">
				<ol>
				<?php
					foreach($views_postmetas as $postmeta) {
						echo '<li>'.$postmeta.'</li>'."\n";
					}
				?>
				</ol>
			</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<p style="text-align: center;">
		<input type="checkbox" name="uninstall_views_yes" value="yes" />&nbsp;<?php _e('是', 'wp-postviews'); ?><br /><br />
		<input type="submit" name="do" value="<?php _e('卸载WP-PostViews', 'wp-postviews'); ?>" class="button" onclick="return confirm('<?php _e('您即将删除 WP-PostViews 插件。\n该操作不可逆。\n\n 选择[取消]停止操作，选择[确定]完成卸载。', 'wp-postviews'); ?>')" />
	</p>
</div> 
</form>
<?php
} // End switch($mode)
?>