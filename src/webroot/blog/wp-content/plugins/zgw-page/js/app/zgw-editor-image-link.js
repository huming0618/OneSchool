(function(z){
	z.ext('editor').as('imageLinkEditor',function($form){
		zgw.imageLinkEditor.superclass.constructor.call(this,$form);
	},{
		init:function(){
			zgw.imageLinkEditor.superclass.init.call(this);
			this.$form.find('button[data-for="pick-image"]').on('click',function(e){
				e.preventDefault();
				//get model
				//new dialog
				//render dialogs
				
				
			});
		}
	});
}(zgw));
