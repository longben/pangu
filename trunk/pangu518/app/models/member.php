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
		'username' => '用户',
		'email' => 'Enter a valid email',
		'password' => 'Your password must be at least 6 characters'
	);
	
	var $hasOne = array(
			'User' =>
				array('className' => 'User',
						'foreignKey' => 'id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'dependent' => ''
				),

	);

	function afterSave(){
		if ($user_id = $this->getLastInsertID()){
			$this->User->create();
			$data['User']['id'] = $user_id;
			$data['User']['login_name'] = $this->data['Member']['username'];
			$data['User']['password'] = $this->data['Member']['password'];
			$data['User']['user_name'] = $this->data['Member']['username'];
			$data['User']['email'] = $this->data['Member']['email'];
			$this->User->save($data);
		}
	}

}
?>