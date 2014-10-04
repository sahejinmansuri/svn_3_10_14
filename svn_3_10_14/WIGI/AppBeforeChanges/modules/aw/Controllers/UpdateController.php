<?php

include(__DIR__ . '/WebController.php');

class Aw_UpdateController extends Aw_WebController {

    
    protected function redirectMerchantDetails($mid)
    {
        $cfg = $this->cfg;
        $orig_basehref = $cfg->paths->basehref;
        $ver = $cfg->version;
        $ver2 = $ver.'/aw';
        $orig_basehref = str_replace("aw",$ver2,$orig_basehref);
        //$formbase = $orig_basehref.$cfg->version.'/aw/';
        $url = $orig_basehref.'customer/mercdetail?MID='.$mid.'#merchantinfo';
        $this->_redirect($url, array('prependBase' => false));
    }



    protected function redirectUserDetails($uid)
    {
        $cfg = $this->cfg;
        $orig_basehref = $cfg->paths->basehref;
        $ver = $cfg->version;
        $ver2 = $ver.'/aw';
        $orig_basehref = str_replace("aw",$ver2,$orig_basehref);
        //$formbase = $orig_basehref.$cfg->version.'/aw/';
        $url = $orig_basehref.'customer/userdetail?UID='.$uid.'#personalinfo';
        $this->_redirect($url, array('prependBase' => false));
    }



    public function showuserAction(){
        $uid = $this->getRequest()->getParam("UID");
        $section = $this->getRequest()->getParam("section");

        if(!$uid) { $this->redirect('home','customer','aw');}

        $sectionInputs = App_Admin_UpdateUtilities::getConsumerInputs($section);

        $this->view->preload_data = $sectionInputs['preload_data'];
        if($sectionInputs['preload_data'])
        {
            if($sectionInputs['preload_call_back'])
            {
                $this->$sectionInputs['preload_call_back']($sectionInputs, $uid);
            }else
            {
                $results = $this->getSectionData($sectionInputs, $uid);
                $sectionData = $results[0];
                $this->view->sectionInputs = $this->prepareSectionInputs($sectionInputs['inputs'], $sectionData);
            }
        }else
        {
            $this->view->sectionInputs = $sectionInputs['inputs'];
        }

        $this->view->section_label = $sectionInputs['section_label'];
        $this->view->uid = $uid;
        $this->view->section = $section;

    }    



    public function saveuserAction()
    {
        $uid = $this->getRequest()->getParam("UID");
        if(!$uid)
        {
            $this->redirect('home','customer','aw');
        }
        $section = $this->getRequest()->getParam("section");
        $sectionInputs = App_Admin_UpdateUtilities::getConsumerInputs($section); 

        // Check if there is a callback function
        if($sectionInputs['call_back'])
        {
            $this->$sectionInputs['call_back']($sectionInputs, $uid);
        }else
        {
            $inputs = $this->processInputData($sectionInputs);
            $this->updateInputData($sectionInputs, $inputs, $uid);
        }

        $this->redirectUserDetails($uid);
    }



    public function showmerchantAction(){
        $mid = $this->getRequest()->getParam("MID");
        $recid = $this->getRequest()->getParam("recid");
        $section = $this->getRequest()->getParam("section");

        if(!$mid) { $this->redirect('home','customer','aw');}

        $sectionInputs = App_Admin_UpdateUtilities::getMerchantInputs($section);

        $this->view->preload_data = $sectionInputs['preload_data'];
        if($sectionInputs['preload_data'])
        {
            if($sectionInputs['preload_call_back'])
            {
                $this->$sectionInputs['preload_call_back']($sectionInputs, $mid);
            }else
            {
                $results = $this->getSectionData($sectionInputs, $mid);
                $sectionData = $results[0];
                $this->view->sectionInputs = $this->prepareSectionInputs($sectionInputs['inputs'], $sectionData);
            }
        }else
        {
            $this->view->sectionInputs = $sectionInputs['inputs'];
        }

        $this->view->section_label = $sectionInputs['section_label'];
        $this->view->mid = $mid;
        $this->view->recid = $recid;
        $this->view->section = $section;

    }

    
    public function savemerchantAction()
    {
        $mid = $this->getRequest()->getParam("MID");

        if(!$mid)
        {
            $this->redirect('home','customer','aw');
        }
        $section = $this->getRequest()->getParam("section");
        $sectionInputs = App_Admin_UpdateUtilities::getMerchantInputs($section); 

        // Check if there is a callback function
        if($sectionInputs['call_back'])
        {
            $this->$sectionInputs['call_back']($sectionInputs, $mid);
        }else
        {
            $inputs = $this->processInputData($sectionInputs);
            $this->updateInputData($sectionInputs, $inputs, $mid);
        }

        $this->redirectMerchantDetails($mid);
    }

    
    protected function updateInputData($sectionInputs, $inputs, $id)
    {
        $searchClass = $sectionInputs['db_class'];
        if(@class_exists($searchClass))
        {
            $srchObj = new $searchClass();
        }else
        {
            return 0;
        }

        $inputs[$sectionInputs['datefield']] = new Zend_Db_Expr('NOW()');;
        $inputs[$sectionInputs['userfield']] = $this->ns->identity['userid'];
        $whereStr = $sectionInputs['db_field'].' = ?';

		if($sectionInputs['db_child_field'])
		{
			$child_id = $this->getRequest()->getParam('recid');
	        $where2Str = $sectionInputs['db_child_field']." = ?";
	        $srchObj->update($inputs, array($whereStr => $id, $where2Str => $child_id));
		}else
		{
	        $srchObj->update($inputs, array($whereStr => $id));
		}

        return 1;
    }

    
    protected function processInputData($sectionInputs)
    {
        $sectionData = $sectionInputs['inputs'];
        $inputArr=array();
        
        foreach($sectionData as $id=>$data)
        {
            if($data['field_type'] == 'text')
            {
                $inputArr[$data['input_field']] = trim($this->getRequest()->getParam($data['input_field']));
            }else
            {
                // If radio button type field and field is checked, get the appropriate value from the data array
                if($data['field_type'] == 'radio')
                {
                    if($this->getRequest()->getParam($data['input_field']))
                    {
                        $inputArr[$data['input_field']] = $data['field_value'];
                    }

                }

            }
        }

		if($this->getRequest()->getParam("section") == 'activate')
		{
			$inputArr['suspend_count'] = 0;
		}

        return $inputArr;
    }

    
    
    protected function prepareSectionInputs($inputs,$data)
    {
        $results=array();

        foreach($inputs as $id=>$fieldData)
        {
            $fieldData['input_value']='';
            if(isset($data[$fieldData['input_field']]))
            {
                $fieldData['input_value'] = $data[$fieldData['input_field']];
            }

            $results[] = $fieldData;
        }

        return $results;
    }


    protected function getSectionData($sectionInputs, $id)
    {
        $searchClass = $sectionInputs['db_class'];

        if(@class_exists($searchClass))
        {
            $srchObj = new $searchClass();
        }else
        {
            return 0;
        }

        $select = $srchObj->select();
        $w = $sectionInputs['db_field']." = ?";
        $select->where($w,$id);
		if($sectionInputs['db_child_field'])
		{
			$child_id = $this->getRequest()->getParam('recid');
	        $w2 = $sectionInputs['db_child_field']." = ?";
	        $select->where($w2,$child_id);
		}

        $raw = $srchObj->fetchAll($select);
        return $raw->toArray();

    }



   /* PRE AND POST CALL BACK FUNCTIONS for features */
	protected function deleteConsumerAccount($sectionInputs, $uid)
	{
		// update status in user table
		$inputs = $this->processInputData($sectionInputs);
		$this->updateInputData($sectionInputs, $inputs, $uid);

		// set status to deleted for all cells belonging to this user
		$srchObj = new App_Models_Db_Wigi_UserMobile();

		$inputs['date_changed'] = new Zend_Db_Expr('NOW()');;
		$inputs['user_changed'] = $this->ns->identity['userid'];
		$inputs['status'] = 'deleted';

		$whereStr = 'user_id = ?';
		$srchObj->update($inputs, array($whereStr => $uid));
	}

    protected function getConsumerPrefs($sectionInputs, $uid)
    {
        $uprefs = new App_Prefs();
        $preferences = $uprefs->getWebUserPrefs($uid);

        $system_timeout = $preferences['system']['timeout'];
        $wigi_international_trans = $preferences['wigi']['international_trans'];
        $notification_alert = $preferences['notification']['alert'];
        $wigi_max_per_trans = $preferences['wigi']['max_per_trans'];
        $wigi_max_per_day = $preferences['wigi']['max_per_day'];
        $wigi_timeout = $preferences['wigi']['timeout'];
        $gift_max_per_trans = $preferences['gift']['max_per_trans'];
        $gift_max_per_day = $preferences['gift']['max_per_day'];
        $funding_max_per_trans = $preferences['funding']['max_per_trans'];
        $funding_max_per_day = $preferences['funding']['max_per_day'];

        $inputs=array();

        foreach($sectionInputs['inputs'] as $id=>$data)
        {
            if($$data['input_field'] == 'true')
            {
                $data['input_value'] = 1;
            }else if($$data['input_field'] == 'false')
            {
                $data['input_value'] = 0;
            }else
            {
                $data['input_value'] = $$data['input_field'];
            }
            $inputs[] = $data;
        }

        $this->view->sectionInputs = $inputs;
    }


    protected function checkUpdateConsumerPrefs($sectionInputs, $uid)
    {
        $uprefs = new App_Prefs();
        $preferences = $uprefs->getWebUserPrefs($uid);

        $preferences['system']['timeout'] = trim($this->getRequest()->getParam("system_timeout"));
        $preferences['wigi']['international_trans'] = trim($this->getRequest()->getParam("wigi_international_trans"));
        $preferences['notification']['alert'] = trim($this->getRequest()->getParam("notification_alert"));
        $preferences['wigi']['max_per_trans'] = trim($this->getRequest()->getParam("wigi_max_per_trans"));
        $preferences['wigi']['max_per_day'] = trim($this->getRequest()->getParam("wigi_max_per_day"));
        $preferences['wigi']['timeout'] = trim($this->getRequest()->getParam("wigi_timeout"));
        $preferences['gift']['max_per_trans'] = trim($this->getRequest()->getParam("gift_max_per_trans"));
        $preferences['gift']['max_per_day'] = trim($this->getRequest()->getParam("gift_max_per_day"));
        $preferences['funding']['max_per_trans'] = trim($this->getRequest()->getParam("funding_max_per_trans"));
        $preferences['funding']['max_per_day'] = trim($this->getRequest()->getParam("funding_max_per_day"));

        $uprefs->checkConstraint($preferences,"system");

        $uprefs->saveWebUserPrefs($uid, $preferences);
    }



    protected function getMerchantPrefs($sectionInputs, $mid)
    {

        $uprefs = new App_Prefs();
        $preferences = $uprefs->getWebUserPrefs($mid,'mw');
        //print_r($preferences);
        $cash = $preferences['accept']['cash'];
        $creditcard = $preferences['accept']['creditcard'];
        $scanandpay = $preferences['accept']['scanandpay'];
        $scanandbuy = $preferences['accept']['scanandbuy'];
        $ecommerce = $preferences['accept']['ecommerce'];
        $salestax = $preferences['salestax'];
        $possecret = $preferences['possecret'];
        $tips = $preferences['tips'];

        $inputs=array();

        foreach($sectionInputs['inputs'] as $id=>$data)
        {
            if($$data['input_field'] == 'true')
            {
                $data['input_value'] = 1;
            }else if($$data['input_field'] == 'false')
            {
                $data['input_value'] = 0;
            }else
            {
                $data['input_value'] = $$data['input_field'];
            }
            $inputs[] = $data;
        }

        $this->view->sectionInputs = $inputs;
    }


    protected function checkUpdatePrefs($sectionInputs, $mid)
    {
        $uprefs = new App_Prefs();
        $prefs = $uprefs->getWebUserPrefs($mid,'mw');

        $prefs["accept"]["cash"] = $this->getRequest()->getParam("cash")?'true':'false';
        $prefs["accept"]["creditcard"] = $this->getRequest()->getParam("creditcard")?'true':'false';
        $prefs["accept"]["scanandpay"] = $this->getRequest()->getParam("scanandpay")?'true':'false';
        $prefs["accept"]["scanandbuy"] = $this->getRequest()->getParam("scanandbuy")?'true':'false';
        $prefs["accept"]["ecommerce"] = $this->getRequest()->getParam("ecommerce")?'true':'false';
        
        $prefs["possecret"] = $this->getRequest()->getParam("possecret");
        $prefs["salestax"] = $this->getRequest()->getParam("salestax");
        $prefs["tips"] = $this->getRequest()->getParam("tips");			
        
        $uprefs->saveWebUserPrefs($mid, $prefs, 'mw');
    }

	protected function checkUpdatePasswd($sectionInputs, $userid)
	{
		$password = trim($this->getRequest()->getParam("password"));
		$password2 = trim($this->getRequest()->getParam("password2"));
		
		$inputs['password'] = Atlasp_Utils::inst()->encryptPassword($password);
		if($password == $password2)
		{
            $this->updateInputData($sectionInputs, $inputs, $userid);
		}

	}

	protected function updateMobileQuestions($sectionInputs, $mobileid)
	{
		$inputsData = $this->prepareMobileQuestions($sectionInputs, $mobileid);
		$questionsObj  = new App_Models_Db_Wigi_Question();

		foreach($inputsData as $id=>$data)
		{
	        $answer = $this->getRequest()->getParam($data['rec_id']);
			$inputs['answer'] = $answer;
			$where['mobile_id = ?'] = $mobileid;
			$where['question_id = ?'] = $data['rec_id'];

	        $update = $questionsObj->update($inputs, $where);
		}
	}

	protected function prepareMobileQuestions($sectionInputs, $mobileid)
	{
		$this->view->is_array_data=1;
		// Get questions data
		$results = $this->getSectionData($sectionInputs, $mobileid);

		$inputsData = array();
		$id1=1;
		foreach($results as $id=>$data)
		{
			$a['rec_info'] = $data['question'];
			$a['rec_value'] = $data['answer'];
			$a['rec_id'] = $data['question_id'];
			$a['rec_num'] = 'Q'.$id1;
			$a['field_type'] = 'text';
	
			$inputsData[] = $a;
			$id1++;
		}

		return $inputsData;
	}

    public function showmobileAction(){
        $uid = $this->getRequest()->getParam("UID");
        $mobileid = $this->getRequest()->getParam("recid");
        $section = $this->getRequest()->getParam("section");
		$this->view->is_array_data=0;
        if(!$uid or !$mobileid) { $this->redirect('home','customer','aw');}
        //echo $uid."|".$id;exit;
		$this->view->valid_request=1;
		
		if(array_key_exists($section, App_Admin_UpdateUtilities::getMobileInputs()))
		{
			$sectionInputs = App_Admin_UpdateUtilities::getMobileInputs($section);
			if(isset($sectionInputs['is_array_input']) and $sectionInputs['is_array_input'])
			{
				$this->view->is_array_data=1;

				if($section == 'questions'){
					$sectionData = $this->prepareMobileQuestions($sectionInputs, $mobileid);
					$this->view->sectionInputs = $sectionData;
				}
			}
			else
			{
				$this->view->preload_data = $sectionInputs['preload_data'];
				if($sectionInputs['preload_data'])
				{
					if($sectionInputs['preload_call_back'])
					{
						$this->$sectionInputs['preload_call_back']($sectionInputs, $uid);
					}else
					{
						$results = $this->getSectionData($sectionInputs, $uid);
						$sectionData = $results[0];
						$this->view->sectionInputs = $this->prepareSectionInputs($sectionInputs['inputs'], $sectionData);
					}
				}else
				{
					$this->view->sectionInputs = $sectionInputs['inputs'];
				}
			}
	        $this->view->section_label = $sectionInputs['section_label'];
		}else
		{
			$this->view->valid_request=0;
		}

        $this->view->uid = $uid;
        $this->view->mobileid = $mobileid;
        $this->view->section = $section;
    }    

    public function savemobileAction()
    {
        $uid = $this->getRequest()->getParam("UID");
        $mobileid = $this->getRequest()->getParam("recid");
        if(!$uid or !$mobileid) { $this->redirect('home','customer','aw');}
        $section = $this->getRequest()->getParam("section");
        $sectionInputs = App_Admin_UpdateUtilities::getMobileInputs($section); 

        // Check if there is a callback function
		if(isset($sectionInputs['is_array_input']) and $sectionInputs['is_array_input'])
		{
			if($section == 'questions'){
				$sectionData = $this->updateMobileQuestions($sectionInputs, $mobileid);
			}
		}
		else
		{
			if($sectionInputs['call_back'])
			{
				$this->$sectionInputs['call_back']($sectionInputs, $uid);
			}else
			{
				$inputs = $this->processInputData($sectionInputs);
				$this->updateInputData($sectionInputs, $inputs, $uid);
			}
		}

        $this->redirectUserDetails($uid);
    }


    protected function getMobilePrefs($sectionInputs, $uid)
    {
        $mid = $this->getRequest()->getParam("recid");
        $uprefs = new App_Prefs();
        $preferences = $uprefs->getCellphonePrefs($uid, $mid, 'mobws');

        $system_timeout = $preferences['system']['timeout'];
        $wigi_international_trans = $preferences['wigi']['international_trans'];
        $notification_alert = $preferences['notification']['alert'];
        $wigi_max_per_trans = $preferences['wigi']['max_per_trans'];
        $wigi_max_per_day = $preferences['wigi']['max_per_day'];
        $wigi_timeout = $preferences['wigi']['timeout'];
        $gift_max_per_trans = $preferences['gift']['max_per_trans'];
        $gift_max_per_day = $preferences['gift']['max_per_day'];
        $funding_max_per_trans = $preferences['funding']['max_per_trans'];
        $funding_max_per_day = $preferences['funding']['max_per_day'];

        $inputs=array();

        foreach($sectionInputs['inputs'] as $id=>$data)
        {
            if($$data['input_field'] == 'true')
            {
                $data['input_value'] = 1;
            }else if($$data['input_field'] == 'false')
            {
                $data['input_value'] = 0;
            }else
            {
                $data['input_value'] = $$data['input_field'];
            }
            $inputs[] = $data;
        }

        $this->view->sectionInputs = $inputs;
    }

    protected function checkUpdateMobilePrefs($sectionInputs, $uid)
    {
        $mid = $this->getRequest()->getParam("recid");

        $uprefs = new App_Prefs();
        $user_prefs = $uprefs->getWebUserPrefs($uid);

        $preferences = $uprefs->getCellphonePrefs($uid, $mid, 'mobws');

        $preferences['system']['timeout'] = trim($this->getRequest()->getParam("system_timeout"));
        $preferences['wigi']['international_trans'] = trim($this->getRequest()->getParam("wigi_international_trans"));
        $preferences['notification']['alert'] = trim($this->getRequest()->getParam("notification_alert"));
        $preferences['wigi']['max_per_trans'] = trim($this->getRequest()->getParam("wigi_max_per_trans"));
        $preferences['wigi']['max_per_day'] = trim($this->getRequest()->getParam("wigi_max_per_day"));
        $preferences['wigi']['timeout'] = trim($this->getRequest()->getParam("wigi_timeout"));
        $preferences['gift']['max_per_trans'] = trim($this->getRequest()->getParam("gift_max_per_trans"));
        $preferences['gift']['max_per_day'] = trim($this->getRequest()->getParam("gift_max_per_day"));
        $preferences['funding']['max_per_trans'] = trim($this->getRequest()->getParam("funding_max_per_trans"));
        $preferences['funding']['max_per_day'] = trim($this->getRequest()->getParam("funding_max_per_day"));
//print_R($user_prefs);
//print_R($preferences);
        $newprefs = $uprefs->checkConstraint($preferences,$user_prefs,false);
//print_r($newprefs);exit;
        if ( $newprefs != null) { 
                $uprefs->saveCellphonePrefs($uid,$mid,$preferences);
        }

    }

}
