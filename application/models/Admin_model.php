<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	 function __construct(){
		parent::__construct();
	}
	
	
	function getLoginStatus($email,$pswd){
		$this->db->select("*", FALSE);
        $this->db->from('login');        
        $this->db->where('username', $email);
		$this->db->where('password', $pswd);
		$this->db->where('user_status', '1');		
		$this->db->where('user_type', '1');		
        return $this->db->get()->row_array();
	}

	
	function getAllGamesCount(){
		$this->db->select("count(*) as total", FALSE);
        $this->db->from('games'); 
        return $this->db->get()->row_array();
	}
	
	function getPublishedGamesCount(){
		$this->db->select("count(*) as total", FALSE);
        $this->db->from('games'); 
        $this->db->where('portalPublished','1'); 
        return $this->db->get()->row_array();
	}
	
	function getTournamentsCount(){
		$this->db->select("count(*) as total", FALSE);
        $this->db->from('tournaments'); 
        return $this->db->get()->row_array();
	}
	
	function getLiveTournamentsCount(){
		$todayDate = date('Y-m-d'); 
		
		$this->db->select("count(*) as total", FALSE);
        $this->db->from('tournaments'); 
        $this->db->where("tournament_start_date <= '$todayDate'"); 
        $this->db->where("tournament_end_date >= '$todayDate'"); 
        return $this->db->get()->row_array();
	}
	
	
	function getUserInfo($user_id){
		$this->db->select("*", FALSE);
        $this->db->from('login');        
        $this->db->where('user_id', $user_id);
		
        return $this->db->get()->row_array();
	}
	
	function getCategoriesList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('categories'); 
		$this->db->order_by('category_id', 'ASC');
        return $this->db->get()->result_array();
	}
	
	function getCategoriesInfo($id){
		$this->db->select("*", FALSE);
        $this->db->from('categories'); 
		$this->db->where('category_id', $id);
        return $this->db->get()->row_array();
	}
	
	function getCategoriesInfoByName($category){
		$this->db->select("*", FALSE);
        $this->db->from('categories'); 
		$this->db->where("category_name LIKE '%$category%' ");
        return $this->db->get()->row_array();
	}
	
	function getGamesList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		if(!empty($id))		
			$this->db->where('id', $id);
		$this->db->order_by('Name', 'ASC');
        return $this->db->get()->result_array();
	}
	public function getCountryList()
	{
		$this->db->select('*' ,FALSE);
		$this->db->from('country');
		return $this->db->get()->result_array();
	}
	public function setCountry($data)
	{
		$this->db->insert('tbl_country' , $data);
		if($this->db->affected_rows()>0)
		{
			return true;
		}
		else
			return false;
	}
	public function updateCountry($cid, $data)
	{
		$this->db->where('c_id', $cid);
		$this->db->update('tbl_country' , $data);
		if($this->db->affected_rows()>0)
		{
			return true;
		}
		else
			return false;
	}
	function getTournamentsList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('tournaments'); 
		if(!empty($id))		
			$this->db->where('tournament_id', $id);
		
        return $this->db->get()->result_array();
	}
	
	public function getActiveCountryList()
	{
		$this->db->select('*' , False);
		$this->db->from('country');
		$this->db->where('c_status', '1');
		return $this->db->get()->result_array();
	}
	public function deteleCountry($id)
	{
		$this->db->where('c_id', $id);
		$this->db->delete('tbl_country');
	}
	public function addNewTournaments($data)
	{
		$data2=array(
			'tournament_name'=>$data['tournament_name'],
			'tournament_game_id'=>$data['tournament_game_id'],
			'tournament_gameboost_id'=>$data['tournament_gameboost_id'],
			'tournament_game_name'=>$data['tournament_game_name'],
			'tournament_game_image'=>$data['tournament_game_image'],
			'tournament_desc'=>$data['tournament_desc'],
			'tournament_type'=>$data['tournament_type'],
			'tournament_section'=>$data['tournament_section'],
			'tournament_start_date'=>$data['tournament_start_date'],
			'tournament_end_date'=>$data['tournament_end_date'],
			'tournament_start_time'=>$data['tournament_start_time'],
			'tournament_end_time'=>$data['tournament_end_time'],
			'tournament_category'=>$data['tournament_category'],
			'tournament_category_id'=>$data['tournament_category_id'],
			'tournament_status'=>$data['tournament_status'],
			'tournament_added_on'=>$data['tournament_added_on'],
			'tournament_updated_on'=>$data['tournament_updated_on'],
			// 'tournament_name'=>$data['tournament_name'],
			// 'tournament_name'=>$data['tournament_name'],
			// 'tournament_name'=>$data['tournament_name'],
			// 'tournament_name'=>$data['tournament_name'],
		);
		$result=$this->db->insert('tbl_tournaments', $data2);
		if(!$result)
			return false;
		$insert_id=$this->db->insert_id();
		print_r($insert_id);
		$count=0;
		foreach($data['country_id'] as $row)
		{
			$data2=array(
				'fee_turnament_id'=> $insert_id,
				'fee_country_id'=>$row,
				'fee_country_name'=>$data['country'][$count],
				'fee_tournament_rewards'=>$data['tournament_reward_type'][$count],
				'fee_tournament_fee'=>$data['tournament_fee'][$count],
				'fee_tournament_prize_1'=>$data['tournament_prize_1'][$count],
				'fee_tournament_prize_2'=>$data['tournament_prize_2'][$count],
				'fee_tournament_prize_3'=>$data['tournament_prize_3'][$count],
				'fee_tournament_prize_4'=>$data['tournament_prize_4'][$count],
				'fee_tournament_prize_5'=>$data['tournament_prize_5'][$count],
				'fee_tournament_prize_6'=>$data['tournament_prize_6'][$count],
				'fee_tournament_prize_7'=>$data['tournament_prize_7'][$count],
				'fee_tournament_prize_8'=>$data['tournament_prize_8'][$count],
				'fee_tournament_prize_9'=>$data['tournament_prize_9'][$count],
			);
			$count++;
			$this->db->insert('tbl_tournaments_fee_rewards', $data2);
		}
		return $insert_id;
	}
	function getTournamentsBannersList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('tournament_banners'); 
        $this->db->join('tournaments','tournaments.tournament_id = tournament_banners.banner_tournament_id','left'); 
		return $this->db->get()->result_array();
	}
	
	function getTournamentBannerInfo($id){
		$this->db->select("*", FALSE);
        $this->db->from('tournament_banners'); 
        $this->db->where('banner_id', $id); 
        $this->db->join('tournaments','tournaments.tournament_id = tournament_banners.banner_tournament_id','left'); 
		return $this->db->get()->row_array();
	}
	
	
	function getTournamentBannerInfoByTid($tournament_id){
		$this->db->select("*", FALSE);
        $this->db->from('tournament_banners'); 
        $this->db->where('banner_tournament_id', $tournament_id); 
       return $this->db->get()->row_array();
	}
	
	
	function getCategoryGamesList($category=''){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		//$this->db->where("portalCategory like '%$category%' ");
		$this->db->where("portalCategoryId", $category);
		$this->db->where("portalPublished", '1');
		$this->db->where("private_tournament", '1');
	
        return $this->db->get()->result_array();
	}
	
	function getGamesInfo($id){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		$this->db->where('gid', $id);
        return $this->db->get()->row_array();
	}
	
	function getGamesInfoByGameboostId($id){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		$this->db->where('id', $id);
        return $this->db->get()->row_array();
	}
	
	function getGameInfoByName($game){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		$this->db->where("Name like '%$game%'");
        return $this->db->get()->row_array();
	}
	
	function getTournamentInfo($id){
		$this->db->select("*", FALSE);
        $this->db->from('tournaments'); 
		$this->db->where('tournament_id', $id);
		
        return $this->db->get()->row_array();
	}
	public function getRewardInfo($id)
	{
		$this->db->select('tbl_tournaments_fee_rewards.* ,tbl_country.c_name ', FALSE);
		$this->db->from('tbl_tournaments_fee_rewards');
		$this->db->where('fee_turnament_id', $id);
		$this->db->join('tbl_country', 'tbl_country.c_country_code = tbl_tournaments_fee_rewards.fee_country_name', 'left');
		return $this->db->get()->result_array();
		// echo "<pre>";
		// print_r($this->db->get()->result_array());
		// die();
	}
	public function updateTournamentInfo($id, $data)
	{
		$data2=array(
			'tournament_name'=>$data['tournament_name'],
			'tournament_game_id'=>$data['tournament_game_id'],
			'tournament_gameboost_id'=>$data['tournament_gameboost_id'],
			'tournament_game_name'=>$data['tournament_game_name'],
			'tournament_game_image'=>$data['tournament_game_image'],
			'tournament_desc'=>$data['tournament_desc'],
			'tournament_type'=>$data['tournament_type'],
			'tournament_section'=>$data['tournament_section'],
			'tournament_start_date'=>$data['tournament_start_date'],
			'tournament_end_date'=>$data['tournament_end_date'],
			'tournament_start_time'=>$data['tournament_start_time'],
			'tournament_end_time'=>$data['tournament_end_time'],
			'tournament_category'=>$data['tournament_category'],
			'tournament_category_id'=>$data['tournament_category_id'],
			// 'tournament_status'=>$data['tournament_status'],
			// 'tournament_added_on'=>$data['tournament_added_on'],
			'tournament_updated_on'=>$data['tournament_updated_on'],
			// 'tournament_name'=>$data['tournament_name'],
			// 'tournament_name'=>$data['tournament_name'],
			// 'tournament_name'=>$data['tournament_name'],
			// 'tournament_name'=>$data['tournament_name'],
		);
		$this->db->where('tournament_id', $id);
		$this->db->update('tbl_tournaments', $data2);
		$result=$this->db->affected_rows();
		$count=0;
		if($result==0)
			return false;
		foreach($data['country_id'] as $row)
		{
			$data2=array(
				'fee_turnament_id'=> $id,
				'fee_country_id'=>$row,
				'fee_country_name'=>$data['country'][$count],
				'fee_tournament_rewards'=>$data['tournament_reward_type'][$count],
				'fee_tournament_fee'=>$data['tournament_fee'][$count],
				'fee_tournament_prize_1'=>$data['tournament_prize_1'][$count],
				'fee_tournament_prize_2'=>$data['tournament_prize_2'][$count],
				'fee_tournament_prize_3'=>$data['tournament_prize_3'][$count],
				'fee_tournament_prize_4'=>$data['tournament_prize_4'][$count],
				'fee_tournament_prize_5'=>$data['tournament_prize_5'][$count],
				'fee_tournament_prize_6'=>$data['tournament_prize_6'][$count],
				'fee_tournament_prize_7'=>$data['tournament_prize_7'][$count],
				'fee_tournament_prize_8'=>$data['tournament_prize_8'][$count],
				'fee_tournament_prize_9'=>$data['tournament_prize_9'][$count],
			);
			$this->db->where('fee_id' , $data['id'][$count]);
			$this->db->update('tbl_tournaments_fee_rewards', $data2);
			$count++;
		}
		return true;
	}
	function getPublishedGamesList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		if(!empty($id))		
			$this->db->where('id', $id);
		//$this->db->where('IsPublished', 'YES');
		//$this->db->or_where('IsPublished', 'Yes');
		$this->db->where('portalPublished', '1');
		$this->db->order_by('Name', 'ASC');
        return $this->db->get()->result_array();
	}
	
	function getPTGamesList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		if(!empty($id))		
			$this->db->where('id', $id);
		//$this->db->where('IsPublished', 'YES');
		//$this->db->or_where('IsPublished', 'Yes');
		$this->db->where('private_tournament', '1');
		$this->db->order_by('Name', 'ASC');
        return $this->db->get()->result_array();
	}
	
	function getQuickTournamnetGamesList(){
		$this->db->select("*", FALSE);
        $this->db->from('quick_tournaments'); 
		 $this->db->join('games','games.gid = quick_tournaments.quick_gid','left'); 
        return $this->db->get()->result_array();
	}
	
	function checkQuickTournamnetGame($gid, $gameboost_id){
		$this->db->select("count(*) as no_rows", FALSE);
        $this->db->from('quick_tournaments'); 
        $this->db->where('quick_gid', $gid); 
        $this->db->where('quick_gameboost_id', $gameboost_id); 
		return $this->db->get()->row_array();
	}
	
	function getQuickTournamnetGameRows(){
		$this->db->select("count(*) as no_rows", FALSE);
        $this->db->from('quick_tournaments'); 
		return $this->db->get()->row_array();
	}
	
	
	function getSuggestedGamesList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		if(!empty($id))		
			$this->db->where('id', $id);
		$this->db->where('IsSuggested', '1');
		//$this->db->where('IsPublished', 'yes');
		$this->db->where('portalPublished', '1');		
		$this->db->order_by('Name', 'ASC');
		
        return $this->db->get()->result_array();
	}
	
	function getTopGamesList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		if(!empty($id))		
			$this->db->where('id', $id);
		$this->db->where('IsTop', '1');
		//$this->db->where('IsPublished', 'yes');
		$this->db->where('portalPublished', '1');
		$this->db->order_by('Name', 'ASC');
		
        return $this->db->get()->result_array();
	}
	
	function getGenreGamesList($type){
		$this->db->select("*", FALSE);
        $this->db->from('games'); 
		$this->db->where("portalCategory like '%$type%' ");
		$this->db->where('portalPublished', '1');
		$this->db->order_by('Name', 'ASC');
		
        return $this->db->get()->result_array();
	}
	
	function getSpinWheelSections(){
		$this->db->select("*", FALSE);
        $this->db->from('spinwheel_data'); 
		$this->db->order_by('wheel_seq', 'ASC');
        return $this->db->get()->result_array();
	}
	
	
	
	function getPractiseBannersList($id=''){
		$this->db->select("*", FALSE);
        $this->db->from('practise_banners'); 
        $this->db->join('games','games.gid = practise_banners.banner_game_id','left'); 
		return $this->db->get()->result_array();
	}
	
	function getPractiseBannersInfo($id){
		$this->db->select("*", FALSE);
        $this->db->from('practise_banners'); 
        $this->db->where('banner_id', $id); 
		return $this->db->get()->row_array();
	}
	
	function getPortalSettings(){
		$this->db->select("*", FALSE);
        $this->db->from('portal_settings'); 
		return $this->db->get()->result_array();
	}
	
	function getRedemptionsList(){
		$this->db->select("*", FALSE);
        $this->db->from('redemption_settings'); 
        $this->db->order_by('redeem_type','ASC'); 
		return $this->db->get()->result_array();
	}
	
	
	
}  

?>
