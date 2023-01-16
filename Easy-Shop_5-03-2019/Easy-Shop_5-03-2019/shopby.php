<!--home block section start-->
        <div class="home_block_seciton">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8">
                      
                       <!--featured product area start-->
                        <div class="featured_left mb-40">   
                            <div class="top_title">
                                <h2> shop by <?php
                                    $sel="select * from category_details_tbl where cat_id=1;";
                                    $res=$con->query($sel);
                                    $ft=$res->fetch_object();
                                    $cat_id=$ft->cat_id;
                                    echo $cat1=$ft->cat_name;
                                    ?></h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="hot_category" style="background-image: url(assets/img/banner/banner11.jpg)">
                                        <h2><?php echo $cat1;?></h2>
                                        <ul>
                                            <?php
                                    $sel="select * from sub_category_details_tbl where cat_id=$cat_id";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>
                                            <li><a href="subcat_product.php?subcatid=<?php echo $ft->sub_cat_id?>"><?php echo $ft->sub_cat_name;?></a></li>
                                    <?php
                                    }
                                    ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="featured_produt">
                                        <div class="featured_active owl-carousel">

                                            <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$cat_id AND sub_cat_id=1  limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                            <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$cat_id AND sub_cat_id=2  limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                            <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$cat_id AND sub_cat_id=3  limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                            <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$cat_id AND sub_cat_id=4  limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--featured product area end--> 
                        
                        <!-- fashion product area start-->
                        <div class="featured_left mb-40">   
                            <div class="top_title">
                                <h2> shop by <?php
                                    $sel="select * from category_details_tbl where cat_id=2";
                                    $res=$con->query($sel);
                                    $ft=$res->fetch_object();
                                    $catid1=$ft->cat_id;
                                    echo $cat1=$ft->cat_name;
                                    ?></h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="hot_category" style="background-image: url(assets/img/banner/banner12.jpg)">
                                        <h2><?php echo $cat1;?></h2>
                                        <ul>
                                            <?php
                                    $sel="select * from sub_category_details_tbl where cat_id=$catid1";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>
                                            <li><a href="subcat_product.php?subcatid=<?php echo $ft->sub_cat_id?>"><?php echo $ft->sub_cat_name;?></a></li>
                                    <?php
                                    }
                                    ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="featured_produt fashion_product">
                                        <div class="featured_active owl-carousel">
                                            <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$catid1 AND sub_cat_id=5 limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                            <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$catid1 AND sub_cat_id=6 limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                    <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$catid1 AND sub_cat_id=7 limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                    <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$catid1 AND sub_cat_id=16 limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- fashion product area end--> 
                        
                        <!--Furnitured product start-->
                         <div class="featured_left mb-40">   
                            <div class="top_title">
                                <h2> Shop By <?php
                                    $sel="select * from category_details_tbl where cat_id=3";
                                    $res=$con->query($sel);
                                    $ft=$res->fetch_object();
                                    $catid2=$ft->cat_id;
                                    echo $cat1=$ft->cat_name;
                                    ?></h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="hot_category" style="background-image: url(assets/img/banner/banner13.jpg)">
                                        <h2><?php echo $cat1;?></h2>
                                        <ul>
                                            <?php
                                    $sel="select * from sub_category_details_tbl where cat_id=$catid2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>
                                            <li><a href="subcat_product.php?subcatid=<?php echo $ft->sub_cat_id?>"><?php echo $ft->sub_cat_name;?></a></li>
                                    <?php
                                    }
                                    ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="featured_produt fashion_product">
                                        <div class="featured_active owl-carousel">
                                            <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$catid2 AND sub_cat_id=8 limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                            <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$catid2 AND sub_cat_id=9 limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                    <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$catid2 AND sub_cat_id=11 limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                    <div class="single_featured">
                                    <?php
                                    $sel="select * from product_details_tbl where cat_id=$catid2 AND sub_cat_id=15 limit 2";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                    ?>   
                                                <div class="single_product">
                                                 
                                                    <div class="product_thumb">
                                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path;?>" alt="" height="200px;"></a>
                                                        <div class="product_discount">
                                                            <span>New</span>
                                                        </div>
                                                        <div class="product_action">
                                                            <ul>
                                                                <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                                <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                                <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                        </div>

                                                    </div>
                                                    <div class="product_content">
                                                        <div class="samll_product_ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="small_product_name">
                                                            <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $ft->prod_id;?>">
                                                                <?php
                                                                echo $ft->prod_name;
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <div class="small_product_price">
                                                            <span class="new_price"> Rs. <?php echo $ft->bprice;?> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                    }
                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                 
                        <!--Furnitured product end--> 
                        
                    </div>
                    <div class="col-lg-3 col-md-4">
                       
                        <!--featured small product start-->
                        <div class="top_sellers featured mb-40">
                            <div class="top_title">
                                <h2>  Featured</h2>
                            </div>
                            <div class="small_product_active owl-carousel">
                                <div class="small_product_item">
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single-product.html"><img src="assets/img/cart/cart13.jpg" alt=""></a>
                                            <div class="product_discount">
                                                <span>-10%</span>
                                            </div>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">Printed Dress</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                                <span class="old_price">  $30.50  </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="assets/img/cart/cart1.jpg" alt=""></a>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">Faded T-shirt</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single-product.html"><img src="assets/img/cart/cart2.jpg" alt=""></a>
                                            <div class="product_discount">
                                                <span>-10%</span>
                                            </div>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">Printed Dress</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                                <span class="old_price">  $30.50  </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="assets/img/cart/cart3.jpg" alt=""></a>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">Summer Dress</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single-product.html"><img src="assets/img/cart/cart5.jpg" alt=""></a>
                                            <div class="product_discount">
                                                <span>-10%</span>
                                            </div>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">hanbag elit </a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="small_product six">
                                        <div class="small_product_thumb">
                                            <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="assets/img/cart/cart6.jpg" alt=""></a>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">Summer Dress</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                            </div>
                                        </div>
                                    </div>     
                                </div>
                                <div class="small_product_item">
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="assets/img/cart/cart4.jpg" alt=""></a>
                                            <div class="product_discount">
                                                <span>-10%</span>
                                            </div>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">Printed Dress</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                                <span class="old_price">  $30.50  </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single-product.html"><img src="assets/img/cart/cart10.jpg" alt=""></a>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">hanbag elit</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="assets/img/cart/cart8.jpg" alt=""></a>
                                            <div class="product_discount">
                                                <span>-10%</span>
                                            </div>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html"> Summer Dress</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                                <span class="old_price">  $30.50  </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single-product.html"><img src="assets/img/cart/cart7.jpg" alt=""></a>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                             <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html"> hanbag justo </a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                                <span class="old_price">  $30.50  </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small_product">
                                        <div class="small_product_thumb">
                                            <a href="single-product.html"><img src="assets/img/cart/cart8.jpg" alt=""></a>
                                            <div class="product_discount">
                                                <span>-10%</span>
                                            </div>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                             <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">Printed  Dress</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                                <span class="old_price">  $30.50  </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small_product six">
                                        <div class="small_product_thumb">
                                            <a href="single-product.html"><img src="assets/img/cart/cart9.jpg" alt=""></a>
                                        </div>
                                        <div class="small_product_content">
                                            <div class="samll_product_ratting">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                             <div class="small_product_name">
                                                <a title="Printed Summer Dress" href="single-product.html">summer Dress</a>
                                            </div>
                                            <div class="small_product_price">
                                                <span class="new_price"> $27.00 </span>
                                                <span class="old_price">  $30.50  </span>
                                            </div>
                                        </div>
                                    </div>     
                                </div>  
                            </div>
                        </div>
                        <!--featured small product end-->
                        
                        <!--banner section start-->
                        <div class="featured_banner mb-40">
                            <div class="feature_banner_box fix">
                                <a href="#"><img src="assets/img/banner/banner6.jpg" alt=""></a>
                            </div>
                            <div class="feature_banner_box fix">
                                <a href="#"><img src="assets/img/banner/banner7.jpg" alt=""></a>
                            </div>
                        </div>
                        <!--banner section end-->
                        
                        
                    </div>
                </div>
            </div>    
        </div>
        <!--home block section end-->