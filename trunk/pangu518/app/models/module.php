<?php
class Module extends AppModel {

	var $name = 'Module';
    

	var $hasAndBelongsToMany = array(
			'Role' =>
				array('className' => 'Role',
						'joinTable' => 'role_modules',
						'foreignKey' => 'module_id',
						'associationForeignKey' => '',
						'conditions' => '',
						'fields' => '',
						'order' => '',
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