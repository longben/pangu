<?php
class WorkstationsController extends AppController {

	var $name = 'Workstations';
	var $helpers = array('Html', 'Form' , 'Ajax', 'JavaScript');

	function index() {
		$this->Workstation->recursive = 0;
		$this->set('workstations', $this->Workstation->findAll());
	}
	
	function audit() {
		$this->Workstation->recursive = 0;
		$this->set('workstations', $this->Workstation->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Workstation.');
			$this->redirect('/workstations/index');
		}
		$this->set('workstation', $this->Workstation->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			//$this->set('members', $this->Workstation->Member->generateList());
			$this->set('regions', $this->Workstation->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Workstation->save($this->data)) {
				$this->Session->setFlash('The Workstation has been saved');
				$this->redirect('/workstations/index');
			} else {
				$this->Session->setFlash('添加工作站出错，请检查错误！');
				$this->set('members', $this->Workstation->Member->generateList());
				$this->set('regions', $this->Workstation->Region->generateList());
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Workstation');
				$this->redirect('/workstations/index');
			}
			$this->data = $this->Workstation->read(null, $id);
			$this->set('members', $this->Workstation->Member->generateList());
			$this->set('regions', $this->Workstation->Region->generateList());
		} else {
			$this->cleanUpFields();
			if($this->Workstation->save($this->data)) {
				$this->Session->setFlash('The Workstation has been saved');
				$this->redirect('/workstations/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('members', $this->Workstation->Member->generateList());
				$this->set('regions', $this->Workstation->Region->generateList());
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Workstation');
			$this->redirect('/workstations/index');
		}
		if($this->Workstation->del($id)) {
			$this->Session->setFlash('The Workstation deleted: id '.$id.'');
			$this->redirect('/workstations/index');
		}
	}

}
?>