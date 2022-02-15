<!doctype html>
<html class="no-js" lang="en">

<head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, user-scalable=0">

	<title>Gaming Social League</title> 
	<meta name="description" content="Play your private battles with Friends & Family!">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="Gaming Social League" />
	<meta property="og:title" content="Gaming Social League">
	<meta property="og:url" content="https://playpt.igpl.pro">
	<meta property="og:description" content="Play your private battles with Friends & Family!">
	<meta property="og:image" content="<?php echo base_url() ?>assets/frontend/img/gpl.png" />
	<meta content="<?php echo base_url() ?>assets/frontend/img/gpl.png" property="thumbnail" />
	
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontend/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>assets/frontend/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/frontend/js/bootstrap.min.js"></script>
	
	<!-- For fontawesome icons -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/css/all.css" rel="stylesheet">
	<script defer src="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/js/all.js"></script>
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/style_theme_2.css">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/frontend/js/main.js"></script>
	
	
	<?php  if($t_current_status == 3 ) {  ?>
		<script>  
			var datTime = "<?php echo date('M j, Y', strtotime($tournamentInfo['t_start_date'])); ?>"+" "+"<?php echo $tournamentInfo['t_start_time'] ?>"+":00";		
		</script>
		
		<script>	
			console.log(datTime);
			//var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
			var countDownDate = new Date(datTime).getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

			  // Get today's date and time
			//   var now = new Date(new Date().toLocaleString("en-UK",{timeZone:'Asia/Yangon'}))
			  var now = new Date('<?php echo date("D M d Y H:i:s"); ?>').getTime();
				
			  // Find the distance between now and the count down date
			  var distance = countDownDate - now;
				
			  // Time calculations for days, hours, minutes and seconds
			  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				
			  // Output the result in an element with id="timer"
				if(days !=0)
					document.getElementById("timer").innerHTML = hours + " Hours "+ minutes + " Mins " + seconds + " Sec ";
				else if(hours >=1)
					document.getElementById("timer").innerHTML = hours + " Hour "+ minutes + " Mins " + seconds + " Sec ";
				else
					document.getElementById("timer").innerHTML = minutes + " Mins " + seconds + " Sec ";
			  // If the count down is over, write some text 
			  if (distance < 0) {
				clearInterval(x);
				//document.getElementById("timer").innerHTML = "EXPIRED";
				//document.getElementById("start_later").innerHTML = "Play Tournament";
				
				$("#start_later").empty();
				$("#start_later").append("Play Tournament");
				
				var url = "<?php echo site_url('JoinTournament/'.base64_encode($tournamentInfo['t_id'])) ?>";
				$("a#start_later").attr('href', url);
				$("#start_later").addClass('btn-active');
			  }
			}, 1000);
		</script>
	
	<?php }   ?>
	
	
	<style>
		.table > tbody > tr > td{
			border-top:none !important;
		}

		.select-time-container{
			box-shadow: none !important;
		}

		#timer{
			font-size:1.0em !important;
		}
		
		.row{
			max-width:95vw !important;
			margin:0 auto;
		}
		.bg-dark{
			color:#fff;
			background: rgb(44,43,77);
			background: linear-gradient(242deg, rgba(44,43,77,1) 0%, rgba(53,56,81,1) 49%, rgba(44,85,134,1) 100%);

		}
		
		.btn-outline-dark{
			border:2px solid #fff;
			color:#fff;
			border-radius:20px;
			font-size:1em;
			font-weight:400;
			background:#5c71db !important;
			border:2px solid #5c71db;
			padding:5px 10px;
			
		}
		
		.btn-outline-dark:hover{
			background:#5c71db !important;
			border:2px solid #fff;
			color:#fff;
			font-weight:400;
		}
		
		.btn-outline-share{
			color:#3fd53f;
			border-radius:20px;
			font-size:1em;
			font-weight:400;
			background:none !important;
			border:2px solid #3fd53f;
			padding:5px 10px;
			
		}
		
		.btn-outline-share:hover{
			
			color:#fff !important;
			border-radius:20px;
			font-size:1em;
			font-weight:400;
			background:#3fd53f !important;
			border:2px solid #3fd53f;
			padding:5px 10px;
			
		}
		
		
		@media only screen and (min-width: 600px){
			.share-text {
				margin-top:25px;
			}
			.share-text > h4{
				font-size:1.8em;
			}
		}
		
	</style>
</head>
<body>
<div id="load"></div>

<?php 
	function obfuscate_email($email){
	$em   = explode("@",$email);
   //return @$em[0].'@' . 'xxxxxxxxx' ; 
	return @$em[0];
}
?>

	<section>
		<div class="f1lhk7ql"><a href="<?php echo site_url() ?>"><img class="f1iowekn" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14"></a>
		<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);">Tournament Details</div>
		</div>
		
		
		<div class="step-container header-padding  custom-border-thin" style="min-height:18vh !important;">
		
			<img src="<?php echo base_url()."uploads/games/".@$tournamentInfo['t_game_image']; ?>" class="thumb-icon">
			<div class="thumb-icon-game-name">
				<span class="game-name text-white font15EM"><?php echo @$tournamentInfo['t_game_name']; ?></span>
			</div>
			
			<?php  if($t_current_status == 1 || $t_current_status == 3) { ?>
			<div class="text-right" style="margin-top:-35px;">
			<a href="#" id="share-btn" class="btn btn-outline-share theme-color">Share <i class="fa fa-share-alt "></i></a>
			</div>
			<?php } ?>
		
		</div>

		<!-- <div class="time-container">
			<div class="ff3k5ad">
			  <div class="foruth-time"><?php echo ucfirst($tournamentInfo['t_start_day']); ?></div> <br>
			
			  <div class="foruth-now"><?php echo date('j F', strtotime($tournamentInfo['t_start_date'])); ?></div>
			</div>
			  <br> <br>
			 <div class="foruth-time" style="position: absolute; right: 10px;font-weight:600; margin-top:-45px; letter-spacing:none !important;"><img src="<?php echo base_url() ?>assets/frontend/img/clock.png" style="max-width:16px;"> <?php echo date('h:i A', strtotime($tournamentInfo['t_start_time'])); ?> </div> 
        </div>  -->
		
		
		
		<div class="time-container  custom-border-thin" style="align-items: flex-start !important;   min-height: 100px">
			<div class="ff3k5ad" style="margin-top: 10px;">
				<!-- <div class="foruth-time"> <?php echo ucfirst($tournamentInfo['t_start_day']); ?> </div>  -->
				<div class="foruth-time">Starts On </div>
				<div class="foruth-now text-white"><?php echo date('j F', strtotime($tournamentInfo['t_start_date'])); ?></div>
				
				<?php if (strtotime($tournamentInfo['t_start_date']) != strtotime($tournamentInfo['t_end_date'])){ ?>
				<div class="clock-time text-white">
					<i class="fas fa-clock text-white"></i> &nbsp; <?php echo date('h:i A', strtotime($tournamentInfo['t_start_time'])); ?> 
				</div>
				<?php } else { ?>
					<div class="clock-time text-white">
						<i class="fas fa-clock text-white"></i> &nbsp; <?php echo date('h:i A', strtotime($tournamentInfo['t_start_time'])); ?>  <?php echo " - ".date('h:i A', strtotime($tournamentInfo['t_end_time']));  ?> 
					</div>
				<?php } ?>
				
				<?php if (strtotime($tournamentInfo['t_start_date']) != strtotime($tournamentInfo['t_end_date'])){ ?>
					<div style="position: absolute; right: 30px; bottom:23px !important; top: 10px !important;">
						<div class="foruth-time"> Ends On </div>
						<div class="foruth-now text-white"> <?php echo date('j F  ', strtotime($tournamentInfo['t_end_date'])); ?>	</div>
						<div class="clock-time text-white">
							<i class="fas fa-clock text-white"></i> &nbsp; <?php echo date('h:i A', strtotime($tournamentInfo['t_end_time']));  ?>
						</div>
					</div>
				<?php } ?>
			</div>
         
		</div>
		
		 <div class="select-time-container  custom-border-thin" style="align-items: flex-start !important; box-shadow: none !important;  ">
      	
			<div class="row" >
				<div class=" col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left ">
					<span style="color: rgb(199, 199, 199); font-size: 12px; text-transform: uppercase; font-weight: 700; padding: 8px 0px;   display: block;"><img src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt="" style="height: 18px; margin-right: 5px;"> Entry Fee</span>
					<p  style="padding-left:35px;" class="text-white"> <b><?php echo $tournamentInfo['t_entry_fee']; ?></b> </p>
				</div>
				<div class="  col-5 col-xs-5 col-sm-5 col-md-5 col-lg-5 text-right" style="">
					<span style="color: rgb(199, 199, 199); font-size: 12px; text-transform: uppercase; font-weight: 700; padding: 8px 0px;  display: block;"><img src="https://static.gamezop.com/peach/assets/img/faceless-player.svg" style="height: 18px; margin-right: 10px;"> Players</span>
					<p  style="padding-right:10px;" class="text-white"> <b> <?php echo $tournamentInfo['no_players']; ?>/<?php echo $tournamentInfo['t_players_count']; ?> </b> </p>
				</div> 
			</div>
			
		</div>
		


      <div class="select-time-container" style="align-items: flex-start !important; box-shadow: none !important;  ">
        
			<div class="ff3k5ad  custom-border-thin" style="clear:both;min-height:60px;" >
				<div class=" col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left "><br>					
					<span class="foruth-time" style="text-transform:capitalize;"> Prize Distribution </span>
				</div>
				
				<div class="  col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left"> 
					<?php if($tournamentInfo['t_prize_type'] == 1){ ?>
						
						  <input type="checkbox" disabled id="takes-all" class="prize_type" name="prize_type"  checked />
						  <label class="text-white" style="padding-left: 6px; margin-bottom:0 !important; "> Winner takes all</label> <br>
						
					<?php } else { ?>
							<input type="checkbox" disabled checked class="prize_type"  />
						  <label class="text-white"> Distribute prize among top 3</label>
						
					<?php } ?>
					<br>
				</div> 
			
			<?php if($tournamentInfo['t_prize_type'] == 2){ ?>
				<div id="distribution_div" >
					<div class="f1d4a11x" style="height: 40px;">
						<div class="f1mi6qxz text-white">Rank 1</div>
						<div class="f181luy4">
							<img class=" fw2jcnz" src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt="">
							<span class="text-white">50</span>
						</div>
					</div>
				  
				  
					<div class="f1pd6hn7" style=" height: 40px;">
						<div class="f1mi6qxz text-white">Rank 2</div>
						<div class="f181luy4">
							<img class=" fw2jcnz" src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt="">
							<span class="text-white">33</span>
						</div>
					</div>
					
					<div class="fqyuqxd" style="height: 40px; ">
						<div class="f1mi6qxz text-white">Rank 3</div>
						<div class="f181luy4">
							<img class=" fw2jcnz" src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt="">
							<span class="text-white">17</span>
						</div>
					</div>
				</div>
			<?php } ?>	
			</div>
			
      </div>
     
	  
	  	<?php /* if($t_current_status == 1 || $t_current_status == 3) { ?>
		  <div id="shareDiv" class="select-time-container text-center" style="  margin-bottom: 50px;  box-shadow: none !important;">
			
				
				<!-- <h3 class="text-bold  text-info" ><b>Share with friends!</b></h3>  -->
				<!--
				<div class="row">
					<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"> 
						<a class="js-tooltip js-copy" data-toggle="tooltip" data-placement="bottom" data-copy="<?php echo $tournamentInfo['t_share_link']; ?>" title="Click to copy link">
							<img class="img-responsive custom-border"  src="<?php echo base_url() ?>assets/frontend/img/share-with-friends.jpg"  />
						</a>
						<br>
					</div>
				</div>
				-->
				
				
				<!-- 
				<div class="row bg-dark" >
					<div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left share-text"> 
						<br>
						<h4> Share link & </h4>
						<h4> Play with friends </h4>
						<br>
						<a class="btn-outline-dark js-tooltip js-copy" data-toggle="tooltip" data-placement="bottom" data-copy="<?php echo $tournamentInfo['t_share_link']; ?>" title="Click to copy link">
							Click to copy link
						</a>
					</div>
					
					<div class="col-6 col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right"> 
						<img class="img-responsive"  src="<?php echo base_url() ?>assets/frontend/img/share-code.png"  />
					</div>
					
					
				</div>
				
				<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"> <br><br></div>
				
				<?php
					// $shareTxt = "Hey! Can you score more than me in this game? Come and play now! Play here: ".$tournamentInfo['t_share_link']."";
				?>
				
				<div class="row" >
					<a class="btn btn-md whatsapp-btn" href="https://wa.me/?text=<?php echo urlencode($shareTxt); ?>">
						<i class="fab fa-whatsapp"></i> &nbsp; Share on Whatsapp
					</a>
				</div>
				<br>
				
				<div class="row" >
					<a class="btn btn-md messenger-btn"  href="fb-messenger://share/?link=<?php echo $tournamentInfo['t_share_link'] ?>&app_id=780071189422716">
						<i class="fab fa-facebook-messenger" aria-hidden="true"></i> &nbsp; Share on Messenger
					</a>
				</div>
				
				-->
				
				<br>
				
			</div>
			
		
		<?php  } */ ?>
		
		
		
	  
	  <?php if( (is_array($playersInfo) && count($playersInfo)>0) && ($t_current_status == 1 || $t_current_status == 2) ) { ?>
		
			<div class="select-time-container" style="align-items: flex-start !important; margin: 5px 0 100px 0 !important; clear:both !important;  ">
				<div class="row card">
					<div class="col-md-12 card-header">
						<h5 class="text-white"><b>Players who joined this tournament</b></h5> <br>
					</div>
					<div class="col-md-12 card-body">
					<table class="table leaderboard-table">
					
					<?php 
					$highest_score = $playersInfo[0]['player_score'];
					$last_highest_score = @$playersInfo[0]['player_score'];
					$orderIndex=1;
					$rank = 1;
					$arrIndex = 1;
					foreach($playersInfo as $pRow){ ?>
					
						<tr class="<?php if($arrIndex == 1){ ?> selected-board <?php } ?> <?php if($this->session->userdata('userId') == $pRow['user_id']){ echo "theme-active-bg-row"; } ?> ">
						 
						  <td width="10%" style="vertical-align: middle;">
						    <?php if($pRow['user_login_type'] == '1') { ?>
								<img src="<?php echo base_url() ?>uploads/site_users/<?php echo $pRow['user_image'] ?>" width="40" style="border:2px solid #7b6a93; border-radius:50%;">
							<?php } else { ?>
								<img src="<?php echo base_url().'uploads/site_users/'.$pRow['user_image'] ?>" width="40" style="border:2px solid #ccc; border-radius:50%;">
							<?php } ?>
						  </td>
						
						  <td width="30%" style="text-align: left; vertical-align: middle;">
							<h4 style="font-size:1.2rem; font-weight:500;" class="text-white">
							<?php
							
								
								if(!empty($pRow['user_full_name'])){
									echo ucwords($pRow['user_full_name']);
								
								} else if(!empty($pRow['user_email'])){
									echo obfuscate_email($pRow['user_email']);
								
								} else if(!empty($pRow['user_phone'])){
									
									//echo "+".substr($pRow['user_phone'], 0, 3).'xxxxxxx'.substr($pRow['user_phone'], 10, 2); 
									$phone = substr($pRow['user_phone'],2, 10);
									echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 

								} 
								
								
							?>
							</h4>
						  </td>
						   <td width="30%" style="text-align: center;">
								<h4 style="font-size:1.2rem; font-weight:500;" class="text-white"><?php echo $pRow['player_score']; ?> </h4> 
								<span style="font-size:1.0rem; color:#ccc;"> Score </span>
						  </td>
						  
						 <td width="30%" style="text-align: center;">
							<h4 style="font-size:1.2rem; font-weight:500;" class="text-white">
							<?php if($arrIndex == 1){
								echo "".@$rank.""; 
							
							} else  {
								if($highest_score !=0 && $pRow['player_score'] == $highest_score){
									echo "".@$rank.""; 
								} else {
									if($pRow['player_score'] >= 0 && $last_highest_score == $pRow['player_score']){
										
										echo "".@$rank.""; 
									} else{
										$last_highest_score = $pRow['player_score'];
										//echo "<span style='padding-top:10px;'>NA</span>"; 
										$rank++;
										echo "".@$rank.""; 
									}
								}
							}
							?>  </h4> <span style="font-size:1.0rem; color:#ccc;"> Rank </span>
						  </td>
						  <!-- <td><i class="fa fa-star"></i></td>  -->
						</tr>
						
					<?php $arrIndex++; ?>
					<?php $orderIndex++; ?>
					<?php } ?>
					</table>
					</div>
				</div>
			</div>
	<?php	} 	?>
	
	
	
	
    <!--  <div class="bottom-fixed-btn"><button type="button" id="save_info" class="btn btn-bottom btn-active">CREATE FOR <img src="<?php echo base_url() ?>assets/frontend/img/coin.png" alt="" style=" max-width: 24px; margin: 0px 2px 0px 8px;"> 100</button></div> -->
		<?php if($t_current_status == 1) { ?>
			<div class="bottom-fixed-btn"><a href="<?php echo site_url('JoinTournament/'.base64_encode($tournamentInfo['t_id'])) ?>"  class="btn btn-bottom btn-active">Play Tournament</a></div>
		<?php } else if($t_current_status == 2) { ?>
			<div class="bottom-fixed-btn"><a href="<?php echo site_url('TournamentLeaderboard/'.base64_encode($tournamentInfo['t_id'])) ?>"  class="btn btn-bottom btn-active">Show Results</a></div>
		<?php } else if($t_current_status == 3) {  ?>
				
				<div class="bottom-fixed-btn">
					<a href="#" class="btn btn-bottom" id="start_later" style="text-transform:capitalize;">Starts In  <span data-countdown="<?php echo date('Y-m-d', strtotime($tournamentInfo['t_start_date'])) ?> <?php echo $tournamentInfo['t_start_time'].":00"; ?>" id="timing"> </span></a>
				</div>
		<?php }   ?>



</section>

<!-- Scripts -->



  
 
<div class="modal fade" id="sharePopup" role="dialog" style="width: 100% !important;">
    <div class="modal-dialog box-center">
      <div class="modal-content modal-bg " align="center">
      
        <div class="modal-body">
          
				<h3 class="text-dark">Share On</h3> <br><br>
		  
		  
				
				<?php
					$shareTxt = "Hey! Can you score more than me in this game? Come and play now! Play here: ".$tournamentInfo['t_share_link']."";
				?>
				
				<div class="row" >
				<div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
					<a class="btn whatsapp-btn" href="https://wa.me/?text=<?php echo urlencode($shareTxt); ?>">
						<i class="fab fa-whatsapp fa-2x"></i> 
					</a>
					<p class="text-dark"> Whatsapp </p>
					
				</div>
				<div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
					
					<a class="btn messenger-btn"  href="fb-messenger://share/?link=<?php echo $tournamentInfo['t_share_link'] ?>&app_id=780071189422716">
						<i class="fab fa-facebook-messenger fa-2x" aria-hidden="true"></i> 
					</a>
					<p class="text-dark">Messenger </p>
				</div>
				
				<div class="col-sm-4 col-xs-4 col-md-4 col-lg-4">
					
					<a class="btn copy-share-btn js-tooltip js-copy" data-toggle="tooltip" data-placement="top" data-copy="<?php echo $tournamentInfo['t_share_link']; ?>" title="Copy link">
						<i class="fas fa-clone fa-2x" aria-hidden="true"></i> 
					</a>
					<p class="text-dark">Tap to Copy </p>
				</div>
				
				
				</div>
				<br><br>
		  
		  <button type="button" class="btn modal-btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <?php include "page_session_timeout.php"; ?>
 
<script>
// COPY TO CLIPBOARD
// Attempts to use .execCommand('copy') on a created text field
// Falls back to a selectable alert if not supported
// Attempts to display status in Bootstrap tooltip
// ------------------------------------------------------------------------------

function copyToClipboard(text, el) {
  var copyTest = document.queryCommandSupported('copy');
  var elOriginalText = el.attr('data-original-title');

  if (copyTest === true) {
    var copyTextArea = document.createElement("textarea");
    copyTextArea.value = text;
    document.body.appendChild(copyTextArea);
    copyTextArea.select();
    try {
      var successful = document.execCommand('copy');
      var msg = successful ? 'Copied!' : 'Whoops, not copied!';
      el.attr('data-original-title', msg).tooltip('show');
    } catch (err) {
      console.log('Oops, unable to copy');
    }
    document.body.removeChild(copyTextArea);
    el.attr('data-original-title', elOriginalText);
  } else {
    // Fallback if browser doesn't support .execCommand('copy')
    window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
  }
}

$(document).ready(function() {
  // Initialize
  // ---------------------------------------------------------------------

  // Tooltips
  // Requires Bootstrap 3 for functionality
  $('.js-tooltip').tooltip();

  // Copy to clipboard
  // Grab any text in the attribute 'data-copy' and pass it to the 
  // copy function
  $('.js-copy').click(function() {
    var text = $(this).attr('data-copy');
    var el = $(this);
    copyToClipboard(text, el);
  });
});
</script>

<script>

jQuery(document).ready(function() {
	jQuery("#share-btn").click(function() {
		jQuery('#sharePopup').modal('show');
	});
}); 

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.4.0/moment-timezone-with-data-2010-2020.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>
<!-- <script>
$(document).ready(function() {
	$('#timing').each(function() { 
		var $_this = $(this) , finalDate = moment.tz($_this.data('countdown'), "Asia/Rangoon");
		console.log($_this.data('countdown'));
		$_this.countdown(finalDate.toDate(), function(event) {
		$_this.html(event.strftime('%Hh : %Mm : %Ss'));
		// $_this.html(event.strftime('%D:%H:%M:%S'));
	  });
	});
});
</script> -->
<script>
$(document).ready(function() {
	$('[data-countdown]').each(function() {
		var $this = $(this), finalDate = moment.tz($this.data('countdown'), "Asia/Rangoon");
		$this.countdown(finalDate.toDate(), function(event) {
		$this.html(event.strftime(' %Hh : %Mm : %Ss'));
	  });
	});
});
</script>
<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>
</body>
</html>