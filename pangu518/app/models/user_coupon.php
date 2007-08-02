<?php
class UserCoupon extends AppModel {

	var $name = 'UserCoupon';
	
	var $belongsTo = array(
			'User' =>
				array('className' => 'User',
						'foreignKey' => 'user_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Coupon' =>
				array('className' => 'Coupon',
						'foreignKey' => 'coupon_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
				
			'Merchant' =>
				array('className' => 'Merchant',
						'foreignKey' => 'merchant_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),
	);
	
	function updateMerchantCouponStatus($user_id = null,$coupon_id = null){
		$merchant = "update merchant_coupons set status = 421 where coupon_id = $coupon_id and status = 341";
		$this->execute($merchant);
	}

}
?>