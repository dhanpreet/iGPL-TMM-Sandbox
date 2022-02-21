<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>GSL | Tournaments</title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
                                        <!-- <li class="breadcrumb-item"><a href="#">Tournaments</a></li> -->
                                        <li class="breadcrumb-item active" aria-current="page">Gratification Report</li>
                                    </ol>
                                </nav>
                                <h4 class="mb-1 mt-0">Gratification Report</h4>
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
											<div class="col-6">
												<h4 class="header-title mt-0 mb-1">
												
												<?php if($filter == 'customDates'){ ?>
													Custom Filters <span class="text-danger"> <?php echo date('d/M/y', strtotime($startDate)); ?> </span> To <span class="text-danger"><?php echo date('d/M/y', strtotime($endDate)); ?> </span>
												<?php } ?>
												
												
												</h4>
											</div>
											
											<div class="col-md-6 float-md-right" style="float:right;"> 
											<form id="searchForm" action="<?php echo site_url('Admin/GratificationFilter'); ?>" method="post"> 
												<div class="form-group row" style=" text-align:right; ">
													<label class="col-md-2 label-control text-bold-700" ><h4><b>&nbsp; </b></h4></label>
													<div class="col-md-8" style="padding: 0 !important;"> 
														<select class="form-control" name="search" id="search">
															<option value='' <?php if(@$filter == '') { echo "selected"; } ?>>Choose Filter</option>
															<option value='1' <?php if(@$filter == '1') { echo "selected"; } ?>>Yesterday</option>
															<option value='7' <?php if(@$filter == '7') { echo "selected"; } ?>>Last 7 days</option>
															<option value='15' <?php if(@$filter == '15') { echo "selected"; } ?>>Last 15 days</option>
															<option value='30' <?php if(@$filter == '30') { echo "selected"; } ?>>Last 30 days</option>
															<option value='month' <?php if(@$filter == 'month') { echo "selected"; } ?>>MTD - Month Till Date</option>										
															<option value='all' <?php if(@$filter == 'all') { echo "selected"; } ?>>All Listed Tournaments</option>										
															<option value='custom' <?php if(@$filter == 'custom') { echo "selected"; } ?>>Custom Dates</option>										
														</select>
													</div>
													<div class="col-md-2 text-center" style="padding: 0 !important;"> 
														<button type="submit" name="Go" id="go-btn" class="btn btn-primary"><i data-feather="search"></i></button>
													</div>
												
												</div>
												
											</form>
											</div>
											
										</div>


                                       <div class="row">
											<div class="col-6">
												<h4 class="header-title mt-0 mb-1">All Tournament</h4>
                                                <!-- <h4 class="header-title mt-0 mb-1">Gratification Type : <b>Talktime</b></h4> -->
											</div>
											<div class="col-6 text-right">
												<!-- <a href="<?php echo site_url('Admin/NewTournament') ?>" class="btn btn-primary btn-rounded" >Create Tournament</a>
												<a href="javascript(0);" data-toggle="modal" data-target="#uploadBulk" class="btn btn-secondary btn-rounded" >Upload Bulk</a> -->
											</div>  
										</div>
                                        
										<p class="sub-header">
                                            &nbsp; <br>
                                        </p>
										
										

                                        <table id="myDataTable" class="table nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tournament</th>
                                                    <th>Game Name</th>
                                                    <th>Starts On</th>
                                                    <th>Ends On</th>
                                                    <th>Tournament Type</th>
                                                    <th class="text-center">Gratification</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                        
                                        
                                            <tbody>
											<?php if(is_array($list) && count($list)>0){ $i=1;  ?>
											<?php foreach($list as $row){  ?>
                                                <tr>
                                                    <td><?php echo $i; $i++; ?></td>
                                                    <td><?php echo stripslashes(urldecode($row['tournament_name'])); ?></td>
                                                    <td><?php echo $row['tournament_game_name'] ?></td>
                                                    <td><?php echo date('d/M/Y', strtotime($row['tournament_start_date'])); ?> <?php echo date('h:i A', strtotime($row['tournament_start_time'])); ?></td>
                                                    <td><?php echo date('d/M/Y', strtotime($row['tournament_end_date'])); ?> <?php echo date('h:i A', strtotime($row['tournament_end_time'])); ?></td>
                                                    
													<td>
													<?php if($row['tournament_section'] == 3){ ?>
														<span class="badge badge-soft-primary">Daily Tournament</span>
													<?php } else if($row['tournament_section']==2) { ?>
														<span class="badge badge-soft-dark">Weekly  Tournament</span>
													<?php } else {?>
														<span class="badge badge-soft-info"> Hero Tournament</span>
														<?php }  ?>
													</td>
													
													
													<td class="text-center">
                                                    <span class="badge badge-soft-success">Talktime</span>
													</td>
													
													
													
													<td class="text-center">
                                                    <a href="<?php echo site_url('Admin/Gratification/Leaderboard/'.base64_encode($row['tournament_id'])); ?>" data-toggle="tooltip" data-title="Leaderboard"><i data-feather="file-text" width="24" height="24"></i></a>
														&nbsp;&nbsp;
														<!-- <a href="<?php echo site_url('admin/deletTournaments/'.base64_encode($row['tournament_id'])); ?>" class="text-danger" onClick="return confirm('Are you sure to remove this tournament from the list?');"><i data-feather="trash-2" width="24" height="24"></i></a> -->
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
	                     
    		
	<div id="uploadBulk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-dark">
					<h5 class="modal-title text-white" id="myModalLabel">Upload Excelsheet</h5>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form role="form" class="parsley-examples" action="<?php echo site_url('admin/processBulkTournaments') ?>" method="post" enctype="multipart/form-data">
                 
				<div class="modal-body">
				
				
					<div class="form-group row">
						<div class="col-md-12 text-right">
							<a  class="btn btn-dark btn-rounded" target="_blank" href="<?php echo base_url('uploads/format/tournaments_bulk.xlsx'); ?>">Download Excel Format</a>
						</div>
					</div>
					
					<div class="row"><div class="col-md-12"><br><br> </div></div>
					
					<div class="form-group row"><br>
						<label for="userfile" class="col-md-5 col-form-label">Upload Excelsheet </label>
						<div class="col-md-7">
							<input type="file" class="" id="userfile"  name="userfile"  required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
						</div>
					</div>
									
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-dark">Upload</button>
				</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" id="customDates" tabindex="-1" aria-labelledby="customDatesLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header bd-primary">
			<h5 class="modal-title" id="customDatesLabel">Filter Data For Custom Dates</h5>
			</div>
		  <form action="<?php echo site_url('Admin/GratificationDateFilter'); ?>" method="post"> 
		  <div class="modal-body">
			
				<div class="form-group row">
					<label class="col-md-12 label-control text-bold-700" ><h6>Please choose a date range</h6></label>
				</div>	
				
				<div class="form-group row">
					<label class="col-md-4 label-control text-bold-700" ><h6>Start Date</h6></label>
					<div class="col-md-8" style="padding: 0 !important;"> 
						<input type="date" class="form-control" name="startDate" id="startDate">
					</div>										
				</div>	
				
				<div class="form-group row">
					<label class="col-md-4 label-control text-bold-700" ><h6>End Date </h6></label>
					<div class="col-md-8" style="padding: 0 !important;"> 
						<input type="date" class="form-control" name="endDate" id="endDate">
					</div>										
				</div>												
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Search</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
        <script>
		$(document).ready( function() {
			$('#search').change( function() {
				var filter = $(this).val();
				if(filter == 'custom'){
					$("#go-btn").attr('disabled','true');
					$("#customDates").modal('show');
				}  else {
					$("#customDates").hide('show');
					$("#go-btn").removeAttr('disabled');
				} 
			});
		});
		</script>
      
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
        <script src="<?php echo base_url() ?>assets/admin/js/app.min.js"></script>
		<script>
		$('#myDataTable').dataTable( {
			"pageLength": 50
		});
		</script>
		

    </body>
</html>