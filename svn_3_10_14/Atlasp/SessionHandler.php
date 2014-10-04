<?php
class Atlasp_SessionHandler extends Zend_Db_Table_Abstract implements Zend_Session_SaveHandler_Interface
{

    protected $_sessionSavePath;
    protected $_sessionName;
    protected $_name ='sessions';
    #protected $_adapter = Zend_Registry::get('sess');

    public function __construct($config) {
        #parent::__construct($config);
        $adapter = Zend_Registry::get('sess');
        parent::__construct($adapter);
    }

    public function __destruct() {
	    Zend_Session::writeClose();
    }

    public function open($save_path, $name) {
        Zend_Registry::get('log')->debug('opening the session');
        $this->_sessionSavePath = $save_path;
        $this->_sessionName     = $name;
        return true;
    }

    public function close() {
	    return true;
    }

    public function read($id) {
        Zend_Registry::get('log')->debug('reading the session '. $id);
        $rows = $this->find($id);
        if (count($rows)) {
            $row = $rows->current();
            if ($row && $row->status == 1) {
              return $row->session_data;
            }
        }
        Zend_Registry::get('log')->debug('did not find '.$id .' in the db');
        return '';
    }

    public function write($id, $data) {
        if(!$this->find($id)->current()) return false;
        $data = array('session_data' => (string) $data);
        if ($this->update($data, sprintf('id = "%s"', $id))) {
	        #Zend_Registry::get('log')->debug('writing the session '.$id);
        	#echo "writing the session ".$id;
        	return  true;
        }
        return false;
    }

    public function destroy($id) {
	Zend_Registry::get('log')->debug('destroying the session');
	$data = array('status' => '0');
	if ($this->update($data, sprintf('id = "%s"', $id))) {
		return true;
	}
	return false;
    }

    public function gc($maxlifetime){
	return true;
    }

}
