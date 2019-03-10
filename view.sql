/***
**
**管理员表OK
**
***/
create table view_admin(
	id int unsigned not null primary key auto_increment , 
	adminuser varchar(32) not null default '',
	adminpass char(32) not null default '',
	adminemail varchar(50) not null default '',
	logintime int unsigned not null default 0,
	loginip bigint not null default 0,
	createtime int unsigned not null default 0,
	UNIQUE view_admin_adminuser_adminpass(adminuser,adminpass),
	UNIQUE view_admin_adminuser_adminemail(adminuser,adminemail)
	)engine=innodb charset=utf8;
/***
**
**艺术资讯表OK
**
***/
create table view_news(
	newid int unsigned not null primary key auto_increment COMMENT '主键ID',
	title varchar(200) not null default '' COMMENT '新闻标题',
	content text COMMENT '新闻内容',
	cover varchar(200) not null default 'http://ooc0eu4ky.bkt.clouddn.com/58f4b60e1156a' COMMENT '封面照片',
	pics text COMMENT '新闻配图',
	num int unsigned not null default 0 COMMENT '新闻访问量',
	author varchar(50) not null default '' COMMENT '作者姓名',
	createtime int unsigned not null default 0 COMMENT '创建时间'
	)engine=innodb charset=utf8;
/***
**
**用户基本信息表OK
**
***/
create table view_user(
	userid bigint unsigned not null primary key auto_increment,
	username varchar(32) not null default '' COMMENT '用户名',
	userpass char(32) not null default '' COMMENT '用户密码',
	useremail varchar(100) not null default '' COMMENT '用户邮箱',
	photo varchar(100) not null default 'http://ooc0eu4ky.bkt.clouddn.com/58f4b60e6c289' COMMENT '用户头像',
	phone varchar(30) not null default '' COMMENT '手机号码',
	createtime int unsigned not null default 0 COMMENT '用户注册时间',
	UNIQUE view_user_username_userpass(username,userpass),
	UNIQUE view_user_useremail_userpass(useremail,userpass)
	)engine = innodb default charset = utf8;
/***
**
**用户详细信息表OK
**
***/
create table view_profile(
	id bigint unsigned not null auto_increment primary key COMMENT '主键ID',
	truename varchar(32) not null default '' COMMENT '真实姓名',
	introduction text COMMENT '个人简介',
	age tinyint unsigned not null default 0 COMMENT '年龄',
	sex ENUM('0','1','2') not null default '0' COMMENT '性别',
	nickname varchar(32) not null default '' COMMENT '昵称',
	userid bigint unsigned not null default 0 COMMENT '用户ID',
	createtime int unsigned not null default 0 COMMENT '创建时间',
	UNIQUE view_profile_userid(userid))engine=innodb default charset=utf8;
/***
**
**艺术家信息表
**
***/
create table view_artist(
	artistid bigint unsigned primary key auto_increment COMMENT '主键ID',
	name varchar(100) not null default '' COMMENT '姓名',
	identity varchar(200) not null default '' COMMENT '身份/职业',
	career text COMMENT '个人履历',
	introduction text COMMENT '个人简介',
	cover varchar(300) not null default 'http://ooc0eu4ky.bkt.clouddn.com/110bab535259d9525201133b51765a8e.jpg' COMMENT '封面照片',
	pics text COMMENT '艺术家配图',
	num int unsigned not null default 0 COMMENT '被关注人数',
	createtime int unsigned not null default 0 COMMENT '创建时间'
	)engine=innodb default charset=utf8;
/***
**
**作品信息表
**
***/
create table view_production(
	productionid bigint unsigned not null primary key auto_increment,
	title varchar(100) not null default '' COMMENT '标题',
	content text COMMENT '文字简介',
	cover varchar(255) not null default 'http://ooc0eu4ky.bkt.clouddn.com/590c31da2f381' COMMENT '封面图片',
	pics text COMMENT '有关图片',
	artistid bigint unsigned not null default 1 COMMENT '属于艺术家',
	createtime int unsigned not null default 0 COMMENT '创建时间',
	index view_production_artistid(artistid))engine=innodb default charset=utf8;
/***
**
**展览消息表OK
**
***/
create table view_show(
	showid bigint unsigned not null primary key auto_increment COMMENT '主键ID',
	title varchar(200) not null default '' COMMENT '消息标题',
	smalltitle varchar(50) not null default '' COMMENT '小标题',
	introduction text COMMENT '展览简介',
	cover varchar(300) not null default 'http://ooc0eu4ky.bkt.clouddn.com/HjHVL55VWVswbr0sOaVIouQ.jpg%211200.jpg' COMMENT '封面图片',
	pics text COMMENT '展览图片',
	pay int not null default 0 COMMENT '入场费用',
	num int unsigned not null default 0 COMMENT '报名人数',
	start_time int not null default 0 COMMENT '展览开始时间',
	end_time int not null default 0 COMMENT '展览结束时间',
	day_time varchar(100) not null default '' COMMENT '每天开放时间',
	city varchar(50) not null default '北京' COMMENT '展览城市',
	place varchar(200) not null default '' COMMENT '展览地点',
	isCover tinyint not null default 0 COMMENT '是否为封面图片',
	artistid bigint unsigned not null default 1 COMMENT '此展览有关人物',
	createtime int unsigned not null default 0 COMMENT '消息发布时间',
	index view_show_artistid(artistid)
	)engine=innodb default charset=utf8;

/***
**
**系统通知表OK
**
***/
create table view_notify(
	notifyid bigint unsigned primary key auto_increment not null COMMENT '主键ID',
	title varchar(50) not null default '' COMMENT '通知标题',
	content varchar(500) not null default '' COMMENT '通知内容',
	userid bigint not null default 0 COMMENT '发送给谁',
	createtime int not null default 0 COMMENT '发送时间',
	index view_notify_userid(userid))engine=innodb default charset=utf8;
INSERT into view_notify(title,content,userid)values('系统通知','您所关心的 “梵高世纪画展已经开始”，望周知',3);
/***
**
**报名记录表OK
**
***/
create table view_ticket(
	ticketid bigint unsigned primary key auto_increment not null COMMENT '主键ID',
	phone varchar(20) not null default '' COMMENT '手机',
	showid bigint not null default 0 COMMENT '展览消息ID',
	userid bigint not null default 0 COMMENT '用户ID',
	createtime int not null default 0 COMMENT '创建时间',
	index view_ticket_showid(showid),
	index view_ticket_userid(userid))engine = innodb default charset = utf8;
/***
**
**关注展览表
**
***/
create table view_careshow(
	id int unsigned primary key auto_increment,
	userid bigint unsigned not null default 0 COMMENT '用户ID',
	showid bigint unsigned not null default 0 COMMENT '展览ID',
	createtime int unsigned not null default 0 COMMENT '创建时间',
	index view_care_userid(userid),
	index view_care_showid(showid))engine=innodb default charset=utf8;
INSERT INTO view_careshow(userid,showid) values(3,2);
/***
**
**关注艺术家表
**
***/
create table view_careart(
	id int unsigned primary key auto_increment,
	userid bigint unsigned not null default 0 COMMENT '用户ID',
	artistid bigint unsigned not null default 0 COMMENT '艺术家ID',
	createtime int unsigned not null default 0 COMMENT '创建时间',
	index view_care_userid(userid),
	index view_care_artistid(artistid))engine=innodb default charset=utf8;
INSERT INTO view_careart(userid,artistid) values(3,2);
/***
**
**意见反馈表
**
***/
create table view_suggestion(
	sugid int unsigned primary key auto_increment COMMENT '主键ID',
	name varchar(100) not null default '' COMMENT '名字',
	phone varchar(100) not null default '' COMMENT '联系方式',
	suggest text COMMENT '意见',
	createtime int unsigned not null default 0 COMMENT '创建时间',
	)engine=innodb default charset=utf8;