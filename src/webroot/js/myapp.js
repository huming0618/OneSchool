(function(window){
	var userModel = Backbone.Model.extend({idAttribute: "userId"});


	var svcProxy = function(svcName){
		var svcMeta = svc_config[svcName];
		if(typeof url == undefined){
			return null;
		}
		var url = svcMeta.url;
		var way = svcMeta.method;

		this.getJson = function(params){
			return $.ajax({url : url, data : params})
		}
	}

	var menuModel = Backbone.Model.extend();

	var menuCollection = Backbone.Collection.extend({
	    model: menuModel,
	    comparator: function(item) {
	        return item.get('index');
	    }
	});

	var menuView = Backbone.View.extend({
    	el: $('#mainmenu'),
    	initialize: function() {
	    },
	    render: function(menus,activeMenu) {
	        var tpl = _.template(
	        	$("#tpl_menu").html(), 
	        	{
	        		menus: menus,
		        	active: ''
	        	});
			//console.log(rate_select_template);
	        $('#mainmenu').html(tpl);
	    }
	});

	var subMenuView = Backbone.View.extend({
    	el: $('#main_panel'),
    	initialize: function() {
	    },
	    render: function(submenus) {
	        var tpl = _.template(
	        	$("#tpl_submenu").html(), 
	        	{
	        		menus: submenus,
	        	});
			//console.log(rate_select_template);
	        $('#main_panel').append(tpl);
	    }
	});

	window.clientApp = function(){
		this.user = undefined;
	}

	clientApp.prototype = {
		initHomePage : function($box){
			var app = this;
			var svc = new svcProxy("MySession");
			svc.getJson().done(function(data){
				app.user = new userModel(data);
				var roles = app.user.get("Roles");
				var menus = new menuCollection();

				_.each(roles,function(role){
					var menuMeta = window.menu_config[role.toLowerCase()];
					if(!_.isUndefined(menuMeta)){
						menus.add(menuMeta);
					}
				});

				menus = menus.sort();
				var menuPart = new menuView();
				menuPart.render(menus);

				var submenusMeta = menus.at(0).get('submenu');
				var submenus = new menuCollection();
				submenus.add(submenusMeta);

				var submenuPart = new subMenuView();
				submenuPart.render(submenus);

				$('#nav_username').html(app.user.get('Name'));
			});
		}
	}

}(window))