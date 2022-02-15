<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Notifications </title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, user-scalable=0">


	<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontend/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>assets/frontend/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/frontend/js/bootstrap.min.js"></script>
	
	<!-- For fontawesome icons -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/css/all.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/css/brand.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/css/solid.css" rel="stylesheet">
	<script defer src="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/js/all.js"></script>
	<script defer src="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/js/brand.js"></script>
	<script defer src="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/js/solid.js"></script>
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/style_theme_2.css">
	
	<style>
		
		p {
			margin: 0 0 3px !important;
		}
		
		
		.bg-row{
			padding:2px 0 2px 0 !important; 
			color:#666;	
			background: #efefef;
			
		  border-left : 4px solid #3fd53f;
		box-shadow: 0 1px 3px 0px rgba(255, 255, 255, 0.2);

		}
		
		.notify_desc{
			color:#2b2b2b !important; 
		}

		.notify_date, .delete{
			color:#888 !important; 
		}
		

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
<body >

<div id="load"></div>
	<section>
		<div class="f1lhk7ql">
			<a href="<?php echo site_url('') ?>"><img class="f1iowekn" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14"></a>
			<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);">Notifications</div>
		</div>
		
		<div class="container" style="width:98%;">
			<div class="" style="margin-bottom: 80px">
				<div class="col-xs-12 padd auto-margin games_area"> 
					
				</div>
			</div>
			
			
				
			<?php if(is_array($list) && count($list)>0 ){ ?>
			
			<div class="row" style="margin-bottom: 30px">
				<div class="col-xs-12 padd auto-margin games_area text-right"> 
			<a href="<?php echo site_url('site/clearNotifications') ?>" class="text-white text-bold">CLEAR ALL</a> &nbsp;
				</div>
			</div>
			
				<!-- <div class="row text-left "> <h5 class="text-bold">&nbsp;&nbsp; Tournaments History</h5> </div>  -->
					<?php foreach($list as $tRow ){ ?>
				
				
						<div class="row bg-row module" style="padding-top:10px !important;">
					
							<div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center ">
								<?php  if($tRow['notify_type'] == '1'){  ?>
									<br><img src="<?php echo base_url('assets/frontend/img/notify-tournament.png') ?>"  style="width:125%;"/>
								<?php } else  if($tRow['notify_type'] == '2'){  ?>
									<br><img src="<?php echo base_url('assets/frontend/img/notify-spin.png') ?>"  style="width:125%;"/>
								<?php } else  if($tRow['notify_type'] == '3'){  ?>
									<br><img src="<?php echo base_url('assets/frontend/img/notify-redeem.png') ?>"  style="width:125%;"/>
								<?php } else  if($tRow['notify_type'] == '4'){  ?>
									<br><img src="<?php echo base_url('assets/frontend/img/notify-tournament-reward.png') ?>"  style="width:125%;"/>
								<?php } else  if($tRow['notify_type'] == '5'){  ?>
									<br><img src="<?php echo base_url('assets/frontend/img/notify-profile.png') ?>"  style="width:125%;"/>
								<?php  }  ?>
							</div>
							
							<div class="col-10 col-xs-10 col-sm-10 col-md-10 col-lg-10 text-left">
								<div class="row">
									<div class="col-10 col-xs-10 col-sm-10 col-md-10 col-lg-10 text-left">
										<p class="text-bold"> <?php echo $tRow['notify_title']; ?></p>
									</div>
									<div class="col-2 col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
										<a href="<?php echo site_url('site/deleteNotification/'.base64_encode($tRow['notify_id'])) ?>" class="delete"><i class="fa fa-times"></i></a>
									</div>
								</div>
								
								<div class="row">
									<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left">
										<p class="notify_desc"><?php echo $tRow['notify_desc']; ?></p>
									</div>
								</div>
									
								<div class="row">
									<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left">
										<i>
										<?php  
											$today = date('Y-m-d');  
											$yesterday = date('Y-m-d',strtotime("-1 days"));
										?>
										<?php  if($today == $tRow['notify_date']){  ?>
											<p class="notify_date"> Today, <?php echo date('h:i A', $tRow['notify_added_on']); ?>  </p>
										<?php } else if($yesterday == $tRow['notify_date']){ ?>
											<p class="notify_date"> Yesterday, <?php echo date('h:i A', $tRow['notify_added_on']); ?>  </p>
										<?php } else { ?>
										
											<p class="notify_date"> <?php echo date('M j, h:i A', $tRow['notify_added_on']); ?>  </p>
										<?php }  ?>
										
										</i>
									</div>
								</div>
							</div>
						</div>
				
					<div class="row"> <br> </div>
				
				<?php } ?>
				<?php } else { ?>
					<div class="row"> <br><br> <br><br> <br><br> </div>
					
					<div class="row">
						<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center"> 
							<img src="<?php echo base_url('assets/frontend/img/no-notifications.png') ?>" width="50%"/><br>
							
							<h3 class="text-bold text-white" style="margin-top:10px !important;"> No Notification Yet!</h3>
							<br>
							<p class="text-white" > When you get notifications, they'll show up here.</p>
						</div>
					</div>
				
				<?php }  ?>
				
				<div class="row"> <br> <br> </div>
			
		   
		</div>
	</section>
	<?php include "page_session_timeout.php"; ?>
 
<script>
(function($) {

  $.fn.visible = function(partial) {
    
      var $t            = $(this),
          $w            = $(window),
          viewTop       = $w.scrollTop(),
          viewBottom    = viewTop + $w.height(),
          _top          = $t.offset().top,
          _bottom       = _top + $t.height(),
          compareTop    = partial === true ? _bottom : _top,
          compareBottom = partial === true ? _top : _bottom;
    
    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

  };
    
})(jQuery);

var win = $(window);

var allMods = $(".module");


allMods.each(function(i, el) {
  var el = $(el);
  if (el.visible(true)) {
     el.addClass("already-visible"); 
  } 
});

win.scroll(function(event) {
  
  allMods.each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      el.addClass("come-in"); 
    } 
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