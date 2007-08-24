<?php
class WorkstationCouponsController extends AppController {

	var $name = 'WorkstationCoupons';
	var $helpers = array('Html', 'Form' );
	
	function index() {
		$user_id = $this->Session->read('User.id');
		$this->data = $this->WorkstationCoupon->Workstation->findByUserId($user_id);
		if(empty($this->data)){
			$this->Session->setFlash('请先申请成立会员消费单位！');
			$this->redirect('/workstations/profile');
		}else{
			$this->Session->write('ws_id',$this->data['Workstation']['id']);
		}
		$this->WorkstationCoupon->recursive = 0;
		
		//统计查询条件
		$criteria = array(
		  'Workstation.user_id' => $this->Session->read('User.id'),
		  'WorkstationCoupon.status' => 131
		);
		$this->set('total', $this->WorkstationCoupon->findCount($criteria));
		
		$criteria = array(
		  'Workstation.user_id' => $this->Session->read('User.id'),
		  'WorkstationCoupon.status' => 341
		);
		$this->set('total2', $this->WorkstationCoupon->findCount($criteria));		
	}
	
	function add(){
		
	}
	
	function balance($workstation_id = null){
		$this->layout = 'ajax';
		$criteria = array(
		  'WorkstationCoupon.workstation_id' => $workstation_id,
		  'WorkstationCoupon.status' => 131
		);
		$this->set('balance', $this->WorkstationCoupon->findCount($criteria));
	}
}
?>