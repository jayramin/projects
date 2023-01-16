<?php
error_reporting(0);
require_once 'includes/header.php';
$data = $fn->GetAddressData();
//echo '<pre>';
//print_r($data);
?>


    <!--========================================== 
          ==Start contact container==
    ========================================== -->
    <div class="contact-container">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="section-title inner-page">
                        <h2>Get <span>office</span> info </h2>
                        <span class="section-style"></span>
                        <p>Here is the information & contacts you can apply</p>
                    </div>
                    <div class="office-info">
                        <ul>
<!--                            <li>
                                <img src="assets/img/icon/home.jpg" alt="">
                                <span>
                                    House 436, Road 30, New DOHS Mohokhali, Chander Desh, United States
                                </span>
                            </li>-->
                            <li>
                                <img src="assets/img/icon/call.jpg" alt="">
                                <p>
                                   <?php echo $data['GetAddressWiseData']['DocumentDescription']?>
                                </p>
                            </li>
<!--                            <li>
                                <img src="assets/img/icon/envelope.jpg" alt="">
                                <span>
                                    <a href="#">
                                        nifo@bighost.com
                                    </a>
                                </span>
                            </li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-md-7">
                        <div class="contact-area-right">
                            <div class="section-title inner-page">
                            <h2>Get <span>in</span> touch </h2>
                            <span class="section-style"></span>
                            <p>Here is the information & contacts you can apply</p>
                        </div>
                        <form action="#">
                            <div class="sl-input">
                                <div class="form-group">
                                    <input type="text" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="sl-input">
                                <div class="form-group">
                                    <input type="text" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="sl-input">
                                <div class="form-group">
                                    <input type="text" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="sl-input">
                                <div class="form-group">
                                    <textarea name="message" placeholder="Message"></textarea> 
                                </div>
                            </div>
                            <div class="sl-input">
                                <div class="form-group">
                                    <div class="cantact-btn">
                                        <button class="pcart-btn">
                                            Send message 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--========================================== 
          ==Start contact container==
    ========================================== -->


<?php
include 'includes/footer.php'
?>