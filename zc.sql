#角色表: 自增长id，角色名，角色描述
#员工表:自增长id，账号，密码，名字，角色（外键），使用状态
#权限表（菜单）:自增长id，权限名（菜单名），二级菜单fid，地址url
#角色与权限表:自增长id，角色id（外键），权限id（外键）

#商品表:自增长id，商品名，商品原价，众筹价，目标金额，支持人数，众筹截止时间，库存，类型（外键），发布类型（enum:众筹，限时），发布时间，上架时间，商品图片，商品详情，限购数，已售数，开始秒杀日期，结束秒杀日期，秒杀时段（外键）
#时段表:自增长id，开始时间，结束时间
#图片表:自增长id，图片路径src，商品id（外键）
#商品类型：自增长id，类型名称

#订单表:自增长id，订单时间、用户名、{{商品id（外键）、商品数目、商品价格}}、订单状态(enum:'未支付','已支付','已发货','已失效','已取消')、收货地址id
#订单商品：自增长id，商品id（外键）、商品数目、商品价格，订单id
#购物车:自增长id，用户id（外键），{{商品id（外键）、商品数目、商品价格}}
#购物车商品：自增长id，商品id（外键）、商品数目、商品价格，购物车id

#用户表:自增长id、账号、密码、头像、注册时间、余额、默认地址
#地址表:自增长id，地址信息、用户id（外键）、收货人、手机
#充值记录表:自增长id，金额，日期，用户id（外键）

#评论表：评论id、用户名、商品编号、订单编号、评价内容、评论时间、（星级）

DROP database if EXISTS hf170724_sk;
CREATE database hf170724_sk DEFAULT CHARACTER SET 'utf8';
use hf170724_sk;
set FOREIGN_key_checks=0; -- 让外键暂时失效

-- 角色表
DROP table if EXISTS t_role;
CREATE table t_role(
r_id int PRIMARY key auto_increment,
r_name VARCHAR(6) not null UNIQUE,
r_desc VARCHAR(20) not null
);
INSERT t_role VALUES
(DEFAULT,'超级管理员','系统管理员'),
(DEFAULT,'经理','添加员工查看报表等'),
(DEFAULT,'普通业务员','普通业务员'),
(DEFAULT,'客服','客服人员');


-- 员工表
DROP table if EXISTS t_emp;
CREATE table t_emp(
e_id int PRIMARY key auto_increment,
e_account VARCHAR(10) not null UNIQUE,
e_pwd char(32) not null DEFAULT 'e10adc3949ba59abbe56e057f20f883e', -- 默认密码123456
e_name VARCHAR(6) not null,
e_role int,
e_state enum('使用','锁定') not null DEFAULT '使用',
e_head VARCHAR(50) not null DEFAULT './view/img/head/86_350.png',
FOREIGN KEY(e_role) REFERENCES t_role(r_id)
);
INSERT into t_emp VALUES
(DEFAULT,'root',DEFAULT,'超管',1,DEFAULT,DEFAULT),
(DEFAULT,'aaaaaa',DEFAULT,'马云',2,DEFAULT,DEFAULT),
(DEFAULT,'bbbbbb',DEFAULT,'林丹',3,DEFAULT,DEFAULT),
(DEFAULT,'cccccc',DEFAULT,'钟敏',4,DEFAULT,DEFAULT);


#创建买家用户表 用户名、头像、密码、注册时间、余额、默认地址等
create table if not exists t_user(
u_id int primary key auto_increment,
u_account VARCHAR(10) not null UNIQUE,
u_pwd char(32) not null DEFAULT 'e10adc3949ba59abbe56e057f20f883e', -- 默认密码123456
u_name VARCHAR(6) not null,
u_coin float not null default 1000,
u_head VARCHAR(50) not null DEFAULT './view/img/head/1_350.png',
u_regTime date not null,
u_addr int,
u_mail VARCHAR(20),
u_state enum('使用','锁定') not null DEFAULT '使用',
u_qq BIGINT,
u_payPwd char(32),
FOREIGN KEY(u_addr) REFERENCES t_addr(a_id) on DELETE set null on UPDATE CASCADE
);
INSERT into t_user VALUES
(DEFAULT,'admin1',DEFAULT,'用户1',DEFAULT,DEFAULT,'2017-1-11',1,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin2',DEFAULT,'用户2',DEFAULT,DEFAULT,'2017-2-11',2,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin3',DEFAULT,'用户3',DEFAULT,DEFAULT,'2017-3-11',3,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin4',DEFAULT,'用户4',DEFAULT,DEFAULT,'2017-4-11',4,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin5',DEFAULT,'用户5',DEFAULT,DEFAULT,'2017-5-11',5,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin6',DEFAULT,'用户6',DEFAULT,DEFAULT,'2017-6-11',1,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin7',DEFAULT,'用户7',DEFAULT,DEFAULT,'2017-7-11',2,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin8',DEFAULT,'用户8',DEFAULT,DEFAULT,'2017-8-11',3,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin9',DEFAULT,'用户9',DEFAULT,DEFAULT,'2017-9-11',4,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin10',DEFAULT,'用户10',DEFAULT,DEFAULT,'2017-10-11',5,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin11',DEFAULT,'用户11',DEFAULT,DEFAULT,'2017-11-11',1,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin12',DEFAULT,'用户12',DEFAULT,DEFAULT,'2017-12-11',2,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin13',DEFAULT,'用户13',DEFAULT,DEFAULT,'2017-11-11',3,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin14',DEFAULT,'用户14',DEFAULT,DEFAULT,'2017-2-11',4,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin15',DEFAULT,'用户15',DEFAULT,DEFAULT,'2017-2-11',5,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin16',DEFAULT,'用户16',DEFAULT,DEFAULT,'2017-3-11',1,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin17',DEFAULT,'用户17',DEFAULT,DEFAULT,'2017-5-11',2,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin18',DEFAULT,'用户18',DEFAULT,DEFAULT,'2017-6-11',3,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin19',DEFAULT,'用户19',DEFAULT,DEFAULT,'2017-7-11',4,DEFAULT,DEFAULT,DEFAULT,DEFAULT),
(DEFAULT,'admin20',DEFAULT,'用户20',DEFAULT,DEFAULT,'2017-8-11',5,DEFAULT,DEFAULT,DEFAULT,DEFAULT);

-- 买家地址：地址id（自动增长）、地址信息、用户名外键、收货人、手机
create table if not exists t_addr(
a_id int primary key auto_increment,
a_name VARCHAR(50) not null,  -- 地址名
a_user int,    								-- 用户id
a_rever VARCHAR(10) not null,   -- 收件人
a_phone BIGINT not null,					-- 手机
FOREIGN KEY(a_user) REFERENCES t_user(u_id) on DELETE set null on UPDATE CASCADE
);
INSERT into t_addr VALUES
(DEFAULT,'福建省福州市仓山区金达路1号',1,'小一',18250000001),
(DEFAULT,'福建省福州市仓山区金达路2号',2,'小二',18250000002),
(DEFAULT,'福建省福州市仓山区金达路3号',3,'小三',18250000003),
(DEFAULT,'福建省福州市仓山区金达路4号',4,'小四',18250000004),
(DEFAULT,'福建省福州市仓山区金达路5号',5,'小五',18250000005),
(DEFAULT,'福建省福州市仓山区金达路6号',6,'小六',18250000006),
(DEFAULT,'福建省福州市仓山区金达路7号',7,'小七',18250000007),
(DEFAULT,'福建省福州市仓山区金达路8号',8,'小八',18250000008),
(DEFAULT,'福建省福州市仓山区金达路9号',9,'小九',18250000009),
(DEFAULT,'福建省福州市仓山区金达路10号',10,'小十',18250000010),

(DEFAULT,'福州台江',1,'小一',18250000001),
(DEFAULT,'福州台江',2,'小二',18250000002),
(DEFAULT,'福州台江',3,'小三',18250000003),
(DEFAULT,'福州台江',4,'小四',18250000004),
(DEFAULT,'福州台江',5,'小五',18250000005),
(DEFAULT,'福州台江',6,'小六',18250000006),
(DEFAULT,'福州台江',7,'小七',18250000007),
(DEFAULT,'福州台江',8,'小八',18250000008),
(DEFAULT,'福州台江',9,'小九',18250000009),
(DEFAULT,'福州台江',10,'小十',18250000010),

(DEFAULT,'福州鼓楼',1,'小一',18250000001),
(DEFAULT,'福州鼓楼',2,'小二',18250000002),
(DEFAULT,'福州鼓楼',3,'小三',18250000003),
(DEFAULT,'福州鼓楼',4,'小四',18250000004),
(DEFAULT,'福州鼓楼',5,'小五',18250000005),
(DEFAULT,'福州鼓楼',6,'小六',18250000006),
(DEFAULT,'福州鼓楼',7,'小七',18250000007),
(DEFAULT,'福州鼓楼',8,'小八',18250000008),
(DEFAULT,'福州鼓楼',9,'小九',18250000009),
(DEFAULT,'福州鼓楼',10,'小十',18250000010);


-- 权限菜单表
DROP table if EXISTS t_menu;
CREATE table t_menu(
m_id int PRIMARY key auto_increment,
m_name VARCHAR(10) not null,
m_fid int not null,
m_url VARCHAR(80)
);
INSERT t_menu VALUES
(DEFAULT,'系统管理',0,''),
(DEFAULT,'商品管理',0,''),
(DEFAULT,'订单管理',0,''),
(DEFAULT,'用户管理',0,''),
(DEFAULT,'平台客服',0,''),
(DEFAULT,'报表统计',0,''),


(DEFAULT,'员工管理',1,'./index.php?type=Emp&do=showEmpView&m_id=7'),
(DEFAULT,'角色管理',1,'./index.php?type=Role&do=showRoleView&m_id=8'),
(DEFAULT,'商品录入',2,'./index.php?type=Goods&do=showGoodsPubView&m_id=9'),
(DEFAULT,'商品信息',2,'./index.php?type=Goods&do=showGoodsView&m_id=10'),
(DEFAULT,'未支付订单',3,'./index.php?type=Order&do=showUnpaidView&m_id=11'),
(DEFAULT,'已支付订单',3,'./index.php?type=Order&do=showPaidView&m_id=12'),

(DEFAULT,'用户管理',4,'./index.php?type=User&do=showUserView&m_id=13'),
(DEFAULT,'平台客服',5,'./index.php?type=Service&do=showServiceView&m_id=14'),
(DEFAULT,'注册用户统计',6,'./index.php?type=Report&do=showRegReportView&m_id=15'),
(DEFAULT,'营销统计',6,'./index.php?type=Report&do=showSaleReportView&m_id=16');

-- 角色权限表
DROP table if EXISTS t_perm;
CREATE table t_perm(
p_id int PRIMARY key auto_increment,
p_role int,
p_menu int,

FOREIGN KEY(p_role) REFERENCES t_role(r_id) on DELETE set null on UPDATE CASCADE,
FOREIGN KEY(p_menu) REFERENCES t_menu(m_id) on DELETE set null on UPDATE CASCADE
);
INSERT t_perm VALUES
(DEFAULT,1,1),
(DEFAULT,1,2),
(DEFAULT,1,3),
(DEFAULT,1,4),
(DEFAULT,1,5),
(DEFAULT,1,6),
(DEFAULT,1,7),
(DEFAULT,1,8),
(DEFAULT,1,9),
(DEFAULT,1,10),
(DEFAULT,1,11),
(DEFAULT,1,12),
(DEFAULT,1,13),
(DEFAULT,1,14),
(DEFAULT,1,15),
(DEFAULT,1,16),

(DEFAULT,2,1),
(DEFAULT,2,2),
(DEFAULT,2,3),
(DEFAULT,2,4),
(DEFAULT,2,5),
(DEFAULT,2,6),
(DEFAULT,2,7),
(DEFAULT,2,9),
(DEFAULT,2,10),
(DEFAULT,2,11),
(DEFAULT,2,12),
(DEFAULT,2,13),
(DEFAULT,2,14),
(DEFAULT,2,15),
(DEFAULT,2,16),

(DEFAULT,3,2),
(DEFAULT,3,3),
(DEFAULT,3,4),
(DEFAULT,3,9),
(DEFAULT,3,10),
(DEFAULT,3,11),
(DEFAULT,3,12),
(DEFAULT,3,13),

(DEFAULT,4,2),
(DEFAULT,4,3),
(DEFAULT,4,4),
(DEFAULT,4,5),
(DEFAULT,4,10),
(DEFAULT,4,11),
(DEFAULT,4,12),
(DEFAULT,4,13),
(DEFAULT,4,14);


-- 商品表
DROP table if EXISTS t_goods;
CREATE table t_goods(
g_id int PRIMARY key auto_increment,
g_name VARCHAR(10) not null,-- 商品名
g_origPrice FLOAT,-- 原价
g_nowPrice float not null,-- 现价
g_stock int not null,-- 商品库存
g_type int,-- 商品类型
g_pubType enum('普通购买','限时秒杀') not null,-- 发布类型
g_pubTime datetime not null,-- 发布时间
-- g_saleTime datetime, -- 上架时间
g_img VARCHAR(100),-- 商品图片
g_detail text,-- 商品详情
g_limitNum int,-- 限购数量
g_sold int default 0, -- 已售
g_startDate date, -- 开始秒杀日期
g_endDate date,-- 结束秒杀日期
g_skTime int,-- 秒杀时段
g_note VARCHAR(20),-- 备注
g_seller VARCHAR(20) DEFAULT '淘抢购经销商',

FOREIGN KEY(g_type) REFERENCES t_goodsType(t_id) on DELETE set null on UPDATE CASCADE,
FOREIGN KEY(g_skTime) REFERENCES t_skTime(s_id) on DELETE set null on UPDATE CASCADE
);

-- INSERT into t_goods VALUES
-- (DEFAULT,'镇店铁观音茶叶',208,68,100,1,'限时秒杀',NOW(),'./view/img/goods/1513150559dog.jpg',DEFAULT,1,DEFAULT,'2017-11-11','2017-12-31',6,DEFAULT);

-- select last_insert_id();

#商品图片表
create table if not exists t_imgs(
i_id int primary key auto_increment,
i_imgSrc VARCHAR(100),
i_goods int,

FOREIGN KEY(i_goods) REFERENCES t_goods(g_id) on DELETE set null on UPDATE CASCADE
);


-- 秒杀时段表
create table if not exists t_skTime(
s_id int primary key auto_increment,
s_startTime int,
s_intervalTime int
);
insert into t_sktime values
(DEFAULT,0,2),
(DEFAULT,2,2),
(DEFAULT,4,2),
(DEFAULT,6,2),
(DEFAULT,8,2),
(DEFAULT,10,2),
(DEFAULT,12,2),
(DEFAULT,14,2),
(DEFAULT,16,2),
(DEFAULT,18,2),
(DEFAULT,20,2),
(DEFAULT,22,2);



drop table if exists t_goodsType;
-- 商品类型（一级）：类型id（自动），类型名称
create table if not exists t_goodsType(
t_id int primary key auto_increment,
t_name VARCHAR(4) not null
);
insert into t_goodsType VALUES
(default,'女装'),
(default,'女鞋'),
(default,'男装'),
(default,'男鞋'),
(default,'美妆'),
(default,'内衣'),
(default,'母婴'),
(default,'食品'),
(default,'数码电器'),
(default,'运动户外'),
(default,'家纺家居'),
(default,'居家百货'),
(default,'个护家清'),
(default,'医药保健'),
(default,'手表配饰'),
(default,'箱包服配'),
(default,'车品旅行');




#订单表:自增长id，订单时间、用户名、{{商品id（外键）、商品数目、商品价格}}、订单状态(enum:'未支付','已支付','已发货','已失效','已取消')、收货地址id
create table if not exists t_order(
o_id int primary key auto_increment,
o_time datetime,
o_user int,
o_status enum('未支付','已支付','已发货','交易成功','交易关闭'),
o_addr int,
o_sendTime datetime,

FOREIGN KEY(o_user) REFERENCES t_user(u_id) on DELETE set null on UPDATE CASCADE,

FOREIGN KEY(o_addr) REFERENCES t_addr(a_id) on DELETE set null on UPDATE CASCADE
);
insert into t_order VALUES
(DEFAULT,'2017-1-17 8:29:50',1,'交易成功',1,DEFAULT),
(DEFAULT,'2017-1-17 9:29:50',2,'交易成功',2,DEFAULT),
(DEFAULT,'2017-2-17 11:29:50',3,'交易成功',3,DEFAULT),
(DEFAULT,'2017-2-17 12:29:50',4,'交易成功',4,DEFAULT),
(DEFAULT,'2017-2-17 13:29:50',5,'交易成功',5,DEFAULT),
(DEFAULT,'2017-3-17 14:29:50',6,'交易成功',6,DEFAULT),
(DEFAULT,'2017-4-17 16:29:50',7,'交易成功',7,DEFAULT),
(DEFAULT,'2017-5-17 17:29:50',8,'交易成功',8,DEFAULT),
(DEFAULT,'2017-6-17 18:29:50',9,'交易成功',9,DEFAULT),
(DEFAULT,'2017-7-17 21:29:50',10,'交易成功',10,DEFAULT),
(DEFAULT,'2017-7-17 8:29:50',1,'交易成功',1,DEFAULT),
(DEFAULT,'2017-8-17 9:29:50',2,'交易成功',2,DEFAULT),
(DEFAULT,'2017-9-17 11:29:50',3,'交易成功',3,DEFAULT),
(DEFAULT,'2017-10-17 12:29:50',4,'交易成功',4,DEFAULT),
(DEFAULT,'2017-11-16 13:29:50',5,'交易成功',5,DEFAULT),
(DEFAULT,'2017-11-16 14:29:50',6,'交易成功',6,DEFAULT),
(DEFAULT,'2017-11-16 16:29:50',7,'交易成功',7,DEFAULT),
(DEFAULT,'2017-11-16 17:29:50',8,'交易成功',8,DEFAULT),
(DEFAULT,'2017-12-16 18:29:50',9,'交易成功',9,DEFAULT),
(DEFAULT,'2017-12-16 21:29:50',10,'交易成功',10,DEFAULT),
(DEFAULT,'2017-12-17 8:29:50',1,'未支付',1,DEFAULT),
(DEFAULT,'2017-12-17 9:29:50',2,'已支付',2,DEFAULT),
(DEFAULT,'2017-12-17 11:29:50',3,'未支付',3,DEFAULT),
(DEFAULT,'2017-12-17 12:29:50',4,'已支付',4,DEFAULT),
(DEFAULT,'2017-12-17 13:29:50',5,'未支付',5,DEFAULT);


#订单商品表：自增长id，商品id（外键）、商品数目、商品价格，订单id
create table if not exists t_orderGoods(
o_id int primary key auto_increment,
o_goods int,
o_num int not null,
o_price float not null,
o_order int,

FOREIGN KEY(o_goods) REFERENCES t_goods(g_id) on DELETE set null on UPDATE CASCADE,
FOREIGN KEY(o_order) REFERENCES t_order(o_id) on DELETE set null on UPDATE CASCADE
);

insert into t_orderGoods VALUES
(DEFAULT,1,2,20.4,1),
(DEFAULT,2,2,20.4,1),
(DEFAULT,3,2,20.4,1),

(DEFAULT,1,2,20.4,2),
(DEFAULT,2,2,20.4,2),
(DEFAULT,3,2,20.4,2),

(DEFAULT,1,2,20.4,3),
(DEFAULT,2,2,20.4,3),
(DEFAULT,3,2,20.4,3),

(DEFAULT,1,2,20.4,4),
(DEFAULT,2,2,20.4,4),

(DEFAULT,1,2,20.4,5),
(DEFAULT,2,2,20.4,5),
(DEFAULT,3,2,20.4,5),

(DEFAULT,1,2,20.4,6),
(DEFAULT,2,2,20.4,6),
(DEFAULT,3,2,20.4,6),

(DEFAULT,1,2,20.4,7),
(DEFAULT,2,2,20.4,7),
(DEFAULT,3,2,20.4,7),

(DEFAULT,1,2,20.4,8),
(DEFAULT,2,2,20.4,8),
(DEFAULT,3,2,20.4,8),

(DEFAULT,1,2,20.4,9),
(DEFAULT,2,2,20.4,9),
(DEFAULT,3,2,20.4,9),

(DEFAULT,1,2,20.4,10),
(DEFAULT,2,2,20.4,10),
(DEFAULT,3,2,20.4,10),

(DEFAULT,1,2,20.4,11),
(DEFAULT,2,2,20.4,11),
(DEFAULT,3,2,20.4,11),

(DEFAULT,1,2,20.4,12),
(DEFAULT,2,2,20.4,12),
(DEFAULT,3,2,20.4,12),

(DEFAULT,1,2,20.4,13),
(DEFAULT,2,2,20.4,13),
(DEFAULT,3,2,20.4,13),

(DEFAULT,1,2,20.4,14),
(DEFAULT,2,2,20.4,14),

(DEFAULT,1,2,20.4,15),
(DEFAULT,2,2,20.4,15),
(DEFAULT,3,2,20.4,15),

(DEFAULT,1,2,20.4,16),
(DEFAULT,2,2,20.4,16),
(DEFAULT,3,2,20.4,16),

(DEFAULT,1,2,20.4,17),
(DEFAULT,2,2,20.4,17),
(DEFAULT,3,2,20.4,17),

(DEFAULT,1,2,20.4,18),
(DEFAULT,2,2,20.4,18),
(DEFAULT,3,2,20.4,18),

(DEFAULT,1,2,20.4,19),
(DEFAULT,2,2,20.4,19),
(DEFAULT,3,2,20.4,19),

(DEFAULT,1,2,20.4,20),
(DEFAULT,2,2,20.4,20),
(DEFAULT,3,2,20.4,20),

(DEFAULT,1,2,20.4,21),
(DEFAULT,2,2,20.4,21),
(DEFAULT,3,2,20.4,21),

(DEFAULT,1,2,20.4,22),
(DEFAULT,2,2,20.4,22),
(DEFAULT,3,2,20.4,22),

(DEFAULT,1,2,20.4,23),
(DEFAULT,2,2,20.4,23),
(DEFAULT,3,2,20.4,23),

(DEFAULT,1,2,20.4,24),
(DEFAULT,2,2,20.4,24),

(DEFAULT,1,2,20.4,25),
(DEFAULT,2,2,20.4,25),
(DEFAULT,3,2,20.4,25);


#购物车:自增长id，用户id（外键），{{商品id（外键）、商品数目、商品价格}}
create table if not exists t_shoppingCar(
s_id int primary key auto_increment,
s_user int,

FOREIGN KEY(s_user) REFERENCES t_user(u_id) on DELETE set null on UPDATE CASCADE
);
INSERT INTO t_shoppingCar VALUES
(DEFAULT,1),
(DEFAULT,2),
(DEFAULT,3),
(DEFAULT,4),
(DEFAULT,5),
(DEFAULT,6),
(DEFAULT,7),
(DEFAULT,8),
(DEFAULT,9),
(DEFAULT,10);



#购物车商品表：自增长id，商品id（外键）、商品数目、商品价格，订单id
create table if not exists t_shoppingCarGoods(
s_id int primary key auto_increment,
s_goods int,
s_num int not null,
-- s_price float not null,
s_shoppingCar int,
s_shoppingTime dateTime not null,

FOREIGN KEY(s_goods) REFERENCES t_goods(g_id) on DELETE set null on UPDATE CASCADE,
FOREIGN KEY(s_shoppingCar) REFERENCES t_shoppingCar(s_id) on DELETE set null on UPDATE CASCADE
);
INSERT INTO t_shoppingCarGoods VALUES
(DEFAULT,1,2,1,'2017-11-11 11:11:11'),
(DEFAULT,2,2,1,'2017-11-11 11:11:11'),
(DEFAULT,3,2,1,'2017-11-11 11:11:11'),

(DEFAULT,1,2,2,'2017-11-11 11:11:11'),
(DEFAULT,2,2,2,'2017-11-11 11:11:11'),
(DEFAULT,3,2,2,'2017-11-11 11:11:11'),

(DEFAULT,1,2,3,'2017-11-11 11:11:11'),
(DEFAULT,2,2,3,'2017-11-11 11:11:11'),
(DEFAULT,3,2,3,'2017-11-11 11:11:11'),

(DEFAULT,1,2,4,'2017-11-11 11:11:11'),
(DEFAULT,2,2,4,'2017-11-11 11:11:11'),

(DEFAULT,1,2,5,'2017-11-11 11:11:11'),
(DEFAULT,2,2,5,'2017-11-11 11:11:11'),
(DEFAULT,3,2,5,'2017-11-11 11:11:11'),

(DEFAULT,1,2,6,'2017-11-11 11:11:11'),
(DEFAULT,2,2,6,'2017-11-11 11:11:11'),
(DEFAULT,3,2,6,'2017-11-11 11:11:11'),

(DEFAULT,1,2,7,'2017-11-11 11:11:11'),
(DEFAULT,2,2,7,'2017-11-11 11:11:11'),
(DEFAULT,3,2,7,'2017-11-11 11:11:11'),

(DEFAULT,1,2,8,'2017-11-11 11:11:11'),
(DEFAULT,2,2,8,'2017-11-11 11:11:11'),
(DEFAULT,3,2,8,'2017-11-11 11:11:11'),

(DEFAULT,1,2,9,'2017-11-11 11:11:11'),
(DEFAULT,2,2,9,'2017-11-11 11:11:11'),
(DEFAULT,3,2,9,'2017-11-11 11:11:11'),

(DEFAULT,1,2,10,'2017-11-11 11:11:11'),
(DEFAULT,2,2,10,'2017-11-11 11:11:11'),
(DEFAULT,3,2,10,'2017-11-11 11:11:11');

#评论表
drop table if exists t_comments;
#评论表：评论id、用户名、商品编号、订单编号、评价内容、评论时间
create table if not exists t_comments(
c_id int primary key auto_increment,
c_content text not null,
c_time datetime not null,

c_user int,
c_goods int,

FOREIGN KEY(c_user) REFERENCES t_user(u_id) on DELETE set null on UPDATE CASCADE,
FOREIGN KEY(c_goods) REFERENCES t_goods(g_id) on DELETE set null on UPDATE CASCADE
);
insert into t_comments values
(DEFAULT,'产品不错','2017-11-11 11:11:11',1,1),
(DEFAULT,'产品不错','2017-11-11 11:11:11',1,2),
(DEFAULT,'产品不错','2017-11-11 11:11:11',1,3),
(DEFAULT,'产品不错','2017-11-11 11:11:11',1,4),
(DEFAULT,'产品不错','2017-11-11 11:11:11',1,5),
(DEFAULT,'产品不错','2017-11-11 11:11:11',1,6),
(DEFAULT,'产品不错','2017-11-11 11:11:11',1,7);

-- 删除表
drop table if exists t_chats;

-- 聊天记录：记录id（自动增长—）、发送者、接收者、类型、内容、记录时间等
create table if not exists t_chats
(
chatId int primary key auto_increment,
sender VARCHAR(20),
rever VARCHAR(20),
type VARCHAR(20) not null default 'text',
content text,
msgTime datetime

);
insert into t_chats(sender,rever,content,msgTime)
       values('admin1','cccccc','你好',now());
insert into t_chats(sender,rever,content,msgTime)
       values('cccccc','admin1','亲，你好',now());
insert into t_chats(sender,rever,content,msgTime)
       values('admin2','cccccc','包邮吗',now());
insert into t_chats(sender,rever,content,msgTime)
       values('cccccc','admin2','全国包邮',now());

-- 插入商品
#普通购买
insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('镇店铁观音茶叶','./view/img/goods/g1_0.jpg','产品参数',208,68,100,'2017-10-27','2018-11-30',6,8,'浓香铁观音！ 高山',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g1_1.jpg',1),
('./view/img/goods/g1_2.jpg',1),
('./view/img/goods/g1_1.jpg',1),
('./view/img/goods/g1_2.jpg',1),
('./view/img/goods/g1_2.jpg',1);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('桂圆红枣枸杞茶','./view/img/goods/g2_1.jpg','产品参数',58,28.8,100,'2017-10-27','2018-11-30',6,8,'【第2份半价】',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g2_1.jpg',2),
('./view/img/goods/g2_2.jpg',2),
('./view/img/goods/g2_3.jpg',2),
('./view/img/goods/g2_4.jpg',2),
('./view/img/goods/g2_5.jpg',2);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('鲜活阳澄湖螃蟹','./view/img/goods/g3_1.jpg','产品参数',88,68,100,'2017-10-27','2018-11-30',6,8,'【第二件1元】',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g3_1.jpg',3),
('./view/img/goods/g3_2.jpg',3),
('./view/img/goods/g3_3.jpg',3),
('./view/img/goods/g3_4.jpg',3),
('./view/img/goods/g3_5.jpg',3);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('加里曼丹沉香佛珠手链','./view/img/goods/g4_1.jpg','产品参数',66,58,100,'2017-10-27','2018-11-30',6,15,'【花豹纹】',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g4_1.jpg',4),
('./view/img/goods/g4_2.jpg',4),
('./view/img/goods/g4_3.jpg',4),
('./view/img/goods/g4_4.jpg',4),
('./view/img/goods/g4_5.jpg',4);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('武夷山岩茶浓香大红袍','./view/img/goods/g5_1.jpg','产品参数',55,32,100,'2017-10-27','2018-11-30',6,8,'【天天特价】',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g5_1.jpg',5),
('./view/img/goods/g5_2.jpg',5),
('./view/img/goods/g5_3.jpg',5),
('./view/img/goods/g5_4.jpg',5),
('./view/img/goods/g5_5.jpg',5);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('OPPO R11全新手机','./view/img/goods/g6_1.jpg','产品参数',2999,2899,100,'2017-10-27','2018-11-30',6,9,'12期免息',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g6_1.jpg',6),
('./view/img/goods/g6_2.jpg',6),
('./view/img/goods/g6_3.jpg',6),
('./view/img/goods/g6_4.jpg',6),
('./view/img/goods/g6_5.jpg',6);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('52度宜宾五粮液','./view/img/goods/g7_1.jpg','产品参数',399,299,100,'2017-10-27','2018-11-30',6,8,'A级上品',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g7_1.jpg',7),
('./view/img/goods/g7_2.jpg',7),
('./view/img/goods/g7_3.jpg',7),
('./view/img/goods/g7_4.jpg',7),
('./view/img/goods/g7_5.jpg',7);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('海尔变频滚筒洗衣机','./view/img/goods/g8_1.jpg','产品参数',3999,3699,100,'2017-10-27','2018-11-30',6,9,'先购先得',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g8_1.jpg',8),
('./view/img/goods/g8_2.jpg',8),
('./view/img/goods/g8_3.jpg',8),
('./view/img/goods/g8_4.jpg',8),
('./view/img/goods/g8_5.jpg',8);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('高端组装台式','./view/img/goods/g9_1.jpg','产品参数',3999,3699,100,'2017-10-27','2018-11-30',6,9,'先购先得',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g9_1.jpg',9),
('./view/img/goods/g9_2.jpg',9),
('./view/img/goods/g9_3.jpg',9),
('./view/img/goods/g9_4.jpg',9),
('./view/img/goods/g9_5.jpg',9);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('时尚防水石英表','./view/img/goods/g10_1.jpg','产品参数',299,199,100,'2017-10-27','2018-11-30',6,15,'先购先得',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g10_1.jpg',10),
('./view/img/goods/g10_2.jpg',10),
('./view/img/goods/g10_3.jpg',10),
('./view/img/goods/g10_4.jpg',10),
('./view/img/goods/g10_5.jpg',10);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('青年立领加厚棉衣','./view/img/goods/g11_1.jpg','产品参数',199,129,100,'2017-10-27','2018-11-30',6,3,'先购先得',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g11_1.jpg',11),
('./view/img/goods/g11_2.jpg',11),
('./view/img/goods/g11_3.jpg',11),
('./view/img/goods/g11_4.jpg',11),
('./view/img/goods/g11_5.jpg',11);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('半合成汽油机油','./view/img/goods/g12_1.jpg','产品参数',199,129,100,'2017-10-27','2018-11-30',6,17,'艾纳5W40合成型 ',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g12_1.jpg',12),
('./view/img/goods/g12_2.jpg',12),
('./view/img/goods/g12_3.jpg',12),
('./view/img/goods/g12_4.jpg',12),
('./view/img/goods/g12_5.jpg',12);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('真皮带男士手表','./view/img/goods/g13_1.jpg','产品参数',699,599,100,'2017-10-27','2018-11-30',6,15,'全自动机械表',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g13_1.jpg',13),
('./view/img/goods/g13_2.jpg',13),
('./view/img/goods/g13_3.jpg',13),
('./view/img/goods/g13_4.jpg',13),
('./view/img/goods/g13_5.jpg',13);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('冬季毛呢外套','./view/img/goods/g14_1.jpg','产品参数',199,119,100,'2017-10-27','2018-11-30',7,1,'大码女秋装',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g14_1.jpg',14),
('./view/img/goods/g14_2.jpg',14),
('./view/img/goods/g14_3.jpg',14),
('./view/img/goods/g14_4.jpg',14),
('./view/img/goods/g14_5.jpg',14);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('冬季小棉袄女','./view/img/goods/g15_1.jpg','产品参数',199,119,100,'2017-10-27','2018-11-30',8,1,'大码女装冬装',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g15_1.jpg',15),
('./view/img/goods/g15_2.jpg',15),
('./view/img/goods/g15_3.jpg',15),
('./view/img/goods/g15_4.jpg',15),
('./view/img/goods/g15_5.jpg',15);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('真皮增高男鞋','./view/img/goods/g16_1.jpg','产品参数',199,129,100,'2017-10-27','2018-11-30',9,4,'冬季商务正装皮鞋',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g16_1.jpg',16),
('./view/img/goods/g16_2.jpg',16),
('./view/img/goods/g16_3.jpg',16),
('./view/img/goods/g16_4.jpg',16),
('./view/img/goods/g16_5.jpg',16);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('时尚防水钢带腕表','./view/img/goods/g17_1.jpg','产品参数',399,229,100,'2017-10-27','2018-11-30',11,15,'古卡伦全自动机械表',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g17_1.jpg',17),
('./view/img/goods/g17_2.jpg',17),
('./view/img/goods/g17_3.jpg',17),
('./view/img/goods/g17_4.jpg',17),
('./view/img/goods/g17_5.jpg',17);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('浓香型醇香铁观音','./view/img/goods/g18_1.jpg','产品参数',49,29,100,'2017-10-27','2018-11-30',12,8,'广蕴茶叶 2017新茶 ',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g18_1.jpg',18),
('./view/img/goods/g18_2.jpg',18),
('./view/img/goods/g18_3.jpg',18),
('./view/img/goods/g18_4.jpg',18),
('./view/img/goods/g18_5.jpg',18);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('套机单电xa10','./view/img/goods/g19_1.jpg','产品参数',3399,2999,100,'2017-10-27','2018-11-30',5,9,'自拍入门级',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g19_1.jpg',19),
('./view/img/goods/g19_2.jpg',19),
('./view/img/goods/g19_3.jpg',19),
('./view/img/goods/g19_4.jpg',19),
('./view/img/goods/g19_5.jpg',19);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('加厚铸铁锅双耳炒锅','./view/img/goods/g20_1.jpg','产品参数',3399,2999,100,'2017-10-27','2018-11-30',5,12,'无油烟无涂层不粘锅',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g20_1.jpg',20),
('./view/img/goods/g20_2.jpg',20),
('./view/img/goods/g20_3.jpg',20),
('./view/img/goods/g20_4.jpg',20),
('./view/img/goods/g20_5.jpg',20);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('野生淡干虾皮虾仁','./view/img/goods/g21_1.jpg','产品参数',29,23,100,'2017-10-27','2018-11-30',6,8,' 250g包邮',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g21_1.jpg',21),
('./view/img/goods/g21_2.jpg',21),
('./view/img/goods/g21_3.jpg',21),
('./view/img/goods/g21_4.jpg',21),
('./view/img/goods/g21_5.jpg',21);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('冬季加厚被子','./view/img/goods/g22_1.jpg','产品参数',199,159,100,'2017-10-27','2018-11-30',6,11,'巨亏8斤',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g22_1.jpg',22),
('./view/img/goods/g22_2.jpg',22),
('./view/img/goods/g22_3.jpg',22),
('./view/img/goods/g22_4.jpg',22),
('./view/img/goods/g22_5.jpg',22);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('马丁靴男短靴','./view/img/goods/g23_1.jpg','产品参数',199,159,100,'2017-10-27','2018-11-30',7,4,'百搭休闲鞋',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g23_1.jpg',23),
('./view/img/goods/g23_2.jpg',23),
('./view/img/goods/g23_3.jpg',23),
('./view/img/goods/g23_4.jpg',23),
('./view/img/goods/g23_5.jpg',23);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('法国原装进口红酒','./view/img/goods/g24_1.jpg','产品参数',199,159,100,'2017-10-27','2018-11-30',7,8,'买一箱得2箱 ',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g24_1.jpg',24),
('./view/img/goods/g24_2.jpg',24),
('./view/img/goods/g24_3.jpg',24),
('./view/img/goods/g24_4.jpg',24),
('./view/img/goods/g24_5.jpg',24);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('电脑椅家用办公椅','./view/img/goods/g25_1.jpg','产品参数',239,159,100,'2017-10-27','2018-11-30',7,12,'前是十名半价',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g25_1.jpg',25),
('./view/img/goods/g25_2.jpg',25),
('./view/img/goods/g25_3.jpg',25),
('./view/img/goods/g25_4.jpg',25),
('./view/img/goods/g25_5.jpg',25);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('梦诺红酒','./view/img/goods/g26_1.jpg','产品参数',199,99,100,'2017-10-27','2018-11-30',8,8,'2支装送礼',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g26_1.jpg',26),
('./view/img/goods/g26_2.jpg',26),
('./view/img/goods/g26_3.jpg',26),
('./view/img/goods/g26_4.jpg',26),
('./view/img/goods/g26_5.jpg',26);



insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('棉马甲女韩版','./view/img/goods/g27_1.jpg','产品参数',169,99,100,'2017-10-27','2018-11-30',9,1,'秋冬2017新款',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g27_1.jpg',27),
('./view/img/goods/g27_2.jpg',27),
('./view/img/goods/g27_3.jpg',27),
('./view/img/goods/g27_4.jpg',27),
('./view/img/goods/g27_5.jpg',27);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('偏小一码棉服男装','./view/img/goods/g28_1.jpg','产品参数',169,99,100,'2017-10-27','2018-11-30',9,3,'秋冬2017新款',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g28_1.jpg',28),
('./view/img/goods/g28_2.jpg',28),
('./view/img/goods/g28_3.jpg',28),
('./view/img/goods/g28_4.jpg',28),
('./view/img/goods/g28_5.jpg',28);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('四叶草手链','./view/img/goods/g29_1.jpg','产品参数',169,139,100,'2017-10-27','2018-11-30',9,15,'2017新款',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g29_1.jpg',29),
('./view/img/goods/g29_2.jpg',29),
('./view/img/goods/g29_3.jpg',29),
('./view/img/goods/g29_4.jpg',29),
('./view/img/goods/g29_5.jpg',29);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('四叶草手链','./view/img/goods/g29_1.jpg','产品参数',169,139,100,'2017-10-27','2018-11-30',9,15,'2017新款',2,'2017-11-11 22:03:19','普通购买');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g29_1.jpg',30),
('./view/img/goods/g29_2.jpg',30),
('./view/img/goods/g29_3.jpg',30),
('./view/img/goods/g29_4.jpg',30),
('./view/img/goods/g29_5.jpg',30);
--
-- insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
-- ('182022cm鼓型家用燃气防爆压力锅','./view/img/goods/g30_1.jpg','产品参数',169,139,100,'2017-10-27','2018-11-30',9,12,'苏泊尔高压锅 ',2,'2017-11-11 22:03:19','普通购买');
-- insert into t_imgs(i_imgSrc,i_goods) values
-- ('./view/img/goods/g30_1.jpg',30),
-- ('./view/img/goods/g30_2.jpg',30),
-- ('./view/img/goods/g30_3.jpg',30),
-- ('./view/img/goods/g30_4.jpg',30),
-- ('./view/img/goods/g30_5.jpg',30);


#限时秒杀
insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('镇店铁观音茶叶','./view/img/goods/g1_0.jpg','产品参数',208,68,100,'2017-10-27','2018-11-30',6,8,'浓香铁观音！ 高山',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g1_1.jpg',31),
('./view/img/goods/g1_2.jpg',31),
('./view/img/goods/g1_1.jpg',31),
('./view/img/goods/g1_2.jpg',31),
('./view/img/goods/g1_2.jpg',31);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('桂圆红枣枸杞茶','./view/img/goods/g2_1.jpg','产品参数',58,28.8,100,'2017-10-27','2018-11-30',6,8,'【第2份半价】',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g2_1.jpg',32),
('./view/img/goods/g2_2.jpg',32),
('./view/img/goods/g2_3.jpg',32),
('./view/img/goods/g2_4.jpg',32),
('./view/img/goods/g2_5.jpg',32);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('鲜活阳澄湖螃蟹','./view/img/goods/g3_1.jpg','产品参数',88,68,100,'2017-10-27','2018-11-30',6,8,'【第二件1元】',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g3_1.jpg',33),
('./view/img/goods/g3_2.jpg',33),
('./view/img/goods/g3_3.jpg',33),
('./view/img/goods/g3_4.jpg',33),
('./view/img/goods/g3_5.jpg',33);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('加里曼丹沉香佛珠手链','./view/img/goods/g4_1.jpg','产品参数',66,58,100,'2017-10-27','2018-11-30',6,15,'【花豹纹】',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g4_1.jpg',34),
('./view/img/goods/g4_2.jpg',34),
('./view/img/goods/g4_3.jpg',34),
('./view/img/goods/g4_4.jpg',34),
('./view/img/goods/g4_5.jpg',34);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('武夷山岩茶浓香大红袍','./view/img/goods/g5_1.jpg','产品参数',55,32,100,'2017-10-27','2018-11-30',6,8,'【天天特价】',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g5_1.jpg',35),
('./view/img/goods/g5_2.jpg',35),
('./view/img/goods/g5_3.jpg',35),
('./view/img/goods/g5_4.jpg',35),
('./view/img/goods/g5_5.jpg',35);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('OPPO R11全新手机','./view/img/goods/g6_1.jpg','产品参数',2999,2899,100,'2017-10-27','2018-11-30',6,9,'12期免息',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g6_1.jpg',36),
('./view/img/goods/g6_2.jpg',36),
('./view/img/goods/g6_3.jpg',36),
('./view/img/goods/g6_4.jpg',36),
('./view/img/goods/g6_5.jpg',36);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('52度宜宾五粮液','./view/img/goods/g7_1.jpg','产品参数',399,299,100,'2017-10-27','2018-11-30',6,8,'A级上品',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g7_1.jpg',37),
('./view/img/goods/g7_2.jpg',37),
('./view/img/goods/g7_3.jpg',37),
('./view/img/goods/g7_4.jpg',37),
('./view/img/goods/g7_5.jpg',37);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('海尔变频滚筒洗衣机','./view/img/goods/g8_1.jpg','产品参数',3999,3699,100,'2017-10-27','2018-11-30',6,9,'先购先得',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g8_1.jpg',38),
('./view/img/goods/g8_2.jpg',38),
('./view/img/goods/g8_3.jpg',38),
('./view/img/goods/g8_4.jpg',38),
('./view/img/goods/g8_5.jpg',38);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('高端组装台式','./view/img/goods/g9_1.jpg','产品参数',3999,3699,100,'2017-10-27','2018-11-30',6,9,'先购先得',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g9_1.jpg',39),
('./view/img/goods/g9_2.jpg',39),
('./view/img/goods/g9_3.jpg',39),
('./view/img/goods/g9_4.jpg',39),
('./view/img/goods/g9_5.jpg',39);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('时尚防水石英表','./view/img/goods/g10_1.jpg','产品参数',299,199,100,'2017-10-27','2018-11-30',6,15,'先购先得',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g10_1.jpg',40),
('./view/img/goods/g10_2.jpg',40),
('./view/img/goods/g10_3.jpg',40),
('./view/img/goods/g10_4.jpg',40),
('./view/img/goods/g10_5.jpg',40);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('青年立领加厚棉衣','./view/img/goods/g11_1.jpg','产品参数',199,129,100,'2017-10-27','2018-11-30',6,3,'先购先得',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g11_1.jpg',41),
('./view/img/goods/g11_2.jpg',41),
('./view/img/goods/g11_3.jpg',41),
('./view/img/goods/g11_4.jpg',41),
('./view/img/goods/g11_5.jpg',41);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('半合成汽油机油','./view/img/goods/g12_1.jpg','产品参数',199,129,100,'2017-10-27','2018-11-30',6,17,'艾纳5W40合成型 ',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g12_1.jpg',42),
('./view/img/goods/g12_2.jpg',42),
('./view/img/goods/g12_3.jpg',42),
('./view/img/goods/g12_4.jpg',42),
('./view/img/goods/g12_5.jpg',42);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('真皮带男士手表','./view/img/goods/g13_1.jpg','产品参数',699,599,100,'2017-10-27','2018-11-30',6,15,'全自动机械表',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g13_1.jpg',43),
('./view/img/goods/g13_2.jpg',43),
('./view/img/goods/g13_3.jpg',43),
('./view/img/goods/g13_4.jpg',43),
('./view/img/goods/g13_5.jpg',43);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('冬季毛呢外套','./view/img/goods/g14_1.jpg','产品参数',199,119,100,'2017-10-27','2018-11-30',7,1,'大码女秋装',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g14_1.jpg',44),
('./view/img/goods/g14_2.jpg',44),
('./view/img/goods/g14_3.jpg',44),
('./view/img/goods/g14_4.jpg',44),
('./view/img/goods/g14_5.jpg',44);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('冬季小棉袄女','./view/img/goods/g15_1.jpg','产品参数',199,119,100,'2017-10-27','2018-11-30',8,1,'大码女装冬装',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g15_1.jpg',45),
('./view/img/goods/g15_2.jpg',45),
('./view/img/goods/g15_3.jpg',45),
('./view/img/goods/g15_4.jpg',45),
('./view/img/goods/g15_5.jpg',45);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('真皮增高男鞋','./view/img/goods/g16_1.jpg','产品参数',199,129,100,'2017-10-27','2018-11-30',9,4,'冬季商务正装皮鞋',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g16_1.jpg',46),
('./view/img/goods/g16_2.jpg',46),
('./view/img/goods/g16_3.jpg',46),
('./view/img/goods/g16_4.jpg',46),
('./view/img/goods/g16_5.jpg',46);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('时尚防水钢带腕表','./view/img/goods/g17_1.jpg','产品参数',399,229,100,'2017-10-27','2018-11-30',11,15,'古卡伦全自动机械表',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g17_1.jpg',47),
('./view/img/goods/g17_2.jpg',47),
('./view/img/goods/g17_3.jpg',47),
('./view/img/goods/g17_4.jpg',47),
('./view/img/goods/g17_5.jpg',47);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('浓香型醇香铁观音','./view/img/goods/g18_1.jpg','产品参数',49,29,100,'2017-10-27','2018-11-30',12,8,'广蕴茶叶 2017新茶 ',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g18_1.jpg',48),
('./view/img/goods/g18_2.jpg',48),
('./view/img/goods/g18_3.jpg',48),
('./view/img/goods/g18_4.jpg',48),
('./view/img/goods/g18_5.jpg',48);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('套机单电xa10','./view/img/goods/g19_1.jpg','产品参数',3399,2999,100,'2017-10-27','2018-11-30',5,9,'自拍入门级',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g19_1.jpg',49),
('./view/img/goods/g19_2.jpg',49),
('./view/img/goods/g19_3.jpg',49),
('./view/img/goods/g19_4.jpg',49),
('./view/img/goods/g19_5.jpg',49);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('加厚铸铁锅双耳炒锅','./view/img/goods/g20_1.jpg','产品参数',3399,2999,100,'2017-10-27','2018-11-30',5,12,'无油烟无涂层不粘锅',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g20_1.jpg',50),
('./view/img/goods/g20_2.jpg',50),
('./view/img/goods/g20_3.jpg',50),
('./view/img/goods/g20_4.jpg',50),
('./view/img/goods/g20_5.jpg',50);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('野生淡干虾皮虾仁','./view/img/goods/g21_1.jpg','产品参数',29,23,100,'2017-10-27','2018-11-30',6,8,' 250g包邮',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g21_1.jpg',51),
('./view/img/goods/g21_2.jpg',51),
('./view/img/goods/g21_3.jpg',51),
('./view/img/goods/g21_4.jpg',51),
('./view/img/goods/g21_5.jpg',51);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('冬季加厚被子','./view/img/goods/g22_1.jpg','产品参数',199,159,100,'2017-10-27','2018-11-30',6,11,'巨亏8斤',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g22_1.jpg',52),
('./view/img/goods/g22_2.jpg',52),
('./view/img/goods/g22_3.jpg',52),
('./view/img/goods/g22_4.jpg',52),
('./view/img/goods/g22_5.jpg',52);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('马丁靴男短靴','./view/img/goods/g23_1.jpg','产品参数',199,159,100,'2017-10-27','2018-11-30',7,4,'百搭休闲鞋',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g23_1.jpg',53),
('./view/img/goods/g23_2.jpg',53),
('./view/img/goods/g23_3.jpg',53),
('./view/img/goods/g23_4.jpg',53),
('./view/img/goods/g23_5.jpg',53);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('法国原装进口红酒','./view/img/goods/g24_1.jpg','产品参数',199,159,100,'2017-10-27','2018-11-30',7,8,'买一箱得2箱 ',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g24_1.jpg',54),
('./view/img/goods/g24_2.jpg',54),
('./view/img/goods/g24_3.jpg',54),
('./view/img/goods/g24_4.jpg',54),
('./view/img/goods/g24_5.jpg',54);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('电脑椅家用办公椅','./view/img/goods/g25_1.jpg','产品参数',239,159,100,'2017-10-27','2018-11-30',7,12,'前是十名半价',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g25_1.jpg',55),
('./view/img/goods/g25_2.jpg',55),
('./view/img/goods/g25_3.jpg',55),
('./view/img/goods/g25_4.jpg',55),
('./view/img/goods/g25_5.jpg',55);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('梦诺红酒','./view/img/goods/g26_1.jpg','产品参数',199,99,100,'2017-10-27','2018-11-30',8,8,'2支装送礼',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g26_1.jpg',56),
('./view/img/goods/g26_2.jpg',56),
('./view/img/goods/g26_3.jpg',56),
('./view/img/goods/g26_4.jpg',56),
('./view/img/goods/g26_5.jpg',56);



insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('棉马甲女韩版','./view/img/goods/g27_1.jpg','产品参数',169,99,100,'2017-10-27','2018-11-30',9,1,'秋冬2017新款',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g27_1.jpg',57),
('./view/img/goods/g27_2.jpg',57),
('./view/img/goods/g27_3.jpg',57),
('./view/img/goods/g27_4.jpg',57),
('./view/img/goods/g27_5.jpg',57);

insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('偏小一码棉服男装','./view/img/goods/g28_1.jpg','产品参数',169,99,100,'2017-10-27','2018-11-30',9,3,'秋冬2017新款',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g28_1.jpg',58),
('./view/img/goods/g28_2.jpg',58),
('./view/img/goods/g28_3.jpg',58),
('./view/img/goods/g28_4.jpg',58),
('./view/img/goods/g28_5.jpg',58);


insert into t_goods(g_name,g_img,g_detail,g_origPrice,g_nowPrice,g_stock,g_startDate,g_endDate,g_skTime,g_type,g_note,g_limitNum,g_pubTime,g_pubType) values
('四叶草手链','./view/img/goods/g29_1.jpg','产品参数',169,139,100,'2017-10-27','2018-11-30',9,15,'2017新款',2,'2017-11-11 22:03:19','限时秒杀');
insert into t_imgs(i_imgSrc,i_goods) values
('./view/img/goods/g29_1.jpg',59),
('./view/img/goods/g29_2.jpg',59),
('./view/img/goods/g29_3.jpg',59),
('./view/img/goods/g29_4.jpg',59),
('./view/img/goods/g29_5.jpg',59);


#防sql注入
SELECT * from t_emp where e_account='test' or 1=1 -- ' and e_pwd='e10adc3949ba59abbe56e057f20f883e';
#获取员工状态
SELECT e_state from t_emp where e_account='root';

#获取登录信息
SELECT a.*,b.* from t_emp a,t_role b where a.e_role=b.r_id and a.e_account='root' and a.e_pwd='e10adc3949ba59abbe56e057f20f883e' and a.e_state='使用';
#获取菜单权限
SELECT a.* from t_menu a,t_emp b,t_perm c where a.m_id=c.p_menu and c.p_role=b.e_role and b.e_role=1 ORDER BY a.m_id;
SELECT DISTINCT a.* from t_menu a LEFT JOIN t_perm c on a.m_id=c.p_menu  LEFT JOIN t_emp b on c.p_role=b.e_role WHERE c.p_role={$role} ORDER BY a.m_id;

#导航菜单
SELECT * FROM t_menu where m_id=8 or m_id=(SELECT m_fid FROM t_menu where m_id=8) ORDER BY m_id;

#角色列表
SELECT * FROM t_role;

#添加角色
INSERT t_role VALUES(DEFAULT,'物流','快递员');
#修改角色
UPDATE t_role set r_name='',r_desc='' where r_id=2;
UPDATE t_role set r_name='保管员',r_desc='测试' where r_id=8;
#删除角色
-- DELETE from t_perm where p_role=10;
DELETE from t_role where r_id=10;
#获取员工
SELECT * FROM t_Emp a,t_role b where a.e_role=b.r_id;
#获取角色
SELECT * FROM t_role where r_id not in(SELECT p_role FROM t_perm where p_menu=8) ORDER BY r_id

SELECT * FROM t_emp a,t_role b where a.e_role=b.r_id and a.e_state='锁定' and  b.r_id not in(SELECT p_role FROM t_perm where p_menu=8) order BY a.e_id;
#更新用户状态
update t_emp set e_state='锁定' where e_id=1 AND e_id<>1;
#获取菜单
SELECT DISTINCT a.* from t_menu a,t_emp b,t_perm c where a.m_id=c.p_menu and c.p_role=b.e_role and b.e_role=3 ORDER BY a.m_id;

select * from t_perm where p_role=3 and p_menu=9;
#获取权限
SELECT DISTINCT a.* from t_menu a,t_emp b,t_perm c where a.m_id=c.p_menu and c.p_role=b.e_role and b.e_role=3 ORDER BY a.m_id;
SELECT DISTINCT a.* from t_menu a,t_emp b,t_perm c where a.m_id=c.p_menu and c.p_role=b.e_role and c.p_role=5 ORDER BY a.m_id;
SELECT DISTINCT a.* from t_menu a LEFT JOIN t_perm c on a.m_id=c.p_menu  LEFT JOIN t_emp b on c.p_role=b.e_role WHERE c.p_role=5 ORDER BY a.m_id;
#获取商品类型
SELECT * from t_goodstype;

SELECT * from t_sktime;
#获取刚插入数据自增长id
select last_insert_id();
#获取全部商品
SELECT * from t_goods where 1=1 order by g_id limit 0,5;
#获取在售商品
SELECT * from t_goods where 1=1 and g_startDate<NOW() and g_endDate>NOW() order by g_id limit 0,2;

select count(*) from t_goods where 1=1;

select count(*) from t_goods where 1=1  and g_type=2;
select * from t_goods where 1=1  and g_type=12 and g_startDate<=NOW() and (g_endDate>NOW() or g_endDate is null) and g_name  LIKE "%茶%" order by g_id limit 0,3;

select * from t_goods where g_endDate is null;

select * from t_goods where  g_startDate<NOW() and g_id=3;

UPDATE t_goods set g_startDate=null where g_id=3;


update t_goods set g_endDate=null,g_startDate=now()  where g_id={$id}
#订单查询
select * from t_order a join t_ordergoods b on a.o_id=b.o_order join t_user c on a.o_user=c.u_id where a.o_status in ('交易关闭','未支付');

update t_goods set g_name=?,g_origPrice=?,g_nowPrice=?,g_stock=?,g_type=?,g_pubType=?,g_pubTime=?,g_img=?,g_limitNum=?,g_startDate=?,g_endDate=?,g_skTime=?,g_note=? where g_id=?
#未支付订单
select a.*,d.*,c.u_account,ROUND(SUM(b.o_num*b.o_price),2) o_total from t_order a LEFT JOIN t_ordergoods b on a.o_id=b.o_order LEFT join t_user c on a.o_user=c.u_id LEFT join t_goods d on b.o_goods=d.g_id where a.o_status in ('交易关闭','未支付') GROUP BY a.o_id;
#已支付订单
select a.*,d.*,c.u_account,ROUND(SUM(b.o_num*b.o_price),2) o_total from t_order a LEFT JOIN t_ordergoods b on a.o_id=b.o_order LEFT join t_user c on a.o_user=c.u_id LEFT join t_goods d on b.o_goods=d.g_id where a.o_status in ('交易成功','已发货','已支付') GROUP BY a.o_id;
#订单详情
select a.*,d.*,c.u_account,ROUND(SUM(b.o_num*b.o_price),2) o_total from t_order a LEFT JOIN t_ordergoods b on a.o_id=b.o_order LEFT join t_user c on a.o_user=c.u_id LEFT join t_goods d on b.o_goods=d.g_id where a.o_status in ('交易成功','已发货','已支付') GROUP BY a.o_id;
SELECT * from t_ordergoods a left join t_goods b on a.o_goods=b.g_id LEFT JOIN t_order c on a.o_order=c.o_id LEFT JOIN t_addr d on c.o_addr=d.a_id where a.o_order=1 order by a.o_id;
#发货
UPDATE t_order set o_status='已发货',o_sendTime=now() where o_id=4;
#用户
select * from t_user where 1=2 or u_account like "%1%" or u_account like "%%" ORDER BY u_id desc LIMIT 0,2;
#获取当年每月注册人数
select count(*) regNum,date_format(u_regTime,'%c') mouth from t_user where year(u_regTime)=year(curdate()) group by date_format(u_regTime, '%Y-%m') ORDER BY u_regTime;
#获取当年每月营业额
SELECT sum(o_total) saleSum,date_format(o_time,'%c') mouth from (select a.*,ROUND(SUM(b.o_num*b.o_price),2) o_total from t_order a LEFT JOIN t_ordergoods b on a.o_id=b.o_order where a.o_status='交易成功' GROUP BY a.o_id) c where year(o_time)=year(curdate()) group by date_format(o_time, '%Y-%m') ORDER BY o_time;

select * from t_user where year(FROM_UNIXTIME(u_regTime))=year(curdate())
select year(u_regTime) from t_user
select year(FROM_UNIXTIME(now()));
select year(curdate());
update t_user set u_pwd='e10adc3949ba59abbe56e057f20f883e' where u_id=1;
select * from t_emp where 1=1 and e_id='1';

SELECT * from t_user where u_account='admin1';

INSERT t_user VALUES (DEFAULT,'admin22','e10adc3949ba59abbe56e057f20f883e','用户22',DEFAULT,DEFAULT,'2017-12-12',DEFAULT,'22qq.com',DEFAULT)

select * from t_imgs where i_goods=2;
select a.*,b.u_head,b.u_name from t_comments a join t_user b on a.c_user=b.u_id where a.c_goods=2;

INSERT INTO t_shoppingCarGoods VALUES(DEFAULT,1,2,(select g_nowPrice FROM t_goods where g_id=1),1);

SELECT *,b.s_id id from t_shoppingcar a join t_shoppingcargoods b on a.s_id=b.s_shoppingcar join t_goods c on b.s_goods=c.g_id where b.s_goods=1 and a.s_user=1;
SELECT sum(b.s_num) from t_shoppingcar a join t_shoppingcargoods b on a.s_id=b.s_shoppingcar join t_goods c on b.s_goods=c.g_id where b.s_goods=1 and a.s_user=1 GROUP BY a.s_id
UPDATE t_shoppingCarGoods set s_num=4 where s_id=1;

select * from t_shoppingCar a join t_shoppingCarGoods b on a.s_id=b.s_shoppingCar join t_goods c on b.s_goods=c.g_id where a.s_user=2 ORDER BY s_shoppingTime DESC LIMIT 0,3;

select COUNT(*) from t_shoppingCar a join t_shoppingCarGoods b on a.s_id=b.s_shoppingCar where a.s_user=2

UPDATE t_shoppingCarGoods set s_num=4 where s_id=1;

INSERT t_user VALUES
(DEFAULT,'admin21',DEFAULT,'用户1',DEFAULT,DEFAULT,'2017-1-11',1,DEFAULT,DEFAULT,DEFAULT);

select *,last_insert_id() lastId from t_shoppingCarGoods a join t_goods b on a.s_id=b.g_id WHERE a.s_id in (1,2,3);

select 1,2,3;
-- SELECT a.s_id,a.s_num,b.g_nowPrice,last_insert_id() lastId from t_shoppingCarGoods a join t_goods b on a.s_goods=b.g_id where 1=2 or s_id=1 or s_id=2;
insert into t_order VALUES(DEFAULT,now(),Array,'未支付',12,DEFAULT);
insert into t_order VALUES
(DEFAULT,now(),1,'未支付',1,DEFAULT);
insert into t_orderGoods(o_goods,o_num,o_price,o_order)
SELECT a.s_id,a.s_num,b.g_nowPrice,last_insert_id() lastId from t_shoppingCarGoods a join t_goods b on a.s_goods=b.g_id where 1=2 or s_id=1 or s_id=2;
insert into t_orderGoods(o_goods,o_num,o_price,o_order) SELECT a.s_id,a.s_num,b.g_nowPrice,last_insert_id() lastId from t_shoppingCarGoods a join t_goods b on a.s_goods=b.g_id where 1=2  or a.s_id=4  or a.s_id=6

delete from t_shoppingCarGoods where 1=2 ;
delete from t_shoppingCarGoods where 1=2  or s_id=4  or s_id=6 ;
SELECT a.s_num,b.g_id from t_shoppingCarGoods a join t_goods b on a.s_goods=b.g_id where 1=2
update t_goods set g_stock= where 1=2 or g_id=(select s_goods from t_shoppingCarGoods where s_id=5;

select ROUND(SUM(b.o_num*b.o_price),2) o_sum from t_order a join t_orderGoods b on a.o_id=b.o_order join t_goods c on b.o_goods=c.g_id where a.o_id=3;
update t_order set o_status='已支付' where o_id=21;
update t_user set u_coin=u_coin-30 where u_id=2;

select * from t_shoppingCar where 1=1 and s_user='2'
SELECT *,b.s_id id from t_shoppingcar a join t_shoppingcargoods b on a.s_id=b.s_shoppingcar join t_goods c on b.s_goods=c.g_id where b.s_goods=2 and a.s_user=2

INSERT INTO t_shoppingCarGoods VALUES(DEFAULT,2,1,2,now());

SELECT a.s_id,a.s_num,b.g_id,b.g_stock from t_shoppingCarGoods a join t_goods b on a.s_goods=b.g_id where 1=2 or a.s_id=4  or a.s_id=6
insert into t_orderGoods(o_goods,o_num,o_price,o_order) SELECT b.g_id,a.s_num,b.g_nowPrice,last_insert_id() lastId from t_shoppingCarGoods a join t_goods b on a.s_goods=b.g_id where 1=2  or a.s_id=31  or a.s_id=32
insert into t_order VALUES(DEFAULT,now(),2,'\u672a\u652f\u4ed8',2,DEFAULT)
SELECT last_insert_id()

0
:
"insert into t_orderGoods(o_goods,o_num,o_price,o_order) SELECT a.s_id,a.s_num,b.g_nowPrice,last_insert_id() lastId from t_shoppingCarGoods a join t_goods b on a.s_goods=b.g_id where 1=2  or a.s_id=30 "
1
:
"delete from t_shoppingCarGoods where 1=2  or s_id=30 "
2
:
"update t_goods set g_stock=96 where g_id=2"
select ROUND(SUM(b.o_num*b.o_price),2) o_sum from t_order a join t_orderGoods b on a.o_id=b.o_order join t_goods c on b.o_goods=c.g_id where a.o_id=46

select now()
select unix_timestamp(now())
SELECT DATE('2017-12-12 12:12:12')
select * from t_skTime where  s_startTime<=NOW() order by s_id desc limit 0,1;
select a.*,b.u_head from t_comments a join t_user b on a.c_user=b.u_id where a.c_goods=1;
select a.o_time,b.u_name from t_order a join t_user b on a.o_user=b.u_id join t_orderGoods c on a.o_id=c.o_order where c.o_goods=1 and a.o_status='交易成功';

select * from t_imgs where i_goods=1;
select * from t_goods where g_pubType='' and now()>=g_startTime and (g_endTime>now() or g_endTime is null)  order by g_id limit 0,4



select count(*) from t_order where  o_status in ('未支付','交易关闭') and u_id=2

select *, sum(b.o_num) sum from t_order a join t_orderGoods b on a.o_id=b.o_order where date(a.o_time)='2017-12-17' and (a.o_status='未支付' or a.o_status='已支付' or a.o_status='已发货' or a.o_status='交易成功') group by a.o_user,b.o_goods;
select * from t_order a join t_orderGoods b on a.o_id=b.o_order where date(a.o_time)='2017-12-17' and (a.o_status='未支付' or a.o_status='已支付' or a.o_status='已发货' or a.o_status='交易成功') ;
SELECT date(now())

insert into t_order(o_time,o_user,o_goods,num,price,o_status,o_addr) values(?,?,?,?,?,?,?)
-- [orderObj.orderTime,orderObj.userName,orderObj.goodsId,orderObj.num,orderObj.price,orderObj.status,orderObj.addrId]
#秒杀插入订单
insert into t_order(o_time,o_user,o_status,o_addr) values(?,?,?,?)
insert into t_orderGoods(o_goods,o_num,o_price,o_order) values(?,?,?,last_insert_id())

insert into t_order(o_time,o_user,o_status,o_addr) values(NOW(),1,'未支付',1);
insert into t_orderGoods(o_goods,o_num,o_price,o_order) values(1,3,66,last_insert_id());

select a.*,b.g_name from t_order a join t_goods b on a.o_id=b.g_id join t_orderGoods c on a.o_id=c.o_order where b.g_pubType='限时秒杀' and a.o_status<>'交易关闭' order by a.o_time desc limit 0,10;
select count(distinct sender)+1 maxId from t_chats where sender not in (select e_account from t_emp where e_role=4) and type='visitorText'

select distinct a.userName,b.u_head from (select rever as userName from t_chats where sender='cccccc'
union select sender as userName from t_chats where rever='cccccc') a left join t_user b on a.userName=b.u_account;

select * from t_goods where g_pubType='限时秒杀' and g_skTime=9 and '2017-12-24' between g_startDate and g_endDate