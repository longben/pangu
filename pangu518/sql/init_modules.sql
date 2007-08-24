 insert into modules(id,parent_id,module_name,module_type,url)
   values(1,0,'会员专区',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(11,1,'编辑个人资料',1,'/members/profile');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(12,1,'修改口令',1,'/members/password');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(13,1,'代金券录入',1,'/user_coupons/input');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(14,1,'会员参与分红',1,'/lottery_bettings/user');


 insert into modules(id,parent_id,module_name,module_type,url)
   values(2,0,'会员消费单位专区',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(21,2,'消费单位资料维护',1,'/merchants/profile');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(22,2,'可用金额及代金券管理',1,'/merchant_coupons');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(23,2,'消费单位参与分红',1,'/lottery_bettings/merchant');


 insert into modules(id,parent_id,module_name,module_type,url)
   values(3,0,'工作站专区',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(31,3,'工作站资料维护',1,'/workstations/profile');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(32,3,'可用金额及代金券管理',1,'/workstation_coupons');


 insert into modules(id,parent_id,module_name,module_type,url)
   values(4,0,'公司总部管理',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(41,4,'会员管理',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(411,41,'会员资料维护',1,'/members');

 insert into modules(id,parent_id,module_name,module_type,url)
   values(42,4,'会员消费单位管理',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(421,42,'新增消费单位',1,'/merchants/add');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(422,42,'消费单位列表',1,'/merchants/index');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(423,42,'消费单位审核',1,'/merchants/audit');

 insert into modules(id,parent_id,module_name,module_type,url)
   values(43,4,'工作站管理',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(431,43,'新增工作站',1,'/workstations/add');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(432,43,'工作站列表',1,'/workstations');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(433,43,'工作站审核',1,'/workstations/audit');

 insert into modules(id,parent_id,module_name,module_type,url)
   values(44,4,'分红管理',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(441,44,'分红期数管理',1,'/lotteries');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(444,44,'当期分红相关数据',1,'/lotteries/currently');

 insert into modules(id,parent_id,module_name,module_type,url)
   values(45,4,'报表管理',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(451,45,'会员收益报表',1,'');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(452,45,'消费单位收益报表',1,'');


 insert into modules(id,parent_id,module_name,module_type,url)
   values(5,0,'代金券认证系统',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(51,5,'代金券生成',1,'/coupons/add');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(52,5,'代金券审核',1,'/coupon_lists/index');


 insert into modules(id,parent_id,module_name,module_type,url)
   values(8,0,'权限管理',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(81,8,'系统初始化',1,'/members/install');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(82,8,'角色维护',1,'/roles/index');


 insert into modules(id,parent_id,module_name,module_type,url)
   values(9,0,'基础代码管理',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(91,9,'行政区划维护',1,'/regions');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(92,9,'会员等级维护',1,'/member_grades');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(93,9,'行业维护',1,'/industries');

 insert into modules(id,parent_id,module_name,module_type,url)
   values(10,0,'系统消息',1,null);
 insert into modules(id,parent_id,module_name,module_type,url)
   values(101,10,'消息分类管理',1,'/categories');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(102,10,'消息发布',1,'/posts/add');
 insert into modules(id,parent_id,module_name,module_type,url)
   values(103,10,'消息内容管理',1,'/posts');
