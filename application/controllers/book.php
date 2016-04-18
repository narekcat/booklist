<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("book_model","",true);
        $this->load->model("user_model","",true);
    }
    
    public function addbook()
    {
        if(isset($_POST['addbook_button']))
        {
            $this->form_validation->set_rules($this->book_model->addbook_rules);
            /*echo "<pre>";
            print_r($_POST);
            echo "</pre>";*/
            $val_res = $this->form_validation->run();
            if($val_res)
            {
                $book_name = $this->input->post('book_name');
                $author = $this->input->post('author');
                if($this->book_model->add_book($book_name,$author)) $data['info'] = "����� ������� ���������";
                else $data['info'] = "������ ��� ������.";
                $data['title'] = "�������� �����";
                $name = "info";
                $this->display_lib->user_page($data,$name);
            }
            else
            {
                $data['info'] = "�������� �����.";
                $data['title'] = "�������� �����.";
                $name = "addbook";
                $this->display_lib->user_page($data,$name);
            }
        }
        else
        {
            $data['info'] = "�������� �����.";
            $data['title'] = "�������� �����.";
            $name = "addbook";
            $this->display_lib->user_page($data,$name);
        }
    }
    
    public function deletebook()
    {
        if(isset($_POST['deletebook_button']))
        {
            $val_check = is_valid_checkbox('check_arr',1);
            if($val_check)
            {
                $delbooks_arr = $this->input->post('check_arr');
                if($this->book_model->delete_book($delbooks_arr))
                {
                    $this->user_model->del_pr_books($delbooks_arr);
                    $data['info'] = "��������� ����� ���� ������� �������.";
                }
                else $data['info'] = "������ ��� ������.";
                $data['title'] = "������� �����";
                $name = "info";
                $this->display_lib->user_page($data,$name);
            }
            else
            {
                $books_list = $this->book_model->get_books();
                $data['books_list'] = $books_list;
                $data['info'] = "������� �����.";
                $data['title'] = "������� �����";
                $name = "deletebook";
                $this->display_lib->user_page($data,$name);
            }
        }
        else
        {
            $books_list = $this->book_model->get_books();
            $data['books_list'] = $books_list;
            $data['info'] = "������� �����.";
            $data['title'] = "������� �����";
            $name = "deletebook";
            $this->display_lib->user_page($data,$name);
        }        
    } 
}

?>