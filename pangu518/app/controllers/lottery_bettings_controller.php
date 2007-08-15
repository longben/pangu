<?php
class LotteryBettingsController extends AppController {

	var $name = 'LotteryBettings';
	var $helpers = array('Html', 'Form' );

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

   function user() {
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
			$this->render();
		} else {
			$this->cleanUpFields();
			$user_id = $this->Session->read('User.uid');
			$lottery_id = $this->data['LotteryBetting']['lottery_id'];
			$betting_number = $this->data['LotteryBetting']['betting_number'];
			$betting_time = $this->data['LotteryBetting']['betting_time'];
			if ($this->LotteryBetting->saveUserBetting($user_id, $lottery_id, $betting_number, $betting_time)) {
				$this->data['LotteryBetting']['user_id'] = $user_id;
				if($this->LotteryBetting->save($this->data)){
					$this->Session->setFlash('会员参与分红成功！');
					$this->redirect('/lottery_bettings/user_histroy');
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
			$this->render();
		} else {
			$this->cleanUpFields();
			$user_id = $this->Session->read('User.uid');
			$Merchant = $this->LotteryBetting->Merchant->findByUserId($user_id);
			$merchant_id = $Merchant['Merchant']['id'];

			$lottery_id = $this->data['LotteryBetting']['lottery_id'];
			$betting_number = $this->data['LotteryBetting']['betting_number'];
			$betting_time = $this->data['LotteryBetting']['betting_time'];
			if ($this->LotteryBetting->saveMerchantBetting($merchant_id, $lottery_id, $betting_number, $betting_time)) {
				$this->data['LotteryBetting']['user_id'] = $user_id;
				$this->data['LotteryBetting']['merchant_id'] = $merchant_id;
				if($this->LotteryBetting->save($this->data)){
					$this->Session->setFlash('会员参与分红成功！');
					$this->redirect('/lottery_bettings/merchant_histroy');
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