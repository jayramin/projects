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
                <div class="container">
                    <div class="col-md-3 sidebar_box">
                        <?php 
                        require_once 'SideMenu.php';
                        ?>
                    </div> 
                    <div class="col-md-9 content_right">
                        <center>                        <img src="assets/images/Logo/Logo.jpeg" style="height: 200px"></center>
                        <p style="font-size: large;text-align: justify">We www.punhallawhopuse.com founded in 2016 based From Ahmedabad. We are working with the Many Law Publications and Law Auhors. We are distributing Law Books on various subjects like VAT, Sales Tax, Income Tax, Professional Tax, Service Tax, Las of Taxes, Rules of Taxes, Latest Notifications. This subjects are playing an important role for Professionals, Sellers, Businessman, Salaried Persons, Law Officers, Government Officers and Law students. </p><br>
                            <p style="font-size: large;text-align: justify">We started this website to comfort the Gujarati reader that they are able to get Detailed Law Information in Gujarati & English language by Latest Books. We are delivering this books to reader’s doorstep without any Delivery Costs. Gujarati People wants these types of book at their place as they are born with world class businessman quality.</p><br>
                            <p style="font-size: large;text-align: justify"> We encourage the Law Books Publishers and Law Book Author to share their knowledge by his books to be sold by this website. </p>
                    </div>
                </div>  	    
            </div>
        </div>
<!-- Modal -->
<?php require_once 'Footer.php';?>