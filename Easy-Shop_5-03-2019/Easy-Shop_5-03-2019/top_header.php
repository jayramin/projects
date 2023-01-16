<?php
session_start();
include 'conn.php';



// echo "<pre>";
// print_r(count($_SESSION['cart_item']));
// exit;
if(isset($_REQUEST['search_btn']))
{
    $nm=$_REQUEST['pnm'];
    $catid=$_REQUEST['cat'];

    $sel="select * from product_details_tbl where 
    ((prod_desc LIKE '%$nm%') OR (prod_name LIKE '%$nm%')) AND (cat_id=$catid)";
    $res=$con->query($sel);
    while($prod_res=$res->fetch_object())
    {
        $arr[]=$prod_res;
    }
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>:: EasyShop </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- all css here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/bundle.css">
        <link rel="stylesheet" href="assets/css/plugins.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    
         <script
    src="https://www.paypal.com/sdk/js?client-id=SB_CLIENT_ID">
  </script>
  <script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // Set up the transaction
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '0.01'
          }
        }]
      });
    }
  }).render('#paypal-button-container');
</script>
    </head>
    <body>
            <!-- Add your site or application content here -->
         <!--header area start-->
        <div class="header_area">
           
            <!--header top start-->
            <div class="header_top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="top_left_sidebar">
                                <div class="contact_link">
                                    <span>Call us toll free : <strong>(+1)866-540-3229</strong></span>
                                </div>
                                <div class="switcher">
                                    <ul>
                                        <li class="currency"><a href="#">Currency : <strong>Indian</strong><i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown_currency">
                                                <li class="select"><a href="#" title="Dollar (USD)">Indian (Rs.)</a></li>
                                            </ul>
                                        </li>
                                        <li class="languages"><a href="#"><img src="assets/img/logo/lion.jpg" alt=""> English <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown_languages">
                                                <li class="select"><img src="assets/img/logo/lion.jpg" alt=""> English</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="header_right_info text-right">
                                <ul>
                                    <li class="link_checkout"><a href="cart.php"><i class="fa fa-check" aria-hidden="true"></i> View Cart</a></li>
                                    <li class="link_checkout"><a href="checkout.php"><i class="fa fa-check" aria-hidden="true"></i> checkout </a></li>
                                    <li class="link_checkout"><a href="wishlist.php"><i class="fa fa-check" aria-hidden="true"></i>Wishlist</a></li>
                                    <?php
                                    if(isset($_SESSION['user']))
                                    {
                                    ?>
                                    <li class="my_account"><a href="myaccount.php"><i class="fa fa-user" aria-hidden="true"></i> My account</a></li>
                                    <li class="my_account"><a href="logout.php"><i class="fa fa-user" aria-hidden="true"></i>Logout</a></li>
                                    
                                    <?php
                                    }
                                    else
                                    {
                                     ?>
                                    
                                    <li class="log_in"><a href="login.php"><i class="fa fa-lock" aria-hidden="true"></i> Log in  </a></li>
                                    <?php   
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--header middel-->
            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <div class="logo">
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="search_form">
                                <form action="search_product.php" method="POST">
                                    <input placeholder="Enter your search..." type="text" name="pnm">
                                    <div class="select_categories">
                                        <select name="cat" id="categorie">
                                            <option selected value="1">All Categories</option>
                                            
                                            <?php
                                            $sel="select * from category_details_tbl";
                                            $res=$con->query($sel);
                                            while($ft=$res->fetch_object())
                                            { 
                                            ?>
                                            <option value="<?php echo $ft->cat_id;?>"><?php echo $ft->cat_name;?></option>
                                        <?php    
                                        }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="search_btn"><i class="fa fa-search" aria-hidden="true"></i></button>

                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="header_widget about_widget text-right">

                                <ul>
                                    <li class="shopping_cart"><a href="cart.php" title="View my shopping cart"><i class="fa fa-shopping-bag"></i></a> 
                                        <span class="cart__quantity"><?php if (isset($_SESSION['cart_item']) && count($_SESSION['cart_item']) > 0 ) {
                                            # code...
                                            echo count($_SESSION['cart_item']);
                                        }else{
                                            echo 0;
                                        }  ?></span>
                                                                                                                                                                                                   
                                    </li>
                                    <li><a href="wishlist.php" title="My wishlist"><i class="fa fa-heart-o"></i></a></li>
                                    <li><a href="#" title="My Compare"><i class="fa fa-exchange"></i></a></li>
                                </ul>
                                <!--mini cart-->
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> 
            <!--header bottom start--> 
            <div class="header_bottom sticky-header">
               <div class="container">
                   <div class="row">
                       <div class="col-12">
                           <div class="main_menu_inner">
                                <div class="main_menu d-none d-lg-block">
                                    <nav>
                                        <ul>
                                            <li class="active"><a href="index.php">Home <i class="fa fa-angle"></i></a>
                                            </li>
                                            <li class="dropdown_item"><a href="shop.html">Offers<i class="fa fa-angle-down"></i></a>
                                                <ul class="sub_menu">
                                                    <li><a href="shop-list.html">Daily Deals</a></li>
                                                    <li><a href="shop-fullwidth.html">No Cost EMI</a></li>
                                                    <li><a href="shop-fullwidth-list.html">Pay Later Offers</a></li>
                                                    <li><a href="shop-right-sidebar.html">50% Off on All Products</a></li>
                                                    
                                                </ul>
                                            </li>
                                            <li class="dropdown_item"><a href="blog.html">Blogs<i class="fa fa-angle-down"></i></a>
                                                <ul class="sub_menu">
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="blog-fullwidth.html">Blog FullWidth</a></li>
                                                    <li><a href="blog-sidebar.html">Blog  Sidebar</a></li>
                                                    <li><a href="blog-details.html">Blog  Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="about.php">About Us</a></li>
                                            <li><a href="contact.php">Contact Us</a></li>
                                            <li class="mega_item"><a href="#">All Menu<i class="fa fa-angle-down"></i></a>
                                                <ul class="sub_menu">
                                    <?php
                                    $cat="select * from category_details_tbl";
                                    $res_cat=$con->query($cat);
                                    while($val=$res_cat->fetch_object())
                                    { 
                                    ?>                                                
                                        <li><a href="#"><?php echo $val->cat_name;?></a></li>
                                    <?php
                                    }
                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                
                                <div class="mobile-menu portfolio_mobail about d-lg-none">
                                    <nav>
                                         <ul>
                                            <li>
                                               <a href="index.html">Home</a>
                                                <ul>
                                                    <li><a href="index.html">home shop 1</a></li>
                                                    <li><a href="index-2.html">home shop 2</a></li>
                                                    <li><a href="index-3.html">home shop 3</a></li>
                                                    <li><a href="index-4.html">home shop 4</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="shop.html">Shop</a>
                                                <ul>
                                                    <li><a href="shop-list.html">shop list</a></li>
                                                    <li><a href="shop-fullwidth.html">shop Full Width Grid</a></li>
                                                    <li><a href="shop-fullwidth-list.html">shop Full Width list</a></li>
                                                    <li><a href="shop-right-sidebar.html">shop Right Sidebar</a></li>
                                                    <li><a href="shop-right-sidebar-list.html">shop list Right Sidebar</a></li>
                                                    <li><a href="single-product.html">Product Details</a></li>
                                                    <li><a href="single-product-video.html">Product Details Video</a></li>
                                                    <li><a href="single-product-gallery.html">Product Details Gallery</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="portfolio.html">Portfolio</a>
                                                <ul>
                                                    <li><a href="portfolio.html">Portfolio</a></li>
                                                    <li><a href="portfolio-details.html">single portfolio</a> </li>
                                                </ul>
                                            </li>
                                            <li><a href="blog.html">Blog</a>
                                                <ul>
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="blog-fullwidth.html">Blog FullWidth</a></li>
                                                    <li><a href="blog-sidebar.html">Blog  Sidebar</a></li>
                                                    <li><a href="blog-details.html">Blog  Details</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="about.html">About Us</a></li>

                                            <li><a href="contact.html">Contact Us</a></li>
                                            <li><a href="#">Features</a>
                                                <ul>
                                                    <li><a href="#">Column1</a>
                                                        <ul>
                                                            <li><a href="shop.html">Shop </a></li>
                                                            <li><a href="single-product.html">Product Details</a></li>
                                                            <li><a href="cart.html">Cart </a></li>
                                                            <li><a href="checkout.html">Checkout </a></li>
                                                            <li><a href="wishlist.html">Wishlist</a></li>
                                                            <li><a href="my-account.html">My account</a></li>
                                                            <li><a href="login.html">Login</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Column2</a>
                                                        <ul>
                                                            <li><a href="blog.html">blog</a></li>
                                                            <li><a href="blog-fullwidth.html">blog full width</a></li>
                                                            <li><a href="blog-sidebar.html">blog  Sidebar </a></li>
                                                            <li><a href="blog-details.html">blog details</a></li>
                                                            <li><a href="404.html">404</a></li>
                                                            <li><a href="faq.html">Frequently Questions</a></li>
                                                            <li><a href="services.html">Service</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Column3</a>
                                                        <ul>
                                                            <li><a href="about.html">About Us</a></li>
                                                            <li><a href="about-2.html">About Us 2</a></li>
                                                            <li><a href="contact.html">Contact</a></li>
                                                            <li><a href="contact-2.html">Contact us 2</a></li>
                                                            <li><a href="portfolio.html">Portfolio</a></li>
                                                            <li><a href="portfolio-details.html">Portfolio Details</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                       </div>
                   </div>
               </div> 
            </div>  
        </div>
         <!--header area end-->


         <!-- <script type="text/javascript">
                // alert(window.location.href.indexOf('reload'));
                // window.location.href=window.location.href+'&reaload';
                var url_string = window.location.href; //window.location.href
                var url = new URL(url_string);
                var c = url.searchParams.get("reaload");
                console.log(c);
                alert(url);
                // if(typeof() != "undefined" && variable !== null) {
                //     alert("called");
                // }else{
                //     alert("else");

                // }

             $( window ).load(function() {
                if (window.location.href.indexOf('reload')==-1) {
                     window.location.replace(window.location.href+'?reload');
                }
            });
            // if (window.location.href.indexOf('reload')==-1) {
            //      window.location.replace(window.location.href+'?reload');
            // }
         </script> -->