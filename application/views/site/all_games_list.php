<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title> Games </title>
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
	
</head>
<body>

<div id="load"></div>
	<section>
		<div class="f1lhk7ql">
			<a onclick="window.history.back();">
				&nbsp; &nbsp;<img src="<?php echo base_url() ?>assets/frontend/img/icons/back.png" height="14">
			</a>
			<div class="f1py95a7" style="text-transform: capitalize; color: rgb(255, 255, 255);"> Games</div>
		</div>
		<div class="step-container header-padding"></div>
		
		<div class="container">
        
		<div class="row" style="margin-bottom: 80px; ">
		
			<div class="col-xs-12 padd gaming-section-header-strip">
				<h4><span class="pull-left text-white">&nbsp; Arcade Games</span></h4>
				<span class="pull-right"><a class="theme-color-btn" href="<?php echo site_url('Games/Arcade') ?>">View all </a></span>
			</div>
		
			<div class="col-xs-12 padd auto-margin games_area"> 
				<?php if(is_array($arcadegamesList) && count($arcadegamesList)>0){ ?>
					<?php foreach($arcadegamesList as $row){ ?>
						<a class="free-games-click" href="<?php echo site_url('playGame/'.base64_encode($row['id'])) ?>" data-id="<?php echo (@$row['gid']); ?>" >
						  <div class="col-xs-4 padd">
							<div class="thumb-container" data-attr-id="<?php echo base64_encode(@$row['gid']); ?>">
							  <img class="img-responsive lazy" data-src="<?php echo base_url('uploads/games/'.$row['ImageName']); ?>"  src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif">
							  <p class="game-name"><?php echo @$row['Name']; ?></p>
							</div>
						  </div>
						</a>
					<?php } ?>
				<?php } ?>
			</div>
			
		<div class="col-xs-12 padd gaming-section-header-strip">
			<br><h4><span class="pull-left text-white">&nbsp; Action Games</span></h4>
			<span class="pull-right"><a class="theme-color-btn" href="<?php echo site_url('Games/Action') ?>">View all </a></span>
		</div>
		
		<div class="col-xs-12 padd auto-margin games_area"> 
        <?php if(is_array($actiongamesList) && count($actiongamesList)>0){ ?>
          <?php foreach($actiongamesList as $rowAction){ ?>
            <a class="free-games-click" href="<?php echo site_url('playGame/'.base64_encode($rowAction['id'])) ?>" data-id="<?php echo (@$rowAction['gid']); ?>" >
              <div class="col-xs-4 padd">
              <div class="thumb-container" data-attr-id="<?php echo base64_encode(@$rowAction['gid']); ?>">
                 <img class="img-responsive lazy" data-src="<?php echo base_url('uploads/games/'.$rowAction['ImageName']); ?>"  src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif">
                <p class="game-name"><?php echo @$rowAction['Name']; ?></p>
              </div>
              </div>
            </a>
          <?php } ?>
        <?php } ?>
      </div>
	  
	  
	<div class="col-xs-12 padd gaming-section-header-strip">
		<br><h4><span class="pull-left text-white">&nbsp; Adventure Games</span></h4>
		<span class="pull-right"><a class="theme-color-btn" href="<?php echo site_url('Games/Adventure') ?>">View all </a></span>
	</div>
		
      <div class="col-xs-12 padd auto-margin games_area"> 
        <?php if(is_array($adventuregamesList) && count($adventuregamesList)>0){ ?>
          <?php foreach($adventuregamesList as $rowAdventure){ ?>
            <a class="free-games-click" href="<?php echo site_url('playGame/'.base64_encode($rowAdventure['id'])) ?>" data-id="<?php echo (@$rowAdventure['gid']); ?>" >
              <div class="col-xs-4 padd">
              <div class="thumb-container" data-attr-id="<?php echo base64_encode(@$rowAdventure['gid']); ?>">
                 <img class="img-responsive lazy" data-src="<?php echo base_url('uploads/games/'.$rowAdventure['ImageName']); ?>"  src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif">
                <p class="game-name"><?php echo @$rowAdventure['Name']; ?></p>
              </div>
              </div>
            </a>
          <?php } ?>
        <?php } ?>
      </div>
	  
	  
		<div class="col-xs-12 padd gaming-section-header-strip">
			<br><h4><span class="pull-left text-white">&nbsp; Sports & Racing Games</span></h4>
			<span class="pull-right"><a class="theme-color-btn" href="<?php echo site_url('Games/Sports') ?>">View all </a></span>
		</div>
	
       <div class="col-xs-12 padd auto-margin games_area"> 
        <?php if(is_array($sportsgamesList) && count($sportsgamesList)>0){ ?>
          <?php foreach($sportsgamesList as $rowSports){ ?>
            <a class="free-games-click" href="<?php echo site_url('playGame/'.base64_encode($rowSports['id'])) ?>" data-id="<?php echo (@$rowSports['gid']); ?>" >
              <div class="col-xs-4 padd">
              <div class="thumb-container" data-attr-id="<?php echo base64_encode(@$rowSports['gid']); ?>">
                <img class="img-responsive lazy" data-src="<?php echo base_url('uploads/games/'.$rowSports['ImageName']); ?>"  src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif">
                <p class="game-name"><?php echo @$rowSports['Name']; ?></p>
              </div>
              </div>
            </a>
          <?php } ?>
        <?php } ?>
      </div>
	  
	  
		<div class="col-xs-12 padd gaming-section-header-strip">
			<br><h4><span class="pull-left text-white">&nbsp; Puzzle & logic Games</span></h4>
			<span class="pull-right"><a class="theme-color-btn" href="<?php echo site_url('Games/Puzzle') ?>">View all </a></span>
		</div>
		
       <div class="col-xs-12 padd auto-margin games_area"> 
        <?php if(is_array($puzzlegamesList) && count($puzzlegamesList)>0){ ?>
          <?php foreach($puzzlegamesList as $rowPuzzle){ ?>
            <a class="free-games-click" href="<?php echo site_url('playGame/'.base64_encode($rowPuzzle['id'])) ?>" data-id="<?php echo (@$rowPuzzle['gid']); ?>" >
              <div class="col-xs-4 padd">
              <div class="thumb-container" data-attr-id="<?php echo base64_encode(@$rowPuzzle['gid']); ?>">
                 <img class="img-responsive lazy" data-src="<?php echo base_url('uploads/games/'.$rowPuzzle['ImageName']); ?>"  src="<?php echo base_url() ?>assets/frontend/img/placeholder.gif">
                <p class="game-name"><?php echo @$rowPuzzle['Name']; ?></p>
              </div>
              </div>
            </a>
          <?php } ?>
        <?php } ?>
      </div>
    
        </div>
<br><br>
      </div>
	</section>
	<!-- Footer-Content -->
		<?php include "footer.php"; ?>
	<!-- Footer Content End -->

	
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


</body>
</html>