<div class="socialicons">
	<div class="container">
	    <div class="col-md-4 col-sm-4 left">
		    <div class="lt"> 
			   <a class="google" href="#"></a>
			   <h3>GOOGLE</h3>
			   <h5>We Have A Circle</h5>
			</div>
			
	    </div>
		<div class="col-md-4 col-sm-4 middle">
		     <a class="facebook" href="#"></a>
			 <h3>FACEBOOK</h3>
			 <h5>Join Our Community</h5>
	    </div>
		<div class="col-md-4 col-sm-4 right">
		    <div class="rt">
			   <a class="twitter" href="#"></a>
			   <h3>TWITTER</h3>
			   <h5>Follow Us</h5>
			</div>
			
	    </div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //Social Icons Section -->
<!-- Footer Section -->
<div class="footer">
	<div class="container">
		<p> &copy; 2016 Career Builder. All Rights Reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
	</div>
</div>
<!-- //Footer Section -->
<!-- js files -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- Scripts For Navbar -->

	<script src="js/jquery.scrollTo.min.js"></script>

<!--// Scripts For Navbar -->

<!-- Scripts For Gallery Section -->
	<script src="js/jquery.localScroll.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/common.js"></script>

    
<!--// Scripts For Gallery Section -->

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

  // Store hash
  var hash = this.hash;

  // Using jQuery's animate() method to add smooth page scroll
  // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
  $('html, body').animate({
    scrollTop: $(hash).offset().top,
  }, 900, function(){

    // Add hash (#) to URL when done scrolling (default click behavior)
    window.location.hash = hash;
    });
  });
})
</script>

<!-- /js files -->
<!-- Script For Number Scrolling -->
	<script type="text/javascript" src="js/numscroller-1.0.js"></script>
		
<!-- //Script For Number Scrolling -->
<script src="js/responsiveslides.min.js"></script>
			<script>
			// You can also use "$(window).load(function() {"
			$(function () {
				// Slideshow 4
				$("#slider3").responsiveSlides({
						auto: true,
						pager: true,
						nav: false,
						speed: 500,
						namespace: "callbacks",
						before: function () {
							$('.events').append();
						},
						after: function () {
							$('.events').append();
						}
					});				
				});
			</script>
</body>
</html>