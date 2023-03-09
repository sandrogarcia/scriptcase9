<?php
/**
 * Classe ApplicationGridGrid.
 *
 * Classe para manipulacao de grid de uma consulta.
 *
 * @package     Classes
 * @subpackage  Interface
 * @creation    2003/11/29
 * @copyright   NetMake Solucoes em Informatica
 * @author      Luis Humberto Roman <romanlh@netmake.com.br>
 *
 * $Id: nmApplicationGridGrid.class.php,v 1.1.1.1 2011-05-12 20:30:48 diogo Exp $
 */

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

/* Classes ancestrais */
nm_load_class('interface', 'Application');

/* Definicao da classe */
class nmApplicationFormExportGooglesheets extends nmApplication
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
        $this->SetFields(array('export_googlesheets' =>
                               array(
                                     'googlesheets_api',
                                     'googlesheets_name',
//                                     'googlesheets_parent',
                                     'googlesheets_fileid',
                                     'googlesheets_fields',
                                    )
                              )
                        );
    } // nmApplicationGridExportSettings
}

?>