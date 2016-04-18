<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('book_model',"",true);
        $this->load->model('user_model',"",true);
    }
    
    public function index()
    {
        $data['title']="Main page";
        $data['info']="Дабро пожаловать на главную страницу сайта www.booklist.";
        $name="info";
        $this->display_lib->user_page($data,$name);
    }
    
    public function add()
    {
        if(isset($_POST['add_button']))
        {
            $this->form_validation->set_rules($this->user_model->add_rules);
            $checked = is_valid_checkbox('check_arr',1);
            $val_run = $this->form_validation->run();
            if($val_run && $checked)
            {
                $name = $this->input->post('name');
                $checkbox_str = checkbox_to_string('check_arr');
                if($this->user_model->add_user($name,$checkbox_str)) $data['info'] = "Ползователь успешно добавлен.";
                else $data['info'] = "Ошибка баз данных.";
                $data['title'] = "Добавить пользователя";
                $name="info";
                $this->display_lib->user_page($data,$name);
            }
            else
            {
                $books_list = $this->book_model->get_books();       
                $data['title']="Добавить пользователя";
                $data['books_list'] = $books_list;
                $name="add";
                $this->display_lib->user_page($data,$name);
            }
        }
        else
        {
            $books_list = $this->book_model->get_books();       
            $data['title']="Добавить пользователя";
            $data['books_list'] = $books_list;
            $name="add";
            $this->display_lib->user_page($data,$name);
        }
    }
    
    public function search()
    {
        if(isset($_POST['search_button']))
        {
            $this->form_validation->set_rules($this->user_model->search_rules);
            $val_res = $this->form_validation->run();
            $name = $this->input->post('name');
            $checkbox_str = checkbox_to_string('check_arr');
            if($name=="" && $checkbox_str==";")
            {
                $books_list = $this->book_model->get_books();
                $data['books_list'] = $books_list;
                $data['info'] = "Один из полей должен быть заполнен.";
                $data['title']="Страница поиска";
                $name="search";
                $this->display_lib->user_page($data,$name);
            }
            else
            {
                $users_list = $this->user_model->search_user($name,$checkbox_str);
                $data['users_list'] = $users_list;
                $books_list = $this->book_model->get_books();
                $data['books_list'] = $books_list;
                $data['title'] = "Страница поиска";
                if(empty($users_list)) $data['info'] = "Поист не дал никаких резултатов.";
                else $data['info'] = "";
                $name="search";
                $this->display_lib->user_page($data,$name);
            }
        }
        else
        {
            $books_list = $this->book_model->get_books();
            $data['books_list'] = $books_list;
            $data['title']="Страница поиска";
            $data['info'] = "";
            $name="search";
            $this->display_lib->user_page($data,$name);
        }
        
    } 
}

?>