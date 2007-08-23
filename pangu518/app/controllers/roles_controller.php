<?php
class RolesController extends AppController {

	var $name = 'Roles';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Role->recursive = 0;
		$this->set('roles', $this->Role->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Role.');
			$this->redirect('/roles/index');
		}
		$this->set('role', $this->Role->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Role->save($this->data)) {
				$this->Session->setFlash('角色保存成功!');
				$this->redirect('/roles/index');
			} else {
				$this->Session->setFlash('角色保存失败，请检查下面错误.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Role');
				$this->redirect('/roles/index');
			}
			$this->data = $this->Role->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Role->save($this->data)) {
				$this->Session->setFlash('角色修改保存成功!');
				$this->redirect('/roles/index');
			} else {
				$this->Session->setFlash('角色修改保存失败，请检查下面错误.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Role');
			$this->redirect('/roles/index');
		}
		if ($this->Role->del($id)) {
			$this->Session->setFlash('角色删除成功!');
			$this->redirect('/roles/index');
		}
	}

}
?>