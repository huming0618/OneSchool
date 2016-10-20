<?php

App::uses('BaseController', 'Controller');

class DonationController extends BaseController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set("pageAbout","Donation");
    }
    
    public function index() {
        
    }
}

?>
