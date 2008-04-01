<?php
class VideoesController extends AppController {

	var $name = 'Videoes';
	var $helpers = array('Html', 'Form', 'Habtm');

	function index() {
		$this->Video->recursive = 0;
		$this->set('videoes', $this->Video->findAll('order by name desc'));
	}


	function add() {
		if (empty($this->data)) {
          	$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Video->save($this->data)) {
				$this->Session->setFlash('视频文件名保存成功.');
				$this->redirect('/videoes/index');
			} else {
				$this->Session->setFlash('请检查下面的错误.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Role');
				$this->redirect('/videoes/index');
			}
			$this->data = $this->Video->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Video->save($this->data)) {
				$this->Session->setFlash('视频文件名修改成功.');
				$this->redirect('/videoes/index');
			} else {
				$this->Session->setFlash('请检查下面的错误.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Role');
			$this->redirect('/videoes/index');
		}
		if ($this->Video->del($id)) {
			$this->Session->setFlash('视频文件名删除成功.');
			$this->redirect('/videoes/index');
		}
	}

}
?>