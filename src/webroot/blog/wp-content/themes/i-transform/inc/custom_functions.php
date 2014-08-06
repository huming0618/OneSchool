<?php 
/*-----------------------------------------------------------------------------------*/
/* Social icons																		*/
/*-----------------------------------------------------------------------------------*/
function itransform_social_icons () {
	
	$socio_list = '';
	$siciocount = 0;
    $services = array ('facebook','twitter','pinterest','flickr','feed','instagram');
    
		$socio_list .= '<ul class="social">';	
		foreach ( $services as $service ) :
			
			$active[$service] = esc_url( of_get_option ('itrans_social_'.$service) );
			if ($active[$service]) { 
				$socio_list .= '<li><a href="'.$active[$service].'" title="'.$service.'" target="_blank"><i class="socico genericon-'.$service.'"></i></a></li>';
				$siciocount++;
			}
			
		endforeach;
		$socio_list .= '</ul>';
		
		if($siciocount>0)
		{	
			return $socio_list;
		} else
		{
			return;
		}
}


/*-----------------------------------------------------------------------------------*/
/* ibanner Slider																		*/
/*-----------------------------------------------------------------------------------*/
function itransform_ibanner_slider () {    
	$arrslidestxt = array();
	$template_dir = get_template_directory_uri();
    for($slideno=1;$slideno<=4;$slideno++){
			$strret = '';
			$slide_title = of_get_option ('itrans_slide'.$slideno.'_title');
			$slide_desc = of_get_option ('itrans_slide'.$slideno.'_desc');
			$slide_linktext = of_get_option ('itrans_slide'.$slideno.'_linktext');
			$slide_linkurl = of_get_option ('itrans_slide'.$slideno.'_linkurl');
			$slide_image = of_get_option ('itrans_slide'.$slideno.'_image');
			
			if ($slide_title) {
			$strret .= '<h2>'.$slide_title.'</h2>';
			$strret .= '<p>'.$slide_desc.'</p>';
			$strret .= '<a href="'.$slide_linkurl.'" class="da-link">Read more</a>';
			
				if( $slide_image!='' ){
					
					$upload_dir = wp_upload_dir();
					$upload_base_dir = $upload_dir['basedir'];
					$upload_base_url = $upload_dir['baseurl'];
					if( file_exists( str_replace($upload_base_url,$upload_base_dir,$slide_image) ) ){
						$strret .= '<div class="da-img"><img src="'.$slide_image.'" alt="'.$slide_title.'" /></div>';
					}
					else
					{
						$slide_image = $template_dir.'/images/no-image.png';
						$strret .= '<div class="da-img noslide-image"><img src="'.$slide_image.'" alt="'.$slide_title.'" /></div>';					
					}
				}
				else
				{					
					$slide_image = $template_dir.'/images/no-image.png';
					$strret .= '<div class="da-img noslide-image"><img src="'.$slide_image.'" alt="'.$slide_title.'" /></div>';
				}
			}
			if ($strret !=''){
				$arrslidestxt[$slideno] = $strret;
			}
					
	}
	if(count($arrslidestxt)>0){
		echo '<div class="ibanner">';
        echo '	<div class="slidexnav">';
		echo '		<a href="#" class="sldprev genericon-leftarrow"></a>';
		echo '		<a href="#" class="sldnext genericon-rightarrow"></a>';
		echo '	</div>';
		echo '	<div id="da-slider" class="da-slider" role="banner">';
			
		foreach ( $arrslidestxt as $slidetxt ) :
			echo '<div class="da-slide">';	
			echo	$slidetxt;
			echo '</div>';

		endforeach;
		
		echo '		<nav class="da-arrows">';
		echo '			<span class="da-arrows-prev"></span>';
		echo '			<span class="da-arrows-next"></span>';
		echo '		</nav>';
		echo '	</div>';
		echo '</div>';
	} else
	{
        echo '<div class="iheader front">';
        echo '    <div class="titlebar">';
        echo '        <h1>';
						//bloginfo( 'name' );
						echo of_get_option('itrans_slogan');
        echo '        </h1>';
		echo ' 		  <h2>';
			    		//bloginfo( 'description' );
						//echo of_get_option('itrans_sub_slogan');
		echo '		</h2>';
        echo '    </div>';
        echo '</div>';
	}
    
}