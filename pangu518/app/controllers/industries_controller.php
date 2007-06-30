<?php
class IndustriesController extends AppController {

	var $name = 'Industries';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Industry->recursive = 0;
		$this->set('industries', $this->Industry->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Industry.');
			$this->redirect('/industries/index');
		}
		$this->set('industry', $this->Industry->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Industry->save($this->data)) {
				$this->Session->setFlash('行业信息添加成功！');
				$this->redirect('/industries/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Industry');
				$this->redirect('/industries/index');
			}
			$this->data = $this->Industry->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Industry->save($this->data)) {
				$this->Session->setFlash('The Industry has been saved');
				$this->redirect('/industries/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Industry');
			$this->redirect('/industries/index');
		}
		if($this->Industry->del($id)) {
			$this->Session->setFlash('The Industry deleted: id '.$id.'');
			$this->redirect('/industries/index');
		}
	}

}
?>