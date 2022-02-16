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
	<script type="text/javascript" src="<?php echo base_url() ?>assets/frontend/js/main.js"></script>
	
	
	<?php if($t_current_status == 1 || $t_current_status == 2 ) { ?>
		<script>  
			var datTime = "<?php echo date('M j, Y', strtotime($tournamentInfo['t_end_date'])); ?>"+" "+"<?php echo $tournamentInfo['t_end_time'] ?>"+":00";		
		</script>
	<?php } else if($t_current_status == 3) {  ?>
		<script>  
			var datTime = "<?php echo date('M j, Y', strtotime($tournamentInfo['t_start_date'])); ?>"+" "+"<?php echo $tournamentInfo['t_start_time'] ?>"+":00";		
		</script>
	<?php }   ?>
	
	
	<script>	
		// Set the date we're counting down to
		
		
		//var datTime = "<?php echo date('M j, Y', strtotime($tournamentInfo['t_end_date'])); ?>"+" "+"<?php echo $tournamentInfo['t_end_time'] ?>"+":00";		
		//console.log(datTime);
		//var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
		var countDownDate = new Date(datTime).getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		  // Get today's date and time
		  var now = new Date().getTime();
			
		  // Find the distance between now and the count down date
		  var distance = countDownDate - now;
			
		  // Time calculations for days, hours, minutes and seconds
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
		  // Output the result in an element with id="timer"
			if(days !=0)
				document.getElementById("timer").innerHTML = days + " Days " + hours + " Hours "+ minutes + " Mins " + seconds + " Sec ";
			else if(hours ==1)
				document.getElementById("timer").innerHTML = hours + " Hour "+ minutes + " Mins " + seconds + " Sec ";
			else
				document.getElementById("timer").innerHTML = hours + " Hours "+ minutes + " Mins " + seconds + " Sec ";
		  // If the count down is over, write some text 
		  if (distance < 0) {
			clearInterval(x);
			document.getElementById("timer").innerHTML = "EXPIRED";
		  }
		}, 1000);
	</script>
	
	<style>
		.table > tbody > tr > td{
			border-top:none !important;
		}
		
		.select-time-container{
			box-shadow: none !important;
		}
		
		.active-row{
			background:#dcddbb; color:#fff;
		}
		
		.active-row
	</style>
	
</head>
<body>


<?php

function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/3);

    return substr($name,0, $len) . str_repeat('x', $len) . "@" . end($em);   
}

 ?>

	<section>
		<div class="f1lhk7ql"><a href="<?php echo site_url('') ?>"><i class="f1iowekn fa fa-arrow-left fa-lg text-white"></i></a><div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);"> Tournament Details</div></div>
		<div class="step-container header-padding">
			<img src="<?php echo @$tournamentInfo['t_game_image']; ?>" class="thumb-icon">
			<div class="thumb-icon-game-name">
				<span class="game-name"><?php echo @$tournamentInfo['t_game_name']; ?></span>
			</div>
		</div>

		<div class="countdown-container text-center">
				<br>
				<?php if($t_current_status == 1) { ?>
					<div>Tournament Ends In <br><p id="timer"></p></div> 
				<?php } else if($t_current_status == 2) { ?>
					<div>Tournament Ends In <br><p id="timer"></p></div> 		
				<?php } else if($t_current_status == 3) {  ?>
					<div>Tournament Starts In <br><p id="timer"></p></div> 
				<?php }   ?>
			<br>
		</div>
		
		


      <div class="select-time-container" style="margin-bottom: 90px">
			<span class="foruth-time" style="text-transform:capitalize;"> Players who joined this tournament </span>
			<br><br>
		
		<table class="table table-condensed lastchild">
			<tbody>
			<?php
				if(is_array($playersInfo) && count($playersInfo)>0){
					
					$highest_score = $playersInfo[0]['player_score'];
					$rank = 1;
					
					foreach($playersInfo as $pRow){ ?>
					
						<tr <?php if($user_id == $pRow['player_user_id']) { ?> class="bg-info" <?php } ?>>
							<td>
								<img src="<?php echo base_url() ?>uploads/site_users/<?php echo $pRow['user_image'] ?>" class="img-border img-circle">

								<?php
								if(!empty($pRow['user_phone'])){
									//echo "+".$pRow['user_phone'];
									echo "+".substr($pRow['user_phone'], 0, 3).'xxxxxxx'.substr($pRow['user_phone'], 10, 2); 
								} else if(!empty($pRow['user_full_name'])){
									echo ucwords($pRow['user_full_name']);
									
								} else {
									echo obfuscate_email($pRow['user_email']);
								
								}
								?>
							</td>

							<td class="score" style="text-align:center"><?php echo $pRow['player_score']; ?> <span> Score</span></td>
							<td class="rank-lead" style="text-align:center"> 
							<?php
							
								if($highest_score !=0 && $pRow['player_score'] == $highest_score){
									echo @$rank."<span>Rank</span>"; 
								} else {
									if($pRow['player_score'] > 0 ){
										$rank++;
										echo @$rank."<span>Rank</span>"; 
									} else{
										//echo "<span style='padding-top:10px;'>NA</span>"; 
									}
									
								}
								
								
							?>
							</td>

						</tr>

			<?php
					}
				}

				?>

               
<!-- 			   <tr>
                    <td><img src="<?php echo base_url() ?>assets/frontend/users/2.png" class="img-border img-circle">  302xxxx750 </td>
                    <td class="score" style="text-align:center">2982 <span> Score</span></td>
                    <td class="rank-lead" style="text-align:center">2 <span>Rank</span></td>
                </tr>  -->
				
                
			</tbody>
		</table>


      </div>
	  
		
    	<?php  if($t_current_status == 1) { ?>
			<div class="bottom-fixed-btn"><a href="<?php echo site_url('PlayTournament/'.base64_encode($tournamentInfo['t_id'])) ?>" id="save_info" class="btn btn-bottom btn-active">Play Now</a></div>
		<?php } else if($t_current_status == 2) { ?>
			<!-- <div class="bottom-fixed-btn"><button type="button" id="save_info" class="btn btn-bottom btn-active">Show Results</button></div>
				-->
		<?php } else if($t_current_status == 3) {  ?>
				<div class="bottom-fixed-btn"><button type="button" id="save_info" class="btn btn-bottom">Play Later</button></div>
		
		<?php }   ?>
</section>


<!-- Scripts -->



 
</body>
</html>