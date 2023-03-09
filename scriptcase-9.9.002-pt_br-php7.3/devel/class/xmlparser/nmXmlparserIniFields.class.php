<?php
/* Classes ancestrais */
nm_load_class('xmlparser', 'XmlparserIni');

/* Definicao da classe */
class nmXmlparserIniFields extends nmXmlparserIni
{
    /* ----- Construtor e Destrutor ------------------------------------ */

    /**
     * Construtor da classe.
     *
     * Seta o elemento raiz do XML.
     *
     * @access  public
     */
    function __construct()
    {
        global $nm_config;
        $this->SetRoot('ROOT');
    } // nmXmlparserIniPublish

    /* ----- Metodos Protegidos ---------------------------------------- */

    /**
     * Normaliza estrutura de dados.
     *
     * Normaliza estrutura retornada pelo EZXML para uso no sistema.
     *
     * @access  protected
     * @param   array      $v_arr_ezxml  Array do EZXML.
     * @return  array      $arr_xml      Array do ScriptCase.
     */
    function Normalize($v_arr_ezxml)
    {
      /* Inicia estrutura do XML */
      $arr_xml = array();
      $arr_fields = array();

      /** Carrega dados do XML  //
       */
      if (isset(   $v_arr_ezxml['ROOT']['children'])                           &&
          is_array($v_arr_ezxml['ROOT']['children'])                           &&
          isset(   $v_arr_ezxml['ROOT']['children'][0]['TARGETS'])             &&
          is_array($v_arr_ezxml['ROOT']['children'][0]['TARGETS'])             &&
          isset(   $v_arr_ezxml['ROOT']['children'][0]['TARGETS']['children']) &&
          is_array($v_arr_ezxml['ROOT']['children'][0]['TARGETS']['children'])
         )
      {
        foreach ($v_arr_ezxml['ROOT']['children'][0]['TARGETS']['children'] as $arr_targets)
        {
          if (isset($arr_targets['TARGET']) && isset($arr_targets['TARGET']['children']))
          {
            $_field_ = '';
            foreach ($arr_targets['TARGET']['children'] as $arr_node)
            {
              $str_node = key($arr_node);

              if ($str_node == 'campo' )
                $_field_ = $arr_node[$str_node]['content'];

              $arr_xml[strtolower($str_node)] = $this->HandleCharsXml($arr_node[$str_node]['content']);
            }
          }
          $arr_fields[$_field_] = $arr_xml;
        }
      }// End if (isset(   $v_arr_ezxml['ROOT']['children'])                           &&

      return $arr_fields;
    } // Normalize

    /* ----- Metodos Publicos ------------------------------------------ */
}
?>