<?php
   
require APPPATH . 'libraries/REST_Controller.php';
defined('BASEPATH') OR exit('No direct script access allowed'); 

     
class Callbacks extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('callback_model','CALLBACKDB');
        $this->load->library('user_agent');
        $this->load->helper('timezone');
        timezone();
    }

	public function index_get(){
		redirect('error');
	}  

	public function index_post(){
		redirect('error');
	}  

    /* ********** Activation Callback Request for Subscription *********** */
    public function activationRequest_post(){
        $callbackRequest = file_get_contents('php://input');
        $callbackRequestJSON = json_decode($callbackRequest, true);
        $_callback['operator'] = "TelenorMM";
        $_callback['data'] =  $callbackRequest;

        if(empty($callbackRequest)){		   
             $status = (string) parent::HTTP_BAD_REQUEST;
             $response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
             $this->response($response, $status);		  
        } else {
            //First update the callback data in log table
            if($this->CALLBACKDB->updateCallbackLogs($type = "activation-callback", json_encode($_callback))){
           
                $coins = "0"; $playerId = "";  $id = "0";  $myAction = "insert";  $vLastStatus = "";
                $reqStatus = ""; $planId = "daily"; $validity = "1";

                $requestData = json_decode($callbackRequest);

                if(empty($requestData->AmountDeducted) || empty($requestData->MSISDNHash)){
                    $status = (string) parent::HTTP_BAD_REQUEST;
                    $response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
                    $this->response($response, $status);
               
                } else {
                    // Check the staus code to find the request type
                    if($requestData->StatusCode == "0")
                        $reqStatus = "sub";
                    else if($requestData->StatusCode == "2")
                        $reqStatus = "inprocess";
                    else if($requestData->StatusCode == "13" || $requestData->StatusCode == "6" )
                        $reqStatus = "parking";
                    else
                        $reqStatus = $requestData->StatusCode;
                    
                    // Calculate the validity and coins value
                    $planId = "weekly";
                    if($requestData->AmountProcessed == "MMK:50000" || $requestData->AmountProcessed == "50000:MMK"){
                        $requestData->AmountProcessed = "MMK:50000";
                        $validity = "7";
                        $coins = $reqStatus == "sub" ? "1000" : "100";
                    } else if($requestData->AmountProcessed == "MMK:35000" || $requestData->AmountProcessed == "35000:MMK"){
                        $requestData->AmountProcessed = "MMK:35000";
                        $validity = "4";
                        $coins = $reqStatus == "sub" ? "500" : "100";
                    } else if($requestData->AmountDeducted == "MMK:50000" || $requestData->AmountDeducted == "50000:MMK"){
                        $validity = "1";
                        $coins = "100";
                    } else{
                        $validity = "1";
                        $coins = $reqStatus == "sub" ? "200" : "100";
                    }
					
					//echo "<pre>";  print_r($requestData); echo "</pre>"; die;
					

                    // Check user already exist in db
                    $checkUserSubscription =  $this->CALLBACKDB->checkUserSubscription($filter="isSubscribed", $requestData->MSISDNHash);
                    if(is_array($checkUserSubscription) && !empty($checkUserSubscription)){
    
                        $id = $checkUserSubscription['ID'];
                        $myAction = "updateACT";
                        $vLastStatus = $checkUserSubscription['vStatus'];
                        $playerId = $checkUserSubscription['PlayerID'];
                    } 

                    
                    $activationCode = $this->getActivationCode();
					$activationTimeout = (string) strtotime("+1 day");

                    //$is_added = $this->CALLBACKDB->InsertTelenorSubscriptionData($MyAction, $id, $callbackRequest, $reqStatus, $vLastStatus);
                    $insertJSON = array("ID"=>$id, "PlayerID"=> $playerId, "vStatus" => $reqStatus, "vLastStatus" => $vLastStatus, "vMSISDN" => $requestData->MSISDNHash, "vLink" => "BEMOBI", "vTName" => "BEMOBI", "vPName" => "BEMOBI", "vService" => $requestData->ProductID, "vPlanID" => $planId, "vPrice" => $requestData->AmountProcessed, "vValidity" => $validity, "vMode" => $requestData->Channel, "ActivationCode" => $activationCode, "ProductID" => $requestData->ProductID, "OPXUserID" => $requestData->OPXUserID, "OPXSubscriptionID" => $requestData->OPXSubscriptionID, "OPXTransactionID" => $requestData->OPXTransactionID, "EndDate" =>$requestData->EndDate, "BillingStartDate" => $requestData->BillingStartDate, "NextBillingDate" => $requestData->NextBillingDate, "UTMSource" => $requestData->UTMSource);
                    $tmmId = $this->CALLBACKDB->InsertTelenorSubscriptionData($myAction, json_encode($insertJSON), $coins);
                    
                    if($tmmId){
						
						$responseURL = site_url()."Subscribe/".$activationCode;
						
						if (!empty($requestData->UTMSource) && strtolower($requestData->UTMSource) == "gpltapp"){
							$responseURL .= "?type=app";
						}
						
						$response = ['ActivationCode' =>$activationCode, 'ActivationLink' => $responseURL, 'ActivationTimeout'=>$activationTimeout];
                        
						//Save activation log
						$this->CALLBACKDB->saveActivationCallbackLog($requestData->MSISDNHash,  $requestData->OPXUserID, $activationCode, $responseURL, $activationTimeout, $type="ActivationCallback", json_encode($response));
						
						$status = (string) parent::HTTP_OK;
						$this->response($response, $status);	
                   
				   } else {
						$status = (string) parent::HTTP_BAD_REQUEST;
						$response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
						$this->response($response, $status);
					}
                }
           
            } else {
                $status = (string) parent::HTTP_BAD_REQUEST;
                $response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
                $this->response($response, $status);	
            }
        }
    }


	/* ********** Payment Callback Request for Subscription *********** */
    public function paymentRequest_post(){
        $callbackRequest = file_get_contents('php://input');
        $callbackRequestJSON = json_decode($callbackRequest, true);
        $_callback['operator'] = "TelenorMM";
        $_callback['data'] =  $callbackRequest;

        if(empty($callbackRequest)){		   
             $status = (string) parent::HTTP_BAD_REQUEST;
             $response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
             $this->response($response, $status);		  
        } else {
            //First update the callback data in log table
            if($this->CALLBACKDB->updateCallbackLogs($type = "payment-callback", json_encode($_callback))){
           
                $coins = "0"; $playerId = "";  $id = "0";  $myAction = "insert";  $vLastStatus = "";
                $reqStatus = ""; $planId = "daily"; $validity = "1";

                $requestData = json_decode($callbackRequest);

                if(empty($requestData->AmountDeducted) || empty($requestData->MSISDNHash)){
                    $status = (string) parent::HTTP_BAD_REQUEST;
                    $response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
                    $this->response($response, $status);
               
                } else {
					
					// Check user already exist in db
                    $checkUserSubscription =  $this->CALLBACKDB->checkUserSubscription($filter="isSubscribed", $requestData->MSISDNHash);
                    if(is_array($checkUserSubscription) && !empty($checkUserSubscription)){
    
                        $id = $checkUserSubscription['ID'];
                        $myAction = "updatePAY";
                        $vLastStatus = $checkUserSubscription['vStatus'];
                        $playerId = $checkUserSubscription['PlayerID'];
                    }
					
                    // Check the staus code to find the request type
                    if($requestData->StatusCode == "0"){
						if (!empty($vLastStatus) && strtolower($vLastStatus) == "inprocess" || strtolower($vLastStatus) == "parking"){
							$reqStatus = "sub";
						} else{
							$reqStatus = "renew";
						}
                    } else {
                        $reqStatus = $requestData->StatusCode;
                    }
					
                    // Calculate the validity and coins value
                    $planId = "weekly";
                    if($requestData->AmountProcessed == "MMK:50000" || $requestData->AmountProcessed == "50000:MMK"){
                        $requestData->AmountProcessed = "MMK:50000";
                        $validity = "7";
                    } else if($requestData->AmountProcessed == "MMK:35000" || $requestData->AmountProcessed == "35000:MMK"){
                        $requestData->AmountProcessed = "MMK:35000";
                        $validity = "4";
					} else{
                        $validity = "1";
                    }
					
					$activationCode = $this->getActivationCode();
					$activationTimeout = (string) strtotime("+1 day");
					//$responseURL = "http://playtm.igpl.pro/sub/redirect/".$activationCode;
					$responseURL = site_url()."Subscribe/".$activationCode;
					$response = ['ActivationCode' =>$activationCode, 'ActivationLink' => $responseURL, 'ActivationTimeout'=>$activationTimeout];
                     
					 
                    if($myAction == "updatePAY" && !empty($planId) && $planId == "weekly" && $requestData->AmountProcessed == "MMK:50000"){
						$coins = "1000";
						/// need to confirm the data
						$countRenewals = $this->CALLBACKDB->checkRenewals($id);
						//echo $countRenewals->renew_count;
						if($countRenewals->renew_count == 0){
							$coins = "1000";
						} else if($countRenewals->renew_count == 1){
							$coins = "1200";
						} else if($countRenewals->renew_count == 2){
							$coins = "1500";
						} else if($countRenewals->renew_count == 3){
							$coins = "2000";
						} else if($countRenewals->renew_count >= 4){
							$coins = "2500";
						}
						
                    } else {
						if ($planId == "weekly")
							$coins = "1000";
						else
							$coins = "200";
						
						//Save activation log
						$this->CALLBACKDB->saveActivationCallbackLog($requestData->MSISDNHash,  $requestData->OPXUserID, $activationCode, $responseURL, $activationTimeout, $type="PaymentCallback", json_encode($response));
					}
					
                    $insertJSON = array("ID"=>$id, "PlayerID"=> $playerId, "vStatus" => $reqStatus, "vLastStatus" => $vLastStatus, "vMSISDN" => $requestData->MSISDNHash, "vLink" => "BEMOBI", "vTName" => "BEMOBI", "vPName" => "BEMOBI", "vService" => $requestData->ProductID, "vPlanID" => $planId, "vPrice" => $requestData->AmountProcessed, "vValidity" => $validity, "vMode" => $requestData->Channel, "ActivationCode" => $activationCode, "ProductID" => $requestData->ProductID, "OPXUserID" => $requestData->OPXUserID, "OPXSubscriptionID" => $requestData->OPXSubscriptionID, "OPXTransactionID" => $requestData->OPXTransactionID, "EndDate" =>$requestData->EndDate, "BillingStartDate" => $requestData->BillingStartDate, "NextBillingDate" => $requestData->NextBillingDate, "UTMSource" => $requestData->UTMSource);
                    $tmmId = $this->CALLBACKDB->InsertTelenorSubscriptionData($myAction, json_encode($insertJSON), $coins);
                    
                    if($tmmId){
						
						$status = (string) parent::HTTP_OK;
						$response = ['status' =>'SUCCESS'];
						$this->response($response, $status);	
                   
					} else {
						$status = (string) parent::HTTP_BAD_REQUEST;
						$response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
						$this->response($response, $status);
					}
                }
            } else {
                $status = (string) parent::HTTP_BAD_REQUEST;
                $response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
                $this->response($response, $status);	
            }
        }
    }

	
    /* ********** Callback Request for Active / Inactive / Suspend Subscription *********** */
	public function callbackRequest_post(){
       
        $callbackRequest = file_get_contents('php://input');
        $callbackRequestJSON = json_decode($callbackRequest, true);
        $_callback['operator'] = "TelenorMM";
        $_callback['data'] =  $callbackRequest;

        if(empty($callbackRequest)){		   
             $status = (string) parent::HTTP_BAD_REQUEST;
             $response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
             $this->response($response, $status);		  
        } else {
            //First update the callback data in log table
            if($this->CALLBACKDB->updateCallbackLogs($type = "callback", json_encode($_callback))){

                $reqStatus = ''; $myAction = 'insert'; $reqLastStatus = '';
               
                $requestData = json_decode($callbackRequest);

                if (!empty($requestData->NotificationType)){
                    
                    $notificationType = strtolower($requestData->NotificationType);

                    if($notificationType == 'suspend_subscription'){
                        $reqStatus = 'suspend';
                    } else if($notificationType == 'cancel_subscription' || $notificationType == 'parked_cancelled' || $notificationType == 'inprogress_cancelled'){
                        $reqStatus = 'unsub';
                    } else if($notificationType == 'activate_subscription'){
                        $reqStatus = 'active';
                    } else {
                        $reqStatus = $notificationType;
                    }
                } else {
                    $reqStatus = 'unknown';
                }

                // check user subscription 
                $checkUserSubscription =  $this->CALLBACKDB->checkUserSubscription($filter="OPXUserID", $requestData->OPXUserID);
                if(is_array($checkUserSubscription) && !empty($checkUserSubscription)){

                    $id = $checkUserSubscription['ID'];
                    $myAction = $reqStatus == "unsub" ? "updateUnsub" : "updateStatus";
                    $vLastStatus = $checkUserSubscription['vStatus'];

					//   $is_added = $this->CALLBACKDB->InsertTelenorSubscriptionData($myAction, $id, $callbackRequest, $reqStatus, $vLastStatus);
                    $insertJSON = array("ID" => $id, "vMSISDN" => $requestData->MSISDNHash, "vStatus" => $reqStatus, "vLastStatus" => $vLastStatus, "vMode" => $requestData->Reason, "ProductID" => $requestData->ProductID, "OPXUserID" => $requestData->OPXUserID, "OPXSubscriptionID" => $requestData->OPXSubscriptionID, "OPXTransactionID" => $requestData->OPXTransactionID, "EndDate" => $requestData->LastPaymentCycleEndDate, "UTMSource" => $requestData->UTMSource );
                    $is_added = $this->CALLBACKDB->InsertTelenorSubscriptionData($myAction, json_encode($insertJSON));
                   
                    if($is_added){
                        if($reqStatus == 'unsub'){
                            $this->manageUserCoins();
                        }

                        $status = (string) parent::HTTP_OK;
						$response = ['status' =>'SUCCESS'];
                        $this->response($response, $status);	
                    }
                } else {
                    $_callback['invalid'] =  '1';
                    $_callback['invalid_reason'] =  $reqStatus;
                    $this->CALLBACKDB->updateCallbackLogs($type = 'callback', json_encode($_callback));

                    $status = (string) parent::HTTP_OK;
					$response = ['status' =>'SUCCESS'];
                    $this->response($response, $status);	
                }

            } else {
                $status = (string) parent::HTTP_BAD_REQUEST;
                $response = ['status' =>'FAIL', 'message' => 'Bad Request Found!'];
                $this->response($response, $status);
            }
        }
    }
    
    
    
    private function manageUserCoins(){

    }

      
	function createShareCode($length){
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(str_shuffle($str_result), 0, $length);
	}


    private function createGameboostPlayerId($id, $MSISDN){
        $uniq_num = uniqid();
        if(!empty($id))
            $gameboostNickname = "utmm_".$id;
        else 
            $gameboostNickname = "utmm_".$uniq_num;

			$gameboostMSISDN = $MSISDN;
			$gameboostEmail = "utmm_".$uniq_num."@igpl.pro";
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
				
				$dataUser['iplayer_nickname'] = $gameboostNickname;
				$dataUser['iplayer_password'] = $gameboostPassword;
				$dataUser['iplayer_object_id'] = $gameboostMSISDN;
				$dataUser['iplayer_player_id'] = $skillpod_player_id;
				$dataUser['iplayer_player_key'] = $skillpod_player_key;
				$dataUser['iplayer_added_on'] = time();
				$this->db->insert('site_user_players', $dataUser);

                return $this->db->insert_id();
			} 
            return false;
    }

    private function getActivationCode(){
        return  uniqid();
    }

   
    
	

}