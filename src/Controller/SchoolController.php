<?php

App::uses('BaseController', 'Controller');

class SchoolController extends BaseController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set("pageAbout","School");
    }
    
    public function index() {
        $this->set("schools", $this->School->find("all"));
    }
    
    public function detail($id = null){
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $school = $this->School->findById($id);
        if (!$school) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set("school", $school);
    }
   
}

?>
