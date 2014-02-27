<?php
	App::uses('AppModel', 'Model');
	
	class Auth extends AppModel {
		public $useTable = 'auth';
		public $hasOne = "User";
	}

?>