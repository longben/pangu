<?php

//请根据开发或者生产实际环境修改include_path路径
ini_set('include_path', 'D:/workspace4php/pangu518/app/vendors/Pear/' . PATH_SEPARATOR . ini_get('include_path'));

class AppModel extends Model{

	function generateList4TreeData($conditions = null, $order = null, $limit = null, $keyPath = null, $valuePath = null) {
		if ($keyPath == null && $valuePath == null && $this->hasField($this->displayField)) {
			$fields = array($this->primaryKey, $this->displayField);
		} else {
			$fields = null;
		}
		$recursive = $this->recursive;

		if ($recursive >= 1) {
			$this->recursive = -1;
		}
		$result = $this->findAllThreaded($conditions,$fields,$order);
		$this->recursive = $recursive;

		if (!$result) {
			return false;
		}

		if ($keyPath == null) {
			$keyPath = '{n}.' . $this->name . '.' . $this->primaryKey;
		}

		if ($valuePath == null) {
			$valuePath = '{n}.' . $this->name . '.' . $this->displayField;
		}

		$keys = Set::extract($result, $keyPath);
		$vals = Set::extract($result, $valuePath);

		if (!empty($keys) && !empty($vals)) {
			$return = array_combine($keys, $vals);
			return $return;
		}
		return null;
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