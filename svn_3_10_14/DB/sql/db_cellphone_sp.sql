DELIMITER $$
 
CREATE PROCEDURE `sp_user_add_mobile`(
    IN p_user_id int(11) unsigned,
    IN p_mobile_type mediumint(6) unsigned,
    IN p_cellphone varchar(30),
    IN p_pin char(32),
    IN p_date_added datetime,
    IN p_user_added varchar(60),
    IN p_date_changed timestamp,
    IN p_user_changed varchar(60),
    OUT p_id int(11) unsigned

)
BEGIN

    call sp_get_confirmation_code(@code);

    INSERT INTO `user_mobile`(
        `user_id`,
        `mobile_type`,
        `cellphone`,
        `pin`,
        `mobile_confirmation_code`,
        `date_added`,
        `user_added`,
        `date_changed`,
        `user_changed`
    ) VALUES (
        p_user_id,
        p_mobile_type,
        p_cellphone,
        p_pin,
        @code,
        p_date_added,
        p_user_added,
        p_date_changed,
        p_user_changed
    );
    
    set p_id = @code;

END$$

drop procedure if exists `sp_get_mobile_id_from_cellphone`;
CREATE PROCEDURE `sp_get_mobile_id_from_cellphone`(
    IN p_cellphone varchar(30),
    IN p_country_code varchar(30),
    OUT p_mobile_id int(11) unsigned
)
BEGIN
    -- select mobile_id into p_mobile_id from user_mobile where `cellphone` = p_cellphone and status <= '1'; -- confirmed and not confirmed, but not deleted
    select mobile_id into p_mobile_id from user_mobile as um, user as u where um.`cellphone` = p_cellphone and u.`country_code` = p_country_code and u.user_id = um.user_id;
END$$

CREATE PROCEDURE `sp_get_user_id_from_mobile_id`(
    IN p_mobile_id int(11) unsigned,
    OUT p_user_id int(11) unsigned
)
BEGIN
    select user_id into p_user_id from user_mobile where `mobile_id` = p_mobile_id;
END$$

CREATE PROCEDURE `sp_mobile_set_os_id`(
    IN p_mobile_id int(11) unsigned,
    IN p_os_id varchar(255)
)
BEGIN
    update user_mobile set `os_id` = p_os_id where `mobile_id` = p_mobile_id;
END$$

CREATE PROCEDURE `sp_os_id_is_set`(
    IN p_mobile_id int(11) unsigned,
    OUT res boolean
)
BEGIN
    select count(*) into res from user_mobile where os_id is not null and `mobile_id` = p_mobile_id;
END$$

CREATE PROCEDURE `sp_user_cellphone_is_confirmed` (
    IN p_mobile_id int(11) unsigned,
    OUT res boolean
)
BEGIN
    select count(*) into res from user_mobile where `mobile_id` = p_mobile_id and status = '1';
END$$

CREATE PROCEDURE `sp_user_confirm_cellphone`(
        IN p_mobile_id int(11) unsigned,
        IN p_code varchar(10),
        OUT p_result tinyint(1) unsigned
)
BEGIN

  declare c smallint(1);
  declare p_user_id int(11) unsigned;
 
  select count(*) into p_result from user_mobile where `mobile_confirmation_code` = p_code and `mobile_id` = p_mobile_id;
  
  if (p_result = 1) then
  
      select user_id into p_user_id from user_mobile where `mobile_id` = p_mobile_id;

      update user_mobile set `status` = '1' where `mobile_id` = p_mobile_id;
      update user set cellphone_confirmed = true where `user_id` = p_user_id;

      select email_confirmed into c from user where `user_id` = p_user_id;

      if (c = 1) then
          update user set `status` = 1 where `user_id` = p_user_id;
      end if;

   end if;

END$$


CREATE PROCEDURE `sp_mobile_id_exists`(
    IN p_mobile_id int(11) unsigned,
    OUT p_res boolean
)
BEGIN
    select count(*) into p_res from user_mobile where `mobile_id` = p_mobile_id;
END$$

CREATE PROCEDURE `sp_reduce_temp_balance`(
    IN p_mobile_id int(11) unsigned,
    IN p_amount decimal(10,2),
    OUT p_res boolean
)
BEGIN

    declare newbalance decimal(10,2);

    -- if there's enough to actually reduce it by
    select (temp_balance - p_amount) into newbalance from user_mobile where `mobile_id` = p_mobile_id;

    if (newbalance >= 0) then
      update user_mobile set `temp_balance` = newbalance where `mobile_id` = p_mobile_id;
      set @p_res = true;
    else
      set @p_res = false;
    end if;
    


END$$

CREATE PROCEDURE `sp_reduce_balance`(
    IN p_mobile_id int(11) unsigned,
    IN p_amount decimal(10,2),
    OUT p_res boolean
)
BEGIN

    declare newbalance decimal(10,2);

    -- if there's enough to actually reduce it by
    select (balance - p_amount) into newbalance from user_mobile where `mobile_id` = p_mobile_id;

    if (newbalance >= 0) then
      update user_mobile set `balance` = newbalance where `mobile_id` = p_mobile_id;
      set @p_res = true;
    else
      set @p_res = false;
    end if;



END$$

CREATE PROCEDURE `sp_increase_balance`(
    IN p_mobile_id int(11) unsigned,
    IN p_amount decimal(10,2),
    OUT p_res boolean
)
BEGIN

    declare new_tempbalance decimal(10,2);
    declare new_balance decimal(10,2);

    select (balance + p_amount)      into new_balance from user_mobile where `mobile_id` = p_mobile_id;
    select (temp_balance + p_amount) into new_tempbalance from user_mobile where `mobile_id` = p_mobile_id;

    -- increase temp_balance
    update user_mobile set `temp_balance` = new_tempbalance where `mobile_id` = p_mobile_id;
    -- increase balance
    update user_mobile set `balance` = new_balance where `mobile_id` = p_mobile_id;

    set @p_res = true;

END$$

CREATE PROCEDURE `sp_increase_temp_balance`(
    IN p_mobile_id int(11) unsigned,
    IN p_amount decimal(10,2),
    OUT p_res boolean
)
BEGIN

    declare new_tempbalance decimal(10,2);

    select (temp_balance + p_amount) into new_tempbalance from user_mobile where `mobile_id` = p_mobile_id;

    -- increase temp_balance
    update user_mobile set `temp_balance` = new_tempbalance where `mobile_id` = p_mobile_id;

    set @p_res = true;

END$$

CREATE PROCEDURE `sp_user_set_default_cellphone` (
    IN p_mobile_id int(11) unsigned
)
BEGIN

    declare p_user_id int(11) unsigned;

    select user_id into p_user_id from user_mobile where `mobile_id` = p_mobile_id;

    -- set all cellphones for that user to false
    update user_mobile set is_default = '0' where `user_id` = p_user_id;
    -- set that one cellphone for that usre to true
    update user_mobile set is_default = '1' where `user_id` = p_user_id and `mobile_id` = p_mobile_id;
    	
END$$

CREATE PROCEDURE `sp_reset_pin` (
  IN p_mobile_id int(11) unsigned,
  IN p_pin char(32)
)
BEGIN
  update user_mobile set pin = p_pin where mobile_id = p_mobile_id;
END$$


CREATE PROCEDURE `sp_mobile_id_from_os_id` (
  IN p_os_id varchar(255),
  OUT p_mobile_id int(11) unsigned
)
BEGIN
  select `mobile_id` into p_mobile_id from user_mobile where `os_id`=p_os_id;
END$$

CREATE PROCEDURE `sp_user_id_from_os_id` (
  IN p_os_id varchar(255),
  OUT p_user_id int(11) unsigned
)
BEGIN
  select `user_id` into p_user_id from user_mobile where `os_id` = p_os_id;
END$$

drop procedure if exists sp_set_mobile_ext;
CREATE PROCEDURE `sp_set_mobile_ext`(
    IN p_key varchar(100),
    IN p_val varchar(100),
    IN p_category tinyint(3),
    IN p_mobile_id int(11) unsigned
)
BEGIN
    declare p_exists boolean;

    select count(*) into p_exists from user_mobile_ext where `key` = p_key and `mobile_id` = p_mobile_id and `category` = p_category;

    if (p_exists = 1) then
      update user_mobile_ext set `val` = p_val where `key` = p_key and `mobile_id` = p_mobile_id and `category` = p_category;
    else
      insert into user_mobile_ext (`key`,`val`,`category`,`mobile_id`) values (p_key,p_val,p_category,p_mobile_id);
    end if;
END$$

drop procedure if exists sp_get_mobile_ext;
CREATE PROCEDURE `sp_get_mobile_ext`(
    IN p_key varchar(100),
    IN p_category tinyint(3),
    IN p_mobile_id int(11) unsigned,
    OUT p_val varchar(100)
)
BEGIN
    SELECT `val` into p_val from user_mobile_ext where `mobile_id` = p_mobile_id and `category` = p_category and `key` = p_key;
END$$
