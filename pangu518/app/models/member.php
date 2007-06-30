<?php
class Member extends AppModel {

	var $name = 'Member';
	var $primaryKey = 'uid';

	var $validate = array(
		'username' => VALID_NOT_EMPTY,
		'email' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
		'password' => '/^[_a-z0-9-][_a-z0-9-][_a-z0-9-][_a-z0-9-][_a-z0-9-][_a-z0-9-]+$/'
	);

	var $jsFeedback = array(
		'username' => 'Enter a first name',
		'email' => 'Enter a valid email',
		'password' => 'Your password must be at least 6 characters'
	);
	
	var $hasOne = array(
			'MemberInfo' =>
				array('className' => 'MemberInfo',
						'foreignKey' => 'id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'dependent' => ''
				),

	);	

}
?>