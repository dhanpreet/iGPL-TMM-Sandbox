<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('timezone')){
    function timezone($var = ''){ 
		$ci =& get_instance();      
        $ci->db->select('c_timezone');
        $ci->db->from('tbl_country');
        $ci->db->where('c_status', '1');
        $query = $ci->db->get();
        if ($query->num_rows() > 0) {
            date_default_timezone_set($query->row()->c_timezone);
        } else {
            date_default_timezone_set('Asia/Rangoon');
        }        
    }  
}