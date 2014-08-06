(function(){
	var $ = jQuery;
	$(document).ready(function(e){
		var $themeMetaBox = $('div#channel_page_meta_box_theme');
		var $themePicker = $themeMetaBox.find('select[name=theme]');
		
		$themePicker.on('change',function(){
			var theme = this.value;
			//console.log(theme);
		});
	})

}())

