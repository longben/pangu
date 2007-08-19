<?php
class Category extends AppModel {

	var $name = 'Category';
	var $validate = array(
		'category_name' => VALID_NOT_EMPTY,
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Post' =>
				array('className' => 'Post',
						'foreignKey' => 'category_id',
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