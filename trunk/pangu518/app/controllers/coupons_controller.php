<?php
class CouponsController extends AppController {

	var $name = 'Coupons';
	var $helpers = array('Html', 'Form', 'Javascript', 'Xls');

	function index() {
		$this->Coupon->recursive = 0;
		//$this->set('coupons', $this->Coupon->findAll());
		$this->set('coupons', $this->Coupon->getGroupByStatus());
		//$this->set('coupons', $this->Coupon->field('coupon_group','status = 0'));

		//field($name, $conditions, $order)

	}
//findAll ($conditions, $fields, $order, $limit, $page, $recursive)


    function audit($coupon_group = null,$custom_num = null){
    	if(!$coupon_group && $coupon_group!=0){
			$this->Session->setFlash('请选择代金券审核组团！');
			$this->redirect('/coupons/index');    		
    	}
    	
    	$this->cleanUpFields();
    	if($this->Coupon->updateStatusByGroup($coupon_group,$custom_num)){
    		$this->Session->setFlash('代金券审核成功！');
    		$this->redirect('/coupons/index');
    	}
    }

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Coupon.');
			$this->redirect('/coupons/index');
		}
		$this->set('coupon', $this->Coupon->read(null, $id));
	}
	
	function initialize($coupon_group = null, $start = null, $end = null, $custom_num = null){
				
		if($coupon_group!=null && $start!=null && $end!=null && $custom_num!=null) {
			ignore_user_abort(); // 后台运行
			set_time_limit(0); // 取消脚本运行时间的超时上限
			
			$this->layout = 'ajax';

			$this->Coupon->query('set @_start='. $start);
			$this->Coupon->query('set @_end='.$end);
			$this->Coupon->query('set @_num='.$custom_num);
			$this->Coupon->query("set @_group='".$coupon_group."'");

			$this->Coupon->query('CALL init_coupon(@flag,@_start,@_end,@_num,@_group)');
			$res = $this->Coupon->query("select @flag");
			$this->set('isExistUser',$res);
			
		}else{
			
		}
	}

	function add() {
		if(empty($this->data)) {
			$this->render();
		} else {
			$start = $this->data['Coupon']['start'];
			$end = $this->data['Coupon']['end'];
			$custom_num = $this->data['Coupon']['custom_num'];
			$coupon_group = $this->data['Coupon']['coupon_group'];
			set_time_limit(16000);
			
			for($i=$start;$i<=$end;$i++){
				$this->cleanUpFields();
				srand((double)microtime()*1000000);//时间的因素，以执行时的百万分之一秒当乱数种子
				$randval = rand(10000,99999);
				$this->data['Coupon']['coupon_group'] = $coupon_group;
				$this->data['Coupon']['custom_num'] = $custom_num;
				$this->data['Coupon']['coupon_no'] = $coupon_group .sprintf('%09s', $i);
				$this->data['Coupon']['coupon_pwd'] = $this->Coupon->getPassword($custom_num,$randval);
				$this->data['Coupon']['random_num'] = $randval;
				
				$this->Coupon->save($this->data);
				$this->Coupon->create(); //再循环
			}
			$this->Session->setFlash('该批次代金券初始化成功！');
			$this->redirect('/coupons/index');
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Coupon');
				$this->redirect('/coupons/index');
			}
			$this->data = $this->Coupon->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Coupon->save($this->data)) {
				$this->Session->setFlash('The Coupon has been saved');
				$this->redirect('/coupons/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Coupon');
			$this->redirect('/coupons/index');
		}
		if($this->Coupon->del($id)) {
			$this->Session->setFlash('The Coupon deleted: id '.$id.'');
			$this->redirect('/coupons/index');
		}
	}
	function export($coupon_group = null, $custom_num = null) {
		set_time_limit(0);
		ini_set("memory_limit","50M");
		
		$this->layout = 'ajax';
		$this->data = $this->Coupon->findAll(
		array(
		'coupon_group' => $coupon_group,
		'custom_num' => $custom_num,
		'status' => 0)
		);
		$this->set('coupons',$this->data);
	}

}
?>