<?php
    add_action('wp_ajax_zgw_get_wp_content','get_wp_content_ajax_handler');
    function show_setting_panel_ajax_handler(){
        $blog_id = $_POST['blog'];
        $type = $_POST['type'];
        $format = $_POST['format'];
        
        $result = array('type'=>$type,'data'=>array());
        //check if it is multisite
        //if( is_multisite() ){
        switch_to_blog($blog_id);
        if($type == 'category'){
            $category_ids = get_all_category_ids();
            foreach($category_ids as $id){
                $cat_name = get_cat_name($id);
                array_push($result['data'],array('id'=>$id,'name'=>$cat_name));
            }
        }
        else if($type == 'post'){
            $cat_id = $_POST['cat'];
            $query = array(
                'category'=>intval($cat_id)
            );
            $post_list = get_posts($query);
            foreach($post_list as $post) :
                array_push($result['data'],array('id'=>$post->ID,'title'=>$post->post_title));
            endforeach;
            wp_reset_postdata();
        }
        else if($type == 'gallery'){
            $cat_id = $_POST['cat'];
            $query = array(
                'category'=>intval($cat_id),
                'tax_query' => array(
                    array(
                      'taxonomy' => 'post_format',
                      'field' => 'slug',
                      'terms' => array('post-format-gallery')
                    )
                 )
            );
            $post_list = get_posts($query);
            foreach($post_list as $post) :
                array_push($result['data'],array('id'=>$post->ID,'title'=>$post->post_title));
            endforeach;
            wp_reset_postdata();
        }
        else if($type == 'video'){
            $cat_id = $_POST['cat'];
            $query = array(
                'category'=>intval($cat_id),
                'tax_query' => array(
                    array(
                      'taxonomy' => 'post_format',
                      'field' => 'slug',
                      'terms' => array('post-format-video')
                    )
                 )
            );
            $post_list = get_posts($query);
            foreach($post_list as $post) :
                array_push($result['data'],array('id'=>$post->ID,'title'=>$post->post_title));
            endforeach;
            wp_reset_postdata();
        }
        else if($type == 'page'){
            $pages = get_pages();
            foreach ( $pages as $page ){
                array_push($result['data'],array('id'=>$post->ID,'title'=>$post->post_title));
            }
        }
        restore_current_blog();
        //post
        
        //media
        
        //format
        
        //type
        die();
    }
    
?>