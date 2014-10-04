drop database if exists wigi;
create database wigi;

use wigi;

drop table if exists user;
-- user_type : 1 : user, 2: company
-- status : 0: new/pending, 1: active, 2: suspended
-- message_method : 1 : email, 2 : SMS
create table user (
    user_id int(11) unsigned not null auto_increment primary key,
    email varchar(100) not null,
    user_type tinyint(3) unsigned not null default 1,
    password char(32) not null,
    status tinyint(3) unsigned not null default 0,
    first_name varchar(100),
    last_name varchar(100),
    middle_init varchar(3),
    message_method tinyint(3) not null default 1, 
    email_confirmed boolean not null default 0,
    email_confirmation_code varchar(10),
    cellphone_confirmed boolean not null default 0,
    lock_count tinyint(3) not null default 0,
    login_code varchar(10),
    login_code_expires datetime,
    question varchar(255),
    answer varchar(255),
    tos_id unsigned tinyint not null default '0',
    tos_accepted_date date_time,
    merchant_id varchar(30),
    country_code varchar(10),
    business_type tinyint(3),
    business_name varchar(100),
    business_tax_id varchar(50),
    business_phone varchar(50),
    date_added datetime,
    user_added varchar(60),
    date_changed timestamp,
    user_changed varchar(60)
) engine=innodb;
create unique index uix_email on user(email);

drop table if exists user_ext;
create table user_ext(
    `user_ext_id` int(11) unsigned not null auto_increment primary key,
    `key` varchar(100) not null,
    `val` varchar(100) not null,
    `category` tinyint(3)
);

drop table if exists user_address;
-- address_type: 1: home, 2: work
create table user_address (
    user_address_id int(11) unsigned not null auto_increment primary key,
    user_id int(11) unsigned not null,
    address_type tinyint(3) unsigned not null,
    addr_line1 varchar(100),
    addr_line2 varchar(100),
    addr_line3 varchar(100),
    addr_line4 varchar(100),
    city varchar(100),
    state varchar(50),
    zip varchar(15),
    country_code char(3),
    is_default boolean default 0,
    date_added datetime,
    user_added varchar(60),
    date_changed timestamp,
    user_changed varchar(60)
) engine=innodb;
create index ix_email on user_address(user_id);
create unique index uix_user_address_type on user_address(user_id, address_type);
create unique index uix_user_address on user_address(user_id, addr_line1, addr_line2, addr_line3, addr_line4, city, state, zip, country_code);

drop table if exists user_contact;
-- contact_type : 1: friend 2: relative 3: business-associate, 4: co-worker
create table user_contact (
    user_contact_id int(11) unsigned not null primary key,
    user_id int(11) unsigned not null,
    contact_type tinyint(3) unsigned not null,
    contact_user_id int(11) unsigned not null,
    date_added datetime,
    user_added varchar(60),
    date_changed timestamp,
    user_changed varchar(60)
) engine=innodb;
create unique index ix_user_contact on user_contact(user_id, contact_user_id, contact_type);
create index ix_contact_user_id on user_contact(contact_user_id);

drop table if exists user_mobile;
-- mobile_type: 1:us 2:india etc. - something that will drive SMS gateway
create table user_mobile (
    mobile_id int(11) unsigned not null auto_increment primary key,
    user_id int(11) unsigned not null,
    mobile_type mediumint(6) unsigned not null,
    cellphone varchar(30) not null,
    status smallint not null default 0,
    mobile_confirmation_code varchar(10),
    is_default boolean not null default 0,
    pin char(32) not null,
    balance decimal(10,2) not null default 0,
    temp_balance decimal(10,2) not null default 0,
    has_message tinyint unsigned,
    has_txn tinyint unsigned,
    date_added datetime,
    user_added varchar(60),
    date_changed timestamp,
    user_changed varchar(60)
) engine=innodb;
create unique index uix_user_mobile on user_mobile(user_id, cellphone);
create unique index uix_mobile_type_id on user_mobile(mobile_type, cellphone);

drop table if exists user_mobile_ext;
create table user_mobile_ext(
    `user_mobile_ext_id` int(11) unsigned not null auto_increment primary key,
    `mobile_id` int(11) unsigned,
    `key` varchar(100) not null,
    `val` varchar(100) not null,
    `category` tinyint(3)
);

drop table if exists message;
create table message(
    `message_id` int(11) unsigned not null auto_increment primary key,
    `message` text,
    `subject` varchar(255),
    `status` tinyint unsigned not null default '0',
    `message_type` tinyint unsigned not null default '1'
);

drop table if exists user_mobile_message;
create table user_mobile_message(
    `user_mobile_message_id` int(11) unsigned not null auto_increment primary key,
    `message_id` int(11) unsigned not null,
    `mobile_id` int(11) unsigned not null,
    `status` int(11) unsigned not null
);

drop table if exists company;
create table company (
    `company_id` int(11) not null auto_increment primary key,
    `company_type` smallint unsigned not null default 0,
    `company_sub_type` smallint unsigned not null default 0,
    `status` smallint not null default 0,
    `name` varchar(100),
    `date_added` datetime,
    `user_added` varchar(60),
    `date_changed` timestamp,
    `user_changed` varchar(60)
);

drop table if exists company_user;
create table company_user (
    `company_user_id` int(11) unsigned not null auto_increment primary key,
    `company_id` int(11) unsigned not null,
    `user_id` int(11) unsigned not null,
    `type` smallint unsigned not null default 0
);

drop table if exists user_credit_card;
-- credit_card_type : 1: mc, 2: visa, 3: amex, 4: discover, 5: diners club
create table user_credit_card (
    user_credit_card_id int(11) unsigned not null primary key,
    user_id int(11) unsigned not null,
    key_version tinyint(3) unsigned not null,
    last4 char(4) not null,
    description varchar(30),
    card_type ENUM('VISA','MAST','AMER','DISC','DINE','JCB'),
    expire_month tinyint unsigned,
    expire_year smallint unsigned,
    name_on_card varchar(255),
    status tinyint(3) not null default '0',
    conf_amt decimal(10,8),
    date_added datetime,
    user_added varchar(60),
    date_changed timestamp,
    user_changed varchar(60)
) engine=innodb;
create index ix_credit_card_user_id on user_credit_card(user_id);

drop table if exists user_mobile_credit_card;

create table user_mobile_credit_card (
    user_mobile_credit_card_id int(11) unsigned not null auto_increment primary key,
    mobile_id int(11) unsigned not null,
    user_credit_card_id int(11) unsigned not null
) engine innodb;

drop table if exists user_bank_account;
create table user_bank_account (
    user_bank_account_id int(11) unsigned not null primary key,
    user_id int(11) unsigned not null,
    key_version tinyint(3) unsigned not null,
    last4 char(4) not null,
    description varchar(30),
    bank_type ENUM('C','S'),
    routing varchar(255),
    status tinyint(3) not null default '0',
    conf_amt decimal(10,8),
    date_added datetime,
    user_added varchar(60),
    date_changed timestamp,
    user_changed varchar(60)
) engine=innodb;
create index ix_bank_account_user_id on user_credit_card(user_id);

drop table if exists user_mobile_bank_account;

create table user_mobile_bank_account (
    user_mobile_bank_account_id int(11) unsigned not null auto_increment primary key,
    mobile_id int(11) unsigned not null,
    user_bank_account_id int(11) unsigned not null
) engine innodb;

drop table if exists authorized_device;
create table authorized_device (
    authorized_device_id int(11) unsigned not null primary key auto_increment,
    mobile_id int(11) unsigned not null,
    os_id varchar(255) not null	
) engine=innodb;

drop table if exists tos;
create table tos (
    tos_id int(11) unsigned not null auto_increment primary key,
    tos text,
    date_added datetime,
    user_added varchar(60),
    date_changed timestamp,
    user_changed varchar(60)
) engine=innodb;

drop table if exists doc_info;
create table doc_info(
  doc_info_id int unsigned not null auto_increment primary key,
  mobile_id int unsigned not null,
  doc_type tinyint unsigned not null default '1',
  current_version smallint unsigned not null default '1',
  expiration datetime not null default '2020-01-01 00:00:00',
  `number` varchar(100) not null default '',
  `description` varchar(100) not null default '', 
  user_added varchar(60),
  date_added datetime,
  user_changed varchar(60),
  date_changed timestamp
) engine=innodb;

drop table if exists promotion;
create table promotion(
  promotion_id int unsigned not null auto_increment primary key,
  promotion_code varchar(16),
  begin_date datetime,
  end_date datetime,
  user_id int unsigned,
  amount decimal(10,2),
  qty int unsigned,
  promotion_type tinyint,
  user_added varchar(60),
  date_added datetime,
  user_changed varchar(60),
  date_changed timestamp
) engine=innodb;

DELIMITER $$

CREATE PROCEDURE `sp_zip_get`(
    IN p_zip varchar(5),
    OUT p_city varchar(50),
    OUT p_state char(2)
)
BEGIN
  select city into p_city from zip_codes where zip=p_zip;
  select state into p_state from zip_codes where zip=p_zip;
END$$

drop procedure if exists `sp_create_tos`;
CREATE PROCEDURE `sp_create_tos`(
    IN p_username varchar(60),
    IN p_tos text
)
BEGIN
    INSERT INTO tos (`tos`,`date_added`,`user_added`,`user_changed`) values (p_tos,now(),p_username,p_username);
END$$

drop procedure if exists `sp_create_document`;
CREATE PROCEDURE `sp_create_document` (
  IN p_mobile_id int unsigned,
  IN p_doc_type tinyint unsigned,
  IN p_current_version smallint unsigned,
  IN p_expiration datetime,
  IN p_description varchar(100),
  IN p_number varchar(100),
  IN p_user_added varchar(60),
  OUT p_res int unsigned
)
BEGIN
  INSERT INTO doc_info (mobile_id,doc_type,current_version,expiration,date_added,user_added,date_changed,user_changed,description,`number`) 
                values (p_mobile_id,p_doc_type,p_current_version,p_expiration,now(),p_user_added,now(),p_user_added,p_description,p_number);
  set p_res = last_insert_id();
END$$

drop procedure if exists `sp_create_message`;
CREATE PROCEDURE `sp_create_message`(
    IN p_message text,
    IN p_subject varchar(255),
    IN p_status tinyint unsigned,
    IN p_message_type tinyint unsigned,
    OUT p_res int unsigned
)
BEGIN
    INSERT INTO message (`message`,`subject`,`status`,`message_type`) values (p_message,p_subject,p_status,p_message_type);
    set p_res = last_insert_id();
END$$

drop procedure if exists `sp_send_message`;
CREATE PROCEDURE `sp_send_message`(
    IN p_message_id int unsigned,
    IN p_mobile_id int unsigned
)
BEGIN
    INSERT INTO user_mobile_message (message_id,mobile_id) values (p_message_id,p_mobile_id);
END$$

drop procedure if exists `sp_mobile_set_message_flag`;
CREATE PROCEDURE `sp_mobile_set_message_flag`(
    IN p_mobile_id int unsigned
)
BEGIN
    UPDATE user_mobile set has_message = '1' where mobile_id = p_mobile_id;
END$$

drop procedure if exists `sp_mobile_unset_message_flag`;
CREATE PROCEDURE `sp_mobile_unset_message_flag`(
    IN p_mobile_id int unsigned
)
BEGIN
    UPDATE user_mobile set has_message = has_message-1 where mobile_id = p_mobile_id;
END$$

drop procedure if exists `sp_mobile_set_new_txn_flag`;
CREATE PROCEDURE `sp_mobile_set_new_txn_flag`(
    IN p_mobile_id int unsigned
)
BEGIN
    UPDATE user_mobile set has_txn = '1' where mobile_id = p_mobile_id;
END$$

drop procedure if exists `sp_set_message_viewed`;
CREATE PROCEDURE `sp_set_message_viewed`(
    IN p_message_id int unsigned
)
BEGIN
    UPDATE user_mobile_message set status = '1' where user_mobile_message_id = p_message_id;
END$$

DELIMITER ;

drop view if exists view_current_tos;
CREATE VIEW view_current_tos AS
select tos_id,tos from tos order by tos_id desc limit 1;

drop view if exists view_my_documents;
CREATE VIEW view_my_documents AS
select doc_info_id,mobile_id,doc_type,current_version,expiration,description,`number` from doc_info;

drop view if exists view_get_messages;
CREATE VIEW view_get_messages AS
select m.message as message,m.subject as subject,m.message_type as message_type,um.status as status,um.mobile_id as mobile_id, um.user_mobile_message_id as id from message as m,user_mobile_message as um where m.message_id=um.message_id limit 20;

