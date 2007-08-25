<?php
class Workstation extends AppModel {

	var $name = 'Workstation';

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
			'WorkstationCoupon' =>
				array('className' => 'WorkstationCoupon',
						'foreignKey' => 'workstation_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),
					
			'MerchantCoupon' =>
				array('className' => 'MerchantCoupon',
						'foreignKey' => 'workstation_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

			'WorkstationAttornLog' =>
				array('className' => 'WorkstationAttornLog',
						'foreignKey' => 'workstation_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'dependent' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
				),

	);
	
	function auditing($id = null,$sum = null,$money = null){
		/*  计算方法：转出方主体×100 + 接收方主体×10 + 动作
		    主体：0:无效 1:公司 2:会员 3:工作站 4:会员消费单位
		    动作：0:无效 1:销售 2:参与抽奖 3:财务审核 4:其它 */
		$status = 1*100 + 3*10 + 1; //应该定义成全局变量
		$limit = $money / $sum;
		$sql = 'select Coupon.id from coupons as Coupon where Coupon.status = 113 limit '.$limit;
        $coupons = $this->query($sql);
       
		$rs = $this->query($sql);
		if(sizeof($rs)>=$limit){
			for($i=0;$i<sizeof($rs);$i++){
				if($i==0){
					$ws_sql = 'insert into workstation_coupons(workstation_id,coupon_id,status)
				       values('.$id.','.$rs[$i]['Coupon']['id'].','.$status.')';
					$coupon_id = $rs[$i]['Coupon']['id'];
				}else{
					$ws_sql .= ',('.$id.','.$rs[$i]['Coupon']['id'].','.$status.')';
					$coupon_id .= ','.$rs[$i]['Coupon']['id'];
				}
			}
			$coupon_sql = 'update coupons set status = '.$status.' where id in('. $coupon_id .')';
			$this->execute($ws_sql);
			$this->execute($coupon_sql);
			return true;
		}else{
			return false;
		}
		
	}
	
	function getReferees($referees_no = null){
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