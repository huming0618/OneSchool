<?php
	require('../../../wp-load.php');
	//include('common.php');
	try{
		$slug = $_POST['slug'];
		$theme = $_POST['theme'];
		
		$config = new zgw_setting_config();
		$config->change_theme($slug,$theme);

		echo '1';
	}
	catch(Exception $e){
		if(WP_DEBUG){
			echo $e->getMessage();
		}
		else{
			echo '0';
		}
	}
	
?>