<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Site extends CI_Controller {
		
	var $unreadNotifications = '0';
	var $quickTournamentEnabled = 0;
	var $createTournamentEnabled = 0;
	var $freeTournamentEnabled = 0;
	var $vipTournamentEnabled = 0;
	var $globalLeaderboardEnabled = 0;
	var $practiceBannersEnabled = 0;
	var $redemptionCoinsEnabled = 0;
	var $redemptionDataPackEnabled = 0;
	var $redemptionTalkTimeEnabled = 0;
	var $redemptionGameAccessEnabled = 0;
	var $payAndPlayTournamentEnabled	=	0;
	var $unseenTournamentsResults	=	array();
	
	 public  function __construct(){
        parent:: __construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->model('site_model','SITEDBAPI');
		//$this->load->helper('timezone');
        //timezone();  // timezone set using helper 
		 date_default_timezone_set("Asia/Dhaka");
		
		$userId = $this->session->userdata('userId');	
		$notifyCount	= $this->SITEDBAPI->getUserUnreadNotificationsCount($userId);
		$this->unreadNotifications	= $notifyCount['rows_count'];
		
		// Get unseen tournaments results
		$prizeUnseen	= $this->SITEDBAPI->getUserUnseenResults($userId);
		$this->unseenTournamentsResults = $prizeUnseen;
		
		//Get The portal enabled/ disabled settings
		$portalSettings	= $this->SITEDBAPI->getPortalSettings();
		
	
		if( $this->search_exif($portalSettings, 'vip_tournaments') ){ 
			$this->vipTournamentEnabled	= 1;
		}
		if( $this->search_exif($portalSettings, 'free_tournaments') ){ 
			$this->freeTournamentEnabled	= 1;
		}
	
		if( $this->search_exif($portalSettings, 'pay_and_play_tournaments') ){ 
			$this->payAndPlayTournamentEnabled	= 1;
		}
		
		
		
    }
	
	function search_exif($exif, $field){
		foreach ($exif as $data){
			if ($data['name'] == $field)
				return $data['enabled'];
		}
	}
	public function error()	{
		$this->load->view('site/error');
	}
	public function JwtError(){
    	$this->load->view('site/jwt_error');
    }
	public function privacyPolicy()	{
		$this->load->view('site/privacy_policy');
	}
	
	public function terms()	{
		$this->load->view('site/terms_of_use');
	}
	
	function createShareCode($length){
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(str_shuffle($str_result), 0, $length);
	}

	function createOTP($length){
		$str_result = '0123456789';
		return substr(str_shuffle($str_result), 0, $length);
	}


	public function index()	{
		$userId = '';
		$user_login_type = '1';   //1=manual  2=Facebook  3=Google 4=gpApp
		// Get Test user details
		if(!empty($_GET['token'])) {
			$id = base64_decode($_GET['token']);  
			$userInfo = $this->SITEDBAPI->validateUser($id);

			if(!empty($userInfo['user_id'])){
				$userId = $userInfo['user_id'];  
				$user_login_type = $userInfo['user_login_type'];
				if($userInfo['user_status'] == 1){
					if(empty($userInfo['skillpod_player_id'])){
						$personEmail = $userInfo['user_email'];
						$this->createGameboostId($userId, $personEmail);
					}
				} else {
					redirect('error');
				}			
			} else {
				//redirect('Login');
			}
		} else {
			if($this->uri->segment(2)=='User'){
                $id = base64_decode($this->uri->segment(3));
			} else {
				$id = base64_decode($this->uri->segment(2));
			}
			
			if(!empty($id)){
				$userInfo = $this->SITEDBAPI->validateUser($id);
				if(!empty($userInfo['user_id'])){
					$userId = $userInfo['user_id'];  
					$user_login_type = $userInfo['user_login_type'];
					if($userInfo['user_status'] == 1){
						if(empty($userInfo['skillpod_player_id'])){
							$personEmail = $userInfo['user_email'];
							$this->createGameboostId($userId, $personEmail);
						}
					} else {
						redirect('error');
					}			
				} else {
					redirect('Login');
				}
			} else if($this->session->userdata('userId')){
				$userId = $this->session->userdata('userId');
				$user_login_type = $this->session->userdata('user_login_type');
			}
		}

		if(!empty($_GET['uid'])) {
			$uid = $_GET['uid'];
			$this->SITEDBAPI->LoginAccessUpdate($uid);
		} else {
			$uid = $this->uri->segment(4);
			if(!empty($uid)){
				$this->SITEDBAPI->LoginAccessUpdate($uid);
			}
		}
        
		
		if(empty($userId) || $userId==''){
			$this->session->set_flashdata("error","Error! Please login first to access this portal.");
			redirect('error');
		} 
		
		$this->session->set_userdata('userId', $userId);
		$this->session->set_userdata('user_login_type', $user_login_type);
		$data['userInfo'] = $this->SITEDBAPI->getSiteUserDetail($userId);
		
		//set popup value 0 for the premium user
		$this->db->where('user_id', $userId);
        $this->db->update('site_users', array('user_subscription_popup' => '0'));
		
		$data['msg']=false;
		$data['parking'] = false;
		
		//$tt = $this->unseenTournamentsResults;
		/* 
		echo "<pre>";
		print_r($tt);
		echo "</pre>";
		
		die;
		 */
		
		
		// get user unseen tournament rewards list
		$data['unseenTournamentsResults'] = $this->unseenTournamentsResults;
		$this->SITEDBAPI->setUpdateUnseenTournamentsResults($data['unseenTournamentsResults']);
		
		
		if($this->vipTournamentEnabled == 1){
			//$data['vipTournaments'] = $this->SITEDBAPI->getVipTournamentList($limit=1);
			
				$data['vipTournaments'] = array();
				$heroTournaments = $this->SITEDBAPI->getVipTournamentList($limit=1);
				$heroCount = 0;
				
				foreach($heroTournaments as $row){
					$checkJoinedTounament = $this->SITEDBAPI->checkJoinedTournamentPlayer($row['tournament_id'], $userId);
					$data['vipTournaments'][$heroCount] = $row;
					$myRank = 0;
					$myScore = 0;
					$joinedStatus = false;
					
					if($checkJoinedTounament > 0){
						// set user joined the tournament
						$joinedStatus = true;
						$heroTournamentPlayers = $this->SITEDBAPI->getLiveTournamentPlayersListDESC($row['tournament_id']);
						
						if(is_array($heroTournamentPlayers) && count($heroTournamentPlayers)>0){
							
							$highest_score = $heroTournamentPlayers[0]['player_score'];
							$rank = 1;
							
							foreach($heroTournamentPlayers as $rowPlayer){
								if($rowPlayer['user_id'] == $userId){
									$myScore = $rowPlayer['player_score'];
								}
								if($highest_score !=0 && $rowPlayer['player_score'] == $highest_score){
								} else {
									if($rowPlayer['player_score'] > 0 ){
										//$rank++;
									}  else {
										$rank = 0;
									}
									$highest_score = $rowPlayer['player_score'];
								}
								
								if($rowPlayer['user_id'] == $userId){
									$myRank = $rank;
								}
								$rank++;
							}
						}
					}	
					
					if($row['fee_tournament_rewards'] == 4){
						$voucherPrize = ($this->SITEDBAPI->getVoucherdetailbyid($row['fee_tournament_prize_1'])['vt_type'] + 
						$this->SITEDBAPI->getVoucherdetailbyid($row['fee_tournament_prize_2'])['vt_type'] + 
						$this->SITEDBAPI->getVoucherdetailbyid($row['fee_tournament_prize_3'])['vt_type'] + 
						($this->SITEDBAPI->getVoucherdetailbyid($row['fee_tournament_prize_4'])['vt_type'] * 7) + 
						($this->SITEDBAPI->getVoucherdetailbyid($row['fee_tournament_prize_5'])['vt_type'] * 40));
						
						$data['vipTournaments'][$heroCount]['voucherPrize'] = $voucherPrize;
					}
					
					$data['vipTournaments'][$heroCount]['joinedStatus'] = $joinedStatus;
					$data['vipTournaments'][$heroCount]['myScore'] = $myScore;
					$data['vipTournaments'][$heroCount]['myRank'] = $myRank;
					
					$heroCount++;
				}
		}
		
		if($this->freeTournamentEnabled == 1){
			//$data['freeTournaments'] = $this->SITEDBAPI->getFreeTournamentList($limit=1);
				$data['freeTournaments'] = array();
				$freeTournaments = $this->SITEDBAPI->getFreeTournamentList($limit=1);
				$freeCount = 0;
				
				foreach($freeTournaments as $freeRow){
					$checkJoinedTounament = $this->SITEDBAPI->checkJoinedTournamentPlayer($freeRow['tournament_id'], $userId);
					$data['freeTournaments'][$freeCount] = $freeRow;
					$myRank = 0;
					$myScore = 0;
					$joinedStatus = false;
					
					if($checkJoinedTounament > 0){
						// set user joined the tournament
						$joinedStatus = true;
						$heroTournamentPlayers = $this->SITEDBAPI->getLiveTournamentPlayersListDESC($freeRow['tournament_id']);
						
						if(is_array($heroTournamentPlayers) && count($heroTournamentPlayers)>0){
							
							$highest_score = $heroTournamentPlayers[0]['player_score'];
							$rank = 1;
							
							foreach($heroTournamentPlayers as $rowPlayer){
								if($rowPlayer['user_id'] == $userId){
									$myScore = $rowPlayer['player_score'];
								}
								if($highest_score !=0 && $rowPlayer['player_score'] == $highest_score){
								} else {
									if($rowPlayer['player_score'] > 0 ){
										//$rank++;
									}  else {
										$rank = 0;
									}
									$highest_score = $rowPlayer['player_score'];
								}
								
								if($rowPlayer['user_id'] == $userId){
									$myRank = $rank;
								}
								$rank++;
							}
						}
					}	
					
					if($freeRow['fee_tournament_rewards'] == 4){
						$voucherPrize = ($this->SITEDBAPI->getVoucherdetailbyid($freeRow['fee_tournament_prize_1']) ['vt_type'] * 10);
						$data['freeTournaments'][$freeCount]['voucherPrize'] = $voucherPrize;
					}
					
					$data['freeTournaments'][$freeCount]['joinedStatus'] = $joinedStatus;
					$data['freeTournaments'][$freeCount]['myScore'] = $myScore;
					$data['freeTournaments'][$freeCount]['myRank'] = $myRank;
					
					$freeCount++;
				}
		}

		if($this->payAndPlayTournamentEnabled==1){
			//$data['payAndPlayTournaments'] = $this->SITEDBAPI->getPayAndPlayTournamentList($limit=1);
			
			
				$data['payAndPlayTournaments'] = array();
				$payAndPlayTournaments = $this->SITEDBAPI->getPayAndPlayTournamentList($limit=1);
				$ppCount = 0;
				
				foreach($payAndPlayTournaments as $ppRow){
					$checkJoinedTounament = $this->SITEDBAPI->checkJoinedTournamentPlayer($ppRow['tournament_id'], $userId);
					$data['payAndPlayTournaments'][$ppCount] = $ppRow;
					$myRank = 0;
					$myScore = 0;
					$joinedStatus = false;
					
					if($checkJoinedTounament > 0){
						// set user joined the tournament
						$joinedStatus = true;
						$heroTournamentPlayers = $this->SITEDBAPI->getLiveTournamentPlayersListDESC($ppRow['tournament_id']);
						
						if(is_array($heroTournamentPlayers) && count($heroTournamentPlayers)>0){
							
							$highest_score = $heroTournamentPlayers[0]['player_score'];
							$rank = 1;
							
							foreach($heroTournamentPlayers as $rowPlayer){
								if($rowPlayer['user_id'] == $userId){
									$myScore = $rowPlayer['player_score'];
								}
								if($highest_score !=0 && $rowPlayer['player_score'] == $highest_score){
								} else {
									if($rowPlayer['player_score'] > 0 ){
										//$rank++;
									}  else {
										$rank = 0;
									}
									$highest_score = $rowPlayer['player_score'];
								}
								
								if($rowPlayer['user_id'] == $userId){
									$myRank = $rank;
								}
								$rank++;
							}
						}
					}	
					
					if($ppRow['fee_tournament_rewards'] == 4){
						$voucherPrize = ($this->SITEDBAPI->getVoucherdetailbyid($ppRow['fee_tournament_prize_1']) ['vt_type'] + 
						$this->SITEDBAPI->getVoucherdetailbyid($ppRow['fee_tournament_prize_2']) ['vt_type'] + 
						$this->SITEDBAPI->getVoucherdetailbyid($ppRow['fee_tournament_prize_3']) ['vt_type'] + 
						($this->SITEDBAPI->getVoucherdetailbyid($ppRow['fee_tournament_prize_4']) ['vt_type'] * 7) + 
						($this->SITEDBAPI->getVoucherdetailbyid($ppRow['fee_tournament_prize_5']) ['vt_type'] * 10));
						
						$data['payAndPlayTournaments'][$ppCount]['voucherPrize'] = $voucherPrize;
					}
			
					
			
					$data['payAndPlayTournaments'][$ppCount]['joinedStatus'] = $joinedStatus;
					$data['payAndPlayTournaments'][$ppCount]['myScore'] = $myScore;
					$data['payAndPlayTournaments'][$ppCount]['myRank'] = $myRank;
					
					$ppCount++;
				}
			
			
		}
		
		$data['actionGames'] = $this->SITEDBAPI->getHomeGenreGamesList($type='action', $limit=5);
		$data['arcadeGames'] = $this->SITEDBAPI->getHomeGenreGamesList($type='arcade', $limit=5);
		$data['adventureGames'] = $this->SITEDBAPI->getHomeGenreGamesList($type='adventure', $limit=5);
		$data['sportsGames'] = $this->SITEDBAPI->getHomeGenreGamesList($type='sports', $limit=5);
		$data['puzzleGames'] = $this->SITEDBAPI->getHomeGenreGamesList($type='puzzle', $limit=5);
		$data['session_page_type']=1;
		$this->load->view('site/home',$data);
		
	}
	
	
	
	function getUser($id){
		$this->db->select("*", FALSE);
		$this->db->where('user_id', $id);
		return  $this->db->get('site_users')->row();
    }
	
	public function createGameboostId($userId, $gameboostEmail){
		if(!empty($userId)){
			
			$userInfo = $this->getUser($userId);
			
			if(!empty($gameboostEmail)){
				$gameboostEmail = "gpbd_".$userInfo->user_phone."@igpl.pro";
			} 
			
			$gameboostMSISDN = $userInfo->user_phone;
			$gameboostNickname = "gpbd_".$userId;
			$gameboostPassword = $this->createShareCode(12);
			
			$postArray = array(
			'nickname' => $gameboostNickname,
			'email' => $gameboostEmail,
			'msisdn' => $gameboostMSISDN,
			'password' => $gameboostPassword,
			'gender' => 'male',
			'date_of_birth' => '1990-01-01'
			);
			
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://games.igpl.pro/xml-api/register_player',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => $postArray,
			  CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJwYXJ0bmVyX2NvZGUiOiJ0ZXN0LTAwMSIsInBhcnRuZXJfcGFzc3dvcmQiOiJ0ZXN0LTAwMSJ9.GQp4_XWFc1FkHHGoy6XWVe40_QHCUt4ityt57ahXoEMW2AhNHo27V_wJmypgZshbw1w6345mKffaGtf9XowGOA'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
				
			$xmlResponse = simplexml_load_string($response);
			
			$status = $xmlResponse->register_player->result;
			
			if(!empty($status) && $status == 'success'){
				$skillpod_player_id = $xmlResponse->register_player->skillpod_player_id;
				$skillpod_player_key = $xmlResponse->register_player->skillpod_player_key;
				
				$dataUser['user_email'] = $gameboostEmail;
				$dataUser['skillpod_nickname'] = $gameboostNickname;
				$dataUser['skillpod_password'] = $gameboostPassword;
				$dataUser['skillpod_object_id'] = $gameboostMSISDN;
				$dataUser['skillpod_player_id'] = $skillpod_player_id;
				$dataUser['skillpod_player_key'] = $skillpod_player_key;
				$this->db->where('user_id', $userId);
				$this->db->update('site_users', $dataUser);
			}
		}
	}
	
	
	
	public function useraccess(){
		$token = base64_decode(@$_GET['token']);
		
		if(empty($token)){
			redirect('error');
		} else {
			$uid = $this->uri->segment(3);
			
			$tokenArr = explode("-", $token);
			
			$uid = $tokenArr[0];
			$id = $tokenArr[1];

			$userInfo = $this->SITEDBAPI->getSiteUserDetail($id);
			$this->SITEDBAPI->LoginAccessUpdate($uid);
			if($userInfo['user_type']=='1' && $userInfo['user_subscription_popup']=='1'){
				//premium
				$url = base_url()."Welcome/".base64_encode($id);
				
				// update the popup value to hide welcome screen
				$updateData['user_subscription_popup'] = '0';
				$this->db->where('user_id', $id);
				$this->db->update('site_users', $updateData);
				
			} else{
				//$url = base_url()."home/".base64_encode($id)."/".$uid;
				$url = base_url()."home/".base64_encode($id);
			}
			redirect($url);
		}	
	}
	
	
    
    public function PremiumUser(){
		$this->load->view('site/subscription_welcome.php');	
	}
	 
	public function userNameupdate(){
		$this->load->view('site/name_update.php');	
	}

	public function updateusername(){
		$data['name']=$_POST['user_name'];
		$data['id']=base64_decode($_POST['token']);
		$userId = $this->SITEDBAPI->signup_name($data);
		
		
		//add Notification
		$notifyData['notify_user_id'] =  $data['id'];
		$notifyData['notify_type'] =  '5';  //1=TournamentCreated   2=Spin&Win   3=RedeemCoins   4=TournamentRewardAdded   5=UpdateProfileName    6=SubscriptionCoins   7=RewardAdded  8=RewardClaimed  9=VoucherExpired

		$notifyData['notify_title'] =  "Profile Settings";
		$notifyData['notify_desc'] =  "Profile name updated successfully.";
		$notifyData['notify_status'] =  '0';
		$notifyData['notify_date'] =  date('Y-m-d');
		$notifyData['notify_added_on'] =  time();
		$this->db->insert('user_notifications', $notifyData);
				
		
	    redirect('home/'.$_POST["token"]);
	}

	public function userSignup(){
		$this->load->view('site/user_signup.php');	
	}
	
	public function userSignupverified(){
		$chk_query=$this->SITEDBAPI->signup_checkmail();
		
		if($chk_query==1){
			$this->session->set_flashdata("error","Email Already Exist!");
				redirect('SignUp');
		}elseif ($chk_query==2) {
			$this->session->set_flashdata("error","Phone No. Already Exist!");
				redirect('SignUp');
		}elseif($chk_query==0){
			$userid = $this->SITEDBAPI->signup_insert();
			
		 redirect('site/index/?token='.base64_encode($userid));
		}
		
	}

	public function userLogin(){
		//$this->load->view('site/user_login.php');	
		$this->load->view('site/error.php');	
	}
	
	public function verifyUserLogin(){
		$phone = $_POST['user_phone'];
		$password = $_POST['user_password'];
		if(!empty($phone) && !empty($password)){
			
			$verifyUser =  $this->SITEDBAPI->verifyUserDetails($phone, $password);
			if(!empty($verifyUser['user_id']) && is_array($verifyUser) && count($verifyUser)>0 ){
				$user_id = $verifyUser['user_id'];
				$data['login_user_id']=$user_id;
				$data['login_user_country_code']=$this->session->userdata('country_code');
				$data['login_user_login_at']=date('Y-m-d H:i:s');
				$result=$this->USERDBAPI->manageLoginHistory($data);
				redirect('site/index/?token='.base64_encode($user_id));
				
			} else {
				$this->session->set_flashdata("error","Error! Invalid Mobile No. or Password.");
				redirect('Login');
			}
		} else {
			$this->session->set_flashdata("error","Error! Required parameters are missing.");
			redirect('Login');
		}
	}
	
	
// *****************************   *************************************** ********************************** //
// *****************************   Live  VIP/Pay&Play/Free Tournaments Starts Here ********************************** //
// *****************************   *************************************** ********************************** //


	public function getLiveTournament($id){
		
		$userId = $this->session->userdata('userId');
		$userInfo = $this->SITEDBAPI->getSiteUserDetail($userId);
		$id = base64_decode($id);
		//print_r($userInfo);
		$this->session->set_userdata('sess_tournament_id', base64_encode($id));
		// Get tournament info
		$this->session->set_userdata('tournament','VIP');
		$data['tournamentInfo'] = $this->SITEDBAPI->getLiveTournamentInfo($id);
		if(is_array($data['tournamentInfo']) && count($data['tournamentInfo'])>0){
			
			$data['playersCount'] = $this->SITEDBAPI->getLiveTournamentPlayersCount($id);
			$data['playersInfo'] = $this->SITEDBAPI->getLiveTournamentPlayersListDESC($id);
			$data['checkPlayerEntry'] = $this->SITEDBAPI->checkLiveTournamentPlayer($userId, $id);
			$data['totalPlayersCount'] = count($data['playersInfo']);
			
			$myRank = 0;
			$myScore = 0;
			$iCount = 0;
			$joinedStatus = false;
			
			// the user already joined this tournament
			if(!empty($data['checkPlayerEntry']['player_id'])){
			
				// set user joined the tournament
				$joinedStatus = true;
				
				if(is_array($data['playersInfo']) && count($data['playersInfo'])>0){
					/*
					$highest_score = $data['playersInfo'][0]['player_score'];
					$rank = 1;
					
					foreach($data['playersInfo'] as $rowPlayer){
						if($rowPlayer['user_id'] == $userId){
							$myScore = $rowPlayer['player_score'];
						}
						if($highest_score !=0 && $rowPlayer['player_score'] == $highest_score){
						} else {
							if($rowPlayer['player_score'] > 0 ){
								$rank++;
							} 
							$highest_score = $rowPlayer['player_score'];
						}
						
						if($rowPlayer['user_id'] == $userId){
							$myRank = $rank;
						}
					}
					*/
					
					$highest_score = $data['playersInfo'][0]['player_score'];
					$rank = 1;
					
					foreach($data['playersInfo'] as $rowPlayer){
						if($rowPlayer['player_score'] >0){
							if($highest_score !=0 && $rowPlayer['player_score'] == $highest_score){
								// don't change the rank for user
							} else {
								if($rowPlayer['player_score'] > 0 ){
									$rank++;
								} 
							$highest_score = $rowPlayer['player_score'];
							}
							
							if($rowPlayer['user_id'] == $userId){
								$myRank = $rank;
								$myScore = $rowPlayer['player_score'] ;
								break;
							}
							$iCount++;
						
						}
					}
					
					
				}
			}	
		
			$data['joinedStatus'] = $joinedStatus;
			$data['myScore'] = $myScore;
			$data['myRank'] = $myRank;
			
			$data['userInfo']  = $this->SITEDBAPI->getSiteUserDetail($userId);
			$data['checkPlayerEntry'] = $this->SITEDBAPI->checkLiveTournamentPlayer($userId, $id);
			if($data['checkPlayerEntry']){
				$data['joined']=true;
			}
			else{
				$data['joined']=false;
			}
			$data['session_page_type']=2;
			$data['session_tournament_id']=$id;
			$data['session_game_id']=$data['tournamentInfo']['tournament_game_id'];
/* 			
			
echo "<pre>";
print_r($data);
echo "</pre>";
			 */
			$this->load->view('site/live_tournament_info', $data);

		} else {
			redirect();
		}
	}

	public function managePlayCoinsHistory($section, $coin_type, $coins, $tournament_id=''){
		$userId = $this->session->userdata('userId');
		if(!empty($userId)){
			$coin['coin_user_id']           =   	$userId;
			$coin['coin_date']              =   	date("Y-m-d");
			$coin['coin_section']           =   	$section;
			if($coin_type == 'add')
				$coin['coin_play_coins_add']    =   $coins;
			if($coin_type == 'redeem')
				$coin['coin_play_coins_redeem']    =  $coins;
			
			$coin['coin_tournament_id']		=		$tournament_id;
			$coin['coin_type']              =   	1;
			$coin['coin_added_on']          =   	time();
			$this->db->insert('tbl_user_coins_history' , $coin);
		}
	}
	
	public function updateUserPlayCoins($coin_type, $coins){
		$userId = $this->session->userdata('userId');
		if(!empty($userId)){
			$userInfo = $this->SITEDBAPI->getSiteUserDetail($userId);
			$userPlayCoins = $userInfo['user_play_coins'];
			
			if($coin_type == 'add')
				$dataCoins['user_play_coins']    =   ($userPlayCoins+$coins);
			if($coin_type == 'redeem')
				$dataCoins['user_play_coins']    = ($userPlayCoins-$coins);
			
			$this->db->where('user_id' , $userId);
			$this->db->update('tbl_site_users' , $dataCoins);
		}
	}
	

	public function playLiveTournament($id){
		$tournament_id = base64_decode($id); 
		$userId = $this->session->userdata('userId');
		$joinedStatus = false;

		if(!empty($userId) && !empty($tournament_id)){
			
			// Get tournament info
			$data['tournamentInfo'] = $this->SITEDBAPI->getLiveTournamentInfo($tournament_id);
			$data['userInfo'] = $this->SITEDBAPI->getSiteUserDetail($userId);
			$data['checkPlayerEntry'] = $this->SITEDBAPI->checkLiveTournamentPlayer($userId, $tournament_id);
			if(!empty($data['checkPlayerEntry']['player_id'])){
				$joinedStatus = true;
			}
			
			if($data['userInfo']['user_type'] == '2' && $data['tournamentInfo']['tournament_section']!='1' && $joinedStatus == false){
				redirect('LiveTournament/'.$id);
			}

			$userPlayCoins = $data['userInfo']['user_play_coins'];
			$entryFee = $data['tournamentInfo']['fee_tournament_fee'];
			
			if(!$joinedStatus){
				
				// Join the user 
				$savePlayer['player_t_id'] = $tournament_id;
				$savePlayer['player_user_id'] = $userId;
				$savePlayer['player_score'] = 0;
				$savePlayer['player_type'] = '2';
				$savePlayer['player_added_on'] = time();
				$this->db->insert('tournaments_players', $savePlayer);
		
				$this->updateUserPlayCoins($coin_type='redeem', $coins=$entryFee);
				$this->managePlayCoinsHistory($section='6', $coin_type='redeem', $coins=$entryFee, $tournament_id);
				
				//Save User Notification
				if($entryFee > 0){
					$notifyDesc = "<b>{$entryFee} Play Coins</b> redeemed for participating a tournament.";
					$this->saveUserNotification($type='1', $notifyDesc);
				}
						
			}
				
			$gameId = $data['tournamentInfo']['tournament_gameboost_id'];
			$playerProfileId = $data['userInfo']['skillpod_player_id'];
			
			// Update the Report for the user wise tournament game play count
			$this->addReportUserGamePlay($type=2, $gameId, $tournament_id);

			$data['game_id'] = $gameId;
			$data['player_profile_id'] = $playerProfileId;
			$data['tournament_id'] = $tournament_id;
			$data['session_page_type']=4;
			$data['session_tournament_id']=$tournament_id;
			$data['session_game_id']=$data['tournamentInfo']['tournament_game_id'];
			
			$this->load->view('site/live_tournament_play_game', $data);
			//$this->load->view('site/live_tournament_play_game_new', $data);
			
		} else {
			redirect();
		}
	}


	public function updateLiveTournamentPlayerScore($tournament_id='', $game_id='', $skillpod_player_id='', $redirect=''){
	
		if(!empty($tournament_id) && !empty($game_id) && !empty($skillpod_player_id) && !empty($redirect)){
			
			$userId = $this->session->userdata('userId');
			$tournament_id =  base64_decode($tournament_id);
			$game_id = $game_id;
			$skillpod_player_id =  $skillpod_player_id;
			$redirect_path =  $redirect;
			
			$tournamentInfo = $this->SITEDBAPI->getLiveTournamentInfo($tournament_id);
			
			// Get current user score starts
			$postArray = array('game_id' => $game_id,'player_id' => $skillpod_player_id);
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://games.igpl.pro/xml-api/get_player_scores',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => $postArray,
			  CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJwYXJ0bmVyX2NvZGUiOiJ0ZXN0LTAwMSIsInBhcnRuZXJfcGFzc3dvcmQiOiJ0ZXN0LTAwMSJ9.GQp4_XWFc1FkHHGoy6XWVe40_QHCUt4ityt57ahXoEMW2AhNHo27V_wJmypgZshbw1w6345mKffaGtf9XowGOA'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			
			$responseXML = simplexml_load_string($response);
			$responseJSON = json_encode($responseXML);

			// Convert into associative array
			$responseArray = json_decode($responseJSON, true);
		 	$userScore = @$responseArray['get_player_scores']['player_scores']['player_score_0']['score'];
		 	$scoreDate = @$responseArray['get_player_scores']['player_scores']['player_score_0']['time'];
			$scoreDate = date('Y-m-d', strtotime($scoreDate.'+6 hours'));
			
			$t_start_date = $tournamentInfo['tournament_start_date'];
			$t_end_date = $tournamentInfo['tournament_end_date'];
			
			if($t_start_date <= $scoreDate &&  $t_end_date >= $scoreDate ){
				if(!empty($userScore)){
					$currentScore = $userScore;
				} else {
					$currentScore = 0;
				}
			} else {
				$currentScore = 0;
			}
			
			//Get User last saved score
			$scoreInfo = $this->SITEDBAPI->getLiveTournamentPlayerScore($tournament_id, $userId);
			$lastScore = @$scoreInfo['player_score'];
			$player_id = @$scoreInfo['player_id'];
			
			if($currentScore > $lastScore){
				$saveScore['player_score'] = $currentScore;
				$saveScore['player_score_updated'] = date('Y-m-d H:i:s');
				$this->db->where('player_id', $player_id);
				$this->db->update('tournaments_players', $saveScore);
			}
			
			if($redirect_path == 'redirect_leaderboard'){
				redirect('LiveTournamentLeaderboard/'.base64_encode($tournament_id));
			} else {
				
				redirect('LiveTournament/'.base64_encode($tournament_id));
			}
			
		} else {
			redirect('LiveTournament/'.base64_encode($tournament_id));
		}
	}



	public function updateLiveTournamentGameboostPlayerScore(){
		
		$userId = $this->session->userdata('userId');
		$tournament_id = @$_POST['tournament_id'];
		$game_id = @$_POST['game_id'];
		$skillpod_player_id = @$_POST['skillpod_player_id'];
		
		if(!empty($tournament_id) && !empty($game_id) && !empty($skillpod_player_id)){
			
			$tournamentInfo = $this->SITEDBAPI->getLiveTournamentInfo($tournament_id);
		
			// Get current user score starts
			$postArray = array('game_id' => $game_id,'player_id' => $skillpod_player_id);
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://games.igpl.pro/xml-api/get_player_scores',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => $postArray,
			  CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJwYXJ0bmVyX2NvZGUiOiJ0ZXN0LTAwMSIsInBhcnRuZXJfcGFzc3dvcmQiOiJ0ZXN0LTAwMSJ9.GQp4_XWFc1FkHHGoy6XWVe40_QHCUt4ityt57ahXoEMW2AhNHo27V_wJmypgZshbw1w6345mKffaGtf9XowGOA'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			
			$responseXML = simplexml_load_string($response);
			$responseJSON = json_encode($responseXML);

			// Convert into associative array
			$responseArray = json_decode($responseJSON, true);
		 	$userScore = @$responseArray['get_player_scores']['player_scores']['player_score_0']['score'];
		 	$scoreDate = @$responseArray['get_player_scores']['player_scores']['player_score_0']['time'];
			$scoreDate = date('Y-m-d', strtotime($scoreDate.'+6 hours'));
			
		 	$t_start_date = $tournamentInfo['tournament_start_date'];
			$t_end_date = $tournamentInfo['tournament_end_date'];
			
			if($t_start_date <= $scoreDate &&  $t_end_date >= $scoreDate ){
				if(!empty($userScore)){
					$currentScore = $userScore;
				} else {
					$currentScore = 0;
				}
			} else {
				$currentScore = 0;
			}
			
			$scoreInfo = $this->SITEDBAPI->getLiveTournamentPlayerScore($tournament_id, $userId);
			$lastScore = @$scoreInfo['player_score'];
			$player_id = @$scoreInfo['player_id'];
			if($currentScore > $lastScore){
				$saveScore['player_score'] = $currentScore;
				$this->db->where('player_id', $player_id);
				$this->db->update('tournaments_players', $saveScore);
			}
		}
	}
	
	
	public function getLiveTournamentLeaderboard($id){
		 $id = base64_decode($id); 
		 //echo "string".$id;
		//get loggedin  user id
		$userId = $this->session->userdata('userId');
		if(!empty($userId) && !empty($id) ){
		
			// Get tournament info
			$data['tournamentInfo'] = $this->SITEDBAPI->getLiveTournamentInfo($id);
			
			if(is_array($data['tournamentInfo']) && count($data['tournamentInfo'])>0){
				$data['userInfo'] = $this->SITEDBAPI->getSiteUserDetail($userId);
			
				$data['playersInfo'] = $this->SITEDBAPI->getLiveTournamentPlayersListDESC($id);
				$data['checkPlayerEntry'] = $this->SITEDBAPI->checkLiveTournamentPlayer($userId, $id);
			
				$data['user_id'] = $userId;
				$data['tournament_id'] = $id;
				
				$myRank = 0;
				$myScore = 0;
				$iCount = 0;
				$totalPlayers =  count($data['playersInfo']);
				if(is_array($data['playersInfo']) && count($data['playersInfo'])>0){
					
					$highest_score = $data['playersInfo'][0]['player_score'];
					$rank = 1;
					
					foreach($data['playersInfo'] as $row){
						if($row['player_score'] >0){
							if($highest_score !=0 && $row['player_score'] == $highest_score){
								// don't change the rank for user
							} else {
								if($row['player_score'] > 0 ){
									$rank++;
								} 
							$highest_score = $row['player_score'];
							}
							
							if($row['user_id'] == $userId){
								$myRank = $rank;
								$myScore = $row['player_score'] ;
								break;
							}
							$iCount++;
						
						}
					}
				}
				
				$data['myRank'] = $myRank;
				$data['myScore'] = $myScore;
				if($totalPlayers > 0 && $myScore>0){ // check the join players number count
					$data['myRank'] = $myRank;
					$data['myScore'] = $myScore;
				} else {
					$data['myRank'] = 0;
					$data['myScore'] = 0;
				}
			    $data['session_page_type']=7;
				$data['session_tournament_id']=$id;
				$data['session_game_id']=$data['tournamentInfo']['tournament_game_id'];
				$this->load->view('site/live_tournament_leaderboard', $data);
			
			} else {
				redirect();
			}
		} else {
			redirect();
		}
	}


	public function practiceTournamentGame($gameId, $tournamentId){
		$gameId = base64_decode($gameId); // gameboost game id
		$tournamentId = base64_decode($tournamentId); // gameboost game id
		
		if(!empty($gameId)){
			$data['gameId'] = $gameId;
			$data['gameInfo'] = $this->SITEDBAPI->getGameboostGameInfo($gameId);
			
			// Update the Report for the user wise practice game play count
			$this->addReportUserGamePlay($type=3, $gameId, $tournamentId);
			$data['session_page_type']=3;
			$data['session_tournament_id']=$tournamentId;
			$data['session_game_id']=$data['gameInfo']['gid'];
			$this->load->view('site/play_game', $data);
		} else {
			redirect();
		}
	}

		
	public function addReportUserGamePlay($type, $gameId, $tournamentId='0'){
		
		$userId = $this->session->userdata('userId');
		if(!empty($userId)){
			if($type == '1'){
				// Update the genre practice game count
				$lastPracticeSession =  $this->SITEDBAPI->getUserPracticeGameReport($userId, $gameId);
				if(!empty($lastPracticeSession['report_id'])){
					$reportData['report_practice_counts'] = ($lastPracticeSession['report_practice_counts']+1);
					$this->db->where('report_id', $lastPracticeSession['report_id']);
					$this->db->update('report_game_play', $reportData);
				} else {
					$reportData['report_user_id'] = $userId;
					$reportData['report_date'] = date('Y-m-d');
					$reportData['report_game_id'] = $gameId;
					$reportData['report_practice_counts'] = '1';
					$reportData['report_last_updated'] = time();
					$this->db->insert('report_game_play', $reportData);
				}
				
			} else if($type == '2'){
				
				if(!empty($tournamentId)){
					// Update the Tournament practice game count
					$lastPracticeSession =  $this->SITEDBAPI->getUserTournamentGameReport($userId, $gameId, $tournamentId);
					
					if(!empty($lastPracticeSession['report_id'])){
						$reportData['report_tournament_counts'] = ($lastPracticeSession['report_tournament_counts']+1);
						$this->db->where('report_id', $lastPracticeSession['report_id']);
						$this->db->update('report_game_play', $reportData);
					} else {
						$reportData['report_user_id'] = $userId;
						$reportData['report_date'] = date('Y-m-d');
						$reportData['report_game_id'] = $gameId;
						$reportData['report_tournament_id'] = $tournamentId;
						$reportData['report_tournament_counts'] = '1';
						$reportData['report_last_updated'] = time();
						$this->db->insert('report_game_play', $reportData);
					}
				} 
			} else if($type == '3'){
				
				if(!empty($tournamentId)){
					// Update the Tournament practice game count
					$lastPracticeSession =  $this->SITEDBAPI->getUserTournamentGameReport($userId, $gameId, $tournamentId);
					
					if(!empty($lastPracticeSession['report_id'])){
						$reportData['report_tournament_practice_counts'] = ($lastPracticeSession['report_tournament_practice_counts']+1);
						$this->db->where('report_id', $lastPracticeSession['report_id']);
						$this->db->update('report_game_play', $reportData);
					} else {
						$reportData['report_user_id'] = $userId;
						$reportData['report_date'] = date('Y-m-d');
						$reportData['report_game_id'] = $gameId;
						$reportData['report_tournament_id'] = $tournamentId;
						$reportData['report_tournament_practice_counts'] = '1';
						$reportData['report_last_updated'] = time();
						$this->db->insert('report_game_play', $reportData);
					}
				} 
			} 
			
		}
	}
	
	
	public function tournamentHistory()	{
		
		$userId = $this->session->userdata('userId');
		if(!empty($userId)){
			
			$data['userInfo'] = $this->SITEDBAPI->getSiteUserDetail($userId);
			$data['tournamentsList'] = $this->SITEDBAPI->getUserTournamentsList($userId, $limit=10, $offset=0);
			
			$tournamentsListCounts = $this->SITEDBAPI->getUserTournamentsTotal($userId);
			$data['offset'] = 0;
			
			if($tournamentsListCounts % 10 == 0){
				$data['total_pages'] = floor($tournamentsListCounts/10);
			} else {
				$data['total_pages'] = floor($tournamentsListCounts/10)+1;
			}
			//echo $data['total_pages']; die;
			$data['session_page_type']=9;
			$this->load->view('site/tournament_history',$data);
		} else {
			redirect();
		}
	}


	public function getTournamentsMore($offset){
		$userId = $this->session->userdata('userId');
		if( !empty($userId)){	
			$data['tournamentsList'] = $this->SITEDBAPI->getUserTournamentsList($userId, $limit=10, $offset);
			$this->load->view('site/tournament_history_more', $data);	
			
		} else {
			redirect();
		}
	}
	

	
	public function tournamentLeaderboard($id){
		 $id = base64_decode($id); 
		//get loggedin  user id
		$userId = $this->session->userdata('userId');
		if(!empty($userId) && !empty($id) ){
		
			// Get tournament info
			$data['tournamentInfo'] = $this->SITEDBAPI->getTournamentInfo($id);
			
			if(is_array($data['tournamentInfo']) && count($data['tournamentInfo'])>0){
		
				$today = time();

				$startDate = $data['tournamentInfo']['t_start_date']." ".$data['tournamentInfo']['t_start_time'].":00";
				$startDate = strtotime($startDate);

				$endDate = $data['tournamentInfo']['t_end_date']." ".$data['tournamentInfo']['t_end_time'].":00";
				$endDate = strtotime($endDate);

				$status = 0;     //1=CurrentlyWorking   2=Expired   3=futureTournament
				if($startDate > $today){
					$status = 3;
				} else if($endDate < $today){
					$status = 2;
				} else if($startDate <= $today && $endDate >= $today){
					$status = 1;
				}
				$data['t_current_status'] = $status;
				$data['user_id'] = $userId;
				$data['tournament_id'] = $id;
				$data['playersInfo'] = $this->SITEDBAPI->getTournamentPlayersListDESC($id);

				$this->load->view('site/tournament_leaderboard', $data);
			
			
			} else {
				redirect();
			}
		} else {
			redirect();
		}
	}


	
	
	
// *****************************   *************************************** ********************************** //
// *****************************   Live  VIP/Pay&Play/Free Tournaments Ends Here ********************************** //
// *****************************   *************************************** ********************************** //


	
// *****************************   **************************** ********************************** //
// *****************************   Free Genre Games Starts Here ********************************** //
// *****************************   **************************** ********************************** //


	public function getallGenreGames(){
		
		$id = $this->session->userdata('userId');
		$data['userInfo'] = $this->SITEDBAPI->validateUser($id);
		
		$data['actiongamesList'] = $this->SITEDBAPI->getGenreGamesList('Action', $limit='6');
		$data['arcadegamesList'] = $this->SITEDBAPI->getGenreGamesList('Arcade', $limit='6');
		$data['adventuregamesList'] = $this->SITEDBAPI->getGenreGamesList('Adventure', $limit='6');
		$data['sportsgamesList'] = $this->SITEDBAPI->getGenreGamesList('Sports', $limit='6');
		$data['puzzlegamesList'] = $this->SITEDBAPI->getGenreGamesList('Puzzle', $limit='6');
		$this->load->view('site/all_games_list', $data);		
	}
	

	public function getGenreGames($type){
		$data['gamesList'] = $this->SITEDBAPI->getGenreGamesList($type);
		$data['type'] = $type;		
		if($type == 'Action')
			$data['genreName'] = 'Action';
		else if($type == 'Arcade')
			$data['genreName'] = 'Arcade';
		else if($type == 'Adventure')
					$data['genreName'] = 'Adventure';
		else if($type == 'Sports')
					$data['genreName'] = 'Sports & Racing';
		else if($type == 'Puzzle')
			$data['genreName'] = 'Puzzle & Logic';
	
		$this->load->view('site/genre_games_list', $data);	
		
	}
	
	
	function testGame(){
		$id = '24';
		$data['gameId'] = $id;
		$data['gameInfo'] = $this->SITEDBAPI->getGameboostGameInfo($id);
			
		$this->load->view('site/test-game.php', $data);
    }
	
	
	public function playGame__old($id){
		$id = base64_decode($id); // gameboost game id
		
		if(!empty($id)){
			$data['gameId'] = $id;
			$data['gameInfo'] = $this->SITEDBAPI->getGameboostGameInfo($id);
			
			// Update the Report for the user wise practice game play count
			$this->addReportUserGamePlay($type=1, $id);
			
			$data['session_page_type']=5;
			$data['session_game_id']=$data['gameInfo']['gid'];
			$this->load->view('site/play_game', $data);
		} else {
			redirect();
		}
	}

	public function playGame($id){
		$id = base64_decode($id); // gameboost game id
		
		if(!empty($id)){
			$data['gameId'] = $id;
			$data['gameInfo'] = $this->SITEDBAPI->getGameboostGameInfo($id);
			
			// Update the Report for the user wise practice game play count
			$this->addReportUserGamePlay($type=1, $id);
			
			$data['session_page_type']=5;
			$data['session_game_id']=$data['gameInfo']['gid'];
			$this->load->view('site/play_game', $data);
			//$this->load->view('site/play_game_new', $data);
		} else {
			redirect();
		}
	}

	
// *****************************   **************************** ********************************** //
// *****************************   Free Genre Games Ends Here ********************************** //
// *****************************   **************************** ********************************** //



	
// *****************************   **************************** ********************************** //
// *****************************   Manage Profile Avatars Starts Here ********************************** //
// *****************************   **************************** ********************************** //

		
	public function manageProfile(){
		$userId = $this->session->userdata('userId');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		if( !empty($userInfo['user_id'])){	
			$data['userInfo'] = $userInfo;
			$data['session_page_type']=6;
			$this->load->view('site/manage_profile', $data);	
			
		} else {
			redirect('Login');
		}
	}


	public function updateUserProfile(){
		$userId = $this->session->userdata('userId');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		if( !empty($userInfo['user_id'])){	
			
			$update['user_full_name'] = $_POST['user_full_name'];
			$update['user_email_2'] = $_POST['user_email_2'];
			if($_POST['user_email_2'] != $userInfo['user_email_2']){
				$otp = $this->createOTP(6);
				$update['user_email_verified'] = 0;
				$update['user_email_otp'] = $otp;
			} else {
				$otp = $this->createOTP(6);
				$update['user_email_verified'] = $userInfo['user_email_verified'];
				$update['user_email_otp'] = $otp;
			}
			
			$this->db->where('user_id', $userId);
			if($this->db->update('site_users', $update)){
				
				//if($update['user_email_verified'] == 0){
				//	$this->sendEmailVerificationOTP($update['user_email_2'], $update['user_email_otp']);
				//} else {
					
					//Save User Notification
					$notifyDesc = "Profile information updated successfully.";
					$this->saveUserNotification($type='5', $notifyDesc);
				
				
					$this->session->set_flashdata("success","Profile information updated successfully.");
					redirect('ManageProfile');
				//}
				
				
			} else {
				$this->session->set_flashdata("error","Sorry! Unable to update profile information. Please try after sometime.");
				redirect('ManageProfile');
				
			}
		} else {
			redirect('Login');
		}
	}
	
	public function sendEmailVerificationOTP($email, $emailOTP){
		
		if(!empty($email)){

			// Sanitize E-mail Address
			$email =filter_var($email, FILTER_SANITIZE_EMAIL);
			// Validate E-mail Address
			$email= filter_var($email, FILTER_VALIDATE_EMAIL);
			if($email){

					$otp = $emailOTP;

					$row['content']='';
					$row['content'] .= "<p> <br> <b>{$otp}</b> is the One Time Password (OTP) to verify your email address. Do not share the OTP with anyone. </p>";
					$row['content'] .= "<p><br><br> <b>IMPORTANT</b>: Please do not reply to this message or mail address.</p>";
					$row['content'] .= "<p><b>DISCLAIMER</b>: This communication is confidential and privileged and is directed to and for the use of the addressee only. The recipient if not the addressee should not use this message if erroneously received, and access and use of this e-mail in any manner by anyone other than the addressee is unauthorized.</p>";
				
					$row['subject'] = "Your GSL Email Verification OTP";
					
					
				// Enable this when shift to live server
					
					$this->load->library("PhpMailerLib");
					$mail = $this->phpmailerlib->load();
					
					try {
						//Server settings
						$mail->SMTPDebug = 0;                                 // Enable verbose debug output
						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
					//	$mail->Username = 'gpl.gamenow@gmail.com';                 // SMTP username
					//	$mail->Password = 'gpl@123*';                           // SMTP password
						$mail->Username = 'adxdigitalsg@gmail.com';                 // SMTP username
						$mail->Password = 'adxd@123';                           // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 465;                                    // TCP port to connect to
						//Recipients
						$mail->setFrom('adxdigitalsg@gmail.com', 'GSL');
						$mail->addAddress($email);     // Add a recipient
						$mail->addReplyTo('adxdigitalsg@gmail.com', 'GSL');
						$mail->addBCC('vaish.nisha55@gmail.com');

						//Content
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = $row['subject'];
						$mail->Body    = $row['content'];
					
						$mail->send();
						$this->session->set_flashdata('otp_success','<strong>Success! </strong> OTP request sent on the specified email address.');

						$this->session->set_userdata('person_verify_email', $email);
						$this->session->set_userdata('person_verify_otp', $otp);
						redirect('ManageProfile');
						
					} catch (Exception $e) {
						$this->session->set_flashdata('error','<strong>Error! </strong> Unable to send OTP request to your specified email address. Please try again.');
					
						redirect("ManageProfile");
					}
					
					
			}	else {
				redirect();
			}
		} else {
			redirect();
		}
	}
	
	public function processEmailVerification(){
		$userId = $this->session->userdata('userId');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		if( !empty($userInfo['user_id'])){	
			
			$email_otp = $_POST['email_otp'];
			
			if($userInfo['user_email_otp'] ==  $email_otp){
				
				$update['user_email_verified'] = 1;
				$this->db->where('user_id', $userId);
				if($this->db->update('site_users', $update)){
					
					//Save User Notification
					$notifyDesc = "Email address verified successfully.";
					$this->saveUserNotification($type='5', $notifyDesc);
				
				
					$this->session->set_flashdata("success","Email address verified successfully.");
					redirect('ManageProfile');
				
				} else {
					$this->session->set_flashdata("error","Sorry! Unable to verify OTP. Please try again.");
					redirect('ManageProfile');
				}
			} else {
				$this->session->set_flashdata("error","Sorry! Unable to verify OTP. Please try again.");
				redirect('ManageProfile');
			}
		} else {
			redirect('Login');
		}
	}
	
	public function updateProfileImage(){
		$data['maleList'] = $this->SITEDBAPI->getMaleProfileImages();
		$data['femaleList'] = $this->SITEDBAPI->getFemaleProfileImages();
		$this->load->view('site/user_images_list', $data);	
		
	}
	
	public function setProfileImage($imgId){
		$userId = $this->session->userdata('userId');		
		$imgId = base64_decode($imgId);
		$dataUser['user_image'] = $imgId.".png";
		$this->db->where('user_id', $userId);
		if($this->db->update('site_users', $dataUser)){
			
			//Save User Notification
			$notifyDesc = "Profile image updated successfully.";
			$this->saveUserNotification($type='5', $notifyDesc);
				
			
			$this->session->set_flashdata("success","Profile image updated successfully.");
			redirect();
		} else {
			$this->session->set_flashdata("error","Unable to update profile image. Please try again.");
			redirect();
		}
		
	}
	
	
// *****************************   **************************** ********************************** //
// *****************************   Manage Profile  Ends Here ********************************** //
// *****************************   **************************** ********************************** //


	
// *****************************   **************************** ********************************** //
// *****************************   Manage Spin & Win  Starts Here ********************************** //
// *****************************   **************************** ********************************** //

	public function spinWheel(){
		$userId = $this->session->userdata('userId');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		if( !empty($userInfo['user_id'])){	
			
			$userSpinInfo = $this->SITEDBAPI->getUserLastSpin($userId);
			if($userSpinInfo)
			{
				$spinDate = $userSpinInfo['spin_date'];
				$spinDate = strtotime($spinDate);
				$today = strtotime(date('Y-m-d'));
				if($today !== @$spinDate){
					$data['session_page_type']=8;
					$this->load->view('site/spin.php');	
				} else {
					$this->session->set_flashdata("error","Sorry, You already used Spin & Win today.  Come back tomorrow to spin again.");
					redirect();
				}
			}
			else{
				$data['session_page_type']=8;
				$this->load->view('site/spin.php');
			}
				
		} else {
			redirect('Login');
		}
	}
	
	
	public function getSpinJSON(){
		
		header('Content-type: application/json');
		
		$list  =  $this->SITEDBAPI->getSpinWheelSections();
		$spinArray = array();
		
		foreach($list as $row){
			$aa = array();
			$aa['id'] = $row['wheel_id'];
			$aa['type'] = "string";
			$aa['win'] = true;
			
			if( $row['wheel_type'] == 1){
				 $str = " COINS";
			}  else if( $row['wheel_type'] == 2){
				 $str = " MB DATA";
			}  else if( $row['wheel_type'] == 3){
				 $str = " GB DATA";
			}  else if( $row['wheel_type'] == 4){
				 $str = " RS. TALKTIME ";
			}
			
			$aa['value'] = $row['wheel_value'].$str;
			$aa['resultText'] = "YOU WON ".$row['wheel_value'].$str;
			array_push($spinArray, $aa);
		}
		
		$data = array(
		"colorArray" => array("#364C62", "#F1C40F", "#E67E22", "#E74C3C", "#98985A", "#95A5A6", "#16A085", "#27AE60", "#2980B9", "#8E44AD", "#2C3E50", "#F39C12", "#D35400", "#C0392B", "#BDC3C7","#1ABC9C", "#2ECC71", "#E87AC2", "#3498DB", "#9B59B6", "#7F8C8D"),

		"segmentValuesArray" => $spinArray,
		"svgWidth" => 1024,
		"svgHeight" => 768,
		"wheelStrokeColor" => "#3fd53f",
		"wheelStrokeWidth" => 18,
		"wheelSize" => 700,
		"wheelTextOffsetY" => 80,
		"wheelTextColor" => "#EDEDED",
		"wheelTextSize" => "2.2em",
		"wheelImageOffsetY" => 40,
		"wheelImageSize" => 50,
		"centerCircleSize" => 250,
		"centerCircleStrokeColor" => "#ffffff",
		"centerCircleStrokeWidth" => 12,
		"centerCircleFillColor" => "#efefef",
		"segmentStrokeColor" => "#E2E2E2",
		"segmentStrokeWidth" => 5,
		"centerX" => 512,
		"centerY" => 384,  
		"hasShadows" => false,
		"numSpins" => 1 ,
		"spinDestinationArray" => array(),
		"minSpinDuration" => 6,
		"gameOverText" => "COME BACK TOMORROW TO PLAY AGAIN!",
		"invalidSpinText" =>"INVALID SPIN. PLEASE SPIN AGAIN.",
		"introText" => "CLICK TO SPIN IT! ",
		"hasSound" => true,
		"gameId" => "9a0232ec06bc431114e2a7f3aea03bbe2164f1aa",
		"clickToSpin" => true

		);

		echo json_encode( $data);
	}
	
	
	public function processSpinWin($id){
		$userId = $this->session->userdata('userId');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		
		if( !empty($userInfo['user_id'])){	
			
			// Get Spin Wheel section info 
			$spinInfo = $this->SITEDBAPI->getSpinWheelInfo($id);
			
			$data['spin_user_id'] = $userId;
			$data['spin_date'] = date('Y-m-d');
			if($spinInfo['wheel_type'] == 1){
				$data['spin_reward'] = '1';  // 1=WinCoin   0=NoCoin
				$data['spin_coins'] = $spinInfo['wheel_value'];
			} else {
				$data['spin_reward'] = '0';
				$data['spin_coins'] = '0';
			}
				
			$data['spin_reward_type'] = $spinInfo['wheel_type'];  // 1=PlayCoins   2=Data-MB  3=Data-GB  4=TalkTime
			$data['spin_reward_value'] = $spinInfo['wheel_value'];  
			
			
			$data['spin_added_on'] = time();
			if($this->db->insert('user_spinwin', $data)){
				
				if($spinInfo['wheel_type'] == 1){
					// If User Wins Play Coins,   then Update the Play Coins in main Users table
					$playCoins = $userInfo['user_play_coins'];
					$updatedPlayCoins = $playCoins+$spinInfo['wheel_value'];
					$dataCoins['user_play_coins'] = $updatedPlayCoins;
					$this->db->where('user_id', $userId);
					$this->db->update('site_users', $dataCoins);
				}
				
				// Update a row for managing coins history				
				$coinHistory['coin_user_id'] = $userId;
				$coinHistory['coin_date'] = date('Y-m-d');				
				$coinHistory['coin_section'] = '2';  //1=AddCoins  2=SpinWin  3=RedeemRewardCoins  4=CreateTournament  5=TournamentReward
				
				// Create User Notificatio desc parameter
				$notifyDesc = '';
						
				if($spinInfo['wheel_type'] == 1){
					$coinHistory['coin_play_coins_add'] = $spinInfo['wheel_value'];
					$coinHistory['coin_type'] = '1';  // 1=PlayCoins  2=RewardCoins  3=Both
					
					$notifyDesc = "<b>{$spinInfo['wheel_value']} Coins</b> added to your account.";
					
				} else if($spinInfo['wheel_type'] == 2){
					$coinHistory['coin_data_pack_value'] = $spinInfo['wheel_value'];
					$coinHistory['coin_data_pack_unit'] = 'MB';
					$coinHistory['coin_type'] = '0';  
					
					$notifyDesc = "<b>{$spinInfo['wheel_value']} MB </b> data added to your account.";
				
				} else if($spinInfo['wheel_type'] == 3){
					$coinHistory['coin_data_pack_value'] = $spinInfo['wheel_value'];
					$coinHistory['coin_data_pack_unit'] = 'GB';
					$coinHistory['coin_type'] = '0'; 
					
					$notifyDesc = "<b>{$spinInfo['wheel_value']} GB </b> data added to your account.";
				
				} else if($spinInfo['wheel_type'] == 4){
					$coinHistory['coin_talk_time_value'] = $spinInfo['wheel_value'];
					$coinHistory['coin_type'] = '0'; 
					
					$notifyDesc = "<b> {$spinInfo['wheel_value']} Rs. </b> recharge done on your account.";
				}
				$coinHistory['coin_added_on'] = time();
				$this->db->insert('user_coins_history', $coinHistory);
				
				//Save User Notification
				$this->saveUserNotification($type='2', $notifyDesc);
				
				
				//$this->session->set_flashdata("success","$coins coins added to your account successfully.");
				redirect();
			} else {
				$this->session->set_flashdata("error","Something went wrong. Please try again after sometime.");
				redirect();
			}
			
		} else {
			redirect('Login');
		}
	}
	
	public function processSpinWinAjax($id){
		$userId = $this->session->userdata('userId');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		
		if( !empty($userInfo['user_id'])){	
			
			// Get Spin Wheel section info 
			$spinInfo = $this->SITEDBAPI->getSpinWheelInfo($id);
			
			$data['spin_user_id'] = $userId;
			$data['spin_date'] = date('Y-m-d');
			if($spinInfo['wheel_type'] == 1){
				$data['spin_reward'] = '1';  // 1=WinCoin   0=NoCoin
				$data['spin_coins'] = $spinInfo['wheel_value'];
			} else {
				$data['spin_reward'] = '0';
				$data['spin_coins'] = '0';
			}
				
			$data['spin_reward_type'] = $spinInfo['wheel_type'];  // 1=PlayCoins   2=Data-MB  3=Data-GB  4=TalkTime
			$data['spin_reward_value'] = $spinInfo['wheel_value'];  
			
			
			$data['spin_added_on'] = time();
			if($this->db->insert('user_spinwin', $data)){
				
				if($spinInfo['wheel_type'] == 1){
					// If User Wins Play Coins,   then Update the Play Coins in main Users table
					$playCoins = $userInfo['user_play_coins'];
					$updatedPlayCoins = $playCoins+$spinInfo['wheel_value'];
					$dataCoins['user_play_coins'] = $updatedPlayCoins;
					$this->db->where('user_id', $userId);
					$this->db->update('site_users', $dataCoins);
				}
				
				// Update a row for managing coins history				
				$coinHistory['coin_user_id'] = $userId;
				$coinHistory['coin_date'] = date('Y-m-d');				
				$coinHistory['coin_section'] = '2';  //1=AddCoins  2=SpinWin  3=RedeemRewardCoins  4=CreateTournament  5=TournamentReward
				
				// Create User Notificatio desc parameter
				$notifyDesc = '';
				
				
				if($spinInfo['wheel_type'] == 1){
					$coinHistory['coin_play_coins_add'] = $spinInfo['wheel_value'];
					$coinHistory['coin_type'] = '1';  // 1=PlayCoins  2=RewardCoins  3=Both
					
					$notifyDesc = "<b>{$spinInfo['wheel_value']} Coins</b> added to your account.";
					
				} else if($spinInfo['wheel_type'] == 2){
					$coinHistory['coin_data_pack_value'] = $spinInfo['wheel_value'];
					$coinHistory['coin_data_pack_unit'] = 'MB';
					$coinHistory['coin_type'] = '0';  
					
					$notifyDesc = "<b>{$spinInfo['wheel_value']} MB </b> data added to your account.";
					
				} else if($spinInfo['wheel_type'] == 3){
					$coinHistory['coin_data_pack_value'] = $spinInfo['wheel_value'];
					$coinHistory['coin_data_pack_unit'] = 'GB';
					$coinHistory['coin_type'] = '0';
	
					$notifyDesc = "<b>{$spinInfo['wheel_value']} GB </b> data added to your account.";
					
				} else if($spinInfo['wheel_type'] == 4){
					$coinHistory['coin_talk_time_value'] = $spinInfo['wheel_value'];
					$coinHistory['coin_type'] = '0'; 
					
					$notifyDesc = "<b> {$spinInfo['wheel_value']} Rs. </b> recharge done on your account.";
					
				}
				$coinHistory['coin_added_on'] = time();
				$this->db->insert('user_coins_history', $coinHistory);
				
				
				//Save User Notification
				$this->saveUserNotification($type='2', $notifyDesc);
				
				
				echo "success";
				
			} else {
				$this->session->set_flashdata("error","Something went wrong. Please try again after sometime.");
				redirect();
			}
			
		} else {
			redirect('Login');
		}
	}
	
// *****************************   **************************** ********************************** //
// *****************************   Manage Spin & Win  Ends Here ********************************** //
// *****************************   **************************** ********************************** //



	
// *****************************   **************************** ********************************** //
// *****************************   Manage Notifications Starts Here ********************************** //
// *****************************   **************************** ********************************** //
	public function manageNotifications(){
		$userId = $this->session->userdata('userId');
		if(!empty($userId) ){
			$updateRead['notify_status'] = '1';
			$this->db->where('notify_user_id', $userId);
			$this->db->update('user_notifications', $updateRead);
			$data['list'] = $this->SITEDBAPI->getUserNotifications($userId);
			$data['session_page_type']=14;
			$this->load->view('site/notifications', $data);
		} else {
			redirect('Login');
		}
	}
		
	
	public function deleteNotification($id){
		$userId = $this->session->userdata('userId');
		if(!empty($userId) ){
			$notify_id =base64_decode($id);
			
			$this->db->where('notify_id', $notify_id);
			$this->db->where('notify_user_id', $userId);
			if($this->db->delete('user_notifications')){
				redirect('Notifications');
			} else {
				redirect('Notifications');
			}
			
		} else {
			redirect('Login');
		}
	}
		
	
	public function clearNotifications(){
		$userId = $this->session->userdata('userId');
		if(!empty($userId) ){
			
			$this->db->where('notify_user_id', $userId);
			if($this->db->delete('user_notifications')){
				
				redirect('Notifications');
			} else {
				redirect('Notifications');
			}
			
		} else {
			redirect('Login');
		}
	}
		
	
	public function saveUserNotification($type, $notifyDesc='', $winner_user_id =''){
		$userId = $this->session->userdata('userId');
		if(!empty($userId) &&  !empty($type)){
			
			if($type == '1'){
				// Tournament Joined
				$notifyData['notify_user_id'] =  $userId;
				$notifyData['notify_type'] =  '1';
				$notifyData['notify_title'] =  "Tournament Joined";
				$notifyData['notify_desc'] = $notifyDesc;
				$notifyData['notify_status'] =  '0';
				$notifyData['notify_date'] =  date('Y-m-d');
				$notifyData['notify_added_on'] =  time();
				
				$this->db->insert('user_notifications', $notifyData);
				
			} else if($type == '2'){
				
				// Spin & Win Reward 
				$notifyData['notify_user_id'] =  $userId;
				$notifyData['notify_type'] =  '2';
				$notifyData['notify_title'] =  "Spin & Win Reward";
				$notifyData['notify_desc'] =  $notifyDesc;
				$notifyData['notify_status'] =  '0';
				$notifyData['notify_date'] =  date('Y-m-d');
				$notifyData['notify_added_on'] =  time();
				
				$this->db->insert('user_notifications', $notifyData);
				
			} else if($type == '3'){
				
				// Spin & Win Reward 
				$notifyData['notify_user_id'] =  $userId;
				$notifyData['notify_type'] =  '3';
				$notifyData['notify_title'] =  "Redeem Coins";
				$notifyData['notify_desc'] =  $notifyDesc;
				$notifyData['notify_status'] =  '0';
				$notifyData['notify_date'] =  date('Y-m-d');
				$notifyData['notify_added_on'] =  time();
				
				$this->db->insert('user_notifications', $notifyData);
			
			} else if($type == '4'){
				if(!empty($winner_user_id)){
					// Tournament Reward 
					$notifyData['notify_user_id'] =  $winner_user_id;
					$notifyData['notify_type'] =  '4';
					$notifyData['notify_title'] =  "Tournament Reward";
					$notifyData['notify_desc'] =  $notifyDesc;
					$notifyData['notify_status'] =  '0';
					$notifyData['notify_date'] =  date('Y-m-d');
					$notifyData['notify_added_on'] =  time();
					
					$this->db->insert('user_notifications', $notifyData);
				}
				
			} else if($type == '5'){
				
				// Update profile name or email
				$notifyData['notify_user_id'] =  $userId;
				$notifyData['notify_type'] =  '5';  //1=TournamentCreated   2=Spin&Win   3=RedeemCoins   4=TournamentRewardAdded   5=UpdateProfileName    6=SubscriptionCoins   7=RewardAdded  8=RewardClaimed  9=VoucherExpired

				$notifyData['notify_title'] =  "Profile Settings";
				$notifyData['notify_desc'] =  $notifyDesc;
				$notifyData['notify_status'] =  '0';
				$notifyData['notify_date'] =  date('Y-m-d');
				$notifyData['notify_added_on'] =  time();
				$this->db->insert('user_notifications', $notifyData);
				
			} else if($type == '6'){
				
				// Update profile verify email
				$notifyData['notify_user_id'] =  $userId;
				$notifyData['notify_type'] =  '6';
				$notifyData['notify_title'] =  "Profile Settings";
				$notifyData['notify_desc'] =  $notifyDesc;
				$notifyData['notify_status'] =  '0';
				$notifyData['notify_date'] =  date('Y-m-d');
				$notifyData['notify_added_on'] =  time();
				
				$this->db->insert('user_notifications', $notifyData);
				
			}
			
		} 
		
	} 
		
// *****************************   **************************** ********************************** //
// *****************************   Manage Notifications Ends Here ********************************** //
// *****************************   **************************** ********************************** //


	
// *****************************   **************************** ********************************** //
// *****************************   Custom Tournaments Starts Here ********************************** //
// *****************************   **************************** ********************************** //


	public function createTournament()	{
		$this->load->view('site/create_tournament');
	}

	public function tournamentStep1()	{
		$userId = $this->session->userdata('userId');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		$data['gamesList'] = $this->SITEDBAPI->getPublishedPTGames();
		if(!empty($userInfo['user_id']) && $userInfo['user_subscription']==0)
		{
			if($userInfo['user_free_custom_tournaments']>0)
			$this->load->view('site/tournament_step_1', $data);
			else
			{
				$this->session->set_flashdata('less_custom_tournament' , "Sorry ,You are not a VIP user. So,  you can not create more tournament. ");
				redirect();
			}
		}
			
		else if( !empty($userInfo['user_id']) && $userInfo['user_play_coins'] > 100){
			$this->load->view('site/tournament_step_1', $data);
		} else {
			$this->session->set_flashdata("less_play_coins","Sorry, You don't have enough play coins to create a new tournament.");
			redirect();
		}
	}

	public function searchGameByName()	{
		$txt = $_POST['txt'];
		$data['gamesList'] = $this->SITEDBAPI->searchPTGameByName($txt);
		$this->load->view('site/tournament_search_result', $data);
	}

	public function tournamentStep2($gameId){
		$gameId =  base64_decode($gameId);
		$this->session->set_userdata('gameId', $gameId);
		$data['gameId'] = $gameId;
		$data['gameInfo'] = $this->SITEDBAPI->getGameInfo($gameId);
		$this->load->view('site/tournament_step_2', $data);
	}

	public function saveTournamentTimings(){
		$start_day =  $_POST['start_day'];
		$start_date = date('Y-m-d');
		if($start_day == 'tomorrow'){
			$start_date = date("Y-m-d", strtotime("+ 1 day"));
		}

		$this->session->set_userdata('startDay', $_POST['start_day']);
		$this->session->set_userdata('startDate', $start_date);
		$this->session->set_userdata('duration', $_POST['duration']);
		$this->session->set_userdata('exactHour', $_POST['exact_hour']);
		$this->session->set_userdata('exactMinutes', $_POST['exact_minutes']);
		$this->session->set_userdata('exactAmpm', $_POST['exact_ampm']);
		echo 'success';
	}

	public function tournamentStep3($gameId){
		$gameId =  base64_decode($gameId);
		$data['gameId'] = $gameId;
		$data['start_day'] = $this->session->userdata('startDay');
		$data['start_date'] = $this->session->userdata('startDate');
		$data['duration'] = $this->session->userdata('duration');
		$data['exact_hour'] = $this->session->userdata('exactHour');
		$data['exact_minutes'] = $this->session->userdata('exactMinutes');
		$data['exact_ampm'] = $this->session->userdata('exactAmpm');
		$data['gameInfo'] = $this->SITEDBAPI->getGameInfo($gameId);

		/* Get tournament timings */
		 	$startDate = $this->session->userdata('startDate');

			$duration = $this->session->userdata('duration');
			$exactHour = $this->session->userdata('exactHour');
			$exactMinutes = $this->session->userdata('exactMinutes');
		 	$exactAmpm = $this->session->userdata('exactAmpm');

			$timings = $this->calculateTournamentTimings($startDate, $duration, $exactHour, $exactMinutes, $exactAmpm);
			$data['t_end_date'] = $timings['end_date'];
			$data['t_end_time'] = $timings['end_time'];

		/* Get tournament timings ends */

		$this->load->view('site/tournament_step_3', $data);
	}

	public function saveTournamentDetails(){

		$userId = $this->session->userdata('userId');
		// $result=$this->SITEDBAPI->getSiteUserDetail($userId);

		$gameId = $this->session->userdata('gameId');
		$startDay = $this->session->userdata('startDay');
		$startDate = $this->session->userdata('startDate');
		$duration = $this->session->userdata('duration');
		$exactHour = $this->session->userdata('exactHour');
		$exactMinutes = $this->session->userdata('exactMinutes');
		$exactAmpm = $this->session->userdata('exactAmpm');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		$playersCount = $_POST['players_count'];
		$entryFee = $_POST['entry_fee'];
		$prizeType = $_POST['prize_type'];
		$this->session->set_userdata('playersCount' ,$playersCount);
		$this->session->set_userdata('entryFee' ,$entryFee);
		$this->session->set_userdata('prizeType' ,$prizeType);
		if($userInfo['user_subscription']!=1)
			{
				if($userInfo['user_free_custom_tournaments']>0)
				{
					$free_tournament = $userInfo['user_free_custom_tournaments'];
					$tournament['user_free_custom_tournaments'] = ($free_tournament - 1);
					$this->db->where('user_id', $userId);
					$this->db->update('site_users', $tournament);
				}
				else{
					$this->session->set_userdata('user_tournament' , true);
					$redirectLink = site_url()."UserSubscription";
					return print_r($redirectLink);
				}
			}
		// Get the game info from master table
		$gameInfo = $this->SITEDBAPI->getGameInfo($gameId);
		$gplGameId = $gameInfo['id'];
		$gplGameName = $gameInfo['Name'];
		$gplGameImage = $gameInfo['GameImage'];
		$gplGameCategory = $gameInfo['Category'];
		$gplGameScreen = $gameInfo['screen'];

		// Calculate the timings of the tournament
		$timings = $this->calculateTournamentTimings($startDate, $duration, $exactHour, $exactMinutes, $exactAmpm);


		//Set start time in 24 hour format for tournament start time
		if($exactAmpm == 'PM' && $exactHour == 12)
			$exactHour= $exactHour;
		else if($exactAmpm == 'PM')
			$exactHour= $exactHour+12;


		$save['t_user_id'] = $userId;
		$save['t_game_gid'] = $gameId;
		$save['t_game_id'] = $gplGameId;
		$save['t_game_name'] = $gplGameName;
		$save['t_game_image'] = $gplGameImage;
		$save['t_game_category'] = $gplGameCategory;
		$save['t_game_screen'] = $gplGameScreen;
		$save['t_start_day'] = $startDay;

		$save['t_duration'] = $duration;
		$save['t_exact_hour'] = $exactHour;
		$save['t_exact_minutes'] = $exactMinutes;
		$save['t_exact_ampm'] = $exactAmpm;
		$save['t_start_date'] = $startDate;
		$save['t_start_time'] = $exactHour.":".$exactMinutes;
		$save['t_end_date'] = $timings['end_date'];
		$save['t_end_time'] = $timings['end_time'];

		$save['t_players_count'] = $playersCount;
		$save['t_entry_fee'] = $entryFee;
		$save['t_prize_type'] = $prizeType;

		$share_code = $this->createShareCode(10);   // 10 specifies string lenth here
		$share_code = strtoupper($share_code);
		$sharelink = site_url()."SHARE/".base64_encode($share_code);
		$save['t_share_code'] = $share_code;
		$save['t_share_link'] = $sharelink;

		$save['t_added_on'] = time();

		if($this->db->insert('user_tournaments', $save)){
			$tournamentId = $this->db->insert_id();

			$savePlayer['player_t_id'] = $tournamentId;
			$savePlayer['player_user_id'] = $userId;
			$savePlayer['player_score'] = 0;
			$savePlayer['player_type'] = '1';
			$savePlayer['player_added_on'] = time();
			$this->db->insert('user_tournament_players', $savePlayer);
			
			
				// Deduct the 100 Play Coins from user Total coins
			if($userInfo['user_subscription']==1)
			{
				$userInfo = $this->SITEDBAPI->validateUser($userId);
				$playCoins = $userInfo['user_play_coins'];
				$updatedPlayCoins = ($playCoins-100);
				$dataCoins['user_play_coins'] = $updatedPlayCoins;
				$this->db->where('user_id', $userId);
				$this->db->update('site_users', $dataCoins);
				
				// Update a row for managing coins history				
				$coinHistory['coin_user_id'] = $userId;
				$coinHistory['coin_date'] = date('Y-m-d');				
				$coinHistory['coin_section'] = '4';  //1=AddCoins  2=SpinWin  3=RedeemRewardCoins  4=CreateTournament  5=TournamentReward
				$coinHistory['coin_play_coins_add'] = '-'.$entryFee;
				$coinHistory['coin_play_coins_redeem'] = $entryFee;
				$coinHistory['coin_tournament_id'] = $tournamentId;
				$coinHistory['coin_type'] = '1';  // 1=PlayCoins  2=RewardCoins  3=Both
				$coinHistory['coin_added_on'] = time();
				$this->db->insert('user_coins_history', $coinHistory);
			}
				//Save User Notification
				$this->saveUserNotification($type='1');
				
			$redirectLink = site_url()."Tournaments/".base64_encode($tournamentId);

			echo $redirectLink;
		} else {
			echo '0';
		}

	}

	public function saveTournament(){
		$userId = $this->session->userdata('userId');
		$gameId = $this->session->userdata('gameId');
		$startDay = $this->session->userdata('startDay');
		$startDate = $this->session->userdata('startDate');
		$duration = $this->session->userdata('duration');
		$exactHour = $this->session->userdata('exactHour');
		$exactMinutes = $this->session->userdata('exactMinutes');
		$exactAmpm = $this->session->userdata('exactAmpm');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		$playersCount = $this->session->userdata('playersCount');
		$entryFee = $this->session->userdata('entryFee');
		$prizeType =$this->session->userdata('prizeType');
		$this->session->set_userdata('playersCount' ,$playersCount);
		$this->session->set_userdata('entryFee' ,$entryFee);
		$this->session->set_userdata('prizeType' ,$prizeType);
		if($userInfo['user_subscription']!=1)
			{
				if($userInfo['user_free_custom_tournaments']>0)
				{
					$free_tournament = $userInfo['user_free_custom_tournaments'];
					$tournament['user_free_custom_tournaments'] = ($free_tournament - 1);
					$this->db->where('user_id', $userId);
					$this->db->update('site_users', $tournament);
				}
				else{
					$this->session->set_userdata('user_tournament' , true);
					$redirectLink = site_url()."UserSubscription";
					return print_r($redirectLink);
				}
			}
		// Get the game info from master table
		$gameInfo = $this->SITEDBAPI->getGameInfo($gameId);
		$gplGameId = $gameInfo['id'];
		$gplGameName = $gameInfo['Name'];
		$gplGameImage = $gameInfo['GameImage'];
		$gplGameCategory = $gameInfo['Category'];
		$gplGameScreen = $gameInfo['screen'];

		// Calculate the timings of the tournament
		$timings = $this->calculateTournamentTimings($startDate, $duration, $exactHour, $exactMinutes, $exactAmpm);


		//Set start time in 24 hour format for tournament start time
		if($exactAmpm == 'PM' && $exactHour == 12)
			$exactHour= $exactHour;
		else if($exactAmpm == 'PM')
			$exactHour= $exactHour+12;


		$save['t_user_id'] = $userId;
		$save['t_game_gid'] = $gameId;
		$save['t_game_id'] = $gplGameId;
		$save['t_game_name'] = $gplGameName;
		$save['t_game_image'] = $gplGameImage;
		$save['t_game_category'] = $gplGameCategory;
		$save['t_game_screen'] = $gplGameScreen;
		$save['t_start_day'] = $startDay;

		$save['t_duration'] = $duration;
		$save['t_exact_hour'] = $exactHour;
		$save['t_exact_minutes'] = $exactMinutes;
		$save['t_exact_ampm'] = $exactAmpm;
		$save['t_start_date'] = $startDate;
		$save['t_start_time'] = $exactHour.":".$exactMinutes;
		$save['t_end_date'] = $timings['end_date'];
		$save['t_end_time'] = $timings['end_time'];

		$save['t_players_count'] = $playersCount;
		$save['t_entry_fee'] = $entryFee;
		$save['t_prize_type'] = $prizeType;

		$share_code = $this->createShareCode(10);   // 10 specifies string lenth here
		$share_code = strtoupper($share_code);
		$sharelink = site_url()."SHARE/".base64_encode($share_code);
		$save['t_share_code'] = $share_code;
		$save['t_share_link'] = $sharelink;

		$save['t_added_on'] = time();

		if($this->db->insert('user_tournaments', $save)){
			$tournamentId = $this->db->insert_id();

			$savePlayer['player_t_id'] = $tournamentId;
			$savePlayer['player_user_id'] = $userId;
			$savePlayer['player_score'] = 0;
			$savePlayer['player_type'] = '1';
			$savePlayer['player_added_on'] = time();
			$this->db->insert('user_tournament_players', $savePlayer);
				
				//Save User Notification
				$this->saveUserNotification($type='1');
				
			$redirectLink = site_url()."Tournaments/".base64_encode($tournamentId);

			echo $redirectLink;
		} else {
			echo '0';
		}

	}


	function calculateTournamentTimings($startDate, $duration, $exactHour, $exactMinutes, $exactAmpm){
        if(empty($duration)){
			$duration = '24';
		}
			$start = "{$startDate} {$exactHour}:{$exactMinutes} {$exactAmpm}";

			$end_date = date('Y-m-d',strtotime("+{$duration} hours ",strtotime($start)));
			$end_time = date('H:i',strtotime("+{$duration} hours ",strtotime($start)));
		    $timings['end_date'] = $end_date;
		    $timings['end_time'] = $end_time;
		    return $timings;
	}

	public function tournamentInfo($id){
		$id = base64_decode($id);

		// Get tournament info
		$data['tournamentInfo'] = $this->SITEDBAPI->getTournamentInfo($id);
		$data['playersInfo'] = $this->SITEDBAPI->getTournamentPlayersListDESC($id);

		$today = time();

		$startDate = $data['tournamentInfo']['t_start_date']." ".$data['tournamentInfo']['t_start_time'].":00";
		$startDate = strtotime($startDate);

		$endDate = $data['tournamentInfo']['t_end_date']." ".$data['tournamentInfo']['t_end_time'].":00";
	 	$endDate = strtotime($endDate);

		$status = 0;     //1=CurrentlyWorking   2=Expired   3=futureTournament
		if($startDate > $today){
			$status = 3;
		} else if($endDate < $today){
			$status = 2;
		} else if($startDate <= $today && $endDate >= $today){
			$status = 1;
		}
		$data['t_current_status'] = $status;
		// Compare dates of tournaments for the status  ends
		if(is_array($data['tournamentInfo']) && count($data['tournamentInfo'])>0){
			$data['session_page_type']=13;
		    $data['session_game_id']=$data['tournamentInfo']['t_game_gid'];
			$data['session_tournament_id']=$data['tournamentInfo']['t_id'];
			$this->load->view('site/tournament_info', $data);
		}else{
			redirect();
		}

	}


// Custom Tournaments created with banner click for users

	public function customTournament($gameId)	{
		$userId = $this->session->userdata('userId');
		$userInfo = $this->SITEDBAPI->validateUser($userId);
		if(!empty($userInfo['user_id']) && $userInfo['user_subscription']==0)
		{
			if($userInfo['user_free_custom_tournaments']>0)
			{
				$startDay =  'today';
				$startDate = date('Y-m-d');
				$duration = '24';
				$exactHour = date('h');
				if($exactHour >= 12)
					$exactHour = 0;
				$exactHour = $exactHour+1;
				$exactMinutes = "00";
				$exactAmpm = date('A');
	
				// Save the details in session to go back  7 further
				$this->session->set_userdata('gameId', $gameId);
				$this->session->set_userdata('startDay', $startDay);
				$this->session->set_userdata('startDate', $startDate);
				$this->session->set_userdata('duration', $duration);
				$this->session->set_userdata('exactHour', $exactHour);
				$this->session->set_userdata('exactMinutes', $exactMinutes);
				$this->session->set_userdata('exactAmpm', $exactAmpm);
	
				// Get tournament end time
				$timings = $this->calculateTournamentTimings($startDate, $duration, $exactHour, $exactMinutes, $exactAmpm);
	
	
				$data['gameId'] = $gameId;
				$data['start_day'] = $startDay;
				$data['start_date'] = $startDate;	
				
				$data['duration'] = $duration;
				$data['exact_hour'] = $exactHour;
				$data['exact_minutes'] = $exactMinutes;
				$data['exact_ampm'] = $exactAmpm;
				$data['t_end_date'] = $timings['end_date'];
				$data['t_end_time'] = $timings['end_time'];
			
				$data['gameInfo'] = $this->SITEDBAPI->getGameInfo($gameId);
	             $data['session_page_type']=12;
				$data['session_game_id']=$data['gameInfo']['gid'];
				$this->load->view('site/tournament_step_3', $data);	
			}
			else
			{
				$this->session->set_flashdata('less_custom_tournament' , "Sorry ,You are not a VIP user. So,  you can not create more tournament. ");
				redirect();
			}
		}
		else if( !empty($userInfo['user_id']) && $userInfo['user_play_coins'] > 100){

			$startDay =  'today';
			$startDate = date('Y-m-d');
			$duration = '24';
			$exactHour = date('h');
			if($exactHour >= 12)
				$exactHour = 0;
			$exactHour = $exactHour+1;
			$exactMinutes = "00";
			$exactAmpm = date('A');

			// Save the details in session to go back  7 further
			$this->session->set_userdata('gameId', $gameId);
			$this->session->set_userdata('startDay', $startDay);
			$this->session->set_userdata('startDate', $startDate);
			$this->session->set_userdata('duration', $duration);
			$this->session->set_userdata('exactHour', $exactHour);
			$this->session->set_userdata('exactMinutes', $exactMinutes);
			$this->session->set_userdata('exactAmpm', $exactAmpm);

			// Get tournament end time
			$timings = $this->calculateTournamentTimings($startDate, $duration, $exactHour, $exactMinutes, $exactAmpm);


			$data['gameId'] = $gameId;
			$data['start_day'] = $startDay;
			$data['start_date'] = $startDate;	
			
			$data['duration'] = $duration;
			$data['exact_hour'] = $exactHour;
			$data['exact_minutes'] = $exactMinutes;
			$data['exact_ampm'] = $exactAmpm;
			$data['t_end_date'] = $timings['end_date'];
			$data['t_end_time'] = $timings['end_time'];
		
			$data['gameInfo'] = $this->SITEDBAPI->getGameInfo($gameId);
            $data['session_page_type']=12;
			$data['session_game_id']=$data['gameInfo']['gid'];
			$this->load->view('site/tournament_step_3', $data);
		} else {
			$this->session->set_flashdata("redemption_error","Sorry, You don't have enough play coins to create a new tournament.");
			redirect();
		}

	}



	public function sharedTournamentInfo($share_code){
		if(!empty($share_code)){
			$share_code = base64_decode($share_code);
			$data['tournamentInfo'] = $this->SITEDBAPI->getSharedTournamentInfo($share_code);
			if(is_array($data['tournamentInfo']) && count($data['tournamentInfo'])>0){
				$this->session->set_userdata('tournament_share_code', $share_code);
				$this->load->view('site/share_login');
			} else {
				redirect();
			}
		} else {
			redirect();
		}
	}
	
// *******************   Custom Tournaments ends  *********************************  //



	public function sendEmailOTP(){
		$email = $_POST['email'];
		if(!empty($email)){

			// Sanitize E-mail Address
			$email =filter_var($email, FILTER_SANITIZE_EMAIL);
			// Validate E-mail Address
			$email= filter_var($email, FILTER_VALIDATE_EMAIL);
			if($email){

					$otp = $this->createOTP(6);

					$row['content']='';
					$row['content'] .= "<p> <br> <b>{$otp}</b> is the One Time Password (OTP) to login and play your Private Tournament. Do not share the OTP with anyone. </p>";
					$row['content'] .= "<p><br><br> <b>IMPORTANT</b>: Please do not reply to this message or mail address.</p>";
					$row['content'] .= "<p><b>DISCLAIMER</b>: This communication is confidential and privileged and is directed to and for the use of the addressee only. The recipient if not the addressee should not use this message if erroneously received, and access and use of this e-mail in any manner by anyone other than the addressee is unauthorized.</p>";
			
					$row['subject'] = "Your GSL Login OTP";
					
				// Enable this when shift to live server
					
					$this->load->library("PhpMailerLib");
					$mail = $this->phpmailerlib->load();
					
					try {
						//Server settings
						$mail->SMTPDebug = 0;                                 // Enable verbose debug output
						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
					//	$mail->Username = 'gpl.gamenow@gmail.com';                 // SMTP username
					//	$mail->Password = 'gpl@123*';                           // SMTP password
						$mail->Username = 'adxdigitalsg@gmail.com';                 // SMTP username
						$mail->Password = 'adxd@123';                           // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 465;                                    // TCP port to connect to
						//Recipients
						$mail->setFrom('adxdigitalsg@gmail.com', 'GSL');
						$mail->addAddress($email);     // Add a recipient
						$mail->addReplyTo('adxdigitalsg@gmail.com', 'GSL');
						$mail->addBCC('vaish.nisha55@gmail.com');

						//Content
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = $row['subject'];
						$mail->Body    = $row['content'];
					
						$mail->send();
						$this->session->set_flashdata('success','<strong>Success! </strong> OTP request sent on the specified email address.');

						$this->session->set_userdata('person_email', $email);
						$this->session->set_userdata('person_otp', $otp);
						redirect('verifyOTP/'.$otp);
						
					} catch (Exception $e) {
						$this->session->set_flashdata('error','<strong>Error! </strong> Unable to send OTP request to your specified email address. Please try again.');
						$shareCode = $this->session->userdata('tournament_share_code');
						$shareCode = base64_encode($shareCode);
						redirect("SHARE/".$shareCode);
					}
					
			}	else {
				redirect();
			}
		} else {
			redirect();
		}
	}
	
	
	public function resendEmailOTP($email =''){
		$email = base64_decode($email);
		if(!empty($email)){

			// Sanitize E-mail Address
			$email =filter_var($email, FILTER_SANITIZE_EMAIL);
			// Validate E-mail Address
			$email= filter_var($email, FILTER_VALIDATE_EMAIL);
			if($email){

					$otp = $this->createOTP(6);

				
					$row['content']='';
					$row['content'] .= "<p> <br> <b>{$otp}</b> is the One Time Password (OTP) to login and play your Private Tournament. Do not share the OTP with anyone. </p>";
					$row['content'] .= "<p><br><br> <b>IMPORTANT</b>: Please do not reply to this message or mail address.</p>";
					$row['content'] .= "<p><b>DISCLAIMER</b>: This communication is confidential and privileged and is directed to and for the use of the addressee only. The recipient if not the addressee should not use this message if erroneously received, and access and use of this e-mail in any manner by anyone other than the addressee is unauthorized.</p>";
					
					$row['subject'] = "Your GSL Login OTP";
					
					
					
				// Enable this when shift to live server
					
					$this->load->library("PhpMailerLib");
					$mail = $this->phpmailerlib->load();
					
					try {
						//Server settings
						$mail->SMTPDebug = 0;                                 // Enable verbose debug output
						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						
						$mail->Username = 'adxdigitalsg@gmail.com';                 // SMTP username
						$mail->Password = 'adxd@123';                           // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 465;                                    // TCP port to connect to
						//Recipients
						$mail->setFrom('adxdigitalsg@gmail.com', 'GSL');
						$mail->addAddress($email);     // Add a recipient
						$mail->addReplyTo('adxdigitalsg@gmail.com', 'GSL');
						$mail->addBCC('vaish.nisha55@gmail.com');

						//Content
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = $row['subject'];
						$mail->Body    = $row['content'];
					
						$mail->send();
						$this->session->set_flashdata('success','<strong>Success! </strong> OTP request sent on the specified email address.');

						$this->session->set_userdata('person_email', $email);
						$this->session->set_userdata('person_otp', $otp);
						redirect('verifyOTP');
						
					} catch (Exception $e) {
						$this->session->set_flashdata('error','<strong>Error! </strong> Unable to send OTP request to your specified email address. Please try again.');
						$shareCode = $this->session->userdata('tournament_share_code');
						$shareCode = base64_encode($shareCode);
						redirect("SHARE/".$shareCode);
					}
					
			}	else {
				redirect();
			}
		} else {
			redirect();
		}
	}
	
	
	public function verifyOTP(){
		$shareCode = $this->session->userdata('tournament_share_code');
		$personEmail = $this->session->userdata('person_email');
		$personOTP = $this->session->userdata('person_otp');
		$this->load->view('site/verify_login_otp');
	}

	public function confirmEmailOTP(){
		$shareCode = $this->session->userdata('tournament_share_code');
		$personEmail = $this->session->userdata('person_email');
		$personOTP = $this->session->userdata('person_otp');
		$otp = $_POST['otp'];

		if(!empty($otp) && $otp == $personOTP){

			$checkEmail = $this->SITEDBAPI->checkUserByEmail($personEmail);
			if(is_array($checkEmail) && count($checkEmail)>0){
				// already registered email address
				$userId = $checkEmail['user_id'];
				$this->session->set_userdata('userId', $userId);

				if(empty($checkEmail['skillpod_player_id'])){
					// Create  Skillpod id on gameboost for playing the games
					$this->createGameboostId($userId, $personEmail);
				}
				
				$this->session->unset_userdata('person_email');
				$this->session->unset_userdata('person_otp');


				// user verified successflly now resend the user to the tournament page
				redirect('TournamentInfo/'.base64_encode($shareCode));

			} else {
				$profileImage = rand(1,32);
				if(!empty($profileImage)){
					$profileImage = $profileImage.".png";
				} else {
					$profileImage = 'default-user.png';
				}
				// a non registered email address
				$dataUser['user_email'] = $personEmail;
				$dataUser['user_login_otp'] = $personOTP;
				//$dataUser['user_image'] = 'default-user.png';
				$dataUser['user_image'] = $profileImage;
				$dataUser['user_registered_on'] = date('Y-m-d H:i:s');
				if($this->db->insert('site_users', $dataUser)){

					$userId = $this->db->insert_id();
					$this->session->set_userdata('userId', $userId);

					$this->session->unset_userdata('person_email');
					$this->session->unset_userdata('person_otp');
					
					// Create  Skillpod id on gameboost for playing the games
					$this->createGameboostId($userId, $personEmail);
					
					// user verified successflly now resend the user to the tournament page
					redirect('TournamentInfo/'.base64_encode($shareCode));

				} else{
					$this->session->set_flashdata('error','<strong>Error! </strong> Unable to verify your email address. Please try again after sometime.');
					redirect('verifyOTP');
				}

			}
		} else {
			$this->session->set_flashdata('error','<strong>Error! </strong> Invalid OTP entered. Please enter a valid OTP sent on your email address.');
			redirect('verifyOTP');
		}
	}

	public function friendTournamentInfo($shareCode){
		$shareCode = base64_decode($shareCode); 
		$userId = $this->session->userdata('userId');
		if(!empty($shareCode) && !empty($userId) ){
		
			// Get tournament info
			$data['tournamentInfo'] = $this->SITEDBAPI->getSharedTournamentInfo($shareCode);
			
			
			if(is_array($data['tournamentInfo']) && count($data['tournamentInfo'])>0){
				
				$t_id = $data['tournamentInfo']['t_id'];
				$data['playersInfo'] = $this->SITEDBAPI->getTournamentPlayersListDESC($t_id);

				// $today = date('Y-m-d H:i:s');
					$today = time();

					$startDate = $data['tournamentInfo']['t_start_date']." ".$data['tournamentInfo']['t_start_time'].":00";
					$startDate = strtotime($startDate);

					$endDate = $data['tournamentInfo']['t_end_date']." ".$data['tournamentInfo']['t_end_time'].":00";
					$endDate = strtotime($endDate);

					$status = 0;     //1=CurrentlyWorking   2=Expired   3=futureTournament
					if($startDate > $today){
						$status = 3;
					} else if($endDate < $today){
						$status = 2;
					} else if($startDate <= $today && $endDate >= $today){
						$status = 1;
					}
				$data['t_current_status'] = $status;
				// Compare dates of tournaments for the status  ends
				
				
				$total_players_count = $data['tournamentInfo']['t_players_count']+1;
				$joined_players_count = $data['tournamentInfo']['no_players'];
				if($joined_players_count < $total_players_count) {				
					$data['player_availability'] = 'yes';
				} else {
					$data['player_availability'] = 'no';
				}

				if($data['t_current_status'] == 2){
					$this->load->view('site/tournament_expired', $data);
				} else {
					$this->load->view('site/friend_tournament_info', $data);
				}
			
			} else{
				redirect();
			}		
		} else {
			redirect();
		}

	}


	public function joinTournament($id){
		 $id = base64_decode($id); 
		//get loggedin  user id
		$userId = $this->session->userdata('userId');
		if(!empty($userId) && !empty($id) ){
		
			// Get tournament info
			$data['tournamentInfo'] = $this->SITEDBAPI->getTournamentInfo($id);
			
			if(is_array($data['tournamentInfo']) && count($data['tournamentInfo'])>0){
			//echo $this->db->last_query(); die;
				
				$checkTournamentPlayer = $this->SITEDBAPI->checkTournamentPlayer($userId, $id);
				
				if(count($checkTournamentPlayer)==0  ){				
					$savePlayer['player_t_id'] = $id;
					$savePlayer['player_user_id'] = $userId;
					$savePlayer['player_score'] = 0;
					$savePlayer['player_type'] = '2';
					$savePlayer['player_added_on'] = time();
					$this->db->insert('user_tournament_players', $savePlayer);
				}
				$today = time();

				$startDate = $data['tournamentInfo']['t_start_date']." ".$data['tournamentInfo']['t_start_time'].":00";
				$startDate = strtotime($startDate);

				$endDate = $data['tournamentInfo']['t_end_date']." ".$data['tournamentInfo']['t_end_time'].":00";
				$endDate = strtotime($endDate);

				$status = 0;     //1=CurrentlyWorking   2=Expired   3=futureTournament
				if($startDate > $today){
					$status = 3;
				} else if($endDate < $today){
					$status = 2;
				} else if($startDate <= $today && $endDate >= $today){
					$status = 1;
				}
				$data['t_current_status'] = $status;
				$data['user_id'] = $userId;
				$data['tournament_id'] = $id;
				$data['playersInfo'] = $this->SITEDBAPI->getTournamentPlayersListDESC($id);
			redirect('PlayTournament/'.base64_encode($id));
			
			} else {
				redirect();
			}
		} else {
			redirect();
		}
	}


	public function playTournament($id){
		$id = base64_decode($id);
		$userId = $this->session->userdata('userId');
		if(!empty($userId) && !empty($id) ){
			// Get tournament info
			
			$data['tournamentInfo'] = $this->SITEDBAPI->getTournamentInfo($id);
			
			$data['userInfo'] = $this->SITEDBAPI->getSiteUserDetail($userId);
			if(is_array($data['tournamentInfo']) && count($data['tournamentInfo'])>0){
				
				$today = time();

				$startDate = $data['tournamentInfo']['t_start_date']." ".$data['tournamentInfo']['t_start_time'].":00";
				$startDate = strtotime($startDate);

				$endDate = $data['tournamentInfo']['t_end_date']." ".$data['tournamentInfo']['t_end_time'].":00";
				$endDate = strtotime($endDate);

				$status = 0;     //1=CurrentlyWorking   2=Expired   3=futureTournament
				if($startDate > $today){
					$status = 3;
				} else if($endDate < $today){
					$status = 2;
				} else if($startDate <= $today && $endDate >= $today){
					$status = 1;
				}
				
				if($status == 1){
					$gameId = $data['tournamentInfo']['t_game_id'];
					$playerProfileId = $data['userInfo']['skillpod_player_id'];
					
					$data['game_id'] = $gameId;
					$data['player_profile_id'] = $playerProfileId;
					$data['tournament_id'] = $id;
					
					$this->load->view('site/tournament_play_game', $data);
				} else {
					redirect('TournamentInfo/'.base64_encode($data['tournamentInfo']['t_share_code']));
				}
			} else {
				redirect();
			}
		} else {
			redirect();
		}

	}

	
	
	public function updateTournamentPlayerScore($tournament_id='', $game_id='', $skillpod_player_id='', $redirect=''){
		
		if(!empty($tournament_id) && !empty($game_id) && !empty($skillpod_player_id) && !empty($redirect)){
			
			$userId = $this->session->userdata('userId');
			$tournament_id =  base64_decode($tournament_id);
			$game_id = $game_id;
			$skillpod_player_id =  $skillpod_player_id;
			$redirect_path =  $redirect;
			
			$tournamentInfo = $this->SITEDBAPI->getTournamentInfo($tournament_id);
			
			$postArray = array('game_id' => $game_id,'player_id' => $skillpod_player_id);
			
			// Get current user score starts
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://games.igpl.pro/xml-api/get_player_scores',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => $postArray,
			  CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJwYXJ0bmVyX2NvZGUiOiJ0ZXN0LTAwMSIsInBhcnRuZXJfcGFzc3dvcmQiOiJ0ZXN0LTAwMSJ9.GQp4_XWFc1FkHHGoy6XWVe40_QHCUt4ityt57ahXoEMW2AhNHo27V_wJmypgZshbw1w6345mKffaGtf9XowGOA'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			

			$responseXML = simplexml_load_string($response);
			$responseJSON = json_encode($responseXML);

			// Convert into associative array
			$responseArray = json_decode($responseJSON, true);
			
		 	$currentScore = @$responseArray['get_player_scores']['player_scores']['player_score_0']['score'];
			
			
			//Get User last saved score
			$scoreInfo = $this->SITEDBAPI->getTournamentPlayerScore($tournament_id, $userId);
			$lastScore = @$scoreInfo['player_score'];
			$player_id = @$scoreInfo['player_id'];
			if($currentScore >= $lastScore){
				$saveScore['player_score'] = $currentScore;
				$this->db->where('player_id', $player_id);
				$this->db->update('user_tournament_players', $saveScore);
			}
			
			
			if($redirect_path == 'redirect_leaderboard'){
				redirect('TournamentLeaderboard/'.base64_encode($tournament_id));
			} else {
				$logged_user_id = $this->session->userdata('userId'); 
				if($tournamentInfo['t_user_id'] == $logged_user_id){
					redirect('Tournaments/'.base64_encode($tournamentInfo['t_id']));
				} else {
					redirect('TournamentInfo/'.base64_encode($tournamentInfo['t_share_code']));
				}
			}
			
		} else {
			redirect();
		}
	}


	public function updateGameboostPlayerScore(){
		
		$userId = $this->session->userdata('userId');
		$tournament_id = @$_POST['tournament_id'];
		$game_id = @$_POST['game_id'];
		$skillpod_player_id = @$_POST['skillpod_player_id'];
		
		if(!empty($tournament_id) && !empty($game_id) && !empty($skillpod_player_id)){
			
			$tournamentInfo = $this->SITEDBAPI->getTournamentInfo($tournament_id);
		
			$apiURL = "https://multiplayergameserver.com/xmlapi7/xmlapi.php?site_id=834&password=GiK2Xz9Ty&nocompress=true&action=get_player_scores&order_by_field=time&order_by_direction=DESC&game_id=".$game_id."&skillpod_player_id=".$skillpod_player_id."&show_games=false";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $apiURL);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
			$response = curl_exec($ch);
			curl_close($ch);

			$responseXML = simplexml_load_string($response);
			$responseJSON = json_encode($responseXML);

			// Convert into associative array
			$responseArray = json_decode($responseJSON, true);
			$userScore = @$responseArray['player_scores']['player_score_0']['score'];			
		 	$scoreDate = @$responseArray['player_scores']['player_score_0']['time'];
			$scoreDate = date('Y-m-d', strtotime($scoreDate));
		
			$t_start_date = $tournamentInfo['t_start_date'];
			$t_end_date = $tournamentInfo['t_end_date'];
		
			$currentScore = $userScore;
			
			$scoreInfo = $this->SITEDBAPI->getTournamentPlayerScore($tournament_id, $userId);
			$lastScore = @$scoreInfo['player_score'];
			$player_id = @$scoreInfo['player_id'];
			if($currentScore >= $lastScore){
				$saveScore['player_score'] = $currentScore;
				$this->db->where('player_id', $player_id);
				$this->db->update('user_tournament_players', $saveScore);
			}
		}
	}

	
	
	public function captureTimeToLeave(){
		$userId = $this->session->userdata('userId');
		$paymayaProfileId = $this->session->userdata('paymayaProfileId');
		// echo $session_page = $_POST['session_page'];
		$session_page=$_POST['session_page'];
		// die();
		$time = $_POST['time'];
		$endTime =$_POST['endTime'];
		$timeSpend = $this->time2sec($time);
		
		// Used in case of practice game play
		$game_id = @$_POST['game_id'];  // This is gameboost game id
		
		// Used in case of tournament game play
		$tournament_id = @$_POST['tournament_id'];
		
		$lastLoginSession =  $this->SITEDBAPI->getUserLastLoginReport($userId, $session_page, $game_id , $tournament_id);
		
		if($lastLoginSession)
		{
			if($lastLoginSession['report_page'] == $session_page){
				// echo "mani";
				if($timeSpend > $lastLoginSession['report_avg_time']){
					$reportUser['report_avg_time'] = $timeSpend;
				}
				$reportUser['report_logout_time'] = date('Y-m-d H:i:s', strtotime($endTime));
				$reportUser['report_page'] = $session_page;
				
				echo  $lastLoginSession['report_id'];
				
				$this->db->where('report_id', $lastLoginSession['report_id']);
				$this->db->update('report_users', $reportUser);
			
			}
	 	} else {
			// echo "anc";
			$reportUser['report_user_id'] = $userId;
			// $reportUser['report_paymaya_id'] = 1;
			$reportUser['report_date'] = date('Y-m-d');
			$reportUser['report_login_time'] = date('H:i:s A');
			$reportUser['report_logout_time'] = date('Y-m-d H:i:s', strtotime($endTime));
			$reportUser['report_tournament_id'] = $tournament_id;
			$reportUser['report_game_id'] = $game_id;
			$reportUser['report_avg_time'] = $timeSpend;
			$reportUser['report_page'] = $session_page;  //1=Home-Page  2=Live Tournament Info  3=Practice-Game-Play  4=Tournament-Detail  5=Tournament-Game-Play  6=Tournament-Practice-Game-Play  7=User-Profile  8=Tournaments-History
			$reportUser['report_last_updated'] = time();
			$this->db->insert('report_users', $reportUser);
		}
		
		echo "Saved: ".$timeSpend;
		
	}

	public function time2sec($time){
		$durations = array_reverse(explode(':', $time));
		$second = array_shift($durations);
		foreach ($durations as $duration) {
			$second += (60 * $duration);
		}
		return $second;
	}
	
	public function EventCapture(){
		
		if(!empty($_POST['user_id'])){
			$data['user_id'] = $_POST['user_id'];
		} else {
			$data['user_id'] = $this->session->userdata('userId');
		}
		
		if(!empty($_POST['gameid'])){
			$data['event_game_id'] = $_POST['gameid'];
		}
		
		if(!empty($_POST['tid'])){
			$data['event_tournament_id'] = $_POST['tid'];
			$data['event_game_access'] = 'play-tournament';
		}
		
		if(!empty($_POST['tgid'])){
			$data['event_tournament_game_id'] = $_POST['tgid'];
		}
		
		if(!empty($_POST['type'])){
			$data['event_game_access'] = $_POST['type'];
		}
		
		
		$data['event_function'] = $_POST['eventfun'];
		$data['event_name'] = $_POST['event_name'];
		$data['page'] = $_POST['page'];
		$data['date_time'] = date('Y-m-d H:i:s');
		$this->db->insert('event_capture', $data);
	}
	
	
// *****************************   **************************** ********************************** //
// *****************************   Custom Tournaments Ends Here ********************************** //
// *****************************   **************************** ********************************** //

	public function liveTournamentsResults(){
		
		$todayHrsStart =  date('Y-m-d', strtotime('-1 day'));
		$todayHrsEnd =  date('Y-m-d');
		
		
	//	$list = $this->db->query("SELECT `tbl_tournaments`.tournament_id,`tbl_tournaments`.tournament_section, `tbl_tournaments_fee_rewards`.fee_tournament_prize_1, `tbl_tournaments_fee_rewards`.fee_tournament_prize_2,`tbl_tournaments_fee_rewards`.fee_tournament_prize_3,`tbl_tournaments_fee_rewards`.fee_tournament_prize_4,`tbl_tournaments_fee_rewards`.fee_tournament_prize_5,`tbl_tournaments_fee_rewards`.fee_tournament_prize_6,`tbl_tournaments_fee_rewards`.fee_tournament_prize_7,`tbl_tournaments_fee_rewards`.fee_tournament_prize_8 FROM tbl_tournaments left join tbl_tournaments_fee_rewards on `tbl_tournaments_fee_rewards`.fee_turnament_id = `tbl_tournaments`.tournament_id WHERE  `tbl_tournaments`.tournament_end_date BETWEEN '$todayHrsStart' AND '$todayHrsEnd' ")->result_array();
		$list = $this->db->query("SELECT `tbl_tournaments`.tournament_id,`tbl_tournaments`.tournament_section, `tbl_tournaments_fee_rewards`.fee_tournament_prize_1, `tbl_tournaments_fee_rewards`.fee_tournament_prize_2,`tbl_tournaments_fee_rewards`.fee_tournament_prize_3,`tbl_tournaments_fee_rewards`.fee_tournament_prize_4,`tbl_tournaments_fee_rewards`.fee_tournament_prize_5,`tbl_tournaments_fee_rewards`.fee_tournament_prize_6,`tbl_tournaments_fee_rewards`.fee_tournament_prize_7,`tbl_tournaments_fee_rewards`.fee_tournament_prize_8 FROM tbl_tournaments left join tbl_tournaments_fee_rewards on `tbl_tournaments_fee_rewards`.fee_turnament_id = `tbl_tournaments`.tournament_id WHERE  `tbl_tournaments`.tournament_end_date = '$todayHrsStart' ")->result_array();
	//	echo $this->db->last_query();
		if(is_array($list) && count($list)>0){
		
			/*  echo "<pre>";
			print_r($list);
			echo "</pre>";
			die; */
			 
			foreach($list as $tRow){
				
				$t_id = $tRow['tournament_id'];
				
				// Get the tournament result status
				
				 $tResult = $this->db->query("SELECT count(*) as no_rows FROM tbl_tournaments_results WHERE result_t_id = '$t_id' ")->row_array();
		
				 if($tResult['no_rows']<=0){
					 
					 
					/*  echo "<pre>";
			print_r($list);
			echo "</pre>";
			die; */
					
					// Manage a aaray for rank-wise prizes
					$t_prize_1 = $tRow['fee_tournament_prize_1'];  // For 1st rank
					$t_prize_2 = $tRow['fee_tournament_prize_2'];  // For 2nd rank
					$t_prize_3 = $tRow['fee_tournament_prize_3'];  // For 3rd rank
					$t_prize_4 = $tRow['fee_tournament_prize_4']; // For 4-5 rank 
					$t_prize_5 = $tRow['fee_tournament_prize_5'];  // For 6-10 rank
					$t_prize_6 = $tRow['fee_tournament_prize_6'];  // For 11-25 rank
					$t_prize_7 = $tRow['fee_tournament_prize_7'];  // For 26-50 rank
					$t_prize_8 = $tRow['fee_tournament_prize_8']; // For 51-100 rank
					
					$array['prizes'] = array("1"=>$t_prize_1, "2"=>$t_prize_2, "3"=>$t_prize_3);
					
					if($tRow['tournament_section']=='2'){ // for weekly prizes 
						if($t_prize_1 > 0)
						  $array['prizes']["1"] = $t_prize_1;
						if($t_prize_2 > 0)
						  $array['prizes']["2"] = $t_prize_2;
						if($t_prize_3 > 0)
						   $array['prizes']["3"] = $t_prize_3;
						if($t_prize_4 > 0){
						   for($i=4; $i<=10; $i++)
							  $array['prizes'][$i] = $t_prize_4;
						}
						if($t_prize_5 > 0){
						
						for($i=11; $i<=50; $i++)
							$array['prizes'][$i] = $t_prize_5;
						}

					}elseif ($tRow['tournament_section']=='3') {  //// for daily prizes 
						if($t_prize_1 > 0)
						  $array['prizes']["1"] = $t_prize_1;
						if($t_prize_2 > 0)
						  $array['prizes']["2"] = $t_prize_2;
						if($t_prize_3 > 0)
						   $array['prizes']["3"] = $t_prize_3;
						if($t_prize_4 > 0){
						   for($i=4; $i<=10; $i++)
							  $array['prizes'][$i] = $t_prize_4;
						}
						if($t_prize_5 > 0){
						for($i=11; $i<=20; $i++)
							$array['prizes'][$i] = $t_prize_5;
						}
					}else{    // for free game prize
                         if($t_prize_1 > 0){
						   for($i=1; $i<=10; $i++)
							  $array['prizes'][$i] = $t_prize_1;
						}
					}
					
					/* echo "<pre>";
						print_r($array['prizes']);
						echo "</pre>";
						die;
					*/
					
				
					// Get the tournament players
					$no_player_selected = count($array['prizes']);
					 $playersList = $this->db->query("SELECT * FROM tbl_tournaments_players WHERE player_t_id = '$t_id' AND player_score > '0' ORDER BY player_score DESC, player_score_updated  ASC LIMIT $no_player_selected")->result_array();
	
					/* 	echo "<pre>";
						print_r($playersList);
						echo "</pre>";
						die; */
	
					if(is_array($playersList) && count($playersList)>0){
						
						$highest_score = $playersList[0]['player_score'];
						$rank = 1;
						$arrIndex = 1;
						
						foreach($playersList as $player){
							if($player['player_score'] >0){
								
								$userId = $player['player_user_id'];
								$userInfo = $this->SITEDBAPI->validateUser($userId);
								
								
								$voucherDetail = $this->SITEDBAPI->getUserRankVoucher($rank, $t_id);								

								// Update the player prize & rank in tournament player's table
								$dataPlayerRow['player_reward_updated'] = date('Y-m-d H:i:s');
								$dataPlayerRow['player_reward_rank'] = $rank;
								$dataPlayerRow['prize_voucher_id'] = $voucherDetail['voucher_id'];
								$dataPlayerRow['player_reward_prize'] = $voucherDetail['vt_type'];
								$dataPlayerRow['redeem_expiry_date'] = date("Y-m-d",strtotime(" +3 months"));
								$dataPlayerRow['redeem_prize'] = 0;
								$this->db->where('player_id', $player['player_id']);
								$this->db->where('player_t_id', $t_id);
								$this->db->update('tournaments_players', $dataPlayerRow);


								//status update of voucher assign
								$voucherow['tv_assigned_status'] = '2';  // assigne to user
								$this->db->where('tv_tournament_id', $t_id);
								$this->db->where('tv_prize_rank', $rank);
								$this->db->where('tv_voucher_id', $voucherDetail['voucher_id']);
								$this->db->update('tournament_voucher_detail', $voucherow);
                                
								
								//status update of voucher assign
								$voucherUpdate['voucher_status'] = '2';  // assigne to user
								$this->db->where('voucher_id', $voucherDetail['voucher_id']);
								$this->db->update('voucher_detail', $voucherUpdate);
                                
								
								// finally update logs
								$logs['log_voucher_id'] =  $voucherDetail['voucher_id'];
								$logs['log_tournament_id'] = $t_id;
								$logs['log_user_id'] = $userInfo['user_id'];
								$logs['log_voucher_status'] = '2';  // assigne to user
								$logs['log_message'] = 'assigned_to_user';
								$logs['log_date_time'] = date('Y-m-d H:i:s');
								$logs['log_added_on'] = time();
								$this->db->insert('voucher_logs', $logs);
								
								
								//add Notification for tournament rewards added
								$notifyData['notify_user_id'] =  $userInfo['user_id'];
								$notifyData['notify_type'] =  '7';  //1=TournamentCreated   2=Spin&Win   3=RedeemCoins   4=TournamentRewardAdded   5=UpdateProfileName    6=SubscriptionCoins   7=RewardAdded  8=RewardClaimed  9=VoucherExpired
								$notifyData['notify_title'] =  "Tournament Reward";
								$notifyData['notify_desc'] =  "You have won a Daraz voucher worth <b>".number_format($voucherDetail['vt_type'], 0)." BDT</b> for participating the tournament.";
								$notifyData['notify_status'] =  '0';
								$notifyData['notify_date'] =  date('Y-m-d');
								$notifyData['notify_added_on'] =  time();
								$this->db->insert('user_notifications', $notifyData);
							
							} 
							
							$rank++;
						}
					}
					
					$updateResult['result_t_id'] = $t_id;
					$updateResult['result_added_on'] = time();
					$this->db->insert('tournaments_results', $updateResult);
					
					
					// Reassign the tournament vouchers back to main voucher table
					$this->reassignTournamentVouchers();
					
				 } 
		
			}
			
		}
	}
	
    public function reassignTournamentVouchers(){
    	$previous_date =  date('Y-m-d', strtotime('-1 day'));

    	$list = $this->db->query("SELECT tournament_id FROM tbl_tournaments WHERE tournament_end_date = '$previous_date' ")->result_array();
	
		/* echo $this->db->last_query();
		echo "<pre>";
		print_r($unassigendVouchers);
		echo "</pre>";
		die; */
		
        if(is_array($list) && count($list)>0){
        	foreach($list as $tRow){
				
				$unassigendVouchers = $this->SITEDBAPI->getUnassignedTournamentVouchers($tRow['tournament_id']);
        	   
			   if(is_array($unassigendVouchers) && count($unassigendVouchers)>0){
				   
				  foreach($unassigendVouchers as $vRow){
					  
						 //status update of voucher assign
						$voucherRow['tv_assigned_status'] = '3';  // reissued to main vouchers
						$this->db->where('tv_id', $vRow['tv_id']);
						$this->db->update('tournament_voucher_detail', $voucherRow);
						
						
						//status update of voucher assign
						$voucherUpdate['voucher_status'] = '0';  // Not assigned to any tournament
						$this->db->where('voucher_id', $vRow['tv_voucher_id']);
						$this->db->update('voucher_detail', $voucherUpdate);
                         
						 
						// deduct coupon from the voucher type and update balance
						$updatedCount = $this->SITEDBAPI->getUpdatedVoucherCounts($vRow['vt_id']);
						$vtAssignCoupons = $updatedCount['vt_assign_coupons'];
						$vtBalanceCoupons = $updatedCount['vt_balance_coupons'];
						
						$updateCoupon['vt_assign_coupons'] = ($vtAssignCoupons-1);
						$updateCoupon['vt_balance_coupons'] = ($vtBalanceCoupons+1);
						$this->db->where('vt_id', $vRow['vt_id']);
						$this->db->update('voucher_type', $updateCoupon);
						
						
						// finally update logs
						$logs['log_voucher_id'] =  $vRow['tv_voucher_id'];
						$logs['log_tournament_id'] = $vRow['tv_tournament_id'];
						$logs['log_voucher_status'] = '6'; //reissued after reward distribution
						$logs['log_message'] = 'reissued_unassigned_reward_voucher';
						$logs['log_date_time'] = date('Y-m-d H:i:s');
						$logs['log_added_on'] = time();
						$this->db->insert('voucher_logs', $logs);
						 
					}
				}
			}
        }
    }


    public function reassignExpiredVouchers(){
    	$previous_date =  date('Y-m-d', strtotime('-1 day'));

    	$list = $this->db->query("SELECT * FROM tbl_tournaments_players WHERE redeem_expiry_date = '$previous_date' AND redeem_prize = '0' ")->result_array();
	  
	/*	echo $this->db->last_query();
		echo "<pre>";
		print_r($list);
		echo "</pre>";
		die; 
		*/  
        if(is_array($list) && count($list)>0){
        	foreach($list as $tRow){
				
				$tournamentId = $tRow['player_t_id'];
				$userId = $tRow['player_user_id'];
				$voucherId = $tRow['prize_voucher_id'];
				$playerId = $tRow['player_id'];
				
				
				//expired voucher to to player table
				$playerData['redeem_prize'] = '1';  // expired
				$this->db->where('player_id', $playerId);
				$this->db->update('tournaments_players', $playerData);
				
				//status update of voucher assign
				$voucherRow['tv_assigned_status'] = '5';  // expired from user so reassign to main voucher table
				$this->db->where('tv_tournament_id', $tournamentId);
				$this->db->where('tv_voucher_id', $voucherId);
				$this->db->update('tournament_voucher_detail', $voucherRow);
								
				//status update of voucher assign
				$voucherUpdate['voucher_status'] = '0';  // reissued to main vouchers after user expiration
				$this->db->where('voucher_id', $voucherId);
				$this->db->update('voucher_detail', $voucherUpdate);
                     
					 
				// deduct coupon from the voucher type and update balance
				$voucherDetail = $this->SITEDBAPI->getVoucherDetail($voucherId);
				$vtAssignCoupons = $voucherDetail['vt_assign_coupons'];
				$vtBalanceCoupons = $voucherDetail['vt_balance_coupons'];
				
				$updateCoupon['vt_assign_coupons'] = ($vtAssignCoupons-1);
				$updateCoupon['vt_balance_coupons'] = ($vtBalanceCoupons+1);
				$this->db->where('vt_id', $voucherDetail['vt_id']);
				$this->db->update('voucher_type', $updateCoupon);		 
				

				// finally update logs
				$logs['log_voucher_id'] =  $voucherId;
				$logs['log_tournament_id'] = $tournamentId;
				$logs['log_voucher_status'] = '9'; //reissued after user not claimed
				$logs['log_message'] = 'reissued_not_claimed_voucher';
				$logs['log_date_time'] = date('Y-m-d H:i:s');
				$logs['log_added_on'] = time();
				$this->db->insert('voucher_logs', $logs);
				
				//add Notification for tournament rewards claimed 
				$notifyData['notify_user_id'] =  $userId;
				$notifyData['notify_type'] =  '9';  //1=TournamentCreated   2=Spin&Win   3=RedeemCoins   4=TournamentRewardAdded   5=UpdateProfileName    6=SubscriptionCoins   7=RewardAdded  8=RewardClaimed  9=VoucherExpired
				$notifyData['notify_title'] =  "Tournament Reward Expired";
				$notifyData['notify_desc'] =  "A daraz voucher worth <b>".number_format($voucherDetail['vt_type'], 0)." BDT </b>, not claimed, is expired.";
				$notifyData['notify_status'] =  '0';
				$notifyData['notify_date'] =  date('Y-m-d');
				$notifyData['notify_added_on'] =  time();
				$this->db->insert('user_notifications', $notifyData);
				
			}
        }

    }

	public function expireExistingVoucher(){
		$expireDate = date("Y-m-d");
		$date=date("Y-m-d" , strtotime('+3 months' , strtotime($expireDate)));
		$notExpired = $this->db->query("SELECT * FROM tbl_voucher_detail WHERE voucher_validity_ends <= '$date' AND voucher_status='0'")->result_array();
		if(is_array($notExpired) && count($notExpired)>0){
			foreach($notExpired as $value){

				$voucherUpdate['voucher_status'] = '6';  // expire voucher
				$this->db->where('voucher_id', $value['voucher_id']);
				$this->db->update('voucher_detail', $voucherUpdate);
			
				// Update Voucher Balance
				$voucherDetail = $this->SITEDBAPI->getVoucherDetail($value['voucher_id']);
				$updateCoupon['vt_expired_coupons'] = $voucherDetail['vt_expired_coupons'] +1;
				$updateCoupon['vt_balance_coupons'] = $voucherDetail['vt_balance_coupons'] -1;
				$this->db->where('vt_id' , $voucherDetail['vt_id']);
				$this->db->update('voucher_type', $updateCoupon);
				
				// Update Logs 
				$log['log_voucher_id'] = $value['voucher_id'];
				$log['log_tournament_id'] = 0;
				$log['log_user_id'] = 0;
				$log['log_voucher_status'] = 10;  // Not AvailableForAssignment
				$log['log_message'] = 'Expire_in_90_days';
				$log['log_date_time'] = date("Y-m-d H:i:s");
				$log['log_added_on'] = time();
				$this->db->insert('tbl_voucher_logs', $log);
			}
		}
		
		$expiredVouchers = $this->db->query("SELECT * FROM tbl_voucher_detail WHERE voucher_validity_ends <= '$expireDate' AND  voucher_status='6' ")->result_array();
		// echo "<pre>";
		// print_r($expiredVouchers);
		// die();
		if(is_array($expiredVouchers) && count($expiredVouchers) >0){
			foreach($expiredVouchers as $row){
				$voucherUpdate['voucher_status'] = '4';  // expire voucher
				$this->db->where('voucher_id', $row['voucher_id']);
				$this->db->update('voucher_detail', $voucherUpdate);

				// Update Logs 
				$log['log_voucher_id'] = $row['voucher_id'];
				$log['log_tournament_id'] = 0;
				$log['log_user_id'] = 0;
				$log['log_voucher_status'] = 5;  // Voucher Expired
				$log['log_message'] = 'Voucher_expired';
				$log['log_date_time'] = date("Y-m-d H:i:s");
				$log['log_added_on'] = time();
				$this->db->insert('tbl_voucher_logs', $log);
			}
		}

	}

	
/*
    public function VoucherCancel(){
    	$previous_date =  date('Y-m-d', strtotime('-1 day'));

    	$list = $this->db->query("SELECT * FROM tbl_tournaments_players  WHERE  Date(`tbl_tournaments_players`.redeem_expiry_date)='$previous_date' and redeem_prize='0'")->result_array();
		
        if(is_array($list) && count($list)>0){
        	foreach($list as $tRow){
        	     $data['redeem_prize'] = '1';
				 $this->db->where('player_id', $tRow['player_id']);
				 $this->db->update('tournaments_players', $data);
                 $voucher_detail = $this->SITEDBAPI->getVoucherInfo($tRow['prize_voucher_id']);
                 $voucher_type_id = $voucher_detail['voucher_typeid'];
                 
                 //coupon balance change 
				 $this->db->set('balance_coupon', 'balance_coupon+1',false);
				 $this->db->where('vouchertype_id', $voucher_type_id);
				 $this->db->update('tbl_voucher_type');

                 //coupon assigned status change
				 $this->db->set('status', '3',false);
				 $this->db->where('tournament_id', $tRow['player_t_id']);
				 $this->db->where('voucher_id', $tRow['prize_voucher_id']);
				 $this->db->where('user_rank', $tRow['player_reward_rank']);
				 $this->db->update('tbl_tournament_voucher_detail');
			}
        }

    }
*/
	public function RedeemModalData(){
		$voucher_id= $_POST['id'];
		$player_id= $_POST['player_id'];
		
		$this->SITEDBAPI->updateVoucherClaimed($player_id, $voucher_id);
		
		$voucherDetail = $this->SITEDBAPI->getVoucherDetail($voucher_id);
		$expiry = $this->db->query("SELECT redeem_prize,redeem_expiry_date FROM tbl_tournaments_players WHERE player_id = '$player_id'")->row();
		
		$data['voucher_id'] = $voucherDetail['voucher_id'];
		$data['voucher_name'] = "Daraz Voucher of  ৳  ".$voucherDetail['vt_type'];
		$data['voucher_code'] = $voucherDetail['voucher_code'];
		$data['voucher_website'] = $voucherDetail['voucher_website'];
		$data['voucher_description'] = $voucherDetail['voucher_description'];
		$data['voucher_redeem'] = $expiry->redeem_prize;
		$data['voucher_expiry'] = "Valid till ".date('F j, Y', strtotime($expiry->redeem_expiry_date));
		
		echo json_encode($data);

	}
/*
	public function RedeemVoucher(){
		$voucher_prize= $this->uri->segment(2);
		$player_id= $this->uri->segment(3);
		$data['voucherDetail']=$this->SITEDBAPI->getVoucherdetailbyPrize($voucher_prize);
        $website = $data['voucherDetail']['website'];
		//$this->SITEDBAPI->RedeemVoucherUpdate($player_id);
		header('Location: '.$website);

	}
*/
	
}
