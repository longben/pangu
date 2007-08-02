<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form','Javascript' );

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->User->findAll('User.id <> 1'));
	}
	
   function invite() {
   	  $this->layout='jiwai';
   }	

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for User.');
			$this->redirect('/users/index');
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->set('memberGrades', $this->User->MemberGrade->generateList());
			$this->set('regions', $this->User->Region->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->User->save($this->data)) {
				$this->Session->setFlash('The User has been saved');
				$this->redirect('/users/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('memberGrades', $this->User->MemberGrade->generateList());
				$this->set('regions', $this->User->Region->generateList());
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for User');
				$this->redirect('/users/index');
			}
			$this->data = $this->User->read(null, $id);
			$this->set('memberGrades', $this->User->MemberGrade->generateList());
			$this->set('regions', $this->User->Region->generateList());
		} else {
			$this->cleanUpFields();
			if($this->User->save($this->data)) {
				$this->Session->setFlash('The User has been saved');
				$this->redirect('/users/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('memberGrades', $this->User->MemberGrade->generateList());
				$this->set('regions', $this->User->Region->generateList());
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for User');
			$this->redirect('/users/index');
		}
		if($this->User->del($id)) {
			$this->Session->setFlash('The User deleted: id '.$id.'');
			$this->redirect('/users/index');
		}
	}
	
	function init($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for User');
			$this->redirect('/members/index');
		}
		
		if($this->User->del($id)) {
			$this->Session->setFlash('The User deleted: id '.$id.'');
			$this->redirect('/users/index');
		}
	}
	
   function performance($id = null) {
   }

}
?>