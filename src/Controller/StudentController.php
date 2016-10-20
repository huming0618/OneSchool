<?php

App::uses('BaseController', 'Controller');

class StudentController extends BaseController {
    var $uses = array('User');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set("pageAbout","Student");
    }
    
    public function index() {
        
    }
    
    public function quickview($id){
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->loadModel('User', $id);
        $student = $this->User->read();
        if (!$student) {
            throw new NotFoundException(__('Invalid post'));
        }
        $portrait_photo = Configure::read('app.portrait_folder')."/".$id.".jpg";
        $this->set("student", $student);
        $this->set("student_portrait", $portrait_photo);
    }
}

?>
