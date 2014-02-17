<?php

App::uses('AppController', 'Controller');

class BaseController extends AppController {
	￼public function beforeFilter() {
		parent::beforeFilter();
		//authentication is required
		if($this->Auth->user('id')){
			
		}
		else{
			$this->render('/login');
		}
	}
}
