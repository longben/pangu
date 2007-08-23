<?php
class RoleModule extends AppModel {

	var $name = 'RoleModule';

	var $belongsTo = array(
			'Role' =>
				array('className' => 'Role',
						'foreignKey' => 'role_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Module' =>
				array('className' => 'Module',
						'foreignKey' => 'module_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>