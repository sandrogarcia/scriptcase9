<?php
// Inicializa array
$arr_fields = array();

// sc_tbprj - tabela de grupos
$arr_fields['sc_tbprj'] = array(
                                'Cod_Prj'   => 'CHAR',
                                'Descricao' => 'CHAR',
                                'Data_Inc'  => 'CHAR',
                                'Hora_Inc'  => 'CHAR',
                                'Folders'   => 'TEXT',
                                'Publish'   => 'TEXT',
                                'Config'    => 'TEXT',
                                'Attr1'     => 'TEXT',
                                'Attr2'     => 'TEXT',
                                'Attr3'     => 'TEXT',
                               );

// sc_tbusu = tabela de usuarios
$arr_fields['sc_tbusu'] = array(
                                'Login'        => 'CHAR',
                                'Senha'        => 'CHAR',
                                'Email'        => 'CHAR',
                                'Data_Inc'     => 'CHAR',
                                'Hora_Inc'     => 'CHAR',
                                'Data_Uacc'    => 'CHAR',
                                'Hora_Uacc'    => 'CHAR',
                                'Ip_Uacc'      => 'CHAR',
                                'Projetos'     => 'TEXT',
                                'Ult_Proj'     => 'CHAR',
                                'Ult_Proj_Ver' => 'NUMBER',
                                'Ult_Folder'   => 'CHAR',
                                'Privilegios'  => 'TEXT',
                                'Lembra_Senha' => 'CHAR',
                                'Attr1'        => 'CHAR',
                                'Attr2'        => 'TEXT',
                                'Attr3'        => 'TEXT',
                                'Attr4'        => 'TEXT',
                               );

// sc_tbapl = tabela de aplicacoes normais
$arr_fields['sc_tbapl'] = array(
                                'Cod_Prj'                  => 'CHAR',
                                'Versao'                   => 'NUMBER',
                                'Cod_Apl'                  => 'CHAR',
                                'friendly_name'            => 'CHAR',
                                'Login'                    => 'CHAR',
                                'Tipo_Apl'                 => 'CHAR',
                                'Descricao'                => 'TEXT',
                                'Folder'                   => 'CHAR',
                                'Data_Inc'                 => 'CHAR',
                                'Hora_Inc'                 => 'CHAR',
                                'Data_Uacc'                => 'CHAR',
                                'Hora_Uacc'                => 'CHAR',
                                'Data_Ger'                 => 'CHAR',
                                'Hora_Ger'                 => 'CHAR',
                                'usa_seguranca'            => 'CHAR',
                                'Idioma'                   => 'CHAR',
                                'charset_specific'         => 'CHAR',
                                'NomeConexao'              => 'CHAR',
                                'NomeTabela'               => 'CHAR',
                                'Campos_Chave'             => 'TEXT',
                                'Template'                 => 'CHAR',
                                'TemplateGrid'             => 'CHAR',
                                'TemplateEdit'             => 'CHAR',
                                'TemplateSearch'           => 'CHAR',
                                'TemplateDetalhe'          => 'CHAR',
                                'TemplateHeadSearch'       => 'CHAR',
                                'TemplateFooterSearch'     => 'CHAR',
                                'SchemaAll'                => 'CHAR',
                                'schemachart'              => 'CHAR',
                                'SchemaSearch'             => 'CHAR',
                                'ButtonAll'                => 'CHAR',
                                'ButtonSearch'             => 'CHAR',
                                'Cabecalho_Grid_Mostra'    => 'CHAR',
                                'Cabecalho_Pesq_Mostra'    => 'CHAR',
                                'Cabecalho_Edit_Mostra'    => 'CHAR',
                                'Cabecalho_Detalhe_Mostra' => 'CHAR',
                                'Tables'                   => 'TEXT',
                                'ComandoSelect'            => 'TEXT',
                                'Variaveis'                => 'TEXT',
                                'Xml_Procedure'            => 'TEXT',
                                'Attr1'                    => 'TEXT',
                                'Attr2'                    => 'TEXT',
                                'Attr3'                    => 'TEXT',
                                'Attr4'                    => 'TEXT',
                                'Attr5'                    => 'TEXT',
                                'Attr6'                    => 'TEXT',
                                'Attr7'                    => 'TEXT',
                                'Attr8'                    => 'TEXT',
                                'Attr9'                    => 'TEXT',
                                'Attr10'                    => 'TEXT',
                               );

// sc_tbcmp = tabela de campos
$arr_fields['sc_tbcmp'] = array(
                                'Cod_Prj'                 => 'CHAR',
                                'Versao'                  => 'NUMBER',
                                'Cod_Apl'                 => 'CHAR',
                                'Seq'                     => 'NUMBER',
                                'Login'                   => 'CHAR',
                                'Campo'                   => 'CHAR',
                                'Html_Tipo'               => 'CHAR',
                                'Tipo_Dado'               => 'CHAR',
                                'Tipo_Dado_Filtro'        => 'CHAR',
                                'Tipo_Sql'                => 'CHAR',
                                'Campo_Def'               => 'TEXT',
                                'Def_Campo'               => 'TEXT',
                                'Label'                   => 'CHAR',
                                'Label_Filtro'            => 'CHAR',
                                'Usar_Label_Grid'         => 'CHAR',
                                'Entra_Edit'              => 'CHAR',
                                'Entra_Update'            => 'CHAR',
                                'Entra_Sort'              => 'CHAR',
                                'EntraDetalhe'            => 'CHAR',
                                'EntraDetalheOrd'         => 'NUMBER',
                                'Def_Tabela'              => 'CHAR',
                                'Def_Complemento'         => 'TEXT',
                                'Def_Complemento_Cons'    => 'TEXT',
                                'Def_Complemento_Pesq'    => 'TEXT',
                                'Texto_Xml'               => 'TEXT',
                                'Xml_Subconsulta'         => 'TEXT',
                                'Ajax_Dados'              => 'CHAR',
                                'Attr1'                   => 'TEXT',
                                'Attr2'                   => 'TEXT',
                                'Attr3'                   => 'TEXT',
                                'Attr4'                   => 'TEXT',
                                'Attr5'                   => 'TEXT',
                                'Attr6'                   => 'TEXT',
                               );

// nm_tbrep - tabela de repositorios
$arr_fields['sc_tbrep'] = array(
                                'Cod_Prj'       => 'CHAR',
                                'RepositorioId' => 'CHAR',
                                'Descricao'     => 'CHAR',
                                'ConexaoDB'     => 'TEXT',
                                'Attr1'         => 'TEXT',
                                'Attr2'         => 'TEXT',
                               );

// nm_tbrep_tables - tabela de tabelas dos repositorios
$arr_fields['sc_tbrep_tables'] = array(
                                'Cod_Prj'          => 'CHAR',
                                'RepositorioId'    => 'CHAR',
                                'Tabela'           => 'CHAR',
                                'Label'            => 'CHAR',
                                'Descricao'        => 'TEXT',
                                'Version'          => 'CHAR',
                                'NewVersion'       => 'CHAR',
                                'DateTimeRefresh'  => 'CHAR',
                                'StatusVersion'    => 'CHAR',
                                'StatusNewVersion' => 'CHAR',
                                'Attr1'            => 'TEXT',
                                'Attr2'            => 'TEXT',
                               );

// nm_tbrep_fields - tabela de campos dos repositorios
$arr_fields['sc_tbrep_fields'] = array(
                                'Cod_Prj'        => 'CHAR',
                                'RepositorioId'  => 'CHAR',
                                'Tabela'         => 'CHAR',
                                'Campo'          => 'CHAR',
                                'Version'        => 'CHAR',
                                'Seque'          => 'NUMBER',
                                'TipoSql'        => 'CHAR',
                                'Tamanho'        => 'NUMBER',
                                'Decimais'       => 'NUMBER',
                                'TipoDado'       => 'CHAR',
                                'Label'          => 'CHAR',
                                'Descricao'      => 'TEXT',
                                'Atributos'      => 'TEXT',
                                'DateTimeUpdate' => 'CHAR',
                                'UsuarioUpdate'  => 'CHAR',
                                'Status'         => 'CHAR',
                                'Attr1'          => 'TEXT',
                                'Attr2'          => 'TEXT',
                               );


// sc_tbconex - tabela de conexoes
$arr_fields['sc_tbconex'] = array(
                                'Cod_Prj'        => 'CHAR',
                                'Nome'           => 'CHAR',
                                'Sgdb'           => 'CHAR',
                                'Servidor'       => 'TEXT',
                                'Usuario'        => 'CHAR',
                                'Senha'          => 'CHAR',
                                'Banco'          => 'TEXT',
                                'Simb_Decimal'   => 'CHAR',
                                'Contr_trans'    => 'CHAR',
                                'Repositorio'    => 'CHAR',
                                'Filtros'        => 'TEXT',
                                'Attr1'          => 'TEXT',
                               );

// sc_tbevt - tabela de eventos
$arr_fields['sc_tbevt'] = array(
                                'Cod_Prj'        => 'CHAR',
                                'Versao'         => 'NUMBER',
                                'Cod_Apl'        => 'CHAR',
                                'Nome'           => 'CHAR',
                                'Tipo'           => 'CHAR',
                                'Parms'          => 'CHAR',
                                'Codigo'         => 'TEXT',
                               );


// sc_tbversao - tabela de versoes
$arr_fields['sc_tbversao'] = array(
                                'Cod_Prj'        => 'CHAR',
                                'Versao'         => 'NUMBER',
                                'Ver_Major'      => 'NUMBER',
                                'Ver_Minor'      => 'NUMBER',
                                'Ver_Build'      => 'NUMBER',
                                'Descricao'      => 'CHAR',
                                'Data_Cria'      => 'CHAR',
                                'Hora_Cria'      => 'CHAR',
                                'Login_Cria'     => 'CHAR',
                                'Bloqueio'       => 'CHAR',
                                'Data_Bloq'      => 'CHAR',
                                'Hora_Bloq'      => 'CHAR',
                                'Login_Bloq'     => 'CHAR',
                                'Data_Reab'      => 'CHAR',
                                'Hora_Reab'      => 'CHAR',
                                'Login_Reab'     => 'CHAR',
                                'Attr1'          => 'TEXT');

//  sc_tblog    - tabela de schemas do modulo de log
$arr_fields['sc_tblog'] = array(
                                'Cod_Prj'           => 'CHAR',
                                'Versao'            => 'NUMBER',
                                'Name_Schema'       => 'CHAR',
                                'Padrao'            => 'CHAR',
                                'Descricao'         => 'CHAR',
                                'Data_criacao'      => 'CHAR',
                                'Data_atualizacao'  => 'CHAR',
                                'Conn'              => 'CHAR',
                                'TableName'         => 'CHAR',
                                'Var_login'         => 'CHAR',
                                'rec_mode'          => 'CHAR',
                                'Attr1'             => 'TEXT');

// sc_tblog_apl - tabela de log de apl
$arr_fields['sc_tblog_apl'] = array(
                                'Dt_Backup'      => 'CHAR',
                                'Cod_Prj'        => 'CHAR',
                                'Versao'         => 'NUMBER',
                                'Cod_Apl'        => 'CHAR',
                                'Tipo_Apl'       => 'CHAR',
                                'Campos'         => 'TEXT');

// sc_tblog_cmp - tabela de log de cmp
$arr_fields['sc_tblog_cmp'] = array(
                                'Dt_Backup'      => 'CHAR',
                                'Cod_Prj'        => 'CHAR',
                                'Versao'         => 'NUMBER',
                                'Cod_Apl'        => 'CHAR',
                                'Seq'            => 'NUMBER',
                                'Campos'         => 'TEXT');

// sc_tbtodo
$arr_fields['sc_tbtodo'] = array(
                                'cd_todo'        => 'NUMBER',
                                'nivel'          => 'CHAR',
                                'login'          => 'CHAR',
                                'login_responsavel'=> 'CHAR',
                                'Cod_Prj'        => 'CHAR',
                                'Cod_Apl'        => 'CHAR',
                                'cd_todo_parent' => 'NUMBER',
                                'title'          => 'CHAR',
                                'description'    => 'TEXT',
                                'dt_created'     => 'CHAR',
                                'dt_modified'    => 'CHAR',
                                'dt_deadline'    => 'CHAR',
                                'dt_finished'    => 'CHAR',
                                'perc'           => 'CHAR',
                                'finished'       => 'CHAR',
                                'permission'     => 'CHAR',
                                'Attr1'          => 'TEXT',
                                'Attr2'          => 'TEXT',
                                'Attr3'          => 'TEXT',
                                'Attr4'          => 'TEXT',
								);
								
// sc_tbmsg
$arr_fields['sc_tbmsg'] = array(
                                'cd_msg'        => 'NUMBER',
                                'dt_sent'       => 'CHAR',
                                'dt_read'       => 'CHAR',
                                'title'         => 'CHAR',
                                'description'   => 'TEXT',
                                'type'          => 'CHAR',
                                'login_destino' => 'CHAR',
                                'login_origem'  => 'CHAR',
                                'Attr1'         => 'TEXT',
                                'Attr2'         => 'TEXT',
                                'Attr3'         => 'TEXT',
                                'Attr4'         => 'TEXT',
								);
?>