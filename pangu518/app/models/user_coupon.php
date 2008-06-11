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
		$merchant = "update merchant_coupons
          set status = 421 where coupon_id = $coupon_id and status = 341";
        $this->execute($merchant);

		$user_coupon = "update user_coupons
          set merchant_id = (select merchant_id from merchant_coupons where coupon_id = $coupon_id)";
		$this->execute($user_coupon);

		$coupon = "update coupons set status = 421 where id = $coupon_id";
		$this->execute($coupon);
	}

	/*
	 * 提现积点
	 */
	function findCashIn($user_id = null, $cash_in_date = null){
		$sql = "select sum(timo) from cotmoney AS Cotmoney where ctnid=$user_id and DATE_FORMAT(crmy,'%Y-%m-%d')='$cash_in_date' and flag=1";
		$rs = $this->query($sql);
		return $rs[0][0]['sum(timo)'];
	}

}
?>