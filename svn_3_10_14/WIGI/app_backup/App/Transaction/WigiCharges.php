<?php

class App_Transaction_WigiCharges
{
	public static function getWigiCharge($defFixed, $defPercentage, $defField, $userStr, $amt, $code)
	{
		/*echo "defFixed	 |".$defFixed."\n";
		echo "defPercentage	 |".$defPercentage."\n";
		echo "defField	 |".$defField."\n";
		echo "userStr	 |".$userStr."\n";
		echo "amt	 |".$amt."\n";
		echo "code	 |".$code."\n";*/

		$wData = self::_getGlobalData($defFixed, $defPercentage, $defField);
		$uData = self::_getUserData($userStr);
		#print_r($uData);

		$finalData = self::_mergeUserAndGlobalData($wData, $uData);
		#print_r($finalData);
		#die();
		$charge = self::_calculateCharges($amt, $code, $finalData);

		return $charge;
	}

	public static function _calculateCharges($amt, $code, $finalData)
	{
		$desc='';
		$desc.='<li>Transaction Code is : '.$code.'</li>';
		$desc.='<li>Transaction Amount is : $'.$amt.'</li>';
		$desc.='<li> >> InCashMe&trade; Charge Calculation:</li>';

		$type = $finalData[$code]['type'];

		switch($type)
		{
			case 'F':
				$charge = $finalData[$code]['val']; // In $s Divide by 100 for dollar cents thingy
				break;
			case 'P':
				$charge = ($finalData[$code]['val'] * $amt)/100; // In $s
				break;
		}

		$desc.='<li>Enforced Charge Type: '.$type.'</li>';
		$desc.='<li>Charge Value: '.$finalData[$code]['val'] .'</li>';
		$desc.='<li>Total InCashMe&trade; Charge: $'.$charge.'</li>';
		//echo "\nTransaction Code is: ".$code." \nEnforced Type is	:".$type." \nCurrent Charge is: $".$charge."\n\n";
		$res['charge']=$charge;
		$res['desc']=$desc;
		return $res;
	}


	public static function _mergeUserAndGlobalData($g, $u)
	{
		//print_r($g);
		//print_r($u);
		$resArr=array();

		foreach($g as $id=>$data)
		{
			$c=array();
			if(array_key_exists($id, $u))
			{
				// Step 1: Get the default type for the user $u[$id]['def']
				// Step 2: Get the value for the user $u[$id]['val']
				//Step 3: Check if value from step 2 is in the limints for the global default for type in Step 1.
				$c['type']=$u[$id]['def'];

				$user_val = $u[$id]['val'];
				$global_min_value = $data[$u[$id]['def']]['min']; // Not sure if need to put a check here.. Global String should always have value for F and P types for every transaction type.
				$global_max_value = $data[$u[$id]['def']]['max'];
				$global_def_value = $data[$u[$id]['def']]['def'];

				if(($user_val <= $global_max_value) && ($user_val >= $global_min_value))
				{
					$c['val']=$user_val;
				}else
				{
					if($user_val > $global_max_value)
					{
						$c['val']=$global_max_value;
					}
					if($user_val < $global_min_value)
					{
						$c['val']=$global_min_value;
					}
				}
				$resArr[$id]=$c;
			}else
			{
				$c['type']=$data['def'];
				$c['val']=$data[$data['def']]['def'];
				$resArr[$id]=$c;
			}
		}

		return $resArr;
	}

	public static function _getUserData($userStr)
	{
		$userData = self::_convertUserStrtoArr($userStr);
		return $userData;
	}

	public static function _convertUserStrtoArr($str)
	{
		$b=array();
		$a=explode("|",$str);
		$r=array();

		foreach($a as $id=>$data)
		{
			if($data)
			{
				$tmp=explode("-",$data);
				$c['def']=$tmp[1];
				$c['val']=$tmp[2];
				$r[$tmp[0]]=$c;
			}
		}
		
		return $r;
	}



	public static function _getGlobalData($defFixed, $defPercentage, $defField)
	{
		$fixedData = self::_convertStrtoArr($defFixed);
		$percentageData = self::_convertStrtoArr($defPercentage);

		$wdata = self::_mergeGlobalData($defField, $fixedData, $percentageData);
		return $wdata;
	}

	# First argument is the default type string, second argument is the array of data type FIXED, #
	# and third argument is the data type PERCENTAGE  #
	public static function _mergeGlobalData($defStr, $f, $p)
	{
		$res=array();
		$a=explode("|",$defStr);

		foreach($a as $id=>$data)
		{
			if($data)
			{
				$c=array();
				$b=explode("-",$data);

				$c['def']=$b[1];
				if (array_key_exists($b[0], $f)) $c['F']=$f[$b[0]];
				if (array_key_exists($b[0], $p)) $c['P']=$p[$b[0]];
				$res[$b[0]]=$c;
			}
		}

		return $res;
	}


	public static function _convertStrtoArr($str)
	{
		$b=array();
		$a=explode("|",$str);
		$r=array();

		foreach($a as $id=>$data)
		{
			if($data)
			{
				$tmp=explode("-",$data);

				$c['min']=$tmp[1];
				$c['def']=$tmp[2];
				$c['max']=$tmp[3];
				$r[$tmp[0]]=$c;
			}
		}
		
		return $r;
	}

    public static function getGlobalDefaultData($gfixed, $gpercentage, $gdefaults) {
			$finalstr='|';
			$list = App_Transaction_Type::getConstName();
			foreach($list as $a=>$id)
			{
				echo "AAAA	 |".$a."| BBBBB	 |".$id;
			}
   }


	public static function _convertDefaultValStrtoArr($str)
	{
		$b=array();
		$a=explode("|",$str);
		$r=array();

		foreach($a as $id=>$data)
		{
			if($data)
			{
				$tmp=explode("-",$data);
				$c['type']=$tmp[1];
				$r[$tmp[0]]=$c;
			}
		}
		
		return $r;
	}


	/* Functions used in the billing module*/
	public static function prepareBillingData($str)
	{
		$a = self::_convertStrtoArr($str);
		$list = App_Transaction_Type::getConstName();

		$res=array();
		foreach($list as $id=>$data)
		{
			$tmp=array();
			$tmp['code']=$id;
			$tmp['desc']=$data;
			$tmp['min']=$a[$id]['min']?$a[$id]['min']:'';
			$tmp['def']=$a[$id]['def']?$a[$id]['def']:'';
			$tmp['max']=$a[$id]['max']?$a[$id]['max']:'';
			$res[]=$tmp;
		}

		return $res;
	}


	public static function prepareUserBillingData($str)
	{
		$a = self::_convertUserStrtoArr($str);
		$list = App_Transaction_Type::getConstName();

		$res=array();
		foreach($list as $id=>$data)
		{
			$tmp=array();
			$tmp['code']=$id;
			$tmp['desc']=$data;
			if(isset($a[$id]))
			{
				$tmp['type']=$a[$id]['def']?$a[$id]['def']:'F';
				$tmp['value']=$a[$id]['val']?$a[$id]['val']:'';
			}else
			{
				$tmp['type']='';
				$tmp['value']='';
			}
			$res[]=$tmp;
		}

		return $res;
	}


	public static function prepareDefaultsData($str)
	{
		$a = self::_convertDefaultValStrtoArr($str);
		$list = App_Transaction_Type::getConstName();

		$res=array();
		foreach($list as $id=>$data)
		{
			$tmp=array();
			$tmp['code']=$id;
			$tmp['desc']=$data;
			$tmp['type']=$a[$id]['type']?$a[$id]['type']:'';
			$res[]=$tmp;
		}

		return $res;
	}


}
