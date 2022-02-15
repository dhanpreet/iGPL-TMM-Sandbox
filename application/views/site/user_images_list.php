<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Update Profile Image </title>
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
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.4/jquery.lazy.min.js"></script>
	
	<style>
	
	
	.thumb-container > img {
		text-align: center !important;
		max-width:100%;
	}
	
	.header-text-2{
		padding:5px 0 5px 0 !important; 
		color:#fff;
		
		background: #3fd53f !important;
		border-radius: 0 50px 50px 0 ; 
	}
	</style>
	
</head>
<body >

<div id="load"></div>
	<section>
		<div class="f1lhk7ql"><a href="<?php echo site_url('') ?>"><img class="f1iowekn" src="<?php echo base_url() ?>assets/frontend/img/icons/back.png"></a>
		<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);"><?php echo @$genreName ?> Select profile Image</div></div>
		
      <div class="container header-padding">
       
		<div class="row"><br>
			<div class="text-left col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 header-text-2" style="width:50%;">
				<h4 class="text-bold">&nbsp;&nbsp;&nbsp; For Male</h4>
			</div>
		</div>
        <div class="row " style="margin-bottom: 30px">
			<div class="col-xs-12 padd auto-margin games_area"> 
				<?php if(is_array($maleList) && count($maleList)>0){ ?>
					<?php foreach($maleList as $rowMale){ ?>
					
						  <div class="col-xs-3 padd">
							<div class="thumb-container text-center" data-attr-id="<?php echo base64_encode(@$rowMale['id']); ?>">
							  <img class=" lazy" data-src="<?php echo base_url('uploads/site_users/'.$rowMale['img']); ?>"  src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif">
							 <!-- <p class="game-name"><?php echo @$rowMale['Name']; ?></p> -->
							</div>
						  </div>
						
					<?php } ?>
				<?php } ?>
			</div>
        </div>
		
		<div class="row">
			<div class="text-left col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 header-text-2" style="width:50%;">
				<h4 class="text-bold">&nbsp;&nbsp;&nbsp; For Female</h4>
			</div>
		</div>
		<div class="row" style="margin-bottom: 90px">
			<div class="col-xs-12 padd auto-margin games_area"> 
				<?php if(is_array($femaleList) && count($femaleList)>0){ ?>
					<?php foreach($femaleList as $rowFemale){ ?>
					
						  <div class="col-xs-3 padd">
							<div class="thumb-container text-center" data-attr-id="<?php echo base64_encode(@$rowFemale['id']); ?>">
							  <img class=" lazy" data-src="<?php echo base_url('uploads/site_users/'.$rowFemale['img']); ?>"  src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif">
							 <!-- <p class="game-name"><?php echo @$rowFemale['Name']; ?></p> -->
							</div>
						  </div>
						
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		

         <a class="bottom-fixed-btn"><button type="button" id="choose_game" class="btn btn-bottom">Set As Profile Image </button></a>  
      </div>
	</section>
		
<script>
jQuery(document).ready(function() {
    jQuery('#load').fadeOut("slow");
});
</script>
 
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

			
 <script>
	$(document.body).on('click', '#choose_game' ,function(){
		var imgId = $('.thumb-container-active').attr('data-attr-id');
		//alert(imgId)
		if(imgId !='' && typeof imgId !== 'undefined'){
			window.location.href = "<?php echo site_url('site/setProfileImage/') ?>"+imgId;
		}
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