<?php get_header(); ?>

<div class="container-fluid" style="margin-top:55px;">
      	<div class="col-md-9 col-lg-9" style="padding-left:0px;">
      		<div class="pull-left front_topic">
	      	<?php
		  			$arg = array(
		  				'category_name'=>'首页专题',
		  				'showposts' => 1
					);

		  			query_posts($arg);
		  			if(have_posts()) while(have_posts()): 
						the_post();
		  				$img = get_post_image();
						echo '<div class="front_topic-bg">';
						echo '<img src="';
						echo $img;
						echo '"/></div>';
					endwhile;
					wp_reset_query();
				?>
				<div style="z-index: 999;position: absolute;bottom:10px;right:30px;">
	        	<p>
	          		<a role="button" href="../../components/#navbar" class="btn btn-small btn-danger">了解更多 »</a>
	        	</p>
				</div>
	        	
	      	</div>
      	</div>
      	<div class="col-md-3 col-lg-3" style="padding-right:0px;">
		  <div class="panel panel-default  height300">
			  <div class="panel-heading" style="padding-left:3px;padding-right: 3px;">
				  <ul class="nav nav-tabs smalll-tabs">
				  		
				  		<li class="active"><a href="#hui_ban_hui" data-toggle="tab">论坛</a></li>
				  		<li><a href="#hui_ban_hui" data-toggle="tab">微博</a></li>
				  		<li><a href="#hui_ban_hui" data-toggle="tab">博客</a></li>
				  </ul>
			  </div>
			  <div class="panel-body">
				<ul class="news-list no-list-style">
		  		<?php
		  			$arg = array(
		  				'category_name'=>'公告',
		  				'showposts' => 10
					);

		  			query_posts($arg);
		  			if(have_posts()) while(have_posts()): 
		  				the_post();
						echo '<li class="news_line">';
						echo '<a target="_blank" href="';
							the_permalink();
						echo '">';
							the_title();
						echo '</a></li>';
					endwhile;
					wp_reset_query();
				?>
				</ul>
			  </div>
		  </div>
      	</div>
</div>
<div class="clearfix"></div>
<div class="container-fluid">
  <div class="col-md-8 col-lg-8"  style="padding-left:0px;">
    <div class="panel panel-defaul  height300">
      <div class="panel-heading">
		  	<h3 class="panel-title">政工动态</h3>
		  </div>
		  <div class="panel-body container-fluid" style="min-height: 300px;">
		  	<div class="col-md-8">
		  		<table class="table new-table">
					<thead>
						<tr><th>最新图文</th></tr>
					</thead>
					<tbody>
						<tr>
							<td>
					<div class="svw">
			  		<ul>
				  		<?php
						  	$arg = array(
				  				'category_name'=>'政工动态-图片新闻',
				  				'showposts' => 10
							);
				  			query_posts($arg);
				  			if(have_posts()) while(have_posts()): 
				  				the_post();
								$img = get_post_image();
								echo '<a target="_blank" href="';
									the_permalink();
								echo '" title="';
									the_title();
								echo '" target="_blank"><li><img src="'.$img.'"/></li></a>';
							endwhile;
							wp_reset_query();
						?>
					</ul>
				</div>
							</td>
						</tr>
					</tbody>
				</table>
		  		
		  	</div>
		  	<div class="col-md-4">
		  		<table class="table table-hover new-table">
					  <thead>
					  	<tr><th>新闻<a class="btn btn-danger btn-xs pull-right">更多</span></th></tr>
					  </thead>
					  <tbody>
					  <?php
						$arg = array(
					  		'category_name'=>'政工动态-新闻',
					  		'showposts' => 5
						);
					  	query_posts($arg);
					  	if(have_posts()) while(have_posts()): 
					  		the_post();
							echo '<tr><td>';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a><br><small>';
							echo get_the_date('Y-m-d H:i:s').'</small>';
							echo '</td></tr>';
						endwhile;
						wp_reset_query();
					 ?>
					
					  </tbody>
					
					  </table>
		  	</div>
		  </div>
    </div>
  </div>
  <div class="col-md-4 col-lg-4"  style="padding-right:0px;">
    <div class="panel panel-default height400">
      <div class="panel-heading">
	  	<ul class="nav nav-tabs">
	  		<li class="active"><a href="#ban_gong_hui" data-toggle="tab">公告栏</a></li>
	  		<li><a href="#ban_gong_hui" data-toggle="tab">办公会</a></li>
	  		<li><a href="#hui_ban_hui" data-toggle="tab">会班会</a></li>
	  	</ul>
	  </div>
	  <div class="panel-body">
	  	<div class="tab-content">
	  		<div class="tab-pane" id="hui_ban_hui">
		  		<ul class="news-list no-list-style">
				<?php
			  			$arg = array(
			  				'category_name'=>'会班会',
			  				'showposts' => 10
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo "<span class='pull-right'>";
							echo get_the_date('Y-m-d').'</span>';
							echo '</a></li>';
						endwhile;
						wp_reset_query();
				?>
				</ul>
	  		</div>
	  		<div class="tab-pane active" id="ban_gong_hui">
	  			<ul class="news-list no-list-style">
				<?php
		  			$arg = array(
		  				'category_name'=>'办公会',
		  				'showposts' => 10
					);

		  			query_posts($arg);
		  			if(have_posts()) while(have_posts()): 
		  				the_post();
						echo '<li class="news_line">';
						echo '<a target="_blank" href="';
							the_permalink();
						echo '">';
							the_title();
						echo "<span class='pull-right'>";
						echo get_the_date('Y-m-d').'</span>';
						echo '</a></li>';
					endwhile;
					wp_reset_query();
				?>
				</ul>
	  		</div>
	  	</div>
		  <div class="panel-body">
		    <ul class="news-list no-list-style">
		  		
			</ul>
		  </div>
    </div>
  </div>
</div>
	  
	  
	<div class="clearfix"></div>
	<div class="container-fluid">
		<!-- 工作指导-->
  		<div class="col-md-4 col-lg-4"  style="padding-left:0px;">
  			<div class="panel-heading">
		  			<h3 class="panel-title">工作指导</h3>
		  	</div>
		  	<!-- 组织工作 -->
  			<div class="panel panel-default height270">
  				<div class="panel-heading">
		  			<h3 class="panel-title">组织工作</h3>
		  		</div>
		  		<div class="panel-body">
			    	<ul class="news-list no-list-style">
			  		<?php
			  			$arg = array(
			  				'category_name'=>'工作指导-组织工作',
			  				'showposts' => 10
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a></li>';
						endwhile;
						wp_reset_query();
					?>
					</ul>
		  </div>
  		</div>
  		
  		<!-- 干部工作 -->
  		<div class="panel panel-default  height270">
  			<div class="panel-heading">
		  		<h3 class="panel-title">干部工作</h3>
		  	</div>
		  	<div class="panel-body">
			    	<ul class="news-list no-list-style">
			  		<?php
			  			$arg = array(
			  				'category_name'=>'干部工作-工作指导',
			  				'showposts' => 10
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a></li>';
						endwhile;
						wp_reset_query();
					?>
					</ul>
		  </div>
  		</div>
  		
  		<!-- 宣传工作 -->
		<div class="panel panel-default height270">
  			<div class="panel-heading">
		  		<h3 class="panel-title">宣传工作</h3>
		  	</div>
		  	<div class="panel-body">
			    	<ul class="news-list no-list-style">
			  		<?php
			  			$arg = array(
			  				'category_name'=>'宣传工作-工作指导',
			  				'showposts' => 10
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a></li>';
						endwhile;
						wp_reset_query();
					?>
					</ul>
		  </div>
  		</div>
  		<!-- 宣传工作 -->
		<div class="panel panel-default height270">
  			<div class="panel-heading">
		  		<h3 class="panel-title">保卫工作</h3>
		  	</div>
		  	<div class="panel-body">
			    	<ul class="news-list no-list-style">
			  		<?php
			  			$arg = array(
			  				'category_name'=>'保卫工作-工作指导',
			  				'showposts' => 10
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a></li>';
						endwhile;
						wp_reset_query();
					?>
					</ul>
		  </div>
  		</div>
  		<!-- 群秘工作 -->
		<div class="panel panel-default height270">
  			<div class="panel-heading">
		  		<h3 class="panel-title">群秘工作</h3>
		  	</div>
		  	<div class="panel-body">
			    	<ul class="news-list no-list-style">
			  		<?php
			  			$arg = array(
			  				'category_name'=>'群秘工作-工作指导',
			  				'showposts' => 10
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a></li>';
						endwhile;
						wp_reset_query();
					?>
					</ul>
		  </div>
  		</div>
  	</div>
  	<!-- 特色栏目 -->
	<div class="col-md-5 col-lg-5">
  		<div class="panel-heading">
			<h3 class="panel-title">特色栏目</h3>
		</div>
		
		<div class="panel panel-default height270">
			<div>
			  	<ul class="nav nav-tabs small-tabs">
			  		<li class="active"><a href="#dang_xiao" data-toggle="tab">网上党校</a></li>
			  		<li><a href="#shuang_zhen" data-toggle="tab">双争考评</a></li>
			  		<li><a href="#lian_zheng" data-toggle="tab">廉政清风</a></li>
			  		<li><a href="#lv_shi" data-toggle="tab">旅史馆</a></li>
			  	</ul>
		  	</div>
	  		<div class="tab-content">
	  			<div class="tab-pane active" id="hui_ban_hui">
		  			<ul class="news-list no-list-style media-list">
					<?php
				  			$arg = array(
				  				'category_name'=>'网上党校',
				  				'showposts' => 3
							);
		
				  			query_posts($arg);
				  			if(have_posts()) while(have_posts()): 
				  				the_post();
								$img = get_post_image();
								echo '<li>';
								echo '<a target="_blank" href="';
									the_permalink();
								echo '">';
								echo '<div class="media">';
									echo '<a class="pull-left" href="#">';
									echo '<img class="media-object" height="100" width="128" src="'.$img.'">';
									echo '</a>';
									
									echo '<div class="media-body">';
									echo '<h5 class="media-heading">';
										the_title();
									echo '</h5>';
									echo '<p><small>';
										the_excerpt();
									echo '</small></p>';
								echo '</div>';
								echo '</div>';
								
								echo '</a>';
								echo '</li>';
								
							endwhile;
							wp_reset_query();
					?>
					</ul>
	  			</div>
	  		</div>
	  	</div>
	  	<div class="clearfix"></div>
	  	<!-- 干部之家 -->
	  	<div class="panel panel-default height270">
			<div>
				<ul class="nav nav-tabs small-tabs">
					<li class="active"><a href="#dang_xiao" data-toggle="tab">干部之家</a></li>
				</ul>
			</div>
	  		<div class="tab-content">
	  			<div class="tab-pane" id="hui_ban_hui">
		  			<ul class="news-list no-list-style">
					<?php
				  			$arg = array(
				  				'category_name'=>'干部之家',
				  				'showposts' => 10
							);
		
				  			query_posts($arg);
				  			if(have_posts()) while(have_posts()): 
				  				the_post();
								echo '<li class="news_line">';
								echo '<a target="_blank" href="';
									the_permalink();
								echo '">';
									the_title();
								echo "<span class='pull-right'>";
								echo get_the_date('Y-m-d').'</span>';
								echo '</a></li>';
							endwhile;
							wp_reset_query();
					?>
					</ul>
	  			</div>
	  		</div>
	  	</div>
	  	<div class="clearfix"></div>
	  	<!-- 宣传 -->
	  	<div class="panel panel-default height270">
			<div>
			  	<ul class="nav nav-tabs small-tabs">
			  		<li class="active"><a href="#dang_xiao" data-toggle="tab">新闻中心</a></li>
			  		<li><a href="#dang_xiao" data-toggle="tab">教育资料</a></li>
			  		<li><a href="#dang_xiao" data-toggle="tab">文化艺术</a></li>
			  		<li><a href="#dang_xiao" data-toggle="tab">心理咨询</a></li>
			  	</ul>
		  	</div>
	  		<div class="tab-content">
	  			<div class="tab-pane" id="hui_ban_hui">
		  			<ul class="news-list no-list-style">
					<?php
				  			$arg = array(
				  				'category_name'=>'会班会',
				  				'showposts' => 10
							);
		
				  			query_posts($arg);
				  			if(have_posts()) while(have_posts()): 
				  				the_post();
								echo '<li class="news_line">';
								echo '<a target="_blank" href="';
									the_permalink();
								echo '">';
									the_title();
								echo "<span class='pull-right'>";
								echo get_the_date('Y-m-d').'</span>';
								echo '</a></li>';
							endwhile;
							wp_reset_query();
					?>
					</ul>
	  			</div>
	  		</div>
	  	</div>
	  	<div class="clearfix"></div>
	  	<!-- 保卫 -->
	  	<div class="panel panel-default height270">
			<div>
			  	<ul class="nav nav-tabs small-tabs">
			  		<li class="active"><a href="#dang_xiao" data-toggle="tab">法治教育</a></li>
			  	</ul>
			</div>
			<div class="tab-content">
	  			<div class="tab-pane" id="hui_ban_hui">
		  			<ul class="news-list no-list-style">
					<?php
				  			$arg = array(
				  				'category_name'=>'会班会',
				  				'showposts' => 10
							);
		
				  			query_posts($arg);
				  			if(have_posts()) while(have_posts()): 
				  				the_post();
								echo '<li class="news_line">';
								echo '<a target="_blank" href="';
									the_permalink();
								echo '">';
									the_title();
								echo "<span class='pull-right'>";
								echo get_the_date('Y-m-d').'</span>';
								echo '</a></li>';
							endwhile;
							wp_reset_query();
					?>
					</ul>
	  			</div>
	  		</div>
		</div>
		<div class="clearfix"></div>
	  	<!-- 群秘 -->
	  	<div class="panel panel-default height270">
			<div>
			  	<ul class="nav nav-tabs small-tabs">
			  		<li class="active"><a href="#dang_xiao" data-toggle="tab">律师在线</a></li>
			  	</ul>
		  	</div>
	  		<div class="tab-content">
	  			<div class="tab-pane" id="hui_ban_hui">
		  			<ul class="news-list no-list-style">
					<?php
				  			$arg = array(
				  				'category_name'=>'会班会',
				  				'showposts' => 10
							);
		
				  			query_posts($arg);
				  			if(have_posts()) while(have_posts()): 
				  				the_post();
								echo '<li class="news_line">';
								echo '<a target="_blank" href="';
									the_permalink();
								echo '">';
									the_title();
								echo "<span class='pull-right'>";
								echo get_the_date('Y-m-d').'</span>';
								echo '</a></li>';
							endwhile;
							wp_reset_query();
					?>
					</ul>
	  			</div>
	  		</div>
	  		
  			
  		</div>	
	</div>
	<div class="col-md-3 col-lg-3">
  		<div class="panel-heading">
			<h3 class="panel-title">特色专题</h3>
		</div>
  		<div class="panel panel-default height270">
  			
		  	<div class="panel-body">
				<ul class="news-list no-list-style">
					
			  		<?php
			  			
			  			$arg = array(
			  				'category_name'=>'特色专题－组织工作',
			  				'showposts' => 1
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							$img = get_post_image();
							echo '<li style="margin-bottom:12px">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
							echo '<img src="'.$img.'" width="172px" height="84px"></img>';
							echo '</a></li>';
							
						endwhile;
						wp_reset_query();
						
			  			$arg = array(
			  				'category_name'=>'特色专题－组织工作',
			  				'showposts' => 5
						);
						
						query_posts($arg);
						if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a></li>';
						endwhile;
						wp_reset_query();
					?>
				</ul>
		  </div>
  		</div>	
  		<div class="panel panel-default height270">
  			
		  	<div class="panel-body">
				<ul class="news-list no-list-style">
					
			  		<?php
			  			
			  			$arg = array(
			  				'category_name'=>'特色专题－组织工作',
			  				'showposts' => 1
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							$img = get_post_image();
							echo '<li style="margin-bottom:12px">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
							echo '<img src="'.$img.'" width="172px" height="84px"></img>';
							echo '</a></li>';
							
						endwhile;
						wp_reset_query();
						
			  			$arg = array(
			  				'category_name'=>'特色专题－组织工作',
			  				'showposts' => 5
						);
						
						query_posts($arg);
						if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a></li>';
						endwhile;
						wp_reset_query();
					?>
				</ul>
		  </div>
  		</div>
  		<div class="panel panel-default height270">
  			
		  	<div class="panel-body">
				<ul class="news-list no-list-style">
					
			  		<?php
			  			
			  			$arg = array(
			  				'category_name'=>'特色专题－组织工作',
			  				'showposts' => 1
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							$img = get_post_image();
							echo '<li style="margin-bottom:12px">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
							echo '<img src="'.$img.'" width="172px" height="84px"></img>';
							echo '</a></li>';
							
						endwhile;
						wp_reset_query();
						
			  			$arg = array(
			  				'category_name'=>'特色专题－组织工作',
			  				'showposts' => 5
						);
						
						query_posts($arg);
						if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a></li>';
						endwhile;
						wp_reset_query();
					?>
				</ul>
		  </div>
  		</div>
  		<div class="panel panel-default height270">
  			
		  	<div class="panel-body">
				<ul class="news-list no-list-style">
					
			  		<?php
			  			
			  			$arg = array(
			  				'category_name'=>'特色专题－组织工作',
			  				'showposts' => 1
						);
	
			  			query_posts($arg);
			  			if(have_posts()) while(have_posts()): 
			  				the_post();
							$img = get_post_image();
							echo '<li style="margin-bottom:12px">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
							echo '<img src="'.$img.'" width="172px" height="84px"></img>';
							echo '</a></li>';
							
						endwhile;
						wp_reset_query();
						
			  			$arg = array(
			  				'category_name'=>'特色专题－组织工作',
			  				'showposts' => 5
						);
						
						query_posts($arg);
						if(have_posts()) while(have_posts()): 
			  				the_post();
							echo '<li class="news_line">';
							echo '<a target="_blank" href="';
								the_permalink();
							echo '">';
								the_title();
							echo '</a></li>';
						endwhile;
						wp_reset_query();
					?>
				</ul>
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
<?php get_footer(); ?>