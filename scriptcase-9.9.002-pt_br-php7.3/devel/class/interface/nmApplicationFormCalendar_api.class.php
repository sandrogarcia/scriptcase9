<?php
/**
 * Classe ApplicationFormCalendar_google_api.
 *
 * Classe para propriedades do calendario.
 *
 * @package     Classes
 * @subpackage  Interface
 * @creation    2010/03/23
 * @copyright   NetMake Solucoes em Informatica
 * @author      Juliano Mesquita dos Santos <juliano@netmake.com.br>
 *
 * $Id: nmApplicationFormCalendar_google_api.class.php,v 1.1.1.1 2011-05-12 20:30:48 diogo Exp $
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
class nmApplicationFormCalendar_api extends nmApplication
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
                               'calendar_api' =>
                               array(
                                     'calendar_use_google',
                                     'calendar_json_oauth',
                                     'calendar_store_login',
                                     'calendar_use_form_update_google',
                                     'calendar_use_form_update_google_insert',
                                     'calendar_use_form_update_google_update',
                                     'calendar_use_form_update_google_delete',
                                    ),
                              )
                        );
    } // nmApplicationFormCalendar_api
}

?>