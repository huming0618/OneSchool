<?php
    if  ($session->check('Message.auth')) $session->flash('auth');  // If authentication message it exist it will be displayed
    echo $form->create('User', array('action' => 'login')); // creating user form with 2 fields email and password
    echo $form->input('email');
    echo $form->input('password');
    echo $form->end('Login');
?>