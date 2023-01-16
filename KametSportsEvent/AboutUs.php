<?php
error_reporting(0);
require_once 'includes/header.php';
$data = $fn->GetAboutUsData();
//echo '<pre>';
//print_r($data);
//print_r($data['GetAboutUsWiseData']['DocumentDescription']);
?>

<section class="aboutHost">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-7">
                <div class="about-big-host-left">
                    <div class="section-title inner-page">
                        <h2><span>About Us</span></h2>
                        <span class="section-style"></span>

                    </div>
                    <div class="about-us-inner-content">
                        <ul>
                            <li>
                                <?php echo $data['GetAboutUsWiseData']['DocumentDescription']; ?>
                            </li>                    		
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-5">
                <div class="aboutHost-right">
                    <figure>
                        <img src="assets/img/volleyBall/Volleyball-HD-Wallpapers-for-Mobile.jpg" alt="about-host">
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=========================================== 
                        ==Start About BigHost==
=========================================== -->

<!--=========================================== 
                        ==Start Team==
=========================================== -->
<!--<section class="team-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
                <div class="section-title">
                    <h2>our <span>awesome</span> team</h2>
                    <span class="section-style"></span>
                    <p>
                        Eu delicata rationibus usu. Vix te putant utroque, ludus fabellas duo eu, his dico ut debet consectetuer.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="single-team-member">
                    <figure>
                        <img src="assets/img/team/team-member1.jpg" alt="">
                    </figure>
                    <div class="member-information">
                        <h6>Nazifa Nusrat</h6>
                        <p>Web Experts</p>
                    </div>
                    <div class="single-member-hover">
                        <div class="member-hover-inner-area">
                            <div class="member-inner-content">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="single-team-member">
                    <figure>
                        <img src="assets/img/team/team-member2.jpg" alt="">
                    </figure>
                    <div class="member-information">
                        <h6>Shaharia Parvez</h6>
                        <p>Web Experts</p>
                    </div>
                    <div class="single-member-hover">
                        <div class="member-hover-inner-area">
                            <div class="member-inner-content">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="single-team-member">
                    <figure>
                        <img src="assets/img/team/team-member3.jpg" alt="">
                    </figure>
                    <div class="member-information">
                        <h6>Abdus Salam</h6>
                        <p>Web Experts</p>
                    </div>
                    <div class="single-member-hover">
                        <div class="member-hover-inner-area">
                            <div class="member-inner-content">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="single-team-member">
                    <figure>
                        <img src="assets/img/team/team-member4.jpg" alt="">
                    </figure>
                    <div class="member-information">
                        <h6>Nazifa Nusrat</h6>
                        <p>Web Experts</p>
                    </div>
                    <div class="single-member-hover">
                        <div class="member-hover-inner-area">
                            <div class="member-inner-content">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->
<!--===========================================
                        ==ENd Team== 
=========================================== -->

<!--=========================================== 
                ==Start conten container==
=========================================== -->
<!--<section class="clint-testimonial">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="section-title inner-page">
                        <center><h2>Our trusted <span>clients</span></h2>
                            <span class="section-style"></span></center>
                    </div>
                </div>
                <div class="our-partners-type2">
                    <ul class="bottom-border">
                        <li>
                            <a href="#">
                                <img src="assets/img/partners/npartners1.png" alt="partners-logo">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="assets/img/partners/npartners2.png" alt="partners-logo">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="assets/img/partners/npartners2.png" alt="partners-logo">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="assets/img/partners/npartners3.png" alt="partners-logo">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="assets/img/partners/npartners2.png" alt="partners-logo">
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>-->


<?php
include 'includes/footer.php'
?>