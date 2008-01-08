<?php
class LotteryBettingsController extends AppController {

	var $name = 'LotteryBettings';
	var $helpers = array('Html', 'Form', 'Javascript', 'Pagination');
	var $components = array('Pagination');

	function index() {
		$this->LotteryBetting->recursive = 0;
		$this->set('lotteryBettings', $this->LotteryBetting->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Lottery Betting.');
			$this->redirect('/lottery_bettings/index');
		}
		$this->set('lotteryBetting', $this->LotteryBetting->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('lotteries', $this->LotteryBetting->Lottery->generateList());
			$this->set('users', $this->LotteryBetting->User->generateList());
			$this->set('merchants', $this->LotteryBetting->Merchant->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->LotteryBetting->save($this->data)) {
				$this->Session->setFlash('The Lottery Betting has been saved');
				$this->redirect('/lottery_bettings/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('lotteries', $this->LotteryBetting->Lottery->generateList());
				$this->set('users', $this->LotteryBetting->User->generateList());
				$this->set('merchants', $this->LotteryBetting->Merchant->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Lottery Betting');
				$this->redirect('/lottery_bettings/index');
			}
			$this->data = $this->LotteryBetting->read(null, $id);
			$this->set('lotteries', $this->LotteryBetting->Lottery->generateList());
			$this->set('users', $this->LotteryBetting->User->generateList());
			$this->set('merchants', $this->LotteryBetting->Merchant->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->LotteryBetting->save($this->data)) {
				$this->Session->setFlash('The LotteryBetting has been saved');
				$this->redirect('/lottery_bettings/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('lotteries', $this->LotteryBetting->Lottery->generateList());
				$this->set('users', $this->LotteryBetting->User->generateList());
				$this->set('merchants', $this->LotteryBetting->Merchant->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Lottery Betting');
			$this->redirect('/lottery_bettings/index');
		}
		if ($this->LotteryBetting->del($id)) {
			$this->Session->setFlash('The Lottery Betting deleted: id '.$id.'');
			$this->redirect('/lottery_bettings/index');
		}
	}

   function user($no = null, $number = null, $page = 1) {
		if (empty($this->data) || empty($this->data['LotteryBetting']['lottery_id'])) {
			$this->set('lotteries', $this->LotteryBetting->Lottery->generateList(
			  $conditions = array(
			    'start_time' => '<=' .date("Y-m-d H:i:s"),
			    'finish_time' => '>='. date("Y-m-d H:i:s"),
			    'flag' => '1'),
			  $order = null,
			  $limit = null,
			  $keyPath = '{n}.Lottery.id',
			  $valuePath = '{n}.Lottery.lottery_times')			
			);

			$_user = $this->Session->read('User.id');

			//投注、中奖情况
			$criteria = "LotteryBetting.user_id = $_user and LotteryBetting.betting_type = 1";
			if($no == null){
				$no = $this->data['LotteryBetting']['no'];
				$number = $this->data['LotteryBetting']['number'];
			}

			if($no != null){
				$criteria .= " and concat(Lottery.lottery_year,lpad(Lottery.lottery_times,3,'0')) = '$no'";
			}

			if($number != null){
				$criteria .= " and LotteryBetting.betting_number = $number";
			}

			list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'user/'.$no.'/'.$number));
			
			$data = $this->LotteryBetting->findAll($criteria, null, 'Lottery.lottery_times desc', $limit, $page); 			
			$this->set('ulbs',$data);

			//$this->set('ulbs',$this->LotteryBetting->findAll($criteria));

			$this->render();
		} else {
			$this->cleanUpFields();
			$user_id = $this->Session->read('User.id');
			$lottery_id = $this->data['LotteryBetting']['lottery_id'];
			$betting_number = $this->data['LotteryBetting']['betting_number'];
			$betting_time = $this->data['LotteryBetting']['betting_time'];
			if ($this->LotteryBetting->saveUserBetting($user_id, $lottery_id, $betting_number, $betting_time)) {
				$this->data['LotteryBetting']['user_id'] = $user_id;
				if($this->LotteryBetting->save($this->data)){
					$this->Session->setFlash('会员参与分红成功！');
					$this->redirect('/user_coupons/input');
				}
			} else {
				$this->Session->setFlash('你拥有的代金券数量不足！');
				$this->set('lotteries', $this->LotteryBetting->Lottery->generateList(
				  $conditions = array(
				    'start_time' => '<=' .date("Y-m-d H:i:s"),
				    'finish_time' => '>='. date("Y-m-d H:i:s"),
				    'flag' => '1'),
				  $order = null,
				  $limit = null,
				  $keyPath = '{n}.Lottery.id',
				  $valuePath = '{n}.Lottery.lottery_times')			
				);
			}
		}
   }
   
   function batch($no = null, $number = null, $page = 1) {
		if (empty($this->data) || empty($this->data['LotteryBetting']['lottery_id'])) {
			$this->set('lotteries', $this->LotteryBetting->Lottery->generateList(
			  $conditions = array(
			    'start_time' => '<=' .date("Y-m-d H:i:s"),
			    'finish_time' => '>='. date("Y-m-d H:i:s"),
			    'flag' => '1'),
			  $order = null,
			  $limit = null,
			  $keyPath = '{n}.Lottery.id',
			  $valuePath = '{n}.Lottery.lottery_times')			
			);

			$_user = $this->Session->read('User.id');

			//投注、中奖情况
			$criteria = "LotteryBetting.user_id = $_user and LotteryBetting.betting_type = 1";
			if($no == null){
				$no = $this->data['LotteryBetting']['no'];
				$number = $this->data['LotteryBetting']['number'];
			}

			if($no != null){
				$criteria .= " and concat(Lottery.lottery_year,lpad(Lottery.lottery_times,3,'0')) = '$no'";
			}

			if($number != null){
				$criteria .= " and LotteryBetting.betting_number = $number";
			}

			list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'user/'.$no.'/'.$number));
			
			$data = $this->LotteryBetting->findAll($criteria, null, 'Lottery.lottery_times desc', $limit, $page); 			
			$this->set('ulbs',$data);

			//$this->set('ulbs',$this->LotteryBetting->findAll($criteria));

			$this->render();
		} else {
			$this->cleanUpFields();
			$user_id = $this->Session->read('User.id');
			$lottery_id = $this->data['LotteryBetting']['lottery_id'];
			$betting_number_start = $this->data['LotteryBetting']['betting_number_start'];
			$betting_number_end = $this->data['LotteryBetting']['betting_number_end'];
			$betting_time = $this->data['LotteryBetting']['betting_time'];

			//计算投注总数
			$betting_total = ((int)$betting_number_end - (int)$betting_number_start + 1) * $betting_time; //投注总数
		
			//首先检查拥有代金券数量
			$user_total = $this->LotteryBetting->findCountUserCoupon($user_id,421); //用户拥有代金券总数

			if($betting_total > $user_total){
				$this->Session->setFlash('你拥有的分红凭证数量不足！');
				$this->redirect('/lottery_bettings/batch');
			}else{
				if($this->LotteryBetting->saveUserBettingBatch($user_id, $lottery_id, (int)$betting_number_start, (int)$betting_number_end, $betting_time, $betting_total)){
				  $this->Session->setFlash('会员参与分红成功！');
				  $this->redirect('/lottery_bettings/batch');
				}else{
				  $this->Session->setFlash('你拥有的分红凭证数量不足！');
				  $this->redirect('/lottery_bettings/batch');
				}
			}
		}
   }
   
   function merchant() {
		if (empty($this->data)) {
			$this->set('lotteries', $this->LotteryBetting->Lottery->generateList(
			  $conditions = array(
			    'start_time' => '<=' .date("Y-m-d H:i:s"),
			    'finish_time' => '>='. date("Y-m-d H:i:s"),
			    'flag' => '1'),
			  $order = null,
			  $limit = null,
			  $keyPath = '{n}.Lottery.id',
			  $valuePath = '{n}.Lottery.lottery_times')			
			);
			$this->set('ulbs',$this->LotteryBetting->findAll("LotteryBetting.user_id = " . $this->Session->read('User.id') ." and LotteryBetting.betting_type = 2"));
			$this->render();
		} else {
			$this->cleanUpFields();
			$user_id = $this->Session->read('User.id');
			$Merchant = $this->LotteryBetting->Merchant->findByUserId($user_id);
			$merchant_id = $Merchant['Merchant']['id'];

			$lottery_id = $this->data['LotteryBetting']['lottery_id'];
			$betting_number = $this->data['LotteryBetting']['betting_number'];
			$betting_time = $this->data['LotteryBetting']['betting_time'];
			if ($this->LotteryBetting->saveMerchantBetting($merchant_id, $lottery_id, $betting_number, $betting_time)) {
				$this->data['LotteryBetting']['user_id'] = $user_id;
				$this->data['LotteryBetting']['merchant_id'] = $merchant_id;
				if($this->LotteryBetting->save($this->data)){
					$this->Session->setFlash('会员消费单位参与分红成功！');
					$this->redirect('/merchant_coupons');
				}
			} else {
				$this->Session->setFlash('你拥有的代金券数量不足！');
				$this->set('lotteries', $this->LotteryBetting->Lottery->generateList(
				  $conditions = array(
				    'start_time' => '<=' .date("Y-m-d H:i:s"),
				    'finish_time' => '>='. date("Y-m-d H:i:s"),
				    'flag' => '1'),
				  $order = null,
				  $limit = null,
				  $keyPath = '{n}.Lottery.id',
				  $valuePath = '{n}.Lottery.lottery_times')			
				);
			}
		}
   }   

}
?>