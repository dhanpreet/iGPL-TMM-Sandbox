<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Geo extends CI_Controller {

	public  function __construct(){
        parent:: __construct();
		$this->load->helper('form');
		$this->load->library('Geoplugin');
		$result=$this->geoplugin->locate('103.37.82.18');
		// $result['geoplugin_countryCode'] ? $this->session->set_userdata('country_code' , $result['geoplugin_countryCode']) : $this->session->set_userdata('country_code' , $result['geoplugin_countryCode']);
		$result['geoplugin_timezone'] ? date_default_timezone_set($result['geoplugin_timezone']) : date_default_timezone_set('Asia/Kolkata');
		$this->session->set_userdata('country_code', 'IN');
		date_default_timezone_set("Asia/Kolkata");
	}
    public function index()
    {
        $result=$this->geoplugin->locate('103.136.43.255');
        echo "<pre>";
        print_r($result);
    }
	public function test()
	{
		$ip= $this->input->ip_address();
		print_r($ip);
	}
	public function test2()
	{
		$result=$this->geoplugin->locate($this->input->ip_address());
		echo "<pre>";
		print_r($result);
	}
}