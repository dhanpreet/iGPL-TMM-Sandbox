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
	
	
	<?php  if($t_current_status == 3) {  ?>
		<script>  
			var datTime = "<?php echo date('M j, Y', strtotime($tournamentInfo['t_start_date'])); ?>"+" "+"<?php echo $tournamentInfo['t_start_time'] ?>"+":00";		
		</script>
		
		<script>	
			//console.log(datTime);
			//var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
			var countDownDate = new Date(datTime).getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

			  // Get today's date and time
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
		
		.bg-light{
			background-color: rgb(245, 247, 255); 
		}
	</style>
	
	
</head>
<body>

<div id="load"></div>

<?php
/*
function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/3);

    return substr($name,0, $len) . str_repeat('x', $len) . "@" . end($em);   
}
 */
 ?>
 
 <?php 
	function obfuscate_email($email){
  
		$em   = explode("@",$email);
	   //return @$em[0].'@' . 'xxxxxxxxx' ; 
		return @$em[0]; 
		
		
	}
	?>

	<section>


		<div class="f1lhk7ql">
		<!-- <a href="#"><i class="f1iowekn fa fa-arrow-left fa-lg text-white"></i></a> -->
		<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);"> Tournament Details</div>
		</div>

	
		
		<div class="step-container header-padding  custom-border-thin" style="min-height:18vh !important;">
		
			<img src="<?php echo base_url()."uploads/games/".@$tournamentInfo['t_game_image']; ?>" class="thumb-icon">
			<div class="thumb-icon-game-name">
				<span class="game-name text-white font15EM"><?php echo @$tournamentInfo['t_game_name']; ?></span>
			</div>
			
			<?php  if($t_current_status == 1 || $t_current_status == 3) { ?>
			<div class="text-right" style="margin-top:-35px;">
			<a href="#gameInfoModal"  data-toggle="modal" data-target="#gameInfoModal" class="btn btn-outline-share theme-color"> How to play ?</a>
			</div>
			<?php } ?>
		
		</div>


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
					<span style="color: rgb(199, 199, 199); font-size: 12px; text-transform: uppercase; font-weight: 700; padding: 8px 0px;   display: block;"><img src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt="" style="height: 18px; margin-right: 5px;"> Winning Prize </span>
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
								<span style="font-size:1.0rem; " class="text-white"> Score </span>
						  </td>
						  
						 <td width="30%" style="text-align: center;">
							<h4 style="font-size:1.2rem; font-weight:500;" class="text-white">
							<?php if($arrIndex == 1){
								echo "".@$rank.""; 
							
							} else  {
								if($highest_score !=0 && $pRow['player_score'] == $highest_score){
									echo "".@$rank.""; 
								} else {
									if($pRow['player_score'] >= 0 ){
										$rank++;
										echo "".@$rank.""; 
									} else{
										//echo "<span style='padding-top:10px;'>NA</span>"; 
									}
								}
							}
							?>  </h4> <span style="font-size:1.0rem; " class="text-white"> Rank </span>
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
	<?php	}  else {	?>
	
		<div class="select-time-container" style="align-items: flex-start !important; margin: 5px 0 100px 0 !important; clear:both !important;   background:none !important;  ">
			<div class="row bg-info">
				<div class="col-md-12 card-header">
					
				</div>
				<div class="col-md-12 card-body">
				
					<table class="table leaderboard-table">

					<tr> 
					<td  width="60%" style="vertical-align: middle;">
						<h5 class="text-white"><b>Tournament hosted by</b></h5>
					</td>
					
					
						<td width="40%" style="vertical-align: middle; text-align:center;">
						<br>
						<?php if($playersInfo[0]['user_login_type'] == '1') { ?>
							<img src="<?php echo base_url() ?>uploads/site_users/<?php echo $playersInfo[0]['user_image'] ?>" width="50" style="border:2px solid #7b6a93; border-radius:50%;">
						<?php } else { ?>
							<img src="<?php echo $playersInfo[0]['user_image'] ?>" width="50" style="border:2px solid #ccc; border-radius:50%;">
						<?php } ?>
						<br>
						<h4 style="font-size:1.5rem; font-weight:600;" class="text-white">
						<?php
						
							if(!empty($playersInfo[0]['user_full_name'])){
								echo ucwords($playersInfo[0]['user_full_name']);
							
							} else if(!empty($playersInfo[0]['user_email'])){
								echo obfuscate_email($playersInfo[0]['user_email']);
								
							} else if(!empty($playersInfo[0]['user_phone'])){
								$phone = substr($playersInfo[0]['user_phone'],2, 10);
								echo substr($phone, 0, 3).'xxxx'.substr($phone, 7, 3); 
							
							}  else {
								//echo obfuscate_email($playersInfo[0]['user_email']);
								echo "NA";
							
							}
							
							
						?>
						</h4>
						</td>
					
					</tr>
					</table>
				
				</div>
			</div>
		</div>
	
	<?php	}  	?>
	
<?php

		$game_id= @$tournamentInfo['t_game_id'];
		if(!empty($game_id)){
		
			$descQuery = "SELECT description,gamehelp,gametip FROM tbl_games WHERE id =".$game_id;
			$descInfo = $this->db->query($descQuery)->row();
			$description = stripslashes(urldecode($descInfo->description));			
			$gamehelp = stripslashes(urldecode($descInfo->gamehelp));			
			$gametip = stripslashes(urldecode($descInfo->gametip));

			
			
		}
?>	
	



  	<?php if($t_current_status == 1) { ?>
			<?php if($player_availability == 'yes') { ?>
				<div class="bottom-fixed-btn"><a href="<?php echo site_url('JoinTournament/'.base64_encode($tournamentInfo['t_id'])) ?>" id="save_info" class="btn btn-bottom btn-active">Play Tournament</a></div>
			<?php } else { ?>
				<div class="bottom-fixed-btn"><button type="button"  class="btn btn-bottom btn-active">Sorry! Entries Full</button></div>
			<?php } ?>
		
		
		<?php } else if($t_current_status == 2) { ?>
		
			<div class="bottom-fixed-btn"><button type="button" id="save_info" class="btn btn-bottom btn-active">Tournament Expired!</button></div>
		
		<?php } else if($t_current_status == 3) {  ?>
		
				<div class="bottom-fixed-btn">
					<a href="#" class="btn btn-bottom" id="start_later" style="text-transform:capitalize;">Starts In&nbsp;<span id="timer"></span></a>
				</div>
		<?php }   ?>



</section>


<div class="modal fade" id="gameInfoModal" role="dialog">
    <div class="modal-dialog modal-sm box-center">
      <div class="modal-content" align="left">
        <div class="modal-header bg-info">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">  <b> How to play ? </b></h4>   
        </div> 
        <div class="modal-body text-left">
        
          <p style="font-size:1.5rem; line-height:22px;"> <?php echo @$description; ?> </p>
		   <br> 
		  <?php if(!empty($gamehelp)){ ?> 
			<h5><b>Help & Tips</b></h5>
			<p style="font-size:1.5rem; line-height:22px;"> <?php echo @$gamehelp; ?> </p>
		  <?php } ?>
        </div>
      </div>
    </div>
  </div>
  

	



<!-- Scripts -->





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
    jQuery('#load').fadeOut("slow");
});
</script>
</body>
</html>
