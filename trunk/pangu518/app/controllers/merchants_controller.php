<?php
class MerchantsController extends AppController {

	var $name = 'Merchants';
	var $helpers = array('Html', 'Form', 'Javascript' );

	function index() {
		$this->Merchant->recursive = 0;
		$this->set('merchants', $this->Merchant->findAll());
	}
	
	function ws_index(){
		$this->Merchant->recursive = 0;
		$this->set('merchants', $this->Merchant->findAllByReferees($this->Session->read('User.id')));		
	}
	
   function audit() {
		$this->Merchant->recursive = 0;
		$this->set('merchants', $this->Merchant->findAllByStatus('9'));   	
   }	
	
	function trade() {
		$this->Merchant->recursive = 0;
		$this->set('merchants', $this->Merchant->findAllByStatus('1'));  
	}
	
	function buy() {
		$this->Merchant->recursive = 0;
		if($this->Merchant->buy($this->Session->read('ws_id'),$this->data['Merchant']['id'],2,$this->data['Workstation']['money'],$this->data['Workstation']['coupon_start'],$this->data['Workstation']['coupon_end'],$this->data['Workstation']['coupon_group'])){
			$this->Session->setFlash('代金券销售成功！');
			$this->redirect('/workstation_coupons/index');
		}else{
			$this->Session->setFlash('代金券销售失败，请检查代金券库存！');
			$this->redirect('/merchants/trade');
		}
	}	
	
	function view($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Merchant.');
			$this->redirect('/merchants/index');
		}
		$this->set('merchant', $this->Merchant->read(null, $id));
	}

	function add() {
		if(empty($this->data)) {
			$this->set('industries', $this->Merchant->Industry->generateList(
			             $conditions = 'Industry.flag = 1',
			             $order = 'Industry.id',
			             $limit = null,
			             $keyPath = '{n}.Industry.id',
			             $valuePath = '{n}.Industry.industry_name')
			);
			$this->set('regions', $this->Merchant->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			$user = $this->Merchant->User->findByLoginName($this->data['Merchant']['login_name']);
			$user_id = $user['User']['id'];
			$referes_no =  $this->data['Merchant']['referees_no'];
			
			$referees = $this->Merchant->getReferees($referes_no);
			$this->data['Merchant']['user_id'] = $user_id;
			$this->data['Merchant']['referees'] = $referees;
			
			if($this->Merchant->save($this->data)) {
				$this->Session->setFlash('会员消费单位添加成功，等待公司审核后生效。');
				$this->redirect('/merchants/index');
			} else {
				$this->Session->setFlash('会员消费单位添加失败，请检查下面的错误！');
				$this->set('industries', $this->Merchant->Industry->generateList(
				             $conditions = 'Industry.flag = 1',
				             $order = 'Industry.id',
				             $limit = null,
				             $keyPath = '{n}.Industry.id',
				             $valuePath = '{n}.Industry.industry_name')
				);
				$this->set('regions', $this->Merchant->Region->generateList(
				             $conditions = "id like '__0000'",
				             $order = 'id',
				             $limit = null,
				             $keyPath = '{n}.Region.id',
				             $valuePath = '{n}.Region.region_name')
				);
			}
		}
	}

	function ws_add() {
		if(empty($this->data)) {
			$this->set('industries', $this->Merchant->Industry->generateList(
			             $conditions = 'Industry.flag = 1',
			             $order = 'Industry.id',
			             $limit = null,
			             $keyPath = '{n}.Industry.id',
			             $valuePath = '{n}.Industry.industry_name')
			);
			$this->set('regions', $this->Merchant->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
			$this->render();
		} else {
			$this->cleanUpFields();
			$user = $this->Merchant->User->findByLoginName($this->data['Merchant']['login_name']);
			$user_id = $user['User']['id'];
			$referes_no =  $this->data['Merchant']['referees_no'];
			
			$referees = $this->Merchant->getReferees($referes_no);
			$this->data['Merchant']['user_id'] = $user_id;
			$this->data['Merchant']['referees'] = $referees;
			
			if($this->Merchant->save($this->data)) {
				$this->Session->setFlash('会员消费单位添加成功，审核后生效。');
				$this->redirect('/merchants/ws_index');
			} else {
				$this->Session->setFlash('会员消费单位添加失败，请检查下面的错误！');
				$this->set('industries', $this->Merchant->Industry->generateList(
				             $conditions = 'Industry.flag = 1',
				             $order = 'Industry.id',
				             $limit = null,
				             $keyPath = '{n}.Industry.id',
				             $valuePath = '{n}.Industry.industry_name')
				);
				$this->set('regions', $this->Merchant->Region->generateList(
				             $conditions = "id like '__0000'",
				             $order = 'id',
				             $limit = null,
				             $keyPath = '{n}.Region.id',
				             $valuePath = '{n}.Region.region_name')
				);
			}
		}
	}	
	
    /**
     * 审核
     *
     * @param int $id
     */
	function auditing($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('无效请求！');
				$this->redirect('/merchants/audit');
			}
			$this->data = $this->Merchant->read(null, $id);
			$this->set('industries', $this->Merchant->Industry->generateList(
			             $conditions = 'Industry.flag = 1',
			             $order = 'Industry.id',
			             $limit = null,
			             $keyPath = '{n}.Industry.id',
			             $valuePath = '{n}.Industry.industry_name')
			);
			$this->set('regions', $this->Merchant->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
		} else {
			$status = $this->data['Merchant']['status'];
			if($status==9){
				$this->data['Merchant']['status'] = '1'; //审核通过

				//取最大值
				$merchant_no = $this->Merchant->findCount(
					array(
						'Merchant.region_id' => $this->data['Merchant']['region_id'],
						'Merchant.status' => '1'
					));
				$this->data['Merchant']['merchant_no'] = $this->data['Merchant']['region_id'].sprintf('%07s', $merchant_no+1);
			}
			$this->cleanUpFields();
			if($status ==9 && $this->Merchant->save($this->data)) {
				$user = $this->Merchant->User->read(null,$this->data['Merchant']['user_id']);
				$user['User']['role_id'] = 2; //会员消费单位默认角色为2
				$this->Merchant->User->save($user);
				
				$this->Merchant->User->updateGrade($this->data['Merchant']['referees']); //更新会员等级
				$this->Session->setFlash('会员消费单位资料审核成功！');
				$this->redirect('/merchants/audit');
			} else {
				if($status!=9){
					$msg = '会员消费单位已经审核！';
				}else{
					$msg = '审核会员消费单位出错！';
				}
				$this->Session->setFlash($msg);
				$this->set('industries', $this->Merchant->Industry->generateList(
					$conditions = 'Industry.flag = 1',
					$order = 'Industry.id',
					$limit = null,
					$keyPath = '{n}.Industry.id',
					$valuePath = '{n}.Industry.industry_name')
				);
				$this->set('regions', $this->Merchant->Region->generateList(
					$conditions = "id like '__0000'",
					$order = 'id',
					$limit = null,
					$keyPath = '{n}.Region.id',
					$valuePath = '{n}.Region.region_name')
				);
			}
		}		
	}

	function edit($id = null) {
		if(empty($this->data)) {
			if(!$id) {
				$this->Session->setFlash('Invalid id for Merchant');
				$this->redirect('/merchants/index');
			}
			$this->data = $this->Merchant->read(null, $id);
			$this->set('industries', $this->Merchant->Industry->generateList(
			             $conditions = 'Industry.flag = 1',
			             $order = 'Industry.id',
			             $limit = null,
			             $keyPath = '{n}.Industry.id',
			             $valuePath = '{n}.Industry.industry_name')
			);
			$this->set('regions', $this->Merchant->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->Merchant->save($this->data)) {
				$this->Session->setFlash('会员消费单位资料更新成功！');
				$this->redirect('/merchants/index');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->Merchant->User->generateList());
				$this->set('industries', $this->Merchant->Industry->generateList());
				$this->set('regions', $this->Merchant->Region->generateList());
			}
		}
	}

	function delete($id = null) {
		if(!$id) {
			$this->Session->setFlash('Invalid id for Merchant');
			$this->redirect('/merchants/index');
		}
		if($this->Merchant->del($id)) {
			$this->Session->setFlash('会员消费单位删除成功!');
			$this->redirect('/merchants/index');
		}
	}
	
	function profile() {
		$user_id = $this->Session->read('User.id');
		$this->set('user_id',$user_id);
		if(empty($this->data)) {
			if(!$user_id) {
				$this->Session->setFlash('无效的会员消费单位！');
				$this->redirect('/merchants/profile');
			}
			$this->data = $this->Merchant->findByUserId($user_id);
			$this->set('industries', $this->Merchant->Industry->generateList(
			             $conditions = 'Industry.flag = 1',
			             $order = 'Industry.id',
			             $limit = null,
			             $keyPath = '{n}.Industry.id',
			             $valuePath = '{n}.Industry.industry_name')
			);
			$this->set('regions', $this->Merchant->Region->generateList(
			             $conditions = "id like '__0000'",
			             $order = 'id',
			             $limit = null,
			             $keyPath = '{n}.Region.id',
			             $valuePath = '{n}.Region.region_name')
			);
		} else {
			$this->cleanUpFields();
			if($this->Merchant->save($this->data)) {
				$this->Session->setFlash('会员消费单位资料保存成功！');
				$this->redirect('/merchants/profile');
			} else {
				$this->Session->setFlash('Please correct errors below.');
				$this->set('users', $this->Merchant->User->generateList());
				$this->set('industries', $this->Merchant->Industry->generateList());
				$this->set('regions', $this->Merchant->Region->generateList());
			}
		}

	}

}
?>