<?php require_once 'Header.php';?>
<?php require_once 'Slider.php';


if(isset($_REQUEST['Category']) && $_REQUEST['Category'] != ''){
//    echo $_REQUEST['Category'];
$BookList = $fn->GetCategoryWiseBookData('{"Category": "'.$_REQUEST['Category'].'" }'); 
}else{
$BookList = $fn->GetAllBookData('{"Flag": "Index" }');   
}

//echo "<pre>";
//print_r($BookList);
//echo count($BookList['GetBookWiseData'] );
//exit;
?>
        <div class="column_center">
            <div class="container">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="search">
                    <div class="stay">Search Product</div>
                    <div class="stay_right">
                        <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {
                              this.value = '';
                          }" name="SearchBox" id="SearchBox">
                          <input type="submit" value="" onclick="SearchBook()">
                    </div>
                    <div class="clearfix"> </div>
                </div>
                    </div>
                </div> 
                
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="main">
            <div class="content_top">
                <div class="container">
                    <div class="col-md-3 sidebar_box">
                        <?php 
                        require_once 'SideMenu.php';
                        ?>
                    </div> 
                    
                    <div class="col-md-9 content_right">
                        
                            <?php if($BookList['GetBookWiseData'] != ''){ ?> 
                                <div class="top_grid1" id="Output">
                                    <?php foreach ($BookList['GetBookWiseData'] AS $Key => $Value) { 
//                                        echo "<pre>";
//                                        print_r($Value);
                                        ?>
                            <div class="col-md-4 box_2" style="margin-bottom: 15px">
                                <div class="grid_1">
                                    <a href="Single.php?BookID=<?php echo $Value['BookID'] ?>">
                                        <div class="b-link-stroke b-animate-go  thickbox">
                                            <img src="admin/uploads/BookImage/<?php echo $Value['BookImage']?>" class="img-responsive" style="height: 200px;width: 100%" alt=""/></div>
                                        <div class="grid_2" style="min-height: 170px;">
                                            <p><?php echo $Value['BookTitle']?></p>
                                            <ul class="grid_2-bottom">
                                                <li class="grid_2-left"> 
                                                    <span style="">MRP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span>
                                                <strike> <?php echo $Value['BookMRP']; ?> &#8377;</strike> 
                                                </li>
                                                <li class="grid_2-left"> 
                                                    <span style="">Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span>
                                                        <?php echo $Value['BookPrice']; ?> &#8377; 
                                                </li>
                                                <li class="grid_2-left">Author : <?php echo $Value['BookAutherName']?></li>
                                                <li class="grid_2-right">
                                                    <div class="btn btn-primary btn-normal btn-inline ">
                                                        
                                                        <a href="Single.php?BookID=<?php echo $Value['BookID'] ?>">Get It</a>
                                                    </div></li>
                                                <div class="clearfix"> </div>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div> 
                            <?php }else{ ?>
                            <div class="top_grid1" id="Output">
                                <center>No Record Found</center>
                            </div> 
                                    
                            <?php }?>
                            
                        <div class="top_grid1" id="top_grid1" style="display: none">
                         <div class="col-md-4 box_2" >
                                 <div class="grid_1" id="SearchOutput">
                             
                             </div>
                         </div>
                        </div>
                       
                    </div>
                </div>  	    
            </div>
        </div>
 	
<?php require_once 'Footer.php';?>
<script>
function SearchBook(){
    var SearchText = $("#SearchBox").val();
//    alert(SearchText);
    jQuery.ajax({
        type: 'POST',
        url: "class/class.ajaxRequest.php",
        data: {"SearchText": SearchText,"do":'SearchBook'},
        success: function (result) {
//                        alert(result);
                          $("#SearchOutput").html(result);
                          $("#Output").hide();
                          $("#top_grid1").show();
                    }
    });
}
</script>