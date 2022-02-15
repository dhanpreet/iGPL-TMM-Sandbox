<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>GSL | Tournament Banners</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo base_url() ?>assets/admin/images/favicon.ico">

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
                                        <li class="breadcrumb-item"><a href="#">Manage Banners</a></li>
                                       
                                        <li class="breadcrumb-item active" aria-current="page">Upload Banner</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Upload Tournament Banner</h4>
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
						
						<form role="form" class="parsley-examples" action="<?php echo site_url('admin/processTournamentBanner') ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header ">
									 <br><h4 class="header-title mt-0 mb-1"> Add Banner Information</h4>
									</div>
                                    <div class="card-body">
                                       
										<div class="form-group row">
											<label for="banner_tournament_id" class="col-md-4 col-form-label">Tournament Name <span class="text-danger">*</span></label>
											<div class="col-md-6">
												<select class="form-control" name="banner_tournament_id" id="banner_tournament_id" required >
														<option value="">Choose Tournament</option> 
														<?php foreach($tournaments as $tournamentRow){ ?>
															<option value="<?php echo $tournamentRow['tournament_id']; ?>" > <?php echo stripslashes(urldecode($tournamentRow['tournament_name'])); ?> </option> 
														<?php } ?>
												</select>
											</div>
										</div>
										
										<div class="form-group row">
											<label for="banner_location" class="col-md-4 col-form-label">Banner Page Location <span class="text-danger">*</span></label>
											<div class="col-md-6">
												<select class="form-control" name="banner_location" id="banner_location" required >
														<option value="">Choose Location</option> 
														<option value="1">Home Page</option> 
														<option value="2">Practice Zone Page</option> 
														
												</select>
											</div>
										</div>
										
										<div class="form-group row">
											<label for="banner_position" class="col-md-4 col-form-label">Banner Position  <span class="text-danger">*</span></label>
											<div class="col-md-6">
												<select class="form-control" name="banner_position" id="banner_position" required >
														<option value="">Choose Position</option> 
														<option value="1">Header</option> 
														<option value="2">Footer</option> 
														
												</select>
											</div>
										</div>
											
										
										<div class="form-group row">
											<label for="banner_image_path" class="col-md-4 col-form-label">Banner Image <span class="text-danger">*</span></label>
											<div class="col-md-6">
												<input type="file"  name="banner_image_path" id="banner_image_path" required />
													
											</div>
										</div>
											
											
										<div class=" row"><div class="col-md-12"><br></div></div>
										<div class="form-group row">
											<div class="col-md-8 offset-md-4">
												<button type="submit" class="btn btn-primary btn-lg mr-1"> Save Banner</button>
												<button type="reset" class="btn btn-secondary btn-lg"> Reset </button>
											</div>
										</div>
										
									</div>
									</div>
								</div>
							</div>
						</div>
						
						
					</form>
                     
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

      

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="<?php echo base_url() ?>assets/admin/js/vendor.min.js"></script>

        <!-- Plugin js-->
        <script src="<?php echo base_url() ?>assets/admin/libs/parsleyjs/parsley.min.js"></script>

        <!-- Validation init js-->
        <script src="<?php echo base_url() ?>assets/admin/js/pages/form-validation.init.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url() ?>assets/admin/js/app.min.js"></script>
        
    </body>
</html>