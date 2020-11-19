<?php 
/* 
-------------------------------------------------------------------------------- 
| @author Tauseef Ahmed
| Last Upate: 31-OCT-2020 05:25 PM
| 
| Facebook: www.facebook.com/ahmadlogs
| Twitter: www.twitter.com/ahmadlogs
| YouTube: https://www.youtube.com/channel/UCOXYfOHgu-C-UfGyDcu5sYw/
| Blog: https://ahmadlogs.wordpress.com/
 -------------------------------------------------------------------------------- 
 */
 
 class TwoCheckoutApi
{
    function __construct()
	{
        include_once 'include/lib/Twocheckout.php'; 
        
        Twocheckout::sellerId(TWOCHECKOUT_SELLER_ID); 
        Twocheckout::privateKey(TWOCHECKOUT_PRIVATE_KEY);
    }
	
    public function createCharge($post_data, $token)
	{ 
		if(!$token) {return "<p>Error on form submission.</p>";}
		
		//store order details in database 
		//and get order_id from database
		$merchantOrderID 	= 1;
		
        try { 
		
            $charge = Twocheckout_Charge::auth(array(
                "merchantOrderId" => $merchantOrderID,
                "token"      	  => $token,
                "currency"   	  => CURRENCY_CODE,
                "total"      	  => $post_data['product_price'],
                "billingAddr" 	  => array(
                    "name" 		  => $post_data['fullname'],
                    "addrLine1"   => $post_data['address'],
                    "city" 		  => $post_data['city'],
                    "state" 	  => $post_data['state'],
                    "zipCode" 	  => $post_data['zipCode'],
                    "country" 	  => $post_data['country'],
                    "email" 	  => $post_data['email'],
                    //"phoneNumber" => $post_data['phoneNumber']
                ),
				"demo"=> true,
            ));
			
			if ($charge['response']['responseCode'] == 'APPROVED') 
			{
				$statusMsg = "";
				$statusMsg = '<h2>Thanks for your Order!</h2>';
				$statusMsg .= '<h4>The transaction was successful. Order details are given below:</h4>';
				$statusMsg .= "<p>Response Code: ".$charge['response']['responseCode']."</p>";
				$statusMsg .= "<p>Order ID: ".$charge['response']['orderNumber']."</p>";
				$statusMsg .= "<p>Transaction ID: ".$charge['response']['transactionId']."</p>";
				$statusMsg .= "<p>Order Total: ".$charge['response']['total']." ".CURRENCY_CODE."</p>";
			}
			else
			{
				$statusMsg = "";
				$statusMsg = '<h2>OOPS! Transaction Faild</h2>';
				$statusMsg .= '<h4>The transaction was not successful. Response code is given below:</h4>';
				$statusMsg .= "<p>Response Code: ".$charge['response']['responseCode']."</p>";
			}
			
			return $statusMsg; 
			
        }catch(Exception $e) { 
            return "<p>API Errors: {$e->getMessage()}</p>";
        }
	
	}
	
}
?>