<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title> Tournaments</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, user-scalable=0">


	<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontend/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>assets/frontend/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/frontend/js/bootstrap.min.js"></script>
	
	<!-- For fontawesome icons -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/css/all.css" rel="stylesheet">
	<script defer src="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/js/all.js"></script>
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/style_theme_2.css">
	
	<style>
		
		
		.btn-outline{
			/*  border:2px solid #5c71db;  */
			color:#fff;
			border-radius:20px;
		}
		.btn-outline:hover{
			background:linear-gradient(to right,#5505d8, #f34b6a);
			
			/*  border:2px solid #5c71db;  */
			color:#fff;
			font-weight:600;
		}
		
		.btn-filled{
			background:#3fd53f !important;
		
			color:#fff;
			border-radius:20px;
			font-weight:600;
			width:75%;
		}
		.btn-filled:hover{
			background:linear-gradient(to right,#5505d8, #f34b6a);
			/*  border:2px solid #5c71db;  */
			color:#fff;
			font-weight:600;
		}
		
		
		.bg-row{
			
			/* border-bottom: 1px solid #fff; */
			
		}


		.come-in {
		  transform: translateY(150px);
		  animation: come-in 0.5s ease forwards;
		}
		.come-in:nth-child(odd) {
		  animation-duration: 0.3s;
		}
		.already-visible {
		  transform: translateY(0);
		  animation: none;
		}

		@keyframes come-in {
		  to { transform: translateY(0); }
		}
	</style>
	
</head>
<body>
<div id="load"></div>

	<section>
		<div class="f1lhk7ql">
			<a href="<?php echo site_url('') ?>"><img class="f1iowekn" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14"></a>
			<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);">Tournament History</div>
		</div>
		<div class="container" style="margin-top : 64px ; color : white;">
			<div class="row">
			<?php if($quickTournaments) { ?>	
			<a href="#" id="public_tournament" class=" col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 btn btn-primary">Public Tournament</a>
				
				<a href="#" id="private_tournament" class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 btn btn-primary">Private Tournament</a>
				<?php } ?>
			</div>
		</div>
		<div class="container" style="display:none" id="private_tournament_content">
			<div class="row" style="margin-bottom: 80px">
				<div class="col-xs-12 padd auto-margin games_area"> 
					
				</div>
			</div>
			<?php if(is_array($tournamentsList) && count($tournamentsList)>0 ){ ?>
				<!-- <div class="row text-left "> <h5 class="text-bold">&nbsp;&nbsp; Tournaments History</h5> </div>  -->
				
				<?php foreach($tournamentsList as $tRow ){ ?>
				
				<?php 
					$today = time();
					$startDate = $tRow['t_start_date']." ".$tRow['t_start_time'].":00";
					$startDate = strtotime($startDate);

					$endDate = $tRow['t_end_date']." ".$tRow['t_end_time'].":00";
					$endDate = strtotime($endDate);

					$t_current_status = 0;     //1=CurrentlyWorking   2=Expired   3=futureTournament
					if($startDate > $today){
						$t_current_status = 3;
					} else if($endDate < $today){
						$t_current_status = 2;
					} else if($startDate <= $today && $endDate >= $today){
						$t_current_status = 1;
					}
				?>
				
					<div class="row bg-row module">
						<?php  if($t_current_status == 1) { ?>
							<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right"> 
								<h5 class="text-danger blink_me"><i class="fa fa-play"></i> Live </h5>
							</div>
						<?php }  else { echo "<br>"; }  ?>
					
						
							<div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 text-left " style="padding:5px;">
								
								<img class="img-responsive" style="padding:3px; border:2px solid #ccc; border-radius:10px; " src="<?php echo base_url('uploads/640X360/'.$tRow['t_game_image']) ?>" />
							</div>
							
							<div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 text-left">
								<h4 class="text-bold text-white" style="margin-top:5px !important;" > <?php echo $tRow['t_game_name']; ?></h4>
								<p class="text-white">
								
									<i class="fa fa-calendar-alt"></i> &nbsp;
									<?php echo date('j M', strtotime($tRow['t_start_date'])); ?> 
									<?php if($tRow['t_start_date'] != $tRow['t_end_date']) { ?>
									- <?php echo date('j M', strtotime($tRow['t_end_date'])); ?>
									<?php } ?>
									
								<br>	
									<i class="fa fa-clock"></i> &nbsp; 
										<?php echo date('h:i A', strtotime($tRow['t_start_time'])); ?> 
										- <?php echo date('h:i A', strtotime($tRow['t_end_time'])); ?> 
								</p>
								
								<!-- <div class="row">
									<div class="col-3 col-xs-3 col-sm-3 col-md-3 col-lg-3 text-left">
										<p class="text-white">Rank <br>#<?php echo $tRow['player_reward_rank']; ?>
									</div>
									<div class="col-9 col-xs-9 col-sm-9 col-md-9 col-lg-9 text-left">
										<p class="text-white">Prize </br> Daraz voucher of ৳ <?php echo $tRow['player_reward_prize']; ?>
									</div>
								</div> -->
							
							</div>
							
							
							<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right" style="padding:0 !important; padding-bottom:5px !important;">

								<?php /*  if($t_current_status == 1) { ?>
								<div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
									<a href="<?php echo site_url('Tournaments/'.base64_encode($tRow['t_id'])) ?>" class="btn btn-filled">Details &nbsp;<i class="fa fa-angle-right"></i></a>
								</div>
								<div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
									<a href="<?php echo site_url('PlayTournament/'.base64_encode($tRow['t_id'])) ?>" class="btn btn-filled">Play Now &nbsp;<i class="fa fa-angle-right"></i></a>
								</div>
								<?php } else if($t_current_status == 2) { ?>
									<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
										<a href="<?php echo site_url('TournamentLeaderboard/'.base64_encode($tRow['t_id'])) ?>" class="btn btn-filled">Show Results &nbsp;<i class="fa fa-angle-right"></i></a>
									</div>
								<?php } else if($t_current_status == 3) { ?>
									<?php $loggedinUser = $this->session->userdata('userId'); ?>
									<?php if($tRow['t_user_id'] == $loggedinUser){ ?>
										<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
											<a href="<?php echo site_url('Tournaments/'.base64_encode($tRow['t_id'])) ?>" class="btn btn-filled">Details &nbsp;<i class="fa fa-angle-right"></i></a>
										</div>
									<?php } else { ?>
										<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
											<a href="<?php echo site_url('TournamentInfo/'.base64_encode($tRow['t_share_code'])) ?>" class="btn btn-filled">Details &nbsp;<i class="fa fa-angle-right"></i></a> 
										</div>
									<?php } ?>
								<?php } */  ?>
								
							</div>
							
					</div>
				
					<div class="row"> <br> <hr></div>
				
				<?php } ?>
				<?php } else { ?>
					<div class="row"> <br><br> <br><br> <br><br>  </div>
					
					<div class="row">
						<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"> 
							<img src="<?php echo base_url('assets/frontend/img/no-tournaments.png') ?>" width="30%"/><br>
							
							<h3 class="text-bold text-white" style="margin-top:10px !important;"> No  history found yet!</h3>
							<br>
							
						</div>
					</div>
				
				<?php }  ?>
				
				<div class="row"> <br> <br> </div>
			
		   
		</div>
		<div class="container" id="public_tournament_content">
			<div class="row" style="margin-bottom: 80px">
				<div class="col-xs-12 padd auto-margin games_area"> 
					
				</div>
			</div>
			<?php if(is_array($tournamentResult) && count($tournamentResult)>0 ){ ?>
				<!-- <div class="row text-left "> <h5 class="text-bold">&nbsp;&nbsp; Tournaments History</h5> </div>  -->
				
				<?php foreach($tournamentResult as $tRow ){ ?>
				
				<?php 
					$today = time();
					$startDate = $tRow['tournament_start_date']." ".$tRow['tournament_start_time'].":00";
					$startDate = strtotime($startDate);

					$endDate = $tRow['tournament_end_date']." ".$tRow['tournament_end_time'].":00";
					$endDate = strtotime($endDate);

					$t_current_status = 0;     //1=CurrentlyWorking   2=Expired   3=futureTournament
					if($startDate > $today){
						$t_current_status = 3;
					} else if($endDate < $today){
						$t_current_status = 2;
					} else if($startDate <= $today && $endDate >= $today){
						$t_current_status = 1;
					}
				?>
				
					<div class="row bg-row module">
						<?php  if($t_current_status == 1) { ?>
							<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right"> 
								<h5 class="text-danger blink_me"><i class="fa fa-play"></i> Live </h5>
							</div>
						<?php }  else { echo "<br>"; }  ?>
					
						
							<div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 text-left " style="padding:5px;">
								
								<img class="img-responsive" style="padding:3px; border:2px solid #ccc; border-radius:10px; " src="<?php echo base_url('uploads/640X360/'.$tRow['tournament_game_image']) ?>" />
							</div>
							
							<div class="col-8 col-xs-8 col-sm-8 col-md-8 col-lg-8 text-left">
								<h4 class="text-bold text-white" style="margin-top:5px !important;" > <?php echo $tRow['tournament_game_name']; ?></h4>
								<p class="text-white">
								
									<i class="fa fa-calendar-alt"></i> &nbsp;
									<?php echo date('j M', strtotime($tRow['tournament_start_date'])); ?> 
									<?php if($tRow['tournament_start_date'] != $tRow['tournament_end_date']) { ?>
									- <?php echo date('j M', strtotime($tRow['tournament_end_date'])); ?>
									<?php } ?>
									
								<br>	
									<i class="fa fa-clock"></i> &nbsp; 
										<?php echo date('h:i A', strtotime($tRow['tournament_start_time'])); ?> 
										- <?php echo date('h:i A', strtotime($tRow['tournament_end_time'])); ?> 
								</p>
								
								<div class="row">
									<div class="col-3 col-xs-3 col-sm-3 col-md-3 col-lg-3 text-left">
										<p class="text-white">Rank <br>#<?php echo $tRow['player_reward_rank']; ?>
									</div>
									<div class="col-9 col-xs-9 col-sm-9 col-md-9 col-lg-9 text-left">
										<p class="text-white">Prize </br>  <?php echo $tRow['player_reward_prize']; ?>
									</div>
								</div>
							
							</div>
							
							
							<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right" style="padding:0 !important; padding-bottom:5px !important;">

								<?php /*  if($t_current_status == 1) { ?>
								<div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left">
									<a href="<?php echo site_url('Tournaments/'.base64_encode($tRow['t_id'])) ?>" class="btn btn-filled">Details &nbsp;<i class="fa fa-angle-right"></i></a>
								</div>
								<div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
									<a href="<?php echo site_url('PlayTournament/'.base64_encode($tRow['t_id'])) ?>" class="btn btn-filled">Play Now &nbsp;<i class="fa fa-angle-right"></i></a>
								</div>
								<?php } else if($t_current_status == 2) { ?>
									<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
										<a href="<?php echo site_url('TournamentLeaderboard/'.base64_encode($tRow['t_id'])) ?>" class="btn btn-filled">Show Results &nbsp;<i class="fa fa-angle-right"></i></a>
									</div>
								<?php } else if($t_current_status == 3) { ?>
									<?php $loggedinUser = $this->session->userdata('userId'); ?>
									<?php if($tRow['t_user_id'] == $loggedinUser){ ?>
										<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
											<a href="<?php echo site_url('Tournaments/'.base64_encode($tRow['t_id'])) ?>" class="btn btn-filled">Details &nbsp;<i class="fa fa-angle-right"></i></a>
										</div>
									<?php } else { ?>
										<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
											<a href="<?php echo site_url('TournamentInfo/'.base64_encode($tRow['t_share_code'])) ?>" class="btn btn-filled">Details &nbsp;<i class="fa fa-angle-right"></i></a> 
										</div>
									<?php } ?>
								<?php } */  ?>
								
							</div>
							
					</div>
				
					<div class="row"> <br> <hr></div>
				
				<?php } ?>
				<?php } else { ?>
					<div class="row"> <br><br> <br><br> <br><br>  </div>
					
					<div class="row">
						<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"> 
							<img src="<?php echo base_url('assets/frontend/img/no-tournaments.png') ?>" width="30%"/><br>
							
							<h3 class="text-bold text-white" style="margin-top:10px !important;"> No  history found yet!</h3>
							<br>
							
						</div>
					</div>
				
				<?php }  ?>
				
				<div class="row"> <br> <br> </div>
			
		   
		</div>
	</section>
	
	<!-- Footer-Content -->
		<?php include "footer.php"; ?>
	<!-- Footer Content End -->


<script>
(function($) {

  $.fn.visible = function(partial) {
    
      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
    
    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };
    
})(jQuery);

var win = $(window);

var allMods = $(".module");


allMods.each(function(i, el) {
  var el = $(el);
  if (el.visible(true)) {
     el.addClass("already-visible"); 
  } 
});

win.scroll(function(event) {
  
  allMods.each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      el.addClass("come-in"); 
    } 
  });
  
});  
</script>
<script>
	$(document).ready(function(){
		$('#public_tournament').click(function()
		{
			$('#private_tournament_content').fadeOut('fast');
			$('#public_tournament_content').fadeIn('fast');
			
		})
	})
</script>
<script>
	$(document).ready(function(){
		$('#private_tournament').click(function()
		{
			$('#public_tournament_content').fadeOut('fast');
			$('#private_tournament_content').fadeIn('fast');
			
		})
	})
</script>
<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>
</body>
</html>