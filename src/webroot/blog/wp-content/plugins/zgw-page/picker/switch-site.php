<?php
    include_once(ABSPATH.'wp-includes/ms-functions.php');
    $blog_list = array();
    $blog_list = wp_get_sites();
    $current_id = get_current_blog_id();
    $current_blog = get_blog_details($current_id);
    $current_name = $current_blog->blogname;
    $current_path = $current_blog->path;
?>

<div class="row">
        <div class="btn-group" id="picker-site-switch">
            <button type="button" class="btn btn-info btn-xs">站点 － <?php echo $current_name?> </button>
            <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
<?php 
    foreach($blog_list as $blog){
        $blog_info = get_blog_details($blog['blog_id']);
        $name = $blog_info->blogname;
?>
                <li><a href="#">站点 － <?php echo $name?></a></li>
<?php 
    }
?>
            </ul>
        </div>
</div>
