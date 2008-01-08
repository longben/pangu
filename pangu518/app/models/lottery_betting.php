<?php
class LotteryBetting extends AppModel {

	var $name = 'LotteryBetting';

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
	 * 检查用户拥有代金券总数
	 *
	 * @param int $user_id
	 * @param int $betting_time
	 * @return boolean
	 */
	function findCountUserCoupon($user_id = null, $status = null){
    	$sql = 'select count(*) from user_coupons as UserCoupon ';
    	$sql .= ' where UserCoupon.user_id = ' . $user_id;
    	$sql .= ' and UserCoupon.status = ' . $status;
        $coupons = $this->query($sql);
        $rs = $this->query($sql);
		return $rs[0][0]['count(*)'];
	}


	/**
	 * 会员批量投注
	 * @param int $user_id  会员ID
	 * @param int $lottery_id 开奖期数
	 * @param int $betting_number_start 投注开始号码
	 * @param int $betting_number_end 投注结束号码
	 * @param int $betting_time 每个号码投注份数
	 * @param int $betting_total 总投注数
	 * @return boolean
	 */
	function saveUserBettingBatch($user_id = null, $lottery_id = null, $betting_number_start = null, $betting_number_end = null, $betting_time = null, $betting_total = null){

		/*  计算方法：转出方主体×100 + 接收方主体×10 + 动作
		    主体：0:无效 1:公司 2:会员 3:工作站 4:会员消费单位
		    动作：0:无效 1:销售 2:参与抽奖 3:财务审核 4:其它 */
		$status = 2*100 + 1*10 + 2; //应该定义成全局变量    	
    	
    	$limit = $betting_total * 1; //会员消费单位每1张代金券一次分红资格

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

			//插入投注数据
			for ($i = $betting_number_start;$i<=$betting_number_end;$i++){
				$sql = "insert into lottery_bettings(lottery_id,betting_number,betting_time,betting_type,user_id,flag)";
				$sql .= " values($lottery_id,'". sprintf('%03s',$i) ."',$betting_time,'1',$user_id,'1')";
				$this->execute($sql);
			}

        }else{
        	return false;
        }
		return true;
	}

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
    	$sql = 'select MerchantVoucher.coupon_id from merchant_vouchers as MerchantVoucher ';
    	$sql .= ' where MerchantVoucher.merchant_id = ' . $merchant_id;
    	$sql .= ' and MerchantVoucher.status = 341';
    	$sql .= ' order by MerchantVoucher.coupon_id';
    	$sql .= ' limit '.$limit;
        $coupons = $this->query($sql);
        $rs = $this->query($sql);
        
        if(sizeof($rs)>=$limit){
			for($i=0;$i<sizeof($rs);$i++){
				if($i==0){
					$coupon_id = $rs[$i]['MerchantVoucher']['coupon_id'];
				}else{
					$coupon_id .= ','.$rs[$i]['MerchantVoucher']['coupon_id'];
				}
			} 
			
			//更新会员消费单位代金券分红凭证状态
			$sql = 'update merchant_vouchers set status = '.$status.' where coupon_id in('. $coupon_id .')';
			$this->execute($sql);			

        }else{
        	return false;
        }
		return true;
	}	

}
?>