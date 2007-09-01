<?php
class LotteriesController extends AppController {

	var $name = 'Lotteries';
	var $helpers = array('Html', 'Form' , 'Time', 'Javascript');

	function index() {
		$this->Lottery->recursive = 0;
		$this->set('lotteries', $this->Lottery->findAll('order by Lottery.open_time desc'));
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
				$this->Session->setFlash('非法数据请求！');
				$this->redirect('/lotteries/index');
			}
			$this->data = $this->Lottery->read(null, $id);
		} else {
			
			$rs = $this->Lottery->LotteryBetting->findBySql("select sum(betting_time) from lottery_bettings 
			   where lottery_id =  $id 
			   and betting_number = '" .$this->data['Lottery']['win_number'] ."'");
			$this->data['Lottery']['win_count'] = $rs[0][0]['sum(betting_time)'];
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
   function query() {
   }   

}
?>