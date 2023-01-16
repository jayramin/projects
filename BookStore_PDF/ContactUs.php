<?php require_once 'Header.php';
//$data = $fn->getDataByID("b_bookmaster", "BookID",@$_REQUEST['BookID']);
$PlacedOrderedData = $fn->GetPlacedOrderedData('{"UserID": "'.$UserID.'"}');
//echo "<pre>";
//print_r($UserAddressData['GetAddressWiseData']);
//echo $UserID;
?> 
<!--        <div class="column_center">
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
        </div>-->
        <div class="main">
            <div class="content_top">
                <div class="container" >
                    <div class="col-md-3 sidebar_box">
                        <?php 
                        require_once 'SideMenu.php';
                        ?>
                    </div> 
                    <div class="col-md-9 content_right" style="background-color: white; padding: 30px;min-height: 200px">
                    
                        <address>
                            <p><b>Punahal Law House,</b> </p>
                            <p>1st Floor above adarsh restaurant,</p>
                            <p>Opp. Mirzapur court,</p>
                            <p>Ahmedabad 38001</p>
                        </address>
                        <span><b>Mobile No:</b> +91 982 598 6757, +91 937 613 3770</span><br>
                        <span> <b>  Email :</b> punhallaw@gmail.com</span><br><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.7284144196997!2d72.58269931465378!3d23.03374198494737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e844422a328e5%3A0xeaf09ccb22277053!2s101%2F102%2C+Mirzapur+Rd%2C+Mirzapur%2C+Bhadra%2C+Ahmedabad%2C+Gujarat+380001!5e0!3m2!1sen!2sin!4v1488972570302" width="500" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>  	    
            </div>
        </div>
<!-- Modal -->
<?php require_once 'Footer.php';?>