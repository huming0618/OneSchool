<?php
    class School extends AppModel{
        public $hasMany = array(
            "SchoolDonation" => array(
                "className" => "ViewDonation",
                "foreignKey" => "school_id",
                "order" => "SchoolDonation.student_id"
            ),
            
            "SchoolSchedules" => array(
                "className" => "SchoolSchedules",
                "foreignKey" => "school_id",
                "order" => "SchoolSchedules.startdate"
            ),
            
            "SchoolFeedbacks" => array(
                "className" => "Feedback",
                "foreignKey" => "school_id",
                "order" => "SchoolFeedbacks.submit_on DESC"
            )
        );
    }
