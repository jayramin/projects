<link href="chart/chartphp.css" rel="stylesheet" type="text/css" media="screen">
<script src="chart/chartphp.js"></script>
<script src="chart/jquery-2.0.3.min.js"></script>
<?php
include 'chart/chartphp_dist.php';
$p = new chartphp();
$p->data = array(array(array('a', 8), array('b', 50), array('c', 20), array('d', 30)));
$p->chart_type = "donut";
$out = $p->render('c1');

?>
<div style="width:35%; min-width:300px;">
<?php echo $out1; ?>
                                                            </div>

                            <style>
                                /* white color data labels */
                                .jqplot-data-label{color:black;}

                            </style>