<?php
class RoleModulesController extends AppController {

	var $name = 'RoleModules';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->RoleModule->recursive = 0;
		$this->set('roleModules', $this->RoleModule->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Role Module.');
			$this->redirect('/role_modules/index');
		}
		$this->set('roleModule', $this->RoleModule->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->RoleModule->save($this->data)) {
				$this->Session->setFlash('The Role Module has been saved');
				$this->redirect('/role_modules/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Role Module');
				$this->redirect('/role_modules/index');
			}
			$this->data = $this->RoleModule->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->RoleModule->save($this->data)) {
				$this->Session->setFlash('The RoleModule has been saved');
				$this->redirect('/role_modules/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Role Module');
			$this->redirect('/role_modules/index');
		}
		if ($this->RoleModule->del($id)) {
			$this->Session->setFlash('The Role Module deleted: id '.$id.'');
			$this->redirect('/role_modules/index');
		}
	}

}
?>