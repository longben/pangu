-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2007 年 09 月 10 日 02:29
-- 服务器版本: 5.0.41
-- PHP 版本: 5.2.2
-- 
-- 数据库: `pangu518`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `modules`
-- 

CREATE TABLE `modules` (
  `id` int(10) NOT NULL auto_increment COMMENT '主键',
  `module_name` varchar(60) NOT NULL,
  `module_type` int(3) default NULL,
  `parent_id` int(10) default NULL,
  `hierarchy` int(3) default '1',
  `node` int(1) default '0',
  `image_uri` varchar(200) default NULL,
  `url` varchar(200) default NULL,
  `target` varchar(20) default NULL,
  `allow_del` int(1) default NULL,
  `allow_add` int(1) default NULL,
  `allow_publish` int(1) default NULL,
  `duty_person` varchar(200) default NULL,
  `duty_company` int(10) default NULL,
  `duty_lead` varchar(200) default NULL,
  `order_list` int(10) default NULL,
  `max_num` int(10) default '5',
  `visit_count` int(10) default NULL,
  `page_type` int(1) default NULL,
  `memo` varchar(4000) default NULL,
  `flag` int(1) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='栏目表' AUTO_INCREMENT=452 ;

-- 
-- 导出表中的数据 `modules`
-- 

INSERT INTO `modules` VALUES 
(1, '会员专区', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(11, '编辑个人资料', 1, 1, 1, 0, NULL, '/members/profile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(12, '修改口令', 1, 1, 1, 0, NULL, '/members/password', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(13, '分红凭证录入', 1, 1, 1, 0, NULL, '/user_coupons/input', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(14, '会员参与分红', 1, 1, 1, 0, NULL, '/lottery_bettings/user', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(2, '会员消费单位专区', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(21, '消费单位资料维护', 1, 2, 1, 0, NULL, '/merchants/profile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(22, '可用财富积点及分红凭证管理', 1, 2, 1, 0, NULL, '/merchant_coupons', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(23, '消费单位参与分红', 1, 2, 1, 0, NULL, '/lottery_bettings/merchant', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(3, '工作站专区', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(31, '工作站资料维护', 1, 3, 1, 0, NULL, '/workstations/profile', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(32, '可用财富积点及分红凭证管理', 1, 3, 1, 0, NULL, '/workstation_coupons', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(33, '增加会员消费单位', 1, 3, 1, 0, NULL, '/merchants/ws_add', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(4, '公司总部管理', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(41, '会员管理', 1, 4, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(411, '会员列表', 1, 41, 1, 0, NULL, '/members', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(42, '会员消费单位管理', 1, 4, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(421, '新增消费单位', 1, 42, 1, 0, NULL, '/merchants/add', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(422, '消费单位列表', 1, 42, 1, 0, NULL, '/merchants/index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(423, '消费单位审核', 1, 42, 1, 0, NULL, '/merchants/audit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(43, '工作站管理', 1, 4, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(431, '新增工作站', 1, 43, 1, 0, NULL, '/workstations/add', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(432, '工作站列表', 1, 43, 1, 0, NULL, '/workstations', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(433, '工作站审核', 1, 43, 1, 0, NULL, '/workstations/audit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(434, '分红凭证转入', 1, 43, 1, 0, NULL, '/workstations/sell', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(44, '分红管理', 1, 4, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(441, '分红期数管理', 1, 44, 1, 0, NULL, '/lotteries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(45, '报表管理', 1, 4, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(451, '当月数据统计报表', 1, 45, 1, 0, NULL, '/report.php', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(5, '分红凭证认证系统', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(51, '分红凭证生成', 1, 5, 1, 0, NULL, '/coupons/add', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(52, '分红凭证审核', 1, 5, 1, 0, NULL, '/coupon_lists/index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(53, '分红凭证查询', 1, 5, 1, 0, NULL, '/coupons/query', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(8, '权限管理', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(82, '角色维护', 1, 8, 1, 0, NULL, '/roles/index', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(9, '基础代码管理', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(91, '行政区划维护', 1, 9, 1, 0, NULL, '/regions', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(92, '会员等级维护', 1, 9, 1, 0, NULL, '/member_grades', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(93, '行业维护', 1, 9, 1, 0, NULL, '/industries', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(10, '系统消息', 1, 0, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(101, '消息分类管理', 1, 10, 1, 0, NULL, '/categories', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(102, '消息发布', 1, 10, 1, 0, NULL, '/posts/add', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1),
(103, '消息内容管理', 1, 10, 1, 0, NULL, '/posts', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 1);

