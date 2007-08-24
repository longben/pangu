<?php
class Role extends AppModel {

	var $name = 'Role';
	var $validate = array(
		'role_name' => VALID_NOT_EMPTY,
	);


	var $hasAndBelongsToMany = array(
			'Module' =>
				array('className' => 'Module',
						'joinTable' => 'role_modules',
						'foreignKey' => 'role_id',
						'associationForeignKey' => '',
						'conditions' => '',
						'fields' => '',
						'order' => 'Module.id',
						'limit' => '',
						'offset' => '',
						'unique' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
				),

	);

}
?>