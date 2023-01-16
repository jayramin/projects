 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<?php 
   require_once('header.php');
   
   
   $FolderNameArray = explode('/',$_SERVER['REQUEST_URI']);
   $base_url = "http://".$_SERVER['SERVER_NAME'].'/'.$FolderNameArray[1].'/';
   $productimage_url = "http://".$_SERVER['SERVER_NAME'].'/'.$FolderNameArray[1].'/'.$FolderNameArray[2].'/Images/ProductImage/MultipleImage/';
   $iconimage_url = "http://".$_SERVER['SERVER_NAME'].'/'.$FolderNameArray[1].'/';
   // echo $productimage_url ;
   ?>
<script defer src="<?php echo $base_url; ?>js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="<?php echo $base_url; ?>css/flexslider1.css" type="text/css" media="screen" />
<script>
   // Can also be used with $(document).ready()
   $(window).load(function() {
     $('.flexslider').flexslider({
       animation: "slide",
       controlNav: "thumbnails"
     });
   });
</script>
<!--flex slider-->
<script src="<?php echo $base_url; ?>js/imagezoom.js"></script>
<!-- <link rel="stylesheet" href="<?php echo $base_url; ?>css/w3.css"> -->
<style>
   .newspaper {
   -webkit-column-count: 3; /* Chrome, Safari, Opera */
   -moz-column-count: 3; /* Firefox */
   column-count: 3;
   -webkit-column-gap: 40px; /* Chrome, Safari, Opera */
   -moz-column-gap: 40px; /* Firefox */
   column-gap: 40px;
   }
   .size
   {
   height:100px;
   width:100px;
   align:center;
   }
   /* The Modal (background) */
   .modal {
   display: none; /* Hidden by default */
   position: fixed; /* Stay in place */
   z-index: 1; /* Sit on top */
   padding-top: 100px; /* Location of the box */
   left: 0;
   top: 0;
   width: 100%; /* Full width */
   height: 100%; /* Full height */
   overflow: auto; /* Enable scroll if needed */
   background-color: rgb(0,0,0); /* Fallback color */
   background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
   }
   /* Modal Content */
   .modal-content {
   background-color: #fefefe;
   margin: auto;
   padding: 20px;
   border: 1px solid #888;
   width: 80%;
   }
   /* The Close Button */
   .close {
   color: #aaaaaa;
   float: right;
   font-size: 28px;
   font-weight: bold;
   }
   .close:hover,
   .close:focus {
   color: #000;
   text-decoration: none;
   cursor: pointer;
   }
   .sidenav {
   height: 100%;
   width: 0;
   position: fixed;
   z-index: 1;
   top: 0;
   right: 0;
   background-color: lightblue;
   overflow-x: hidden;
   transition: 0.5s;
   padding-top: 60px;
   }
   .sidenav a {
   padding: 0px 8px 0px 32px;
   text-decoration: none;
   font-size: 25px;
   color: #818181;
   display: block;
   transition: 0.3s;
   }
   .sidenav a:hover {
   color: #f1f1f1;
   }
   .sidenav .closebtn {
   position: absolute;
   top: 0;
   right:0px;
   font-size: 36px;
   margin-right: 15px;
   }
   #main {
   transition: margin-right .5s;
   padding: 16px;
   }
   @media screen and (max-height: 450px) {
   .sidenav {padding-top: 15px;}
   .sidenav a {font-size: 18px;}
   }
   .flexslider .slides img {
   display: block;
   margin-left: 6em;
   height: 100px !important;
   width: 220px !important;
   }
</style>
<!--breadcrumbs-->
<div class="breadcrumbs">
   <div class="container">
      <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
         <li><a href="index"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
         <li class="active"> BO Product</li>
      </ol>
   </div>
</div>
<!--//breadcrumbs-->
<!--single-page-->
<form method="post">
   <div class="single" style="width: 75%; margin-left: 185px;">
      <div class="container">
         <div class="single-info">
            <div class="col-md-6 single-top wow fadeInLeft animated" data-wow-delay=".5s">
               <div class="flexslider">
                  <ul class="slides">
                     <li data-thumb="<?php echo $productimage_url .$ProductImage[0]->image_title?>">
                        <div class="thumb-image"> <img src="<?php echo $productimage_url .$ProductImage[0]->image_title?>" data-imagezoom="true" class="img-responsive" alt="" onmouseover="zoomimage()" > </div>
                     </li>
                     <li data-thumb="<?php echo $productimage_url .$ProductImage[1]->image_title?>">
                        <div class="thumb-image"> <img src="<?php echo $productimage_url .$ProductImage[1]->image_title?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                     </li>
                     <li data-thumb="<?php echo $productimage_url .$ProductImage[2]->image_title?>">
                        <div class="thumb-image"> <img src="<?php echo $productimage_url .$ProductImage[2]->image_title?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
                     </li>
                     <script type="text/javascript">
                        function zoomimage(){
                          alert("call");
                          $("#zoomimage").animate({left:250px});
                        }
                     </script>
                  </ul>
               </div>
            </div>
            <div class="col-md-6 single-top-left simpleCart_shelfItem wow fadeInRight animated" data-wow-delay=".5s">
               <h3><?php echo $IdWiseProduct[0]-> name; ?></h3>
               <div class="single-rating">
                  <a href="#bottom">Add Your Review</a>
                  <input type="hidden" name="userid" value="<?php echo $_SESSION['UserData']->user_id;?>">
                  <input type="hidden" name="list_price" id="list_price" value="<?php echo $IdWiseProduct[0]->list_price;?>">
                  <input type="hidden" name="amount" value="<?php echo $IdWiseProduct[0]->list_price;?>" id="amount">
               </div>
               <?php
                  $profit=abs($IdWiseProduct[0]->list_price-$IdWiseProduct[0]->price);
                  $percentage=round(abs($profit/$IdWiseProduct[0]->price)*100);
                  ?>
               <h6 class="item_price">&#x20B9;<del><?php echo $IdWiseProduct[0]->price; ?></del>&nbsp; &nbsp;&#x20B9;<?php echo $IdWiseProduct[0]->list_price; ?>( <?php echo $percentage ?>% Discount)<br></h6>
               <h6>Profit : &#x20B9;<?php echo $profit ?></h6>
               <?php echo $IdWiseProduct[0]-> description; ?>
               <br>
               <br>
               <div class="clearfix"> </div>
               <div class="row form-group">
                  <div class=" quantity col-md-3">
                     <select name="quantity" onchange="GetAmout(this.value)" class="form-control">
                        <?php
                           for ($i=0; $i <= $IdWiseProduct[0]->quantity ; $i++) { ?> 
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <div class=" quantity col-md-3">
                     <h3>&#x20B9; <span id="displayamount"></span></h3>
                  </div>
               </div>
               <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group mr-4" role="group" aria-label="Second group">
                     <!-- <button type="button" class="btn btn-secondary" name="AddToCart">Add To Cart</button> -->
                     <span class="btn btn-primary" style="cursor:pointer; width:250;" onclick="openNav()">TRY ON</span>
                  </div>
                  <div class="btn-group mr-4" role="group" aria-label="First group">
                     <input type="submit"  style="cursor:pointer; width:260px;" class="btn btn-success " name="AddToCart" value="ORDER GLASSES">
                  </div>
               </div>
               <div id="mySidenav" class="sidenav" >
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                  <center>
                     <h2 class="w3-center" style="color:red;">Change your look with it </h2>
                  </center>
                  <img src="<?php echo $iconimage_url;?>/images/arrow_w.png"  hspace="100" align="middle" style=" height:105px;">
                  <script>
                     var slideIndex = 1;
                     showDivs(slideIndex);
                     
                     function plusDivs(n) {
                       showDivs(slideIndex += n);
                     }
                     
                     function showDivs(n) {
                       var i;
                       var x = document.getElementsByClassName("mySlides");
                       if (n > x.length) {slideIndex = 1}    
                       if (n < 1) {slideIndex = x.length}
                       for (i = 0; i < x.length; i++) {
                          x[i].style.display = "none";  
                       }
                       x[slideIndex-1].style.display = "block";  
                     }
                  </script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<!-- <script src="http://code.jquery.com/jquery-1.8.3.js" type="text/javascript"></script> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
                         $("#resizebleImage").resizable().parent().draggable();  
                     });
                         function ShowMarker(event) {
                                     //console.log (event);
                                     console.log (event);
                                     var mark = document.getElementById('divMark');
                                     mark.style.top =  (event.clientY)+'px';
                                     mark.style.left = (event.clientX) +'px';
                                 }
                             
                  </script>
                  <style type='text/css'>
                     div.divImgContainer { position:absolute; top:10px; left:10px; bottom:10px; right:10px;  border: 1px solid black; }
                     div#divMark { position: initial; top:-100px;  left:-100px; width:100px; height:100px;}
                  </style>
                  <div class="row">
                     <div class="col-lg-8 " style="padding: 10px 0px 0px 135px;">
                        <div>
                           <label for="inputFile" hspace="200" align="middle" style="float:right; " class="btn btn-info btn-lg">Select Image</label>
                           <input  type="file"  id="inputFile" name="files[]" style="visibility:hidden;" type="file">
                        </div>
                        <!-- <input type="file" name="files[]" id="inputFile" /> -->
                     </div>
                  </div>
                  <div class="row"   class='divImgContainer' onclick='ShowMarker(event);' style="padding: 0px 125px 10px; ">
                     <br>
                     <img id="image_upload_preview" src="http://placehold.it/100x100" style="position: absolute;" width="220px" height="220px" alt="your image" onchange="GetPriview(this)" />
                  </div>
                  <div id='divMark' >
                     <!-- you can change the "x" to image of marker if needed -->
                     <img id="resizebleImage" src="<?php echo $productimage_url.$ProductImage[3]->image_title  ?>" width="100%">
                  </div>
                  <div id="myModal" class="modal">
                     <!-- Modal content -->
                     <div class="modal-content">
                        
<!-- Script For Image Uploading START -->

<!-- Script For Image Uploading END -->
<script type="text/javascript">
   function readURL(input) {
         if (input.files && input.files[0]) {
             var reader =  new FileReader();
             reader.onload = function (e) {
                 $('#image_upload_preview').attr('src', e.target.result);   
             }
             reader.readAsDataURL(input.files[0]);
         }
     }
     $("#inputFile").change(function () {
         readURL(this);
         $('#AddGogalsOnFace1').html('<img src="<?php echo $productimage_url.$ProductImage[0]->image_title  ?>" style="position: relative;left: 34px;top: 82px;width: 156px;">');
     });
</script>
</div>
</div>
</div>
</div>
<div id="main">
</div>
<script type="text/javascript">
   // alert("call");
   function openNav() {
     document.getElementById("mySidenav").style.width = "450px";
     document.getElementById("main").style.marginRight = "450px";
   }
   
   function closeNav() {
     document.getElementById("mySidenav").style.width = "0";
     document.getElementById("main").style.marginRight= "0";
   }
</script>
</div>  
</div>
</div>
<div class="clearfix"> </div>
</div>
<!--collapse-tabs-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.2/jquery.min.js"></script>
<div class="collpse tabs" style="width: 85%; margin-left: 125px;">
   <div class="panel-group collpse" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default wow fadeInUp animated" data-wow-delay=".5s">
         <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
               <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
               Description
               </a>
            </h4>
         </div>
         <a name="bottom"></a>
         <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
               <?php echo $IdWiseProduct[0]-> description; ?>
            </div>
         </div>
      </div>
      <div class="panel panel-default wow fadeInUp animated" id="clickme" data-wow-delay=".7s">
         <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title">
               <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
               Reviews <i style="float:right;" class="arrow"></i>
               </a>
            </h4>

         </div>
         
            <!-- <img id="book" src="book.png" alt="" width="100" height="123"> -->
         <script type="text/javascript">
            $( "#clickme" ).click(function() {
            $( "#collapseThree" ).slideToggle( "slow", function() {
              // Animation complete.
            });
          });
            function AddToReviewAjax(prod_id)
            {
            $.ajax({
            type:'POST',
            url:'<?php echo $base_url;?>/Controller/AddToReviewAjaxRequest',
            data:{prod_id:prod_id},
            success:function(responsedata)
            {
                $("#reviewed").alert(responsedata);
            
                
            
            }
            });
            }
         </script>
         <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
               <?php echo $IdWiseReview[0]->review ;?> 
               <br>
               <form method="post">
                  <textarea rows="2" cols="2"  placeholder="Describe your Experience..." class="btn btn-lg btn-block"   name="reviewtext" id="reviewtext" required=""></textarea>
                  <input type="submit" name="reviewed" id="reviewed" value="Review It" onclick="AddToReviewAjax(<?php echo $value->id;?>)"class="btn btn-lg btn-block btn-success">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!--//collapse -->
<!--related-products-->
<div class="related-products" style="width: 85%; margin-left: 125px;">
   <div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
      <h3 class="title">Related<span> Products</span></h3>
   </div>
   <div class="related-products-info">
      <?php
         foreach ($ProdByCatId as $key => $value) {
           // print_r($value);
          ?>
      <div class="col-md-3 new-grid simpleCart_shelfItem wow flipInY animated" data-wow-delay=".5s">
         <div class="new-top">
            <a href="singleproduct?productid=<?php echo $value->id; ?>">
            <img src="<?php echo $productimage_url.$value->thumb; ?>" class="img-responsive" alt=""/></a>
            <div class="new-text">
               <ul>
                  <li><a href="singleproduct?productid=<?php echo $value->id; ?>">Quick View </a></li>
               </ul>
            </div>
         </div>
         <div class="new-bottom">
            <h5><a href="singleproduct?productid=<?php echo $value->id; ?>" class="name"><?php echo $value->name; ?> </a></h5>
            <div class="ofr">
               <p class="pric1">&#x20B9;<del><?php echo $value->price; ?> </del></p>
               <p><span class="item_price">&#x20B9;<?php echo $value->list_price; ?> </span></p>
            </div>
         </div>
      </div>
      <?php } ?>
      <div class="clearfix"> </div>
   </div>
</div>
<!--//related-products-->
</div>
</div>
</form>
<!--//single-page-->
<!--search jQuery-->
<script src="<?php echo $base_url; ?>js/main.js"></script>
<!--//search jQuery-->
<!--smooth-scrolling-of-move-up-->
<script type="text/javascript">
   function GetAmout(e){
       // alert(e);
       var l_price = $("#list_price").val();
       // alert(l_price);
       var amt = l_price*e;
       // alert(amt);
       $("#amount").val(amt);
       $("#displayamount").text(amt);
   }
   
   $(document).ready(function() {
   
       var defaults = {
           containerID: 'toTop', // fading element id
           containerHoverID: 'toTopHover', // fading element hover id
           scrollSpeed: 1200,
           easingType: 'linear' 
       };
       
       $().UItoTop({ easingType: 'easeOutQuart' });
       
   });
</script>
<?php 
   require_once('footer.php');
   ?>
<!--//FOOTER