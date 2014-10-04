<?php
class Atlasp_Models_Db_Session extends Zend_Db_Table_Abstract 
{
    protected $_name ='sessions';
    protected $_primary = 'id';
	const ACTIVE = 1;
	const INVALID = 7;
	const INACTIVE = 9;

    public function __construct() 
    {
        $adapter = Zend_Registry::get('sess');
        parent::__construct($adapter);
    }
       
    public function createSession($l, $disable_multiple_sess)  
    {
        $m = __METHOD__ . '(): ';
        Zend_Session::regenerateId();
        $sid  = Zend_Session::getId();
        $clip = $_SERVER["REMOTE_ADDR"]; 
        $svip = $_SERVER["SERVER_ADDR"]; 
		$app = Zend_Registry::get('name');

		if($disable_multiple_sess == 1)
		{
		    $this->invalidatePrevSessions($l);
		}

        try {
            $this->insert(array('id'=> $sid, 'client_ip' => $clip, 'server_ip' => $svip, 'login_id' => $l,  'status'=>self::ACTIVE )); 
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            Zend_Registry::get('log')->err($m . "Exception thrown: {$errorMsg}.");
        } 
    }

    public function regenerateSessionId($l)
    {
        $m = __METHOD__ . '(): ';
        $sid = Zend_Session::getId();
        $row = array();

        try {
            $rowset = $this->find($sid);
            $row = $rowset->current();

            Zend_Session::regenerateId();
            $newId = Zend_Session::getId();
            
            Zend_Registry::get('log')->debug($m . "New session id ({$newId}).");

            $where = "id = '{$sid}'";
            $params = array(
                'id'          => $newId ,
                'session_data'   => $row->session_data,
                'client_ip' => $row->client_ip,
                'server_ip' => $row->server_ip,
                'login_id'     => $row->loginid,
            );

            try { 
                $rowsAffected = $this->update($params, $where);

                if ($rowsAffected > 0) {
                    Zend_Registry::get('log')->debug($m . "Successfully regenerated session id and updated session table.");
                } else {
                    Zend_Registry::get('log')->debug($m . 'Failed to regenerate session id, update failed.');
                    $this->createSession($l);
                } 
            } catch(Excpetion $e) {
                $errorMsg = $e->getMessage();
                Zend_Registry::get('log')->debug($m . "Update failed. Exception thrown: {$errorMsg}");
                $this->createSession($l);
            }
            
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            Zend_Registry::get('log')->debug($m . "Could not retrieve old session information. Exception thrown: {$errorMsg}");
            $this->createSession($l);
        }   
    }


    public function invalidatePrevSessions($l)
    {
        $m = __METHOD__ . '(): ';

        try {
            $where = "login_id = '{$l}'";
            $params = array(
                'status'          => self::INVALID,
            );

                $rowsAffected = $this->update($params, $where);

                if ($rowsAffected > 0) {
                    Zend_Registry::get('log')->debug($m . "Successfully invalidated previous sessions updated session table.");
                } else {
                    Zend_Registry::get('log')->debug($m . 'Failed to invalidate predvious sessions, update failed.');
                } 
            
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            Zend_Registry::get('log')->debug($m . "Could not retrieve old session information. Exception thrown: {$errorMsg}");
        }   
    }

    public function updateCurrentSession(array $data) {
        $where = $this->getAdapter()->quoteInto('id = ?', Zend_Session::getId());
        return parent::update($data, $where);
    }


}    
