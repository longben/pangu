<?php
class UserAttribute extends AppModel {

	var $name = 'UserAttribute';

	var $belongsTo = array(
			'User' =>
				array('className' => 'User',
						'foreignKey' => 'user_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Role' =>
				array('className' => 'Role',
						'foreignKey' => 'role_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>