<?php
$RoleID = $_SESSION['BookStore']['session']['RoleID'];
//session_start();
?>
<?php
if ($RoleID == '1') {
?>
<div class="content-wrapper">
    <div class="page-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            </div>
            <div>
                <ul class="breadcrumb">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="#">Dashboard</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Web Users</h4>
                        <p> <b>20</b></p>
                    </div>
                </div>
<!--                <div class="widget-small info"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                    <div class="info">
                        <h4>Agents</h4>
                        <p> <b>20</b></p>
                    </div>
                </div>-->
                <div class="widget-small danger"><i class="icon fa fa-comments-o fa-3x"></i>
                    <div class="info">
                        <h4>Book Sellers</h4>
                        <p> <b>200</b></p>
                    </div>
                </div>
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                    <div class="info">
                        <h4>Retailers</h4>
                        <p> <b>20</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <?php
//                echo "<pre>";
//print_r($_SESSION['BookStore']);
                ?>
                <div class="card" style="margin: 0px 20px 0 0px  !important">
                    <h3 class="card-title">Punhal law house</h3>
                    <p style="font-size: 16px;">Vali is a free dashboard theme built with Bootstrap, pug.js(templating) and sass. It's fully customizable and modular. You don't need to add the code, you will not use. For more information about customizing theme take a look at the docs. Try forget password link on <a href="page-login.html">login page</a> for a surprise. <br><br> Pull requests are always welcome on GitHub</p><br>
<!--                    <p class="mt-40 mb-20"><a class="btn btn-primary icon-btn mr-10" href="http://pratikborsadiya.in/blog/vali-admin" target="_blank"><i class="fa fa-file"></i>Docs</a><a class="btn btn-info icon-btn mr-10" href="https://github.com/pratikborsadiya/vali-admin" target="_blank"><i class="fa fa-github"></i>GitHub</a><a class="btn btn-success icon-btn" href="https://github.com/pratikborsadiya/vali-admin/archive/master.zip" target="_blank"><i class="fa fa-download"></i>Download</a></p>-->
                </div>
            </div>
        </div>

<?php }else{ ?> 
    <div class="content-wrapper">
    <div class="page-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            </div>
            <div>
                <ul class="breadcrumb">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li><a href="#">Dashboard</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4>Hello Agent</h4>
                        <p> <b>20</b></p>
                    </div>
                </div>
<!--                <div class="widget-small info"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                    <div class="info">
                        <h4>Likes</h4>
                        <p> <b>20</b></p>
                    </div>
                </div>-->
<!--                <div class="widget-small danger"><i class="icon fa fa-comments-o fa-3x"></i>
                    <div class="info">
                        <h4>Comments</h4>
                        <p> <b>200</b></p>
                    </div>
                </div>
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                    <div class="info">
                        <h4>Uploades</h4>
                        <p> <b>20</b></p>
                    </div>
                </div>-->
            </div>
            <div class="col-md-7">
                <?php
//                echo "<pre>";
//print_r($_SESSION['BookStore']);
                ?>
<!--                <div class="card" style="margin: 0px">
                    <h3 class="card-title">Getting Started</h3>
                    <p style="font-size: 16px;">Vali is a free dashboard theme built with Bootstrap, pug.js(templating) and sass. It's fully customizable and modular. You don't need to add the code, you will not use. For more information about customizing theme take a look at the docs. Try forget password link on <a href="page-login.html">login page</a> for a surprise. <br><br> Pull requests are always welcome on GitHub</p><br>
                    <p class="mt-40 mb-20"><a class="btn btn-primary icon-btn mr-10" href="http://pratikborsadiya.in/blog/vali-admin" target="_blank"><i class="fa fa-file"></i>Docs</a><a class="btn btn-info icon-btn mr-10" href="https://github.com/pratikborsadiya/vali-admin" target="_blank"><i class="fa fa-github"></i>GitHub</a><a class="btn btn-success icon-btn" href="https://github.com/pratikborsadiya/vali-admin/archive/master.zip" target="_blank"><i class="fa fa-download"></i>Download</a></p>
                </div>-->
            </div>
        </div>

    <?php } ?>