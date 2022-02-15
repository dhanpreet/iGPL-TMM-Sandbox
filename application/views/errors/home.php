<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="theme-color" content="#000" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
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
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/style.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/slick.css">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/frontend/js/slick.js"></script>
	
	
	
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/glider/glider.css" />
  
	<script src="<?php echo base_url() ?>assets/frontend/glider/glider.js"></script>
	<script>
      window.addEventListener('load',function(){
        
		window._ = new Glider(document.querySelector('.glider-2'), {
            slidesToShow: 1.3, //'auto',
            slidesToScroll: 1,
            itemWidth: 150,
            draggable: true,
            scrollLock: false,
            dots: '#dots',
            rewind: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 2.1, 
                    }
                },
             ]
           
        });
       
       
      });
    </script>
	
	
	
  <style type="text/css">
	.slide-menu.glider.draggable {
			position: fixed;
			bottom: 0;
			background: #202123;
			z-index: 1;
			border-top: 1px solid #4a4a4a;
			padding: 10px 0px;
		}

    </style>
	
	
	
	
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js"></script>

	<script>
	/*  document.onreadystatechange = function () {
	  var state = document.readyState
	  if (state == 'complete') {
			document.getElementById('load').style.visibility="hidden";
	  }
	}  */
	</script>
	
	
	
	<?php if(is_array($liveInfo) && count($liveInfo)>0  && ($t_current_status == 1 || $t_current_status == 3) ){ ?>
		<?php if(@$t_current_status == 1  ) { ?>
			<script>  
				var datTime = "<?php echo date('M j, Y', strtotime($liveInfo['t_end_date'])); ?>"+" "+"<?php echo $liveInfo['t_end_time'] ?>"+":00";		
			</script>
		<?php } else if(@$t_current_status == 3) {  ?>
			<script>  
				var datTime = "<?php echo date('M j, Y', strtotime($liveInfo['t_start_date'])); ?>"+" "+"<?php echo $liveInfo['t_start_time'] ?>"+":00";		
			</script>
		<?php }   ?>
	
	
	<script>	
		// Set the date we're counting down to
		
		//console.log(datTime);
		//var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
		var countDownDate = new Date().getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		  // Get today's date and time 
		  var now 	=	new Date().getTime();
		//   var now = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>).getTime();
		//   console.log(Date(<?php echo date("Y, n - 1, d, H, i, s") ?>));
		//   var now = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>).getTime();
		//   console.log('<?php $a=0; echo $a; $a++  ?>');
			
		  // Find the distance between now and the count down date
		  var distance = countDownDate - now;
			
		  // Time calculations for days, hours, minutes and seconds
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			
		  // Output the result in an element with id="timer"
			if(days !=0)
				document.getElementById("timer").innerHTML = hours + " Hrs : "+ minutes + " Mins : " + seconds + " Sec ";
			else if(hours >0)
				document.getElementById("timer").innerHTML = hours + " Hour : "+ minutes + " Mins";
			else
				document.getElementById("timer").innerHTML = minutes + " Mins : " + seconds + " Sec ";
		  // If the count down is over, write some text 
		  if (distance < 0) {
			clearInterval(x);
			//document.getElementById("timer").innerHTML = " Started";
			var t_status = "<?php echo $t_current_status; ?>";
			if(t_status == '3'){
				document.getElementById("start_span").innerHTML = '';
				document.getElementById("timer").innerHTML = '';
				
				//location.reload()
				$('#live_tournament').load(location.href + " #live_tournament");
				stateChange();
			} else {
				
				document.getElementById("timer").innerHTML = " Expired";
				$('#live_tournament').hide('fast');
			}
		  }
		}, 1000);
		
		
	</script>
	<script>
		function stateChange(){
			
			var datTimeEnd = "<?php echo date('M j, Y', strtotime($liveInfo['t_end_date'])); ?>"+" "+"<?php echo $liveInfo['t_end_time'] ?>"+":00";		
			console.log(datTimeEnd);
			var countdownEndDate = new Date(datTimeEnd).getTime();
			// Update the count down every 1 second
			var x = setInterval(function() {

				var now = new Date().getTime();
			  // Get today's date and time
			//   var now = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>).getTime();
			//   console.log(now);
			
			  // Find the distance between now and the count down date
			  var distance = countdownEndDate - now;
				
			  // Time calculations for days, hours, minutes and seconds
			  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				
				
				document.getElementById("start_span").innerHTML = 'Ends In ';
			
			  // Output the result in an element with id="timer"
				if(days !=0)
					document.getElementById("timer").innerHTML = hours + " Hrs : "+ minutes + " Mins : " + seconds + " Sec ";
				else if(hours >0)
					document.getElementById("timer").innerHTML = hours + " Hrs : "+ minutes + " Mins";
				else
					document.getElementById("timer").innerHTML = minutes + " Mins : " + seconds + " Sec "; 
			  // If the count down is over, write some text 
			  
				if (distance < 0) {
					clearInterval(x);
					document.getElementById("timer").innerHTML = " Expired";
					$('#live_tournament').hide('fast');	
				}
			}, 1000);
		
		}
	</script>
	
	<?php }   ?>
	
	
	
	<style>
		body{
			background:#202125 !important;
		}
		
		
		#timer{
			font-size:1em !important;
			font-weight: 400 !important;
		}
		
		.bg-leaderboard{
			padding:15px 5px;
			border-radius: 20px 20px 0 0;
			background:#2b2b2b !important;
			color:#fff;
		}
		.bg-dark{
			padding:15px 5px;
			border-radius: 0 0 20px 20px;
			background:#2b2b2b !important;
			color:#fff;
		}
		
		.bg-dark-2{
			padding:10px 5px;
			
		/*	background:#2c2b4d !important;  */
			color:#fff;
			background: rgb(44,43,77);
			background: linear-gradient(242deg, rgba(44,43,77,1) 0%, rgba(53,56,81,1) 49%, rgba(44,85,134,1) 100%);

		}
		
		.btn-outline-dark{
			border:2px solid #fff;
			color:#fff;
			border-radius:20px;
			font-weight:600;
			background:#5c71db !important;
		}
		.btn-outline-dark:hover{
			background:#5c71db !important;
			border:2px solid #5c71db;
			color:#fff;
			font-weight:600;
		}
		
		
		
		.nav-tabs li{
			width: 50% !important;
			border-bottom: 0 !important;
			color:#fff; 
		}
		
		
		
	</style>
	

	<style type="text/css">
		
		img {
			max-width: 100%;
			height: auto;
			
		}
		
		.winner{
			max-width: 70%;
			height: auto;
			vertical-align: middle;
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

.header-text{
	padding:5px 0 5px 0 !important; 
	color:#fff;
	background: linear-gradient(to right,#fa687e,#fdb165);
	border-radius: 0 15px;
}

.header-text-2{
	 padding:5px 0 5px 0 !important; 
	color:#fff;
	/* background: linear-gradient(to left,#ababd1,#5a74a6);  */
	
	/* background: rgb(2,11,116);
	background: linear-gradient(103deg, rgba(2,11,116,1) 0%, rgba(91,1,115,0.8) 85%);  */
	
	/*  background:  linear-gradient(120deg, rgb(91, 1, 115) 10%, rgb(232, 29, 98) 80%);  */
	
	/*  background: linear-gradient(120deg, #6524e4 10%, #e91e63 80%);  */
	background: linear-gradient(to left,#2b2b2b,#000000);
/*	
background: #D06D9F;
background: -webkit-linear-gradient(right, #D06D9F, #8D589E);
background: -moz-linear-gradient(right, #D06D9F, #8D589E);
background: linear-gradient(to left, #D06D9F, #8D589E);
*/

	
	
	

}

.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
	
	 background: #5a599d;
	 color:#fff;
	 border-radius: 0 !important;
}

.nav-item, .nav-pills>li>a{ 
	 border-radius: 0 !important;
	  text-align:center !important;
}

.fw-400{
	font-weight:400 !important;
}

.small-txt{
	color:#333;
	font-weight:400 !important;
	padding-left:5px;
}

#small-tournaments-slider img{
	border-radius:0 !important;
	border-top-right-radius: 10px !important;
	border-top-left-radius: 10px !important;
}

#small-tournaments-slider .time-ticker{
	text-align:center;
	font-size:0.75em;
	border-radius:0 !important;
	border-bottom-right-radius: 10px !important;
	border-bottom-left-radius: 10px !important;
	background:rgba(0,0,0,0.75);
	color:#efefef;
	position:relative;
	margin-top:0;
	padding:3px 0 3px 0;
	
}

#medium-tournaments-slider {
	text-align:center !important;
}

#medium-tournaments-slider img{
	border-radius:0 !important;
	border-top-right-radius: 10px !important;
	border-top-left-radius: 10px !important;
}

#medium-tournaments-slider .time-ticker{
	text-align:center;
	font-size:0.75em;
	border-radius:0 !important;
	border-bottom-right-radius: 10px !important;
	border-bottom-left-radius: 10px !important;
	background:rgba(0,0,0,0.75);
	color:#efefef;
	position:relative;
	margin-top:0;
	padding:5px 0 5px 0;
	
}

#hero-tournaments-slider{
	position:relative;
	
}
#hero-tournaments-slider .slick-list{padding:0 10% 0 0 !important; }

#hero-tournaments-slider .lazy{
	
	border-radius:10px !important;
	background-color: rgb(68,68,68); /* Needed for IEs */

	-moz-box-shadow: 5px 5px 5px rgba(68,68,68,0.9);
	-webkit-box-shadow: 5px 5px 5px rgba(68,68,68,0.9);
	box-shadow: 5px 5px 5px rgba(68,68,68,0.9);

	filter: progid:DXImageTransform.Microsoft.Blur(PixelRadius=3,MakeShadow=true,ShadowOpacity=0.30);
	-ms-filter: "progid:DXImageTransform.Microsoft.Blur(PixelRadius=3,MakeShadow=true,ShadowOpacity=0.30)";
	zoom: 1;
}



#hero-tournaments-slider .live-ticker{
	
	font-size:1.15em;
	border-radius:0 !important;
	border-top-left-radius: 10px !important;
	
	border-bottom-right-radius: 5px !important;
	color:#fff !important;
	background:rgba(255, 87, 51, 0.75) !important;
	color:#efefef;
	position:relative;
	top:-203px;
	width:50%;
	padding-left:12px;
	padding-bottom:2px;
	font-weight:600;

}

#hero-tournaments-slider .time-ticker{
	text-align:center;
	font-size:1.15em;
	border-radius:0 !important;
	border-top-right-radius: 10px !important;

	border-bottom-left-radius: 5px !important;
	background:rgba(0,0,0,0.75);
	color:#efefef;
	position:relative;
	top:-203px;
	padding-bottom:3px;
}

#hero-tournaments-slider .bottom-ticker{
	text-align:center;
	font-size:1.15em;
	border-radius:0 !important;
	border-bottom-right-radius: 10px !important;
	border-bottom-left-radius: 10px !important;
	
	background:rgba(0,0,0,0.75);
	color:#efefef;
	position:relative;
	top:-70px;
	padding-bottom:3px;
	width:100%;
	margin: 5px auto;
	
}

.btn-entry-fee{
	background-color: #2539A2;
	border: 1px solid #6B83D9;
	border-radius: 4px;
	display: inline-block;
	padding:5px 15px;
}

</style>
	
</head>
<body>
<div id="load"></div>

	<!-- Header-Content -->
		<?php include "header.php"; ?>
	<!-- Header Content End -->

	<!-- Sidebar-Content -->
		<?php include "sidebar.php"; ?>
	<!-- Sidebar Content End -->

<section class="main-wrapper" align="center"><br>
	<div class="container">
	
	<div class="row"> <br><br> </div>
		
		
		<!-- <div class="row text-center">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
				<h4><b>Play Private Tournaments</b></h4>
			</div>
		</div>  -->
		
		
	<?php if(@$userInfo['user_type'] == 1){ ?>	
		
		<?php if($this->practiceBannersEnabled == 1 && is_array($practiceBanners) && count(@$practiceBanners)>0 ){ ?>
		
		<div class="row">
			<div class="text-left col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 header-text-2" style="width:75%;">
				<h4 class="text-bold text-white">&nbsp;&nbsp;&nbsp; Practice For Tournaments</h4>
			</div>
		</div>
		
		<div class="row"> <br> </div>
		
		<div class="row">
			<div id="practice-banners-slider" class="slider">
				
				<?php foreach($practiceBanners as $pbRow){ ?>
					<a href="<?php echo site_url('playGame/'.base64_encode($pbRow['banner_gameboost_id'])) ?>">
						<img  class="lazy" src="<?php echo base_url('uploads/practise-banners/'.$pbRow['banner_image_path']) ?>" /> 
					</a>
				<?php } ?>
				
			</div>
		</div>
		
		<?php }  ?>
		
		
		<?php if($this->heroTournamentEnabled == 1 && is_array($heroTournaments) && count(@$heroTournaments)>0 ){ ?>
		
	
		<div class="row text-left"> <h5 class="text-bold theme-color" style="font-size:1.25em;">&nbsp;&nbsp; Tournaments of the week</h5> <br></div>
		
		<div class="row text-left">
			<div id="hero-tournaments-slider" class="slider">
				
				<?php foreach($heroTournaments as $heroRow){ ?>
					<a href="<?php echo site_url('LiveTournaments/'.base64_encode($heroRow['tournament_id'])) ?>" aria-hidden="false">
						<img class="lazy" src="<?php echo base_url('uploads/tournaments-banners/'.$heroRow['banner_image_path']) ?>" /> 
						
						
						<div class="row">
							<div class="col-xs-5">
								<div class="live-ticker col-8"><span class="blink_me">LIVE</span></div>
							</div>
							<div class="col-xs-7">
							<div data-countdown="<?php echo date('Y/m/d', strtotime($heroRow['tournament_end_date'])) ?> <?php echo $heroRow['tournament_end_time'].":00"; ?>" class="time-ticker" id="st-timer-<?php echo $heroRow['tournament_id']; ?>"> </div>
					
							</div>
						</div>
					
						<div class="row bottom-ticker">
							<div class="col-xs-5">
							<h5 class=" text-bold text-white text-left"> &nbsp;&nbsp; WIN <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" style="width:18px; display:inline; margin-top:-3px;"><span style="font-size:1.1em;"><?php echo $heroRow['tournament_prize_1']; ?></span></h5>
							</div>
							<div class="col-xs-7 text-right text-white" >
								<div class=" text-right"  style="margin-top:5px;">
									<div class=" text-white text-bold">
									Entry Fee &nbsp; 
									<?php if($heroRow['tournament_fee'] == 0){ ?>
										<b>Free</b> 
									<?php } else { ?>
									<img src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" style="width:18px; display:inline; margin-top:-3px;">
										 <b><?php echo $heroRow['tournament_fee']; ?></b> 
									<?php }  ?>
									</div>
								</div>
							</div>
						</div>
						
					</a>
					
				<?php } ?>
				
			</div>
		</div>
		
		<?php }  ?>
		
		
		
		<?php if($this->smallTournamentEnabled == 1 && is_array($smallTournaments) && count(@$smallTournaments)>0 ){ ?>
	
		<div class="row text-left" style="margin-top:-70px;"> <h5 class="text-bold theme-color" style="font-size:1.25em;">&nbsp;&nbsp; Tournaments of the day</h5><br> </div>
		
		<div class="row text-left" >
			<div id="medium-tournaments-slider" class="slider">
				
					<?php foreach($suggestedGames as $rowSuggested){ ?>
						
						<?php if(@$userInfo['user_type'] == 1  || $accessUnsubscribe){ ?>
							<a href="<?php echo site_url('playGame/'.base64_encode($rowSuggested['id'])); ?>">
						<?php 	} else { ?>
							<a href="#" class="unauthorized">
						<?php 	} ?>						
						<!-- <img  class="lazy" src="<?php echo $rowSuggested['GameImage']; ?>" />  -->
								<img  class="lazy" src="<?php echo base_url('uploads/suggested-games/'.$rowSuggested['ImageName']); ?>" /> 
							
							<div data-countdown="<?php echo date('Y/m/d') ?> <?php echo "23:59:59"; ?>" class="time-ticker" id="mt-timer-<?php echo $rowSuggested['id']; ?>"> </div>
					
								<h5 class="small-txt text-white"> &nbsp;&nbsp; WIN <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" style="width:18px; display:inline; margin-top:-3px;"> <span style="font-size:1em;">100</span></h5>
						
							</a>
							
							
					<?php } ?>
				
			</div>
		</div>
		
		<?php }  ?>
		
		
		
		<?php if($this->smallTournamentEnabled == 1 && is_array($smallTournaments) && count(@$smallTournaments)>0 ){ ?>
	
		<div class="row text-left"> <h5 class="text-bold theme-color" style="font-size:1.25em;">&nbsp;&nbsp; Instant tournaments to play</h5><br> </div>
		
		<div class="row text-left" >
			<div id="small-tournaments-slider" class="slider">
				
				<?php foreach($smallTournaments as $stRow){ ?>
					<a href="<?php echo site_url('LiveTournaments/'.base64_encode($stRow['tournament_id'])) ?>" aria-hidden="false">
						<img  class="lazy" src="<?php echo base_url('uploads/games/'.$stRow['tournament_gameboost_id'].'.jpg') ?>" /> 
						<div data-countdown="<?php echo date('Y/m/d', strtotime($stRow['tournament_end_date'])) ?> <?php echo $stRow['tournament_end_time'].":00"; ?>" class="time-ticker" id="st-timer-<?php echo $stRow['tournament_id']; ?>"> </div>
					
						
						<?php if($stRow['tournament_reward_type'] == 1){ ?>
							<h5 class="small-txt text-white"> &nbsp;&nbsp; WIN <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" style="width:18px; display:inline; margin-top:-3px;"> <span style="font-size:1em;"><?php echo $stRow['tournament_prize_1']; ?></span></h5>
						<?php } else { ?>
							<h5 class="small-txt text-white"> &nbsp;&nbsp; Play Now</h5>
						<?php }  ?>
						
					</a>
					
				
						
						
				<?php } ?>
				
			</div>
		</div>
	
		<?php }  ?>
		
		
		
		<?php if($this->quickTournamentEnabled == 1){ ?>
		<!-- <div class="row">
			<div class="text-left col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 header-text-2" style="width:75%;">
				<h4 class="text-bold text-white">&nbsp;&nbsp;&nbsp; Play Private Tournaments</h4>
			</div>
		</div>  -->
		
		<div class="row text-left"><h5 class="text-bold  theme-color"  style="font-size:1.25em;">&nbsp;&nbsp; Play Private Tournaments</h5> </div>
		<div class="row text-left"><span class="head-desc" style="font-size:1em;">&nbsp;&nbsp;&nbsp; Quick  tournaments with friends</span></div>
		<!-- <div class="row text-left text-white"> <h5 class="text-bold  theme-color"  style="font-size:1.15em;">&nbsp;&nbsp; Quick  tournaments with friends</h5> </div>
		-->
		
		
		<div class="row"><br>
			<div id="main-slider" class="slider">
				
				<?php foreach($quickTournaments as $qtRow){ ?>
					<a href="<?php echo site_url('site/customTournament/'.$qtRow['quick_gid']) ?>">
						<img  class="lazy" src="<?php echo base_url('uploads/banners/'.$qtRow['quick_gameboost_id'].'.jpg') ?>" /> 
					</a>
				<?php } ?>
				
			</div>
		</div>
		<?php } else { ?>
		
		<div class="row"> <br> </div>
		<?php }  ?>
		
		
	
		<?php if(is_array($liveInfo) && count($liveInfo)>0  && ($t_current_status == 1 || $t_current_status == 3) ){ ?>
		
		<div id="live_tournament" class="row bg-dark-2">
			<?php if($t_current_status == 1) { ?>
			<div  class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right" style="margin-top: -15px;"> 
				<h5 class="text-white blink_me"><i class="fa fa-play"></i> Live </h5>
			</div>
			<?php } else { echo "<br>"; } ?>
		
			<div class="col-5 col-xs-5 col-sm-5 col-md-5 col-lg-5 text-left" style="padding-bottom:10px; padding-left: 0!important;">
				<img  class="img-responsive lazy" style="border:1px solid #ccc; border-radius:5px;" src="<?php echo base_url()."uploads/games/".$liveInfo['t_game_id'].".jpg"; ?>" />
			</div>
			
			<div class="col-7 col-xs-7 col-sm-7 col-md-7 col-lg-7 text-left" style="padding:0 !important;">
				<h4 class="text-bold" style="margin-top:5px !important;"> <?php echo $liveInfo['t_game_name']; ?></h4>
				<!-- <p> <b>Ends In</b>: <span id="timer"> 0 Hrs : 00 Mins </span></p>  -->
				<?php if($t_current_status == 1) { ?>
					<p> <span id="start_span"> Ends In </span> <span id="timer"></span></p> 
				<?php } else if($t_current_status == 2) { ?>
					<p> <span id="start_span"> Ends In </span> <span id="timer"></span></p> 		
				<?php } else if($t_current_status == 3) {  ?>
					<p>  <span id="start_span"> Starts In </span> <span id="timer"></span></p> 
				<?php }   ?>
				
				<?php /* if($t_current_status ==1) {  ?>
				<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right"> 
					<br><a href="<?php echo site_url('PlayTournament/'.base64_encode($liveInfo['t_id'])) ?>" class="btn btn-warning">Play Now &nbsp;<i class="fa fa-angle-right"></i></a>
				</div>
				<?php }  if($t_current_status ==3) { ?>
					<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right"> 
						<br><a href="<?php echo site_url('TournamentInfo/'.base64_encode($liveInfo['t_share_code'])) ?>" class="btn btn-warning">Details &nbsp;<i class="fa fa-angle-right"></i></a>
					</div>
				<?php } */ ?>
				
				<?php  if($t_current_status == 1) { ?>
					<a href="<?php echo site_url('PlayTournament/'.base64_encode($liveInfo['t_id'])) ?>" class="btn btn-outline-dark">Play Now &nbsp;<i class="fa fa-angle-right"></i></a>
				<?php } else if($t_current_status == 2) { ?>
					<a href="<?php echo site_url('TournamentLeaderboard/'.base64_encode($liveInfo['t_id'])) ?>" class="btn btn-outline-dark">Show Results &nbsp;<i class="fa fa-angle-right"></i></a>
				<?php } else if($t_current_status == 3) { ?>
					
					<!-- <a href="<?php echo site_url('TournamentInfo/'.base64_encode($liveInfo['t_share_code'])) ?>" class="btn btn-outline-dark">Details &nbsp;<i class="fa fa-angle-right"></i></a>
							-->
						<?php $loggedinUser = $this->session->userdata('userId'); ?>
						<?php if($liveInfo['t_user_id'] == $loggedinUser){ ?>
							<a href="<?php echo site_url('Tournaments/'.base64_encode($liveInfo['t_id'])) ?>" class="btn btn-outline-dark">Details &nbsp;<i class="fa fa-angle-right"></i></a>
						<?php } else { ?>
							<a href="<?php echo site_url('TournamentInfo/'.base64_encode($liveInfo['t_share_code'])) ?>" class="btn btn-outline-dark">Details &nbsp;<i class="fa fa-angle-right"></i></a> 
						<?php } ?>
						
				<?php } ?>
				
			</div>
		</div>
		
		<div class="row"> <br> </div>
		
	<?php } ?>
		
		
	<!-- 	<div class="row text-left"> <h5 class="text-bold">&nbsp;&nbsp; Create & Invite Friends </h5> </div>  -->
		
		<?php if($this->createTournamentEnabled == 1){ ?>
		<div class="row"> 
			<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<a  href="<?php echo site_url('createTournament/Step-1') ?>"  >
					<img class="custom-border  lazy"  src="<?php echo base_url() ?>uploads/pt-banner-2.jpg" />
				</a>
			</div>
		</div>
		
		<div class="row"> <br> </div>
		<div class="row"> <br> </div>
		
		<?php } ?>
		
		<?php if($this->globalLeaderboardEnabled == 1){ ?>
		
			<!-- <div class="row text-center header-text"><h4><b>Leaderboard</b></h4></div>  -->
			<div class=" row">
				<div class="text-left col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 header-text-2" style="width:55%;">
					<h4 class="text-bold text-white">&nbsp;&nbsp;&nbsp; Leaderboard</h4>
				</div>
			</div>
			
			
			<div class="row"> <br> </div>
			<div id="global_leaderboard">
			</div>
			
			<div class="row"> <br><br> </div>
			
		<?php } ?>
		
		
	<?php } ?>
		
		<!--
		<div class=" row">
			<div class="text-left col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 header-text-2" style="width:55%;">
				<h4 class="text-bold text-white">&nbsp;&nbsp;&nbsp; Play & Practice</h4>
			</div>
		</div>
		-->
		
		<div class="row text-left"><h5 class="text-bold  theme-color"  style="font-size:1.25em;">&nbsp;&nbsp; Suggested Games</h5> </div>
		<div class="row text-left"><span class="head-desc" style="font-size:1em;">&nbsp;&nbsp;&nbsp; Play & Practice</span></div>
		
		<?php if(is_array($suggestedGames) && count($suggestedGames)>0){ ?>
				<!-- <div class="row text-left text-white"> <h5 class="text-bold theme-color"  style="font-size:1.15em;">&nbsp;&nbsp; Suggested Games </h5> </div>
				-->
				<div class="row"><br>
					<div id="suggested" class="slider">
						<?php foreach($suggestedGames as $rowSuggested){ ?>
						
						<?php if(@$userInfo['user_type'] == 1  || $accessUnsubscribe){ ?>
							<a href="<?php echo site_url('playGame/'.base64_encode($rowSuggested['id'])); ?>">
						<?php 	} else { ?>
							<a href="#" class="unauthorized">
						<?php 	} ?>						
						<!-- <img  class="lazy" src="<?php echo $rowSuggested['GameImage']; ?>" />  -->
								<img  class="lazy" src="<?php echo base_url('uploads/suggested-games/'.$rowSuggested['ImageName']); ?>" /> 
							</a>
						<?php } ?>
					</div>
				</div>
		<?php } ?>
		
		
		<?php if(is_array($topGames) && count($topGames)>0){ ?>
				<div class="row text-left"><h5 class="text-bold  theme-color"  style="font-size:1.25em;">&nbsp;&nbsp;  Top Trending</h5> </div>
				<div class="row text-left"><span class="head-desc" style="font-size:1em;">&nbsp;&nbsp;&nbsp; Free to play games</span></div>
		
				
				<!-- <div class="row text-left text-white"> <h5 class="text-bold theme-color"  style="font-size:1.15em;">&nbsp;&nbsp;  Top Trending </h5> </div>
				-->
				
				<div class="row"><br>
					<div id="trending" class="slider">
						<?php foreach($topGames as $rowTop){ ?>
						
						<?php if(@$userInfo['user_type'] == 1  || $accessUnsubscribe){ ?>
							<a href="<?php echo site_url('playGame/'.base64_encode($rowTop['id'])); ?>">
						<?php 	} else { ?>
							<a href="#" class="unauthorized">
						<?php 	} ?>	
							
								<img  class="lazy" src="<?php echo base_url('uploads/games/'.$rowTop['ImageName']); ?>" /> 
							</a>
						<?php } ?>
					</div>
				</div>
		<?php } ?>
		
		
		
		<!-- <div class="row text-left"> <h5 class="text-bold">&nbsp;&nbsp; Top Trending </h5> </div>
		<div class="row">
			<div id="trending" class="slider">
				<a href="<?php echo site_url('playGame/'.base64_encode('107604')) ?>">
					<img  class="lazy" src="<?php echo base_url() ?>uploads/games/107604.jpg" /> 
				</a>
				<a href="<?php echo site_url('playGame/'.base64_encode('107646')) ?>">
					<img  class="lazy" src="<?php echo base_url() ?>uploads/games/107646.jpg" />
				</a>
				<a href="<?php echo site_url('playGame/'.base64_encode('107780')) ?>">
					<img  class="lazy" src="<?php echo base_url() ?>uploads/games/107780.jpg" />
				</a>
				<a href="<?php echo site_url('playGame/'.base64_encode('107487')) ?>">
					<img  class="lazy" src="<?php echo base_url() ?>uploads/games/107487.jpg" />
				</a>
				
				<a href="<?php echo site_url('playGame/'.base64_encode('108123')) ?>">
					<img  class="lazy" src="<?php echo base_url() ?>uploads/games/108123.jpg" />
				</a>
				
				<a href="<?php echo site_url('playGame/'.base64_encode('107557')) ?>">
					<img  class="lazy" src="<?php echo base_url() ?>uploads/games/107557.jpg" />
				</a>
				
			</div>
		</div>  -->
		
		
		<?php /* if(is_array($actionGames) && count($actionGames)>0){ ?>
				<div class="row"> 
					<div class="col-xs-6 col-sm-6 col-md-8 text-left"><h5 class="text-bold text-white">Action</h5></div>
					<div class="col-xs-6 col-sm-6 col-md-4 text-right"><a href="<?php echo site_url('Games/Action') ?>"><p>See All <i class="fa fa-angle-double-right"></i></p></a></div>
				</div>
				<div class="row">
					<div  class="genre_games slider">
						<?php foreach($actionGames as $rowAction){ ?>
						
							<?php if(@$userInfo['user_type'] == 1  || $accessUnsubscribe){ ?>
								<a href="<?php echo site_url('playGame/'.base64_encode($rowAction['id'])); ?>">
							<?php 	} else { ?>
								<a href="#" class="unauthorized">
							<?php 	} ?>
							
								<img  class="lazy" data-src="<?php echo base_url('uploads/games/'.$rowAction['ImageName']); ?>" src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif" /> 
							</a>
						<?php } ?>
					</div>
				</div>
		<?php } */ ?>
		
		<?php /* if(is_array($arcadeGames) && count($arcadeGames)>0){ ?>
			<div class="row text-left"> 
				<div class="col-xs-6 col-sm-6 col-md-8 text-left"><h5 class="text-bold text-white">Arcade</h5></div>
				<div class="col-xs-6 col-sm-6 col-md-4 text-right"><a href="<?php echo site_url('Games/Arcade') ?>"><p>See All <i class="fa fa-angle-double-right"></i></p></a></div>
			</div>
			<div class="row">
				<div  class="genre_games slider">
					<?php foreach($arcadeGames as $rowArcade){ ?>
						
						<?php if(@$userInfo['user_type'] == 1  || $accessUnsubscribe){ ?>
							<a href="<?php echo site_url('playGame/'.base64_encode($rowArcade['id'])); ?>">
						<?php 	} else { ?>
							<a href="#" class="unauthorized">
						<?php 	} ?>
						
							<img  class="lazy" data-src="<?php echo base_url('uploads/games/'.$rowArcade['ImageName']); ?>" src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif" /> 
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } */ ?>
		
		
		<?php /* if(is_array($adventureGames) && count($adventureGames)>0){ ?>
			<div class="row"> 
				<div class="col-xs-6 col-sm-6 col-md-8 text-left text-white"><h5 class="text-bold">Adventure</h5></div>
				<div class="col-xs-6 col-sm-6 col-md-4 text-right"><a href="<?php echo site_url('Games/Adventure') ?>"><p>See All <i class="fa fa-angle-double-right"></i></p></a></div>
			</div>
			<div class="row">
				<div class="genre_games slider">
				<?php foreach($adventureGames as $rowAdventure){ ?>
				
					<?php if(@$userInfo['user_type'] == 1  || $accessUnsubscribe){ ?>
						<a href="<?php echo site_url('playGame/'.base64_encode($rowAdventure['id'])); ?>">
					<?php 	} else { ?>
						<a href="#" class="unauthorized">
					<?php 	} ?>
			
						<img  class="lazy" data-src="<?php echo base_url('uploads/games/'.$rowAdventure['ImageName']); ?>" src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif" /> 
					</a>
				<?php } ?>
				</div>
			</div>
		<?php } */ ?>
		
		
		<?php /* if(is_array($sportsGames) && count($sportsGames)>0){ ?>
			<div class="row"> 
				<div class="col-xs-6 col-sm-6 col-md-8 text-left text-white"><h5 class="text-bold">Sports & Racing</h5></div>
				<div class="col-xs-6 col-sm-6 col-md-4 text-right"><a href="<?php echo site_url('Games/Sports') ?>"><p>See All <i class="fa fa-angle-double-right"></i></p></a></div>
			</div>
			<div class="row">
				<div class="genre_games slider">
				<?php foreach($sportsGames as $rowSports){ ?>
				
					<?php if(@$userInfo['user_type'] == 1  || $accessUnsubscribe){ ?>
						<a href="<?php echo site_url('playGame/'.base64_encode($rowSports['id'])); ?>">
					<?php 	} else { ?>
						<a href="#" class="unauthorized">
					<?php 	} ?>
					
						<img  class="lazy" data-src="<?php echo base_url('uploads/games/'.$rowSports['ImageName']); ?>" src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif" /> 
					</a>
				<?php } ?>
				</div>
			</div>
		<?php } */ ?>
		
		
		<?php /* if(is_array($puzzleGames) && count($puzzleGames)>0){ ?>
			<div class="row"> 
				<div class="col-xs-6 col-sm-6 col-md-8 text-left text-white"><h5 class="text-bold">Puzzle & Logic</h5></div>
				<div class="col-xs-6 col-sm-6 col-md-4 text-right"><a href="<?php echo site_url('Games/Puzzle') ?>"><p>See All <i class="fa fa-angle-double-right"></i></p></a></div>
			</div>
			<div class="row">
				<div class="genre_games slider">
				<?php foreach($puzzleGames as $rowPuzzle){ ?>
					
					<?php if(@$userInfo['user_type'] == 1  || $accessUnsubscribe){ ?>
						<a href="<?php echo site_url('playGame/'.base64_encode($rowPuzzle['id'])); ?>">
					<?php 	} else { ?>
						<a href="#" class="unauthorized">
					<?php 	} ?>
					
						<img  class="lazy" data-src="<?php echo base_url('uploads/games/'.$rowPuzzle['ImageName']); ?>"  src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif" /> 
					</a>
				<?php } ?>
				</div>
			</div>
		<?php } */ ?>
		
			
				<div class="row text-left"><h5 class="text-bold  theme-color"  style="font-size:1.25em;">&nbsp;&nbsp;  Genre Games </h5> </div>
				<div class="row text-left"><span class="head-desc" style="font-size:1em;">&nbsp;&nbsp;&nbsp; Instant games to play </span></div>
		
			
			<div class="row" style="margin-bottom:50px !important;"><br>
				<div class="glider-contain">
		        <div class="glider-2">
			            
						<div>
							<?php foreach($actionGames as $rowAction){ ?>
								<div class="row thumbnails">
									<div class="col-xs-3"><img class="lazy thumb-img" src="<?php echo base_url('uploads/games/'.$rowAction['ImageName']); ?>" ></div>
									<div class="col-xs-7 text-white text-left"><h3><?php echo $rowAction['Name']; ?></h3><span class="head-desc">Action</span></div>
									<div class="col-xs-2"><i class="fa fa-play"></i></div>
								</div>
							<?php } ?>
			            </div>
						
						<div>
							<?php foreach($arcadeGames as $rowArcade){ ?>
								<div class="row thumbnails">
									<div class="col-xs-3"><img class="lazy thumb-img" src="<?php echo base_url('uploads/games/'.$rowArcade['ImageName']); ?>" ></div>
									<div class="col-xs-7 text-white text-left"><h3><?php echo $rowArcade['Name']; ?></h3><span class="head-desc">Arcade</span></div>
									<div class="col-xs-2"><i class="fa fa-play"></i></div>
								</div>
							<?php } ?>
			            </div>
						
						<div>
							<?php foreach($adventureGames as $rowAdventure){ ?>
								<div class="row thumbnails">
									<div class="col-xs-3"><img class="lazy thumb-img" src="<?php echo base_url('uploads/games/'.$rowAdventure['ImageName']); ?>" ></div>
									<div class="col-xs-7 text-white text-left"><h3><?php echo $rowAdventure['Name']; ?></h3><span class="head-desc">Adventure</span></div>
									<div class="col-xs-2"><i class="fa fa-play"></i></div>
								</div>
							<?php } ?>
			            </div>
						
						<div>
							<?php foreach($sportsGames as $rowSports){ ?>
								<div class="row thumbnails">
									<div class="col-xs-3"><img class="lazy thumb-img" src="<?php echo base_url('uploads/games/'.$rowSports['ImageName']); ?>" ></div>
									<div class="col-xs-7 text-white text-left"><h3><?php echo $rowSports['Name']; ?></h3><span class="head-desc">Sports & Racing</span></div>
									<div class="col-xs-2"><i class="fa fa-play"></i></div>
								</div>
							<?php } ?>
			            </div>
						
						<div>
							<?php foreach($puzzleGames as $rowPuzzle){ ?>
								<div class="row thumbnails">
									<div class="col-xs-3"><img class="lazy thumb-img" src="<?php echo base_url('uploads/games/'.$rowPuzzle['ImageName']); ?>" ></div>
									<div class="col-xs-7 text-white text-left"><h3><?php echo $rowPuzzle['Name']; ?></h3><span class="head-desc">Puzzle & Logic</span></div>
									<div class="col-xs-2"><i class="fa fa-play"></i></div>
								</div>
							<?php } ?>
			            </div>
					</div>
					
    			</div>
			</div>
		
		
		<div class="row"> 
			<div class="col-xs-12 col-sm-12 col-md-12 text-left theme-color"><br><br></div>
		</div>
		
		
		
	</div>
</section>


	<!-- Footer-Content -->
		<?php include "footer.php"; ?>
	<!-- Footer Content End -->



<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog box-center ">
    
      <!-- Modal content-->
       <div class="modal-content modal-bg  modal-bg-error" align="center">

         <div class="modal-body">
           <img src="<?php echo base_url('assets/frontend/img/sad-face.png') ?>" />
          <br>
		  <?php if( @$userInfo['user_reward_coins'] <= 0){ ?>
				<h4> <b> Sorry!</b></h4>
				<p>Right now you don't have enough reward coins to get the access of this section . </p>
				<br><br>
				<button type="button" class="btn modal-btn-dark" data-dismiss="modal">Close</button>
		
		  <?php } else { ?>
				<h4> <b> Access Restriced!</b></h4>
				<p>You can redeem your reward coins to free access this section. <br>Do you want to proceed further? </p>
			  
			   <br><br>
				<button type="button" class="btn modal-btn-dark" data-dismiss="modal">Close</button>
				<a href="<?php echo site_url('RedeemCoins') ?>"><button type="button" class="btn modal-btn-dark">Proceed</button></a>
       
		  <?php }  ?>
		  
		   </div>
      </div>
      
    </div>
  </div>
  
  
<div class="modal fade" id="successModal" role="dialog">
    <div class="modal-dialog box-center">
      <div class="modal-content modal-bg  modal-bg-success" align="center">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>   -->
        <div class="modal-body">
         <!--  <i class="fa fa-check-circle text-success" style="font-size:32px; "></i>  -->
          <img src="<?php echo base_url('assets/frontend/img/happy-face.png') ?>" />
          <br>
		  <h4 class="text-white"> <b> Success! </b></h4>
          <p class="text-white"><?php echo @$this->session->flashdata('success') ?></p>
		  <br><br>
		  <button type="button" class="btn modal-btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
 

 
<div class="modal fade" id="errorModal" role="dialog">
    <div class="modal-dialog box-center">
      <div class="modal-content modal-bg  modal-bg-error" align="center">
      
        <div class="modal-body">
           <img src="<?php echo base_url('assets/frontend/img/sad-face.png') ?>" />
          <br>
		  <h4> <b> OOPS ! </b></h4>
          <p><?php echo @$this->session->flashdata('error') ?></p>
		   <br><br>
		  <button type="button" class="btn modal-btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
 
<div class="modal fade" id="redemptionErrorModal" role="dialog">
    <div class="modal-dialog box-center">
      <div class="modal-content modal-bg modal-bg-error" align="center">
      
        <div class="modal-body">
           <img src="<?php echo base_url('assets/frontend/img/sad-face.png') ?>" />
          <br>
		  <h4> <b> OOPS ! </b></h4>
          <p><?php echo @$this->session->flashdata('redemption_error') ?></p>
		   <br><br>
		  <button type="button" class="btn modal-btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
  

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "80%";
}

function closeNav() {
  //document.getElementById("mySidenav").style.width = "0";
}
</script>



<script>
jQuery(document).ready(function ($) {
	jQuery("#close-sidebar").on('click', function () {
	jQuery("#mySidenav").css('width','0');
		
	});
}); 
</script>



<script>
jQuery(document).ready(function ($) {
	jQuery(".unauthorized").on('click', function () {
		jQuery('#myModal').modal('show');
	});
}); 
</script>



<?php if($this->session->flashdata('redemption_error')){ ?>
<script>
jQuery(document).ready(function ($) {
	jQuery('#redemptionErrorModal').modal('show');
}); 
</script>
<?php } ?>



<?php if($this->session->flashdata('error')){ ?>
<script>
jQuery(document).ready(function ($) {
	jQuery('#errorModal').modal('show');
}); 
</script>
<?php } ?>


<?php if($this->session->flashdata('success')){ ?>
<script>
jQuery(document).ready(function ($) {
	jQuery('#successModal').modal('show');
}); 
</script>
<?php } ?>


<script>
jQuery(document).ready(function ($) {
  $("#practice-banners-slider").slick({
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 400,
        settings: {
          arrows: false,
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
    ]
  });
});

</script>


<script>
jQuery(document).ready(function ($) {
  $("#hero-tournaments-slider").slick({
    dots: false,
    infinite: true, 
    speed: 500,
    slidesToShow: 1.5,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 4000,
	arrows: false,

    responsive: [
      {
        breakpoint: 600,
        settings: {
		arrows: false,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 400,
        settings: {
          arrows: false,
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
});

</script>



<script>
jQuery(document).ready(function ($) {
  $("#medium-tournaments-slider").slick({
    dots: false,
    infinite: true, 
    speed: 500,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 4000,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
		arrows: false,
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 400,
        settings: {
          arrows: false,
          slidesToShow: 3,
          slidesToScroll: 1
        }
      }
    ]
  });
});

</script>




<script>
jQuery(document).ready(function ($) {
  $("#small-tournaments-slider").slick({
    dots: false,
    infinite: true, 
    speed: 500,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 4000,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
		arrows: false,
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 400,
        settings: {
          arrows: false,
          slidesToShow: 3,
          slidesToScroll: 1
        }
      }
    ]
  });
});

</script>



<script>
jQuery(document).ready(function ($) {
  $("#main-slider").slick({
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 400,
        settings: {
          arrows: false,
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
    ]
  });
});

</script>


<script>
jQuery(document).ready(function ($) {
  $("#suggested").slick({
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 400,
        settings: {
          arrows: false,
          slidesToShow: 3,
          slidesToScroll: 1
        }
      }
    ]
  });
});

</script>

<script>
jQuery(document).ready(function ($) {
  $("#trending").slick({
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 400,
        settings: {
          arrows: false,
          slidesToShow:3,
          slidesToScroll: 1
        }
      }
    ]
  });
});

</script>


<script>
jQuery(document).ready(function ($) {
  $(".genre_games").slick({
    dots: false,
    infinite: false,
    speed: 500,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 400,
        settings: {
          arrows: false,
          slidesToShow: 3,
          slidesToScroll: 1
        }
      }
    ]
  });
});

</script>
<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>

<script>
$(document).ready(function() {
    $.ajax({
		url:"<?php echo site_url('site/globalLeaderboardHomepage') ?>",
		type:"POST",
		cache:false,
		success: function(data){
			//alert(data);
			$("#global_leaderboard").empty();
			$("#global_leaderboard").html(data);
		}
	});
});
</script>

<script>
   /* $(function() {
        $('.lazy').lazy();
    });  */
</script>


<script>
!function(window){
  var $q = function(q, res){
        if (document.querySelectorAll) {
          res = document.querySelectorAll(q);
        } else {
          var d=document
            , a=d.styleSheets[0] || d.createStyleSheet();
          a.addRule(q,'f:b');
          for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
            l[b].currentStyle.f && c.push(l[b]);

          a.removeRule(0);
          res = c;
        }
        return res;
      }
    , addEventListener = function(evt, fn){
        window.addEventListener
          ? this.addEventListener(evt, fn, false)
          : (window.attachEvent)
            ? this.attachEvent('on' + evt, fn)
            : this['on' + evt] = fn;
      }
    , _has = function(obj, key) {
        return Object.prototype.hasOwnProperty.call(obj, key);
      }
    ;

  function loadImage (el, fn) {
    var img = new Image()
      , src = el.getAttribute('data-src');
    img.onload = function() {
      if (!! el.parent)
        el.parent.replaceChild(img, el)
      else
        el.src = src;

      fn? fn() : null;
    }
    img.src = src;
  }

  function elementInViewport(el) {
    var rect = el.getBoundingClientRect()

    return (
       rect.top    >= 0
    && rect.left   >= 0
    && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
    )
  }

    var images = new Array()
      , query = $q('img.lazy')
      , processScroll = function(){
          for (var i = 0; i < images.length; i++) {
            if (elementInViewport(images[i])) {
              loadImage(images[i], function () {
                images.splice(i, i);
              });
            }
          };
        }
      ;
    // Array.prototype.slice.call is not callable under our lovely IE8 
    for (var i = 0; i < query.length; i++) {
      images.push(query[i]);
    };

    processScroll();
    addEventListener('scroll',processScroll);

}(this);
</script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
	$('[data-countdown]').each(function() {
	  var $this = $(this), finalDate = $(this).data('countdown');
	  $this.countdown(finalDate, function(event) {
		$this.html(event.strftime('%Dd : %Hh : %Mm : %Ss'));
	  });
	});
});
</script>


</body>
</html>