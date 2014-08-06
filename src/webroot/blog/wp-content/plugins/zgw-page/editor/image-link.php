<?php
    //include_once(ABSPATH.'wp-includes/ms-functions.php');
    //echo  wp_get_sites();
    $plugin_url = plugin_dir_url(dirname(__FILE__));
    $my_option = array();
    if(!empty($option_Val)){
        $my_option = json_decode($option_Val);
        $image_type = $my_option['image']['type'];
        if($image_type == 'content'){
            $media_id = $my_option['image']['id'];
            $image_url = zgw_get_content_url('media',$media_id);
        }
        else{
            $image_url = $my_option['image']['url'];
        }
        
        if($link_type == 'content.post'){
            $content_id = $my_option['link-content']['id'];
            $content_url = $my_option['link-content']['url'];
        }
        else{
            $content_url = $my_option['link-url'];
        }
    }
    if(!isset($image_url)){
        $image_url = $plugin_url.'images/placeholder.png';
    }
    if(!isset($content_url)){
        $content_url = '';
    }
    if(!isset($link_type)){
        $link_type = '';
    }
?>
<div class="panel panel-info">
    <div class="panel-heading"><?php echo $option['display']?></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
      
                <div>
                    <img src="<?php echo $image_url?>" style="width:120px;height:auto;"/>
                    <button type="button" class="btn btn-info btn-xs" data-for='pick-image'>选择</button>
                </div>
    
            
            </div>
            <div class="col-md-4">
                <h5>图片点击链接 ：</h5>
               
                <div>
                    <input type="radio" name="content-link"><label for="radio1">内容链接</label>
                    <input type="radio" name="fix-link" checked="checked"><label for="radio2">固定链接</label>
                </div>
                <div class="break"></div>
                <div>
                   <input type="text" placeholder="链接地址" value="<?php echo $content_url?>"/>
                </div>
            </div>
            
    
        </div>
    </div>
    <input type="hidden" name="<?php echo $option['wp-option']?>" value="<?php echo $option_Val?>" data-for="option"/>
</div>


<script>
    var $ = jQuery;
    $(document).ready(function(){
       // $('div.jq-radio').buttonset();
    });
    
    $('select[name=category-selector]').on('change',function(){
        var cat_id = this.value;
        $.post(
            'admin-ajax.php',
            {
                "action":"show_cat_articles",
                "cat_id" : cat_id
            },
            function(response){
                //console.log('response',response);
                $('select[name=article-selector]').html(response);
            }
        )
    })
</script>


<div class="break"></div>