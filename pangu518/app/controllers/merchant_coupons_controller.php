<?php
class MerchantCouponsController extends AppController {

	var $name = 'MerchantCoupons';
	var $helpers = array('Html', 'Form' );

	function index() {
		$user_id = $this->Session->read('User.uid');
		$this->data = $this->MerchantCoupon->Merchant->findByUserId($user_id);
		if(empty($this->data)){
			$this->Session->setFlash('请先申请成立会员消费单位！');
			$this->redirect('/merchants/profile');
		}
		$this->MerchantCoupon->recursive = 0;
		
		//统计查询条件
		//可用代金券
		$criteria = array(
		  'Merchant.user_id' => $this->Session->read('User.uid'),
		  'MerchantCoupon.status' => 341
		);
		$this->set('total', $this->MerchantCoupon->findCount($criteria));
		
		//参与分红抽奖
		$criteria = array(
		  'Merchant.user_id' => $this->Session->read('User.uid'),
		  'MerchantCoupon.status' => 421
		);
		$this->set('total2', $this->MerchantCoupon->findCount($criteria));		
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Merchant Coupon.');
			$this->redirect('/merchant_coupons/index');
		}
		$this->set('merchantCoupon', $this->MerchantCoupon->read(null, $id));
	}
	

	function add($workstation_id=null,$merchant_id=null,$sum=null) {
		
	}

	function add2() {
		if(empty($this->data)) {
			$this->set('merchants', $this->MerchantCoupon->Merchant->generateList());
			$this->set('workstations', $this->MerchantCoupon->Workstation->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->MerchantCoupon->save($this->data)) {
				$this->Session->setFlash('The Merchant Coupon has been saved');
				$this->redirect('/merchant_coupons/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('merchants', $this->MerchantCoupon->Merchant->generateList());
				$this->set('coupons', $this->MerchantCoupon->Coupon->generateList());
				$this->set('workstations', $this->MerchantCoupon->Workstation->generateList());
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Merchant Coupon');
				$this->redirect('/merchant_coupons/index');
			}
			$this->data = $this->MerchantCoupon->read(null, $id);
			$this->set('merchants', $this->MerchantCoupon->Merchant->generateList());
			$this->set('coupons', $this->MerchantCoupon->Coupon->generateList());
			$this->set('workstations', $this->MerchantCoupon->Workstation->generateList());
		} else {
			$this->cleanUpFields();
			if($this->MerchantCoupon->save($this->data)) {
				$this->Session->setFlash('The MerchantCoupon has been saved');
				$this->redirect('/merchant_coupons/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('merchants', $this->MerchantCoupon->Merchant->generateList());
				$this->set('coupons', $this->MerchantCoupon->Coupon->generateList());
				$this->set('workstations', $this->MerchantCoupon->Workstation->generateList());
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Merchant Coupon');
			$this->redirect('/merchant_coupons/index');
		}
		if($this->MerchantCoupon->del($id)) {
			$this->Session->setFlash('The Merchant Coupon deleted: id '.$id.'');
			$this->redirect('/merchant_coupons/index');
		}
	}

}
?>