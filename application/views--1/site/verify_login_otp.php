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
	<script src="<?php echo base_url() ?>assets/frontend/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/css/style.css">
	
	<style type="text/css">

		.form-control{
			height:45px !important;
		}

		.text-box-position2
		{
		    background: #fff;
		    padding-bottom: 10px !important;
		    padding:20px;
		    border-radius: 10px;
		    margin:0 0px;
		    display: inline-block;
			width: 90%;
		}
		.text-btn2 {
		    width: 100%;
		    padding: 14px;
		    border-radius: 8px;
		    border: 1px solid #fff;
		    background-color: #948ace;
		    font-size: 16px;
		    font-weight: 300;
		}
		.bottom-text
		{
		      font-size: 14px;
		    color: #fff;
		}

		.bottom-position
		{
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
			min-width:70%;
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
		    min-width:45%;
			text-align:center;
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

  	</style>

</head>
<body>
<div id="load"></div>
	<section>

		<div class="continer white-bg padd relative" style="padding: 18px; height: 120vh; background-image: url(<?php echo base_url() ?>assets/frontend/img/referral-back.jpg); background-size:cover;background-position: bottom; ">
			<div class="row text-center">
				<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" >
					<img class="lazy" src="<?php echo base_url() ?>assets/frontend/img/gpl.png">
					<h3 class="text-white">Gaming Social League</h3>
				</div>
			</div>
			<?php if(@$this->session->flashdata('error')) { ?>
				<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" >
							<div class="alert alert-danger">
								<p>  <?php echo $this->session->flashdata('error'); ?></p>
							</div>
					</div>
			<?php } ?>
			<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 padd position-absolute" align="center">
				<br><br>
				<div class="row text-box-position2">
					<form action="<?php echo site_url('site/confirmEmailOTP') ?>" method="post">
						<h4 class="text-bold">Enter OTP</h4> <br>

					   <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd">
						 <input  type="text" name="otp" class="form-control" size="6" placeholder="Enter one time password (OTP)" required /><br>

						<!--  <span><i>An OTP sent on your specified email address. Please enter the same to verify your email address with us.</i></span><br><br>
							<?php echo @$this->session->userdata('person_otp'); ?>
						 -->
						 <?php $email =  @$this->session->userdata('person_email'); ?>
						<span><i>  Didn't receive OTP? <a href="<?php echo site_url('site/resendEmailOTP/'.base64_encode($email)) ?>"> Resend OTP </a> </i></span><br><br>
						 
						 <button type="submit" class="text-btn2 text-white text-bold">Confirm OTP</button>
					   </div>
					</form>
				</div>
				<div class="bottom-position">


				</div>
			</div>
		</div>
	</section>

<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>
 

</body>
</html>
