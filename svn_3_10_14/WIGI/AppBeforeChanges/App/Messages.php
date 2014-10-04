<?php

class App_Messages{
    protected $consumerRegister;    
    protected $merchantRegister;    

    public function __construct(){
    }

    public function sendMerchantWigiPwdReset($email, $firstname, $passwd) {
       $s = <<<EOF
<html>
<body>
Dear $firstname,<br /><br/>
	   
Your password has been reset by your administrator. <br/>
Your new password is: <b>$passwd</b><br/>
<br/>
Thanks,<br />
Wigi Customer Support
</body>
</html>
EOF;

		$m = new App_Messenger();
		$m->sendMessage($s,$email,'1');	

       return $s;
    }


    public function sendCreditCardAdd($email, $firstname, $lastname, $last4) {
       $s = <<<EOF
<html>
<body>
<b>Dear $firstname $lastname,</b><br /><br/>
	   
You are receiving this email because you have successfully added a Credit Card to your WiGime account. Your credit card details are listed below:<br/><br/>
Credit Card Number: $last4<br/>
<br/>
Thanks,<br />
Wigi Customer Support
</body>
</html>
EOF;

		$m = new App_Messenger();
		$m->sendMessage($s,$email,'1');	

       return $s;
    }


    public function sendBankAccountDelete($email, $firstname, $lastname) {
       $s = <<<EOF
<html>
<body>
<b>Dear $firstname $lastname,</b><br /><br/>
	   
You are receiving this email because you have successfully deleted a Bank Account from your WiGime account. 
<br/>
<br/>
Thanks,<br />
Wigi Customer Support
</body>
</html>
EOF;

		$m = new App_Messenger();
		$m->sendMessage($s,$email,'1');	

       return $s;
    }


    public function sendCreditCardDelete($email, $firstname, $lastname) {
       $s = <<<EOF
<html>
<body>
<b>Dear $firstname $lastname,</b><br /><br/>
	   
You are receiving this email because you have successfully deleted a Credit Card from your WiGime account. 
<br/>
<br/>
Thanks,<br />
Wigi Customer Support
</body>
</html>
EOF;

		$m = new App_Messenger();
		$m->sendMessage($s,$email,'1');	

       return $s;
    }


    public function sendBankAccountAdd($email, $firstname, $lastname, $bankaccount, $routing) {
       $s = <<<EOF
<html>
<body>
<b>Dear $firstname $lastname,</b><br /><br/>
	   
You are receiving this email because you have successfully added a Bank Account to your WiGime account. Your Bank accout details are listed below:<br/><br/>
Bank Account Number: $bankaccount<br/>
Routing Number: $routing<br/>
<br/>
Thanks,<br />
Wigi Customer Support
</body>
</html>
EOF;

		$m = new App_Messenger();
		$m->sendMessage($s,$email,'1');	

       return $s;
    }

    public function getTxtInvite($merchName) {
       $s = "You are receiving this email because your friend $merchName wants you to join WiGime.
WiGime is a Mobile Money / Mobile Wallet application that runs on your iPhone or Android cellular phone.

It allows you to turn your smart phone into a secure payment system.

To join, please visit wigime.com  and open an account, it's FREE!";
       return $s;
    }

    public function getEmailInvite($merchName) {
       $s = "You are receiving this email because your friend $merchName wants you to join WiGime.
WiGime is a Mobile Money / Mobile Wallet application that runs on your iPhone or Android cellular phone.

It allows you to turn your smart phone into a secure payment system.

To join, please visit wigime.com  and open an account, it's FREE!"; 
       return $s;
    }


    public function getForgotMerchLoginId($merchName) {
       $s = "You are receiving this email because a request has been made for a forgotten login id.

Your merchant account listed as $merchName is registered to this email address.

If you have not requested this information but are still receiving this email, please contact WiGime support staff.";
       return $s;
    }


    public function getTxtReceipt($amount,$merchName,$method) {
       $s = "Thank you for your purchase from $merchName. Your total is US $${amount} paid using $method";
       return $s;
    }

    public function getEmailReceipt($amount,$merchName, $method) {
       $s = "Thank you for your purchase from $merchName. Your total is US $${amount} paid using $method";
       return $s;
    }


    public function getConsumerRegister($firstname, $lastname, $email, $emailcode, $userid){

        $cfg = Zend_Registry::get('config');
        $link = $cfg->qrcode->base;
		$link = $link.'v2/cw/registration/verify/CODE/'.$emailcode.'/UID/'.$userid;

		
		$this->consumerRegister = <<<EOF
<html>
<body>
<b>Dear $firstname $lastname,</b><br /><br/>

You've entered $email as the contact email address for your Wigi account. To complete the process, we just need to verify that this email address belongs to you. Simply click the link below.<br /><br />

<a href="$link">Verify Now ></a><br /><br />

<b>Wondering why you got this email?</b><br />
It's sent when someone adds or changes a contact email address for a Wigi account. If you didn't do this, don't worry. Your email address cannot be used as a contact address for a Wigi account without your verification.<br /><br /><br />

For more information, see our frequently asked questions.<br /><br />

Thanks,<br />
Wigi Customer Support
</body>
</html>
EOF;
        error_log($this->consumerRegister);
        return $this->consumerRegister;
    }

    public function getMerchantRegister($name, $email, $emailcode, $userid, $merchantid){

        $cfg = Zend_Registry::get('config');
        $link = $cfg->qrcode->base;
		$link = $link.'v2/mw/registration/verify/CODE/'.$emailcode.'/UID/'.$userid;

        $this->consumerRegister = <<<EOF
<html>
<body>
<b>Welcome $name,</b><br /><br/>

You've entered $email as the contact email address for your Wigi merchant account. To complete the process, we just need to verify that this email address belongs to you. Simply click the link below.<br /><br />

<a href="$link">Verify Now ></a><br /><br />

Your merchant id is <b>$merchantid</b>.<br /><br />

<b>Wondering why you got this email?</b><br />
It's sent when someone adds or changes a contact email address for a Wigi account. If you didn't do this, don't worry. Your email address cannot be used as a contact address for a Wigi account without your verification.<br /><br /><br />

For more information, see our frequently asked questions.<br /><br />

Thanks,<br />
Wigi Customer Support
</body>
</html>
EOF;
        error_log($this->consumerRegister);
        return $this->consumerRegister;
    }


    public function getConsumerDelete($firstname, $lastname, $email, $cellphones){
        $this->consumerDelete = <<<EOF
<html>
<body>
<b>Dear $firstname $lastname,</b><br /><br/>

You've requested your Wigi account $email be deleted. Please note that additionally the cellphones $cellphones will also be deleted. Please call customer support if you have received this email without requesting your account be deleted.<br /><br />


<b>Wondering why you got this email?</b><br />
It's sent when someone adds or changes a contact email address for a Wigi account. If you didn't do this, don't worry. Your email address cannot be used as a contact address for a Wigi account without your verification.<br /><br /><br />

For more information, see our frequently asked questions.<br /><br />

Thanks,<br />
Wigi Customer Support
</body>
</html>
EOF;
        error_log($this->consumerDelete);
        return $this->consumerDelete;
    }


}
