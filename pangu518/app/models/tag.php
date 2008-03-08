<?php
class Tag extends AppModel {

	var $name = 'Tag';

	var $hasAndBelongsToMany = array(
			'Article' =>
				array('className' => 'Article',
						'joinTable' => 'articles_tags',
						'foreignKey' => 'tag_id',
						'associationForeignKey' => 'article_id',
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