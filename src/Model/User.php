<?php
	App::uses('AppModel', 'Model');
	
	class User extends AppModel {
        
        public $hasMany = array(
            "BankAccount" => array(
                "className" => "BankAccount",
                "foreignKey" => "user_id",
                "order" => "BankAccount.id"
            ),
            
            "Contact" => array(
                "className" => "Contact",
                "foreignKey" => "user_id",
                "order" => "Contact.id"
            ),
            
            "StudentDonation" => array(
                "className" => "ViewDonation",
                "foreignKey" => "student_id",
                "order" => "StudentDonation.id DESC"
            ),
            
            "MyDonation" => array(
                "className" => "ViewDonation",
                "foreignKey" => "donator_id",
                "order" => "MyDonation.id DESC"
            )
        );
        
		public $validate = array(
	        'username' => array(
	            'required' => array(
	                'rule' => array('notEmpty'),
	                'message' => 'A username is required'
	            )
	        ),
            'password' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A password is required'
                )
            ),
            'role' => array(
                'valid' => array(
                    'rule' => array('inList', array('admin', 'author')),
                    'message' => 'Please enter a valid role',
                    'allowEmpty' => false
                )
            )
    );
}

?>