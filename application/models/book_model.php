<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model
{
    public $addbook_rules = array
    (
        array
        (
            'field'=>"book_name",
            'label'=>"Название книги",
            'rules'=>"trim|required|min_length[3]|max_length[100]|htmlspecialchars|xss_clean"
        ),
        array
        (
            'field'=>"author",
            'label'=>"Имя автора",
            'rules'=>"trim|required|min_length[3]|max_length[100]|htmlspecialchars|xss_clean"
        )
    );
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_books()
    {
        $this->db->order_by('id_book','asc');
        $res = $this->db->get('books');
        return $res->result_array();
    }
    
    public function add_book($book_name,$author)
    {
        $ins_arr = array('id_book'=>null,'author'=>$author,'name'=>$book_name);
        return $this->db->insert('books',$ins_arr);
    }
    
    public function delete_book($delbooks_arr)
    {
        /*echo "<pre>";
        print_r($delbooks_arr);
        echo "</pre>";*/
        foreach($delbooks_arr as $id_book)
        {
            //echo "$id_book ";
            $this->db->or_where('id_book',$id_book);
        }
        return $this->db->delete('books');
    }
}

?>