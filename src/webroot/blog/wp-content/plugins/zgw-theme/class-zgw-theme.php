<?php	
	class ZGW_Theme {
		public function __construct() {
	    	$this-> register_widget_areas();
			add_action('widgets_init', array($this, 'register_widgets'));
	    }
		
		public function register_widgets() {
		    $base_path = plugin_dir_path(__FILE__);
		    include $base_path . 'widgets.php';
		    register_widget('Home_List_Widget');
		}
		
     	public function register_widget_areas() {
       		register_sidebar(array(
           		'name' => __('Home Widgets','topmenu'),
           		'id' => 'home-TopMenu',
           		'description' => __('Home Widget Area', 'topmenu'),
           		'before_widget' => '<div id="one" class="home_list">',
           		'after_widget' => '</div>',
           		'before_title' => '<h2>',
           		'after_title' => '</h2>'
			)); 
		}
	}
?>