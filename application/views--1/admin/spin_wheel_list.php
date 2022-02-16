<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>GSL | Spin & Win</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Manage Spin & Win Section</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Manage Spin & Win Section</h4>
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
												<h4 class="header-title mt-0 mb-1"> Spin & Win Sections List</h4>
											</div>
											<div class="col-4 text-right">
											<?php if(count(@$list)<9){  ?>
												<button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#addSection">Add Section</button>
											<?php } else { ?>
												<button type="button" class="btn btn-primary btn-rounded" onclick=" alert('You can not add more than 9 sections on wheel board.');" >Add Section</button>
											
											<?php } ?>
											</div>  
										</div>
                                        
										<p class="sub-header">
                                            &nbsp; <br>
                                        </p>
										
										

                                        <table id="myDataTable" class="table dt-responsive nowrap">
                                            <thead>
                                               <tr>
													<th>#</th>
													<th>Section Prize</th>
													<th class="text-center"> Sequence</th>
												   
													<th class="text-center">Actions</th>
													
												</tr>
                                            </thead>
                                        
                                        
                                            <tbody>
											<?php if( is_array(@$list) && count(@$list)>0){ $i=1; ?>
											<?php foreach($list as $row){ ?>
												<tr>
													<td><?php echo $i; $i++; ?></td>
													<td>
													<?php 
													
													if( $row['wheel_type'] == 1){
														echo $row['wheel_value']." Play Coins";
													}  else if( $row['wheel_type'] == 2){
														echo $row['wheel_value']." MB Data Pack";
													}  else if( $row['wheel_type'] == 3){
														echo $row['wheel_value']." GB Data Pack";
													}  else if( $row['wheel_type'] == 4){
														echo $row['wheel_value']." Rs. TalkTime ";
													}
													
													?>
													
													</td>
													
													<td class="text-center"><?php echo $row['wheel_seq'];  ?></td>
													
													<td class="text-center">
														<a href="#" data-toggle="modal" data-target="#edit_<?php echo $row['wheel_id']; ?>" ><i data-feather="edit-3" width="24" height="24"></i></a>
														&nbsp; &nbsp;
														<a class="text-danger" href="<?php echo site_url('admin/removeWheelSection/'.base64_encode($row['wheel_id'])); ?>" onClick="return confirm('Are you sure to remove this section from the list?');" ><i data-feather="trash-2" width="24" height="24"></i></a>
													
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
		
	<div id="addSection" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Add New Section</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form role="form" class="parsley-examples" action="<?php echo site_url('admin/processSpinWheel') ?>" method="post">
                 
				<div class="modal-body">
				
					<div class="form-group row">
						<label for="wheel_value" class="col-md-4 col-form-label">Section Value</label>
						<div class="col-md-8">
							<input type="number" min="1" class="form-control" id="wheel_value"  name="wheel_value"  required />
								
						</div>
					</div>
					
					<div class="form-group row">
						<label for="wheel_type" class="col-md-4 col-form-label">Choose Section Type</label>
						<div class="col-md-8">
							<select class="form-control" id="wheel_type" name="wheel_type" required>
								<option value=""> ----- Choose Option ----- </option> 
								<option value="1"> Play Coins </option> 
								<option value="2"> Data Pack (in MB) </option> 
								<option value="3"> Data Pack (in GB) </option> 
								<option value="4"> TalkTime (in RS)</option> 
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="wheel_seq" class="col-md-4 col-form-label">Section Sequence</label>
						<div class="col-md-8">
							<input type="number" min="1" max="9"  class="form-control" id="wheel_seq"  name="wheel_seq"  required />
								
						</div>
					</div>			
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
<?php if( is_array(@$list) && count(@$list)>0){ $i=1; ?>
<?php foreach($list as $rows){ ?>
	<div class="modal fade" id="edit_<?php echo $rows['wheel_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Update Section</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="<?php echo site_url('admin/processSpinWheel') ?>" method="post">
				<input type="hidden" name="wheel_id" value="<?php echo base64_encode($rows['wheel_id']); ?>" required />
					
				<div class="form-group row">
					<label for="wheel_value" class="col-md-4 col-form-label"> Section Value</label>
					<div class="col-md-8">
						<input class="form-control" type="number" min="1"  name="wheel_value" value="<?php echo $rows['wheel_value']; ?>" required />
					</div>
				</div>
				<div class="form-group row">
					<label for="recipient-name" class="col-md-4 col-form-label">Choose Section Type</label>
					<div class="col-md-8">
						<select class="form-control" name="wheel_type" required>
							<option value=""> ----- Choose Option ----- </option> 
							<option value="1" <?php if($rows['wheel_type'] == 1){ echo "selected=selected"; } ?>> Play Coins </option> 
							<option value="2" <?php if($rows['wheel_type'] == 2){ echo "selected=selected"; } ?>> Data Pack (in MB) </option> 
							<option value="3" <?php if($rows['wheel_type'] == 3){ echo "selected=selected"; } ?>> Data Pack (in GB) </option> 
							<option value="4" <?php if($rows['wheel_type'] == 4){ echo "selected=selected"; } ?>> TalkTime (in RS)</option> 
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="recipient-name" class="col-md-4 col-form-label"> Section Sequence</label>
					<div class="col-md-8">
						<input class="form-control" type="number" min="1" max="9"  name="wheel_seq" value="<?php echo $rows['wheel_seq']; ?>" required />
					</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Update</button>
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