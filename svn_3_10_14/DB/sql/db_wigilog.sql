drop database if exists wigi_log;
create database wigi_log;

use wigi_log;

CREATE TABLE `wigi_code` (
  `wigi_code_id` char(20) NOT NULL,
  `from_mobile_id` int(11) unsigned NOT NULL,
  `to_mobile_id` int(11) unsigned,
  `amount` decimal(10,2) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL default 0,
  `date_expires` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `date_redeemed` datetime,
  `from_ip_address` char(20) NOT NULL default '0',
  `to_ip_address` char(20) NOT NULL default '0',
  `viewed` tinyint(3) NOT NULL default '0',
  PRIMARY KEY (`wigi_code_id`),
  KEY `uix_from_mobile_id` (`from_mobile_id`,`date_added`),
  KEY `uix_to_mobile_id` (`to_mobile_id`,`date_added`)
);

CREATE TABLE `transaction`(
  `transaction_id` int(11) unsigned NOT NULL auto_increment,
  `type` smallint unsigned NOT NULL,
  `direction` ENUM('CREDIT','DEBIT','INFO') NOT NULL,
  `amount` decimal(10,2),
  `from` int(11) unsigned,
  `from_description` varchar(100),
  `to` int(11) unsigned,
  `to_description` varchar(100),
  `description` varchar(255),
  `viewed` tinyint(3) NOT NULL default '0',
  `stamp` datetime NOT NULL,
  PRIMARY KEY (`transaction_id`)
);

DELIMITER $$

-- log transactions
CREATE PROCEDURE `sp_log_transaction`(
  p_type smallint unsigned,
  p_direction char(10),
  p_amount decimal(10,2),
  p_from int(11) unsigned, 
  p_to int(11) unsigned,
  p_from_description varchar(100),
  p_to_description varchar(100),
  p_description varchar(255)
)
BEGIN
  INSERT INTO transaction (`type`,`direction`,`amount`,`from`,`to`,`description`,`stamp`,`from_description`,`to_description`) values 
                          (p_type,p_direction,p_amount,p_from,p_to,p_description,now(),p_from_description,p_to_description);
END$$

-- wigicode exists
CREATE PROCEDURE `sp_wigi_exists`(
    IN p_code char(20),
    OUT p_res boolean
)
BEGIN
    select count(*) into p_res from wigi_code where `wigi_code_id` = p_code;
END$$


-- create wigicode
drop procedure if exists `sp_wigi_create`;
CREATE PROCEDURE `sp_wigi_create`(
    IN p_mobile_id int(11) unsigned,
    IN p_amount decimal(10,2),
    IN p_code char(20),
    IN p_expires datetime,
    OUT p_date_added datetime,
    OUT p_date_expires datetime
)
BEGIN

    -- make sure the code isn't already in the database

    INSERT INTO `wigi_code`(
        `wigi_code_id`,
        `amount`,
        `from_mobile_id`,
        `date_expires`,
        `date_added`
    ) VALUES (
        p_code,
        p_amount,
        p_mobile_id,
        p_expires,
        now()
    );

    select date_expires into p_date_expires from wigi_code where wigi_code_id = p_code;
    select date_added into p_date_added from wigi_code where wigi_code_id = p_code;

END$$

-- has been redeemed
CREATE PROCEDURE `sp_is_redeemed`(
    IN p_code char(20),
    OUT res boolean
)
BEGIN
    select count(*) into res from wigi_code where `wigi_code_id` = p_code and `status` = '1';
END$$

-- has been redeemed
CREATE PROCEDURE `sp_is_expired`(
    IN p_code char(20),
    OUT res boolean
)
BEGIN
    select count(*) into res from wigi_code where `wigi_code_id` = p_code and `status` = '0' and (date_expires < now());
END$$




-- redeem wigicode
CREATE PROCEDURE `sp_wigi_redeem`(
    IN p_code char(20),
    IN p_mobile_id int(11) unsigned
)
BEGIN

    -- make sure it's not already redeemed

    UPDATE wigi_code SET `to_mobile_id` = p_mobile_id, `status` = '1', `date_redeemed` = now() where `wigi_code_id` = p_code;

END$$

-- force expire
CREATE PROCEDURE `sp_wigi_expire`(
    IN p_code char(20)
)
BEGIN
    UPDATE wigi_code SET `status` = '2' where `wigi_code_id` = p_code and status= '0' and date_expires < now();
END$$

-- delete
CREATE PROCEDURE `sp_wigi_delete`(
    IN p_code char(20)
)
BEGIN
    UPDATE wigi_code SET `status` = '3' where `wigi_code_id` = p_code and status = '0';
END$$

-- get value
CREATE PROCEDURE `sp_wigi_get_amount`(
    IN p_code char(20),
    OUT p_amount decimal(10,2)
)
BEGIN
    SELECT amount into p_amount from wigi_code where wigi_code_id = p_code and status = '0'; 
END$$

--get amount history
drop procedure if exists `sp_get_last_day_amt`;
CREATE PROCEDURE `sp_get_last_day_amt`(
    IN p_mobile_id int(11) unsigned,
    IN p_type int(11) unsigned,
    OUT p_res decimal(10,2)
)
BEGIN
    select count(*) into p_res from transaction where `type` = p_type and `from` = p_mobile_id and stamp >= DATE_SUB(now(),INTERVAL 24 hour);
END$$

-- reduce value
CREATE PROCEDURE `sp_wigi_reduce_amount`(
    IN p_code char(20),
    IN p_amount decimal(10,2)
)
BEGIN
    UPDATE wigi_code set amount = p_amount where wigi_code_id = p_code and status = '0'; 
END$$

-- set that transactoin has been viewed
CREATE PROCEDURE `sp_set_transaction_viewed`(
    IN p_transaction_id int(11) unsigned
)
BEGIN
    update transaction set viewed = '1' where transaction_id = p_transaction_id;
END$$

drop view if exists view_transaction;
CREATE VIEW view_transaction AS
SELECT * from transaction;

