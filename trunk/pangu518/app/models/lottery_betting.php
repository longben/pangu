<?php
class LotteryBetting extends AppModel {

	var $name = 'LotteryBetting';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Lottery' =>
				array('className' => 'Lottery',
						'foreignKey' => 'lottery_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'User' =>
				array('className' => 'User',
						'foreignKey' => 'user_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

			'Merchant' =>
				array('className' => 'Merchant',
						'foreignKey' => 'merchant_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	
	/**
	 * 会员抽奖
	 *
	 * @param int $user_id
	 * @param int $lottery_id
	 * @param int $betting_number
	 * @param int $betting_time 投奖数
	 * @return boolean
	 */
    function saveUserBetting($user_id = null, $lottery_id = null, $betting_number = null, $betting_time = null){
    	//判断用户代金券数是否够抽奖数
    	
		/*  计算方法：转出方主体×100 + 接收方主体×10 + 动作
		    主体：0:无效 1:公司 2:会员 3:工作站 4:会员消费单位
		    动作：0:无效 1:销售 2:参与抽奖 3:财务审核 4:其它 */
		$status = 2*100 + 1*10 + 2; //应该定义成全局变量    	
    	
    	$limit = $betting_time * 1; //会员消费单位每1张代金券一次分红资格
    	$sql = 'select UserCoupon.coupon_id from user_coupons as UserCoupon ';
    	$sql .= ' where UserCoupon.user_id = ' . $user_id;
    	$sql .= ' and UserCoupon.status = 421';
    	$sql .= ' order by UserCoupon.coupon_id';
    	$sql .= ' limit '.$limit;
        $coupons = $this->query($sql);
        $rs = $this->query($sql);
        
        if(sizeof($rs)>=$limit){
			for($i=0;$i<sizeof($rs);$i++){
				if($i==0){
					$coupon_id = $rs[$i]['UserCoupon']['coupon_id'];
				}else{
					$coupon_id .= ','.$rs[$i]['UserCoupon']['coupon_id'];
				}
			} 
			
			//更新会员代金券状态
			$sql = 'update user_coupons set status = '.$status.' where coupon_id in('. $coupon_id .')';
			$this->execute($sql); 
			
			//更新代金券状态
			$sql = 'update coupons set status = '.$status.' where id in('. $coupon_id .')';
			$this->execute($sql); 
        }else{
        	return false;
        }
		return true;
	}
	
	/**
	 * 会员消费单位抽奖
	 *
	 * @param int $merchant_id
	 * @param int $lottery_id
	 * @param int $betting_number
	 * @param int $betting_time
	 * @return boolean
	 */
    function saveMerchantBetting($merchant_id = null, $lottery_id = null, $betting_number = null, $betting_time = null){
    	//判断用户代金券数是否够抽奖数
    	
		/*  计算方法：转出方主体×100 + 接收方主体×10 + 动作
		    主体：0:无效 1:公司 2:会员 3:工作站 4:会员消费单位
		    动作：0:无效 1:销售 2:参与抽奖 3:财务审核 4:其它 */
		$status = 4*100 + 1*10 + 2; //应该定义成全局变量    	
    	
    	$limit = $betting_time * 25; //会员消费单位每25张代金券一次分红资格
    	$sql = 'select MerchantCoupon.coupon_id from merchant_coupons as MerchantCoupon ';
    	$sql .= ' where MerchantCoupon.merchant_id = ' . $merchant_id;
    	$sql .= ' and MerchantCoupon.status = 341';
    	$sql .= ' order by MerchantCoupon.coupon_id';
    	$sql .= ' limit '.$limit;
        $coupons = $this->query($sql);
        $rs = $this->query($sql);
        
        if(sizeof($rs)>=$limit){
			for($i=0;$i<sizeof($rs);$i++){
				if($i==0){
					$coupon_id = $rs[$i]['MerchantCoupon']['coupon_id'];
				}else{
					$coupon_id .= ','.$rs[$i]['MerchantCoupon']['coupon_id'];
				}
			} 
			
			//更新会员代金券状态
			$sql = 'update merchant_coupons set status = '.$status.' where coupon_id in('. $coupon_id .')';
			$this->execute($sql); 
			
			//更新代金券状态
			$sql = 'update coupons set status = '.$status.' where id in('. $coupon_id .')';
			$this->execute($sql); 
        }else{
        	return false;
        }
		return true;
	}	

}
?>