<?php
class User extends AppModel {

	var $name = 'User';
	
	var $belongsTo = array(
			'MemberGrade' =>
				array('className' => 'MemberGrade',
						'foreignKey' => 'member_grades_id',
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

			'Role' =>
				array('className' => 'Role',
						'foreignKey' => 'role_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);
	
	function getPerformance($user_id = null, $start_date = null, $end_date = null){
		$user_workstation = 0; //推荐工作站数目
		$user_workstation_pay = 0 ; //推荐工作站所得报酬
		$user_merchant = 0; //签定会员消费单位数目
		$user_merchant_coupon = 0; //签定会员消费单位所购代金券
		$user_referees = 0; //推荐会员数目
		$user_referees_coupon = 0;  //推荐会员所得代金券数目
		$income_tax = 0; //所得税
		$overhead_expenses = 0; //管理费用
		$total = 0 ; //累积所得
		
		//推荐工作站数目
		$w = $this->findBySql("select count(*) from workstations where referees = $user_id");
		$user_workstation = $w[0][0]['count(*)'];
		
		//指定时间范围内签订会员消费单位数目
		$m = $this->findBySql("select count(*) from merchants where referees = $user_id");
		$user_merchant = $m[0][0]['count(*)'];
		//签定会员消费单位所购代金券
		$m = $this->findBySql("select count(*) from merchant_coupons mc , merchants m 
		  where m.referees = $user_id and mc.merchant_id = m.id");
		$user_merchant_coupon = $m[0][0]['count(*)'];
				
		//推荐会员数目
		$user_referees = $this->findCount("referees = $user_id");
		//推荐会员所得代金券数目
		$uc = $this->findBySql("select count(*) from user_coupons uc , users u
		  where u.referees = $user_id and uc.user_id = u.id");
		$user_referees_coupon = $uc[0][0]['count(*)'];
		
		//提成比率
		$mg = $this->findBySql("select mg.member_per, mg.ws_per from member_grades mg , users as u
		  where u.id = $user_id and u.member_grades_id = mg.id");
		
		$u_per = $mg[0]['mg']['member_per']; //会员返回率
		$m_per = $mg[0]['mg']['ws_per']; //消费单位返回率
		
		$user_workstation_pay = $user_workstation * 3000;
		$user_referees_coupon = $user_referees_coupon * 2 * $u_per;
		$user_merchant_coupon = $user_merchant_coupon * 2 * $m_per;
		
	
		$_total = $user_workstation_pay + $user_referees_coupon + $user_merchant_coupon; //毛收入

		$income_tax = $this->getIncomeTax($_total); //所得税
		
		//$overhead_expenses = $_total * 0.05; //管理费用
		
		$total =  $_total - $income_tax - $overhead_expenses;
		
		
		$performance = array(
		  'user_workstation' => $user_workstation,
		  'user_workstation_pay' => $user_workstation_pay,
		  'user_merchant' => $user_merchant,
		  'user_merchant_coupon' => $user_merchant_coupon,
		  'user_referees' => $user_referees,
		  'user_referees_coupon' => $user_referees_coupon,
		  'income_tax' => $income_tax,
		  'overhead_expenses' => $overhead_expenses,
		  'total' => $total
		);
		return $performance;
	}

	
	function updateGrade($user_id = null){
		if($user_id != null & $user_id != 1){ //用户ID不为空也不能是管理员
			$this->data = $this->read(null,$user_id);
			$grade = $this->data['User']['member_grades_id'];
			switch ($grade){
				case 1: //个人会员
				    $user_count = $this->findCount(array('referees' => $user_id));
					$sql = "select count(*) from users a,users b where a.id = b.referees and a.referees = $user_id";
					$rs = $this->findBySql($sql);
					$user_count += $rs[0][0]['count(*)'];
				    if($user_count >= 1){ //发展个人会员100名以上
				    	$sql = 'select id from merchants where status = 1 and referees = '.$user_id;
				    	$rs = $this->findBySql($sql);
				    	if($rs != null){
				    		$merchant_count = sizeof($rs);
				    		if($merchant_count >= 1){ //发展会员签约单位10家以上
				    			$sql = "update users set member_grades_id = 2 where id = " . $user_id;
				    			$this->execute($sql); 
				    		}
				    	}
				    }
					$this->updateGrade($this->data['User']['referees']);
					
					break;
				case 2: //签约会员
				    $user_count = $this->findCount("User.referees = $user_id and User.member_grades_id >= 2");
				    echo $user_count;
				    if($user_count >= 1){ //30
				    	$sql = "update users set member_grades_id = 3 where id = " . $user_id;
				    	$this->execute($sql);
				    }
					$this->updateGrade($this->data['User']['referees']);
					
					break;
				case 3: //蓝领会员
				    $user_count = $this->findCount("User.referees = $user_id and User.member_grades_id >= 3");
				    if($user_count >= 1){ //30
				    	$sql = "update users set member_grades_id = 4 where id = " . $user_id;
				    	$this->execute($sql);
				    }
					$this->updateGrade($this->data['User']['referees']);
					break;
				case 4: //白领会员
				    $user_count = $this->findCount("User.referees = $user_id and User.member_grades_id >= 4");
				    if($user_count >= 1){ //30
				    	$sql = "update users set member_grades_id = 5 where id = " . $user_id;
				    	$this->execute($sql);
				    }
					$this->updateGrade($this->data['User']['referees']);
					break;
			}
			$this->create(); //再循环
		}
	}	

}
?>