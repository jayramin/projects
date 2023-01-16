<?php
$inner = array(TBL_USER_TYPES => TBL_MENU_ACCESS . ".menu_access_role_id = " . TBL_USER_TYPES . ".UserType");
$query = $db->innerdata(TBL_MENU_ACCESS, "", $inner, "", '');
$num_rows = mysql_num_rows($query);
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
							        <?php
        if (isset($_REQUEST['method'])) {
            include ADMIN_ROOT . 'forms/form_menu_access.php';
        } else {
            ?>						
												<table id="master" class="table table-striped table-bordered table-hover" data-ride="datatables">
                     <thead>
                        <tr>
                            <th><?php echo $lang->lang['user_role'] ?></th>
                            <th><?php echo $lang->lang['menu'] ?></th>
                            <th><?php echo $lang->lang['action'] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($menu_access = mysql_fetch_object($query)) {
                            $status_class = ($menu_access->menu_access_status == 1) ? "btn-success" : "btn-warning";
                            $status_label = ($menu_access->menu_access_status == 1) ? "A" : "D";
                            $status = ($menu_access->menu_access_status == 1) ? 0 : 1;
                            $menus = explode(",", $menu_access->menu_access_menu_ids);
                            //echo $menu_access->menu_access_role_id;
                            ?>
                            <tr id="<?php echo $menu_access->menu_access_id; ?>">
                                <td align="left" width="15%"><?php echo $menu_access->TypeLabel; ?></td>
                                <td align="left" width="75%">
                                    <?php
                                    for ($m = 0; $m < sizeof($menus); $m++) {
                                        $mns = $db->selectdata(TBL_MENUS, "menu_id='" . $menus[$m] . "'");
                                        $mns_data = mysql_fetch_object($mns);
                                        echo @$mns_data->menu_name . ", ";
                                    }
                                    ?>
                                </td>
                                <td align="center">
                                    <div>
                                        <button type="button" class="btn btn-xs show-tooltip <?php echo $status_class; ?> show-tooltip" title="<?php echo $lang->lang['status']; ?>" data-original-title="Status" onclick="change_status(<?php echo TBL_MENU_ACCESS; ?>, '<?php echo $menu_access->menu_access_id; ?>', '<?php echo $status; ?>', 'menu_access_id', 'menu_access_status');"><?php echo $status_label; ?></button>
                                        <button type="button" class="btn btn-xs show-tooltip" title="<?php echo $lang->lang['edit']; ?>" data-original-title="Edit" onclick="update('menu_rights&method=update&UserType=<?php echo $menu_access->menu_access_role_id; ?>');">
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-danger show-tooltip" title="<?php echo $lang->lang['delete']; ?>" data-original-title="Delete" onclick="delete_single_row('<?php echo TBL_MENU_ACCESS; ?>', '<?php echo $menu_access->menu_access_id; ?>', 'menu_access_id', '<?php echo $menu_access->menu_access_id; ?>');">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
		<?php } ?>								</div>
											</div>
										</div>
									</div>
									</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->