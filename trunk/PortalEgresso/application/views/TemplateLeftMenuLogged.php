<?php echo form_open('perfil/alterar') ?>
<table width="100%">
    <tr>
        <td align="right" >Nome:</td>
        <td >{nome}</td>
    </tr>
    <tr>
        <td align="right" >Usuário: </td>
        <td>{usuario}</td>
    </tr>
    <tr>
        <td align="right" >E-mail: </td>
        <td>{email}</td>
    </tr>
</table>
<center>
    <?php
    echo form_submit('button_editar', 'Editar')
    ?>

</center>
<?php
echo form_close()?>