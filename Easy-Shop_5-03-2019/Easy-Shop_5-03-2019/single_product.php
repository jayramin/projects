<?php
include_once 'top_header.php';
if(isset($_REQUEST['pid']))
{
    $id=$_REQUEST['pid'];
    $sel_prod="select * from product_details_tbl join 
    category_details_tbl on category_details_tbl.cat_id=product_details_tbl.cat_id
    join sub_category_details_tbl on sub_category_details_tbl.sub_cat_id=product_details_tbl.sub_cat_id 
    join brand_details_tbl on brand_details_tbl.brand_id=product_details_tbl.brand_id 
    where prod_id=$id";
    $res_prod=$con->query($sel_prod);
    $row=$res_prod->fetch_object();
    //print_r($row);die;
}
?>
  <!--breadcrumbs area start-->
  <div class="breadcrumbs_area bread_about">
	        <div class="container">
	            <div class="row">
	                <div class="col-12">
	                    <div class="breadcrumb_content">
	                        <div class="breadcrumb_header">
	                            <a href="index.html"><i class="fa fa-home"></i></a>
	                            <span><i class="fa fa-angle-right"></i></span>
	                            <span> <a href="shop.html">product</a></span>
	                            
	                            <span><i class="fa fa-angle-right"></i></span>
	                            <span> single product</span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
		<!--breadcrumbs area end-->

        
        <!--product details start-->
        <div class="product_details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="product_d_tab fix"> 
                            <div class="product_d_tab_button">    
                                <ul class="nav product_navactive" role="tablist">
                                    <li >
                                        <a class="nav-link active" data-toggle="tab" href="#p_d_tab1" role="tab" aria-controls="p_d_tab1" aria-selected="false"><img src="admin/<?php echo $row->img_path;?>" alt=""></a>
                                    </li>
                                    <li>
                                         <a class="nav-link" data-toggle="tab" href="#p_d_tab2" role="tab" aria-controls="p_d_tab2" aria-selected="false"><img src="admin/<?php echo $row->img_path;?>" alt=""></a>
                                    </li>
                                    <li>
                                       <a class="nav-link button_three" data-toggle="tab" href="#p_d_tab3" role="tab" aria-controls="p_d_tab3" aria-selected="false"><img src="admin/<?php echo $row->img_path;?>" alt=""></a>
                                    </li>
                                </ul>
                            </div> 
                            <div class="tab-content product_d_content">
                                <div class="tab-pane fade show active" id="p_d_tab1" role="tabpanel" >
                                    <div class="modal_tab_img">
                                        <a href="#"><img src="admin/<?php echo $row->img_path;?>" alt=""></a>
                                        <div class="product_discount">
                                            <span>New</span>
                                        </div>
                                        <div class="view_img">
                                            <a class="view_large_img" href="../admin/<?php echo $row->img_path;?>">View larger <i class="fa fa-search-plus"></i></a>
                                        </div>    
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="p_d_tab2" role="tabpanel">
                                    <div class="modal_tab_img">
                                        <a href="#"><img src="assets/img/product/product23.jpg" alt=""></a>
                                        <div class="product_discount">
                                            <span>New</span>
                                        </div>
                                        <div class="view_img">
                                            <a class="view_large_img" href="assets/img/product/product23.jpg">View larger <i class="fa fa-search-plus"></i></a>
                                        </div>     
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="p_d_tab3" role="tabpanel">
                                    <div class="modal_tab_img">
                                        <a href="#"><img src="assets/img/product/product4.jpg" alt=""></a>
                                        <div class="product_discount">
                                            <span>New</span>
                                        </div>
                                        <div class="view_img">
                                            <a class="view_large_img" href="assets/img/product/product4.jpg">View larger <i class="fa fa-search-plus"></i></a>
                                        </div>     
                                    </div>
                                </div>
                            </div>
                              
                        </div> 
                    </div>
                    <div class="col-lg-7 col-md-6">
                        <div class="product_d_right">
                            <h1><?php echo $row->prod_name;?></h1>
                             <div class="samll_product_ratting mb-10">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a class="comment_form" href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a class="comment_form" href="#"> Write a review </a></li>
                                </ul>
                            </div>
                            <div class="product_reference">
                                <p>Brand : <span><?php echo $row->brand_name;?></span></p>
                            </div>
                            <div class="product_reference">
                                <p>Category : <span><?php echo $row->cat_name;?></span></p>
                            </div>
                            <div class="product_condition">
                                <p>Sub-Category :  <span><?php echo $row->sub_cat_name;?></span></p>
                            </div>
                            <div class="product_short_desc">
                                <p><?php echo $row->prod_desc;?></p>
                            </div>
                            <div class="small_product_price mb-15">
                                <span class="new_price"> RS. <?php echo $row->bprice;?> </span>
                                <span class="old_price"> RS.100</span>
                            </div>
                            <div class="product_d_quantity mb-20">
                                <form action="cart.php?action=add&code=<?php echo $row->prod_id;?>" method="post">
                                    <label>quantity</label>
                                    <input min="0" max="100" name="quantity" value="1" type="number">
                                    <button type="submit" name="btn_pid" ><i class="fa fa-shopping-cart"></i> add to cart</button>
                                </form> 
                                    
                            </div>
                            <div class="product_action action_categorie mb-20">
                                <ul>
                                    <li><a href="#" title=" Add to Wishlist "><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#" title=" Add to Compare "><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#" title=" Add to cart "><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product_d_size mb-20">
                                <label for="group_1">size</label>
                                <select name="size" id="group_1">
                                    <option value="1">S</option>
                                    <option value="2">M</option>
                                    <option value="3">L</option>
                                </select>
                            </div>
                            <div class="product_d_color mb-20">
                               <label>Color </label>
                                <ul>
                                    <li>
                                       <a class="p_white" href="#" title="White"></a>
                                    </li>
                                    <li>
                                        <a class="p_yellow" href="#" title="Yellow"></a>
                                    </li>
                                    <li>
                                        <a class="p_red" href="#" title="Yellow"></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product_in_stock mb-20">
                               <p><?php echo $row->prod_quantity;?> Items</p>
                                <span> In stock </span>
                            </div>>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--product details end-->
        
        <!--product details tab-->
        <div class="product__details_tab mb-40">
            <div class="container">
                <div class="row">
                    <div class="col-12 ">
                        <div class="product_details_tab_inner"> 
                            <div class="product_details_tab_button">    
                                <ul class="nav" role="tablist">
                                    <li >
                                        <a class="nav-link active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">More info</a>
                                    </li>
                                    <li>
                                         <a class="nav-link" data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Data sheet</a>
                                    </li>
                                    <li>
                                       <a class="nav-link button_three" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                                    </li>
                                </ul>
                            </div> 
                            <div class="tab-content product_details_content">
                                <div class="tab-pane fade show active" id="info" role="tabpanel" >
                                    <div class="product_d_tab_content">
                                        <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                                    </div>    
                                </div>
                                <div class="tab-pane fade" id="sheet" role="tabpanel">
                                    <div class="product_d_table">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="first_child">Compositions</td>
                                                    <td>Polyester</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Styles</td>
                                                    <td>Girly</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Properties</td>
                                                    <td>Short Dress</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="product_d_tab_content">
                                        <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                                    </div> 
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <div class="product_d_tab_content">
                                        <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                                    </div>
                                    <div class="product_d_tab_content_inner">
                                        <div class="product_d_tab_content_item">
                                            <div class="samll_product_ratting">
                                            <ul>
                                               <li>Grade </li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a class="comment_form" href="#"><i class="fa fa-star"></i></a></li>
                                            </ul>
                                            </div>
                                             <strong>Posthemes</strong> 
                                             <p>09/07/2018</p>
                                        </div>
                                        <div class="product_d_tab_content_item">
                                            <strong>demo</strong>
                                            <p>That's OK!</p>
                                        </div>
                                    </div> 
                                    <div class="product_review_form">
                                        <form action="#">
                                            <h2>Add a review </h2>
                                            <p>Your email address will not be published. Required fields are marked </p>
                                            <div class="samll_product_ratting review_rating">
                                               <span>Your rating</span>
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="review_form_comment">
                                                        <label for="review_comment">Your review </label>
                                                        <textarea name="comment" id="review_comment" ></textarea>
                                                    </div>
                                                </div> 
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="review_form_author">
                                                        <label for="author">Name</label>
                                                        <input id="author"  type="text">
                                                    </div>
                                                </div> 
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="review_form_author">
                                                        <label for="email">Email </label>
                                                        <input id="email"  type="text">
                                                    </div>
                                                </div>  
                                            </div>
                                            <button type="submit">Submit</button>
                                         </form>   
                                    </div>   
                                       
                                </div>
                            </div>  

                        </div>
                    </div>   
                        
                </div>
            </div>
        </div>
        <!--product details tab end-->
        
        
        <!--product_details_single_product-->
        <div class="product_details_s_product mb-40">
            <div class="container">
                <div class="product_details_s_product_inner">
                    <div class="top_title p_details mb-10">
                            <h2> 11 other products in the same category: </h2>
                        </div>
                    <div class="row">
            <div class="details_s_product_active owl-carousel">   
        <?php
        $sel="select * from product_details_tbl where cat_id=1 or 
        cat_id=2 or cat_id=3 or cat_id=4 ORDER BY RAND() limit 10";
        $res=$con->query($sel);
        while($ft=$res->fetch_object())
        {
        ?>   
    `<div class="col-lg-4">
                                <div class="single_product categorie" >
                                    <div class="product_thumb">
                                        <a href="single_product.php?pid=<?php echo $ft->prod_id;?>"><img src="admin/<?php echo $ft->img_path?>" alt="" style="height:200px; width: 250px;"></a>
                                        <div class="product_discount">
                                            <span>-10%</span>
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
                                            <a title="Printed Summer Dress" href="single-product.html"><?php echo $ft->prod_name?></a>
                                        </div>
                                        <div class="small_product_price">
                                            <span class="new_price"> Rs.<?php echo $ft->bprice?></span>
                                            <span class="old_price"> 150.50  </span>
                                        </div>
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
        <!--product_details_single_end-->
<?php
include_once 'footer.php';
?>