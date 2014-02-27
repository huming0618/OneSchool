	<?php
	App::uses('AppModel', 'Model');
	
	class UserRole extends AppModel {
		public $useTable = 'user_role';
		public $hasOne = "User";
		
	}

?>