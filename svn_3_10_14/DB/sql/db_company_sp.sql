 
DELIMITER $$

CREATE PROCEDURE `sp_company_create`(
    IN p_company_type smallint unsigned,
    IN p_company_sub_type smallint unsigned,
    IN p_name varchar(100),
    IN p_email varchar(100),
    IN p_password char(32).
    IN p_confirmation_code varchar(10)
)

BEGIN
    INSERT INTO company (`company_type`,`company_sub_type`,`name`,`email`,`password`,`confirmation_code`) values (p_company_type,p_company_sub_type,p_name,p_email,p_password,p_confirmation_code);
END$$

CREATE PROCEDURE `sp_pos_create` (
    IN p_company_id int(11) unsigned,
    IN p_os_id varchar(100),
    IN p_name varchar(30)
)
BEGIN
    INSERT INTO company (`company_id`,`os_id`,`name`) values (p_company_id,p_os_id,p_name);
END$$

CREATE PROCEDURE `sp_company_confirm` (
    IN p_company_id int(11) unsigned,
    IN p_confirmation_code varchar(10),
    OUT p_res smallint   
)
BEGIN
    SELECT count(*) into p_res from company where `company_id`=p_company_id and `confirmation_code`=p_confirmation_code;

    if (p_res = '1')
    then
      UPDATE company set status = '1' where `company_id`=p_company_id
    end if;
END$$

CREATE PROCEDURE `sp_auth_company` (
    IN company_id int(11) unsigned,
    IN password char(32),
    OUT boolean
)
BEGIN
    SELECT count(*) from company 
END$$

CREATE PROCEDURE `sp_auth_company_merchant` (

)
BEGIN

END$$

CREATE PROCEDURE `sp_add_pos` (

)
BEGIN

END$$

CREATE PROCEDURE `sp_authorize_user` (

)
BEGIN

END$$

CREATE PROCEDURE `sp_company_id_from_email`(
    IN p_email varchar(30),
    OUT p_company_id int(11) unsigned
)
BEGIN
    SELECT company_id into p_company_id from company where `email` = p_email and `status` = '1';
END$$