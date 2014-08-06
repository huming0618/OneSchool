<?php
	function get_post_image($default_img='/images/default.jpg'){
		global $post,$posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_content,$matches);
		$first_img = $matches [1][0];
		if(empty($first_img)){
			$first_img = $default_img;
		}
		return $first_img;
	}
	
?>