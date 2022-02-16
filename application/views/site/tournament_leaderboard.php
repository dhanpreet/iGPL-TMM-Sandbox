<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Tournament</title>
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
		font-size: 18px;
		
	}
	
	
	span.second-position, span.second-text {
		position: relative;
		top: 30px;
	}
	.leader-table{
	  position: relative;
	  top:-44px;
	}
	table.table.leaderboard-table td {
		border: 0;
		text-align: center;
		line-height: 5;
	}
	table.table.leaderboard-table
	{
		position: absolute;
		width: 100%;
		top: -86px;
		left: 0;
	}
	table.table.leaderboard-table tr.selected-board td {
		color: #fff;
	}
	.header-center{
		color: #fff;
		font-size: 16px;
		font-weight: 600;
		
		text-transform: capitalize;
		display: block;
		width: 100%;
		text-align: center;
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
	
	</style>
	
</head>
<body style="background:#fff">
<div id="load"></div>
<?php
/*
function obfuscate_email_short($email){
   $em   = explode("@",$email);
   $name = implode('@', array_slice($em, 0, count($em)-1));
   $len  = floor(strlen($name));
	return substr($name,0, 12); 
	
}

*/

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

function obfuscate_email($email)
{
   /* $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/3);
    return substr($name,0, $len) . str_repeat('x', $len) . "@" . end($em); 
*/

/*
	$em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name));
	if($len <=12)
		return substr($name,0, 12).'@' . 'xxxxxxx' ; 
	else 
		return substr($name,0, 12). 'xxxxxxx' ; 
*/

	$em   = explode("@",$email);
   //return @$em[0].'@' . 'xxxxxxxxx' ; 
    return @$em[0]; 
	
	
}

 ?>

	<section>
	<div class="container padd">
		<div class="leader-header">
			<?php $logged_user_id = $this->session->userdata('userId'); ?>
			
			<?php
			$previousUrl= @$_SERVER['HTTP_REFERER'];
			$tHistoryUrl = site_url('tournamentHistory'); 
			?>
			
			<?php if($tournamentInfo['t_user_id'] == $logged_user_id){ ?>
				<a href="javascript:history.go(-1)"><i class="f1iowekn fa fa-arrow-left fa-lg text-white"></i></a>
			<?php } else { ?>
			
				<?php if($tHistoryUrl == $previousUrl){ ?>
					<a href="<?php echo @$tHistoryUrl; ?>">	
						<i class="f1iowekn fa fa-arrow-left fa-lg text-white"></i>
					</a>
				<?php } else { ?>
					<a href="<?php echo site_url('TournamentInfo/'.base64_encode($tournamentInfo['t_share_code'])) ?>">	
						<i class="f1iowekn fa fa-arrow-left fa-lg text-white"></i>
					</a>
				<?php }  ?>
				
			<?php }  ?>
			
			<div class="header-center" style="text-transform: capitalize; color: rgb(255, 255, 255);">Leaderboard</div>
		</div>
		
		<div class="leader-container relative">
            <img src="<?php echo base_url() ?>assets/frontend/img/leaderboard-back.jpg" style="width:100%">
            
			<div class="lederboard-inner container">
            <?php $winnerType = $tournamentInfo['t_prize_type']; ?>
			<?php if($winnerType == 1){ ?>
				<div class="row">
					
					<div class="col-xs-12 winner-tab" align="center">
						<span class="first-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-gold.png" style="width:75%"></span> 
						<span class="first-text limit"> 
						<?php
							 if(!empty($playersInfo[0]['user_full_name'])){
								echo ucwords($playersInfo[0]['user_full_name']);
							
							} else if(!empty($playersInfo[0]['user_email'])) {
								echo obfuscate_email_short($playersInfo[0]['user_email']);
														
							}  else if(!empty($playersInfo[0]['user_phone'])){
								$ph = substr($playersInfo[0]['user_phone'],2, 10);
								
								echo substr($ph, 0, 3).'XXXX'.substr($ph, 7, 3);
							} 
						?>
						</span>
						<!-- <br><span class="text-white"> (Winner) </span>   -->
					</div>
					
				</div>
			<?php } else { ?>
				<div class="row">
					<div class="col-xs-4" align="center">
						<span class="second-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-silver.png" style="width:65%"></span>
						<span class="second-text limit">
						<?php 
						if(!empty($playersInfo[1]['player_id'])){
							 
							if(!empty($playersInfo[1]['user_full_name'])){
								echo ucwords($playersInfo[1]['user_full_name']);
							
							} else if(!empty($playersInfo[1]['user_email'])) {
								echo obfuscate_email_short($playersInfo[0]['user_email']);
							
							 } else if(!empty($playersInfo[1]['user_phone'])){
								//echo "+".substr($playersInfo[1]['user_phone'], 0, 3).'xxxxxxx'.substr($playersInfo[1]['user_phone'], 10, 2); 
								
								$ph1 = substr($playersInfo[1]['user_phone'],2, 10);
								echo substr($ph1, 0, 3).'xxxx'.substr($ph1, 7, 3); 
							
							} 
						} else { echo "NA";  }
						?>
						</span>
					</div>
					
					<div class="col-xs-4 winner-tab">
						<span class="first-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-gold.png" style="width:75%"></span> 
						<span class="first-text limit">
						<?php 
							if(!empty($playersInfo[0]['user_full_name'])){
								echo ucwords($playersInfo[0]['user_full_name']);
							
							} else if(!empty($playersInfo[0]['user_email'])) {
								echo obfuscate_email_short($playersInfo[0]['user_email']);
							
							} else if(!empty($playersInfo[0]['user_phone'])){
								// echo "+".substr($playersInfo[0]['user_phone'], 0, 3).'xxxxxxx'.substr($playersInfo[0]['user_phone'], 10, 2); 
								$ph2 = substr($playersInfo[0]['user_phone'],2, 10);
								echo substr($ph2, 0, 3).'xxxx'.substr($ph2, 7, 3); 
							
							} 
						?>
						</span>
					</div>
					
					
					<div class="col-xs-4" align="center">
					<span class="second-position"><img src="<?php echo base_url() ?>assets/frontend/img/trophy-bronze.png" style="width:65%"></span> 
					<span class="second-text limit">
					<?php 
						if(!empty($playersInfo[2]['player_id'])){
							
							if(!empty($playersInfo[2]['user_full_name'])){
								echo ucwords($playersInfo[2]['user_full_name']);

							} else if(!empty($playersInfo[2]['user_email'])) {
								echo obfuscate_email_short($playersInfo[0]['user_email']);
								
							} else if(!empty($playersInfo[2]['user_phone'])){
								//echo "+".substr($playersInfo[2]['user_phone'], 0, 3).'xxxxxxx'.substr($playersInfo[2]['user_phone'], 10, 2); 
								$ph2 = substr($playersInfo[2]['user_phone'],2, 10);
								echo substr($ph2, 0, 3).'xxxx'.substr($ph2, 7, 3); 
							
							}
						} else { echo "NA";  }
						?>
					</span>
					</div>
				</div>
			<?php }  ?>
				
				
            </div>
        </div>
		
		<div class="leader-table">
          <img src="<?php echo base_url() ?>assets/frontend/img/leader-back-strip.png" style="width:100%">
          <div class="container relative">
            <table class="table leaderboard-table">
            
			<?php
				if(is_array($playersInfo) && count($playersInfo)>0){
					
					$highest_score = $playersInfo[0]['player_score'];
					$rank = 1;
					$arrIndex = 1;
					foreach($playersInfo as $pRow){ ?>
						<tr class="<?php if($arrIndex == 1){ ?> selected-board <?php } ?>">
						  <td>
							<?php if($arrIndex == 1){ ?>
								<i class="fa fa-trophy"></i>
							<?php 
							} else  {
								if($highest_score !=0 && $pRow['player_score'] == $highest_score){
									echo "<b>".@$rank."</b>"; 
								} else {
									if($pRow['player_score'] >= 0 ){
										$rank++;
										echo "<b>".@$rank."</b>"; 
									} else{
										//echo "<span style='padding-top:10px;'>NA</span>"; 
									}
								}
							}
							?>
						  </td>
						  <td>
							<?php if($pRow['user_login_type'] == '1') { ?>
								<img src="<?php echo base_url() ?>uploads/site_users/<?php echo $pRow['user_image'] ?>" width="40" style="border:2px solid #7b6a93; border-radius:50%;">
							<?php } else { ?>
								<img src="<?php echo $pRow['user_image'] ?>" width="40" style="border:2px solid #ccc; border-radius:50%;">
							<?php } ?>
						  
						  </td>
						  <td style="text-align: left;">
							<?php
								if(!empty($pRow['user_full_name'])){
									echo ucwords($pRow['user_full_name']);
								
								} else if(!empty($pRow['user_email'])) {
									echo obfuscate_email_short($playersInfo[0]['user_email']);
															
								} else if(!empty($pRow['user_phone'])){
									
									//echo "+".substr($pRow['user_phone'], 0, 3).'xxxxxxx'.substr($pRow['user_phone'], 10, 2); 
									$phone = substr($pRow['user_phone'],2, 10);
									echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
								
								
								}  else {
									echo obfuscate_email($pRow['user_email']);
								
								}
								
								//if(!empty($logged_user_id) && $logged_user_id == $pRow['user_id']){ echo " (You)"; } 
								?>
						  </td>
						   <td style="text-align: left;">
							<b><?php echo $pRow['player_score']; ?></b>
						  </td>
						  
						  <!-- <td><i class="fa fa-star"></i></td>  -->
						</tr>
						
					<?php $arrIndex++; ?>
					<?php } ?>
			<?php } ?>
          
          </table>
          </div>
      </div>
    </div>

</section>

<!-- Scripts -->


<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>
 
</body>
</html>