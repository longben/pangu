<?php
class RegionsController extends AppController {

	var $name = 'Regions';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript','Pagination');
	var $components = array ('Pagination','Pager'); // Added


	function index($page=1) {
        
		$key = $this->data['Region']['keyword'];
		if($key){
			$criteria = array(
				  'Region.id' => 'LIKE %'. $key .'%',
				);
		}else{
			$criteria = null;
		}

        echo key($this->Pagination->privateParams);
		
		$this->Pagination->resultsPerPage = array(100,200,500);
		$this->Pagination->show = 10;
		$this->Pagination->style = "ajax";
		$this->Session->write('search_term', $this->data['Region']['keyword']);

		$this->Pagination->privateParams  = Array('t1' => 'wwww','t2' => 'demo');

		$settings = array (
			'show' => 15,
			'privateParams' => array('test' => 'www'),
		); 
		
		list($order,$limit,$page) = $this->Pagination->init($criteria,null,$settings); // Added

		//list($order,$limit,$page) = $this->Pagination->init(null,array('dd'=>'Foo'),null);
		$data = $this->Region->findAll($criteria, NULL, $order, $limit, $page); // Extra parameters added
		
		
		$this->set('regions', $data);
	}


	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->flash('无效的操作！', '/regions/index');
			}
			$this->data = $this->Region->read(null, $id);
		} else {
			$this->cleanUpFields();
			if($this->Region->save($this->data)) {
				$this->flash('修改成功！', '/regions/index');
			} else {
			}
		}
	}

}
?>