<?php
/**
 * Classe ApplicationFilterMobile.
 *
 * Classe para manipulacao da exibição do search em ambiente mobile.
 *
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
class nmApplicationFilterMobile extends nmApplication
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
        global $nm_config;
        $this->SetTable('tab_apl');
        $this->SetCodField('Cod_Apl');

        if ($_SESSION['nm_session']['app']['type'] == NM_APP_TYPE_FILTER) {
            $fields = [
                'mobile_settings' => [
                    'use_mobile_improvements',
                    'mobile_display_scrollup',
                    'mobile_scrollup_position',
                    'mobile_toolbar_simple',
                    'mobile_toolbar_bottom_fixed',
//                    'mobile_display_options_button',
//                    'mobile_toolbar_orientation',
//                'mobile_navigation_bar_buttons',
                ],
//                'mobile_settings_detail' => [
//                    'use_mobile_improvements_detail',
//                    'mobile_display_options_button_detail',
//                    'mobile_toolbar_orientation_detail',
//                ],
//                'mobile_settings_search' => [
//                    'use_mobile_improvements_search',
//                    'mobile_display_options_button_search',
//                    'mobile_toolbar_orientation_search',
//                ],
//                'mobile_settings_summary' => [
//                    'use_mobile_improvements_summary',
//                    'mobile_display_options_button_summary',
//                    'mobile_toolbar_orientation_summary',
//                ],
            ];
        } else {
            $fields = [
                'mobile_settings' => [
                    'use_mobile_improvements',
//                    'mobile_display_scrollup',
//                    'mobile_scrollup_position',
                ],
//                'mobile_settings_search' => [
//                    'use_mobile_improvements_search',
//                    'mobile_display_options_button_search',
//                    'mobile_toolbar_orientation_search',
//                ],
            ];
        }


        $this->SetFields($fields);
    } // nmApplicationFilterMobile
}

?>