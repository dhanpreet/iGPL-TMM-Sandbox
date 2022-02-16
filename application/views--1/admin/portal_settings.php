<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>GSL | Portal Settings</title>
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
				border: 1px solid #b3b8d6 !important;
			}
			.section-heading{
				font-size:1.1em !important;
			}
			.form-group{
				margin-bottom: 0 !important;
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
                                        <li class="breadcrumb-item active" aria-current="page">Portal Settings</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Portal Settings</h4>
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
						
						<form role="form" class="parsley-examples" action="<?php echo site_url('admin/processPortalSettings') ?>" method="post" >
                      
						
						<div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header ">
									 <h4 class="header-title mt-0 mb-1">Update Portal Settings</h4>
									</div>
                                    <div class="card-body">
                                       	
										<div class="form-group row">
											<label class="col-md-6 col-form-label"><h5 class="section-heading"> Quick Tournaments Section </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="quick_tournaments" name="quick_tournaments" <?php if( search_exif($list, 'quick_tournaments') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="quick_tournaments">&nbsp; </label>
												</div>
											</div>
										</div>
										
										
										<div class="form-group row">
											<label class="col-md-6 col-form-label"><h5 class="section-heading"> Create Tournaments Section </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="create_tournaments" name="create_tournaments" <?php if( search_exif($list, 'create_tournaments') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="create_tournaments">&nbsp; </label>
												</div>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-md-6 col-form-label"><h5 class="section-heading"> Live Tournaments - Hero Tournaments </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="hero_tournaments" name="hero_tournaments" <?php if( search_exif($list, 'hero_tournaments') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="hero_tournaments">&nbsp; </label>
												</div>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-md-6 col-form-label"><h5 class="section-heading"> Live Tournaments - Weekly Tournaments </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="weekly_tournaments" name="weekly_tournaments" <?php if( search_exif($list, 'weekly_tournaments') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="weekly_tournaments">&nbsp; </label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-6 col-form-label"><h5 class="section-heading"> Live Tournaments - Daily Tournaments </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="daily_tournaments" name="daily_tournaments" <?php if( search_exif($list, 'daily_tournaments') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="daily_tournaments">&nbsp; </label>
												</div>
											</div>
										</div>
										
										
										<div class="form-group row">
											<label class="col-md-6 col-form-label"><h5 class="section-heading"> Global Leaderboard </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="global_leaderboard" name="global_leaderboard" <?php if( search_exif($list, 'global_leaderboard') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="global_leaderboard">&nbsp; </label>
												</div>
											</div>
										</div>
										
										
										<div class="form-group row">
											<label class="col-md-6 col-form-label"><h5 class="section-heading"> Free Games Banners</h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="practise_banners" name="practise_banners" <?php if( search_exif($list, 'practise_banners') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="practise_banners">&nbsp; </label>
												</div>
											</div>
										</div>
										
										
										<div class="form-group row">
											<label class="col-md-6 col-form-label"><h5 class="section-heading"> Redemption Settings</h5></label>
											<div class="col-md-6 text-center"><br>
												&nbsp;
											</div>
										</div>
										
										
										<div class="form-group row">
											<label class="col-md-1 col-form-label"><h5 class="section-heading"> <i data-feather="chevron-right"></i></h5></label>
											<label class="col-md-5 col-form-label"><h5 class="section-heading"> Coins </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="redemption_coins" name="redemption_coins" <?php if( search_exif($list, 'redemption_coins') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="redemption_coins">&nbsp; </label>
												</div>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-md-1 col-form-label"><h5 class="section-heading"> <i data-feather="chevron-right"></i></h5></label>
											<label class="col-md-5 col-form-label"><h5 class="section-heading"> Data Pack </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="redemption_data_pack" name="redemption_data_pack" <?php if( search_exif($list, 'redemption_data_pack') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="redemption_data_pack">&nbsp; </label>
												</div>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-md-1 col-form-label"><h5 class="section-heading"> <i data-feather="chevron-right"></i></h5></label>
											<label class="col-md-5 col-form-label"><h5 class="section-heading"> Talktime </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="redemption_talktime" name="redemption_talktime" <?php if( search_exif($list, 'redemption_talktime') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="redemption_talktime">&nbsp; </label>
												</div>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-md-1 col-form-label"><h5 class="section-heading"> <i data-feather="chevron-right"></i></h5></label>
											<label class="col-md-5 col-form-label"><h5 class="section-heading"> Free Games Access (For Unsubscribed Users) </h5></label>
											<div class="col-md-6 text-center"><br>
												<div class="custom-control custom-switch ">
													<input type="checkbox" class="custom-control-input active_banner" id="redemption_games_access" name="redemption_games_access" <?php if( search_exif($list, 'redemption_games_access') ){ echo "checked"; } ?>>
													<label class="custom-control-label" for="redemption_games_access">&nbsp; </label>
												</div>
											</div>
										</div>
											
                                 
										<div class="form-group row">
										   <div class="col-md-12"> <br> </div>
										</div>
											
										 
                                 
										<div class="form-group row">
											<div class="col-md-8 offset-md-4">
												<button type="submit" class="btn btn-primary btn-lg mr-1"> Update  </button>
												
											</div>
										</div>
                                       
                                    </div>
                                </div> <!-- end card -->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
					
					
					
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

		<?php
	  
		function search_exif($exif, $field){
			foreach ($exif as $data)
			{
				if ($data['name'] == $field)
					return $data['enabled'];
			}
		}
	  
		?>

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