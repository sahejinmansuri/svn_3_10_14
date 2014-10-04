<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewConsumerInfo
 *
 * @author nhenehan
 */
class App_Models_Db_Wigi_ViewConsumerInfo extends Zend_Db_Table_Abstract {

    protected $_name = 'view_consumer_info';

    public function __construct() {
        parent::__construct(array('db' => Zend_Registry::get('wigi')));
    }

}

?>
