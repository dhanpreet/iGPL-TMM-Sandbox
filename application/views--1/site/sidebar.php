<?php
function obfuscate_email($email){
 /*   $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/3);

    return substr($name,0, $len) . str_repeat('x', $len) . "@" . end($em); 
*/

/*
	$em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name));
	if($len <=12)
		return substr($name,0, 12).'@' . 'xxxxxxxxx' ; 
	else 
		return substr($name,0, 12). 'xxxxxxxxx' ; 
	*/
	
	$em   = explode("@",$email);
   return @$em[0]; 
	
}
?>


<?php
// Get Unsubscribe User Access Duration
$accessUnsubscribe = false;
$unsubscribedUserId = $this->session->userdata('userId');
$userLastAccess = $this->db->query("SELECT * FROM tbl_unsubscribed_user_access WHERE access_user_id = '$unsubscribedUserId' ")->row_array();
if(!empty($userLastAccess['access_id'])){
	$endDate = $userLastAccess['access_end_date'];
	$today = date('Y-m-d H:i:s');
	if($endDate>= $today){
		$accessUnsubscribe = true;
	}
}
?>
 
 
<div id="mySidenav" class="sidenav">
		<!-- <a href="#" class="closebtn" onclick="closeNav()">&times;</a> -->
		<div class="fykrs1m">
		   <div id="sidebarProfile" class="f1wvou2n">
		  			
				<div class="f1m7l5pe">
				<a href="<?php echo site_url('updateProfileImage') ?>">
				<?php if(!empty($userInfo['user_image'])){ ?>
					
					<?php if($userInfo['user_login_type'] == '1') { ?>
						<img class="lazy" src="<?php echo base_url() ?>uploads/site_users/<?php echo @$userInfo['user_image'] ?>" width="50">
					<?php } else { ?>
						<img class="lazy" src="<?php echo base_url().'uploads/site_users/'.@$userInfo['user_image'] ?>" width="50">
					<?php } ?>
					
					<!-- <img  class="lazy" src="<?php echo base_url() ?>uploads/site_users/<?php echo @$userInfo['user_image']; ?>" alt="">  -->
				<?php } else { ?>
					<img  class="lazy" src="<?php echo base_url() ?>uploads/default-user.png" width="50" alt="">
				<?php }  ?>
				</a>
				</div>
			

				<div class="f10r1kbh">	
					<div class="ftumkjx">
					<a href="<?php echo site_url('ManageProfile') ?>" class="text-white">
					<?php
					if(!empty($userInfo['user_full_name'])){
						$phone = substr($userInfo['user_phone'],0, 12);
						echo ucwords($userInfo['user_full_name'])."<br>".substr($phone, 0, 3).'xxxxxx'.substr($phone, 9, 3);
					
					} else if(!empty($userInfo['user_email'])){
						echo obfuscate_email($userInfo['user_email']);
					
					} else if(!empty($userInfo['user_phone'])){
						$prefix = "+".substr($userInfo['user_phone'],0, 2);
						$ph = substr($userInfo['user_phone'],2, 10);
						echo $prefix.substr($ph, 0, 3).'XXXX'.substr($ph, 7, 3); 
					}
					?>
					</a>
					
					</div>
				</div>
				
				<div class="f1o3noum" style="cursor:pointer !important;">
				 <picture class="fc39scl">
					
					<img id="close-sidebar" onclick="closeNav()" class="f1mgyl9u" src="<?php echo base_url() ?>assets/frontend/img/close.png" alt="arrow">
				 </picture>
				</div>
			 </div> 

		</div>
		<div class="f1g1xeuz">
		   <div class="f108ghxs">
			  
			 <a id="sidebarWithdraw" class="fflrbt6" href="#">
				 <div class="fmn8x67">
					<div class="f1efquwu">Play Coins Balance</div>
					<div class="fddsvlq">
					   <div class="fn5go5s"><img src="<?php echo base_url() ?>assets/frontend/img/gold-coins.png" alt=""></div>
					   <div class="fgtyo0p"><?php echo @$userInfo['user_play_coins']; ?></div>
					</div>
				 </div>
				 <div class="f1vou0gj">Add</div>
			  </a>
			 
			  <a id="sidebarDeposit" class="fflrbt6" href="#" style=" border-bottom-left-radius: 5px;  border-bottom-right-radius: 5px;  ">
				 <div class="fmn8x67">
					<div class="f1efquwu">Reward Coins Balance</div>
					<div class="fddsvlq">
					   <div class="fn5go5s"><img src="<?php echo base_url() ?>assets/frontend/img/gold-coin.png" alt=""></div>
					   <div class="fgtyo0p"><?php echo @$userInfo['user_reward_coins']; ?></div>
					</div>
				 </div>
				 <div class="fnzd1bo">Redeem</div>
			  </a>
			 
			  <!-- <a id="sidebarTransactionHistory" href="" style="background-color: rgb(255, 249, 235); padding: 10px; border-bottom-left-radius: 5px; color: rgb(177, 122, 1); border-bottom-right-radius: 5px; font-weight: 500; position: relative;">
				 View order history 
				 <div style="position: absolute; right: 10px; top: 10px;">
					<picture class="fc39scl">
					   <source class="f1mgyl9u" type="image/webp" srcset="https://static.gamezop.com/peach/assets/img/xxl/black-arrow-right.webp">
					   <source class="f1mgyl9u" type="image/png" srcset="https://static.gamezop.com/peach/assets/img/xxl/black-arrow-right.png">
					   <img id="" class="frjiz3d" src="https://static.gamezop.com/peach/assets/img/black-arrow-right.png" width="10" alt="arrow">
					</picture>
				 </div>
			  </a>
			  
			  -->
			  
		   </div>
		</div>
	
		
		<div class="side-menu">
			<ul>
				
				<!-- <li><a href="<?php echo site_url('updateProfileImage') ?>"><i class="f1h2vptk fa fa-user-circle fa-lg"></i><span>Select Profile Image</span></a></li>
				-->
				<li><a href="<?php echo site_url('ManageProfile') ?>"><i class="f1h2vptk fa fas fa-user-edit fa-lg"></i> <span>My Account</span></a></li>
				
				
				<?php //if(@$userInfo['user_type'] == 1){ ?>
					<li><a href="<?php echo site_url('Spin-Win') ?>" id="spinwheel"><i class="f1h2vptk fa fa-spinner fa-lg"></i><span>Spin & Win</span></a></li>
				<?php //} ?>
					
				<!-- 
				<li><a href="#" class=""><i class="f1h2vptk fa fa-stream fa-lg"></i><span>Live Tournaments</span></a></li>
					-->
					
					
				<?php //if(@$userInfo['user_type'] == 1 && $this->createTournamentEnabled == 1){ ?>
						<!-- <li><a href="<?php echo site_url('createTournament/Step-1') ?>" class=""><i class="f1h2vptk fa fa-trophy fa-lg"></i><span>Create Tournament</span></a></li>
						-->
						<li><a href="#" class=""><i class="f1h2vptk fa fa-trophy fa-lg"></i><span>Create Tournament</span></a></li>
					
				<?php //}  ?>
				
			
				<li><a href="<?php echo site_url('tournamentHistory') ?>"><i class="f1h2vptk fa fa-boxes fa-lg"></i><span>Tournament History</span></a></li>
				<!-- 
				<li><a href="#"><i class="f1h2vptk fa fas fa-stream fa-lg"></i> <span>My Subscriptions</span></a></li>
				<li><a href="#"><i class="f1h2vptk fa fas fa-stream fa-lg"></i> <span>Topup History</span></a></li>
				-->
				<li><a href="<?php echo site_url('Notifications') ?>"><i class="f1h2vptk fa fa-bell fa-lg"></i><span>Notifications <span class="badge bg-danger" style="background:red !important;"><?php if(!empty($this->unreadNotifications) && $this->unreadNotifications>0) { echo @$this->unreadNotifications; }  ?></span></span></a></li>
				
			</ul>
			<hr>
			<ul>
		
				<li><a href="<?php echo site_url('Games/Action') ?>"><i class="f1h2vptk fa fa-gamepad fa-lg"></i><span>Action</span></a></li>
				<li><a href="<?php echo site_url('Games/Arcade') ?>"><i class="f1h2vptk fa fa-dice-five fa-lg"></i><span>Arcade</span></a></li>
				<li><a href="<?php echo site_url('Games/Adventure') ?>"><i class="f1h2vptk fa fa-route fa-lg"></i><span>Adventure </span></a></li>
				<li><a href="<?php echo site_url('Games/Sports') ?>"><i class="f1h2vptk fa fa-basketball-ball fa-lg"></i><span>Sports & Racing</span></a></li>
				<li><a href="<?php echo site_url('Games/Puzzle') ?>"><i class="f1h2vptk fa fa-chess fa-lg"></i><span>Puzzle & Logic</span></a></li>
			
			</ul>
			<hr>
			<ul>
				<li><a href="#"><i class="f1h2vptk fa fa-user-slash fa-lg"></i><span>Unsubscribe</span></a></li>
				<li><a href="#"><i class="f1h2vptk fa fa-file-contract fa-lg"></i><span>Terms & Conditions</span></a></li>
				<li><a href="#"><i class="f1h2vptk fa fa-shield-alt fa-lg"></i><span>Privacy Policy</span></a></li>
				<li><a href="#"><i class="f1h2vptk fa fa-headset fa-lg"></i><span>Support</span></a></li>
				
				<?php if($this->session->userdata('user_login_type') == 4){ ?>
					<!-- <li><a href="#" onclick="window.webViewJSBridge.goBackHome('Tickets')"><i class="f1h2vptk fa fa-arrow-left fa-lg"></i><span>Back to bKAsh App</span></a></li> -->
				<?php } ?>
			</ul>
		</div>
	</div>