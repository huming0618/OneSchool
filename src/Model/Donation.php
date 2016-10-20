<?php
    class Donation extends AppModel{
        public $belongsTo = array(
            "DonationSchool" => array(
                "className" => "School",
                "foreignKey" => "school_id"
            ),
            
            "DonationStudent" => array(
                "className" => "User",
                "foreignKey" => "student_id"
            ),
            
            "DonationDonator" => array(
                "className" => "User",
                "foreignKey" => "donator_id"
            )
        );
    }
?>
