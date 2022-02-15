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
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/style_theme_2.css">
	
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

			  // Get today's date and time
			  var now = new Date().getTime();
			
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
.modal_custom{
	margin-top:17%;
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
#small-tournaments-slider .slick-list{padding:0 40% 0 0 !important; }
#small-tournaments-slider .time-ticker{
	text-align:center;
	font-size:1.15em;
	border-radius:0 !important;
	border-bottom-right-radius: 10px !important;
	border-bottom-left-radius: 10px !important;
	background:rgba(72, 254, 72,0.5);
	color:#efefef;
	position:relative;
	margin-top:0;
	padding:3px 0 3px 0;
	
}


.small-tournaments-slider img{
	border-radius:0 !important;
	border-top-right-radius: 10px !important;
	border-top-left-radius: 10px !important;
}
.small-tournaments-slider .slick-list{padding:0 40% 0 0 !important; }
.small-tournaments-slider .time-ticker{
	text-align:center;
	font-size:1.15em;
	border-radius:0 !important;
	border-bottom-right-radius: 10px !important;
	border-bottom-left-radius: 10px !important;
	background:rgba(72, 254, 72,0.5);
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
#medium-tournaments-slider .slick-list{padding:0 10% 0 0 !important; }
#medium-tournaments-slider .time-ticker{
	text-align:center;
	font-size:1.05em;
	border-radius:0 !important;
	border-bottom-right-radius: 10px !important;
	border-bottom-left-radius: 10px !important;
	background:rgba(72, 254, 72,0.5);
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
	
	font-size:1em;
	border-radius:0 !important;
	border-top-left-radius: 10px !important;
	
	border-bottom-right-radius: 5px !important;
	color:#fff !important;
	background:rgba(255, 87, 51, 0.75) !important;
	color:#efefef;
	position:fixed;
	top:0;
	padding-left:12px;
	padding-right:12px;
	padding-bottom:2px;
	font-weight:600;

}

#hero-tournaments-slider .time-ticker{
	text-align:center;
	font-size:1em;
	border-radius:0 !important;
	border-top-right-radius: 10px !important;

	border-bottom-left-radius: 5px !important;
	background:rgba(0,0,0,0.75);
	color:#efefef;
	position:fixed;
	top:0;
	padding: 2px 32px 4px 32px;
}

#hero-tournaments-slider .bottom-ticker{
	text-align:center;
	font-size:1em;
	border-radius:0 !important;
	border-bottom-right-radius: 10px !important;
	border-bottom-left-radius: 10px !important;
	
	background:rgba(0,0,0,0.75);
	color:#efefef;
	position:fixed;
	
	width:100%;
	margin: 5px auto;
	width: inherit;
margin: 5px auto;
bottom: -4px;
	
}

.btn-entry-fee{
	
	border: 1px solid #48ff48;
	border-radius: 3px;
	display: inline-block;
	padding:5px 15px;
}


.btn-outline-green, .btn-outline-green:active, .btn-outline-green:hover, .btn-outline-green:focus {
	border: 1px solid #48ff48;
	border-radius: 3px;
	display: inline-block;
	padding: 5px 5px;
    color: #48ff48;
    width: 33%;
}


.btn i{

    border: 1px solid #48ff48;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    text-align: center;
    padding-left: 1px;
    line-height: 15px;
    font-size: 5px;
    color: #48ff48;
   
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
		<?php if($msg==true){?>
		<p style="background-color : yellow; font-weight : bold" >Your VIP pass will expire on <?php echo date('d M Y', strtotime($subscriptionDetails['sub_endDate'])); ?>. <?php if($subscriptionDetails['sub_cycle']!='DAILY') {?> We will renew it on <?php echo date('d M Y', strtotime($subscriptionDetails['sub_endDate'].'+1 Days')); ?> <a style="float: right" data-toggle="modal" data-target="#terms_and_conditions"> <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></a> <?php } ?></p>				
		<?php } ?>
		<?php if($parking){?>
		<p style="background-color : yellow; font-weight : bold" > Your Auto Payment failed. <a style="float: right" data-toggle="modal" data-target="#terms_and_conditions"> T&C</a></p>				
		<?php } ?>
		
		
		<div class="container">
			<div class="row">
				<?php  if($this->vipTournamentEnabled == 1 && is_array($vipTournaments) && count(@$vipTournaments)>0 ){ ?>
			<?php $count=0; foreach($vipTournaments as $stRow){ ?>
				<?php if($stRow['c_country_code']==$this->session->userdata('country_code')) { ?>
				<div class="col-xs-12" style="padding:10px;">
					<div class="row text-left col-ls-12"  >
							<div class="slider small-tournaments-slider" >
						
							<a href="<?php echo site_url('LiveTournament/'.base64_encode($stRow['tournament_id'])) ?>" aria-hidden="false">
					
								<img  class="lazy" src="<?php echo base_url('uploads/640X360/'.$stRow['tournament_gameboost_id'].'.jpg') ?>" /> 
								<div data-countdown="<?php echo date('Y/m/d', strtotime($stRow['tournament_end_date'])) ?> <?php echo $stRow['tournament_end_time'].":00"; ?>" class="time-ticker" id="st-timer-<?php echo $stRow['tournament_id']; ?>"> </div>
							
								<div class="row" style="width:98%; margin:0 auto;">
									<h5 class="small-txt text-white text-left col-xs-8 col-sm-8  col-md-8 col-lg-8 " style="margin-top:19px;"> &nbsp;&nbsp; WIN <img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" style="width:18px; display:inline; margin-top:-3px;"> <span style="font-size:1em;"><b><?php echo $stRow['fee_tournament_prize_1']; ?></b></span></h5>
									<h5 class=" btn btn-outline-green text-center col-xs-4 col-sm-4  col-md-4 col-lg-4">Play Now</h5>
									
								</div>			
									
							</a>
					
						
															
							</div>
						</div>
				</div> <!-- col 6 -->
    <?php }  } } ?>

			</div>
		</div>
		
	

		
		
		
		
		
		
		

		
		
	

		
		
	<!-- 	<div class="row text-left"> <h5 class="text-bold">&nbsp;&nbsp; Create & Invite Friends </h5> </div>  -->
		

		
	
		
		
	<?php  // } ?>
		
		<!--
		<div class=" row">
			<div class="text-left col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 header-text-2" style="width:55%;">
				<h4 class="text-bold text-white">&nbsp;&nbsp;&nbsp; Play & Practice</h4>
			</div>
		</div>
		-->
		
		
	
		
	
	

		
			
			
	
		
		<br><br>
		
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
				<p>Right now you don't have enough reward coins to get the access of this section. </p>
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
  
 
<div class="modal fade" id="less_play_coins" role="dialog">
    <div class="modal-dialog box-center">
      <div class="modal-content modal-bg modal-bg-error" align="center">
      
        <div class="modal-body">
           <img src="<?php echo base_url('assets/frontend/img/sad-face.png') ?>" />
          <br>
		  <h4> <b> OOPS ! </b></h4>
          <p><?php echo @$this->session->flashdata('less_play_coins') ?></p>
		   <br><br>
		  <button type="button" class="btn modal-btn-dark">Buy Play Coins</button><br><br>
		  <a class="text-white" href="javascript:(0);" data-dismiss="modal">Close</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="less_custom_tournament" role="dialog">
    <div class="modal-dialog box-center">
      <div class="modal-content modal-bg modal-bg-error" align="center">
      
        <div class="modal-body">
           <img src="<?php echo base_url('assets/frontend/img/sad-face.png') ?>" />
          <br>
		  <h4> <b> OOPS ! </b></h4>
          <p><?php echo @$this->session->flashdata('less_custom_tournament') ?></p>
		   <br><br>
		  <!-- <button type="button" class="btn modal-btn-dark">Buy Play Coins</button><br><br> -->
		  <a class="btn modal-btn-dark" href="javascript:(0);" data-dismiss="modal">Close</a>
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



<?php if($this->session->flashdata('less_play_coins') ){ ?>
<script>
jQuery(document).ready(function ($) {
	jQuery('#less_play_coins').modal('show');
}); 
</script>
<?php } ?>

<?php if($this->session->flashdata('less_custom_tournament') ){ ?>
<script>
jQuery(document).ready(function ($) {
	jQuery('#less_custom_tournament').modal('show');
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
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 4000,
    arrows: false,
    responsive: [
      {
        breakpoint: 600,
        settings: {
		arrows: false,
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
  $("#small-tournaments-slider").slick({
    dots: false,
    infinite: true, 
    speed: 500,
    slidesToShow: 2,
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


<?php if($this->session->userdata('user_login_type') == 4){
//include "bkash_footer.php";
	} ?>
</body>
</html>