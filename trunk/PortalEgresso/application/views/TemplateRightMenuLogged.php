<div>
    {form_open}
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

    <div align="center" >
        <table>
            <tr>
                <td>
                    {button_editar}
                    {form_close}
                </td>
                <td>
                    {form_sair_open}
                    {button_sair}
                    {hidden_current_url}
                    {form_close}
                </td>
            </tr>
        </table>
    </div>
</div>