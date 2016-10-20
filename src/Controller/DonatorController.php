<?php

App::uses('BaseController', 'Controller');

class DonatorController extends BaseController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set("pageAbout","Donator");
    }
    
    public function index() {
        
    }
    
    public function school($id){
        $school_donations = $this->Donation->find("all");
        $this->set("donations", $school_donations);
    }
}

?>
