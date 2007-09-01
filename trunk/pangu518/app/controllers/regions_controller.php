<?php
class RegionsController extends AppController {

	var $name = 'Regions';
	var $helpers = array('Html', 'Form' , 'Ajax', 'Javascript','Pagination');
	var $components = array ('Pagination'); // Added


	function index($keyword= null, $page=1) {
        
		$criteria = null;
		if($keyword == null){
			$keyword = $this->data['Region']['keyword'];
		}
			
		$this->Pagination->resultsPerPage = array(50,100,200,500);
		$this->Pagination->show = 15;
		//$this->Pagination->style = "ajax"; //ajax风格翻页

	
	   if($keyword != null){
	   	  $criteria = "Region.id like '$keyword%' or Region.region_name like '%$keyword%' ";
	   }
       
       list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('ajaxDivUpdate'=>'cs','url'=> 'index/'.$keyword));
       
       //list($order,$limit,$page) = $this->Pagination->init($criteria,null,$settings); // Added
       $data = $this->Region->findAll($criteria, NULL, $order, $limit, $page);  		
		
		//list($order,$limit,$page) = $this->Pagination->init($criteria,null,$settings); // Added
		//$data = $this->Region->findAll($criteria, NULL, $order, $limit, $page); // Extra parameters added
				
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