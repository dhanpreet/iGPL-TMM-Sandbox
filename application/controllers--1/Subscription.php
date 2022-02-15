<?php
   
defined('BASEPATH') OR exit('No direct script access allowed'); 

class Subscription extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('subscription_model','SUBSCRIPTIONDB');
        $this->load->library('user_agent');
        $this->load->helper('timezone');
        timezone();
    }

	public function index(){
		
		$requestHeader = $this->input->request_headers(); // fetch header request
        
        if(isset($requestHeader['HTTP_X_MSISDN'])){
        	$HE_MSISDN = $requestHeader['HTTP_X_MSISDN'];
        } else if(isset($requestHeader['http_x_msisdn'])){
        	$HE_MSISDN = $requestHeader['http_x_msisdn'];
        }
		
		// get activationCode from URL
		$activationCode = @$this->uri->segment(2);
		
		// check login type app or not
		$loginType = @$_GET['type'];  // ?type=app
		
		if(!empty($HE_MSISDN)){
			$checkUserSub = $this->SUBSCRIPTIONDB->checkTMMUser($filterBy='MSISDN', $filterValue=$HE_MSISDN);
		
		} else if(!empty($activationCode)){
			$checkUserSub = $this->SUBSCRIPTIONDB->checkTMMUser($filterBy='ActCode', $filterValue=$activationCode);
			
		} else if(!empty($loginType) && $loginType == 'app'){
			$HE_MSISDN = '99017700000';
			$checkSiteUser = $this->SUBSCRIPTIONDB->checkSiteUser($filterBy='MSISDN', $filterValue=$HE_MSISDN);
			if(!empty($checkSiteUser->user_id)){
				$this->session->set_userData('userID', $checkSiteUser->user_id);
				redirect('Home');
			}
		} 
		
		// If we get the user from MSISDN or ActivationCode
		//echo "<pre>"; print_r($checkUserSub); echo "</pre>";
		if(!empty($checkUserSub->ID)){
			if($checkUserSub->vStatus == 'sub' || $checkUserSub->vStatus == 'renew' ||  $checkUserSub->vStatus == 'parking' ||  $checkUserSub->vStatus == 'inprocess' ||  $checkUserSub->vStatus == 'suspend'){
				$dValidTill = $checkUserSub->dValidTill;
				$currentTS = date('Y-m-d H:i:s');
				if($currentTS <= $dValidTill){
					$this->session->set_userData('tmmId', $checkUserSub->ID);
					redirect('Home');
				} else {
					echo "<script> window.location.href='http://tmm.gplclub.mobi'; </script>";
				}
			} 
		} else if($HE_MSISDN == '99017700000'){
			$checkSiteUser = $this->SUBSCRIPTIONDB->checkSiteUser($filterBy='MSISDN', $filterValue=$HE_MSISDN);
			if(!empty($checkSiteUser->user_id)){
				$this->session->set_userData('userID', $checkSiteUser->user_id);
				redirect('Home');
			}
		}
		
		// if nothing found reditect to TMM GPL Club
		echo "<script> window.location.href='http://tmm.gplclub.mobi'; </script>";
		
	}  

	
   
}