<?php
/**
 * Classe ApplicationGridMobile.
 *
 * Classe para manipulacao da exibição da grid em ambiente mobile.
 *
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
class nmMenuAppMobile extends nmMenuApp
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

        $fields = [
            'mobile_settings' => [
                'mobile_menu_start_as',
                'mobile_menu_toolbar',
                'menu_mobile_type',
                'mobile_menu_mobile_hide',
                'mobile_menu_mobile_inicial_state',
                'mobile_menutree_mobile_float',
                'mobile_menu_mobile_hide_onclick',
                'mobile_menu_mobile_hide_icon',
            ],
        ];

        $this->SetFields($fields);
    } // nmMenuAppMobile
}

?>