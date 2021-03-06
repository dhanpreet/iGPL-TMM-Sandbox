<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>GSL | Countries</title>
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
                                        <li class="breadcrumb-item"><a href="#">Country</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Manage Country</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Manage Countries</h4>
                            </div>
                        </div>
						
						<div class="row">
                           <div class="col-lg-12">
								<?php if(@$this->session->flashdata('error')) { ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<?php echo $this->session->flashdata('error'); ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">??</span>
										</button>
									</div>
								<?php } ?>
								<?php if(@$this->session->flashdata('success')) { ?>
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<?php echo $this->session->flashdata('success'); ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">??</span>
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
												<h4 class="header-title mt-0 mb-1">All Countries</h4>
											</div>
											<div class="col-4 text-right">
												<button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#addCategory">Add Country</button>
											</div>
										</div>
                                        
										<p class="sub-header">
                                            &nbsp; <br>
                                        </p>
										
										

                                        <table id="myDataTable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Country Name</th>
                                                    <th>Country Code</th>
                                                    <th>Currency Code</th>
                                                    <th>Time Zone</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
                                            <?php if(is_array($list) && count($list)>0){ $i=1;  ?>
											<?php foreach($list as $row){  ?>
                                            <tr>
                                                <td><?php echo $i; $i++; ?></td>
                                                <td><?php echo ucfirst($row['c_name']) ?></td>
                                                <td><?php echo $row['c_country_code'] ?></td>
                                                <td><?php echo $row['c_currency_code'] ?></td>
                                                <td><?php echo $row['c_timezone'] ?></td>
                                                <td>
														<?php if($row['c_status'] == 1){ ?>
															<span class="badge badge-soft-primary">Active</span>
														<?php } else { ?>
															<span class="badge badge-soft-danger">Inactive</span>
														<?php }  ?>
												</td>
                                                <td class="text-center">
														<a href="javascript: void(0);" data-toggle="modal" data-target="#editCountry_<?php echo $row['c_id']; ?>"><i data-feather="edit-3" width="24" height="24"></i></a>
                                                        <a href="<?php echo site_url('admin/deleteCountry/'.base64_encode($row['c_id'])); ?>" class="text-danger" onClick="return confirm('Are you sure to remove this tournament from the list?');"><i data-feather="trash-2" width="24" height="24"></i></a>
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
		
	<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Add New Country</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form role="form" class="parsley-examples" action="<?php echo site_url('admin/processCountry') ?>" method="post">
                 
				<div class="modal-body">
				
					<div class="form-group row">
						<label for="category_name" class="col-md-4 col-form-label">Country Name <span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="c_name"  name="c_name"  required />
						</div>
					</div>
					<div class="form-group row">
						<label for="category_name" class="col-md-4 col-form-label">Country Code <span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="c_country_code"  name="c_country_code"  required />
						</div>
					</div>

                    <div class="form-group row">
						<label for="category_name" class="col-md-4 col-form-label">Curreny Code <span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="c_currency_code"  name="c_currency_code"  required />
						</div>
					</div>
                    <div class="form-group row">
						<label for="category_name" class="col-md-4 col-form-label">Timezone <span class="text-danger">*</span></label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="c_timezone"  name="c_timezone"  required />
						</div>
					</div>
					<div class="form-group row">
						<label for="category_status" class="col-md-4 col-form-label">Category Status </label>
						<div class="col-md-8">
							<select class="form-control" id="c_status"  name="c_status"  required >
								<option value="1">Active</option>
								<option value="0">Inactive</option>
							</select>
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
	
	
	<?php if(is_array($list) && count($list)>0){ $i=1;  ?> 
	<?php foreach($list as $rows){  ?>
		<div id="editCountry_<?php echo $rows['c_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Update Country</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form role="form" class="parsley-examples" action="<?php echo site_url('admin/updateCountry') ?>" method="post">
					 
					<div class="modal-body">
					
						<div class="form-group row">
							<label for="category_name_" class="col-md-4 col-form-label">Category Name <span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="category_name_"  name="c_name" value="<?php echo $rows['c_name']; ?>" required />
								<input type="hidden" class="form-control" id="category_id"  name="c_id" value="<?php echo base64_encode($rows['c_id']); ?>" required />
							</div>
						</div>

                        <div class="form-group row">
							<label for="code" class="col-md-4 col-form-label">Category Name <span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="code"  name="c_country_code" value="<?php echo $rows['c_country_code']; ?>" required />
							</div>
						</div>

                        <div class="form-group row">
							<label for="currency_code" class="col-md-4 col-form-label">Category Name <span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="currency_code"  name="c_currency_code" value="<?php echo $rows['c_currency_code']; ?> " required />
							</div>
						</div>

                        <div class="form-group row">
							<label for="timezone" class="col-md-4 col-form-label">Category Name <span class="text-danger">*</span></label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="timezone"  name="c_timezone" value="<?php echo $rows['c_timezone']; ?>" required />
							</div>
						</div>

                        
						
						<div class="form-group row">
							<label for="category_status_" class="col-md-4 col-form-label">Category Status </label>
							<div class="col-md-8">
								<select class="form-control" id="category_status_"  name="c_status"  required >
									<option value="1" <?php if($rows['c_status'] == 1) { echo "selected"; } ?> >Active</option>
									<option value="0" <?php if($rows['c_status'] == 0) { echo "selected"; } ?> >Inactive</option>
								</select>
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
	<?php   }     ?>
	<?php   }     ?>
                                        

      
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