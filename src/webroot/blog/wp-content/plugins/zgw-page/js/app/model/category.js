(function(model){
	model.category = Backbone.Model.extend({
		defaults: {
            name: '',
            _blog : ''
        },
        initialize: function(){
        }
    });
}(window.zgwApp.model))
