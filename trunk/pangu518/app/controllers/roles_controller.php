<?php
class RolesController extends AppController {

	var $name = 'Roles';
	var $helpers = array('Html', 'Form', 'Habtm');

	function index() {
		$this->Role->recursive = 0;
		$this->set('roles', $this->Role->findAll());
	}

	function left(){
		$id = $this->Session->read('User.role_id');
		if (!$id && $id!=0) {
			$this->Session->setFlash('无效请求.');
			$this->redirect('/admin');
		}
		$this->set('role', $this->Role->read(null, $id));
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

            
			$this->set('modules', $this->Role->Module->generateList(
			  $conditions = null,
			  $order = 'Module.id',
			  $limit = null,
			  $keyPath = '{n}.Module.id',
			  $valuePath = '{n}.Module.module_name')
			);
			

            /*
			$this->set('modules', $this->Role->Module->generateList4TreeData(
			  $conditions = null,
			  $order = 'id',
			  $limit = null,
			  $keyPath = '{n}.Module.id',
			  $valuePath = '{n}.Module.module_name')
			);
			*/

			//$this->set('modules', $this->Role->Module->findAllThreaded(null,null,'id'));

			$this->set('selectedModules', null);
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Role->save($this->data)) {
				$this->Session->setFlash('角色保存成功.');
				$this->redirect('/roles/index');
			} else {
				$this->Session->setFlash('请检查下面的错误.');
				$this->set('modules', $this->Role->Module->generateList(
				  $conditions = null,
				  $order = null,
				  $limit = null,
				  $keyPath = '{n}.Module.id',
				  $valuePath = '{n}.Module.module_name')
				);

				if (empty($this->data['Module']['Module'])) { $this->data['Module']['Module'] = null; }
				$this->set('selectedModules', $this->data['Module']['Module']);
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
			$this->set('modules', $this->Role->Module->generateList(
			  $conditions = null,
			  $order = null,
			  $limit = null,
			  $keyPath = '{n}.Module.id',
			  $valuePath = '{n}.Module.module_name')
			);

			if (empty($this->data['Module'])) { $this->data['Module'] = null; }
			$this->set('selectedModules', $this->_selectedArray($this->data['Module']));
		} else {
			$this->cleanUpFields();
			if ($this->Role->save($this->data)) {
				$this->Session->setFlash('角色修改成功.');
				$this->redirect('/roles/index');
			} else {
				$this->Session->setFlash('请检查下面的错误.');
				$this->set('modules', $this->Role->Module->generateList(
				  $conditions = null,
				  $order = null,
				  $limit = null,
				  $keyPath = '{n}.Module.id',
				  $valuePath = '{n}.Module.module_name')
				);
				if (empty($this->data['Module']['Module'])) { $this->data['Module']['Module'] = null; }
				$this->set('selectedModules', $this->data['Module']['Module']);
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Role');
			$this->redirect('/roles/index');
		}
		if ($this->Role->del($id)) {
			$this->Session->setFlash('角色删除成功.');
			$this->redirect('/roles/index');
		}
	}

}
?>