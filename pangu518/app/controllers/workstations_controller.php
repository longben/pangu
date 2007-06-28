<?php
class WorkstationsController extends AppController {

	var $name = 'Workstations';
	var $helpers = array('Html', 'Form' );

	function index() {
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
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Workstation->save($this->data)) {
				$this->Session->setFlash('The Workstation has been saved');
				$this->redirect('/workstations/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
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
		} else {
			$this->cleanUpFields();
			if($this->Workstation->save($this->data)) {
				$this->Session->setFlash('The Workstation has been saved');
				$this->redirect('/workstations/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
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