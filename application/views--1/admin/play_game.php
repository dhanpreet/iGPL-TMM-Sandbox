<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Play Game</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="mobile-web-app-capable" content="yes">
	<!--  meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, user-scalable=0"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">

	<link rel="stylesheet" href="<?php echo base_url() ?>assets/frontend/css/bootstrap.min.css">
	<script src="<?php echo base_url() ?>assets/frontend/js/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>assets/frontend/js/bootstrap.min.js"></script>
	
	<!-- For fontawesome icons -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/css/all.css" rel="stylesheet">
	<script defer src="<?php echo base_url() ?>assets/frontend/fontawesome-5.15.1/js/all.js"></script>
	
	
	
	<script src="https://multiplayergameserver.com/rtl/swfobject.js"></script>
    <script src="https://multiplayergameserver.com/js/swfobject.js"></script>
    <script src="https://multiplayergameserver.com/js/jquery.js"></script>
    <script src="https://multiplayergameserver.com/js/jquery.simplemodal.js"></script>
	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
	<style>
		body {
            background: #000;
			font-family: 'Ubuntu', sans-serif;  
        }
		
		<!-- body, html { overflow-x:hidden !important; }  -->
		
		.red-bg {
			background: linear-gradient(to bottom,#251b72,#3f27c3);
		}
		
		.videoWrapper iframe {
			top: 0;
			left: 0;
			background: #000;
            height: 90vh;
            width: 100vw;
			border:none !important;
		}
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
            right: 10px;
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
			
		}
	</style>
	
	<script>

        var elem = document.documentElement;
        function openFullscreen() {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) { /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
            }

        }

        function closeFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    </script>
	
</head>
<body>


 <?php $gameScreenOrientation =  $gameInfo['screen']; ?>

<div id="myvideofull">
	<section>
		<div class=" padd">
			<div class="padd relative col-md-12">
				<div class="header-height red-bg" style="height: 40px"> </div>
				<div class="nav-back " style="width:99%;" align="center">
					<p id="timer" class="inline-block">  <?php echo $gameInfo['Name']; ?></p>
				</div>
			</div>   
	
			<span class="arrow-absolute">
				<!-- <a href="javascript: history.go(-1)" class="anch-white text-white" style="cursor: pointer;color:#fff !important; margin-top: 5px;">	
					<i class=" fa fa-arrow-left fa-lg text-white"></i>
				</a> -->
            </span>
		</div>
	</section>
					
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="">
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
			
			
				<div class="relative">
				
				<div>
				 <span class="full-absolute"><button onclick="goFullscreen('myvideofull');" class="btn anch-white btn-show" id="expandbtn"><i class="fa fa-expand"></i></button></span>
				 <span class="full-absolute btn-hide"><button onclick="closeFullscreen();" id="collapsebtn" class="btn anch-white btn-hide"><i class="fa fa-compress"></i></button></span>
				</div>
			
					<div class="videoWrapper">
						<div id="area-landscape" style="display:none;">
							<br><br><br><br><img src="<?php echo base_url('assets/frontend/img/device-rotate-landscape.png') ?>" />
						</div>
						<iframe id="myvideo" src="https://multiplayergameserver.com/xmlapi7/rdf.playgame.php?skillpod_siteid=834&gameid=<?php echo $gameId; ?>&seemless=true&fullscreen=true"></iframe>
					</div>
				</div>
				  
			</div>
        
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
	
</div>	

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
            $('.videoWrapper').css('height','100vh');

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
			$('.videoWrapper').css('height','94vh');
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

if((gameOrientation == 'Landscape' || gameOrientation == 'landscape') && screenWidth < 780){
	var orientation = window.screen.orientation;
	var orientation = (screen.orientation || {}).type || screen.mozOrientation || screen.msOrientation;
	
	if (orientation === "landscape-primary" || orientation === "landscape-secondary") {
		$("#area-landscape").css("display", "inline-block");
		$("#myvideo").css("display", "none");
	} else if (orientation === "portrait-secondary" || orientation === "portrait-primary" || orientation===0) {
		if(gameOrientation == 'Landscape' || gameOrientation == 'landscape'){
			$("#myvideo").css("display", "none");
			$("#area-landscape").css("display", "inline-block");
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
		} else {
			$("#myvideo").css("display", "none");
			$("#area-landscape").css("display", "inline-block");
		}
	} else if (orientation === "portrait-secondary" || orientation === "portrait-primary" || iOS_Orientation ==0) {
		if(gameOrientation == 'Landscape' || gameOrientation == 'landscape'){
			$("#myvideo").css("display", "none");
			$("#area-landscape").css("display", "inline-block");
		}
	} else if (orientation === undefined) {}
}, false);


</script>


	
</body>
</html>