<?php
class Webpage extends AppModel {

	var $name = 'Webpage';

	var $belongsTo = array(
			'Channel' =>
				array('className' => 'Channel',
						'foreignKey' => 'channel_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	function listMe($_conditions = null, $_order = 'id'){
		return $this->generateList(
			$conditions = $_conditions,
			$order = $_order,
			$limit = null,
			$KeyPath = '{n}.Webpage.id',
			$valuePath = '{n}.Webpage.page_name');
	}

	function findWebpageByChannel($channel_id = null ,$limit = null){
		$this->recursive = 0;
		return $this->findAll("Webpage.channel_id = $channel_id order by Webpage.id limit $limit");
	}

	function findWebpageByChannel4Rand($channel_id = null ,$limit = null){
		$this->recursive = 0;
		return $this->findAll("Webpage.channel_id = $channel_id order by rand()  limit $limit");
	}

}
?>