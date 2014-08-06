<?php
	add_action('wp_ajax_show_cat_articles','show_cat_articles_handler');
	add_action('wp_ajax_nopriv_show_cat_articles','show_cat_articles_handler');
	
	function show_cat_articles_handler(){
		$cat_id = $_POST['cat_id'];
		$query = array(
			'category'=>intval($cat_id)
			);
		$post_list = get_posts($query);

		foreach($post_list as $post) :
?>
			<option value="<?php echo $post->ID?>"><?php echo $post->post_title?></option>
<?php
		endforeach;
		wp_reset_postdata();
		die();
	}
	
?>