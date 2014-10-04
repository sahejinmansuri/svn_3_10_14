<?php

/**
 * Approval records for non-profit entities
 *
 * @author nhenehan
 */
class App_Approval extends App_Models_Db_Wigi_Approval {

    private $approval_id;
    private $is_phone_verified;
    private $phone_comment;
    private $is_bbb_verified;
    private $bbb_comment;
    private $is_irs_verified;
    private $irs_comment;
    private $is_clearinghouse_verified;
    private $clearinghouse_comment;
    private $is_address_verified;
    private $address_comment;
    private $is_statereg_verified;
    private $statereg_comment;
    private $is_url_verified;
    private $url_comment;
    private $is_ssl_verified;
    private $ssl_comment;
    private $is_fed501c_verified;
    private $fed501c_comment;
    private $is_fedfein_verified;
    private $fedfein_verified;
    private $user_id;
    private $approved_by;
    private $approved_datetime;
    private $approved;

    public function __construct($approval_id=0) {

        parent::__construct();

        if ($approval_id > 0) {

            $this->approval_id = $approval_id;
            $result = $this->find($approval_id)->current();
            if (!$result) {
                error_log("approval_id $approval_id does not exist");
                throw new App_Exception_WsException('Approval ID does not exist');
                return false;
            }

            $this->approval_id = $result->approval_id;
            $this->is_phone_verified = $result->is_phone_verified;
            $this->phone_comment = $result->phone_comment;
            $this->is_bbb_verified = $result->is_bbb_verified;
            $this->bbb_comment = $result->bbb_comment;
            $this->is_irs_verified = $result->is_irs_verified;
            $this->irs_comment = $result->irs_comment;
            $this->is_clearinghouse_verified = $result->is_clearinghouse_verified;
            $this->clearinghouse_comment = $result->clearinghouse_comment;
            $this->is_address_verified = $result->is_address_verified;
            $this->address_comment = $result->address_comment;
            $this->is_statereg_verified = $result->is_statereg_verified;
            $this->statereg_comment = $result->statereg_comment;
            $this->is_url_verified = $result->is_url_verified;
            $this->url_comment = $result->url_comment;
            $this->is_ssl_verified = $result->is_ssl_verified;
            $this->ssl_comment = $result->ssl_comment;
            $this->is_fed501c_verified = $result->is_fed501c_verified;
            $this->fed501c_comment = $result->fed501c_comment;
            $this->is_fedfein_verified = $result->is_fedfein_verified;
            $this->fedfein_verified = $result->fedfein_verified;
            $this->user_id = $result->user_id;
            $this->approved_by = $result->approved_by;
            $this->approved_datetime = $result->approved_datetime;
            $this->approved = $result->approved;
        }
    }

    public function get_approval_id() {
        return $this->approval_id;
    }

    public function get_is_phone_verified() {
        return $this->is_phone_verified;
    }

    public function get_phone_comment() {
        return $this->phone_comment;
    }

    public function get_is_bbb_verified() {
        return $this->is_bbb_verified;
    }

    public function get_bbb_comment() {
        return $this->bbb_comment;
    }

    public function get_is_irs_verified() {
        return $this->is_irs_verified;
    }

    public function get_irs_comment() {
        return $this->irs_comment;
    }

    public function get_is_clearinghouse_verified() {
        return $this->is_clearinghouse_verified;
    }

    public function get_clearinghouse_comment() {
        return $this->clearinghouse_comment;
    }

    public function get_is_address_verified() {
        return $this->is_address_verified;
    }

    public function get_address_comment() {
        return $this->address_comment;
    }

    public function get_is_statereg_verified() {
        return $this->is_statereg_verified;
    }

    public function get_statereg_comment() {
        return $this->statereg_comment;
    }

    public function get_is_url_verified() {
        return $this->is_url_verified;
    }

    public function get_url_comment() {
        return $this->url_comment;
    }

    public function get_is_ssl_verified() {
        return $this->is_ssl_verified;
    }

    public function get_ssl_comment() {
        return $this->ssl_comment;
    }

    public function get_is_fed501c_verified() {
        return $this->is_fed501c_verified;
    }

    public function get_fed501c_comment() {
        return $this->fed501c_comment;
    }

    public function get_is_fedfein_verified() {
        return $this->is_fedfein_verified;
    }

    public function get_fedfein_verified() {
        return $this->fedfein_verified;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function get_approved_by() {
        return $this->approved_by;
    }

    public function get_approved_datetime() {
        return $this->approved_datetime;
    }

    public function get_approved() {
        return $this->approved;
    }
    
    //Setters
/**
 *
 * @param type $value 
 */
    public function set_approval_id( $value ) {
        $this->approval_id = $value;
    }

    public function set_is_phone_verified( $value ) {
        $this->is_phone_verified = $value;
    }

    public function set_phone_comment( $value ) {
        $this->phone_comment = $value;
    }

    public function set_is_bbb_verified( $value ) {
        $this->is_bbb_verified = $value;
    }

    public function set_bbb_comment( $value ) {
        $this->bbb_comment = $value;
    }

    public function set_is_irs_verified( $value ) {
        $this->is_irs_verified = $value;
    }

    public function set_irs_comment( $value ) {
        $this->irs_comment = $value;
    }

    public function set_is_clearinghouse_verified( $value ) {
        $this->is_clearinghouse_verified = $value;
    }

    public function set_clearinghouse_comment( $value ) {
        $this->clearinghouse_comment = $value;
    }

    public function set_is_address_verified( $value ) {
        $this->is_address_verified = $value;
    }

    public function set_address_comment( $value ) {
        $this->address_comment = $value;
    }

    public function set_is_statereg_verified( $value ) {
        $this->is_statereg_verified = $value;
    }

    public function set_statereg_comment( $value ) {
        $this->statereg_comment = $value;
    }

    public function set_is_url_verified( $value ) {
        $this->is_url_verified = $value;
    }

    public function set_url_comment( $value ) {
        $this->url_comment = $value;
    }

    public function set_is_ssl_verified( $value ) {
        $this->is_ssl_verified = $value;
    }

    public function set_ssl_comment( $value ) {
        $this->ssl_comment = $value;
    }

    public function set_is_fed501c_verified( $value ) {
        $this->is_fed501c_verified = $value;
    }

    public function set_fed501c_comment( $value ) {
        $this->fed501c_comment = $value;
    }

    public function set_is_fedfein_verified( $value ) {
        $this->is_fedfein_verified = $value;
    }

    public function set_fedfein_verified( $value ) {
        $this->fedfein_verified = $value;
    }

    public function set_user_id( $value ) {
        $this->user_id = $value;
    }

    public function set_approved_by( $value ) {
        $this->approved_by = $value;
    }

    public function set_approved_datetime( $value ) {
        $this->approved_datetime = $value;
    }

    public function set_approved( $value ) {
        $this->approved = $value;
    }

    public function save($id, $data) {
        //$stuff = array();
        //$stuff['approved'] = 1;
        $this->update($data,
            $this->getAdapter()->quoteInto('approval_id = ?', $id )
        );
    }
    
    public static function findAll() {
        
        $tblApproval = new App_Models_Db_Wigi_Approval();
        $approvals = array();

        $selectAll = $tblApproval->select();
        $selectAll->from($tblApproval->_name);
        $rawApprovalSet = $tblApproval->fetchAll($selectAll);
        
        $i = 0;
        foreach ( $rawApprovalSet as $row ){
            $cur_appr = new App_Approval($row);
            $approvals[$i] = $cur_appr;
            ++$i;
        }
        return $approvals;
    }
    
    
    public static function findUnapproved() {
        
        $tblApproval = new App_Models_Db_Wigi_Approval();
        $approvals = array();

        $selectAll = $tblApproval->select();
        $selectAll->from($tblApproval->_name)->where("approved = 0") ;
        $rawApprovalSet = $tblApproval->fetchAll($selectAll);
        
        $i = 0;
        foreach ( $rawApprovalSet as $row ){
            $cur_appr = new App_Approval($row);
            $approvals[$i] = $cur_appr;
            ++$i;
        }
        return $approvals;
    }
    
    public static function findByMerchant( $uid ) {
        //Zend_Debug::dump($uid);
        $tblApproval = new App_Models_Db_Wigi_Approval();
        $approvals = array();

        $selectAll = $tblApproval->select();
        $selectAll->from($tblApproval->_name)->where("user_id = ?", $uid) ;
        $rawApprovalSet = $tblApproval->fetchAll($selectAll);
        //Zend_Debug::dump($rawApprovalSet);
        $i = 0;
        foreach ( $rawApprovalSet as $row ){
            $cur_appr = new App_Approval($row['approval_id']);
            $approvals[$i] = $cur_appr;
            ++$i;
        }
        return $approvals[0];
    }

    public static function create($userid) {
            $data = array(
               'user_id'  => $userid,
            );
            $a = new App_Approval();
            return $a->insert($data);

    }

}

?>
