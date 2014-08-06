
(function(){
	var $jq = jQuery;
	$jq(window).bind('load',function(){
		var $silderShow = $jq('div.svw');
		$silderShow.slideView();
		$silderShow.css('min-height',240);
		$silderShow.css('min-width',350);
	})

}());
