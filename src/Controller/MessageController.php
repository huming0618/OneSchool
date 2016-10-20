<?php

App::uses('BaseController', 'Controller');

class MessageController extends BaseController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set("pageAbout","Message");
    }
    
    public function index() {
        
    }
    
}

?>
