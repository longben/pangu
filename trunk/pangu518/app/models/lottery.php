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

}
?>