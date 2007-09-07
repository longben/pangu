<?php
class PostsController extends AppController {

	var $name = 'Posts';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->Post->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Post.');
			$this->redirect('/posts/index');
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->set('categories', $this->Post->Category->generateList(
			  $conditions = null,
			  $order = 'id',
			  $limit = null,	
			  $keyPath = '{n}.Category.id',
			  $valuePath = '{n}.Category.category_name'			
			));
			$this->set('postStatuses',array('publish' => '上网','draft' => '草稿'));
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Post->save($this->data)) {
				//$this->Session->setFlash('文章保存成功！');
				$msg = '文章保存成功！';
				$this->redirect('/posts/index?msg='.urlencode($msg));	
			} else {
				$this->Session->setFlash('请检查下面错误.');
				$this->set('categories', $this->Post->Category->generateList(
				  $conditions = null,
				  $order = 'id',
				  $limit = null,	
				  $keyPath = '{n}.Category.id',
				  $valuePath = '{n}.Category.category_name'			
				));
				$this->set('postStatuses',array('publish' => '上网','draft' => '草稿'));
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Post');
				$this->redirect('/posts/index');
			}
			$this->data = $this->Post->read(null, $id);
			$this->set('categories', $this->Post->Category->generateList(
			  $conditions = null,
			  $order = 'id',
			  $limit = null,	
			  $keyPath = '{n}.Category.id',
			  $valuePath = '{n}.Category.category_name'			
			));
			$this->set('postStatuses',array('publish' => '上网','draft' => '草稿'));
		} else {
			$this->cleanUpFields();
			if ($this->Post->save($this->data)) {
				//$this->Session->setFlash('消息文章修改成功！');
				$msg = '消息文章修改成功！';
				$this->redirect('/posts/index?msg='.urlencode($msg));	
			} else {
				$this->Session->setFlash('请检查下面的错误.');
				$this->set('categories', $this->Post->Category->generateList(
				  $conditions = null,
				  $order = 'id',
				  $limit = null,	
				  $keyPath = '{n}.Category.id',
				  $valuePath = '{n}.Category.category_name'			
				));
				$this->set('postStatuses',array('publish' => '上网','draft' => '草稿'));
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Post');
			$this->redirect('/posts/index');
		}
		if ($this->Post->del($id)) {
			$this->Session->setFlash('The Post deleted: id '.$id.'');
			$this->redirect('/posts/index');
		}
	}

}
?>