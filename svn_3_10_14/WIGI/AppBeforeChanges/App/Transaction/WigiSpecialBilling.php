<?php

class App_Transaction_WigiSpecialBilling
{
    const BASE_AMOUNT                   = 1;
    const SPECIAL_TRANS_CODES                   = '100,101,102';


	public static function getSpecialTransactionCodeDetails()
	{
		$list = App_Transaction_Type::getConstName();
		$a=array();

		$specialTCodes = self::SPECIAL_TRANS_CODES;
		$specialCodeArr = explode(",",$specialTCodes);
		foreach($specialCodeArr as $id=>$data)
		{
			$r['id']=$data;
			$r['desc']=$list[$data];
			$a[]=$r;
		}

		return $a;
	}


	public static function getWigiSpecialBilling($wSpecialBillingStr, $mSpecialBillingStr, $amt, $tcode, $charge)
	{
		$res=array();
		$res['charge']= $charge;
		$res['desc']='<li> >> Special Billing Calculation</li>';
		$res['update_str'] = $mSpecialBillingStr;

			// Step 1: Get and set Global Discount 
			if($wSpecialBillingStr)
			{
				$chargeInfo = self::_getGlobalDiscount($charge, $tcode, $wSpecialBillingStr);
				$res['charge'] = $chargeInfo['charge'];
				$res['desc'] .= $chargeInfo['desc'];
			}

			if($res['charge']==0) { return $res;}

			// Step 2: Check if it is a special Transaction Code
			if(self::_checkTransactionforSpecialBilling($tcode))
			{
				// Since this transaction falls under special billing, update the count and total amount for this transaction
				$updateStr = self::_saveMerchantTransactionInfo($mSpecialBillingStr, $amt);
				$res['update_str'] = $updateStr;
				$res['desc'] .= "<li>MERCHANT: Updated Current settings: ".$res['update_str']."</li>";

				$res['desc'] .= '<li>WIGI: Special Merchant Billing available for this Transaction Code</li>';
				if($mSpecialBillingStr)
				{
					$chargeInfo = self::_getMerchantDiscount($res['charge'], $amt, $mSpecialBillingStr);
					$res['charge'] = $chargeInfo['charge'];
					$res['desc'] .= $chargeInfo['desc'];
				}else
				{
					$res['desc'] .= '<li>MERCHANT: No Specials for Merchant for this month</li>';
				}
			}else
			{
				$res['desc'] .= '<li>WIGI: No Special Merchant Billing for this Transaction Code</li>';
			}

		return $res;
	}



	public static function _getMerchantDiscount($charge, $amt, $mSpecialBillingStr)
	{
			$res=array();

			$r = self::prepareSpecialBillingData($mSpecialBillingStr);
			$finalCharge=$charge;
			$desc='';

			/* First Special Discount */
			if($r['have_free_transactions'] and ($r['special_billing_discount_one'] >= $r['currentTotalNumTrans']))
			{
				$r['currentTotalNumTrans']++;
				$desc = "<li>MERCHANT: Available Free Transactions. This is a FREE Transaction </li>";
				$finalCharge=0;
			}else{
				if($r['have_transactions_discount'])
				{
					$finalCharge = ($charge - $charge*$r['special_billing_discount_one']/100);
					$desc = "<li>MERCHANT: ".$r['special_billing_discount_one']."% discount on $".$charge.", Current Charge $".$finalCharge."</li>";
				}
			}

			/* Second Special Discount */
			if($r['have_account_special'])
			{
				if(($r['currentTotalNumTrans'] > $r['account_special_min_num_trans']) or ($r['currentTotalTransAmt'] > $r['account_special_min_amount_trans']) )
				{
					if($r['currentTotalNumTrans'] > $r['account_special_min_num_trans']) 
					{
						$desc.= "<li>MERCHANT: Total NUM of Transactions above required number of Transactions for additional discount.</li>";
					}
					if($r['currentTotalTransAmt'] > $r['account_special_min_amount_trans']) 
					{
						$desc.= "<li>MERCHANT: Total AMOUNT of Transactions above required number of Transactions for additional discount.</li>";
					}
					$tmpCharge = ($finalCharge - $finalCharge*$r['special_billing_discount_two']/100);
					$desc .= "<li>MERCHANT: Applied ".$r['special_billing_discount_two']."% discount on $".$finalCharge.", Current Charge is $".$tmpCharge." </li>";
					$finalCharge = $tmpCharge;
				}
			}else
			{
				//$finalCharge = $charge;
			}

			//$updateStr = self::_saveMerchantTransactionInfo($r);
			$res['charge']= $finalCharge;
			$res['desc']=$desc;
			//$res['update_str']=$updateStr;

			return $res;
	}


	public static function _saveMerchantTransactionInfo($mSpecialBillingStr, $amt)
	{
		$r = self::prepareSpecialBillingData($mSpecialBillingStr);
		$r['currentTotalNumTrans'] = $r['currentTotalNumTrans']+1;
		$r['currentTotalTransAmt'] = $r['currentTotalTransAmt']+$amt;

		//$mSpecialBillingStr='B-10|Y-8-15000-20|9-900|';/* Would come from m table*/
		$updateStr = $r['special_billing_discount_one_code'].'-'.$r['special_billing_discount_one'].'|'.$r['special_billing_discount_two_code'].'-'.$r['account_special_min_num_trans'].'-'.$r['account_special_min_amount_trans'].'-'.$r['special_billing_discount_two'].'|'.$r['currentTotalNumTrans'].'-'.$r['currentTotalTransAmt'].'|';
		
		return $updateStr;
	}


	public static function _checkTransactionforSpecialBilling($code)
	{
		$specialTCodes = self::SPECIAL_TRANS_CODES;
		$specialCodeArr = explode(",",$specialTCodes);
		foreach($specialCodeArr as $id=>$data)
		{
			if($data == $code) {return true;}
		}

		return false;

	}

	public static function _getGlobalDiscount($charge, $code, $wSpecialBillingStr)
	{
		$desc='';
		$finalCharge=0;

		$b = self::_convertGlobalDiscountStrtoArr($wSpecialBillingStr);
		//print_r($b); 
		if(isset($b[$code]) and $b[$code]['free'])
		{
			// This Transaction is free;
			$desc = "<li>WIGI Special Billing: Free Transaction. </li>";
		}else
		{
			if(isset($b[$code]) and !$b[$code]['free'] and $b[$code]['val'])
			{
				$finalCharge = ($charge - $charge*$b[$code]['val']/100);
				$desc = "<li>WIGI Special Billing: ".$b[$code]['val']."% discount applied on $".$charge.", Current Charge $".$finalCharge."</li>";
			}else
			{
				$desc = "WIGI Special Billing: No Discount available. \n";
				$finalCharge = $charge;
			}
		}

		$res['charge']=$finalCharge;
		$res['desc']=$desc;
		return $res;
	}



	public static function getCurrentMonthCategory()
	{
		$cat = date('F').' '.date('Y').' special billing';
		return str_replace(' ','_', $cat);
	}

	public static function prepareSpecialBillingData($str)
	{
		$a=explode("|",$str);
		$spb1=explode("-",$a[0]);
		$spb2=explode("-",$a[1]);
		$currentMerchantTotals=explode("-",$a[2]);

		$b=array();
		$b['special_billing_discount_one_code'] = $spb1[0];
		$b['special_billing_discount_one'] = $spb1[1];
		$b['have_free_transactions'] = ($spb1[0]=='F')?1:0;
		$b['have_transactions_discount'] = ($spb1[0]=='B')?1:0;

		$b['have_account_special'] = ($spb2[0]=='Y')?1:0;
		$b['special_billing_discount_two_code'] = $spb2[0];
		$b['account_special_min_num_trans'] = $spb2[1];
		$b['account_special_min_amount_trans'] = $spb2[2];
		$b['special_billing_discount_two'] = $spb2[3];

		$b['currentTotalNumTrans'] = $currentMerchantTotals[0];
		$b['currentTotalTransAmt'] = $currentMerchantTotals[1];

	return $b;

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
			$tmp['free']=isset($a[$id]['free'])?$a[$id]['free']:'';
			$tmp['value']=isset($a[$id]['value'])?$a[$id]['value']:'';
			$res[]=$tmp;
		}

		return $res;
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
				$c['free']=$tmp[1];
				$c['value']=$tmp[2];
				$r[$tmp[0]]=$c;
			}
		}
		
		return $r;
	}

	public static function _convertGlobalDiscountStrtoArr($str)
	{
		$b=array();
		$a=explode("|",$str);
		$r=array();

		foreach($a as $id=>$data)
		{
			if($data)
			{
				$tmp=explode("-",$data);
				$c['free']=($tmp[1] == 'Y') ? 1 : 0;
				$c['val']=$tmp[2]?$tmp[2]:0;
				$r[$tmp[0]]=$c;
			}
		}
		
		return $r;
	}

}
