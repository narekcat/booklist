<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Display_lib
{
    public function user_page($data,$name)
    {
        $CI =& get_instance($data,$name);
        $CI->load->view("preheader_view",$data);
        $CI->load->view("header_view");
        $CI->load->view($name."_view",$data);
        $CI->load->view("navigation_view");
        $CI->load->view("footer_view");
    }
}

?>