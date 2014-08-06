<div class="container-fluid">
      	<div class="col-md-9 col-lg-9" style="padding-left:0px;">
	      	<div class="pull-left jumbotron">
	        	<h2>两会专题2</h2>
	        	<p>This example is a quick exercise to illustrate how the default, static navbar and fixed to top navbar work. It includes the responsive CSS and HTML, so it also adapts to your viewport and device.</p>
	        	<p>
	          		<a role="button" href="../../components/#navbar" class="btn btn-lg btn-danger">了解更多 »</a>
	        	</p>
	      	</div>
      	</div>
      	<div class="col-md-3 col-lg-3" style="padding-right:0px;">
		  <div class="panel panel-default">
			  <div class="panel-heading">
			  	<h3 class="panel-title">通知栏</h3>
			  </div>
			  <div class="panel-body">
			    通知
			  </div>
		  </div>
      	</div>
</div>
<div class="clearfix"></div>
<div class="container-fluid">
  <div class="col-md-8 col-lg-8"  style="padding-left:0px;">
    <div class="panel panel-default">
      <div class="panel-heading">
		  	<h3 class="panel-title">政工动态</h3>
		  </div>
		  <div class="panel-body row">
		  	<div class="col-md-5">
		  		
		  		<?php
		  			query_posts('category_name=政工动态-图片新闻');
		  			if(have_posts()) while(have_posts()): 
		  				the_post();
						echo '<li>';
							the_title();
						echo '</li>';
					endwhile;
					wp_reset_query();
				?>
		  	</div>
		  	<div class="col-md-7">
		  		
		  	</div>
		  </div>
    </div>
  </div>
  <div class="col-md-4 col-lg-4"  style="padding-right:0px;">
    <div class="panel panel-default">
      <div class="panel-heading">
		  	<h3 class="panel-title">政工研究</h3>
		  </div>
		  <div class="panel-body">
		    Panel content
		  </div>
    </div>
  </div>
</div>
	  
	  
	  <div class="clearfix"></div>
	  <div class="panel panel-default">
		  <div class="panel-heading">
		  	<h3 class="panel-title">秘群工作</h3>
		  </div>
		  <div class="panel-body">
		    <div class="container-fluid">
		    	<div class="col-md-4 col-lg-4">
		    		工作指导
		    	</div>
		    	<div class="col-md-4 col-lg-4">
		    		特色专栏
		    	</div>
		    	<div class="col-md-4 col-lg-4">
		    		特色专题
		    	</div>
		    </div>
		  </div>
	  </div>
	  
	  <div class="clearfix"></div>
	  <div class="panel panel-default">
		  <div class="panel-heading">
		  	<h3 class="panel-title">组织工作</h3>
		  </div>
		  <div class="panel-body">
		    <div class="container-fluid">
		    	<div class="col-md-4 col-lg-4">
		    		工作指导
		    	</div>
		    	<div class="col-md-4 col-lg-4">
		    		特色专栏
		    	</div>
		    	<div class="col-md-4 col-lg-4">
		    		特色专题
		    	</div>
		    </div>
		  </div>
	  </div>
	  
	  <div class="clearfix"></div>
	  <div class="panel panel-default">
		  <div class="panel-heading">
		  	<h3 class="panel-title">宣传工作</h3>
		  </div>
		  <div class="panel-body">
		    <div class="container-fluid">
		    	<div class="col-md-4 col-lg-4">
		    		工作指导
		    	</div>
		    	<div class="col-md-4 col-lg-4">
		    		特色专栏
		    	</div>
		    	<div class="col-md-4 col-lg-4">
		    		特色专题
		    	</div>
		    </div>
		  </div>
	  </div>
	  
	  <div class="clearfix"></div>
	  <div class="panel panel-default">
		  <div class="panel-heading">
		  	<h3 class="panel-title">保卫工作</h3>
		  </div>
		  <div class="panel-body">
		    <div class="container-fluid">
		    	<div class="col-md-4 col-lg-4">
		    		工作指导
		    	</div>
		    	<div class="col-md-4 col-lg-4">
		    		特色专栏
		    	</div>
		    	<div class="col-md-4 col-lg-4">
		    		特色专题
		    	</div>
		    </div>
		  </div>
	  </div>
	  
	  <div class="clearfix"></div>
	  <div class="panel panel-default">
		  <div class="panel-heading">
		  	<h3 class="panel-title">基层动态</h3>
		  </div>
		  <div class="panel-body">
		    Panel content
		  </div>
	  </div>
