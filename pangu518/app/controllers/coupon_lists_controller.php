<?php
class CouponListsController extends AppController {

	var $name = 'CouponLists';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->CouponList->recursive = 0;
		$this->set('couponLists', $this->CouponList->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Coupon List.');
			$this->redirect('/coupon_lists/index');
		}
		$this->set('couponList', $this->CouponList->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->CouponList->save($this->data)) {
				$this->Session->setFlash('The Coupon List has been saved');
				$this->redirect('/coupon_lists/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}
	
	function check($coupon_group = null,$coupon_start = null,$coupon_end = null){
	    $this->layout = 'ajax';
	    $coupon_group = strtoupper($coupon_group);
	    $msg = '';
		$conditions = "	where coupon_group='$coupon_group'
		    and  ((coupon_start  = $coupon_start 
		      or coupon_start = $coupon_end  or coupon_end =$coupon_start
                  or coupon_end = $coupon_end ) or (coupon_start < $coupon_start
                     and $coupon_end <coupon_end ) or (coupon_start < $coupon_start
                        and $coupon_start <coupon_end ) or (coupon_start < $coupon_end
                          and $coupon_end <coupon_end ))";
	    $count = $this->CouponList->findCount("coupon_group = '$coupon_group' and (coupon_start >= $coupon_start
	       or coupon_start >= $coupon_end or coupon_end >= $coupon_start or coupon_end >= $coupon_end)");
        //$count = $this->CouponList->findCount($conditions);
	    if($count>0){
	    	$msg = "提示：[" .$coupon_group ."]组团代金券，起止号码[$coupon_start]至[$coupon_end]已经使用！\n请重新选择起止号码！\n\n";
		    $this->data = $this->CouponList->findAllByCouponGroup($coupon_group);
		    $msg .= $coupon_group ."组团代金券数据：\n";
		    $msg .= "_______________________________\n";
		    foreach ($this->data as $couponList){
		    	$msg .= "开始号码：" . $couponList['CouponList']['coupon_start'] ."  结束号码：" . $couponList['CouponList']['coupon_end'] . "\n";
		    	$msg .= "_______________________________\n";
		    }
	    }
	    $this->set('msg',$msg);
    }

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Coupon List');
				$this->redirect('/coupon_lists/index');
			}
			$this->data = $this->CouponList->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->CouponList->save($this->data)) {
				$this->Session->setFlash('The CouponList has been saved');
				$this->redirect('/coupon_lists/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Coupon List');
			$this->redirect('/coupon_lists/index');
		}
		if ($this->CouponList->del($id)) {
			$this->Session->setFlash('The Coupon List deleted: id '.$id.'');
			$this->redirect('/coupon_lists/index');
		}
	}

}
?>