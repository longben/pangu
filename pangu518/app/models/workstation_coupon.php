<?php
class WorkstationCoupon extends AppModel {

	var $name = 'WorkstationCoupon';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Workstation' =>
				array('className' => 'Workstation',
						'foreignKey' => 'workstation_id',
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