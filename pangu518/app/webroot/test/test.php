<?php

	// DB LINK
	$db_name 		= "pangu518";
	$db_host 		= "localhost";
	$db_user 		= "root";
	$db_password 	= "";	

	$db = mysql_connect($db_host, $db_user, $db_password);
	mysql_query("set names 'utf8'");
	mysql_select_db($db_name, $db);

	
	set_time_limit(0);
	$SLEEP_TIMER = 5;
	$REFRESH_EACH = 600;


	/**
	 * 密码生成算法
	 *
	 * @param int $custom_num
	 * @param int $random_num
	 * @return int
	 */
	function getPassword($custom_num = 0,$random_num = 0){
		$pwd = (int)$custom_num ^ (int)$random_num; //用户输入6位数字和6位随机数异或产生密码
		$pwd = substr($pwd, 0, 6); //只保留6位数
		$pwd = sprintf('%06s', $pwd);
		return $pwd;
	}

	$sql = "select coupon_start,coupon_end,coupon_group,custom_num,id from coupon_lists where status = 0";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);

	$coupon_start = $arr[0];
	$coupon_end = $arr[1];
	$coupon_group = $arr[2];
	$custom_num = $arr[3];
	$updateID = $arr[4];

	//echo $coupon_start."<br>".$coupon_end."<br>".$coupon_group."<br>".$custom_num."<hr>";


	if($coupon_start){

		for($i=$coupon_start;$i<=$coupon_end;$i++){

			//echo $i."<br>";

			//当开始执行生成代金券，将序列中的该条记录状态更改为1（生成中）
			if($i == $coupon_start){
				$UpdateStatus = "update coupon_lists set status = 1 where id =".$updateID;
				mysql_query($UpdateStatus);
			}

			srand((double)microtime()*1000000);//时间的因素，以执行时的百万分之一秒当乱数种子
			$randval = rand(10000,99999);

			$coupon_no = $coupon_group .sprintf('%09s', $i);
			$coupon_pwd = getPassword($custom_num,$randval);

			$insert_time = time();

			$InsertCoupon = "insert into coupons(coupon_no,coupon_pwd,custom_num,random_num,coupon_group,created) values('".$coupon_no."','".$coupon_pwd."','".$custom_num."','".$randval."','".$coupon_group."',".$insert_time.")";
			mysql_query($InsertCoupon);

			//当全部执行完成，生成所有代金券，将序列中的该条记录状态更改为2（生成完毕）
			if($i == $coupon_end){
				$UpdateStatus = "update coupon_lists set status = 2 where id =".$updateID;
				mysql_query($UpdateStatus);
			}


		}

	}
	
	if($updateID){
		echo('该批次代金券初始化成功！');
	}else{
		echo('无新批次代金券初始化！');
	}

?>