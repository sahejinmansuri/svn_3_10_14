drop table if exists txn_limit;

create table txn_limit ( 
    `txn_limit_id` int(11) unsigned not null auto_increment primary key,
    `type` tinyint unsigned,
    `time_span` smallint unsigned,
    `limit`  decimal(10,2),
    `order` tinyint,
    `owner_id` int(11) unsigned not null
);

DELIMITER $$


-- 1: 
drop procedure if exists sp_create_limit;
CREATE PROCEDURE sp_create_limit (
    IN p_type tinyint unsigned,
    IN p_time_span smallint unsigned,
    IN p_limit decimal(10,2),
    IN p_order tinyint unsigned,
    IN p_owner_id int(11) unsigned
)
BEGIN
    INSERT INTO txn_limit (`type`,`time_span`,`limit`,`order`,`owner`) values (p_type,p_time_span,p_limit);
END$$

drop view if exists view_limit;
CREATE PROCEDURE view_limit AS
select * from txn_limit;
