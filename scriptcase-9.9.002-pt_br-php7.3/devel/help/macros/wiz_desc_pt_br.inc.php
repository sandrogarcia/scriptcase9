        <?php
        /**
         * Array gerado automaticamente pela base de eventos.
         *
         * @package     Biblioteca
         * @subpackage  PHP
         * @creation    2019/01/07
         * @copyright   NetMake Solucoes em Informatica
         * @author      Henrique Cézar de Barros <h.barros@netmake.com.br>
         *
         */
         
        /* ARQUIVO GERADO AUTOMATICAMENTE */
        
        /* Protecao contra hacks */
        if(!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
        {
            die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
                'Invalid access to system file.');
        }
        
        
        function get_events_desc() {
            $arr_evt = [
            
                'blank_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                            
                'blank_onExecute' => [
                    'res' => [
                        'pt' => "Este evento ocorre ao executar a Aplicação",
                        'en' => "This event occurs when the application runs"
                    ],
                    'desc' => [
                        'pt' => "<p>É o único evento da aplicação Blank. Este evento ocorre sempre ao executar a Aplicação. É utilizado para criar todo o código HTML, PHP e JS da página.</p>",
                        'en' => "<p>It is the only event of the Blank application. This event always occurs when running the Application. It is used to create all the HTML, PHP and JS code for the page.</p>"
                    ]
                ],
                            
                'calendar_ajaxFieldonBlur' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html perde o focus.",
                        'en' => "This event occurs when the html object \"loses\" focus."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre quando o objeto html perde o foco.</p>
<hr />
<p><strong>Exemplo:</strong></p>
<p>Em um form de pedidos, ao digitar o código do produto<strong>{cpo_produto}</strong> em um campo, desejamos preencher o valor unitário do produto e em outro campo e exibir a descrição do mesmo.</p>
<p>No evento ajax onblur, criado no campo onde o código do produto será informado<strong>{cpo_produto}, </strong>podemos usar um código semelhante a este:</p>
<p><code>sc_lookup(prod,\" select descricao , valor from produtos where codigo = {cpo_produto} \");</code><br /><br /><code>{desc_produto} = {prod[0][1]};</code><br /><code>{val_produto} = {prod[0][2]};</code></p>",
                        'en' => "<p>Occurs when the focus get out of the HTML object.</p>
<hr />
<p><strong>Example:</strong></p>
<p>in an order form, when entering the product code in a field, we want to fill the product unit value in another field and display the product description. in the onblur field ajax event we can use a PHP block similar to this:</p>
<p>sc_lookup (prod, \"select description, value from products where code = {product_product}\");</p>"
                    ]
                ],
                            
                'calendar_ajaxFieldonChange' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html perde o foco e o conteúdo foi alterado.",
                        'en' => "This event occurs when the field \"loses\" focus and the field value its changed."
                    ],
                    'desc' => [
                        'pt' => "<p>Ocorre quando o foco sai do objeto HTML e houver alteração em seu conteúdo.</p>
<hr />
<p><strong>Exemplo: </strong></p>
<p>Em um formulario de pedidos, desejamos preencher o valor do produto no campo \"preco\" ao digitar o código daquele produto. </p>
<p>sc_lookup(vunit,\" select preco from produtos where codigo = {cod_produto} \"); {cpo_precp_unit_do_form} = {vunit[0][0]};</p>",
                        'en' => "<p>Occurs when focus leaves the HTML object and its content has changed.</p>
<hr />
<p><strong>Example: </strong></p>
<p>In an Order form, we want to fill in the value in the \"price\" field when we enter a product code.</p>
<p>sc_lookup(prc,\" select price from products where productid = '{field_product_id}' \"); {other_form_field_price} = {prc[0][0]};</p>"
                    ]
                ],
                            
                'calendar_ajaxFieldonClick' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html recebe um click.",
                        'en' => "This event occurs when a input object is clicked."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">Ocorre a partir do clique do usuário no campo configurado com o evento, permitindo assim, que ações específicas sejam executadas após a interação do usuário do sistema. </span></p>
<hr />
<p><strong>Exemplo:</strong></p>
<p>Em um campo tipo Radio, queremos esconder ou exibir um outro campo dependendo do valor clicado no campo radio. </p>
<p>if ( <strong>{fld_radio}</strong> == 1 ) {</p>
<p>  sc_field_display(<strong>{fld_information}</strong>, on);</p>
<p>}else{</p>
<p>   sc_field_display(<strong>{fld_information}</strong>, off);</p>
<p>}</p>",
                        'en' => "<p>The event occurs when the user clicks on the configured field, thus allowing specific actions to be performed after system user interaction.</p>
<hr />
<p><strong>Example:</strong></p>
<p>In a Radio field, we want to hide or display another field depending on the value clicked on the radio field.</p>
<p>if ( <strong>{fld_radio}</strong> == 1 ) {</p>
<p>  sc_field_display(<strong>{fld_information}</strong>, on);</p>
<p>}else{</p>
<p>   sc_field_display(<strong>{fld_information}</strong>, off);</p>
<p>}</p>"
                    ]
                ],
                            
                'calendar_ajaxFieldonFocus' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html recebe o foco.",
                        'en' => "This event occurs when the field is focused."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre quando o objeto HTML recebe o foco do mouse.</p>
<hr />
<p><strong>Exemplo:</strong></p>
<p>Desejamos que o <strong>campoX</strong> não permita ser alterado e que o focus do mouse vá para outro campo exibindo uma mensagem de alerta na tela. </p>
<p>sc_set_focus(<strong>outrocampo</strong>);<br />sc_alert(\"Não altere o valor do campoX\");</p>",
                        'en' => "<p>This event occurs when the HTML object receives the mouse focus.</p>
<hr />
<p><strong>Example:</strong></p>
<p>We don't want to allow that the <strong>fieldX </strong>to be changed and the mouse focus to go to another field displaying an alert message on the screen.</p>
<p>sc_set_focus(<strong>anotherfield</strong>);<br />sc_alert(\"Do not change this field\");</p>"
                    ]
                ],
                            
                'calendar_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                            
                'calendar_onAfterDelete' => [
                    'res' => [
                        'pt' => "Este evento ocorre após a deleção de um registro.",
                        'en' => "This event occurs when a register is deleted."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Excluir do Calendário. O formulário executará, na sequência, os eventos onValidate, onValidateSuccess e onBeforeDelete, e então, logo após executar o comando SQL de exclusão do registro no banco de dados, ele executará o evento onAfterDelete.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Depois da exclusão do registro podemos criar logs com facilidade, conforme o código abaixo:</p>
<p>sc_exec_sql(\" insert into tb_log values([glo_usuario],'exclusao','tabela_clientes',{codigo}); //gravamos alem dos literais 'exclusão' e 'tabela_clientes', a variável de sessão [glo_usuario], e a variável local {codigo}, que continha o conteúdo do campo código recém excluído</p>",
                        'en' => "<p>This event occurs after clicking the form's Delete button. The form will then execute the events onValidate, onValidateSuccess and onBeforeDelete, and then, right after executing the SQL command to delete the record in the database, it will execute the event onAfterDelete.</p>
<p> </p>
<hr />
<p><strong>Example:</strong> After deleting the record we can easily create logs, according to the code below:</p>
<p>sc_exec_sql(\" insert into tb_log values([glo_user],'exclusion','customer_table',{code}); //we are storing the literals 'exclusion' and 'customer_table', the session variable [glo_user] and the field variable {code} containing the deleted content of the code field.</p>"
                    ]
                ],
                            
                'calendar_onAfterInsert' => [
                    'res' => [
                        'pt' => "Este evento ocorre após uma inclusão.",
                        'en' => "This event occurs after a row is added on a form applications."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Inserir do formulário. O formulário executará então os eventos onValidate, onValidateSuccess e onBeforeInsert, e logo após executar o comando SQL para inserir o registro do banco de dados, ele executará o evento onAfterInsert.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Após a inclusão de um registro no banco de dados queremos gravar numa tabela de log a operação de inclusão.</p>
<p>sc_exec_sql(\" insert into log values ([glo_usuario],'tabela alvo','insercao',{campo_chave}) \"); //inserimos o id do usuário que estava armazenado em uma variável de sessão [glo_usuario] e a chave do registro recém incluído {campo_chave}.</p>",
                        'en' => "<p>This event occurs after clicking the Insert button on the form. The form will execute the onValidate, onValidateSuccess and onBeforeInsert events, and right after executing the SQL command to insert the database record, it will execute the onAfterInsert event.</p>
<p> </p>
<hr />
<p><strong>Example:</strong> After the inclusion of a record in the database, we want to store the inserting operation in a log table.</p>
<p>sc_exec_sql(\" insert into log values ([glo_user],'target table','insert',{key_field}) \"); //insert the user id that was stored in a session variable [glo_user] and the newly added registry key {key_field}.</p>"
                    ]
                ],
                            
                'calendar_onAfterUpdate' => [
                    'res' => [
                        'pt' => "Este evento ocorre após uma atualização.",
                        'en' => "This event occurs after a row is updated on a form applications."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Salvar do Calendário. O formulário executará então os eventos onValidate, onValidateSuccess e onBeforeUpdate, e logo após executar o comando SQL para inserir o registro do banco de dados, ele executará o evento onAfterUpdate.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Após a atualização de um registro no banco de dados queremos gravar numa tabela de log a operação de atualização.</p>
<p>sc_exec_sql(\" insert into log values ([glo_usuario],'tabela alvo','atualização',{campo_chave}) \"); //inserimos o id do usuário que estava armazenado em uma variável de sessão [glo_usuario] e a chave do registro recém incluído {campo_chave}.</p>",
                        'en' => "<p>This event occurs after clicking on the Form's Save button. The form will then execute the onValidate, onValidateSuccess and onBeforeUpdate events, and right after executing the SQL command to insert the database record, it will execute the onAfterUpdate event.</p>
<p> </p>
<hr />
<p><strong>Example:</strong> After updating a record in the database, we want to store the update operation in a log table.</p>
<p>sc_exec_sql(\" insert into log values ([glo_user],'target table','update',{key_field}) \"); //insert the user id that was stored in a session variable [glo_user] and the newly added registry key {key_field}.</p>"
                    ]
                ],
                            
                'calendar_onApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma unica vez quando a aplicacao é carregada.",
                        'en' => "This event occurs once only when the application is loaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da aplicação executar o SQL. Só é executada ao carregar a aplicação.

É usado para verificações de variáveis e para verificações de segurança.

Ex:

if ([glo_var_depto] != 'financeiro'){

sc_redir(app_x.php);

}",
                        'en' => "This event occurs before the application execute the SQL, and execute only once.

It's used to do verification of variables, and security verification.

Ex:

if ([glo_var_department] != 'financial'){

sc_redir(app_x.php);

}"
                    ]
                ],
                            
                'calendar_onBeforeDelete' => [
                    'res' => [
                        'pt' => "Este evento ocorre antes de um registro ser deletado em um formulário.",
                        'en' => "This event occurs before deleting a record on a form application."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após a validação do formulário (onValidate e onValidateSuccess), ao clicar no botão Excluir, e antes de executar o comando SQL de exclusão do registro no banco de dados.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Vamos consultar uma tabela de privilegios de usuário antes de excluir o registro , caso o mesmo não tenha tal privilégio, mandamos uma mensagem de erro.</p>
<p>sc_lookup(priv_del,\" select priv_del from tb_privilegios where login = [var_login] \");</p>
<p>if(<strong>{priv_del[0][0]}</strong> != 'SIM'){</p>
<p>  sc_erro_mensagem(\" você nao tem privilégios para executar esta operação \");</p>
<p>}</p>",
                        'en' => "<p>This event occurs before deleting rows on form applications. Ex: Before delete a row it is possible to verify the users privileges, if the user has no delete privilege the transaction is cancelled automatically. sc_lookup(priv_del,\" select priv_del from tb_privileges where login = [var_login] \"); if({priv_del[0][0]} != 'Y') { sc_erro_mensage(\" você nao tem privilégios para executar esta operação \"); }</p>"
                    ]
                ],
                            
                'calendar_onBeforeInsert' => [
                    'res' => [
                        'pt' => "Este evento ocorre antes de uma inclusão.",
                        'en' => "This event occurs before add a new record on the form application."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da inclusão de um registro no formulário.",
                        'en' => "This event occurs before adding a new row, it is possible to create or call sophisticated data validations on this event."
                    ]
                ],
                            
                'calendar_onBeforeUpdate' => [
                    'res' => [
                        'pt' => "Este evento ocorre antes de uma atualização em um formulário.",
                        'en' => "This event occurs before the update of a record in a form."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após a validação do formulário (onValidate e onValidateSuccess), ao clicar no botão Salvar, e antes de executar o comando SQL de Update do registro no banco de dados.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Consultamos uma tabela de privilegios de usuário antes de atualizar o registro, caso o mesmo não tenha tal privilégio, mandamos uma mensagem de erro.</p>
<p>sc_lookup(<strong>priv_upd</strong> ,\" select priv_upd from tb_privilegios where login = [var_login] \");</p>
<p>if(<strong>{priv_upd [0][0]}</strong> != 'SIM'){</p>
<p>  sc_error_message(\" você nao tem privilégios para executar esta operação \");</p>
<p>}</p>",
                        'en' => "<p>This event occurs after form validation (onValidate and onValidateSuccess), when clicking the Save button, and before executing the SQL command to Update the record in the database.</p>
<p> </p>
<hr />
<p><strong>Example:</strong> We are checking the user privileges table before updating the record, if it does not have such privilege, we send an error message.</p>
<p>sc_lookup(<strong>priv_upd</strong> ,\" select priv_upd from tb_privileges where login = [var_login] \");</p>
<p>if( <strong>{priv_upd [0][0]}</strong> != 'YES'){</p>
<p>  sc_error_message(\"You do not have privileges to perform this operation\");</p>
<p>}</p>"
                    ]
                ],
                            
                'calendar_onCalendarApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma unica vez quando a aplicacao é carregada.",
                        'en' => "This event occurs once only when the application is loaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da aplicação executar o SQL. Só é executada ao carregar a aplicação.",
                        'en' => "This event occurs before the application execute the SQL, and is executed only once."
                    ]
                ],
                            
                'calendar_onCalendarScriptInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre na inicialização do calendário.",
                        'en' => "This event occurs when the calendar its initialized."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da inicialização do calendário, neste momento as variáveis locais da aplicação não estão disponíveis.",
                        'en' => "These formulas are executed before the application starts. At this moment, the application local variables are not available."
                    ]
                ],
                            
                'calendar_onInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre na inicialização do formulário.",
                        'en' => "This event occurs when the form its initialized."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da inicialização do formulário, neste momento as variáveis locais da aplicação não estão disponíveis.",
                        'en' => "These formulas are executed before the application starts. At this moment, the application local variables are not available."
                    ]
                ],
                            
                'calendar_onLoadAll' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o formulário é carregado.",
                        'en' => "This event occurs when the form its loaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado antes que o formulário seja carregado. Neste momento todas as variáveis da aplicação estão disponíveis.",
                        'en' => "This event its executed before the form is loaded. In this moment all the applications variables are available."
                    ]
                ],
                            
                'calendar_onRefresh' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando houver recarga do formulário.",
                        'en' => "This event occurs when the form its reloaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre quando acontece uma recarga no form.",
                        'en' => "This event occurs when the form application is reloaded, is possible to reload the form based on fields (select , radio, checkbox)"
                    ]
                ],
                            
                'calendar_onValidate' => [
                    'res' => [
                        'pt' => "Este evento ocorre durante a validação dos dados do formulário.",
                        'en' => "This event occurs during the data validation in a form application."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado quando o formulário é submetido ao servidor, através dos botões: \"incluir\", \"alterar\" ou \"excluir\"",
                        'en' => "This event is executed when the form is submitted to the server through the buttons: \"include\", \"change\" or \"delete\""
                    ]
                ],
                            
                'calendar_onValidateFailure' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando existe erro de validação.",
                        'en' => "This event occurs when there is a validation error."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre quando ao submeter a aplicação no onValidate houver um erro gerado pelas macros sc_error_exit, sc_error_message, ou por erro verificado pelo Scriptcase (erros relacionados a Banco de dados).",
                        'en' => "This event occurs when submitting the application to onValidate there is an error generated by the macros sc_error_exit, sc_error_message, or by an error verified by Scriptcase (errors related to Database)."
                    ]
                ],
                            
                'calendar_onValidateSuccess' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando não existe erro de validação.",
                        'en' => "This event occurs when there is no validation errors."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre quando ao submeter a aplicação no onValidate não houver erro gerado pelas macros sc_error_exit, sc_error_message, ou por erro verificado pelo Scriptcase (erros relacionados a Banco de dados).",
                        'en' => "This event occurs when submitting the application to onValidate, there is no error generated by the macros sc_error_exit, sc_error_message, or by an error verified by Scriptcase (errors related to Database)."
                    ]
                ],
                            
                'chart_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                            
                'chart_onApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma unica vez quando a aplicação é carregada.",
                        'en' => "This event occurs just one time, when the application is loaded."
                    ],
                    'desc' => [
                        'pt' => "Ocorre uma unica vez quando a aplicação é carregada. Antes da aplicação executar o SQL.

Pode ser utilizado, para tratamento de dados, ou para verificação de variáveis.

 

 

Ex:

if ([glo_var_depto] != 'financeiro'){

sc_redir(app_x.php);

}",
                        'en' => "It only occurs one time when the application loads. Before the application run SQL.

It can be used for data processing or for checking variables.

 

 

Ex:

if ([glo_var_department] != 'financial'){

sc_redir(app_x.php);

}"
                    ]
                ],
                            
                'chart_onFooter' => [
                    'res' => [
                        'pt' => "Este evento ocorre na exibição do rodapé.",
                        'en' => "This event occurs on the application footer display."
                    ],
                    'desc' => [
                        'pt' => "Este evento é utilizado quando no rodapé precisarmos exibir algum valor calculado, é neste evento que escrevemos o cálculo necessário para montar algum valor que desejamos exibir.

 Ex:

Queremos no rodapé da consulta exibir o valor total dos pedidos exibidos na grid de uma nota fiscal, com um desconto de 10% , vejamos abaixo um exemplo de código rodando no evento OnFooter.

sc_lookup(ret,\" select sum({valoritem}) from vendas_item where id_venda='{id_venda}' \");

{campo_valnota_rodape} = {ret[0][0]} * 0,1;


Precisamos antes disso ter criado o campo {campo_valnota_rodape}",
                        'en' => "This event occurs on the application footer display, it is frequently used when it is required to display any calculated data on grids or report footer.
 
Ex:

sc_lookup(ret,\" select sum({item_value}) from orders_items where id_order='{fld_id_order}' \");

{fld_footer_total_field_a} = {ret[0][0]} * 0,1;


The field {fld_footer_total_field_a} must be created on fields menu"
                    ]
                ],
                            
                'chart_onHeader' => [
                    'res' => [
                        'pt' => "Este evento ocorre na exibição do cabeçalho.",
                        'en' => "This event occurs before the header display"
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado imediatamente antes da exibição do cabeçalho da consulta, podemos utilizar este evento por exemplo quando precisarmos imprimir algum valor calculado no cabeçalho.

Por exemplo, precisamos no cabeçalho de uma consulta de pedidos por cliente exibir o total geral dos pedidos deste;

Criamos um campo , ou um atributo chamado total_compras , em seguida dentro do evento onHeader da consulta montamos um bloco php para carregar o valor no campo / atributo.

sc_lookup(peds,\" select sum(valor) from pedidos where cliente='{cpo_cliente}' \");",
                        'en' => "This event is frequently used when it is required to display any calculated value on report's header

Ex. In a customer report header it is required to display the customer balance on reports header.

Create a field called fld_customer_balance on fields menu.

 sc_lookup(v_bal,\" select sum(debits) - sum(credits) from view_debits_credits  where customer ='{field_customer}' \");"
                    ]
                ],
                            
                'chart_onInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre sempre que a aplicação é carregada, ou recarregada.",
                        'en' => "This event occurs everytime the application is loaded or reloaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado quando a aplicação é carregada ou recarregada, antes da execução do select principal da aplicação. Neste escopo normalmente são executadas as macros que alteram o select, tais como: sc_select_field, sc_select_order, sc_select_where(add), etc.
Podemos também carregar valor para algum atributo da aplicação , bem como verificar alguma diretiva de segurança da mesma antes de executar a aplicação.",
                        'en' => "This event occurs when the application its loaded, or reload. Occurs before the application runs the SQL statement, so using this event it is possible to modify the grid SQL statement dynamically, based on any logical.
Macros frequently called on this event: sc_select_field, sc_select_order, sc_select_where(add), etc"
                    ]
                ],
                            
                'consulta_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                            
                'consulta_ajaxFieldonClick' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html recebe um click.",
                        'en' => "This event occurs when a input object is clicked."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">Ocorre a partir do clique do usuário no campo configurado com o evento, permitindo assim, que ações específicas sejam executadas após a interação do usuário do sistema.</span></p>
<p><span style=\"font-weight: 400;\">Entre outras funcionalidades, é possível criar um redirecionamento para outras aplicações com a macro sc_redir, deletar registros sem sair da consulta utilizando a macro sc_exec_sql entre outras implementações.</span></p>
<p><span style=\"font-weight: 400;\">----</span></p>
<p><span style=\"font-weight: 400;\">No exemplo abaixo, será realizado um redirecionamento utilizando a macro </span><strong>sc_redir </strong><span style=\"font-weight: 400;\">enviado como parâmetro o número do pedido para o ReportPDF, que mostrará os detalhes do pedido.</span></p>
<p><span style=\"font-weight: 400;\">No ReportPDF que utiliza a tabela orders_detais, adicione uma cláusula where no SQL:</span></p>
<p><strong>WHERE orders.orderid = [pedido]</strong></p>
<p><span style=\"font-weight: 400;\">Na consulta, utilizando a tabela </span><strong>orders</strong><span style=\"font-weight: 400;\">, crie um evento onClick no campo de sua escolha, e adicione a linha de comando abaixo.</span></p>
<p><span style=\"font-weight: 400;\">sc_redir(pdf_name.php, pedido={orderid}, \"_blank\");</span></p>",
                        'en' => "<p>It occurs when the user clicks on the field configured with the event, thus allowing specific actions to be performed after the interaction of the system user.</p>
<p>Among other features, it is possible to create a redirect to other applications with the sc_redir macro, delete records without leaving the query using the sc_exec_sql macro, among other implementations.</p>
<p>----</p>
<p>In the example below, a redirect will be performed using the sc_redir macro sent as a parameter the order number to the ReportPDF, which will show the order details.</p>
<p>In the ReportPDF that uses the orders_detais table, add a where clause in SQL:</p>
<p><strong>WHERE orders.orderid = [order]</strong></p>
<p>In the query, using the orders table, create an onClick event in the field of your choice, and add the command line below.</p>
<p>sc_redir(pdf_name.php, order={orderid}, \"_blank\");</p>"
                    ]
                ],
                            
                'consulta_onApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma unica vez quando a aplicação é carregada.",
                        'en' => "This event occurs just one time, when the application is loaded."
                    ],
                    'desc' => [
                        'pt' => "<p>É o primeiro evento executado na aplicação, sendo acionado antes mesmo da montagem do SQL e HTML.</p>
<p>Funciona como uma preparação para a aplicação, onde é possível entre outras coisas, manipular variáveis, realizar validações e mudar a conexão com a macro <strong>sc_change_connection</strong>, por exemplo.</p>
<hr />
<p>No exemplo abaixo, o acesso ao formulário de edição(form_orders) vinculado a consulta será limitado, dependendo do usuário que está acessando a aplicação.<br /><br />Caso a variável <code>[usr_login]</code> seja igual a <strong>admin</strong> o usuário terá acesso ao formulário com a possibilidade de inserir e excluir um registro.<br /><br />Caso a variável possua algum outro valor, o usuário ainda terá acesso ao formulário, porém, apenas com a possibilidade de alterar um registro.</p>
<p><strong>Exemplo do Código</strong></p>
<pre><code>if ( [usr_login] == 'admin') {</code><br /><br /><code>  sc_apl_conf(\"form_orders\", \"insert\", \"on\");</code><br /><code>  sc_apl_conf(\"form_orders\", \"delete\", \"on\");</code><br /><br /><code>} else {</code><br /><br /><code>  sc_apl_conf(\"form_orders\", \"insert\", \"off\");</code><br /><code>  sc_apl_conf(\"form_orders\", \"delete\", \"off\");</code><br /><br /><code>}</code></pre>",
                        'en' => "<p>It is the first event executed in the application, being fired even before the SQL and HTML assembly.</p>
<p>It works as a preparation for the application, where it is possible, among other things, to manipulate variables, perform validations and change the connection with the <code>sc_change_connection</code> macro, for example.</p>
<hr />
<p>In the example below, access to the edit form (form_orders) linked to the query will be limited, depending on the user who is accessing the application.</p>
<p>If the variable <code>[usr_login]</code> is equal to <strong>admin</strong>, the user will have access to the form with the possibility of inserting and deleting a record.</p>
<p>If the variable has some other value, the user will still have access to the form, but only with the possibility of changing a record.</p>
<p><strong>Samples Code</strong></p>
<pre><code>if ( [usr_login] == 'admin') {</code><br /><br /><code>  sc_apl_conf(\"form_orders\", \"insert\", \"on\");</code><br /><code>  sc_apl_conf(\"form_orders\", \"delete\", \"on\");</code><br /><br /><code>} else {</code><br /><br /><code>  sc_apl_conf(\"form_orders\", \"insert\", \"off\");</code><br /><code>  sc_apl_conf(\"form_orders\", \"delete\", \"off\");</code><br /><br /><code>}</code></pre>"
                    ]
                ],
                            
                'consulta_onFooter' => [
                    'res' => [
                        'pt' => "Este evento ocorre na exibição do rodapé.",
                        'en' => "This event occurs on the application footer display."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após o processamento das linhas da grid, durante a exibição dos elementos HTML do rodapé da página. </p>
<p>O onFooter é utilizado quando desejamos exibir alguma informação no rodapé, como um total de vendas ou uma legenda para um gráfico de linha.</p>
<blockquote>
<p><br />O onFooter é executado apenas quando a opção de exibir rodapé está habilitada nas configurações de layout da aplicação.</p>
</blockquote>
<hr />
<p> </p>
<p><strong>Ex:</strong> Queremos no rodapé da consulta exibir o valor total dos pedidos exibidos na grid de uma nota fiscal, com um desconto de 10%:</p>
<pre><code>sc_lookup(ret,\" select sum( valoritem ) from vendas_item where id_venda={id_venda} \");</code><br /><br /><code>[v_nota_rodape] = {ret[0][0]} * 0,1;</code></pre>",
                        'en' => "<p>This event occurs after the processing of the grid lines, during the display of the HTML elements of the page footer.</p>
<p>onFooter is used when we want to display some information in the footer, such as a sales total or a legend for a line graph.</p>
<blockquote>
<p><br />onFooter runs only when the option to show footer is enabled in the application's layout settings.</p>
</blockquote>
<hr />
<p> </p>
<p><strong>E.g:</strong> We want at the bottom of the application to display the total value of orders displayed in the grid of an invoice, with a 10% discount:</p>
<pre><code>sc_lookup(ret,\" select sum( valueitem ) from sales_item where sale_id={sale_id} \");</code><br /><br /><code>[v_footnote] = {ret[0][0]} * 0.1;</code></pre>"
                    ]
                ],
                            
                'consulta_onGroupBy' => [
                    'res' => [
                        'pt' => "Este evento ocorre durante as quebras.",
                        'en' => "This event it is executed inside the grouping."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento é executado sempre que ocorrer quebras, independente do nível da quebra, e permitem a manipulação dos campos de totalização.</p>
<p>O Scriptcase disponibiliza todas as variáveis de totalização no escopo da Grid.</p>
<blockquote>
<p><span style=\"font-weight: 400;\">O onGroupBy </span><span style=\"font-weight: 400;\">é executado apenas quando a aplicação de Consulta possui uma ou mais Quebras configurada. </span></p>
</blockquote>
<hr />
<p><span style=\"font-weight: 400;\"><strong>Ex</strong>:</span></p>
<p><span style=\"font-weight: 400;\">Supondo uma aplicação que tenha dois níveis de quebra, <strong>estado</strong> e <strong>cidade</strong>, e que totaliza dois campos, <strong>parcela</strong> e <strong>saldo</strong>, podemos ter acesso aos totais, no escopo de \"calcular a cada registro\", da seguinte forma:</span></p>
<ul>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{count_ger}</code> - contém a quantidade total dos registros;</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_parcela}</code> - contém o somatório geral do campo \"parcela\";</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_saldo}</code> - contém o somatório geral do campo \"saldo\";</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{count_estado}</code> - contém a quantidade total dos registros, da quebra de \"estado\" que estiver sendo processada;</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_estado_parcela}</code> - contém o somatório do campo \"parcela\", da quebra de \"estado\" que estiver sendo processada;</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_estado_saldo}</code> - contém o somatório do campo \"saldo\", da quebra de \"estado\" que estiver sendo processada;</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{count_cidade}</code> - contém a quantidade total dos registros, da quebra de \"cidade\" que estiver sendo processada;</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_cidade_parcela}</code> - contém o somatório do campo \"parcela\", da quebra de \"cidade\" que estiver sendo processada;</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_cidade_saldo}</code> - contém o somatório do campo \"saldo\", da quebra de \"cidade\" que estiver sendo processada;</span></li>
</ul>
<p><span style=\"font-weight: 400;\">Considerando que as fórmulas, definidas para serem processadas no escopo de \"calcular durante as quebras\" estarão atuando para os vários níveis de quebra, as variáveis especiais de totalização, neste escopo, são referenciadas substituindo-se o nome da quebra pela palavra chave \"quebra\", ou seja:</span></p>
<ul>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{count_ger}</code> - contém a quantidade total dos registros;</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_parcela}</code> - contém o somatório geral do campo \"parcela\";</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_saldo}</code> - contém o somatório geral do campo \"saldo\";</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{count_quebra}</code> - contém a quantidade total dos registros, da quebra que estiver sendo processada;</span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_quebra_parcela}</code> - contém o somatório do campo \"parcela\", da quebra que estiver sendo processada; </span></li>
<li style=\"font-weight: 400;\" aria-level=\"1\"><span style=\"font-weight: 400;\"><code>{sum_quebra_saldo}</code> - contém o somatório do campo \"saldo\", da quebra que estiver sendo processada;</span></li>
</ul>",
                        'en' => "<p>This event is executed whenever breaks occur, regardless of the break level, and allows the manipulation of the totalization fields.</p>
<p>Scriptcase makes all the totalization variables available in the scope of the Grid.</p>
<blockquote>
<p>onGroupBy  is only executed when the Query application has one or more Breaks configured.</p>
</blockquote>
<hr />
<p><strong>Eg:</strong></p>
<p>Assuming an application that has two levels of <strong>state</strong> and <strong>city</strong> break and that totals two <strong>parcel</strong> and <strong>balance</strong> fields, we can have access to the totals, in the scope of \"calculating each record\", as follows:</p>
<ul>
<li><code>{count_ger}</code> - contains the total amount of the registers;</li>
<li><code>{sum_parcel}</code> - contains the general summing of the \"parcel\" field;</li>
<li><code>{sum_balance}</code> - contains the general summing of the \"balance\" field;</li>
<li><code>{count_state}</code> - contains the total amount of the registers, of \"state\" grouping that is being processed;</li>
<li><code>{sum_state_parcel}</code> - contains the summing of the \"parcel\" field, of the \"state\" grouping that is being processed;</li>
<li><code>{sum_state_balance}</code> - contains the summing of the \"balance\" field, of the \"state\" grouping that is being processed;</li>
<li><code>{count_city}</code> - contains the total amount of the registers, of the \"city\" grouping that is being processed;</li>
<li><code>{sum_city_parcel}</code> - contains the summing of the \"parcel\" field, of the \"city\" grouping that is being processed;</li>
<li><code>{sum_city_balance}</code> - contains the summing of the \"balance\" field, of the \"city\" grouping that is being processed;</li>
</ul>
<p>Considering that the formulas, defined to be processed in the scope of \"calculate during the groupings\" will be acting for the various grouping levels, the special sum variables, in this scope, are referenced substituting the grouping name by the word key \"grouping\", or either:</p>
<ul>
<li><code>{count_ger}</code> - contains the total amount of the registers;</li>
<li><code>{sum_parcel}</code> - contains the general summing of the \"parcel\" field;</li>
<li><code>{sum_balance}</code> - contains the general summing of the \"balance\" field;</li>
<li><code>{count_groupby}</code> - contains the total amount of the registers, of the grouping that is being processed;</li>
<li><code>{sum_groupby_parcel}</code> - contains the summing of the \"parcel\" field, of the grouping is being processed;</li>
<li><code>{sum_groupby_balance}</code> - contains the summing of the \"balance\" field, of the grouping is being processed;</li>
</ul>"
                    ]
                ],
                            
                'consulta_onHeader' => [
                    'res' => [
                        'pt' => "Este evento ocorre na exibição do cabeçalho.",
                        'en' => "This event occurs before the header display"
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">É o terceiro evento executado na consulta, ocorre imediatamente antes da exibição do cabeçalho da aplicação, durante o carregamento dos elementos HTML de exibição da página. </span></p>
<blockquote>
<p><span style=\"font-weight: 400;\">O </span><em><span style=\"font-weight: 400;\">onHeader</span></em><span style=\"font-weight: 400;\"> é executado apenas quando a opção de exibir cabeçalho está habilitada nas configurações de layout da aplicação.</span></p>
</blockquote>
<p><span style=\"font-weight: 400;\">Neste evento é possível realizar consultas na base de dados, permitindo ler informações sobre a aplicação e acessar valores dos campos da Consulta.</span></p>
<p><span style=\"font-weight: 400;\">É utilizado, entre outras coisas, para alteração do CSS da aplicação, códigos javascript e exibição de informações vinculadas à campos, como um total de vendas ou uma legenda para um gráfico de linha.</span></p>",
                        'en' => "<p>The third event generated in the query occurs immediately before the application's header display, during the loading of the page's display HTML elements.</p>
<blockquote>
<p>The onHeader is only obtained when the option to display the header is enabled in the application's layout settings.</p>
</blockquote>
<p>In this event, it is possible to perform queries in the database, allowing you to read information about the application and the values of the Query's fields.</p>
<p>It is used, among other things, to change the application's CSS, javascript codes and display information linked to fields, such as a sales total or a legend for a line graph.</p>"
                    ]
                ],
                            
                'consulta_onInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre sempre que a aplicação é carregada, ou recarregada.",
                        'en' => "This event occurs every time the application is loaded or reloaded."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">Segundo evento a ser executado, <strong>antes da execução do select principal</strong>, ele é acionado sempre que a aplicação é carregada. </span><span style=\"font-weight: 400;\">Por exemplo, após utilização do filtro avançado.<br /></span></p>
<p><span style=\"font-weight: 400;\">Nele, todas as variáveis e bibliotecas da aplicação estão disponíveis para utilização.</span></p>
<p><span style=\"font-weight: 400;\">A manipulação das conexões com as macros <code>sc_connection_edit</code> e <code>sc_connection_new</code>, manipulação do select principal com as macros <code>sc_select_order</code> e <code>sc_select_where(add)</code> e inclusão de bibliotecas já incorporádas ao Scriptcase como a <strong>Jquery</strong> com a macro <code>sc_include_lib</code> são alguns dos exemplos de utilização do evento.</span></p>
<p> </p>
<hr />
<p><span style=\"font-weight: 400;\">No exemplo abaixo, o acesso ao relatório de vendas será limitado ao usuário que as realizou.</span></p>
<p><span style=\"font-weight: 400;\">O acesso está limitado caso o usuário não seja o admin.<br /></span></p>
<p><span style=\"font-weight: 400;\"><strong>Exemplo do Código</strong><br /></span></p>
<p><code><span style=\"font-weight: 400;\">if ( [usr_login] != 'admin' ) {</span></code></p>
<p><code></code><code><span style=\"font-weight: 400;\">    if ( empty({sc_where_atual})){</span></code></p>
<p><code><span style=\"font-weight: 400;\">        sc_select_where(add) = \"WHERE employeeid > [usr_login]\";</span></code></p>
<p><code><span style=\"font-weight: 400;\">    } else {</span></code><br /><code></code></p>
<p><code><span style=\"font-weight: 400;\">        sc_select_where(add) = \"AND employeeid > [usr_login]\";</span></code><br /><code><span style=\"font-weight: 400;\">    }<br />}</span></code></p>",
                        'en' => "<p>Second event to be executed, before the execution of the main select, it is triggered whenever the application is loaded. For example, after using the advanced filter.</p>
<p>In it, all application variables and libraries are available for use.</p>
<p>The manipulation of connections with <code>sc_connection_edit</code> and <code>sc_connection_new</code> macros, manipulation of the main select with <code>sc_select_order</code> and <code>sc_select_where(add)</code> macros and inclusion of libraries already incorporated into Scriptcase such as Jquery with <code>sc_include_lib</code> macro are some of the examples of using the event.</p>
<p> </p>
<hr />
<p>In the example below, access to the sales report will be limited to the user who performed them.</p>
<p>Access is limited if the user is not the admin.</p>
<p><strong>Sample Code</strong></p>
<p><code><span style=\"font-weight: 400;\">if ( [usr_login] != 'admin' ) {</span></code></p>
<p><code></code><code><span style=\"font-weight: 400;\">    if ( empty({sc_where_atual})){</span></code></p>
<p><code><span style=\"font-weight: 400;\">        sc_select_where(add) = \"WHERE employeeid > [usr_login]\";</span></code></p>
<p><code><span style=\"font-weight: 400;\">    } else {</span></code><br /><code></code></p>
<p><code><span style=\"font-weight: 400;\">        sc_select_where(add) = \"AND employeeid > [usr_login]\";</span></code><br /><code><span style=\"font-weight: 400;\">    }<br />}</span></code></p>"
                    ]
                ],
                            
                'consulta_onNavigate' => [
                    'res' => [
                        'pt' => "Este evento ocorre ao navegar entre as páginas da consulta.",
                        'en' => "This event occurs when navigating among the grid pages."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">Na aplicação de consulta, este evento é executado em duas situações:</span></p>
<ul>
<li><span style=\"font-weight: 400;\">Quando configurada com paginação parcial, o evento é executado ao navegar entre as páginas, utilizando os </span><strong>botões de navegação</strong><span style=\"font-weight: 400;\">, </span><strong>navegação por página</strong><span style=\"font-weight: 400;\"> ou a opção </span><strong>ir para.</strong></li>
<li><span style=\"font-weight: 400;\">Ao configurar a aplicação com Scroll Infinito, é executado a cada carregamento dos registros.</span></li>
</ul>
<p><span style=\"font-weight: 400;\">Diferente dos demais eventos, este depende da interação do usuário para ser acionado, p</span><span style=\"font-weight: 400;\">ermitindo, por exemplo, que alguma validação ou alteração de layout seja realizada apenas após esta interação.</span></p>
<blockquote>
<p><strong>Nota</strong></p>
<p><span style=\"font-weight: 400;\">A navegação na consulta é realizada por ajax, desta forma, não é possível a utilização de códigos Javascript(JQuery, Ajax).</span></p>
<p><span style=\"font-weight: 400;\">Ao utilizar a paginação total na aplicação, o evento não é executado.</span></p>
</blockquote>",
                        'en' => "<p>In the query application, this event runs in two situations:</p>
<ul>
<li>When configured with partial paging, the event is executed when navigating between pages using the <strong>navigation buttons</strong>, <strong>navigation by page</strong> or the <strong>Jump to</strong> option.</li>
<li>When configuring the application with <strong>Infinite Scroll</strong>, it is executed every time records are loaded.</li>
</ul>
<p>Unlike other events, this one depends on user interaction to be triggered, allowing, for example, that any validation or layout change is performed only after this interaction.</p>
<blockquote>
<p><strong>Note</strong></p>
<p>The query navigation is performed by ajax, thus, it is not possible to use Javascript codes (JQuery, Ajax).</p>
<p>When using full paging in the application, the event is not executed.</p>
</blockquote>"
                    ]
                ],
                            
                'consulta_onRecord' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma vez para cada registro da consulta.",
                        'en' => "This event occurs immediately before printing a row."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">Este evento é executado imediatamente antes da exibição de cada registro exibido na consulta, independente da interação do usuário.<br /></span></p>
<p><span style=\"font-weight: 400;\">Desta forma, é comumente utilizado para a manipulação e validação dos dados, criação de links com a macro <strong>sc_link</strong> ou alteração de layout com a macro <strong>sc_field_style,</strong> baseada nas informações exibidas.<br /></span></p>
<p><span style=\"font-weight: 400;\"> </span></p>
<hr />
<p>No exemplo abaixo, o estilo do texto no campo <strong>{priceorder}</strong> será alterado de acordo com o valor.</p>
<p>Para valores abaixo de <strong>500</strong> reais, o texto terá uma cor diferente dos valores acima de <strong>500</strong> reais,</p>
<h4>Exemplo do Código</h4>
<p><code><span style=\"font-weight: 400;\">if ( {priceorder} < 500 ) {</span></code></p>
<p><code></code><code></code><code><span style=\"font-weight: 400;\">   sc_field_style({priceorder}, \"Background-Color\", \"15\", \"#228B22\", \"\", \"bold\");<br /></span></code></p>
<p><code><span style=\"font-weight: 400;\">} else {<br /></span></code></p>
<p><code><span style=\"font-weight: 400;\">   sc_field_style({priceorder}, \"Background-Color\", \"15\", \"#006400\", \"\", \"bold\");<br /></span></code></p>
<p><code><span style=\"font-weight: 400;\">}</span></code></p>",
                        'en' => "<p>This event is executed immediately before the display of each record displayed in the query, regardless of user interaction.</p>
<p>Thus, it is commonly used for data manipulation and validation, creating links with the <code>sc_link</code> macro or changing the layout with the <code>sc_field_style</code> macro, based on the displayed information.</p>
<p><span style=\"font-weight: 400;\"> </span></p>
<hr />
<p>In the example below, the style of the text in the <code>{priceorder}</code> field will change according to the value.</p>
<p>For values below 500 reais, the text will have a different color from values above 500 reais,</p>
<p><strong>Samples Code</strong></p>
<p><code><span style=\"font-weight: 400;\">if ( {priceorder} < 500 ) {</span></code></p>
<p><code></code><code></code><code><span style=\"font-weight: 400;\">   sc_field_style({priceorder}, \"Background-Color\", \"15\", \"#228B22\", \"\", \"bold\");<br /></span></code></p>
<p><code><span style=\"font-weight: 400;\">} else {<br /></span></code></p>
<p><code><span style=\"font-weight: 400;\">   sc_field_style({priceorder}, \"Background-Color\", \"15\", \"#006400\", \"\", \"bold\");<br /></span></code></p>
<p><code><span style=\"font-weight: 400;\">}</span></code></p>"
                    ]
                ],
                            
                'filter_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                            
                'filter_onApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma unica vez quando a aplicacao e carregada.",
                        'en' => "This event occurs once only when the application is loaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre uma única vez antes da exibição do formulario do filtro. Podemos utilizar o evento para \"setar\" alguns defaults para os campos do filtro ex:

{empresa} = [glo_empresa];

Campos no formato data são tratados diferentemente, recebendo um sufixo dia, mes e/ou ano. Por exemplo, o campo {dataNasc} será tratado da seguinte forma:

{dataNasc_dia}=date(\"d\");

{dataNasc_mes}=date(\"m\");

{dataNasc_ano}=date(\"Y\");",
                        'en' => "This event occurs just once before it display the search form. It can be used to set some default values to the fields. For example:

{company} = [glo_company];

Date fields are used differently, They use a suffix \"day\" for day, \"month\" for month and/or \"year\" for year. For example, The {Birth} field will be:

{Birth_day}=date(\"d\");

{Birth_month}=date(\"m\");

{Birth_year}=date(\"Y\");"
                    ]
                ],
                            
                'filter_onFilterInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre sempre que a aplicação é carregada, ou recarregada.",
                        'en' => "This event occurs whenever the application is loaded, or reloaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado toda vez, quando a aplicação é carregada, ou recarregada, antes da execução do select principal da aplicação. Neste escopo, normalmente, são executadas as macros que alteram o select, tais como: sc_select_field, sc_select_order, sc_select_where(add), etc...

Podemos também carregar valor para algum atributo da aplicação , bem como verificar alguma diretiva de segurança da mesma antes de executar a aplicação.",
                        'en' => "This event occurs when the application its loaded, or reload. Occurs before the application runs the SQL statement, so using this event it is possible to modify the grid SQL statement dynamically, based on any logical.

Macros frequently called on this event: sc_select_field, sc_select_order, sc_select_where(add), etc. "
                    ]
                ],
                            
                'filter_onFilterRefresh' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando houver recarga do formulário.",
                        'en' => "This event occurs when the form its reloaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre quando acontece uma recarga no form.",
                        'en' => "This event occurs when the form application is reloaded, is possible to reload the form based on fields (select , radio, checkbox)"
                    ]
                ],
                            
                'filter_onFilterSave' => [
                    'res' => [
                        'pt' => "Este evento ocorre sempre que alguma configuração de pesquisa é salva no filtro.",
                        'en' => "This event occurs always that some search setting is saved in the filter application."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre sempre que alguma configuração de pesquisa é salva no filtro.",
                        'en' => "This event occurs always that some search setting is saved in the filter application."
                    ]
                ],
                            
                'filter_onFilterValidate' => [
                    'res' => [
                        'pt' => "Este evento ocorre durante a validação dos dados do filtro.",
                        'en' => "This event occurs when the search form is submitted."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado quando o formulário de filtro é submetido ao servidor.

Ex. possuo uma função php que me devolve strings similares a um valor passado , ex similar(joao) retona 'joão','juao','juão' etc. Ou seja a função tenta trazer resultados foneticamente iguais.

Ex. ao validar o form de filtro , antes de executar a pesquisa no banco, desejo alterar o valor do nome passado para derivações fonéticas do mesmo , no evento OnValidate basta escrever

{nome} = similar({nome});",
                        'en' => "This event occours when the search form is submitted.

Ex. in order to prevent some searches or to validate any search params

if( strlen({name}) <= 0) {

sc_error_message(\" Please fill the name field before submit your search \");

}"
                    ]
                ],
                            
                'form_ajaxFieldonBlur' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html perde o focus.",
                        'en' => "This event occurs when the field \"loses\" the focus."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre quando o objeto html perde o foco.</p>
<hr />
<p><strong>Exemplo:</strong></p>
<p>Em um form de pedidos, ao digitar o código do produto<strong>{cpo_produto}</strong> em um campo, desejamos preencher o valor unitário do produto e em outro campo e exibir a descrição do mesmo.</p>
<p>No evento ajax onblur, criado no campo onde o código do produto será informado<strong>{cpo_produto}, </strong>podemos usar um código semelhante a este:</p>
<p><code>sc_lookup(prod,\" select descricao , valor from produtos where codigo = {cpo_produto} \");</code><br /><br /><code>{desc_produto} = {prod[0][1]};</code><br /><code>{val_produto} = {prod[0][2]};</code></p>",
                        'en' => "<p>Occurs when the focus get out of the HTML object.</p>
<hr />
<p><strong>Example:</strong></p>
<p>in an order form, when entering the product code in a field, we want to fill the product unit value in another field and display the product description. in the onblur field ajax event we can use a PHP block similar to this:</p>
<p>sc_lookup (prod, \"select description, value from products where code = {product_product}\");</p>"
                    ]
                ],
                            
                'form_ajaxFieldonChange' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html perde o focus e o conteudo foi alterado.",
                        'en' => "This event occurs when the field \"loses\" focus and the field value its changed."
                    ],
                    'desc' => [
                        'pt' => "<p>Ocorre quando o foco sai do objeto HTML e houver alteração em seu conteúdo.</p>
<hr />
<p>Ex: Em um formulario de pedidos, desejamos preencher o valor do produto no campo \"preco\" ao digitar o código daquele produto. </p>
<p>sc_lookup(vunit,\" select preco from produtos where codigo = {cod_produto} \"); {cpo_precp_unit_do_form} = {vunit[0][0]};</p>",
                        'en' => "<p>Occurs when focus leaves the HTML object and its content has changed.</p>
<hr />
<p>Ex: In an Order form, we want to fill in the value in the \"price\" field when we enter a product code.</p>
<p>sc_lookup(prc,\" select price from products where productid = '{field_product_id}' \"); {other_form_field_price} = {prc[0][0]};</p>"
                    ]
                ],
                            
                'form_ajaxFieldonClick' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html recebe um click.",
                        'en' => "This event occurs when a input object is clicked."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">Ocorre a partir do clique do usuário no campo configurado com o evento, permitindo assim, que ações específicas sejam executadas após a interação do usuário do sistema. </span></p>
<hr />
<p><strong>Exemplo:</strong></p>
<p>Em um campo tipo Radio, queremos esconder ou exibir um outro campo dependendo do valor clicado no campo radio. </p>
<p>if ( <strong>{fld_radio}</strong> == 1 ) {</p>
<p>  sc_field_display(<strong>{fld_information}</strong>, on);</p>
<p>}else{</p>
<p>   sc_field_display(<strong>{fld_information}</strong>, off);</p>
<p>}</p>",
                        'en' => "<p>The event occurs when the user clicks on the configured field, thus allowing specific actions to be performed after system user interaction.</p>
<hr />
<p><strong>Example:</strong></p>
<p>In a Radio field, we want to hide or display another field depending on the value clicked on the radio field.</p>
<p>if ( <strong>{fld_radio}</strong> == 1 ) {</p>
<p>  sc_field_display(<strong>{fld_information}</strong>, on);</p>
<p>}else{</p>
<p>   sc_field_display(<strong>{fld_information}</strong>, off);</p>
<p>}</p>"
                    ]
                ],
                            
                'form_ajaxFieldonFocus' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html recebe o focus.",
                        'en' => "This event occurs when the field is focused."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocurre cuando el objeto HTML recibe el foco del mouse.</p>
<hr />
<p><strong>Ejemplo:</strong></p>
<p>Queremos que el <strong>campoX</strong> no permita que se cambie y que el foco del mouse vaya a otro campo mostrando un mensaje de alerta en la pantalla.</p>
<p>sc_set_focus(<strong>outrocampo</strong>);<br />sc_alert(\"Não altere o valor do campoX\");</p>",
                        'en' => "<p>This event occurs when the HTML object receives the mouse focus.</p>
<hr />
<p><strong>Example:</strong></p>
<p>We don't want to allow that the <strong>fieldX </strong>to be changed and the mouse focus to go to another field displaying an alert message on the screen.</p>
<p>sc_set_focus(<strong>anotherfield</strong>);<br />sc_alert(\"Do not change this field\");</p>"
                    ]
                ],
                            
                'form_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                            
                'form_onAfterDelete' => [
                    'res' => [
                        'pt' => "Este evento ocorre após que algum resgistro tenha sido deletado.",
                        'en' => "This event occurs when a register is deleted."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Excluir do formulário. O formulário executará, na sequência, os eventos onValidate, onValidateSuccess e onBeforeDelete, e então, logo após executar o comando SQL de exclusão do registro no banco de dados, ele executará o evento onAfterDelete.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Depois da exclusão do registro podemos criar logs com facilidade, conforme o código abaixo:</p>
<p>sc_exec_sql(\" insert into tb_log values([glo_usuario],'exclusao','tabela_clientes',{codigo}); //gravamos alem dos literais 'exclusão' e 'tabela_clientes', a variável de sessão [glo_usuario], e a variável local {codigo}, que continha o conteúdo do campo código recém excluído</p>",
                        'en' => "<p>This event occurs after clicking the form's Delete button. The form will then execute the events onValidate, onValidateSuccess and onBeforeDelete, and then, right after executing the SQL command to delete the record in the database, it will execute the event onAfterDelete.</p>
<p> </p>
<hr />
<p><strong>Example:</strong> After deleting the record we can easily create logs, according to the code below:</p>
<p>sc_exec_sql(\" insert into tb_log values([glo_user],'exclusion','customer_table',{code}); //we are storing the literals 'exclusion' and 'customer_table', the session variable [glo_user] and the field variable {code} containing the deleted content of the code field.</p>"
                    ]
                ],
                            
                'form_onAfterDeleteAll' => [
                    'res' => [
                        'pt' => "Este evento ocorre após algum registro do form multiplo registro seja deletado.",
                        'en' => "This event occurs when a register is deleted on multiple rows forms."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Excluir do formulário de múltiplos registros. O formulário executará então os eventos onValidate, onValidateSuccess e onBeforeDelete, e logo após executar todos os comandos SQL para excluir os registros no banco de dados, ele executará o evento <strong>onAfterDeleteAll</strong>.</p>
<p><em>Obs: Este evento ocorre apenas uma vez independentemente da quantidade de registros excluídos por vez.</em></p>
<hr />
<p>Ex: Em um form de itens de pedido (multiplos registros), desejamos excluir o pedido caso todos os itens da tela sejam excluídos.</p>
<p>sc_exec_sql(\" DELETE FROM adm_pedidos WHERE pedido_id = {pedido} \");</p>",
                        'en' => "<p>This event occurs after clicking no button Exclude form multiple records. Or the form will execute the onValidate, onValidateSuccess and onBeforeDelete events, and the logo will execute all the SQL commands to exclude the records not the data bank, it will execute or the <strong>onAfterDeleteAll</strong> event.</p>
<p><em>Note: This event occurs only once regardless of the quantity of records excluded at a time.</em></p>
<hr />
<p>Ex. In an order item form (multiple records), we want to delete the order if all screen items are deleted. Just in the event OnAfterDeleteAll use a block similar to the one shown below:</p>
<p>sc_exec_sql (\"DELETE FROM orders WHERE order_id = {order}\");</p>"
                    ]
                ],
                            
                'form_onAfterInsert' => [
                    'res' => [
                        'pt' => "Este evento ocorre após uma inclusão.",
                        'en' => "This event occurs after a row is added on a form applications."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Inserir do formulário. O formulário executará então os eventos onValidate, onValidateSuccess e onBeforeInsert, e logo após executar o comando SQL para inserir o registro do banco de dados, ele executará o evento onAfterInsert.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Após a inclusão de um registro no banco de dados queremos gravar numa tabela de log a operação de inclusão.</p>
<p>sc_exec_sql(\" insert into log values ([glo_usuario],'tabela alvo','insercao',{campo_chave}) \"); //inserimos o id do usuário que estava armazenado em uma variável de sessão [glo_usuario] e a chave do registro recém incluído {campo_chave}.</p>",
                        'en' => "<p>This event occurs after clicking the Insert button on the form. The form will execute the onValidate, onValidateSuccess and onBeforeInsert events, and right after executing the SQL command to insert the database record, it will execute the onAfterInsert event.</p>
<p> </p>
<hr />
<p><strong>Example:</strong> After the inclusion of a record in the database, we want to store the inserting operation in a log table.</p>
<p>sc_exec_sql(\" insert into log values ([glo_user],'target table','insert',{key_field}) \"); //insert the user id that was stored in a session variable [glo_user] and the newly added registry key {key_field}.</p>"
                    ]
                ],
                            
                'form_onAfterInsertAll' => [
                    'res' => [
                        'pt' => "Esse evento ocorre após inclusão de um registro no forumulário multiplo registros.",
                        'en' => "This event occurs when a record its added on a multiple register form. "
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Inserir do <strong>formulário de múltiplos registros</strong>. O formulário executará então os eventos onValidate, onValidateSuccess e onBeforeInsertAll, e logo após executar todos os comandos SQL para inserir os registros no banco de dados, ele executará o evento <strong>onAfterInsertAll</strong>.</p>
<p> </p>
<hr />
<p>Podemos por exemplo, após inserir os itens de uma nota fiscal, (tb_itens_nf), em um form de múltiplos registros , incluir na tabela \"pai\" (nota_fiscal), o valor total dos produtos.</p>
<p>sc_lookup(tot,\" select sum(valor_item) from tb_itens_nf where num_nf = {num_nf} \");</p>
<p>{tmp_tot} = {tot[0][0]};</p>
<p>sc_exec_sql(\" update tb_itens_nf set total_itens = {tmp_tot} where num_nf = {num_nf} \");</p>",
                        'en' => "<p>This event occurs after clicking on the Insert button of the <strong>multiple record form</strong>. The Form will execute the onValidate, onValidateSuccess and onBeforeInsertAll events, and then it will execute the <strong>onAfterInsertAll</strong> event after execute all the SQL commands to insert the records into the database.</p>
<p> </p>
<hr />
<p>For example, after entering the items of an invoice, (tb_itens_nf), in a multiple-record form, include in the \"parent\" table (invoice_file) the total value of the products.</p>
<p>sc_lookup (tot, \"select sum (item_value) from tb_itens_nf where num_nf = {num_nf}\");</p>
<p>{tmp_tot} = {tot [0] [0]};</p>
<p>sc_exec_sql (\"update tb_itens_nf set total_itens = {tmp_tot} where num_nf = {num_nf}\");</p>"
                    ]
                ],
                            
                'form_onAfterUpdate' => [
                    'res' => [
                        'pt' => "Este evento ocorre após uma atualização.",
                        'en' => "This event occurs after a row is updated on a form applications."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Salvar do formulário. O formulário executará então os eventos onValidate, onValidateSuccess e onBeforeUpdate, e logo após executar o comando SQL para inserir o registro do banco de dados, ele executará o evento onAfterUpdate.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Após a atualização de um registro no banco de dados queremos gravar numa tabela de log a operação de atualização.</p>
<p>sc_exec_sql(\" insert into log values ([glo_usuario],'tabela alvo','atualização',{campo_chave}) \"); //inserimos o id do usuário que estava armazenado em uma variável de sessão [glo_usuario] e a chave do registro recém incluído {campo_chave}.</p>",
                        'en' => "<p>This event occurs after clicking the form's Save button. The form will then execute the onValidate, onValidateSuccess and onBeforeUpdate events, and right after executing the SQL command to insert the database record, it will execute the onAfterUpdate event.</p>
<p> </p>
<hr />
<p><strong>Example:</strong> After updating a record in the database, we want to store the update operation in a log table.</p>
<p>sc_exec_sql(\" insert into log values ([glo_user],'target table','update',{key_field}) \"); //insert the user id that was stored in a session variable [glo_user] and the newly added registry key {key_field}.</p>"
                    ]
                ],
                            
                'form_onAfterUpdateAll' => [
                    'res' => [
                        'pt' => "Este evento ocorre após atualização de um registro em um formulário multiplo registro.",
                        'en' => "This event occurs when there is an update on a multiple row only on multiple rows forms."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Salvar do <strong>formulário de múltiplos registros</strong>. O formulário executará então os eventos onValidate, onValidateSuccess e onBeforeUpdateAll, e logo após executar todos os comandos SQL para atualizar os registros no banco de dados, ele executará o evento <strong>onAfterUpdateAll</strong>.</p>
<p> </p>
<hr />
<p>Podemos por exemplo, após atualizar os itens de uma nota fiscal, (tb_itens_nf), em um form de múltiplos registros , atualizar na tabela \"pai\" (nota_fiscal), o valor total dos produtos.</p>
<p>sc_lookup(tot,\" select sum(valor_item) from tb_itens_nf where num_nf = {num_nf} \");</p>
<p>{tmp_tot} = {tot[0][0]};</p>
<p>sc_exec_sql(\"UPDATE tb_itens_nf SET total_itens = {tmp_tot} WHERE num_nf = {num_nf} \");</p>",
                        'en' => "<p>This event occurs after clicking on the Save button of <strong>the multiple record form</strong>. The Form will execute the onValidate, onValidateSuccess and onBeforeUpdateAll events, and then it will execute the <strong>onAfterUpdateAll</strong> event after execute all the SQL commands to update the records into the database.</p>
<p> </p>
<hr />
<p>Example: We can update the total value of an invoice (tb_invoice) after update its items (tb_invoice_items) in a multiple records form.</p>
<p>sc_lookup (tot, \"select sum(value_item) from tb_invoice_items where num_nf = {num_nf}\");</p>
<p>{tmp_tot} = {tot [0] [0]};</p>
<p>sc_exec_sql (\"UPDATE tb_invoice SET total_items = {tmp_tot} WHERE num_nf = {num_nf}\");</p>"
                    ]
                ],
                            
                'form_onApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma única vez quando a aplicação é carregada.",
                        'en' => "This event occurs once only when the application is loaded."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">Primeiro evento executado no formulário, sendo acionado antes mesmo da montagem do SQL e HTML.</span></p>
<p><span style=\"font-weight: 400;\">Funciona como uma preparação para a aplicação, onde é possível entre outras coisas, manipular variáveis, realizar validações e mudar a conexão com a macro </span><strong>sc_change_connection</strong><span style=\"font-weight: 400;\">, por exemplo.</span></p>
<p><span style=\"font-weight: 400;\">Veja abaixo um exemplo de como utilizá-lo.</span></p>
<hr />
<p><span style=\"font-weight: 400;\">No exemplo abaixo, o </span><strong>form_orders</strong><span style=\"font-weight: 400;\"> será alterado de acordo com o usuário que estiver acessando o sistema.</span></p>
<p><span style=\"font-weight: 400;\">Caso a variável </span><code><span style=\"font-weight: 400;\">[usr_login]</span></code><span style=\"font-weight: 400;\"> seja igual a </span><strong>admin,</strong><span style=\"font-weight: 400;\"> o usuário terá acesso ao formulário com a possibilidade de inserir e excluir um registro.</span></p>
<p><span style=\"font-weight: 400;\">Caso a variável possua algum outro valor, o usuário ainda terá acesso ao formulário, porém, apenas com a possibilidade de alterar um registro.</span></p>
<h4><strong>Exemplo do Código</strong></h4>
<pre>if ( [usr_login] == 'admin') {<br /><br />  sc_apl_conf(\"form_orders\", \"insert\", \"on\");<br /><br />  sc_apl_conf(\"form_orders\", \"delete\", \"on\");<br /><br />} else {<br /><br />  sc_apl_conf(\"form_orders\", \"insert\", \"off\");<br /><br />  sc_apl_conf(\"form_orders\", \"delete\", \"off\");<br /><br />}</pre>",
                        'en' => "<p>First non-formal event executed, being triggered before the assembly of SQL and HTML.</p>
<p>It works as a preparation for an application, since it is possible among other things, various manipulatives, performs validations and changes a connection with a macro <strong>sc_change_connection</strong>, for example.</p>
<p>See below an example of how you use it.</p>
<p> </p>
<hr />
<p>No example below, or <strong>form_orders</strong> will be altered according to the user accessing the system.</p>
<p>If variable <code>[usr_login]</code> is equal to <strong>admin</strong>, or user will have access to or form with the possibility of inserting and excluding a registration.</p>
<p>If a variable has some other value, or user still has access to the form, therefore, only with a possibility of altering a registry.</p>
<p><strong>Code example</strong></p>
<pre><code>if ([usr_login] == 'admin') {</code><br /><br /><code>    sc_apl_conf (\"form_orders\", \"insert\", \"in\");</code><br /><br /><code>    sc_apl_conf (\"form_orders\", \"remove\", \"activated\");</code><br /><br /><code>} else {</code><br /><br /><code>    sc_apl_conf (\"form_orders\", \"insert\", \"off\");</code><br /><br /><code>    sc_apl_conf (\"form_orders\", \"remove\", \"off\");</code><br /><br /><code>}</code></pre>"
                    ]
                ],
                            
                'form_onBeforeDelete' => [
                    'res' => [
                        'pt' => "Este evento ocorre antes de um registro ser deletado em um formulário.",
                        'en' => "This event occurs before deleting a record on a form application."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após a validação do formulário (onValidate e onValidateSuccess), ao clicar no botão Excluir, e antes de executar o comando SQL de exclusão do registro no banco de dados.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Vamos consultar uma tabela de privilegios de usuário antes de excluir o registro , caso o mesmo não tenha tal privilégio, mandamos uma mensagem de erro.</p>
<p>sc_lookup(priv_del,\" select priv_del from tb_privilegios where login = [var_login] \");</p>
<p>if(<strong>{priv_del[0][0]}</strong> != 'SIM'){</p>
<p>  sc_erro_mensagem(\" você nao tem privilégios para executar esta operação \");</p>
<p>}</p>",
                        'en' => "<p>This event occurs after form validation (onValidate and onValidateSuccess), when clicking the Delete button, and before executing the SQL command to delete the record in the database.</p>
<p> </p>
<hr />
<p>As examples we can see in the example below, we consult a user privileges table before deleting the record, if it does not have such privilege, we send an error message.</p>
<p>sc_lookup(priv_del,\" select priv_del from tb_privileges where login = [var_login] \");</p>
<p>if({priv_del[0][0]} != 'YES'){</p>
<p>  sc_error_messagem(\" you do not have privileges to perform this operation \");</p>
<p>}</p>"
                    ]
                ],
                            
                'form_onBeforeDeleteAll' => [
                    'res' => [
                        'pt' => "Este evento ocorre antes de um registro ser deletado em um formulário.",
                        'en' => "This event occurs before deleting a record on a form application."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Excluir do <strong>formulário de múltiplos registros</strong>. O formulário executará então os eventos onValidate e onValidateSuccess, em seguida ele executará o evento <strong>onBeforeDeleteAll</strong> antes de iniciar a execução dos comandos SQL de exclusão dos registros no banco de dados.</p>
<p><em>Obs: Este evento é acionado apenas uma vez, independente da quantidade de linhas removidas em um clique no botão Excluir .</em></p>
<p> </p>
<hr />
<p>Como exemplos podemos verificar no exemplo abaixo, consultamos uma tabela de privilegios de usuário antes de excluir o registro , caso o mesmo não tenha tal privilégio, mandamos uma mensagem de erro.</p>
<p>sc_lookup(priv_del,\" select priv_del from tb_privilegios where login = [var_login] \");</p>
<p>if({priv_del[0][0]} != 'SIM'){</p>
<p>sc_erro_mensagem(\" você nao tem privilégios para executar esta operação \");</p>
<p>}</p>",
                        'en' => "<p>This event occurs after clicking the Delete button on the <strong>multi-record form</strong>. The form will execute the onValidate and onValidateSuccess events, then it will execute the <strong>onBeforeDeleteAll</strong> event before starting the execution of the SQL commands to delete records in the database.</p>
<p><em>Note: This event is triggered only once, regardless of the amount of lines removed in one click on the Delete button.</em></p>
<p> </p>
<hr />
<p>As examples we can see in the example below, we consult a user privileges table before deleting the record, if it does not have such privilege, we send an error message.</p>
<p>sc_lookup(priv_del,\" select priv_del from tb_privileges where login = [var_login] \");</p>
<p>if({priv_del[0][0]} != 'YES'){</p>
<p>sc_error_message(\" you do not have privileges to perform this operation \");</p>
<p>}</p>"
                    ]
                ],
                            
                'form_onBeforeInsert' => [
                    'res' => [
                        'pt' => "Este evento ocorre antes de uma inclusão.",
                        'en' => "This event occurs before add a new record on the form application."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após a validação do formulário (onValidate e onValidateSuccess), ao clicar no botão Inserir, e antes de executar o comando SQL de inclusão do registro no banco de dados.</p>
<p> </p>
<hr />
<p>Exemplo: Consultamos uma tabela de privilegios de usuário antes de inserir o registro , caso o mesmo não tenha tal privilégio, mandamos uma mensagem de erro.</p>
<p>sc_lookup(priv_ins ,\" select priv_ins from tb_privilegios where login = [var_login] \");</p>
<p>if({priv_ins [0][0]} != 'SIM'){</p>
<p>  sc_erro_mensagem(\" você nao tem privilégios para executar esta operação \");</p>
<p>}</p>",
                        'en' => "<p>This event occurs after form validation (onValidate and onValidateSuccess), when clicking the Insert button, and before executing the SQL command to add the record to the database.</p>
<p> </p>
<hr />
<p>Example: We check the user privileges table before inserting the record, if he does not have privilege, we should send an error message.</p>
<p>sc_lookup(priv_ins,\" select priv_ins from tb_privileges where login = [var_login] \");</p>
<p>if({priv_ins [0][0]} != 'YES'){</p>
<p>  sc_error_message(\" you do not have privileges to perform this operation \");</p>
<p>}</p>"
                    ]
                ],
                            
                'form_onBeforeInsertAll' => [
                    'res' => [
                        'pt' => "Este evento ocorre antes inclusão de registros em formulários do tipo multiplo registro.",
                        'en' => "This event occurs before add a new record on a multiple register form application."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Inserir do <strong>formulário de múltiplos registros</strong>. O formulário executará então os eventos onValidate e onValidateSuccess, em seguida ele executará o evento <strong>onBeforeInsertAll</strong> antes de iniciar a execução dos comandos SQL de inserção dos registros no banco de dados. </p>
<p> </p>
<p><em>Obs: Este evento é acionado apenas uma vez, independente da quantidade de linhas inseridas em um clique no botão Inserir.</em></p>
<hr />
<p>Exemplo: Consultamos uma tabela de privilegios de usuário antes de inserir o registro , caso o mesmo não tenha tal privilégio, mandamos uma mensagem de erro.</p>
<p>sc_lookup(priv_ins ,\" select priv_ins from tb_privilegios where login = [var_login] \");</p>
<p>if({priv_ins [0][0]} != 'SIM'){</p>
<p>  sc_erro_mensagem(\" você nao tem privilégios para executar esta operação \");</p>
<p>}</p>",
                        'en' => "<p>This event occurs after clicking the Insert button of the <strong>multiple record form</strong>. The form will execute the onValidate and onValidateSuccess events, then it will execute the <strong>onBeforeInsertAll</strong> event before starting the execution of the SQL commands to insert the records into the database.</p>
<p> </p>
<p><em>Note: This event is triggered only once, regardless of the number of lines inserted in one click on the Insert button.</em></p>
<hr />
<p>Example: We check the user privileges table before inserting the record, if he does not have privilege, we should send an error message.</p>
<p>sc_lookup(priv_ins,\" select priv_ins from tb_privileges where login = [var_login] \");</p>
<p>if({priv_ins [0][0]} != 'YES'){</p>
<p>  sc_error_message(\" you do not have privileges to perform this operation \");</p>
<p>}</p>"
                    ]
                ],
                            
                'form_onBeforeUpdate' => [
                    'res' => [
                        'pt' => "Este evento ocorre antes de uma atualização em um formulário.",
                        'en' => "This event occurs before the update of a record in a form."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após a validação do formulário (onValidate e onValidateSuccess), ao clicar no botão Salvar, e antes de executar o comando SQL de Update do registro no banco de dados.</p>
<p> </p>
<hr />
<p><strong>Exemplo:</strong> Consultamos uma tabela de privilegios de usuário antes de atualizar o registro, caso o mesmo não tenha tal privilégio, mandamos uma mensagem de erro.</p>
<p>sc_lookup(<strong>priv_upd</strong> ,\" select priv_upd from tb_privilegios where login = [var_login] \");</p>
<p>if(<strong>{priv_upd [0][0]}</strong> != 'SIM'){</p>
<p>  sc_error_message(\" você nao tem privilégios para executar esta operação \");</p>
<p>}</p>",
                        'en' => "<p>This event occurs after form validation (onValidate and onValidateSuccess), when clicking the Save button, and before executing the SQL command to Update the record in the database.</p>
<p> </p>
<hr />
<p><strong>Example:</strong> We are checking the user privileges table before updating the record, if it does not have such privilege, we send an error message.</p>
<p>sc_lookup(<strong>priv_upd</strong> ,\" select priv_upd from tb_privileges where login = [var_login] \");</p>
<p>if( <strong>{priv_upd [0][0]}</strong> != 'YES'){</p>
<p>  sc_error_message(\"You do not have privileges to perform this operation\");</p>
<p>}</p>"
                    ]
                ],
                            
                'form_onBeforeUpdateAll' => [
                    'res' => [
                        'pt' => "Este evento ocorre antes atualização de um registro em um formulário do tipo multiplo registro.",
                        'en' => "This event occurs before the update of a record in a multiple register form."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre após clicar no botão Salvar do <strong>formulário de múltiplos registros</strong>. O formulário executará então os eventos onValidate e onValidateSuccess, e em seguida executará o evento <strong>onBeforeUpdateAll</strong> antes de iniciar a execução dos comandos SQL de atualização dos registros no banco de dados.</p>
<p><em>Obs: Este evento é acionado apenas uma vez, independente da quantidade de linhas atualizadas em um clique no botão Salvar.</em></p>
<p> </p>
<hr />
<p>Como exemplos podemos verificar no exemplo abaixo, consultamos uma tabela de privilegios de usuário antes de atualizar o registro, caso o mesmo não tenha tal privilégio, mandamos uma mensagem de erro.</p>
<p>sc_lookup(priv_upd ,\" select priv_upd from tb_privilegios where login = [var_login] \");</p>
<p>if({priv_upd [0][0]} != 'SIM'){</p>
<p>sc_error_message(\" você nao tem privilégios para executar esta operação \");</p>
<p>}</p>",
                        'en' => "<p>This event occurs after clicking the Save button on the <strong>multi-record form</strong>. The form will then execute the events onValidate and onValidateSuccess, and then execute the event <strong>onBeforeUpdateAll</strong> before starting the execution of SQL commands to update records in the database.</p>
<p><em>Note: This event is triggered only once, regardless of the amount of rows updated in one click on the Save button.</em></p>
<p> </p>
<hr />
<p>As examples we can see in the example below, we consult a user privileges table before updating the record, if it does not have such privilege, we send an error message.</p>
<p>sc_lookup(priv_upd ,\" select priv_upd from tb_privileges where login = [var_login] \");</p>
<p>if({priv_upd [0][0]} != 'YES'){</p>
<p>sc_error_message(\" you do not have privileges to perform this operation \");</p>
<p>}</p>"
                    ]
                ],
                            
                'form_onClick' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando clicamos em um botão criado na barra de ferramentas.",
                        'en' => "This event occurs when a created button is clicked"
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre quando clicamos em um botão criado na barra de ferramentas.",
                        'en' => "This event occurs when we click a button created on the toolbar."
                    ]
                ],
                            
                'form_onInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre na inicialização do formulário.",
                        'en' => "This event occurs when the form its initialized."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da inicialização do formulário, neste momento, as variáveis locais da aplicação não estão disponíveis.",
                        'en' => "These formulas are executed before the application starts. At this moment, the application locals variables are not available."
                    ]
                ],
                            
                'form_onLoadAll' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o formulário é carregado.",
                        'en' => "This event occurs when the form it loaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado antes que o formulário seja carregado. Neste momento todas as variáveis da aplicação estão disponíveis.",
                        'en' => "This event it executed before the form is loaded. In this moment all the applications variables are available."
                    ]
                ],
                            
                'form_onRecord' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o formulário é carregado.",
                        'en' => "This event occurs when the form it loaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado antes que o formulário seja carregado. Neste momento todas as variáveis da aplicação estão disponíveis.",
                        'en' => "This event is executed before the form is loaded. In this moment all the applications variables are available."
                    ]
                ],
                            
                'form_onNavigate' => [
                    'res' => [
                        'pt' => "Este evento ocorre ao navegar entre os registros do formulário.",
                        'en' => "This event occurs when navigating among the records."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">No formulário, este evento sempre é executado ao realizar uma navegação, através dos </span><strong>botões de navegação</strong><span style=\"font-weight: 400;\">, </span><strong>navegação por página</strong><span style=\"font-weight: 400;\"> ou a opção </span><strong>ir para.</strong></p>",
                        'en' => "<p>In the form, this event is always executed when performing a navigation, through the <strong>navigation buttons</strong>, <strong>navigation by page</strong> or the option <strong>go to</strong>.</p>"
                    ]
                ],
                            
                'form_onRefresh' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando houver recarga do formulário.",
                        'en' => "This event occurs when the form its reloaded."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre quando acontece uma recarga no formulário . É possível recarregar o formulário utilizando os campos de seleção (Select, Radio, Checkbox) ou utilizando o botão de Refresh da barra de ferramentas</p>",
                        'en' => "<p>This event occurs when the form application is reloaded, is possible to reload the form based on fields (select, radio, checkbox) or using the toolbar's Refresh button</p>"
                    ]
                ],
                            
                'form_onValidate' => [
                    'res' => [
                        'pt' => "Este evento ocorre durante a validação dos dados do formulário.",
                        'en' => "This event occurs during the data validation in a form application."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento é executado quando o formulário é submetido ao servidor, através dos botões: \"incluir\", \"alterar\" ou \"excluir\"<br />Nesse evento, é permitido realizar validações antes de que os dados do formulário sejam enviados para o banco de dados.</p>
<hr />
<p><span style=\"font-weight: 400;\">No exemplo abaixo, utilizando a aplicação form_orders,  iremos validar o campo freight, onde se o valor atribuído ao campo freight for maior que 30 será disparado uma mensagem de erro para o usuário e o envio do formulário será cancelado.</span></p>
<p><strong>Exemplo do código:</strong></p>
<p><strong>if({freight} > 30){</strong></p>
<p><strong>sc_error_message(\"Valor do frete é muito alto\");</strong></p>
<p><strong>}</strong></p>",
                        'en' => "<p>This event is executed when the form is submitted to the server, using the buttons: \"add\", \"change\" or \"delete\"<br />In this event, it is allowed to perform validations before the form data is sent to the database.</p>
<hr />
<p><br />In the example below, using the form_orders application, we will validate the freight field, where if the value assigned to the freight field is greater than 30, an error message will be triggered to the user and the form submission will be cancelled.</p>
<p><br />Code example:<br />if({freight} > 30){<br />  sc_error_message(\"Shipping value is too high\");<br />}</p>"
                    ]
                ],
                            
                'form_onValidateFailure' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando existe erro de validação.",
                        'en' => "This event occurs when there is a validation error."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre quando ao submeter, a aplicação no onValidate, tiver erro, gerado pelas macros sc_error_exit, sc_error_message, ou por erro verificado pelo scriptcase (erros relacionados a Banco de dados). </p>",
                        'en' => "<p>This event occurs when submitting the application in OnValidate, has errors generated by macros sc_error_exit, sc_error_message, or error detected by scriptcase (errors related to Database).</p>"
                    ]
                ],
                            
                'form_onValidateSuccess' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando não existe erro de validação.",
                        'en' => "This event occurs when there is no validation error."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">Este evento ocorre após submeter o formulário e executar o evento onValidate, então se a validação for bem sucedida e não contiver erros, gerado pelas macros sc_error_exit ou sc_error_message, o evento onValidateSuccess é executado.</span></p>",
                        'en' => "<p>This event occurs after submitting the form and executing the onValidate event, so if the validation is successful and contains no errors, generated by the sc_error_exit or sc_error_message macros, the onValidateSuccess event is executed.</p>"
                    ]
                ],
                            
                'form_controle_ajaxFieldonBlur' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html perde o focus.",
                        'en' => "This event occurs when the field \"loses\" focus."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre quando o objeto html perde o foco.</p>
<hr />
<p><strong>Exemplo:</strong></p>
<p>Em um form de pedidos, ao digitar o código do produto<strong>{cpo_produto}</strong> em um campo, desejamos preencher o valor unitário do produto e em outro campo e exibir a descrição do mesmo.</p>
<p>No evento ajax onblur, criado no campo onde o código do produto será informado<strong>{cpo_produto}, </strong>podemos usar um código semelhante a este:</p>
<p><code>sc_lookup(prod,\" select descricao , valor from produtos where codigo = {cpo_produto} \");</code><br /><br /><code>{desc_produto} = {prod[0][1]};</code><br /><code>{val_produto} = {prod[0][2]};</code></p>",
                        'en' => "<p>Occurs when the focus get out of the HTML object.</p>
<hr />
<p><strong>Example:</strong></p>
<p>in an order form, when entering the product code in a field, we want to fill the product unit value in another field and display the product description. in the onblur field ajax event we can use a PHP block similar to this:</p>
<p>sc_lookup (prod, \"select description, value from products where code = {product_product}\");</p>"
                    ]
                ],
                            
                'form_controle_ajaxFieldonChange' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html perde o focus e o conteudo foi alterado.",
                        'en' => "This event occurs when the field \"loses\" focus and the field value its changed."
                    ],
                    'desc' => [
                        'pt' => "<p>Ocorre quando o foco sai do objeto HTML e houver alteração em seu conteúdo.</p>
<hr />
<p><strong>Exemplo: </strong></p>
<p>Em um formulario de pedidos, desejamos preencher o valor do produto no campo \"preco\" ao digitar o código daquele produto. </p>
<p>sc_lookup(vunit,\" select preco from produtos where codigo = {cod_produto} \"); {cpo_precp_unit_do_form} = {vunit[0][0]};</p>",
                        'en' => "<p>Occurs when focus leaves the HTML object and its content has changed.</p>
<hr />
<p><strong>Example: </strong></p>
<p>In an Order form, we want to fill in the value in the \"price\" field when we enter a product code.</p>
<p>sc_lookup(prc,\" select price from products where productid = '{field_product_id}' \"); {other_form_field_price} = {prc[0][0]};</p>"
                    ]
                ],
                            
                'form_controle_ajaxFieldonClick' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html recebe um click.",
                        'en' => "This event occurs when a input object is clicked."
                    ],
                    'desc' => [
                        'pt' => "<p><span style=\"font-weight: 400;\">Ocorre a partir do clique do usuário no campo configurado com o evento, permitindo assim, que ações específicas sejam executadas após a interação do usuário do sistema. </span></p>
<hr />
<p><strong>Exemplo:</strong></p>
<p>Em um campo tipo Radio, queremos esconder ou exibir um outro campo dependendo do valor clicado no campo radio. </p>
<p>if ( <strong>{fld_radio}</strong> == 1 ) {</p>
<p>  sc_field_display(<strong>{fld_information}</strong>, on);</p>
<p>}else{</p>
<p>   sc_field_display(<strong>{fld_information}</strong>, off);</p>
<p>}</p>",
                        'en' => "<p>The event occurs when the user clicks on the configured field, thus allowing specific actions to be performed after system user interaction.</p>
<hr />
<p><strong>Example:</strong></p>
<p>In a Radio field, we want to hide or display another field depending on the value clicked on the radio field.</p>
<p>if ( <strong>{fld_radio}</strong> == 1 ) {</p>
<p>  sc_field_display(<strong>{fld_information}</strong>, on);</p>
<p>}else{</p>
<p>   sc_field_display(<strong>{fld_information}</strong>, off);</p>
<p>}</p>"
                    ]
                ],
                            
                'form_controle_ajaxFieldonFocus' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o objeto html recebe o foco.",
                        'en' => "This event occurs when the field is focused."
                    ],
                    'desc' => [
                        'pt' => "<p>Este evento ocorre quando o objeto HTML recebe o foco do mouse.</p>
<hr />
<p><strong>Exemplo:</strong></p>
<p>Desejamos que o <strong>campoX</strong> não permita ser alterado e que o focus do mouse vá para outro campo exibindo uma mensagem de alerta na tela. </p>
<p>sc_set_focus(<strong>outrocampo</strong>);<br />sc_alert(\"Não altere o valor do campoX\");</p>",
                        'en' => "<p>This event occurs when the HTML object receives the mouse focus.</p>
<hr />
<p><strong>Example:</strong></p>
<p>We don't want to allow that the <strong>fieldX </strong>to be changed and the mouse focus to go to another field displaying an alert message on the screen.</p>
<p>sc_set_focus(<strong>anotherfield</strong>);<br />sc_alert(\"Do not change this field\");</p>"
                    ]
                ],
                            
                'form_controle_onApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma unica vez quando a aplicacao é carregada.",
                        'en' => "This event occurs once only when the application is loaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da aplicação executar o SQL. Só é executada ao carregar a aplicação.

É usado para verificações de variáveis e para verificações de segurança.

Ex:

if ([glo_var_depto] != 'financeiro'){

sc_redir(app_x.php);

}",
                        'en' => "This event occurs before the application execute the SQL, and execute only once.

Is used to do verification of variables, and security verification.

Ex:

if ([glo_var_department] != 'financial'){

sc_redir(app_x.php);

}"
                    ]
                ],
                            
                'form_controle_onClick' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando clicamos em um botão criado na barra de ferramentas.",
                        'en' => "This event occurs when a created button is clicked"
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre quando clicamos em um botão criado na barra de ferramentas.",
                        'en' => "This event occurs when a created button is clicked"
                    ]
                ],
                            
                'form_controle_onInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre na inicialização do formulário.",
                        'en' => "This event occurs when the form its initialized."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da inicialização do formulário, neste momento, as variáveis locais da aplicação, não estão disponíveis.",
                        'en' => "These formulas are executed before the application starts. At this moment, the application locals variables are not available."
                    ]
                ],
                            
                'form_controle_onLoadAll' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o formulário é carregado.",
                        'en' => "This event occurs when the form its loaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado antes que o formulário seja carregado. Neste momento todas as variáveis da aplicação estão disponíveis.",
                        'en' => "This event its executed before the form is loaded. In this moment all the applications variables are available."
                    ]
                ],
                            
                'form_controle_onRefresh' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando houver recarga do formulário.",
                        'en' => "This event occurs when the form its reloaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre quando acontece uma recarga no form.",
                        'en' => "This event occurs when the form application is reloaded, is possible to reload the form based on fields (select , radio, checkbox)"
                    ]
                ],
                            
                'form_controle_onValidate' => [
                    'res' => [
                        'pt' => "Este evento ocorre durante a validação dos dados do formulário.",
                        'en' => "This event occurs during the data validation in a form application."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado quando o formulário é submetido ao servidor, através dos botões: \"incluir\", \"alterar\" ou \"excluir\"",
                        'en' => "This event occurs before the end user (inserts, updates or deletes) a row."
                    ]
                ],
                            
                'form_controle_onValidateFailure' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando existe erro de validação.",
                        'en' => "This event occurs when there is a validation error."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre quando ao submeter, a aplicação no onValidate houver erro gerado pelas macros sc_error_exit, sc_error_message, ou por erro verificado pelo Scriptcase (erros relacionados a Banco de dados).",
                        'en' => "This event occurs when submitting the application in OnValidate, there are errors generated by macros sc_error_exit, sc_error_message, or error detected by Scriptcase (errors related to Database)."
                    ]
                ],
                            
                'form_controle_onValidateSuccess' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando não existe erro de validação.",
                        'en' => "This event occurs when there is no validation errors."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre quando ao submeter a aplicação no onValidate não houver erro gerado pelas macros sc_error_exit, sc_error_message, ou por erro verificado pelo Scriptcase (erros relacionados a Banco de dados).",
                        'en' => "This event occurs when submitting the application to onValidate, there is no error generated by the macros sc_error_exit, sc_error_message, or by error verified by Scriptcase (errors related to Database)."
                    ]
                ],
                            
                'form_controle_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                            
                'menu_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                            
                'menu_onApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma unica vez quando a aplicacao é carregada",
                        'en' => "This event occurs once only when the application is loaded"
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da aplicação executar o SQL. Só é executada ao carregar a aplicação. É usado para verificações de variáveis e para verificações de segurança.",
                        'en' => "This event occurred before the application execute the SQL, and execute only once. Is used to do verification of variables, and security verification."
                    ]
                ],
                            
                'menu_onExecute' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando um item do menu é selecionado",
                        'en' => "This event occurs when a menu item it selected"
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre nas aplicações de \"menu\" e é executado quando uma aplicação é chamada através de um link do menu.

Normalmente é utilizado para a tomada de decisão antes da execução da aplicação chamada, ver: sc_script_name e sc_menu_item",
                        'en' => "This event works only in the \"menu\" applications and are executed when an application is called through a link of the menu.

Normally are used to the decision taking before the application execution named sc_script_name."
                    ]
                ],
                            
                'menu_onLoad' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o menu é carregado",
                        'en' => "This event occurs when the menu its loaded"
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre na carga de um menu horizontal/vertical.

Podemos nesse evento rodar alguma diretiva de segurança , por exemplo se houver uma tentativa de acesso direto ao menu, sem antes se passar por um form de login , podemos através do teste de uma variável de sessão definida no form de login , redirecionar o fluxo para a aplicação inicial.

if(!isset([var_id_usu]) or empty([var_id_usu]))

{

       sc_redirect(\"login.php\");

}",
                        'en' => "This event occurs when loading a horizontal / vertical menu.

In this event we can run some security policy, for example if there is an attempt to access the menu directly, without first going through a login form, we can test a session variable defined in the login form, redirect the flow to the initial application.

if( !isset([var_id_user]) or empty([var_id_user]) )

{
       sc_redirect(\"login.php\");
}"
                    ]
                ],
                            
                'menutree_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                            
                'menutree_onApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma unica vez quando a aplicacao é carregada",
                        'en' => "This event occurs once only when the application is loaded"
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da aplicação executar o SQL. Só é executada ao carregar a aplicação. É usado para verificações de variáveis e para verificações de segurança.",
                        'en' => "This event occurred before the application execute the SQL, and execute only once. Is used to do verification of variables, and security verification."
                    ]
                ],
                            
                'menutree_onExecute' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando um item do menu é selecionado",
                        'en' => "This event occurs when a menu item its selected"
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre nas aplicações de \"menu\" e é executado quando uma aplicação é chamada através de um link do menu.

Normalmente é utilizado para a tomada de decisão antes da execução da aplicação chamada, ver: sc_script_name e sc_menu_item",
                        'en' => "This event works only in the \"menu\" applications and are executed when an application is called through a link of the menu.

Normally are used to the decision taking before the application execution named sc_script_name."
                    ]
                ],
                            
                'menutree_onLoad' => [
                    'res' => [
                        'pt' => "Este evento ocorre quando o menu é carregado",
                        'en' => "This event occurs when the menu its loaded"
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre na carga de um menu horizontal/vertical.

Podemos nesse evento rodar alguma diretiva de segurança , por exemplo se houver uma tentativa de acesso direto ao menu, sem antes se passar por um form de login , podemos através do teste de uma variável de sessão definida no form de login , redirecionar o fluxo para a aplicação inicial.

if(!isset([var_id_usu]) or empty([var_id_usu]))

{

       sc_redirect(\"login.php\");

}",
                        'en' => "This event occurs when loading a horizontal / vertical menu.

In this case, we can execute some security policy, for example, if you try to access the menu directly, without first going through a login form, we can test a session variable defined in the login form, redirect the flow to the initial application.

if( !isset([var_id_user]) or empty([var_id_user]) )

{
       sc_redirect(\"login.php\");
}"
                    ]
                ],
                            
                'reportpdf_onApplicationInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma unica vez quando a aplicacao é carregada",
                        'en' => "This event occurs once only when the application is loaded"
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre antes da aplicação executar o SQL. Só é executada ao carregar a aplicação. É usado para verificações de variáveis e para verificações de segurança.",
                        'en' => "This event occurred before the application execute the SQL, and execute only once. Is used to do verification of variables, and security verification."
                    ]
                ],
                            
                'reportpdf_onFooter' => [
                    'res' => [
                        'pt' => "Este evento ocorre na exibição do rodapé.",
                        'en' => "This event occurs on the application footer display."
                    ],
                    'desc' => [
                        'pt' => "Este evento é utilizado quando no rodapé precisarmos exibir algum valor calculado, é neste evento que escrevemos o cálculo necessário para montar algum valor que desejamos exibir.",
                        'en' => "This event is used when in the footer we need to display some calculated value, it is in this event that we write the calculation necessary to assemble some value that we want to display."
                    ]
                ],
                            
                'reportpdf_onHeader' => [
                    'res' => [
                        'pt' => "Este evento ocorre na exibição do cabeçalho.",
                        'en' => "This event occurs before the header display"
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado imediatamente antes da exibição do cabeçalho da consulta, podemos utilizar este evento por exemplo quando precisarmos imprimir algum valor calculado no cabeçalho.
",
                        'en' => "This event occurs before the header display. This event is frequently used when it is required to display any calculated value on report header.
"
                    ]
                ],
                            
                'reportpdf_onInit' => [
                    'res' => [
                        'pt' => "Este evento ocorre sempre que a aplicação é carregada, ou recarregada.",
                        'en' => "This event occurs every time the application is loaded or reloaded."
                    ],
                    'desc' => [
                        'pt' => "Este evento é executado toda vez, quando a aplicação é carregada, ou recarregada, antes da execução do select principal da aplicação. Neste escopo, normalmente, são executadas as macros que alteram o select, tais como: sc_select_field, sc_select_order, sc_select_where(add), etc...
Podemos também carregar valor para algum atributo da aplicação , bem como verificar alguma diretiva de segurança da mesma antes de executar a aplicação.",
                        'en' => "This event occurs when the application its loaded, or reload. Occurs before the application runs the SQL statement, so using this event it is possible to modify the grid SQL statement dynamically, based on any logical.
Macros frequently called on this event: sc_select_field, sc_select_order, sc_select_where(add), etc"
                    ]
                ],
                            
                'reportpdf_onRecord' => [
                    'res' => [
                        'pt' => "Este evento ocorre uma vez para cada registro.",
                        'en' => "This event occurs immediately before printing a row."
                    ],
                    'desc' => [
                        'pt' => "Este evento ocorre imediatamente antes da exibição de cada registro.",
                        'en' => "This event occurs immediately before displaying a row, it is used to calculate any cell value.
"
                    ]
                ],
                            
                'reportpdf_allMacros' => [
                    'res' => [
                        'pt' => "",
                        'en' => ""
                    ],
                    'desc' => [
                        'pt' => "",
                        'en' => ""
                    ]
                ],
                        
            ];
            return $arr_evt;
        }
        