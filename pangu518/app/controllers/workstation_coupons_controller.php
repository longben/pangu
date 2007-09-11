<?php
class WorkstationCouponsController extends AppController {

	var $name = 'WorkstationCoupons';
	var $helpers = array('Html', 'Form', 'Pagination');
	var $components = array('Pagination');
	
	function index($keyword = null, $page=1) {
		$this->WorkstationCoupon->recursive = 0;

		$user_id = $this->Session->read('User.id');
		$criteria = array(
		  'Workstation.user_id' => $user_id
		);	

		$this->WorkstationCoupon->Workstation->unbindModel(array('belongsTo' => array('User')));
		$this->WorkstationCoupon->Workstation->unbindModel(array('belongsTo' => array('Referee')));
		$this->WorkstationCoupon->Workstation->unbindModel(array('belongsTo' => array('Region')));
		$this->WorkstationCoupon->Workstation->unbindModel(array('hasMany' => array('WorkstationCoupon')));
		$this->WorkstationCoupon->Workstation->unbindModel(array('hasMany' => array('MerchantCoupon')));
		$this->WorkstationCoupon->Workstation->unbindModel(array('hasMany' => array('WorkstationAttornLog')));
		
		$this->data2 = $this->WorkstationCoupon->Workstation->find($criteria,null,'Workstation.id',null);

		if(empty($this->data2)){
			$this->Session->setFlash('请先申请成立会员消费单位！');
			$this->redirect('/workstations/profile');
		}else{
		    //设置工作站ID
			$this->Session->write('ws_id',$this->data2['Workstation']['id']);
		}
		
		
		//统计查询条件
		$criteria = array(
		  'Workstation.user_id' => $this->Session->read('User.id'),
		  'WorkstationCoupon.status' => 131
		);
		$this->WorkstationCoupon->unbindModel(array('belongsTo' => array('Coupon')));
		$this->WorkstationCoupon->Workstation->unbindModel(array('hasMany' => array('MerchantCoupon')));
		$this->WorkstationCoupon->Workstation->unbindModel(array('hasMany' => array('WorkstationAttornLog')));
		$this->set('total', $this->WorkstationCoupon->findCount($criteria));
		
		$criteria = array(
		  'Workstation.user_id' => $this->Session->read('User.id'),
		  'WorkstationCoupon.status' => 341
		);
		$this->WorkstationCoupon->unbindModel(array('belongsTo' => array('Coupon')));
		$this->set('total_sale', $this->WorkstationCoupon->findCount($criteria));
		
		$this->WorkstationCoupon->unbindModel(array('belongsTo' => array('Coupon')));
		$this->WorkstationCoupon->unbindModel(array('belongsTo' => array('Workstation')));
		$coupons = $this->WorkstationCoupon->findAll("status = 131 group by coupon_group  order by coupon_no");
		$this->set('coupons', $coupons);
		
		$this->WorkstationCoupon->unbindModel(array('belongsTo' => array('Coupon')));
		$this->WorkstationCoupon->unbindModel(array('belongsTo' => array('Workstation')));
		$this->WorkstationCoupon->Workstation->unbindModel(array('hasMany' => array('WorkstationCoupon')));
		$this->WorkstationCoupon->Workstation->unbindModel(array('hasMany' => array('WorkstationAttornLog')));

		$criteria = "MerchantCouponList.workstation_id = " . $this->data2['Workstation']['id'];
		if($keyword == null){
			$keyword = $this->data['Workstation']['keyword'];
		}		
		if($keyword != null){
			$criteria = "MerchantCouponList.workstation_id = " . $this->data2['Workstation']['id'] . " and Merchant.merchant_name like '%$keyword%'";
		}
		//$merchantcouponlists = $this->WorkstationCoupon->Workstation->MerchantCouponList->findAllByWorkstationId($this->data2['Workstation']['id']);
		$merchantcouponlists = $this->WorkstationCoupon->Workstation->MerchantCouponList->findAll($criteria);
		$this->set('merchantcouponlists', $merchantcouponlists);
	}
	
	function add(){
		
	}
	
	function balance($workstation_id = null){
		$this->layout = 'ajax';
		$this->cacheAction = true;
		$criteria = array(
		  'WorkstationCoupon.workstation_id' => $workstation_id,
		  'WorkstationCoupon.status' => 131
		);
		$this->set('balance', $this->WorkstationCoupon->findCount($criteria));
	}
	
	function getMax($status = null, $start = null, $group = null){
		$ws_id = $this->Session->read("ws_id");
		$rs = $this->WorkstationCoupon->findBySql("select max(coupon_no)
		   from (select * from workstation_coupons 
		     where status = $status and workstation_id = $ws_id and coupon_no > '$start') as c");			
		return $rs[0][0]['max(coupon_no)'];
	}		
}
?>