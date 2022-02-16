<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Create Tournament</title>
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
	<script type="text/javascript" src="<?php echo base_url() ?>assets/frontend/js/main.js"></script>
	<style>
	.non-clicked{
		pointer-events: none !important;
	}
	</style>
	
</head>
<body>

	<section>
		<div class="f1lhk7ql"><a href="<?php echo site_url('createTournament/Step-1') ?>"><img class="f1iowekn" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14"></a><div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);">Create Tournament</div></div>
		
		<div class="step-container header-padding" >
			 <h3 class="step2 theme-color">STEP 2</h3>
		</div>
		<div class="step-container  custom-border-thin" >
		
			<img src="<?php echo base_url()."uploads/games/".$gameInfo['GameImage']; ?>" class="thumb-icon">
			<div class="thumb-icon-game-name">
				<span class="game-name text-white font15EM"><?php echo @$gameInfo['Name']; ?></span>
			</div>
			<div class="again-select"><a href="<?php echo site_url('createTournament/Step-1') ?>"><img src="https://cdn.zeplin.io/5b8799579d9d9032d00a89fc/assets/748A0DB5-EFD7-4EA5-B550-4D6F4227A2C7.svg" alt="" width=""></a></div>
		</div>
		
      <div class="select-time-container">
         
         <span class="step2-desc theme-color">Select tournament schedule</span>

            <div style="color: rgb(199, 199, 199); font-size: 12px; text-transform: uppercase; font-weight: 700; padding: 8px 0px;     margin-top: 20px;">Start time</div>

            <div class="center">
              <select name="start_day" id="start_day" class="custom-select sources" required placeholder="Today" style="width: 130px">
               <option value="today" selected>Today</option>
                <option value="tomorrow">Tomorrow</option>
              </select>
			 

              <button class="open-timer" id="hours_minutes" data-toggle="modal" data-target="#myModal">00:00 AM</button>
               <input type="hidden" id="exact_hour" name="exact_hour" />
               <input type="hidden" id="exact_minutes" name="exact_minutes" />
               <input type="hidden" id="exact_ampm" name="exact_ampm" />
              </span>
			 
            </div>

            <div style="color: rgb(199, 199, 199); font-size: 12px; text-transform: uppercase; font-weight: 700; padding: 8px 0px;     margin-top: 20px;">DURATION</div>
			<div class="center">
			  <select name="duration" id="duration" class="custom-select sources" required placeholder="24 Hours" style="width: 160px">
				<option value="6">6 Hours</option>
				<option value="12">12 Hours</option>
				<option value="18">18 Hours</option>
				<option value="24" selected>24 Hours</option>
			  </select>
			</div>
			
      </div>

        <div class="bottom-fixed-btn"><button type="button" id="save_info" class="btn btn-bottom btn-active" style="background: rgb(62, 81, 181) none repeat scroll 0% 0%;">NEXT</button></div>
      
	</section>
	
	
 <div id="myModal" class="modal modal-md fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
	   <div class="modal-header bg-dark">
			<div class="f1mqr89k">
				 <img class="close" data-dismiss="modal" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" alt="" style="position: absolute; left: 10px;">
				 <div class="fh6ecoi" style="color:#fff;">Select Hour</div>
			  </div>
		</div>
	
		<div class="modal-body padd">
		<!-- Select-hour -->
      
			<div class="timer-sample-container">
				<div style="border-radius: 5px; background: rgb(255, 255, 255); width: 100%; padding: 10px;">
			
				<div class="f1mdleym">
					<div class="exact-hour">00</div>
					 :
					 <div class="exact-minutes">00</div>
					 <div class="am-pm">AM</div>
				</div>
				<div class="f1k6gupq">
					<div class="f1u2s0am t-AM">AM</div>
					<div class="f1u2s0am t-PM">PM</div>
				</div>
		  
		  
				<div class="timer-container">
					 <div class="f12pdp9g t-1">
						<div class="f188ddnc">1</div>
					 </div>
					 <div class="f12pdp9g t-2">
						<div class="f188ddnc">2</div>
					 </div>
					 <div class="f12pdp9g t-3">
						<div class="f188ddnc">3</div>
					 </div>
					 <div class="f12pdp9g t-4">
						<div class="f188ddnc">4</div>
					 </div>
					 <div class="f12pdp9g t-5">
						<div class="f188ddnc">5</div>
					 </div>
					 <div class="f12pdp9g t-6">
						<div class="f188ddnc">6</div>
					 </div>
					 <div class="f12pdp9g t-7">
						<div class="f188ddnc">7</div>
					 </div>
					 <div class="f12pdp9g t-8">
						<div class="f188ddnc">8</div>
					 </div>
					 <div class="f12pdp9g t-9">
						<div class="f188ddnc">9</div>
					 </div>
					 <div class="f12pdp9g t-10">
						<div class="f188ddnc">10</div>
					 </div>
					 <div class="f12pdp9g t-11">
						<div class="f188ddnc">11</div>
					 </div>        
					 <div class="f12pdp9g t-12">
						<div class="f188ddnc">12</div>
					 </div>
					  
				</div>
				 
			   </div>
			</div>
      <!-- end -->
	  
		</div>
		
		<div class="modal-footer bg-dark">
			<div class="fd2skst" id="Select-time">Continue</div>
		</div>
	
    </div>

  </div>
</div>

	
 <div id="myModalTime" class="modal modal-md fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-header bg-dark">
			<div class="f1mqr89k">
				 <img class="close back-to-hours" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" alt="" style="position: absolute; left: 10px;">
				 <div class="fh6ecoi" style="color:#fff;">Select Minute</div>
			  </div>
		</div>
	
		<div class="modal-body padd">
		<!-- Select-hour -->
      
		<div class="timer-sample-container">
			<div style="border-radius: 5px; background: rgb(255, 255, 255); width: 100%; padding: 10px;">
		
			<div class="f1mdleym">
				<div class="exact-hour">00</div>
				 :
				 <div class="exact-minutes">00</div>
				 <div class="am-pm">AM</div>
			</div>
			<!--<div class="f1k6gupq">
				 <div class="f1u2s0am t-AM">AM</div>
				<div class="f1u2s0am t-PM">PM</div>  
			</div>-->
			<hr>
	  
	  
		   </div>
		</div>
      <!-- end -->
	  
      <!-- Select-time -->
		<div class="" id="" >
		   <div style="border-radius: 5px; background: rgb(255, 255, 255); width: 100%; padding: 10px;">
					
			  <div>
				 <div class="fk875py">
					<div class="f188ddncc t-00">00</div>
				 </div>
				 <div class="fk875py">
					<div class="f188ddncc t-15">15</div>
				 </div>
				 <div class="fk875py">
					<div class="f188ddncc t-30">30</div>
				 </div>
				 <div class="fk875py">
					<div class="f188ddncc t-45">45</div>
				 </div>
			  </div>
			  
		   </div>
		</div>
      <!-- end -->
    </div>
	
		<div class="modal-footer bg-dark">
			<div data-dismiss="modal" id="time-selected" class="fd2skst">Continue</div>
		</div>
    </div>
  </div>
</div>



<script>
$(document).ready(function(){
	var d = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>); 
	d.setHours( d.getHours() + 1 ); // offset from local time
	var hour = (d.getHours() % 12) || 12; // show midnight & noon as 12
	var minutes = (d.getMinutes() < 10 ? '00' : '00') ;
	var ampm =  d.getHours() < 12 ? 'AM' : 'PM';
	
	var hours = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>  ).getHours();	
	var ampmCheck = (hours >= 12) ? "PM" : "AM";
	
	// If time goes in PM make the PM button non-clickable
	if(ampmCheck == 'PM'){
		$(".t-PM ").addClass("non-clicked");
	}
	
	
	if(hour == '12' && minutes == "00" && ampm == 'AM'){
		
		var d1 = new Date( <?php echo date("Y, n - 1, d, H, i, s") ?>  ); 		
		var t_hour = d1.getHours();
		t_hour  = parseInt(t_hour);
		var t_minutes = d1.getMinutes();
		var t_ampm =  d1.getHours() < 12 ? 'AM' : 'PM';
		
		if(t_hour >12)
			t_hour = t_hour-12;
		
		$(".t-AM").removeClass("f6lrqsn");
		$(".t-AM").addClass("disabled");
		
		$(".t-PM").addClass("f6lrqsn");
			
			$(".t-00").removeClass("disabled");
			$(".t-15").removeClass("disabled");
			$(".t-30").removeClass("disabled");
			$(".t-45").removeClass("disabled");
		
			$("#exact_hour").val(t_hour);
			$("#exact_minutes").val(t_minutes);
			$("#exact_ampm").val("PM");
			
			var timeTXT = t_hour+":"+t_minutes+" PM";
			$("#hours_minutes").empty();
			$("#hours_minutes").append(timeTXT);
			
			$(".exact-hour").text(t_hour);
			$(".exact-minutes").text(t_minutes);
			$(".am-pm").text("PM");
			
			
			var selectedHour = $("#exact_hour").val();
			var selectedMins = $("#exact_minutes").val();
			var selectedAMPM = $("#exact_ampm").val();
			$(".t-"+selectedHour).addClass("f12pdp9g-active");   
			$(".t-"+selectedMins).addClass("fd3g1lt"); 
			$(".t-"+selectedAMPM).addClass("f6lrqsn");
			
			for (i = 1; i <= 10; i++) {
				$(".t-"+i).addClass("disabled-btn"); 
				$(".t-"+i+" > .f188ddnc").addClass("disabled"); 
			}
			$(".t-12").addClass("disabled-btn"); 
			$(".t-12 > .f188ddnc").addClass("disabled"); 
		
		
				var minutesCheck = d.getMinutes();
				minutesCheck = parseInt(minutesCheck);
					
				if(minutesCheck >= '30'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					$(".t-30").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
					$(".t-30").removeClass("fd3g1lt");
			
					
					$(".t-45").addClass("fd3g1lt");
					$(".exact-minutes").text("45");
					$("#exact_minutes").val("45");
					
					var timeTXT = selectedHour+":45 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				
				} else if(minutesCheck >= '15'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
			
					
					$(".t-30").addClass("fd3g1lt");
					$(".exact-minutes").text("30");
					$("#exact_minutes").val("30");
					
					var timeTXT = selectedHour+":30 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				} else {
					$(".t-00").addClass("disabled");
					$(".t-00").removeClass("fd3g1lt");
					
					
					$(".t-15").addClass("fd3g1lt");
					$(".exact-minutes").text("15");
					$("#exact_minutes").val("15");
					
					var timeTXT = selectedHour+":15 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
				}
		
	} else {
	
		$("#exact_hour").val(hour);
		$("#exact_minutes").val(minutes);
		$("#exact_ampm").val(ampm);
		
		var timeTXT = hour+":"+minutes+" "+ampm;
		$("#hours_minutes").empty();
		$("#hours_minutes").append(timeTXT);
		
		
		$(".exact-hour").text(hour);
		$(".exact-minutes").text(minutes);
		$(".am-pm").text(ampm);
		
		
		$(".t-"+hour).addClass("f12pdp9g-active");   
		$(".t-"+minutes).addClass("fd3g1lt");   
		$(".t-"+ampm).addClass("f6lrqsn"); 
		
		if(ampm == 'PM' && ampmCheck== 'PM'){
			$(".t-AM").addClass("disabled");
		} 
		
		if(hour == 12 && ampm == 'PM'){
			$(".t-12").removeClass("disabled-btn"); 
			$(".t-12 > .f188ddnc").removeClass("disabled"); 
		} else {
			$(".t-12").addClass("disabled-btn"); 
			$(".t-12 > .f188ddnc").addClass("disabled"); 
		}
		
		// disable minutes tabs according to current time
			if(hour == 12)
				hour = 0;
			
			var hourLimit = hour;
			hourLimit = parseInt(hourLimit);
		
			var minutesCheck = d.getMinutes();
			minutesCheck = parseInt(minutesCheck);
			
			if(minutesCheck >= '45'){
				hourLimit = hour;
			} else { 
				hour = parseInt(hour);
				hourLimit = hour-1;
				
				if(hourLimit == 0){  // case for the 1PM
					$(".t-12 ").removeClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").removeClass("disabled");
				}
			}
		// disable minutes tabs according to current time
			
		
		
		for (i = 1; i < hourLimit; i++) {
			$(".t-"+i).addClass("disabled-btn"); 
			$(".t-"+i+" > .f188ddnc").addClass("disabled"); 
		}
		
	}	
});
</script>

<script>
$(document.body).on('click', '.custom-option' ,function(){
	var day = $(this).data("value");
	
	if(day == 'today' || day == 'tomorrow'){
	
			$(".f12pdp9g").removeClass("f12pdp9g-active");
			$(".f188ddnc").removeClass("fd3g1lt");
			$(".f188ddncc").removeClass("fd3g1lt");
			$(".f1u2s0am ").removeClass("f6lrqsn");
			
	
	
		var d = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>   ); 
		d.setHours( d.getHours() + 1 ); // offset from local time
		var hour = (d.getHours() % 12) || 12; // show midnight & noon as 12
		var minutes = (d.getMinutes() < 10 ? '00' : '00') ;
		var ampm =  d.getHours() < 12 ? 'AM' : 'PM';
		
		$("#exact_hour").val(hour);
		$("#exact_minutes").val(minutes);
		$("#exact_ampm").val(ampm);
		
		var timeTXT = hour+":"+minutes+" "+ampm;
		$("#hours_minutes").empty();
		$("#hours_minutes").append(timeTXT);
		
		
		$(".exact-hour").text(hour);
		$(".exact-minutes").text(minutes);
		$(".am-pm").text(ampm);
		
		
		if(day == 'today'){	
		
			if(hour == '12' && minutes == "00" && ampm == 'AM'){
		
				var d1 = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>   ); 		
				var t_hour = d1.getHours();
				t_hour  = parseInt(t_hour);
				var t_minutes = d1.getMinutes();
				var t_ampm =  d1.getHours() < 12 ? 'AM' : 'PM';
				
				if(t_hour >12)
					t_hour = t_hour-12;
				
				$(".t-AM").removeClass("f6lrqsn");
				$(".t-AM").addClass("disabled");
				
				$(".t-PM").addClass("f6lrqsn");
			
				$(".t-00").removeClass("disabled");
				$(".t-15").removeClass("disabled");
				$(".t-30").removeClass("disabled");
				$(".t-45").removeClass("disabled");
			
				$("#exact_hour").val(t_hour);
				$("#exact_minutes").val(t_minutes);
				$("#exact_ampm").val("PM");
				
				var timeTXT = t_hour+":"+t_minutes+" PM";
				$("#hours_minutes").empty();
				$("#hours_minutes").append(timeTXT);
				
				$(".exact-hour").text(t_hour);
				$(".exact-minutes").text(t_minutes);
				$(".am-pm").text("PM");
				
				
				var selectedHour = $("#exact_hour").val();
				var selectedMins = $("#exact_minutes").val();
				var selectedAMPM = $("#exact_ampm").val();
				$(".t-"+selectedHour).addClass("f12pdp9g-active");   
				$(".t-"+selectedMins).addClass("fd3g1lt"); 
				$(".t-"+selectedAMPM).addClass("f6lrqsn");
				
				for (i = 1; i <= 10; i++) {
					$(".t-"+i).addClass("disabled-btn"); 
					$(".t-"+i+" > .f188ddnc").addClass("disabled"); 
				}
				$(".t-12").addClass("disabled-btn"); 
				$(".t-12 > .f188ddnc").addClass("disabled"); 
			
		
				var minutesCheck = d.getMinutes();
				minutesCheck = parseInt(minutesCheck);
					
				if(minutesCheck >= '30'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					$(".t-30").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
					$(".t-30").removeClass("fd3g1lt");
			
					
					$(".t-45").addClass("fd3g1lt");
					$(".exact-minutes").text("45");
					$("#exact_minutes").val("45");
					
					var timeTXT = selectedHour+":45 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				
				} else if(minutesCheck >= '15'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
			
					
					$(".t-30").addClass("fd3g1lt");
					$(".exact-minutes").text("30");
					$("#exact_minutes").val("30");
					
					var timeTXT = selectedHour+":30 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				} else {
					$(".t-00").addClass("disabled");
					$(".t-00").removeClass("fd3g1lt");
					
					
					$(".t-15").addClass("fd3g1lt");
					$(".exact-minutes").text("15");
					$("#exact_minutes").val("15");
					
					var timeTXT = selectedHour+":15 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
				}
		
			} else {
		
			
				$(".f12pdp9g").removeClass("f12pdp9g-active");
				$(".f188ddnc").removeClass("fd3g1lt");
				$(".f188ddncc").removeClass("fd3g1lt");
				$(".f1u2s0am ").removeClass("f6lrqsn");
				
				$(".t-"+hour).addClass("f12pdp9g-active");   
				$(".t-"+minutes).addClass("fd3g1lt");   
				$(".t-"+ampm).addClass("f6lrqsn"); 
			
				var hourLimit = hour;
				hourLimit = parseInt(hourLimit);
					
				/*  if(ampm == 'PM'){
					
					$(".t-AM").addClass("disabled"); 
					$(".t-12 ").addClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").addClass("disabled"); 
					
				} else {
					$(".t-12").addClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").addClass("disabled"); 			
				}  */
				
				var hours = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>  ).getHours();
				var ampmCheck = (hours >= 12) ? "PM" : "AM";
				if(ampm == 'PM' && ampmCheck== 'PM'){
					$(".t-AM").addClass("disabled");
				} 
				
				if(hours == 12 && ampm == 'PM'){
					$(".t-12").removeClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").removeClass("disabled"); 
				} else {
					$(".t-12").addClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").addClass("disabled"); 
				}
				
				// disable minutes tabs according to current time
					var minutesCheck = d.getMinutes();
					minutesCheck = parseInt(minutesCheck);
					
					if(minutesCheck >= '45'){
						hourLimit = hour;
					} else {
						hour = parseInt(hour);
						hourLimit = hour-1;
						
					}		
				// disable minutes tabs according to current time
				
				for (i = 1; i < hourLimit; i++) {
					$(".t-"+i).addClass("disabled-btn"); 
					$(".t-"+i+" > .f188ddnc").addClass("disabled"); 
				}
			
			}
		} else if(day == 'tomorrow'){
			
			$(".f12pdp9g").removeClass("f12pdp9g-active");
			$(".f188ddnc").removeClass("fd3g1lt");
			$(".f188ddncc").removeClass("fd3g1lt");
			$(".f1u2s0am ").removeClass("f6lrqsn");
			
			
			$(".t-"+hour).addClass("f12pdp9g-active");   
			$(".t-"+minutes).addClass("fd3g1lt");   
			$(".t-"+ampm).addClass("f6lrqsn"); 
		
			
			$(".t-AM").removeClass("disabled"); 
			$(".t-12 ").removeClass("disabled-btn"); 
			$(".t-12 > .f188ddnc").removeClass("disabled");
			
			$(".t-00").removeClass("disabled");
			$(".t-15").removeClass("disabled");
			$(".t-30").removeClass("disabled");
			$(".t-45").removeClass("disabled");
			
			for (i = 1; i <= 12; i++) {
				$(".t-"+i).removeClass("disabled-btn"); 
				$(".t-"+i+" > .f188ddnc").removeClass("disabled"); 
			}	
		}
	}
	
});
</script>


<script>
$(document.body).on('click', '.f12pdp9g' ,function(){

	var day = $(".custom-options > .selection").data("value");
	if(typeof day === "undefined" ){
		day = 'today';
	}
		
	if(day == 'today'){	
	
		var selectedHour = $(this).children('.f188ddnc').text();
		var selectedHourCheck  = parseInt(selectedHour);	
		
		var d = new Date( <?php echo date("Y, n - 1, d, H, i, s") ?>  ); 		
		var hour = d.getHours();
		hour  = parseInt(hour);		
		var minutes = d.getMinutes();
		var ampm =  d.getHours() < 12 ? 'AM' : 'PM';
		
			
		if(ampm == 'PM' && selectedHourCheck !=12){
			selectedHourCheck = selectedHourCheck+12;
		}
			
		if(selectedHourCheck == hour){
			
			$(".t-00").removeClass("fd3g1lt");
			$(".t-15").removeClass("fd3g1lt");
			$(".t-30").removeClass("fd3g1lt");
			$(".t-45").removeClass("fd3g1lt");
			
			
			var hours = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>  ).getHours();
			var ampmCheck = (hours >= 12) ? "PM" : "AM";
			var timings = $(".f6lrqsn").text();
			
			if(ampmCheck == timings ){
				//alert(hours+' '+ampmCheck)
			
				// disable minutes tabs according to current time
				var minutesCheck = d.getMinutes();
				minutesCheck = parseInt(minutesCheck);
					
				if(minutesCheck >= '30'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					$(".t-30").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
					$(".t-30").removeClass("fd3g1lt");
			
					
					$(".t-45").addClass("fd3g1lt");
					$(".exact-minutes").text("45");
					$("#exact_minutes").val("45");
					
					var timeTXT = selectedHour+":45 "+ampm;
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				
				} else if(minutesCheck >= '15'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
			
					
					$(".t-30").addClass("fd3g1lt");
					$(".exact-minutes").text("30");
					$("#exact_minutes").val("30");
					
					var timeTXT = selectedHour+":30 "+ampm;
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				} else {
					$(".t-00").addClass("disabled");
					$(".t-00").removeClass("fd3g1lt");
					
					
					$(".t-15").addClass("fd3g1lt");
					$(".exact-minutes").text("15");
					$("#exact_minutes").val("15");
					
					var timeTXT = selectedHour+":15 "+ampm;
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
				}
			
			}
			
			// disable minutes tabs according to current time
				
		} else {
			$(".t-00").removeClass("disabled");
			$(".t-15").removeClass("disabled");
			$(".t-30").removeClass("disabled");
			$(".t-45").removeClass("disabled");
		}
		
		$(".f12pdp9g").removeClass("f12pdp9g-active");
		$(".f188ddnc").removeClass("fd3g1lt");
		
		$(this).addClass("f12pdp9g-active");  
		
	} else if(day == 'tomorrow'){
		
		$(".f12pdp9g").removeClass("f12pdp9g-active");
		$(".f188ddnc").removeClass("fd3g1lt");
		
		$(".t-"+hour).addClass("f12pdp9g-active");   
		$(".t-"+minutes).addClass("fd3g1lt");   
		$(".t-"+ampm).addClass("f6lrqsn"); 
	
		$(this).addClass("f12pdp9g-active");  
	
	}	
});
</script>

<script>
$(document.body).on('click', '.f1u2s0am' ,function(){

	var day = $(".custom-options > .selection").data("value");
	if(typeof day === "undefined" ){
		day = 'today';
	}
	
	var timings = $(this).text();
	
	$(".f12pdp9g").removeClass("f12pdp9g-active");
	$(".f188ddnc").removeClass("fd3g1lt");
	$(".f188ddncc").removeClass("fd3g1lt");
		 
	if(day == 'today'){	
		
		var d = new Date( <?php echo date("Y, n - 1, d, H, i, s") ?>  ); 		
		var hour = d.getHours();
		hour  = parseInt(hour);
		var minutes = d.getMinutes();
		var ampm =  d.getHours() < 12 ? 'AM' : 'PM';
		
		var dd = new Date( <?php echo date("Y, n - 1, d, H, i, s") ?>  ); 
		dd.setHours( dd.getHours() + 1 ); // offset from local time
		var t_hour = (dd.getHours() % 12) || 12; // show midnight & noon as 12
		var t_minutes = (dd.getMinutes() < 10 ? '00' : '00') ;
		var t_ampm =  dd.getHours() < 12 ? 'AM' : 'PM';
	
		
		if(ampm == 'AM'  && timings == 'PM'){
			
			// alert('am - pm differ')
			
			$(".t-AM ").removeClass("f6lrqsn");
			$(".t-PM ").addClass("f6lrqsn");
			
			$(".t-00").removeClass("disabled");
			$(".t-15").removeClass("disabled");
			$(".t-30").removeClass("disabled");
			$(".t-45").removeClass("disabled");
		
			$("#exact_hour").val(t_hour);
			$("#exact_minutes").val(t_minutes);
			$("#exact_ampm").val("PM");
			
			var timeTXT = t_hour+":"+t_minutes+" PM";
			$("#hours_minutes").empty();
			$("#hours_minutes").append(timeTXT);
			
			$(".exact-hour").text(t_hour);
			$(".exact-minutes").text(t_minutes);
			$(".am-pm").text("PM");
			
			//$(".t-"+t_hour).addClass("f12pdp9g-active");   
			//$(".t-"+t_minutes).addClass("fd3g1lt");   
			
			
			var selectedHour = $("#exact_hour").val();
			var selectedMins = $("#exact_minutes").val();
			$(".t-"+selectedHour).addClass("f12pdp9g-active");   
			$(".t-"+selectedMins).addClass("fd3g1lt"); 
			
			for (i = 1; i <= 12; i++) {
				$(".t-"+i).removeClass("disabled-btn"); 
				$(".t-"+i+" > .f188ddnc").removeClass("disabled"); 
			}
			
			
		} else if(ampm == 'PM'  && timings == 'PM'){
			
			//alert('1')
			
			var d1 = new Date(<?php echo date("Y, n - 1, d, H, i, s") ?>   ); 		
			var t_hour = d1.getHours();
			t_hour  = parseInt(t_hour);
			var t_minutes = d1.getMinutes();
			var t_ampm =  d1.getHours() < 12 ? 'AM' : 'PM';
			
			//alert(t_hour+' : '+t_minutes+'  '+t_ampm);
			
			if(t_hour >12)
				t_hour = t_hour-12;
			
			$(".t-AM").removeClass("f6lrqsn");
			$(".t-AM").addClass("disabled");
			
			$(".t-PM").addClass("f6lrqsn");
				
			$(".t-00").removeClass("disabled");
			$(".t-15").removeClass("disabled");
			$(".t-30").removeClass("disabled");
			$(".t-45").removeClass("disabled");
		
			$("#exact_hour").val(t_hour);
			$("#exact_minutes").val(t_minutes);
			$("#exact_ampm").val("PM");
			// alert('pm')
			
			var timeTXT = t_hour+":"+t_minutes+" PM";
			$("#hours_minutes").empty();
			$("#hours_minutes").append(timeTXT);
			
			$(".exact-hour").text(t_hour);
			$(".exact-minutes").text(t_minutes);
			$(".am-pm").text("PM");
			
		
			var selectedHour = $("#exact_hour").val();
			var selectedMins = $("#exact_minutes").val();
			var selectedAMPM = $("#exact_ampm").val();
			$(".t-"+selectedHour).addClass("f12pdp9g-active");   
		//	$(".t-"+selectedMins+" > .f188ddnc").addClass("fd3g1lt"); 
			$(".t-"+selectedAMPM).addClass("f6lrqsn");
			
			
			if(t_hour == '12' && t_ampm == 'PM'){
				
				var hourLimit = '0';
				var minutesCheck = parseInt(t_minutes);
				
				if(minutesCheck < '45'){
					selectedHour = parseInt('12');
					$(".t-12 ").removeClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").removeClass("disabled");
				} else {
					selectedHour = parseInt('1');
					$(".t-1").addClass("f12pdp9g-active"); 
					$(".t-12").removeClass("f12pdp9g-active"); 
					
					$(".t-12 ").addClass("disabled-btn"); 
					$(".t-12 > .addClass").removeClass("disabled");
				}
				
				//$(".t-"+hour).addClass("f12pdp9g-active"); 

					$(".exact-minutes").text("00");
					$("#exact_minutes").val("00");
					
					var timeTXT = selectedHour+":00 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);				
				
			} else {
				//alert(t_hour)
				// disable hours tabs according to current time
					var hourLimit = t_hour;
					hourLimit = parseInt(hourLimit);
				
					var minutesCheck = parseInt(t_minutes);
					
					if(minutesCheck >= '45'){
						hourLimit = t_hour;
					} else { 
						t_hour = parseInt(t_hour);
						hourLimit = t_hour+1;
						
						if(hourLimit == 0){  // case for the 1PM
							$(".t-12 ").removeClass("disabled-btn"); 
							$(".t-12 > .f188ddnc").removeClass("disabled");
						}
					}
				
					for (i = 1; i < hourLimit; i++) {
						$(".t-"+i).addClass("disabled-btn"); 
						$(".t-"+i+" > .f188ddnc").addClass("disabled"); 
					}
				// disable hours tabs according to current time
				
			}
			
				var minutesCheck = d.getMinutes();
				minutesCheck = parseInt(minutesCheck);
					
				if(minutesCheck >= '30'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					$(".t-30").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
					$(".t-30").removeClass("fd3g1lt");
			
					
					$(".t-45").addClass("fd3g1lt");
					$(".exact-minutes").text("45");
					$("#exact_minutes").val("45");
					
					var timeTXT = selectedHour+":45 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				
				} else if(minutesCheck >= '15'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
			
					
					$(".t-30").addClass("fd3g1lt");
					$(".exact-minutes").text("30");
					$("#exact_minutes").val("30");
					
					var timeTXT = selectedHour+":30 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				} else {
					$(".t-00").addClass("disabled");
					$(".t-00").removeClass("fd3g1lt");
					
					
					$(".t-15").addClass("fd3g1lt");
					$(".exact-minutes").text("15");
					$("#exact_minutes").val("15");
					
					var timeTXT = selectedHour+":15 "+"PM";
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
				}
			
		
			
		} else {
			
			$(".t-PM ").removeClass("f6lrqsn");
			$(".t-AM ").addClass("f6lrqsn");
			
			var inputHrs = t_hour;
			var inputMins = t_minutes;
			
			//alert(hour)
			//alert(t_hour)
			if(t_hour == 12){
				
				$("#exact_hour").val(hour);
				$("#exact_minutes").val(inputMins);
				$("#exact_ampm").val("AM");
				
				var timeTXT = hour+":"+inputMins+" AM";
				$("#hours_minutes").empty();
				$("#hours_minutes").append(timeTXT);
				
				$(".exact-hour").text(hour);
				$(".exact-minutes").text(inputMins);
				$(".am-pm").text("AM");
				
				var selectedHour = $("#exact_hour").val();
				var selectedMins = $("#exact_minutes").val();
				$(".t-"+selectedHour).addClass("f12pdp9g-active");   
				$(".t-"+selectedMins).addClass("fd3g1lt"); 
				
				
				if(ampm == 'PM'){
					$(".t-AM").addClass("disabled"); 
					$(".t-12 ").addClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").addClass("disabled");
				} else {
					$(".t-12").addClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").addClass("disabled"); 
				}
				// disable hours tabs according to current time
					var hourLimit = inputHrs;
					hourLimit = parseInt(hourLimit);
				
					var minutesCheck = d.getMinutes();
					minutesCheck = parseInt(minutesCheck);
					
					if(minutesCheck >= '45'){
						hourLimit = inputHrs;
					} else { 
						inputHrs = parseInt(inputHrs);
						hourLimit = inputHrs-1;
						
						if(hourLimit == 0){  // case for the 1PM
							$(".t-12 ").removeClass("disabled-btn"); 
							$(".t-12 > .f188ddnc").removeClass("disabled");
						}
					}
				
					for (i = 1; i < hourLimit; i++) {
						$(".t-"+i).addClass("disabled-btn"); 
						$(".t-"+i+" > .f188ddnc").addClass("disabled"); 
					}
				// disable hours tabs according to current time
				
				
				// disable minutes tabs according to current time
				var minutesCheck = d.getMinutes();
				minutesCheck = parseInt(minutesCheck);
					
				if(minutesCheck >= '30'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					$(".t-30").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
					$(".t-30").removeClass("fd3g1lt");
			
					
					$(".t-45").addClass("fd3g1lt");
					$(".exact-minutes").text("45");
					$("#exact_minutes").val("45");
					
					var timeTXT = selectedHour+":45 "+ampm;
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				
				} else if(minutesCheck >= '15'){
					$(".t-00").addClass("disabled");
					$(".t-15").addClass("disabled");
					
					$(".t-00").removeClass("fd3g1lt");
					$(".t-15").removeClass("fd3g1lt");
			
					
					$(".t-30").addClass("fd3g1lt");
					$(".exact-minutes").text("30");
					$("#exact_minutes").val("30");
					
					var timeTXT = selectedHour+":30 "+ampm;
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
					
				} else {
					$(".t-00").addClass("disabled");
					$(".t-00").removeClass("fd3g1lt");
					
					
					$(".t-15").addClass("fd3g1lt");
					$(".exact-minutes").text("15");
					$("#exact_minutes").val("15");
					
					var timeTXT = selectedHour+":15 "+ampm;
					$("#hours_minutes").empty();
					$("#hours_minutes").append(timeTXT);
				}
				
			} else {
			
				// If timings goes in PM but we can select AM also like in case 12PM
				$("#exact_hour").val(inputHrs);
				$("#exact_minutes").val(inputMins);
				$("#exact_ampm").val("AM");
				
				var timeTXT = inputHrs+":"+inputMins+" AM";
				$("#hours_minutes").empty();
				$("#hours_minutes").append(timeTXT);
				
				$(".exact-hour").text(inputHrs);
				$(".exact-minutes").text(inputMins);
				$(".am-pm").text("AM");
				
				var selectedHour = $("#exact_hour").val();
				var selectedMins = $("#exact_minutes").val();
				$(".t-"+selectedHour).addClass("f12pdp9g-active");   
				$(".t-"+selectedMins).addClass("fd3g1lt"); 
				
				
				if(ampm == 'PM'){
					$(".t-AM").addClass("disabled"); 
					$(".t-12 ").addClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").addClass("disabled");
				} else {
					$(".t-12").addClass("disabled-btn"); 
					$(".t-12 > .f188ddnc").addClass("disabled"); 
				}
				
				// disable minutes tabs according to current time
					var hourLimit = inputHrs;
					hourLimit = parseInt(hourLimit);
				
					var minutesCheck = d.getMinutes();
					minutesCheck = parseInt(minutesCheck);
					
					if(minutesCheck >= '45'){
						hourLimit = inputHrs;
					} else { 
						inputHrs = parseInt(inputHrs);
						hourLimit = inputHrs-1;
						
						if(hourLimit == 0){  // case for the 1PM
							$(".t-12 ").removeClass("disabled-btn"); 
							$(".t-12 > .f188ddnc").removeClass("disabled");
						}
					}
				// disable minutes tabs according to current time
				
				for (i = 1; i < hourLimit; i++) {
					$(".t-"+i).addClass("disabled-btn"); 
					$(".t-"+i+" > .f188ddnc").addClass("disabled"); 
				}
			
			}
		}
		
	} else if(day == 'tomorrow'){
		
		$(".f12pdp9g").removeClass("f12pdp9g-active");
		$(".f188ddnc").removeClass("fd3g1lt");
		$(".f188ddncc").removeClass("fd3g1lt");
		$(".f1u2s0am ").removeClass("f6lrqsn");
		
		
		$(".t-"+hour).addClass("f12pdp9g-active");   
		$(".t-"+minutes).addClass("fd3g1lt");   
		$(".t-"+ampm).addClass("f6lrqsn"); 
	
		
		$(".t-AM").removeClass("disabled"); 
		$(".t-12 ").removeClass("disabled-btn"); 
		$(".t-12 > .f188ddnc").removeClass("disabled");
		
		$(".t-00").removeClass("disabled");
		$(".t-15").removeClass("disabled");
		$(".t-30").removeClass("disabled");
		$(".t-45").removeClass("disabled");
		
		if(timings == 'PM'){
			$(".t-AM ").removeClass("f6lrqsn");
			$(".t-PM ").addClass("f6lrqsn");
		} else {
			$(".t-PM ").removeClass("f6lrqsn");
			$(".t-AM ").addClass("f6lrqsn");
		}
		
		for (i = 1; i <= 12; i++) {
			$(".t-"+i).removeClass("disabled-btn"); 
			$(".t-"+i+" > .f188ddnc").removeClass("disabled"); 
		}	
		
		var selectedHour = $("#exact_hour").val();
		var selectedMins = $("#exact_minutes").val();
		$(".t-"+selectedHour).addClass("f12pdp9g-active");   
		$(".t-"+selectedMins).addClass("fd3g1lt");   
		
	}
	
	
});
</script>
		
 <script>
	$(document.body).on('click', '#save_info' ,function(){
		var start_day = $("#start_day").val();
		var duration = $("#duration").val();
		var exact_hour = $("#exact_hour").val();
		var exact_minutes = $("#exact_minutes").val();
		var exact_ampm = $("#exact_ampm").val();
			var dataStr = "start_day="+start_day+"&duration="+duration+"&exact_hour="+exact_hour+"&exact_minutes="+exact_minutes+"&exact_ampm="+exact_ampm;
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('site/saveTournamentTimings') ?>",
				data: dataStr,
				success: function(data){				
					if(data == 'success'){
						var gameID = "<?php echo base64_encode($this->session->userdata('gameId')); ?>";
						window.location.href = "<?php echo site_url('createTournament/Step-3/') ?>"+gameID;
					}
				}
			});
		});
 </script>
 
 
</body>
</html>