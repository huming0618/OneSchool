<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>77113装甲旅政工网</title>
    <!-- Bootstrap -->
    <?php
    	echo '<link href="'.get_template_directory_uri().'/bootstrap/css/bootstrap.min.css'.'" rel="stylesheet"/>';
		//wp_enqueue_script('ie-html5');
	    //wp_enqueue_script('ie-respond');	

    ?>
  	<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">

    <?php wp_head(); ?>
  </head>
  <body>
	<div class="container">
		<div role="navigation" class="navbar navbar-default">
	        <div class="container-fluid">
	          <div class="navbar-header">
	            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
	              <span class="sr-only">Toggle navigation</span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	              <span class="icon-bar"></span>
	            </button>
	            <a href="#" class="navbar-brand">
	            	<?php bloginfo('name'); ?>
	            	<!--<img src="images/zg_logo.jpg"/>-->
	            </a>
	          </div>
	          <div class="navbar-collapse collapse">
	          	
 			  <?php 
		      	wp_nav_menu( array(
					'menu' => 'top_menu',
					'depth' => 2,
					'container' => false,
					'menu_class' => 'nav navbar-nav',
						  //Process nav menu using our custom nav walker
					'walker' => new wp_bootstrap_navwalker())
				);
	          ?>
	            <ul class="nav navbar-nav navbar-right">
	              <!--<li class="active"><a href="./">Default</a></li>
	              <li><a href="../navbar-static-top/">Static top</a></li>
	              <li><a href="../navbar-fixed-top/">Fixed top</a></li>-->
	            </ul>
	          </div><!--/.nav-collapse -->
	        </div><!--/.container-fluid -->
	      </div>