drop database if exists wigi_safe;

create database wigi_safe;

use wigi_safe;

drop table if exists user_credit_card;
create table user_credit_card (
    user_credit_card_id int(11) unsigned not null auto_increment primary key,
    user_id int(11) unsigned not null,
    credit_card text not null, -- encrypted
    key_version tinyint(3) unsigned not null,
    date_added datetime,
    user_added text,
    date_changed timestamp,
    user_changed text
) engine=innodb;
-- create index ix_credit_card_user_id on user_credit_card(user_id);

drop table if exists user_bank_account;
-- checking_account_type : 1: current 2: savings
create table user_bank_account (
    user_bank_account_id int(11) unsigned not null auto_increment primary key,
    user_id int(11) unsigned not null,
    bank_account varchar(1024) not null,
    key_version tinyint(3) unsigned not null,
    date_added datetime,
    user_added varchar(60),
    date_changed timestamp,
    user_changed varchar(60)
) engine=innodb;
create index ix_bank_account_user_id on user_bank_account(user_id);


drop table if exists doc_data;
create table doc_data(
  doc_data_id int unsigned not null auto_increment primary key,
  doc_info_id int unsigned,
  version smallint unsigned,
  key_version tinyint unsigned,
  doc_data blob
) engine=innodb;

DELIMITER $$

CREATE PROCEDURE `sp_cc_create`(
    IN p_user_id int(11) unsigned,
    IN p_credit_card text,
    IN p_key_version tinyint(3) unsigned,
    IN p_user_added text,
    OUT p_res int(11)
)
BEGIN

    INSERT INTO user_credit_card (
      `user_id`,
      `credit_card`,
      `key_version`,
      `date_added`,
      `user_added`,
      `date_changed`,
      `user_changed`
    ) values (
      p_user_id,
      p_credit_card,
      p_key_version,
      now(),
      p_user_added,
      now(),
      p_user_added
    );

    set p_res = last_insert_id();

END$$

CREATE PROCEDURE `sp_cc_get`(
    IN p_user_credit_card_id int(11),
    OUT p_user_id int(11) unsigned,
    OUT p_credit_card text,
    OUT p_key_version tinyint(3) unsigned
)
BEGIN
    select     `user_id`,
               `credit_card`,
               `key_version`

    into 
               p_user_id,
               p_credit_card,
               p_key_version

     from user_credit_card where user_credit_card_id = p_user_credit_card_id;
END$$


CREATE PROCEDURE `sp_ba_create`(
    IN p_user_id int(11) unsigned,
    IN p_bank_account text,
    IN p_key_version tinyint(3) unsigned,
    IN p_user_added text,
    OUT p_res int(11)
)
BEGIN

    INSERT INTO user_bank_account (
      `user_id`,
      `bank_account`,
      `key_version`,
      `date_added`,
      `user_added`,
      `date_changed`,
      `user_changed`
    ) values (
      p_user_id,
      p_bank_account,
      p_key_version,
      now(),
      p_user_added,
      now(),
      p_user_added
    );

    set p_res = last_insert_id();

END$$

CREATE PROCEDURE `sp_ba_get`(
    IN p_user_bank_account_id int(11),
    OUT p_user_id int(11) unsigned,
    OUT p_bank_account text,
    OUT p_key_version tinyint(3) unsigned
)
BEGIN
    select     `user_id`,
               `bank_account`,
               `key_version`

    into 
               p_user_id,
               p_bank_account,
               p_key_version

     from user_bank_account where user_bank_account_id = p_user_bank_account_id;
END$$

drop procedure if exists `sp_create_document`;
CREATE PROCEDURE `sp_create_document`(
  IN p_doc_info_id int unsigned,
  IN p_version smallint unsigned,
  IN p_key_version tinyint unsigned,
  IN p_doc_data blob
)
BEGIN
  INSERT INTO doc_data (`doc_info_id`,`version`,`doc_data`,`key_version`) VALUES (p_doc_info_id,p_version,p_doc_data,p_key_version);
END$$

drop procedure if exists `sp_doc_get`;
CREATE PROCEDURE `sp_doc_get`(
    IN p_doc_id int(11) unsigned,
    OUT p_key_version tinyint unsigned,
    OUT p_doc_data blob
)
BEGIN
    select
               `doc_data`,`key_version`
    into 
               p_doc_data,p_key_version
     from doc_data where doc_info_id = p_doc_id;
END$$
    
DELIMITER ;
