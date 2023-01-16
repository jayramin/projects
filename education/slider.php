<!-- SLIDER 1 START -->
<!--<div id="myCarousel" class="carousel slide" data-ride="carousel">
   Indicators 
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

   Wrapper for slides 
  <div class="carousel-inner" role="listbox">
    <div class="item active">
        <img src="images/slider/slide1.jpg" alt="Chania" style="height: 500px;width:100%;">
      <div class="carousel-caption">
        <h3>Chania</h3>
        <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
      </div>
    </div>

    <div class="item">
      <img src="images/slider/slide2.jpg" alt="Chania" style="height: 500px;width:100%;">
      <div class="carousel-caption">
        <h3>Chania</h3>
        <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
      </div>
    </div>

    <div class="item">
      <img src="images/slider/slide3.jpg" alt="Chania" style="height: 500px;width:100%;">
      <div class="carousel-caption">
        <h3>Flowers</h3>
        <p>Beatiful flowers in Kolymbari, Crete.</p>
      </div>
    </div>

    <div class="item">
      <img src="images/slider/slide4.jpg" alt="Chania" style="height: 500px;width:100%;">
      <div class="carousel-caption">
        <h3>Flowers</h3>
        <p>Beatiful flowers in Kolymbari, Crete.</p>
      </div>
    </div>
  </div>

   Left and right controls 
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>-->
<!-- SLIDER 1 END -->

<!-- SLIDER 2 START -->
<section id="main-slider" class="no-margin">
<div class="carousel slide wet-asphalt">
<ol class="carousel-indicators">
<li data-target="#main-slider" data-slide-to="0" class="active"></li>
<li data-target="#main-slider" data-slide-to="1"></li>
<li data-target="#main-slider" data-slide-to="2"></li>
</ol>
<div class="carousel-inner">
    <?php for($i=1;$i<=9;$i++){ ?>
    <div class="item <?php if($i == 1){ ?>active<?php } ?>">
        <img src="images/slider/slide<?php echo $i; ?>.jpg" alt="Slide1">
      <div class="carousel-caption">
        <h3>Item <?php echo $i; ?></h3>
        <p>The atmosphere in Chania has a touch of Florence and Venice.</p>
      </div>
    </div>
    <?php } ?>
</div> 
</div> 
<a class="prev hidden-xs" href="#main-slider" data-slide="prev">
<i class="icon-angle-left"></i>
</a>
<a class="next hidden-xs" href="#main-slider" data-slide="next">
<i class="icon-angle-right"></i>
</a>
</section>
<!-- SLIDER 2 END -->

<!-- SLIDER 3 START -->
<!--<section id="main-slider" class="no-margin">
<div class="carousel slide wet-asphalt">
<ol class="carousel-indicators">
<li data-target="#main-slider" data-slide-to="0" class="active"></li>
<li data-target="#main-slider" data-slide-to="1"></li>
<li data-target="#main-slider" data-slide-to="2"></li>
</ol>
<div class="carousel-inner">
<div class="item active" style="background-image: url(images/slider/slide5.jpg)" style="max-height:300px;">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="carousel-content centered">
<h2 class="animation animated-item-1">Powerful and Responsive Web Design</h2>
<p class="animation animated-item-2">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
</div>
</div>
</div>
</div>
</div> 
<div class="item" style="background-image: url(images/slider/slide6.jpg)">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="carousel-content center centered">
<h2 class="boxed animation animated-item-1">Clean, Crisp, Powerful and Responsie Web Design Theme</h2>
<p class="boxed animation animated-item-2">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
<br>
<a class="btn btn-md animation animated-item-3" href="#">Learn More</a>
</div>
</div>
</div>
</div>
</div> 
<div class="item" style="background-image: url(images/slider/slide7.jpg)">
<div class="container">
<div class="row">
<div class="col-sm-6">
<div class="carousel-content centered">
<h2 class="animation animated-item-1">Powerful and Responsive Web Design Theme</h2>
<p class="animation animated-item-2">Pellentesque habitant morbi tristique senectus et netus et malesuada fames</p>
<a class="btn btn-md animation animated-item-3" href="#">Learn More</a>
</div>
</div>
<div class="col-sm-6 hidden-xs animation animated-item-4">
<div class="centered">
<div class="embed-container">
<iframe src="http://player.vimeo.com/video/69421653?title=0&amp;byline=0&amp;portrait=0&amp;color=a22c2f" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
</div>
</div>
</div>
</div>
</div> 
</div> 
</div> 
<a class="prev hidden-xs" href="#main-slider" data-slide="prev">
<i class="icon-angle-left"></i>
</a>
<a class="next hidden-xs" href="#main-slider" data-slide="next">
<i class="icon-angle-right"></i>
</a>
</section> -->
<!-- SLIDER 3 END -->


<!-- Social Media Section START -->
<!--<section id="services" class="emerald">
<div class="container">
<div class="row">
<div class="col-md-4 col-sm-6">
<div class="media">
<div class="pull-left">
<i class="icon-twitter icon-md"></i>
</div>
<div class="media-body">
<h3 class="media-heading">Twitter Marketing</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</p>
</div>
</div>
</div> 
<div class="col-md-4 col-sm-6">
<div class="media">
<div class="pull-left">
<i class="icon-facebook icon-md"></i>
</div>
<div class="media-body">
<h3 class="media-heading">Facebook Marketing</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</p>
</div>
</div>
</div> 
<div class="col-md-4 col-sm-6">
<div class="media">
<div class="pull-left">
<i class="icon-google-plus icon-md"></i>
</div>
<div class="media-body">
<h3 class="media-heading">Google Plus Marketing</h3>
<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.</p>
</div>
</div>
</div> 
</div>
</div>
</section>-->
<!-- Social Media Section END -->
