<?php
defined('BASEPATH') OR exit('No direct script access allowed');


 class Test extends CI_Controller {
	
	public  function __construct(){
		parent:: __construct();		
			$this->load->model('user_model','USERDBAPI');
    }

	public function index()	{	}
	public function addData()	{	
	
		$data['name'] = "nisha";
		$data['seq'] = "1";
		$this->db->insert('test_crons', $data);
	
	}
	
	public function showData()	{	
	
		$list = $this->db->query("SELECT * FROM tbl_test_crons")->result_array();
		echo "<table>";
		foreach($list as $row){
			
			echo "<tr>";
				echo "<td>".$row['id']."</td>";
				echo "<td>".$row['name']."</td>";
				
			echo "</tr>";
		
		}
		echo "</table>";
	}
	
//*********************  *********************************************************** *********************************//	
//*********************  Functions needed for Calculations starts *********************************//	
 

	public function updateGames(){
		$apiURL = "http://68.168.100.55/Gplapi/GetGames?Published=0&Status=1&GameID=0&CategoryID=0";

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $apiURL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET"	
		));

		$responseData = curl_exec($curl);
		$resData = json_decode($responseData, true);	

		echo "<pre>";
		// print_r($resData);
		echo "</pre>";


		if(is_array($resData) && count($resData)>0){
			$gamesArr = array(); $i=0;
			foreach($resData as $row){
				
				$rowArr = array();
				foreach($row as $key=>$val){
					$rowArr[$key] = $val;
					$rowArr['added_on'] = time();
				}
				//unset($rowArr['id']);
				$gamesArr[] = $rowArr;
				$i++;
			}
			
			$this->db->insert_batch('games', $gamesArr);
			
		}
	}


	public function updateUsers(){
		$apiURL = "http://68.168.100.55/Gplapi/GetUsers?UserType=2&vMSISDN=0";

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $apiURL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET"	
		));

		$responseData = curl_exec($curl);
		$resData = json_decode($responseData, true);	

		echo "<pre>";
		// print_r($resData);
		echo "</pre>";


		if(is_array($resData) && count($resData)>0){
			$gamesArr = array(); $i=0;
			foreach($resData as $row){
				
				$rowArr = array();
				foreach($row as $key=>$val){
					$rowArr[$key] = $val;
					$rowArr['user_added_on'] = time();
				}
				$gamesArr[] = $rowArr;
				$i++;
			}
			
			$this->db->insert_batch('fake_users', $gamesArr);
			
		}
	}

	public function playGame(){
		
		$this->load->view('user/play_game_test');
		
		
	}

	public function getGameScore(){
		
		$this->load->view('user/play_game_test');
		
		
	}

	public function showUsersData()	{	
	
		$list = $this->db->query("SELECT * FROM tbl_site_users")->result_array();
		
		foreach($list as $row){
			
			echo "<pre>";
			print_r($row);
			echo "</pre>";
		}
		
	}
	

	public function download(){
		$games = $this->SITEDBAPI->getGamesList();	
		$files = array();		
		foreach($games as $row){
			$imgPath = $row['GameImage'];
			array_push($files, $imgPath);
		}
		$zip = new ZipArchive();
		$tmp_file = tempnam('.', '');
		$zip->open($tmp_file, ZipArchive::CREATE);


		foreach ($files as $file) {   
			$download_file = file_get_contents($file);    
			$zip->addFromString(basename($file), $download_file);
		}

		$zip->close();

		header('Content-disposition: attachment; filename="myfile.zip"');
		header('Content-type: application/zip');
		readfile($tmp_file);
		unlink($tmp_file);
	}
	
	
	public function exportSheet(){
		$this->load->library("PHPExcel"); 
		//$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objReader = PHPExcel_IOFactory::createReaderForFile("./uploads/GPLPublishedGames.xlsx");
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load("./uploads/GPLPublishedGames.xlsx");
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);  
		$objWorksheet1 = $objPHPExcel->getActiveSheet();
		$lastRow      = $objWorksheet1->getHighestRow(1);  
		
		for($i=2; $i<=$lastRow; $i++){
			$id = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
			$category = $objWorksheet->getCellByColumnAndRow(23,$i)->getValue();
			
			$update['portalPublished'] = '1';
			$update['portalCategory'] = trim($category);
			$this->db->where('id', $id);
			$this->db->update('games', $update);
		}
				
	}

	
	public function sendMail(){
		$this->load->library("PhpMailerLib");
		$mail = $this->phpmailerlib->load();
		
		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		   
		 /*  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'vaish.nisha55@gmail.com';                 // SMTP username
		    $mail->Password = 'nishavaish12#$';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to
		  */
			
			$mail->Host = 'localhost';
			$mail->SMTPAuth = false;
			$mail->SMTPAutoTLS = false; 
			$mail->Port = 25; 		  


		   //Recipients
		    $mail->setFrom('vaish.nisha55@gmail.com', 'Nisha');
		    $mail->addAddress('vaish.nisha73@gmail.com', 'Nisha Vaish');     // Add a recipient
		    $mail->addReplyTo('vaish.nisha55@gmail.com', 'Nisha');
		    //$mail->addCC('cc@example.com');
		    //$mail->addBCC('bcc@example.com');

		   
		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Here is the subject';
		    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    if($mail->send())
				echo 'Message has been sent';
			else 
				echo 'Message could not be sent.';
		} catch (Exception $e) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	
	
	
	
	function getPlayerScore(){
		
		$game_id= "108225";
		$skillpod_player_id= "17449695";
		$apiURL = "https://multiplayergameserver.com/xmlapi7/xmlapi.php?site_id=834&password=GiK2Xz9Ty&nocompress=true&action=get_scores&order_by_direction=DESC&order_by_field=score_date&game_id=".$game_id."&skillpod_player_id=".$skillpod_player_id."&show_games=false";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $apiURL);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
			$response = curl_exec($ch);
			curl_close($ch);

			$responseXML = simplexml_load_string($response);
			$responseJSON = json_encode($responseXML);

			// Convert into associative array
			$responseArray = json_decode($responseJSON, true);
			
			echo "<pre>";
			print_r($responseArray);
			echo "</pre>";
			die;


	}

	function getPlayerScore_2(){
		
		$game_id= "108225";
		$skillpod_player_id= "17449695";
		$apiURL = "https://multiplayergameserver.com/xmlapi7/xmlapi.php?site_id=834&password=GiK2Xz9Ty&nocompress=true&action=get_player_scores&order_by_field=time&order_by_direction=DESC&game_id=".$game_id."&skillpod_player_id=".$skillpod_player_id."&show_games=false";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $apiURL);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
			$response = curl_exec($ch);
			curl_close($ch);

			$responseXML = simplexml_load_string($response);
			$responseJSON = json_encode($responseXML);

			// Convert into associative array
			$responseArray = json_decode($responseJSON, true);
			
			echo "<pre>";
			print_r($responseArray);
			echo "</pre>";
			die;


	}
	
	function getPlayerScore_3(){
		
		$game_id= "108238";
		$skillpod_player_id= "17449907";
		//$apiURL = "https://multiplayergameserver.com/xmlapi7/xmlapi.php?site_id=834&password=GiK2Xz9Ty&nocompress=true&action=get_player_scores&date_from=2020-12-16&date_to=2020-12-17&order_by_field=score&order_by_direction=DESC&game_id=".$game_id."&skillpod_player_id=".$skillpod_player_id."&limit=30&show_games=false";
		$apiURL = "https://multiplayergameserver.com/xmlapi7/xmlapi.php?site_id=834&password=GiK2Xz9Ty&nocompress=true&action=get_player_scores&order_by_field=score&order_by_direction=DESC&game_id=".$game_id."&skillpod_player_id=".$skillpod_player_id."&limit=30&show_games=false";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $apiURL);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
			$response = curl_exec($ch);
			curl_close($ch);

			$responseXML = simplexml_load_string($response);
			$responseJSON = json_encode($responseXML);

			// Convert into associative array
			$responseArray = json_decode($responseJSON, true);
			
			echo "<pre>";
			print_r($responseArray);
			echo "</pre>";
			die;


	}
	
	function getgameInfo(){
		
		$game_id= "108238";
		$apiURL = "https://multiplayergameserver.com/xmlapi7/xmlapi.php?site_id=834&password=GiK2Xz9Ty&nocompress=true&action=get_games&game_id=".$game_id."&show_description=true&show_help=true&show_tip=true&exclude_category_id=0";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $apiURL);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
			$response = curl_exec($ch);
			curl_close($ch);

			$responseXML = simplexml_load_string($response);
			$responseJSON = json_encode($responseXML);

			// Convert into associative array
			$responseArray = json_decode($responseJSON, true);
			
			echo "<pre>";
			print_r($responseArray);
			echo "</pre>";
			die;


	}
	
	public function updateTournamentPlayerScore(){
		
		$tournament_id = '24';
		
		if(!empty($tournament_id) ){
			
			$tournamentInfo = $this->SITEDBAPI->getTournamentInfo($tournament_id);
			$playersList = $this->SITEDBAPI->getTournamentPlayersList($tournament_id);
		
			if(is_array($playersList) && count($playersList) >0){
			
				foreach($playersList as $player){
					
					
					$userId = $player['player_user_id'];
					$game_id = $tournamentInfo['t_game_id'];
					$skillpod_player_id =  $player['skillpod_player_id'];
					
					
					
					// Get current user score starts
					$apiURL = "https://multiplayergameserver.com/xmlapi7/xmlapi.php?site_id=834&password=GiK2Xz9Ty&nocompress=true&action=get_scores&order_by_direction=DESC&game_id=".$game_id."&skillpod_player_id=".$skillpod_player_id."&show_games=false";
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $apiURL);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
					curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
					$response = curl_exec($ch);
					curl_close($ch);

					$responseXML = simplexml_load_string($response);
					$responseJSON = json_encode($responseXML);

					// Convert into associative array
					$responseArray = json_decode($responseJSON, true);
					
				/*	echo "<pre>";
					print_r($responseArray);
					echo "</pre>";
					die;
		*/
				//	$userScore = @$responseArray['player_scores']['player_score_0']['score'];
				//	$scoreTime = @$responseArray['player_scores']['player_score_0']['time'];
				//	$scoreTime = date('Y-m-d', strtotime($scoreTime));
				
					$userScore = @$responseArray['scores']['score_0']['score'];
					$scoreDate = @$responseArray['scores']['score_0']['score_date'];
					$scoreDate = date('Y-m-d', strtotime($scoreDate));
					
					$t_start_date = $tournamentInfo['t_start_date'];
					$t_end_date = $tournamentInfo['t_end_date'];
					
					/*if($t_start_date <= $scoreDate ){
						if(!empty($userScore))
							$currentScore = $userScore;
						else
							$currentScore = 0;
					} else {
						$currentScore = 0;
					}
					*/
					
					if(!empty($userScore))
						$currentScore = $userScore;
					else
						$currentScore = 0;
					
					
				
					
					//Get User last saved score
					$scoreInfo = $this->SITEDBAPI->getTournamentPlayerScore($tournament_id, $userId);
					$lastScore = @$scoreInfo['player_score'];
					$player_id = @$scoreInfo['player_id'];
					/*
					if($currentScore >= $lastScore){
						$saveScore['player_score'] = $currentScore;
						$this->db->where('player_id', $player_id);
						$this->db->update('user_tournament_players', $saveScore);
					}
					*/
					
					echo "User: ".$player['user_email'];
					
					echo "<br>";
					
					echo "Current Score: ".$currentScore;
					
					echo "<br>";
					
					echo "Last Score: ".$lastScore;
					
					echo "<br>";echo "<br>";echo "<br>";
					
					
			
				}
			
			}
			
		} else {
			redirect();
		}
		
	}

	function createShareCode($length){
		// String of all alphanumeric character
		$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

		// Shufle the $str_result and returns substring
		// of specified length
		return substr(str_shuffle($str_result), 0, $length);
	}
	
	public function createGameboostId($user_id='48', $email='sanjay@18boxmedia.com'){
		if(!empty($user_id) && !empty($email)){
			//$user_id = "1";
			//$email = "nisha@gmail.com";
			$objectid = time();
			$nick = "unknown_".$user_id;
			$password = $this->createShareCode(12);
		//	$url = "https://multiplayergameserver.com/xmlapi7/xmlapi.php?site_id=834&password=GiK2Xz9Ty&nocompress=true&action=register_player&nick={nickname}&player_password={password}&email={email}&gender={gender}&date_of_birth={DOB}&msisdn={objectid}";		 
			$url = "https://multiplayergameserver.com/xmlapi7/xmlapi.php?site_id=834&password=GiK2Xz9Ty&nocompress=true&action=register_player&nick=".$nick."&player_password=".$password."&email=".$email."&msisdn=".$objectid;		 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );		
			$response = curl_exec($ch);
			curl_close($ch);
				
			$xmlResponse = simplexml_load_string($response);
			echo "<pre>"; print_r($xmlResponse); echo "</pre>";
			
			$status = $xmlResponse->result;
			
		/*	if(!empty($status) && $status == 'success'){
				$skillpod_player_id = $xmlResponse->skillpod_player_id;
				$skillpod_player_key = $xmlResponse->skillpod_player_key;
				
				$dataUser['skillpod_nickname'] = $nick;
				$dataUser['skillpod_password'] = $password;
				$dataUser['skillpod_object_id'] = $objectid;
				$dataUser['skillpod_player_id'] = $skillpod_player_id;
				$dataUser['skillpod_player_key'] = $skillpod_player_key;
				$this->db->where('user_id', $user_id);
				$this->db->update('site_users', $dataUser);
			}
			
			*/
		}
	}
	
	

}
