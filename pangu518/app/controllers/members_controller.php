<?php
class MembersController extends AppController {

	var $name = 'Members';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Member->recursive = 0;
		$this->set('members', $this->Member->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Member.');
			$this->redirect('/members/index');
		}
		$this->set('member', $this->Member->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Member->save($this->data)) {
				$this->Session->setFlash('The Member has been saved');
				$this->redirect('/members/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Member');
				$this->redirect('/members/index');
			}
			$this->data = $this->Member->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Member->save($this->data)) {
				$this->Session->setFlash('The Member has been saved');
				$this->redirect('/members/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Member');
			$this->redirect('/members/index');
		}
		if($this->Member->del($id)) {
			$this->Session->setFlash('The Member deleted: id '.$id.'');
			$this->redirect('/members/index');
		}
	}

}
?>