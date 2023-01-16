<?php require_once 'Header.php';

//$data = $fn->getDataByID("b_bookmaster", "BookID",@$_REQUEST['BookID']);
$BookList = $fn->GetAllBookData('{"BookID":'.$_REQUEST['BookID'].'}');
//$BookQuantityList = $fn->GetBookQuantityData('{"BookID":'.$_REQUEST['BookID'].'}');
$data = $BookList['GetBookWiseData'];
//echo "<pre>";
//print_r($data);
$QuantityList = $fn->GetBookQuantityData('{"BookID":'.$_REQUEST['BookID'].'}');
//echo "<pre>";
//print_r($QuantityList['GetBookQuantityWiseData']);
?>

        
        <div class="column_center">
            <div class="container">
                <div class="search">
                    <div class="stay">Search Product</div>
                    <div class="stay_right">
                        <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {
                              this.value = '';
                          }">
                        <input type="submit" value="">
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="main">
            <div class="content_top">
                <div class="container">
                    <div class="col-md-3 sidebar_box">
                        <?php 
                        require_once 'SideMenu.php';
                        ?>
                    </div> 
                    <div class="col-md-9 content_right">
                    
                        <div class="single_top">
                            <div class="single_grid">
                                <div class="grid images_3_of_2">
                                    <ul id="etalage">
                                        <li>
                                            <a href="optionallink.html">
                                                <img class="etalage_thumb_image" src="admin/uploads/BookImage/<?php echo $data['BookImage']; ?>" class="img-responsive" />
                                                <img class="etalage_source_image" src="admin/uploads/BookImage/<?php echo $data['BookImage']; ?>" class="img-responsive" title="" />
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>		
                                </div> 
                                <div class="desc1 span_3_of_2">
                                    <h1><?php echo $data['BookTitle']; 
//                                    echo "<pre>";
//                                    print_r( $data);
                                    
                                    ?> </h1>
                                    <p class="availability">Availability: <span class="color">In stock</span></p>
                                    <div class="price_single">
                                        <span class="reducedfrom"><?php echo $data['BookMRP']; ?> &#8377;</span>
                                        <span class="actual"><?php echo $data['BookPrice']; ?> &#8377;</span>
                                        <!--<a href="#">click for offer</a>-->
                                    </div>
                                    <h2 class="quick">Quick Overview:</h2>
                                    <p class="quick_desc"><?php echo $data['BookDescription']?></p>
                                    <p ><b>Author Name :</b> <?php echo $data['BookAutherName']?></p>
                                    <p ><b>Edition : </b><?php echo $data['BookCode']?></p>
                                    <p ><b>Publisher : </b><?php echo $data['BookPublisher']?></p>
                                    <div class="quantity_box">
                                        <ul class="product-qty">
                                            <span>Quantity:</span>
                                            <?php 
                                            
//                                            if($QuantityList['GetBookQuantityWiseData']['DisplayQuantity'] > 0){ ?>
                                            <input type="number" min="1" name="Quantity" id="Quantity" value="1" max="<?php echo $QuantityList['GetBookQuantityWiseData']['DisplayQuantity']?>">  
                                            <!--<label style="color: green"><?php echo $QuantityList['GetBookQuantityWiseData']['DisplayQuantity']?> available</label>-->
<!--                                            <select name="Quantity" id="Quantity">
                                                <?php for($i = 1; $i<=$QuantityList['GetBookQuantityWiseData']['DisplayQuantity'] ;$i++){ ?>
                                                <option value="<?php echo $i?>"><?php echo $i;?></option>
                                                <?php }?>
                                            </select>-->    
                                            <?php // }
//                                            else{ 
//                                                if($QuantityList['GetBookQuantityWiseData']['DisplayQuantity'] == "" ){ ?>
                                                
                                            <!--<input type="number" name="Quantity" id="Quantity" min="1" value="1" max="//<?php echo $QuantityList['GetBookQuantityWiseData']['Quantity']?>">  <label style="color: green"><?php echo $QuantityList['GetBookQuantityWiseData']['Quantity']?> available</label>-->
                                           <?php 
                                           
//                                                }else{ ?>
                                            <!--<label style="color: red">Out of Stock</label>-->
                                            <?php //}
//                                            } ?>
                                            
                                        </ul>
                                        <ul class="single_social">
                                            <li><a href="#"><i class="fb1"> </i> </a></li>
                                            <li><a href="#"><i class="tw1"> </i> </a></li>
                                            <li><a href="#"><i class="g1"> </i> </a></li>
                                            <li><a href="#"><i class="linked"> </i> </a></li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <label class="btn bt1 btn-primary btn-normal btn-inline " onclick="AddToCart('<?php echo $data['BookID']?>')"> Add to cart</label>
                                    <input type="hidden" value="<?php echo $_SESSION['BookStore']['session']['UserID']?>" name="UserID" id="UserID">
                                    <!--<a href="reservation.html" title="Online Reservation" class="btn bt1 btn-primary btn-normal btn-inline " target="_self">Add to Cart</a>-->
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="sap_tabs">	
                            <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                                <ul class="resp-tabs-list">
                                    <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Product Description</span></li>
                                    <!--<li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Additional Information</span></li>-->
                                    <!--<li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Reviews</span></li>-->
                                    <div class="clear"></div>
                                </ul>				  	 
                                <div class="resp-tabs-container">
                                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                                        <div class="facts"  style="background-color: white;">
                                            <ul class="tab_list">
                                                <li><a href="#"><?php echo $data['BookDescription']?></a></li>
                                            </ul>           
                                        </div>
                                    </div>	
<!--                                    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
                                        <ul class="tab_list">
                                            <li><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat</a></li>
                                            <li><a href="#">augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigatione</a></li>
                                            <li><a href="#">claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores leg</a></li>
                                            <li><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</a></li>
                                        </ul>      
                                    </div>	-->
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>  	    
            </div>
        </div>

<?php require_once 'Footer.php';?>
<script>
function AddToCart(BookID){
//    alert(BookID);
    var UserID = $('#UserID').val(); 
    var Quantity = $('#Quantity').val(); 
    if( UserID != ''){
        jQuery.ajax({
        type: 'POST',
        url: "class/class.ajaxRequest.php",
        data: {BookID:BookID, UserID:UserID, Quantity:Quantity,do: 'AddToCart'},
        success: function (result) {
//            alert(result);
            window.location = "MyCart.php";
//            alert_message_popup('MyCart.php',result);
        }
    });
    }else{
          window.location = "Login.php";
    }
    
}

</script>