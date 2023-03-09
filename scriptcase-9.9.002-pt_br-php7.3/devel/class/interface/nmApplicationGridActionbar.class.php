<?php

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
    die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
        'invalid access to system file.');
}

/* Classes ancestrais */
nm_load_class('interface', 'Application');

/* Definicao da classe */
class nmApplicationGridActionbar extends nmApplication
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
        $this->SetFields(
            array(
                'actionbar' =>
                    array(
                        'sc_actionbar_grid'
                    )
            )
        );
    } // nmApplicationGridAttribute
}
