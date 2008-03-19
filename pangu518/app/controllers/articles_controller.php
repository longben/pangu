<?php
class ArticlesController extends AppController {

	var $name = 'Articles';
	var $helpers = array('Html', 'Form', 'Javascript' );

	function index() {
		$this->Article->recursive = 0;
		$this->set('articles', $this->Article->findAll("order by created desc"));
	}

	function show($id = null) {
		$this->layout = 'website';
		if (!$id) {
			$this->Session->setFlash('非法请求！');
			$this->redirect('/');
		}
		$this->data = $this->Article->read(null, $id);
		$this->data['Article']['hits'] = $this->data['Article']['hits'] + 1;
		$this->Article->save($this->data);
		$this->set('article', $this->data);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Article.');
			$this->redirect('/articles/index');
		}
		$this->set('article', $this->Article->read(null, $id));
	}

	function add() {
		$this->layout = 'jquery';
		if (empty($this->data)) {
			$this->set('channels', $this->Article->Channel->listMe("disabled = 0", "order_id"));
			$this->set('webpages', $this->Article->Webpage->listMe());
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Article->save($this->data)) {
				$this->Session->setFlash('网站文章发布成功！');
				$this->redirect('/articles/add');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('channels', $this->Article->Channel->listMe());
				$this->set('webpages', $this->Article->Webpage->listMe());
			}
		}
	}

	function edit($id = null) {
		$this->layout = 'jquery';
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Article');
				$this->redirect('/articles/index');
			}
			$this->data = $this->Article->read(null, $id);
			$this->set('channels', $this->Article->Channel->listMe());
			$this->set('webpages', $this->Article->Webpage->listMe());
		} else {
			$this->cleanUpFields();
			if ($this->Article->save($this->data)) {
				$this->Session->setFlash('网站文章修改成功！');
				$this->redirect('/articles/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('tags', $this->Article->Tag->generateList());
				if (empty($this->data['Tag']['Tag'])) { $this->data['Tag']['Tag'] = null; }
				$this->set('selectedTags', $this->data['Tag']['Tag']);
				$this->set('channels', $this->Article->Channel->generateList());
				$this->set('webpages', $this->Article->Webpage->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Article');
			$this->redirect('/articles/index');
		}
		if ($this->Article->del($id)) {
			$this->Session->setFlash('The Article deleted: id '.$id.'');
			$this->redirect('/articles/index');
		}
	}

   function image() {
	   $this->layout = 'ajax';
   }

}
?>