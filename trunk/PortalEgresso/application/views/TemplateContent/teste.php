

<div>
<?php 
    echo form_open('teste') . '<br>';
    echo form_input('texto')  .'<br>';
    echo form_hidden('escondido','haha') . '<br>';
    echo form_submit('submit');
    echo form_close();

?>
</div>
