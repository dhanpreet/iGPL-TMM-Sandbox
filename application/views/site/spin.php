<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title> Spin & Win</title>
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
	
	<link href='https://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/frontend/spin-wheel/css/style.css">
	
	<style>
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
	<section>
		<div class="f1lhk7ql" style="padding-left:10px;"><a href="<?php echo site_url() ?>" style=""><img class="" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14"></a><div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);"> Spin & Win </div></div>
		
  
		<div class="wheelContainer module" >
		  <svg class="wheelSVG" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid meet" text-rendering="optimizeSpeed">
		<defs>
		<filter id="shadow" x="-100%" y="-100%" width="550%" height="550%">
		  <feOffset in="SourceAlpha" dx="0" dy="0" result="offsetOut"></feOffset>        
		  <feGaussianBlur stdDeviation="9" in="offsetOut" result="drop" />
		<feColorMatrix in="drop" result="color-out" type="matrix"
			  values="0 0 0 0   0
					  0 0 0 0   0 
					  0 0 0 0   0 
					  0 0 0 .3 0"/>  
		 <feBlend in="SourceGraphic" in2="color-out" mode="normal" />
		</filter> 
		  
		</defs>
		  <g class="mainContainer">   
			<g class="wheel"/>    
		  </g> 
		  <g class="centerCircle" />
			
		  <g class="wheelOutline" />
			<g class="pegContainer" >
			  <path  class="peg" fill="#EEEEEE" d="M22.139,0C5.623,0-1.523,15.572,0.269,27.037c3.392,21.707,21.87,42.232,21.87,42.232	s18.478-20.525,21.87-42.232C45.801,15.572,38.623,0,22.139,0z" /> 
			</g>
		<g class="valueContainer" />
		</svg>
		<div class="toast">  <p/>  </div>
		<div class="btnDiv">
			<a href="<?php echo site_url() ?>" id="skipLink"> <button id="skipBtn" class="btn"> Skip </button> </a>
			<!-- &nbsp;&nbsp;&nbsp;&nbsp;
			<button class="btn"> Claim Reward </button>  -->
		</div>
		  
		 
		</div>
	</section>
	
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/utils/Draggable.min.js'></script>
<script src="<?php echo base_url() ?>assets/frontend/spin-wheel/js/ThrowPropsPlugin.min.js"></script>
<script src="<?php echo base_url() ?>assets/frontend/spin-wheel/js/Spin2WinWheel.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/TextPlugin.min.js'></script>
<?php include "page_session_timeout.php"; ?>
<script>
//var jsonContent = "<?php echo base_url() ?>/wheel_data.json";
var jsonContent = "<?php echo site_url('site/getSpinJSON') ?>";
//load your JSON (you could jQuery if you prefer)
function loadJSON(callback) {

  var xobj = new XMLHttpRequest();
  xobj.overrideMimeType("application/json");
  xobj.open('GET', jsonContent, true); 
  xobj.onreadystatechange = function() {
    if (xobj.readyState == 4 && xobj.status == "200") {
      //Call the anonymous function (callback) passing in the response
      callback(xobj.responseText);
    }
  };
  xobj.send(null);
}

//your own function to capture the spin results
function myResult(e) {
	//e is the result object
	//  console.log('Result Spin Count: ' + e.spinCount + ' - ' + 'Win: ' + e.win + ' - ' + 'Message: ' +  e.msg);
	if(e.spinCount == 3){
		//show the game progress when the spinCount is 3
		//console.log(e.target.getGameProgress());
		//restart it if you like
	   // e.target.restart();
	}  
  
	var claimStr = e.msg; 
	 claimStr = claimStr.split(' ')[2];  
  //  console.log(e.id);
     
  if(e.win == true){
	//$("#skipLink").attr("href", "<?php echo site_url('site/processSpinWin/') ?>"+claimStr);
	// document.getElementById('skipBtn').innerText= 'Claim '+claimStr+" Coins!";
	
	$.ajax({
		url: "<?php echo site_url('site/processSpinWinAjax/') ?>"+e.id,
		type: "POST",
		success: function(data){
			console.log(data)
		}
	});
	//$("#skipLink").attr("href", "<?php echo site_url('site/processSpinWin/') ?>"+e.id);
	$("#skipLink").attr("href", "<?php echo site_url('') ?>");
	document.getElementById('skipBtn').innerText= "Claim Prize";
  } else {
	document.getElementById('skipBtn').innerText= 'Close';
  }
}

//your own function to capture any errors
function myError(e) {
  //e is error object
  //console.log('Spin Count: ' + e.spinCount + ' - ' + 'Message: ' +  e.msg);

}

function myGameEnd(e) {
  //e is gameResultsArray
 // console.log(e);
}

function init() {
  loadJSON(function(response) {
    // Parse JSON string to an object
    var jsonData = JSON.parse(response);
    //if you want to spin it using your own button, then create a reference and pass it in as spinTrigger
    //var mySpinBtn = document.querySelector('.spinBtn');
    //create a new instance of Spin2Win Wheel and pass in the vars object
    var myWheel = new Spin2WinWheel();
    
    //WITH your own button
    //myWheel.init({data:jsonData, onResult:myResult, onGameEnd:myGameEnd, onError:myError, spinTrigger:mySpinBtn});
    
    //WITHOUT your own button
    myWheel.init({data:jsonData, onResult:myResult, onGameEnd:myGameEnd, onError:myError});
  });
}


//And finally call it
init();
</script>

    
  </body>
</html>
