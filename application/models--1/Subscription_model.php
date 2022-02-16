<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function checkTMMUser($filter, $paramValue){
		$this->db->select('*', false);
		$this->db->from('tmm_subscription');
		
		if($filter == 'MSISDN')
			$this->db->where('vMSISDN', $paramValue);
		else if($filter == 'ActCode')
			$this->db->where('ActivationCode', $paramValue);

		$this->db->order_by('ID','DESC');
		$this->db->limit('1');
		return	$this->db->get()->row();
	}
	
	function checkSiteUser($filter, $paramValue){
		$this->db->select('*', false);
		$this->db->from('site_users');
		
		if($filter == 'MSISDN')
			$this->db->where('user_phone', $paramValue);
		
		$this->db->order_by('user_id','DESC');
		$this->db->limit('1');
		return	$this->db->get()->row();
	}
	

}

?>
