 
DELIMITER $$



CREATE PROCEDURE `sp_auth1`(
    IN p_user_id int(11) unsigned,
    IN p_password char(32),
    OUT p_code varchar(10)
)
BEGIN

    declare res boolean;
    declare code varchar(10);

    select count(*) into res from user where `user_id` = p_user_id and `password` = p_password and status = '1';

    if (res = 1) then
        call sp_get_confirmation_code(@code);
        update user set `login_code` = @code,`login_code_expires` = (now() + INTERVAL 15 minute) where `user_id` = p_user_id;
        set p_code = @code;
    end if;

END$$

CREATE PROCEDURE `sp_auth2`(
    IN p_user_id int(11) unsigned,
    IN p_password char(32),
    IN p_code varchar(10),
    OUT p_res boolean
)
BEGIN

    select count(*) into p_res from user where `user_id` = p_user_id and `password` = p_password and `login_code` = p_code and (login_code_expires > now()) and status = '1';

END$$

CREATE PROCEDURE `sp_auth_mobile` (
    IN p_mobile_id int(11) unsigned,
    IN p_pin char(32),
    OUT p_res boolean
)
BEGIN
    select count(*) into p_res from user_mobile where `mobile_id` = p_mobile_id and `pin` = p_pin;
END$$


CREATE PROCEDURE `sp_user_auth`(
    IN p_user_id int(11) unsigned,
    IN p_password char(32),
    OUT p_result smallint
)
BEGIN

  select count(*) into p_result from user where user_id=p_user_id and password=p_password;

END$$

CREATE PROCEDURE `sp_mobile_auth`(
    IN p_mobile_id int(11) unsigned,
    IN p_pin char(32),
    OUT p_result smallint
)
BEGIN

  select count(*) into p_result from user_mobile where mobile_id=p_mobile_id and pin=p_pin;

END$$

CREATE PROCEDURE `sp_mobile_os_id_is_authorized` (
    IN p_mobile_id int(11) unsigned,
    IN p_os_id varchar(255),
    OUT p_result boolean
)
BEGIN
    select count(*) into p_result from authorized_device where mobile_id = p_mobile_id and os_id = p_os_id;
END$$

CREATE PROCEDURE `sp_mobile_authorize_os_id` (
    IN p_mobile_id int(11) unsigned,
    IN p_os_id varchar(255)
)
BEGIN
    insert into authorized_device (`mobile_id`,`os_id`) values (p_mobile_id,p_os_id);
END$$