<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends CI_Model {

	 function __construct(){
		parent::__construct();
	}


	function getPortalSettings(){
		$this->db->select("*", FALSE);
        $this->db->from('portal_settings'); 
		return $this->db->get()->result_array();
	}
	
	function validateUserBkashToken($phone, $token){
		$this->db->select("*", FALSE);
		$this->db->from('site_users');
		$this->db->where('user_id', $id);
		 return $this->db->get()->row_array();
	}

	function validateUser($id){
		$this->db->select("*", FALSE);
		$this->db->from('site_users');
		$this->db->where('user_id', $id);
		 return $this->db->get()->row_array();
	}

	function verifyUserDetails($phone, $password){
		$this->db->select("*", FALSE);
		$this->db->from('site_users');
		$this->db->where('user_phone', $phone);
		$this->db->where('user_password', $password);
		 return $this->db->get()->row_array();
	}

	function getSiteUserDetail($id=''){
		$this->db->select("*", FALSE);
		$this->db->from('site_users');
		if(!empty($id))
			$this->db->where('user_id', $id);
		 return $this->db->get()->row_array();
	}

	function getTMMUserDetail($id=''){
		$this->db->select("*", FALSE);
		$this->db->from('site_users');
		if(!empty($id)){
			$this->db->where('user_operator', 'telenorMM');
			$this->db->where('user_subscription_id', $id);
		}
		 return $this->db->get()->row_array();
	}


	function checkUserByEmail($email){
		$this->db->select("*", FALSE);
		$this->db->from('site_users');
		$this->db->where('user_email', $email);
		return $this->db->get()->row_array();
	}

	function getGamesList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games');
		if(!empty($id))
			$this->db->where('id', $id);
		//$this->db->limit('30');
		 return $this->db->get()->result_array();
	}

	function getPublishedGamesList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games');
		if(!empty($id))
			$this->db->where('id', $id);
		//$this->db->where('IsPublished', 'YES');
		$this->db->where('portalPublished', '1');
		
        return $this->db->get()->result_array();
	}

	function getPublishedPTGames($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games');
		if(!empty($id))
			$this->db->where('id', $id);
		$this->db->where('IsPublished', 'YES');
		$this->db->where('private_tournament', '1');
		$this->db->order_by('Name', 'ASC');
        return $this->db->get()->result_array();
	}

	function getGameInfo($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games');
		if(!empty($id))
			$this->db->where('gid', $id);
		//$this->db->where('IsPublished', 'YES');
		$this->db->where('portalPublished', '1');
        return $this->db->get()->row_array();
	}

	function getGameboostGameInfo($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games');
		if(!empty($id))
			$this->db->where('id', $id);
		//$this->db->where('IsPublished', 'YES');
		$this->db->where('portalPublished', '1');
        return $this->db->get()->row_array();
	}

	function getSiteUserLiveTournament($user_id){
		$today = date('Y-m-d');
		$this->db->select("user_tournaments.*, user_tournament_players.*", FALSE);
        $this->db->from('user_tournaments');
		$this->db->where('player_user_id', $user_id);
		$this->db->where("t_start_date <= '$today' ");
		$this->db->where("t_end_date >= '$today' ");
		$this->db->join('user_tournament_players', 'user_tournament_players.player_t_id = user_tournaments.t_id', 'left');
        $this->db->group_by('t_id');
        $this->db->order_by('t_id','desc');
        $this->db->limit('1');
		return $this->db->get()->row_array();
	}

	function getUserTournamentsList__old($user_id){
		$this->db->select("user_tournaments.*, count(tbl_user_tournament_players.player_id) as no_players ", FALSE);
        $this->db->from('user_tournaments');
		$this->db->where('t_user_id', $user_id);
		$this->db->join('user_tournament_players', 'user_tournament_players.player_t_id = user_tournaments.t_id', 'left');
        $this->db->group_by('t_id');
        $this->db->order_by('t_id','desc');
		return $this->db->get()->result_array();
	}

	function getUserTournamentsList($user_id){
		$this->db->select("user_tournaments.*, count(tbl_user_tournament_players.player_id) as no_players ", FALSE);
        $this->db->from('user_tournaments');
		$this->db->where('t_user_id', $user_id);
		$this->db->or_where('user_tournament_players.player_user_id', $user_id);
		$this->db->join('user_tournament_players', 'user_tournament_players.player_t_id = user_tournaments.t_id', 'left');
        $this->db->group_by('t_id');
        $this->db->order_by('t_id','desc');
		return $this->db->get()->result_array();
	}
	function getTournamentsList($user_id){
		$today = date('Y-m-d');
		$this->db->select("*", FALSE);
        $this->db->from('tournaments_players');
		$this->db->where('player_user_id', $user_id);
		$this->db->where("tournament_end_date <= '$today' ");
		$this->db->join('tournaments', 'tournaments.tournament_id = tournaments_players.player_t_id', 'left');
		$this->db->join('tbl_tournaments_fee_rewards', 'tbl_tournaments_fee_rewards.fee_turnament_id = tournaments.tournament_id', 'left');
		$this->db->join('tournaments_results', 'tournaments_results.result_t_id = tournaments_players.player_t_id', 'right');
		$this->db->group_by('tournaments.tournament_id');
        $this->db->order_by('tournaments.tournament_id','desc');
        // $this->db->limit($limit,$offset);
		return $this->db->get()->result_array();
		// return $this->db->last_query();
	}

	

	function getTournamentInfo($id){
		$this->db->select("user_tournaments.*, count(tbl_user_tournament_players.player_id) as no_players ", FALSE);
        $this->db->from('user_tournaments');
		$this->db->where('t_id', $id);
		$this->db->join('user_tournament_players', 'user_tournament_players.player_t_id = user_tournaments.t_id', 'left');
        $this->db->group_by('t_id');
		return $this->db->get()->row_array();
	}

	function getSharedTournamentInfo($share_code){
		$this->db->select("user_tournaments.*, count(tbl_user_tournament_players.player_id) as no_players ", FALSE);
        $this->db->from('user_tournaments');
		$this->db->where('t_share_code', $share_code);
		$this->db->join('user_tournament_players', 'user_tournament_players.player_t_id = user_tournaments.t_id', 'left');
        $this->db->group_by('t_id');
		return $this->db->get()->row_array();
	}

	function getTournamentPlayersList($id){
		$this->db->select("*", FALSE);
		$this->db->from('user_tournament_players');
		$this->db->where('player_t_id', $id);
		$this->db->join('site_users', 'site_users.user_id = user_tournament_players.player_user_id', 'left');
		
	    return $this->db->get()->result_array();
	}
	
	function getTournamentPlayersListDESC($id){
		$this->db->select("*", FALSE);
		$this->db->from('user_tournament_players');
		$this->db->where('player_t_id', $id);
		$this->db->join('site_users', 'site_users.user_id = user_tournament_players.player_user_id', 'left');
		$this->db->order_by('player_score', 'desc');
	    return $this->db->get()->result_array();
	}
	
	function getTournamentPlayerScore($id, $user_id){
		$this->db->select("*", FALSE);
		$this->db->from('user_tournament_players');
		$this->db->where('player_t_id', $id);
		$this->db->where('player_user_id', $user_id);
		
	    return $this->db->get()->row_array();
	}
	
	
	function checkTournamentPlayer($user_id, $t_id){
		$this->db->select("*", FALSE);
		$this->db->from('user_tournament_players');
		$this->db->where('player_t_id', $t_id);
		$this->db->where('player_user_id', $user_id);
		return $this->db->get()->row_array();
	}

	function searchPTGameByName($txt){
		$this->db->select("*", FALSE);
        $this->db->from("games");
		$this->db->where("Name like '%$txt%' ");
		$this->db->where("IsPublished", "YES");
		$this->db->where('private_tournament', '1');
		$this->db->order_by('Name', 'ASC');

        return $this->db->get()->result_array();
	}

	function searchGameByName($txt){
		$this->db->select("*", FALSE);
        $this->db->from("games");
		$this->db->where("Name like '%$txt%' ");
		$this->db->where("IsPublished", "YES");

        return $this->db->get()->result_array();
	}

	public function getUserLastLoginReport($userId, $page , $gameId , $tournamentId)
	{
		$date= date('Y-m-d');
		$this->db->select('*' , FALSE);
		$this->db->from('report_users');
		$this->db->where('report_date' , $date);
		$this->db->where('report_user_id' , $userId);
		$this->db->where('report_page', $page);
		$this->db->where('report_game_id', $gameId);
		$this->db->where('report_tournament_id', $tournamentId);
		return $this->db->get()->row_array();

	}

	function getGenreGames($type, $limit){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		$this->db->where("portalCategory like '%$type%' ");
		$this->db->where('portalPublished', '1');
		$this->db->where('private_tournament',0);
		
		$this->db->order_by('Name', 'RANDOM');
		$this->db->limit($limit);
		
        return $this->db->get()->result_array();
	}
	
	function getGenreGamesList($type){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		$this->db->where("portalCategory like '%$type%' ");
		$this->db->where('portalPublished', '1');
		$this->db->where('private_tournament',0);
		
		$this->db->order_by('Name', 'RANDOM');
		
        return $this->db->get()->result_array();
	}
	
	function getSuggestedGamesList($limit){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		$this->db->where('IsSuggested', '1');
		$this->db->where('portalPublished', '1');		
		$this->db->order_by('Name', 'RANDOM');
		$this->db->limit($limit);
		
        return $this->db->get()->result_array();
	}
	
	function getQuickTournamnetGamesList($limit){
		$this->db->select("*", FALSE);
        $this->db->from('quick_tournaments'); 
		$this->db->join('games','games.gid = quick_tournaments.quick_gid','left'); 
		$this->db->order_by('quick_tid', 'RANDOM');
		$this->db->limit($limit);
        return $this->db->get()->result_array();
	}
	
	function getTopGamesList($limit){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		$this->db->where('IsTop', '1');
		$this->db->where('portalPublished', '1');
		$this->db->order_by('Name', 'RANDOM');
		$this->db->limit($limit);
		
        return $this->db->get()->result_array();
	}
	
	function getHomeGenreGamesList($type, $limit){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		$this->db->where("portalCategory like '%$type%' ");
		$this->db->where('portalPublished', '1');
		$this->db->where('private_tournament','0');
		$this->db->order_by('gid', 'RANDOM');
		$this->db->limit($limit);
        return $this->db->get()->result_array();
	}
	
	function getMaleProfileImages(){
		$this->db->select("*", FALSE);
        $this->db->from('user_images');
        $this->db->where('type', '1');
		$this->db->order_by('id', 'RANDOM');
		return $this->db->get()->result_array();
	}
	function getFemaleProfileImages(){
		$this->db->select("*", FALSE);
        $this->db->from('user_images');
		$this->db->where('type', '2');
		$this->db->order_by('id', 'RANDOM');
		return $this->db->get()->result_array();
	}
	
	
/*  **********************************   Global Leaderboard *********************** */
	
	public function getMonthlyGlobalLeaderboard($limit='', $offset=''){
		
		//$startDate= date("Y-m-d",strtotime("-1 month")); 
		//$endDate= date('Y-m-d');
		
		 $startDate = date("Y-m-d", strtotime("first day of this month"));
		 $endDate = date("Y-m-d", strtotime("last day of this month"));
		
		$this->db->select(" count(DISTINCT tbl_user_tournaments.t_id) as no_tournaments, count(tbl_user_tournament_players.player_id) as no_players, site_users.user_id, site_users.user_full_name, site_users.user_email, site_users.user_phone, site_users.user_login_type, site_users.user_image ", FALSE);
        $this->db->from('user_tournaments');
        $this->db->where("user_tournament_players.player_score > 0");
        $this->db->where("user_tournament_players.player_type = 2");
        $this->db->where("user_tournaments.t_start_date >= '$startDate'");
        $this->db->where("user_tournaments.t_end_date <= '$endDate'");
		$this->db->join('user_tournament_players', 'user_tournament_players.player_t_id = user_tournaments.t_id', 'left');
		$this->db->join('site_users', 'site_users.user_id = user_tournaments.t_user_id', 'left');
        $this->db->group_by('user_tournaments.t_user_id');
		$this->db->having('no_players > 0');
        $this->db->order_by('no_tournaments','desc');
        $this->db->limit("$limit, $offset");
		return  $this->db->get()->result_array();
		
	}
	
	public function getWeeklyGlobalLeaderboard($limit='', $offset=''){
		
		//$startDate= date("Y-m-d",strtotime("-7 days")); 
		//$endDate= date('Y-m-d');
		
		$monday = strtotime("last monday");
		$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
		$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
		$startDate = date("Y-m-d",$monday);
		$endDate = date("Y-m-d",$sunday);
		
		$this->db->select(" count(DISTINCT tbl_user_tournaments.t_id) as no_tournaments, count(tbl_user_tournament_players.player_id) as no_players, site_users.user_id, site_users.user_full_name, site_users.user_email, site_users.user_phone, site_users.user_login_type, site_users.user_image ", FALSE);
        $this->db->from('user_tournaments');
        $this->db->where("user_tournament_players.player_score > 0");
        $this->db->where("user_tournament_players.player_type = 2");
        $this->db->where("user_tournaments.t_start_date >= '$startDate'");
        $this->db->where("user_tournaments.t_end_date <= '$endDate'");
		$this->db->join('user_tournament_players', 'user_tournament_players.player_t_id = user_tournaments.t_id', 'left');
		$this->db->join('site_users', 'site_users.user_id = user_tournaments.t_user_id', 'left');
        $this->db->group_by('user_tournaments.t_user_id');
		$this->db->having('no_players > 0');
        $this->db->order_by('no_tournaments','desc');
		 $this->db->limit("$limit, $offset");
		return  $this->db->get()->result_array();
	
	}
	
	function getFakeUsers($count){
		
		$this->db->select("vName", FALSE);
        $this->db->from('fake_users');        
        $this->db->order_by('ID', 'RANDOM');
        $this->db->limit($count);
       
        return $this->db->get()->result_array();
	}
	
	public function getMonthlyGlobalLeaderboardUsers($limit='', $offset=''){
		$today = date('Y-m-d');
		$this->db->select("*", FALSE);
        $this->db->from('leaderboard_monthly');
        $this->db->where("month_date", $today);
        $this->db->limit("$limit, $offset");
		return  $this->db->get()->result_array();
	}
	
	public function getWeeklyGlobalLeaderboardUsers($limit='', $offset=''){
		$today = date('Y-m-d');
		$this->db->select("*", FALSE);
        $this->db->from('leaderboard_weekly');
        $this->db->where("week_date", $today);
        $this->db->limit("$limit, $offset");
		return  $this->db->get()->result_array();
	}
	
	public function checkWeeklyGLRows(){
		$today = date('Y-m-d');
		$this->db->select("count(*) as no_rows", FALSE);
        $this->db->from('leaderboard_weekly');
        $this->db->where("week_date", $today);
		return  $this->db->get()->row_array();
	}
	
	public function checkMonthlyGLRows(){
		$today = date('Y-m-d');
		$this->db->select("count(*) as no_rows", FALSE);
        $this->db->from('leaderboard_monthly');
        $this->db->where("month_date", $today);
		return  $this->db->get()->row_array();
	}
	
	
	public function getUserMGLRank(){
		
		$startDate = date("Y-m-d", strtotime("first day of this month"));
		$endDate = date("Y-m-d", strtotime("last day of this month"));
		
		$this->db->select(" count(DISTINCT tbl_user_tournaments.t_id) as no_tournaments, count(tbl_user_tournament_players.player_id) as no_players, site_users.user_id, site_users.user_full_name, site_users.user_email, site_users.user_phone, site_users.user_login_type, site_users.user_image ", FALSE);
        $this->db->from('user_tournaments');
        $this->db->where("user_tournament_players.player_score > 0");
        $this->db->where("user_tournament_players.player_type = 2");
        $this->db->where("user_tournaments.t_start_date >= '$startDate'");
        $this->db->where("user_tournaments.t_end_date <= '$endDate'");
		$this->db->join('user_tournament_players', 'user_tournament_players.player_t_id = user_tournaments.t_id', 'left');
		$this->db->join('site_users', 'site_users.user_id = user_tournaments.t_user_id', 'left');
        $this->db->group_by('user_tournaments.t_user_id');
		$this->db->having('no_players > 0');
        $this->db->order_by('no_tournaments','desc');
       
		return  $this->db->get()->result_array();
		
	}
	
	public function getUserWGLRank(){
		
		$monday = strtotime("last monday");
		$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
		$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
		$startDate = date("Y-m-d",$monday);
		$endDate = date("Y-m-d",$sunday);
		
		$this->db->select(" count(DISTINCT tbl_user_tournaments.t_id) as no_tournaments, count(tbl_user_tournament_players.player_id) as no_players, site_users.user_id, site_users.user_full_name, site_users.user_email, site_users.user_phone, site_users.user_login_type, site_users.user_image ", FALSE);
        $this->db->from('user_tournaments');
        $this->db->where("user_tournament_players.player_score > 0");
        $this->db->where("user_tournament_players.player_type = 2");
        $this->db->where("user_tournaments.t_start_date >= '$startDate'");
        $this->db->where("user_tournaments.t_end_date <= '$endDate'");
		$this->db->join('user_tournament_players', 'user_tournament_players.player_t_id = user_tournaments.t_id', 'left');
		$this->db->join('site_users', 'site_users.user_id = user_tournaments.t_user_id', 'left');
        $this->db->group_by('user_tournaments.t_user_id');
		$this->db->having('no_players > 0');
        $this->db->order_by('no_tournaments','desc');		
		return  $this->db->get()->result_array();
	
	}
	
/*  **********************************   Global Leaderboard Ends Here *********************** */

/*  **********************************   Coins Management Starts Here *********************** */


	function getUserLastSpin($userId){
		$this->db->select("*", FALSE);
        $this->db->from('user_spinwin'); 
		$this->db->where('spin_user_id', $userId);
		$this->db->order_by('spin_id', 'desc');
		$this->db->limit('1');
		
        return $this->db->get()->row_array();
	}
	
/*  **********************************   Coins Management Ends Here *********************** */

/*  **********************************   Spin & Win Sections Starts Here *********************** */
	
	function getSpinWheelSections(){
		$this->db->select("*", FALSE);
        $this->db->from('spinwheel_data'); 
		$this->db->order_by('wheel_seq', 'ASC');
        return $this->db->get()->result_array();
	}
	
	function getSpinWheelInfo($id){
		$this->db->select("*", FALSE);
        $this->db->from('spinwheel_data'); 
        $this->db->where('wheel_id', $id); 
		return $this->db->get()->row_array();
	}
	
/*  **********************************   Spin & Win Sections Ends Here *********************** */


/*  **********************************   Notifications Sections Starts Here *********************** */

	function getUserNotifications($user_id){
		$this->db->select("*", FALSE);
        $this->db->from('user_notifications'); 
        $this->db->where('notify_user_id', $user_id); 
        $this->db->order_by('notify_id', 'desc'); 
        $this->db->limit('100'); 
		return $this->db->get()->result_array();
	}
	
	function getUserUnreadNotificationsCount($user_id){
		$this->db->select("count(*) as rows_count", FALSE);
        $this->db->from('user_notifications'); 
        $this->db->where('notify_user_id', $user_id); 
        $this->db->where('notify_status', '0'); 
		return $this->db->get()->row_array();
	}
	
/*  **********************************   Notifications Sections Ends Here *********************** */


	function getRedemptionsList($type){
		$this->db->select("*", FALSE);
        $this->db->from('redemption_settings'); 
		// Type values:  1=Coins  2=Datapack(MB)   3=Datapack(GB)    4=Talktime   5=GamesAccessForUnsubscribedUsers
		$this->db->where('redeem_type', $type); 
		$this->db->where('redeem_status', '1'); 
		
		return $this->db->get()->result_array();
	}
	
		
	function getPractiseBannersList($limit){
		$this->db->select("*", FALSE);
        $this->db->from('practise_banners'); 
        $this->db->where('banner_status', '1'); 
        $this->db->order_by('banner_id', 'desc'); 
		$this->db->limit($limit); 
		
		return $this->db->get()->result_array();
	}
	
	
	
		
	function getPortalTournamentsList($type, $limit){
		$todayDate = date('Y-m-d'); 
		$code = $this->session->userdata('country_code');
		$this->db->select("*", FALSE);
        $this->db->from('tournaments'); 
        $this->db->where('tournament_section',$type);   // 1=HeroTournaments   2=WeeklyTournaments  3=DailyTournaments
		$this->db->where("tournament_start_date <= '$todayDate'"); 
        $this->db->where("tournament_end_date >= '$todayDate'"); 
        $this->db->join("tournament_banners","tournament_banners.banner_tournament_id = tournaments.tournament_id", "left"); 
		$this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.fee_turnament_id = tournaments.tournament_id AND tbl_tournaments_fee_rewards.fee_country_name='$code'", "left");
		$this->db->join("tbl_country","tbl_country.c_id = tbl_tournaments_fee_rewards.fee_country_id AND tbl_country.c_country_code='$code'", "left");
		$this->db->limit($limit);
		return $this->db->get()->result_array();
	}
	
		
	function getVipTournamentList($limit){
		$todayDate = date('Y-m-d'); 
		$code=$this->session->userdata('country_code');
		$this->db->select("*", FALSE);
        $this->db->from('tournaments'); 
        $this->db->where('tournament_section','2');   // 1=HeroTournaments   2=SmallTournaments  after Update  // 1=Free 2=Vip 3=Pay and Play 
		$this->db->where("tournament_start_date <= '$todayDate'"); 
        $this->db->where("tournament_end_date >= '$todayDate'"); 
        $this->db->join("tournament_banners","tournament_banners.banner_tournament_id = tournaments.tournament_id", "left"); 
		$this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.fee_turnament_id = tournaments.tournament_id AND tbl_tournaments_fee_rewards.fee_country_name='$code'", "left");
		$this->db->join("tbl_country","tbl_country.c_id = tbl_tournaments_fee_rewards.fee_country_id AND tbl_country.c_country_code='$code'", "left");
		$this->db->limit($limit);
		return $this->db->get()->result_array();
	}
	function getVipTournamentListAll(){
		$todayDate = date('Y-m-d'); 
		$code=$this->session->userdata('country_code');
		$this->db->select("*", FALSE);
        $this->db->from('tournaments'); 
        $this->db->where('tournament_section','2');   // 1=HeroTournaments   2=SmallTournaments  after Update  // 1=Free 2=Vip 3=Pay and Play 
		$this->db->where("tournament_start_date <= '$todayDate'"); 
        $this->db->where("tournament_end_date >= '$todayDate'"); 
        $this->db->join("tournament_banners","tournament_banners.banner_tournament_id = tournaments.tournament_id", "left"); 
		$this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.fee_turnament_id = tournaments.tournament_id AND tbl_tournaments_fee_rewards.fee_country_name='$code'", "left");
		$this->db->join("tbl_country","tbl_country.c_id = tbl_tournaments_fee_rewards.fee_country_id AND tbl_country.c_country_code='$code'", "left");
		// $this->db->limit($limit);
		return $this->db->get()->result_array();
	}
		
	function getFreeTournamentList($limit){
		$todayDate = date('Y-m-d'); 
		$code=$this->session->userdata('country_code');
		$this->db->select("*", FALSE);
        $this->db->from('tournaments'); 
        $this->db->where('tournament_section','1');   // 1=HeroTournaments   2=SmallTournaments after Update  // 1=Free 2=Vip 3=Pay and Play 
		$this->db->where("tournament_start_date <= '$todayDate'"); 
        $this->db->where("tournament_end_date >= '$todayDate'");
		$this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.fee_turnament_id = tournaments.tournament_id AND tbl_tournaments_fee_rewards.fee_country_name='$code'", "left");
		$this->db->join("tbl_country","tbl_country.c_id = tbl_tournaments_fee_rewards.fee_country_id AND tbl_country.c_country_code='$code'", "left");
		// $this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.banner_tournament_id = tournaments.tournament_id", "left");
		$this->db->limit($limit);
		return $this->db->get()->result_array();
		// $result=$this->db->get()->result_array();
		// echo "<pre>";
		// print_r($result);
		// die();
	}
	function getFreeTournamentListAll(){
		$todayDate = date('Y-m-d'); 
		$code=$this->session->userdata('country_code');
		$this->db->select("*", FALSE);
        $this->db->from('tournaments'); 
        $this->db->where('tournament_section','1');   // 1=HeroTournaments   2=SmallTournaments after Update  // 1=Free 2=Vip 3=Pay and Play 
		$this->db->where("tournament_start_date <= '$todayDate'"); 
        $this->db->where("tournament_end_date >= '$todayDate'");
		$this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.fee_turnament_id = tournaments.tournament_id AND tbl_tournaments_fee_rewards.fee_country_name='$code'", "left");
		$this->db->join("tbl_country","tbl_country.c_id = tbl_tournaments_fee_rewards.fee_country_id AND tbl_country.c_country_code='$code'", "left");
		// $this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.banner_tournament_id = tournaments.tournament_id", "left");
		
		return $this->db->get()->result_array();
		// $result=$this->db->get()->result_array();
		// echo "<pre>";
		// print_r($result);
		// die();
	}
	public function getPayAndPlayTournamentList($limit){
		$todayDate = date('Y-m-d'); 
		$code=$this->session->userdata('country_code');
		$this->db->select("*", FALSE);
        $this->db->from('tournaments'); 
        $this->db->where('tournament_section','3');   // 1=Free   2=VipTournaments  3=PayAndPlay
		$this->db->where("tournament_start_date <= '$todayDate'"); 
        $this->db->where("tournament_end_date >= '$todayDate'");
		$this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.fee_turnament_id = tournaments.tournament_id AND tbl_tournaments_fee_rewards.fee_country_name='$code'", "left");
		$this->db->join("tbl_country","tbl_country.c_id = tbl_tournaments_fee_rewards.fee_country_id AND tbl_country.c_country_code='$code'", "left");
		$this->db->limit($limit);
		return $this->db->get()->result_array();
		// $result= $this->db->get()->result_array();
		// echo "<pre>";
		// print_r($result);
		// die();
	}
	public function getPayAndPlayTournamentListAll(){
		$todayDate = date('Y-m-d'); 
		$code=$this->session->userdata('country_code');
		$this->db->select("*", FALSE);
        $this->db->from('tournaments'); 
        $this->db->where('tournament_section','3');   // 1=Free   2=VipTournaments  3=PayAndPlay
		$this->db->where("tournament_start_date <= '$todayDate'"); 
        $this->db->where("tournament_end_date >= '$todayDate'");
		$this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.fee_turnament_id = tournaments.tournament_id ", "left");
		$this->db->join("tbl_country","tbl_country.c_id = tbl_tournaments_fee_rewards.fee_country_id", "left");
		return $this->db->get()->result_array();
		// $result= $this->db->get()->result_array();
		// echo "<pre>";
		// print_r($result);
		// die();
	}
	
	function getLiveTournamentInfo($id){
		$this->db->select("tournaments.*, games.screen as tournament_game_screen , tbl_tournaments_fee_rewards.* ,tbl_country.c_country_code, tournament_banners.banner_image_path", FALSE);
        $this->db->from('tournaments'); 
        $this->db->where('tournament_id',$id);  
        $this->db->join('games','games.gid = tournaments.tournament_game_id','left');
		$this->db->join("tbl_tournaments_fee_rewards","tbl_tournaments_fee_rewards.fee_turnament_id = tournaments.tournament_id", "left");
		$this->db->join("tournament_banners","tournament_banners.banner_tournament_id = tournaments.tournament_id", "left"); 
		
		$this->db->join("tbl_country","tbl_country.c_id = tbl_tournaments_fee_rewards.fee_country_id", "left");
		// echo "<pre>";
		$result=$this->db->get()->result_array();
		// print_r($result);
		foreach($result as $row)
		{
			if($row['c_country_code']==$this->session->userdata('country_code'))
				return $row;
		}
		// print_r($result);
		// die();
		return $result;
	}
	
	public function deductTournamentFee($fee , $t_id){
		$this->db->select('user_play_coins', FALSE);
		$this->db->where('user_id', $this->session->userdata('userId'));
		$coins=$this->db->get('tbl_site_users')->result_array()[0]['user_play_coins'];
		// echo "<pre>";
		// print_r($coins['user_play_coins']);
		// die();
		$data2['user_play_coins']=$coins-$fee;
		if($data2['user_play_coins']>0)
		{
			$this->db->where('user_id' , $this->session->userdata('userId'));
			$this->db->update('tbl_site_users' , $data2);
			// if($this->db->affected_rows()==0)
			// 	return 1;
			// Manage Coin history
			$coin['coin_user_id']           =   	$this->session->userdata('userId');
			$coin['coin_date']              =   	date("Y-m-d");
			$coin['coin_section']           =   	6;
			$coin['coin_play_coins_add']    =   	'-'.$fee;
			$coin['coin_tournament_id']		=		$t_id;
			$coin['coin_type']              =   	1;
			$coin['coin_added_on']          =   	time();
			$this->db->insert('tbl_user_coins_history' , $coin);
			// if($this->db->affected_rows()==0)
			// 	return 2;

			// END
			return true;
		}
		else
			return false;
	}
		
	function getLiveTournamentPlayersCount($id){
		$this->db->select("count(*) as total_players", FALSE);
        $this->db->from('tournaments_players'); 
        $this->db->where('player_t_id',$id);   
		return $this->db->get()->row_array();
	}
	
	public function checkTournamentJoined($userId , $id){
		$this->db->select('*');
		$this->db->where('player_t_id' , $id);
		$this->db->where('player_user_id' , $userId);
		$result=$this->db->get('tbl_tournaments_players');
		if($result->num_rows()>0)
			return true;
		return false;
	}
		
	function checkLiveTournamentPlayer($user_id, $t_id){
		$this->db->select("*", FALSE);
		$this->db->from('tournaments_players');
		$this->db->where('player_t_id', $t_id);
		$this->db->where('player_user_id', $user_id);
		return $this->db->get()->row_array();
	}
	
	function getLiveTournamentPlayerScore($id, $user_id){
		$this->db->select("*", FALSE);
		$this->db->from('tournaments_players');
		$this->db->where('player_t_id', $id);
		$this->db->where('player_user_id', $user_id);
		
	    return $this->db->get()->row_array();
	}
	
	
	function getLiveTournamentPlayersListDESC($id){
		$this->db->select("*", FALSE);
		$this->db->from('tournaments_players');
		$this->db->where('player_t_id', $id);
		$this->db->join('site_users', 'site_users.user_id = tournaments_players.player_user_id', 'left');
		$this->db->order_by('player_score', 'desc');
	    return $this->db->get()->result_array();
	}
	
	
	function getUserPracticeGameReport($userId, $gameId){
		$today = date('Y-m-d');
		$this->db->select("*", FALSE);
		$this->db->from('report_game_play');
		$this->db->where('report_user_id', $userId);
		$this->db->where('report_game_id', $gameId);
		$this->db->where('report_date', $today);
		$this->db->order_by('report_id', 'desc');
		$this->db->limit('1');
		return $this->db->get()->row_array();
	}
	
	function getUserTournamentGameReport($userId, $gameId, $tournamentId){
		$today = date('Y-m-d');
		$this->db->select("*", FALSE);
		$this->db->from('report_game_play');
		$this->db->where('report_user_id', $userId);
		$this->db->where('report_game_id', $gameId);
		$this->db->where('report_tournament_id', $tournamentId);
		$this->db->where('report_date', $today);
		$this->db->order_by('report_id', 'desc');
		$this->db->limit('1');
		return $this->db->get()->row_array();
	}
	
	function getUserForGratification($id)
	{
		$this->db->select('*' , FALSE);
		$this->db->from('tbl_talktime_gratification');
		$this->db->where('tg_t_id' , $id);
		return $this->db->get()->result_array();
	}
	function getSkuCode()
	{
		$this->db->select('*', FALSE);
		$this->db->from('tbl_talktime_reward');
		$result = $this->db->get()->result_array();
		return $result;
	}
	
	
}

?>
