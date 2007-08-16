/*********************************************************************************************
/*  表必须有名为 id 的主键。
/*  如果表中包含 created 或 modified 列，cakephp 将自动填充字段（如果适用）。
/*  表名必须为复数的(users、products)。其相应的模型将具有单数的名称(user、product)。
/*  如果要将表关联起来，外键应当遵循 table_id 格式，且使用单数的表名。
/*  例如，user_id、product_id 将是表 user、product的外键。
/*  字段flag用于且仅用于最多表示两种状态。如：0：无效 1： 有效
/*  大于两种状态用status字段。如：0:无效 1:有效 2:拟转让 9:待审核
/*  在使用0和1表示状态的时候，如无特殊说明0始终表示无效，1始终表示有效。
/*  个税应缴纳数额＝应缴纳所得款（月工资－起征点）×适用税率
/*  所以代金券状态，请参考“代金券状态说明”
/*  修改日志		merchants新增merchant_no字段
/*					merchant_complaint_logs 原complaint_date字段修改为created	
/*					
/*  
/*********************************************************************************************


/* 行政区划 */
create table regions(
  id               int(11)       not null auto_increment comment '主键',
  region_name      varchar(30)   not null                comment '行政地区名称',
  maximum          int(6)        not null default 0      comment '工作站记录数。用于省代号+00001的计算',
  flag             int(1)        not null                comment '有效标志',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='行政区划';


/*********************************************************************************************
/*  代金券状态说明
/*  计算方法：转出方主体×100 + 接收方主体×10 + 动作
/*  主体：0:无效 1:公司 2:会员 3:工作站 4:会员消费单位
/*  动作：0:无效 1:销售 2:参与抽奖 3:财务审核 4:其它
/*  例如：状态: 131表示代金券由公司销售给工作站 341表示代金券由工作站销售给会员消费单位
/*********************************************************************************************
/* 代金券  */
create table coupons(
  id               int(11)       not null auto_increment comment '主键',
  coupon_no        varchar(15)   not null                comment '代金券编码。no.00000001－no.25000000，2500万一组',
  coupon_pwd       varchar(10)                           comment '代金券密码',
  custom_num       varchar(10)                           comment '用户随机数',
  random_num       varchar(10)                           comment '随机数',
  money            int(3)        not null default 2      comment '金额',
  coupon_group     char(3)                               comment '代金券组团 0组团 A组团',
  rate_of_discount decimal(2,1)                          comment '折价率',
  created          timestamp                             comment '创建时间',
  modified         timestamp                             COMMENT '修改时间',
  status           int(3)        not null default 0      comment '状态',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='代金券';


/* 会员等级 */
create table member_grades(
  id               int(2)        not null auto_increment comment '主键',
  grade_name       varchar(20)   not null                comment '会员等级名称',
  member_per       decimal(2,2)  not null default 0      comment '会员消费提成',
  ws_per           decimal(2,2)  not null default 0      comment '会员消费单位购券提成',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='会员等级';


/* 会员扩展信息 */
create table users(
  id               int(8)        not null                comment '主键，值同members主键值',
  login_name       varchar(15)   not null  default ''    comment '用户登录名',
  password         varchar(32)   not null  default ''    comment '用户口令',  
  user_name        varchar(20)   not null                comment '真实姓名',
  sex              int(1)        not null  default 1     comment '性别: 1:男 0:女',
  member_no        varchar(25)   not null  default ''    comment '省编号+身份证号码成为会员编号',
  cert_number      varchar(18)   not null  default ''    comment '身份证号码',
  referees         int(8)                                comment '推荐人',
  member_grades_id int(2)        not null default 1      comment '会员等级，默认为普通会员',
  region_id        int(11)                               comment '会员所属地区',
  telephone        varchar(30)                           comment '联系电话',
  mobile           varchar(11)                           comment '移动电话',
  office_phone     varchar(30)                           comment '办公电话',
  home_phone       varchar(30)                           comment '家庭电话',
  email            varchar(30)                           comment '电子邮件',
  bank_accounts    varchar(30) DEFAULT '邮政储蓄银行'    comment '开户银行',
  accounts         varchar(20)                           comment '银行帐号',
  created          timestamp                             comment '会员创建日期',
  flag             int(1)        not null default 1      comment '会员状态',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='会员扩展信息';


/* 会员代金券 */
create table user_coupons(
  id               int(11)       not null auto_increment comment '主键',
  user_id          int(8)        not null                comment '会员编码',
  coupon_id        int(11)       not null                comment '代金券编码',
  merchant_id      int(11)       not null                comment '会员消费单位',
  created          timestamp                             comment '获得代金券时间',
  modified         timestamp                             comment '代金券转出时间。即参与抽奖返回公司时间',
  status           int(3)        not null                comment '代金券状态',
  primary key (id),
  key coupon_id (coupon_id)
) engine=MyISAM default charset=utf8 comment='会员代金券';



/* 工作站 */
create table workstations(
  id               int(11)       not null auto_increment comment '主键',
  ws_no            varchar(15)   not null default '0'    comment '工作站编码:省代号+0001',
  ws_name          varchar(50)   not null                comment '工作站名称',
  user_id          int(8)        not null                comment '工作站所有人',
  referees         int(8)                                comment '工作站推荐者',
  bargain_no       varchar(30)                           comment '合同编号',
  address          varchar(100)                          comment '工作站地址',
  telphone         varchar(20)                           comment '工作站联系电话',
  principal        varchar(20)                           comment '工作站负责人',
  introduction     varchar(2000)                         comment '工作站简介',
  region_id        int(11)                               comment '工作站所属地区',
  created          timestamp                             comment '创建时间',
  income           decimal(2,2)  not null default 0.08   comment '工作站收益',
  status           int(1)        not null default 9      comment '状态：0:无效 1:有效 2:拟转让 9:待审核',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='工作站';


/* 工作站代金券 */
create table workstation_coupons(
  id               int(11)       not null auto_increment comment '主键',
  workstation_id   int(11)       not null                comment '工作站编码',
  coupon_id        int(11)       not null                comment '代金券编码',
  created          timestamp                             comment '获得代金券时间',
  modified         timestamp                             comment '代金券转出时间。即转给会员消费单位时间',
  status           int(3)        not null default 1      comment '状态',
  primary key (id),
  key coupon_id (coupon_id)
) engine=MyISAM default charset=utf8 comment='工作站代金券';


/* 工作站转让记录 */
create table workstation_attorn_logs(
  id               int(11)       not null auto_increment comment '主键',
  workstation_id   int(11)       not null                comment '被转让的工作站',
  endorsor         int(11)       not null                comment '转让人',
  endorsor_bargain varchar(30)                           comment '转让人工作站合同编号',
  assignee         int(11)       not null                comment '受托人',
  assignee_bargain varchar(30)                           comment '受托人工作站合同编号',
  attorn_money     decimal(6,2)  not null default 0      comment '转让费',
  modified         timestamp     not null                comment '转让日期',
  remark           varchar(800)  not null                comment '备注',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='工作站转让记录';


/* 行业 */
create table industries(
  id               int(11)       not null auto_increment comment '主键',
  industry_name    varchar(30)   not null                comment '行业名称',
  introduction     varchar(500)                          comment '行业描述',
  flag             int(1)        not null default 1      comment '状态',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='行业';


/* 会员消费单位 */
create table merchants(
  id               int(11)       not null auto_increment comment '主键',
  user_id          int(8)                                comment '会员消费拥有人',
  merchant_name    varchar(50)   not null                comment '消费单位名称',
  merchant_no      varchar(15)   not null default '0'    comment '消费单位编码:省代号+000001',	
  owner            varchar(10)                           comment '店主',
  telephone        varchar(30)                           comment '联系电话',
  mobile           varchar(11)                           comment '移动电话',
  office_phone     varchar(30)                           comment '办公电话',
  bank_accounts    varchar(30)                           comment '开户银行',
  accounts         varchar(20)                           comment '银行帐号',
  referees         int(8)        not null                comment '会员消费单位签署人',
  bargain_no       varchar(30)                           comment '合同编号',
  complaint_time   int(2)        not null default 0      comment '投诉次数(merchant_complaint_logs有一条有效记录者+1)',
  return_ratio     decimal(6,2)  not null default 0      comment '返劵比例返给会员',
  industry_id      int(11)       NOT NULL                COMMENT '所属行业',
  region_id        int(11)                               comment '所属地区',
  created          timestamp                             comment '创建时间',
  status           int(1)        not null default 9      comment '有效标志 0:无效 1:有效 9:待审核',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='会员消费单位';


/* 会员消费单位代金券 */
create table merchant_coupons(
  id               int(11)       not null auto_increment comment '主键',
  merchant_id      int(11)       not null                comment '会员消费单位',
  coupon_id        int(11)       not null                comment '代金券',
  workstation_id   int(11)       not null                comment '销售代金券给消费单位的工作站',
  created          timestamp                             comment '获得代金券时间',
  modified         timestamp                             comment '会员消费时间',
  untread_date     timestamp                             comment '代金券退还公司时间',
  status           int(3)        not null default 1      comment '状态',
  primary key (id),
  key coupon_id (coupon_id)
) engine=MyISAM default charset=utf8 comment='会员消费单位代金券';


/* 会员消费单位被投诉记录表 */
create table merchant_complaint_logs(
  id               int(11)       not null auto_increment comment '主键',
  merchant_id      int(11)       not null                comment '会员消费单位',
  user_id          int(8)        not null                comment '会员',
  created          timestamp                             comment '会员投诉会员消费单位时间',	
  complaint_reason varchar(500)                          comment '投诉原因',
  judge            int(8)                                comment '公司内部投诉审核人',
  auditing_date    timestamp                             comment '审核时间',
  auditing_opinion varchar(200)                          comment '审核处理意见',
  status           int(1)        not null default 0      comment '状态 0：无效 1：有效 2：投诉',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='会员消费单位被投诉记录表';


/* 彩票表 */
create table lotteries(
  id               int(5)        not null auto_increment comment '主键',
  lottery_year     int(4)        not null                comment '开奖年份',
  lottery_times    int(3)        not null default 0      comment '开奖次数',
  start_time       timestamp                             comment '彩票期数的开始时间',
  finish_time      timestamp                             comment '彩票期数的结束时间',
  open_time        timestamp                             comment '开奖时间',
  win_number       varchar(5)                            comment '中奖号码',
  win_count        int(5)                                comment '中奖总数',
  created          timestamp                             comment '创建时间',
  modified         timestamp                             comment '修改时间',
  createdby        int(8)                                comment '创建者',
  flag             int(1)        not null default 1      comment '状态',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='彩票表';


/* 彩票投注表 */
create table lottery_bettings(
  id               int(11)       not null auto_increment comment '主键',
  lottery_id       int(5)        not null                comment '彩票期数',
  betting_number   varchar(5)    not null                comment '彩票投注号码',
  betting_time     int(5)        not null default 1      comment '投注份数',
  betting_type     int(1)        not null default 1      comment '投注类型：1:个人投注 2:会员消费单位投注',
  user_id          int(8)                                comment '个人会员',
  merchant_id      int(11)                               comment '会员消费单位',
  created          timestamp                             comment '投票时间',
  flag             int(1)        not null default 1      comment '状态',
  primary key (id)  
) engine=MyISAM default charset=utf8 comment='彩票投注表';


/* 代金券生成排序表  */
create table coupon_lists(
  id               int(11)       not null auto_increment comment '主键',
  coupon_start     varchar(15)   not null                comment '代金券开始编码',
  coupon_end	   varchar(15)   not null                comment '代金券结束编码',
  coupon_group     char(3)       not null                comment '代金券组团 0组团 A组团',
  custom_num       varchar(10)   not null                comment '用户随机数',
  created          timestamp                             comment '创建时间',
  modified         timestamp                             COMMENT '修改时间',
  status           int(1)        not null default 0      comment '状态 0-等待中，1-生成中，2-生成完毕',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='代金券生成排序';
