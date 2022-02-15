<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>GSL | Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?php echo base_url() ?>assets/admin/images/favicon.ico">

	<!-- plugins -->
	<link href="<?php echo base_url() ?>assets/admin/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

	<!-- App css -->
	<link href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/admin/css/app.min.css" rel="stylesheet" type="text/css" />

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
                    <div class="container-fluid">
                        <div class="row page-title align-items-center">
                            <div class="col-sm-4 col-xl-6">
                                <h4 class="mb-1 mt-0">Dashboard</h4>
                            </div>
                            <div class="col-sm-8 col-xl-6">
                                <form class="form-inline float-sm-right mt-3 mt-sm-0">
                                    <div class="form-group mb-sm-0 mr-2"> &nbsp; </div>
                                </form>
                            </div>
                        </div>

                      
                        <!-- stats + charts -->
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="card bg-soft-info">
                                    <div class="card-body p-0">
                                        <!-- stat 1 -->
                                        <div class="media px-3 py-4 border-bottom">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal"><?php echo $allGames['total']; ?></h4>
                                                <span class="text-muted">Total Games</span>
                                            </div>
                                            <i data-feather="grid" class="align-self-center icon-dual icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-xl-3">
                                <div class="card bg-soft-primary">
                                    <div class="card-body p-0">
                                      
                                        <!-- stat 2 -->
                                        <div class="media px-3 py-4 border-bottom">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal"><?php echo $allPublishedGames['total']; ?></h4>
                                                <span class="text-muted">Published Games</span>
                                            </div>
                                            <i data-feather="pie-chart" class="align-self-center icon-dual icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-xl-3">
                                <div class="card bg-soft-warning">
                                    <div class="card-body p-0">
                                        <!-- stat 3 -->
                                        <div class="media px-3 py-4">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal"><?php echo $allTournaments['total']; ?></h4>
                                                <span class="text-muted">Tournaments Listed</span>
                                            </div>
                                            <i data-feather="file-text" class="align-self-center icon-dual icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="col-xl-3">
                                <div class="card bg-soft-success">
                                    <div class="card-body p-0">
                                        <!-- stat 3 -->
                                        <div class="media px-3 py-4">
                                            <div class="media-body">
                                                <h4 class="mt-0 mb-1 font-size-22 font-weight-normal"><?php echo $liveTournaments['total']; ?></h4>
                                                <span class="text-muted">Live Tournaments</span>
                                            </div>
                                            <i data-feather="airplay" class="align-self-center icon-dual icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
							

						</div>
                        <!-- row -->
                
                    
                    </div>
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

        <!-- optional plugins -->
        <script src="<?php echo base_url() ?>assets/admin/libs/moment/moment.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/apexcharts/apexcharts.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/libs/flatpickr/flatpickr.min.js"></script>

        <!-- page js -->
        <script src="<?php echo base_url() ?>assets/admin/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url() ?>assets/admin/js/app.min.js"></script>


    </body>
</html>