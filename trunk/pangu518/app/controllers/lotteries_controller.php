<?php
class LotteriesController extends AppController {

	var $name = 'Lotteries';
	var $helpers = array('Html', 'Form' , 'Time', 'Javascript');

	function index() {
		$this->Lottery->recursive = 0;
		$this->set('lotteries', $this->Lottery->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Lottery.');
			$this->redirect('/lotteries/index');
		}
		$this->set('lottery', $this->Lottery->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			echo $this->data['Lottery']['start'];
			$this->cleanUpFields();
			if ($this->Lottery->save($this->data)) {
				$this->Session->setFlash('分红期数新增成功！');
				$this->redirect('/lotteries/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}
	
	function open($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Lottery');
				$this->redirect('/lotteries/index');
			}
			$this->data = $this->Lottery->read(null, $id);
		} else {
			$this->data['Lottery']['win_count'] = $this->Lottery->LotteryBetting->findCount(
			  array(
			    'LotteryBetting.lottery_id1' => $id,
			    'LotteryBetting.betting_number' => $this->data['Lottery']['win_number']
			  )
			);
			$this->cleanUpFields();
			$this->data['Lottery']['open_time'] = date("Y-m-d H:i:s");
			$this->data['Lottery']['flag'] = 9;
			if ($this->Lottery->save($this->data)) {
				$this->Session->setFlash('分红开奖资料保存成功！');
				$this->redirect('/lotteries/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}	

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Lottery');
				$this->redirect('/lotteries/index');
			}
			$this->data = $this->Lottery->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Lottery->save($this->data)) {
				$this->Session->setFlash('分红资料更新成功！');
				$this->redirect('/lotteries/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Lottery');
			$this->redirect('/lotteries/index');
		}
		if ($this->Lottery->del($id)) {
			$this->Session->setFlash('The Lottery deleted: id '.$id.'');
			$this->redirect('/lotteries/index');
		}
	}
	
   function dividend() {
   }
   
   /**
    * 当期分红相关数据
    *
    */
   function currently() {
   }   

}
?>