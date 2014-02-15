//To-do: convert to Boo
window.menu_config = {
	"admin" : [
		{
			id:"menu_user_m", 
			text : "用户管理", 
			index : 0,
			submenu : [
				{id:"submenu_user_m_list", text : "用户列表", svc:'user/list', icon:'glyphicon-list'},
				{id:"submenu_user_m_add", text : "添加用户", svc:'user/add', icon:'glyphicon-plus-sign'},
				{id:"submenu_user_m_del", text : "删除用户", svc:'user/delete', icon:'glyphicon-remove-circle'},
				{id:"submenu_user_m_right", text : "更改权限", svc:'user/changeright', icon:'glyphicon-tasks'},
			]
		},
		{
			id:"menu_product_m", 
			text : "产品管理", 
			index : 1,
			submenu : [
				{id:"submenu_product_m_list", text : "产品列表"},
				{id:"submenu_product_m_add", text : "添加产品"},
				{id:"submenu_product_m_deleteuser", text : "删除产品"},
				{id:"submenu_product_m_price", text : "更改价格"},
			]
		},
		{
			id:"menu_wechat_m", 
			text : "微信管理", 
			index : 3,
			submenu : [
				{id:"submenu_wechat_m_menu", text : "菜单管理"},
				{id:"submenu_product_m_login", text : "登录更改"}
			]
		}
	],
	"super" : [
		{
			id:"menu_log_m", 
			text : "日志管理", 
			index : 10,
			submenu : [
				{id:"submenu_log_m", text : "所有日志", svc:'log/list'},
				{id:"submenu_log_m", text : "用户相关", svc:'log/user'},
				{id:"submenu_log_m", text : "安全相关", svc:'log/security'},
				{id:"submenu_log_m", text : "管理相关", svc:'log/management'},
				{id:"submenu_log_m", text : "业务相关", svc:'log/business'}
			]
		},
		{
			id:"menu_sysadmin_m", 
			text : "系统管理", 
			index : 11,
			submenu : [
				{id:"submenu_sysadmin_m_admins", text : "管理员列表"},
				{id:"submenu_sysadmin_m_admins_add", text : "添加管理员"},
				{id:"submenu_sysadmin_m_admins_delete", text : "删除管理员"},
				{id:"submenu_sysadmin_m_admins_change", text : "系统备份"},
			]
		},
		{
			id:"menu_report_m", 
			text : "业务分析", 
			index : 2,
			submenu : [
				{id:"submenu_report_distribution", text : "销售排行"},
				{id:"submenu_report_ac", text : "防伪报告"}
			]
		}
	]
}
