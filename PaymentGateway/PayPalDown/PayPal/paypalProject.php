<!DOCTYPE html>
<html lang="en">
<head>

	<title>Paypal Address</title>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php include('include/config.php');

	include('scripts.php');

	include_once("class/Orders.php");

	$obj_orders = new Orders();

	include_once("class/OrderDetail.php");

	$obj_order_detail = new OrderDetail();

	include_once("class/UserDetail.php");

	$obj_user_detail = new UserDetail();

	if(isset($_POST['checkoutaddress']))	
	{ 

		$codes = $_POST['code'];

		$qtys = $_POST['qty'];

		$price_options = $_POST['price_option'];

		//$prices = $_POST['price'];
		$prices = 1.00;

		$obj_orders->fname = $_SESSION['name'];

		$obj_orders->user_id = $_SESSION['userid'];

		//$obj_orders->total_amount = $_POST['total_amount'];
		$obj_orders->total_amount = 1;

		$total_amount = number_format(1,2);;

		$obj_orders->currency = $currency;

		$obj_orders->payment_type = 'paypal';

		$obj_orders->payment_status = 'Pending';

		$requestNvp = array(

		'USER' => $paypalusername,

		'PWD' => $paypalpassword,

		'SIGNATURE' => $paypalsignature,

	

		'VERSION' => '93',

		'METHOD'=> 'SetExpressCheckout',

	

		'PAYMENTREQUEST_0_CURRENCYCODE' => $currency,

		'PAYMENTREQUEST_0_AMT' => $total_amount,

		'PAYMENTREQUEST_0_ITEMAMT' => $total_amount,

		'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',

		'PAYMENTREQUEST_0_DESC' => 'Report',

		'PAYMENTREQUEST_0_SELLERPAYPALACCOUNTID' => $paypalemail,

		'PAYMENTREQUEST_0_PAYMENTREQUESTID' => 'VID-PAYMENT0',

	

		'L_PAYMENTREQUEST_0_NAME0' => 'Report Purchase',

		'L_PAYMENTREQUEST_0_NUMBER0' => 'SS-101',

		'L_PAYMENTREQUEST_0_QTY0' => '1',

		'L_PAYMENTREQUEST_0_AMT0' => $total_amount,

	

		'RETURNURL' => $paypalsuccessurl,

		'CANCELURL' => $paypalcancelurl,

		'BUTTONSOURCE' => 'BR_EC_EMPRESA'

	);

	

	$curl = curl_init();

	

	curl_setopt_array($curl, array(

	  CURLOPT_URL => "https://www.sandbox.paypal.com/cgi-bin/webscr",

	  CURLOPT_RETURNTRANSFER => true,

	  CURLOPT_ENCODING => "",

	  CURLOPT_MAXREDIRS => 10,

	  CURLOPT_TIMEOUT => 30,

	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

	  CURLOPT_CUSTOMREQUEST => "POST",

	  CURLOPT_POSTFIELDS =>  http_build_query($requestNvp),

	));

	//echo "<pre>";

	//print_r($requestNvp);exit;

	$response = (curl_exec($curl));

	

	$responseNvp = array();

	if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches))

	{

	 foreach ($matches['name'] as $offset => $name)

	 {

	   $responseNvp[$name] = $matches['value'][$offset];

	  }

	}

	//echo "<pre>";

	//print_r($responseNvp);exit;

		if (isset($responseNvp['ACK']) && $responseNvp['ACK'] == 'Success')

		{

			session_start();

			$_SESSION['currency'] = $currency;	

			$_SESSION['total_amount'] = $total_amount;	

		  $token = $responseNvp['TOKEN'];

 		  $order_id = $obj_orders->insert();

		  $_SESSION['order_id'] = $order_id;	

		  $obj_order_detail->order_id =  $order_id;

		  $i=0;

		  foreach($codes as $code)

		  {

			$obj_order_detail->item_id = $code;

			$obj_order_detail->qty = $qtys[$i];

			$obj_order_detail->amount = $prices[$i];

			$obj_order_detail->price_option = $price_options[$i];	

			$obj_order_detail->status = 1;	

			$obj_order_detail->insert();

			$i++;

		  }

		  $url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$token;
			?>
            <script>
			    window.location.href = "<?php echo  $url;?>";
			</script>
            <?php
			exit();
		 // header('location:'.$url);exit;

		  /*for ($i = 0; isset($responseNvp['L_ERRORCODE' . $i]); ++$i)

		  {

			$message = sprintf("PayPal NVP %s[%d]: %s\n",

			$responseNvp['L_SEVERITYCODE' . $i],

			$responseNvp['L_ERRORCODE' . $i],

			$responseNvp['L_LONGMESSAGE' . $i]);

		  }*/

		}

		else

		{

			$msg = "There is some problem to connect paypal";

		}

		//echo "<pre>";

		//print_r($responseNvp);exit;

		

		



		}

?>

</head>

<body class="animsition">

	<!-- Header -->

	<?php include('header.php'); ?>

	<!-- Title Page -->

		<section class="p-t-66 p-b-38" >
		<div class="container" >
			<div class="bredcrum fa fa-home">
        	<a href="<?php echo SITE_PATH;?>"> Home</a> <span class="pipe">/</span> <span class="bredspan">Cart</span>
        </div>	<div class="row">
				

				<div class="inner-page p-b-30" style="height:auto;">
				
<div class="rc_innertheight">
<h2 class="inner-title">Paypal Checkout</h2>


<div class="rc_innerunhlink"><a href="<?php echo SITE_PATH;?>/about-us.php" class="innerlink">About Researchica</a> <span class="rc_innerpagepipe">|</span> <a href="<?php echo SITE_PATH;?>/publisher-index.php" class="innerlink">Our Publishers</a> <span class="rc_innerpagepipe">|</span> <a href="<?php echo SITE_PATH;?>/investors.php" class="innerlink">Our Team</a> <span class="rc_innerpagepipe">|</span> <a href="<?php echo SITE_PATH;?>/investors.php" class="innerlink">Investor Relations</a> <span class="rc_innerpagepipe">|</span> <a href="<?php echo SITE_PATH;?>/career.php" class="innerlink">Careers</a> <span class="rc_innerpagepipe">|</span> <a href="<?php echo SITE_PATH;?>/contact.php" class="innerlink">Contact Us</a></div><span ></span></div>
					<p class="p-b-28 rc_aboutmain" style="height:auto;">

					 <form class="leave-comment" method="post" name="address"><form name="cart" method="post">



	

	<section class="cart">


		<div class="container">




			<!-- Cart item -->



			<?php $totalcartitem =  count($_SESSION["products"]);

			if($msg != '')

			{

				echo $msg;

			}

			//echo "<pre>"; print_r($_SESSION["products"]);



			?>



			<div class="container-table-cart pos-relative">



				<div class="wrap-table-shopping-cart bgwhite">



					<?php 



					if($totalcartitem > 0 )



					{



					?>



					<table class="table-shopping-cart">



						<tr class="table-head" style="border-bottom: 1px solid #e6e6e6;">



							<th class="column-1">Product</th>



						
							<th class="column-4 p-l-70" style="    padding-left: 93px;">Quantity</th>



							<th class="column-5">Total</th>




						</tr>




					<?php 



					$totalprice = '';



					foreach($_SESSION['products'] as $proid => $proq) { 


					$totalprice = ( $proq['qty'] * $proq['price']) + $totalprice;




					?>


						<tr class="table-row">




							<td class="column-1"><input type="hidden" name="code[]" value="<?php echo $proq['code'] ?>"><?php echo $proq['name'] ?>
							
							<br/>
							<div class="rc_cartlicense"> <?php echo $reports[0]->research_type; ?> <span class="pipe">|</span>
                            <input type="hidden"   name="price_option[]" value="<?php echo $proq['price_option'] ?>"><?php echo $proq['price_option'] ?> <span class="pipe">|</span> 
                            <input type="hidden" class="rc_cartlprice" name="price[]" value="<?php echo $proq['price'] ?>" id="price_<?php echo $i;?>">$<?php echo $proq['price'] ?>  </div>	
							<br/>
							<div class="rc_cartdelivery">Delivery: <?php echo $reports[0]->delivery; ?></div></td>



							

							<td class="column-4">


								<div class="flex-w bo5 of-hidden w-size17" style="margin-left: 100px;">


									<!--<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">


										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>



									</button>-->




									<input class="size8 m-text18 t-center num-product" type="number" name="qty[]" value="<?php echo $proq['qty']; ?>">



									<!--<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">







										<i class="fs-12 fa fa-plus" aria-hidden="true"></i>


									</button>-->



								</div>




							</td>



							<td class="column-5" style="float: right;
text-align: right;
margin-right: -1px;
margin-top: 31px;">$<?php $total =   $proq['qty'] * $proq['price'];



									echo  $total;



									?></td>







						</tr>



					<?php  



					}   //------ foreach end-------   ?>



						



					</table>



					<?php }



					 



					?>

				</div>




			</div>


			<!-- Total -->



			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">


				<h5 class="m-text20 p-b-24">



			
				</h5>



				<!--  -->


				<div class="flex-w flex-sb-m p-b-12">


					<span class="s-text18 w-size19 w-full-sm" style="padding-left: 33px;">



						SUBTOTAL:



					</span>




					<span class="m-text21 w-size20 w-full-sm" style="float: right;
text-align: right;
margin-right: -13px;">

						$<?php echo $totalprice;?>



					</span>


				</div>
<div class="flex-w flex-sb-m p-b-12">

					<span class="s-text18 w-size19 w-full-sm rc_cartsubtext">

						DELIVERY:

					</span>



				<div class="rc_cartdelpricer">	<span class="m-text21 w-size20 w-full-sm rc_cartdprice" >

						$0.00

					</span></div>

				</div>

<div class="rc_carttborderpaypal"></div>

				<div class="flex-w flex-sb-m p-t-26 p-b-30">



					<span class="m-text22 w-size19 w-full-sm" style="padding-left: 72px;">



					TOTAL:

					</span>




					<span class="m-text21 w-size20 w-full-sm" style="float: right;
text-align: right;
margin-right: -13px; font-size: 15px;">


						$<?php echo $totalprice;?>



						<input type="hidden" name="total_amount" value="<?php echo $totalprice;?>">



					</span>


				</div>
<div class="rc_cartgtborder"></div>


			</div>




		</div>


	</section>
<div class="rc_cartimagesp"><img src="images/p1.png" style="width:200px;"></div>
				<div class="size15 trans-0-4">


					<!-- Button -->


				<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" name="checkoutaddress" value="checkoutaddress" style="width: 278px;
margin-left: 665px;
margin-top: -74px;
font-family: 'Arial';
font-size: 14px;
font-weight: normal;
padding-left: 30px;
padding-right: 30px;
border-radius: 5px;
background-color: #1AA6E1;">



						Proceed to checkout&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>


					</button>


				</div>



</form>
					</p>

					
				</div>
			</div>
		</div>
	</section>
	<!-- Footer -->



<?php include('footer.php');?>



</body>







</html>



