<?php
class AppController extends Controller {
	
	/*  主体：0:无效 1:公司 2:会员 3:工作站 4:会员消费单位*/
	var $_company = 1;
	var $_user = 2;
	var $_workstation = 3;
	var $_merchant = 4;


	function bzip2($in, $out){
	   if (!file_exists ($in) || !is_readable ($in))
		   return false;
	   if ((!file_exists ($out) && !is_writeable (dirname ($out)) || (file_exists($out) && !is_writable($out)) ))
		   return false;
	   
	   $in_file = fopen ($in, "r");
	   $out_file = bzopen($out, "w");
	   
	   while (!feof ($in_file)) {
		   $buffer = fgets ($in_file, 4096);
			 bzwrite ($out_file, $buffer, 4096);
	   }

	   fclose ($in_file);
	   bzclose ($out_file);
	   
	   return true;
	}

	/*
	用速算扣除数计算
	工资、薪金所得项目税率表
	级数---全月应纳税所得额-------------税率%--速算扣除法（元）
	1-------不超过500元的-----------------5---------0
	2------超过500元至2000元的部分-------10--------25
	3------超过2000元至5000元的部分------15 ------125
	4------超过5000元至20000元的部分-----20 ----- 375
	5------超过20000元至40000元的部分----25------1375
	6------超过40000元至60000元的部分----30------3375
	7------超过60000元至80000元的部分----35------6375
	8------超过80000元至100000元的部分---40-----10375
	9------超过100000元的部分------------45-----15375
	*/
	function getIncomeTax($money = null){
		$radix = 1600;
		$money = $money - $radix;
		if($money > 0){
			if($money < 500){
				return $money * 0.05;
			}
			if($money >= 500 && $money< 2000){
				return $money * 0.1 - 25;
			}

			if($money >= 2000 && $money< 5000){
				return $money * 0.15 - 125;
			}

			if($money >= 5000 && $money< 20000){
				return $money * 0.2 - 375;
			}

			if($money >= 20000 && $money< 40000){
				return $money * 0.25 - 1375;
			}

			if($money >= 40000 && $money< 60000){
				return $money * 0.3 - 3375;
			}

			if($money >= 60000 && $money< 80000){
				return $money * 0.35 - 6375;
			}

			if($money >= 80000 && $money< 100000){
				return $money * 0.4 - 10375;
			}

			if($money >= 100000){
				return $money * 0.45 - 15375;
			}

		}else{
			return 0; 
		}
	}
	
}
?>