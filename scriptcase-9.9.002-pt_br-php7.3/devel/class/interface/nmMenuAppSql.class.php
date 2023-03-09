<?php
/**
 * Classe ApplicationGridSql.
 *
 * Classe para manipulacao do SQL.
 *
 * @package     Classes
 * @subpackage  Interface
 * @creation    2006/03/02
 * @copyright   NetMake Solucoes em Informatica
 * @author      Juliano Mesquita dos Santos <juliano@netmake.com.br>
 *
 * $Id: nmApplicationGridSql.class.php,v 1.1.1.1 2011-05-12 20:30:48 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

/* Classes ancestrais */
nm_load_class('interface', 'MenuApp');

/* Definicao da classe */
class nmMenuAppSql extends nmMenuApp
{
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Inicializa objeto.
     *
     * @access  public
     */
    function __construct()
    {
        $this->SetTable('tab_apl');
        $this->SetCodField('Cod_Apl');
        $this->SetFields(array('sql' =>
                               array(
                                     'NomeConexao',
                                    )
                              )
                        );
    }
}

?>