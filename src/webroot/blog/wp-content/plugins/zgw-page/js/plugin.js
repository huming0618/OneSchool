(function(window){
	var $=jQuery;
	window.themePicker = function($el){
		var $picker = $('#zgw-page-theme-picker-form');
		var $pickerList = $picker.children('ul');
		
		//change container height
		var $container = $picker.parent();
		$container.css({'min-height':600,'overflow':'auto'});
		
		this.whenThemeChanged = [];
		
		this.regThemeChanged = function(callback){
			this.whenThemeChanged.push(callback);
		}
		
		//sort the active theme as first one
		function sortActiveOne(){
			var $activeOne = $picker.find('li div.active');
				
				if($activeOne.length > 0 && $activeOne.prevAll().length > 0){
					var $box = $activeOne.parent();
					$pickerList.prepend($box);
	
				}
			}
			
		sortActiveOne();
			
		function swap_active($toActiveBox){
				
			var $activeOne = $picker.find('li div.active');
			var activeOneTheme = $activeOne.data('theme');
			var activeOneThemeName = $activeOne.data('theme-name');
			$activeOne.removeClass('active')
					.addClass('bg-graywhite')
					.append(
						['<div class="action">',
							'<a class="button button-primary" style="z-index: 9999" data-theme="'+activeOneTheme+'" data-theme-name="'+activeOneThemeName+'"href="#">启用</a>',
						'</div>'].join(''));
			var $activeLabel = $activeOne.find('label');
			$activeLabel.text($activeLabel.text().replace('当前模版 - ',''));
				
			$toActiveBox.find('div.bg-graywhite')
							.removeClass('bg-graywhite')
							.addClass('active')
							.find('div.action')
							.remove();
			var $toActiveLabel = $toActiveBox.find('label');
			$toActiveLabel.text('当前模版 - '+$toActiveLabel.text());
				
				
			sortActiveOne();
				
		}
		var me = this;
		//submit 
		$picker.find('div.action a').live('click',function(e){
			e.preventDefault();
			$this = $(this);
				
			var theme = $this.data('theme');
			var themeName = $this.data('theme-name');
			var themeOptionName = $('input[name=zgw_page_theme_option_name]').val();
			var themeOptionType = $('input[name=zgw_page_theme_option_type]').val();
			var themeForPost = $('input[name=zgw_page_theme_post_id]').val();
				
			$.post(
					'admin-ajax.php',
					{
						"action":"zgw_change_theme",
						"zgw_page_theme_active" : theme,
						"zgw_page_theme_option_type":themeOptionType,
						"zgw_page_theme_option_name":themeOptionName,
						"zgw_page_theme_post_id":themeForPost
					},
					function(response){
						if(response == "1"){
							var $toActiveBox = $this.closest('li');
							alert("成功启用模版 - "+themeName);
							swap_active($toActiveBox);
							$.each(me.whenThemeChanged,function(){
								var callback = this;
								callback.call(me,theme);
							})
						}
						else{
							alert("出错了,模版启用失败！");
						}
						
					}
				)
				
			});
	}
}(window));

