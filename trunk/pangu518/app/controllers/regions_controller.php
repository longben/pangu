<?php
class RegionsController extends AppController {

	var $name = 'Regions';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript','Pagination');
	var $components = array ('Pagination','Pager'); // Added

	function index($page=1) {
        
		//分页方式二
		/*
        $params = array( 
            'perPage'     => 10, 
            'totalItems'  => $this->Region->findCount(), 
            'currentPage' => $page, 
        ); 
        $this->Pager->init($params);
        */
		
		//$this->Region->recursive = 0;
		//Pagination 分页方式一
		if($this->data['Region']['keyword']){
			$conditions = " id like '" . $this->data['Region']['keyword']. "%'";
		}else{
			$conditions = null;
		}
		
		list($order,$limit,$page) = $this->Pagination->init($conditions); // Added
		$data = $this->Region->findAll($conditions, NULL, $order, $limit, $page); // Extra parameters added
		
		
		//$data = $this->Region->findAll($conditions, null, 'id', $this->Pager->params['perPage'], $this->Pager->params['currentPage']);
		//$this->set('regions', $this->Region->findAll());
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