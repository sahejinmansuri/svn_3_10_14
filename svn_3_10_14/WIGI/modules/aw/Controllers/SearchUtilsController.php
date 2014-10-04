<?php

error_reporting(E_ALL);
include(__DIR__ . '/WebController.php');

class Aw_SearchUtilsController extends Aw_WebController {

    public function getSearchResults($id, $fixedInputs)
    {
        $inputsArr = $this->prepareSearchInputs($id,$fixedInputs);
		$orderby = $this->getRequest()->getParam('orderby');
		$orderby2 = $this->getRequest()->getParam('orderby2');

        return $this->searchDatafromInputs($id,$inputsArr, $orderby, $orderby2);
    }
	 public function getTransSearchResults($id, $fixedInputs,$page_offset,$per_page)
    {
        $inputsArr = $this->prepareSearchInputs($id,$fixedInputs);
		$orderby = $this->getRequest()->getParam('orderby');
		
		$orderby2 = $this->getRequest()->getParam('orderby2');

        return $this->searchTransDatafromInputs($id,$inputsArr, $orderby, $orderby2,$page_offset,$per_page);
    }
	
	protected function searchTransDatafromInputs($id, $inputs,$o,$o2,$page_offset,$per_page)
    {
        $searchClass = App_SearchOptionsUtils::getSearchClass($id);
        if(@class_exists($searchClass))
        {
            $srchObj = new $searchClass();
        }else
        {
            return 0;
        }


        $select = $srchObj->select();

        foreach($inputs as $id=>$data)
        {
            $w='';
            if($data['option']=='EQ')
            {
                $w = $data['field_name']." = ?";
                $select->where($w,$data['value']);
            }

            if($data['option']=='LT')
            {
                $w = $data['field_name']." <= ?";
                $select->where($w,$data['value']);
            }

            if($data['option']=='GT')
            {
                $w = $data['field_name']." >= ?";
                $select->where($w,$data['value']);
            }

            if($data['option']=='LI')
            {
                $w = $data['field_name']." like ?";
                $select->where($w,'%'.$data['value'].'%');
            }
        }

        $select->order("$o $o2");
		$select->limit($per_page,$page_offset);
		
		
        $raw = $srchObj->fetchAll($select);

        return $raw->toArray();

    }


	public function prepareSearchInputForm($id, $tplname,$form_code)
	{
		$variableArr=App_SearchOptionsUtils::prepareSearchInputForms($id);
		$this->view->variableArr = $variableArr;
		$this->view->num_filters = count($variableArr);
		$this->view->form_code = $form_code;

        $view = $this->getHelper('ViewRenderer')->view;
        $formHtml = $view->render($tplname);
        return $formHtml;
	}

	public function prepareSearchInputs($id,$fixedArr)
	{
		$inputsArr=array();
		$variableArr=App_SearchOptionsUtils::prepareSearchInputForms($id);
		//print_r($variableArr);
		for($i=0;$i<=count($variableArr);$i++)
		{
			$tmp=array();
			$field_name = $this->getRequest()->getParam("field_name_".$i);
			$option = $this->getRequest()->getParam("option_".$i);
			$value = $this->getRequest()->getParam("value_".$i);
			if($field_name != '' and $value != '')
			{
				$tmp['field_name']=$field_name;
				$tmp['option']=$option;
				$tmp['value']=$value;

				$inputsArr[$field_name]=$tmp;
			}
		}
		
		foreach($fixedArr as $id=>$data)
		{
			$value = $this->getRequest()->getParam($data);
			if($value !='')
			{
				$tmp['field_name']=$data;
				$tmp['option']='EQ';
				$tmp['value']=$value;

				$inputsArr[$data]=$tmp;
			}
		}

		return $inputsArr;	
	
	}

    protected function searchDatafromInputs($id, $inputs,$o,$o2)
    {
        $searchClass = App_SearchOptionsUtils::getSearchClass($id);
        if(@class_exists($searchClass))
        {
            $srchObj = new $searchClass();
        }else
        {
            return 0;
        }


        $select = $srchObj->select();

        foreach($inputs as $id=>$data)
        {
            $w='';
            if($data['option']=='EQ')
            {
                $w = $data['field_name']." = ?";
                $select->where($w,$data['value']);
            }

            if($data['option']=='LT')
            {
                $w = $data['field_name']." <= ?";
                $select->where($w,$data['value']);
            }

            if($data['option']=='GT')
            {
                $w = $data['field_name']." >= ?";
                $select->where($w,$data['value']);
            }

            if($data['option']=='LI')
            {
                $w = $data['field_name']." like ?";
                $select->where($w,'%'.$data['value'].'%');
            }
        }


        $select->order("$o $o2");
        $raw = $srchObj->fetchAll($select);

        return $raw->toArray();

    }



    // This function would take the key of the table info that needs to be looked up along with consumer/user id
    public function getWigiUserData($id, $consumer_id)
    {
        $searchData = App_SearchOptionsUtils::getSearchData($id);
        if(@class_exists($searchData['class_name']))
        {
            $srchObj = new $searchData['class_name']();
        }else
        {
            return 0;
        }

        $select = $srchObj->select();
        $w = $searchData['field_name']." = ?";
        $orderby = $searchData['order_by'];

        $select->where($w,$consumer_id);
        if($searchData['has_status'])
        {
            $select->where('status = ?','active');
        }
        
        $select->order($orderby);
        $select->limit(50);

        $raw = $srchObj->fetchAll($select);
        $finalResults = $raw->toArray();
        $this->view->$searchData['view_var_name'] = $finalResults;
        return $finalResults;
    }


    public function loadCellPhoneInfo($consumer_id, $identifier='mobws')
    {
        $cellPhones = $this->getWigiUserData('CONSUMERS_MOBILE_INFO',$consumer_id);

        $uprefs = new App_Prefs();
        $finalRes=array();

        foreach ($cellPhones as $cell) {
            $mid = $cell['mobile_id'];
            $cellPrefs = $uprefs->getCellphonePrefs($consumer_id, $mid, $identifier);
            $cell['preferences'] = $cellPrefs;
            $finalRes[]=$cell;
        }
        //print_r($finalRes);die();
        $this->view->consumers_mobile_info_data = $finalRes;
    }



    public function loadConsumerTransactions($consumer_id)
    {
        $transactions = $this->getWigiUserData('CONSUMERS_TRANSACTIONS',$consumer_id);
        $finalRes=array();

		$list = App_Transaction_Type::getConstName();
        foreach($transactions as $id=>$data)
        {
            $data['type_desc'] = $list[$data['type']];
            $finalRes[]=$data;
        }

        $this->view->consumers_transaction_data = $finalRes;

    }

    public function loadPreferences($uid, $app='cw')
    {
        $uprefs = new App_Prefs();
        $preferences = $uprefs->getWebUserPrefs($uid,$app);
        $this->view->preferences = $preferences;

    }


    public function loadMerchantTransactions($merchant_id)
    {
        $transactions = $this->getWigiUserData('MERCHANT_TRANSACTIONS',$merchant_id);
        $finalRes=array();

		$list = App_Transaction_Type::getConstName();
        foreach($transactions as $id=>$data)
        {
            $data['type_desc'] = $list[$data['type']];
            $finalRes[]=$data;
        }
        $this->view->merchants_transaction_data = $finalRes;
    }


    public function loadPOSUsersInfo($merchant_id)
    {
        $user = new App_Models_Db_Wigi_User();
        $result = $user->fetchAll(
          $user->select()
            ->where('parent_user_id = ?', $merchant_id)->where('status != ?','deleted')
        );
        $pos_users = $result->toArray();
        $finalRes=array();
        if(count($pos_users)>0)
        {
            foreach($pos_users as $id=>$data)
            {
                $pos_device = $this->getWigiUserData('MERCHANTS_POS_DEVICE',$data['user_id']);
                $data['pos_device']=$pos_device;

                $finalRes[]=$data;
            }
        }


		$this->view->merchant_id = $merchant_id;
        $this->view->merchants_pos_user_data=$finalRes;

    }

}
