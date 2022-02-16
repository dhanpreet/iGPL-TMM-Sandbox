<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>GSL | Games</title>
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
                                        <li class="breadcrumb-item"><a href="#">Games Master</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Manage Games</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Manage Games</h4>
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
											<div class="col-12">
												<h4 class="header-title mt-0 mb-1">All Games</h4>
											</div>
											<!-- <div class="col-4 text-right">
												<button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#addCategory">Add Category</button>
											</div>  -->
										</div>
                                        
										<p class="sub-header">
                                            &nbsp; <br>
                                        </p>
										
										

                                        <table id="myDataTable" class="table dt-responsive nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Game ID</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Genre</th>
                                                    <th>Play Link</th>
                                                   
                                                    <th class="text-center">Published?</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
											<?php if(is_array($list) && count($list)>0){ $i=1;  ?>
											<?php foreach($list as $row){  ?>
                                                <tr>
                                                    <td><?php echo $i; $i++; ?></td>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['Name'] ?></td>
                                                    <td><?php echo $row['portalCategory'] ?></td>
                                                    <td><?php echo $row['Category'];  ?></td> 
                                                    <td><a href="<?php echo site_url('Admin/PlayGame/'.base64_encode($row['id'])); ?>" target="_blank">Click to play</a></td> 
													
                                                    <td class="text-center">
														<?php // if($row['IsPublished'] == 'Yes' || $row['IsPublished'] == 'YES' || $row['IsPublished'] == 'yes' ){ ?>
														<?php if($row['portalPublished']== '1' ){  ?>
															<span class="badge badge-soft-primary">Yes</span>
														<?php } else { ?>
															<span class="badge badge-soft-danger">No</span>
														<?php }  ?>
													</td>
                                                   <td class="text-center">
														<a href="javascript: void(0);" data-toggle="modal" data-target="#editGame_<?php echo $row['gid']; ?>"><i data-feather="edit-3" width="24" height="24"></i></a>
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
		
	    <?php if(is_array($list) && count($list)>0){ $i=1;  ?>
	<?php foreach($list as $rows){  ?>
		<div id="editGame_<?php echo $rows['gid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="myModalLabel">Update Game Information</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form role="form" class="parsley-examples" action="<?php echo site_url('admin/updateGameInfo') ?>" method="post">
						<input type="hidden" name="gid" value="<?php echo $rows['gid'] ?>" />
						<input type="hidden" name="id" value="<?php echo $rows['id'] ?>" />
					
					<div class="modal-body">
						<div class="form-group row">
							<label class="col-md-4 col-form-label">Game Name </label>
							<div class="col-md-8">
								<b><?php echo $rows['Name'] ?></b>
							</div>
						</div>
						<div class="form-group row">
							<label for="portalCategory_<?php echo $rows['gid'] ?>" class="col-md-4 col-form-label">Category <span class="text-danger">*</span></label>
							<div class="col-md-8">
								<select class="form-control" id="portalCategory_<?php echo $rows['gid'] ?>" name="portalCategoryId" required>
									<option value=""> ----- Choose Category ----- </option> 
									
									<?php foreach($categories as $category){ ?>
										<option value="<?php echo $category['category_id']; ?>" <?php if($rows['portalCategoryId']== $category['category_id'] ){ echo "selected=selected"; } ?> > <?php echo $category['category_name']; ?> </option> 
									<?php } ?>
									
								</select>
								
							</div>
						</div>
						
						
					  <!--
						<div class="form-group row">
							<label for="private_tournament_<?php echo $rows['gid'] ?>" class="col-md-4 col-form-label">Tournament Game? <span class="text-danger">*</span></label>
							<div class="col-md-8">
								<select class="form-control" id="private_tournament_<?php echo $rows['gid'] ?>" name="private_tournament" required >
									<option value="1" <?php if($rows['private_tournament']== '1' ){ echo "selected=selected"; } ?>> Yes </option> 
									<option value="0" <?php if($rows['private_tournament']== '0' ){ echo "selected=selected"; } ?>> No </option> 
								</select>
							</div>
						 </div>
						 -->
						 
						<div class="form-group row">
							<label for="portalPublished_<?php echo $rows['gid'] ?>" class="col-md-4 col-form-label">Published? <span class="text-danger">*</span></label>
							<div class="col-md-8">
								<select class="form-control" id="portalPublished_<?php echo $rows['gid'] ?>" name="portalPublished" required >
									<option value="1" <?php if($rows['portalPublished']== '1' ){ echo "selected=selected"; } ?>> Yes </option> 
									<option value="0" <?php if($rows['portalPublished']== '0' ){ echo "selected=selected"; } ?>> No </option> 
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