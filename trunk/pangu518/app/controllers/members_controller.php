<?php
class MembersController extends AppController {

	var $name = 'Members';
	var $components = array('Acl','AjaxValid','Pagination');//Make sure you include this, it makes the magic work.
	var $helpers = array('Html', 'Javascript', 'Ajax', 'Form', 'Time','Pagination');
	
    function validator(){
        $this->layout = '';
        $this->AjaxValid->return = 'javascript';
        $this->AjaxValid->changeClass('errors');
        $this->AjaxValid->setForm($this->data,'Member/index','redirect');
        $this->AjaxValid->required(array('Member/username','Member/password','Member/email'));
        $this->AjaxValid->unique(array('Member/email'));
        $this->AjaxValid->confirm('Member/password', array('Member/confirm'), '两次输入口令不匹配.');
        $this->set('data',$this->AjaxValid->validate());
        $this->set('valid',$this->AjaxValid->valid);
        if($this->AjaxValid->valid){
          $this->User->save($this->AjaxValid->form['Member']);
        }
    } 

	function index($keyword = null, $page=1) {
		$this->Member->recursive = 0;
		
		$criteria = "Member.uid <> 1";
		if($keyword == null){
			$keyword = $this->data['Member']['keyword'];
		}		
		if($keyword != null){
			$criteria = "Member.uid <> 1 and (Member.username like '%$keyword%' or User.user_name like '%$keyword%')";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'index/'.$keyword));
		
		$data = $this->Member->findAll($criteria, NULL, null, $limit, $page); 			
		$this->set('members',$data);
	}

	function view($id = null) {
		if ($this->Acl->check($this->Session->read('User.id'), $this->Session->read('User.username'), 'read')){
			$this->Session->setFlash('无权查看！');
			$this->redirect('/members/index');
		}
		if(!$id) {
			$this->Session->setFlash('Invalid id for Member.');
			$this->redirect('/members/index');
		}
		echo $this->Session->read('User.username');
		$this->set('member', $this->Member->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->render();
		} else {
        	if($this->Member->findByUsername($this->data['Member']['username'])){
        		$this->Member->invalidate('username');
        		$this->set('username_error', '用户名已经存在！');
        	}else{
        		$this->cleanUpFields();
        		$this->data['Member']['password'] = md5($this->data['Member']['password']);
        		$member_alias = $this->data['Member']['username'];
        		if($this->Member->save($this->data)) {
        		  $aro = new Aro();
        		  $aro->create($this->Member->uid, 'Members',$this->data['Member']['username']);//把新增用户添加到"Members"组中
        		  
        		  $aco = new Aco();
        		  $aco->create($member_id, 3, $member_alias);
        		  $this->Acl->allow('Admins', $member_alias,'*');
        		  $this->Acl->allow($this->Session->read('User.id'), $member_alias, '*');
       		   		          		  
				  $this->Session->setFlash('添加成功！');
				  $this->redirect('/members/index');
			    } else {
				  $this->Session->setFlash('添加用户出错！');
			    }        		
        	}
		}
	}
	
	function register() {
		if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->Member->save($this->data)) {
				$this->Session->setFlash('注册成功！');
				$this->redirect('/members/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}
	
	function profile() {
		$id = $this->Session->read('User.id');
		$this->set('regions', $this->Member->User->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
		);
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('无效的用户！');
			}
			$this->data = $this->Member->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Member->save($this->data)) {
				$this->data['User']['id'] = $id;
				$this->data['User']['member_no'] = $this->data['User']['region_id'].$this->data['User']['cert_number'];
				if($this->Member->User->save($this->data)){
					$this->Session->setFlash('会员信息修改成功！');
				}else{
					$this->Session->setFlash('会员信息保存出错！');
				}
			} else {
				$this->Session->setFlash('会员信息保存出错！');
			}
		}
	}	

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Member');
				$this->redirect('/members/index');
			}
			$this->data = $this->Member->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Member->save($this->data)) {
				$this->Session->setFlash('会员信息修改成功！');
				$this->redirect('/members/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Member');
			$this->redirect('/members/index');
		}
		if($this->Member->del($id)) {
			$this->Session->setFlash('The Member deleted: id '.$id.'');
			$this->redirect('/members/index');
		}
	}
	
	function install(){
		$aro = new Aro();
		
		//创建组
		$aro->create(0, null, 'Admins');
		$aro->create(0, null, 'Finances');
		$aro->create(0, null, 'Members');
		$aro->create(0, null, 'Workstations');
		$aro->create(0, null, 'Merchants');
		
		//创建ARO（admin）
		$aro->create( 1, null, 'admin');
		
		//把admin授权到Admins组
		$aro->setParent('Admins', 'admin');
		
		$this->Session->setFlash('系统授权成功！');
	}
	
   function login() {
      
	  $this->layout="admin";

      if (!empty($this->data)){
		$this->cleanUpFields();
      	$this->someone = $this->Member->findByUsername($this->data['Member']['username']);
      	if(!empty($this->someone['Member']['password']) && ($this->someone['Member']['password'] == md5($this->data['Member']['password']))){
      		if(mktime() - $this->someone['Member']['lastvisit']  > 88){
				$user = $this->Member->User->read(null, $this->someone['Member']['uid']);
				$this->someone['Member']['lastip'] = $_SERVER["REMOTE_ADDR"];
				$this->someone['Member']['lastvisit'] = mktime();
				$sql = "update members set lastip = '" . $_SERVER["REMOTE_ADDR"] . "',";
				$sql .= " lastvisit = " . mktime();
				$sql .= " where uid = " . $this->someone['Member']['uid'];
				$this->Member->execute($sql);
				$this->Session->write('User',$user['User']);
		      	$this->Session->write('Member', $this->someone['Member']);
		      	$this->Session->write('password',md5($this->data['Member']['password']));
		      	$this->redirect('/admin_index');				
      		}else {
      			$this->Session->setFlash('会员重复登录！'); //重复登录。
      		}
      	}
      	else{
      		$this->Session->setFlash('会员用户名或者口令不正确！');
      	}
      }
   }
   
   function password() {
		if(!empty($this->data)) {
			$old_password = md5($this->data['Member']['old']);
			$password = md5($this->data['Member']['new']);
			$this->data = $this->Member->read(null, $this->Session->read('User.id'));
			if($old_password != $this->data['Member']['password']){
				$this->Session->setFlash('会员原口令不正确！');
			}else{
			  	$sql = "update members set password = '$password' where uid = " .$this->Session->read('User.id');
			  	$this->Member->execute($sql);
			  	$this->Session->setFlash('会员口令修改成功！');		
			}			
		}
   }   
   
  function logout(){
    $this->layout="admin";
    $this->Session->delete('User');
    $this->redirect('/admin/');
  }
  
  function refresh(){
    $this->layout="ajax";
  	$sql = "update members set lastvisit = " . mktime() ." where uid = ". $this->Session->read('User.id');
  	$this->Member->execute($sql);
  }  
  
  function initpassword($id = null, $pwd = null){
  	$this->layout = 'ajax';
  	if($pwd == null){
  		$pwd = md5('888888');
  	}else{
  		$pwd = md5($pwd);
  	}
  	
  	$sql = "update members set password = '$pwd' where uid = $id";
  	$this->Member->execute($sql);
  
  }
   
}
?>