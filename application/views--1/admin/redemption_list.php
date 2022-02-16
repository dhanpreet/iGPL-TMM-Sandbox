<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>GSL | Manage Redemption</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/admin/images/favicon.ico">

	<!-- plugins -->
	
	<link href="<?php echo base_url() ?>assets/admin/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/admin/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/admin/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/admin/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 

	<!-- App css -->
	<link href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/admin/css/app.min.css" rel="stylesheet" type="text/css" />
	<style>
		.form-control{
			border : 1px solid #b3b8d6 !important;
		}
	</style>
</head>

    <body>
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
			 <?php include ('topbar.php'); ?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
			 <?php include ('left_sidebar.php'); ?>
           <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                  <!-- Start Content-->
                    <div class="container-fluid">
                        <div class="row page-title">
                            <div class="col-md-12">
                                <nav aria-label="breadcrumb" class="float-right mt-1">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#">Tournaments</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Manage Reward Coins Redemption</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Manage Reward Coins Redemption</h4>
                            </div>
                        </div>


						<div class="row">
                           <div class="col-lg-12">
								<?php if(@$this->session->flashdata('error')) { ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<?php echo $this->session->flashdata('error'); ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
								<?php } ?>
								<?php if(@$this->session->flashdata('success')) { ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<?php echo $this->session->flashdata('success'); ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
								<?php } ?>
							</div>
						</div> 
						
                    <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                       <div class="row">
											<div class="col-8">
												<h4 class="header-title mt-0 mb-1">All Reward Coins Redemption Options</h4>
											</div>
											<div class="col-4 text-right">
												<button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#addGame">New Redemption Option</button>
											</div>  
										</div>
                                        
										<p class="sub-header">
                                            &nbsp; <br>
                                        </p>
										
                                        <table id="myDataTable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Option Type</th>
                                                    <th class="text-center">Reward Coins</th>
                                                    <th class="text-center">Redemption Value</th>
                                                    <th class="text-center">Status?</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
											<?php if(is_array($list) && count($list)>0){ $i=1;  ?>
											<?php foreach($list as $row){  ?>
                                                <tr>
                                                    <td><?php echo $i; $i++; ?></td>
                                                    <td>
														<?php if($row['redeem_type']== '1' ){  ?>
															Play Coins
														<?php } else if($row['redeem_type']== '2' || $row['redeem_type']== '3'){  ?>
															Data Pack
														<?php } else if($row['redeem_type']== '4' ){  ?>
															Talk Time
														<?php } else if($row['redeem_type']== '5' ){  ?>
															Free Games Access
														<?php }  ?>
													</td>
													<td class="text-center"><?php echo $row['redeem_reward_coins'] ?></td>
													<td class="text-center">
													<?php echo $row['redeem_value'] ?>
														<?php if($row['redeem_type']== '1' ){  ?>
															Play Coins
														<?php } else if($row['redeem_type']== '2' ){  ?>
															MB Data
														<?php } else if($row['redeem_type']== '3' ){  ?>
															GB Data
														<?php } else if($row['redeem_type']== '4' ){  ?>
															Rs. Talktime
														<?php } else if($row['redeem_type']== '5' ){  ?>
															Day(s)  Access
														<?php }  ?>
													</td>
                                                   
													<td class="text-center">
														<?php if($row['redeem_status']== '1' ){  ?>
															<span class="badge badge-soft-primary">Active</span>
														<?php } else { ?>
															<span class="badge badge-soft-danger">Inactive</span>
														<?php }  ?>
													</td>
													
													<td class="text-center">
														<a href="#" data-toggle="modal" data-target="#editOption_<?php echo $row['redeem_id'] ?>" ><i data-feather="edit-3" width="24" height="24"></i></a>
														&nbsp; &nbsp;
														
														<a class="text-danger" href="<?php echo site_url('admin/removeRedemptionOption/'.base64_encode($row['redeem_id'])); ?>" onClick="return confirm('Are you sure to remove this option from redemption list?');" ><i data-feather="trash-2" width="24" height="24"></i></a>
													
													
													
													</td>
                                                    
                                                </tr>
                                            <?php } ?>   
                                            <?php } ?>   
                                            </tbody>
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->

					</div> <!-- container-fluid -->
				</div> <!-- content -->

                

                <!-- Footer Start -->
                <?php include ('footer.php'); ?>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
		
	
<div class="modal fade" id="addGame" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Redemption Option</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" class="parsley-examples" action="<?php echo site_url('admin/saveRedemptionOption') ?>" method="post">
          
		  
		  <div class="form-group row">
            <label for="recipient-name" class="col-md-4 col-form-label">Reward Coins</label>
            <div class="col-md-8">
				<input type="number" min="1" class="form-control" id="redeem_reward_coins" name="redeem_reward_coins" required />
			</div>
          </div>
		  
		  <div class="form-group row">
            <label for="recipient-name" class="col-md-4 col-form-label">Choose Type</label>
            <div class="col-md-8">
				<select class="form-control" id="redeem_type" name="redeem_type" required>
					<option value=""> ----- Choose type ----- </option> 
					<!--<option value="1" selected> Play Coins </option>  -->
					<option value="2"> Data Pack (in MB)</option> 
					<option value="3"> Data Pack (in GB)</option> 
					<option value="4"> Talktime (in Rs.)</option> 
					<option value="5"> Free Games Access (in Days)</option> 
				</select>
			</div>
          </div>
		  
		  <div class="form-group row">
            <label for="recipient-name" class="col-md-4 col-form-label"> <span id="value_txt">Coins/DP/TT</span> Value</label>
            <div class="col-md-8">
				<input type="number" min="1" class="form-control" id="redeem_value" name="redeem_value" required />
			</div>
          </div>
		  
		   <div class="form-group row">
				<label for="recipient-name" class="col-md-4 col-form-label"> Status </label>
				<div class="col-md-8">
					<div class="custom-control custom-switch ">
						<input type="checkbox" class="custom-control-input active_banner" id="redeem_status_option" name="redeem_status" checked >
						<label class="custom-control-label" for="redeem_status_option">&nbsp; </label>
					</div>
				</div>
			  </div>
			  
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add </button>
      </div>
	  </form>
    </div>
  </div>
</div>
	                       
		
<?php if(is_array($list) && count($list)>0){  ?>
	<?php foreach($list as $rows){  ?>	
	<div class="modal fade" id="editOption_<?php echo $rows['redeem_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Update Redemption Option</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form role="form" class="parsley-examples" action="<?php echo site_url('admin/saveRedemptionOption') ?>" method="post">
			  <input type="hidden"  id="redeem_id" name="redeem_id" value="<?php echo base64_encode($rows['redeem_id']) ?>" required />
			  
			  <div class="form-group row">
				<label for="recipient-name" class="col-md-4 col-form-label">Reward Coins</label>
				<div class="col-md-8">
					<input type="number" min="1" class="form-control" id="redeem_reward_coins" name="redeem_reward_coins" value="<?php echo $rows['redeem_reward_coins'] ?>" required />
					
				</div>
			  </div>
			  
			  <div class="form-group row">
				<label for="recipient-name" class="col-md-4 col-form-label">Choose Type</label>
				<div class="col-md-8">
					<select class="form-control" id="redeem_type" name="redeem_type" required>
						<option value=""> ----- Choose type ----- </option> 
						<!-- <option value="1" <?php if($rows['redeem_type'] == 1){ echo "selected"; } ?> > Play Coins </option>  -->
						<option value="2" <?php if($rows['redeem_type'] == 2){ echo "selected"; } ?>> Data Pack (in MB)</option> 
						<option value="3" <?php if($rows['redeem_type'] == 3){ echo "selected"; } ?>> Data Pack (in GB)</option> 
						<option value="4" <?php if($rows['redeem_type'] == 4){ echo "selected"; } ?>> Talktime (in Rs.)</option> 
						<option value="5" <?php if($rows['redeem_type'] == 5){ echo "selected"; } ?>> Free Games Access (in Days)</option> 
					</select>
				</div>
			  </div>
			  
			  <div class="form-group row">
				<label for="recipient-name" class="col-md-4 col-form-label"> <span id="value_txt">Coins/DP/TT/Games Access</span> Value</label>
				<div class="col-md-8">
					<input type="number" min="1" class="form-control" id="redeem_value" name="redeem_value" value="<?php echo $rows['redeem_value'] ?>" required />
				</div>
			  </div>
			  
			  
			  <div class="form-group row">
				<label for="recipient-name" class="col-md-4 col-form-label"> Status </label>
				<div class="col-md-8">
					<div class="custom-control custom-switch ">
						<input type="checkbox" class="custom-control-input active_banner" id="redeem_status_<?php echo $rows['redeem_id'] ?>" name="redeem_status" <?php if( $rows['redeem_status'] == 1){ echo "checked"; } ?>>
						<label class="custom-control-label" for="redeem_status_<?php echo $rows['redeem_id'] ?>">&nbsp; </label>
					</div>
				</div>
			  </div>
			  
			  
		  
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Update </button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
							   
	<?php } ?>
<?php } ?>
      
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
		
		<!-- Vendor js -->
        <script src="<?php echo base_url() ?>assets/admin/js/vendor.min.js"></script>

		<!-- datatable js -->
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/responsive.bootstrap4.min.js"></script>
        
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/buttons.flash.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/buttons.print.min.js"></script>

        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/datatables/dataTables.select.min.js"></script>

        <!-- Datatables init -->
        <script src="<?php echo base_url() ?>assets/admin/js/pages/datatables.init.js"></script>
		
		<!-- Plugin js-->
        <script src="<?php echo base_url() ?>assets/admin/libs/parsleyjs/parsley.min.js"></script>

        <!-- Validation init js-->
        <script src="<?php echo base_url() ?>assets/admin/js/pages/form-validation.init.js"></script>


        <!-- App js -->
        <script src="<?php echo base_url() ?>assets/admin/js/app.min.js"></script>


		<script>
		$('#myDataTable').dataTable( {
			"pageLength": 50
		});
		</script>
		
    </body>
</html>