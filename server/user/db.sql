drop database if exists gofire_user_db;
create database if not exists gofire_user_db;
use gofire_user_db;

show tables;
drop table if exists ta_situation;
drop table if exists ta_type;
drop table if exists tb_user;
drop table if exists tb_profile;
drop table if exists tb_contact;

create table if not exists ta_situation(
	id int primary key auto_increment,
    code          varchar(20) unique not null,
    label         varchar(255)not null,
    description   varchar(30) ,
    insert_date timestamp not null,
    update_date timestamp,
    delete_date timestamp
);
select  * from ta_situation;
insert into ta_situation value(null, 'ACTIVE', 'ACTIVE', 'ACTIVE DESCRIPTION', sysdate(),null,null);



create table if not exists ta_type(
	id int primary key auto_increment,
	code          varchar(20)unique not null,
    label         varchar(255) not null,
    description   varchar(30),
    insert_date timestamp not null,
    update_date timestamp default null,
    delete_date timestamp default null
);

select  * from ta_type;
insert into ta_type value(null, 'USER_ADMIN', 'ADMIN', 'SYSTEM ADMINISTRATOR', sysdate(),null,null);



create table if not exists tb_user(
	id int primary key auto_increment,
    name			varchar(35)  not null,
    email           varchar(80)  not null unique,
    username        varchar(35)  not null unique,
    password        varchar(128) not null,
    situation_id int  not null,
	insert_date timestamp not null,
    update_date timestamp,
    delete_date timestamp,
	foreign key(situation_id) references ta_situation(id)
);

delete from tb_user where id<>0;
select * from tb_user;
select * from tb_profile;
desc tb_user;

create table if not exists tb_profile(
	id           int primary key auto_increment,
    photo        varchar(41) default null,
    name         varchar(80) not null,
    email        varchar(30) not null unique,
    bio	         varchar(255)default null,
    birthday     timestamp default null,
    user_id      int not null,
    type_id 	 int not null,
    insert_date  timestamp not null,
    update_date  timestamp default null,
    delete_date  timestamp default null,
    foreign key(user_id) references tb_user(id) on delete cascade,
    foreign key(type_id) references ta_type(id)
);

