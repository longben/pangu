<?php
class MerchantCouponsController extends AppController {

	var $name = 'MerchantCoupons';
	var $helpers = array('Html', 'Form' , 'Javascript');
	var $uses = array('MerchantCoupon','User');

	function index() {
		$user_id = $this->Session->read('User.id');
		$this->data = $this->MerchantCoupon->Merchant->findByUserId($user_id);
		if(empty($this->data)){
			$this->Session->setFlash('请先申请成立会员消费单位！');
			$this->redirect('/merchants/profile');
		}
		$this->MerchantCoupon->recursive = 0;
		
		//可用代金券
		$criteria = array(
		  'Merchant.user_id' => $this->Session->read('User.id'),
		  'MerchantCoupon.status' => 341
		);
		$this->set('total', $this->MerchantCoupon->findCount($criteria));
		
		//销售(返回给会员)
		$criteria = array(
		  'Merchant.user_id' => $this->Session->read('User.id'),
		  'MerchantCoupon.status' => 421
		);
		$this->set('total_sale', $this->MerchantCoupon->findCount($criteria));
				
		/**
		//参与分红抽奖
		$criteria = array(
		  'Merchant.user_id' => $this->Session->read('User.id'),
		  'MerchantCoupon.status' => 412
		);
		$this->set('total_melon_cutting', $this->MerchantCoupon->findCount($criteria));	
		*/

		//可用财富积点总数
		$sql = "select count(*) from merchant_vouchers where status = 341 and merchant_id = " . $this->data['Merchant']['id'];
		$v = $this->MerchantCoupon->findBySql($sql); 
		$this->set('total_usable', $v[0][0]['count(*)']);	

		
		//参与分红
		$sql = "select count(*) from merchant_vouchers where status = 412 and merchant_id = " . $this->data['Merchant']['id'];
		$v = $this->MerchantCoupon->findBySql($sql); 
		$this->set('total_melon_cutting', $v[0][0]['count(*)']);	
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Merchant Coupon.');
			$this->redirect('/merchant_coupons/index');
		}
		$this->set('merchantCoupon', $this->MerchantCoupon->read(null, $id));
	}
	

	function add($workstation_id=null,$merchant_id=null,$sum=null) {
		
	}

	function add2() {
		if(empty($this->data)) {
			$this->set('merchants', $this->MerchantCoupon->Merchant->generateList());
			$this->set('workstations', $this->MerchantCoupon->Workstation->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->MerchantCoupon->save($this->data)) {
				$this->Session->setFlash('The Merchant Coupon has been saved');
				$this->redirect('/merchant_coupons/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('merchants', $this->MerchantCoupon->Merchant->generateList());
				$this->set('coupons', $this->MerchantCoupon->Coupon->generateList());
				$this->set('workstations', $this->MerchantCoupon->Workstation->generateList());
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Merchant Coupon');
				$this->redirect('/merchant_coupons/index');
			}
			$this->data = $this->MerchantCoupon->read(null, $id);
			$this->set('merchants', $this->MerchantCoupon->Merchant->generateList());
			$this->set('coupons', $this->MerchantCoupon->Coupon->generateList());
			$this->set('workstations', $this->MerchantCoupon->Workstation->generateList());
		} else {
			$this->cleanUpFields();
			if($this->MerchantCoupon->save($this->data)) {
				$this->Session->setFlash('The MerchantCoupon has been saved');
				$this->redirect('/merchant_coupons/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('merchants', $this->MerchantCoupon->Merchant->generateList());
				$this->set('coupons', $this->MerchantCoupon->Coupon->generateList());
				$this->set('workstations', $this->MerchantCoupon->Workstation->generateList());
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Merchant Coupon');
			$this->redirect('/merchant_coupons/index');
		}
		if($this->MerchantCoupon->del($id)) {
			$this->Session->setFlash('The Merchant Coupon deleted: id '.$id.'');
			$this->redirect('/merchant_coupons/index');
		}
	}

   /**
    * 会员消费单位向会员批量转入分红凭证
    *
    * @param string $login_name 预转入会员的登录名
    * @param string $number_start 分红凭证开始号码
    * @param string $number_end 分红凭证结束号码
    */
   function batch() {
	  /*  计算方法：转出方主体×100 + 接收方主体×10 + 动作
		    主体：0:无效 1:公司 2:会员 3:工作站 4:会员消费单位
		    动作：0:无效 1:销售 2:参与抽奖 3:财务审核 4:其它 */
	   $status = 4*100 + 2*10 + 1; //应该定义成全局变量
		   	
	   $user_id = $this->Session->read('User.id');
	   if(empty($this->data)) {
	   }else{
	   	  $this->data1 = $this->User->findByLoginName($this->data['MerchantCoupon']['login_name']);
	   	  $user1 = $this->data1['User']['id']; //预转入会员
	   	  if($this->data1 != null){
	   		
	   		if($this->User->Workstation->findCount(array('user_id' => $this->data1['User']['id'])) > 0){
	   			$this->Session->setFlash('预转入会员不能是工作站！');
	   		}
	   		
	   		if($this->User->Merchant->findCount(array('user_id' => $this->data1['User']['id'])) > 0){
	   			$this->Session->setFlash('预转入会员不能是会员消费单位！');
	   		}
	   		
	   		if($this->Session->read('password') == md5($this->data['MerchantCoupon']['password'])){
	   			$this->merchant = $this->MerchantCoupon->Merchant->findByUserId($user_id);
	   			$merchant1 = $this->merchant['Merchant']['id'];
	   			
	   			//检查分红凭证编码是否连贯和合法性
	   			$sql = "Coupon.coupon_no >= '" . $this->data['MerchantCoupon']['number_start'] . "'";
	   			$sql .= " AND Coupon.coupon_no <= '" . $this->data['MerchantCoupon']['number_end'] . "'";
	   			$sql .= " AND MerchantCoupon.merchant_id = " . $this->merchant['Merchant']['id'];
	   			$sql .= " AND MerchantCoupon.status = 341";
	   			$this->MerchantCoupon->unbindModel(array('belongsTo' => array('Merchant','Workstation')));
	   			$rs = $this->MerchantCoupon->findAll($sql); //会员消费单位对该号段的实际拥有数字
	   			$count1 = sizeof($rs); //会员消费单位此号段实际库存代金券
	   			
	   			//预转入分红凭证数额
	   			$count2 = (int)(substr($this->data['MerchantCoupon']['number_end'],1,10)) - (int)(substr($this->data['MerchantCoupon']['number_start'],1,10)) + 1; 

	   			if($count1 < $count2){ //
	   				$this->Session->setFlash('请检查分红凭证编码是否连贯以及合法性！');
	   			}else{
					for($i=0;$i<sizeof($rs);$i++){
						if($i==0){
							$user_sql = 'insert into user_coupons(user_id,coupon_id,merchant_id,status)
						       values('.$user1.','.$rs[$i]['Coupon']['id'].','.$merchant1.','.$status.')';
							$coupon_id = $rs[$i]['Coupon']['id'];
						}else{
							$user_sql .= ',('.$user1.','.$rs[$i]['Coupon']['id'].','.$merchant1.','.$status.')';
							$coupon_id .= ','.$rs[$i]['Coupon']['id'];
						}
					}
					$this->MerchantCoupon->execute($user_sql);
					
					//更新分红凭证状态
					$coupon_sql = 'update coupons set status = '.$status.' where id in('. $coupon_id .')';
					$this->MerchantCoupon->execute($coupon_sql);
					
					$merchant_sql = 'update merchant_coupons set status = '.$status.' where coupon_id in('. $coupon_id .')';
					$this->MerchantCoupon->execute($merchant_sql);
					$this->Session->setFlash('恭喜你，已成功批量录入，并且此号段分红凭证已作废，请妥善保管！');
					$this->redirect('/merchant_coupons/batch');
	   			}
	   		}else{
	   			$this->Session->setFlash('口令错误！');
	   		}
	   		
	   	  }else{
	   	  	$this->Session->setFlash('预转入会员的登录名不正确！');
	   	  }
	   }
   }

}
?>