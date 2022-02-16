
<section class="footer-wrapper" align="center">
	<div class="container">
		<div class="row footer-dark <?php if($this->session->userdata('user_login_type') == 4){ ?>footer-dark-bkash<?php } ?>" style="padding:12px">
			<div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
				<a href="<?php echo site_url() ?>" class="<?php if($this->uri->segment(1)=='' || $this->uri->segment(1)=='index'){ echo "theme-color"; }else{ echo "text-white"; } ?>"> 
					<i class="f1h2vptk fa fa-home <?php if($this->uri->segment(1)=='' || $this->uri->segment(1)=='index'){ echo "theme-color"; }else{ echo "text-white"; } ?>"></i><span>
					<br> <span style="font-size: 1.0em; font-weight: 700;"> Home  </span>
				</a>
			</div>
			
			<div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
				<a href="<?php echo site_url('AllGames') ?>" class="<?php if($this->uri->segment(1)=='AllGames'  || $this->uri->segment(1)=='Games'){ echo "theme-color"; }else{ echo "text-white"; } ?>"> 
					<i class="f1h2vptk fa fa-gamepad <?php if($this->uri->segment(1)=='AllGames' || $this->uri->segment(1)=='Games'){ echo "theme-color"; }else{ echo "text-white"; } ?>"></i><span>
					<br> <span style="font-size: 1.0em; font-weight: 700;"> Games  </span>
				</a>
			</div>
			
			<div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
				<a href="<?php echo site_url('ManageProfile'); ?>" class="<?php if($this->uri->segment(1)=='ManageProfile'){ echo "theme-color"; }else{ echo "text-white"; } ?>">
					<i class="f1h2vptk fa fa-user-circle <?php if($this->uri->segment(1)=='ManageProfile'){ echo "theme-color"; }else{ echo "text-white"; } ?>"></i><span>
					<br><span style="font-size: 1.0em; font-weight: 700;"> My Account   </span>
				</a>
			</div>
			
	   </div>
	</div>
</section>