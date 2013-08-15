<?php echo form_open('usuario') ?>
<table width="100%">
    <tr>
        <td align="right" >Usuário:</td>
        <td><?php echo form_input('user') ?></td>
    </tr>
    <tr>
        <td align="right" >Senha:</td>
        <td><?php echo form_password('senha') ?><td>
    </tr>
</table>
<center>
    <?php
    echo form_submit('button_login', 'Entrar')
    ?>
    <?php echo form_submit('button_registrar', 'Registrar')
    ?>
</center>
<?php echo form_close() ?>
