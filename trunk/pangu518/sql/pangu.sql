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
  list_id	   int(11)       not null		 comment '代金券批号id',
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


/* 代金券生成排序表  */
create table coupon_lists(
  id               int(11)       not null auto_increment comment '主键',
  coupon_start     varchar(15)   not null                comment '代金券开始编码',
  coupon_end	   varchar(15)   not null                comment '代金券结束编码',
  coupon_group     char(3)       not null                comment '代金券组团 0组团 A组团',
  custom_num       varchar(10)   not null                comment '用户随机数',
  created          timestamp                             comment '创建时间',
  modified         timestamp                             comment '修改时间',
  status           int(1)        not null default 0      comment '状态 0-等待生成，1-生成中，2-生成完毕(待审核)，3-已导出,4-已审核',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='代金券生成排序';


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
  cert_int         varchar(18)   not null  default ''    comment '身份证号码',
  referees         int(8)                                comment '推荐人',
  member_grades_id int(2)        not null default 1      comment '会员等级，默认为普通会员',
  region_id        int(11)                               comment '会员所属地区',
  telephone        varchar(30)                           comment '联系电话',
  mobile           varchar(11)                           comment '移动电话',
  office_phone     varchar(30)                           comment '办公电话',
  home_phone       varchar(30)                           comment '家庭电话',
  email            varchar(30)                           comment '电子邮件',
  bank_accounts    varchar(30) DEFAULT '邮政储蓄'	 comment '开户银行',
  accounts         varchar(20)                           comment '银行帐号',
  created          timestamp                             comment '会员创建日期',
  role_id          int(6)        default 1               comment '用户角色',       
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
  merchant_no      varchar(15)   not null default '0'    comment '消费单位编码:省代号+0000001',
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
  start_time       datetime                              comment '彩票期数的开始时间',
  finish_time      datetime                              comment '彩票期数的结束时间',
  open_time        datetime                              comment '开奖时间',
  win_int       varchar(5)                            comment '中奖号码',
  win_count        int(5)                                comment '中奖总数',
  created          timestamp                             comment '创建时间',
  modified         timestamp                             comment '修改时间',
  createdby        int(8)                                comment '创建者',
  flag             int(1)        not null default 1      comment '状态 1:正常 9:开奖',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='彩票表';


/* 彩票投注表 */
create table lottery_bettings(
  id               int(11)       not null auto_increment comment '主键',
  lottery_id       int(5)        not null                comment '彩票期数',
  betting_int   varchar(5)    not null                comment '彩票投注号码',
  betting_time     int(5)        not null default 1      comment '投注份数',
  betting_type     int(1)        not null default 1      comment '投注类型：1:个人投注 2:会员消费单位投注',
  user_id          int(8)                                comment '个人会员',
  merchant_id      int(11)                               comment '会员消费单位',
  created          timestamp                             comment '投票时间',
  flag             int(1)        not null default 1      comment '状态',
  primary key (id)  
) engine=MyISAM default charset=utf8 comment='彩票投注表';


/* 网站栏目分类表 */
create table categories(
  id                   int(10)       not null auto_increment comment '主键',
  category_name        varchar(18)   not null default ''     comment '栏目分类名称',
  category_nicename    varchar(66)   not null default ''     comment '栏目分类别名',
  category_description longtext                              comment '栏目简介',
  category_parent      int(10)                               comment '父亲栏目',
  category_count       int(10)                               comment '栏目点击',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='网站栏目分类';


/* 网站栏目文章表 */
create table posts(
  id                   int(10)       not null auto_increment comment '主键',
  category_id          varchar(18)   not null default ''     comment '栏目分类',
  post_title           varchar(255)  not null                comment '标题',
  post_content         longtext      not null                comment '内容',
  post_status          enum('publish','draft','private','static','object','attachment') not null default 'publish' comment '发布状态',
  post_count           int(10)       not null default 0      comment '点击次数',
  created              timestamp                             comment '创建时间',
  modified             timestamp                             comment '修改时间',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='网站栏目文章';

/* 角色表 */
create table roles (
  id                   int(10)         not null auto_increment comment '主键',
  role_name            varchar(200)    not null                comment '角色名称',
  type_id              int(1)          not null default 1      comment '类型',
  hierarchy            int(1)                                  comment '角色等级',
  father_id            int(1)                                  comment '父亲角色',
  valid_from           date                                    comment '生效日期',
  valid_thru           date                                    comment '终止日期',
  flag                 int(1)          not null default 1      comment '有效标志(1: 有效; 0: 无效)',
  memo                 varchar(2000)                           comment '备注',
  primary key  (id)
) engine=MyISAM default charset=utf8 comment='角色';

/* 用户角色表 */
create table user_attributes(
  id                   int(10)         not null auto_increment comment '主键',
  user_id              int(10)         not null                comment '用户',
  role_id              int(10)         not null                comment '角色',
  valid_from           date                                    comment '生效日期',
  valid_thru           date                                    comment '终止日期',
  primary key (id)
) engine=MyISAM default charset=utf8 comment='用户角色';

/* 栏目表 */
create table modules  (
  id                   int(10)         not null auto_increment comment '主键',
  module_name   varchar(60)    not null ,  -- 栏目(功能) 名称	*
  module_type   int(3)                ,  -- 栏目(功能) 类型 (1:系统模块 2:OA系统固定模板  3:网站栏目)
  parent_id     int(10)               ,  -- 上级栏目id
  hierarchy     int(3)      default 1 ,  -- 级别		
  node          int(1)      default 0 ,  -- 节点 (1:根  0:节点 )
  image_uri     varchar(200)            ,  -- 栏目图标 (限止大小、长度、宽度)	*
  url           varchar(200)            ,  -- 链接地址				* 
  target        varchar(20)             ,  -- 打开方式 (_top/_self/_parent/_winname/_blank)	*
  allow_del     int(1)                ,  -- 此栏目是否允许删除      （1：允许  2：不允许 ）
  allow_add     int(1)                ,  -- 此栏目是否允许新增子栏目（1：允许  2：不允许 ）
  allow_publish int(1)                ,  -- 此栏目是否允许上文章    （1： 允许上文章 2： 不允许上文章《例如：总队简介、相关下载等》）
  duty_person   varchar(200)            ,  -- 栏目责任人		* (一级栏目必填)
  duty_company  int(10)	         ,  -- 栏目责任单位		* (一级栏目必填)
  duty_lead     varchar(200)            ,  -- 栏目责任领导		* (一级栏目必填)
  order_list    int(10)               ,  -- 栏目的排序	
  max_num       int(10)     default 5 ,  -- 每页最大显示记录数	
  visit_count   int(10)               ,  -- 栏目被访问的次数
  page_type     int(1)                ,  -- 栏目的类别 （1：菜单  2：栏目）
  memo          varchar(4000)           ,  -- 备注
  flag          int(1)      default 1 ,  -- 有效标志
  primary key  (id)
 ) engine=MyISAM default charset=utf8 comment='栏目表';

 /*  角色所属栏目 */
create table role_modules (
  id                   int(10)         not null auto_increment comment '主键',
  role_id      int(10)      not null ,  -- 角色id
  module_id    int(10)      not null ,  -- 功能id
  valid_from   date                     ,  -- 生效日期
  valid_thru   date                     ,  -- 终止日期
  type_id      int(1)                ,  -- 角色对应栏目的类型 （1: 发布   2:审核 )
  primary key  (id)
) engine=MyISAM default charset=utf8 comment='角色所属栏目';