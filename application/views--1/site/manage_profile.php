<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Manage Profile </title>
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
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js"></script>
	
	<style>
	body  {
		background: #ededed  !important;
	}
	
	[disabled], [readonly] {background-color:#ffffff !important; color:#555555 !important; }
	
	.thumb-container > img {
		text-align: center !important;
		max-width:100%;
	}
	
	.header-text-2{
		padding:5px 0 5px 0 !important; 
		color:#fff;
		
		background: rgb(2,11,116);
		background: linear-gradient(103deg, rgba(2,11,116,1) 0%, rgba(91,1,115,1) 47%);
		border-radius: 0 50px 50px 0 ; 
	}
	
	
	</style>
	<style>
		input {
			border: 0 !important;
		}
		.form-control{
			height:45px !important;
			border-radius: 0 !important;
			border:2px solid #efefef !important;
		}
		.text-field{
			
			border:2px solid #efefef !important;
		}
		
		.input-group-addon{
			background: #fff !important;
			color: #2b2b2b !important;
			border:2px solid #efefef !important;
			padding: 12px 15px !important;
			border-radius: 0 !important;
		}
		

		.text-box-position2{
		   background:rgba(255,255,255,0.3); 
		    padding-bottom: 10px !important;
		    padding:20px;
		    border-radius: 10px;
		    margin:0 0px;
		    display: inline-block;
			width: 99.5%
			min-height:90vh !important;
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
<body >

<div id="load"></div>
	<section>
		<div class="f1lhk7ql"><a href="<?php echo site_url('') ?>"><i class="f1iowekn fa fa-arrow-left fa-lg text-white"></i></a>
		<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);"><?php echo @$genreName ?> Manage Profile </div></div>
	
	<form action="<?php echo site_url('site/updateUserProfile') ?>" method="post" autocomplete="none">
						
      <div class="container">
        <div class="row">   <br><br><br><br>		</div>
		
				<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 padd position-absolute" align="center">
				<br>
				<div class="row text-box-position2 white-bg">
				
				
						
						<?php if(!empty($userInfo['user_image'])){ ?>
					
							<?php if($userInfo['user_login_type'] == '1') { ?>
								<img class="lazy" src="<?php echo base_url() ?>uploads/site_users/<?php echo @$userInfo['user_image'] ?>" >
							<?php } else { ?>
								<img class="lazy" src="<?php echo base_url().'uploads/site_users/'.$userInfo['user_image'] ?>">
							<?php } ?>
							
							<!-- <img  class="lazy" src="<?php echo base_url() ?>uploads/site_users/<?php echo @$userInfo['user_image']; ?>" alt="">  -->
						<?php } else { ?>
							<img  class="lazy" src="<?php echo base_url() ?>uploads/default-user.png" width="100" alt="">
						
						<?php }  ?>
				
						
				<br><br><br>
				
			
					
						<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd">
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user-alt"></i></span> 
							<input  type="text" name="user_full_name" class="form-control text-field" value="<?php echo $userInfo['user_full_name']; ?>" placeholder="Full Name"  autocomplete="none"  /><br>
						</div>
						</div>
						
						<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd">
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
							<input  type="email" name="user_email" class="form-control text-field" value="<?php echo $userInfo['user_email']; ?>" placeholder="Email Address"  autocomplete="none"  /><br>
						<!-- <span class="input-group-addon"><i class="fa fa-check-circle  echo 'text-success'; } else { echo 'text-disabled'; } ?>" aria-hidden="true"></i></span> 
							-->
							<?php if(@$userInfo['user_email_verified'] == 1){ ?>
								<span class="input-group-addon"><i class="fa fa-check-circle text-success"></i></span> 
							<?php } else { ?>
								<span class="input-group-addon"><i class="fa fa-check-circle text-disabled"></i></span> 
							<?php }  ?>
							
						</div>
						</div>
						
						
						<?php if(@$userInfo['user_type'] == 1 ){ ?>
						<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd">
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone-alt"></i></span> 
							<input  type="text" name="user_phone" class="form-control text-field" value="<?php echo "+".$userInfo['user_phone']; ?>" placeholder="Phone Number"  autocomplete="none" required disabled /><br>
							<span class="input-group-addon"><i class="fa fa-check-circle text-success"></i></span> 
							
						</div>
						
						</div>
						<?php } ?>
						
					 <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd">
						 <br><br><br><br>	
					 </div>
				</div>
				
			</div>
		

         <a class="bottom-fixed-btn"><button type="submit" id="choose_game" class="btn btn-bottom btn-active">Update Profile  </button></a>  
      </div>
	  
	   </form>
	</section>
	
	
	

  
<div class="modal fade" id="successOTPModal" role="dialog">
    <div class="modal-dialog box-center">
      <div class="modal-content " align="center">
        <div class="modal-header bg-success">
			<h4 class="modal-header">Verify Email Address</h4>
         <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>  -->
        </div>
		<form action="<?php echo site_url('site/processEmailVerification') ?>" method="post">
        <div class="modal-body">
       
			
          <p class="text-dark">Enter the OTP you just received on the specified email address.</p>
		  <br>	  
		  
		  	<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-t-15 padd">
			<br>
			<div class="input-group">
				<input  type="number" name="email_otp" class="form-control text-field" value="" placeholder="Enter One Time Password"  autocomplete="none" required />
			</div>
					   <br><br>
			</div>
						

			<button type="submit" class="btn btn-success">Verify</button>
        </div>
		
		</form>
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
  	
  <?php include "page_session_timeout.php"; ?>
		
<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>



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
 

<?php if($this->session->flashdata('otp_success')){ ?>
<script>
jQuery(document).ready(function ($) {
	jQuery('#successOTPModal').modal('show');
}); 
</script>
<?php } ?>
 
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


</body>
</html>