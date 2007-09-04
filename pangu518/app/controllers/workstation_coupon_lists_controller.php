<?php
class WorkstationCouponListsController extends AppController {

	var $name = 'WorkstationCouponLists';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->WorkstationCouponList->recursive = 0;
		$this->set('workstationCouponLists', $this->WorkstationCouponList->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Workstation Coupon List.');
			$this->redirect('/workstation_coupon_lists/index');
		}
		$this->set('workstationCouponList', $this->WorkstationCouponList->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->WorkstationCouponList->save($this->data)) {
				$this->Session->setFlash('The Workstation Coupon List has been saved');
				$this->redirect('/workstation_coupon_lists/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Workstation Coupon List');
				$this->redirect('/workstation_coupon_lists/index');
			}
			$this->data = $this->WorkstationCouponList->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->WorkstationCouponList->save($this->data)) {
				$this->Session->setFlash('The WorkstationCouponList has been saved');
				$this->redirect('/workstation_coupon_lists/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Workstation Coupon List');
			$this->redirect('/workstation_coupon_lists/index');
		}
		if ($this->WorkstationCouponList->del($id)) {
			$this->Session->setFlash('The Workstation Coupon List deleted: id '.$id.'');
			$this->redirect('/workstation_coupon_lists/index');
		}
	}

}
?>