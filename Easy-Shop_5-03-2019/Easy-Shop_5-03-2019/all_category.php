<!--baner slide show-->
        <div class="banner_slide_show mb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="categories_menu">
                            <div class="categories_title">
                                <h2 class="categori_toggle"><img src="assets/img/logo/categorie.png" alt=""> All categories</h2>
                            </div>
                            <div class="categories_menu_inner">
                                <ul>
                                    <?php
                                    $sel="select * from category_details_tbl";
                                    $res=$con->query($sel);
                                    while($ft=$res->fetch_object())
                                    {
                                        $catid=$ft->cat_id; 
                                    ?>
                                    <li><a href="#"><i class="fa fa-caret-right"></i> <?php echo $ft->cat_name;?><i class="fa fa-angle-right"></i></a>
                                        <ul class="categories_mega_menu">
                                            <li>
                                    <?php
                                    $sel="select * from sub_category_details_tbl where cat_id=$catid";
                                    $res=$con->query($sel);
                                    while($fts=$res->fetch_object())
                                    { 
                                    ?>
                                                <a href="#"><?php echo $fts->sub_cat_name?></a>
                                    <?php
                                    }
                                    ?>
                                            
                                            </li>
                                        </ul>
                                    </li>
                                <?php
                                }
                                ?>
                                    <li id="cat_toggle" class="has-sub"><a href="#"><i class="fa fa-caret-right"></i> More Categories</a>
                                        <ul class="categorie_sub">
                                            <li><a href="#"><i class="fa fa-caret-right"></i> Computer - Laptop</a></li>
                                        </ul>   

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    