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
  
</head>
<body>

	<section>
		<div class="f1lhk7ql"><a href="<?php echo site_url('createTournament/Step-1') ?>"><img class="f1iowekn" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14"></a>
		<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);">Create Tournament</div>
		</div>
		
		<div class="step-container header-padding" >
			 <h3 class="step2 theme-color">Final Step</h3>
		</div>
		<div class="step-container  custom-border-thin" >
		
			<img src="<?php echo base_url()."uploads/games/".$gameInfo['GameImage']; ?>" class="thumb-icon">
			<div class="thumb-icon-game-name">
				
				<span class="game-name text-white font15EM"><?php echo @$gameInfo['Name']; ?></span>
			</div>
			<div class="again-select"><a href="<?php echo site_url('createTournament/Step-1') ?>"><img src="https://cdn.zeplin.io/5b8799579d9d9032d00a89fc/assets/748A0DB5-EFD7-4EA5-B550-4D6F4227A2C7.svg"></a></div>
		</div>

		
		<?php 
		
		$startDay = $this->session->userdata('startDay');
		$startDate = $this->session->userdata('startDate');
		$exactHour = $this->session->userdata('exactHour');
		$exactMinutes = $this->session->userdata('exactMinutes');
		$exactAmpm = $this->session->userdata('exactAmpm');
		
		$endDay = $t_end_date;
		$endTime = $t_end_time;
		?>
		

		<div class="time-container custom-border-thin" style="align-items: flex-start !important;   min-height: 110px">
			<div class="ff3k5ad" style="margin-top: 10px;">
				<!-- <div class="foruth-time"> <?php echo ucfirst($startDay); ?> </div> -->
				<div class="foruth-time ">Starts On </div>
				<div class="foruth-now text-white"><?php echo date('j F', strtotime($startDate)); ?></div>
				
				<?php if (strtotime($startDate) != strtotime($t_end_date)){ ?>
				<div class="clock-time text-white">
					<i class="fas fa-clock text-white"></i> &nbsp; <?php echo $exactHour.':'.$exactMinutes.' '.$exactAmpm; ?> 
				</div>
				<?php } else { ?>  
					<div class="clock-time text-white">
						<i class="fas fa-clock text-white"></i> &nbsp; <?php echo $exactHour.':'.$exactMinutes.' '.$exactAmpm; ?>  <?php echo " - ".date('h:i A', strtotime($t_end_time)); ?> 
					</div>
				<?php  } ?>
				
				<?php if (strtotime($startDate) != strtotime($t_end_date)){ ?>
				<div style="position: absolute; right: 50px; bottom:23px !important; top: 10px !important;">
					<div class="foruth-time "> Ends On </div>
					<div class="foruth-now text-white"> <?php echo date('j F  ', strtotime($t_end_date)); ?>	</div>
					<div class="clock-time text-white">
						<i class="fas fa-clock text-white"></i> &nbsp; <?php echo date('h:i A', strtotime($t_end_time));  ?>
					</div>
				</div>
				<?php } ?>
			  
			</div>
         
          <div style="position: absolute; right: 10px;  bottom:10px !important;"><a href="<?php echo site_url('createTournament/Step-2/'.base64_encode($this->session->userdata('gameId'))) ?>"><img src="https://cdn.zeplin.io/5b8799579d9d9032d00a89fc/assets/748A0DB5-EFD7-4EA5-B550-4D6F4227A2C7.svg" alt=""></a></div>
        
		</div>
		


      <div class="select-time-container" style="margin-bottom: 80px">
        
         
            <span class="step2-desc theme-color">Set Tournament Entry Fees</span>

            <input type="hidden" name="players_count" id="players_count" value="20" />

            <div class="center">
				<div class="inline-block">
					<span style="color: rgb(199, 199, 199); font-size: 12px; text-transform: uppercase; font-weight: 700; padding: 8px 0px;     margin-top: 20px; display: block;"><img src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt="" style="height: 18px; margin-right: 5px;"> Entry Fee</span>
					<select name="entry_fee" id="entry_fee" class="custom-select sources" placeholder="100" style="width: 130px">
						<option value="100">100</option>
					</select>
				</div>
				
				<div class="inline-block" style="margin-left:30px;">
				  <span style="color: rgb(199, 199, 199); font-size: 12px; text-transform: uppercase; font-weight: 700; padding: 8px 0px;     margin-top: 20px; display: block;"><img src="https://static.gamezop.com/peach/assets/img/faceless-player.svg" style="height: 18px; margin-right: 10px;"> Players</span>
				  <button class="open-timer" id="players_txt" data-toggle="modal" data-target="#myModal">20</button>
				 </div>  
              
            </div>

			<div class="takes-all">
			  <input type="radio" id="takes-all" class="prize_type theme-color" name="prize_type" value="1" checked />
			  <label class="text-white" for="takes-all" style="padding-left: 6px;"> Winner takes all</label><br>
			 
			</div>
			<div class="price-devide">
			  <input type="radio" id="top-three" class="prize_type" name="prize_type" value="2" />
			  <label class="text-white" for="top-three" style="padding-left: 6px;">Distribute prize among top 3</label><br>
			</div>
			<div id="distribution_div" style="display:none;">
			  <div class="f1d4a11x" style=" height: 40px;"><div class="f1mi6qxz text-white">Rank 1</div><div class="f181luy4" style="right: 15px; width: 50px;"><img class=" fw2jcnz " src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt=""><span class="text-white">50</span></div></div>
			  <div class="f1pd6hn7" style=" height: 40px;"><div class="f1mi6qxz text-white">Rank 2</div><div class="f181luy4" style="right: 15px; width: 50px;"><img class=" fw2jcnz" src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt=""><span class="text-white">33</span></div></div>
			  <div class="fqyuqxd" style=" height: 40px;"><div class="f1mi6qxz text-white">Rank 3</div><div class="f181luy4" style="right: 15px; width: 50px;"><img class=" fw2jcnz" src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt=""><span class="text-white">17</span></div></div>

			</div>
			<!-- <div class="takes-all-text">Entry fee will be refunded if no one joins this tournament.</div> -->

      </div>

    <!--  <div class="bottom-fixed-btn"><button type="button" id="save_info" class="btn btn-bottom btn-active">CREATE FOR <img src="<?php echo base_url() ?>assets/frontend/img/coin.png" alt="" style=" max-width: 24px; margin: 0px 2px 0px 8px;"> 100</button></div> -->
      <div class="bottom-fixed-btn"><button type="button" id="save_info" class="btn btn-bottom btn-active">Create Tournament</button></div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	
		<div class="modal-header bg-dark">
			<div class="f1mqr89k">
				 <img class="close"  data-dismiss="modal" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" alt="" style=" position: absolute; left: 10px;">
				 <div class="fh6ecoi" style="color:#fff;">Number of Players</div>
			  </div>
		</div>
		
	
	
      <div class="modal-body padd">
      
			<div class="timer-sample-container"> <br>
			   <div style="border-radius: 5px; background: rgb(255, 255, 255); width: 100%; padding: 10px;">
				 
				  
				  <output id="num" class="fqp4va8">20</output>
				  <div class="f1dzlhs6">Players</div>
				 <!-- <input class="range" type="range" value="0" max="10" oninput="num.value = this.value"> -->
					<input  type="range" min="0" max="50" class="range" oninput="num.value = this.value">
				  <div style="width: 100%; display: flex; font-size: 1.4em; font-weight: 600; padding: 10px 0px;"><span class="f15o6vtm">2</span><span class="f15o6vtm">10</span><span class="f15o6vtm">20</span><span class="f15o6vtm">30</span><span class="f15o6vtm">40</span><span class="f15o6vtm">50</span></div>
				 
				 
			   </div>
			   <br>
			</div>
		 
      
		</div>
		
		
		<div class="modal-footer bg-dark">
			<div class="fd2skst" id="save_player">Next</div>
		</div>
		
    </div>

  </div>
</div>
</section>

<!-- Scripts -->

<script>
	  $(document).ready(function(){
		  <?php if($this->session->flashdata('success')){ ?>
			$('#successSubscriptionModal').modal('show');
		  <?php } ?>
	  })
  </script>

<div class="modal fade" id="successSubscriptionModal" role="dialog">
    <div class="modal-dialog box-center">
      <div class="modal-content modal-bg  modal-bg-success" align="center">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>   -->
        <div class="modal-body">
         <!--  <i class="fa fa-check-circle text-success" style="font-size:32px; "></i>  -->
          <img src="<?php echo base_url('assets/frontend/img/happy-face.png') ?>" />
          <br>
		  <h4 class="text-white"> <b>Success! </b></h4>
          <p class="text-white"><?php echo $this->session->flashdata('success'); ?></p>
		  <br><br>
		  <button type="button" class="btn modal-btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<script>
	  $(document).ready(function(){
		  <?php if($this->session->flashdata('error')){ ?>
			$('#errorSubscriptionModal').modal('show');
		  <?php } ?>
	  })
  </script>

<div class="modal fade" id="errorSubscriptionModal" role="dialog">
    <div class="modal-dialog box-center">
      <div class="modal-content modal-bg modal-bg-error" align="center">
      
        <div class="modal-body">
           <img src="<?php echo base_url('assets/frontend/img/sad-face.png') ?>" />
          <br>
		  <h4 class="text-white"> <b> OOPS ! </b></h4>
          <h4 class="text-white"><?php echo @$this->session->flashdata('error') ?></h4>
		   <br><br>
		  <button type="button" class="btn modal-btn-dark" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<script>
$(document.body).on('click', '#save_player' ,function(){   
    $(".btn-bottom").addClass("btn-active"); 
	var num = $("#num").val();
	num = parseInt(num);
	$("#players_txt").empty();
    $("#players_txt").append(num);
    $("#players_count").val(num);
	
	$("#myModal").modal('hide');
	
});
</script>


<script>
$(document.body).on('change', '.prize_type' ,function(){   
    var type = $(this).val();
	if(type=='1'){
		$("#distribution_div").hide('slow');
	} else {
		$("#distribution_div").show('slow');
	}
});
</script>
		
<script>
	$(document.body).on('click', '#save_info' ,function(){
		var players_count = $("#players_count").val();
		var entry_fee = $("#entry_fee").val();
		var prize_type = $(".prize_type:checked").val();
		
		var dataStr = "players_count="+players_count+"&entry_fee="+entry_fee+"&prize_type="+prize_type;
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('site/saveTournamentDetails') ?>",
			data: dataStr,
			success: function(data){
				if(data != '0'){
					window.location.href = data;
				}
			}
		});
	});
</script>
 
</body>
</html>