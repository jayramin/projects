<?php
include 'top_header.php';

$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='jay.amin.business@test.com'; // Business email ID and pass: 
// jay.amin.client@test.com //clint id //pwd is jayramin

// ehco ""
error_reporting(0);
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
  case "add":
    if(!empty($_POST["quantity"])) {
      $id=$_GET["code"];
      $sq="SELECT * FROM product_details_tbl WHERE prod_id=$id";
      $res=$con->query($sq);
      $productByCode=$res->fetch_object();

      $total_quantity=0;
      $total_quantity += $item["quantity"];

      $itemArray = array($productByCode->prod_id=>array('name'=>$productByCode->prod_name,'code'=>$productByCode->prod_id,'quantity'=>$_POST["quantity"], 'price'=>$productByCode->bprice,'image'=>$productByCode->img_path));
      //print_r($itemArray);die;
       if(!empty($_SESSION["cart_item"])) {
        if(in_array($productByCode->prod_id,array_keys($_SESSION["cart_item"]))) {
          foreach($_SESSION["cart_item"] as $k => $v) {
              if($productByCode->prod_id == $k) {
                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                  $_SESSION["cart_item"][$k]["quantity"] = 0;
                }
                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
              }
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }
  break;
  case "remove":
    if(!empty($_SESSION["cart_item"])) {
      foreach($_SESSION["cart_item"] as $k => $v) {
          if($_GET["code"] == $k)
            unset($_SESSION["cart_item"][$k]);        
          if(empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
      }
    }
  break;
  case "empty":
    echo "empty";
    unset($_SESSION["cart_item"]);
    header('location:cart.php');
  break;  
}
}
?>
        <!--breadcrumbs area start-->
	    <div class="breadcrumbs_area contact_bread">
	        <div class="container">
	            <div class="row">
	                <div class="col-12">
	                    <div class="breadcrumb_content">
	                        <div class="breadcrumb_header">
	                            <a href="index.html"><i class="fa fa-home"></i></a>
	                            <span><i class="fa fa-angle-right"></i></span>
	                            <span> Shopping Cart</span>
	                        </div>
	                        <div class="breadcrumb_title">
	                            <h2>Shopping Cart</h2>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
		<!--breadcrumbs area end-->
       
        <!--shopping cart area start -->
        <!--shopping cart area end -->
        <div class="shopping_cart_details">
            <div class="container"> 
                    <div class="row">
                        <div class="col-12">
                           <div class="table_cart_button">
                                     <form action="cart.php?action=empty" method="POST">
                                      <button type="submit">Empty cart</button>
                                     </form>
                                </div>
                            <div class="table_desc">
                                <div class="cart_page table-responsive">
                                       
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product_remove">Delete</th>
                                                    <th class="product_thumb">Image</th>
                                                    <th class="product_name">Product</th>
                                                    <th class="product-price">Price</th>
                                                    <th class="product_quantity">Quantity</th>
                                                    <th class="product_total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
  <?php
  $total_quantity=0;
  $total_price=0;     
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
        
     
    ?>
                                                <tr>
                                                   <td class="product_remove"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>"><i class="fa fa-trash-o"></i></a></td>
                                                    <td class="product_thumb"><a href="#"><img src="admin/<?php echo $item["image"];?>" alt="" style="height:80px;"></a></td>
                                                    <td class="product_name"><a href="#"><?php echo $item["name"]; ?></a></td>
                                                    <td class="product-price"><?php echo $item["price"]; ?></td>
                                                    <td class="product_quantity"><input min="0" max="100" value="<?php echo $item["quantity"]; ?>" type="number"></td>
                                                    <td class="product_total">Rs.<?php echo "$item_price";?></td>
                                                </tr>
                                      <?php
        $total_price += ($item["price"]*$item["quantity"]);
        $total_quantity += $item["quantity"];
    }
    ?>

                                            </tbody>
                                        </table>  
                                    </div>  
                                <div class="table_cart_button">
                                     
                                    <button type="submit">update cart</button>
                                </div>
                                
                              
                            </div>
                         </div>
                     </div>
                     <!--coupon code area start-->
                    <div class="coupon_code_area">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code coupon">
                                    <h3>Coupon</h3>
                                    <div class="coupon_code_inner">
                                        <p>Enter your coupon code if you have one.</p>                                
                                           <input placeholder="Coupon code" type="text">
                                           <button type="submit">Apply coupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="coupon_code">
                                    <h3>Cart Totals</h3>
                                    <div class="cart_total_amount">
                                       <div class="cart_subtotal">
                                           <p class="subtotal">Total Product Quantity</p>
                                           <p class="cart_amount"><?php echo $total_quantity;?></p>
                                       </div>
                                       <div class="cart_subtotal">
                                           <p class="subtotal">Subtotal</p>
                                           <p class="cart_amount">Rs.<?php echo $total_price;?></p>
                                       </div>
                                       <div class="flat_rate ">
                                           <div class="shipping_flat_rate">
                                               <p class="subtotal">Shipping</p>
                                               <p class="cart_amount"><span>Flat Rate:</span>Rs.00.00</p>
                                           </div>
                                           <a href="#">Calculate shipping</a>
                                       </div>

                                       <div class="cart_subtotal order">
                                           <p class="order_total">Total</p>
                                           <p class="order_amount">Rs.<?php echo $total_price;?></p>
                                       </div>
                                       <div class="cart_to_checkout">
                  <form action="<?php echo $paypal_url; ?>" method="post" name="frmPayPal1">
                  <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
                  <input type="hidden" name="cmd" value="_xclick">
                  <input type="hidden" name="item_name" value="TOPS">
                  <input type="hidden" name="item_number" value="1">
                  <input type="hidden" name="credits" value="1000">
                  <input type="hidden" name="userid" value="1">
                  <input type="hidden" name="amount" value="<?php echo $total_price;?>">
                  <input type="hidden" name="no_shipping" value="1">
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="hidden" name="handling" value="0">
                  <input type="hidden" name="cancel_return" value="cancel.php">
                  <input type="hidden" name="return" value="success.php">
                  <input type="submit" name="submit" value="Pay Now" class="btn btn-success">
                  <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form> 
                                           <!-- <a href="https://www.sandbox.paypal.com/webapps/hermes?token=2GG581543T912644A&useraction=commit&mfid=1551762646252_f105a13e1f853">

                                           Proceed to Checkout</a> -->
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--coupon code area end-->
             </div>
         </div>
        <!-- accont area end -->
 <?php
include 'footer.php';
 ?>