<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callback_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function updateCallbackLogs($type, $callbackRequest){
		$callbackData = json_decode($callbackRequest, true);
		if(!empty($callbackData['operator']) && !empty($callbackData['data']) ){
			//fetch data from callback
			$logData = json_decode($callbackData['data']);
			foreach($logData as $key=>$rowLog){
				$logUpdate['log_'.$key] = $rowLog;
			}
			$logUpdate['log_operator'] = $callbackData['operator'];
			$logUpdate['log_callback_type'] = $type;   // callback / activation-callback / payment-callback
			$logUpdate['log_RequestJSON'] = $callbackRequest;

			if(!empty($callbackData['invalid']))
				$logUpdate['log_invalid_request'] = '1'; 

			if(!empty($callbackData['invalid_reason']))
				$logUpdate['log_invalid_reason'] = $callbackData['invalid_reason']; 
	
			$logUpdate['log_added_on'] = time();
			if($this->db->insert('tmm_subscription_logs', $logUpdate)){
				return $this->db->insert_id();	
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function checkUserSubscription($filter, $paramValue){
		$this->db->select('*', false);
		$this->db->from('tmm_subscription');
		
		if($filter =='OPXUserID')
			$this->db->where('OPXUserID', $paramValue);
		else if($filter =='isSubscribed')
			$this->db->where('vMSISDN', $paramValue);

		return	$this->db->get()->row_array();
	}
	

	function checkRenewals($id){
		$this->db->select('count(*) as renew_count', false);
		$this->db->from('tmm_subscription_update_logs');
		$this->db->where('ID', $id);
		$this->db->where('vStatus', 'renew');
		return	$this->db->get()->row();
	}
	

	function InsertTelenorSubscriptionData($action, $requestData, $coins=''){
		$requestData = json_decode($requestData, true);

		if($action =='updateACT' || $action =='updatePAY'){
			foreach($requestData as $key=>$val){
				$update[$key] = $val;
			}
			$update['dUpdatedOn'] = date('Y-m-d H:i:s');
			$update['dValidFrom'] = date('Y-m-d H:i:s');
			$update['dValidTill'] = date('Y-m-d H:i:s', strtotime("+ ".$update['vValidity']." days"));
			
			
			$this->db->where('ID', $requestData['ID']);
			if($this->db->update('tmm_subscription', $update)){
				
				//fetch the user id and update coins
				$userInfo = $this->getUserBySubscriptionId($requestData['ID']);
				$userId =  @$userInfo->user_id;
				$playCoins =  @$userInfo->user_play_coins;
				
				if(!empty($userId)){
					$updateCoins['user_play_coins'] = ($playCoins+$coins);
					$this->db->where('user_id', $userId);
					$this->db->update('site_users', $updateCoins);
					
					//update coins history
					$coinNew['coin_user_id'] 		   =      $userId;
					$coinNew['coin_date']              =       date("Y-m-d");
					$coinNew['coin_section']           =       7;
					$coinNew['coin_play_coins_add']    =   		($coins);
					$coinNew['coin_type']              =       1;
					$coinNew['coin_added_on']          =       time();
					$this->db->insert('user_coins_history' , $coinNew);
				}
				
				if(empty($userInfo->skillpod_player_id)){
					$this->createGameboostId($userId);
				}
				
				return $requestData['ID'];
			}
		
		} else if($action =='updateStatus'){
			
			foreach($requestData as $key=>$val){
				$update[$key] = $val;
			}
			$this->db->where('ID', $requestData['ID']);
			if($this->db->update('tmm_subscription', $update)){
				return $requestData['ID'];
			}
			
		} else if($action =='insert'){
			foreach($requestData as $key=>$val){
				$update[$key] = $val;
			}
			$update['vLastStatus'] = 'master';
			$update['dCreatedOn'] = date('Y-m-d H:i:s');
			$update['dUpdatedOn'] = date('Y-m-d H:i:s');
			$update['dValidFrom'] = date('Y-m-d H:i:s');
			$update['dValidTill'] = date('Y-m-d H:i:s', strtotime("+ ".$update['vValidity']." days"));
			
			if($this->db->insert('tmm_subscription', $update)){
				$tmmID =  $this->db->insert_id();
				
				$userData['user_operator'] = 'telenorMM';
				$userData['user_subscription_id'] = $tmmID;
				$userData['user_subscription_status'] = $requestData['vStatus'];
				$userData['user_phone'] = $requestData['vMSISDN'];
				$userData['user_image'] = 'default.png';
				$userData['user_play_coins'] = $coins;
				$userData['user_reward_coins'] = '0';
				$userData['user_registered_on'] = date('Y-m-d H:i:s');
				$userData['user_added_on'] = time();
				$userData['user_updated_on'] = time();
				$this->db->insert('site_users', $userData);
				$userID =  $this->db->insert_id();
				if($userID){
					//update coins history
					$coinNew['coin_user_id'] 			=      $userID;
					$coinNew['coin_date']              =       date("Y-m-d");
					$coinNew['coin_section']           =       7;
					$coinNew['coin_play_coins_add']    =   		$coins;
					$coinNew['coin_type']              =       1;
					$coinNew['coin_added_on']          =       time();
					$this->db->insert('user_coins_history' , $coinNew);
					
					//create a gameboost player id
					$this->createGameboostId($userID);
				}
				
				return $userID;
			}
		}
		
		return false;
	}
	
	
	function saveActivationCallbackLog($MSISDNHash, $OPXUserID, $activationCode, $responseURL, $activationTimeout, $type, $responseJSON ){
		$log['log_MSISDNHash'] = $MSISDNHash;
		$log['log_OPXUserID'] = $OPXUserID;
		$log['log_ActivationCode'] = $activationCode;
		$log['log_ActivationLink'] = $responseURL;
		$log['log_ActivationTimeout'] = $activationTimeout;
		$log['log_type'] = $type;
		$log['log_response_data'] = $responseJSON;
		$log['log_added_on']  = time();
		$this->db->insert('tmm_activation_logs' , $log);
    }
     
	
	
	function getUserBySubscriptionId($subscriptionId){
		$this->db->select("*", FALSE);
		$this->db->where('user_subscription_id', $subscriptionId);
		return  $this->db->get('site_users')->row();
    }
     
	
	function getUser($id){
		$this->db->select("*", FALSE);
		$this->db->where('user_id', $id);
		return  $this->db->get('site_users')->row();
    }
     
	function createShareCode($length){
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(str_shuffle($str_result), 0, $length);
	}

	function createGameboostId($userId){
		/*if(!empty($userId)){
			$userInfo = $this->getUser($userId);
			
			$gameboostMSISDN = $userInfo->user_phone;
			$gameboostNickname = "unknowntmm_".$userId;
			$gameboostEmail = "tmm_".$userInfo->user_phone."@igpl.pro";
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

*/		
	}
	

	
}

?>
