<?php
class Workstation extends AppModel {

	var $name = 'Workstation';
	
	var $validate = array(
		'ws_name' => VALID_NOT_EMPTY
	);

	var $belongsTo = array(
			'Member' =>
				array('className' => 'Member',
						'foreignKey' => 'member_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'MemberInfo' =>
				array('className' => 'MemberInfo',
						'foreignKey' => 'member_id',
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
			'MerchantCoupon' =>
				array('className' => 'MerchantCoupon',
						'foreignKey' => 'workstation_id',
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

			'WorkstationAttornLog' =>
				array('className' => 'WorkstationAttornLog',
						'foreignKey' => 'workstation_id',
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
						'foreignKey' => 'workstation_id',
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