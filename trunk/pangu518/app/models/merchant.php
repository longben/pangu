<?php
class Merchant extends AppModel {

	var $name = 'Merchant';

	var $belongsTo = array(
			'Member' =>
				array('className' => 'Member',
						'foreignKey' => 'member_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Industry' =>
				array('className' => 'Industry',
						'foreignKey' => 'industry_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Region' =>
				array('className' => 'Region',
						'foreignKey' => 'region_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	var $hasMany = array(
			'LotteryBetting' =>
				array('className' => 'LotteryBetting',
						'foreignKey' => 'merchant_id',
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

			'MerchantComplaintLog' =>
				array('className' => 'MerchantComplaintLog',
						'foreignKey' => 'merchant_id',
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
						'foreignKey' => 'merchant_id',
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