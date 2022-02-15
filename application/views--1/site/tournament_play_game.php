<!doctype html>
<html class="no-js" lang="en">

<head>
<title>iGPL</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta http-equiv="Cache-Control" content="max-age=0" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"> -->

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />	
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	
	<!-- Java Script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<!-- For fontawesome icons -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
  
	
	<script src="https://multiplayergameserver.com/rtl/swfobject.js"></script>
    <script src="https://multiplayergameserver.com/js/swfobject.js"></script>
    <script src="https://multiplayergameserver.com/js/jquery.js"></script>
    <script src="https://multiplayergameserver.com/js/jquery.simplemodal.js"></script>
	

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
	<style>
		body {
            background: #212121;
			font-family: 'Ubuntu', sans-serif;  
        }
		
		
		body, html { overflow-x:hidden !important; }
		
		
		.red-bg {
			background:  rgba(34,40,46, 1);
		}
		
		<!-- .videoWrapper iframe {
			top: 0;
			left: 0;
			background: #212121;
            height: 90vh;
            width: 100vw;
			border:none !important;
		} -->
		
		
		.btn-show {
            visibility: visible;
        }

        .btn-hide {
            visibility: hidden;
        }
		.back-arrow {
            width: 18px;
            margin-right: 20px;
            margin-top: -3px;
        }

        .arrow-absolute {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #fff;
        }

        .full-absolute {
            position: absolute;
            top: 5px;
            right: 5px;
			z-index:999990;
        }
		
		.lowIndex{
			z-index:999999 !important;
		}

		.full-absolute i {
			color: #103c42 !important;
		}

        .padd {
            padding: 0px;
            margin: 0px;
        }

        .nav-back {
            position: absolute;
            top: 10px;
            color: #fff;
            left: 10px;
        }
		
		#timer{
			font-size:1.2em !important;
		}
		
		.anch-white, .anch-white:focus, .anch-white:hover{
			color:#333 !important;
			background:#fff !important;
		}
		
		.leader-board {
			position: absolute;
			top: 6px;
			color: #fff;
			right: 10px;
		}

		.leader-board a {
			color: #fff;
		}
		.inline-block{
			display: inline-block;
		}
		
		@media only screen and (max-width: 767px) {
			.header-height{
				height:45px !important;
			}
		}
		@media only screen and (min-width: 768px) {
			.header-height{
				height:45px !important;
			}
		}
		
		
		#myvideo:-webkit-full-screen #myvideo {
			display: none;
		  }
		  #myvideo:-moz-full-screen #myvideo {
			display: none;
		  }
		  #myvideo:-ms-fullscreen #myvideo {
			display: none;
		  }
		  #myvideo:fullscreen #myvideo {
			display: none;
		}
		
		
		#area-landscape{
			width: 100%  !important;
			height: 100%  !important;
			text-align: center;
			background:#212121;
			
		}
		
		#area-landscape img{
			max-width: 100%  !important;
		}
		
		
		body, html {width: 100%; height: 100%; margin: 0; padding: 0}
		.iframeWrapper {position: absolute; top: 40px; left: 0; right: 0; bottom: 0;  }
		.iframeWrapper iframe {display: block; width: 100%; height: 100%; border: none;}
		
		
	</style>
	
	<script>
	  function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
	  }
	</script>
	
</head>

<body style="height:100%;">
<div id="load"></div>


 <?php $gameScreenOrientation =  @$tournamentInfo['t_game_screen'] ?>


<div id="myvideofull">
	<section>
		<div class="padd">
			<div class="padd  col-md-12">
				<div class="header-height red-bg" style="height: 40px"> </div>
				<div class="nav-back " style="width:98%;" align="center">
					<img  src="<?php echo base_url() ?>assets/frontend/img/time.png" height="20" style="margin-top: -6px;"> 
					<!-- <p id="timer" class="inline-block"> &nbsp; 00:00:00:00</p>  -->
					<span data-countdown="<?php echo $tournamentInfo['t_end_date'].' '.$tournamentInfo['t_end_time'].':00'; ?>"></span>
				</div>
				
				<!-- 
				<div class="leader-board"> 
					<a href="<?php echo site_url('site/updateTournamentPlayerScore/'.base64_encode($tournament_id).'/'.@$game_id.'/'.@$player_profile_id.'/redirect_leaderboard') ?>"> <img  src="<?php echo base_url() ?>assets/frontend/img/leader-board.png" width="32" style="margin-top: 5px;">	</a>
				</div>
				
				
				-->
				<div> 
					<span class="full-absolute"><button onclick="goFullscreen('myvideofull');" class="btn anch-white btn-show" id="expandbtn"><i class="fa fa-expand"></i></button></span>
					 <span class="full-absolute btn-hide"><button onclick="closeFullscreen();" id="collapsebtn" class="btn anch-white btn-hide"><i class="fa fa-compress"></i></button></span>
				</div>
				
			</div>   
	
			<span class="arrow-absolute">
			
				<?php $logged_user_id = $this->session->userdata('userId'); ?>
				
				<a href="<?php echo site_url('site/updateTournamentPlayerScore/'.base64_encode($tournament_id).'/'.@$game_id.'/'.@$player_profile_id.'/redirect_tournament') ?>"  style="cursor: pointer;color:#fff !important; margin-top: 5px;">
					<img src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14">
				</a>
				
				
            </span>
		</div>
	</section>
					
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container">
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
			
				<div class="relative">
					
					<div class="iframeWrapper">
					
						<div id="area-landscape" style="display:none;">
							
							<?php if($gameScreenOrientation == 'Portrait' || $gameScreenOrientation == 'Potrait') { ?>
									<img src="<?php echo base_url('assets/frontend/img/device-rotate-potrait.png') ?>" />
							<?php } else { ?>
								<img src="<?php echo base_url('assets/frontend/img/device-rotate-landscape.png') ?>" />
							<?php } ?>
							
						</div>
					
						<iframe id="myvideo" src="https://games.igpl.pro/xml-api/play-game?partnercode=test-001&playerid=<?php echo $player_profile_id; ?>&gameid=<?php echo $game_id; ?>&seemless=true&fullscreen=true" frameborder="0"  allowtransparency="true" style="z-index:1;" onload="resizeIframe(this);" scrolling="no"  allow="autoplay"></iframe>
						
						
					</div>
				</div>
				  
			</div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
</div>	

 <script>
      $(document).ready(function() {
        var dataStr = "tournament_id=<?php echo $tournament_id; ?>"+"&game_id=<?php echo $game_id; ?>"+"&skillpod_player_id=<?php echo $player_profile_id; ?>";
        setInterval(function() {
          $.ajax({
            crossDomain: true,
            async: true,
            type: "POST",
			data: dataStr,
            url: "<?php echo site_url('site/updateGameboostPlayerScore') ?>",
            success: function(result) {
              //console.log(dataStr);
              console.log(result);
            },
            jsonpCallback: 'callbackFnc',
            failure: function() {},
            complete: function() { 
				//console.log('completed'); 
			}
          });
        }, 15000);
      });

    </script>
	
  <script type="text/javascript">
        function goFullscreen(id) {
            // Get the element that we want to take into fullscreen mode
            var element = document.getElementById(id);
            var collapseElement = document.getElementById("collapsebtn");
            //  var a = collapseElement.attributes("style");
            $('#expandbtn').removeClass('anch-white btn-show');
            $('#expandbtn').addClass('anch-white btn-hide');
            $('#collapsebtn').removeClass('anch-white btn-hide');
            $('#collapsebtn').addClass('anch-white btn-show');
           
            // collapseElement.style("visibility: visible");
            // These function will not exist in the browsers that don't support fullscreen mode yet, 
            // so we'll have to check to see if they're available before calling them.

            if (element.mozRequestFullScreen) {
                // This is how to go into fullscren mode in Firefox
                // Note the "moz" prefix, which is short for Mozilla.
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullScreen) {
                // This is how to go into fullscreen mode in Chrome and Safari
                // Both of those browsers are based on the Webkit project, hence the same prefix.
                element.webkitRequestFullScreen();
            }
            // Hooray, now we're in fullscreen mode!
        }
        function closeFullscreen() {
			
            $('#expandbtn').removeClass('anch-white btn-hide');
            $('#expandbtn').addClass('anch-white btn-show');
            $('#collapsebtn').removeClass('anch-white btn-show');
            $('#collapsebtn').addClass('anch-white btn-hide');
			
            if (document.exitFullscreen) { 
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {  /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
				
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }
        }
        function requestFullScreen(element) {
            // Supports most browsers and their versions.
            var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;

            if (requestMethod) { // Native full screen.
                requestMethod.call(element);
            } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");
                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }

        document.addEventListener("keydown", function (e) {
            if (e.keyCode == 13) {
                toggleFullScreen();
            }
        }, false);
        var videoElement = document.getElementById("myvideo");
            function toggleFullScreen() {
                if (!document.mozFullScreen && !document.webkitFullScreen) {
                    if (videoElement.mozRequestFullScreen) {
                        videoElement.mozRequestFullScreen();
                    } else {
                        videoElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else {
                        document.webkitCancelFullScreen();
                    }
                }
            }
         
    </script>



<script>
var gameOrientation = "<?php echo $gameScreenOrientation; ?>";
var screenWidth = window.screen.width;

if((gameOrientation == 'Landscape' || gameOrientation == 'landscape')){
	var orientation = window.screen.orientation;
	var orientation = (screen.orientation || {}).type || screen.mozOrientation || screen.msOrientation;
	var iOS_Orientation = window.orientation;
	if (orientation === "landscape-primary" || orientation === "landscape-secondary" || iOS_Orientation ==90 || iOS_Orientation== -90) {
		if(gameOrientation == 'Landscape' || gameOrientation == 'landscape'){
			$("#area-landscape").css("display", "none");
			$("#myvideo").css("display", "inline-block");
			resizeIframe("myvideo");
		} else {
			$("#myvideo").css("display", "none");
			$("#area-landscape").css("display", "inline-block");
			resizeIframe("myvideo");
		}
	} else if (orientation === "portrait-secondary" || orientation === "portrait-primary" || iOS_Orientation ==0) {
		if(gameOrientation == 'Landscape' || gameOrientation == 'landscape'){
			$("#myvideo").css("display", "none");
			$("#area-landscape").css("display", "inline-block");
			resizeIframe("myvideo");
		} else {
			$("#area-landscape").css("display", "none");
			$("#myvideo").css("display", "inline-block");
			resizeIframe("myvideo");
		}
	} else if (orientation === undefined) {}

} else {
	
	var orientation = window.screen.orientation;
	var orientation = (screen.orientation || {}).type || screen.mozOrientation || screen.msOrientation;
	var iOS_Orientation = window.orientation;
	
	if (orientation === "landscape-primary" || orientation === "landscape-secondary" || iOS_Orientation ==90 || iOS_Orientation== -90) {
		if(gameOrientation == 'Landscape' || gameOrientation == 'landscape'){
			$("#area-landscape").css("display", "none");
			$("#myvideo").css("display", "inline-block");
			resizeIframe("myvideo");
		} else {
			$("#myvideo").css("display", "none");
			$("#area-landscape").css("display", "inline-block");
			resizeIframe("myvideo");
		}
	} else if (orientation === "portrait-secondary" || orientation === "portrait-primary" || iOS_Orientation ==0) {
		if(gameOrientation == 'Landscape' || gameOrientation == 'landscape'){
			$("#myvideo").css("display", "none");
			$("#area-landscape").css("display", "inline-block");
			resizeIframe("myvideo");
		} else {
			$("#area-landscape").css("display", "none");
			$("#myvideo").css("display", "inline-block");
			resizeIframe("myvideo");
		}
	} else if (orientation === undefined) {}
}
	
</script>

<script>
window.addEventListener("orientationchange", function() {
	var orientation = window.screen.orientation;
	var orientation = (screen.orientation || {}).type || screen.mozOrientation || screen.msOrientation;
	var iOS_Orientation = window.orientation;
	if (orientation === "landscape-primary" || orientation === "landscape-secondary" || iOS_Orientation ==90 || iOS_Orientation== -90) {
		if(gameOrientation == 'Landscape' || gameOrientation == 'landscape'){
			$("#area-landscape").css("display", "none");
			$("#myvideo").css("display", "inline-block");
			resizeIframe("myvideo");
		} else {
			$("#myvideo").css("display", "none");
			$("#area-landscape").css("display", "inline-block");
			resizeIframe("myvideo");
		}
	} else if (orientation === "portrait-secondary" || orientation === "portrait-primary" || iOS_Orientation ==0) {
		if(gameOrientation == 'Landscape' || gameOrientation == 'landscape'){
			$("#myvideo").css("display", "none");
			$("#area-landscape").css("display", "inline-block");
			resizeIframe("myvideo");
		} else {
			$("#area-landscape").css("display", "none");
			$("#myvideo").css("display", "inline-block");
			resizeIframe("myvideo");
		}
	} else if (orientation === undefined) {}
}, false);
</script>


<script>
jQuery(document).ready(function() {
   setTimeout(function(){ jQuery('#load').fadeOut("fast"); }, 500);
});
</script>	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.4.0/moment-timezone-with-data-2010-2020.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js" integrity="sha512-lteuRD+aUENrZPTXWFRPTBcDDxIGWe5uu0apPEn+3ZKYDwDaEErIK9rvR0QzUGmUQ55KFE2RqGTVoZsKctGMVw==" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
	$('[data-countdown]').each(function() { 
		var $_this = $(this);
		var finalDate = moment.tz($_this.data('countdown'), "Asia/Manila");
		$_this.countdown(finalDate.toDate(), function(event) {
		//$this.html(event.strftime('%Dd : %Hh : %Mm : %Ss'));
		$_this.html(event.strftime('%D:%H:%M:%S'));
	
	  });
	});
});
</script>

</body>
</html>