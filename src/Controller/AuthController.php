<?php

App::uses('BaseController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class AuthController extends BaseController {
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    // Allow users to register and logout.
	    $this->Auth->allow('logout');
	}
	
	public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            return $this->redirect($this->Auth->redirect());
	        }
	        $this->Session->setFlash(__('用户名或密码错误'));
	    }
	}
	
	public function logout() {
	    return $this->redirect($this->Auth->logout());
	}

	public function beforeSave($options = array()) {
		//hash password
	    if (isset($this->data[$this->alias]['pwd'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['pwd'] = $passwordHasher->hash(
	            $this->data[$this->alias]['pwd']
	        );
	    }
	    return true;
	}
	
}
