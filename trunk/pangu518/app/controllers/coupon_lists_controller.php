<?php
class CouponListsController extends AppController {

	var $name = 'CouponLists';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->CouponList->recursive = 0;
		$this->set('couponLists', $this->CouponList->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Coupon List.');
			$this->redirect('/coupon_lists/index');
		}
		$this->set('couponList', $this->CouponList->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->CouponList->save($this->data)) {
				$this->Session->setFlash('The Coupon List has been saved');
				$this->redirect('/coupon_lists/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Coupon List');
				$this->redirect('/coupon_lists/index');
			}
			$this->data = $this->CouponList->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->CouponList->save($this->data)) {
				$this->Session->setFlash('The CouponList has been saved');
				$this->redirect('/coupon_lists/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Coupon List');
			$this->redirect('/coupon_lists/index');
		}
		if ($this->CouponList->del($id)) {
			$this->Session->setFlash('The Coupon List deleted: id '.$id.'');
			$this->redirect('/coupon_lists/index');
		}
	}

}
?>