<?php
class Channel extends AppModel {

	var $name = 'Channel';

	function listMe($_conditions = null, $_order = 'id'){
		return $this->generateList(
			$conditions = $_conditions,
			$order = $_order,
			$limit = null,
			$KeyPath = '{n}.Channel.id',
			$valuePath = '{n}.Channel.channel_name');
	}

}
?>