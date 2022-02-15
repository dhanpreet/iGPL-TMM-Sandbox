<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>GSL | Update Password</title>
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
                                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Update Password</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Update Password</h4>
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
                           
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mt-0 mb-1">Update your current account password here</h4>
                                        <p class="sub-header">
                                           <br>
                                        </p>
										
									
										
                                        <form role="form" class="parsley-examples" action="<?php echo site_url('admin/processUpdatePassword') ?>" method="post">
                                            <div class="form-group row">
                                                <label for="username" class="col-md-4 col-form-label">Username <span class="text-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" id="username" readonly value="<?php echo $info['username'] ?>" required />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="old-password" class="col-md-4 col-form-label">Current Password <span class="text-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="password" class="form-control" name="old_password" id="old-password" required />
                                                </div>
                                            </div>
											
											<div class="form-group row">
                                                <label for="new-password" class="col-md-4 col-form-label">New Password <span class="text-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="password" class="form-control" name="new_password" id="new-password" required />
                                                </div>
                                            </div>
											
											
                                            <div class="form-group row">
                                                <label for="confirm-password" class="col-md-4 col-form-label">Confirm Password <span class="text-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="password" data-parsley-equalto="#new-password" class="form-control" id="confirm-password" name="confirm_password" required />
                                                </div>
                                            </div>
                                 
                                            <div class="form-group row">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary mr-1"> Update </button>
                                                    <button type="reset" class="btn btn-secondary"> Reset </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- end card -->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                       
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