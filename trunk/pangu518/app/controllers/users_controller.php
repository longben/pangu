<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form','Javascript', 'Pagination' );
	var $components = array('Pagination');

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
			$this->set('user', $this->data);
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
	 */
	function performance($user_id = null) {
		$this->User->recursive = 0;
		$this->cleanUpFields();

		if (empty($this->data)) {
			$start_date = date("Y").'-'.date("m").'-1';
			$end_date = date("Y").'-'.date("m").'-'.date("d")+1;
		}else{
			$start_date = $this->data['User']['start_time_year'].'-'.$this->data['User']['start_time_month'].'-'.$this->data['User']['start_time_day'];
			$end_date = $this->data['User']['end_time_year'].'-'.$this->data['User']['end_time_month'].'-'.$this->data['User']['end_time_day'];
		}

		$this->set('performance', $this->User->getPerformance($user_id, $start_date, $end_date));
		$this->set('user_id',$user_id);
	}

	/**
	 * 历史分红
	 *
	 */
	function bonus($user_id = null) {
	}

	/**
	 * 会员网络
	 *
	 * @param unknown_type $user_id
	 */
	function network($user_id = null,$keyword = null) {
		$this->User->recursive = 0;

		$criteria = "User.referees = $user_id";
		if($keyword == null){
			$keyword = $this->data['User']['keyword'];
		}		
		if($keyword != null){
			$criteria = "User.referees = $user_id and (User.login_name like '%$keyword%' or User.user_name like '%$keyword%')";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'network/'. $user_id . '/' .$keyword));
		
		$data = $this->User->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('users',$data);
		$this->set('user_id',$user_id);
	}
	
	function check($login_name = null){
		$this->layout = 'ajax';
		$count = 0;
		$this->data = $this->User->findByLoginName($login_name);
		if($this->data != null){
			$count = 1;
			if($this->User->Workstation->findCount(array('user_id' => $this->data['User']['id'])) > 0){
				$count = 87;
			}

			if($this->User->Merchant->findCount(array('user_id' => $this->data['User']['id'])) > 0){
				$count = 77;
			}
		}

		//$this->set('isExistUser',$this->User->findCount(array('login_name' => $login_name)));
		$this->set('isExistUser',$count);
	}
	
	function check_referees($login_name = null,$referees = null){
		$this->layout = 'ajax';
		$count = $this->User->findCount(array('login_name' => $referees));
		if($count == 0){
			$this->set('isExistUser',0);
		}else{
			$user = $this->User->findByLoginName($login_name);
			$user2 = $this->User->findByLoginName($referees); //推荐人
			if($user['User']['id'] == $user2['User']['referees']){
				$this->set('isExistUser',0);
			}else{
				$this->set('isExistUser',1);
			}
		}
	}	
	
	function getUserName($id = null){
		$this->data = $this->User->read(null, $id);
		return $this->data['User']['user_name'];
	}
	
	function upgrade($id = null){
		$this->layout = 'ajax';
		$this->User->updateGrade($id);
	}

	function user_tree($user_id = null, $out = null){
		$this->layout = 'ajax';
		$arr = $this->User->getUserTree($user_id,null,null);
		$this->set('out',$arr['out']);
	}
}
?>