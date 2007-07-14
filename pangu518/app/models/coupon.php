<?php
class Coupon extends AppModel {

	var $name = 'Coupon';

	var $hasMany = array(
			'MemberCoupon' =>
				array('className' => 'MemberCoupon',
						'foreignKey' => 'coupon_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'MerchantCoupon' =>
				array('className' => 'MerchantCoupon',
						'foreignKey' => 'coupon_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'WorkstationCoupon' =>
				array('className' => 'WorkstationCoupon',
						'foreignKey' => 'coupon_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);

	function getGroupByStatus(){
		$sql = "select distinct Coupon.coupon_group,Coupon.custom_num,Coupon.status
		  from coupons as Coupon 
		    where Coupon.status = 0 order by Coupon.coupon_group,Coupon.created";
		return $this->query($sql);
	}
	
	/**
	 * 更新代金券状态
	 *
	 * @param unknown_type $coupon_group
	 * @return unknown
	 */
	function updateStatusByGroup($coupon_group=null,$custom_num=null){
		if($coupon_group!=null && $custom_num != null){
			$sql = "update coupons as Coupon set Coupon.status = 113
			  where Coupon.coupon_group = '$coupon_group'
			    and Coupon.custom_num = $custom_num
			     and Coupon.status = 0";
			return $this->query($sql);
		}
	}

}
?>