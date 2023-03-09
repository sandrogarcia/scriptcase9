<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIniDefinition');

/* Definicao da classe */
class nmXmlparserIniDefinitionTable extends nmXmlparserIniDefinition
{


    var $teste;
    var $table;
    var $fields;
    var $subtypes;
    var $indexes;
    var $index;
    var $fields_in;
    var $tipo;

    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o elemento raiz do XML.
     *
     * @access  public
     * @param   string  $v_str_group  Grupo de trabalho do ScriptCase.
     * @global  array   $nm_config    Array com configuracao do ScriptCase.
     */
    function __construct($v_str_group, $v_str_file = 'dbmanager')
    {
        global $nm_config;
        if (!@is_dir($nm_config['path_grp'] . $v_str_group . '/def/'))
        {
            nm_dir_create($nm_config['path_grp'] . $v_str_group . '/def/');
        }
        $this->SetRoot('database');
        $this->SetDir($nm_config['path_grp'] . $v_str_group . '/def/');
        $this->SetFile($v_str_file);
    } // nmXmlparserIniDefinition
}
?>