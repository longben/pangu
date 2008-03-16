<?php
class WebpagesController extends AppController {

	var $name = 'Webpages';
	var $helpers = array('Html', 'Form' );

	function index($channel_id = null) {
		$this->Webpage->recursive = 0;
		$this->set('webpages', $this->Webpage->findAllByChannelId($channel_id));
		$this->set('channel_id', $channel_id);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Webpage.');
			$this->redirect('/webpages/index');
		}
		$this->set('webpage', $this->Webpage->read(null, $id));
	}

	function add($channel_id = null) {
		if (empty($this->data)) {
			$this->set('channels', $this->Webpage->Channel->listMe("Channel.id = $channel_id"));
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Webpage->save($this->data)) {
				$this->Session->setFlash('The Webpage has been saved');
				$this->redirect('/webpages/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('channels', $this->Webpage->Channel->generateList());
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Webpage');
				$this->redirect('/webpages/index');
			}
			$this->data = $this->Webpage->read(null, $id);
			$this->set('channels', $this->Webpage->Channel->generateList());
		} else {
			$this->cleanUpFields();
			if ($this->Webpage->save($this->data)) {
				$this->Session->setFlash('The Webpage has been saved');
				$this->redirect('/webpages/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('channels', $this->Webpage->Channel->generateList());
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Webpage');
			$this->redirect('/webpages/index');
		}
		if ($this->Webpage->del($id)) {
			$this->Session->setFlash('The Webpage deleted: id '.$id.'');
			$this->redirect('/webpages/index');
		}
	}

	function select() {
		$this->layout = 'ajax';
		$this->cleanUpFields();
		$this->Webpage->recursive = 0;
		$this->set('webpages', $this->Webpage->findAllByChannelId($this->data['Article']['channel_id']));
	}

}
?>