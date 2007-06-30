<?php
class MemberInfosController extends AppController {

	var $name = 'MemberInfos';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->MemberInfo->recursive = 0;
		$this->set('memberInfos', $this->MemberInfo->findAll());
	}

	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Member Info.');
			$this->redirect('/member_infos/index');
		}
		$this->set('memberInfo', $this->MemberInfo->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->set('memberGrades', $this->MemberInfo->MemberGrade->generateList());
			$this->set('regions', $this->MemberInfo->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			$this->data['MemberInfo']['member_no'] = $this->data['MemberInfo']['region_id'].$this->data['MemberInfo']['cert_number'];
			if($this->MemberInfo->save($this->data)) {
				$this->Session->setFlash('The Member Info has been saved');
				$this->redirect('/member_infos/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('memberGrades', $this->MemberInfo->MemberGrade->generateList());
				$this->set('regions', $this->MemberInfo->Region->generateList());
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Member Info');
				$this->redirect('/member_infos/index');
			}
			$this->data = $this->MemberInfo->read(null, $id);
			$this->set('memberGrades', $this->MemberInfo->MemberGrade->generateList());
			$this->set('regions', $this->MemberInfo->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->MemberInfo->save($this->data)) {
				$this->Session->setFlash('The MemberInfo has been saved');
				$this->redirect('/member_infos/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('memberGrades', $this->MemberInfo->MemberGrade->generateList());
				$this->set('regions', $this->MemberInfo->Region->generateList());
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Member Info');
			$this->redirect('/member_infos/index');
		}
		if($this->MemberInfo->del($id)) {
			$this->Session->setFlash('The Member Info deleted: id '.$id.'');
			$this->redirect('/member_infos/index');
		}
	}

}
?>