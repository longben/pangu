<?php
class Post extends AppModel {

	var $name = 'Post';
	var $validate = array(
		'post_title' => VALID_NOT_EMPTY,
		'post_content' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Category' =>
				array('className' => 'Category',
						'foreignKey' => 'category_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>