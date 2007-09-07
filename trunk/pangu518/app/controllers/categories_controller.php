<?php
class CategoriesController extends AppController {

	var $name = 'Categories';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->Category->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Category.');
			$this->redirect('/categories/index');
		}
		$this->set('category', $this->Category->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Category->save($this->data)) {
				//$this->Session->setFlash('消息分类添加成功！');
				$msg = '消息分类添加成功！';
				$this->redirect('/categories/index?msg='.urlencode($msg));				
			} else {
				//$this->Session->setFlash('请检查下面的错误：');
				$msg = '请检查下面的错误：';
				$this->redirect('/categories/index?msg='.urlencode($msg));				
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Category');
				$this->redirect('/categories/index');
			}
			$this->data = $this->Category->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Category->save($this->data)) {
				//$this->Session->setFlash('消息分类保存成功！');
				$msg = '消息分类保存成功！';
				$this->redirect('/categories/index?msg='.urlencode($msg));				
			} else {
				$this->Session->setFlash('请检查下面的错误.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Category');
			$this->redirect('/categories/index');
		}
		if ($this->Category->del($id)) {
			//$this->Session->setFlash('分类删除成功！');
			$msg = '分类删除成功！';
			$this->redirect('/categories/index?msg='.urlencode($msg));	
		}
	}

}
?>