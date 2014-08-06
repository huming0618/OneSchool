<?php
/*$for_page is from slug of menu
 *
 */
include_once ('class-config.php');
include_once ('class-options-reader.php');

$config = new zgw_page_themes_config();

$theme = get_option($theme_option_key);
$theme_folder = get_template_directory();
$theme_config_file = $theme_folder . DIRECTORY_SEPARATOR . $theme . '.options.json';
?>

<div class="wrap">
<h2>
设置
<a class="add-new-h2" href="#" id="zge_change_theme">更换模版</a>

</h2>
<div class="tablenav top" id="zgw_change_theme_panel" style="display:none">
<form id="zgw_form_change_theme" action="<?php echo(site_url().'/wp-content/plugins/zgw-setting/change_theme.php') ?>">
<label>更换模版 ： </label>
<input type="hidden" name="slug" value="<?php echo $for_page ?>"/>
<?php
$theme_for = '';

if ($for_page == 'general-front-page') {
	$theme_for = 'home';
	$theme_option_name = 'zgw-page-home-theme';
	$theme_option_type = 'wp_option';
}

$current_theme = get_option($theme_option_name, '');
include_once ('theme_picker.php');

$theme_picker = new zgw_theme_picker($for_page, $current_theme, $theme_option_type, $theme_option_name);
$theme_picker -> render();
?>
&nbsp;

</form>
</div>
<script>
    var $ = jQuery;
  
    $(document).ready(function() {
        var $panel = $('#zgw_change_theme_panel');
        var $option_panel = $('#zgw-setting-tabs');
        var $btn = $('#zge_change_theme')
        var toggleBtn = function() {
                if ($panel.is(':visible')) {
                    $btn.text('X 取消更换');
                    $btn.css('background-color', '#A21B25');
                    $btn.css('color', 'white');
                    //console.log($option_panel);
                    $option_panel.hide();
                } else {
                    $btn.text('更换模版');
                    $btn.css('background-color', '');
                    $btn.css('color', '');
                    $option_panel.show();
                }
            };
            
        var regThemeChangeEvent = window.setInterval(function() {
                if (window.theme_picker) {
                    window.clearInterval(regThemeChangeEvent);
                    window.theme_picker.regThemeChanged(function(){
                        $panel.slideToggle(200,toggleBtn);
                    })
                    
                }
            }, 100);
            
        $btn.click(function() {
            $panel.slideToggle(200,toggleBtn);
        })
    })
</script>
<!--<div class="tablenav top">

</div>-->
<div id="zgw-setting-tabs">

<?php
//$option_reader = new options_reader();
if (!empty($current_theme) && file_exists($theme_config_file)) {
	include_once ('class-setting-panel.php');
	$theme_config_file = $theme_folder . DIRECTORY_SEPARATOR . $current_theme . '.options.json';
	$panel = new zgw_setting_panel($theme_config_file);
	$panel->render();
}
else{
?>
    <div id="no-setting-msg">当前模版无可配置项目</div>
<?php
}
?>
</div><!-- end of div zgw-setting-tabs-->
<div class="row">
<?php
    include_once('picker/picker.php');
?>
</div>
 <script>
        var $ = jQuery;
        $(document).ready(function(){
            
            var $settingTabs =  $("#zgw-setting-tabs");
           
            var afterTabRender = function(){
                
                $settingTabs.tabs();
                var $settingTabDiv = $('#zgw-setting-tabs>div[id^=zgw-setting-tab-]');
                if($settingTabDiv.length > 0){
                   //$settingTabs.tabs();
                    
                   $settingTabDiv.each(function(){
                        if(this.id.indexOf('zgw-setting-tab-') == 0){
                            $(this).accordion({ 
                                        heightStyle: "auto",
                                        active: true,
                                        collapsible: true});
                            $(this).children('div').css('height','auto');
                        }
                   });
                    
                                
                   $("form[action='options.php']").submit(function(e){
                        e.preventDefault();
                        var $form = $(this);
                        var data = $form.serialize();
                        
                        var url = $form.attr('action')
        
                        var post = $.post(url,data);
                        post.done(function(result){
                            alert('设置保存成功');
                            //console.log(result);
                        }).fail(function(){
                            alert('设置保存失败');
                        })
                        
                    });
                }
                else{
                    $('#no-setting-msg').show();
                }
            }
            
            afterTabRender();
            
            var regThemeChangeEvent = window.setInterval(function() {
                if (window.theme_picker) {
                    window.clearInterval(regThemeChangeEvent);
                    window.theme_picker.regThemeChanged(function(theme){
                        $.post(
                                'admin-ajax.php',
                                {
                                    "action":"zgw_show_setting_panel",
                                    "theme":theme
                                },
                                function(response){
                                    $settingTabs.html(response);
                                    $settingTabs.tabs('destroy');
                                    afterTabRender();
                                    //console.log(response);
                                }
                        ).error(function(){
                            $settingTabs.html('<div id="no-setting-msg">当前模版无可配置项目</div>');
                        })
                    
                    });
                    
                }   
            }, 100);

            //edit options forms
            $('form[data-role="zgw-setting-form"]').each(function(){
                var $form = $(this)
                var type = $form.data('type');
                var editor = zgw.editor.create($form,type);
                //console.log(type,$form);
                
            })
        })
    </script>
