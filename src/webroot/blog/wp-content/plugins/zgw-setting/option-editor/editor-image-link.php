<?php
	
?>
<div class="label" style="clear:both;">
	<label class="width-60 title">
		<?php echo $option['display']?>
	</label>
</div>
<hr>
<div class="rows">
	<div class="row">
		<label class="width-60">链接类型  ：</label>
		<input type="radio" name="link-type" value="raw-link" checked="checked"/>固定链接
		<input type="radio" name="link-type" value="article-link"/>目录/专题
		<input type="radio" name="link-type" value="article-link"/>文章
		<input type="radio" name="link-type" value="article-link"/>页面
		<input type="radio" name="link-type" value="article-link"/>附件
		<input type="radio" name="link-type" value="article-link"/>相册
		<input type="radio" name="link-type" value="article-link"/>视频
		<div class="sub-row">
			<select name="category-selector">
				<option selected="selected" value="-1">--选择目录或专题--</option>
				<?php 
					$category_ids = get_all_category_ids();
					
					foreach($category_ids as $id){
						$cat_name = get_cat_name($id);
				?>
						<option value="<?php echo $id?>"><?php echo $cat_name?></option>
				<?php
					}
				?>
			</select>
			<select name="article-selector">
			</select>
		</div>
		<div class="row">
			<label class="width-60">图片  ：</label>
			<img src=""/>
			<button>选择图片</button>
			<hr>
		</div>
	</div>
	<div></div>
</div>
<input type="hidden" name="<?php echo $option['wp-option']?>" value="<?php echo $option_Val?>" />
 

<br>

<script>
	var $ = jQuery;
	$('select[name=category-selector]').on('change',function(){
		var cat_id = this.value;
		$.post(
			'admin-ajax.php',
			{
				"action":"show_cat_articles",
				"cat_id" : cat_id
			},
			function(response){
				console.log('response',response);
				$('select[name=article-selector]').html(response);
			}
		)
	})
</script>


<div class="break"></div>