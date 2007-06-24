/*********************************************************************************************
/*  表必须有名为 id 的主键。
/*  如果表中包含 created 或 modified 列，cakephp 将自动填充字段（如果适用）。
/*  表名必须为复数的(users、products)。其相应的模型将具有单数的名称(user、product)。
/*  如果要将表关联起来，外键应当遵循 table_id 格式，且使用单数的表名。
/*  例如，user_id、product_id 将是表 user、product的外键。
/*  字段flag用于且仅用于最多表示两种状态。如：0：无效 1： 有效
/*  大于两种状态用status字段。如：0:无效 1:有效 2:拟转让 9:待审核
/*  在使用0和1表示状态的时候，如无特殊说明0始终表示无效，1始终表示有效。
/*********************************************************************************************


/* 行政区划 */
create table regions(
  id               int(11)       not null auto_increment comment '主键',
  region_name      varchar(30)   not null                comment '行政地区名称',
  maximum          int(6)        not null default 0      comment '工作站记录数。用于省代号+00001的计算',
  flag             int(1)        not null                comment '有效标志',
  primary key (id)
) engine=myisam default charset=utf8 comment='行政区划';


/* 会员扩展信息 */
create table member_infos(
  id               int(8)        not null                comment '主键，值同members主键值',
  member_no        varchar(25)   not null                comment '省编号+身份证号码成为会员编号',
  telephone        varchar(30)                           comment '联系电话',
  mobile           varchar(11)                           comment '移动电话',
  office_phone     varchar(30)                           comment '办公电话',
  home_phone       varchar(30)                           comment '家庭电话',
  bank_accounts    varchar(30)                           comment '开户银行',
  accounts         varchar(20)                           comment '银行帐号',
  primary key (id)
) engine=myisam default charset=utf8 comment='会员扩展信息';


/* 代金券  */
create table coupons(
  id               int(11)       not null auto_increment comment '主键',
  coupon_no        varchar(15)   not null                comment '代金券编码。no.0000000001－no.1000000000，10亿一组',
  coupon_pwd       varchar(10)                           comment '代金券密码',
  money            int(3)        not null default 2      comment '金额',
  coupon_group     char(3)                               comment '代金券组团 0组团 a组团',
  rate_of_discount decimal(2,1)                          comment '折价率',
  status           int(1)        not null                comment '状态 0:无效 1:有效(工作站) 2:有效(会员消费单位) 3:有效(会员) 9:有效(盘古)',
  primary key (id)
) engine=myisam default charset=utf8 comment='代金券';


/* 工作站 */
create table workstations(
  id               int(11)       not null auto_increment comment '主键',
  ws_no            varchar(11)   not null default '0'    comment '工作站编码',
  ws_name          varchar(50)   not null                comment '工作站名称',
  member_id        int(8)        not null                comment '工作站所有人',
  bargain_no       varchar(30)                           comment '合同编号',
  address          varchar(100)                          comment '工作站地址',
  telphone         varchar(20)                           comment '工作站联系电话',
  principal        varchar(20)                           comment '工作站负责人',
  introduction     varchar(2000)                         comment '工作站简介',
  referees         int(8)                                comment '工作站推荐者',
  region_id        int(11)                               comment '工作站所属地区',
  create_date      date                                  comment '工作站创建日期',
  status           int(1)        not null                comment '状态：0:无效 1:有效 2:拟转让 9:待审核',
  primary key (id)
) engine=myisam default charset=utf8 comment='工作站';


/* 工作站代金券 */
create table workstation_coupons(
  id               int(11)       not null auto_increment comment '主键',
  workstation_id   int(11)       not null                comment '工作站编码',
  coupon_id        int(11)       not null                comment '代金券编码',
  gain_date        date          not null                comment '获得代金券时间',
  transfer_date    date                                  comment '代金券转出时间。即转给会员消费单位时间',
  flag             int(1)        not null default 1      comment '0: 无效 1：有效 (获得后为1，转出后为0)',
  primary key (id),
  key coupon_id (coupon_id)
) engine=myisam default charset=utf8 comment='工作站代金券';


/* 工作站转让记录 */
create table workstation_attorn_logs(
  id               int(11)       not null auto_increment comment '主键',
  workstation_id   int(11)       not null                comment '被转让的工作站',
  endorsor         int(11)       not null                comment '转让人',
  endorsor_bargain varchar(30)                           comment '转让人工作站合同编号',
  assignee         int(11)       not null                comment '受托人',
  assignee_bargain varchar(30)                           comment '受托人工作站合同编号',
  attorn_date      date          not null                comment '转让日期',
  attorn_money     decimal(6,2)  not null default 0      comment '转让费',
  remark           varchar(800)  not null                comment '备注',
  primary key (id)
) engine=myisam default charset=utf8 comment='工作站转让记录';


/* 会员消费单位 */
create table merchants(
  id               int(11)       not null auto_increment comment '主键',
  merchant_name    varchar(50)   not null                comment '消费单位名称',
  owner            varchar(10)                           comment '店主',
  telephone        varchar(30)                           comment '联系电话',
  mobile           varchar(11)                           comment '移动电话',
  office_phone     varchar(30)                           comment '办公电话',
  bank_accounts    varchar(30)                           comment '开户银行',
  accounts         varchar(20)                           comment '银行帐号',
  member_id        int(8)        not null                comment '会员消费单位签署人',
  complaint_time   int(2)        not null default 0      comment '投诉次数(merchant_complaint_logs有一条有效记录者+1)',
  status           int(1)        not null                comment '有效标志 0:无效 1:有效 9:待审核'
  primary key (id)
) engine=myiasm default charset=utf8 comment='会员消费单位';


/* 会员消费单位代金券 */
create table workstation_coupons(
  id               int(11)       not null auto_increment comment '主键',
  merchant_id      int(11)       not null                comment '会员消费单位',
  coupon_id        int(11)       not null                comment '代金券',
  workstation_id   int(11)       not null                comment '销售代金券给消费单位的工作站',
  gain_date        date          not null                comment '获得代金券时间',
  transfer_date    date                                  comment '代金券退还公司时间',
  consume_date     date                                  comment '会员消费时间',
  status           int(1)        not null default 1      comment '0:无效(退还后) 1:有效(获得后) 2:会员消费',
  primary key (id),
  key coupon_id (coupon_id)
) engine=myisam default charset=utf8 comment='会员消费单位代金券';


/* 会员消费单位被投诉记录表 */
create table merchant_complaint_logs(
  id               int(11)       not null auto_increment comment '主键',
  merchant_id      int(11)       not null                comment '会员消费单位',
  member_id        int(8)        not null                comment '会员',
  complaint_date   date          not null                comment '会员投诉会员消费单位时间',
  complaint_reason varchar(500)                          comment '投诉原因',
  judge            int(8)                                comment '公司内部投诉审核人',
  auditing_date    date                                  comment '审核时间',
  auditing_opinion varchar(200)                          comment '审核处理意见',
  status           int(1)        not null default 0      comment '状态 0：无效 1：有效 2：投诉',
  primary key (id)
) engine=myiasm default charset=utf8 comment='会员消费单位被投诉记录表';