(function(z){
	z.create('editor',function($form){
		this.$form = $form;
		this.init();
	},{
		init : function(){
			var optionJson = this.$form.find('input[data-for="option"]').val();
			if(!zgw.isEmpty(optionJson)){
				this._originalOption = JSON.parse(optionJson);
				this.model = new z.model.option(this._originalOption);
			}
			else{
				this.model = new z.model.option();
			}
			
			this.view = new z.view.editor({el:this.$form});
			
		},
		
		submit:function(){
			
		}
	});
	
	z.editor.create = function($form,type){
		if(type == 'image-link'){
			return new z.imageLinkEditor($form);
		}
		return new z.editor($form);
	}
}(zgw));
