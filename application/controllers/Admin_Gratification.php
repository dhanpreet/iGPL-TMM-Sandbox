<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Admin_Gratification extends CI_Controller {
    public  function __construct(){
        parent:: __construct();
        $this->load->library('session');
        $this->load->model('Admin_Gratification_model','ADMINDBAPI');
        $this->load->library('session');
		$this->load->library('encrypt');
    }


    public function liveTournamentsResults(){
		
        $todayHrsStart =  date('Y-m-d', strtotime('-1 day'));
        $todayHrsEnd =  date('Y-m-d');
        
        
        //	$list = $this->db->query("SELECT `tbl_tournaments`.tournament_id,`tbl_tournaments`.tournament_section, `tbl_tournaments_fee_rewards`.fee_tournament_prize_1, `tbl_tournaments_fee_rewards`.fee_tournament_prize_2,`tbl_tournaments_fee_rewards`.fee_tournament_prize_3,`tbl_tournaments_fee_rewards`.fee_tournament_prize_4,`tbl_tournaments_fee_rewards`.fee_tournament_prize_5,`tbl_tournaments_fee_rewards`.fee_tournament_prize_6,`tbl_tournaments_fee_rewards`.fee_tournament_prize_7,`tbl_tournaments_fee_rewards`.fee_tournament_prize_8 FROM tbl_tournaments left join tbl_tournaments_fee_rewards on `tbl_tournaments_fee_rewards`.fee_turnament_id = `tbl_tournaments`.tournament_id WHERE  `tbl_tournaments`.tournament_end_date BETWEEN '$todayHrsStart' AND '$todayHrsEnd' ")->result_array();
        $list = $this->db->query("SELECT `tbl_tournaments`.tournament_id,`tbl_tournaments`.tournament_section,`tbl_tournaments_fee_rewards`.fee_tournament_rewards, `tbl_tournaments_fee_rewards`.fee_tournament_prize_1, `tbl_tournaments_fee_rewards`.fee_tournament_prize_2,`tbl_tournaments_fee_rewards`.fee_tournament_prize_3,`tbl_tournaments_fee_rewards`.fee_tournament_prize_4,`tbl_tournaments_fee_rewards`.fee_tournament_prize_5,`tbl_tournaments_fee_rewards`.fee_tournament_prize_6,`tbl_tournaments_fee_rewards`.fee_tournament_prize_7,`tbl_tournaments_fee_rewards`.fee_tournament_prize_8,`tbl_tournaments_fee_rewards`.fee_tournament_prize_9	 FROM tbl_tournaments left join tbl_tournaments_fee_rewards on `tbl_tournaments_fee_rewards`.fee_turnament_id = `tbl_tournaments`.tournament_id WHERE  `tbl_tournaments`.tournament_end_date = '$todayHrsStart' ")->result_array();
        
        //	echo $this->db->last_query();
        if(is_array($list) && count($list)>0){
             
            foreach($list as $tRow)
            {
                
                $t_id = $tRow['tournament_id'];
                
                
                    // Get the tournament result status
                
                $tResult = $this->db->query("SELECT count(*) as no_rows FROM tbl_tournaments_results WHERE result_t_id = '$t_id' ")->row_array();
        
                 
                if($tResult['no_rows']<=0){
                     
                
                    // Manage a aaray for rank-wise prizes
                    $t_prize_1 = $tRow['fee_tournament_prize_1'];  	// For 1st rank
                    $t_prize_2 = $tRow['fee_tournament_prize_2'];  	// For 2nd rank
                    $t_prize_3 = $tRow['fee_tournament_prize_3'];  	// For 3rd rank
                    $t_prize_4 = $tRow['fee_tournament_prize_4']; 	// For 4-5 rank 
                    $t_prize_5 = $tRow['fee_tournament_prize_5'];  	// For 6-10 rank
                    $t_prize_6 = $tRow['fee_tournament_prize_6'];  	// For 11-25 rank
                    $t_prize_7 = $tRow['fee_tournament_prize_7'];  	// For 26-50 rank
                    $t_prize_8 = $tRow['fee_tournament_prize_8']; 	// For 51-100 rank
                    $t_prize_9 = $tRow['fee_tournament_prize_9'];	// For 101-200 rank
                    $array['prizes'] = array("1"=>$t_prize_1, "2"=>$t_prize_2, "3"=>$t_prize_3);
                    
                    if($t_prize_4)
                    {
                        $array['prizes']["4"] = $t_prize_4;
                        $array['prizes']["5"] = $t_prize_4;
                    }
                    if($t_prize_5)
                    {
                        for($i = 6; $i<=10; $i++)
                        {
                            $array['prizes'][$i] = $t_prize_5;
                        }
                    }
                    if($t_prize_6)
                    {
                        for($i = 11; $i<=25; $i++)
                        {
                            $array['prizes'][$i] = $t_prize_6;
                        }
                    }
                    if($t_prize_7)
                    {
                        for($i = 26; $i<=50; $i++)
                        {
                            $array['prizes'][$i] = $t_prize_7;
                        }
                    }
                    if($t_prize_8)
                    {
                        for($i = 51; $i<=100; $i++)
                        {
                            $array['prizes'][$i] = $t_prize_8;
                        }
                    }
                    if($t_prize_9)
                    {
                        for($i = 101; $i<=200; $i++)
                        {
                            $array['prizes'][$i] = $t_prize_8;
                        }
                    }
                    
                
                    // Get the tournament players
                    $no_player_selected = count($array['prizes']);
                        
                    $playersList = $this->db->query("SELECT * FROM tbl_tournaments_players WHERE player_t_id = '$t_id' AND player_score > '0' ORDER BY player_score DESC, player_score_updated  ASC LIMIT $no_player_selected")->result_array();
                    //  print_r($playersList);
                    //  die();
                    
                    if(is_array($playersList) && count($playersList)>0){
                        
                        $highest_score = $playersList[0]['player_score'];
                        $rank = 1;
                        $arrIndex = 1;
                        
                        foreach($playersList as $player){
                            if($player['player_score'] >0){
                                $userId = $player['player_user_id'];
                                $userInfo = $this->ADMINDBAPI->validateUser($userId);
                                if($list[0]['fee_tournament_rewards']==3)
                                {
                                
                                    $data['tg_player_user_id'] = $userId;
                                    $data['tg_player_msisdn'] = $userInfo['user_phone'];
                                    $data['tg_t_id'] = $player['player_t_id'];
                                    $data['tg_player_id'] = $player['player_id'];
                                    $data['tg_player_score'] = $player['player_score'];
                                    $data['tg_player_rank'] = $rank;
                                    $data['tg_ref_id'] = time().'e'.time().'c'.$userId;
                                    $data['tg_player_reward'] = $array['prizes'][$rank];
                                    $data['tg_is_gratify'] = 0;
                                    $this->db->insert('tbl_talktime_gratification' , $data);
                                    // die();
                                }
                                else
                                {
                                    
                                    $this->distributeTournamentReward($player['player_id'] , $rank , $array['prizes'][$rank]);
                                    $this->updateRewardCoins($userId , $userInfo['user_reward_coins'] , $array['prizes'][$rank]);
                                    $this->updateRewardCoinsHistory($userId, $array['prizes'][$rank]);
                                    
                                }
                            } 
                            $rank++;
                        }
                        if($list[0]['fee_tournament_rewards']==3)
                        {
                            $skuCode = $this->ADMINDBAPI->getSkuCode();
                            if(!empty($skuCode))
                            {
                                $reward=[];
                                $sku=[];
                                foreach($skuCode as $row)
                                {
                                    $reward[$row['tr_reward_amount']] = $row['tr_usd_amount'];
                                    $sku[$row['tr_reward_amount']]	=	$row['tr_skuCode'];
                                }
                            }
                            $result = $this->generateTokenForGratification();
                            if($result)
                            {
                                $allPlayer = $this->ADMINDBAPI->getUserForGratification($t_id);
                                if(!empty($allPlayer))
                                {
                                    foreach($allPlayer as $row)
                                    {
                                        $res = $this->sendReward($row['tg_ref_id'] , $reward[$row['tg_player_reward']] , $sku[$row['tg_player_reward']] , $result);
                                        if($res)
                                        {
                                            if($res->ResultCode != 1)
                                            {	
                                                $response['dr_user_id'] = $row['tg_player_user_id'];
                                                $response['dr_refrence'] = $row['tg_ref_id'];
                                                $response['dr_SkuCode'] = $res->TransferRecord->SkuCode;
                                                $response['dr_CommissionApplied'] = $res->TransferRecord->CommissionApplied;
                                                $response['dr_ProcessingState']=	$res->TransferRecord->ProcessingState;
                                                $response['dr_AccountNumber'] = $res->TransferRecord->AccountNumber;
                                                $response['dr_ResultCode']= $res->ResultCode;
                                                $response['dr_ErrorCodes_Code'] = $res->ErrorCodes[0]->Code;
                                                $response['dr_ErrorCodes_Context'] = $res->ErrorCodes[0]->Context;
                                                $this->db->insert('tbl_ding_response' , $response);
    
                                                $gratification['tg_response'] = "Failed";
                                                $gratification['tg_error_code'] = $res->ResultCode;
                                                $gratification['tg_error_message']= $res->ErrorCodes[0]->Code;
                                                $this->db->where('tg_ref_id' , $row['tg_ref_id']);
                                                $this->db->update('tbl_talktime_gratification' , $gratification);

                                                
                                                $player2['player_reward_updated'] = 0;
                                                $player2['player_reward_error'] = $res->ErrorCodes[0]->Context;
                                                $this->db->where('player_id' , $row['tg_player_id']);
                                                $this->db->update('tbl_tournaments_players' , $player2);
                                            }
                                            else
                                            {
                                                $response['dr_user_id'] = $row['tg_player_user_id'];
                                                $response['dr_refrence'] = $row['tg_ref_id'] ; 
                                                $response['dr_TransferRef'] = $res->TransferRecord->TransferId->TransferRef;
                                                $response['dr_DistributorRef']= $res->TransferRecord->TransferId->DistributorRef;
                                                $response['dr_SkuCode'] = $res->TransferRecord->SkuCode;
                                                $response['dr_CustomerFee'] = $res->TransferRecord->Price->CustomerFee;
                                                $response['dr_DistributorFee'] = $res->TransferRecord->Price->DistributorFee;
                                                $response['dr_ReceiveValue']= $res->TransferRecord->Price->ReceiveValue;
                                                $response['dr_ReceiveCurrencyIso'] = $res->TransferRecord->Price->ReceiveCurrencyIso;
                                                $response['dr_ReceiveValueExcludingTax'] = $res->TransferRecord->Price->ReceiveValueExcludingTax;
                                                $response['dr_TaxRate'] = $res->TransferRecord->Price->TaxRate;
                                                $response['dr_SendValue'] = $res->TransferRecord->Price->SendValue;
                                                $response['dr_SendCurrencyIso'] = $res->TransferRecord->Price->SendCurrencyIso;
                                                $response['dr_CommissionApplied'] = $res->TransferRecord->CommissionApplied;
                                                $response['dr_StartedUtc'] = $res->TransferRecord->StartedUtc;
                                                $response['dr_CompletedUtc'] = $res->TransferRecord->CompletedUtc;
                                                $response['dr_ProcessingState'] = $res->TransferRecord->ProcessingState;
                                                $response['dr_AccountNumber'] = $res->TransferRecord->AccountNumber;
                                                $response['dr_ResultCode'] = $res->ResultCode;
                                                $this->db->insert('tbl_ding_response' , $response);
    
    
                                                $gratification['tg_response'] = "Success";
                                                $gratification['tg_error_code'] = $res->ResultCode;
                                                $gratification['tg_is_gratify'] =1;
                                                $this->db->where('tg_ref_id' , $row['tg_ref_id']);
                                                $this->db->update('tbl_talktime_gratification' , $gratification);
    
                                                $player2['player_reward_updated'] = 1;
                                                $player2['player_reward_rank'] 	=	$row['tg_player_rank'];
                                                $player2['player_reward_prize']	    = 	$row['tg_player_reward'];
                                                $this->db->where('player_id' , $row['tg_player_id']);
                                                $this->db->update('tbl_tournaments_players' , $player2);
    
                                            }
                                        }
                                    }
    
                                }
                            }
                        }
    
                    }
                    $update['tournament_status']=3;
                    $this->db->where('tournament_id' , $t_id);
                    $this->db->update('tbl_tournaments' , $update);
                    $updateResult['result_t_id'] = $t_id;
                    $updateResult['result_added_on'] = time();
                    $this->db->insert('tournaments_results', $updateResult);
                } 
            }
        }
    }
    
        function updateRewardCoins($userId , $existingCoins, $reward)
        {
            $data['user_reward_coins'] = $existingCoins + $reward;
            $this->db->where('user_id', $userId);
            $this->db->update('tbl_site_users' , $data);
            if($this->db->affected_rows()>0)
                return true;
            return false;
        }
        function updateRewardCoinsHistory($userId , $reward)
        {
            $data['coin_user_id'] = $userId;
            $data['coin_date'] = date('Y-m-d');
            $data['coin_section'] = 5;
            $data['coin_reward_coins_add'] = $reward;
            $data['coin_type'] = 2;
            $data['coin_added_on'] = time();
            $this->db->insert('tbl_user_coins_history' , $data);
        }
        function distributeTournamentReward($userId, $rank , $reward)
        {
            $data['player_reward_rank'] = $rank;
            $data['player_reward_prize'] = $reward;
            $this->db->where('player_id' , $userId);
            $this->db->update('tbl_tournaments_players' , $data);
        }
    
        function generateTokenForGratification()
        {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://idp.ding.com/connect/token',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'client_secret=%2FTCCXOTVAXYfSv2%2FpuA5cFZiNOQjx%2F%2BkaYL9nZ6%2BKEY%3D&client_id=2337c2b8-4284-4e93-9d6e-344950c48422&grant_type=client_credentials',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Cookie: incap_ses_165_2345414=ukGgIR7Y7SiY2IMzpzJKAlPVDGIAAAAA54xRLasBz5wLT9c342lSSg==; nlbi_2345414=eNVPXLXiCU/cz4u5vZyyQgAAAADEhX9ZhB2UDMA+8bpNgzEn; visid_incap_2345414=Ah5F2bALQkSNDza4S5FYYVLVDGIAAAAAQUIPAAAAAACGKGTQPj3FD/02uO6/CeeK'
                ),
                ));
    
                $response = curl_exec($curl);
    
                curl_close($curl);
                
                $result = json_decode($response);
                if(isset($result->access_token))
                {
                    return $result;
                }
                else
                {
                    return false;
                }
        }
    
        function sendReward($ref , $reward , $sku , $result)
        {
            // echo $sku;
            // echo $reward;
            // die();
                $curl = curl_init();
    
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.dingconnect.com/api/V1/SendTransfer',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "SkuCode":"'.$sku.'",
                    "SendValue" :"'.$reward.'",
                    "SendCurrencyIso" :"USD",
                    "AccountNumber" : "950000000000",
                    "DistributorRef" : "'.$ref.'",
                    "ValidateOnly" : false
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$result->access_token,
                    'Cookie: incap_ses_1523_1694192=EEGwXUn5uTFQHgFVfMgiFYc6DmIAAAAA11+kSXc5ZiQhnLCs4BpTqg==; incap_ses_218_1694192=2UHYFtnM6RbB0PBc5n0GA08eDmIAAAAAOtr495Q/cG3BtFl4Un5OpQ==; nlbi_1694192=lM1LO85vxwc0ovorGYVdWQAAAADeJcY1ZD0CALulv+4AJsJI; visid_incap_1694192=Yguxt22OQnCsSt6TPU/yDcoaDmIAAAAAQUIPAAAAAACNS8GHFGzCtdngsQ9Ty4Um'
                ),
                ));
    
                $response = curl_exec($curl);
    
                curl_close($curl);
                // echo "<pre>";
                $result =json_decode($response);
                // print_r($result);
                // die();
                if($result)
                {
                    return $result;
                }
                else
                    return false;
    
        }

        public function getGratificationReport()
        {
            $data['list'] = $this->ADMINDBAPI->getExpiredTournaments();
            $this->load->view('admin/gratification_report' , $data);
        }

        public function getExpiredTournament($id='')
        {
            $t_id = base64_decode($id);
            $data['list'] = $this->ADMINDBAPI->getTournamentLeaderboard($t_id);
        
            $this->load->view('admin/gratification_status' , $data);
        }
}