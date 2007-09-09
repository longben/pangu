<?php
class MerchantCouponList extends AppModel {

	var $name = 'MerchantCouponList';

	var $belongsTo = array(
			'Merchant' =>
				array('className' => 'Merchant',
						'foreignKey' => 'merchant_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Workstation' =>
				array('className' => 'Workstation',
						'foreignKey' => 'workstation_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>