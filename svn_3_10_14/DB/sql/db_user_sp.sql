 
DELIMITER $$

/*
Generates a random 6 digit confirmation code
*/

CREATE PROCEDURE `sp_get_confirmation_code`(
    OUT p_code varchar(10)
)
BEGIN
    select FLOOR(100000 + (RAND() * 888888)) into p_code;
END$$

/*
Create a new user. User must then go through confirmation process
*/
drop procedure if exists `sp_user_create`;
CREATE PROCEDURE `sp_user_create`(
        IN p_email varCHAR(100),
        IN p_user_type varCHAR(100),
        IN p_password char(32),
        IN p_status varCHAR(100),
        IN p_first_name varCHAR(100),
        IN p_last_name varCHAR(100),
        IN p_middle_init varCHAR(3),
        IN p_country_code varchar(10),
        IN p_birthdate date,
        IN p_date_added datetime,
        IN p_user_added varCHAR(60),
        IN p_user_changed varCHAR(60),
        IN p_nationality varCHAR(20),
        IN p_gender varCHAR(10),
        IN p_marital_status varCHAR(10),
        IN p_spouse_name varCHAR(20),
        IN p_occupation varCHAR(30),
        IN p_annual_income varCHAR(30),
        IN p_resident varCHAR(30),
        IN p_pan_no varCHAR(30),
        IN p_aadhar_id varCHAR(30),
        IN p_submitted_id_proof varCHAR(30),
        OUT p_user_id INTEGER(11) unsigned,
        OUT p_email_code varchar(10)
    )

BEGIN
    call sp_get_confirmation_code(@code);
    INSERT INTO `user`(
        `email`,
        `user_type`,
        `password`,
        `status`,
        `first_name`,
        `last_name`,
        `middle_init`,
        `email_confirmation_code`,
        `country_code`,
        `birthdate`,
        `date_added`,
        `user_added`,
        `user_changed`,
		`nationality`,
		`gender`,
		`marital_status`,
		`spouse_name`,
		`occupation`,
		`annual_income`,
		`resident`,
		`pan_no`,
		`aadhar_id`,
		`submitted_id_proof`
		) 
	VALUE (
        p_email,
        p_user_type,
        p_password,
        p_status,
        p_first_name,
        p_last_name,
        p_middle_init,
        @code,
        p_country_code,
        p_birthdate,
        p_date_added,
        p_user_added,
        p_user_changed,
		p_nationality,
		p_gender,
		p_marital_status,
		p_spouse_name,
		p_occupation,
		p_annual_income,
		p_resident,
		p_pan_no,
		p_aadhar_id,
		p_submitted_id_proof
	);
	
       set p_user_id = last_insert_id();
       select @code into p_email_code;

END$$

drop procedure if exists `sp_merchant_create`;
CREATE PROCEDURE `sp_merchant_create`(
        IN p_email varCHAR(100),
        IN p_user_type TINYINT(3),
        IN p_password char(32),
        IN p_status tinYINT(3),
        IN p_first_name varCHAR(100),
        IN p_last_name varCHAR(100),
        IN p_middle_init varCHAR(3),
        IN p_question varchar(255),
        IN p_answer varchar(255),
        IN p_country_code varchar(10),
        IN p_business_type tinyint unsigned,
        IN p_business_name varchar(100),
        IN p_business_tax_id varchar(50),
        IN p_business_phone varchar(50),
        IN p_date_added datetime,
        IN p_user_added varCHAR(60),
        IN p_user_changed varCHAR(60),
        OUT p_user_id INTEGER(11) unsigned,
        OUT p_email_code varchar(10)
    )

BEGIN
    call sp_get_confirmation_code(@code);
    INSERT INTO `user`(
        `email`,
        `user_type`,
        `password`,
        `status`,
        `first_name`,
        `last_name`,
        `middle_init`,
        `email_confirmation_code`,
        `question`,
        `answer`,
        `country_code`,
        `business_type`,
        `business_name`,
        `business_tax_id`,
        `business_phone`,
        `date_added`,
        `user_added`,
        `user_changed`
                ) 
        VALUE (
        p_email,
        p_user_type,
        p_password,
        p_status,
        p_first_name,
        p_last_name,
        p_middle_init,
        @code,
        p_question,
        p_answer,
        p_country_code,
        p_business_type,
        p_business_name,
        p_business_tax_id,
        p_business_phone,
        p_date_added,
        p_user_added,
        p_user_changed

        );

       set p_user_id = last_insert_id();
       select @code into p_email_code;

END$$


/*
Update basic user info
*/
CREATE PROCEDURE `sp_user_update`(
        IN p_user_id int(11) unsigned,
        IN p_first_name varCHAR(100),
        IN p_last_name varCHAR(100),
        IN p_middle_init varCHAR(3)
    )

BEGIN

    UPDATE user SET `first_name` = p_first_name, `middle_init` = p_middle_init, `last_name` = p_last_name where `user_id` = p_user_id;

END$$

/*
Confirm email address.
If there's a cellphone confirmed already, confirm the whole account
Else just confirm the email
*/
CREATE PROCEDURE `sp_user_confirm_email`(
        IN p_user_id int(11) unsigned,
        IN p_code varchar(10),
        OUT p_result tinyint(1) unsigned
)
BEGIN

    declare c smallint(1);

    select count(*) into p_result from user where `user_id` = p_user_id and `email_confirmation_code` = p_code;

    if (p_result = 1) then

        update user set `email_confirmed` = true where `user_id` = p_user_id;
  
        select cellphone_confirmed into c from user where `user_id` = p_user_id;

        if (c = 1) then
            update user set `status` = 1 where `user_id` = p_user_id;
        end if;
     
     end if;

END$$

/*
0 - User ID doesn't exist
1 - User ID exists
*/
CREATE PROCEDURE `sp_user_id_exists`(
    IN p_user_id int(11) unsigned,
    OUT p_res boolean
)
BEGIN
    select count(*) into p_res from user where `user_id` = p_user_id;
END$$

/*
Input - Email
Output - User ID
*/
CREATE PROCEDURE `sp_user_get_id`(
    IN  p_email varchar(100),
    OUT p_user_id int(11) unsigned
    )
BEGIN
  declare exist smallint;

  select count(*) into @exist from user where email=p_email;

  if (@exist > 0) then
    select user_id into p_user_id from user where email=p_email;
  else
    set @p_user_id = 0;
  end if;


END$$

/*
Input - Email
Output -
  0 - User doesn't exist
  1 - User exists
*/

CREATE PROCEDURE `sp_user_exists`(
        IN p_email varCHAR(100),
        OUT p_user_exists smallint
    )

BEGIN

  select count(*) into p_user_exists from user where email=p_email;

END$$

/*
Get the number of cellphones associated with the user
*/

CREATE PROCEDURE `sp_user_no_cellphones` (
    IN p_user_id int(11) unsigned,
    OUT p_count int unsigned
)
BEGIN
    select count(*) into p_count from user_mobile where `user_id` = p_user_id;
END$$

/*
Remove cellphone
*/
CREATE PROCEDURE `sp_user_cellphone_remove`(
    IN p_user_id int(11) unsigned,
    IN p_mobile_id varchar(30)
)
BEGIN
    delete from user_mobile where `user_id` = p_user_id and `mobile_id` = p_mobile_id limit 1;
END$$

/*
Get the ID of the default cellphone
*/
CREATE PROCEDURE `sp_user_get_default_cellphone` (
    IN p_user_id int(11) unsigned,
    OUT p_mobile_id int(11)
)
BEGIN

	select `mobile_id` into p_mobile_id from user_mobile where `user_id` = p_user_id and is_default = '1';

END$$

CREATE PROCEDURE `sp_user_add_address`(
    IN p_user_id int(11) unsigned,
    IN p_address_type tinyint(3) unsigned,
    IN p_addr_line1 varchar(100),
    IN p_addr_line2 varchar(100),
    IN p_addr_line3 varchar(100),
    IN p_addr_line4 varchar(100),
    IN p_city varchar(100),
    IN p_state varchar(50),
    IN p_zip varchar(15),
    IN p_country_code char(3),
    IN p_date_added datetime,
    IN p_user_added varchar(60),
    IN p_date_changed timestamp,
    IN p_user_changed varchar(60),
    IN p_country varchar(60),
    IN p_pt_country varchar(60),
    IN p_pt_address varchar(100),
    IN p_pt_city varchar(100),
    IN p_pt_state varchar(50),
    IN p_pt_zip varchar(15),
    IN p_landline_home1 int(11) unsigned,
    IN p_landline_home2 int(11) unsigned,
    IN p_email_address varchar(30),
    IN p_address_proof varchar(30),
    OUT p_address_id int(11) unsigned
)

BEGIN
    INSERT INTO `user_address`(
          `user_id`,
          `address_type`,
          `addr_line1`,
          `addr_line2`,
          `addr_line3`,
          `addr_line4`,
          `city`,
          `state`,
          `zip`,
          `country_code`,
          `date_added`,
          `user_added`,
          `date_changed`,
          `user_changed`,
		  `country`,
		  `pt_country`,
		  `pt_address`,
		  `pt_city`,
		  `pt_state`,
		  `pt_zip`,
		  `landline_home`,
		  `landline_office`,
		  `email_address`,
		  `address_proof`

    ) values (
           p_user_id,
           p_address_type,
           p_addr_line1,
           p_addr_line2,
           p_addr_line3,
           p_addr_line4,
           p_city,
           p_state,
           p_zip,
           p_country_code,
           p_date_added,
           p_user_added,
           p_date_changed,
           p_user_changed,
		   p_country,
		   p_pt_country,
		   p_pt_address,
		   p_pt_city,
		   p_pt_state,
		   p_pt_zip,
		   p_landline_home1,
		   p_landline_home2,
		   p_email_address,
		   p_address_proof
    ); 
    set p_user_id = last_insert_id();

END$$


CREATE PROCEDURE `sp_user_add_doc`(
	IN p_key_version smallint(5) unsigned,
	In p_mobile_id int(10) unsigned,
	IN p_user_id int(10) unsigned,
    IN p_doc_type varchar(50),
    IN p_doc_description varchar(100)
)
BEGIN
    INSERT INTO `doc_info`(
			`key_version`,
			`mobile_id`,
		  `user_id`,
          `doc_type`,
          `description`
    ) values (
			p_key_version,
           p_mobile_id,
			p_user_id,
           p_doc_type,
           p_doc_description
    ); 
    set p_user_id = last_insert_id();
END$$

CREATE PROCEDURE `sp_add_credit_card`(
    IN p_user_credit_card_id int(11) unsigned,
    IN p_user_id int(11) unsigned,
    IN p_key_version tinyint(3) unsigned,
    IN p_last4 char(4),
    IN p_description varchar(30),
    IN p_card_type varchar(10),
    IN p_expire_month tinyint unsigned,
    IN p_expire_year  smallint unsigned,
    IN p_name_on_card varchar(255),
    IN p_conf_amt decimal(10,2),
    IN p_user_added varchar(60),
    OUT p_res boolean
)
BEGIN

    INSERT INTO user_credit_card (
      user_credit_card_id,
      user_id,
      key_version,
      last4,
      description,
      card_type,
      expire_month,
      expire_year,
      name_on_card,
      conf_amt,
      status,
      date_added,
      user_added,
      date_changed,
      user_changed
    ) VALUES (
      p_user_credit_card_id,
      p_user_id,
      p_key_version,
      p_last4,
      p_description,
      p_card_type,
      p_expire_month,
      p_expire_year,
      p_name_on_card,
      p_conf_amt,
      '0',
      now(),
      p_user_added,
      now(),
      p_user_added
    );

END$$

CREATE PROCEDURE `sp_link_credit_card`(
    p_mobile_id int(11) unsigned,
    p_user_credit_card_id int(11) unsigned
)
BEGIN
    insert into user_mobile_credit_card (`mobile_id`,`user_credit_card_id`) values (p_mobile_id,p_user_credit_card_id);
END$$

CREATE PROCEDURE `sp_credit_card_is_linked`(
    IN p_mobile_id int(11) unsigned,
    IN p_user_credit_card_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_mobile_credit_card where `mobile_id` = p_mobile_id and `user_credit_card_id` = p_user_credit_card_id;
END$$

CREATE PROCEDURE `sp_user_is_credit_card_owner`(
    IN p_user_id int(11) unsigned,
    IN p_user_credit_card_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_credit_card where `user_id` = p_user_id and `user_credit_card_id` = p_user_credit_card_id;
END$$


CREATE PROCEDURE `sp_add_bank_account`(
    IN p_user_bank_account_id int(11) unsigned,
    IN p_user_id int(11) unsigned,
    IN p_key_version tinyint(3) unsigned,
    IN p_last4 char(4),
    IN p_description varchar(30),
    IN p_bank_type varchar(10),
    IN p_routing varchar(30),
    IN p_conf_amt decimal(10,2),
    IN p_user_added varchar(60),
    OUT p_res boolean
)
BEGIN

    INSERT INTO user_bank_account (
      user_bank_account_id,
      user_id,
      key_version,
      last4,
      description,
      bank_type,
      routing,
      conf_amt,
      status,
      date_added,
      user_added,
      date_changed,
      user_changed
    ) VALUES (
      p_user_bank_account_id,
      p_user_id,
      p_key_version,
      p_last4,
      p_description,
      p_bank_type,
      p_routing,
      p_conf_amt,
      '0',
      now(),
      p_user_added,
      now(),
      p_user_added
    );

END$$

CREATE PROCEDURE `sp_link_bank_account`(
    p_mobile_id int(11) unsigned,
    p_user_bank_account_id int(11) unsigned
)
BEGIN
    insert into user_mobile_bank_account (`mobile_id`,`user_bank_account_id`) values (p_mobile_id,p_user_bank_account_id);
END$$

CREATE PROCEDURE `sp_bank_account_is_linked`(
    IN p_mobile_id int(11) unsigned,
    IN p_user_bank_account_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_mobile_bank_account where `mobile_id` = p_mobile_id and `user_bank_account_id` = p_user_bank_account_id;
END$$

CREATE PROCEDURE `sp_user_is_bank_account_owner`(
    IN p_user_id int(11) unsigned,
    IN p_user_bank_account_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_bank_account where `user_id` = p_user_id and `user_bank_account_id` = p_user_bank_account_id;
END$$


CREATE PROCEDURE `sp_user_is_cellphone_owner`(
    IN p_user_id int(11) unsigned,
    IN p_mobile_id int(11) unsigned,
    OUT p_res smallint unsigned
)
BEGIN
    select count(*) into p_res from user_mobile where `mobile_id` = p_mobile_id and `user_id` = p_user_id;
END$$


CREATE PROCEDURE `sp_user_address_set_default`(
    IN p_address_id INT(11) unsigned
    )
BEGIN
    declare uid INT(11) unsigned;
    SELECT user_id into uid from user_address where `user_address_id`=p_address_id;
    UPDATE user_address SET `is_default`='0' where `user_id`=uid;
    UPDATE user_address SET `is_default`='1' where `user_address_id`=p_address_id;
END$$

CREATE PROCEDURE `sp_get_user_balance`(
    IN p_user_id INT(11) unsigned,
    OUT p_res decimal(10,2)
)
BEGIN
   select sum(balance) into p_res from user_mobile where `user_id` = p_user_id group by user_id;
END$$

CREATE PROCEDURE `sp_get_user_temp_balance`(
    IN p_user_id INT(11) unsigned,
    OUT p_res decimal(10,2)
)
BEGIN
   select sum(temp_balance) into p_res from user_mobile where `user_id` = p_user_id group by user_id;
END$$

CREATE PROCEDURE `sp_confirm_credit_card`(
    IN p_id int(11) unsigned
)
BEGIN
  update user_credit_card set status = '1' where user_credit_card_id = p_id;
END$$


CREATE PROCEDURE `sp_confirm_bank_account`(
    IN p_id int(11) unsigned
)
BEGIN
  update user_bank_account set status = '1' where user_bank_account_id = p_id;
END$$

drop procedure if exists `sp_get_accepted_tos`;
CREATE PROCEDURE `sp_get_accepted_tos`(
    IN p_user_id int(11) unsigned,
    OUT p_tos_id int(11) unsigned
)
BEGIN
    select tos_id into p_tos_id from user where user_id = p_user_id;
END$$

drop procedure if exists `sp_set_accepted_tos`;
CREATE PROCEDURE `sp_set_accepted_tos`(
    IN p_user_id int(11) unsigned,
    IN p_tos_id  int(11) unsigned
)
BEGIN
    update user set `tos_id`=p_tos_id,`tos_accepted_date`=now() where `user_id` = p_user_id;
END$$

drop procedure if exists `sp_delete_unconfirmed_user`;
CREATE PROCEDURE `sp_delete_unconfirmed_user`(
    IN p_user_id int(11) unsigned
)
BEGIN
    delete from user where user_id = p_user_id;
    delete from user_mobile where user_id = p_user_id;
END$$
