<?php
class Merchant extends AppModel {

	var $name = 'Merchant';

	var $belongsTo = array(
			'User' =>
				array('className' => 'User',
						'foreignKey' => 'user_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Referee' =>
				array('className' => 'User',
						'foreignKey' => 'referees',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),					
				
			'Industry' =>
				array('className' => 'Industry',
						'foreignKey' => 'industry_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Region' =>
				array('className' => 'Region',
						'foreignKey' => 'region_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

	var $hasMany = array(
			'LotteryBetting' =>
				array('className' => 'LotteryBetting',
						'foreignKey' => 'merchant_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'dependent' => ''
				),

			'MerchantComplaintLog' =>
				array('className' => 'MerchantComplaintLog',
						'foreignKey' => 'merchant_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'dependent' => ''
				),

	);
	
	function buy($workstation_id=null,$merchant_id=null,$sum=null) {
		//Configure::write('debug',2);
		$status = 3*100 + 4*10 + 1;
		$sql = "select WorkstationCoupon.coupon_id from workstation_coupons as WorkstationCoupon 
		    where WorkstationCoupon.workstation_id = $workstation_id
		      and WorkstationCoupon.status = 131 limit $sum";
			
		$rs = $this->query($sql);
		if(sizeof($rs)==$sum){
			for($i=0;$i<sizeof($rs);$i++){
				if($i==0){
					$merchant_sql = 'insert into merchant_coupons(merchant_id,coupon_id,workstation_id,status)
				      values('.$merchant_id.','.$rs[$i]['WorkstationCoupon']['coupon_id'].','.$workstation_id.','.$status.')';
					$coupon_id = $rs[$i]['WorkstationCoupon']['coupon_id'];
				}else{
					$merchant_sql .= ',('.$merchant_id.','.$rs[$i]['WorkstationCoupon']['coupon_id'].','.$workstation_id.','.$status.')';
					$coupon_id .= ','.$rs[$i]['WorkstationCoupon']['coupon_id'];
				}
			}
			$coupon_sql = 'update coupons set status = '.$status.' where id in('. $coupon_id .')';
			$updateWorkstationCoupon = 'update workstation_coupons set status = '.$status.' where coupon_id in('. $coupon_id .')';
			$this->execute($merchant_sql); //插入会员消费单位代金券
			$this->execute($coupon_sql); //更新代金券状态
			$this->execute($updateWorkstationCoupon); //更新工作站代金券状态
			return true;
		}else{
			return false;
		}		
		
	}
	
	function getReferees($referees_no = null){
		//暂时用的login_name
		$ret = $this->findBySql("SELECT id FROM users as User
                                   WHERE login_name = '$referees_no'");

		if(sizeof($ret)>=1){
			$user_id = $ret[0]['User']['id'];
		}else{
			$user_id = 1;
		}

		return $user_id;
	}

}
?>