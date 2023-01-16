<?php
$CategoryList = $fn->GetActiveCategoryData();
//echo "<pre>";
//print_r($CategoryList['GetCategoryWiseData']);
?>
                        <div class="sidebar">
                            <div class="menu_box">
                                <h3 class="menu_head">Category</h3>
                                <ul class="menu123">
                                    <?php foreach ($CategoryList['GetCategoryWiseData'] AS $Key => $Value) { ?>
                                    <li class="item1"><a href="index.php?Category=<?php echo $Value['CategoryTitle']?>"><img class="arrow-img" src="assets/images/f_menu.png" alt=""/> <?php echo $Value['CategoryTitle']?></a></li>
                                   <?php } ?>
                                </ul>
                            </div>
                            <!--initiate accordion-->
                            <script type="text/javascript">
                                $(function () {
                                    var menu_ul = $('.menu > li > ul'),
                                            menu_a = $('.menu > li > a');
                                    menu_ul.hide();
                                    menu_a.click(function (e) {
                                        e.preventDefault();
                                        if (!$(this).hasClass('active')) {
                                            menu_a.removeClass('active');
                                            menu_ul.filter(':visible').slideUp('normal');
                                            $(this).addClass('active').next().stop(true, true).slideDown('normal');
                                        } else {
                                            $(this).removeClass('active');
                                            $(this).next().stop(true, true).slideUp('normal');
                                        }
                                    });

                                });
                            </script>
                        </div>
<!--                        <div class="delivery">
                            <img src="assets/images/delivery.jpg" class="img-responsive" alt=""/>
                            <h3>Delivering</h3>
                            <h4>World Wide</h4>
                        </div>-->
<!--                        <div class="twitter">
                            <h3>Latest From Twitter</h3>
                            <ul class="twt1">
                                <i class="twt"> </i>
                                <li class="twt1_desc"><span class="m_1">@Contrary</span> to popular belief, Lorem Ipsum is<span class="m_1"> not simply</span></li>
                                <div class="clearfix"> </div>
                            </ul>
                            <ul class="twt1">
                                <i class="twt"> </i>
                                <li class="twt1_desc"><span class="m_1">There are many</span> variations of passages of Lorem Ipsum available, but the majority <span class="m_1">have suffered</span></li>
                                <div class="clearfix"> </div>
                            </ul>
                            <ul class="twt1">
                                <i class="twt"> </i>
                                <li class="twt1_desc"><span class="m_1">Lorem Ipsum</span> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has <span class="m_1">been the industry's standard dummy text ever</span></li>
                                <div class="clearfix"> </div>
                            </ul>
                        </div>-->
<div class="clients" style="margin-left: 20px">
<h3>Follow Us</h3>
                    <ul class="social">
                        <li><a href=""> <i class="fb"> </i><p class="m_3">Facebook</p><div class="clearfix"> </div></a></li>
                        <li><a href=""><i class="tw"> </i><p class="m_3">Twittter</p><div class="clearfix"> </div></a></li>
                        <li><a href=""><i class="google"> </i><p class="m_3">Google</p><div class="clearfix"> </div></a></li>
                        <li><a href=""><i class="instagram"> </i><p class="m_3">Instagram</p><div class="clearfix"> </div></a></li>
                    </ul>
                        </div>
     


