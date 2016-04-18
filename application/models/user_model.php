<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    public $add_rules = array
    (
    array
        (
        'field'=>'name',
        'label'=>'Имя ползователя',
        'rules'=>'trim|required|min_length[3]|max_length[100]|htmlspecialchars|xss_clean'
        )
    );
    
    public $search_rules = array
    (
    array
        (
        'field'=>'name',
        'label'=>'Имя ползователя',
        'rules'=>'trim|htmlspecialchars|xss_clean'
        )
    );
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function add_user($name,$pr_books)
    {
        $ins_arr = array('id_user'=>NULL,'name'=>$name,'pr_books'=>$pr_books);
        return $this->db->insert('users',$ins_arr);
    }
    
    public function search_user($name,$pr_books)
    {
        $this->db->like('name',$name);
        $str = strtok($pr_books,";");
        while($str)
        {
            $this->db->like('pr_books',";".$str.";");
            $str = strtok(";");
        }
        $res = $this->db->get('users');
        return $res->result_array();
    }
    
    public function del_pr_books($delbooks_arr)
    {
        foreach($delbooks_arr as $id_book)
        {
            $this->db->like('pr_books',";$id_book;");
            $res = $this->db->get('users');
            $res_arr = $res->result_array();
            /*echo "<pre>";
            print_r($res_arr);
            echo "</pre>";*/
            foreach($res_arr as $item)
            {
                $item['pr_books'] = str_replace(";$id_book;",";",$item['pr_books']);
                $this->db->where('id_user',$item['id_user']);
                $this->db->update('users',$item);
            }
        }
    }
}

?>