<?php require_once 'header.php'; ?>
<section id="title" class="alizarin">
    <div class="container">
<!--        <div class="row">
            <div class="col-sm-6">
                <h1>Contact Us</h1>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
            </div>
            <div class="col-sm-6">
                <ul class="breadcrumb pull-right">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Contact Us</li>
                </ul>
            </div>
        </div>-->
    </div>
</section> 
<center><h1>Contact Us</h1></center>
<section id="contact-page" class="container">
    <div class="row">
        <div class="col-sm-8">
            <h4>Contact Form</h4>
            <div class="status alert alert-success" style="display: none"></div>
            <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="http://shapebootstrap.net/demo/html/flat_theme/sendemail.php" role="form">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <input type="text" class="form-control" required="required" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" required="required" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" required="required" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
                    </div>
                </div>
            </form>
        </div> 
        <div class="col-sm-4">
            <h4>Our Location</h4>
            <iframe width="100%" height="215" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.2032351035273!2d72.54640591496829!3d23.05300948493771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e849940a12d2b%3A0x2e70616493572894!2sAEC+Tower%2C+Naranpura+Rd%2C+Vijay+Char+Rasta%2C+Naryanpura%2C+Ahmedabad%2C+Gujarat+380013!5e0!3m2!1sen!2sin!4v1479541573507"></iframe>
        </div> 
    </div>
</section><br><br>
<?php require_once 'footer.php'; ?>