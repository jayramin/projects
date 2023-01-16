<?php
include_once 'top_header.php';
if(isset($_REQUEST['contact']))
{
    $nm=$_REQUEST['name'];   
    $email=$_REQUEST['email'];
    $mno=$_REQUEST['mno'];
    $sub=$_REQUEST['sub'];
    $msg=$_REQUEST['msg'];
    
    $sq="insert into feedback_details_tbl (name,email,mobile,sub,msg) values ('$nm','$email','$mno','$sub','$msg')";
    $res=$con->query($sq);
    if($res)
    {
        ?>
        <script type="text/javascript">
            alert('Thanks for Contacting us!!');
            window.location="contact.php";
        </script>
        <?php
    }
    else
    {
        ?>
        <script type="text/javascript">
            alert('Proble While Contacting , please try again Later');
            window.location="contact.php";
        </script>
        <?php
    }
}
?>
 <!--breadcrumbs area start-->
        <div class="breadcrumbs_area contact_bread contact">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb_content">
                            <div class="breadcrumb_header">
                                <a href="index.html"><i class="fa fa-home"></i></a>
                                <span><i class="fa fa-angle-right"></i></span>
                                <span> Contact</span>
                            </div>
                            <div class="breadcrumb_title">
                                <h2>Contact</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumbs area end-->
    
       <div class="contact_area mb-40">
           <div class="container">
               <div class="row">
                   <div class="col-lg-6 col-md-12">
                       <div class="contact_message">
                            <div class="contact_title">
                                <h2>Tell us your project</h2>   
                            </div>
                            <form id="contact-form" method="POST"  action="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input name="name" placeholder="Name *" type="text">    
                                    </div>
                                    <div class="col-lg-6">
                                        <input name="email" placeholder="Email *" type="email">    
                                    </div>
                                    <div class="col-lg-6">
                                        <input name="sub" placeholder="Subject *" type="text">   
                                    </div>
                                     <div class="col-lg-6">
                                        <input name="mno" placeholder="Phone *" type="text">   
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="contact_textarea">
                                            <textarea placeholder="Message *" name="msg"  class="form-control2" ></textarea>     
                                        </div>   
                                        <button type="submit" name="contact"> Send Message </button>  
                                    </div> 
                                    <div class="col-12">
                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                            </form>    
                        </div> 
                   </div>
                   <div class="col-lg-6 col-md-12">
                       <div class="contact_info_wrapper">
                            <div class="contact_title">
                                <h4>contact us</h4>    
                            </div>
                            <div class="contact_info mb-15">
                                 <p>Easy-Shop is E-Commerce Platform which provide the all products at reilable shipping service and bring great market Values to customer</p>
                            </div>
                            <div class="contact_info mb-15">
                                <ul>
                                    <li><i class="fa fa-fax"></i>  Address : D/304 ,GopiNath Pride , Nr-Shkent Bunglows ,B/H - Prerna Bunglow,New Naroda , Ahmedabad</li>
                                    <li><i class="fa fa-phone"></i> <a href="#">Infor@easyshop.com</a></li>
                                    <li><i class="fa fa-envelope-o"></i> 0(1234) 567 890</li>
                                </ul>        
                            </div>
                        </div> 
                   </div>
               </div>
           </div>
       </div>
<?php
include_once 'footer.php';
?>