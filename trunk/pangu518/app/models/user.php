<?php
class User extends AppModel {

	var $name = 'User';
	
	var $belongsTo = array(
			'MemberGrade' =>
				array('className' => 'MemberGrade',
						'foreignKey' => 'member_grades_id',
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

}
?>