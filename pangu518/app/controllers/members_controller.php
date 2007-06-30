<?php
class MembersController extends AppController {

	var $name = 'Members';
	var $components = array('AjaxValid');//Make sure you include this, it makes the magic work.
	var $helpers = array('Html', 'Javascript', 'Ajax','Form');
	
    function validator(){
        $this->layout = '';
        $this->AjaxValid->return = 'javascript';
        $this->AjaxValid->changeClass('errors');
        $this->AjaxValid->setForm($this->data,'Member/index','redirect');
        $this->AjaxValid->required(array('Member/username','Member/password','Member/email'));
        $this->AjaxValid->unique(array('Member/email'));
        $this->AjaxValid->confirm('Member/password', array('Member/confirm'), 'Your passwords do not match');
        $this->set('data',$this->AjaxValid->validate());
        $this->set('valid',$this->AjaxValid->valid);
        if($this->AjaxValid->valid){
          $this->User->save($this->AjaxValid->form['Member']);
        }
    } 

	function index() {
		$this->Member->recursive = 0;
		$this->set('members', $this->Member->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Member.');
			$this->redirect('/members/index');
		}
		$this->set('member', $this->Member->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->render();
		} else {
        	if($this->Member->findByUsername($this->data['Member']['username'])){
        		$this->Member->invalidate('username');
        		$this->set('username_error', 'User already exists.');
        	}else{
        		$this->cleanUpFields();
        		$this->data['Member']['password'] = md5($this->data['Member']['password']);
        		if($this->Member->save($this->data)) {
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
	
   function login() {
      //$this->layout="admin";
      $this->set('error', false);
      if (!empty($this->data)){
      	$someone = $this->Member->findByUsername($this->data['Member']['username']);

      	// Compare the MD5 encrypted version of the password against recorded encrypted password.
      	if(!empty($someone['Member']['password']) &&
            ($someone['Member']['password'] == md5($this->data['Member']['password']))){
      		$this->Session->write('User', $someone['Member']);
      		$this->redirect('/admin_index.php');
      	}
      	else{
      		$this->set('error', true);
      	}
      }
   }
   
  function logout(){
    $this->layout="admin";
    $this->Session->delete('User');
    $this->redirect('/admin/');
  }
   
}
?>