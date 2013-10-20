<div>

    <center>

        <h2>Perfil</h2><br>
            {form_multipart}
        <div style="text-align: center;">
            {foto}<br>
        </div>    
        Upload : {upload_imagem}<br>
        Link : {link_imagem}<br>
        {button_alterar_foto}
        {form_close}
        <p>Você pode alterar sua fóto fornecendo um link de uma foto externa, ou fazendo o upload de um imagem de seu computador</p>

    </center>
    <div class="tabela">
        {form_open}
        <table width="100%" border="00">
            <tr>
                <td> Nome:</td>
                <td>{nome}</td>
            </tr>  
            <tr>
                <td> Sexo: </td>
                <td>{sexo}</td>
            </tr>
            <tr>
                <td>Rua:  </td>
                <td>{rua}</td>
            </tr>
            <tr>
                <td>Cidade: </td>
                <td>{cidade}</td>
            </tr>
            <tr>
                <td>Estado: </td>
                <td>{estado}</td>
            </tr>
            <tr>
                <td>Telefone: </td>
                <td>{telefone}</td>
            </tr>
            <tr>
                <td>CEP: </td>
                <td>{cep}</td>
            </tr>
            <tr>
                <td>Link Lattes: </td>
                <td>{lattes}</td>
            </tr>
            <tr>
                <td>Página Pessoal: </td>
                <td>{pagina_pessoal}</td>
            </tr>
            <tr>
                <td>Area de Atuação: </td>
                <td>{area_atuacao}</td>
            </tr>
            <tr>
                <td>E-mail: </td>
                <td>{email_publico}</td>
            </tr>
            <tr>
                <td>Descrição: </td>
                <td>{descricao}</td>
            </tr>
                <td colspan="2" align="center">{button_alterar}</td>
            
        </table>
        {form_close}
    </div>
</div>