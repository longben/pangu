<?php

	// DB LINK
	$db_name 		= "pangu518";
	$db_host 		= "localhost";
	$db_user 		= "root";
	$db_password 	= "";	

	$db = mysql_connect($db_host, $db_user, $db_password);
	mysql_query("set names 'utf8'");
	mysql_select_db($db_name, $db);


	
	$sql = "select id from coupon_lists where status = 0";
	$stmt = mysql_query($sql);
	$arr = mysql_fetch_array($stmt);

	$id = $arr[0];

	if($id){
		//表示存在还没有执行的生成代金券序列，需要等待生成完成才能再继续【这个其实也可以不做限制，因为有序列表，可以不管，但是为了预防出现重复提交的编号，先只允许序列表中只有唯一一个等待执行的序列】
		
		echo "上次的批量生成代金券还未完成，请耐心等待完成后再生成新的代金券！";

	}else{
		$InsertList = "insert into coupons(coupon_start,coupon_end,coupon_group,custom_num) values('".$coupon_start."','".$coupon_end."','".$coupon_group."','".$custom_num."')";
		mysql_query($InsertList);
	}

	//另外，就是有关是否判断代金券编码重复的事情，我考虑的是就不判断了，因为数据量很大，交付时会在文档中给客户这边详细说明，并可以通过查看今天新增的序列表，看到每批次的起止组合编号，结合客户反馈，可以根据这张表的数据，将组合后完整编码的起止编号罗列出来。

?>