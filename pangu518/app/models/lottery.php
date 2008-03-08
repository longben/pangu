<?php
class Lottery extends AppModel {

	var $name = 'Lottery';

	var $hasMany = array(
			'LotteryBetting' =>
				array('className' => 'LotteryBetting',
						'foreignKey' => 'lottery_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'dependent' => ''
				),
	);
	
	function findBulletin($limit = null){
		$this->recursive = 0;
		return $this->findAll("flag = 9 order by open_time desc limit $limit");
	}
}
?>