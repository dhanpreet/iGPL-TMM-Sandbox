<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Global Leaderboard</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, user-scalable=0">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontend/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>assets/frontend/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/frontend/js/bootstrap.min.js"></script>
	
	<!-- For fontawesome icons -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/css/all.css" rel="stylesheet">
	<script defer src="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/js/all.js"></script>
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/style.css">
	<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/frontend/js/main.js"></script>  -->
	
	
	<style>
	
	.nav {
		position: fixed;
		bottom: 0;
		width: 600px;
		margin:0 auto;
		max-width:100%;
		height: 40px;
		/* box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);  */
		background-color: #ffffff;
		display: flex;
		
		border:none !important;
	}

	
	

	</style>
   	
	<style>
    	.leader-header{
		align-items: center;
		display: flex;
		height: 60px;
		left: 50%;
		max-width: 600px;
		position: absolute;
		transform: translate(-50%,0px);
		width: 100%;
		z-index: 2;
    }
    .lederboard-inner{
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 100%;
	  margin-top: 5px;
    }
    span.second-position {
		display: block;
		background: #8d80b8;
		color: #fff;
		border-radius: 50%;
		height: 50px;
		width: 50px;
		vertical-align: middle;
		line-height: 50px;
		font-size: 18px;
		font-weight: 600;
	}
	span.first-position {
		display: block;
		background: #a694c4;
		border-radius: 50%;
		height: 100px;
		width: 100px;
		line-height: 100px;
	}
	span.second-text {
		color: #fff;
		position: relative;
		top: 4px;
	}
	span.first-text {
		color: #fff;
		position: relative;
		top: 4px;
		font-size: 20px;
	}
	span.second-position, span.second-text {
		position: relative;
		top: 30px;
	}
	.leader-table
	{
	  position: relative;
	  top:-44px;
	}
	table.table.leaderboard-table td {
		border: 0;
		text-align: center;
		line-height: 3;
	}
	table.table.leaderboard-table
	{
		  position: relative;
		width: 100%;
		top: -60px;
		left: 0;
	}
	table.table.leaderboard-table tr.selected-board td {
		color: #fff;
	}
	.header-center
	{
		color: #fff;
		font-size: 16px;
		font-weight: 600;
		/* margin-left: 20px; */
		text-transform: capitalize;
		display: block;
		width: 80%;
		text-align: center;
	}

	.create-btn-text{
		background: linear-gradient(to right,#3E51B5,#3957EA) !important; 
		
	}

	.header-text{
		padding:5px 0 5px 0 !important; 
		color:#fff;
		background: linear-gradient(to right,#fa687e,#fdb165);
		border-radius: 0 15px;
	}
	.winner-tab{
		text-align: center !important;
		text-align: -webkit-center !important;
		text-align: -moz-center !important;
	}
	

	@media only screen and (max-width: 600px){	
		.limit {
			font-size : 2.5vw;
		}
	}
	.fw-400{
		font-weight:400 !important;
	}
	</style>
	
</head>
<body style="background:#fff">
<div id="load"></div>


<?php

function obfuscate_email_short($email){
	
    $em   = explode("@",$email);
	$name = implode('@', array_slice($em, 0, count($em)-1));
	$len  = floor(strlen($name));
	
	if(!empty($em[0])){
		return @$em[0];
	} else {
		return substr($name,0, 12); 
	}
}

function obfuscate_email($email){
   
	$em   = explode("@",$email);
   //return @$em[0].'@' . 'xxxxxxxxx' ; 
    return @$em[0]; 
}

$logged_in_userid = $this->session->userdata('userId');

 ?>

<section class="main">
	<div class="f1lhk7ql">
		<a href="<?php echo site_url('') ?>"><i class="f1iowekn fa fa-arrow-left fa-lg text-white"></i></a>
		<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);">Global Leaderboard</div>
	</div>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade active in" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">		  
			
			<div class="global-leaderboard" >				
					
					<div class=" leader-container relative">
						<img src="<?php echo base_url() ?>assets/frontend/img/bg/2.jpg" style="width:100%; max-height:300px;">
						<div class="lederboard-inner container">
						<div class="row">
							<div class="col-xs-4" align="center" style="padding: 0 0 0 0 !important;">
								<span class="second-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-silver.png" style="width:65%"></span>
								<?php if(!empty($weeklyGlobalLeaderboard[1]['user_phone'])) { ?>
									<span class="second-text fw-400">
									<?php
									if(!empty($weeklyGlobalLeaderboard[1]['user_phone']) && $weeklyGlobalLeaderboard[1]['user_fake'] == 1) {
										$phone = substr($weeklyGlobalLeaderboard[1]['user_phone'],2, 10);
										echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
									} else {
										if(!empty($weeklyGlobalLeaderboard[1]['user_full_name'])){
											echo ucwords($weeklyGlobalLeaderboard[1]['user_full_name']);
										
										} else if(!empty($weeklyGlobalLeaderboard[1]['user_email'])){
											echo obfuscate_email($weeklyGlobalLeaderboard[1]['user_email']);
											
										} else if(!empty($weeklyGlobalLeaderboard[1]['user_phone'])){
										
											$phone = substr($weeklyGlobalLeaderboard[1]['user_phone'],2, 10);
											echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
										
										} else {
											echo "NA";
										
										}
									}
									?>
									</span>
								<?php } else { ?>
									<span class="second-text fw-400">NA</span>
								<?php } ?>
							</div> 
							
							<div class="col-xs-4" align="center" style="padding: 0 0 0 0 !important;">
							<span class="first-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-gold.png" style="width:75%"></span> 
								<?php if(!empty($weeklyGlobalLeaderboard[0]['user_phone'])) { ?>
									<span class="first-text fw-400">
									<?php
									if(!empty($weeklyGlobalLeaderboard[0]['user_phone']) && $weeklyGlobalLeaderboard[0]['user_fake'] == 1) {
										$phone = substr($weeklyGlobalLeaderboard[0]['user_phone'],2, 10);
										echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
									} else {
										if(!empty($weeklyGlobalLeaderboard[0]['user_full_name'])){
											echo ucwords($weeklyGlobalLeaderboard[0]['user_full_name']);
										
										} else if(!empty($weeklyGlobalLeaderboard[0]['user_email'])){
											echo obfuscate_email($weeklyGlobalLeaderboard[0]['user_email']);
											
										} else if(!empty($weeklyGlobalLeaderboard[0]['user_phone'])){
										
											$phone = substr($weeklyGlobalLeaderboard[0]['user_phone'],2, 10);
											echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
										
										} else {
											echo "NA";
										
										}
									}
									?>
									</span>
								<?php } else { ?>
									<span class="first-text fw-400">NA</span>
								<?php } ?>
							</div>
							
							<div class="col-xs-4" align="center" style="padding: 0 0 0 0 !important;">
							<span class="second-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-bronze.png" style="width:65%"></span> 
								<?php if(!empty($weeklyGlobalLeaderboard[2]['user_phone'])) { ?>
									<span class="second-text fw-400">
									<?php
									if(!empty($weeklyGlobalLeaderboard[2]['user_phone']) && $weeklyGlobalLeaderboard[2]['user_fake'] == 1) {
										$phone = substr($weeklyGlobalLeaderboard[2]['user_phone'],2, 10);
										echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
									} else {
										if(!empty($weeklyGlobalLeaderboard[2]['user_full_name'])){
											echo ucwords($weeklyGlobalLeaderboard[2]['user_full_name']);
										
										} else if(!empty($weeklyGlobalLeaderboard[2]['user_email'])){
											echo obfuscate_email($weeklyGlobalLeaderboard[2]['user_email']);
										
										} else if(!empty($weeklyGlobalLeaderboard[2]['user_phone'])){
										
											$phone = substr($weeklyGlobalLeaderboard[2]['user_phone'],2, 10);
											echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
											
										}  else {
											echo "NA";
										
										}
									}
									?>
									</span>
								<?php } else { ?>
									<span class="second-text fw-400">NA</span>
								<?php } ?>
							</div>
						</div>
						
						</div>
					</div>
					<div class="leader-table">
					  <img src="<?php echo base_url() ?>assets/frontend/img/leader-back-strip2.png" style="width:100%">
					  <div class="container relative">
						<table class="table leaderboard-table">
						
						<?php if(is_array($weeklyGlobalLeaderboard) && count($weeklyGlobalLeaderboard)>0){ ?>
							<?php $weekRowCount = 1;  ?>
							<?php foreach($weeklyGlobalLeaderboard as $weekRow){ ?>
								
								<tr <?php if(!empty($logged_in_userid) && $logged_in_userid == $weekRow['user_id']){ echo "style='background:#e1e0e0;'"; } ?> >
								  <td><?php echo $weekRowCount; ?></td>
								  <td>
									<?php if($weekRow['user_login_type'] == '1') { ?>
										<img src="<?php echo base_url() ?>uploads/site_users/<?php echo $weekRow['user_image'] ?>" width="40" style="border:2px solid #7b6a93; border-radius:50%;">
									<?php } else { ?>
										<img src="<?php echo $weekRow['user_image'] ?>" width="40" style="border:2px solid #ccc; border-radius:50%;">
									<?php } ?>
						  
								  </td>
								  <td>
								  
								  
									<?php
									if(!empty($weekRow['user_phone']) && $weekRow['user_fake'] == 1) {
										$phone = substr($weekRow['user_phone'],2, 10);
										echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
									} else {
										if(!empty($weekRow['user_full_name'])){
											echo ucwords($weekRow['user_full_name']);
										
										} else if(!empty($weekRow['user_email'])){
											echo obfuscate_email($weekRow['user_email']);
																				
										} else if(!empty($weekRow['user_phone'])){
										
											$phone = substr($weekRow['user_phone'],2, 10);
											echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
										
										}  else {
											echo "NA";
										
										}
									}
									?>
								  
								  </td>
								  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> <?php echo ($weekRow['no_points']); ?></td>
								</tr>
						
								
								<?php $weekRowCount++;  ?>
							<?php } ?>
						<?php } ?>
						
						<?php if($myWeeklyRank > 50 && !empty($myWeeklyRankList['user_id'])){ ?>
							
							<tr <?php if(!empty($logged_in_userid) && $logged_in_userid == $myWeeklyRankList['user_id']){ echo "style='background:#e1e0e0;'"; } ?> >
								  <td><?php echo $myWeeklyRank; ?></td>
								  <td>
									<?php if($myWeeklyRankList['user_login_type'] == '1') { ?>
										<img src="<?php echo base_url() ?>uploads/site_users/<?php echo @$myWeeklyRankList['user_image'] ?>" width="40" style="border:2px solid #7b6a93; border-radius:50%;">
									<?php } else { ?>
										<img src="<?php echo @$myWeeklyRankList['user_image'] ?>" width="40" style="border:2px solid #ccc; border-radius:50%;">
									<?php } ?>
						  
								  </td>
								  <td>
								  
								  
									<?php
									
									    if(!empty($myWeeklyRankList['user_full_name'])){
											echo ucwords($myWeeklyRankList['user_full_name']);
										
										} else if(!empty($myWeeklyRankList['user_email'])){
											echo obfuscate_email($myWeeklyRankList['user_email']);
										
										} else if(!empty($myWeeklyRankList['user_phone'])){
										
											$phone = substr($myWeeklyRankList['user_phone'],2, 10);
											echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
										
										}  else {
											echo "NA";
										
										}
									
									?>
								  
								  </td>
								  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> <?php echo ($myWeeklyRankList['no_points']); ?></td>
								</tr>
						<?php } ?>
						
					<!--	
						<tr>
						  <td>1</td>
						  <td><img src="<?php echo base_url() ?>uploads/site_users/3.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
						  <td>927xxxx679</td>
						  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 586</td>
						</tr>
						
						<tr>
						  <td>2</td>
						  <td><img src="<?php echo base_url() ?>uploads/site_users/4.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
						  <td>894xxxx555</td>
						  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 499</td>
						</tr>
						
						<tr>
						  <td>3</td>
						  <td><img src="<?php echo base_url() ?>uploads/site_users/5.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
						  <td>997xxxx009</td>
						  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 467</td>
						</tr>
						
						<tr>
						  <td>4</td>
						  <td><img src="<?php echo base_url() ?>uploads/site_users/6.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
						  <td>324xxxx809</td>
						  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 456</td>
						</tr>
						
						<tr>
						  <td>5</td>
						  <td><img src="<?php echo base_url() ?>uploads/site_users/7.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
						  <td>345xxxx999</td>
						  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 345</td>
						</tr>
						
						-->
					  </table>
					  
					
					  </div>
				  </div>
				</div>
			</div>
	
		<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
		<div class="global-leaderboard">				
			
			<div class="leader-container relative">
				<img src="<?php echo base_url() ?>assets/frontend/img/bg/2.jpg" style="width:100%; max-height:300px;">
				<div class="lederboard-inner container">
				<div class="row">
					<div class="col-xs-4" align="center" style="padding: 0 0 0 0 !important;">
						<span class="second-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-silver.png" style="width:65%"></span>
						<?php if(!empty($monthlyGlobalLeaderboard[1]['user_phone'])) { ?>
							<span class="second-text fw-400">
							<?php
							if(!empty($monthlyGlobalLeaderboard[1]['user_phone']) && $monthlyGlobalLeaderboard[1]['user_fake'] == 1) {
								$phone = substr($monthlyGlobalLeaderboard[1]['user_phone'],2, 10);
								echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
							} else {
								if(!empty($monthlyGlobalLeaderboard[1]['user_full_name'])){
									echo ucwords($monthlyGlobalLeaderboard[1]['user_full_name']);
								
								} else if(!empty($monthlyGlobalLeaderboard[1]['user_email'])){
									echo obfuscate_email($monthlyGlobalLeaderboard[1]['user_email']);
									
								} else if(!empty($monthlyGlobalLeaderboard[1]['user_phone'])){
								
									$phone = substr($monthlyGlobalLeaderboard[1]['user_phone'],2, 10);
									echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
									
								}  else {
									echo "NA";
								
								}
							}
							?>
							</span>
						<?php } else { ?>
							<span class="second-text fw-400">NA</span>
						<?php } ?>
					</div> 
					
					<div class="col-xs-4" align="center" style="padding: 0 0 0 0 !important;">
					<span class="first-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-gold.png" style="width:75%"></span> 
						<?php if(!empty($monthlyGlobalLeaderboard[0]['user_phone'])) { ?>
							<span class="first-text fw-400">
							<?php
							if(!empty($monthlyGlobalLeaderboard[0]['user_phone']) && $monthlyGlobalLeaderboard[0]['user_fake'] == 1) {
								$phone = substr($monthlyGlobalLeaderboard[0]['user_phone'],2, 10);
								echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
							} else {
								if(!empty($monthlyGlobalLeaderboard[0]['user_full_name'])){
									echo ucwords($monthlyGlobalLeaderboard[0]['user_full_name']);
								
								} else if(!empty($monthlyGlobalLeaderboard[0]['user_email'])){
									echo obfuscate_email($monthlyGlobalLeaderboard[0]['user_email']);
								
								} else if(!empty($monthlyGlobalLeaderboard[0]['user_phone'])){
								
									$phone = substr($monthlyGlobalLeaderboard[0]['user_phone'],2, 10);
									echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
								
								} else {
									echo "NA";
								
								}
							}
							?>
							</span>
						<?php } else { ?>
							<span class="first-text fw-400">NA</span>
						<?php } ?>
					</div>
					
					<div class="col-xs-4" align="center" style="padding: 0 0 0 0 !important;">
					<span class="second-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-bronze.png" style="width:65%"></span> 
						<?php if(!empty($monthlyGlobalLeaderboard[2]['user_phone'])) { ?>
							<span class="second-text fw-400">
							<?php
							if(!empty($monthlyGlobalLeaderboard[2]['user_phone']) && $monthlyGlobalLeaderboard[2]['user_fake'] == 1) {
								$phone = substr($monthlyGlobalLeaderboard[2]['user_phone'],2, 10);
								echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
							} else {
								if(!empty($monthlyGlobalLeaderboard[2]['user_full_name'])){
									echo ucwords($monthlyGlobalLeaderboard[2]['user_full_name']);
								
								} else if(!empty($monthlyGlobalLeaderboard[2]['user_email'])){
									echo obfuscate_email($monthlyGlobalLeaderboard[2]['user_email']);
									
								} else if(!empty($monthlyGlobalLeaderboard[2]['user_phone'])){
								
									$phone = substr($monthlyGlobalLeaderboard[2]['user_phone'],2, 10);
									echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
									
								} else {
									echo "NA";
								
								}
							}
							?>
							</span>
						<?php } else { ?>
							<span class="second-text fw-400">NA</span>
						<?php } ?>
					</div>
				</div>
				</div>
			</div>
			<div class="leader-table">
			  <img src="<?php echo base_url() ?>assets/frontend/img/leader-back-strip2.png" style="width:100%">
			  <div class="container relative">
				<table class="table leaderboard-table" >
				
				<?php if(is_array($monthlyGlobalLeaderboard) && count($monthlyGlobalLeaderboard)>0){ ?>
					<?php $monthRowCount = 1;  ?>
					<?php foreach($monthlyGlobalLeaderboard as $monthRow){ ?>
					
						<tr <?php if(!empty($logged_in_userid) && $logged_in_userid == $monthRow['user_id']){ echo "style='background:#e1e0e0;'"; } ?>>
						  <td><?php echo $monthRowCount; ?></td>
						  <td>
							<?php if($monthRow['user_login_type'] == '1') { ?>
								<img src="<?php echo base_url() ?>uploads/site_users/<?php echo $monthRow['user_image'] ?>" width="40" style="border:2px solid #7b6a93; border-radius:50%;">
							<?php } else { ?>
								<img src="<?php echo $monthRow['user_image'] ?>" width="40" style="border:2px solid #ccc; border-radius:50%;">
							<?php } ?>
				  
						  </td>
						  <td>
						  
						  
							<?php
							if(!empty($monthRow['user_phone']) && $monthRow['user_fake'] == 1) {
								$phone = substr($monthRow['user_phone'],2, 10);
								echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
							} else {
								if(!empty($monthRow['user_full_name'])){
									echo ucwords($monthRow['user_full_name']);
								
								} else if(!empty($monthRow['user_email'])){
									echo obfuscate_email($monthRow['user_email']);
										
								} else if(!empty($monthRow['user_phone'])){
								
									$phone = substr($monthRow['user_phone'],2, 10);
									echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3);
									
								} else {
									echo "NA";
								}
							}
							?>
						  
						  </td>
						  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> <?php echo ($monthRow['no_points']); ?></td>
						</tr>
				
						<?php $monthRowCount++;  ?>
					<?php } ?>
				<?php } ?>
				
				<?php if($myMonthlyRank > 50 && !empty($myMonthlyRankList['user_id'])){ ?>
							
							<tr <?php if(!empty($logged_in_userid) && $logged_in_userid == $myMonthlyRankList['user_id']){ echo "style='background:#e1e0e0;'"; } ?> >
								  <td><?php echo $myMonthlyRank; ?></td>
								  <td>
									<?php if($myMonthlyRankList['user_login_type'] == '1') { ?>
										<img src="<?php echo base_url() ?>uploads/site_users/<?php echo @$myMonthlyRankList['user_image'] ?>" width="40" style="border:2px solid #7b6a93; border-radius:50%;">
									<?php } else { ?>
										<img src="<?php echo @$myMonthlyRankList['user_image'] ?>" width="40" style="border:2px solid #ccc; border-radius:50%;">
									<?php } ?>
						  
								  </td>
								  <td>
								  
								  
									<?php
										if(!empty($myMonthlyRankList['user_full_name'])){
											echo ucwords($myMonthlyRankList['user_full_name']);
										
										} else if(!empty($myMonthlyRankList['user_email'])){
											echo obfuscate_email($myMonthlyRankList['user_email']);
											
										} else if(!empty($myMonthlyRankList['user_phone'])){
										
											$phone = substr($myMonthlyRankList['user_phone'],2, 10);
											echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
											
										} else {
											echo "NA";
										
										}
									?>
								  
								  </td>
								  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> <?php echo ($myMonthlyRankList['no_points']); ?></td>
								</tr>
						<?php } ?>
						
				
				<!--
				<tr>
				  <td>1</td>
				  <td><img src="<?php echo base_url() ?>uploads/site_users/4.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
				  <td>894xxxx555</td>
				  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 999</td>
				</tr>
				
				<tr>
				  <td>2</td>
				  <td><img src="<?php echo base_url() ?>uploads/site_users/3.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
				  <td>927xxxx679</td>
				  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 956</td>
				</tr>
				
				
				
				<tr>
				  <td>3</td>
				  <td><img src="<?php echo base_url() ?>uploads/site_users/5.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
				  <td>997xxxx009</td>
				  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 907</td>
				</tr>
				
				<tr>
				  <td>4</td>
				  <td><img src="<?php echo base_url() ?>uploads/site_users/6.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
				  <td>324xxxx809</td>
				  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 756</td>
				</tr>
				
				<tr>
				  <td>5</td>
				  <td><img src="<?php echo base_url() ?>uploads/site_users/7.png" width="40" style="border:2px solid #7b6a93; border-radius:50%;"></td>
				  <td>345xxxx999</td>
				  <td> <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" width="16"> 545</td>
				</tr>
				
				-->
			  </table>
			  
			
			  </div>
		  </div>
		</div>

	
	</div>

	
	</div>
		
		
		
</section>


<nav class="nav nav-pills" id="pills-tab" role="tablist">

<a class="nav__link nav__link--active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Weekly</a>


 <a class="nav__link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Monthly</a>

</nav>



<!-- Scripts -->


<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>
 
 

<script>
$(document).ready(function() {
    $('.nav__link').click(function(){
		$('.nav__link').removeClass('nav__link--active');
		$(this).addClass('nav__link--active');
		// $("html, body").animate({ scrollTop: 0 }, "slow");
		window.scrollTo({ top: 0, behavior: 'smooth' });
	});
});
</script>
 
 
 
</body>
</html>