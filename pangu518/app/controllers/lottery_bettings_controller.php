<?php
class LotteryBettingsController extends AppController {

	var $name = 'LotteryBettings';
	var $helpers = array('Html', 'Form' );

	
	function index() {
		$this->LotteryBetting->recursive = 0;
		$this->set('lotteryBettings', $this->LotteryBetting->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Lottery Betting.');
			$this->redirect('/lottery_bettings/index');
		}
		$this->set('lotteryBetting', $this->LotteryBetting->read(null, $id));
	}

	function add() {
		$this->set('test','程小飞测试用变量');
		if(empty($this->data)) {
			$this->set('lotteries', $this->LotteryBetting->Lottery->generateList());
			$this->set('merchants', $this->LotteryBetting->Merchant->generateList(
			      $conditions = "member_id = ". $this->Session->read('User.uid'),
			      $order = null,
			      $limit = null,
			      $keyPath = '{n}.Merchant.id',
			      $valuePath = '{n}.Merchant.merchant_name')
			);
			//$this->set('merchants',$this->LotteryBetting->Merchant->findAll());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->LotteryBetting->save($this->data)) {
				$this->Session->setFlash('The Lottery Betting has been saved');
				$this->redirect('/lottery_bettings/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('lotteries', $this->LotteryBetting->Lottery->generateList());
				$this->set('merchants', $this->LotteryBetting->Merchant->generateList());
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Lottery Betting');
				$this->redirect('/lottery_bettings/index');
			}
			$this->data = $this->LotteryBetting->read(null, $id);
			$this->set('lotteries', $this->LotteryBetting->Lottery->generateList());
			$this->set('merchants', $this->LotteryBetting->Merchant->generateList(
			      $conditions = "member_id = ". $this->Session->read('User.uid'),
			      $order = null,
			      $limit = null,
			      $keyPath = '{n}.Merchant.id',
			      $valuePath = '{n}.Merchant.merchant_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->LotteryBetting->save($this->data)) {
				$this->Session->setFlash('The LotteryBetting has been saved');
				$this->redirect('/lottery_bettings/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('lotteries', $this->LotteryBetting->Lottery->generateList());
				$this->set('merchants', $this->LotteryBetting->Merchant->generateList());
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Lottery Betting');
			$this->redirect('/lottery_bettings/index');
		}
		if($this->LotteryBetting->del($id)) {
			$this->Session->setFlash('The Lottery Betting deleted: id '.$id.'');
			$this->redirect('/lottery_bettings/index');
		}
	}

}
?>