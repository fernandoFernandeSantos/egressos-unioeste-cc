<div>


    <div class="tabela">


        <h2>Perfil</h2><br>
        {form_multipart}
        <div style="text-align: center;">
            {foto}<br>
        </div>    
        <table>
            <tr><td>Upload:</td><td colspan="2"> {upload_imagem}</td></tr>
            <tr><td>Link : </td><td>{link_imagem}</td><td><font color="red">*Você pode alterar sua fóto fornecendo um link de uma foto externa, ou fazendo o upload de um imagem de seu computador</font></td></tr>
            <td colspan="3" align="center">{button_alterar_foto}</td>
        </table>
        {form_close}


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
                <td>Estado (Ex:PR): </td>
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
                <td>Trabalha em: </td>
                <td>{trabalha}</tr>
            <tr><td>Descrição: </td><td>{descricao}</td></tr>
            <td colspan="2" align="center">{button_alterar}</td>
        </table>
        {form_close}
        
        <table width="100%" border="00">
            <th>Redes Sociais do Egresso</th>
        </table>
        {tabela_redes_sociais}
        
        {form_adicionar_rede_social}
        <table width="100%" border="00" >
            <th colspan="3">Adicionar Rede Social</th>
            <tr><td>Selecione o nome da rede:</td><td>{rede_social_dropdown}</td><td> <font color="red">*Caso a rede social não esteja no menu, adicione-a manualmente na caixa de texto. </font></td></tr>
            <tr><td>Insira o nome da rede:</td><td colspan="2">{rede_social_input}</td></tr>
            <tr><td>Insira o link da rede:</td><td colspan="2">{link_rede_social}</td></tr>
            <tr><td colspan="3" align="center">{button_adicionar_rede_social}</td></tr>
        </table>
        {form_close}
        
        {form_remover_rede_social}
        <table width="100%" border="00" >
            <th colspan="2">Remover Rede Social</th>
            <tr><td width="50%">Selecione a rede a ser removida:</td><td>{perfil_rede_social_dropdown}</td></tr>
            <tr><td colspan="2" align="center">{button_remover_rede_social}</td></tr>
        </table>
        {form_close}

        {form_trabalha_open}
        <table width="100%" border="00" >
            <th colspan="2">Alterar Empresa em que Trabalha</tr>
            <tr><td>Selecione:</td><td>{trabalha_dropdown} <font color="red">*Caso a instituição não esteja no menu, adicione-a manualmente na caixa de texto. </font></td></tr>
            <tr><td>Insira:</td><td>{trabalha_em_input} {radiobutton}</td><tr/>
            <tr><td colspan="2" align="center">{button_alterar_trabalho}</td></tr>
        </table>
        {form_close}

        <table width="100%" border="00" >
            <th>Especializações</tr>
        </table>
        {especializacoes}
        {form_adicionar_especializacao_open}
        <table width="100%" border="00">
            <th colspan="2">Adicionar Especialização</th>
            <tr><td>Tipo:</td><td>{tipo_especializacao}</td></tr>
            <tr><td>Area:</td><td>{area_especializacao}</td></tr>
            <tr><td>Instituição:</td><td>{instituicao_dropdown}  <font color="red">*Caso a instituição não esteja no menu, adicione-a manualmente na caixa de texto. </font><br> {instituicao_especializacao} </td></tr>
            <tr><td>Ano de Inicio:</td><td>{ano_inicio_especializacao}</td></tr>
            <tr><td>Ano de Conclusão</td><td>{ano_conclusao_especializacao}</td></tr>
            <tr><td colspan="2" align="center">{adicionar_especializacao}</td></tr>
        </table>
        {form_close}

        {form_remover_especializacao_open}
        <table width="100%" border="00">
            <th colspan="2">Remover Especialização</th>
            <tr><td>Selecione a especializacao que quer remover:</td><td>{remover_especializacao_dropdown}</td></tr>
            <tr><td colspan="2" align="center">{remover_especializacao}</td></tr>
        </table>
        {form_close}

    </div>
    
</div>