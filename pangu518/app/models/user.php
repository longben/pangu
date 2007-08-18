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

	);

	function updateGrade($user_id = null){
		if($user_id != null & $user_id != 1){ //用户ID不为空也不能是管理员
			$this->data = $this->read(null,$user_id);
			$grade = $this->data['User']['member_grades_id'];
			switch ($grade){
				case 1: //个人会员
				    $user_count = $this->findCount(array('referees' => $user_id));
				    if($user_count >= 100){ //发展个人会员100名以上
				    	$sql = 'select id from merchants where status = 1 and referees = '.$user_id;
				    	$rs = $this->findBySql($sql);
				    	if($rs != null){
				    		$merchant_count = sizeof($rs);
				    		if($merchant_count >= 10){ //发展会员签约单位10家以上
				    			$sql = "update users set member_grades_id = 2 where id = " . $user_id;
				    			$this->execute($sql); 
				    		}
				    	}
				    }
					break;
				case 2: //签约会员
				    $user_count = $this->findCount(array('referees' => $user_id,'member_grades_id' => ' >= 2'));
				    if($user_count >= 30){
				    	$sql = "update users set member_grades_id = 3 where id = " . $user_id;
				    	$this->execute($sql);
				    }
					break;
				case 3: //蓝领会员
				    $user_count = $this->findCount(array('referees' => $user_id,'member_grades_id' => ' >= 3'));
				    if($user_count >= 30){
				    	$sql = "update users set member_grades_id = 4 where id = " . $user_id;
				    	$this->execute($sql);
				    }				
					break;
				case 4: //白领会员
				    $user_count = $this->findCount(array('referees' => $user_id,'member_grades_id' => ' >= 4'));
				    if($user_count >= 30){
				    	$sql = "update users set member_grades_id = 5 where id = " . $user_id;
				    	$this->execute($sql);
				    }						
					break;
				case 5: //金领会员
				    $user_count = $this->findCount(array('referees' => $user_id,'member_grades_id' => ' >= 5'));
				    if($user_count >= 30){
				    	$sql = "update users set member_grades_id = 6 where id = " . $user_id;
				    	$this->execute($sql);
				    }				
					break;
			}
		}
	}	

}
?>