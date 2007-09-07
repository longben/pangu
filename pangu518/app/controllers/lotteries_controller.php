<?php
class LotteriesController extends AppController {

	var $name = 'Lotteries';
	var $helpers = array('Html', 'Form' , 'Time', 'Javascript');

	function index() {
		$this->Lottery->recursive = 0;
		$this->set('lotteries', $this->Lottery->findAll('order by Lottery.lottery_times desc'));
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
			$this->cleanUpFields();
			if($this->data['Lottery']['start_time']>=$this->data['Lottery']['finish_time']){
				//$this->Session->setFlash('分红开始日期大于或者等于结束日期！');
				$msg = '分红开始日期必须小于结束日期！';
				$this->redirect('/lotteries/add?msg='.urlencode($msg));
			}else{

				//判断是否重复开奖号码，以及不允许编号回走
				$rsCode = $this->Lottery->findBySql("select count(*) from lotteries
				   where lottery_year = ".$this->data['Lottery']['lottery_year']." and lottery_times >=".$this->data['Lottery']['lottery_times']);
				$_code = $rsCode[0][0]['count(*)']; 
				$this->data['Lottery']['code'] = $_code;
				if($_code > 0){
					//$this->Session->setFlash('存在相同或更大的期数，请录入大于已有的期数！');
					$msg = '存在相同或更大的期数，录入的期数不能小于或等于已有期数！';
					$this->redirect('/lotteries/add?msg='.urlencode($msg));
				}

				if ($this->Lottery->save($this->data)) {
					//$this->Session->setFlash('分红期数新增成功！');
					$msg = '分红期数新增成功！';
					$this->redirect('/lotteries/index?msg='.urlencode($msg));
				} else {
					$this->Session->setFlash('Please correct errors below.');
				}				
			}
		}
	}
	
	function open($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				//$this->Session->setFlash('非法数据请求！');
				$msg = '非法数据请求！';
				$this->redirect('/lotteries/index?msg='.urlencode($msg));
			}
			$this->data = $this->Lottery->read(null, $id);
		} else {
			$this->cleanUpFields();

			//判断是否存在还未开奖的以前的期数，若有则不允许，需要顺序开奖
			$rsList = $this->Lottery->findBySql("select count(*) from lotteries
			   where id <  $id 
				and flag = 1");
			$_list = $rsList[0][0]['count(*)']; 
			$this->data['Lottery']['list'] = $_list;
			if($_list > 0){
				//$this->Session->setFlash('存在前期尚未开奖数据，请先开出前期结果！');
				$msg = '存在前期尚未开奖数据，请先开出前期结果！';
				$this->redirect('/lotteries/index?msg='.urlencode($msg));
			}

			//计算会员投注总金额
			$rsUser = $this->Lottery->LotteryBetting->findBySql("select sum(betting_time)*2 from lottery_bettings
			   where lottery_id =  $id
			   and betting_type = 1");
			$_total = $rsUser[0][0]['sum(betting_time)*2']; //本期总额
			$this->data['Lottery']['total'] = $_total;
			
			//计算中奖总数
			$rs = $this->Lottery->LotteryBetting->findBySql("select sum(betting_time) from lottery_bettings 
			   where lottery_id =  $id 
			   and betting_number = '" .$this->data['Lottery']['win_number'] ."'");
			$_win_count =   $rs[0][0]['sum(betting_time)']; //中奖总数
			$this->data['Lottery']['win_count'] = $_win_count;
			
			//计算上期分红余额
			$rsBalance = $this->Lottery->find('flag = 9','balance','lottery_year,lottery_times desc');
			$_last_time_balance = $rsBalance['Lottery']['balance']; //上期分红余额
			
			//本期分红总金额
			$_total2 = $_total * 0.5 + $_last_time_balance; 
			
			//每份金额
			$_dividend = $_total2 / $_win_count;
			if($_dividend > 4999){ //分红金额最多只能为4999元（含税）
				$_dividend = 4999;
				$_balance = $_total2 - 4999 * $_win_count; //本期余额
			}else{
				$_balance = 0; //本期余额
			}
			
			$this->data['Lottery']['total'] = $_total;
			$this->data['Lottery']['dividend'] = $_dividend;
			$this->data['Lottery']['balance'] = $_balance;
			$this->data['Lottery']['open_time'] = date("Y-m-d H:i:s");
			$this->data['Lottery']['flag'] = 9;
			
			
			if ($this->Lottery->save($this->data)) {
				//$this->Session->setFlash('分红开奖资料保存成功！');
				$msg = '分红开奖资料保存成功！';
				$this->redirect('/lotteries/index?msg='.urlencode($msg));
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
				//$this->Session->setFlash('分红资料更新成功！');
				$msg = '分红资料更新成功！';
				$this->redirect('/lotteries/index?msg='.urlencode($msg));
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
	
   function dividend($id = null, $num = null) {
		if (!$id) {
			//$this->Session->setFlash('非法数据请求.');
			$msg = '非法数据请求';
			$this->redirect('/lotteries/index?msg='.urlencode($msg));
		}
		$this->set('lottery', $this->Lottery->read(null, $id));
		$this->set('lotteryBettings', $this->Lottery->LotteryBetting->findAll("lottery_id = $id and betting_number = '$num'"));
		
   }
   
   /**
    * 当期分红相关数据
    *
    */
   function query() {
   }   

}
?>