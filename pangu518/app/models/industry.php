<?php
class Industry extends AppModel {

	var $name = 'Industry';
	var $validate = array(
		'industry_name' => VALID_NOT_EMPTY,
	);

	var $hasMany = array(
			'Merchant' =>
				array('className' => 'Merchant',
						'foreignKey' => 'industry_id',
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