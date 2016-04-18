<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$checkbox_error = array();

function is_valid_checkbox($field_name,$count)
{
    global $checkbox_error;
    if(!isset($_POST[$field_name])) 
    {
        $checkbox_error[$field_name] = "Вы не поставили ни один из флажков";
        return false;
    }
    $check_arr = $_POST[$field_name];
    $count_checked = count($check_arr);
    if($count_checked>=$count) return true;
    else{
        $checkbox_error[$field_name] = "Должно быть поставлено не менше чем $count флажков";
        return false;
    }
}

function set_checkbox($field_name,$id_book)
{
    if(!isset($_POST[$field_name])) return "";
    $check_arr = $_POST[$field_name];
    if(array_search($id_book,$check_arr)!==false) return "checked";
    else return "";
}

function checkbox_error($field_name)
{
    global $checkbox_error;
    if(isset($checkbox_error[$field_name]))
    return $checkbox_error[$field_name];
    else return "";
}

function checkbox_to_string($field_name)
{
    $str=";";
    if(!isset($_POST[$field_name])) return $str;
    $check_arr = $_POST[$field_name];
    foreach($check_arr as $item)
    {
        $str.="$item;";
    }
    return $str;
}

?>