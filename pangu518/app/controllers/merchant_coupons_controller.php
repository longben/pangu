<?php
class MerchantCouponsController extends AppController {

	var $name = 'MerchantCoupons';
	var $helpers = array('Html', 'Form' );

	function index() {
		$user_id = $this->Session->read('User.id');
		$this->data = $this->MerchantCoupon->Merchant->findByUserId($user_id);
		if(empty($this->data)){
			$this->Session->setFlash('请先申请成立会员消费单位！');
			$this->redirect('/merchants/profile');
		}
		$this->MerchantCoupon->recursive = 0;
		
		//可用代金券
		$criteria = array(
		  'Merchant.user_id' => $this->Session->read('User.id'),
		  'MerchantCoupon.status' => 341
		);
		$this->set('total', $this->MerchantCoupon->findCount($criteria));
		
		//销售(返回给会员)
		$criteria = array(
		  'Merchant.user_id' => $this->Session->read('User.id'),
		  'MerchantCoupon.status' => 421
		);
		$this->set('total_sale', $this->MerchantCoupon->findCount($criteria));
				
		/**
		//参与分红抽奖
		$criteria = array(
		  'Merchant.user_id' => $this->Session->read('User.id'),
		  'MerchantCoupon.status' => 412
		);
		$this->set('total_melon_cutting', $this->MerchantCoupon->findCount($criteria));	
		*/

		//可用财富积点总数
		$sql = "select count(*) from merchant_vouchers where status = 341 and merchant_id = " . $this->data['Merchant']['id'];
		$v = $this->MerchantCoupon->findBySql($sql); 
		$this->set('total_usable', $v[0][0]['count(*)']);	

		
		//参与分红
		$sql = "select count(*) from merchant_vouchers where status = 412 and merchant_id = " . $this->data['Merchant']['id'];
		$v = $this->MerchantCoupon->findBySql($sql); 
		$this->set('total_melon_cutting', $v[0][0]['count(*)']);	
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