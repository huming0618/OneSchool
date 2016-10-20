<?php
    App::uses('AppModel', 'Model');
    
    class BankAccount extends AppModel {
        public $useTable = "bankacts";
        
        
        public $hasMany = array(
            
        );
        
        public $validate = array(
            
        );
    }

?>