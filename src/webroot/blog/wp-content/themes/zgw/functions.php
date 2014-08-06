<?php 
	require_once('common.php');
	//widget
	function theme_widgets(){
		if( function_exists('register_sidebar') ) {
			register_sidebar(array(
				'before_widget' => '<li class="widget">', // widget 的开始标签
				'after_widget' => '</li>', // widget 的结束标签
				'before_title' => '<h3>', // 标题的开始标签
				'after_title' => '</h3>' // 标题的结束标签
			));
		}
	}
	add_action('init','theme_widgets');
	
	//post type
	function theme_post_types()
	{
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		));
		add_post_type_support('page','post-formats');
	}
	add_action('init','theme_post_types');
	
	//js,
	function theme_scripts()
	{
		// Register the script like this for a theme:
		//wp_register_script( 'jq-script', get_template_directory_uri() . '/bootstrap/js/jquery-2.0.3.min.js');
		// For either a plugin or a theme, you can then enqueue the script:
		//wp_enqueue_script( 'jq-script' );
		
		wp_register_script( 'bootstrap-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js');
		//wp_enqueue_script( 'bootstrap-script' );
		
		//slider show plugin
		wp_register_script( 'slideshow-script-easing', get_template_directory_uri() . '/slidershow/jquery.easing.js');
		//wp_enqueue_script( 'slideshow-script-easing' );
		
		wp_register_script( 'slideshow-script', get_template_directory_uri() . '/slidershow/svw.js');
		//wp_enqueue_script( 'slideshow-script' );
		
		wp_register_script( 'page-script', get_template_directory_uri() . '/js/page.js');
		//wp_enqueue_script( 'page-script' );
		
		wp_register_script( 'ie-respond', get_template_directory_uri() . '/bootstrap/js/respond.min.js');
		wp_register_script( 'ie-html5', get_template_directory_uri() . '/bootstrap/js/html5shiv.js');
	}
	
	add_action('wp_enqueue_scripts', 'theme_scripts' );
	
	//menu
	require_once('wp_bootstrap_navwalker.php');
	function theme_menu() { 
    	register_nav_menu( 'primary', __( '顶部菜单', 'zgw' ) );
    }
	add_action( 'after_setup_theme', 'theme_menu' );

?>