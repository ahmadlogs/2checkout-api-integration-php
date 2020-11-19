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
 
include_once 'include/config.php';
include_once 'include/TwoCheckoutApi.php';

$title = TITLE;

include("include/header.php"); 

/* 
-------------------------------------------------------------------------------- 
| NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
-------------------------------------------------------------------------------- 
 */ 
if($_POST)
{
	$results = $db->query("SELECT * FROM product WHERE product_id = ".$_POST['product_id']); 
	$row = $results->fetch_array();

	$data['product_price']	=  $row['price'];
	$data['fullname'] 		= $_POST['fullname'];
	$data['email'] 			= $_POST['email'];
	$data['address']		= $_POST['address'];
	$data['country']		= $_POST['country'];
	$data['city']	 		= $_POST['city'];
	$data['state']	 		= $_POST['state'];
	$data['zipCode']	 	= $_POST['zipCode'];
	$data['name_on_card']	= $_POST['name_on_card'];
	$data['ccnum']			= $_POST['ccNo'];
	$data['expmonth']		= $_POST['expMonth'];
	$data['expyear']	 	= $_POST['expYear'];
	$data['cvv']	 		= $_POST['cvv'];
	$token	 				= $_POST['token'];

	$two_c_api	= new TwoCheckoutApi();
	$response	= $two_c_api->createCharge($data, $token);
	
	echo '<pre>';
	print_r($response);
	echo '</pre>';
	//echo 'token: '.$token;
}
/* 
-------------------------------------------------------------------------------- 
| NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
 -------------------------------------------------------------------------------- 
*/ 
 
/* 
-------------------------------------------------------------------------------- 
| NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
 -------------------------------------------------------------------------------- 
*/ 
$product_id = $_GET['product_id'];

$results = $db->query("SELECT * FROM product WHERE product_id = ".$product_id); 
$row = $results->fetch_array();

$product_name = $row['name'];
$product_price = $row['price'];
$image = $row['image'];

/* 
-------------------------------------------------------------------------------- 
| NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
 -------------------------------------------------------------------------------- 
*/ 

?>

<!-- container --> 
  <section class="showcase">
    <div class="container">
      <div class="pb-2 mt-4 mb-2 border-bottom">
        <h2><?php echo TITLE;?>  - Checkout</h2>
      </div>      
      <span id="success-msg" class="payment-errors"></span>   
      
<div class=" container-fluid my-5 ">
    <div class="row justify-content-center ">
        <div class="col-xl-10">
            <div class="card shadow-lg ">
                <div class="row justify-content-around">
                    <div class="col-md-7">
                        <div class="card border-0">
                            <div class="card-header pb-0">
                                <h2 class="card-title space ">Checkout</h2>
                                <p class="card-text text-muted mt-4 space">PAYMENT DETAILS</p>
                                <hr class="my-0">
                            </div>
                            <div class="card-body">
							
    <!-- ----------------------------------------------------------------------------------------- -->
	<!-- payment form -->
    <!-- ----------------------------------------------------------------------------------------- -->
	<form action="<?php echo BASE_URL.'checkout.php?product_id='.$product_id;?>" method="POST" id="myCCForm">
		
		<input id="token" name="token" type="hidden" value="">
		<input type="hidden" name="product_id" value="<?php echo $product_id;?>">


		<div class="row"> 
		<div class="col-sm-6">
		<div class="form-group"> 
		<label for="name_on_card" class="small text-muted mb-1">Name on Card</label> 
		<input type="text" name="name_on_card" id="name_on_card" value="Jenny Doe" class="form-control form-control-sm" > 
		</div>
		</div>
		<div class="col-sm-6">
		<div class="form-group"> 
		<label for="ccNo" class="small text-muted mb-1">Credit Card Number</label> 
		<input type="text" name="ccNo" id="ccNo" value="4111111111111111" class="form-control form-control-sm" > 
		</div>
		</div>
		</div>
		
		<div class="row"> 
		<div class="col-sm-4">
		<div class="form-group"> 
		<label for="expMonth" class="small text-muted mb-1">Exp Month</label> 
		<input type="text" name="expMonth" id="expMonth" value="12" class="form-control form-control-sm" > 
		</div>
		</div>
		
		<div class="col-sm-4">
		<div class="form-group"> 
		<label for="expYear" class="small text-muted mb-1">Exp Year</label> 
		<input type="text" name="expYear" id="expYear" value="2021" class="form-control form-control-sm" > 
		</div>
		</div>
		<div class="col-sm-4">
		<div class="form-group"> 
		<label for="cvv" class="small text-muted mb-1">CVV</label> 
		<input type="text" name="cvv" id="cvv" value="123" class="form-control form-control-sm" > 
		</div>
		</div>
		</div>
		
		<hr>
		<div class="row"> 
		<div class="col-sm-6">
		<div class="form-group"> 
		<label for="fullname" class="small text-muted mb-1"><i class="fa fa-user"></i> Full Name</label> 
		<input type="text" name="fullname" id="fullname" value="Jenny Doe" class="form-control form-control-sm" > 
		</div>
		</div>
		
		<div class="col-sm-6">
		<div class="form-group"> 
		<label for="email" class="small text-muted mb-1"><i class="fa fa-envelope"></i> Email</label> 
		<input type="text" name="email" id="email" value="abc@gmail.com" class="form-control form-control-sm" > 
		</div>
		</div>
		</div>
		
		<div class="row"> 
		<div class="col-sm-6">
		<div class="form-group"> 
		<label for="address" class="small text-muted mb-1"><i class="fa fa-address-card-o"></i> Address</label> 
		<input type="text" name="address" id="address" value="house no 245 street no 8 Lahore" class="form-control form-control-sm" > 
		</div>
		</div>
		
		<div class="col-sm-6">
		<div class="form-group"> 
		<label for="country" class="small text-muted mb-1"><i class="fa fa-address-card-o"></i> Country</label> 
		<input type="text" name="country" id="country" value="Pakistan" class="form-control form-control-sm" > 
		</div>
		</div>
		</div>
		
		<div class="row"> 
		<div class="col-sm-4">
		<div class="form-group"> 
		<label for="city" class="small text-muted mb-1"><i class="fa fa-institution"></i> City</label> 
		<input type="text" name="city" id="city" value="Lahore" class="form-control form-control-sm" > 
		</div>
		</div>
		
		<div class="col-sm-4">
		<div class="form-group"> 
		<label for="state" class="small text-muted mb-1">State</label> 
		<input type="text" name="state" id="state" value="punjab" class="form-control form-control-sm" > 
		</div>
		</div>
		
		<div class="col-sm-4">
		<div class="form-group"> 
		<label for="state" class="small text-muted mb-1">Zip Code</label> 
		<input type="text" name="zipCode" id="zipCode" value="54000" class="form-control form-control-sm" > 
		</div>
		</div>
		</div>
		
		<div class="row mb-md-5">
			<div class="col"> 
			<button type="submit" name="" id="" class="btn btn-lg btn-block btn-primary">PURCHASE <?php echo $product_price;?> PKR</button></div>
		</div>
    </form>
	<!-- ----------------------------------------------------------------------------------------- -->
	<!-- ./payment form -->
	<!-- ----------------------------------------------------------------------------------------- -->

							</div>
                        </div>
                    </div>
					
					
                    <!-- Cart -->
					<div class="col-md-5">
                        <div class="card border-0 ">
                            <div class="card-header pb-0">
                                <h2 class="card-title space ">Cart</h2>
                                <p class="card-text text-muted mt-4 space">YOUR ORDER</p>
                                <hr class="my-0">
                            </div>
							
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-auto col-md-7">
                                        <div class="media flex-column flex-sm-row"> 
										<img class=" img-fluid" src="<?php echo BASE_URL.$image;?>" width="62" height="62">
                                            <div class="media-body my-auto">
                                                <div class="row ">
                                                    <div class="col-auto">
                                                        <p class="mb-0"><?php echo $product_name;?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" pl-0 flex-sm-col col-auto my-auto">
                                        <p class="boxed-1">1</p>
                                    </div>
                                    <div class=" pl-0 flex-sm-col col-auto my-auto ">
                                        <p><?php echo $product_price;?> PKR</p>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="row ">
                                    <div class="col">
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                                <p class="mb-1"><b>Subtotal</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1"><b><?php echo $product_price;?> PKR</b></p>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col">
                                                <p class="mb-1">Shipping</p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1">0 PKR</p>
                                            </div>
                                        </div>
										<hr class="my-2">
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                                <p><b>Total</b></p>
                                            </div>
                                            <div class="flex-sm-col col-auto">
                                                <p class="mb-1"><b><?php echo $product_price;?> PKR</b></p>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<!-- ./Cart -->
					
                </div>
            </div>
        </div>
    </div>
   
</div>

   
	</div>
  </section>

<?php include("include/footer.php"); ?>