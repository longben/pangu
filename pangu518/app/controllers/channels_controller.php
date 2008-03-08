<?php
class ChannelsController extends AppController {

	var $name = 'Channels';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Channel->recursive = 0;
		$this->set('channels', $this->Channel->findAll());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Channel.');
			$this->redirect('/channels/index');
		}
		$this->set('channel', $this->Channel->read(null, $id));
	}

	function add() {
		if (empty($this->data)) {
			$this->render();
		} else {
			$this->cleanUpFields();
			if ($this->Channel->save($this->data)) {
				$this->Session->setFlash('The Channel has been saved');
				$this->redirect('/channels/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function edit($id = null) {
		if (empty($this->data)) {
			if (!$id) {
				$this->Session->setFlash('Invalid id for Channel');
				$this->redirect('/channels/index');
			}
			$this->data = $this->Channel->read(null, $id);
		} else {
			$this->cleanUpFields();
			if ($this->Channel->save($this->data)) {
				$this->Session->setFlash('The Channel has been saved');
				$this->redirect('/channels/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Channel');
			$this->redirect('/channels/index');
		}
		if ($this->Channel->del($id)) {
			$this->Session->setFlash('The Channel deleted: id '.$id.'');
			$this->redirect('/channels/index');
		}
	}

}
?>