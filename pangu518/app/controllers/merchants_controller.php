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
			$this->set('users', $this->Merchant->User->generateList());
			$this->set('industries', $this->Merchant->Industry->generateList());
			$this->set('regions', $this->Merchant->Region->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Merchant->save($this->data)) {
				$this->Session->setFlash('The Merchant has been saved');
				$this->redirect('/merchants/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->Merchant->User->generateList());
				$this->set('industries', $this->Merchant->Industry->generateList());
				$this->set('regions', $this->Merchant->Region->generateList());
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
			$this->set('users', $this->Merchant->User->generateList());
			$this->set('industries', $this->Merchant->Industry->generateList());
			$this->set('regions', $this->Merchant->Region->generateList());
		} else {
			$this->cleanUpFields();
			if($this->Merchant->save($this->data)) {
				$this->Session->setFlash('The Merchant has been saved');
				$this->redirect('/merchants/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->Merchant->User->generateList());
				$this->set('industries', $this->Merchant->Industry->generateList());
				$this->set('regions', $this->Merchant->Region->generateList());
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
	
	function profile() {
		$user_id = $this->Session->read('User.uid');
		$this->set('user_id',$user_id);
		if(empty($this->data)) {
			if(!$user_id) {
				$this->Session->setFlash('Invalid id for Merchant');
				$this->redirect('/merchants/profile');
			}
			$this->data = $this->Merchant->findByUserId($user_id);
			$this->set('industries', $this->Merchant->Industry->generateList(
			             $conditions = 'Industry.flag = 1',
			             $order = 'Industry.id',
			             $limit = null,
			             $keyPath = '{n}.Industry.id',
			             $valuePath = '{n}.Industry.industry_name')
			);
			$this->set('regions', $this->Merchant->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->Merchant->save($this->data)) {
				$this->Session->setFlash('会员消费单位资料保存成功！');
				$this->redirect('/merchants/profile');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->Merchant->User->generateList());
				$this->set('industries', $this->Merchant->Industry->generateList());
				$this->set('regions', $this->Merchant->Region->generateList());
			}
		}

	}

}
?>