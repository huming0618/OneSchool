<?php

App::uses('AppController', 'Controller');
class BaseController extends AppController {
	public function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow();
    }
	
	public function beforeRender() {
		$this->layout = 'home_layout';
    	$this->set('title_for_layout', "一村小 捐助管理");
	}
}
?>