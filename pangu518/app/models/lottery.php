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

	function findTimesByDate($open_time = null){
		$this->recursive = 0;
		$lottery = $this->find("DATE_FORMAT(open_time,'%Y-%m-%d')='$open_time'");
		if($lottery == null){
			return null;
		}else{
			return $lottery['Lottery']['lottery_year'] . sprintf('%03s', $lottery['Lottery']['lottery_times']);
		}
	}

	/*
	 * 当期分红用户数据
	 */
	function findLotteryBettingByUserAndTimes($user_id = null, $open_time = null){
		$lottery = $this->find("DATE_FORMAT(open_time,'%Y-%m-%d')='$open_time'");
		if($lottery == null){
			return null;
		}else{
			$lotteryBetting = $this->LotteryBetting->find("lottery_id = ". $lottery['Lottery']['id'] ." and LotteryBetting.user_id = $user_id");
			return $lotteryBetting['LotteryBetting']['betting_time'] * $lottery['Lottery']['dividend'];
		}
	}

	/*
	 * 当期用户投注数据
	 */
	function findBetByUserAndTimes($user_id = null, $open_time = null){
		$lottery = $this->find("DATE_FORMAT(open_time,'%Y-%m-%d')='$open_time'");
		if($lottery == null){
			return null;
		}else{
			$count = $this->LotteryBetting->findCount("lottery_id = ". $lottery['Lottery']['id'] ." and LotteryBetting.user_id = $user_id");
			return $count*2;
		}
	}
}
?>