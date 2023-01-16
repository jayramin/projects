<?php
$udata = $functions->get_seller_users();
?>						<div class="page-header pull-left">
    <h1>
        Sellers
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            System &amp; Users
        </small>
    </h1>
</div><!-- /.page-header -->

<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
                <div class="widget-box widget-color-pink ui-sortable-handle">
                    <div class="widget-header">
                        <h5 class="widget-title">Shopizen Sellers (View)</h5>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
                            </a>
                        </div>

                        <div class="widget-toolbar no-border">
                            <button class="btn btn-xs btn-light bigger">
                                <i class="ace-icon fa fa-arrow-left"></i>
                                Prev
                            </button>

                            <button class="btn btn-xs bigger btn-yellow dropdown-toggle" data-toggle="dropdown">
                                Next
                                <i class="ace-icon fa fa-chevron-down icon-on-right"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                <li>
                                    <a href="#">Action</a>
                                </li>

                                <li>
                                    <a href="#">Another action</a>
                                </li>

                                <li>
                                    <a href="#">Something else here</a>
                                </li>

                                <li class="divider"></li>

                                <li>
                                    <a href="#">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">

                            <table id="master" class="table table-striped table-bordered table-hover" data-ride="datatables">
                                <thead>
                                    <tr>
                                        <th><?php echo $lang->lang['sr_no'] ?></th>
                                        <th><?php echo $lang->lang['name'] ?></th>
                                        <th><?php echo $lang->lang['cell_number'] ?></th>
                                        <th><?php echo $lang->lang['email'] ?></th>
                                        <th><?php echo $lang->lang['ARSrNo'] ?></th>
                                        <th><?php echo $lang->lang['action'] ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $srno = 1;
                                    //echo $udata[1]['user_id'];
                                    for ($i = 0; $i < sizeof($udata); $i++) {
                                        $status = ($udata[$i]['admin_approval'] == 'Y') ? "btn-success" : "btn-warning";
                                        $status_label = ($udata[$i]['admin_approval'] == 'Y') ? 'A' : 'D';
                                        $status1 = ($udata[$i]['admin_approval'] == 'Y') ? 'N' : 'Y';
                                        ?>
                                        <tr id="<?php echo $udata[$i]['user_id']; ?>">
                                            <td><?php echo $srno; ?></td>
                                            <td><?php echo $udata[$i]['prefix_status'] . ' ' . $udata[$i]['first_name'] . ' ' . $udata[$i]['last_name']; ?></td>
                                            <td><?php echo $udata[$i]['cell_number']; ?></td>
                                            <td><a href="#"><?php echo $udata[$i]['email']; ?></a></td>
                                            <td><?php echo $udata[$i]['ARSrNo']; ?></td>
                                            <td>
                                                <div>
                                                    <button class="btn btn-xs <?php echo $status; ?>" title="Status" onclick="change_status('<?php echo TBL_ADMIN_USERS; ?>', '<?php echo $udata[$i]['user_id']; ?>', '<?php echo $status1; ?>', 'user_id', 'is_active', 'admin_user');"><?php echo $status_label; ?></button>
                                                    <button class="btn btn-xs show-tooltip" title="<?php echo $lang->lang['edit'] ?>" onclick="update('admin_user&mode=edit&req_id=<?php echo $udata[$i]['user_id']; ?>', this.form);">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-xs btn-danger show-tooltip" title="" data-original-title="Delete" onclick="delete_single_row('<?php echo TBL_ADMIN_USERS; ?>', '<?php echo $udata[$i]['user_id']; ?>', 'user_id', '<?php echo $udata[$i]['user_id']; ?>');">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $srno++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->