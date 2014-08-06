<?php

	function frontpage_opt_changetheme() {
?>
		<div class="wrap">
		<h2>更换主题</h2>
		
		<form method="post" action="options.php">
		    <?php settings_fields( 'zgw_frontpage_theme' ); ?>
		    <?php do_settings_sections( 'zgw_frontpage_theme' ); ?>
		    <table class="form-table">
		        <tr valign="top">
		        <th scope="row">请选择主题</th>
		        <td><input type="text" name="zgw_frontpage_theme" value="<?php echo get_option('zgw_frontpage_theme'); ?>" /></td>
		        </tr>
		    </table>
		    
		    <?php submit_button(); ?>
		
		</form>
		</div>
<?php 
	}
	
	return array('submenus'=>
		array(
			array(
				'display'=>'更换模版',
				'name'=>'theme',
				'option_group'=>'zgw_frontpage_theme',
				'options' => array('zgw_frontpage_theme'=>'zgw_frontpage_theme'),
				'option_callback'=>'frontpage_opt_changetheme'
			),
			array(
				'display'=>'基本设置',
				'name'=>'basic',
				'option_group'=>'',
				'options'=>null,
				'option_callback'=>''),
			array('display'=>'轮播图','name'=>'routing_pic',
				'option_group'=>'',
				'options'=>null,
				'option_callback'=>''),
			array('display'=>'今日头条','name'=>'today_header',
				'option_group'=>'',
				'options'=>null,
				'option_callback'=>''),
			array('display'=>'政工动态','name'=>'zgdt',
				'option_group'=>'',
				'options'=>null,
				'option_callback'=>''),
			array('display'=>'分类设置','name'=>'flsz',
				'option_group'=>'',
				'options'=>null,
				'option_callback'=>'')
		)
	);
?>
