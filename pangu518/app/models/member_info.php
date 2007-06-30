<?php
class MemberInfo extends AppModel {

	var $name = 'MemberInfo';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
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

	var $hasOne = array(
			'Member' =>
				array('className' => 'Member',
						'foreignKey' => 'uid',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'dependent' => ''
				),

	);

}
?>