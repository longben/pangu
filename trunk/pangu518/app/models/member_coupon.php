<?php
class MemberCoupon extends AppModel {

	var $name = 'MemberCoupon';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Member' =>
				array('className' => 'Member',
						'foreignKey' => 'member_id',
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

	);

}
?>