<?php

App::uses('BaseController', 'Controller');

class UserController extends BaseController {
	
	public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('add');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('用户不存在'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('用户已经被保存'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('无法保存')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('用户不存在'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('用户已被保存'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('无法保存')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            //unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('用户不存在'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('用户已被删除'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('用户未被删除'));
        return $this->redirect(array('action' => 'index'));
    }
	
	
}
