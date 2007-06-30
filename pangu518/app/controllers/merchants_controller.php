<?php
class MerchantsController extends AppController {

	var $name = 'Merchants';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Merchant->recursive = 0;
		$this->set('merchants', $this->Merchant->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Merchant.');
			$this->redirect('/merchants/index');
		}
		$this->set('merchant', $this->Merchant->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->set('members', $this->Merchant->Member->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Merchant->save($this->data)) {
				$this->Session->setFlash('The Merchant has been saved');
				$this->redirect('/merchants/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('members', $this->Merchant->Member->generateList());
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Merchant');
				$this->redirect('/merchants/index');
			}
			$this->data = $this->Merchant->read(null, $id);
			$this->set('members', $this->Merchant->Member->generateList());
		} else {
			$this->cleanUpFields();
			if($this->Merchant->save($this->data)) {
				$this->Session->setFlash('The Merchant has been saved');
				$this->redirect('/merchants/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('members', $this->Merchant->Member->generateList());
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Merchant');
			$this->redirect('/merchants/index');
		}
		if($this->Merchant->del($id)) {
			$this->Session->setFlash('The Merchant deleted: id '.$id.'');
			$this->redirect('/merchants/index');
		}
	}

}
?>