<div id="wrapper">

<div id="content">
<p><strong>Поиск пользователей.</strong><br />
<strong><?php echo "$info<br />";?></strong>
<form method="post" action="<?php echo base_url();?>search">
<p>Имя: <input type="text" name="name" value="<?php echo set_value('name');?>"/></p>

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
</table><br />

<p><input type="submit" name="search_button" value="Найти"/></p>
</form>

<!--Выводим список найденных пользователей или собшение о том что поиск не дал резултатов-->
<?php
if(isset($users_list))
{
    echo "<table width=100%>";
    $count=0;
    echo "<tr>";
    foreach($users_list as $user)
    {
        if($count==3) 
        {
            echo "</tr><tr>";
            $count=0;   
        }
        echo "<td><p>$user[name]</p>";
        $str = strtok($user['pr_books'],";");
        echo "<p>";
        while($str)
        {
            echo "<div class='blue_line'></div>";
            $id_book = intval($str);
            foreach($books_list as $key=>$val)
            {
                if($val['id_book']==$id_book) {
                    $idx = $key;
                    break;
                    }
            }
            echo $books_list[$idx]['name']."<br />Автор: ".$books_list[$idx]['author']."<br />";
            $str = strtok(";");
        }
        echo "</p>";
        echo "</td>";
        $count++;
    }
    //for(;$count<3;$count++) echo "<td></td>";
    echo "</tr>";
    echo "</table>";
}
?>

</div>

</div>