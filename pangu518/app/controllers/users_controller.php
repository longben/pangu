<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form','Javascript' );

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->User->findAll('User.id <> 1'));
	}
	
   function invite() {
   	  $this->layout='jiwai';
   }	

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for User.');
			$this->redirect('/users/index');
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->set('memberGrades', $this->User->MemberGrade->generateList());
			$this->set('regions', $this->User->Region->generateList());
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->User->save($this->data)) {
				$this->Session->setFlash('The User has been saved');
				$this->redirect('/users/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('memberGrades', $this->User->MemberGrade->generateList());
				$this->set('regions', $this->User->Region->generateList());
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('非法请求！');
				$this->redirect('/members/index');
			}
			$this->data = $this->User->read(null, $id);
			$this->set('memberGrades', $this->User->MemberGrade->generateList(
			  $conditions = null,
			  $order = null,
			  $limit = null,
			  $keyPath = '{n}.MemberGrade.id',
			  $valuePath = '{n}.MemberGrade.grade_name')
			);
			$this->set('regions', $this->User->Region->generateList(
			  $conditions = "id like '__0000'",
			  $order = 'id',
			  $limit = null,
			  $keyPath = '{n}.Region.id',
			  $valuePath = '{n}.Region.region_name')
			);
			$this->set('roles', $this->User->Role->generateList(
			  $conditions = null,
			  $order = 'id',
			  $limit = null,
			  $keyPath = '{n}.Role.id',
			  $valuePath = '{n}.Role.role_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->User->save($this->data)) {
				$this->Session->setFlash('会员资料保存成功！');
				$this->redirect('/members/index');
			} else {
				$this->Session->setFlash('请检查下面的错误.');
				$this->set('regions', $this->User->Region->generateList(
				  $conditions = "id like '__0000'",
				  $order = 'id',
				  $limit = null,
				  $keyPath = '{n}.Region.id',
				  $valuePath = '{n}.Region.region_name')
				);
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for User');
			$this->redirect('/users/index');
		}
		if($this->User->del($id)) {
			$this->Session->setFlash('The User deleted: id '.$id.'');
			$this->redirect('/users/index');
		}
	}
	
	function init($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for User');
			$this->redirect('/members/index');
		}
		
		if($this->User->del($id)) {
			$this->Session->setFlash('The User deleted: id '.$id.'');
			$this->redirect('/users/index');
		}
	}

	/**
	 * 会员业绩
	 *
	 * @param unknown_type $user_id
	 */
	function performance($user_id = null, $start_date = null, $end_date = null) {
		$this->set('performance', $this->User->getPerformance($user_id, $start_date, $end_date));
	}

	/**
	 * 历史分红
	 *
	 * @param unknown_type $user_id
	 */
	function bonus($user_id = null) {
	}

	/**
	 * 会员网络
	 *
	 * @param unknown_type $user_id
	 */
	function network($user_id = null) {
		$this->User->recursive = 0;
		$this->set('users', $this->User->findAllByReferees($user_id));		
	}
	
	function check($login_name = null){
		$this->layout = 'ajax';
		$this->set('isExistUser',$this->User->findCount(array('login_name' => $login_name)));
	}

}
?>