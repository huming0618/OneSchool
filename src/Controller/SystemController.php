<?php

App::uses('BaseController', 'Controller');

class SystemController extends BaseController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set("pageAbout","System");
    }
    
    public function index() {
        
    }
    
}

?>
