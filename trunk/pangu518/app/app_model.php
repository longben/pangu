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
}
?>