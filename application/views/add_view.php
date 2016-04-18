<div id="wrapper">

<div id="content">
<p><strong>Добавить пользователя.</strong></p>

<form method="post" action="<?php echo base_url();?>add">
<p>Имя: <input type="text" name="name" value="<?php echo set_value('name');?>"/>
<strong><?php echo form_error('name');?></strong></p> 

<table>
<?php
$books_count=count($books_list);
$end=(int)($books_count/3);
for($i=0;$i<$end;$i++)
{
    echo "<tr><td><input type='checkbox' name='check_arr[]' value='".$books_list[$i*3]['id_book']."' ".set_checkbox('check_arr',$books_list[$i*3]['id_book'])."/>".$books_list[$i*3]['name']."</td>";
    
    echo "<td><input type='checkbox' name='check_arr[]' value='".$books_list[$i*3+1]['id_book']."' ".set_checkbox('check_arr',$books_list[$i*3+1]['id_book'])."/>".$books_list[$i*3+1]['name']."</td>";
    
    echo "<td><input type='checkbox' name='check_arr[]' value='".$books_list[$i*3+2]['id_book']."' ".set_checkbox('check_arr',$books_list[$i*3+2]['id_book'])."/>".$books_list[$i*3+2]['name']."</td></tr>";
}
if($books_count%3!=0)
{
    echo "<tr>";
    for($i=0;$i<3;$i++)
    {
        if(isset($books_list[$end*3+$i])) 
        echo "<td><input type='checkbox' name='check_arr[]' value='".$books_list[$end*3+$i]['id_book']."' ".set_checkbox('check_arr',$books_list[$end*3+$i]['id_book'])."/>".$books_list[$end*3+$i]['name']."</td>";
        else echo "<td></td>";
    }
    echo "</tr>";
}
?>
</table>
<p><strong><?php echo checkbox_error('check_arr');?></strong></p>

<p><input type="submit" name="add_button" value="Добавить"/></p>
</form>

</div>

</div>