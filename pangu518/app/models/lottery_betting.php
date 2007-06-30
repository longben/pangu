<?php
class LotteryBetting extends AppModel {

	var $name = 'LotteryBetting';

	var $belongsTo = array(
			'Lottery' =>
				array('className' => 'Lottery',
						'foreignKey' => 'lottery_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Merchant' =>
				array('className' => 'Merchant',
						'foreignKey' => 'merchant_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>