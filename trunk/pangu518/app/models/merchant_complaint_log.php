<?php
class MerchantComplaintLog extends AppModel {

	var $name = 'MerchantComplaintLog';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Merchant' =>
				array('className' => 'Merchant',
						'foreignKey' => 'merchant_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Member' =>
				array('className' => 'Member',
						'foreignKey' => 'member_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>