<?php
class UserCouponsController extends AppController {

	var $name = 'UserCoupons';
	var $helpers = array('Html', 'Form','Javascript','Ajax' );

	function index() {
		$this->UserCoupon->recursive = 0;
		$this->set('userCoupons', $this->UserCoupon->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for User Coupon.');
			$this->redirect('/user_coupons/index');
		}
		$this->set('userCoupon', $this->UserCoupon->read(null, $id));
	}

	function input() {
		$criteria = array(
		  'UserCoupon.user_id' => $this->Session->read('User.id'),
		  'UserCoupon.status' => 421
		);
		$available_capital = $this->UserCoupon->findCount($criteria);
		
		$criteria = array(
		  'UserCoupon.user_id' => $this->Session->read('User.id'),
		  'UserCoupon.status' => 212
		);		
		$expenditure = $this->UserCoupon->findCount($criteria);
				
		$this->set('available_capital', $available_capital);
		$this->set('expenditure', $expenditure);

		if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			//检查代金券有效性，返回0表示无效。非0表示有效
			$coupon_id = $this->UserCoupon->Coupon->verify($this->data['Coupon']['coupon_no'],$this->data['Coupon']['coupon_pwd']);
			if($coupon_id!=0){
			    $coupon = $this->UserCoupon->Coupon->read(null,$coupon_id);
				$this->data['UserCoupon']['coupon_id'] = $coupon_id;
				$this->data['UserCoupon']['status'] = 421;
				$this->data['UserCoupon']['user_id'] = $this->Session->read('User.id');
				$this->data['UserCoupon']['merchant_id'] = 1;
				
				
				if($this->UserCoupon->save($this->data)) {
					$this->UserCoupon->updateMerchantCouponStatus($this->Session->read('User.id'),$coupon_id);
					$this->Session->setFlash('代金券录入成功！');
					$this->redirect('/user_coupons/input');
				} else {
					$this->Session->setFlash('代金券录入不成功！');
				}
			}else{
				$this->Session->setFlash('不是有效的代金券，请检查代金券编号和密码是否正确录入。');
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for User Coupon');
				$this->redirect('/user_coupons/index');
			}
			$this->data = $this->UserCoupon->read(null, $id);
			$this->set('users', $this->UserCoupon->User->generateList());
			$this->set('coupons', $this->UserCoupon->Coupon->generateList());
		} else {
			$this->cleanUpFields();
			if($this->UserCoupon->save($this->data)) {
				$this->Session->setFlash('The UserCoupon has been saved');
				$this->redirect('/user_coupons/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->UserCoupon->User->generateList());
				$this->set('coupons', $this->UserCoupon->Coupon->generateList());
			}
		}
	}

}
?>