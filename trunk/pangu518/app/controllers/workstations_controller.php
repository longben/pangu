<?php
class WorkstationsController extends AppController {

	var $name = 'Workstations';
	var $helpers = array('Html', 'Form' , 'Ajax', 'JavaScript', 'Pagination');
	var $components = array('Acl', 'Pagination');

	function index() {
		$this->Workstation->recursive = 0;
		
		$criteria = null;
		if($keyword == null){
			$keyword = $this->data['Workstation']['keyword'];
		}		
		if($keyword != null){
			$criteria = "Workstation.ws_name like '%$keyword%'";
		}

		list($order,$limit,$page) = $this->Pagination->init($criteria,null,array('url'=> 'index/'.$keyword));
		
		$data = $this->Workstation->findAll($criteria, NULL, NULL, $limit, $page); 	
		
		$this->set('workstations', $data);
	}
	
	function sell() {
		$this->Workstation->recursive = 0;
		$this->set('workstations', $this->Workstation->findAll('status = 1'));
	}	
	
	function audit() {
		$this->Workstation->recursive = 0;
		$this->set('workstations', $this->Workstation->findAll('status = 9'));
	}
	
   function trade($merchant_id=null,$merchant_name=null,$user_name=null,$owner=null,$telephone=null) {
   	  $this->Workstation->recursive = 0;
   	  $this->set('merchant_id',$merchant_id);
   	  $this->set('merchant_name',$merchant_name);
   	  $this->set('user_name',$user_name);
   	  $this->set('owner',$owner);
   	  $this->set('telephone',$telephone);
   }	

	function auditing($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Workstation');
				$this->redirect('/workstations/index');
			}
			$this->data = $this->Workstation->read(null, $id);
			$this->set('users', $this->Workstation->User->generateList());
			$this->set('regions', $this->Workstation->Region->generateList(
			  $conditions = "id like '__0000'",
			  $order = 'id',
			  $limit = null,
			  $keyPath = '{n}.Region.id',
			  $valuePath = '{n}.Region.region_name')
			);
		} else {
			$status = $this->data['Workstation']['status'];
			if($status == 9){
				$this->cleanUpFields();
				$user = $this->Workstation->User->read(null,$this->data['Workstation']['user_id']);
				$user['User']['role_id'] = 3; //工作站默认角色为3
				$this->Workstation->User->save($user);					
				
				$this->data['Workstation']['status'] = '1'; //审核通过
				
				//取最大值
				$ws_no = $this->Workstation->findCount(
				  array(
				    'Workstation.region_id' => $this->data['Workstation']['region_id'],
				    'Workstation.status' => '1'
				  ));
				$this->data['Workstation']['ws_no'] = $this->data['Workstation']['region_id'].sprintf('%04s', $ws_no+1);
				
				if($this->Workstation->save($this->data)) {
					$this->Session->setFlash('工作站审核成功！');
					$this->redirect('/workstations');	
				}else{
					$this->Session->setFlash('Please correct errors below.');
					$this->set('users', $this->Workstation->User->generateList());
					$this->set('regions', $this->Workstation->Region->generateList());
				}
			}else{
				$this->Session->setFlash('该工作站已经审核！');
				$this->redirect('/workstations');	
			}
		}
	}
	
	function buy($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('无效的工作站编号！');
				$this->redirect('/workstations/sell');	
			}
			$this->Workstation->unbindModel(array('hasMany' => array('WorkstationCoupon')));
			$this->Workstation->unbindModel(array('hasMany' => array('MerchantCoupon')));
			$this->Workstation->unbindModel(array('hasMany' => array('WorkstationAttornLog')));
			$this->Workstation->unbindModel(array('hasMany' => array('MerchantCouponList')));
						
			$this->data = $this->Workstation->read(null, $id);
			$this->set('regions', $this->Workstation->Region->generateList(
			  $conditions = "id like '__0000'",
			  $order = 'id',
			  $limit = null,
			  $keyPath = '{n}.Region.id',
			  $valuePath = '{n}.Region.region_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->Workstation->buy($this->data['Workstation']['id'],2,$this->data['Workstation']['money'],$this->data['Workstation']['coupon_start'],$this->data['Workstation']['coupon_end'],$this->data['Workstation']['coupon_group'])){
				$this->Session->setFlash('分红凭证转入成功！');
				$this->redirect('/workstations/sell');	
			}else{
				$this->Session->setFlash('分红凭证转入失败！<br>库存分红凭证数量过少或号段不在同一个组团或你选择的号段已被转入其他工作站！');
				$this->redirect('/workstations/sell');	
				$this->set('regions', $this->Workstation->Region->generateList(
				  $conditions = "id like '__0000'",
				  $order = 'id',
				  $limit = null,
				  $keyPath = '{n}.Region.id',
				  $valuePath = '{n}.Region.region_name')
				);

			}
		}
	}	
	
	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Workstation.');
			$this->redirect('/workstations/index');
		}
		$this->set('workstation', $this->Workstation->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->set('regions', $this->Workstation->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			$user = $this->Workstation->User->findByLoginName($this->data['Workstation']['login_name']);
			$user_id = $user['User']['id'];
			$referes_no =  $this->data['Workstation']['referees_no'];
					
			$referees = $this->Workstation->getReferees($referes_no);
			
			$this->data['Workstation']['user_id'] = $user_id;
			$this->data['Workstation']['referees'] = $referees;

			if($this->Workstation->save($this->data)) {
				//$aco = new Aco();
				$workstation_id = $this->Workstation->getLastInsertID(); //得到刚保存到数据库中的主键值
				//$aco->create($workstation_id, $workstation_id,$workstation_id.'-'.$this->data['Workstation']['ws_name']);
				$this->Session->setFlash('工作站增加成功！');
				$this->redirect('/workstations');	
			} else {
				$this->Session->setFlash('添加工作站出错，请检查错误！');
				$this->redirect('/workstations/add');	
				$this->set('members', $this->Workstation->Member->generateList());
				$this->set('regions', $this->Workstation->Region->generateList());
			}
		}
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Workstation');
				$this->redirect('/workstations/index');
			}
			$this->data = $this->Workstation->read(null, $id);
			$this->set('regions', $this->Workstation->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->Workstation->save($this->data)) {
				$this->Session->setFlash('工作站资料修改成功！');
				$this->redirect('/workstations');	
			} else {
				$this->Session->setFlash('Please correct errors below.');
                $this->set('regions', $this->Workstation->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			    );
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Workstation');
			$this->redirect('/workstations/index');
		}
		if($this->Workstation->del($id)) {
			$this->Session->setFlash('工作站删除成功! ');
			$this->redirect('/workstations');	
		}
	}
	
	function profile() {
		$user_id = $this->Session->read('User.id');
		$this->set('user_id',$user_id);
		if(empty($this->data)) {
			if(!$user_id) {
				$this->Session->setFlash('无效的工作站！');
				$this->redirect('/admin');
			}

			$this->Workstation->unbindModel(array('hasMany' => array('WorkstationCoupon')));
			$this->Workstation->unbindModel(array('hasMany' => array('MerchantCoupon')));
			$this->Workstation->unbindModel(array('hasMany' => array('WorkstationAttornLog')));
			$this->Workstation->unbindModel(array('hasMany' => array('MerchantCouponList')));

			$this->data = $this->Workstation->findByUserId($user_id);
			$this->set('regions', $this->Workstation->Region->generateList(
				$conditions = "id like '__0000'",
				$order = 'id',
				$limit = null,
				$keyPath = '{n}.Region.id',
				$valuePath = '{n}.Region.region_name')
			);
		} else {
			$this->cleanUpFields();
			$this->data['Workstation']['user_id'] = $user_id;
			if($this->Workstation->save($this->data)) {
				$this->Session->setFlash('工作站资料保存成功！');
				$this->redirect('/workstations/profile');	
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('regions', $this->Workstation->Region->generateList(
					$conditions = "id like '__0000'",
					$order = 'id',
					$limit = null,
					$keyPath = '{n}.Region.id',
					$valuePath = '{n}.Region.region_name')
				);
			}
		}
	}
	
	function min($status = null, $limit = null, $r = null, $group = null){
		$this->layout = 'ajax';
		$this->cacheAction = true;
		$user_id = $this->Session->read('User.id');
		$this->data = $this->Workstation->findByUserId($user_id);
		$id = $this->data['Workstation']['id'];
		if($group == null){
			$rs = $this->Workstation->findBySql("
			 select min(coupon_no)
			   from (select * from workstation_coupons 
			     where status = $status and workstation_id = $id
			     order by coupon_no limit $limit) as c");
		}else{
			$rs = $this->Workstation->findBySql("
			 select min(coupon_no)
			   from (select * from workstation_coupons
			     where status = $status and coupon_group = '$group' and workstation_id = $id
			     order by coupon_no limit $limit) as c");
		}
		$this->set('min_no',$rs[0][0]['min(coupon_no)']);
	}
	
	function max($status = null, $limit = null, $start = null, $r = null, $group = null){
		$this->layout = 'ajax';
		$this->cacheAction = true;
		$user_id = $this->Session->read('User.id');
		$this->data = $this->Workstation->findByUserId($user_id);
		$id = $this->data['Workstation']['id'];
		if($start == null){
			$rs = $this->Workstation->findBySql("select max(coupon_no)
			   from (select * from workstation_coupons 
			     where status = $status and workstation_id = $id
			     order by coupon_no limit $limit) as c");			
		}else{
			$rs = $this->Workstation->findBySql("select max(coupon_no)
			   from (select * from workstation_coupons 
			     where status = $status and workstation_id = $id and coupon_no > '$start'
			     order by coupon_no limit $limit) as c");			
	    }
		$this->set('max_no',$rs[0][0]['max(coupon_no)']);
	}
	
	function check_bargain($bargain_no = null){
		$this->layout = 'ajax';
		$count = $this->Workstation->findCount("bargain_no = '$bargain_no'");
		$this->set('count',$count);
	}

}
?>