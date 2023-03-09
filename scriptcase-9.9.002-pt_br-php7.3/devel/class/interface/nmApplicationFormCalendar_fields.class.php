<?php
/**
 * Classe ApplicationFormCalendar_fields.
 *
 * Classe para propriedades do calendario.
 *
 * @package     Classes
 * @subpackage  Interface
 * @creation    2010/03/23
 * @copyright   NetMake Solucoes em Informatica
 * @author      Juliano Mesquita dos Santos <juliano@netmake.com.br>
 *
 * $Id: nmApplicationFormCalendar_fields.class.php,v 1.1.1.1 2011-05-12 20:30:48 diogo Exp $
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
class nmApplicationFormCalendar_fields extends nmApplication
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
        $this->SetFields(array(
                               'calendar_fields' =>
                               array(
                                     'list_fld_calendar',
                                    ),
                              )
                        );
    } // nmApplicationFormCalendar_fields
}

?>