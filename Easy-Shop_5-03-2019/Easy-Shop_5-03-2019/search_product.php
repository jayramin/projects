<?php
    include_once('top_header.php');
?>
 <!--categorie details start-->
 <div class="categorie_details">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="categorie_d_right">
                           
                            <div class="categorie__name mb-20 fix">
                                <h2>Search Results</h2>
                            </div>
                            <div class="categorie_product_toolbar mb-30">
                                <div class="categorie_product_button">
                                    <ul class="nav" role="tablist">
                                        <li>
                                            <a class="active" data-toggle="tab" href="#large" role="tab" aria-controls="large" aria-selected="true"><i class="fa fa-th-large"></i></a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="false"><i class="fa fa-th-list"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <form action="#">
                                    <label>Sort By</label>
                                    <select name="orderby" id="short">
                                        <option selected value="1">Default sorting</option>
                                        <option value="1">Sort by popularity</option>
                                        <option value="1">Sort by average rating</option>
                                        <option value="1">Sort by rating</option>
                                        <option value="1">Sort by price: low to high</option>
                                        <option value="1">Sort by price: high to low</option>
                                        <option value="1">Price: Lowest first</option>
                                        <option value="1">Product Name: A to Z</option>
                                        <option value="1">In stock</option>
                                        <option value="1">Reference: Lowest first</option>
                                        <option value="1">Reference: Highest first</option>
                                    </select>
                                </form>
                                <p>Showing 1–12 of 46 results</p>
                            </div>
                            
                            
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="large" role="tabpanel">
                                    <div class="row cate_tab_product">
                                        <?php
                                        foreach ($arr as $value)
                                        {
                                        ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="single_product categorie">
                                                <div class="product_thumb">
                                                    <a href="single_product.php?pid=<?php echo $value->prod_id;?>"><img src="admin/<?php echo $value->img_path;?>" alt="" style="height:250px; width: 250px;"></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>
                                                    <div class="product_action">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
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
                                                        <a title="Printed Summer Dress" href="single_product.php?pid=<?php echo $value->prod_id;?>">
                                                            <?php echo $value->prod_name;?>
                                                        </a>
                                                    </div>
                                                    <div class="small_product_price">
                                                        <span class="new_price"> Rs. <?php echo $value->bprice;?></span>
                                                        <span class="old_price">  150.50  </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>                                  
                                    </div>  
                                </div>
                                <div class="tab-pane fade" id="list" role="tabpanel">
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product44.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product14.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product15.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product16.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product17.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product18.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product19.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product20.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product21.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product22.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product23.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="single_product categorie">   
                                        <div class="row cate_tab_product">
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="product_thumb">
                                                    <a href="single-product.html"><img src="assets/img/product/product24.jpg" alt=""></a>
                                                    <div class="product_discount">
                                                        <span>-10%</span>
                                                    </div>

                                                    <div class="quick_view categorie_view">
                                                        <a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-search"></i></a>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-6">
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
                                                    <div class="small_product_name categorie_name">
                                                        <a title="Printed Summer Dress" href="single-product.html"> Faded Short Sleeves T-shirt </a>
                                                    </div>
                                                    <div class="small_product_price categorie_prie mb-10">
                                                        <span class="new_price"> $140.00 </span>
                                                        <span class="old_price">  $150.50  </span>
                                                    </div>
                                                    <div class="single__product_drsc">
                                                        <p> Faded short sleeves t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!</p>
                                                    </div>
                                                    <div class="product_action action_categorie mb-10">
                                                        <ul>
                                                            <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product_in_stock">
                                                        <span> In stock </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                            
                            <div class="page_numbers_toolbar">
                                <ul>
                                    <li><a class="current_page" href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a class="next_page" href="#">next</a></li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--categorie details end-->
        
        <!--brand logo area start-->
		<div class="brand_logo mb-40">
		   <div class="container">
		       <div class="row brand_padding">
		           <div class="brand_active owl-carousel">
		               <div class="col-lg-2">
		                   <div class="single_brand">
		                       <a href="#"><img src="assets/img/brand/brand1.jpg" alt=""></a>
		                   </div>
		               </div>
		               <div class="col-lg-2">
		                   <div class="single_brand">
		                       <a href="#"><img src="assets/img/brand/brand2.jpg" alt=""></a>
		                   </div>
		               </div>
		               <div class="col-lg-2">
		                   <div class="single_brand">
		                       <a href="#"><img src="assets/img/brand/brand3.jpg" alt=""></a>
		                   </div>
		               </div>
		               <div class="col-lg-2">
		                   <div class="single_brand">
		                       <a href="#"><img src="assets/img/brand/brand4.jpg" alt=""></a>
		                   </div>
		               </div>
		               <div class="col-lg-2">
		                   <div class="single_brand">
		                       <a href="#"><img src="assets/img/brand/brand5.jpg" alt=""></a>
		                   </div>
		               </div>
		               <div class="col-lg-2">
		                   <div class="single_brand">
		                       <a href="#"><img src="assets/img/brand/brand6.jpg" alt=""></a>
		                   </div>
		               </div>
		               <div class="col-lg-2">
		                   <div class="single_brand">
		                       <a href="#"><img src="assets/img/brand/brand4.jpg" alt=""></a>
		                   </div>
		               </div>
		              
		           </div>
		       </div>
		   </div> 
		</div>
		<!--brand logo area end-->
<?php
    include_once('footer.php');
?>