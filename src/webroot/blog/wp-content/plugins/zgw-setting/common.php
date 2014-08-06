<?php

		
	function zgw_read_setting($option, $default){
		$prefix = 'zgw_plugin_setting_';
		return get_option( $prefix.$option, $default );
	}
?>