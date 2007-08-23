<?php
class Role extends AppModel {

	var $name = 'Role';
	var $validate = array(
		'role_name' => VALID_NOT_EMPTY,
	);

	var $hasMany = array(
			'RoleModule' =>
				array('className' => 'RoleModule',
						'foreignKey' => 'role_id',
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

			'UserAttribute' =>
				array('className' => 'UserAttribute',
						'foreignKey' => 'role_id',
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