<?php require_once 'header.php'; ?>
<?php require_once 'slider.php'; ?>
<!-- Social Media Fixed Slidebar START -->
<div id='social-sidebar' class="sideicon123">
    <ul>
        <li><a class='entypo-facebook' href='#' target='_blank'>
                <span>facebook</span> </a></li>
        <li><a class='entypo-twitter' href='#' target='_blank'>
                <span>Twitter</span> </a></li>
        <li><a class='entypo-youtube' href='' target='_blank'>
                <img src="images/icons/youtube.png" width="20px" style="vertical-align: middle" align="middle"alt="Youtube" />
                <span>Youtube</span> </a></li>
        <li><a class='entypo-linkedin' href='#' target='_blank'>
                <span>Linkedin</span> </a></li>
        <li><a class='entypo-gplus' href='#'target='_blank'>
                <span>Google+</span> </a></li>
        <li><a class='entypo-pinterest' href='#' target='_blank'>
                <span>Pinterest</span> </a></li>
        <li><a class='entypo-blogspot' href='#' target='_blank'>
                <img src="images/icons/blogspot.png" width="20px" style="vertical-align: middle" align="middle"alt="Youtube" />
                <span>Blogspot</span> </a></li>
    </ul>
</div>
<!-- Social Media Fixed Sidebar End -->
<!--Testimonia-PhotoGallery-EnquirySTART-->
<style>
    @import url(http://fonts.googleapis.com/css?family=Anaheim);

    *{
        margin: 0;
        padding: 0;
        outline: none;
        border: none;
        box-sizing: border-box;
    }
    *:before,
    *:after{
        box-sizing: border-box;
    }
    html,
    body{
        min-height: 100%;
    }
    body{
        background-image: radial-gradient(mintcream 0%, lightgray 100%);
    }
    h1{
        display: table;
        margin: 5% auto 0;
        text-transform: uppercase;
        font-family: 'Anaheim', sans-serif;
        font-size: 4em;
        font-weight: 400;
        text-shadow: 0 1px white, 0 2px black;
    }
    .containerPhoto{
        margin: 4% auto;
        width: 210px;
        height: 140px;
        position: relative;
        perspective: 1000px;
    }
    #carouselPhoto{
        width: 100%;
        height: 100%;
        position: absolute;
        transform-style: preserve-3d;
        animation: rotation 20s infinite linear;
    }
    #carouselPhoto:hover{
        animation-play-state: paused;
    }
    #carouselPhoto figure{
        display: block;
        position: absolute;
        width: 90%;
        height: 50%px;
        left: 10px;
        top: 10px;
        background: black;
        overflow: hidden;
        border: solid 5px black;
    }
    #carouselPhoto figure:nth-child(1){transform: rotateY(0deg) translateZ(288px);}
    #carouselPhoto figure:nth-child(2) { transform: rotateY(40deg) translateZ(288px);}
    #carouselPhoto figure:nth-child(3) { transform: rotateY(80deg) translateZ(288px);}
    #carouselPhoto figure:nth-child(4) { transform: rotateY(120deg) translateZ(288px);}
    #carouselPhoto figure:nth-child(5) { transform: rotateY(160deg) translateZ(288px);}
    #carouselPhoto figure:nth-child(6) { transform: rotateY(200deg) translateZ(288px);}
    #carouselPhoto figure:nth-child(7) { transform: rotateY(240deg) translateZ(288px);}
    #carouselPhoto figure:nth-child(8) { transform: rotateY(280deg) translateZ(288px);}
    #carouselPhoto figure:nth-child(9) { transform: rotateY(320deg) translateZ(288px);}

    img{
        -webkit-filter: grayscale(1);
        cursor: pointer;
        transition: all .5s ease;
    }
    img:hover{
        -webkit-filter: grayscale(0);
        transform: scale(1.2,1.2);
    }

    @keyframes rotation{
        from{
            transform: rotateY(0deg);
        }
        to{
            transform: rotateY(360deg);
        }
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-4">
 
        </div>
        <div class="col-lg-4">
               <div class="containerPhoto">
    <div id="carouselPhoto">
        <figure><img src="http://lorempixel.com/186/116/nature/1" alt=""></figure>
        <figure><img src="http://lorempixel.com/186/116/nature/2" alt=""></figure>
        <figure><img src="http://lorempixel.com/186/116/nature/3" alt=""></figure>
        <figure><img src="http://lorempixel.com/186/116/nature/4" alt=""></figure>
        <figure><img src="http://lorempixel.com/186/116/nature/5" alt=""></figure>
        <figure><img src="http://lorempixel.com/186/116/nature/6" alt=""></figure>
        <figure><img src="http://lorempixel.com/186/116/nature/7" alt=""></figure>
        <figure><img src="http://lorempixel.com/186/116/nature/8" alt=""></figure>
        <figure><img src="http://lorempixel.com/186/116/people/9" alt=""></figure>
    </div>
</div>
        </div>
        <div class="col-lg-4">
        
        </div>
    </div>
</div>

<!--Testimonia-PhotoGallery-EnquiryEND-->

<section id="recent-works">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3>Our Latest Project</h3>
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
                                            <img class="img-responsive" src="images/portfolio/recent/item1.png" alt="">
                                            <h5>
                                                Nova - Corporate site template
                                            </h5>
                                            <div class="overlay">
                                                <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="portfolio-item">
                                        <div class="item-inner">
                                            <img class="img-responsive" src="images/portfolio/recent/item3.png" alt="">
                                            <h5>
                                                Fornax - Apps site template
                                            </h5>
                                            <div class="overlay">
                                                <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="portfolio-item">
                                        <div class="item-inner">
                                            <img class="img-responsive" src="images/portfolio/recent/item2.png" alt="">
                                            <h5>
                                                Flat Theme - Business Theme
                                            </h5>
                                            <div class="overlay">
                                                <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                                            </div>
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
                                            <img class="img-responsive" src="images/portfolio/recent/item2.png" alt="">
                                            <h5>
                                                Flat Theme - Business Theme
                                            </h5>
                                            <div class="overlay">
                                                <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="portfolio-item">
                                        <div class="item-inner">
                                            <img class="img-responsive" src="images/portfolio/recent/item1.png" alt="">
                                            <h5>
                                                Nova - Corporate site template
                                            </h5>
                                            <div class="overlay">
                                                <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="portfolio-item">
                                        <div class="item-inner">
                                            <img class="img-responsive" src="images/portfolio/recent/item3.png" alt="">
                                            <h5>
                                                Fornax - Apps site template
                                            </h5>
                                            <div class="overlay">
                                                <a class="preview btn btn-danger" title="Malesuada fames ac turpis egestas" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
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
    </div>
</section> 
<section id="testimonial" class="alizarin">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center">
                    <h2>What our clients say</h2>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
                <div class="gap"></div>
                <div class="row">
                    <div class="col-md-6">
                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                        </blockquote>
                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                        </blockquote>
                    </div>
                    <div class="col-md-6">
                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                        </blockquote>
                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require_once 'footer.php';
