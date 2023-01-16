<?php require_once 'header.php'; ?>
<?php require_once 'slider.php'; ?>
<!-- Social Media Fixed Slidebar START -->
<style>
    .navbar-right .dropdown-menu{
            right: auto !important;
    }
</style>
<div id='social-sidebar' class="sideicon123">
    <ul>
        <li><a class='entypo-facebook' href='#' target='_blank' style="background-color: #3b5998 !important">
                <span>facebook</span> </a></li>
        <li><a class='entypo-twitter' href='#' target='_blank' style="background-color: #0084b4 !important">
                <span>Twitter</span> </a></li>
        <li><a class='entypo-youtube' href='' target='_blank' style="background-color: red !important">
                <img src="images/icons/youtube.png" width="20px" style="vertical-align: middle" align="middle"alt="Youtube" />
                <span>Youtube</span> </a></li>
        <li><a class='entypo-linkedin' href='#' target='_blank' style="background-color: #0077B5 !important">
                <span>Linkedin</span> </a></li>
        <li><a class='entypo-gplus' href='#'target='_blank' style="background-color: #d34836 !important">
                <span>Google+</span> </a></li>
<!--        <li><a class='entypo-pinterest' href='#' target='_blank' style="background-color: #0084b4 !important">
                <span>Pinterest</span> </a></li>-->
<!--        <li><a class='entypo-blogspot' href='#' target='_blank' style="background-color: #0084b4 !important">
                <img src="images/icons/blogspot.png" width="20px" style="vertical-align: middle" align="middle"alt="Youtube" />
                <span>Blogspot</span> </a></li>-->
    </ul>
</div>
<!-- Social Media Fixed Sidebar End -->

<div class="row" style="margin-top: 20px;" >
    <div class="col-lg-12">
        <div class="col-lg-1"></div>
        <div class="col-lg-4">
            <style>
                /*-------------------------------*/
                /*      Code snippet by          */
                /*      @maridlcrmn              */
                /*-------------------------------*/


                section {
                    /*    padding-top: 100px;
                        padding-bottom: 100px;*/
                }

                .quote {
                    color: rgba(0,0,0,.1);
                    text-align: center;
                    margin-bottom: 30px;
                }

                /*-------------------------------*/
                /*    Carousel Fade Transition   */
                /*-------------------------------*/

                #fade-quote-carousel.carousel {
                    padding-bottom: 80px;
                }
                #fade-quote-carousel.carousel .carousel-inner .item {
                    opacity: 0;
                    -webkit-transition-property: opacity;
                    -ms-transition-property: opacity;
                    transition-property: opacity;
                }
                #fade-quote-carousel.carousel .carousel-inner .active {
                    opacity: 1;
                    -webkit-transition-property: opacity;
                    -ms-transition-property: opacity;
                    transition-property: opacity;
                }
                #fade-quote-carousel.carousel .carousel-indicators {
                    bottom: 10px;
                }
                #fade-quote-carousel.carousel .carousel-indicators > li {
                    background-color: #e84a64;
                    border: none;
                }
                #fade-quote-carousel blockquote {
                    text-align: center;
                    border: none;
                }
                #fade-quote-carousel .profile-circle {
                    width: 100px;
                    height: 100px;
                    margin: 0 auto;
                    border-radius: 100px;
                }
            </style>
            <section id="title" class="alizarin">
                <div class="container"></div></section>
            <section id="carousel ">    				
                <div class="container">
                    <div class="row ">
                        <div class="col-md-12 thumbnail bootsnipp-thumb">
                            <center>   <h2 class="HeaderColor">Testimonials</h2></center>
                            <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
                            <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                                <!-- Carousel indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#fade-quote-carousel" data-slide-to="0"></li>
                                    <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
                                    <li data-target="#fade-quote-carousel" data-slide-to="2" class="active"></li>
                                    <li data-target="#fade-quote-carousel" data-slide-to="3"></li>
                                    <li data-target="#fade-quote-carousel" data-slide-to="4"></li>
                                    <li data-target="#fade-quote-carousel" data-slide-to="5"></li>
                                </ol>
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <div class="item">
                                        <div class="profile-circle" style="background-color: rgba(0,0,0,.2);">
                                            <img alt="" src="images/Testimonial/testi (2).png" style=" height: 100px;,margin-top: 20px;">
                                        </div>
                                        <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam.</p>
                                        </blockquote>	
                                    </div>
                                    <div class="item">
                                        <div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>
                                        <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam.</p>
                                        </blockquote>
                                    </div>
                                    <div class="active item">
                                        <div class="profile-circle" style="background-color: rgba(145,169,216,.2);"></div>
                                        <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam.</p>
                                        </blockquote>
                                    </div>
                                    <div class="item">
                                        <div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>
                                        <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam.</p>
                                        </blockquote>
                                    </div>
                                    <div class="item">
                                        <div class="profile-circle" style="background-color: rgba(77,5,51,.2);"></div>
                                        <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam.</p>
                                        </blockquote>
                                    </div>
                                    <div class="item">
                                        <div class="profile-circle">
                                            <img alt="" src="images/photogalley/img (3).jpg" style="height: 50px;">
                                        </div>
                                        
                                        <blockquote>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam.</p>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>							
                    </div>
                </div>
            </section>
        </div>




        <div class="col-lg-4 thumbnail bootsnipp-thumb ">


            <style>
                .media-carousel .carousel-control.left 
                {
                    left: -12px;
                    background-image: none;
                    background: none repeat scroll 0 0 #222222;
                    border: 4px solid #FFFFFF;
                    border-radius: 23px 23px 23px 23px;
                    height: 40px;
                    width : 40px;
                    margin-top: 60px
                }
                /* Next button  */
                .media-carousel .carousel-control.right 
                {
                    right: -12px !important;
                    background-image: none;
                    background: none repeat scroll 0 0 #222222;
                    border: 4px solid #FFFFFF;
                    border-radius: 23px 23px 23px 23px;
                    height: 40px;
                    width : 40px;
                    margin-top: 60px
                }
                .media-carousel img
                {
                    width: 200px;
                    height: 200px
                }
            </style>
            <div class="container">
                <center>   <h2 class="HeaderColor">Image Gallery</h2>
<h4><a  href="#">Create Link </a></h4></center>
                <div class='row'>
                    <div class='col-lg-12' style="margin-top: 20px; margin-bottom: 36px ">
                        <div class="carousel slide media-carousel" id="media">
                            <div class="carousel-inner">
                                <div class="item  active">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a class="thumbnail" href="events.php"><img alt="" src="images/photogalley/img (1).jpg" > </a>
                                        </div>    
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a class="thumbnail" href="events.php"><img alt="" src="images/photogalley/img (4).jpg"></a>
                                        </div>        
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a class="thumbnail" href="events.php"><img alt="" src="images/photogalley/img (3).jpg"></a>
                                        </div>      
                                    </div>
                                </div>
                            </div>
                            <a data-slide="prev" href="#media" class="left carousel-control"><i class="glyphicon glyphicon-chevron-left"></i></a>
                            <a data-slide="next" href="#media" class="right carousel-control"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>                          
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <style>
                * {
                    box-sizing: border-box;
                }


                h2 {
                    text-align: center;
                    /*    margin-bottom: 50px;*/
                        color: #f0ad4e;
                }



                /* form starting stylings ------------------------------- */
                .group {
                    position: relative;
                    margin-bottom: 23px;
                }

/*                input {
                    font-size: 18px;
                    padding: 5px 10px 10px 5px;
                    display: block;
                    width: 100%;
                    border: none;
                    border-bottom: 1px solid #fff;
                    background: transparent;
                }

                input:focus {
                    outline: none;
                }*/

                /* LABEL ======================================= */
/*                label {
                    color: #fff;
                    font-size: 18px;
                    font-weight: normal;
                    position: absolute;
                    pointer-events: none;
                    left: 5px;
                    top: 10px;
                    transition: 0.2s ease all;
                    -moz-transition: 0.2s ease all;
                    -webkit-transition: 0.2s ease all;
                }*/

                /* active state */
/*                input:focus ~ label, input:valid ~ label {
                    top: -20px;
                    font-size: 14px;
                    color: #fff;
                }*/

                /* BOTTOM BARS ================================= */
/*                .bar {
                    position: relative;
                    display: block;
                    width: 100%;
                }*/
/*
                .bar:before, .bar:after {
                    content: '';
                    height: 2px;
                    width: 0;
                    bottom: 1px;
                    position: absolute;
                    background: #fff;
                    transition: 0.2s ease all;
                    -moz-transition: 0.2s ease all;
                    -webkit-transition: 0.2s ease all;
                }

                .bar:before {
                    left: 50%;
                }

                .bar:after {
                    right: 50%;
                }*/



                /* active state */
/*                input:focus ~ .bar:before, input:focus ~ .bar:after {
                    width: 50%;
                }*/

                /* HIGHLIGHTER ================================== */
/*                .highlight {
                    position: absolute;
                    height: 60%;
                    width: 100px;
                    top: 25%;
                    left: 0;
                    pointer-events: none;
                    opacity: 0.5;
                }*/

                /* active state */
/*                input:focus ~ .highlight {
                    -webkit-animation: inputHighlighter 0.3s ease;
                    -moz-animation: inputHighlighter 0.3s ease;
                    animation: inputHighlighter 0.3s ease;
                }

                 ANIMATIONS ================ 
                @-webkit-keyframes inputHighlighter {
                    from {
                        background: #fff;
                    }

                    to {
                        width: 0;
                        background: transparent;
                    }
                }

                @-moz-keyframes inputHighlighter {
                    from {
                        background: #fff;
                    }

                    to {
                        width: 0;
                        background: transparent;
                    }
                }

                @keyframes inputHighlighter {
                    from {
                        background: #fff;
                    }

                    to {
                        width: 0;
                        background: transparent;
                    }
                }*/


                #panel {
                    border: 1px solid rgb(200, 200, 200);
                    box-shadow: rgba(0, 0, 0, 0.1) 0px 5px 5px 2px;
                    background: -webkit-linear-gradient(90deg, #2caab3 0%, #2c8cb3 100%);
                    background: red; /* For browsers that do not support gradients */
                    background: -webkit-linear-gradient(90deg, #2caab3 0%, #2c8cb3 100%); /* For Safari 5.1 to 6.0 */
                    background: -o-linear-gradient(90deg, #2caab3 0%, #2c8cb3 100%); /* For Opera 11.1 to 12.0 */
                    background: -moz-linear-gradient(90deg, #2caab3 0%, #2c8cb3 100%); /* For Firefox 3.6 to 15 */
                    background:linear-gradient(90deg, #34495e 0%, #4c83b9 100%);/* linear-gradient(90deg, #2caab3 0%, #2c8cb3 100%);  Standard syntax (must be last) */
                    border-radius: 4px;
                    top: 50px;
                }

            </style>
            <div class="container">


                <div id="panel">
                    <h2 class="HeaderColor">Enquiry</h2>
                    <form>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                            <input type="text" name="Name" id="Name" class="form-control" required placeholder="Name">
                        </div>
                         <div class="form-group">
                        <input type="text" name="Email" id="Email" class="form-control" required placeholder="Email Id">
                         </div>
                        <div class="form-group">
                            <input type="text" name="MobileNumber" id="MobileNumber" class="form-control" required placeholder="Mobile Number"  onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                         <div class="form-group">
                             <textarea name="Message" id="Message" class="form-control" placeholder="Message" rows="4"></textarea>
                        </div>
                        
                        <div class="group">
                            <center> <button type="submit" class="btn btn-warning EnquiryBtn">Send <span class="glyphicon glyphicon-send"></span></button></center>
                        </div>
                            </div>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<section id="testimonial" class="alizarin">
    <div class="container">
        <div class="row MarginTop10">
            <div class="col-lg-12">
                <div class="col-lg-8">
                    <div class="col-lg-5"><br><br>
                         <img alt="" src="images/photogalley/img (1).png">
                    </div>
                   <div class="col-lg-7">
                    <p>Study Smart is a premier overseas education consulting firm that offers the best in-its-class personalized guidance and counseling to students who wish to Study Abroad. Study Smart Overseas Education is the official representative for over 300 Top Universities in UK, New Zealand, Canada, Ireland, Australia, Germany, Singapore & Malaysia. Our head office is located in Delhi and branch offices in Pune & Gurgaon. appropriate & accurate advice, providing you with an end-to-end solution for your overseas education needs. We are also one of the Top IELTS, TOEFL & PTE Coaching Centre in Delhi& Pune and provide IELTS, PTE & TOEFL training to over 800 students every year who are looking to Study Abroad.</p>
                   </div>
                </div>
                <div class="col-lg-4">
                    <div class="thumbnail">
                        <center><h4 class="HeaderColor" style="text-decoration: underline ;">NEWS Feeds</h4></center>
                        <div style="padding: 10px 0 0 10px; " >
                        <marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" behaviour="scroll" scrollamount="3" >
                            <ul style="height: 200px; ">
                                <li> <a href="#">Welcome To Eduroute </a></li>
                                <li> <a href="#">New Events to display</a></li>
                                <li> <a href="#">Add Some New Text </a></li>
                            </ul>
                        </marquee>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="recent-works">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>Countries</h3>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                <div class="btn-group">
                    <a class="btn btn-danger" href="#scroller" data-slide="prev"><i class="icon-angle-left"></i></a>
                    <a class="btn btn-danger" href="#scroller" data-slide="next"><i class="icon-angle-right"></i></a>
                </div>
                <p class="gap"></p>
            </div>
            <div class="col-md-9">
                <div id="scroller" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="portfolio-item">
                                        <div class="item-inner">
                                            <a href="Country_USA.php"><img class="img-responsive" src="images/countries/USA.jpg" alt="" style="height: 200px;"></a>
                                            <h5>
                                                USA
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="portfolio-item">
                                        <div class="item-inner">
                                            <a href="Country_Canada.php"><img class="img-responsive" src="images/countries/Canada.jpg" alt="" style="height: 200px;"></a>
                                            <h5>
                                                CANADA
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="portfolio-item">
                                        <div class="item-inner">
                                            <a href="Country_Australia.php"><img class="img-responsive" src="images/countries/Australia.png" alt="" style="height: 200px;"></a>
                                            <h5>
                                                AUSTRALIA
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        <div class="item">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="portfolio-item">
                                        <div class="item-inner">
                                            <a href="Counrty_Newzeland.php"><img class="img-responsive" src="images/countries/Newziland.jpg" alt="" style="height: 200px;"></a>
                                            <h5>
                                                New Zealand
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="portfolio-item">
                                        <div class="item-inner">
                                            <a href="Country_Germany.php"><img class="img-responsive" src="images/countries/Germany.jpg" alt="" style="height: 200px;"></a>
                                            <h5>
                                                GERMANY
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div> 
    </div>
</section>

<style>

</style>


<!--<section id="services" class="alizarin">
    <div id="services-sec" class="container-fluid text-center">
  <h2>SERVICES</h2>
  <h4>What we offer</h4>
  <br>
  <div class="container">
  <div class="row slideanim">
    <div class="col-sm-3">
        <a href="Services_Career_Counseling.php">
      <span class="glyphicon glyphicon-off logo-small" ></span>
      <h4>Career Counseling</h4></a>
    </div>
    <div class="col-sm-3">
        <a href="Services_Course_Selection.php">
      <span class="glyphicon glyphicon-heart logo-small"></span>
      <h4>Course Selection</h4></a>
    </div>
    <div class="col-sm-3">
        <a href="Services_Country_Selection.php">
      <span class="glyphicon glyphicon-lock logo-small"></span>
      <h4>Country Selection</h4></a>
    </div>
      <div class="col-sm-3">
        <a href="Services_University_Selection.php">
      <span class="glyphicon glyphicon-leaf logo-small"></span>
      <h4>University Selection</h4></a>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    
    <div class="col-sm-3 divbottom0">
        <a href="Services_Coaching.php">
      <span class="glyphicon glyphicon-certificate logo-small"></span>
      <h4>Coaching/Entrance Exam</h4></a>
    </div>
    <div class="col-sm-3 divbottom0">
        <a href="Services_Applications_And_Documentations.php">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4>Application & Documentation</h4></a>
      
    </div>
      <div class="col-sm-3 divbottom0">
        <a href="Services_Bank_Loan_And_Assistance.php">
      <span class="glyphicon glyphicon-off  logo-small"></span>
      <h4>Bank Loan assistance</h4>
      </a>
    </div>
    <div class="col-sm-3 divbottom0">
        <a href="Services_VISA_Interview_Preparation.php">
      <span class="glyphicon glyphicon-heart logo-small"></span>
      <h4>Visa Interview</h4>
     </a>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    
    <div class="col-sm-3 divbottom0">
        <a href="Services_Foreign_Exchange.php">
      <span class="glyphicon glyphicon-lock logo-small"></span>
      <h4>Foreign Exchange</h4>
      </a>
    </div>
      <div class="col-sm-3 divbottom0">
        <a href="Services_Student_Insurance.php">
      <span class="glyphicon glyphicon-leaf logo-small"></span>
      <h4>Student Insurance</h4>
      </a>
    </div>
    <div class="col-sm-3 divbottom0">
        <a href="Services_Air_Ticket.php">
      <span class="glyphicon glyphicon-certificate logo-small"></span>
      <h4>Air Ticket</h4></a>
    </div>
    <div class="col-sm-3 divbottom0">
        <a href="Services_Pre_Departure_Briefings.php">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4>Pre departure</h4></a>
    </div>
  </div>
  <br><br>

  </div>
</div>
</section>-->

<!--<div class="container-fluid text-center">
    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10 " style="margin-top: 10px;">
            <div class="col-xs-1">
                <a href="#"><img class="img-responsive img-circle" src="images/CountryFlagImage/country (1).jpg"  data-toggle="tooltip" title="Hooray!"/></a>
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (2).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (2).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (3).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (4).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (5).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (6).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (7).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (1).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (2).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (3).png" />
            </div>
            <div class="col-xs-1">
                <img class="img-responsive img-circle" src="images/CountryFlagImage/country (4).png" />
            </div>
        </div>
         <div class="col-xs-1"></div>
    </div>
</div>-->
<?php
require_once 'footer.php';
