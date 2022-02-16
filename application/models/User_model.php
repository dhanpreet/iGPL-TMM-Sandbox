<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model {

	 function __construct(){
		parent::__construct();
	}
	
	
	function getLoginStatus($email,$pswd){
		$this->db->select("*", FALSE);
        $this->db->from('login');        
        $this->db->where('username', $email);
		$this->db->where('password', $pswd);
		$this->db->where('user_status', '1');		
        return $this->db->get()->row_array();
	}

	
	function getLiveBattles(){
		$date = date('Y-m-d');
		$this->db->select("battles.*, games.Name, games.GameImage", FALSE);
        $this->db->from('battles');        
        $this->db->where("battle_start_date <= '$date'");
        $this->db->where("battle_end_date >= '$date'");
        $this->db->join("games","games.id = battles.battle_game_id","left");
        return $this->db->get()->result_array();
	}
	
	function getLiveBattleInfo($id){
		$date = date('Y-m-d');
		$this->db->select("battles.*, games.Name, games.GameImage", FALSE);
        $this->db->from('battles');        
        $this->db->where("battle_id", $id);
        $this->db->where("battle_start_date <= '$date'");
        $this->db->where("battle_end_date >= '$date'");
        $this->db->join("games","games.id = battles.battle_game_id","left");
        return $this->db->get()->result_array();
	}
	
	function getLiveBattlesList($id){
		$date = date('Y-m-d');
		$this->db->select("*", FALSE);
        $this->db->from('battles_info');        
        $this->db->where('binfo_battle_id', $id);
       
        return $this->db->get()->result_array();
	}
			
	
	function getBattlePlayerInfo($id){
		
		$this->db->select("*", FALSE);
        $this->db->from('battles_info');        
        $this->db->where('binfo_id', $id);
       
        return $this->db->get()->result_array();
	}
				
	
	function getFakeUsers($count){
		
		$this->db->select("*", FALSE);
        $this->db->from('fake_users');        
        $this->db->order_by('ID', 'RANDOM');
        $this->db->limit($count);
       
        return $this->db->get()->result_array();
	}
	
	function getRandomUserImages($count){
		
		$this->db->select("*", FALSE);
        $this->db->from('user_images');        
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit($count);
       
        return $this->db->get()->result_array();
	}
	
	function getUserBattleInfo($id){		
		$this->db->select("*", FALSE);
        $this->db->from('users_battles');        
        $this->db->where('battle_id', $id);
		return $this->db->get()->row_array();
	}
	
	function getUserBattlePlayersInfo($id){		
		$this->db->select("*", FALSE);
        $this->db->from('users_battles_scores');        
        $this->db->where('score_battle_id', $id);
		$this->db->order_by('score_count', 'DESC');
		return $this->db->get()->result_array();
	}
			
	public function manageLoginHistory($data)
	{
		$this->db->insert('tbl_user_login_history', $data);
		$this->session->set_userdata('login_id' , $this->db->insert_id());
		return true;
	}
	public function manageLogoutHistory($data)
	{
		// $data['login_user_logout_at']=date('Y-m-d H:i:s');
		$this->db->where('login_id', $this->session->userdata('login_id'));
		$this->db->update('tbl_user_login_history' , $data);
		return true;
	}
	
}  

?>
