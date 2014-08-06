	</div><!-- /container -->

	<?php
	 	$ie_ver = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($ie_ver, "MSIE 6.0") || strpos($ie_ver, "MSIE 7.0") || strpos($ie_ver, "MSIE 8.0")){
			wp_enqueue_script('ie-html5');
	    	wp_enqueue_script('ie-respond');	
			
		}

		
		wp_enqueue_script("jquery");
		wp_enqueue_script( 'bootstrap-script' );
		wp_enqueue_script( 'slideshow-script-easing' );
		wp_enqueue_script( 'slideshow-script' );
		wp_enqueue_script( 'page-script' );
	?>
    <?php wp_footer(); ?>
	
  </body>
</html>