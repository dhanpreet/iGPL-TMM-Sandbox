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

</head>
<body>

<div id="load"></div>


	<section>
		<div class="f1lhk7ql"><a href="<?php echo site_url('') ?>"><img class="f1iowekn" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14"></a>
		<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);">Create Tournament</div></div>
			<div class="step-container header-padding">
				<h3 class="heading theme-color">STEP 1</h3>
				<p class="theme-color">Select game to create tournament</p>
      
				<input type="text" name="txtBox" id="txtBox" placeholder="Search for games here" class="search form-control">
		</div>
      <div class="container">
        <div class="row" style="margin-bottom: 80px; max-width:98vw;">
			<div class="col-xs-12 padd auto-margin games_area"> 
				<?php if(is_array($gamesList) && count($gamesList)>0){ ?>
					<?php foreach($gamesList as $row){ ?>				  
						  <div class="col-xs-4 padd">
							<div class="thumb-container" data-attr-id="<?php echo base64_encode(@$row['gid']); ?>">
							  <!-- <img class="img-responsive" src="<?php echo @$row['GameImage']; ?>"> -->
							  <img class="img-responsive" src="<?php echo base_url()."uploads/games/".@$row['ImageName']; ?>">
							  <p class="game-name"><?php echo @$row['Name']; ?></p>
							</div>
						  </div>
					<?php } ?>
				<?php } ?>
			</div>
        </div>

        <a class="bottom-fixed-btn"><button type="button" id="choose_game" class="btn btn-bottom">NEXT</button></a>
      </div>
	</section>
	
	
<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>

		
 <script>
	$(document.body).on('click', '#choose_game' ,function(){
		var gameId = $('.thumb-container-active').attr('data-attr-id');
		//alert(gameId)
		if(gameId !='' && typeof gameId !== 'undefined')
			window.location.href = "<?php echo site_url('createTournament/Step-2/') ?>"+gameId;
	});

 </script>
 
 		
 <script>
	$(document).ready(function(){
		$("#loader").hide();
	});
</script>
<script>
	$(document).ready(function(){
		$("#txtBox").on('change, keyup', function(){			
			var txt = $(this).val();
			var dataStr = "txt="+txt;
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('site/searchGameByName') ?>",
				data: dataStr,
				success: function(data){									
					$(".games_area").empty();
					$(".games_area").append(data);					
				}
			});
		});
	});
 </script>
 
 <script>
	$(document).ajaxSend(function(){
		//console.log('ajax started');
		$("#loader").fadeIn(250);
	});
	$(document).ajaxComplete(function(){
		//console.log('ajax completed');
		$("#loader").fadeOut(250);
	});
 </script>
 
 		
 <script>
	$(document.body).on('click', '.thumb-container' ,function(){
		$(".thumb-container").removeClass("thumb-container-active");
		$(this).addClass("thumb-container-active");
		$(".btn-bottom").addClass("btn-active");
	});
 </script>
 
 
 

</body>
</html>