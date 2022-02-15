<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class RSA
{
    public function __construct()
    {
        require_once APPPATH.'third_party/phpseclib/Crypt/RSA.php';
    }
}