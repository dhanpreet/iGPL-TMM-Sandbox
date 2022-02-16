<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class Admin extends CI_Controller {
	
	
	public  function __construct(){
		parent:: __construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->library('encrypt');	
		$this->load->model('admin_model','ADMINDBAPI');
	
		date_default_timezone_set("Asia/Kolkata");
		
    }

	public function index()	{	
		if($this->session->userdata('admin_logged_in'))
			redirect('Admin/Home');
		else{
			$this->load->view('admin/login');
		}
	}
	
	
	public function processLogin(){
		
	 	$username = trim($_POST['username']);
		$password  = trim($_POST['password']);
	
		if(!($username && $password)){
			$this->session->set_flashdata('error','<strong>Error! </strong> Email and Password Both Fields Required.');
			redirect('Admin');
		}	else{
			$status = $this->ADMINDBAPI->getLoginStatus($username,$password);
			
			if(count($status) == 0){
				
				$this->session->set_flashdata('error','<strong>Error! </strong> Invalid Email or Password.');
				redirect('Admin');
			} else{
				$profile = $this->ADMINDBAPI->getUserInfo($status['user_id']);
		
				$user_login_data = array(
				   'username'     => $username,
				   'name'     => $status['name'],
				   'user_id'      => @$status['user_id'],
				   
			   );
				$user_login_data['admin_logged_in'] = TRUE;					
				$this->session->set_userdata($user_login_data);
				redirect('Admin/Home');		
			}
		}	
	}
	
	
	public function alert(){
		$this->session->sess_destroy();	
		redirect('Admin');			
	}
	
	public function error(){
		//$this->session->sess_destroy();
		//redirect('Admin');	
		$this->load->view('admin/error');	
	}
		
	public function logout(){	
		$this->session->sess_destroy();		
		redirect('Admin');
	}
	
	

	public function home(){
		if($this->session->userdata('admin_logged_in')){
			$data['allGames'] = $this->ADMINDBAPI->getAllGamesCount();
			$data['allPublishedGames'] = $this->ADMINDBAPI->getPublishedGamesCount();
			$data['allTournaments'] = $this->ADMINDBAPI->getTournamentsCount();
			$data['liveTournaments'] = $this->ADMINDBAPI->getLiveTournamentsCount();
			
			$this->load->view('admin/dashboard', $data);
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
			
		}
	}
	


	//******************************************************************************************//
	//************************     Update Password Starts         ************************//
	//******************************************************************************************//
	
	public function updatePassword(){
		if($this->session->userdata('admin_logged_in')){
			$user_id = $this->session->userdata('user_id');
			$data['info'] = $this->ADMINDBAPI->getUserInfo($user_id);
			$this->load->view('admin/update_password', $data);
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
			
		}
	}
	
	public function processUpdatePassword(){
		if($this->session->userdata('admin_logged_in')){
			$user_id = $this->session->userdata('user_id');
			
			$info = $this->ADMINDBAPI->getUserInfo($user_id);
		//	print_r($info); die;
			if(is_array($info) && count($info)>0){
				
				$old_password = $_POST['old_password'];
				$new_password = $_POST['new_password'];
				$confirm_password = $_POST['confirm_password'];
				
			if($old_password == $info['password']){
				$this->db->where('user_id', $user_id);
				
				if($new_password == $confirm_password){
				
					$user['password'] = $new_password;
					if($this->db->update('login', $user)){
						$this->session->set_flashdata('success','<strong> Success!</strong>  Profile settings updated successfully.');
						redirect("Admin/UpdatePassword");
					} else {
						$this->session->set_flashdata('error','<strong> Error!</strong>  Something went wrong while updating information. Please try again later.');
						redirect("Admin/UpdatePassword");
					}
				
				} else {
					$this->session->set_flashdata('error',"<strong>Error! </strong> New password and confirm password doesn't match.");
					redirect("Admin/UpdatePassword");
				}
			
			} else {
				$this->session->set_flashdata('error','<strong>Error! </strong> Old password is incorrect.');
				redirect("Admin/UpdatePassword");
			}
				
			} else {
				$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
				redirect('Admin');
			
			}
		
		} else {
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
			
		}
		
	}
	
	//******************************************************************************************//
	//************************     Update Password Ends         ************************//
	//******************************************************************************************//
	
	
	
	
	//  **************************************   ***************************** **************************************//
	//  **************************************   Games Categories Section Starts **************************************//
	//  **************************************   ***************************** **************************************//
	
	
	
	public function getCategories(){
		if($this->session->userdata('admin_logged_in')){
			$data['list'] = $this->ADMINDBAPI->getCategoriesList();
			$this->load->view('admin/categories_list', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	
	public function processCategory(){
		if($this->session->userdata('admin_logged_in')){
			
			$id = base64_decode(@$_POST['category_id']); 
			foreach($_POST as $key=>$val){
				$data[$key] = $val;
			}	
			unset($data['category_id']);
			
			
			if($id){
				$data['category_updated_on'] = time();
				$this->db->where('category_id', $id);				
				if($this->db->update('categories', $data)){
					$this->session->set_flashdata('success','<strong> Success! </strong> Category information updated successfully. ');
					redirect("Admin/ManageCategories");
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to update category information. Please try again.');
					redirect("Admin/ManageCategories");
				}				
			} else {
				$data['category_added_on'] = time();
				$data['category_updated_on'] = time();
				
				if($this->db->insert('categories', $data)){
					$this->session->set_flashdata('success','<strong> Success! </strong> Category information added successfully. ');
					redirect("Admin/ManageCategories");
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to add new category information. Please try again.');
					redirect("Admin/ManageCategories");
				}
			}
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}

	
	
	//  **************************************   ***************************** **************************************//
	//  **************************************   Games Categories Section Ends **************************************//
	//  **************************************   ***************************** **************************************//
	
	
	
	
	
	
	//  **************************************   ***************************** **************************************//
	//  **************************************   Games Section Starts **************************************//
	//  **************************************   ***************************** **************************************//
	
	public function getGames(){
		if($this->session->userdata('admin_logged_in')){
			$data['categories'] = $this->ADMINDBAPI->getCategoriesList();
			$data['list'] = $this->ADMINDBAPI->getGamesList();
			$this->load->view('admin/games_list', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function getPlayGame($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			$data['gameInfo'] = $this->ADMINDBAPI->getGamesInfoByGameboostId($id);
			$data['gameId'] = $id;
			$this->load->view('admin/play_game', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function updateGameInfo(){
		if($this->session->userdata('admin_logged_in')){
		
			$id = @$_POST['id']; 
			$gid = @$_POST['gid']; 
			foreach($_POST as $key=>$val){
				$data[$key] = $val;
			}	
			unset($data['id']);
			unset($data['gid']);
			
			$category_id = $_POST['portalCategoryId'];
			$categoryInfo = $this->ADMINDBAPI->getCategoriesInfo($category_id);
			$data['portalCategory'] = $categoryInfo['category_name'];
			
		
			if($id && $gid){				
				$this->db->where('id', $id);				
				$this->db->where('gid', $gid);				
				if($this->db->update('games', $data)){
					$this->session->set_flashdata('success','<strong> Success! </strong> Game information updated successfully. ');
					redirect("Admin/ManageGames");
					
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to update game information. Please try again.');
					redirect("Admin/ManageGames");
				}				
			} else {
				$this->session->set_flashdata('error','<strong> Error! </strong> Unable to update game information. Please try again.');
				redirect("Admin/ManageGames");
			}			
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Account.');
			redirect('Admin');			
		}
	}
	
	
	public function getPracticeBanners(){
		if($this->session->userdata('admin_logged_in')){
		
			$data['games'] = $this->ADMINDBAPI->getPublishedGamesList();
			$data['list'] = $this->ADMINDBAPI->getPractiseBannersList();
			$this->load->view('admin/practise_banners_list', $data);
			
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Account.');
			redirect('Admin');			
		}
	}
		
	public function processPracticeBanner(){
		if($this->session->userdata('admin_logged_in')){
			
			//if(!empty($_POST['banner_game_id']) && !empty($_FILES['banner_image_path']['name'])){
			if(!empty($_POST['banner_game_id'])){
				
				$data = array();
				foreach($_POST as $key=>$val){
					$data[$key] = $val;
				}

				$banner_game_id = $_POST['banner_game_id'];
				$gameInfo = $this->ADMINDBAPI->getGamesInfo($banner_game_id);
				
				$data['banner_game_id'] = $gameInfo['gid'];
				$data['banner_gameboost_id'] = $gameInfo['id'];
				$data['banner_game_name'] = $gameInfo['Name'];
				$data['banner_game_image'] = $gameInfo['GameImage'];
				
				
				$filename = $_FILES["banner_image_path"]["name"];
				$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
				$file_ext = substr($filename, strripos($filename, '.')); // get file name
					
				//$newfilename = md5($file_basename).'_'.time().'_ITR_'. $file_ext;
				$newfilename = md5($file_basename).'-'.time(). $file_ext;
			
				if(move_uploaded_file($_FILES["banner_image_path"]["tmp_name"], "uploads/practise-banners/".$newfilename))
					$data['banner_image_path']	= $newfilename; 
			
			
				$data['banner_added_on'] = time();
				$data['banner_updated_on'] = time();
				
				if($this->db->insert('practise_banners', $data)){
					$this->session->set_flashdata('success','<strong> Success! </strong> Practice zone banner information added successfully. ');
					redirect("Admin/PracticeBanners");
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to add practice zone banner information. Please try again.');
					redirect("Admin/PracticeBanners");
				}
			} else {
				$this->session->set_flashdata('error',"<strong> Error! </strong> Required parameters are missing for uploading a new practice zone banner.Please add all mandatory fields.");
				redirect("Admin/PracticeBanners");
			}
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
		
	public function updatePractiseBannerStatusAjax(){
		if($this->session->userdata('admin_logged_in')){
			
			if(!empty($_POST['id'])){
				$banner_id = $_POST['id'];
				$bannerInfo = $this->ADMINDBAPI->getPractiseBannersInfo($banner_id);
				
				if($bannerInfo['banner_status'] == '1'){
					$data['banner_status'] = '2';
				} else {
					$data['banner_status'] = '1';
				}
				
				$data['banner_updated_on'] = time();
				$this->db->where('banner_id', $banner_id);
				if($this->db->update('practise_banners', $data)){
					echo "success";
				} else {
					echo "error";
				}
			} else {
				echo "error";
			}
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function deletePracticeBanner($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			
			// finally remove practise banner
			$this->db->where('banner_id', $id);
			if($this->db->delete('practise_banners')){
				$this->session->set_flashdata('success','<strong> Success! </strong> Practice banner information deleted successfully. ');
				redirect("Admin/PracticeBanners");
			} else {
				$this->session->set_flashdata('error','<strong> Error! </strong> Unable to delete practice banner information. Please try again.');
				redirect("Admin/PracticeBanners");
			}
			
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}

	//  **************************************   ***************************** **************************************//
	//  **************************************   Games Section Ends **************************************//
	//  **************************************   ***************************** **************************************//
	


	//  **************************************   ***************************** **************************************//
	//  **************************************    Manage Country Starts **************************************//
	//  **************************************   ***************************** **************************************//
	
		public function manageCountry()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$data['list']	=	$this->ADMINDBAPI->getCountryList();
				$this->load->view('admin/country_list', $data );
			}
			else
				redirect('Admin');
		}

		public function processCountry()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$data['c_name']	=	$this->input->post('c_name');
				$data['c_country_code']	=	$this->input->post('c_country_code');	
				$data['c_currency_code']	=	$this->input->post('c_currency_code');
				$data['c_timezone']	=	$this->input->post('c_timezone');
				$data['c_status']	=	$this->input->post('c_status');
				$result		=	$this->ADMINDBAPI->setCountry($data);
				if($result)
					$this->session->set_flashdata('success' , '<strong> Success!</strong> New country addedd successfully.');
				else
					$this->session->set_flashdata('error' , '<strong> Error! </strong> Unable to add new country. Please try again');
					
				redirect(site_url('admin/manageCountry'));
			}
			else
				redirect('Admin');
		}

		public function updateCountry()
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$c_id	=	base64_decode($this->input->post('c_id'));
				$data['c_name']	=	$this->input->post('c_name');
				$data['c_country_code']= $this->input->post('c_country_code');
				$data['c_currency_code']=$this->input->post('c_currency_code');
				$data['c_timezone']=$this->input->post('c_timezone');
				$data['c_status']=$this->input->post('c_status');
				$result		=	$this->ADMINDBAPI->updateCountry($c_id, $data);
				if($result)
					$this->session->set_flashdata('success', '<strong> Success! </strong> Country information updated successfully. ');
				else
					$this->session->set_flashdata('error', '<strong> Error! </strong> Unable to update country information. Please try again.');
				redirect('Admin/ManageCountry');
			}
			else
				redirect('Admin');
		}
		public function deleteCountry($id)
		{
			if($this->session->userdata('admin_logged_in'))
			{
				$id=base64_decode($id);
				$result		=	$this->ADMINDBAPI->deteleCountry($id);
				$this->session->set_flashdata('success' , '<strong>Success! </strong> Country information deleted successfully.');
				redirect('Admin/ManageCountry');
			}
			else
				redirect('Admin');
		}

	//  **************************************   ***************************** **************************************//
	//  **************************************   Manage Country Ends **************************************//
	//  **************************************   ***************************** **************************************//
	
	
	
	//  **************************************   ***************************** **************************************//
	//  **************************************   Tournament Section Starts **************************************//
	//  **************************************   ***************************** **************************************//
	
	public function getTournaments(){
		if($this->session->userdata('admin_logged_in')){
			//$data['categories'] = $this->ADMINDBAPI->getCategoriesList();
			$data['list'] = $this->ADMINDBAPI->getTournamentsList();
			$this->load->view('admin/tournament_list', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function newTournament(){
		if($this->session->userdata('admin_logged_in')){
			$data['categories'] = $this->ADMINDBAPI->getCategoriesList();
			$data['country']	=	$this->ADMINDBAPI->getActiveCountryList();
			$this->load->view('admin/tournament_new', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function getCategoryGamesAjax(){
		if($this->session->userdata('admin_logged_in')){
			$category = $_POST['category'];
			if(!empty($category) && $category !==''){
				$games = $this->ADMINDBAPI->getCategoryGamesList($category);
				echo "<option value=''>Choose Game</option>";
				if(is_array($games) && count($games)>0){
					foreach($games as $row){
						echo "<option value='".$row['gid']."'>".$row['Name']."</option>";
					}
				}
			} else {
				echo "<option value=''>Choose Game</option>";
			}
			
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	
	public function processTournament(){
		if($this->session->userdata('admin_logged_in')){
			
			foreach($_POST as $key=>$val){
				$data[$key] = $val;
			}
			
			unset($data['banner_location']);
			unset($data['banner_position']);
			
			// $data['tournament_start_date'] = date('Y-m-d', strtotime($_POST['tournament_start_date']));
			// $data['tournament_end_date'] = date('Y-m-d', strtotime($_POST['tournament_end_date']));

			$data['tournament_start_date'] = $_POST['tournament_start_date'];
			$data['tournament_end_date'] = $_POST['tournament_end_date'];
			
			
			//$data['tournament_start_time'] = date('H:i:s', strtotime($_POST['tournament_start_date']));
			//$data['tournament_end_time'] = date('H:i:s', strtotime($_POST['tournament_end_date']));
			$data['country']=$this->input->post('country');
			$tournament_game_id = $_POST['tournament_game_id'];
			// echo "<pre>";
			// print_r($data);
			// $count=0;
			// foreach($data['country_id'] as $row)
			// {
			// 	echo "Countary_id:-".$row."Country_Name:-".$data['country'][$count]."Tournament_Fee:-".$data['tournament_fee'][$count];
			// 	echo "<br>";
			// 	$count++;
			// }
			// die();
			$gameInfo = $this->ADMINDBAPI->getGamesInfo($tournament_game_id);
			
			$tournament_category_id = $_POST['tournament_category_id'];
			$categoryInfo = $this->ADMINDBAPI->getCategoriesInfo($tournament_category_id);
			$data['tournament_category'] = $categoryInfo['category_name'];
			
			$data['tournament_game_id'] = $gameInfo['gid'];
			$data['tournament_gameboost_id'] = $gameInfo['id'];
			$data['tournament_game_name'] = $gameInfo['Name'];
			$data['tournament_game_image'] = $gameInfo['GameImage'];
			$data['tournament_status'] = '1';
			$data['tournament_added_on'] = time();
			$data['tournament_updated_on'] = time();
			$result  =		$this->ADMINDBAPI->addNewTournaments($data);
			if($result){
				$tournament_id = $result;
				if(!empty($_FILES['banner_image_path']['name'])){
					
					$dataBanner = array();
					$dataBanner['banner_tournament_id'] = $tournament_id;		
					$dataBanner['banner_position'] = $_POST['banner_position'];		
					$dataBanner['banner_location'] = $_POST['banner_location'];		
					$dataBanner['banner_added_on'] = time();
					$dataBanner['banner_updated_on'] = time();
					$dataBanner['uploaded']		=		'1';
					
					$filename = $_FILES["banner_image_path"]["name"];
					$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
					$file_ext = substr($filename, strripos($filename, '.')); // get file name
						
					//$newfilename = md5($file_basename).'_'.time().'_ITR_'. $file_ext;
					$newfilename = md5($file_basename).'-'.time(). $file_ext;
				
					if(move_uploaded_file($_FILES["banner_image_path"]["tmp_name"], "uploads/tournaments-banners/".$newfilename))
						$dataBanner['banner_image_path']	= $newfilename; 
				
					//Add the banner info in db
					$this->db->insert('tournament_banners', $dataBanner);
					
				}
				
				$this->session->set_flashdata('success','<strong> Success! </strong> Tournament information added successfully. ');
				redirect("Admin/ManageTournaments");
				
			} else {
				$this->session->set_flashdata('error','<strong> Error! </strong> Unable to update tournament information. Please try again.');
				redirect("Admin/ManageTournaments");
			}				
						
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Account.');
			redirect('Admin');			
		}
	}
	
	
	public function editTournaments($id){
		if($this->session->userdata('admin_logged_in')){
			 $id = base64_decode($id);
			$data['tournamentInfo'] = $this->ADMINDBAPI->getTournamentInfo($id);
			$data['rewardInfo']	=	$this->ADMINDBAPI->getRewardInfo($id);
			$data['bannerInfo'] = $this->ADMINDBAPI->getTournamentBannerInfoByTid($id);
			
			$category = $data['tournamentInfo']['tournament_category_id'];
			$data['categories'] = $this->ADMINDBAPI->getCategoriesList();
			$data['games'] = $this->ADMINDBAPI->getCategoryGamesList($category);
			
			$data['tournament_id'] = base64_encode($id);
			
			$this->load->view('admin/tournament_edit', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function processEditTournament($id){
		if($this->session->userdata('admin_logged_in')){
			
			$tournament_id = base64_decode($id);
			foreach($_POST as $key=>$val){
				$data[$key] = $val;
			}

			unset($data['banner_location']);
			unset($data['banner_position']);
			
			
			$data['tournament_start_date'] = date('Y-m-d', strtotime($_POST['tournament_start_date']));
			$data['tournament_end_date'] = date('Y-m-d', strtotime($_POST['tournament_end_date']));
			
			$data['tournament_name'] = addslashes(urlencode($_POST['tournament_name']));
			$data['tournament_desc'] = addslashes(urlencode($_POST['tournament_desc']));
			
			$tournament_game_id = $_POST['tournament_game_id'];
			// echo "<pre>";
			// print_r($data);
			// die();
			$gameInfo = $this->ADMINDBAPI->getGamesInfo($tournament_game_id);
			
			$tournament_category_id = $_POST['tournament_category_id'];
			$categoryInfo = $this->ADMINDBAPI->getCategoriesInfo($tournament_category_id);
			$data['tournament_category'] = $categoryInfo['category_name'];
			
			$data['tournament_game_id'] = $gameInfo['gid'];
			$data['tournament_gameboost_id'] = $gameInfo['id'];
			$data['tournament_game_name'] = $gameInfo['Name'];
			$data['tournament_game_image'] = $gameInfo['GameImage'];
			$data['tournament_updated_on'] = time();
			if($data['country']){
				$result	= $this->ADMINDBAPI->updateTournamentInfo($tournament_id, $data);
			} else {
				$this->db->where('tournament_id', $tournament_id);
				$result = $this->db->update('tournaments', $data);
			}
			
			if($result){
				
				if(!empty($_FILES['banner_image_path']['name'])){
					
					$dataBanner = array();
					$dataBanner['banner_tournament_id'] = $tournament_id;		
					$dataBanner['banner_position'] = $_POST['banner_position'];		
					$dataBanner['banner_location'] = $_POST['banner_location'];		
					$dataBanner['banner_added_on'] = time();
					$dataBanner['banner_updated_on'] = time();
					$dataBanner['uploaded']		=		'1';
				
					
					$filename = $_FILES["banner_image_path"]["name"];
					$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
					$file_ext = substr($filename, strripos($filename, '.')); // get file name
						
					//$newfilename = md5($file_basename).'_'.time().'_ITR_'. $file_ext;
					$newfilename = md5($file_basename).'-'.time(). $file_ext;
				
					if(move_uploaded_file($_FILES["banner_image_path"]["tmp_name"], "uploads/tournaments-banners/".$newfilename))
						$dataBanner['banner_image_path']	= $newfilename; 
				
				
					//update the banner info in db
					$this->db->where('banner_tournament_id', $tournament_id);
					$this->db->update('tournament_banners', $dataBanner);
				
				}
				
				$this->session->set_flashdata('success','<strong> Success! </strong> Tournament information updated successfully. ');
				redirect("Admin/ManageTournaments");
				
			} else {
				$this->session->set_flashdata('error','<strong> Error! </strong> Unable to update tournament information. Please try again.');
				redirect("Admin/ManageTournaments");
			}				
						
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Account.');
			redirect('Admin');			
		}
	}
	
	
	public function deletTournaments($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			$tournamentInfo = $this->ADMINDBAPI->getTournamentInfo($id);
			$tournament_start_date = strtotime($tournamentInfo['tournament_start_date'].' '.$tournamentInfo['tournament_start_time']);
			$tournament_end_date = strtotime($tournamentInfo['tournament_end_date'].' '.$tournamentInfo['tournament_end_time']);
			$today = strtotime(date('Y-m-d H:i')); 
			
			if($tournament_start_date > $today){
				// Check players 
				// Check created banners
				
				// finally remove tournament
				$this->db->where('tournament_id', $id);
				if($this->db->delete('tournaments')){
					$this->session->set_flashdata('success','<strong> Success! </strong> Tournament information deleted successfully. ');
					redirect("Admin/ManageTournaments");
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to delete tournament information. Please try again.');
					redirect("Admin/ManageTournaments");
				}
			
			} else if($tournament_start_date < $today  && $tournament_end_date > $today ){
				$this->session->set_flashdata('error',"<strong> Sorry! </strong>  You can't delete this tournament information. This tournament is in live mode.");
				redirect("Admin/ManageTournaments");
			
			} else {
				$this->session->set_flashdata('error',"<strong> Sorry! </strong> You can't delete this tournament information. This tournament is already expired.");
				redirect("Admin/ManageTournaments");
			}
		
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	
	public function tournamentBannersList(){
		if($this->session->userdata('admin_logged_in')){
			$data['list'] = $this->ADMINDBAPI->getTournamentsBannersList();
			$this->load->view('admin/tournament_banners_list', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
		
	public function uploadTournamentBanner(){
		if($this->session->userdata('admin_logged_in')){
			$data['tournaments'] = $this->ADMINDBAPI->getTournamentsList();			
			$this->load->view('admin/tournament_banner_upload', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
		
	public function processTournamentBanner(){
		if($this->session->userdata('admin_logged_in')){
			
			if(!empty($_FILES['banner_image_path']['name'])){
				
				$data = array();
				foreach($_POST as $key=>$val){
					$data[$key] = $val;
				}				
				$filename = $_FILES["banner_image_path"]["name"];
				$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
				$file_ext = substr($filename, strripos($filename, '.')); // get file name
					
				//$newfilename = md5($file_basename).'_'.time().'_ITR_'. $file_ext;
				$newfilename = md5($file_basename).'-'.time(). $file_ext;
			
				if(move_uploaded_file($_FILES["banner_image_path"]["tmp_name"], "uploads/tournaments-banners/".$newfilename))
					$data['banner_image_path']	= $newfilename; 
			
			
				$data['banner_added_on'] = time();
				$data['banner_updated_on'] = time();
				
				if($this->db->insert('tournament_banners', $data)){
					$this->session->set_flashdata('success','<strong> Success! </strong> Tournament banner information added successfully. ');
					redirect("Admin/TournamentBanners");
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to add tournament banner information. Please try again.');
					redirect("Admin/UploadTournamentBanner");
				}
			} else {
				$this->session->set_flashdata('error',"<strong> Error! </strong> Required parameters are missing for uploading a new banner.Please add all mandatory fields.");
				redirect("Admin/UploadTournamentBanner");
			}
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	
	public function editTournamentBanner($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			$data['bannerInfo'] = $this->ADMINDBAPI->getTournamentBannerInfo($id);
			$data['tournaments'] = $this->ADMINDBAPI->getTournamentsList();	
			$data['banner_id'] = base64_encode($id);
			
			$this->load->view('admin/tournament_banner_edit', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function processEditTournamentBanner($id){
		if($this->session->userdata('admin_logged_in')){
			
			$banner_id = base64_decode($id);
			foreach($_POST as $key=>$val){
				$data[$key] = $val;
			}	
			
			if(!empty($_FILES['banner_image_path']['name'])){
							
				$filename = $_FILES["banner_image_path"]["name"];
				$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
				$file_ext = substr($filename, strripos($filename, '.')); // get file name
					
				//$newfilename = md5($file_basename).'_'.time().'_ITR_'. $file_ext;
				$newfilename = md5($file_basename).'-'.time(). $file_ext;
			
				if(move_uploaded_file($_FILES["banner_image_path"]["tmp_name"], "uploads/tournaments-banners/".$newfilename))
					$data['banner_image_path']	= $newfilename; 
			}
			
			$data['banner_updated_on'] = time();
			$this->db->where('banner_id', $banner_id);
			if($this->db->update('tournament_banners', $data)){
				$this->session->set_flashdata('success','<strong> Success! </strong> Tournament Banner information updated successfully. ');
				redirect("Admin/TournamentBanners");
				
			} else {
				$this->session->set_flashdata('error','<strong> Error! </strong> Unable to update tournament banner information. Please try again.');
				redirect("Admin/TournamentBanners");
			}				
						
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Account.');
			redirect('Admin');			
		}
	}
	
	public function deleteTournamentBanner($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			
			// finally remove tournament banner
			$this->db->where('banner_id', $id);
			if($this->db->delete('tournament_banners')){
				$this->session->set_flashdata('success','<strong> Success! </strong> Tournament banner information deleted successfully. ');
				redirect("Admin/TournamentBanners");
			} else {
				$this->session->set_flashdata('error','<strong> Error! </strong> Unable to delete tournament banner information. Please try again.');
				redirect("Admin/TournamentBanners");
			}
			
			
		
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function getQuickTournaments(){
		if($this->session->userdata('admin_logged_in')){
		
			$data['publishedGames'] = $this->ADMINDBAPI->getPublishedGamesList();
			$data['list'] = $this->ADMINDBAPI->getQuickTournamnetGamesList();
			$this->load->view('admin/quick_tournaments_list', $data);
			
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Account.');
			redirect('Admin');			
		}
	}
	
	public function saveQuickTournamentGame(){
		if($this->session->userdata('admin_logged_in')){
			
			$gid = $_POST['game_id'];
			$gameInfo = $this->ADMINDBAPI->getGamesInfo($gid);
			
			$checkGameInfo = $this->ADMINDBAPI->checkQuickTournamnetGame($gid, $gameInfo['id']);
			
			if($checkGameInfo['no_rows'] == 0){
				$data['quick_gid'] = $gid;
				$data['quick_gameboost_id'] = $gameInfo['id'];
				$data['quick_added_on'] = time();
				
				$this->db->insert('quick_tournaments', $data);
				
				$this->session->set_flashdata('success','<strong> Success! </strong> Game added to quick tournaments section successfully.');
				redirect('Admin/QuickTournaments');
			
			} else {
				$this->session->set_flashdata('error','<strong> Error! </strong> Game already added in quick tournaments section. Please add another game.');
				redirect('Admin/QuickTournaments');
			}
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function removeQuickTournamentGame($id){
		if($this->session->userdata('admin_logged_in')){
			
			$id = base64_decode($id);
			$checkGamesCount = $this->ADMINDBAPI->getQuickTournamnetGameRows();
			if($checkGamesCount['no_rows'] > 3){
				
				$this->db->where('quick_tid', $id);
				$this->db->delete('quick_tournaments');
				$this->session->set_flashdata('success','<strong> Success! </strong> Game removed from quick tournaments section successfully.');
				redirect('Admin/QuickTournaments');
			
			} else {
				$this->session->set_flashdata('error',"<strong> Error! </strong> You can't delete the row. Minimum three games are required for quick tournaments section.");
				redirect('Admin/QuickTournaments');
			}
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function processBulkTournaments(){
		if($this->session->userdata('admin_logged_in')){
			
			if($_FILES['userfile']['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $_FILES['userfile']['type'] == 'application/vnd.ms-excel'){
		
				$file_name='';
				$config['upload_path'] = './uploads/tournaments-excel/';
				$config['allowed_types'] = 'xls|xlsx';
				$config['file_name'] = time();
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload()){
					echo $this->upload->display_errors();
				}else {
					$data2 = $this->upload->data();
					$file_name = $data2['file_name'];			
				}	 
				
				
				// $tournament_section = $_POST['tournament_section'];
				
				$this->load->library("PHPExcel"); 
				$objReader = PHPExcel_IOFactory::createReaderForFile("./uploads/tournaments-excel/".$file_name);
				$objReader->setReadDataOnly(true);
				$objPHPExcel = $objReader->load("uploads/tournaments-excel/".$file_name);
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);  
				$objWorksheet1 = $objPHPExcel->getActiveSheet();
				$lastRow      = $objWorksheet1->getHighestRow(2);  
			
				$insertArrayValues = array();
			  
				for($i=2; $i<=$lastRow; $i++){
					
					$dataUpload = array();
					
					$sno = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
					$tournament_name = $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
					$tournament_desc = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
					$tournament_type = $objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
					$duration = $objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
					$category = $objWorksheet->getCellByColumnAndRow(5,$i)->getValue();
					$game = $objWorksheet->getCellByColumnAndRow(6,$i)->getValue();
					$operator = $objWorksheet->getCellByColumnAndRow(7,$i)->getValue();
					$tournament_fee = $objWorksheet->getCellByColumnAndRow(8,$i)->getValue();
					$tournament_prize_1 = $objWorksheet->getCellByColumnAndRow(9,$i)->getValue();
					$tournament_prize_2 = $objWorksheet->getCellByColumnAndRow(10,$i)->getValue();
					$tournament_prize_3 = $objWorksheet->getCellByColumnAndRow(11,$i)->getValue();
					
					$start_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(12,$i)->getValue()));
					$start_time = $objWorksheet->getCellByColumnAndRow(13,$i)->getFormattedValue();
					$start_time_field = PHPExcel_Shared_Date::ExcelToPHP($start_time);
					$start_time = gmdate("H:i", $start_time_field);
					
					$end_date = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(14,$i)->getValue()));
					$end_time = $objWorksheet->getCellByColumnAndRow(15,$i)->getFormattedValue();
					$end_time_field = PHPExcel_Shared_Date::ExcelToPHP($end_time);
					$end_time = gmdate("H:i", $end_time_field);
					
					$reward_type = $objWorksheet->getCellByColumnAndRow(16,$i)->getValue();
					$tournament_prize_4 = $objWorksheet->getCellByColumnAndRow(17,$i)->getValue();
					$tournament_prize_5 = $objWorksheet->getCellByColumnAndRow(18,$i)->getValue();
					$tournament_prize_6 = $objWorksheet->getCellByColumnAndRow(19,$i)->getValue();
					$tournament_prize_7 = $objWorksheet->getCellByColumnAndRow(20,$i)->getValue();
					$tournament_prize_8 = $objWorksheet->getCellByColumnAndRow(21,$i)->getValue();
					$tournament_section = $objWorksheet->getCellByColumnAndRow(22,$i)->getValue();
					
					$dataUpload['tournament_name'] = addslashes(urlencode($tournament_name));
					$dataUpload['tournament_desc'] = addslashes(urlencode($tournament_desc));
					
					
					if($tournament_type == 'Free' || $tournament_type == 'free')
						$dataUpload['tournament_type'] = '1';
					else if($tournament_type == 'Paid' || $tournament_type == 'paid')
						$dataUpload['tournament_type'] = '2';
					else if($tournament_type == 'Contest' || $tournament_type == 'contest')
						$dataUpload['tournament_type'] = '3';
					else 
						$dataUpload['tournament_type'] = '1';
						
					$categoryInfo = $this->ADMINDBAPI->getCategoriesInfoByName($category);
					$dataUpload['tournament_category_id'] = $categoryInfo['category_id'];
					$dataUpload['tournament_category'] = $categoryInfo['category_name'];
					
					$gameInfo = $this->ADMINDBAPI->getGameInfoByName($game);	
					$dataUpload['tournament_game_id'] = $gameInfo['gid'];
					$dataUpload['tournament_gameboost_id'] = $gameInfo['id'];
					$dataUpload['tournament_game_name'] = $gameInfo['Name'];
					$dataUpload['tournament_game_image'] = $gameInfo['GameImage'];
					
					
					if($reward_type == 'Coins' || $reward_type == 'coins')
						$dataUpload['tournament_reward_type'] = '1';
					else if($reward_type == 'DataPack' || $reward_type == 'datapack' || $reward_type == 'data_pack' || $reward_type == 'data-pack' || $reward_type == 'data pack' || $reward_type == 'Data Pack')
						$dataUpload['tournament_reward_type'] = '2';
					else if($reward_type == 'Talktime' || $reward_type == 'talktime' || $reward_type == 'TalkTime' || $reward_type == 'Talk Time' || $reward_type == 'talk time' || $reward_type == 'talk-time' || $reward_type == 'talk_time')
						$dataUpload['tournament_reward_type'] = '3';
					else 
						$dataUpload['tournament_reward_type'] = '1';
					
					
					$dataUpload['tournament_fee'] = $tournament_fee;
					$dataUpload['tournament_prize_1'] = $tournament_prize_1;
					$dataUpload['tournament_prize_2'] = $tournament_prize_2;
					$dataUpload['tournament_prize_3'] = $tournament_prize_3;
					$dataUpload['tournament_prize_4'] = $tournament_prize_4;
					$dataUpload['tournament_prize_5'] = $tournament_prize_5;
					$dataUpload['tournament_prize_6'] = $tournament_prize_6;
					$dataUpload['tournament_prize_7'] = $tournament_prize_7;
					$dataUpload['tournament_prize_8'] = $tournament_prize_8;
					
					$dataUpload['tournament_start_date'] = $start_date;
					$dataUpload['tournament_start_time'] = $start_time;
					$dataUpload['tournament_end_date'] = $end_date;
					$dataUpload['tournament_end_time'] = $end_time;
					$dataUpload['tournament_added_on'] = time();
					$dataUpload['tournament_updated_on'] = time();
					
					if($tournament_section == 'Hero' || $tournament_section == 'hero')
						$dataUpload['tournament_section'] = '1';
					else 
						$dataUpload['tournament_section'] = '2';
					
					
					
					$insertArrayValues[] = $dataUpload;
					
				}
				
				/*
				echo "<pre>";
				print_r($insertArrayValues);
				echo "</pre>";
				*/
				
				if(is_array($insertArrayValues) && count($insertArrayValues)>0){
					
					$this->db->insert_batch('tournaments', $insertArrayValues);
					$this->session->set_flashdata('success',  '<strong> Success! </strong> Tournaments excelsheet uploaded successfully. Please add the banners in respective list.');
					redirect('Admin/ManageTournaments');
				
				} else {
					$this->session->set_flashdata('error',  '<strong> Error! </strong> No rows found in excelsheet. Please upload correct excelsheet file.');
					redirect('Admin/ManageTournaments');
				}
				
				
				
			
			} else {
				$this->session->set_flashdata('error',  '<strong> Error! </strong> Upload file format is not acceptable. Upload only .xls or .xlsx file.');
				redirect('Admin/ManageTournaments');
			} 
			
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	
	
	
	
	
	//  **************************************   ***************************** **************************************//
	//  **************************************   Tournament Section Ends **************************************//
	//  **************************************   ***************************** **************************************//
	
	
	
		
	public function getPrivateTournamentGames(){
		if($this->session->userdata('admin_logged_in')){
			
			$data['gameslist'] = $this->ADMINDBAPI->getPublishedGamesList();
			$data['list'] = $this->ADMINDBAPI->getPTGamesList();
			$this->load->view('admin/private_tournament_games', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
		
	public function savePrivateTournamentGame(){
		if($this->session->userdata('admin_logged_in')){
			$id = $_POST['game_id'];
			$update['private_tournament'] = '1';
			$this->db->where('gid', $id);
			$this->db->update('games', $update);
			$this->session->set_flashdata('success','<strong> Success! </strong> Game added to private tournaments section successfully.');
			redirect('Admin/PrivateTournamentGames');
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	public function removePrivateTournamentGames($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			$update['private_tournament'] = '0';
			$this->db->where('gid', $id);
			$this->db->update('games', $update);
			$this->session->set_flashdata('success','<strong> Success! </strong> Game removed from private tournaments section successfully.');
			redirect('Admin/PrivateTournamentGames');
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
		
	public function getSuggestedGames(){
		if($this->session->userdata('admin_logged_in')){
			
			$data['gameslist'] = $this->ADMINDBAPI->getPublishedGamesList();
			$data['list'] = $this->ADMINDBAPI->getSuggestedGamesList();
			$this->load->view('admin/suggested_games_list', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
		
	public function saveSuggestedGame(){
		if($this->session->userdata('admin_logged_in')){
			$id = $_POST['game_id'];
			$update['IsSuggested'] = '1';
			$this->db->where('gid', $id);
			$this->db->update('games', $update);
			$this->session->set_flashdata('success','<strong> Success! </strong> Game added to suggested section successfully.');
			redirect('Admin/SuggestedGames');
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	public function removeSuggestedGame($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			$update['IsSuggested'] = '0';
			$this->db->where('gid', $id);
			$this->db->update('games', $update);
			$this->session->set_flashdata('success','<strong> Success! </strong> Game removed from suggested section successfully.');
			redirect('Admin/SuggestedGames');
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function getTopGames(){
		if($this->session->userdata('admin_logged_in')){			
			$data['gameslist'] = $this->ADMINDBAPI->getPublishedGamesList();
			$data['list'] = $this->ADMINDBAPI->getTopGamesList();
			$this->load->view('admin/top_games_list', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function saveTopGame(){
		if($this->session->userdata('admin_logged_in')){
			$id = $_POST['game_id'];
			$update['IsTop'] = '1';
			$this->db->where('gid', $id);
			$this->db->update('games', $update);
			$this->session->set_flashdata('success','<strong> Success! </strong> Game added to top trending games section successfully.');
			redirect('Admin/TopGames');
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	public function removeTopGame($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			$update['IsTop'] = '0';
			$this->db->where('gid', $id);
			$this->db->update('games', $update);
			$this->session->set_flashdata('success','<strong> Success! </strong> Game removed from top trending games section successfully.');
			redirect('Admin/TopGames');
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
		
	public function getGenreGames($type){
		if($this->session->userdata('admin_logged_in')){
			
			$data['list'] = $this->ADMINDBAPI->getGenreGamesList($type);			
			$data['gameslist'] = $this->ADMINDBAPI->getPublishedGamesList();
			$data['type'] = $type;				
			$this->load->view('admin/genre_games_list', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	
	//  **************************************   ***************************** **************************************//
	//  **************************************   Spin Wheel Section Starts Here **************************************//
	//  **************************************   ***************************** **************************************//
	
	
	public function getSpinWheelSections(){
		if($this->session->userdata('admin_logged_in')){
			
			$data['list'] = $this->ADMINDBAPI->getSpinWheelSections();
			$this->load->view('admin/spin_wheel_list', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	public function processSpinWheel(){
		if($this->session->userdata('admin_logged_in')){
			
			$id = base64_decode(@$_POST['wheel_id']); 
			foreach($_POST as $key=>$val){
				$data[$key] = $val;
			}	
			unset($data['wheel_id']);
			
			
			if($id){
				$data['wheel_updated_on'] = time();
				$this->db->where('wheel_id', $id);				
				if($this->db->update('spinwheel_data', $data)){
					$this->session->set_flashdata('success','<strong> Success! </strong> Section information updated successfully. ');
					redirect("Admin/SpinWheel");
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to update section information. Please try again.');
					redirect("Admin/SpinWheel");
				}				
			} else {
				$data['wheel_added_on'] = time();
				$data['wheel_updated_on'] = time();
				
				if($this->db->insert('spinwheel_data', $data)){
					$this->session->set_flashdata('success','<strong> Success! </strong> Section information added successfully. ');
					redirect("Admin/SpinWheel");
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to add new section information. Please try again.');
					redirect("Admin/SpinWheel");
				}
			}
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}

	public function removeWheelSection($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			
			// First check if the total segements count is less than 3 , then stop the user to delete the section
			$countSections = count($this->ADMINDBAPI->getSpinWheelSections());
			$countSections = $countSections-1;
			if($countSections <= 3){
				$this->session->set_flashdata('error',"<strong> Sorry! </strong> You can't delete this section. Minimum 3 sections are required for the Spin & Win.");
				redirect('Admin/SpinWheel');
			} else {
				$this->db->where('wheel_id', $id);
				$this->db->delete('spinwheel_data');
				$this->session->set_flashdata('success','<strong> Success! </strong> Section information removed successfully.');
				redirect('Admin/SpinWheel');
			}
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
		
	
	//  **************************************   ***************************** **************************************//
	//  **************************************   Spin Wheel Section Ends Here  **************************************//
	//  **************************************   ***************************** **************************************//
	
	
	
	//  **************************************   ***************************** **************************************//
	//  **************************************   Portal Settings Section Starts Here **************************************//
	//  **************************************   ***************************** **************************************//
	
		
	public function getPortalSettings(){
		if($this->session->userdata('admin_logged_in')){
			
			$data['list'] = $this->ADMINDBAPI->getPortalSettings();
			$this->load->view('admin/portal_settings', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	function search_exif($exif, $field){
		foreach ($exif as $data)
		{
			if ($data['name'] == $field)
				return $data['enabled'];
		}
	}
	
	public function processPortalSettings(){
		if($this->session->userdata('admin_logged_in')){
			
			// remove the old settings			
			$this->db->truncate('portal_settings');
			
			// add new updated  settings	
			foreach($_POST as $key=>$val){
				$data['name'] = $key;
				$data['enabled'] = 1;
				$data['last_updated'] = time();
				$this->db->insert('portal_settings', $data);
			}	
				
			$this->session->set_flashdata('success','<strong> Success! </strong> Portal settings updated successfully.');
			redirect("Admin/PortalSettings");
				
			
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}

		
	public function manageRedemption(){
		if($this->session->userdata('admin_logged_in')){
			
			$data['list'] = $this->ADMINDBAPI->getRedemptionsList();
			$this->load->view('admin/redemption_list', $data);	
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	

	public function saveRedemptionOption(){
		if($this->session->userdata('admin_logged_in')){
			
			$id = base64_decode(@$_POST['redeem_id']); 
			foreach($_POST as $key=>$val){
				$data[$key] = $val;
			}
			if(isset($_POST['redeem_status']))	
				$data['redeem_status'] = '1';
			else 
				$data['redeem_status'] = '0';
			
			unset($data['redeem_id']);
			$data['redeem_updated_on'] = time();
			
			if($id){
				
				$this->db->where('redeem_id', $id);				
				if($this->db->update('redemption_settings', $data)){
					$this->session->set_flashdata('success','<strong> Success! </strong> Redemption option information updated successfully. ');
					redirect("Admin/ManageRedemption");
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to update redemption option information. Please try again.');
					redirect("Admin/ManageRedemption");
				}				
			} else {
				
				if($this->db->insert('redemption_settings', $data)){
					$this->session->set_flashdata('success','<strong> Success! </strong> Redemption option information added successfully. ');
					redirect("Admin/ManageRedemption");
				} else {
					$this->session->set_flashdata('error','<strong> Error! </strong> Unable to add new redemption option  information. Please try again.');
					redirect("Admin/ManageRedemption");
				}
			}
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}


	public function removeRedemptionOption($id){
		if($this->session->userdata('admin_logged_in')){
			$id = base64_decode($id);
			
			$this->db->where('redeem_id', $id);
			$this->db->delete('redemption_settings');
			$this->session->set_flashdata('success','<strong> Success! </strong> Redemption option information removed successfully.');
			redirect('Admin/ManageRedemption');
			
		} else{
			$this->session->set_flashdata('error','<strong> Error! </strong> Login to Access Your Account.');
			redirect('Admin');
		}
	}
	
	//  **************************************   ***************************** **************************************//
	//  **************************************   Portal Settings Section Ends Here **************************************//
	//  **************************************   ***************************** **************************************//
	
	
	
}
