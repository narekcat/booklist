<div id="wrapper">

<div id="content">

<p><strong><?php echo "$info<br />";?></strong></p>
<form method="post" action="<?php echo base_url();?>addbook">
<p>Название книги: <input type="text" name="book_name" size="40" value="<?php echo set_value('book_name');?>" /><br />
<strong><?php echo form_error('book_name');?></strong></p>

<p>Автор книги: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="author" size="40" value="<?php echo set_value('author');?>"/><br />
<strong><?php echo form_error('author');?></strong></p>

<p><input type="submit" name="addbook_button" value="Добавить книгу"/></p>
</form>

</div>

</div>