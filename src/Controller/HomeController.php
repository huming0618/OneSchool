<?php

App::uses('BaseController', 'Controller');

class HomeController extends BaseController {
	public function beforeFilter() {
	    parent::beforeFilter();
		$this->set("pageAbout","Home");
	}
	
	public function index() {
	    
	}
	
}

?>
