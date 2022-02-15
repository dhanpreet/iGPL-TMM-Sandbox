<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Common_functions extends CI_Controller {
	
	public  function __construct(){
		parent:: __construct();		
		$this->load->model('user_model','USERDBAPI');
		
    }

	public function index()	{

	}
	
//*********************  *********************************************************** *********************************//	
//*********************  Functions needed for Calculations starts *********************************//	
 
 
	function rand_float($st_num=0,$end_num=1,$mul=1000000){
		if ($st_num>$end_num) return false;
		return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
	}
	
 
	// For total tournament games division numbers in array
	function generateRandomNumbers($max, $count){
		$numbers = array();
		for ($i = 1; $i < $count; $i++) {
			$random = mt_rand(200, $max / ($count - $i));
			$numbers[] = $random;
			$max -= $random;
		}
		$numbers[] = $max;

		return $numbers;
	}
	
	// For total  practice games division numbers in array
	function generateRandomNumbersPG($max, $count){
		$numbers = array();
		for ($i = 1; $i < $count; $i++) {
			$random = mt_rand(0, $max / ($count - $i));
			$numbers[] = $random;
			$max -= $random;
		}
		$numbers[] = $max;

		return $numbers;
	}
	
	
	function getTodayStatsJazz(){		
		$url = "https://igpl.pro/user/billing/getlastdayactivebase_jazz";		 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );	
		curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(			  
			  'Content-Type: application/json'
		   ));		
		$response = curl_exec($ch);
		curl_close($ch);
		$totalUsers = json_decode($response);
	//	return $totalUsers;     
		
		$today = date('Y-m-d');
		$checkStats = $this->USERDBAPI->getTotalUsersByDate($today);		
		//Update Total Users Counts in DB
		if(is_array($checkStats) && count($checkStats) == 0){
			$update['count_date'] = date('Y-m-d');
			$update['count_users'] = $totalUsers;
			$update['count_added_on'] =  date('Y-m-d');
			$this->db->insert('users_counts', $update);
		} 
		
	}
 
	function getStats($date){
		
		$usersCount = $this->USERDBAPI->getYesterdayUsersCount();	
		$totalUsers = $usersCount['count_users'];
		if(empty($totalUsers)){
			$totalUsers = rand(100000, 200000);
		}		
		
		$engageRate = round( $this->rand_float(5.0, 6.0), 2);
		$engageBase = (int)(($totalUsers*$engageRate)/100);
		
		$gamePlayRate = round( $this->rand_float(1.2, 1.7), 2);
		$gamePlayBase = round($engageBase*$gamePlayRate);
		
		$engageRateFalse = rand(30, 35);
		$engageBaseFalse = (int)(($totalUsers*$engageRateFalse)/100);
		
		//$tournamentRate = "70";
		//$practiceRate = "30";
		$tournamentRate = rand(65, 75);
		$practiceRate = (100-$tournamentRate);
		
		$tournamentGamesCount = round(($gamePlayBase*$tournamentRate)/100);	
		$practiceGamesCount = ($gamePlayBase - $tournamentGamesCount);
		
		$visitorRate = round($this->rand_float(40, 50), 2);
		$visitorCount =  (int)(($engageBase*$visitorRate)/100);
		
		$GPEBList = $this->USERDBAPI->getTotalGPEB();
		$GPEBRate = number_format( ($GPEBList['gp_base']/$GPEBList['eng_base']), 2);
				
		$checkStats = $this->USERDBAPI->getStatsData($date);
		
		//Update Total Counts in DB
		if(is_array($checkStats) && count($checkStats) == 0){
			
			$updateStat['stat_date'] = $date;
			$updateStat['stat_total_base'] = $totalUsers;
			$updateStat['stat_eng_rate'] = $engageRate;
			$updateStat['stat_eng_base'] = $engageBase;
			$updateStat['stat_eng_rate_false'] = $engageRateFalse;
			$updateStat['stat_eng_base_false'] = $engageBaseFalse;
			$updateStat['stat_gp_rate'] = $gamePlayRate;
			$updateStat['stat_gp_base'] = $gamePlayBase;
			$updateStat['stat_tg_rate'] = $tournamentRate;
			$updateStat['stat_tg_count'] = $tournamentGamesCount;
			$updateStat['stat_pg_rate'] = $practiceRate;
			$updateStat['stat_pg_count'] = $practiceGamesCount;
			$updateStat['stat_visitor_rate'] = $visitorRate;
			$updateStat['stat_visitor_count'] = $visitorCount;
			$updateStat['stat_gpeb'] = $GPEBRate;
			$updateStat['stat_date_added'] = date('Y-m-d');
			$this->db->insert('counts_stats', $updateStat);
			
			//Update Tournament Games Count in DB
			$this->addTournamentCounts($date, $tournamentGamesCount);
			
			//Update Practice Games Count in DB
			$this->addPracticeCounts($date, $practiceGamesCount);
		}
		
		
		
		
	}
 
/*	function addTournamentCounts__old($date, $counts){		
		$startDate = $date;
		$tCount  = $counts;
		
		$gamesList = $this->USERDBAPI->getSelectedTournaments();
		$newGamesList = array_map (function($value){
			return $value['game_id'];
			} , $gamesList);
		$divided = count($gamesList);
		
		$list = $this->generateRandomNumbers($tCount, $divided);
		$i=0;
		foreach($list as $aa){
			$dataTT['tc_date'] = $startDate;
			$dataTT['tc_count'] = $aa;
			$dataTT['tc_game_id'] = $newGamesList[$i];
			$this->db->insert('tournament_counts', $dataTT);
			$i++;
		}
	}
	*/
	
	function addTournamentCounts($date, $counts){		
		$startDate = $date;
		$tCount  = $counts;		
		
		$gamesList = $this->USERDBAPI->getSelectedTournamentsPriority();
		$divided = count($gamesList);
		
		$newGamesList = array_map (function($value){
			return $value['game_id'];
		} , $gamesList);
		
		$pList = $this->generateRandomNumbers($tCount, $divided);
		rsort($pList);
		
		$finalArr = array();
		$arrlength = count($pList);
		for($x = 0; $x < $arrlength; $x++) {
			$finalArr[$x] =  $pList[$x];			
		}
		
		
		$testArr = array();
		$i=0;
		foreach($finalArr as $aa){
			$dataTT['tc_date'] = $startDate;
			$dataTT['tc_count'] = $aa;
			$dataTT['tc_game_id'] = $newGamesList[$i];
		
			$testArr[] = $dataTT;			$i++;
		}
		$this->db->insert_batch('tournament_counts_test', $testArr);
		
	}
 
 
 
	function addPracticeCounts($date, $counts){		
		$startDate = $date;
		$tCount  = $counts;
		
		$gamesList1 = $this->USERDBAPI->getSelectedPracticeGamesPart1();
		$gamesList2 = $this->USERDBAPI->getSelectedPracticeGamesPart2();
		$gamesList3 = $this->USERDBAPI->getSelectedPracticeGamesPart3();
		$divided1 = count($gamesList1);
		$divided2 = count($gamesList2);
		$divided3 = count($gamesList3);
		//print_r($gamesList);
		
		$arr1 = array_map (function($value){
		return $value['game_id'];
		} , $gamesList1);
		
		$arr2 = array_map (function($value){
		return $value['game_id'];
		} , $gamesList2);
		
		$arr3 = array_map (function($value){
		return $value['game_id'];
		} , $gamesList3);
		
		$tCount1 = round(($tCount*85)/100);
		$tCount2 = round(($tCount*14.5)/100);			
		$tCount3 = $tCount - ($tCount1+$tCount2);
		
		$pList1 = $this->generateRandomNumbersPG($tCount1, $divided1);
		$pList2 = $this->generateRandomNumbersPG($tCount2, $divided2);
		$pList3 = $this->generateRandomNumbersPG($tCount3, $divided3);

		$testArr = array();
		$i=0;
		foreach($pList1 as $aa){
			$dataTT['pc_date'] = $startDate;
			$dataTT['pc_count'] = $aa;
			$dataTT['pc_game_id'] = $arr1[$i];
		//	$this->db->insert('practice_counts', $dataTT);
			$testArr[] = $dataTT;
			$i++;
		}
		
		$j=0;
		foreach($pList2 as $aa2){
			$dataTT2['pc_date'] = $startDate;
			$dataTT2['pc_count'] = $aa2;
			$dataTT2['pc_game_id'] = $arr2[$j];
		//	$this->db->insert('practice_counts', $dataTT2);
			$testArr[] = $dataTT2;
			$j++;
		}
		
		$k=0;
		foreach($pList3 as $aa3){
			$dataTT3['pc_date'] = $startDate;
			$dataTT3['pc_count'] = $aa3;
			$dataTT3['pc_game_id'] = $arr3[$k];
		//	$this->db->insert('practice_counts', $dataTT3);
			$testArr[] = $dataTT3;
			$k++;
		}
		
		$this->db->insert_batch('practice_counts_test', $testArr);
		
	 
	}
 
 
	
	function addWeeklyTournament($date){		
		//$weekStartDate = '2020-03-01';
		$weekStartDate = $date;
		$weekEndDate = date('Y-m-d', strtotime(" $weekStartDate +6 day"));		
		$lastTournament = $this->USERDBAPI->getLastWeeklyTournament();		
		$lastTournamentStartDate  = @$lastTournament['tour_start_date'];	
	 	$lastTournamentDate  = @$lastTournament['tour_end_date'];	
		$today = date('Y-m-d');
	
		//Update Weekly Tournaments Counts in DB
		if(empty($lastTournamentDate)){
			$updateStat['tour_start_date'] = $date;
			$updateStat['tour_end_date'] = date('Y-m-d', strtotime(" $date +6 day"));			
			$updateStat['tour_counts'] = rand(55, 57);
			$this->db->insert('weekly_tournaments', $updateStat);
		
		} else if($lastTournamentDate < $today){			
			$updateStat['tour_start_date'] = date('Y-m-d', strtotime(" $lastTournamentDate +1 day"));
			$updateStat['tour_end_date'] = date('Y-m-d', strtotime(" $lastTournamentDate +7 day"));			
			$updateStat['tour_counts'] = rand(55, 57);
			$this->db->insert('weekly_tournaments', $updateStat);			
		}
	}
 
	
//*********************  Functions needed for Calculations ends *********************************//	
//*********************  ********************************************************* *********************************//	
	
	
	
	

}
