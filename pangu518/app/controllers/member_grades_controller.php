<?php
class MemberGradesController extends AppController {

	var $name = 'MemberGrades';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->MemberGrade->recursive = 0;
		$this->set('memberGrades', $this->MemberGrade->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Member Grade.');
			$this->redirect('/member_grades/index');
		}
		$this->set('memberGrade', $this->MemberGrade->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if($this->MemberGrade->save($this->data)) {
				$this->Session->setFlash('会员等级添加成功！');
				$this->redirect('/member_grades/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Member Grade');
				$this->redirect('/member_grades/index');
			}
			$this->data = $this->MemberGrade->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->MemberGrade->save($this->data)) {
				$this->Session->setFlash('会员等级修改成功！');
				$this->redirect('/member_grades/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Member Grade');
			$this->redirect('/member_grades/index');
		}
		if($this->MemberGrade->del($id)) {
			$this->Session->setFlash('The Member Grade deleted: id '.$id.'');
			$this->redirect('/member_grades/index');
		}
	}

}
?>