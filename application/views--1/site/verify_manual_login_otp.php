<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
    <meta name="theme-color" content="#000" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Gaming Social League</title>
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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/css/brands.css" rel="stylesheet">
	<script defer src="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/js/all.js"></script>
	<script defer src="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/js/brands.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/style.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
	
<!-- for google sign in -->
<meta name="google-signin-client_id" content="931603219860-h3bpksbdd0basc0gjmmjeqq48tr8e6oe.apps.googleusercontent.com">
<meta name="google-signin-scope" content="profile email">
 <script src="https://apis.google.com/js/platform.js" async defer></script> 
 
<!-- for google sign in ends-->
 
	
	<style type="text/css">

		.form-control{
			height:45px !important;
			background: rgba(1,1,1,0.5) !important;
			border:  none !important;
			border-top-right-radius: 20px !important;
			border-bottom-right-radius: 20px !important;
			color:#fff !important;
		}
		
		.input-group-addon{
			background: #2b2b2b !important;
			color: #fff !important;
			border:  none !important;
			border-top-left-radius: 20px !important;
			border-bottom-left-radius: 20px !important;
			padding: 12px 15px !important;
		}
		

		.text-box-position2{
		   background:rgba(255,255,255,0.3); 
		    padding-bottom: 10px !important;
		    padding:20px;
		    border-radius: 10px;
		    margin:0 0px;
		    display: inline-block;
			width: 90%;
		}
		
		.text-btn2 {
		    width: 50%;
		    padding: 10px 5px;
		    border-radius: 20px;
			color:#fff !important;
		    background: #392963 !important;
		    font-size: 15px;
		    font-weight: 600 !important;
			border:none !important;
		}
		.bottom-text{
		    font-size: 14px;
		    color: #fff;
		}

		.bottom-position{
		  /*position: absolute;
		  bottom: 0;
		      left: 50%;
		    transform: translate(-50%, 0px);
		    width: 100%;*/
		    margin-top: 15px;
		}

		div.relative > input, div.spacing > select {
		    padding-left: 72px !important;
		}
		h5.text-with-line {
		  overflow: hidden;
		  text-align: center;
		  color: #efefef;
		}

		h5.text-with-line:before,
		h5.text-with-line:after {
		  background-color: #efefef;
		  content: "";
		  display: inline-block;
		  height: 1px;
		  position: relative;
		  vertical-align: middle;
		  width: 20%;
		}

		h5.text-with-line:before {
		  right: 0.5em;
		  margin-left: -50%;
		}

		h5.text-with-line:after {
		  left: 0.5em;
		  margin-right: -50%;
		}



		.loginBtn {
			min-width:60%;
		    position: relative;

			padding: 5px 10px 5px 10px;
			border: none;
			text-align: left;
			line-height: 36px;
			white-space: nowrap;
			border-radius: 8px;
			font-size: 16px;
			font-weight:600;
			color: #FFF;
			box-shadow: 0 -1px 0 #354C8C;
		}
		@media only screen and (min-width: 600px) {
		  .loginBtn {
		    min-width:40%;
			text-align:center;
		  }
		  
		  .g-signin2 .abcRioButtonBlue{
				text-align: center !important;
				min-width:60% !important;
				margin:0 auto !important;
			}
		}

		/* Facebook */
		.loginBtn--facebook {
		  background-color: #3479ea;

		}

		/* Google */
		.loginBtn--google {
		  background: #de4a39;
		  color:#fff;
		}
		
		
		/*   For Google defined custome button */
		
		.g-signin2 .abcRioButtonBlue{
			text-align: center !important;
			min-width:40% !important;
			margin:0 auto !important;
		}
		
		.abcRioButton, .abcRioButtonBlue{
			height: 48px !important;
			width: 230px !important;
			border-radius: 10px !important;
			background: #fff !important;
			color: #2b2b2b !important;
		}
		
		.abcRioButtonContentWrapper{
			text-align:center !important; 
		}
		.abcRioButtonContents{
			font-family: 'Ubuntu', sans-serif !important; 
			font-weight: 600 !important; 
			margin-left : 2px !important; 
			float: left !important; 
		}
		
.bg-image{
	background-image: url(<?php echo base_url() ?>assets/frontend/img/bg/2.jpg); 
	position: fixed;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	z-index: -1;
	background-size:cover;
	background-position:bottom;
}

  	</style>

</head>
<body>
<div class="bg-image"></div>
<div id="load"></div>
	<section>
		 <div class="continer padd relative" style="padding: 18px; height: 100vh; ">
			<br>
			<div class="row text-center">
				<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" >
					<br><img  src="<?php echo base_url() ?>assets/frontend/img/logo-512.png" style="width:20%;">
					<br><br>
					<!-- <h3 class="text-white">Gaming Social League</h3>  -->
				</div>
			</div>
			
			<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 padd position-absolute" align="center">
				<br>
				<div class="row text-box-position2 white-bg  ">
					
						<h3 class="text-bold text-white">Gaming Social League </h3> 
						<br>
						<h4 class="text-bold text-white">Enter OTP</h4> <br>

						<?php if(@$this->session->flashdata('error')) { ?>
							<div class="alert alert-danger">
								<p>  <?php echo $this->session->flashdata('error'); ?></p>
							</div>
						<?php } ?>
						
						
						<?php if(@$this->session->flashdata('success')) { ?>
							<div class="alert text-white">
								<p>  <?php echo $this->session->flashdata('success'); ?></p>
							</div>
						<?php } ?>
						
						
 
					<form action="<?php echo site_url('site/confirmLoginEmailOTP') ?>" method="post" autocomplete="none">
						
						<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd" id="login_div" >
							<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd" >
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
									<input  type="number" name="otp" class="form-control" placeholder="Enter one time password (OTP)"  autocomplete="none" required /><br>
								</div>
								
								<br>
								 <button type="submit" class="text-btn2 text-white text-bold">Verify OTP</button>
							</div>
							
							 <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd">
							  <br><br>
							  <?php  echo $otp =  @$this->session->userdata('person_login_otp'); ?>
							  <?php  $email =  @$this->session->userdata('person_login_email'); ?>
								<span class="text-white"><i>  Didn't receive OTP? <a href="<?php echo site_url('site/resendLoginEmailOTP/'.base64_encode($email)) ?>" class="text-white text-bold"> Resend OTP </a> </i></span><br><br>
						 
							 
							 
								 <br><br>
									<span><i><a href="<?php echo site_url('Login') ?>" id="login_manual_phone" class="text-white"><u>Back To Login</u></a></i></span>
									
								<br><br>
							 </div>
						 </div>
					 
					</form>
						
				</div>
			
			</div>
		</div>
	</section>


<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>
 

<script>
$(document).ready(function() {
    $('#login_manual_email').click(function(){
		$("#login_with_phone").hide('fast');
		$("#login_div").show('fast');
	});
});
</script>


<script>
$(document).ready(function() {
    $('#login_manual_phone').click(function(){
		$("#login_div").hide('fast');
		$("#login_with_phone").show('fast');
	});
});
</script>


 
</body>
</html>
