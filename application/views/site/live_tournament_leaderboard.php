<!DOCTYPE html>
<html lang="en">
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
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/style_theme_2.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/new-style.css">
	<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/frontend/js/main.js"></script>  -->
	
</head>
<body>
	<div id="load"></div>
	<div class="shades">&nbsp;</div>
	<!-- 
	<div class="header-strip">
		<span><a href="#">Back</a></span>
		<span class="center">Play</span>
	</div> -->
	<!-- White Strip End -->
	
	
    <div class="col-xs-12 padd">  
        <div class="touraments-profile "> 
        
          <div class="transperent-strip">
          <span class="pull-left"><a href="<?php echo site_url('LiveTournament/'.base64_encode($tournament_id)) ?>"><img src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14"></a></span>
          
          </div>
        </div>
        <div class="main-container">
            <div class="col-xs-12 align-middle padd first-rank">
                <div class="col-xs-4 text-center"><img src="<?php echo base_url() ?>assets/frontend/img/trophy.png" width="64"><br><span class="theme-color">Rank <?php echo @$myRank; ?></span> </div>
                <div class="col-xs-8 text-center"><span class="text-white">Your best score is</span><span class="text-dark theme-color"><?php echo @$myScore; ?></span></div>
            </div>
            <!-- Table -->
            <div class="col-xs-12 padd rank-table">
                <table class="table">
                  <tr><th>User</th><th>Score</th><th>Rank</th></tr>
                   <?php $logged_user_id = $this->session->userdata('userId'); ?>
			
				  <?php
					if(is_array($playersInfo) && count($playersInfo)>0){
					
					$highest_score = $playersInfo[0]['player_score'];
					$rank = 1;
					$arrIndex = 1;
					foreach($playersInfo as $pRow){ ?>
						<tr class="<?php if(!empty($logged_user_id) && @$logged_user_id == $pRow['user_id']){ ?> active <?php } ?>">
						 
						  <td>
							<?php if(!empty($logged_user_id) && @$logged_user_id == $pRow['user_id']){ ?>
								<img class="user-profile-leaderboard-selected" src="<?php echo base_url() ?>uploads/site_users/<?php echo $pRow['user_image'] ?>" >
							<?php } else { ?>
								<img class="user-profile-leaderboard" src="<?php echo base_url() ?>uploads/site_users/<?php echo $pRow['user_image'] ?>" >
							<?php }  ?>
							&nbsp;&nbsp;
							<?php
								//$phone = substr($pRow['user_phone'],0, 12);
								//echo substr($phone, 0, 3).'xxxxxx'.substr($phone, 9, 3); 
								echo $pRow['user_full_name'];
							?>
						  </td>
							
							<td>
								<?php echo $pRow['player_score']; ?>
							</td>
						  
						  
						   <td>
							<?php
								if($highest_score !=0 && $pRow['player_score'] == $highest_score){
									echo "<b>".@$rank."</b>"; 
								} else {
									if($pRow['player_score'] > 0 ){
										$rank++;
										echo "<b>".@$rank."</b>"; 
									} else{
										echo "0"; 
									}
									$highest_score = $pRow['player_score'];
								}
							
							?>
						  </td>
						 
						</tr>
						
					<?php $arrIndex++; ?>
					<?php } ?>
			<?php } ?>
          
                
                </table>
            </div>
        </div>
    </div>
	<?php include "page_session_timeout.php"; ?>
	<script>
jQuery(document).ready(function() {
   setTimeout(function(){ jQuery('#load').fadeOut("fast"); }, 500);
});
</script>

	
<?php 
// if($this->session->userdata('user_login_type') == 4){
// 	echo "<br><br><br>";
// 	include "bkash_footer.php";
// } 
?>


  </body>
  </html>