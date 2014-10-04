<?php

class App_Event_Cw_ProfileController_editpersonal extends App_Event_WsEventAbstract  {

    /**
     * @param Zend_Controller_Request_Abstract $request 
     */
    public function __construct(Zend_Controller_Request_Abstract $request = null)
    {
        parent::__construct($request);

        $this->_evt_data = array(
            'inputs' => array(
                'BIRTH_MONTH'  => array('int', 5, 0, App_Constants::getFormLabel('MONTH')),
                'BIRTH_DAY'    => array('int', 5, 0, App_Constants::getFormLabel('DAY')),
                'BIRTH_YEAR'   => array('int', 5, 0, App_Constants::getFormLabel('YEAR')),
                'FIRST_NAME'  => array('generic', 100, 0, App_Constants::getFormLabel('FIRST_NAME')),
                'LAST_NAME' => array('generic', 100, 0, App_Constants::getFormLabel('LAST_NAME')),
                'ALTEMAIL' => array('email', 100, 0, App_Constants::getFormLabel('EMAIL')),
                'ALTPHONE'  => array('int', 100, 0, App_Constants::getFormLabel('PHONE')),
                'ADDRESS'   => array('generic', 100, 0, App_Constants::getFormLabel('ADDRESS')),
                'ADDRESS2'  => array('generic', 100, 0, App_Constants::getFormLabel('ADDRESS')),
                'CITY' => array('generic', 100, 0, App_Constants::getFormLabel('CITY')),
                'STATE' => array('generic', 100, 0, App_Constants::getFormLabel('STATE')),
                'ZIP'  => array('int', 100, 0, App_Constants::getFormLabel('ZIP')),
            )

        );
    }

    public function getEvtData() {
        $data = parent::getEvtData();
        unset($data['inputs']['KEY']);
        unset($data['inputs']['IDENTIFIER']);
        return $data;
    }
    
    public function execute(&$session_data,&$pview,&$cthis){


                App_DataUtils::beginTransaction();

                //$ns = new Zend_Session_Namespace(Zend_Registry::get('name'));
                //App_DataUtils::userlogp('Change',$ns->mobileid,'user_mobile','Reset PIN');     
                $pview->pageid = "profile";

                        $uid = $session_data->identity['userid'];

                        $pview->states = array("AL" => "Alabama", "AK" => "Alaska", "AZ" => "Arizona", "AR" => "Arkansas", "CA" => "California", "CO" => "Colorado", "CT" => "Connecticut", "DE" => "Delaware", "FL" => "Florida", "GA" => "Georgia", "HI" => "Hawaii", "ID" => "Idaho", "IL" => "Illinois", "IN" => "Indiana", "IA" => "Iowa", "KS" => "Kansas", "KY" => "Kentucky", "LA" => "Louisiana", "ME" => "Maine", "MD" => "Maryland", "MA" => "Massachusetts", "MI" => "Michigan", "MN" => "Minnesota", "MS" => "Mississippi", "MO" => "Missouri", "MT" => "Montana", "NE" => "Nebraska", "NV" => "Nevada", "NH" => "New Hampshire", "NJ" => "New Jersey", "NM" => "New Mexico", "NY" => "New York", "NC" => "North Carolina", "ND" => "North Dakota", "OH" => "Ohio", "OK" => "Oklahoma", "OR" => "Oregon", "PA" => "Pennsylvania", "RI" => "Rhode Island", "SC" => "South Carolina", "SD" => "South Dakota", "TN" => "Tennessee", "TX" => "Texas", "UT" => "Utah", "VT" => "Vermont", "VA" => "Virginia", "WA" => "Washington", "WV" => "West Virginia", "WI" => "Wisconsin", "WY" => "Wyoming");
                        $pview->birthdatedays = 31;
                        $pview->birthdatemonths = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
                        $pview->birthdateyears = date("Y");

                        $pview->EMAIL      = $session_data->identity['email'];
                        $pview->FIRST_NAME = $session_data->identity['firstname'];
                        $pview->LAST_NAME  = $session_data->identity['lastname'];

                        $uinfo = new App_Models_Db_Wigi_User();
                        $birthdate = $uinfo->fetchRow($uinfo->select()->where('user_id = ?', $uid));
                        $pview->birthdate_day = date("j", strtotime($birthdate['birthdate']));
                        $pview->birthdate_month = date("n", strtotime($birthdate['birthdate']));
                        $pview->birthdate_year = date("Y", strtotime($birthdate['birthdate']));

                        $uinfof = $uinfo->fetchRow($uinfo->select()->from($uinfo,
                                array('alternate_email', 'alternate_phone')
                        )->where('user_id = ?', $uid));

                        $pview->ALTEMAIL = $uinfof['alternate_email'];
                        $pview->ALTPHONE = $uinfof['alternate_phone'];

                        $uaddr = new App_Models_Db_Wigi_UserAddress();
                        $uaddrf = $uaddr->fetchRow($uaddr->select()->from($uaddr,
                                array('addr_line1', 'addr_line2', 'city', 'state', 'zip')
                        )->where('user_id = ?', $uid));

                        $pview->ZIP      = $uaddrf['zip'];
                        $pview->ADDRESS  = $uaddrf['addr_line1'];
                        $pview->ADDRESS2 = $uaddrf['addr_line2'];
                        $pview->CITY     = $uaddrf['city'];
                        $pview->STATE    = $uaddrf['state'];

                        $pview->showcontent = "form";

                        if ($this->_request->getParam('doaction') != null) {

                                $birthm = $this->_request->getParam("BIRTH_MONTH");
                                $birthd = $this->_request->getParam("BIRTH_DAY");
                                $birthy = $this->_request->getParam("BIRTH_YEAR");
                                $birthdate = $birthy . "-" . $birthm . "-" . $birthd;

                                $uinfo = new App_Models_Db_Wigi_User();
                                $uinfof = $uinfo->update(
                                        array(
                                                'first_name' => $this->_request->getParam('FIRST_NAME'),
                                                'last_name' => $this->_request->getParam('LAST_NAME'),
                                                'birthdate' => $birthdate,
                                                'alternate_email' => $this->_request->getParam('ALTEMAIL'),
                                                'alternate_phone' => $this->_request->getParam('ALTPHONE')
                                        ),
                                        $uinfo->getAdapter()->quoteInto('user_id = ?', $uid)
                                );

                                $uaddr = new App_Models_Db_Wigi_UserAddress();
                                $uaddrf = $uaddr->update(
                                        array(
                                                'addr_line1' => $this->_request->getParam('ADDRESS'),
                                                'addr_line2' => $this->_request->getParam('ADDRESS2'),
                                                'city' => $this->_request->getParam('CITY'),
                                                'state' => $this->_request->getParam('STATE'),
                                                'zip' => $this->_request->getParam('ZIP')
                                        ),
                                        $uaddr->getAdapter()->quoteInto('user_id = ?', $uid)
                                );
								
								$cthis->initTplData();
                                $pview->showcontent = "success";
                        }


                        App_DataUtils::commit();

    }
}
