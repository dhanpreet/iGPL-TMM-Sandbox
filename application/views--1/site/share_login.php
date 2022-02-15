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
		

  	</style>

</head>
<body>
<div id="load"></div>
	<section>
		<div class="continer white-bg padd relative" style="padding: 18px; height: 100vh; background-image: url(<?php echo base_url() ?>assets/frontend/img/referral-back.jpg); background-size:cover;background-position: bottom; ">
			<div class="row text-center">
				<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center" >
					<img  src="<?php echo base_url() ?>assets/frontend/img/gpl.png">
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
				<br>
				<div class="row text-box-position2">
					<form action="<?php echo site_url('site/sendEmailOTP') ?>" method="post">
						<h4 class="text-bold">Sign in with Email </h4> <br>

					   <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd">
						 <input  type="email" name="email" class="form-control" placeholder="Enter email address" required /><br>

						 <span><i>You will receive an OTP on this email address.</i></span><br><br>

						 <button type="submit" class="text-btn2 text-white text-bold">Get OTP</button>
					   </div>
					 </form>
				</div>
				<div class="bottom-position">

					<div class="row text-center">
						<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd">
							<h5 class="block text-with-line">OR</h5> <br>
						</div>

						<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12  text-center">
							<!-- <button class="loginBtn loginBtn--facebook text-center">
							 <i class="fab fa-facebook fa-lg"></i>&nbsp;&nbsp;&nbsp;Sign in with Facebook
							</button>  -->
							 <fb:login-button class="fb-login-button" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""  scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
	
							<br><br>
							<div class='g-signin2' data-onsuccess="onSignIn" data-theme="dark" data-width="230" data-height="48"  data-longtitle="true"> </div>

							<br> <br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>
 
 <?php
	$shareCode = $this->session->userdata('tournament_share_code');
	$redirectUrl = site_url('TournamentInfo/'.base64_encode($shareCode)); 
 ?>

  <script>
    function onSignIn(googleUser) {
      // Useful data for your client-side scripts:
      var profile = googleUser.getBasicProfile();
    
	// console.log("ID: " + profile.getId()); // Don't send this directly to your server!
    //  console.log('Full Name: ' + profile.getName());
    //  console.log('Given Name: ' + profile.getGivenName());
    //  console.log('Family Name: ' + profile.getFamilyName());
    //  console.log("Image URL: " + profile.getImageUrl());
    //  console.log("Email: " + profile.getEmail());

      // The ID token you need to pass to your backend:
      var id_token = googleUser.getAuthResponse().id_token;
      var name =  profile.getName()
      var image =  profile.getImageUrl()
      var email =  profile.getEmail()
      $.ajax({
        type: 'POST',
        data: {
          id_token: id_token,
          name: name,
          image: image,
          email: email,
          type: 'google'
        },
        url: "<?php echo site_url('site/processGmailLogin') ?>",
        success: function(data) {
          //alert(data);
		  
		  if(data == 'success'){
			  window.location.href = "<?php echo $redirectUrl; ?>";
		  }
		   signOut();
        }

      });  
    //  console.log("ID Token: " + id_token);
    }

    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function() {
        //console.log('User signed out.');
      });
    }
  </script>
  
  
  

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '386600022426608',
      cookie     : true,
      xfbml      : true,
      version    : 'v8.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
 
<script>
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
	//console.log(response);
  });
}
</script>

<script>
/*
function statusChangeCallback(response) {
	//console.log('statusChangeCallback');
	console.log(response);
	// for FB.getLoginStatus().
	if (response.status === 'connected') {
		// Logged into your app and Facebook.
		console.log('Welcome!  Fetching your information.... ');
		FB.api('/me', {fields: 'name, email'}, function(response) {
		//FB.api('/me', function (response) {
			console.log('User Name: ' + response.name);
			console.log('Email: ' + response.email);
			console.log('FB ID: ' + response.id);
			document.getElementById('status').innerHTML =
			  'Thanks for logging in, ' + response.name + '!';
		});
	} else {
		// The person is not logged into your app or we are unable to tell.
		document.getElementById('status').innerHTML = 'Please log ' +
		  'into this app.';
	}
}  */
</script>

<script>
function statusChangeCallback(response) {
	//console.log('statusChangeCallback');
	console.log(response);
	// The response object is returned with a status field that lets the
	// app know the current login status of the person.
	// Full docs on the response object can be found in the documentation
	// for FB.getLoginStatus().
	if (response.status === 'connected') {
		// Logged into your app and Facebook.
		console.log('Processing information.... ');
		FB.api('/me', {fields: 'name, email'}, function(response) {
		//FB.api('/me', function (response) {
			
			/*console.log('User Name: ' + response.name);
			console.log('Email: ' + response.email);
			console.log('FB ID: ' + response.id);
			document.getElementById('status').innerHTML =
			  'Thanks for logging in, ' + response.name + '!';
			*/  
			 
			var id_token = response.id;
			var name =  response.name;
			var image =  "https://graph.facebook.com/v9.0/"+id_token+"/picture?type=large";
			var email =  response.email;
			$.ajax({
				type: 'POST',
				data: {
				  id_token: id_token,
				  name: name,
				  image: image,
				  email: email,
				  type: 'facebook'
				},
				url: "<?php echo site_url('site/processFBLogin') ?>",
				success: function(data) {
				  //console.log(data);
				  if(data == 'success'){
					  window.location.href = "<?php echo $redirectUrl; ?>";
				  } 
				}

			});  
				//console.log("ID Token: " + id_token);
		});
	} else {
		// The person is not logged into your app or we are unable to tell.
		console.log('Please log into this app.');
	}
}
</script>


 
</body>
</html>
