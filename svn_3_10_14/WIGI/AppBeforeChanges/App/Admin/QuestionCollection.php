<?php

/**
 * QuestionCollection holds questions for 501c approval
 *
 * @author nhenehan
 */
class App_Admin_QuestionCollection {

    public static $phoneQuestion = "Do they have a valid business phone?";
    public static $bbbQuestion = "Does Better Business bureau like this company?";
    public static $irsQuestion = "Does the IRS inquery check out cleanly?";
    public static $clearinghouseQuestion = "Does the Clearing House inquery check out cleanly?";
    public static $addressQuestion = "Does the postal address inquery check out cleanly?";
    public static $stateregQuestion = "Does state registration exist and show as active?";
    public static $urlQuestion = "Is their URL valid?";
    public static $sslQuestion = "Is the SSL certificate valid?";
    public static $fed501cQuestion = "Is there a valid 501c registration?";
    public static $fedFEINQuestion = "Is FEIN valid?";

    public static function getAllAsArray() {
        $questions = array();
        $questions['is_phone_verified'] = App_Admin_QuestionCollection::$phoneQuestion;
        $questions['is_bbb_verified'] = App_Admin_QuestionCollection::$bbbQuestion;
        $questions['is_irs_verified'] = App_Admin_QuestionCollection::$irsQuestion;
        $questions['is_clearinghouse_verified'] = App_Admin_QuestionCollection::$clearinghouseQuestion;
        $questions['is_address_verified'] = App_Admin_QuestionCollection::$addressQuestion;
        $questions['is_statereg_verified'] = App_Admin_QuestionCollection::$stateregQuestion;
        $questions['is_url_verified'] = App_Admin_QuestionCollection::$urlQuestion;
        $questions['is_ssl_verified'] = App_Admin_QuestionCollection::$sslQuestion;
        $questions['is_fed501c_verified'] = App_Admin_QuestionCollection::$fed501cQuestion;
        $questions['is_fedfein_verified'] = App_Admin_QuestionCollection::$fedFEINQuestion;

        return $questions;
    }

}

?>
