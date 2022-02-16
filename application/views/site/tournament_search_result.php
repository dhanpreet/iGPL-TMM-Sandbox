<?php if(is_array($gamesList) && count($gamesList)>0){ ?>
	<?php foreach($gamesList as $row){ ?>				  
		  <div class="col-xs-4 padd">
			<div class="thumb-container" data-attr-id="<?php echo base64_encode(@$row['gid']); ?>">
			  <!-- <img class="img-responsive" src="<?php echo @$row['GameImage']; ?>">  -->
			  <img class="img-responsive" src="<?php echo base_url()."uploads/games/".@$row['ImageName']; ?>">
							  
			  <p class="game-name"><?php echo @$row['Name']; ?></p>
			</div>
		  </div>
	<?php } ?>
<?php } else { ?>
		<div class="col-xs-12 padd text-center">
			<br><br>
			<h5> <b> Sorry! No search results found. </b></h5>
		</div>
<?php } ?>
			