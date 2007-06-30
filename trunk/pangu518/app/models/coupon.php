<?php
class Coupon extends AppModel {

	var $name = 'Coupon';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
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

}
?>