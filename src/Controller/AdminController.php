<?php

App::uses('BaseController', 'Controller');

class AdminController extends BaseController {
	public function beforeFilter() {
	    parent::beforeFilter();
	
	}
	
	public function index() {
	    
	}
	
	public function manageUsers(){
		$this->render('user_list');
	}
	
	
}
