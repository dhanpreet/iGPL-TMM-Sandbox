<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Gratification_model extends CI_Model {

	 function __construct(){
		parent::__construct();
	}

    function validateUser($id){
		$this->db->select("*", FALSE);
		$this->db->from('site_users');
		$this->db->where('user_id', $id);
		 return $this->db->get()->row_array();
	}

    function getSkuCode()
	{
		$this->db->select('*', FALSE);
		$this->db->from('tbl_talktime_reward');
		$result = $this->db->get()->result_array();
		return $result;
	}

    function getUserForGratification($id)
	{
		$this->db->select('*' , FALSE);
		$this->db->from('tbl_talktime_gratification');
		$this->db->where('tg_t_id' , $id);
		return $this->db->get()->result_array();
	}
	function getExpiredTournaments()
	{
		$this->db->select('*', FALSE);
		$this->db->from('tbl_tournaments');
		$this->db->where('tournament_reward_type', 3);
		$this->db->where('tournament_status' , 3);
		$this->db->order_by("tournament_id", "desc");
		return $this->db->get()->result_array();
	}
	function getTournamentLeaderboard($id)
	{
		$this->db->select('tbl_tournaments_players.* ,tbl_site_users.user_full_name , tbl_site_users.user_phone ' , FALSE);
		$this->db->from('tbl_tournaments_players');
		$this->db->where('player_t_id' , $id);
		$this->db->join('tbl_site_users','tbl_tournaments_players.player_user_id = tbl_site_users.user_id','left');
		$this->db->order_by("player_reward_rank", "asc");
		return $this->db->get()->result_array();
	}
}