

<div>

    <button onclick="loginValidation()">bottao</button>
        
    <?php
    echo form_open('teste') . '<br>';
    $data = array('name' => 'texto','id' => 'texto');
    echo form_input($data) . '<br>';
    echo form_hidden('escondido', 'haha') . '<br>';
    echo form_submit('submit');
    echo form_close();
    ?>
</div>
