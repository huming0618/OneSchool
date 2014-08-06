(function(window){
	window.zgwApp.picker = function(blog){
		this.blog = blog;
		this.type = "*";
		this.format = "*";
	}
	
	window.zgwApp.picker.prototype.show = function(){
		
	}
	
	window.zgwApp.picker.prototype.changeBlog = function(blog){
		this.blog = blog;
	}
	
	window.zgwApp.picker.prototype.changeContentFormat = function(format){
		this.format = format;
	}
	
	
	window.zgwApp.picker.prototype.changeType = function(type){
		this.type = type;
	}
	
	window.zgwApp.contentAgent = function(query){
		
	}
	
	window.zgwApp.contentAgent.get = function(callback){
		
	}
	
	
}(window));
